<?php

@session_start();

include("../../header.php");
require_once "../../functions/functions.php";

	if(isset($_POST['submit'])) {
		if(isset($_SESSION['login']) && $_SESSION['login'] === true) {
			unset($_POST['submit']);
			unset($_SESSION['login']);
		} else {
			try{
				echo "<div id='pictureModal' class='picture-modal'>
						<span class='picture-close'>&times;</span>
							<img id='pictureContent' class='picture-modal-content' 
							src='../../functions/createPicture.php?". http_build_query($_POST) ."'>
						<button id='paymentConfirm'>Potvrdi</button>
					</div>";
			} catch(RuntimeException $e){
				return $e->getMessage();
			} 
		}
	}
	
	if(isset($_SESSION['orderSaved'])){
		if($_SESSION['orderSaved'] == 1){
			unset($_POST);
			$_POST = array();
			$_SESSION['orderSaved'] = null;
			unset($_SESSION['orderSaved']);
		} else if($_SESSION['orderSaved'] == 2){
//			$status = false;
//			$statusMessage = "Došlo je do greške prilikom upisa u bazu, pokušajte ponovo.";
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
                    <a class="tile" href="./" style="font-size: 1.6rem;">Nalog za prenos</a>
                </li>
            </ul>
        </div>
        <!-- End of navigation -->


        <!--Stampanje section-->
        <section class="section__stampanje">
            <div class="container container-form">
                <h2 class="section__heading">Nalog za prenos</h2>
				<!-- Loading slika-->
				<img src="../../images/loader.gif" class="gif_image" id="gif_image">
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
				
                <img class="slike-forma" src="../../images/nalog-za-prenos-slika.png"/> 
            </div>
            <!-- OVDE POCINJE FORMA -->
            <form method="POST" name="orderForm" action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="form-box">
				
                <!-- UNOS PODATAKA ***************************** -->
				<?php 
					if(isset($_POST['orderObject'])){
						$order = json_decode($_POST['orderObject'], true);
				?> 
					<!--NAME AND SURNAME ******************************-->
                    <label for="payer" class="label__heading">Ime i prezime nalogodavca</label>
                    <input class="u-full-width" type="text" placeholder="" name="payer" 
						<?php echo isset($order['Name']) ? "value=\"".$order['Name']."\"" : '' ?> >
                    <!-- ***************************** -->

                    <!--ADRESA ****************************** -->
                    <label for="address" class="label__heading">Ulica i broj nalogodavca</label>
                    <input class="u-full-width" type="text" placeholder="" name="address"
						<?php echo isset($order['Address']) ? "value=\"".$order['Address']."\"" : '' ?> >
                    <!-- ***************************** -->                    

                    <!--MESTO ******************************-->
                    <label for="location" class="label__heading">Poštanski broj i mesto</label>
                    <input class="u-full-width" type="text" placeholder="" name="location"
						<?php echo isset($order['Location']) ? "value=\"".$order['Location']."\"" : '' ?> >
                    <!-- ***************************** -->

                    <!--DRZAVA ******************************-->
                    <label for="country" class="label__heading">Država</label>
                    <input class="u-full-width" type="text" placeholder="" name="country"
						<?php echo isset($order['Country']) ? "value=\"".$order['Country']."\"" : '' ?> >
                    <!-- ***************************** --> 
                    
                    <!--SVRHA UPLATE ******************************-->
                    <label for="purposeOfPayment" class="label__heading">Svrha uplate</label>
                    <input class="u-full-width" type="text" placeholder="" name="purposeOfPayment"
						<?php echo isset($order['PaymentPurpose']) ? "value=\"".$order['PaymentPurpose']."\"" : '' ?> >
                    <!-- ***************************** -->

                    <!--PRIMALAC ******************************-->
                    <label for="recipient" class="label__heading">Primalac</label>
                    <input class="u-full-width" type="text" placeholder="" name="recipient"
						<?php echo isset($order['Recipient']) ? "value=\"".$order['Recipient']."\"" : '' ?> >
                    <!-- ***************************** -->

                    <!--SIFRA PLACANJA ******************************-->
                    <label for="paymentCode" class="label__heading">Šifra plaćanja</label>
                    <input class="u-full-width" type="text" placeholder="" name="paymentCode"
						<?php echo isset($order['PaymentCode']) ? "value=\"".$order['PaymentCode']."\"" : '' ?>>
                    <!-- ***************************** -->

                    <!--VALUTA ******************************-->
                    <label for="currency" class="label__heading">Valuta</label>
                    <input class="u-full-width" type="text" placeholder="" name="currency"
						<?php echo isset($order['Currency']) ? "value=\"".$order['Currency']."\"" : '' ?> readonly>
                    <!-- ***************************** -->

                    <!--IZNOS ******************************-->
                    <label for="amount" class="label__heading">Iznos</label>
                    <input class="u-full-width" type="text" placeholder="RSD" name="amount"
						<?php echo isset($order['Amount']) ? "value=\"".$order['Amount']."\"" : '' ?> >
                    <!-- ***************************** -->

                    <!--RACUN PRIMAOCA ******************************-->
                    <label for="accountOfOrderer" class="label__heading">Račun nalogodavca</label>
                    <input class="u-full-width" type="text" placeholder="" name="accountOfOrderer"
						<?php echo isset($order['OrdererAccount']) ? "value=\"".$order['OrdererAccount']."\"" : '' ?>>
                    <!-- ***************************** -->

                    <!--MODEL ******************************-->
                    <label for="mockUpDebit" class="label__heading">Model (zaduženje)</label>
                    <input class="u-full-width" type="text" placeholder="" name="mockUpDebit"
						<?php echo isset($order['ModelDebit']) ? "value=\"".$order['ModelDebit']."\"" : '' ?> >
                    <!-- ***************************** -->

                    <!--POZIV NA BROJ ZADUZENJA ******************************--> <!-- OVO JE DRUGACIJE OD DRUGE DVE UPLATNICE -->
                    <label for="referenceNumber" class="label__heading">Poziv na broj zaduženja</label> <!-- referenceNumberObligation -->
                    <input class="u-full-width" type="text" placeholder="" name="referenceNumber"
						<?php echo isset($order['ReferenceNumber']) ? "value=\"".$order['ReferenceNumber']."\"" : '' ?>>
                    <!-- ***************************** -->

                    <!--RACUN PRIMAOCA ******************************-->
                    <label for="accountOfRecipient" class="label__heading">Račun primaoca</label>
                    <input class="u-full-width" type="text" placeholder="" name="accountOfRecipient"
						<?php echo isset($order['RecipientAccount']) ? "value=\"".$order['RecipientAccount']."\"" : '' ?>>
                    <!-- ***************************** -->

                    <!--MODEL ******************************-->
                    <label for="mockUpApproval" class="label__heading">Model (odobrenje)</label>
                    <input class="u-full-width" type="text" placeholder="" name="mockUpApproval"
						<?php echo isset($order['ModelApproval']) ? "value=\"".$order['ModelApproval']."\"" : '' ?>>
                    <!-- ***************************** -->

                    <!--POZIV NA BROJ ODOBRENJA ******************************-->
                    <label for="referenceNumberApprovals" class="label__heading">Poziv na broj odobrenja</label>
                    <input class="u-full-width" type="text" placeholder="" name="referenceNumberApprovals"
						<?php echo isset($order['ReferenceNumberApprovals']) ? "value=\"".$order['ReferenceNumberApprovals']."\"" : '' ?>>
                    <!-- ***************************** -->

                    <!-- Kraj naloga za prenos u setu sledi radio buttons -->

                    <!-- BROJ UPLATNICA U SETU ***************************** -->
                    <label for="" class="label__heading">Broj naloga za prenos u setu</label>
                    <label for="1+1"> <!-- number of transfer orders in set -->
                        <input type="radio" name="numOfPaySet" value="1+1" id="1+1"
							<?php echo (isset($order['PaymentSlipNumber']) && $order['PaymentSlipNumber'] == '1+1') ? "checked" : "" ?>>
                        <span>1+1</span>
                    </label>
                    <label for="1+2">
                        <input type="radio" name="numOfPaySet" value="1+2" id="1+2"
							<?php echo isset($order['PaymentSlipNumber']) && $order['PaymentSlipNumber'] == '1+2' ? "checked" : ""?> >
                        <span>1+2</span>
                    </label>
                    <!-- ***************************** -->

                    <!-- KOLICINA SETOVA --> <!-- -->
                    <label for="quantity" class="label__heading">Količina setova</label>
                    <select class="u-full-width" name="quantity">
                        <option value="100" <?php echo isset($order['SetQuantity']) && $order['SetQuantity'] == '100' ? "selected" : "" ?>>100</option>
                        <option value="200" <?php echo isset($order['SetQuantity']) && $order['SetQuantity'] == '200' ? "selected" : "" ?>>200</option>
                        <option value="500" <?php echo isset($order['SetQuantity']) && $order['SetQuantity'] == '500' ? "selected" : "" ?>>500</option>
                        <option value="900" selected>900</option>
                        <option value="1800" <?php echo isset($order['SetQuantity']) && $order['SetQuantity'] == '1800' ? "selected" : "" ?>>1800</option>
                        <option value="2700" <?php echo isset($order['SetQuantity']) && $order['SetQuantity'] == '2700' ? "selected" : "" ?>>2700</option>
                        <option value="5400" <?php echo isset($order['SetQuantity']) && $order['SetQuantity'] == '5400' ? "selected" : "" ?>>5400</option>
                        <option value="8100" <?php echo isset($order['SetQuantity']) && $order['SetQuantity'] == '8100' ? "selected" : "" ?>>8100</option>
                        <option value="10800" <?php echo isset($order['SetQuantity']) && $order['SetQuantity'] == '10800' ? "selected" : "" ?>>10800</option>
                    </select>
                    <!-- ***************************** -->

					<?php
						include("../../delivery_fields.php");
					?>
                    
                    <!--Krajnja poruka-->
                    <label for="message" class="label__heading">Poruka</label>
                    <textarea class="u-full-width" placeholder="Dodatni komentar ..." name="comment"><?php echo isset($order['Comment']) ? $order['Comment'] : ''?></textarea>
                    <!-- Varijabilni podaci i prihvatam uslove
                    <label for="varData">
                        <input type="checkbox" name="varData" id="varData" 
							<?php //echo isset($order['VariableData']) && $order['VariableData'] === '1' ? 'checked' : ''?>>
                        <span class="label-body">Varijabilni podaci</span>
                    </label> -->
                    <label for="sendCopy">
                        <input type="checkbox" name="sendCopy" id="sendCopy"
							<?php echo isset($order['SendCopy']) && $order['SendCopy'] === '1' ? 'checked' : ''?>>
                        <span class="label-body">Pošalji kopiju sebi</span>
						<input type="text" placeholder="Upišite Vas email" id="sendCopyEmail" name="sendCopyEmail"
							value="<?php if(isset($_SESSION['user_info'])) 
											echo $_SESSION['user_info']->Email;
										else if(isset($_POST['sendCopyEmail'])) 
											echo $_POST['sendCopyEmail'];
										else 
											echo ''; ?>">
                    </label>
					
					<?php
						} else {
					?>
                    <!--NAME AND SURNAME ******************************-->
                    <label for="payer" class="label__heading">Ime i prezime nalogodavca</label>
                    <input class="u-full-width" type="text" placeholder="" name="payer" 
						<?php echo isset($_POST['payer']) ? "value=\"".$_POST['payer']."\"" : '' ?> >
                    <!-- ***************************** -->

                    <!--ADRESA ******************************-->
                    <label for="address" class="label__heading">Ulica i broj nalogodavca</label>
                    <input class="u-full-width" type="text" placeholder="" name="address"
						<?php echo isset($_POST['address']) ? "value=\"".$_POST['address']."\"" : '' ?> >
                    <!-- ***************************** -->                    

                    <!--MESTO ******************************-->
                    <label for="location" class="label__heading">Poštanski broj i mesto</label>
                    <input class="u-full-width" type="text" placeholder="" name="location"
						<?php echo isset($_POST['location']) ? "value=\"".$_POST['location']."\"" : '' ?> >
                    <!-- ***************************** -->

                    <!--DRZAVA ******************************-->
                    <label for="country" class="label__heading">Država</label>
                    <input class="u-full-width" type="text" placeholder="" name="country"
						<?php echo isset($_POST['country']) ? "value=\"".$_POST['country']."\"" : '' ?> >
                    <!-- ***************************** --> 
                    
                    <!--SVRHA UPLATE ******************************-->
                    <label for="purposeOfPayment" class="label__heading">Svrha uplate</label>
                    <input class="u-full-width" type="text" placeholder="" name="purposeOfPayment"
						<?php echo isset($_POST['purposeOfPayment']) ? "value=\"".$_POST['purposeOfPayment']."\"" : '' ?> >
                    <!-- ***************************** -->

                    <!--PRIMALAC ******************************-->
                    <label for="recipient" class="label__heading">Primalac</label>
                    <input class="u-full-width" type="text" placeholder="" name="recipient"
						<?php echo isset($_POST['recipient']) ? "value=\"".$_POST['recipient']."\"" : '' ?> >
                    <!-- ***************************** -->

                    <!--SIFRA PLACANJA ******************************-->
                    <label for="paymentCode" class="label__heading">Šifra plaćanja</label>
                    <input class="u-full-width" type="text" placeholder="" name="paymentCode"
						<?php echo isset($_POST['paymentCode']) ? "value=\"".$_POST['paymentCode']."\"" : '' ?>>
                    <!-- ***************************** -->

                    <!--VALUTA ******************************-->
                    <label for="currency" class="label__heading">Valuta</label>
                    <input class="u-full-width" type="text" placeholder="" name="currency"
						value="RSD" readonly>
                    <!-- ***************************** -->

                    <!--IZNOS ******************************-->
                    <label for="amount" class="label__heading">Iznos</label>
                    <input class="u-full-width" type="text" placeholder="RSD" name="amount"
						<?php echo isset($_POST['amount']) ? "value=\"".$_POST['amount']."\"" : '' ?> >
                    <!-- ***************************** -->

                    <!--RACUN PRIMAOCA ******************************-->
                    <label for="accountOfOrderer" class="label__heading">Račun nalogodavca</label>
                    <input class="u-full-width" type="text" placeholder="" name="accountOfOrderer"
						<?php echo isset($_POST['accountOfOrderer']) ? "value=\"".$_POST['accountOfOrderer']."\"" : '' ?>>
                    <!-- ***************************** -->

                    <!--MODEL ******************************-->
                    <label for="mockUpDebit" class="label__heading">Model (zaduženje)</label>
                    <input class="u-full-width" type="text" placeholder="" name="mockUpDebit"
						<?php echo isset($_POST['mockUpDebit']) ? "value=\"".$_POST['mockUpDebit']."\"" : '' ?> >
                    <!-- ***************************** -->

                    <!--POZIV NA BROJ ZADUZENJA ******************************--> <!-- OVO JE DRUGACIJE OD DRUGE DVE UPLATNICE -->
                    <label for="referenceNumber" class="label__heading">Poziv na broj zaduženja</label> <!-- referenceNumberObligation -->
                    <input class="u-full-width" type="text" placeholder="" name="referenceNumber"
						<?php echo isset($_POST['referenceNumber']) ? "value=\"".$_POST['referenceNumber']."\"" : '' ?>>
                    <!-- ***************************** -->

                    <!--RACUN PRIMAOCA ******************************-->
                    <label for="accountOfRecipient" class="label__heading">Račun primaoca</label>
                    <input class="u-full-width" type="text" placeholder="" name="accountOfRecipient"
						<?php echo isset($_POST['accountOfRecipient']) ? "value=\"".$_POST['accountOfRecipient']."\"" : '' ?>>
                    <!-- ***************************** -->

                    <!--MODEL ******************************-->
                    <label for="mockUpApproval" class="label__heading">Model (odobrenje)</label>
                    <input class="u-full-width" type="text" placeholder="" name="mockUpApproval"
						<?php echo isset($_POST['mockUpApproval']) ? "value=\"".$_POST['mockUpApproval']."\"" : '' ?>>
                    <!-- ***************************** -->

                    <!--POZIV NA BROJ ODOBRENJA ******************************-->
                    <label for="referenceNumberApprovals" class="label__heading">Poziv na broj odobrenja</label>
                    <input class="u-full-width" type="text" placeholder="" name="referenceNumberApprovals"
						<?php echo isset($_POST['referenceNumberApprovals']) ? "value=\"".$_POST['referenceNumberApprovals']."\"" : '' ?>>
                    <!-- ***************************** -->

                    <!-- Kraj naloga za prenos u setu sledi radio buttons -->

                    <!-- BROJ UPLATNICA U SETU ***************************** -->
                    <label for="" class="label__heading">Broj naloga za prenos u setu</label>
                    <label for="1+1"> <!-- number of transfer orders in set -->
                        <input type="radio" name="numOfPaySet" value="1+1" id="1+1"
							<?php echo (isset($_POST['numOfPaySet']) && $_POST['numOfPaySet'] == '1+1') || !isset($_POST['numOfPaySet']) ? "checked" : "" ?>>
                        <span>1+1</span>
                    </label>
                    <label for="1+2">
                        <input type="radio" name="numOfPaySet" value="1+2" id="1+2"
							<?php echo isset($_POST['numOfPaySet']) && $_POST['numOfPaySet'] == '1+2' ? "checked" : ""?> >
                        <span>1+2</span>
                    </label>
                    <!-- ***************************** -->

                    <!-- KOLICINA SETOVA --> <!-- -->
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
                    
                    <!--Krajnja poruka-->
                    <label for="message" class="label__heading">Poruka</label>
                    <textarea class="u-full-width" placeholder="Dodatni komentar ..." name="comment"><?php echo isset($_POST['comment']) ? $_POST['comment'] : ''?></textarea>
                    <!-- Varijabilni podaci i prihvatam uslove
                    <label for="varData">
                        <input type="checkbox" name="varData" id="varData" 
							<?php //echo isset($_POST['varData']) ? 'checked' : ''?>>
                        <span class="label-body">Varijabilni podaci</span>
                    </label> -->
                    <label for="sendCopy">
                        <input type="checkbox" name="sendCopy" id="sendCopy"
							<?php echo isset($_POST['sendCopy']) ? 'checked' : ''?>>
                        <span class="label-body">Pošalji kopiju sebi</span>
						<input type="text" placeholder="Upišite Vas email" id="sendCopyEmail" name="sendCopyEmail"
							value="<?php if(isset($_SESSION['user_info'])) 
											echo $_SESSION['user_info']->Email;
										else if(isset($_POST['sendCopyEmail'])) 
											echo $_POST['sendCopyEmail'];
										else 
											echo ''; ?>">
                    </label>
					<?php if(isset($_SESSION['user_info'])) {?> 
						<label for="savedOrder">
							<input type="checkbox" name="savedOrder" id="savedOrder" <?php echo isset($_POST['savedOrder']) ? 'checked' : ''?>>
							<span class="label-body">Prikaži u sačuvanim narudžbinama</span>
						</label>
					<?php }?>
					<?php }?>
					<input type="hidden" name="orderType" id="orderType" value="uplatnice/nalog-za-prenos">
					<input type="hidden" id="successMessage" value="Nalog za prenos je uspešno naručen.">
                    <input class="button-primary" type="submit" value="Prikaži" name="submit">
                    <p class="uslovi" style="font-size:1.3rem; font-style: italic;">Narudzbinom prihvatam uslove poslovanja.</p>
                </div>
            </form>
        </section>

<?php
	include("../../footer.php");
?>