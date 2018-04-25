<?php

@session_start();

	if(isset($_POST['submit']) && isset($_SESSION['status']) && $_SESSION['status'] == '1'){
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}

	include("../header.php");
	require_once '../functions/mail.php';
	require_once '../functions/functions.php';

	if(isset($_POST['submit'])) {
		try{
		
			$status = 0;
			$fileStatus = 0;
			$bindingFileStatus = 0;	
			
			if(isset($_SESSION['user_info'])){
				$directory = "uploaded_file/". $_SESSION['user_info']->Email . "/";
				$fileStatus = uploadFile($directory, $_FILES["fileToUpload"]);
			}
			else {
				$fileStatus = uploadFile("uploaded_file/", $_FILES["fileToUpload"]);
			}
			$statusMessage = generateMessage($fileStatus, $_FILES['fileToUpload']);
			if($fileStatus !== 2 && $fileStatus !== 3)
				return false;
		
			if(!empty($_FILES['bindingFileToUpload']['name'])){
				if(isset($_SESSION['user_info'])){
					$directory = "uploaded_binding_file/". $_SESSION['user_info']->Email . "/";
					$bindingFileStatus = uploadFile($directory, $_FILES["bindingFileToUpload"]);
				} else {
					$bindingFileStatus = uploadFile("uploaded_binding_file/", $_FILES["bindingFileToUpload"]);
				}
				$statusMessage .= " " . generateMessage($bindingFileStatus, $_FILES['bindingFileToUpload']);
				if($bindingFileStatus !== 2 && $bindingFileStatus !== 3){
					return false;
				}
			}
		
			if(isset($_SESSION['user_info']))
				$message = makeMessage('stampanje', $_SESSION['user_info']->Email);
			else 
				$message = makeMessage('stampanje');
			
			$status = false;
			if($fileStatus === 2 || $fileStatus === 3){
				if(!empty($files['bindingFileToUpload']['name'])){
					if($bindingFileStatus === 2 || $bindingFileStatus === 3){
						$status = true;
					} else {
						$status = false;
					}
				} else {
					$status = true;
				}
			} else {
				$status = false;
			}

			if($status === true) {
				if(isset($_POST['sendCopy'])) {
					if(isset($_POST['sendCopyEmail'])){
						$status = sendMail($message, $_POST['sendCopyEmail']);		
					} else if(isset($_SESSION['user_info'])){
						$status = sendMail($message, $_SESSION['user_info']->Email);
					} else {
						$status = sendMail($message);
					}
				}
				else {
					$status = sendMail($message);		
				}
			}
			
			if($status === true){
				if(isset($_SESSION['user_info'])){
					$_POST['fileToUploadName'] = $_FILES['fileToUpload']['name'];
				}
			}
			
			if($status === true){
				$order = new Stampanje($_POST, $_FILES);
				
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
			$statusMessage = "Uspešno poslata narudžbina.";
		} else {
			$statusMessage = "Došlo je do greške prilikom upisa narudžbine u bazu, pokušajte ponovo.";
		}
	}	
?>
 
    <!-- Navigation 2 -->
    <div class="twelve columns">
      <ul class="nav1">
        <li>
          <a class="tile" href="../">
            <i class="fas fa-home" aria-hidden="true"></i>Početna</a>
        </li>
        <span class="line">/</span>
        <li>
          <a class="tile" href="./" style="font-size: 1.6rem;">Štampanje</a>
        </li>
      </ul>
    </div>
    <!-- End of navigation -->

    <!--Stampanje section-->
    <section class="section__stampanje">
      <div class="container">
        <h2 class="section__heading">Štampanje</h2>		
      </div>

      <!-- OVDE POCINJE FORMA ZA ***STAMPANJE*** -->
      <form method="POST" name="orderForm" enctype="multipart/form-data" onsubmit="return(validate())";
		action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        <div class="form-box">
		<!-- Paragraf za povratnu poruku -->		
		<?php
			if(isset($status)){
				if($status === true){
					if(isset($statusMessage) && $statusMessage)
						echo '<p style="font-size:2rem; font-style: italic; color: green">'.
							htmlspecialchars($statusMessage) .'</p>';
				}
				else {
					if(isset($_statusMessage) && $statusMessage)
						echo '<p style="font-size:2rem; font-style: italic; color: red">'.
							htmlspecialchars($statusMessage) . '</p>';						
				}
				if(isset($_SESSION['user_info']) && isset($_POST['submit']))
					echo '<input type="button" value="Sačuvaj narudžbinu" id="saveOrder" title="Možete sačuvati narudžbinu u Vašem nalogu"><br><br>';
			}
		?> 		
		<?php 
			if(isset($_POST['orderObject'])){
				$order = json_decode($_POST['orderObject'], true);				
		?>
			<!--UPLOAD dugme-->  
            <input type='file' name='fileToUpload' id="file" class="inputfile" accept='.jpe,.jpg,.jpeg,.png,.pdf'>			
            <label for="file"><i class="fa-upload fas fa-upload"></i><span>Okačite fajl</span></label>
            <!-- BROJ PRIMERAKA ***************************** -->
            <label for="noInput" class="label__heading">Broj primeraka</label>
            <input name="noInput" type="number" value="<?php echo isset($order['CopyNumber']) ? $order['CopyNumber'] : '1'?>" class="u-full-width">
            <!-- Redosled primeraka -->
            <label class="label__heading">Složi stranice</label>
            <label for="1,2,3; 1,2,3; 1,2,3">
              <input type="radio" name="orderOfInput" id="1,2,3; 1,2,3; 1,2,3" value="1,2,3; 1,2,3; 1,2,3"
				<?php echo (isset($order['PageOrder']) && $order['PageOrder'] == '1,2,3; 1,2,3; 1,2,3') ? "checked" : "" ?>>
              <span>1,2,3; 1,2,3; 1,2,3</span>
            <label for="1,1,1; 2,2,2; 3,3,3">
              <input type="radio" name="orderOfInput" id="1,1,1; 2,2,2; 3,3,3" value="1,1,1; 2,2,2; 3,3,3" 
				<?php echo (isset($order['PageOrder']) && $order['PageOrder'] == '1,1,1; 2,2,2; 3,3,3') ? "checked" : "" ?>>
              <span>1,1,1; 2,2,2; 3,3,3</span>
            </label>
            <!-- ***************************** -->

            <!-- BOJA ***************************** -->
            <label class="label__heading">Boja</label>
            <label for="Crno-belo">
              <input type="radio" name="colorOfInput" id="Crno-belo" value="Crno-belo" 
				<?php echo (isset($order['Color']) && $order['Color'] == 'Crno-belo') || !isset($order['Color']) ? "checked" : "" ?>>
              <span>Crno belo</span>
            </label>
            <label for="U boji">
              <input type="radio" name="colorOfInput" id="U boji" value="U boji"
				<?php echo (isset($order['Color']) && $order['Color'] == 'U boji') ? "checked" : "" ?>>
              <span>U boji</span>
            </label>
            <!-- ***************************** -->

            <!-- JEDNOSTRANO/DVOSTRANO  ***************************** -->
            <label class="label__heading">Jednostrano / Dvostrano</label>
            <label for="Jednostrano">
              <input type="radio" name="typeOfPrint" id="Jednostrano" value="Jednostrano" 
				<?php echo (isset($order['PagePrintType']) && $order['PagePrintType'] == 'Jednostrano') ? "checked" : "" ?>>
              <span>Jednostrano</span>
            </label>
            <label for="Dvostrano">
              <input type="radio" name="typeOfPrint" id="Dvostrano" value="Dvostrano" 
				<?php echo (isset($order['PagePrintType']) && $order['PagePrintType'] == 'Dvostrano') ? "checked" : "" ?>>
              <span>Dvostrano</span>
            </label>
            <!-- ***************************** -->

            <!-- VELICINA PAPIRA -->
            <label class="label__heading">Veličina papira</label>
            <label for="A4">
              <input type="radio" name="paperSize" id="A4" value="A4"
				<?php echo (isset($order['PaperSize']) && $order['PaperSize'] == 'A4') ? "checked" : "" ?>>
              <span>A4</span>
            </label>
            <label for="A3">
              <input type="radio" name="paperSize" id="A3" value="A3" 
				<?php echo (isset($order['PaperSize']) && $order['PaperSize'] == 'A3') ? "checked" : "" ?>>
              <span>A3</span>
            </label>
            <!-- ***************************** -->

            <!-- DEBILJINA PAPIRA -->
            <label class="label__heading">Debljina papira</label>
            <label for="80">
              <input type="radio" id="80" name="paperWidth" value="80gr/m2" 
				<?php echo (isset($order['PaperWidth']) && $order['PaperWidth'] == '80gr/m2') ? "checked" : "" ?>>
              <span>80 gr/m<sup>2</sup></span>
            </label>
            <label for="100">
              <input type="radio" id="100" name="paperWidth" value="100gr/m2" 
				<?php echo (isset($order['PaperWidth']) && $order['PaperWidth'] == '100gr/m2') ? "checked" : "" ?>>
              <span>100 gr/m<sup>2</sup></span>
            </label>
            <!-- ***************************** -->


            <!-- KORICENJE -->
            <label class="label__heading">Koričenje</label>
            <label for="bindingTypePlastic">
              <input type="radio" id="bindingTypePlastic" name="bindingType" value="Plasticnom spiralom"
				<?php echo (isset($order['BindingType']) && $order['BindingType'] == 'Plasticnom spiralom') ? "checked" : "" ?>>
              <span>Plastičnom spiralom</span>
            </label>
            <label for="bindingTypeWire">
              <input type="radio" id="bindingTypeWire" name="bindingType" value="Zicanom spiralom" 
				<?php echo (isset($order['BindingType']) && $order['BindingType'] == 'Zicanom spiralom') ? "checked" : "" ?>>
              <span>Žičanom spiralom</span>
            </label>
            <label for="bindingTypeHard">
              <input type="radio" id="bindingTypeHard" name="bindingType" value="Tvrdo koricenje"
				<?php echo (isset($order['BindingType']) && $order['BindingType'] == 'Tvrdo koricenje') ? "checked" : "" ?>>
              <span>Tvrdo koričenje</span>
            </label>
            <!-- Upload korice dugme -->
            <label class="label__heading">Okačite koricu</label>
			      <input type='file' name='bindingFileToUpload' accept='.jpe,.jpg,.jpeg,.png,.pdf'>
            <!-- ***************************** -->

            <!-- HEFTANJE -->
              <label for="heftingType" class="label__heading">Heftanje</label>
              <select class="u-full-width" name="heftingType">
                <option value="Gore levo" <?php echo isset($order['HeftingType']) && $order['HeftingType'] == 'Gore levo' ? "selected" : "" ?>>Gore levo</option>
                <option value="Gore desno" <?php echo isset($order['HeftingType']) && $order['HeftingType'] == 'Gore desno' ? "selected" : "" ?>>Gore desno</option>
                <option value="Dole levo" <?php echo isset($order['HeftingType']) && $order['HeftingType'] == 'Dole levo' ? "selected" : "" ?>>Dole levo</option>
                <option value="Dole desno" <?php echo isset($order['HeftingType']) && $order['HeftingType'] == 'Dole desno' ? "selected" : "" ?>>Dole desno</option>
                <option value="Po sredini levo" <?php echo isset($order['HeftingType']) && $order['HeftingType'] == 'Po sredini levo' ? "selected" : "" ?>>Po sredini levo</option>
                <option value="Po sredini desno" <?php echo isset($order['HeftingType']) && $order['HeftingType'] == 'Po sredini desno' ? "selected" : "" ?>>Po sredini desno</option>
                <option value="Po sredini gore" <?php echo isset($order['HeftingType']) && $order['HeftingType'] == 'Po sredini gore' ? "selected" : "" ?>>Po sredini gore</option>
                <option value="Po sredini dole" <?php echo isset($order['HeftingType']) && $order['HeftingType'] == 'Po sredini dole' ? "selected" : "" ?>>Po sredini dole</option>
              </select>
            <!-- ***************************** -->


            <!-- BUSENJE -->
              <label for="drillingType" class="label__heading">Bušenje</label>
              <select class="u-full-width" name="drillingType">
                <option value="Dve rupe za registrator levo" <?php echo isset($order['DrillingType']) && $order['DrillingType'] == 'Dve rupe za registrator levo' ? "selected" : "" ?>>Dve rupe za registrator levo</option>
                <option value="Dve rupe za registrator desno" <?php echo isset($order['DrillingType']) && $order['DrillingType'] == 'Dve rupe za registrator desno' ? "selected" : "" ?>>Dve rupe za registrator desno</option>
                <option value="Dve rupe za registrator gore" <?php echo isset($order['DrillingType']) && $order['DrillingType'] == 'Dve rupe za registrator gore' ? "selected" : "" ?>>Dve rupe za registrator gore</option>
                <option value="Dve rupe za registrator dole" <?php echo isset($order['DrillingType']) && $order['DrillingType'] == 'Dve rupe za registrator dole' ? "selected" : "" ?>>Dve rupe za registrator dole</option>
              </select>
            <!-- ***************************** -->

			<!-- Adresa isporuka-->
			<label for="deliveryAddress" class="label__heading">Adresa isporuke</label>
			<input class="u-full-width" type="text" placeholder="" name="deliveryAddress" required
                 value="<?php echo $order['DeliveryAddress']; ?>">
			<!-- ****************************** -->

			<!-- Zip kod isporuka -->
			<label for="deliveryZipCode" class="label__heading">Poštanski broj isporuke</label>
			<input class="u-full-width" type="text" placeholder="" name="deliveryZipCode" required
                value="<?php echo $order['DeliveryZipCode']; ?>">
			<!-- ****************************** -->

			<!-- Mesto isporuke -->
			<label for="deliveryLocation" class="label__heading">Mesto isporuke</label>
			<input class="u-full-width" type="text" placeholder="" name="deliveryLocation" required
                value="<?php echo $order['DeliveryLocation']; ?>">
			<!-- ****************************** -->
			
            <!-- Krajnja poruka -->
            <label for="message" class="label__heading">Poruka</label>
            <textarea class="u-full-width" placeholder="Dodatni komentar ..." name="comment"><?php echo isset($order['Comment']) ? $order['Comment'] : "" ?></textarea>
            <label class="sendCopy" for="sendCopy">
              <input type="checkbox" id="sendCopy" name="sendCopy"
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
			
		<?php } else { ?>
			
          <!--UPLOAD dugme-->  
            <input type='file' name='fileToUpload' id="file" class="inputfile" accept='.jpe,.jpg,.jpeg,.png,.pdf'>
            <label for="file"><i class="fa-upload fas fa-upload"></i><span>Okačite fajl</span></label>
			<input type="hidden" name="fileToUploadName" value="<?php echo isset($_FILES['fileToUpload']) ? $_FILES['fileToUpload']['name'] : ''?>">
            <!-- BROJ PRIMERAKA ***************************** -->
            <label for="noInput" class="label__heading">Broj primeraka</label>
            <input name="noInput" type="number" value="<?php echo isset($_POST['noInput']) ? $_POST['noInput'] : '1'?>" class="u-full-width">
            <!-- Redosled primeraka -->
            <label class="label__heading">Složi stranice</label>
            <label for="1,2,3; 1,2,3; 1,2,3">
              <input type="radio" name="orderOfInput" id="1,2,3; 1,2,3; 1,2,3" value="1,2,3; 1,2,3; 1,2,3"
				<?php echo (isset($_POST['orderOfInput']) && $_POST['orderOfInput'] == '1,2,3; 1,2,3; 1,2,3') || !isset($_POST['orderOfInput']) ? "checked" : "" ?>>
              <span>1,2,3; 1,2,3; 1,2,3</span>
            <label for="1,1,1; 2,2,2; 3,3,3">
              <input type="radio" name="orderOfInput" id="1,1,1; 2,2,2; 3,3,3" value="1,1,1; 2,2,2; 3,3,3" 
				<?php echo (isset($_POST['orderOfInput']) && $_POST['orderOfInput'] == '1,1,1; 2,2,2; 3,3,3') ? "checked" : "" ?>>
              <span>1,1,1; 2,2,2; 3,3,3</span>
            </label>
            <!-- ***************************** -->

            <!-- BOJA ***************************** -->
            <label class="label__heading">Boja</label>
            <label for="Crno-belo">
              <input type="radio" name="colorOfInput" id="Crno-belo" value="Crno-belo" 
				<?php echo (isset($_POST['colorOfInput']) && $_POST['colorOfInput'] == 'Crno-belo') || !isset($_POST['colorOfInput']) ? "checked" : "" ?>>
              <span>Crno belo</span>
            </label>
            <label for="U boji">
              <input type="radio" name="colorOfInput" id="U boji" value="U boji"
				<?php echo (isset($_POST['colorOfInput']) && $_POST['colorOfInput'] == 'U boji') ? "checked" : "" ?>>
              <span>U boji</span>
            </label>
            <!-- ***************************** -->

            <!-- JEDNOSTRANO/DVOSTRANO  ***************************** -->
            <label class="label__heading">Jednostrano / Dvostrano</label>
            <label for="Jednostrano">
              <input type="radio" name="typeOfPrint" id="Jednostrano" value="Jednostrano" 
				<?php echo (isset($_POST['typeOfPrint']) && $_POST['typeOfPrint'] == 'Jednostrano') || !isset($_POST['typeOfPrint']) ? "checked" : "" ?>>
              <span>Jednostrano</span>
            </label>
            <label for="Dvostrano">
              <input type="radio" name="typeOfPrint" id="Dvostrano" value="Dvostrano" 
				<?php echo (isset($_POST['typeOfPrint']) && $_POST['typeOfPrint'] == 'Dvostrano') ? "checked" : "" ?>>
              <span>Dvostrano</span>
            </label>
            <!-- ***************************** -->

            <!-- VELICINA PAPIRA -->
            <label class="label__heading">Veličina papira</label>
            <label for="A4">
              <input type="radio" name="paperSize" id="A4" value="A4"
				<?php echo (isset($_POST['paperSize']) && $_POST['paperSize'] == 'A4') || !isset($_POST['paperSize']) ? "checked" : "" ?>>
              <span>A4</span>
            </label>
            <label for="A3">
              <input type="radio" name="paperSize" id="A3" value="A3" 
				<?php echo (isset($_POST['paperSize']) && $_POST['paperSize'] == 'A3') ? "checked" : "" ?>>
              <span>A3</span>
            </label>
            <!-- ***************************** -->

            <!-- DEBILJINA PAPIRA -->
            <label class="label__heading">Debljina papira</label>
            <label for="80">
              <input type="radio" id="80" name="paperWidth" value="80gr/m2" 
				<?php echo (isset($_POST['paperWidth']) && $_POST['paperWidth'] == '80gr/m2') || !isset($_POST['paperWidth']) ? "checked" : "" ?>>
              <span>80 gr/m<sup>2</sup></span>
            </label>
            <label for="100">
              <input type="radio" id="100" name="paperWidth" value="100gr/m2" 
				<?php echo (isset($_POST['paperWidth']) && $_POST['paperWidth'] == '100gr/m2') ? "checked" : "" ?>>
              <span>100 gr/m<sup>2</sup></span>
            </label>
            <!-- ***************************** -->


            <!-- KORICENJE -->
            <label class="label__heading">Koričenje</label>
            <label for="bindingTypePlastic">
              <input type="radio" id="bindingTypePlastic" name="bindingType" value="Plasticnom spiralom"
				<?php echo (isset($_POST['bindingType']) && $_POST['bindingType'] == 'Plasticnom spiralom') || !isset($_POST['bindingType']) ? "checked" : "" ?>>
              <span>Plastičnom spiralom</span>
            </label>
            <label for="bindingTypeWire">
              <input type="radio" id="bindingTypeWire" name="bindingType" value="Zicanom spiralom" 
				<?php echo (isset($_POST['bindingType']) && $_POST['bindingType'] == 'Zicanom spiralom') ? "checked" : "" ?>>
              <span>Žičanom spiralom</span>
            </label>
            <label for="bindingTypeHard">
              <input type="radio" id="bindingTypeHard" name="bindingType" value="Tvrdo koricenje"
				<?php echo (isset($_POST['bindingType']) && $_POST['bindingType'] == 'Tvrdo koricenje') ? "checked" : "" ?>>
              <span>Tvrdo koričenje</span>
            </label>
            <!-- Upload korice dugme -->
            <label class="label__heading">Okačite koricu</label>
			      <input type='file' name='bindingFileToUpload' accept='.jpe,.jpg,.jpeg,.png,.pdf'>
			<input type='hidden' name="bindingFileToUploadName" value="<?php echo isset($_FILES['bindingFileToUpload']) ? $_FILES['bindingFileToUpload']['name'] : ''?>">
            <!-- ***************************** -->

            <!-- HEFTANJE -->
              <label for="heftingType" class="label__heading">Heftanje</label>
              <select class="u-full-width" name="heftingType">
                <option value="Gore levo" selected>Gore levo</option>
                <option value="Gore desno" <?php echo isset($_POST['heftingType']) && $_POST['heftingType'] == 'Gore desno' ? "selected" : "" ?>>Gore desno</option>
                <option value="Dole levo" <?php echo isset($_POST['heftingType']) && $_POST['heftingType'] == 'Dole levo' ? "selected" : "" ?>>Dole levo</option>
                <option value="Dole desno" <?php echo isset($_POST['heftingType']) && $_POST['heftingType'] == 'Dole desno' ? "selected" : "" ?>>Dole desno</option>
                <option value="Po sredini levo" <?php echo isset($_POST['heftingType']) && $_POST['heftingType'] == 'Po sredini levo' ? "selected" : "" ?>>Po sredini levo</option>
                <option value="Po sredini desno" <?php echo isset($_POST['heftingType']) && $_POST['heftingType'] == 'Po sredini desno' ? "selected" : "" ?>>Po sredini desno</option>
                <option value="Po sredini gore" <?php echo isset($_POST['heftingType']) && $_POST['heftingType'] == 'Po sredini gore' ? "selected" : "" ?>>Po sredini gore</option>
                <option value="Po sredini dole" <?php echo isset($_POST['heftingType']) && $_POST['heftingType'] == 'Po sredini dole' ? "selected" : "" ?>>Po sredini dole</option>
              </select>
            <!-- ***************************** -->


            <!-- BUSENJE -->
              <label for="drillingType" class="label__heading">Bušenje</label>
              <select class="u-full-width" name="drillingType">
                <option value="Dve rupe za registrator levo" selected>Dve rupe za registrator levo</option>
                <option value="Dve rupe za registrator desno" <?php echo isset($_POST['drillingType']) && $_POST['drillingType'] == 'Dve rupe za registrator desno' ? "selected" : "" ?>>Dve rupe za registrator desno</option>
                <option value="Dve rupe za registrator gore" <?php echo isset($_POST['drillingType']) && $_POST['drillingType'] == 'Dve rupe za registrator gore' ? "selected" : "" ?>>Dve rupe za registrator gore</option>
                <option value="Dve rupe za registrator dole" <?php echo isset($_POST['drillingType']) && $_POST['drillingType'] == 'Dve rupe za registrator dole' ? "selected" : "" ?>>Dve rupe za registrator dole</option>
              </select>
            <!-- ***************************** -->

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
        
            <!-- Krajnja poruka -->
            <label for="message" class="label__heading">Poruka</label>
            <textarea class="u-full-width" placeholder="Dodatni komentar ..." name="comment"><?php echo isset($_POST['comment']) ? $_POST['comment'] : "" ?></textarea>
            <label class="sendCopy" for="sendCopy">
              <input type="checkbox" id="sendCopy" name="sendCopy"
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
			<?php }?>			
			<?php } ?>			
			<input type="hidden" name="orderType" id="orderType" value="stampanje">
			<input type="hidden" id="successMessage" value="Uspešno naručeno.">
            <input class="button-primary" type="submit" value="Pošalji" name="submit">
            <p class="uslovi" style="font-size:1.3rem; font-style: italic;">Narudzbinom prihvatam uslove poslovanja.</p> 
          </div>
      </form>
    </section>

<?php
include("../footer.php");
?>
