<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pictures');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'MediaLib'), 'url' => ['/medialib']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="picture-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Picture',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php
	// Ajax uploads with drag and drop feature. Enable AJAX uploads by setting the `uploadUrl` property 
	// in pluginOptions. You can also pass extra data to your upload URL via `uploadExtraData`. Refer 
	// [plugin documentation and demos](http://plugins.krajee.com/file-input/demo) for more details 
	// and options on using AJAX uploads.
	echo \kartik\file\FileInput::widget([
		'name' => 'Picture[file]',
		'options'=>[
			'multiple'=>true
		],
		'pluginOptions' => [
			'uploadUrl' => \yii\helpers\Url::to(['/medialib/picture/upload']),
			'uploadExtraData' => [
				'album_id' => 20,
				'cat_id' => 'Nature'
			],
			'maxFileCount' => 100
		]
	]);
?>
	<div class="mlpicture">
		<?php echo ListView::widget([
			'dataProvider'=>$dataProvider,
			'itemView'=>'_preview'
		]); ?>
	</div>
	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'folder',
            'name',
            'filetype',
            'sizex',
            // 'sizey',
            // 'createtime:datetime',
            // 'updatetime:datetime',
            // 'comment',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
