<?php

$user_id = $_SESSION['GADAFICPROSECONDARY']['id'];

$response = array('code'=>0, 'msg'=>'Aucune action effectuée !');

if( isset($_POST['edit_login']) || isset($_POST['edit_pwd']) ) {
	
	$currentlogin 	= $_POST['currentlogin'];
	$currentpwd 	= $_POST['currentpwd'];
	
	$newlogin 		= $_POST['newlogin'];
	$newpwd 		= $_POST['newpwd'];
	$newpwdconfirm 	= $_POST['newpwdconfirm'];
	
	if( trim($currentlogin) != '' && trim($currentpwd) != '' ) {
		
		$utilisateurTable = new OpenAdmin\DAO\AppTable('utilisateur');
		
		$where  = 'login="'.$APP_PDO->skipTextSlashes($currentlogin).'" AND password=SHA1("'.$APP_PDO->skipTextSlashes($currentpwd).'")';
		$utilisateurRerord = $utilisateurTable->getResults('*', $where, null, 1);

		if( !empty($utilisateurRerord) ){
			
			//On se rassure que l'utilisateur est entrain de modifier son propre compte
			if( $utilisateurRerord[0]['id'] == $user_id ) {
				
				//SI L'UTILISATEUR VEUT MODIFIER SON IDENTIFIANT
				if( isset($_POST['edit_login']) ) {
					//On se rassure que le nouvel identifiant n'existe pas dans la base de données avant de le créer
					$utilisateurRecords = $utilisateurTable->getResults('*', 'login="'.$APP_PDO->skipTextSlashes($newlogin).'"');
					if( count($utilisateurRecords) == 0 ) {
						$affected = $utilisateurTable->updateRows(array('login'=> $APP_PDO->skipTextSlashes($newlogin) ), 'id='.$user_id);
						$_SESSION['GADAFICPROSECONDARY']['login'] = $APP_PDO->skipTextSlashes($newlogin);
						$response = array('code' => 5, 'msg'=>'Mise à jour effectuée avec succès !');
					}
					else {
						$response = array('code' => 3, 'msg'=>'Cet identifiant est déjà utilisé !');
					}
					
				}
				
				//SI L'UTILISATEUR VEUT MODIFIER SON MOT DE PASSE
				if( isset($_POST['edit_pwd']) ) {
					//On se rassure que l'utilisateur a bien rempli les champs de nouveaux mots de passe
					if( trim($newpwd) != '' && trim($newpwdconfirm) == trim($newpwd)  ) {
						$affected = $utilisateurTable->updateRows(array('password'=>'SHA1("'.$APP_PDO->skipTextSlashes($newpwd).'")' ), 'id='.$user_id, array('password'));
						$_SESSION['GADAFICPROSECONDARY']['password'] = $APP_PDO->skipTextSlashes($newpwd);
						$response = array('code' => 5, 'msg'=>'Mise à jour effectuée avec succès !');
					}
					else {
						$response = array('code' => 4, 'msg'=>'Veuillez fournir un nouveau mot et le confirmer !');
					}
					
				}				
				
				
			}
			else{
				$response = array('code' => 2, 'msg'=>'Impossible de modifier les paramètres de compte !');
			}
		}
		else{
			$response = array('code' => 1, 'msg'=>'Utilisateur introuvable !');
		}

	}	
}
