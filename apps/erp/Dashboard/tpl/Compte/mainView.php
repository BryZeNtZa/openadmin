<!DOCTYPE html>
<html lang="FR-fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title><?php  echo $APP_DEFAULTS['name']; ?></title>
		<link type="image/x-icon" rel="shortcut icon" href="www/img/logo-gadafic.png" />
		
		<!-- Libraries -->
		<link rel="stylesheet" href="www/css/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="www/vendors/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="www/vendors/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="www/css/animate.min.css">
		
		
		<link rel="stylesheet" href="www/css/themes/gadafic/theme.css" class="theme">
		<link rel="stylesheet" href="www/css/main.css" class="theme">
		<link rel="stylesheet" href="www/css/languages.css" class="theme">
		
		<link rel="stylesheet" href="www/css/dropdowns-effects.css">
		<link rel="stylesheet" href="www/css/chat.css">
		<link rel="stylesheet" href="www/vendors/tooltipster/css/tooltipster.bundle.min.css">
		
		<link rel="stylesheet" href="www/css/notifs.css">
		
	</head>
	
	<body style="background: url(www/img/pattern.png)">
		
		<?php $page->navBar->render(); ?>
		
		<nav id="gadafic-main-nav" class="gadafic-main-nav theme-gadafic navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation" gadafic-app="gadafic">
								
			<div class="container-fluid">
									
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- logo -->
					<a class="navbar-brand gadafic-logo" href="http://www.gadafic.edu">
						<img class="logo-img" alt="OpenAdmin" src="www/img/gadafic-logo-text.png" />
					</a>     
				</div>
									
				<div class="collapse navbar-collapse animated fadeIn" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
					<?php $page->navBar->getModules(); ?>
					
		<?php $content = ViewHelper::getPageContent() ; ?>
		
		<?php echo $content['nav']; ?>
		<?php echo $content['body']; ?>
		
		
	<div style="background-color: #222; opacity: 0.3; position: absolute; top: 50px; height: 93.5%; width: 100%"></div>
	
	<center style="position: absolute; top: 50px; height: 90%; width: 100%">
		<div style="height: 100px"></div>
		<img src="www/img/gadafic-logo-text.png" style="max-width: 90%" />
		<div style="height: 100px"></div>
		<span id="gadafic-slogan-slides"></span>
		<div id="gadafic-slogan-slides-text" style="display: none">
			<div class="slogan"><?php echo $COMMON_LANGUAGE['MSG_WELCOME_ON_GADAFIC']; ?></div>
			<div class="slogan"><span class="fa fa-quote-left"></span> <?php echo $COMMON_LANGUAGE['MSG_GADAFIC_SLOGAN']; ?> <span class="fa fa-quote-right"></span></div>
			<div class="slogan"><?php echo $COMMON_LANGUAGE['MSG_GADAFIC_SLOGAN2']; ?> </div>
		</div>
	</center>
	
	<!-- DIALOG BOX -->
	<div id="dialog-confirm" align=center></div>
	
	<!-- FOOTER -->
	
	<div id="gadafic-xdev-wg-footer" >
		<div class="col-md-5 gadafic-i18n-switch">
			<a href="#" class="a-i18n-switch"><?php echo $COMMON_LANGUAGE['LBL_TERMS']; ?></a> <span class="a-sep">|</span>
			<a href="#" class="a-i18n-switch"><?php echo $COMMON_LANGUAGE['LBL_PRIVACY']; ?></a> <span class="a-sep">|</span>
			<a href="#" class="a-i18n-switch language-switch-link" data-tooltip-content="#languages-links" ><?php echo $COMMON_LANGUAGE['LBL_LANGUAGE']; ?></a>
		</div>
		<div class="col-md-7 gadafic-copy" > <span>&copy; &nbsp; <?php echo $COMMON_LANGUAGE['LBL_COPYRIGHT']; ?>&nbsp;&nbsp;<a href="http://www.xdev-wg.com" target="_" ><?php echo $PROJECT_PARAMS['author']; ?></a>&nbsp;&nbsp;<?php echo $PROJECT_PARAMS['bottomdate']; ?></span></div>
	</div>

	<div class="tooltip_templates" style="display: none;">
		<div id="languages-links">
			<div class="col-md-0">
				<?php echo ViewHelper::getLanguageMenu($APP_DEFAULTS['language']); ?>
			</div>
		</div>
	</div>
	
	<!-- Page scripts -->
	<script src="www/vendors/jquery/jquery.min.js"></script>    
	<script src="www/vendors/jquery/ui/jquery-ui.min.js"></script>   
	<script src="www/vendors/bootstrap/js/bootstrap.js"></script>
	<script src="www/js/dropdowns-effects.js"></script>
	<script src="www/vendors/tooltipster/js/tooltipster.bundle.min.js"></script>
	<script src="www/vendors/typed/js/typed.min.js"></script>
	<script src="langues/{language}/common.js"></script>
	</body>
</html>