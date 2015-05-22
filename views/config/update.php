<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model simplator\medialib\models\Config */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Config',
]) . ' ' . $model->model;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Configs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->model, 'url' => ['view', 'model' => $model->model, 'item' => $model->item, 'variant' => $model->variant]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="config-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
