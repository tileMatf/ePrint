<?php
@session_start();

include("../../header.php");
require_once '../../functions/functions.php';

	

	if(isset($_POST['submit'])) {
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
			//unset($_POST);
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
                    <a class="tile" href="./" style="font-size: 1.6rem;">Formulari za adresiranje</a>
                </li>
            </ul>
        </div>
        <!-- End of navigation -->


        <!--Stampanje section-->
        <section class="section__stampanje">
			<div class="container container-form">
				<h2 class="section__heading">Formulari za adresiranje</h2>
				<!-- Loading slika -->
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
			<img class="slike-forma" src="../../images/formulari-za-adresiranje1.png"/>	
			</div>
			
            <!-- OVDE POCINJE FORMA ** -->
            <form method="POST" name="orderForm" action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" name="orderForm">
                <div class="form-box">				
				<?php 
					if(isset($_POST['orderObject'])){
						$order = json_decode($_POST['orderObject'], true);
				?>
				<!-- Kolicina -->
                    <label for="quantity" class="label__heading">Količina</label>
                    <select class="u-full-width" name="quantity">
                        <option value="1000" selected>1000</option>
                        <option value="2000" <?php echo isset($order['Quantity']) && $order['Quantity'] == '2000' ? "selected" : ""?>>2000</option>
                        <option value="3000" <?php echo isset($order['Quantity']) && $order['Quantity'] == '3000' ? "selected" : ""?>>3000</option>
                        <option value="4000" <?php echo isset($order['Quantity']) && $order['Quantity'] == '4000' ? "selected" : ""?>>4000</option>
                        <option value="5000" <?php echo isset($order['Quantity']) && $order['Quantity'] == '5000' ? "selected" : ""?>>5000</option>
                        <option value="6000" <?php echo isset($order['Quantity']) && $order['Quantity'] == '6000' ? "selected" : ""?>>6000</option>
                        <option value="7000" <?php echo isset($order['Quantity']) && $order['Quantity'] == '7000' ? "selected" : ""?>>7000</option>
                        <option value="8000" <?php echo isset($order['Quantity']) && $order['Quantity'] == '8000' ? "selected" : ""?>>8000</option>
                        <option value="9000" <?php echo isset($order['Quantity']) && $order['Quantity'] == '9000' ? "selected" : ""?>>9000</option>
                        <option value="10000" <?php echo isset($order['Quantity']) && $order['Quantity'] == '10000' ? "selected" : ""?>>10000</option>
                    </select>
                    <!-- ***************************** -->
					
					<!-- Vrsta formulara-->
					<label class="label__heading">Tip</label>
                    <label for="S5">
                        <input type="radio" name="typeOfEnvelope" id="S5" value="S5" 
							<?php echo isset($order['Type']) && $order['Type'] == 'S5' ? "checked" : "" ?>>
                        <span>S5</span>
                    </label>
	                <label for="S6">
                        <input type="radio" name="typeOfEnvelope" id="S6" value="S6" 
							<?php echo isset($order['Type']) && $order['Type'] == 'S6' ? "checked" : "" ?>>
                        <span>S6</span>
                    </label>
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
					
					<?php } else { ?>
				
                    <!-- Kolicina -->
                    <label for="quantity" class="label__heading">Količina</label>
                    <select class="u-full-width" name="quantity">
                        <option value="1000" selected>1000</option>
                        <option value="2000" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '2000' ? "selected" : ""?>>2000</option>
                        <option value="3000" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '3000' ? "selected" : ""?>>3000</option>
                        <option value="4000" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '4000' ? "selected" : ""?>>4000</option>
                        <option value="5000" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '5000' ? "selected" : ""?>>5000</option>
                        <option value="6000" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '6000' ? "selected" : ""?>>6000</option>
                        <option value="7000" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '7000' ? "selected" : ""?>>7000</option>
                        <option value="8000" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '8000' ? "selected" : ""?>>8000</option>
                        <option value="9000" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '9000' ? "selected" : ""?>>9000</option>
                        <option value="10000" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '10000' ? "selected" : ""?>>10000</option>
                    </select>
                    <!-- ***************************** -->
					
					<!-- Vrsta formulara-->
					<label class="label__heading">Tip</label>
                    <label for="S5">
                        <input type="radio" name="typeOfEnvelope" id="S5" value="S5"
							<?php echo (isset($_POST['typeOfEnvelope']) && $_POST['typeOfEnvelope'] == 'S5') 
								|| !isset($_POST['typeOfEnvelope']) ? "checked" : "" ?>>
                        <span>S5</span>
                    </label>
	                <label for="S6">
                        <input type="radio" name="typeOfEnvelope" id="S6" value="S6" 
							<?php echo isset($_POST['typeOfEnvelope']) && $_POST['typeOfEnvelope'] == 'S6' ? "checked" : "" ?>>
                        <span>S6</span>
                    </label>
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
					<input type="hidden" id="orderType" name="orderType" value="koverte-dostavnice-formulari/formulari-za-adresiranje">
					<input type="hidden" id="successMessage" name="successMessage" value="Formulari za adresiranje su uspešno naručeni.">
                    <input class="button-primary" type="submit" value="Prikaži" name="submit" >
                    <!-- Smisli kako ovo lepse da izgleda -->
                    <p class="uslovi" style="font-size:1.3rem; font-style: italic;">Narudzbinom prihvatam uslove poslovanja.</p> 
                </div>
            </form>
        </section>

<?php
	include("../../footer.php");
?>