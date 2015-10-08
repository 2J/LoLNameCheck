<?php $this->title = "Upcoming Region Selection" ?>
<div id="main">
  <h1 class="bigwords" style="font-weight:normal">LoL Namecheck: Upcoming Names</h1>
  <h3 class="smallwords" style="font-weight:normal">Select your region to view names that are expiring from <?php echo date('Y-m-d',strtotime(date('Y-m-d').'- 1 week')) . ' to ' . date('Y-m-d',strtotime(date('Y-m-d').'+ 2 week')) ?></h3>
</div>

<?php
foreach($regions as $model){?>
  <div class="upcoming_region_container">
  <a href="<?php echo Yii::app()->baseUrl."/upcoming/".$model['region_code']?>" class="no_under dark"> 
    <div class="upcoming_region">
      <?php echo strtoupper($model['region_code']) ?> 
    </div>
  </a>
  </div>
<?php } ?>

<div class="fb-like" style="position:fixed; right:5px; bottom:5px;" data-href="https://www.facebook.com/JHM.JJ" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>