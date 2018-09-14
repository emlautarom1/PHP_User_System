<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Laboratorio Programaci&oacute;n III</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
	<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
	<script src="main.js"></script>
</head>

<body>
	<div id="wrapper">
		<div id="header-wrapper" class="container">
			<div id="header" class="container">
				<div id="logo">
					<h1><a href="#">Usuarios</a></h1>
				</div>
				<div id="menu">
					<ul>
						<li class="current_page_item"><a href="index.php">Inicio</a></li>
						<li><a href="agregar.php">Nuevo</a></li>
						<li><a href="listar.php">Listar</a></li>
						<li><a href="borrar.php">Eliminar</a></li>
					</ul>
				</div>
			</div>
			<div>
				<img src="images/img03.png" width="1000" height="40" alt=""/>
			</div>
		</div>
		<!-- end #header -->

		<div id="page">
			<div id="content">
				<div class="post">
					<h2>Sistema de Administraci&oacute;n de Usuarios</h2>
					<p class="meta">
						<span class="date">
							<?php
								print(date("d - m - Y"));
							?>
						</span>
					</p>
					<div style="clear: both;">&nbsp;</div>
					<div class="entry">
						<h1>Funcionamiento del Sistema:</h2>
						<hr>
						<h3>Agregar un nuevo usuario</h3>
						<p>Dirijase a la pestaña de <a href="agregar.php"><b>Nuevo</b></a> y complete el formulario.</p>
						<br>
						<h3>Listar usuarios registrados</h3>
						<p>Dirijase a la pestaña de <a href="listar.php"><b>Listar</b></a></p>
						<br>
						<h3>Borrar usuarios</h3>
						<p>Dirijase a la pestaña de <a href="borrar.php"><b>Eliminar</b></a>, marque los usuarios que desee eliminar y pulse <b>Eliminar Usuarios</b>.</p>
						<br>
					</div>
				</div>
				<div style="clear: both;">&nbsp;</div>
			</div>
			<!-- end #content -->
			<div style="clear: both;">&nbsp;</div>
		</div>
		<div class="container"><img src="images/img03.png" width="1000" height="40" alt="" /></div>
		<!-- end #page -->
	
	<footer>
		<div id="footer-content"></div>
			<div id="footer">
				<p>&copy; Emanuel Lautaro - 2018 </p>
	</footer>
	<!-- end #footer -->
</body>

</html>