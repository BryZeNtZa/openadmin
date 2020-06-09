<?php

$id = (int) $_SESSION['GADAFICPROSECONDARY']['id'];
$p  = $_POST;

$utilisateurTable  = new OpenAdmin\DAO\AppTable('utilisateur');
$utilisateurEntity = DAO_UTILS::getEntity('utilisateur');
$utilisateurDatas  = DAO_UTILS::prepareModel($utilisateurEntity, $p);

$utilisateurDatas['date_engagt'] = Utils::dateConvert($utilisateurDatas['date_engagt'].':00', 'd/m/Y', 'Y-m-d', 19);

 $affected = $utilisateurTable->updateRows($utilisateurDatas, 'id='.$id);

echo $affected;
exit;
	