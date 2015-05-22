<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace simplator\medialib\widgets;

use simplator\medialib\models\Picture;

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
		
        if ($this->hasModel()) {
            echo \yii\helpers\Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            echo \yii\helpers\Html::textInput($this->name, $this->value, $this->options);
        }

		$js = [];

        $view = $this->getView();

/*        CKEditorWidgetAsset::register($view);

        $id = $this->options['id'];

        $options = $this->clientOptions !== false && !empty($this->clientOptions)
            ? Json::encode($this->clientOptions)
            : '{}';

        $js[] = "CKEDITOR.replace('$id', $options);";*/
		
$js[]= <<< JS
	//alert('$id');
	var callback = function(id) {
      	$.fancybox.close();
        alert("This is ID of selected image: "+id);
	};

    $('#$id-select').click(function(){
        $.fancybox.open([{href : '/image/selector.html', type: 'iframe', title : 'Title', width: '900px', height: '700px', autoDimensions: false, 'autoSize':false}]);
    });
JS;

		
        if (isset($this->clientOptions['filebrowserUploadUrl'])) {
            $js[] = "dosamigos.ckEditorWidget.registerCsrfImageUploadHandler();";
        }

        $view->registerJs(implode("\n", $js));
		
        return $this->render('picSelect', [
			'id'	=>$id
        ]);
		
    }
}
