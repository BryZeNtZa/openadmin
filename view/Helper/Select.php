<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : General View Helper Class
 * Date : June 2018
 * Copyright XDEV WORKGROUP
 * */

namespace OpenAdmin\View;

Class ViewHelper {
	
	public static function getListOptionsConfig($key, $default){
		
		GLOBAL $USER_CHOICES;
		
		$list = $USER_CHOICES[$key];
		
		$options = '';
		foreach ($list as $cle => $valeur){
			$options .= ( $cle == $default ) 
						? '<option value="'.$cle.'" selected >'.$valeur.'</option>' 
						: '<option value="'.$cle.'" >'.$valeur.'</option>';
		}
		return $options;
	}
	
	public static function getArrayOptions($bdArray, $v, $f, $default){
		$options = '';
		foreach ($bdArray as $cle => $valeur){
			$options .= ( $valeur[$v] == $default ) 
						? '<option value="'.$valeur[$v].'" selected >'.$valeur[$f].'</option>' 
						: '<option value="'.$valeur[$v].'" >'.$valeur[$f].'</option>';
		}
		return $options;
	}
	
	public static function getListValueConfig($key, $value){
		GLOBAL $USER_CHOICES;		
		return $USER_CHOICES[$key][$value];
	}

	public static function getLanguageMenu($default){
		GLOBAL $LANGUES, $APP_DEFAULTS;
		
		if( !isset($default) ) 
			$default = $APP_DEFAULTS['language'];
		
		$menu = '<ul role="menu">';
		foreach ($LANGUES as $cle => $valeur){
			$menu .= ( $valeur['code'] == $default ) 
						? '<li class="lang-active" onclick="Login.setDefaultLanguage('.$cle.')"><span class="lang-sm lang-lbl" lang="'.$valeur['code'].'"></span></li>'
						: '<li onclick="Login.setDefaultLanguage('.$cle.')"><span class="lang-sm lang-lbl" lang="'.$valeur['code'].'"></span></li>';
		}
		
		$menu .= '</ul>';
		
		return $menu;
	}
	
	public static function getListOptions($table, $default=null, $optionsParams=null){

		$tableTable = new APP_TABLE($table['name']);
		
		$fields = '*';
		$where  = null;
		$order	= null;

		if( isset($table['fields']) ) $fields = $table['fields'];
		if( isset($table['where']) )  $where  = $table['where'];
		if( isset($table['order']) )  $order  = $table['order'];

		$optionsDatas = $tableTable->getResults($fields, $where, $order);

		$n = count($optionsDatas);
		
		$options = '';			
		for($i=0; $i<$n; $i++) {
			
			$optionsParamsString = '';
			if( $optionsParams ){
				for($j=0; $j<count($optionsParams); $j++){
					$optionsParamsString .= $optionsParams[$j].'="'.Utils::strEncode($optionsDatas[$i][$optionsParams[$j]]).'" ';
				}
			}
			
			$options .= ( $default != null && $optionsDatas[$i][$table['valuefield']] == $default ) 
						? '<option value="' . $optionsDatas[$i][$table['valuefield']] . '"' . $optionsParamsString . ' selected >' . $optionsDatas[$i][$table['textfield']] . '</option>'
						: '<option value="' . $optionsDatas[$i][$table['valuefield']] . '"' . $optionsParamsString . ' >' . $optionsDatas[$i][$table['textfield']] . '</option>';
		}
		
		return $options;
		
	}
	
	public static function getMultipleListOptions($table, $selected=null){

		$tableTable = new APP_TABLE($table["name"]);
		
		$fields = "*";
		$where  = null;
		$order	= null;

		if( !empty($table["fields"]) ) $fields  = $table["fields"];

		if( !empty($table["where"]) ) $where  	= $table["where"];

		if( !empty($table["order"]) ) $order	= $table["order"];

		$optionsDatas = $tableTable->getResults($fields, $where, $order);

		$n = count($optionsDatas);
		
		$options = "";			
		for($i=0; $i<$n; $i++) {
			$options .= ( $selected != null && in_array($optionsDatas[$i][$table["valuefield"]], $selected) ) 
						? "<option value='".$optionsDatas[$i][$table["valuefield"]]."' selected>".Utils::strEncode($optionsDatas[$i][$table["textfield"]])."</option>" 
						: "<option value='".$optionsDatas[$i][$table["valuefield"]]."' >".Utils::strEncode($optionsDatas[$i][$table["textfield"]])."</option>";
		}
		
		return $options;
		
	}
	
	public static function getListValue($table, $value){
		
		$tableTable = new APP_TABLE($table["name"]);
		
		$field  = $table["valuefield"];
		$where  = $table["checkfield"]."='".$value."'";

		if( !empty($table["where"]) )  $where  	.= " AND ".$table["where"];

		$rowDatas = $tableTable->getResults($field, $where, null);
		
		return ( !empty($rowDatas) ) ? $rowDatas[0][0] : "Undifined !";

	}
	
	public static function getPageContent(){
		
		GLOBAL $APP_PDO;
		GLOBAL $DISPLAY_MESSAGES;
		GLOBAL $MODULE_LANGUAGE;
		
		$onglets = "";
		$pages 	 = "";
		
		//Si le compte de l'utilisateur n'a pas été bloqué
		
		if( $_SESSION['GADAFICPROSECONDARY']['privileges'] != 'none' ) {
			
			//On recupère tous les modules accessibles par l'utilisateur et on les charge en session
			$privilegesTable = new APP_TABLE('privilege_brouillon');
			$where   	   = 'utilisateur_id="'.$_SESSION['GADAFICPROSECONDARY']['id'].'"';
			$modulesRows   = $privilegesTable->getResults('DISTINCT(module) AS module', $where);

			if( !empty($modulesRows) ){
				
				$userModulesList = "";
				$n = count($modulesRows);
				for($i=0; $i<$n; $i++) 
					$userModulesList .= ( $i != ($n-1) ) 
										? '"'.$modulesRows[$i]['module'].'",' 
										: '"'.$modulesRows[$i]['module'].'"';
				
				//On recupère tous les privilèges de l'utilisateur et on les charge en session
				$where   	   	= 'utilisateur_id="'.$_SESSION['GADAFICPROSECONDARY']['id'].'"';
				$privilegesRows = $privilegesTable->getResults('*', $where);
				
	
				//On construit les modules
				$modulesTable = new APP_TABLE('module');
				$where  = 'nom IN('.$userModulesList.') AND visible=1 AND parent="" AND langue_id="'.$_SESSION['GADAFICPROSECONDARY']['langue_id'].'"';
				$modules = $modulesTable->getResults('*', $where, 'ordreaffichage');

				if( !empty($modules) ){
					
				
				$mainNav = 
					'<nav id="gadafic-main-nav" class="gadafic-main-nav theme-gadafic navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation" gadafic-app="gadafic">
						
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
								<ul class="nav navbar-nav">';
							
								$n = count($modules);
								
								if($n <= 4) {
									for($i=0; $i<$n; $i++){
										$nom_module 	= $modules[$i]['nom'];
										$libelle_module = $modules[$i]['libelle'];
										$titre_module = $modules[$i]['titre'];
										$mainNav .= '<li class="gadafic-app-item gadafic-app-gadafic" gadafic-target-app="gadafic" pageref="'.$nom_module.'" title="'.Utils::strEncode($titre_module).'"><a href="#"><span class="'.$modules[$i]['classicon'].'"></span>'.Utils::strEncode($libelle_module).'</a></li>';
									}
									
									
								}
								else {
									for($i=0; $i<4; $i++){
										$nom_module 	= $modules[$i]['nom'];
										$libelle_module = $modules[$i]['libelle'];
										$titre_module = $modules[$i]['titre'];
										$mainNav .= '<li class="gadafic-app-item gadafic-app-gadafic" gadafic-target-app="gadafic" pageref="'.$nom_module.'" title="'.Utils::strEncode($titre_module).'"><a href="#"><span class="'.$modules[$i]['classicon'].'"></span>'.Utils::strEncode($libelle_module).'</a></li>';
									}
									$mainNav .= 
									'<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-ellipsis-v mg-rg-6"></span></a>
										<ul class="dropdown-menu" data-dropdown-in="flipInY" data-dropdown-out="flipOutY" style="width: 220px">';
										for($i=4; $i<$n; $i++){
											$nom_module 	= $modules[$i]['nom'];
											$libelle_module = $modules[$i]['libelle'];
											$titre_module = $modules[$i]['titre'];
											$mainNav .= '<li class="gadafic-app-item gadafic-app-gadafic" gadafic-target-app="gadafic" pageref="'.$nom_module.'" title="'.Utils::strEncode($titre_module).'"><a href="#"><span class="'.$modules[$i]['classicon'].'"></span>'.Utils::strEncode($libelle_module).'</a></li>';
										}
										$mainNav .= 
										'</ul>';
									$mainNav .= 
									'</li>';

								}
						
								$mainNav .= '</ul>';
					
					$mainNav .=
					'<ul class="nav navbar-nav navbar-right">
					
						<li role="presentation" class="dropdown open">
							
							<a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="true">
								<i class="fa fa-envelope-o"></i>
								<span class="badge bg-green">6</span>
							</a>
							
							<ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
								<li>
									<div class="col app-notif">
										<div class="col-md-2" >
											<img src="www/img/personnal.png" />
										</div>
										<div class="col-md-10" >
											<div style="font-weight: bold;">Retard Paiement</div>
											<div style="font-weight: normal;">45 Adhérants attendus en fin du mois.</div>
											<div style="font-weight: normal; font-size: 9px; text-align: right">08/06/2018 11:04</div>
										</div>
									</div>
								</li>
								
								<li>
									<div class="col app-notif">
										<div class="col-md-2" >
											<img src="www/img/personnal.png" />
										</div>
										<div class="col-md-10" >
											<div style="font-weight: bold;">Retard Paiement</div>
											<div style="font-weight: normal;">45 Adhérants attendus en fin du mois.</div>
											<div style="font-weight: normal; font-size: 9px; text-align: right">08/06/2018 11:04</div>
										</div>
									</div>
								</li>
								
								<li>
									<div class="col app-notif">
										<div class="col-md-2" >
											<img src="www/img/personnal.png" />
										</div>
										<div class="col-md-10" >
											<div style="font-weight: bold;">Retard Paiement</div>
											<div style="font-weight: normal;">45 Adhérants attendus en fin du mois.</div>
											<div style="font-weight: normal; font-size: 9px; text-align: right">08/06/2018 11:04</div>
										</div>
									</div>
								</li>
								
								<li>
									<div class="col app-notif">
										<div class="col-md-2" >
											<img src="www/img/personnal.png" />
										</div>
										<div class="col-md-10" >
											<div style="font-weight: bold;">Retard Paiement</div>
											<div style="font-weight: normal;">45 Adhérants attendus en fin du mois.</div>
											<div style="font-weight: normal; font-size: 9px; text-align: right">08/06/2018 11:04</div>
										</div>
									</div>
								</li>
								
								<li>
								  <div class="text-center">
									<a>
									  <strong>See All Alerts</strong>
									  <i class="fa fa-angle-right"></i>
									</a>
								  </div>
								</li>
								
							</ul>
							
						</li>
						
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-search mg-rg-6"></span></a>
							<ul class="dropdown-menu" data-dropdown-in="flipInY" data-dropdown-out="flipOutY" style="width: 500px" onclick="return false;">
								<li>
									<div class="row">
										
										<div class="col-md-12">
										
											<!-- Login -->
											<div class="social-buttons">
												<div class="iconSpecial"><i class="glyphicon glyphicon-user mg-rg-6"></i>Recherche Générale</div>
											</div>
											
											<div class="divider-fine"></div>
											<br />
											<div>
												<input type="text" style="width: 100%" />
											</div>
											
											
											<br />
												
										</div>
										
									</div>
									
								</li>
							</ul>
						</li>
							
						<li class="dropdown">
							
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><b> Login</b> <span class="caret"></span></a>
						
							<ul id="login-dp" class="dropdown-menu" data-dropdown-in="flipInX" data-dropdown-out="flipOutX" >
								<li>
									<div class="row">
										
										<div class="col-md-12">
										
											<!-- Login -->
											<div class="social-buttons">
												<div class="iconSpecial"><i class="glyphicon glyphicon-user mg-rg-6"></i>Login</div>
											</div>
											
											<div class="divider-fine"></div>
											
											<br />
											<br />
											
											<form name="login-form" class="login-form" action="" method="post">
											
												<div class="content">	
												
													<div style="margin-bottom: 25px" class="input-group">
														<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
														<input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username">                                        
													</div>
												
													<div style="margin-bottom: 25px" class="input-group">
														<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
														<input id="login-password" type="password" class="form-control" name="password" placeholder="Password">
													</div>
													<a href="#" style="float: right; font-size: 85%">Mot de passe oublie ?</a>
												
												</div>

												<div class="footer">
													<button href="#" class="button"><span class="fa fa-unlock mg-rg-6"></span><b>Login</b></button>
												</div>
											
											</form>
												
										</div>
										
									</div>
									
								</li>
							</ul>
							
						</li>
						
					</ul>								
					</div>							
					</div>								
					</nav>';								
						
					
					$body = 
					'<div class="ui-widget">
						<div class="ui-state-error ui-corner-all" style="text-align: center; color: darkred; font-size: 14px; margin-top: 50px">
							<img src="www/img/red-lock.png" />
							<br />
							<strong style="font-size: 22px">'.$DISPLAY_MESSAGES['ACCESS_DENIED'].' </strong>
							<br />'.
							$DISPLAY_MESSAGES['USER_NO_MODULE_ACCESS'].
							'<br />
							<br />
						</div>
						<center>
							<br />
							<br />
							<img src="www/img/gadafic-logo-text.png" style="margin-top: 50px" />
						</center>						
					</div>';
				}
				else{
					$body = 
					'<div class="ui-widget">
						<div class="ui-state-error ui-corner-all" style="text-align: center; color: darkred; font-size: 14px; margin-top: 50px">
							<img src="www/img/red-lock.png" />
							<br />
							<strong style="font-size: 22px">'.$DISPLAY_MESSAGES['ERROR_OCCURED'].' </strong>
							<br />'.
							$DISPLAY_MESSAGES['USER_MODULE_RETRIEVE_ERROR'].
							'<br />
							<br />
						</div>
						<center>
							<br />
							<br />
							<img src="www/img/gadafic-logo-text.png" style="margin-top: 50px" />
						</center>						
					</div>';						
				
				}
			
			}
			else{
				$body = 
				'<div class="ui-widget">
					<div class="ui-state-error ui-corner-all" style="text-align: center; color: darkred; font-size: 14px; margin-top: 50px">
						<img src="www/img/red-lock.png" />
						<br />
						<strong style="font-size: 22px">'.$DISPLAY_MESSAGES['ACCESS_DENIED'].' </strong>
						<br />'.
						$DISPLAY_MESSAGES['USER_NO_MODULE_ACCESS'].
						'<br />
						<br />
					</div>
					<center>
						<br />
						<br />
						<img src="www/img/gadafic-logo-text.png" style="margin-top: 50px" />
					</center>						
				</div>';
			}
			
		}
		else{
			$body = 
			'<div class="ui-widget">
				<div class="ui-state-error ui-corner-all" style="text-align: center; color: darkred; font-size: 14px; margin-top: 50px">
					<img src="www/img/red-lock.png" />
					<br />
					<strong style="font-size: 22px">'.$DISPLAY_MESSAGES['ACCESS_DENIED'].' </strong>
					<br />'.
					$DISPLAY_MESSAGES['USER_NO_MODULE_ACCESS'].
					'<br />
					<br />
				</div>
				<center>
					<br />
					<br />
					<img src="www/img/gadafic-logo-text.png" style="margin-top: 50px" />
				</center>						
			</div>';
		}
		
		//$onglets .= '<button class="theme-d disconnect-btn" id="deconnexion" onclick="disconnectDialog()" ><span class="ui-icon ui-icon-power"></span>&nbsp;'.$DISPLAY_MESSAGES['LOGOUT'].'</button>';
		
		return array('nav' => $mainNav, 'body' => $body);
	}


	public static function getModule($nomModule){
		
		$modulesTable = new APP_TABLE('module');
		$where  = 'nom = "'.$nomModule.'" AND langue_id="'.$_SESSION['GADAFICPROSECONDARY']['langue_id'].'"';
		$module = $modulesTable->getResults('*', $where, 'ordreaffichage');
		
		if( !empty($module) ){
			
			return $module[0];
		
		}
		else{
			return array(
							"id" 			=> "0", 
							"codelangue" 	=> "", 
							"nom" 			=> "", 
							"libelle" 		=> "Undifined module", 
							"titre" 		=> "Undifined module", 
							"description" 	=> "Undifined module", 
						);
		}

	}

	public static function getModuleActions($nomModule, $resultType='assoc'){
		
		$actionsTable = new APP_TABLE('action');
		
		$where   = 'module = "'.$nomModule.'" AND langue_id="'.$_SESSION['GADAFICPROSECONDARY']['langue_id'].'"';
		$actions = $actionsTable->getResults('*', $where, 'ordreaffichage');
		
		if( $resultType && $resultType == 'index' ) return $actions;
		
		$userActions = array();
		
		if( !empty($actions) ){
			
			$n = count($actions);
			
			for($i=0; $i<$n; $i++) $userActions[$actions[$i]['nom']] = $actions[$i];
		
		}
		else{
			$userActions = null;
		}

		return $userActions;
	}		

	public static function getUserPrivilegesInModule($nomModule, $userID=null){
		
		$privilegesTable = new APP_TABLE('privilege');
		
		if( $userID == null )  $userID = $_SESSION['GADAFICPROSECONDARY']['id'];
		
		$where   	= 'module = "'.$nomModule.'" AND utilisateur_id = "'.$userID.'"';
		$privileges = $privilegesTable->getResults('action', $where);
		
		$userPrivileges = array();
		
		if( !empty($privileges) ){
			
			$n = count($privileges);
			
			for($i=0; $i<$n; $i++) $userPrivileges[] = $privileges[$i]['action'];
		
		}
		else{
			$userPrivileges = null;
		}

		return $userPrivileges;
	}
	
	public static function userHasPrivilege($action){
		
		GLOBAL $UserPrivivileges;
		
		if( !empty( $UserPrivivileges ) ){
			return in_array($action, $UserPrivivileges);
		}
		else{
			return false;
		}
		
	}
	
	public static function getAPPModules(){			
		
		$modulesTable = new APP_TABLE('module');
		$where  = 'visible=1 AND parent="" AND langue_id="'.$_SESSION['GADAFICPROSECONDARY']['langue_id'].'"';
		return $modulesTable->getResults('*', $where, 'ordreaffichage');
		
	}
	
	public static function getUserAllPrivileges($userID){			
		
		$privilegesTable = new APP_TABLE('privilege');
		$where  = 'utilisateur_id="'.$userID.'"';
		return $privilegesTable->getResults('*', $where);
		
	}	
	
	public static function findPrivilege($module, $action, $privileges){			
		
		if( empty($privileges) ) return false;
		
		$n = count($privileges);
		
		for($i=0; $i<$n; $i++) 
			if( $privileges[$i]["module"] == $module && $privileges[$i]["action"] == $action ) 
				return true;
			
		return false;
		
	}
	
	public static function getStats($param=null){
		
		$statTable = new APP_TABLE('stat');
		$statsRows  = $statTable->getResults('*');
		$n = count($statsRows);
		
		$stats = array();
		$param_value = 0;
		for($i=0;$i<$n;$i++){
			if( isset($param) ) {
				if($statsRows[$i]['parametre'] == $param) $param_value = $statsRows[$i]['valeur'];
			}
			else {
				$stats[$statsRows[$i]['parametre']] = $statsRows[$i]['valeur'];
			}
		}
		
		return ( isset($param )) ? $param_value : $stats;
	}
	
	public static function incrementStat($param) {
		return (new APP_TABLE('stat'))->updateRows( array('valeur'=>'valeur+1'), 'parametre="' . $param . '"', array('valeur') );
	}

	public static function decrementStat($param) {
		return (new APP_TABLE('stat'))->updateRows( array('valeur'=>'valeur-1'), 'parametre="' . $param . '"', array('valeur') );
	}
	
	public static function setStat($param, $value) {
		return (new APP_TABLE('stat'))->updateRows( array('valeur'=>$value), 'parametre="' . $param . '"');
	}
	
	public static function getUserImageSrc($target, $id, $thumb) {
		
		$userRecord = (new APP_TABLE($target))->getResults('*', 'id="'.$id.'"', null, 1);

		if( !empty($userRecord) ){
			
			$imageID = $userRecord[0]['imageID'];
			
			if($imageID != 0) {
				$imageRecord = (new APP_TABLE('image'))->getResults('*', 'id="'.$imageID.'"', null, 1);
				
				if(!empty($imageRecord)) {
					return 'ressources/photos/'.Utils::parseFolderTarget($target).'/'.Utils::parseImgPrefixTarget($target).$id.'IMG'.$imageRecord[0]['id'].'THB'.$thumb.'XD.jpg';
				}
			}
			
		}
		
		if($target == 'entreprise') return 'www/img/olympia-logo.png';
		if($target == 'produit') return 'www/img/produit.png';
		return 'www/img/user.png';

	}
	
	public static function getLangueIDStr($id) {
		GLOBAL $LANGUES;
		return $LANGUES[$id]['code'];
	}
	
	public static function getEntenteEtablissement() {
		
		GLOBAL $ENTERPRISE_PARAMS;
		
		$entrepriseTable = new APP_TABLE('entreprise');
		$entreprise = $entrepriseTable->getResults('*', '', null, 1)[0];
		$logo = self::getUserImageSrc('entreprise', $entreprise['id'], 2);
 
		$slogan  = ( trim($entreprise['slogan']) != '' ) ? '<div style="font-family: arial; font-size: 12px; font-style: italic; text-align: center;">' . $entreprise['slogan'] . '</div>' : '';
		
		$tel = '<div style="font-size: 12px; font-style: italic; font-weight: bold;">TEL:&nbsp;&nbsp;' . $entreprise['tel1'];
		if( trim($entreprise['tel2']) != '' ) $tel .= '/'.$entreprise['tel2'];
		if( trim($entreprise['tel3']) != '' ) $tel .= '/'.$entreprise['tel3'];
		
		$adresse = ( trim($entreprise['adresse']) != '' ) ? '<div style="font-size: 12px; font-style: italic;"> <strong>Adresse:</strong>&nbsp;&nbsp;' . $entreprise['ville'] . ', ' . $entreprise['adresse'] . '</div>' : '';

		$numcontrib = ( trim($entreprise['numcontrib']) != '' ) ? '<div style="font-size: 12px; font-style: italic;"> <strong>N-Contrib:</strong>&nbsp;&nbsp; ' . $entreprise['numcontrib'] . '</div>' : '';
		$siteweb = ( trim($entreprise['siteweb']) != '' ) ? '<div style="font-size: 12px; font-style: italic;"><strong>Site Web:</strong>&nbsp;&nbsp;' . $entreprise['siteweb'] . '</div>' : '';
		
		$entete  = 
		'<table style="width: 100%; margin-top: 5px; border: 1px solid #DDD; border-radius: 4px; box-shadow: 2px 2px 2px #F8F8F8" cellpadding=5 >' . 
			'<tr>' . 
				'<td width="20%" align="left" valign="top">' . 
					'<img src="' . $logo . '"  style="height: 80px;" >' . 
				'</td>' . 
				'<td width="50%" align="center" valign="middle">' . 
					'<div style="font-size: 16px; font-weight: bold">' . $entreprise['nom'] . '</div>' . 
					$slogan .
					$tel .
				'</td>' . 
				'<td width="30%" align="right" valign="top">' . 
					$adresse . 
					$numcontrib . 
					$siteweb . 
				'</td>' . 
			'</tr>' . 
		'</table>';
		
		$ENTERPRISE_PARAMS['agence_name'] = $entreprise['ville'];
		
		return $entete;
	}
	
}
	