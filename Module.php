<?php

namespace simplator\medialib;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'simplator\medialib\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
	
    /**
     * @var string The prefix for user module URL.
     * @See [[GroupUrlRule::prefix]]
     */
    public $urlPrefix = 'medialib';

    /** @var array The rules to be used in URL management. */
    public $urlRules = [
        'pic<id:\d+>/<size:\w+>'	=> 'file/picture',
        'pic<id:\d+>'				=> 'file/picture',
		'folder'					=> 'json/index',
        'picture/<id:\d+>'			=> 'picture/view',
    ];
}
