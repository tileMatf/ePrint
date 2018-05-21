<?php
	@session_start();
	
	if(!isset($_SESSION['user_info'])){
		header("Location: ../");
		exit();
	}
	include("../header.php");
?>
	<section class="section__stampanje">
		<div class="container">
			<h2 class="section__heading">Promena lozinke</h2>
		</div>
				
		<form name="changePassForm" id="changePassForm">
			<div class="form-box">
				<!-- Statusna poruka-->
				<p id="statusMessage"></p>				
				
				<!-- Stara lozinka-->
				<label for="oldPassword" class="label__heading">Stara lozinka</label>
				<input class="u-full-width" type="password" placeholder="" name="oldPassword" id="oldPassword" required>
				<!-- ****************************** -->

				<!-- Nova lozinka-->
				<label for="newPassword" class="label__heading">Nova lozinka</label>
				<input class="u-full-width" type="password" placeholder="" name="newPassword" id="newPassword" required>
				<!-- ****************************** -->

				<!-- Nova lozika ponovo -->
				<label for="confirmPassword" class="label__heading">Ponovite novu lozinku</label>
				<input class="u-full-width" type="password" placeholder="" name="confirmPassword" id="confirmPassword" required>
				<!-- ****************************** -->
				<input type="submit" value="Promeni" name="changePass" class="button-primary">
			</div>
		</form>
	</section>

<?php
	include("../footer.php");
?>