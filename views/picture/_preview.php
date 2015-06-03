<?php
use simplator\medialib\models\File;
?>

<div class="file-preview-frame" id="preview-1426305300270-0" data-fileindex="0">
	<?php echo \yii\helpers\Html::a(\yii\helpers\Html::img(File::picture($model->id, 'preview')), File::picture($model->id, 'full'), [
		'class'=>'file-preview-image',
		'style'=>'width:auto;height:160px;'
		]); ?>
	<div class="file-thumbnail-footer">
    <div class="file-caption-name" title="0_807d0_190c4635_orig.png" style="width: 207px;"><?= $model->comment ?></div>
    <div class="file-actions">
    <div class="file-footer-buttons">
        <button type="button" class="kv-file-upload btn btn-xs btn-default" title="Upload file">   <i class="glyphicon glyphicon-upload text-info"></i>
</button>
		<button type="button" class="kv-file-remove btn btn-xs btn-default" title="Remove file" data-confirm="Realy?" href="<?php echo \yii\helpers\Url::to(['/medialib/picture/delete', 'id'=>$model->id]); ?>" data-method="post" data-pjax="0"><i class="glyphicon glyphicon-trash text-danger"></i></button>
    </div>
    <div class="file-upload-indicator" tabindex="-1" title="Not uploaded yet"><i class="glyphicon glyphicon-hand-down text-warning"></i></div>
    <div class="clearfix"></div>
</div>
</div>
</div>
