<?php

return array(
    'module_id' => "M-CM",
    'required'=>true,
    'moduleID'=>"contentmanager",
    'module_name' => 'contentmanagerModuleName',
    'defaultCntrl' => '/contentmanager/',
    'modulDescription' => 'contentmanagerDescription',
    'class' => 'contentmanager',
    'modulePermission' => array(
        array('access' => 'manageContent', 'name' => 'contentmanagermanageContent'),
        array('access' => 'manageLocale', 'name' => 'localemanagermanageLocale'),
    ),
        )
?>
