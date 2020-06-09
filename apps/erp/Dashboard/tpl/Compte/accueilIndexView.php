<div class="row" style="padding: 10px"> 


	<div class="row">
		
		<div class="col-md-10">
			<br />
			<div id="app-general-stats" class="row top_tiles">
				
				<div class="stat-number-holder animated bounceIn col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="tile-stats smooth_white">
						<div class="icon"><i class="fa  fa-users"></i></div>
						<div class="stat-number" data-start="1500" data-end="2000" data-duration="1500" data-delay="0"><span class="num">0</span> </div>
						<h3>Elèves</h3>
					</div>
				</div>
			  
				<div class="animated bounceIn col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="tile-stats smooth_white">
						<div class="icon"><i class="fa fa-male"></i></div>
						<div class="stat-number" data-start="0" data-end="25" data-duration="1500" data-delay="1500"><span class="num">0</span> &pound;</div>
						<h3>Enseignants</h3>
					</div>
				</div>
			  
				<div class="animated bounceIn col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="tile-stats smooth_white">
						<div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
						<div class="stat-number" data-start="0" data-end="40" data-duration="1500" data-delay="3000"><span class="num">0</span> </div>
						<h3>Classes</h3>
					</div>
				</div>
			  
				<div class="animated bounceIn col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="tile-stats smooth_white">
						<div class="icon"><i class="fa fa-calendar-o"></i></div>
						<div class="stat-number" data-start="0" data-end="300" data-duration="1500" data-delay="4500"><span class="num">0</span> &pound;</div>
						<h3>Absences</h3>
					</div>
				</div>
			  
			</div>
		</div>
		
		<div class="col-md-2">
			<div class="ui-widget ui-widget-content ui-corner-all smooth_white" style=" height: 350px; width: 220px; box-shadow: 4px 4px 4px #B7B6B6">

				<div class="x_content" style="text-align: center">
					<div class="flex">
						<ul class="list-inline widget_profile_box">
							<li><a href="#" id="compte-delete-image-btn"><i class="fa fa-close" style="margin-top: 4px;"></i></a></li>
							<li><img src="<?php echo ViewHelper::getUserImageSrc($_SESSION['GADAFICPROSECONDARY']['target'], $_SESSION['GADAFICPROSECONDARY']['id'], 2); ?>" alt="..." class="img-profil-user img-circle profile_img"></li>
							<li><a href="#" id="compte-edit-image-btn"><i class="fa fa-pencil" style="margin-top: 4px;"></i></a></li>
						</ul>
					</div>
					
					<br />
					<h3 class="name" style="text-align: center;"><?php echo Utils::strEncode($_SESSION['GADAFICPROSECONDARY']['nom']) . ' ' . Utils::strEncode($_SESSION['GADAFICPROSECONDARY']['prenom']) ; ?></h3>
					<span>(<?php echo AccueilDAO::getGroupeUtilisateurLibelle($_SESSION['GADAFICPROSECONDARY']['groupeutilisateur_id']); ?>)</span>
					<br />
					<div class="flex">
						<ul class="list-inline count2">
							
							<li>
								<h3>0</h3>
								<span>Disciplines</span>
							</li>
							
							<li>
							  <h3>0</h3>
							  <span>Élèves</span>
							</li>
						
							<li>
								<h3>0</h3>
								<span>Privilèges</span>
							</li>
						
						</ul>
					</div>
					
					<br />
					<p> <?php echo $MODULE_LANGUAGE['LBL_DATE_LAST_CONNEXION']; ?><br /><strong><?php echo str_replace(':', 'h', Utils::showDateHeuresMinsJMY($_SESSION['GADAFICPROSECONDARY']['derniereconnexion'])); ?></strong> </p>
					
				</div>
			</div>
		</div>
		
	</div>

</div>

<script type="text/javascript">
animateNumberStats("app-general-stats");


</script>