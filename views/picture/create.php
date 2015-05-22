<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model cnxfaeton\medialib\models\Picture */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Picture',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pictures'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="picture-create">

    <h1><?= Html::encode($this->title) ?></h1>

	<div class="picture-form">

		<?php $form = ActiveForm::begin([
			'options'=>[
				'enctype' => 'multipart/form-data'
			]
		]); ?>

		<?= $form->field($model, 'file')->fileInput() ?>
		<?= $form->field($model, 'comment')->textInput(['maxlength' => 250]) ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>
	<?php var_dump($model->errors) ?>
</div>
