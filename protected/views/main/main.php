<?php $select=''; ?>
<script>
$(function(){
  $('#check_button').click(function(){
    $('#results').html('<span style="color:black">Calculating...</span>')
  
    username= $('#username').val();
    region_name= $('#region_name').val();
    
    <?php echo CHtml::ajax(array(
      'url'=> array('main/check'),
      'data'=> "js:'username='+username+'&region_name='+region_name",
      'type'=>'get',
      'dataType'=>'json',
      'success'=>"function(data)
      {
        $('#results').html(data.result);
        $('#ntoday').html(data.ntoday);
        $('#ntotal').html(data.ntotal);
        $('#ad').show();
      } ",
    ))?>;
  });
  
  $("#username").keyup(function(event){
      if(event.keyCode == 13){
          $("#check_button").click();
      }
  });
});
</script>

<div id="main">
  <h1 class="bigwords" style="font-weight:normal">LoL Namecheck</h1>
  <h3 class="smallwords" style="font-weight:normal">League of Legends name availability checker</h3>
  <div style="font-size:0;border:0;margin:0;padding:0;">LoL Namecheck is a League of Legends name checker that shows when a username is going to expire. Type in a name to see the availability of the summoner name and the expiry date if the name stays inactive. League of Legends Summoner Name Checker allows you to get the best League names. LoL Namecheck also has a feature to see upcoming usernames that will be free soon on each region for League. Check your dream League summoner name now and see when you will be able to get it.</div>
  <div id="namecheck_form">
    <span class="form_box">
      <input type="text" autocomplete="off" placeholder=" Summoner name..." name="username" id="username" autofocus><?php echo CHtml::dropDownList('region_name',$select,array('na'=>'NA','eune'=>'EUNE','euw'=>'EUW','br'=>'BR','lan'=>'LAN','las'=>'LAS','oce'=>'OCE', 'ru'=>'RU', 'tr'=>'TR')); ?>
    </span>
    <button type="button" id="check_button">Check</button>
  </div>
</div>

<div id="results">
</div>

<div id="ad" style="display:none">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- lolnamecheck_mobile -->
<ins class="adsbygoogle"
     style="display:inline-block;width:320px;height:100px"
     data-ad-client="ca-pub-4614603456200884"
     data-ad-slot="2767095850"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>

<div class="upcoming">
<a href="<?php echo Yii::app()->baseUrl."/upcoming" ?>" class="no_under">View Upcoming Names!</a>
</div>

<div class="tweets">
<a class="twitter-timeline" data-chrome="noheader nofooter transparent" data-dnt="true" href="https://twitter.com/LoLNamecheck" data-widget-id="570411283124846592">Tweets by @LoLNamecheck</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>

<div id="counter">
<div class="label">Past 24 Hours:</div><div id="ntoday"><?php echo GenericFunctions::SearchCountLast24(); ?></div>
<div class="label">Total:</div><div id="ntotal"><?php echo GenericFunctions::SearchCountAll(); ?></div>
</div>

<div class="fb-like" style="position:fixed; right:5px; bottom:5px;" data-href="https://www.facebook.com/JHM.JJ" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>