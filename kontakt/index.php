<?php

@session_start();
include("../header.php");

require_once '../functions/mail.php';
require_once '../functions/functions.php';

if(isset($_POST['submit'])) {
	try{
		//$db = new DB();

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
        <!-- Navigation -->
        <div class="twelve columns">
            <ul class="nav1">
                <li>
                    <a class="tile" href="../">
                        <i class="fas fa-home" aria-hidden="true"></i>Početna</a>
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
                            <label for="email" class="label__heading">Vaš email</label>
                            <input class="u-full-width" type="email" placeholder="" name="email" required>
                        </div>
                        <div class="six columns">
                            <label for="nameAndLastName" class="label__heading">Vaše ime i prezime</label>
                            <input class="u-full-width" type="text" placeholder="" name="nameAndLastName" required>
                        </div>
                    </div>
                    <label for="message" class="label__heading">Poruka</label>
                    <textarea class="u-full-width" name="message" placeholder="Slobodno nas kontaktirajte ukoliko imate bilo kakvih pitanja ..."></textarea>
                    <input class="button-primary" type="submit" value="Pošalji" name="submit">
                </form>
            </div>
        </section>

<?php
	include("../footer.php");
?>