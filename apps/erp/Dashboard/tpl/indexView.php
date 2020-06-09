<link rel="stylesheet" href="www/css/stats.css">

<div class="mp_header_bar" style="text-align:left;margin-top: -2px">
	<img src="www/img/white_arrow_right.png" style="float:left;margin-left:10px;height:20px;margin-top:2px" />
	<span style="margin-left:20px"><?php echo $DISPLAY_MESSAGES['WELCOME_MSG']; ?> <?php echo Utils::strEncode($_SESSION['GADAFICPROSECONDARY']['nom']); ?> !</span>
</div>
<div id="afp-page-content-<?php echo $module; ?>" style="background:#fff;min-height:300px;overflow:hidden">

	
	<div id="afp-page-content-<?php echo $module; ?>-holder" style='margin-top:-2px;'>

		<div class="row" >
			<div id="menuframe_td" class="col-md-2 app-menu-left">
				<div class="theme-d" style="padding:10px;text-align:left; color: #DDD; text-shadow: none;"> <img src="www/img/options.png" width=20 /> &nbsp;&nbsp; <?php echo $DISPLAY_MESSAGES['USER_MENU']; ?></div>
				<div id="menuframe" style="font-size:12px;padding-left:5px;">
					<br />
					<ul class="modulestat">
						<?php if( ViewHelper::userHasPrivilege('dashboard') ){ ?><li class="menu_item mp_header_bar" module="accueil" controller="accueilIndex" title="<?php echo Utils::strEncode($ModuleActions['dashboard']['description']); ?>" ><img src="www/img/home.png" style="height:24px;width:24px"/>&nbsp;<span style="display:inline-block;margin-top:-25px;font-size:12px"><?php echo Utils::strEncode($ModuleActions['dashboard']['titre']); ?></span></li><?php } ?>
						<?php if( ViewHelper::userHasPrivilege('compte') ){ ?><li class="menu_item mp_header_bar" module="accueil" controller="compteIndex" title="<?php echo Utils::strEncode($ModuleActions['compte']['description']); ?>"><img src="www/img/user_friend.png" style="height:24px;width:24px"/>&nbsp;<span style="display:inline-block;margin-top:-25px;font-size:12px"><?php echo Utils::strEncode($ModuleActions['compte']['titre']); ?></span></li><?php } ?>
					</ul>			
				</div>
			</div>
			<div class="col-md-10" style="padding-left: 0; border-left: 1px solid #fff;">
				<div id="chartsframe" class="smooth_white"></div>
			</div>
		</div>	
	
	</div>
	
	<br />
	<br />
	<br />

</div>

<script type="text/javascript">
$(document).ready(	
	function(){
		
		$("#menuframe").css({height:(screen.height-320)+'px'});
		$("#chartsframe").css({height:(screen.height-280)+'px'});
			
		$("ul.modulestat li").click(function(event){
			$("ul.modulestat li").removeClass("module_actif");
			$(this).addClass("module_actif");
			loadRightMenu($(this));
		});
		
		$("ul.modulestat li:first").click();
	}
);
</script>