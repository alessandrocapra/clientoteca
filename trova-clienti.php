<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/stile.css">
</head>
<body>
	<header class="container-fluid">
		<div class="row">
			<div id="logo" class="col-sm-4">
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

		<article class="container-fluid">
			<h1 class="titolo">Come funziona Clientoteca</h1>
			<section class="row services">

				<div class="col-sm-12">
					<?php
					$servername = "localhost";
					$username = "clientoteca";
					$password = "clientoteca";
					$dbname = "clientoteca";

					// Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);

					// Check connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}

					// Insert data
//					$sql = "INSERT INTO prova (id, name)
//VALUES (NULL, 'John')";
//
//					if ($conn->query($sql) === TRUE) {
//						echo "New record created successfully";
//					} else {
//						echo "Error: " . $sql . "<br>" . $conn->error;
//					}

					// Retrieve data
					$sql = "select sum(numero_totale) from RegioneMicroJunction where regione_id = 21 and micro_id in (select id from Micro where macro_id in (select customer_id from MacroJunction where macro_id = 103));
";

					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
//							echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
							echo $row["sum(numero_totale)"]. "<br>";
						}
					} else {
						echo "0 results";
					}

					$conn->close();

					?>
				</div>

				<div class="col-sm-2 col-sm-offset-1">
					<div class="circle">1</div>
					<p>Seleziona il settore in cui operi</p>
				</div>
				<div class="col-sm-2">
					<div class="circle">2</div>
					<p>Affina la ricerca definendo il tuo settore operativo</p>
				</div>
				<div class="col-sm-2">
					<div class="circle">3</div>
					<p>Scegli l'area di tuo interesse</p>
				</div>
				<div class="col-sm-2">
					<div class="circle">4</div>
					<p>Inserisci i tuoi contatti per ricevere i dati richiesti</p>
				</div>
				<div class="col-sm-2">
					<div class="circle">5</div>
					<p>Ricevi i dati direttamente nella tua casella email!</p>
				</div>
			</section>
			<section class="row tabella">
				<h1 class="titolo">Trova nuovi potenziali clienti!</h1>
				<div class="col-sm-3 col-sm-offset-1">
					<div class="row">
						<form action="">
							<div class="col-sm-12">
								<h2>Tipo di attività</h2>
                                <h3>Settore</h3>
                                <select name="" id="settore">
                                    <option value="primo">primo</option>
                                    <option value="secondo">secondo</option>
                                    <option value="terzo">terzo</option>
                                    <option value="quarto">quarto</option>
                                </select>
							</div>
							<div class="col-sm-12">
                                <h3>Microsettore</h3>
                                <select name="" id="microsettore">
                                    <option value="primo">primo</option>
                                    <option value="secondo">secondo</option>
                                    <option value="terzo">terzo</option>
                                    <option value="quarto">quarto</option>
                                </select>
							</div>
						</form>	
					</div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h2>Geolocalizzazione</h2>
                            <h3>Regione</h3>
                            <select name="" id="regione">
                                <option value="primo">Tutte le regioni</option>
                                <option value="secondo">Abruzzo</option>
                                <option value="terzo">Marche</option>
                                <option value="quarto">Molise</option>
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <h3>Comune</h3>
                            <select name="" id="comune">
                                <option value="primo">Tutti i comuni</option>
                                <option value="secondo">Borgo Valsugana</option>
                                <option value="terzo">Trento</option>
                                <option value="quarto">Rovereto</option>
                            </select>

                            <input type="submit" value="Cerca clienti!">
                        </div>

                    </div>
                </div>
				<div class="col-sm-8">
					<section class="risultati">
						<h1 class="titolo">Risultati</h1>
						<div class="col-sm-4 col-sm-offset-2">
							<h2>300</h2>
							<p>potenziali clienti</p>
						</div>
						<div class="col-sm-4">
							<h2>320</h2>
							<p>mail di contatto</p>
						</div>
					</section>		
				</div>
			</section>
		</article>
	</main>


	<footer class="container-fluid">
		<div class="row">
			<div class="col-sm-4">
				<h3>Lista di qualcosa</h3>
				<ul>
					<li>Primo</li>
					<li>Secondo</li>
					<li>Terzo</li>
					<li>Quarto</li>
				</ul>
			</div>
			<div class="col-sm-4">
				<h3>Clientoteca srl</h3>
				<p>Via S. Caterina 64 - Arco (TN)</p>
				<ul class="vertical">
					<li><i class="fa fa-facebook-f fa-2x"></i></li>
					<li><i class="fa fa-twitter fa-2x"></i></li>
					<li><i class="fa fa-linkedin fa-2x"></i></li>
				</ul>
			</div>
			<div class="col-sm-4">
				<h3>Cosa mettiamo qui?</h3>
				<p>Potrebbe esserci qualche link a qualche contenuto del sito, altrimenti ci piazzo la cookie e privacy policy.</p>
			</div>
		</div>
	</footer>
	
	<!-- SCRIPTS -->
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script src="js/wow.min.js"></script>
       	<script>
       		new WOW().init();
       	</script>
</body>
</html>