<?php

@session_start();

if(!isset($_POST['orderType']) && !isset($_POST['submit'])){
	header("Location: ../../");
	exit();
}

include("../../header.php")
?>

	<section class="section__stampanje">
            <div class="container">
                <h2 class="section__heading">Podaci o isporuci</h2>
            </div>
            <!-- OVDE POCINJE FORMA -->
            <form method="POST" name="orderForm" action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">				
                <div class="form-box">
				<!-- Paragraf za povratnu poruku -->		
				<p style="font-size:2rem; font-style: italic;" id="statusMessage"></p>
				<?php
					if(isset($status)){
						if($status === true){
							if(isset($status) && $status)
								echo '<p id="statusMessage" style="font-size:2rem; font-style: italic; color: green">'.
									htmlspecialchars($statusMessage) . '</p>';							
						}
						else {
							if(isset($statusMessage) && $statusMessage)
								echo '<p id="statusMessage" style="font-size:2rem; font-style: italic; color: red">'.
									htmlspecialchars($statusMessage) . '</p>';						
						}
					}
				?>
                    <!-- UNOS PODATAKA ***************************** -->

					<!-- Adresa isporuka-->
					<label for="deliveryAddress" class="label__heading">Adresa isporuke</label>
					<input class="u-full-width" type="text" placeholder="" name="deliveryAddress" required
                        value="<?php echo isset($_POST['deliveryAddress']) ? $_POST['deliveryAddress'] : '' ?>">
					<!-- ****************************** -->

					<!-- Zip kod isporuka -->
					<label for="deliveryZipCode" class="label__heading">Poštanski broj isporuke</label>
					<input class="u-full-width" type="text" placeholder="" name="deliveryZipCode" required
                        value="<?php echo isset($_POST['deliveryZipCode']) ? $_POST['deliveryZipCode'] : '' ?>">
					<!-- ****************************** -->

					<!-- Mesto isporuke -->
					<label for="deliveryLocation" class="label__heading">Mesto isporuke</label>
					<input class="u-full-width" type="text" placeholder="" name="deliveryLocation" required
                        value="<?php echo isset($_POST['deliveryLocation']) ? $_POST['deliveryLocation'] : '' ?>">
					<!-- ****************************** -->

                    <!-- POSALJI DUGME -->
                    <input class="button-primary" type="submit" value="Pošalji" name="submit">					
                    <p class="uslovi" style="font-size:1.3rem; font-style: italic;">Narudzbinom prihvatam uslove poslovanja.</p>
                </div>
            </form>
        </section>


<?php
include("../../footer.php");
?>