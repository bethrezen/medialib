<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model simplator\medialib\models\Picture */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="picture-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'folder')->textInput(['maxlength' => 16]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'filetype')->dropDownList([ 'jpeg' => 'Jpeg', 'png' => 'Png', 'gif' => 'Gif', '' => '', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'sizex')->textInput() ?>

    <?= $form->field($model, 'sizey')->textInput() ?>

    <?= $form->field($model, 'createtime')->textInput() ?>

    <?= $form->field($model, 'updatetime')->textInput() ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => 250]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('medialib', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
