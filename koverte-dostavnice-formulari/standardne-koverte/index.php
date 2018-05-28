<?php
@session_start();

	if(isset($_POST['submit'])){
		if(isset($_SESSION['status']) && $_SESSION['status'] == '1'){
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			exit();
		}
	}	

	include("../../header.php");
	require_once "../../functions/mail.php";
	require_once "../../functions/functions.php";

	if(isset($_POST['submit'])) {
		try{
			$message = makeMessage('koverte-dostavnice-formulari/standardne-koverte');

			$status = false;
			if(!isset($_POST['sendCopy'])){
				$mailStatus = sendMail($message);
			} else {
				$mailStatus = sendMail($message, $_POST['sendCopyEmail']);		
			}
			
			if($mailStatus === true){
				$order = new StandardnaKoverta($_POST, $_FILES);
				
				if(!isset($order) || !is_object($order)){
					header("Location: ../");
					exit();
				}
			
				$db = new DB();
				if(isset($_SESSION['user_info'])){
					$order->UserID = $_SESSION['user_info']->ID;	
				} else {
					$unregisterUserID = $db->getIdOfUnregisterUser()[0]->ID;
					$order->UserID = $unregisterUserID;
				}
			
				$status = $db->saveOrder($order);				
			} else {
				$status = false;
			}
			
		} catch(RuntimeException $e){
			return $e->getMessage();
		} 
	}
	
	if(isset($status)){
		$_SESSION['status'] = $status;
	} else {
		$_SESSION['status'] = null;
		unset($_SESSION['status']);
	}
	
	if(isset($status)){
		if($status === true){
			unset($_POST);
			$_POST = array();
			$statusMessage = "Uspešno naručena koverta.";
		} else{
			$statusMessage = "Došlo je do greške prilikom upisa narudžbine u bazu, pokušajte ponovo.";
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
                    <a class="tile" href="./" style="font-size: 1.6rem;">Standardne koverte</a>
                </li>
            </ul>
        </div>
        <!-- heading -->
        <h2 class="section__heading">Standardne koverte</h2>
        <!-- End of navigation -->
    <form method="POST" name="orderForm" action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
    <div class="form-box">
        <div class="row row_style">
            <div class="one-half column">
   				                    <!-- VELICINA -->
                                       <label class="label__heading">Veličina</label>
                    <label for="B6">
                        <input type="radio" id="B6" name="size" value="B6"
							<?php echo isset($order['Size']) && $order['Size'] == 'B6' ? "checked" : "" ?>>
                        <span>B6</span>
                    </label>
                    <label for="B5">
                        <input type="radio" id="B5" name="size" value="B5" 
							<?php echo isset($order['Size']) && $order['Size'] == 'B5' ? "checked" : "" ?>>
                        <span>B5</span>
                    </label>
                    <label for="C4">
                        <input type="radio" id="C4" name="size" value="C4" 
							<?php echo isset($order['Size']) && $order['Size'] == 'C4' ? "checked" : "" ?>>
                        <span>C4</span>
                    </label>
                    <label for="American1">
                        <input type="radio" id="American1" name="size" value="American sa prozorom desnim"
							<?php echo (isset($order['Size']) && $order['Size'] == 'American sa prozorom desnim') ? "checked" : "" ?>>
                        <span>American sa prozorom desnim</span>
                    </label>
                    <label for="American2">
                        <input type="radio" id="American2" name="size" value="American bez prozora" 
							<?php echo (isset($order['Size']) && $order['Size'] == 'American bez prozora') ? "checked" : "" ?>>
                        <span>American bez prozora</span>
                    </label>
                    <!-- ***************************** -->
            </div>
            <div class="one-half column">
                    <!--Stampanje na posledjini ******************************-->
                    <label class="label__heading">Štampanje na poleđini:</label>
                    <input class="u-full-width" type="text" placeholder="Prvi red..." name="printingOnBack1" 
						<?php echo isset($order['BackPrintRow1']) ? "value='".$order['BackPrintRow1']."'" : "" ?>>
                    <input class="u-full-width" type="text" placeholder="Drugi red..." name="printingOnBack2"
						<?php echo isset($order['BackPrintRow2']) ? "value='".$order['BackPrintRow2']."'" : "" ?>>
                    <input class="u-full-width" type="text" placeholder="Treći red..." name="printingOnBack3" 
						<?php echo isset($order['BackPrintRow3']) ? "value='".$order['BackPrintRow3']."'" : "" ?>>
                    <input class="u-full-width" type="text" placeholder="Četvrti red..." name="printingOnBack4"
						<?php echo isset($order['BackPrintRow4']) ? "value='".$order['BackPrintRow4']."'" : "" ?>>
                    <!-- ***************************** -->
            </div>
        </div>
        <!-- end of first row -->
        <div class="row row_style">
            <div class="one-half column column_space">
                    <!-- Kolicina -->
                    <label for="quantity" class="label__heading">Količina</label>
                    <select class="u-full-width" name="quantity">
                        <option value="1000" selected>1000</option>
                        <option value="2000" <?php echo isset($order['Quantity']) && $order['Quantity'] == '2000' ? "selected" : "" ?>>2000</option>
                        <option value="3000" <?php echo isset($order['Quantity']) && $order['Quantity'] == '3000' ? "selected" : "" ?>>3000</option>
                        <option value="4000" <?php echo isset($order['Quantity']) && $order['Quantity'] == '4000' ? "selected" : "" ?>>4000</option>
                        <option value="5000" <?php echo isset($order['Quantity']) && $order['Quantity'] == '5000' ? "selected" : "" ?>>5000</option>
                        <option value="6000" <?php echo isset($order['Quantity']) && $order['Quantity'] == '6000' ? "selected" : "" ?>>6000</option>
                        <option value="7000" <?php echo isset($order['Quantity']) && $order['Quantity'] == '7000' ? "selected" : "" ?>>7000</option>
                        <option value="8000" <?php echo isset($order['Quantity']) && $order['Quantity'] == '8000' ? "selected" : "" ?>>8000</option>
                        <option value="9000" <?php echo isset($order['Quantity']) && $order['Quantity'] == '9000' ? "selected" : "" ?>>9000</option>
                        <option value="100000" <?php echo isset($order['Quantity']) && $order['Quantity'] == '10000' ? "selected" : "" ?>>10000</option>
                    </select>

                    					<?php
						include("../../delivery_fields.php");
					?>
                    <!-- ***************************** -->
            </div>
            <div class="one-half column">
                   <!--Stampanje na adresnoj strani ******************************-->
                   <label class="label__heading">Štampanje na adresnoj strani:</label>
                    <input class="u-full-width" type="text" placeholder="Prvi red..." name="printingOnAdressPage1"
						<?php echo isset($order['AddressPrintRow1']) ? "value='".$order['AddressPrintRow1']."'" : "" ?>>
                    <input class="u-full-width" type="text" placeholder="Drugi red..." name="printingOnAdressPage2" 
						<?php echo isset($order['AddressPrintRow2']) ? "value='".$order['AddressPrintRow2']."'" : "" ?>>
                    <input class="u-full-width" type="text" placeholder="Treći red..." name="printingOnAdressPage3" 
						<?php echo isset($order['AddressPrintRow3']) ? "value='".$order['AddressPrintRow3']."'" : "" ?>>
                    <input class="u-full-width" type="text" placeholder="Četvrti red..." name="printingOnAdressPage4" 
						<?php echo isset($order['AddressPrintRow4']) ? "value='".$order['AddressPrintRow4']."'" : "" ?>>
                    <!-- ***************************** -->
            </div>
        </div>
        <!--end of second row -->
        <div class="row row_style">
            <div class="one-half column">
            <label for="message" class="label__heading">Poruka</label>
                    <textarea class="u-full-width" placeholder="Dodatni komentar ..." name="comment"><?php echo isset($_POST['comment']) ? $_POST['comment'] : "" ?></textarea>
                    <!-- Varijabilni podaci i prihvatam uslove
                    <label for="varData">
                        <input type="checkbox" name="varData" id="varData"
							<?php //echo isset($_POST['varData']) ? "checked" : ""?>>
                        <span class="label-body">Varijabilni podaci</span>
                    </label> -->
             </label>
            </div>

            <div class="one-half column">
            <label class="sendCopy">
                        <input type="checkbox" id="sendCopy" name="sendCopy"
							<?php echo isset($_POST['sendCopy']) ? "checked" : ""?>>
                        <span class="label-body">Pošalji kopiju sebi</span>
                        <input type="text" placeholder="Upišite Vas email" id="sendCopyEmail" name="sendCopyEmail" 
							value="<?php if(isset($_SESSION['user_info'])) 
											echo $_SESSION['user_info']->Email;
										else if(isset($_POST['sendCopyEmail'])) 
											echo $_POST['sendCopyEmail'];
										else 
											echo ''; ?>">
            </div>
        </div>

        <div class="twelve column" style="text-align:center;">
                            <!-- POSALJI DUGME -->
                    <input class="button-primary" type="submit" value="Pošalji" name="submit">
                    <p class="uslovi" style="font-size:1.3rem; font-style: italic;">Narudzbinom prihvatam uslove poslovanja.</p>
                    </div>
        </div>
    </form>
<?php
	include("../../footer.php");
?>
