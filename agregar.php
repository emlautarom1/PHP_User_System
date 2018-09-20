<!DOCTYPE html>
<?php 
	include_once "functions.php"
?>
<html>

<head>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Laboratorio Programaci&oacute;n III</title>
	<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
	<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
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
						<li><a href="index.php">Inicio</a></li>
						<li class="current_page_item"><a href="agregar.php">Nuevo</a></li>
						<li><a href="listar.php">Listar</a></li>
						<li><a href="borrar.php">eliminar</a></li>
					</ul>
				</div>
			</div>
			<div><img src="images/img03.png" width="1000" height="40" alt="" /></div>
		</div>
		<!-- end #header -->

		<div id="page">
			<div id="content">
				<div class="post">
					<h1>Sistema de Administraci&oacute;n de Usuarios</h1>
					<p class="meta">
						<span class="date">
							<?php
								print(date("d - m - Y")); 
							?>
						</span>
					</p>
					<div style="clear: both;">&nbsp;</div>
					<div class="entry">

						<!-- Input form -->
						<?php
						if($_SERVER["REQUEST_METHOD"] == "POST"){
							$user = getPostUser();
							$errorList = validateUser($user);
							if (noErrorCheck($errorList)) {
								// If no erros, add user.
								if (addUser($user)) {
									// Alert box
									print("
									<script language=\"javascript\">
									alert(\"Se ha cargado el usuario al sistema.\")
									</script>
									");
									// Reset user
									$user = emptyUser();
								} else {
									print("
									<script language=\"javascript\">
									alert(\"Hubo un problema al cargar el usuario.\")
									</script>
									");
								}
							}
						}
						else {
							// If no POST, set user and errors empty.
							$user = emptyUser();
							$errorList = emptyErrors();
						}
					?>

						<h3>Todos los campos son obligatorios</h3>
						<form class="newuser" method="post" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF"]);?>">
							<input type="text" name="name" id="surname" value="<?php echo $user['name'];?>" placeholder="Nombre">
							<span class="error">
								<?php echo $errorList['name'];?></span>
							<br>
							<input type="text" name="surname" id="surname" value="<?php echo $user['surname'];?>" placeholder="Apellido">
							<span class="error">
								<?php echo $errorList['surname'];?></span>
							<br>
							<span>Sexo: </span>
							<input type="radio" name="gender" value="M" <?php if ($user['gender']=="" || $user['gender']=="M" ) echo
							 "checked" ;?>>
							<label for="male">Masculino</label>
							<input type="radio" name="gender" value="F" <?php if ($user['gender']=="F" ) echo "checked" ;?>>
							<label for="male">Femenino</label>
							<input type="radio" name="gender" value="O" <?php if ($user['gender']=="O" ) echo "checked" ;?>>
							<label for="male">Otro</label>
							<span class="error">
								<?php echo $errorList['gender'];?></span>
							<br>
							<input type="email" name="email" value="<?php echo $user['email'];?>" placeholder="ejemplo@dominio.com">
							<span class="error">
								<?php echo $errorList['email'];?></span>
							<br>
							<input type="text" name="address" value="<?php echo $user['address'];?>" placeholder="Calle Ciudad Provincia">
							<span class="error">
								<?php echo $errorList['address'];?></span>
							<br>
							<input type="text" name="nickname" value="<?php echo $user['nickname'];?>" placeholder="Nick">
							<span class="error">
								<?php echo $errorList['nickname'];?></span>
							<br>
							<input type="tel" name="tel" value="<?php echo $user['tel'];?>" placeholder="555-555-5555">
							<span class="error">
								<?php echo $errorList['tel'];?></span>
							<br>
							<button type="submit">Enviar</button>
						</form>
					</div>
				</div>
				<div style="clear: both;">&nbsp;</div>
			</div>
			<!-- end #content -->
			<div style="clear: both;">&nbsp;</div>
		</div>
		<div class="container">
			<img src="images/img03.png" width="1000" height="40" alt="" />
		</div>
		<!-- end #page -->
		<footer>
			<div id="footer-content"></div>
			<div id="footer">
				<p>&copy; Emanuel Lautaro - 2018 </p>
		</footer>
		<!-- end #footer -->
</body>

</html>