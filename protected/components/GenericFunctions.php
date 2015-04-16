<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class GenericFunctions
{
  public static $my_ips = ['135.23.177.38','127.0.0.1','23.233.119.43'];

	public static function SearchCountLast24() {
    $sql = "SELECT COUNT(*) AS count FROM log WHERE log.timestamp >= DATE_SUB(NOW(), INTERVAL 1 DAY)";
    foreach(self::$my_ips as $ip){
      $sql .= " AND ipaddr != '" . $ip . "'";
    }
    $sql .= ";";
    return Log::model()->countBySql($sql);
	}
  public static function SearchCountAll() {
    $sql = "SELECT COUNT(*) FROM log where ipaddr IS NOT NULL";
    foreach(self::$my_ips as $ip){
      $sql .= " AND ipaddr != '" . $ip . "'";
    }
    $sql .= ";";
    return Log::model()->countBySql($sql);
  }
  
  public static function TimeSince($since){
    $chunks = array(
        array(60 * 60 * 24 * 365 , 'year'),
        array(60 * 60 * 24 * 30 , 'month'),
        array(60 * 60 * 24 * 7, 'week'),
        array(60 * 60 * 24 , 'day'),
        array(60 * 60 , 'hour'),
        array(60 , 'minute'),
        array(1 , 'second')
    );

    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];
        if (($count = floor($since / $seconds)) != 0) {
            break;
        }
    }

    $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
    return $print;
  }
}
?>