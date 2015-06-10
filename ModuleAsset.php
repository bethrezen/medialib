<?php

/**
 * @copyright Copyright (c) 2015 Evgeny Lubyanoi
 * @license https://github.com/simplator/medialib/blob/master/LICENSE.md
 * @author Evgeny Lubyanoi <i@cnx-faeton.ru>
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
		'newerton\fancybox\FancyBoxAsset',
		'dosamigos\fileupload\FileUploadAsset'
    ];
    
	public $js = [];
	public $css = [
		'css/main.css'
	];
    
	public $sourcePath='@vendor/simplator/medialib/assets/';
}
