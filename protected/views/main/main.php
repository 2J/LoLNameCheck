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
    <?php echo CHtml::dropDownList('region_name',$select,array('na'=>'NA','eunw'=>'EUNE','euw'=>'EUW','br'=>'BR','lan'=>'LAN','las'=>'LAS','oce'=>'OCE')); ?>
    <button type="button" id="check_button">Check</button>
  </div>
</div>
<div id="results">
</div>
<div class="contact">
<?php //  <a href="http://blog.j2.io/lol-namecheck-league-of-legends-username-availability-checker/" class="no_under">About</a><br> ?>
  <p>Hyunmok "Plant" Jeong </p><?php //<a class="no_under" href="http://j2.io">J².io</a><br> ?>
  <a class="no_under" href="mailto:jj@j2.io">jj@j2.io</a>
</div>
