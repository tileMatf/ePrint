<?php
@session_start();

include("../../header.php");
require_once '../../functions/functions.php';

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(isset($_SESSION['login']) && isset($_SESSION['submit_processed'])) {
			unset($_POST['submit']);
			unset($_SESSION['submit_processed']);
		} else {
			try{		
				echo "<div id='pictureModal' class='picture-modal'>
					 <span class='picture-close'>&times;</span>
					  <img id='pictureContent' class='picture-modal-content' 
						src='../../functions/createPicture.php?". http_build_query($_POST) . "'>
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
                    <a class="tile" href="../">Koverte, dostavnice, formulari za adresiranje</a>
                </li>
                <span class="line">/</span>
                <li>
                    <a class="tile" href="./" style="font-size: 1.6rem;">Koverte sa dostavnicom za ručno popunjavanje</a>
                </li>
            </ul>
        </div>
        <!-- End of navigation -->


        <!--Stampanje section-->
        <section class="section__stampanje">
			<div class="container container-form">
				<h2 class="section__heading section-heading--smaller">Koverte sa dostavnicom za ručno popunjavanje</h2>
				<!-- Loading slika-->
				<img src="../../images/loader.gif" class="gif_image" id="gif_image">
				<!-- Paragraf za povratnu poruku -->		
				<p style="font-size:2rem; font-style: italic;" id="statusMessage"><p id="statusMessage2"></p></p>
				

            <img class="povratnice-img" src="../../images/koverte-sa-dostavnicom.png"/>
			</div>
            <!-- OVDE POCINJE FORMA ** -->
            <form method="POST" name="orderForm" action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="form-box">				
				<?php 
					if(isset($_GET['orderObject'])){
						$order = json_decode($_GET['orderObject'], true);
				?> 
				<!-- ZA -->
                    <label class="label__heading">Za</label>
                    <label for="Javni izvrsitelj">
                        <input type="radio" id="Javni izvrsitelj" name="forInput" value="Javni izvrsitelj" 
							<?php echo isset($order['Recipient']) && $order['Recipient'] == 'Javni izvrsitelj' ? "checked" : "" ?>>
                        <span>Javni izvršitelj</span>
                    </label>
                    <label for="Javni beleznik">
                        <input type="radio" id="Javni beleznik" name="forInput" value="Javni beleznik" 
							<?php echo isset($order['Recipient']) && $order['Recipient'] == 'Javni beleznik' ? "checked" : ""?>>
                        <span>Javni beležnik</span>
                    </label>

                    <!-- BOJA -->
                    <label class="label__heading">Boja</label>
                    <label for="plava">
                        <input type="radio" id="plava" name="color" value="plava"
							<?php echo (isset($order['Color']) && $order['Color'] == 'plava') ? "checked" : "" ?>>
                        <span>Plave</span>
                    </label>
                    <label for="bela">
                        <input type="radio" id="bela" name="color" value="bela" 
							<?php echo isset($order['Color']) && $order['Color'] == 'bela' ? "checked" : ""?>>
                        <span>Bele</span>
                    </label>

                    <!--Ime i prezime ******************************-->
                    <label for="nameLastname" class="label__heading">Ime i prezime</label>
                    <input name="nameLastname" class="u-full-width" type="text"
						value="<?php echo isset($order['Name']) ? $order['Name'] : '' ?>">
                    <!-- ***************************** -->

                    <!--Ulica ******************************-->
                    <label for="adress" class="label__heading">Ulica</label>
                    <input name="adress" class="u-full-width" type="text"
						value="<?php echo isset($order['Address']) ? $order['Address'] : '' ?>">
                    <!-- ***************************** -->

                    <!--Postanski broj ******************************-->
                    <label for="zipCode" class="label__heading">Postanski broj</label>
                    <input name="zipCode" class="u-full-width" type="text"
						value="<?php echo isset($order['ZipCode']) ? $order['ZipCode'] : '' ?>">
                    <!-- ***************************** -->

                    <!--Mesto ******************************-->
                    <label for="location" class="label__heading">Mesto</label>
                    <input name="location"  class="u-full-width" type="text"
						value="<?php echo isset($order['Location']) ? $order['Location'] : '' ?>">
                    <!-- ***************************** -->


                    <!--Postarina placena kod poste ******************************-->
                    <label for="postagePaid" class="label__heading">Poštarina plaćena kod pošte</label>
                    <input name="postagePaid"  class="u-full-width" type="text"
						value="<?php echo isset($_POST['postagePaid']) ? $_POST['postagePaid'] : '' ?>">
                    <!-- ***************************** -->

                    <!-- S0 ili S5 -->
                    <label class="label__heading">Koverte za lično popunjavanje</label>
                    <label for="zeroEnvelope">
                        <input type="radio" id="zeroEnvelope" name="envelopeType" value="S0" checked 
							<?php echo isset($order['EnvelopeType']) && $order['EnvelopeType'] == 'S0' ? "checked" : "" ?>>
                        <span>S0</span>
                    </label>
                    <label for="fiveEnvelope">
                        <input type="radio" id="fiveEnvelope" name="envelopeType" value="S5" 
							<?php echo isset($order['EnvelopeType']) && $order['EnvelopeType'] == 'S5' ? "checked" : ""?>>
                        <span>S5</span>
                    </label>

                    <!-- Kolicina -->
                    <label for="quantity" class="label__heading">Količina</label>
                    <select class="u-full-width" name="quantity">
                        <option value="1000" selected>1000</option>
                        <option value="2000"  <?php echo isset($order['Quantity']) && $order['Quantity'] == '2000' ? "selected" : ""?>>2000</option>
                        <option value="3000"  <?php echo isset($order['Quantity']) && $order['Quantity'] == '3000' ? "selected" : ""?>>3000</option>
                        <option value="4000"  <?php echo isset($order['Quantity']) && $order['Quantity'] == '4000' ? "selected" : ""?>>4000</option>
                        <option value="5000"  <?php echo isset($order['Quantity']) && $order['Quantity'] == '5000' ? "selected" : ""?>>5000</option>
                        <option value="6000"  <?php echo isset($order['Quantity']) && $order['Quantity'] == '6000' ? "selected" : ""?>>6000</option>
                        <option value="7000"  <?php echo isset($order['Quantity']) && $order['Quantity'] == '7000' ? "selected" : ""?>>7000</option>
                        <option value="8000"  <?php echo isset($order['Quantity']) && $order['Quantity'] == '8000' ? "selected" : ""?>>8000</option>
                        <option value="9000"  <?php echo isset($order['Quantity']) && $order['Quantity'] == '9000' ? "selected" : ""?>>9000</option>
                        <option value="10000"  <?php echo isset($order['Quantity']) && $order['Quantity'] == '10000' ? "selected" : ""?>>10000</option>
                    </select>
                    <!-- ***************************** -->

					<?php
						include("../../delivery_fields.php");
					?>
                    
                    <label class="sendCopy">
                        <input type="checkbox" id="sendCopy" name="sendCopy" 
							<?php echo isset($order['SendCopy']) && $order['SendCopy'] === '1' ? "checked" : ""?>>
                        <span class="label-body">Pošalji kopiju sebi</span>
                        <input type="text" placeholder="Upišite Vas email" id="sendCopyEmail" name="sendCopyEmail" 
							value="<?php if(isset($_SESSION['user_info'])) 
											echo $_SESSION['user_info']->Email;
										else if(isset($_POST['sendCopyEmail'])) 
											echo $_POST['sendCopyEmail'];
										else 
											echo ''; ?>">
                    </label>
					
					<?php } else {?>
					
                    <!-- ZA -->
                    <label class="label__heading">Za</label>
                    <label for="Javni izvrsitelj">
                        <input type="radio" id="Javni izvrsitelj" name="forInput" value="Javni izvrsitelj" 
							<?php echo (isset($_POST['forInput']) && $_POST['forInput'] == 'Javni izvrsitelj') || !isset($_POST['forInput']) ? "checked" : "" ?>>
                        <span>Javni izvršitelj</span>
                    </label>
                    <label for="Javni beleznik">
                        <input type="radio" id="Javni beleznik" name="forInput" value="Javni beleznik" 
							<?php echo isset($_POST['forInput']) && $_POST['forInput'] == 'Javni beleznik' ? "checked" : ""?>>
                        <span>Javni beležnik</span>
                    </label>

                    <!-- BOJA -->
                    <label class="label__heading">Boja</label>
                    <label for="plava">
                        <input type="radio" id="plava" name="color" value="plava"
							<?php echo (isset($_POST['color']) && $_POST['color'] == 'plava') || !isset($_POST['color']) ? "checked" : "" ?>>
                        <span>Plave</span>
                    </label>
                    <label for="bela">
                        <input type="radio" id="bela" name="color" value="bela" 
							<?php echo isset($_POST['color']) && $_POST['color'] == 'bela' ? "checked" : ""?>>
                        <span>Bele</span>
                    </label>

                    <!--Ime i prezime ******************************-->
                    <label for="nameLastname" class="label__heading">Ime i prezime</label>
                    <input name="nameLastname" class="u-full-width" type="text"
						value="<?php echo isset($_POST['nameLastname']) ? $_POST['nameLastname'] : '' ?>">
                    <!-- ***************************** -->

                    <!--Ulica ******************************-->
                    <label for="adress" class="label__heading">Ulica</label>
                    <input name="adress" class="u-full-width" type="text"
						value="<?php echo isset($_POST['adress']) ? $_POST['adress'] : '' ?>">
                    <!-- ***************************** -->

                    <!--Postanski broj ******************************-->
                    <label for="zipCode" class="label__heading">Postanski broj</label>
                    <input name="zipCode" class="u-full-width" type="text"
						value="<?php echo isset($_POST['zipCode']) ? $_POST['zipCode'] : '' ?>">
                    <!-- ***************************** -->

                    <!--Mesto ******************************-->
                    <label for="location" class="label__heading">Mesto</label>
                    <input name="location"  class="u-full-width" type="text"
						value="<?php echo isset($_POST['location']) ? $_POST['location'] : '' ?>">
                    <!-- ***************************** -->


                    <!--Postarina placena kod poste ******************************-->
                    <label for="postagePaid" class="label__heading">Poštarina plaćena kod pošte</label>
                    <input name="postagePaid"  class="u-full-width" type="text"
						value="<?php echo isset($_POST['postagePaid']) ? $_POST['postagePaid'] : '' ?>">
                    <!-- ***************************** -->

                    <!-- S0 ili S5 -->
                    <label class="label__heading">Koverte za lično popunjavanje</label>
                    <label for="zeroEnvelope">
                        <input type="radio" id="zeroEnvelope" name="envelopeType" value="S0" checked 
							<?php echo (isset($_POST['envelopeType']) && $_POST['envelopeType'] == 'S0') || !isset($_POST['envelopeType']) ? "checked" : "" ?>>
                        <span>S0</span>
                    </label>
                    <label for="fiveEnvelope">
                        <input type="radio" id="fiveEnvelope" name="envelopeType" value="S5" 
							<?php echo isset($_POST['envelopeType']) && $_POST['envelopeType'] == 'S5' ? "checked" : ""?>>
                        <span>S5</span>
                    </label>

                    <!-- Kolicina -->
                    <label for="quantity" class="label__heading">Količina</label>
                    <select class="u-full-width" name="quantity">
                        <option value="1000" selected>1000</option>
                        <option value="2000"  <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '2000' ? "selected" : ""?>>2000</option>
                        <option value="3000"  <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '3000' ? "selected" : ""?>>3000</option>
                        <option value="4000"  <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '4000' ? "selected" : ""?>>4000</option>
                        <option value="5000"  <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '5000' ? "selected" : ""?>>5000</option>
                        <option value="6000"  <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '6000' ? "selected" : ""?>>6000</option>
                        <option value="7000"  <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '7000' ? "selected" : ""?>>7000</option>
                        <option value="8000"  <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '8000' ? "selected" : ""?>>8000</option>
                        <option value="9000"  <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '9000' ? "selected" : ""?>>9000</option>
                        <option value="10000"  <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '10000' ? "selected" : ""?>>10000</option>
                    </select>
                    <!-- ***************************** -->
                    
					<?php
						include("../../delivery_fields.php");
					?>
                    
                    <label class="sendCopy">
                        <input type="checkbox" id="sendCopy" name="sendCopy" <?php echo isset($_POST['sendCopy']) ? "checked" : ""?>>
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
					<input type="hidden" name="orderType" id="orderType" value="koverte-dostavnice-formulari/koverte-sa-dostavnicom">
					<input type="hidden" id="successMessage" value="Koverte sa dostavnicom su uspešno naručene.">
                    <input class="button-primary" type="submit" value="Prikaži" name="submit">
                    <p class="uslovi" style="font-size:1.3rem; font-style: italic;">Narudzbinom prihvatam uslove poslovanja.</p> 
                </div>
            </form>
        </section>

<?php
	include("../../footer.php");
?>