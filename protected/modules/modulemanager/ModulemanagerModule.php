<?php

class ModuleManagerModule extends CMyModule
{
    
      public $defaultController="module";
      
	public function init()
	{
                parent::init();
		$this->setImport(array(
			'modulemanager.models.*',
			'modulemanager.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			return true;
		}
		else
			return false;
	}
}
