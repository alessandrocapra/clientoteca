<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Clientoteca - trova nuovi clienti e aumenta la visibilità della tua azienda!</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?v=Nmm4A9lo20">
	<link rel="icon" type="image/png" href="/favicon-32x32.png?v=Nmm4A9lo20" sizes="32x32">
	<link rel="icon" type="image/png" href="/favicon-16x16.png?v=Nmm4A9lo20" sizes="16x16">
	<link rel="manifest" href="/manifest.json?v=Nmm4A9lo20">
	<link rel="mask-icon" href="/safari-pinned-tab.svg?v=Nmm4A9lo20" color="#5bbad5">
	<link rel="shortcut icon" href="/favicon.ico?v=Nmm4A9lo20">
	<meta name="theme-color" content="#ffffff">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/stile.css">
</head>
<body>
	<header class="container">
		<div class="row">
			<div id="logo" class="col-sm-6">
				<img src="img/logo.png" alt="Clientoteca">
				<h2>Per chi ha voglia di fare!</h2>
			</div>
			<nav>
				<ul>
					<li><a href="index.html">Home</a></li>
					<li><a href="chi-siamo.html">Chi siamo</a></li>
					<li><a href="servizi.html">Servizi</a></li>
					<li><a href="trova-clienti.html" class="active">Area Interesse</a></li>
				</ul>
			</nav>
		</div>
	</header>

	<main>
		<section class="container-fluid slider home">
			<div class="motto col-xs-12 col-sm-6">
				<h1>Trova nuovi clienti!</h1>
				<p>Un metodo testato, pratico e veloce per trovare nuovi clienti.</p>
			</div>
		</section>

		<article class="container">
			<h1 class="titolo">Come funziona Clientoteca</h1>
			<section class="row services">
				<div class="col-sm-3">
					<div class="circle">1</div>
					<p>Seleziona il settore in cui operi</p>
				</div>
				<div class="col-sm-3">
					<div class="circle">2</div>
					<p>Affina la ricerca definendo il tuo settore operativo</p>
				</div>
				<div class="col-sm-3">
					<div class="circle">3</div>
					<p>Scegli l'area di tuo interesse</p>
				</div>
				<div class="col-sm-3">
					<div class="circle">4</div>
					<p>Inserisci i tuoi contatti per ricevere i dati richiesti direttamente nella tua casella email!</p>
				</div>
			</section>
		</article>

		<article class="container-fluid">
			<section class="row tabella">
<!--				<h1 class="titolo">Trova nuovi potenziali clienti!</h1>-->
				<div class="col-sm-10 col-sm-offset-1">
					<div class="row">
						<form class="col-sm-12" action="" onsubmit="event.preventDefault();processForm();">
							<div class="row">
								<div class="col-sm-12" style="margin-bottom: 1.5em;">
									<div class="col-sm-4">
										<h3>Nome contatto</h3>
										<input type="text" id="nomeContatto" placeholder="es. Mario Rossi">
									</div>
									<div class="col-sm-4">
										<h3>Nome azienda</h3>
										<input type="text" id="nomeAzienda" placeholder="es. Clientoteca S.r.l.">
									</div>
									<div class="col-sm-4">
										<h3>Email</h3>
										<input type="email" id="email" placeholder="es. mario.rossi@clientoteca.com">
									</div>
								</div>
								<div class="col-sm-12">
									<div class="col-sm-4">
										<!--								<h2>Tipo di attività</h2>-->
										<h3>Settore</h3>
										<select name="mega" id="mega">
											<option selected value="defaultMega">Seleziona settore</option>
											<?php

											include('php/dbconnection.php');

											$sql = "SELECT id,name FROM Mega";
											$result = $conn->query($sql);

											if ($result->num_rows > 0) {
												// output data of each row
												while($row = $result->fetch_assoc()) {
													echo "<option value=\" " . $row['id'] . " \">" . $row['name'] . "</option>";
												}
											} else {
												echo "0 results";
											}

											$conn->close();
											?>
										</select>
									</div>
									<div class="col-sm-4">
										<h3>Attività</h3>
										<select name="macro" id="macro">
											<option selected value="defaultMacro">Seleziona attività</option>
										</select>
									</div>
									<div class="col-sm-4">
										<!--								<h2>Geolocalizzazione</h2>-->
										<h3>Regione</h3>
										<select name="regione" id="regione">
											<option selected value="defaultRegione">Seleziona regione</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<input type="submit" id="trovaClienti" value="Trova Clienti">
							</div>
						</form>
						<div class="col-sm-12">
							<p id="result"></p>
						</div>
					</div>
			</section>
		</article>
	</main>


	<footer class="container-fluid">
		<div class="row">
			<div class="col-sm-4">
				<h3>Servizi offerti</h3>
				<ul class="services">
					<li>Web</li>
					<li>Brochure</li>
					<li>Sondaggi</li>
					<li>Seo</li>
					<li>Newsletter</li>
					<li>Training</li>
				</ul>
			</div>
			<div class="col-sm-4">
				<h3>Clientoteca srl</h3>
				<p>Via S. Caterina 74/D - Arco (TN)</p>
				<p>P.IVA 02401360223</p>
				<ul class="vertical">
					<li><i class="fa fa-facebook-f fa-2x"></i></li>
					<li><i class="fa fa-twitter fa-2x"></i></li>
					<li><i class="fa fa-linkedin fa-2x"></i></li>
				</ul>
			</div>
			<div class="col-sm-4">
				<h3>Privacy policy</h3>
				<a href="//www.iubenda.com/privacy-policy/7817932" class="iubenda-white iubenda-embed" title="Privacy Policy">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
			</div>
		</div>
	</footer>
	
	<!-- SCRIPTS -->
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="js/script.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script src="js/wow.min.js"></script>
       	<script>
       		new WOW().init();
       	</script>
</body>
</html>