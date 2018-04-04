<?php
@session_start();
include("../../header.php");

require_once '../../functions/functions.php';

if(isset($_POST['submit'])) {
	try{			
		echo "<div id='pictureModal' class='picture-modal'>
			 <span class='picture-close'>&times;</span>
			  <img id='pictureContent' class='picture-modal-content' 
				src='../../functions/createPicture.php?". http_build_query($_POST) ."'>
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
                    <a class="tile" href="../../">
                        <i class="fas fa-home" aria-hidden="true"></i>Početna</a>
                </li>
                <span class="line">/</span>
                <li>
                    <a class="tile" href="../">Koverte, dostavnice, formulari za adresiranje</a>
                </li>
                <span class="line">/</span>
                <li>
                    <a class="tile" href="./" style="font-size: 1.6rem;">Koverte sa povratnicom za štampanje</a>
                </li>
            </ul>
        </div>
        <!-- End of navigation -->


        <!--Stampanje section-->
        <section class="section__stampanje">
            <h2 class="section__heading">Koverte sa povratnicom za štampanje</h2>


            <!-- OVDE POCINJE FORMA ** -->
            <form method="POST" name="orderForm" action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="form-box">
				<!-- Paragraf za povratnu poruku -->		
				<p style="font-size:2rem; font-style: italic;" id="statusMessage"></p>
                    <!-- BOJA -->
                    <label class="label__heading">Boja</label>
                    <label for="plava">
                        <input type="radio" id="plava" name="color" value="plava"
						<?php echo (isset($_POST['color']) && $_POST['color'] == 'plava') || !isset($_POST['color']) ? "checked" : "" ?> >
                        <span>Plave</span>
                    </label>
                    <label for="bela">
                        <input type="radio" id="bela" name="color" value="bela" 
							<?php echo isset($_POST['color']) && $_POST['color'] == 'bela' ? "checked" : ""?> >
                        <span>Bele</span>
                    </label>

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

                    <label class="sendCopy">
                        <input type="checkbox" id="sendCopy" name="sendCopy">
                        <span class="label-body">Pošalji kopiju sebi</span>
                        <input type="text" placeholder="Upišite Vas email" id="sendCopyEmail" name="sendCopyEmail" 
							value="<?php echo isset($_POST['sendCopyEmail']) ? $_POST['sendCopyEmail'] : '' ?>">
                    </label>
					<input type="hidden" name="orderType" id="orderType" value="koverta-sa-povratnicom">
					<input type="hidden" id="successMessage" value="Koverte sa povratnicom su uspešno naručene.">
                    <input class="button-primary" type="submit" value="Pošalji" name="submit" />
                    <!-- Smisli kako ovo lepse da izgleda -->
                    <p class="uslovi" style="font-size:1.3rem; font-style: italic;">Narudzbinom prihvatam uslove poslovanja.</p> 
                </div>
            </form>
        </section>
<?php
	include("../../footer.php");
?>