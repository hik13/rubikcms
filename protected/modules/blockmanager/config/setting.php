<?php

return array(
    'module_id' => "M-BM",
    'required'=>true,
    'moduleID'=>"blockmanager",
    'module_name' => 'blockmanagerModulName',
    'defaultCntrl' => '/blockmanager/',
    'modulDescription' => 'blockmanagerDescription',
    'class' => 'blockmanager',
    'modulePermission' => array(
        array('access' => 'manageBlock', 'name' => 'blockmanagermanageBlock'),
        array('access' => 'manageSystemBlock', 'name' => 'blockmanagermanageSystemBlock',),
        array('access' => 'manageBanner', 'name' => 'bannermanagerBanner'),
        array('access' => 'managePosition', 'name' => 'blockmanagermanagePosition',),
    ),
        )
?>
