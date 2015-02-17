<div class="<?php echo $avail_class ?>">
  <?php if($available){ ?>
    "<?php echo $username ?>" is (probably) available!
  <?php }else if($avail_class == 'avail-soon'){ ?>
    "<?php echo $username ?>" is available soon.
  <?php }else{ ?>
    "<?php echo $username ?>" is unavailable.
  <?php } ?>
  <div id="details">
    <?php if($exist){ //username exists ?>
      <br>
      <p>Username: <?php echo $username ?></p>
      <p>Last Game<?php if($used_revision_date) echo "(approx)" ?>: <?php echo $last_game_date ?></p>
      <p>It takes <?php echo max(6, $level) ?> months for cleanup</p>
      <p>Cleanup date (if inactive): <?php echo $avail_date ?></p>
      <?php if(!$available){ ?>
        <p>Days until name available: <?php echo $days_until_avail ?> day<?php if($days_until_avail!=1)echo "s" ?></p>
      <?php } ?>
      
    <?php }else{ //username does not exist ?>
      
    <?php } ?>
  </div>
</div>