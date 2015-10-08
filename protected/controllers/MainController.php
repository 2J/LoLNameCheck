<?php

class MainController extends Controller
{
  public $title="";

  public function actionError(){
    echo "no. go back.";
  }
  
	public function actionCheckexists($usernames,$region_name)
	{
    $username = [];
    foreach(explode(',',$usernames) as $name){
      $username[strtolower($name)] = ['exist'=>0];
    }
    $timezone = 'America/Los_Angeles';
    /*switch($timezone){
      case 'na':
        $timezone = 'America/Los_Angeles'; break;
      case 'euw':
        $timezone = 'Europe/Amsterdam'; break;
      default:
        $timezone = 'America/Los_Angeles'; break;
    }*/
    if($timezone != '') date_default_timezone_set ( $timezone );
    
    $username_40s = [];
    $count = 0;
    foreach($username as $name => $exist){
      $username_40s[intval(($count++) / 40)][] = $name;
    }
    
    foreach($username_40s as $batch){
      $summoner_url = "https://".$region_name.".api.pvp.net/api/lol/".$region_name."/v1.4/summoner/by-name/". implode(',',$batch) ."?api_key=".Yii::app()->params['API_KEY'];
      //SUCCESS: string '{"plant":{"id":22859380,"name":"Plant","profileIconId":580,"summonerLevel":30,"revisionDate":1416661100000}}' (length=108)
      $summoners = CJSON::decode(Yii::app()->curl->get($summoner_url));
      
      foreach($summoners as $summ_name => $data){
        $username[$summ_name]['exist'] = 1;
      }
    }
    
    $avail_username = [];
    foreach($username as $name=>$data){
      if($username[$name]['exist'] == 0) {
        $avail_username[] = $name;
        
        $log = new Log;
        $log->server = $region_name;
        $log->name = strtolower(preg_replace('/\s+/', '', strtolower($name)));
        $log->free_date = '2000-01-01 00:00:00';
        $log->ipaddr = "localhost";
        if($log->validate()) $log->save();
      };
      
    }
    echo CJSON::encode(array(
      'avail_usernames'=>$avail_username,
    ));
  }
  
	public function actionCheck($username,$region_name,$g='')
	{
    if(!$this->validate($username,$region_name)){ //not valid
      die;
    }
    $timezone = 'America/Los_Angeles';
    /*switch($timezone){
      case 'na':
        $timezone = 'America/Los_Angeles'; break;
      case 'euw':
        $timezone = 'Europe/Amsterdam'; break;
      default:
        $timezone = 'America/Los_Angeles'; break;
    }*/
    if($timezone != '') date_default_timezone_set ( $timezone );
    
    $username_api = preg_replace('/\s+/', '', $username);
    
    $summoner_url = "https://".$region_name.".api.pvp.net/api/lol/".$region_name."/v1.4/summoner/by-name/".$username_api."?api_key=".Yii::app()->params['API_KEY'];
    //SUCCESS: string '{"plant":{"id":22859380,"name":"Plant","profileIconId":580,"summonerLevel":30,"revisionDate":1416661100000}}' (length=108)
    $summoner = CJSON::decode(Yii::app()->curl->get($summoner_url));
    
    $available=true;
    if(is_array($summoner)) reset($summoner);
    
    if(isset($summoner) && is_array($summoner) && (key($summoner) == strtolower($username_api))){ //username taken - check if available and when
      $summoner = reset($summoner);
      $level=$summoner['summonerLevel'];
      $exist = true;
      $games_url ="https://".$region_name.".api.pvp.net/api/lol/".$region_name."/v1.3/game/by-summoner/".$summoner['id']."/recent?api_key=".Yii::app()->params['API_KEY'];
      $last_game = CJSON::decode(Yii::app()->curl->get($games_url));
      
      if(isset($last_game)){ //has last game
        $last_game_date = date('Y-m-d H:i:s',$last_game['games'][0]['createDate']/1000); //unix timestamp of last played date
      }else{ //TODO: when account is too old and doesnt have any last games played
        $last_game_date = date('Y-m-d H:i:s',$summoner['revisionDate']/1000);
        $used_revision_date = true;
      }
      
      //add # months to date
      $avail_date = [];
      $avail_date['y'] = date('Y',strtotime($last_game_date));
      $avail_date['m'] = date('m',strtotime($last_game_date));
      $avail_date['d'] = date('d',strtotime($last_game_date));
      $avail_date['m'] += max(6,$summoner['summonerLevel']);
      $avail_date['y'] += floor(($avail_date['m'] - 1) / 12);
      $avail_date['m'] = (($avail_date['m'] - 1) % 12) + 1;
      $avail_date['d'] = min(cal_days_in_month(CAL_GREGORIAN, $avail_date['m'], $avail_date['y']), $avail_date['d']);
      $avail_date = date('Y-m-d',strtotime($avail_date['y'].'-'.$avail_date['m'].'-'.$avail_date['d'])); //.' + 1 DAY'
      if($avail_date<=date('Y-m-d')) $available=true;
      else $available = false;
      $days_until_avail = floor((strtotime($avail_date)-strtotime(date('Y-m-d')))/86400);

      //log data
      $log = new Log;
      $log->server = $region_name;
      $log->name = strtolower(preg_replace('/\s+/', '', $username));
      $log->free_date = $avail_date;
      $log->ipaddr = getenv('HTTP_CLIENT_IP')?:
      getenv('HTTP_X_FORWARDED_FOR')?:
      getenv('HTTP_X_FORWARDED')?:
      getenv('HTTP_FORWARDED_FOR')?:
      getenv('HTTP_FORWARDED')?:
      getenv('REMOTE_ADDR')?:
      'UNKNOWN';
      if($log->validate()) $log->save();
      
      //get last played date
    }else{ //username available
      //log data
      $log = new Log;
      $log->server = $region_name;
      $log->name = strtolower(preg_replace('/\s+/', '', $username));
      $log->free_date = '2000-01-01 00:00:00';
      $log->ipaddr = getenv('HTTP_CLIENT_IP')?:
      getenv('HTTP_X_FORWARDED_FOR')?:
      getenv('HTTP_X_FORWARDED')?:
      getenv('HTTP_FORWARDED_FOR')?:
      getenv('HTTP_FORWARDED')?:
      getenv('REMOTE_ADDR')?:
      'UNKNOWN';
      if($log->validate()) $log->save();
      
      $exist = false;
      $available = true;
    }
    
    if($g==''){
      //echo $username;echo $region_name;
      echo CJSON::encode(array(
        'result'=>$this->renderPartial('check',array(
          'exist'=>$exist,
          'level'=>isset($level)?$level:null,
          'available'=>$available,
          'username'=>$username,
          'avail_class'=>($available)? "avail-yes":(($days_until_avail<=90)? "avail-soon":"avail-no"),
          'summoner'=>$summoner,
          'last_game_date'=>isset($last_game_date)? $last_game_date : null,
          'avail_date'=>isset($avail_date)? $avail_date : null,
          'days_until_avail'=>isset($days_until_avail)? $days_until_avail : null,
          'used_revision_date'=>isset($used_revision_date)? $used_revision_date : null,
        ),true),
        'ntoday'=>Log::model()->countBySql("SELECT COUNT(*) AS count FROM log WHERE log.timestamp >= DATE_SUB(NOW(), INTERVAL 1 DAY) AND ipaddr != '135.23.177.38' AND ipaddr != '127.0.0.1'"),
        'ntotal'=>Log::model()->countBySql("SELECT COUNT(*) FROM log where ipaddr != '135.23.177.38' AND ipaddr != '127.0.0.1';"),
      ));
    }else{
      echo CJSON::encode(array(
        'available'=>$available,
        'name'=>$username,
        'avail_date'=>isset($avail_date)? $avail_date : null,
      ));
    }
  }
  
	public function actionMain()
	{
		$this->render('main');
	}
  
  public function actionUpcoming(){
    if(isset($_GET['region'])) $region = $_GET['region'];
    else $region = NULL;
    date_default_timezone_set ( 'America/Los_Angeles' );
    $region_model = RegionIndex::model()->findByAttributes(array('region_code'=>$region));
    if($region_model == NULL){
      $this->render('upcoming_home',array(
        'regions'=>RegionIndex::model()->findAll(),
      ));
    } else {
      $upcoming_names = Yii::app()->db->createCommand(
        'SELECT *,unix_timestamp(now()) - unix_timestamp(timestamp) secondsago FROM
          (SELECT * FROM 
            (SELECT name,free_date,timestamp FROM log log2
            WHERE `server`=\''.$region_model->region_code.'\'
            ORDER BY `timestamp` DESC) log1
          GROUP BY `name` 
          ORDER BY `free_date` DESC) log3 
        WHERE `free_date` <= \''.date('Y-m-d',strtotime(date('Y-m-d').'+ 2 week')).'\'
        AND `free_date` >= \''.date('Y-m-d',strtotime(date('Y-m-d').'- 1 week')).'\''
      )->queryAll();
      $this->render('upcoming',array(
        'region'=>$region_model->region_code,
        'upcoming_names'=>$upcoming_names,
      ));
    }
  }
  
  public function actionPages($page){
    if($page=="faq") $this->render('faq');
  }

  public function validate($username, $region_name){
    $username = preg_replace('/\s+/', '', $username);
    $region = RegionIndex::model()->findByAttributes(array('region_code'=>$region_name));
    if( $region == NULL){
      echo CJSON::encode(array(
        'name'=>$username,
        'result'=>"<div class=\"avail-no\">Invalid region code</div>",
      ));
      return false;
    }else if ((strlen($username)<2) || (strlen($username)>16) || !preg_match($region->regex, $username) ) {
      echo CJSON::encode(array(
        'name'=>$username,
        'result'=>"<div class=\"avail-no\">Invalid username</div>",
      ));
      return false;
    }else if ((strpos(strtolower($username),'riot') !== false) || (BannedList::model()->findByPk(strtolower($username)) !== NULL)){
      echo CJSON::encode(array(
        'name'=>$username,
        'result'=>"<div class=\"avail-no\">Riot Reserved</div>",
      ));
      return false;
    }
    return true;
  }
}