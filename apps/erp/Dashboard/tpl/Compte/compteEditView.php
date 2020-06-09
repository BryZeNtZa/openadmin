<div style="padding:8px;">
	<center>
		<div id="errorMsgLevel0" class="error-box" ></div>
		<div id="waitMsgLevel0" class="wait-box" ></div>
	</center>
</div>
<div id="detailsCompteViewContent" >
	
	<form id="editview-compte-form">
	
		<div id="editview-compte-tabs">
			
			<ul>
				<li><a href="#editview-compte-infos-generales"><?php echo $MODULE_LANGUAGE['LBL_INFOS_GENERALES']; ?></a></li>
				<li><a href="#editview-compte-adresses"><?php echo $MODULE_LANGUAGE['LBL_ADRESSES']; ?></a></li>
				<li><a href="#editview-compte-disciplines"><?php echo $MODULE_LANGUAGE['LBL_DISCIPLINES']; ?></a></li>
				<li><a href="#editview-compte-parametres-connexion"><?php echo $MODULE_LANGUAGE['LBL_PARAMETRES_CONNEXION']; ?></a></li>
				<li><a href="#editview-compte-infos-compl"><?php echo $MODULE_LANGUAGE['LBL_INFORMATIONS_COMPLEMENTAIRES']; ?></a></li>
			</ul>
			
			<div id="editview-compte-infos-generales" >
				<table border=0 width="85%" align="center" class="table-td-6" >

					<tr>
						<td class="droite" width=20%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_MATRICULE']; ?></label></td>
						<td class="gauche" width=40% ><input type="text" name="code" class="inset-shadow-grey ui-corner-all" value="<?php echo $utilisateurDatas['code']['valeur']; ?>" readonly /> &nbsp;<strong><font color="red">(AUTO)</font></strong></td>
						<td class="droite" width=20%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_CIVILITE']; ?></label></td>
						<td class="gauche" width=40%><select name="civilite" class="inset-shadow-grey ui-corner-all"><?php echo ViewHelper::getListOptionsConfig('CIVILITE_LONG', $utilisateurDatas['civilite']['valeur']); ?></select></td>
					</tr>
					
					<tr>
						<td class="droite" width=20%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_NOM']; ?></label></td>
						<td class="gauche" width=40%><input type="text" name="nom" class="inset-shadow-grey ui-corner-all" value="<?php echo $utilisateurDatas['nom']['valeur']; ?>" /></td>
						<td class="droite" width=20%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_SEXE']; ?></label></td>
						<td class="gauche" width=40%><select name="sexe" class="inset-shadow-grey ui-corner-all"><?php echo ViewHelper::getListOptionsConfig('SEXE', $utilisateurDatas['sexe']['valeur']); ?></select></td>
					</tr>
					
					<tr>
						<td class="droite" width=20%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_PRENOM']; ?></label></td>
						<td class="gauche" width=40%><input type="text" name="prenom" class="inset-shadow-grey ui-corner-all" value="<?php echo $utilisateurDatas['prenom']['valeur']; ?>" /></td>
						<td class="droite" width=20%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_AGE']; ?></label></td>
						<td class="gauche" width=40%><input type="text" name="age" class="inset-shadow-grey ui-corner-all" value="<?php echo $utilisateurDatas['age']['valeur']; ?>" onkeypress="return keyPressHandler(event);" /></td>
					</tr>

					<tr>
						<td class="droite" width=20%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_DATE_ENGAGEMENT']; ?></td>
						<td class="gauche" width=40%><input type="text" id="date_engagt" name="date_engagt" class="inset-shadow-grey ui-corner-all" value="<?php echo Utils::showDateHeuresMinsJMY($utilisateurDatas['date_engagt']['valeur']); ?>" onkeypress="return keyPressHandler2(event);" /></td>
						<td class="droite" width=20%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_TAILLE']; ?></label></td>
						<td class="gauche" width=40%><input type="text" name="taille" class="inset-shadow-grey ui-corner-all" value="<?php echo $utilisateurDatas['taille']['valeur']; ?>" onkeypress="return keyPressHandler2(event);" /></td>
					</tr>
					
					<tr>
						<td class="droite" width=20%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_DATE_ENREGISTREMENT']; ?></td>
						<td class="gauche" width=40%><input type="text" class="inset-shadow-grey ui-corner-all" value="<?php echo Utils::showDateHeuresMinsJMY($utilisateurDatas['date_enreg']['valeur']); ?>" disabled /></td>
						<td class="droite" width=20%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_POIDS']; ?></label></td>
						<td class="gauche" width=40%><input type="text" name="poids" class="inset-shadow-grey ui-corner-all" value="<?php echo $utilisateurDatas['poids']['valeur']; ?>" /></td>
					</tr>
					
				</table>
				
			</div>
			
			<div id="editview-compte-adresses" >
				
				<table cellspacing=10 cellpadding=10 border=0 width="85%" align="center" >

					<tr>
						<td class="droite" width=20%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_TEL1']; ?></label></td>
						<td class="gauche" width=30%><input type="text" name="tel1" class="inset-shadow-grey ui-corner-all" value="<?php echo $utilisateurDatas['tel1']['valeur']; ?>" onkeypress="return keyPressHandler(event);" /></td>
						<td class="gauche" width=50%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_ADRESSE']; ?></label></td>
					</tr>
					
					<tr>
						<td class="droite" width=20%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_TEL2']; ?></label></td>
						<td class="gauche" width=30%><input type="text" name="tel2" class="inset-shadow-grey ui-corner-all" value="<?php echo $utilisateurDatas['tel2']['valeur']; ?>" onkeypress="return keyPressHandler(event);" /></td>
						<td class="gauche" width=50% rowspan=2><textarea name="adresse" class="inset-shadow-grey ui-corner-all" style="width: 90%; height: 80px"><?php echo $utilisateurDatas['adresse']['valeur']; ?></textarea></td>
					</tr>

					<tr>
						<td class="droite" width=20%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_EMAIL']; ?></label></td>
						<td class="gauche" width=30%><input type="text" name="email" class="inset-shadow-grey ui-corner-all" value="<?php echo $utilisateurDatas['email']['valeur']; ?>" /></td>
					</tr>
					
				</table>
				
			</div>
			
			<div id="editview-compte-disciplines" >
			
			</div>
			
			<div id="editview-compte-parametres-connexion" >
				<table cellspacing=10 cellpadding=10 border=0 width="50%" align="center" >

					<tr>
						<td align="left">
							<button id="edit-login-pwd-btn" style="padding: 10px; width: 250px"><?php echo $MODULE_LANGUAGE['BTN_EDIT_PARAMETRES_CONNEXION']; ?></button>
						</td>
					</tr>
					
				</table>
				
			</div>
			
			<div id="editview-compte-infos-compl" >
				<table cellspacing=10 cellpadding=10 border=0 width="85%" align="center" >
					<tr>
						<td class="gauche"><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_INFORMATIONS_COMPLEMENTAIRES']; ?></label></td>
					</tr>
					<tr>
						<td class="gauche"><textarea name="infos_comp" class="inset-shadow-grey ui-corner-all" style="width: 80%; height: 80px" ><?php echo $utilisateurDatas['infos_comp']['valeur']; ?></textarea></td>
					</tr>
				</table>
				
			</div>
			
		</div>
		
	</form>
	
	<br />
	<br />
	
	<button id="edit-account-save-btn" style="float: right; padding: 10px; width: 120px"><?php echo $DISPLAY_MESSAGES['BTN_SAVE']; ?></button>
	
</div>

<div id="edit-login-pwd-dlog" style="display: none">
	<div id="edit-login-pwd-processDiv"></div>
	<form id="edit-login-pwd-form">
		<table border=0 width="100%" align="center" class="table-td-6" >
			<tr><td class="droite"><?php echo $MODULE_LANGUAGE['LBL_CURRENT_LOGIN']; ?><span class="obliged-elts">*</span></td></tr>	
			<tr><td class="gauche"><input type="text" id="currentlogin" name="currentlogin" class="inset-shadow-grey ui-corner-all input-skyblue-bg" style="width: 90%" value="" /></td></tr>
			<tr><td class="droite"><?php echo $MODULE_LANGUAGE['LBL_CURRENT_PASSEWORD']; ?><span class="obliged-elts">*</span></td></tr>	
			<tr><td class="gauche"><input type="text" id="currentpwd" name="currentpwd" class="inset-shadow-grey ui-corner-all input-skyblue-bg" style="width: 90%" value="" /></td></tr>

			<tr><td class="droite">&nbsp;</td></tr>
			<tr><td class="droite"><div class="ui-widget ui-widget-header ui-state-default ui-corner-all ui-div-separation-form" style="padding:2px !important"><input type="checkbox" id="edit_login" name="edit_login" style="margin:5px; margin-top: 2px" /><label for="edit_login"><?php echo $MODULE_LANGUAGE['LBL_MODIFIER_LOGIN']; ?></label></div></td></tr>
			
			<tr><td class="droite"><?php echo $MODULE_LANGUAGE['LBL_NEW_IDENTIFIANT']; ?></td></tr>	
			<tr><td class="gauche"><input type="text" id="newlogin" name="newlogin" class="inset-shadow-grey ui-corner-all" style="width: 90%" value="" /></td></tr>
			
			<tr><td class="droite">&nbsp;</td></tr>
			<tr><td class="droite"><div class="ui-widget ui-widget-header ui-state-default ui-corner-all ui-div-separation-form" style="padding:2px !important"><input type="checkbox" id="edit_pwd" name="edit_pwd" style="margin:5px; margin-top: 2px" /><label for="edit_pwd"><?php echo $MODULE_LANGUAGE['LBL_MODIFIER_PWD']; ?></label></div></td></tr>
			
			<tr><td class="droite"><?php echo $MODULE_LANGUAGE['LBL_NEW_PASSEWORD']; ?></td></tr>	
			<tr><td class="gauche"><input type="text" id="newpwd" name="newpwd" class="inset-shadow-grey ui-corner-all" style="width: 90%" value="" /></td></tr>
			<tr><td class="droite"><?php echo $MODULE_LANGUAGE['LBL_CFRIRM_NEW_PASSEWORD']; ?></td></tr>	
			<tr><td class="gauche"><input type="text" id="newpwdconfirm" name="newpwdconfirm" class="inset-shadow-grey ui-corner-all" style="width: 90%" value="" /></td></tr>
			
			<tr><td class="droite">&nbsp;</td></tr>
			<tr><td class="droite"><span class="obliged-elts">*</span><?php echo $DISPLAY_MESSAGES['LBL_OBLIGED_FIELDS']; ?></td></tr>
		</table>
	</form>
</div>

<script type="text/javascript">
	$("#editview-compte-tabs").tabs();
	$("#edit-account-save-btn").button({icons:{secondary:"ui-icon-check"}});
	$("#edit-login-pwd-btn").button({icons:{secondary:"ui-icon-pencil"}});
	
	$("#date_engagt").datetimepicker({
		format:'d/m/Y H:i',
		lang:'fr'
	}).mask("99/99/9999 99:99");
	
	$("#edit-account-save-btn").click( function() {
		
		if( $.trim( $("#editview-compte-form input[name=email]").val() ) != "" && !checkRegexp($("#editview-compte-form input[name=email]"), EMAILRGX) ) return;
		
		$("#errorMsgLevel0").hide("blind");
		$("#waitMsgLevel0").html("<?php echo $DISPLAY_MESSAGES['MSG_SAVING']; ?>").show("blind");
		
		var formDatas = $("#editview-compte-form").serialize();
		//alert(formDatas); return;
		var request = $.ajax({type: "POST", url: "index.php?module=accueil&controller=saveUtilisateur", data: formDatas});
		request.done(function(response) {
			$(".afp-main-menu-item[pageref=accueil]").click();
		});
		request.error(function(e){
			alert("DESOLE, UNE ERREUR S'EST PRODUITE PENDANT LA REQUETE :"+e.responseText+" !");
		});
	});
	
	$("#edit-login-pwd-btn").click( function (event) {
		
		event.preventDefault();
		
		$("#edit-login-pwd-dlog:ui-dialog").dialog("close");
		$("#edit-login-pwd-dlog").dialog({
			title: "<?php echo $MODULE_LANGUAGE['TTR_EDIT_LOGIN_PWD']; ?>",
			show: { effect: "explode", duration: 200 },
			hide: { effect: "explode", duration: 200 },
			resizable: false,
			draggable: true,
			height:600,
			width:400,
			modal: true,
			buttons:[
				{
					text: "<?php echo $DISPLAY_MESSAGES['BTN_SAVE']; ?>",
					click: function(){
						
						var checkEdition = false;
						
						if( !checkValue($("#currentlogin")) ) return;
						if( !checkValue($("#currentpwd")) ) return;
						
						if( document.getElementById("edit_login").checked == true ) {
							if( !checkValue($("#newlogin")) ) return;
							checkEdition = true;
						}
						
						if( document.getElementById("edit_pwd").checked == true ) {
							if( !checkValue($("#newpwd")) ) return;
							if( !checkValue($("#newpwdconfirm")) ) return;
							if( $("#newpwd").val() != $("#newpwdconfirm").val() ) {
								$("#newpwd").addClass("ui-state-error");
								$("#newpwdconfirm").addClass("ui-state-error");
								return;
							}
							checkEdition = true;
						}
						
						if(!checkEdition) return;
						
						$("#saveNewLoginPwdBtn").button({disable:true});
						
						var dlg = $(this);
						var formDatas = $("#edit-login-pwd-form").serialize();
						var request = $.ajax({type: "POST", url: "index.php?module=accueil&controller=saveLoginPwd", dataType:"json", data: formDatas});
						request.done(function(responseJSON){      
							if( responseJSON.code == 5 ) {
								alert(responseJSON.msg);
								dlg.dialog("close");
								$(".afp-main-menu-item[pageref=accueil]").click();
							}
							else {
								alert(responseJSON.msg);
							}
							
						});
						request.error(function(e){
							alert("DESOLE, UNE ERREUR S'EST PRODUITE PENDANT LA REQUETE :"+e.responseText+" !");
						});
					},
					icons:{secondary:"ui-icon-check"},
					id: "saveNewLoginPwdBtn"
				},
				{
					text: "<?php echo $DISPLAY_MESSAGES['BTN_CANCEL']; ?>",
					click: function(){
						$(this).dialog("close");
					},
					icons:{secondary:"ui-icon-close"}
				}
			]
		});
	
	});
</script>