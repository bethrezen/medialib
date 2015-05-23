<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/assets/style.css">
	<script type="text/javascript" src="/assets/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="/assets/dropzone.js"></script>
	<script type="text/javascript" src="/assets/base.js"></script>
</head>
<body>
	<div class="leftpart">
		<h3>Все каталоги</h3>
	</div>
	<div class="content">
		<h3></h3>
		<div class="descr"></div>
		<div class="imglist"></div>
		<div class="dzonediv">
		<form class="dzone" action="POST" style="display: none; width: 1020px; height: 548px;">
		  <input name="catid" type="hidden">
		</form>
	</div>
	</div>
	<div style="clear:both"></div>
	<div class="form">
		<form>
			<p>Загрузить по url: <input name="customUrl" class="customUrl" type="text" /></p>
			<p>Загрузить с компьютера: <input class="ufile" name="file" type="file" /></p>
			<input type="hidden" name="catid" class="catid" />
			<p><div class="sendfile">Отправить</div></p>
		</form>
	</div>
</body>
</html>