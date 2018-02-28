<?php

require_once "../connection.php";
require_once '../mail.php';

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if(isset($_POST['submit'])) {
	try{
		//$db = new DB();

		date_default_timezone_set('Europe/Belgrade');
		$status = 0;
		
		$message = 
			"<html>
				<head><title> </title></head>
				<body>
					<label> Korisnik: </label> ".test_input($_POST['email'])." </br>
					<label> Ime i prezime korisnika: </label> ".test_input($_POST['nameAndLastName'])." </br>
					<label> Datum: </label> ".date("d.m.Y.")." </br>
					<label> Vreme: </label> ".date("h:i")." </br>
					<label> Tip: </label> Pitanje korisnika </br>
					<label> Pitanje/komentar: </label> ". nl2br(test_input($_POST['message']))." </br>
				</body>
			</html>";

		$status = sendMail($message);
		
		if($status === true)
			$statusMessage = "Vaša poruka je poslata.";
		else
			$statusMessage = "Oprostite došlo je do greške prilikom slanja poruke. Molim Vas, pokušajte ponovo.";
	} catch(RuntimeException $e){
		return $e->getMessage();
	} 
}
?>

<!DOCTYPE html>
<html class="no-js" lang="sr">

<head>
    <meta charset="UTF-8">
    <title>ePrint</title>
    <!--Meta tags-->
    <meta name="description" content="Usluge se sastoje od pripreme za štampu, štampe, pečatiranja, kovertiranja, i otpremanja na poštu ili drugom dostavljaču.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Font from Google-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600&amp;subset=latin-ext" rel="stylesheet" type="text/css">
    <!--CSS files-->
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/skeleton.css">
    <link rel="stylesheet" href="../css/style.css">
    <!--Favicon-->
    <link rel="icon" type="image/png" href="../images/favicon.png">
    <link rel="apple-touch-icon" href="../images/icon.png">
    <!--FA icons-->
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
</head>

<body>
    <div class="container container__main shadow">
        <!--HEADER-->
        <header>
            <div class="row">
                <div class="six columns">
                    <a href="../">
                        <img class="logo" src="../images/eprint1.png" />
                    </a>
                </div>
                <!--NAVIGATION-->
                <div class="six columns navigation__header">
                    <div class="navigation__header--nav">
                        <ul class="nav">
                            <li>
                                <a href="#">Registruj se
                                    <i class="fas fa-user-plus" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">Uloguj se
                                    <i class="fas fa-user" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--end of second one-half column-->
            </div>
            <!--end of row-->
        </header>

        <!-- Navigation -->
        <div class="twelve columns">
            <ul class="nav1">
                <li>
                    <a class="tile" href="../">
                        <i class="fas fa-home" aria-hidden="true"></i>Pocetna</a>
                </li>
                <span class="line">/</span>
                <li>
                    <a class="tile" href="./" style="font-size: 1.6rem;">Kontakt</a>
                </li>
            </ul>
        </div>
        <!-- End of navigation -->

        <!--MAIN PAGE SECTION-->
        <section class="section__main">
            <div class="row">
                <h2 class="section__heading">Kontakt</h2>
            </div>
            <!--Kontakt-->
            <div class="container">
                <form method="POST" action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
				<!-- Paragraf za povratnu poruku -->		
					<?php
						if(isset($status)){
							if($status === true)
								echo '<p id="statusMessage" style="font-size:1.8rem; font-style: italic; color: green">'.
									htmlspecialchars($statusMessage) . '</p>';
							else
								echo '<p id="statusMessage" style="font-size:1.8rem; font-style: italic; color: red">'.
									htmlspecialchars($statusMessage) . '</p>';
						}
					?> 
                    <div class="row">
                        <div class="six columns">
                            <label for="email" class="label__heading">Vas email</label>
                            <input class="u-full-width" type="email" placeholder="" name="email" required>
                        </div>
                        <div class="six columns">
                            <label for="nameAndLastName" class="label__heading">Vase ime i prezime</label>
                            <input class="u-full-width" type="text" placeholder="" name="nameAndLastName" required>
                        </div>
                    </div>
                    <label for="message" class="label__heading">Poruka</label>
                    <textarea class="u-full-width" name="message" placeholder="Slobodno nas kontaktirajte ukoliko imate bilo kakvih pitanja ..."></textarea>
                    <input class="button-primary" type="submit" value="Posalji" name="submit">
                </form>
            </div>
        </section>





        <!--Footer-->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="one-half column">
                        <p>26232 Pančevo, Matije Gupca 24</p>
                    </div>
                    <div class="one-half column">
                        <p>065 983 983 8</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

</body>

</html>