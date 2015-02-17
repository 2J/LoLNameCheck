<?php

class MainController extends Controller
{
  public function actionError(){
    echo "no. go back.";
  }

  public function actionViewLog($password=""){
    if($password != "justinjjang") throw new CHttpException(404,'Don\' even try..');
    
    $model=new Log('search');
    $model->unsetAttributes();  // clear any default values
    if(isset($_GET['Log']))
        $model->attributes=$_GET['Log'];

    $this->render('/log/admin',array(
        'model'=>$model,
    ));
  }

	public function actionCheck($username,$region_name)
	{
    if(!$this->validate($username,$region_name)){ //not valid
      die;
    }
    
    date_default_timezone_set ( 'America/Los_Angeles' );
    
    $username_api = preg_replace('/\s+/', '', $username);
    
    $summoner_url = "https://".$region_name.".api.pvp.net/api/lol/".$region_name."/v1.4/summoner/by-name/".$username_api."?api_key=".Yii::app()->params['API_KEY'];
    //SUCCESS: string '{"plant":{"id":22859380,"name":"Plant","profileIconId":580,"summonerLevel":30,"revisionDate":1416661100000}}' (length=108)
    $summoner = CJSON::decode(Yii::app()->curl->get($summoner_url));
    
    $available=true;
    
    if(isset($summoner)){ //username taken - check if available and when
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
      $avail_date = date('Y-m-d',strtotime($last_game_date.' + '.max(6,$summoner['summonerLevel']).' months - 1 DAY'));
      if($avail_date<=date('Y-m-d')) $available=true;
      else $available = false;
      $days_until_avail = floor((strtotime($avail_date)-strtotime(date('Y-m-d')))/86400);

      //log data
      $log = new Log;
      $log->server = $region_name;
      $log->name = $summoner['name'];
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
    }else{ //username invalid or available
      $exist = false;
      $available = true;
    }
    
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
    ));
		
	}
  
	public function actionMain()
	{
		$this->render('main');
	}

  public function validate($username, $region_name){
    $username = preg_replace('/\s+/', '', $username);
    if(!in_array($region_name, ['na','eunw','euw','br','lan','las','oce'] )) {
      echo CJSON::encode(array(
        'name'=>$username,
        'result'=>"<div class=\"avail-no\">Invalid region code</div>",
      ));
      return false;
    }else if ((strlen($username)<2) || (strlen($username)>16) || !ctype_alnum ($username) ) {
      echo CJSON::encode(array(
        'name'=>$username,
        'result'=>"<div class=\"avail-no\">Invalid username</div>",
      ));
      return false;
    }else if ((strpos(strtolower($username),'riot') !== false)){
      echo CJSON::encode(array(
        'name'=>$username,
        'result'=>"<div class=\"avail-no\">Riot Reserved</div>",
      ));
      return false;
    }
    return true;
  }
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}