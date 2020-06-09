<?php
/**
 * Project : OPEN ADMIN
 * File Author : BryZe NtZa
 * File Description : Namespaces classes entries
 * Date : Juin 2018
 * Copyright XDEV WORKGROUP
 * */

return [
    'OpenAdmin' => [
        'Core' => $baseDir . '/core',
        'View' => $baseDir . '/view',
        'App' => $baseDir . '/apps',
        'Library' => $baseDir . '/lib',
        'Erp' => $baseDir . '/apps/erp',
        'Administration' => $baseDir . '/apps/administration',
        'Stocks' => $baseDir . '/apps/stocks',
        'Ged' => $baseDir . '/apps/ged',
        'Finances' => $baseDir . '/apps/finances',
        'Hr' => $baseDir . '/apps/hr',
        'Accounting' => $baseDir . '/apps/accounting',
        'Taxes' => $baseDir . '/apps/taxes',
        'Citizen' => $baseDir . '/apps/citizen',
        'Messages' => $baseDir . '/apps/messages',
    ],
    'Xdev' => $baseDir . '/xdev',
    'Mpdf' => $vendorsDir . '/mpdf/src',
    'Psr' => [
        'Container' => $vendorsDir . '/psr/container/src',
        'Http' => $vendorsDir . '/psr/http-message/src',
        'Log' => $vendorsDir . '/psr/log/Psr/Log',
    ],
    'League' => [
        'Plates' => $vendorsDir . '/league/plates/src',
    ],
];
