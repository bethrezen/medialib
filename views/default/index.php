<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model cnxfaeton\medialib\models\Picture */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Medialib'), 'url' => ['index']];
?>
<?= Html::a(Yii::t('app', 'Pictures'), ['/medialib/picture'], ['class' => 'btn btn-primary']) ?>

<div class="medialib-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
		
		!!! form
    </p>
</div>
