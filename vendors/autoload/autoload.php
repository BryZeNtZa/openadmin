<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Application Classes Autoload Function
 * Date : Mars 2020
 * Copyright XDEV WORKGROUP
 * */

$vendorsDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorsDir);

$namespaces_entries = include $vendorsDir . '/autoload/namespaces.entries.php';

function autoload($classname) {	
    GLOBAL $namespaces_entries;

    $entries = $namespaces_entries;
    $namespaces = explode('\\', $classname);
    $nb_namespaces = count($namespaces);

    $i = 0;
    $loop = true;

    do {	
        $sub_entries = $entries[$namespaces[$i]];
        if($sub_entries == null) {
            echo "Namespace '{$namespaces[$i]}' not found for the class '{$classname}'";
            return;
        }
        if( is_string($sub_entries) ) {
            $classpath = $sub_entries;
            for($j=$i+1; $j<$nb_namespaces; $j++) { $classpath .= '/' . $namespaces[$j]; }
            $loop = false;
            require_once $classpath . '.php';
            return;
        }
        else {
            $i++;
            $entries = $sub_entries;
        }
    } while($loop);
}

spl_autoload_register('autoload');
