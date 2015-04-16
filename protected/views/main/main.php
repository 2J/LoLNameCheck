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
  <div id="namecheck_form">
    Username:<input type="text" placeholder=" Summoner name..." name="username" id="username" autofocus>
    <?php echo CHtml::dropDownList('region_name',$select,array('na'=>'NA','eune'=>'EUNE','euw'=>'EUW','br'=>'BR','lan'=>'LAN','las'=>'LAS','oce'=>'OCE')); ?>
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
<a href="<?php echo Yii::app()->baseUrl."/upcoming" ?>" class="no_under">BETA: View Upcoming Names!</a>
</div>

<div id="counter">
<div class="label">Past 24 Hours:</div><div id="ntoday"><?php echo GenericFunctions::SearchCountLast24(); ?></div>
<div class="label">Total:</div><div id="ntotal"><?php echo GenericFunctions::SearchCountAll(); ?></div>
</div>

<div class="tweets">
<a class="twitter-timeline" data-dnt="true" href="https://twitter.com/LoLNameCheck" data-widget-id="570411283124846592">Tweets by @LoLNameCheck</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>

<div class="contact">
<?php //  <a href="http://blog.j2.io/lol-namecheck-league-of-legends-username-availability-checker/" class="no_under">About</a><br> ?>
  <p>Hyunmok "Plant" Jeong </p><?php //<a class="no_under" href="http://j2.io">J².io</a><br> ?>
  <a class="no_under" href="mailto:jj@j2.io">jj@j2.io</a>
</div>