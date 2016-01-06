<?php $this->title = strtoupper($region)." Upcoming Names"; ?>
<script>
$(function(){
  $('.update').click(function(){
    username= $(this).data('name');
    $(this).html('updating...');
    <?php echo CHtml::ajax(array(
      'url'=> array('main/check'),
      'data'=> "js:'username='+username+'&region_name=".$region."&g=a'",
      'type'=>'get',
      'dataType'=>'json',
      'success'=>"function(data)
      {
        console.log(data.name + ' : ' + data.avail_date);
        $(\"td.update[data-name='\" + data.name + \"']\").html('');
        $(\"td.update[data-name='\" + data.name + \"']\").prev('td').prev('td').html(data.avail_date);
        $(\"td.update[data-name='\" + data.name + \"']\").prev('td').html('NOW');
      } ",
    ))?>;
  });
});

var myApp = angular.module('myApp', []); //initialize myApp 

myApp.controller('NamesCtrl', ['$scope', function ($scope) { 

$scope.names = {}; 

// Assign the initial data! 
$scope.names = globalData.names; 

}]); 
</script>

<h1>
  <a href="<?php echo Yii::app()->baseUrl ?>">LoL Namecheck</a> - <?php echo strtoupper($region) ?> upcoming names <br>
  (<?php echo date('Y-m-d',strtotime(date('Y-m-d').'- 1 week')) . ' ~ ' . date('Y-m-d',strtotime(date('Y-m-d').'+ 2 week')) ?>)
</h1>

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- lolnamecheck_responsive -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-4614603456200884"
     data-ad-slot="7336896259"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

<div ng-app="myApp"> 
<div ng-controller="NamesCtrl">
<table>
<tr><th>Name</th><th>Free date</th><th class="hide_on_sm">Last Updated</th><th class="hide_on_sm"></th></tr>

  <tr ng-repeat="name in names" ng-class="$even? 'even':'odd'">
    <td class="logname">{{ name[0] | uppercase}}</td>
    <td>{{ name[1] }}</td>
    <td class="hide_on_sm">{{ name[2] }}</td>
    <td class="update hide_on_sm">UPDATE</td>
  </tr>

</table>

</div> 
</div> 

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- lolnamecheck_responsive -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-4614603456200884"
     data-ad-slot="7336896259"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
window.globalData = {}; 
globalData.names = <?php echo $upcoming_names?>;
</script>

<div class="fb-like" style="position:fixed; right:5px; bottom:5px;" data-href="https://www.facebook.com/JHM.JJ" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>