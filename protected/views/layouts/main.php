<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<!-- Total name checks to date: <?php echo GenericFunctions::SearchCountAll(); ?> names -->
<head>
    <title>LoL Namecheck<?php if(!!$this->title) echo " - ".$this->title ?></title>
    <meta name="Description" content="League of Legends Summoner Name Availability Checker">
    <link rel="shortcut icon" href="/favicon.ico"> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    
    <meta property="og:site_name" content="LoL NameCheck" />
    <meta property="og:url" content="<?php echo Yii::app()->request->hostInfo . Yii::app()->request->baseUrl; ?>" />
    <meta property="og:title" content="League of Legends Name Checker" />
    <meta property="og:description" content="Get them OG League of Legends Summoner Names" />
    <meta property="og:image" content="<?php echo Yii::app()->request->hostInfo . Yii::app()->request->baseUrl; ?>/images/Nc.jpg" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css?1436763554" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
</head>

<body>
  <div id="global_wrap">
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=1038758249472123";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    window.onload=function(){setTimeout(function(){var e=document.querySelector("ins.adsbygoogle");e&&0==e.innerHTML.replace(/\s/g,"").length&&(e.style.cssText="display:block !important",e.innerHTML="Please disable adblock to support LoL Namecheck!")},2e3)};</script>
    
    <div id="navbar_wrap">
      <div id="navbar">
        <ul class="nav-left">
          <li class="navitem"><a href="<?php echo Yii::app()->request->baseUrl; ?>/" class="no_under dark">Home</a></li>
          <li class="navitem"><a href="<?php echo Yii::app()->request->baseUrl; ?>/upcoming" class="no_under dark">Upcoming</a></li>
          <li class="navitem"><a href="<?php echo Yii::app()->request->baseUrl; ?>/faq" class="no_under dark">FAQ</a></li>
        </ul>
        <ul class="nav-right">
          <li class="navitem"><a target="_blank" href="http://www.facebook.com/JHM.JJ" title="Facebook" class="no_under dark"><i class="fa fa-facebook"></i></a></li>
          <li class="navitem"><a target="_blank" href="http://twitter.com/koggiri" title="Twitter" class="no_under dark"><i class="fa fa-twitter"></i></a></li>
          <li class="navitem"><a target="_blank" href="http://imraising.tv/u/koggiri" title="Donate" class="no_under dark"><i class="fa fa-dollar"></i></a></li>
        </ul>
        <div class="clear"></div>
      </div>
    </div>

    <div class="clear"></div>
    <div id="content_wrap">
      <?php echo $content; ?>
    </div>
    
    <br><br><br>
  </div>
</body>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-49914538-1', 'auto');
  ga('send', 'pageview');

</script>
</html>
