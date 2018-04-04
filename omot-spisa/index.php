<?php

@session_start();
include("../header.php");

require_once '../functions/functions.php';

if(isset($_POST['submit'])) {
	try{
		echo "<div id='pictureModal' class='picture-modal'>
			 <span class='picture-close'>&times;</span>
			  <img id='pictureContent' class='picture-modal-content' 
				src='../functions/createPicture.php?". http_build_query($_POST) ."'>
			 <button id='paymentConfirm'>Ok</button>
			</div>";
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
                    <a class="tile" href="./" style="font-size: 1.6rem;">Omot spisa</a>
                </li>
            </ul>
        </div>
        <!-- End of navigation -->


        <!--Stampanje section-->
        <section class="section__stampanje">
            <h2 class="section__heading">Omot Spisa</h2>

            <!-- OVDE POCINJE FORMA ** -->
            <form method="POST" name="orderForm" action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                <div class="form-box">
				<!-- Paragraf za povratnu poruku -->		
				<p style="font-size:2rem; font-style: italic;" id="statusMessage"></p>

                    <!-- ZA -->
                    <label class="label__heading">Za</label>
                    <label for="Javni izvrsitelj">
                        <input type="radio" name="forInput" id="Javni izvrsitelj" value="Javni izvrsitelj" 
							<?php echo (isset($_POST['forInput']) && $_POST['forInput'] == 'Javni izvrsitelj') || !isset($_POST['forInput']) ? "checked" : "" ?> >
                        <span>Javni izvršitelj</span>
                    </label>
                    <label for="Javni beleznik">
                        <input type="radio" name="forInput" id="Javni beleznik" value="Javni beleznik"
							<?php echo isset($_POST['forInput']) && $_POST['forInput'] == 'Javni beleznik' ? "checked" : ""?>>
                        <span>Javni beležnik</span>
                    </label>
                    <label for="Advokat">
                        <input type="radio" name="forInput" id="Advokat" value="Advokat" 
							<?php echo isset($_POST['forInput']) && $_POST['forInput'] == 'Advokat' ? "checked" : ""?>>
                        <span>Advokat</span>
                    </label>
                    <!-- ***************************** -->

                    <!--Ime i prezime ******************************-->
                    <label for="nameLastname" class="label__heading">Ime i prezime</label>
                    <input name="nameLastname" class="u-full-width" type="text" 
						value="<?php echo isset($_POST['nameLastname']) ? $_POST['nameLastname'] : '' ?>" >
                    <!-- ***************************** -->

                    <!--Ulica ******************************-->
                    <label for="address" class="label__heading">Ulica</label>
                    <input name="address" class="u-full-width" type="text" 
						value="<?php echo isset($_POST['address']) ? $_POST['address'] : '' ?>" >
                    <!-- ***************************** -->

                    <!--Mesto ******************************-->
                    <label for="location" class="label__heading">Mesto</label>
                    <input name="location"  class="u-full-width" type="text" 
						value="<?php echo isset($_POST['location']) ? $_POST['location'] : '' ?>" >
                    <!-- ***************************** -->

                    <!-- Vrsta papira ***************************** -->
                    <label class="label__heading">Vrsta papira</label>
                    <label for="100gr/m2">
                        <input type="radio" name="typeOfPaper" id="100gr/m2" value="100gr/m2" 
							<?php echo (isset($_POST['typeOfPaper']) && $_POST['typeOfPaper'] == '100gr/m2') || !isset($_POST['typeOfPaper']) ? "checked" : "" ?>>
                        <span>100gr/m<sup>2</span>
                    </label>
                    <label for="300gr/m2" class="label__heading">
                        <input type="radio" name="typeOfPaper" id="300gr/m2" value="300gr/m2" 
							<?php echo isset($_POST['typeOfPaper']) && $_POST['typeOfPaper'] == '300gr/m2' ? "checked" : ""?>>
                        <span>300gr/m<sup>2</span>
                    </label>
                    <!-- ***************************** -->

                    <!-- Kolicina -->
                    <label for="quantity" class="label__heading">Količina</label>
                    <select class="u-full-width" name="quantity">
                        <option value="1000" selected>1000</option>
                        <option value="2000" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '2000' ? "selected" : "" ?>>2000</option>
                        <option value="3000" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '3000' ? "selected" : "" ?>>3000</option>
                        <option value="4000" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '4000' ? "selected" : "" ?>>4000</option>
                        <option value="5000" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '5000' ? "selected" : "" ?>>5000</option>
                        <option value="6000" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '6000' ? "selected" : "" ?>>6000</option>
                        <option value="7000" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '7000' ? "selected" : "" ?>>7000</option>
                        <option value="8000" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '8000' ? "selected" : "" ?>>8000</option>
                        <option value="9000" <?php echo isset($_POST['quantity']) && $_POST['quantity'] == '9000' ? "selected" : "" ?>>9000</option>
                    </select>
                    <!-- ***************************** -->

                    <!-- Krajnja poruka -->
                        <label for="message" class="label__heading">Poruka</label>
                        <textarea class="u-full-width" placeholder="Dodatni komentar ..." name="comment"><?php if(isset($_POST['comment'])) { echo htmlentities($_POST['comment']); }?></textarea>
                        <label class="sendCopy">
                            <input type="checkbox" id="sendCopy" name="sendCopy" 
								<?php echo isset($_POST['sendCopy']) ? 'checked' : ''?>>
                            <span class="label-body">Pošalji kopiju sebi</span>
                            <input type="text" placeholder="Upišite Vas email" id="sendCopyEmail" name="sendCopyEmail" 
							value="<?php echo isset($_POST['sendCopyEmail']) ? $_POST['sendCopyEmail'] : '' ?>">
                        </label>
						<input type="hidden" name="orderType" id="orderType" value="omot-spisa">
						<input type="hidden" id="successMessage" value="Omot spisa je uspešno naručen.">
                        <input class="button-primary" type="submit" value="Pošalji" name="submit" >
                        <p class="uslovi" style="font-size:1.3rem; font-style: italic;">Narudzbinom prihvatam uslove poslovanja.</p>
                </div>
            </form>
        </section>
<?php
	include("../footer.php");
?>