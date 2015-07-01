<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<link rel="stylesheet" type="text/css" href="/profs/css/style1.css" />
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="/profs/js/rating/jquery.rating.css">
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script src="/profs/js/rating/jquery.rating.pack.js"></script>

	<title>Escolha seu professor - Site</title>
</head>

<body>
	<div style="width: 400px;margin: auto;">
		<h1>Enviar Sugestao</h1>
		<h4>Sugira:
			<ul>
				<li>Novos professores</li>
				<li>Melhorias</li>
			</ul>
		</h4>
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</body>
</html>