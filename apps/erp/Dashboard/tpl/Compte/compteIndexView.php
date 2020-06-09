<div style="padding:10px; height: 96%; background: url('www/img/bg/bg1.jpg');">

<div id="detailsCompteViewContent" >
	
	<div id="detailsview-compte-tabs">
		
		<ul>
			<li><a href="#detailsview-compte-infos-generales"><?php echo $MODULE_LANGUAGE['LBL_INFOS_GENERALES']; ?></a></li>
			<li><a href="#detailsview-compte-adresses"><?php echo $MODULE_LANGUAGE['LBL_ADRESSES']; ?></a></li>
			<li><a href="#detailsview-compte-disciplines"><?php echo $MODULE_LANGUAGE['LBL_DISCIPLINES']; ?></a></li>
			<li><a href="#detailsview-compte-parametres-connexion"><?php echo $MODULE_LANGUAGE['LBL_PARAMETRES_CONNEXION']; ?></a></li>
			<li><a href="#detailsview-compte-infos-compl"><?php echo $MODULE_LANGUAGE['LBL_INFORMATIONS_COMPLEMENTAIRES']; ?></a></li>
		</ul>
		
		<div id="detailsview-compte-infos-generales" >
			<table border=0 width="85%" align="center" class="table-td-6" >

				<tr>
					<td class="droite" ><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_MATRICULE']; ?></label></td>
					<td class="gauche" colspan=3 ><?php echo $utilisateurDatas['code']['valeur']; ?></td>
				</tr>
				
				<tr>
					<td class="droite" width=20%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_NOM']; ?></label></td>
					<td class="gauche" width=40%><?php echo $utilisateurDatas['nom']['valeur']; ?></td>
					<td class="droite" width=20%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_SEXE']; ?></label></td>
					<td class="gauche" width=40%><?php echo ViewHelper::getListValueConfig('SEXE', $utilisateurDatas['sexe']['valeur']); ?></td>
				</tr>
				
				<tr>
					<td class="droite" width=20%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_PRENOM']; ?></label></td>
					<td class="gauche" width=40%><?php echo $utilisateurDatas['prenom']['valeur']; ?></td>
					<td class="droite" width=20%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_AGE']; ?></label></td>
					<td class="gauche" width=40%><?php echo $utilisateurDatas['age']['valeur']; ?></td>
				</tr>

				<tr>
					<td class="droite" width=20%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_DATE_ENGAGEMENT']; ?></td>
					<td class="gauche" width=40%><?php echo str_replace(':', 'h', Utils::showDateHeuresMinsJMY($utilisateurDatas['date_engagt']['valeur'])); ?></td>
					<td class="droite" width=20%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_TAILLE']; ?></label></td>
					<td class="gauche" width=40%><?php echo $utilisateurDatas['taille']['valeur']; ?></td>
				</tr>
				
				<tr>
					<td class="droite" width=20%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_DATE_ENREGISTREMENT']; ?></td>
					<td class="gauche" width=40%><?php echo str_replace(':', 'h', Utils::showDateHeuresMinsJMY($utilisateurDatas['date_enreg']['valeur'])); ?></td>
					<td class="droite" width=20%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_POIDS']; ?></label></td>
					<td class="gauche" width=40%><?php echo $utilisateurDatas['taille']['valeur']; ?></td>
				</tr>				
			</table>
			
		</div>
		
		<div id="detailsview-compte-adresses" >
			<table border=0 width="85%" align="center" class="table-td-6" >

				<tr>
					<td class="droite" width=20%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_TEL1']; ?></label></td>
					<td class="gauche" width=30%><?php echo $utilisateurDatas['tel1']['valeur']; ?></td>
					<td class="gauche" width=50%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_ADRESSE']; ?></label></td>
				</tr>
				
				<tr>
					<td class="droite" width=20%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_TEL2']; ?></label></td>
					<td class="gauche" width=30%><?php echo $utilisateurDatas['tel2']['valeur']; ?></td>
					<td class="gauche" width=50% rowspan=2><?php echo $utilisateurDatas['adresse']['valeur']; ?></td>
				</tr>

				<tr>
					<td class="droite" width=20%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_EMAIL']; ?></label></td>
					<td class="gauche" width=30%><?php echo $utilisateurDatas['email']['valeur']; ?></td>
				</tr>
				
			</table>
			
		</div>
		<div id="detailsview-compte-disciplines" >
		
		</div>
		
		<div id="detailsview-compte-parametres-connexion" >
			<table border=0 width="85%" align="center" class="table-td-6" >

				<tr>
					<td class="droite" width=20%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_IDENTIFIANT']; ?></label></td>
					<td class="gauche" width=30%><?php echo $utilisateurDatas['login']['valeur']; ?></td>
					<td class="gauche" width=50%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_DATE_LAST_CONNEXION']; ?></label></td>
				</tr>
				
				<tr>
					<td class="droite" width=20%><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_PASSEWORD']; ?></label></td>
					<td class="gauche" width=30%>********</td>
					<td class="gauche" width=50% ><?php echo str_replace(':', 'h', Utils::showDateHeuresMinsJMY($_SESSION['GADAFICPROSECONDARY']['last_connexion'])); ?></td>
				</tr>
				
			</table>
			
		</div>
		
		<div id="detailsview-compte-infos-compl" >
			<table border=0 width="85%" align="center" class="table-td-6" >

				<tr>
					<td class="gauche"><label class="label_class"><?php echo $MODULE_LANGUAGE['LBL_INFORMATIONS_COMPLEMENTAIRES']; ?></label></td>
				</tr>
				
				<tr>
					<td class="gauche"><?php echo $utilisateurDatas['infos_comp']['valeur']; ?></td>
				</tr>
			</table>
			
		</div>
		
	</div>
	<br />
	<br />
	<button id="edit-account-btn" style="float: right; padding: 10px; width: 120px"><?php echo $DISPLAY_MESSAGES['BTN_EDIT']; ?></button>
	
</div>
</div>
<script type="text/javascript">
	$("#detailsview-compte-tabs").tabs();
	$("#edit-account-btn").button({icons:{secondary:"ui-icon-pencil"}});
	
	$("#edit-account-btn").click(function(){
		var request = $.ajax({type: "GET", url: "index.php?module=accueil&controller=compteEdit"});
		request.done(function(HTMLBlock){      
			$("#detailsCompteViewContent").replaceWith(HTMLBlock);
		});
		request.error(function(e){
			alert("DESOLE, UNE ERREUR S'EST PRODUITE PENDANT LA REQUETE :"+e.responseText+" !");
		});
	});
</script>