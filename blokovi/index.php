<?php

@session_start();
//error_reporting(0);

include("../header.php");

require_once '../functions/mail.php';
require_once '../functions/functions.php';


if(isset($_POST['submit'])) {
	try{
	
		$status = 0;
		$fileStatus = 0;
		
		$fileStatus = uploadFile("uploaded_file/");
		$statusMessage = generateMessage($fileStatus);
		if($fileStatus !== 2 && $fileStatus !== 3){
			$status = false;
			$statusMessage = "Neodgovarajući fajl.";
			return;
		}
		
		$message = makeMessage('blokovi');

		if(isset($_POST['sendCopy']) && isset($_POST['sendCopyEmail'])){
			$mailStatus = sendMail($message, $_POST['sendCopyEmail']);		
		}
		else {
			$mailStatus = sendMail($message);
		}
		
		$status = false;
		if(($fileStatus === 2 || $fileStatus === 3) && $mailStatus === true){
			$status = true;
		} else {
			$status = false;
		}		
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
                    <a class="tile" href="./" style="font-size: 1.6rem;">Preslikavajući Blokovi</a>
                </li>
            </ul>
        </div>
        <!-- End of navigation -->

        <!--Stampanje section-->
        <section class="section__stampanje">
            <div class="container">
                <h2 class="section__heading">Preslikavajući blokovi</h2>
            </div>
            <!-- OVDE POCINJE FORMA ZA ***BLOKOVE*** -->
            <form method="POST" name="orderForm" action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data"
				onsubmit="return(validate());">
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
                    <!--UPLOAD dugme-->
                    <input type='file' name='fileToUpload' id="file" class="inputfile" accept='.gif,.jpe,.jpg,.jpeg,.png,.pdf'>
                    <label for="file"><i class="fa-upload fas fa-upload"></i><span>Okačite fajl</span></label>
                    <div class="row">

                        <!-- BROJ SETOVA ***************************** -->
                        <label for="noOfSet" class="label__heading">Broj setova</label>
                        <input class="u-full-width" type="number" name="noOfSet"
							<?php echo (isset($_POST['noOfSet'])) ? "value='".$_POST['noOfSet']."'" : "value='1'" ?>>
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
								<?php echo isset($_POST['packing']) && $_POST['packing'] == 'Heftanjem gore' ? "checked" : "" ?>>
                            <span>Heftanjem levo</span>
                        </label>
                        <label for="U fasciklu">
                            <input type="radio" name="packing" id="U fasciklu" value="U fasciklu" checked 
								<?php echo isset($_POST['packing']) && $_POST['packing'] == 'U fasciklu' ? "checked" : "" ?>>
                            <span>U fasciklu</span>
                        </label>
                        <!-- ***************************** -->

                        <!-- Krajnja poruka -->
                        <label for="message" class="label__heading">Poruka</label>
                        <textarea class="u-full-width" placeholder="Dodatni komentar ..." name="comment"><?php echo isset($_POST['comment']) ? $_POST['comment'] : ''?></textarea>
                        <label for="sendCopy">
                        <input type="checkbox" name="sendCopy" id="sendCopy" 
							<?php echo isset($_POST['sendCopy']) ? "checked" : "" ?>>
                        <span class="label-body">Pošalji kopiju sebi</span>
						<input type="text" placeholder="Upišite Vas email" id="sendCopyEmail" name="sendCopyEmail"
							value="<?php echo isset($_POST['sendCopyEmail']) ? $_POST['sendCopyEmail'] : ''?>">
                        </label>
						<input type="hidden" name="orderType" id="orderType" value="blokovi">
						<input type="hidden" id="successMessage" value="Blokovi su uspešno naručeni.">
                        <input class="button-primary" type="submit" value="Pošalji" name="submit" />
                        <p class="uslovi" style="font-size:1.3rem; font-style: italic;">Narudzbinom prihvatam uslove poslovanja.</p>
                    </div>
            </form>
        </section>

<?php
include("../footer.php");
?>