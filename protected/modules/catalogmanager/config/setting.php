<?php
return array(
        'module_id'=>"M-CTM",
        'required'=>false,
        'moduleID'=>"catalogmanager",
        'module_name'=>'catalogmanagerModulName',
        'defaultCntrl'=>'/catalogmanager/',
        'modulDescription'=>'catalogmanagerDescription',
        'class'=>'catalogmanager',
        'modulePermission'=>array(array('access'=>'manageObject', 'name'=>'catalogmanagermanageObject'),
                                  array('access'=>'manageDimension', 'name'=>'catalogmanagermanageDimension'),
                                  array('access'=>'manageManufacturer', 'name'=>'catalogmanagermanageManufacturer'),
                                  ),
        )
?>

