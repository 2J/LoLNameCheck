<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/css/bootstrap-theme.min.css" />
  <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
	<title>Budget.</title>
  <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
</head>

<body>
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo Yii::app()->request->baseUrl; ?>">Project name</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li <?php if($this->action->id == "main") echo 'class="active"'; ?> ><a href="<?php echo Yii::app()->request->baseUrl; ?>">Home</a></li>
            <li <?php if($this->action->id == "change") echo 'class="active"'; ?> ><a href="<?php echo Yii::app()->request->baseUrl; ?>/add">Add</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

      <div class="starter-template">
        <?php echo $content; ?>
      </div>

    </div><!-- /.container -->
    
   

	<div class="clear"></div>

	<div class="contact">
		Made by <a href="mailto:jj@j2.io">Hyunmok</a>.
	</div><!-- footer -->
  
</body>
</html>
