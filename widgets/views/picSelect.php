<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var simplator\medialib\models\Picture $picture
 */
$asset=\simplator\medialib\ModuleAsset::register($this);
$baseurl=$asset->baseUrl;
?>

<div class="medialib-widget-select" style="background-image: url(<?=$baseurl ?>/file-add.png)" data-add="<?=$baseurl ?>/file-add.png" data-uploading="<?=$baseurl ?>/file-uploading.gif" id="<?php echo $widget->options['id'].'-select' ?>">
<?php echo \yii\helpers\Html::activeTextInput($widget->model, $widget->attribute, $widget->options); ?>
<?php echo Html::fileInput('Picture[file]', null, [
	'class'=>'fileupload',
	'data-url'=>\yii\helpers\Url::to($widget->uploadurl),
	'multiple'=>true]) ?><br />

<div class="progr">
    <div class="bar" style="width: 0%;"></div>
</div>
</div>
