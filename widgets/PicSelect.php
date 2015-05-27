<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace simplator\medialib\widgets;

use simplator\medialib\models\Picture;
use simplator\medialib\ModuleAsset;

/**
 * Description of PicSelect
 *
 * @author faeton
 */
class PicSelect extends \yii\jui\InputWidget
{
	public $folderurl=['/medialib/json/index'];
	public $uploadurl=['/medialib/picture/upload'];
	
    /**
     * @inheritdoc
	 * 
	 * FIXME hide input
     */
    public function run()
    {
		$folderurl=  \yii\helpers\Url::to($this->folderurl);
//		$this->options['data-url'] = \yii\helpers\Url::to($this->uploadurl);

		$picid=$this->model->{$this->attribute};
		$picture=null;
		if ($picid)
			$picture=Picture::find()->where(['id'=>$picid])->one();
		if (!$picture)
			$picture=new Picture;
		
		$id=$this->options['id'];
		
		$js = [];

        $view = $this->getView();

/*        CKEditorWidgetAsset::register($view);

        $id = $this->options['id'];

        $options = $this->clientOptions !== false && !empty($this->clientOptions)
            ? Json::encode($this->clientOptions)
            : '{}';

        $js[] = "CKEDITOR.replace('$id', $options);";*/
		
			
$js[]= <<< JS
	jQuery('#$id-select').fileselect({
		title:		"Выбор изображения",
		callback:	function(id){alert(id)}
	});
	
JS;

		
        $this->registerClientScript();
        $view->registerJs(implode("\n", $js));
		
        return $this->render('picSelect', [
			'widget'	=> $this,
			'picture'	=> $picture
        ]);
		
    }
	
    /**
     * Registers required script for the plugin to work as DatePicker
     */
    public function registerClientScript() {
        $view = $this->getView();

        $assets=ModuleAsset::register($view);
		$assets->js[]='js/jquery.fileselect.js';
    }
	
}
