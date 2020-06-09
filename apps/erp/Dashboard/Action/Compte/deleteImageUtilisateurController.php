<?php

$affected = (new OpenAdmin\DAO\AppTable($_SESSION['GADAFICPROSECONDARY']['target']))->updateRows(array('imageID'=>0), 'id='.$_SESSION['GADAFICPROSECONDARY']['id']);
$_SESSION['GADAFICPROSECONDARY']['imageID'] = 0;
