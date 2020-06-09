<?php

$langue_id = $_GET['id'];

if( isset($_SESSION['GADAFICPROSECONDARY']) ) {
	
	$_SESSION['GADAFICPROSECONDARY']['langue_id'] = $langue_id;
	
	if($_SESSION['GADAFICPROSECONDARY']['target']==1) { //Utilissateur
		$utilisateurTable  = new OpenAdmin\DAO\AppTable('utilisateur');
		$affected = $utilisateurTable->updateRows(array('langue_id'=>$langue_id), 'id='.$_SESSION['GADAFICPROSECONDARY']['id']);
	}
	if($_SESSION['GADAFICPROSECONDARY']['target']==2) { //Elève
		$eleveTable  = new OpenAdmin\DAO\AppTable('eleve');
		$affected = $eleveTable->updateRows(array('langue_id'=>$langue_id), 'id='.$_SESSION['GADAFICPROSECONDARY']['id']);
	}
	
}
else {
	$_SESSION['GADAFICPROSECONDARY_']['langue_id'] = $langue_id;
}

exit;
	