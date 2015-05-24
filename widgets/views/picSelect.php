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
?>

<div style="background: grey" id="<?php echo $widget->options['id'].'-select' ?>">
	<span class="log">PicSelect</span>
<?php //echo Html::buttonInput(Yii::t('medialib', 'Select picture')) ?><br />

<?php echo \yii\helpers\Html::activeTextInput($widget->model, $widget->attribute, $widget->options); ?>
<?php echo Html::fileInput('Picture[file]', null, [
	'class'=>'fileupload',
	'data-url'=>\yii\helpers\Url::to($widget->uploadurl),
	'multiple'=>true]) ?><br />

<div class="progress">
    <div class="bar" style="width: 0%;height: 18px;background: green;"></div>
</div>
</div>
