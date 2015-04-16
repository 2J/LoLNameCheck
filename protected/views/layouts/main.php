<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<!-- Total name checks to date: <?php echo GenericFunctions::SearchCountAll(); ?> names -->
<head>
    <title>LoL Namecheck</title>
    <meta name="Description" content="League of Legends Summoner Name Availability Checker">
    <link rel="shortcut icon" href="favicon.ico"> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    
    <meta property="og:site_name" content="LoL NameCheck" />
    <meta property="og:url" content="<?php echo Yii::app()->request->hostInfo . Yii::app()->request->baseUrl; ?>" />
    <meta property="og:title" content="League of Legends Name Checker" />
    <meta property="og:description" content="Get them OG League of Legends Summoner Names" />
    <meta property="og:image" content="<?php echo Yii::app()->request->hostInfo . Yii::app()->request->baseUrl; ?>/images/Nc.jpg" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
</head>

<body bgcolor="#cdcdcd">
  <?php echo $content; ?>
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
