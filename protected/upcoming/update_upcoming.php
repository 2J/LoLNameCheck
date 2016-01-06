<?php 
set_time_limit(0);

$region_codes = ['ru','oce','las','euw','eune','br','tr','lan','na'];
foreach($region_codes as $region_code){
  
$servername = "REDACTED";
$username = "REDACTED";
$password = "REDACTED";
$dbname = "REDACTED";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = 
'SELECT *,unix_timestamp(now()) - unix_timestamp(timestamp) secondsago FROM
  (SELECT * FROM 
    (SELECT name,free_date,timestamp FROM log log2
    WHERE `server`=\''.$region_code.'\'
    ORDER BY `timestamp` DESC) log1
  GROUP BY `name` 
  ORDER BY `free_date` DESC) log3 
WHERE `free_date` <= \''.date('Y-m-d',strtotime(date('Y-m-d').'+ 2 week')).'\'
AND `free_date` >= \''.date('Y-m-d',strtotime(date('Y-m-d').'- 1 week')).'\'';

$conn->set_charset("utf8");
$result = $conn->query($sql);

$names=[];

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $names[] = $row;
    }
    
    file_put_contents (realpath(dirname(__FILE__))."/".$region_code."/upcoming_".time().".txt",json_encode($names) );
} else {
    //echo "0 results";
}
$conn->close();
 

//delete all files except 2
if ($handle = opendir(realpath(dirname(__FILE__))."/".$region_code)) 
{
    $files = array();
    while (false !== ($file = readdir($handle))) 
    {
        if (!is_dir($file))
        {
            // You'll want to check the return value here rather than just blindly adding to the array
            $files[realpath(dirname(__FILE__))."/".$region_code."/".$file] = filemtime(realpath(dirname(__FILE__))."/".$region_code."/".$file);
        }
    }
    // Now sort by timestamp (just an integer) from oldest to newest
    asort($files, SORT_NUMERIC);

    // Loop over all but the 5 newest files and delete them
    // Only need the array keys (filenames) since we don't care about timestamps now as the array will be in order
    $files = array_keys($files);
    for ($i = 0; $i < (count($files) - 2); $i++) //change -2 to change # files
    {
        // You'll probably want to check the return value of this too
        unlink($files[$i]);
    }
} 
}
?>