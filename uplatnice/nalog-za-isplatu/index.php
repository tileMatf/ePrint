<?php

@session_start();

require_once "../../functions/functions.php";
include('../../header.php');


	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		if(isset($_SESSION['first_log']) && $_SESSION['first_log']){
			unset($_SESSION['first_log']);
			if(isset($_POST['submit']))
				unset($_POST['submit']);
		}
		
		if(isset($_POST['submit'])){
			try{
				echo "<div id='pictureModal' class='picture-modal'>
					 <span class='picture-close'>&times;</span>
					  <img id='pictureContent' class='picture-modal-content' 
						src='../../functions/createPicture.php?". http_build_query($_POST) ."'>
                        <button id='paymentConfirm'>Potvrdi</button>

                        <button id='paymentCancel'>Otkaži</button>
					</div>";
				unset($_POST['submit']);
			} catch(RuntimeException $e){
				return $e->getMessage();
			} 
		}
	}

?>

        <!-- Navigation -->
        <div class="twelve columns">
            <ul class="nav1">
                <li>
                    <a class="tile" href="../../">
                        <i class="fas fa-home" aria-hidden="true"></i>Početna</a>
                </li>
                <span class="line">/</span>
                <li>
                    <a class="tile" href="../">Uplatnice</a>
                </li>
                <span class="line">/</span>
                <li>
                    <a class="tile" href="./" style="font-size: 1.6rem;">Nalog za isplatu</a>
                </li>
            </ul>
        </div>
        <!-- End of navigation -->


        <!--Stampanje section-->
        <section class="section__stampanje">
            <div class="container container-form">
                <h2 class="section__heading">Nalog za isplatu</h2>
				<!-- Loading slika-->
				<img src="../../images/loader.gif" class="gif_image" id="gif_image">
				<!-- Paragraf za povratnu poruku -->		
				<p class='success' id="statusMessage">
					<p id="statusMessage2"></p>
				</p>
				
				<img class="slike-forma" src="../../images/nalog-za-isplatu-slika.png"/> 
            </div>
            <!-- OVDE POCINJE FORMA -->
            <form method="POST" name="orderForm" action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="form-box">
				
                <!-- UNOS PODATAKA ***************************** -->
				<?php 
					if(isset($_GET['orderObject'])){						
						$order = json_decode($_GET['orderObject'], true);
				?>				
					<!--NAME AND SURNAME ******************************-->
                    <label for="payer" class="label__heading">Ime i prezime</label>
                    <input class="u-full-width" type="text" placeholder="" name="payer" 
						value="<?php echo isset($order['Name']) ? $order['Name'] : '' ?>">
                    <!-- ***************************** -->

                    <!--ADRESA ******************************-->
                    <label for="address" class="label__heading">Adresa</label>
                    <input class="u-full-width" type="text" placeholder="" name="address"
						value="<?php echo isset($order['Address']) ? $order['Address'] : '' ?>">
                    <!-- ***************************** -->                    

                    <!--MESTO ******************************-->
                    <label for="location" class="label__heading">Poštanski broj i mesto</label>
                    <input class="u-full-width" type="text" placeholder="" name="location"
						value="<?php echo isset($order['Location']) ? $order['Location'] : '' ?>">
                    <!-- ***************************** -->

                    <!--DRZAVA ******************************-->
                    <label for="country" class="label__heading">Država</label>
                    <input class="u-full-width" type="text" placeholder="" name="country"
						value="<?php echo isset($order['Country']) ? $order['Country'] : '' ?>">
                    <!-- ***************************** -->                    

                    <!--SVRHA UPLATE ******************************-->
                    <label for="purposeOfPayment" class="label__heading">Svrha uplate</label>
                    <input class="u-full-width" type="text" placeholder="" name="purposeOfPayment" 
						value="<?php echo isset($order['PaymentPurpose']) ? $order['PaymentPurpose'] : '' ?>">
                    <!-- ***************************** -->

                    <!--PRIMALAC ******************************-->
                    <label for="recipient" class="label__heading">Primalac</label>
                    <input class="u-full-width" type="text" placeholder="" name="recipient"
						value="<?php echo isset($order['Recipient']) ? $order['Recipient'] : '' ?>">
                    <!-- ***************************** -->

                    <!--SIFRA PLACANJA ******************************-->
                    <label for="paymentCode" class="label__heading">Šifra plaćanja</label>
                    <input class="u-full-width" type="text" placeholder="" name="paymentCode"
						value="<?php echo isset($order['PaymentCode']) ? $order['PaymentCode'] : '' ?>">
                    <!-- ***************************** -->

                    <!--VALUTA ******************************-->
                    <label for="currency" class="label__heading">Valuta</label>
                    <input class="u-full-width" type="text" placeholder="" name="currency" 
						value="<?php echo isset($order['Currency']) ? $order['Currency'] : '' ?>" readonly>
                    <!-- ***************************** -->

                    <!--IZNOS ******************************-->
                    <label for="amount" class="label__heading">Iznos</label>
                    <input class="u-full-width" type="text" placeholder="RSD" name="amount" 
						value="<?php echo isset($order['Amount']) ? $order['Amount'] : '' ?>">
                    <!-- ***************************** -->

                    <!--RACUN PRIMAOCA ******************************-->
                    <label for="accountOfRecipient" class="label__heading">Račun primaoca</label>
                    <input class="u-full-width" type="text" placeholder="" name="accountOfRecipient"
						value="<?php echo isset($order['RecipientAccount']) ? $order['RecipientAccount'] : '' ?>">
                    <!-- ***************************** -->

                    <!--MODEL ******************************-->
                    <label for="mockUp" class="label__heading">Model</label>
                    <input class="u-full-width" type="text" placeholder="" name="mockUp" 
						value="<?php echo isset($order['Model']) ? $order['Model'] : '' ?>">
                    <!-- ***************************** -->

                    <!--POZIV NA BROJ ******************************-->
                    <label for="referenceNumber" class="label__heading">Poziv na broj</label>
                    <input class="u-full-width" type="text" placeholder="" name="referenceNumber" 
						value="<?php echo isset($order['ReferenceNumber']) ? $order['ReferenceNumber'] : '' ?>">
                    <!-- ***************************** -->

                    <!-- Kraj unosa podataka, sledi radio buttons -->

                    <!-- BROJ UPLATNICA U SETU ***************************** -->
                    <label for="" class="label__heading">Broj uplatnica u setu</label>
                    <label for="1plus1">
                        <input type="radio" id="1plus1" name="numOfPaySet" value="1+1" 
							<?php echo (isset($order['PaymentSlipNumber']) && $order['PaymentSlipNumber'] == '1+1') ? "checked" : "" ?> >
                        <span>1+1</span>
                    </label>
                    <label for="1plus2">
                        <input type="radio" id="1plus2" name="numOfPaySet" value="1+2" 
							<?php echo isset($order['PaymentSlipNumber']) && $order['PaymentSlipNumber'] == '1+2' ? "checked" : ""?> >
                        <span>1+2</span>
                    </label>
                    <!-- ***************************** -->

                    <!-- KOLICINA SETOVA -->
                    <label for="quantity" class="label__heading">Količina setova</label>
                    <select class="u-full-width" name="quantity">
                        <option value="100" <?php echo isset($order['SetQuantity']) && $order['SetQuantity'] == '100' ? "selected" : ""?> >100</option>
                        <option value="200" <?php echo isset($order['SetQuantity']) && $order['SetQuantity'] == '200' ? "selected" : ""?>>200</option>
                        <option value="500" <?php echo isset($order['SetQuantity']) && $order['SetQuantity'] == '500' ? "selected" : ""?>>500</option>
                        <option value="900" selected>900</option>
                        <option value="1800" <?php echo isset($order['SetQuantity']) && $order['SetQuantity'] == '1800' ? "selected" : ""?>>1800</option>
                        <option value="2700" <?php echo isset($order['SetQuantity']) && $order['SetQuantity'] == '2700' ? "selected" : ""?>>2700</option>
                        <option value="5400" <?php echo isset($order['SetQuantity']) && $order['SetQuantity'] == '5400' ? "selected" : ""?>>5400</option>
                        <option value="8100" <?php echo isset($order['SetQuantity']) && $order['SetQuantity'] == '8100' ? "selected" : ""?>>8100</option>
                        <option value="10800" <?php echo isset($order['SetQuantity']) && $order['SetQuantity'] == '10800' ? "selected" : ""?>>10800</option>
                    </select>

					<?php
						include("../../delivery_fields.php");
					?>
					
                    <!-- PORUKA -->
                    <label for="message" class="label__heading">Poruka</label>
                    <textarea class="u-full-width" placeholder="Dodatni komentar ..." name="comment"><?php echo isset($order['Comment']) ? $order['Comment'] : ''?></textarea>
                    
					<!-- SLANJE KOPIJE CHECKBOX -->
                    <label class="sendCopy" for="sendCopy">
                        <input type="checkbox" id="sendCopy" name="sendCopy"
							<?php echo isset($order['SendCopy']) && $order['SendCopy'] === '1' ? "checked" : "" ?>>
                        <span class="label-body">Pošalji kopiju sebi</span>
                        <input type="text" placeholder="Upišite Vaš email" id="sendCopyEmail" name="sendCopyEmail"
							value="<?php if(isset($_SESSION['user_info'])) 
											echo $_SESSION['user_info']->Email; 
										else if(isset($_POST['sendCopyEmail'])) 
											echo $_POST['sendCopyEmail']; ?>">
                    </label>
					
					<!-- CUVANJE NARUDZBINE CHECKBOX -->
					<label for="savedOrder">
						<input type="checkbox" name="savedOrder" id="savedOrder" checked>
						<span class="label-body">Sačuvaj narudžbinu</span>
					</label>
					
				<?php	
					} else {
				?>
					
                    <!--NAME AND SURNAME ******************************-->
                    <label for="payer" class="label__heading">Ime i prezime</label>
                    <input class="u-full-width" type="text" placeholder="" name="payer"
						value="<?php echo isset($_POST['payer']) ? $_POST['payer'] : '' ?>" >
                    <!-- ***************************** -->

                    <!--ADRESA ******************************-->
                    <label for="address" class="label__heading">Adresa</label>
                    <input class="u-full-width" type="text" placeholder="" name="address"
						value="<?php echo isset($_POST['address']) ? $_POST['address'] : '' ?>" >
                    <!-- ***************************** -->                    

                    <!--MESTO ******************************-->
                    <label for="location" class="label__heading">Poštanski broj i mesto</label>
                    <input class="u-full-width" type="text" placeholder="" name="location"
						value="<?php echo isset($_POST['location']) ? $_POST['location'] : '' ?>" >
                    <!-- ***************************** -->

                    <!--DRZAVA ******************************-->
                    <label for="country" class="label__heading">Država</label>
                    <input class="u-full-width" type="text" placeholder="" name="country"
						value="<?php echo isset($_POST['country']) ? $_POST['country'] : '' ?>" >
                    <!-- ***************************** --> 
                    
                    <!--SVRHA UPLATE ******************************-->
                    <label for="purposeOfPayment" class="label__heading">Svrha uplate</label>
                    <input class="u-full-width" type="text" placeholder="" name="purposeOfPayment"
						value="<?php echo isset($_POST['purposeOfPayment']) ? $_POST['purposeOfPayment'] : '' ?>" >
                    <!-- ***************************** -->

                    <!--PRIMALAC ******************************-->
                    <label for="recipient" class="label__heading">Primalac</label>
                    <input class="u-full-width" type="text" placeholder="" name="recipient" 
						value="<?php echo isset($_POST['recipient']) ? $_POST['recipient'] : '' ?>" >
                    <!-- ***************************** -->

                    <!--SIFRA PLACANJA ******************************-->
                    <label for="paymentCode" class="label__heading">Šifra plaćanja</label>
                    <input class="u-full-width" type="text" placeholder="" name="paymentCode"
						value="<?php echo isset($_POST['paymentCode']) ? $_POST['paymentCode'] : '' ?>" >
                    <!-- ***************************** -->

                    <!--VALUTA ******************************-->
                    <label for="currency" class="label__heading">Valuta</label>
                    <input class="u-full-width" type="text" placeholder="" name="currency" 
						value="RSD" readonly>
                    <!-- ***************************** -->

                    <!--IZNOS ******************************-->
                    <label for="amount" class="label__heading">Iznos</label>
                    <input class="u-full-width" type="text" placeholder="RSD" name="amount" 
						value="<?php echo isset($_POST['amount']) ? $_POST['amount'] : '' ?>" >
                    <!-- ***************************** -->

                    <!--RACUN PRIMAOCA ******************************-->
                    <label for="accountOfRecipient" class="label__heading">Račun primaoca</label>
                    <input class="u-full-width" type="text" placeholder="" name="accountOfRecipient"
						value="<?php echo isset($_POST['accountOfRecipient']) ? $_POST['accountOfRecipient'] : '' ?>" >
                    <!-- ***************************** -->

                    <!--MODEL ******************************-->
                    <label for="mockUp" class="label__heading">Model</label>
                    <input class="u-full-width" type="text" placeholder="" name="mockUp"
						value="<?php echo isset($_POST['mockUp']) ? $_POST['mockUp'] : '' ?>" >
                    <!-- ***************************** -->

                    <!--POZIV NA BROJ ******************************-->
                    <label for="referenceNumber" class="label__heading">Poziv na broj</label>
                    <input class="u-full-width" type="text" placeholder="" name="referenceNumber"
						value="<?php echo isset($_POST['referenceNumber']) ? $_POST['referenceNumber'] : '' ?>" >
                    <!-- ***************************** -->

                    <!-- Kraj naloga za prenos u setu sledi radio buttons -->

                    <!-- BROJ UPLATNICA U SETU ***************************** --> <!-- SVAKA UPLATNICA OVO IMA DRUGACIJE -->
                    <label for="" class="label__heading">Broj naloga za isplatu u setu</label>
                    <label for="1plus1">
                        <input type="radio" name="numOfPaySet" id="1plus1" value="1+1" 
						<?php echo (isset($_POST['numOfPaySet']) && $_POST['numOfPaySet'] == '1+1') || !isset($_POST['numOfPaySet']) ? "checked" : "" ?> />
                        <span>1+1</span>
                    </label>
                    <label for="1plus2">
                        <input type="radio" name="numOfPaySet" id="1plus2" value="1+2" 
							<?php echo isset($_POST['numOfPaySet']) && $_POST['numOfPaySet'] == '1+2' ? "checked" : ""?> />
                        <span>1+2</span>
                    </label>
                    <!-- ***************************** -->

                    <!-- KOLICINA SETOVA -->
                    <label for="quantity" class="label__heading">Količina setova</label>
                    <select class="u-full-width" name="quantity">
                        <option value="100" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '100' ? "selected" : "" ?>>100</option>
                        <option value="200" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '200' ? "selected" : "" ?>>200</option>
                        <option value="500" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '500' ? "selected" : "" ?>>500</option>
                        <option value="900" selected>900</option>
                        <option value="1800" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '1800' ? "selected" : "" ?>>1800</option>
                        <option value="2700" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '2700' ? "selected" : "" ?>>2700</option>
                        <option value="5400" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '5400' ? "selected" : "" ?>>5400</option>
                        <option value="8100" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '8100' ? "selected" : "" ?>>8100</option>
                        <option value="10800" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '10800' ? "selected" : "" ?>>10800</option>
                    </select>
                    <!-- ***************************** -->
					
					<?php
						include("../../delivery_fields.php");
					?>
                    
                    <!-- PORUKA -->
                    <label for="message" class="label__heading">Poruka</label>
                    <textarea class="u-full-width" placeholder="Dodatni komentar ..." name="comment"><?php echo isset($_POST['comment']) ? $_POST['comment'] : ''?></textarea>
                    
					<!-- SLANJE KOPIJE CHECKBOX -->
                    <label for="sendCopy">
                        <input type="checkbox" name="sendCopy" id="sendCopy"
							<?php echo isset($_POST['sendCopy']) ? 'checked' : ''?>>
                        <span class="label-body">Pošalji kopiju sebi</span>
						<input type="text" placeholder="Upišite Vaš email" id="sendCopyEmail" name="sendCopyEmail"
							value="<?php if(isset($_SESSION['user_info'])) 
											echo $_SESSION['user_info']->Email;
										else if(isset($_POST['sendCopyEmail'])) 
											echo $_POST['sendCopyEmail']; ?>">
                    </label>
					
					<!-- CUVANJE NARUDZBINE CHECKBOX -->
					<?php if(isset($_SESSION['user_info'])) {?>
						<label for="savedOrder">
							<input type="checkbox" name="savedOrder" id="savedOrder" <?php if(isset($_POST['savedOrder'])) echo "checked"; ?>>
							<span class="label-body">Sačuvaj narudžbinu</span>
						</label>
					<?php } ?>
					<?php } ?>
					
					<input name="orderType" type="hidden" id="orderType" value="uplatnice/nalog-za-isplatu">
					<input type="hidden" id="successMessage" value="Nalog za isplatu je uspešno naručen.">
                    <input name="submit" class="button-primary" type="submit" value="Prikaži" />
                    <p class="uslovi" style="font-size:1.3rem; font-style: italic;">Narudžbinom prihvatam uslove poslovanja.</p>
                </div>
            </form>
        </section>
		
<?php
include('../../footer.php');
?>
