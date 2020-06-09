<?php 

$id   = $_SESSION['GADAFICPROSECONDARY']['id'];
$type = $_SESSION['GADAFICPROSECONDARY']['groupeutilisateur_id'];

$utilisateurTable = new OpenAdmin\DAO\AppTable('utilisateur');
$utilisateurRow = $utilisateurTable->getRecordInfos('id', $id);

if( !empty($utilisateurRow) ){
	
	$utilisateurEntity = DAO_UTILS::getEntity('utilisateur');
	$utilisateurDatas  = DAO_UTILS::hydratate($utilisateurEntity, $utilisateurRow[0]);
}
