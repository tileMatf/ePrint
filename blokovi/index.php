<?php

@session_start();

	if(isset($_POST['submit'])){
		if(isset($_SESSION['status']) && $_SESSION['status'] == '1'){
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			exit();
		}
	}	
	
	include("../header.php");
	require_once '../functions/mail.php';
	require_once '../functions/functions.php';
	
	if(isset($_POST['submit'])) {
		try{
		
			$status = 0;
			$fileStatus = 0;
			
			if(isset($_SESSION['user_info'])){
				$directory = "uploaded_file/". $_SESSION['user_info']->Email . "/";
				$fileStatus = uploadFile($directory, $_FILES["fileToUpload"]);
			}
			else {
				$fileStatus = uploadFile("uploaded_file/", $_FILES["fileToUpload"]);
			}
			$statusMessage = generateMessage($fileStatus, $_FILES['fileToUpload']);
			if($fileStatus !== 2 && $fileStatus !== 3){
				$status = false;
				$statusMessage = "Neodgovarajući fajl.";
				return;
			}
			
			if(isset($_SESSION['user_info']))
				$message = makeMessage('blokovi', $_SESSION['user_info']->Email);
			else 
				$message = makeMessage('blokovi');

			if(isset($_POST['sendCopy'])){
				if(isset($_POST['sendCopyEmail'])){
					$mailStatus = sendMail($message, $_POST['sendCopyEmail']);		
				} else if(isset($_SESSION['user_info'])){
					$mailStatus = sendMail($message, $_SESSION['user_info']->Email);
				} else {
					$mailStatus = sendMail($message);
				}
			}
			else {
				$mailStatus = sendMail($message);
			}
			
			$status = false;
			if(($fileStatus === 2 || $fileStatus === 3) && $mailStatus === true){
				$status = true;
				if(isset($_SESSION['user_info'])){
					$_POST['fileToUploadName'] = $_FILES['fileToUpload']['name'];  //pogledati ovaj deo
				}
			} else {
				$status = false;
			}

			if($status === true){
				$blok_order = new Blok($_POST, $_FILES);
				
				if(!isset($blok_order) || !is_object($blok_order)){
					header("Location: ../");
					exit();
				}
			
				$db = new DB();
				if(isset($_SESSION['user_info'])){
					$blok_order->UserID = $_SESSION['user_info']->ID;	
				} else {
					$unregisterUserID = $db->getIdOfUnregisterUser()[0]->ID;
					$blok_order->UserID = $unregisterUserID;
				}
				
				//if(isset($_POST['openOrderButton'])){
				//	if(orderChanged($_POST, ))
				//		update
				//}
				//else {
					$status = $db->saveOrder($blok_order);
				//}
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
		if($status === true) {
			unset($_POST);
			$_POST = array();
			$statusMessage = "Uspešno poslata narudžbina.";
		} else {
			$statusMessage .= " Došlo je do greške prilikom upisa narudžbine u bazu, pokušajte ponovo.";
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
                    <a class="tile" href="./" style="font-size: 1.6rem;">Preslikavajući blokovi</a>
                </li>
            </ul>
        </div>
        <!-- End of navigation -->

        <!--Stampanje section-->
        <section class="section__stampanje">
            <div class="container">
                <h2 class="section__heading">Preslikavajući blokovi</h2>
            </div>
			
            <!-- OVDE POCINJE FORMA ZA ***BLOKOVE*** echo htmlspecialchars($_SERVER['PHP_SELF']);-->
            <form name="orderForm" id="orderForm" enctype="multipart/form-data" method="post" 
				action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" onsubmit="return(validate());">
                <div class="form-box">
				<!-- Paragraf za povratnu poruku -->	
				<?php
					if(isset($status)){
						if($status === true){
							if(isset($statusMessage) && $statusMessage)
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
				<?php 
					if(isset($_POST['orderObject'])){
						$order = json_decode($_POST['orderObject'], true);
				?>
					<!--UPLOAD dugme-->
                    <input type='file' name='fileToUpload' id="file" class="inputfile" accept='.jpe,.jpg,.jpeg,.png,.pdf'>
                    <label for="file"><i class="fa-upload fas fa-upload"></i><span>Okačite fajl</span></label>
					<input type="hidden" name="fileToUploadName" value="<?php echo isset($order['FileName']) ? $order['FileName'] : ''?>">                    
					<div class="row">
                        <!-- BROJ SETOVA ***************************** -->
                        <label for="noOfSet" class="label__heading">Broj setova</label>
                        <input class="u-full-width" type="number" name="noOfSet" value="<?php echo isset($order['NumberOfSet']) ? $order['NumberOfSet'] : '1'?>">
                        <!-- ***************************** -->

                        <!-- BOJA ***************************** -->
                        <label for="" class="label__heading">Boja</label>
                        <label for="Crno-belo">
                            <input type="radio" name="blockColor" id="Crno-belo" value="Crno-belo" 
								<?php echo (isset($order['Color']) && $order['Color'] == 'Crno-belo') || !isset($order['Color']) ? "checked" : "" ?>>
                            <span>Crno belo</span>
                        </label>
                        <label for="Plavo-belo" class="label__heading">
                            <input type="radio" name="blockColor" id="Plavo-belo" value="Plavo-belo" 
								<?php echo isset($order['Color']) && $order['Color'] == 'Plavo-belo' ? "checked" : "" ?>>
                            <span>Plavo belo</span>
                        </label>
                        <label for="U boji" class="label__heading">
                            <input type="radio" name="blockColor" id="U boji" value="U boji" 
								<?php echo isset($order['Color']) && $order['Color'] == 'U boji' ? "checked" : "" ?>>
                            <span>U boji</span>
                        </label>
                        <!-- ***************************** -->

                        <!-- VELICINA BLOKA  ***************************** -->
                        <label for="" class="label__heading">Veličina bloka</label>
                        <label for="A4">
                            <input type="radio" name="blockSize" id="A4" value="A4"
								<?php echo (isset($order['Size']) && $order['Size'] == 'A4') || !isset($order['Size']) ? "checked" : "" ?>>
                            <span>A4</span>
                        </label>
                        <label for="A5">
                            <input type="radio" name="blockSize" id="A5" value="A5"
								<?php echo isset($order['Size']) && $order['Size'] == 'A5' ? "checked" : "" ?>>
                            <span>A5</span>
                        </label>
                        <!-- ***************************** -->

                        <!-- SPAKOVANO -->
                        <label for="" class="label__heading">Spakovano</label>
                        <label for="Heftanjem gore">
                            <input type="radio" name="packing" id="Heftanjem gore" value="Heftanjem gore" 
								<?php echo isset($order['Packing']) && $order['Packing'] == 'Heftanjem gore' ? "checked" : "" ?>>
                            <span>Heftanjem gore</span>
                        </label>
                        <label for="Heftanjem levo">
                            <input type="radio" name="packing" id="Heftanjem levo" value="Heftanjem levo" 
								<?php echo isset($order['Packing']) && $order['Packing'] == 'Heftanjem levo' ? "checked" : "" ?>>
                            <span>Heftanjem levo</span>
                        </label>
                        <label for="U fasciklu">
                            <input type="radio" name="packing" id="U fasciklu" value="U fasciklu" 
								<?php echo isset($order['Packing']) && $order['Packing'] == 'U fasciklu' ? "checked" : "" ?>>
                            <span>U fasciklu</span>
                        </label>
                        <!-- ***************************** -->
						
						<?php
							include("../delivery_fields.php");
						?>

                        <!-- Krajnja poruka -->
                        <label for="message" class="label__heading">Poruka</label>
                        <textarea class="u-full-width" placeholder="Dodatni komentar ..." name="comment"><?php echo isset($order['Comment']) ? $order['Comment'] : ''?></textarea>
                        <label for="sendCopy">
                        <input type="checkbox" name="sendCopy" id="sendCopy" 
							<?php echo isset($order['SendCopy']) && $order['SendCopy'] === '1' ? "checked" : "" ?>>
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
				
                    <!--UPLOAD dugme-->
                    <input type='file' name='fileToUpload' id="file" class="inputfile" accept='.jpe,.jpg,.jpeg,.png,.pdf'>
                    <label for="file"><i class="fa-upload fas fa-upload"></i><span>Okačite fajl</span></label>
					<input type="hidden" name="fileToUploadName" value="<?php echo isset($_FILES['fileToUpload']) ? $_FILES['fileToUpload']['name'] : ''?>">                    
					<div class="row">
                        <!-- BROJ SETOVA ***************************** -->
                        <label for="noOfSet" class="label__heading">Broj setova</label>
                        <input class="u-full-width" type="number" name="noOfSet" value="<?php echo isset($_POST['noOfSet']) ? $_POST['noOfSet'] : '1'?>">
                        <!-- ***************************** -->

                        <!-- BOJA ***************************** -->
                        <label for="" class="label__heading">Boja</label>
                        <label for="Crno-belo">
                            <input type="radio" name="blockColor" id="Crno-belo" value="Crno-belo" 
								<?php echo (isset($_POST['blockColor']) && $_POST['blockColor'] == 'Crno-belo') || !isset($_POST['blockColor']) ? "checked" : "" ?>>
                            <span>Crno belo</span>
                        </label>
                        <label for="Plavo-belo" class="label__heading">
                            <input type="radio" name="blockColor" id="Plavo-belo" value="Plavo-belo" 
								<?php echo isset($_POST['blockColor']) && $_POST['blockColor'] == 'Plavo-belo' ? "checked" : "" ?>>
                            <span>Plavo belo</span>
                        </label>
                        <label for="U boji" class="label__heading">
                            <input type="radio" name="blockColor" id="U boji" value="U boji" 
								<?php echo isset($_POST['blockColor']) && $_POST['blockColor'] == 'U boji' ? "checked" : "" ?>>
                            <span>U boji</span>
                        </label>
                        <!-- ***************************** -->

                        <!-- VELICINA BLOKA  ***************************** -->
                        <label for="" class="label__heading">Veličina bloka</label>
                        <label for="A4">
                            <input type="radio" name="blockSize" id="A4" value="A4"
								<?php echo (isset($_POST['blockSize']) && $_POST['blockSize'] == 'A4') || !isset($_POST['blockSize']) ? "checked" : "" ?>>
                            <span>A4</span>
                        </label>
                        <label for="A5">
                            <input type="radio" name="blockSize" id="A5" value="A5"
								<?php echo isset($_POST['blockSize']) && $_POST['blockSize'] == 'A5' ? "checked" : "" ?>>
                            <span>A5</span>
                        </label>
                        <!-- ***************************** -->

                        <!-- SPAKOVANO -->
                        <label for="" class="label__heading">Spakovano</label>
                        <label for="Heftanjem gore">
                            <input type="radio" name="packing" id="Heftanjem gore" value="Heftanjem gore" 
								<?php echo (isset($_POST['packing']) && $_POST['packing'] == 'Heftanjem gore') || !isset($_POST['packing']) ? "checked" : "" ?>>
                            <span>Heftanjem gore</span>
                        </label>
                        <label for="Heftanjem levo">
                            <input type="radio" name="packing" id="Heftanjem levo" value="Heftanjem levo" 
								<?php echo isset($_POST['packing']) && $_POST['packing'] == 'Heftanjem levo' ? "checked" : "" ?>>
                            <span>Heftanjem levo</span>
                        </label>
                        <label for="U fasciklu">
                            <input type="radio" name="packing" id="U fasciklu" value="U fasciklu" checked 
								<?php echo isset($_POST['packing']) && $_POST['packing'] == 'U fasciklu' ? "checked" : "" ?>>
                            <span>U fasciklu</span>
                        </label>
                        <!-- ***************************** -->

						<?php
							include("../delivery_fields.php");
						?>

                        <!-- Krajnja poruka -->
                        <label for="message" class="label__heading">Poruka</label>
                        <textarea class="u-full-width" placeholder="Dodatni komentar ..." name="comment"><?php echo isset($_POST['comment']) ? $_POST['comment'] : ''?></textarea>
                        <label for="sendCopy">
                        <input type="checkbox" name="sendCopy" id="sendCopy" 
							<?php echo isset($_POST['sendCopy']) ? "checked" : "" ?>>
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
						<?php } ?>
						<?php }?>
						<input type="hidden" name="orderType" id="orderType" value="blokovi">
						<input type="hidden" id="successMessage" value="Blokovi su uspešno naručeni.">
                        <input class="button-primary" type="submit" value="Pošalji" name="submit">
                        <p class="uslovi" style="font-size:1.3rem; font-style: italic;">Narudzbinom prihvatam uslove poslovanja.</p>
                    </div>
            </form>
        </section>

<?php
include("../footer.php");
?>