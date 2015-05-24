<div class="folders">
	<h3>Все каталоги</h3>
</div>
<div class="content">
	<h3>Заголовок</h3>
	<div class="descr">Описание</div>
	<div class="imglist"></div>


<div class="form">
	
<?= \dosamigos\fileupload\FileUpload::widget([
    'model' => $model,
    'attribute' => 'file',
    'url' => ['/medialib/picture/upload'], // your url, this is just for demo purposes,
    'options' => ['accept' => 'image/*'],
    'clientOptions' => [
        'maxFileSize' => 2000000
    ],
    // Also, you can specify jQuery-File-Upload events
    // see: https://github.com/blueimp/jQuery-File-Upload/wiki/Options#processing-callback-options
    'clientEvents' => [
        'fileuploaddone' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
        'fileuploadfail' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
    ],
]);?>
</div>

</div>
<div class="info">
	<h3>Описание</h3>
</div>


