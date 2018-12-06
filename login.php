<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>PROblemSolver</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" type="text/css" href="http://localhost/PROblemSolver/css/main.css">
</head>
<body>
	

	<div class="container">
		<!--NAVBAR-->
		<nav class="navbar">
				<span class="open-slide">
					<a href="#" onclick="openSlideMenu()">
						<svg width="30" height="30">
							<path d = "M0,5 30,5" stroke="#fff" stroke-width="5"/>
							<path d = "M0,14 30,14" stroke="#fff" stroke-width="5"/>
							<path d = "M0,23 30,23" stroke="#fff" stroke-width="5"/>
						</svg>
					</a>
				</span>
				<ul class="navbar-nav">
                    <li><a href="http://localhost/PROblemSolver/index.php">Home</a></li>
                    <li><a href="http://localhost/PROblemSolver/prova.php">Naviga Problemi</a></li>
                    <li><a href="http://localhost/PROblemSolver/report.php">Riporta Problema</a></li>
                    <li><a href="#">Login/Registrati</a></li>
					<li><a href="http://localhost/PROblemSolver/cerca.php"> Cerca Problemi</a><li>
				</ul>

		</nav>

		<!--Menu a scomparsa-->
		<div id="side-menu" class="side-nav">
				<a href="#" class="btn-close" onclick="closeSlideMenu()">&times;</a>
				<a href="http://localhost/PROblemSolver/index.php">Home</a>
				<a href="http://localhost/PROblemSolver/prova.php">Naviga Problemi</a></a>
				<a href="http://localhost/PROblemSolver/report.php">Riporta Problema</a>
				<a href="#">Login/Registrati</a>
				<li><a href="http://localhost/PROblemSolver/cerca.php"> Cerca Problemi</a><li>
		</div>

		<!-- main body-->
		<div class="logincontainer">
			<img src="http://localhost/PROblemSolver/logocomune.png" class="logo">
			<form>
				<label for="uname"><b>Username</b></label>
				<input type="text" name="Username" placeholder="Nome Utente" required>
				<label for="psw"><b>Password</b></label>
				<input type="password" name="password" placeholder="Password" required>
				<input type="submit" value="Login">
				<p><a href="http://localhost/PROblemSolver/registrati.php">Non sei ancora registrato? Registrati.</a></p>
			</form>
		</div>

		<div></div>
	



		<!-- footer-->
		<div class="footer">
			<p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,

			</p>
		</div>
	



	</div>
	<script>
			function openSlideMenu(){
				document.getElementById("side-menu").style.width="250px"
				document.getElementById("main.").style.marginLeft="250px"
			}
			function closeSlideMenu(){
				document.getElementById("side-menu").style.width="0px"
				document.getElementById("main.").style.marginLeft="0px"
			}
	</script>
</body>
</html>