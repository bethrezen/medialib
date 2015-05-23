<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2015
 * @package yii2-widgets
 * @subpackage yii2-widget-fileinput
 * @version 1.0.2
 */

namespace simplator\medialib;

/**
 * Asset bundle for simpleblog
 *
 * @since 0.1
 */
class ModuleAsset extends \simplator\base\BaseAssetBundle
{
	public $depends = [
        'yii\web\JqueryAsset',
		'newerton\fancybox\FancyBoxAsset'
    ];
    
	public $js = [];
	public $css = [
		'css/main.css'
	];
    
	public $sourcePath='@vendor/simplator/medialib/assets/';
}
