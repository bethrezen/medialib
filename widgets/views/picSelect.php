<?php

/**
 * @copyright Copyright (c) 2015 Evgeny Lubyanoi
 * @license https://github.com/simplator/medialib/blob/master/LICENSE.md
 * @author Evgeny Lubyanoi <i@cnx-faeton.ru>
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var simplator\medialib\models\Picture $picture
 */
$asset=\simplator\medialib\ModuleAsset::register($this);
$baseurl=$asset->baseUrl;
$img=$baseurl.'/file-add.png';
if (!$picture->getIsNewRecord())
	$img=$picture->directlink('preview');
?>

<div class="medialib-widget-select" style="background-image: url(<?=$img ?>)" data-add="<?=$baseurl ?>/file-add.png" data-uploading="<?=$baseurl ?>/file-uploading.gif" id="<?php echo $widget->options['id'].'-select' ?>">
<?php echo \yii\helpers\Html::activeTextInput($widget->model, $widget->attribute, $widget->options); ?>
<?php echo Html::fileInput('Picture[file]', null, [
	'class'=>'fileupload',
	'data-url'=>\yii\helpers\Url::to($widget->uploadurl),
	'multiple'=>true]) ?><br />

<div class="progr">
    <div class="bar" style="width: 0%;"></div>
</div>
</div>
