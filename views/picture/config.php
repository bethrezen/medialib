<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model simplator\medialib\models\Picture */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Picture',
]) . ' ' . $model->name;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pictures'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="picture-update">

    <h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin([
	'method'=>'POST'
]); ?>
<?php
$items=$options->items['size'];
$items['_new']=[];
var_dump($items);
?>
<table>
	<tr>
		<th>name</th>
		<th>width</th>
		<th>height</th>
		<th>scale</th>
	</tr>
<?php
foreach ($items as $variant=>$value):
	echo '<tr>';
	echo '<td>'.Html::textInput('options[size]['.$variant.'][_name]', $variant).'</td>';
	echo '<td>'.Html::textInput('options[size]['.$variant.'][width]', $value['width']).'</td>';
	echo '<td>'.Html::textInput('options[size]['.$variant.'][height]', $value['height']).'</td>';
	echo '<td>'.Html::dropDownList('options[size]['.$variant.'][scale]', $value['scale'], [
		'in' => 'In',
		'out' => 'Out',
		'center' => 'Center',
	]).'</td>';
	echo '</tr>';
endforeach; 
?>
</table>
<div class="form-group">
	<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>

</div>
