<?php

$username = $_GET['lg'];
$password = $_GET['pw'];

$response = 'empty';

if( trim($username) != '' && trim($password) != '' ) {
	
	$where  = 'login="'.$APP_PDO->skipTextSlashes($username).'" AND password=SHA1("'.$APP_PDO->skipTextSlashes($password).'")';
	
	//On regarde d'abord dans la table des utiisateurs
	$utilisateurTable = new OpenAdmin\DAO\AppTable('utilisateur');
	$utilisateurRecord = $utilisateurTable->getResults('*', $where, null, 1);
	if( !empty($utilisateurRecord) ){
		$_SESSION['GADAFICPROSECONDARY'] = $utilisateurRecord[0];
		$affected = $utilisateurTable->updateRows(array('last_connexion'=>date("Y-m-d h:i:s")), 'id='.$_SESSION['GADAFICPROSECONDARY']['id']);
		$_SESSION['GADAFICPROSECONDARY']['target'] = 'utilisateur';
		$response = 'success';
	}
	else{
		
		//On regarde ensuite dans la table des entraineurs
		$entraineurTable = new OpenAdmin\DAO\AppTable('entraineur');
		$entraineurRecord = $entraineurTable->getResults('*', $where, null, 1);
		if( !empty($entraineurRecord) ){
			$_SESSION['GADAFICPROSECONDARY'] = $entraineurRecord[0];
			$affected = $entraineurTable->updateRows(array('last_connexion'=>date("Y-m-d h:i:s")), 'id='.$_SESSION['GADAFICPROSECONDARY']['id']);
			$_SESSION['GADAFICPROSECONDARY']['target'] = 'entraineur';
			$response = 'success';
		}
		else{
			
			//On regarde enfin dans la table des adherants
			$adherantTable = new OpenAdmin\DAO\AppTable('adherant');
			$adherantRecord = $adherantTable->getResults('*', $where, null, 1);
			if( !empty($adherantRecord) ){
				$_SESSION['GADAFICPROSECONDARY'] = $adherantRecord[0];
				$affected = $adherantTable->updateRows(array('last_connexion'=>date("Y-m-d h:i:s")), 'id='.$_SESSION['GADAFICPROSECONDARY']['id']);
				$_SESSION['GADAFICPROSECONDARY']['target'] = 'adherant';
				$response = 'success';
			}
			else {
				//Sinon
				$response = 'denied';
			}
		}
	
	}

}
 
echo $response; exit;
