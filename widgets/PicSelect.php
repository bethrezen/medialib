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
    /**
     * @inheritdoc
	 * 
	 * FIXME hide input
     */
    public function run()
    {
		$id=$this->options['id'];
		
		$js = [];

        $view = $this->getView();

/*        CKEditorWidgetAsset::register($view);

        $id = $this->options['id'];

        $options = $this->clientOptions !== false && !empty($this->clientOptions)
            ? Json::encode($this->clientOptions)
            : '{}';

        $js[] = "CKEDITOR.replace('$id', $options);";*/
		
		$folderurl=  \yii\helpers\Url::to(['/medialib/json/index']);
$js[]= <<< JS
	jQuery('#$id-select').fileselect({
		title:		"Выбор изображения",
		callback:	function(id){alert(id)}
	});
JS;

		
        $this->registerClientScript();
        $view->registerJs(implode("\n", $js));
		
        return $this->render('picSelect', [
			'id'	=> $id,
			'input'	=> $this->hasModel()?\yii\helpers\Html::activeTextInput($this->model, $this->attribute, $this->options):\yii\helpers\Html::textInput($this->name, $this->value, $this->options)
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
