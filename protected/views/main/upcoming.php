<script>
$(function(){
  $('.update').click(function(){
    username= $(this).data('name');
    region_name= 'na';//$('#region_name').val();
    $(this).html('updating...');
    <?php echo CHtml::ajax(array(
      'url'=> array('main/check'),
      'data'=> "js:'username='+username+'&region_name=na&g=a'",
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
</script>

<style>
a{text-decoration:none;}
a:link {color:#000000;}
a:visited {color:#000000;}
a:active {color:#000000;}
a:hover {color:#FF3333;}

tr.odd{
background-color: #a4a4a4;
}
tr.even{
}
.update{
cursor:pointer
}
td{
width:200px;
}
td.logname{
font-family: Consolas,monaco,monospace; 
}
th{
text-align:left;
}
</style>
<h1><a href="<?php echo Yii::app()->baseUrl ?>">LoL Namecheck</a> - <?php echo strtoupper($region) ?> upcoming names <br>(<?php echo date('Y-m-d',strtotime(date('Y-m-d').'- 1 week')) . ' - ' . date('Y-m-d',strtotime(date('Y-m-d').'+ 1 week')) ?>)</h1>

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

<table>
<tr><th>Name</th><th>Free date</th><th>Last Updated</th><th></th></tr>
<?php
$odd = true;
foreach($upcoming_names as $item){?>
  <tr class="<?php echo $odd? 'odd':'even'; $odd=!$odd; ?>"><td class="logname"><?php echo strtoupper($item['name']) ?></td><td><?php echo substr($item['free_date'],0,10) ?></td><td><span title="<?php echo $item['timestamp'] ?>"><?php echo GenericFunctions::TimeSince($item['secondsago']) ?> ago</span</td><td class="update" data-name="<?php echo $item['name'] ?>">UPDATE</td></tr><?php } ?>
</table>

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