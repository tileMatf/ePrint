<?php
@session_start();

	if(!isset($_SESSION['user_info'])){
		header("Location: ../");
		exit();
	}
	include("../header.php");
	require_once("../registration/connection.php");
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
                    <a class="tile" href="./" style="font-size: 1.6rem;">Sačuvane narudžbine</a>
                </li>
            </ul>
        </div>
        <!-- End of navigation -->

        <section class="section__stampanje">
            <h2 class="section__heading">Sačuvane narudžbine</h2>

			<div class="12 columns">
			  <h3>Štampanje</h3>
			</div>
			<!-- tabela -->
			<table class="u-full-width">
			  <thead>
				<tr>
				  <th>Datum</th>
				  <th>Datoteka</th>
				</tr>
			  </thead>
			  <tbody>
				<?php
					$db = new DB();
					$orders = $db->getOrders($_SESSION['user_info']->ID, 100);
					//$orders = $db->getSavedOrders($_SESSION['user_info']->ID, 'Stampanje');
					if($orders != null){
						for($i = 0; $i < count($orders[0]); $i++){
							echo '<tr class="clickable" name="orderRow">
									<form method="post" action="open_order.php">
										<input type="hidden" name="orderType" value="stampanje"/>					
										<input type="hidden" name="orderObject" value=\''.json_encode($orders[0][$i]).'\'>
										<td>'.$orders[0][$i]->OrderDate.'</td>
										<td>'.$orders[0][$i]->FileName.'</td>
									</form>
								</tr>';
						}
					} else {
						echo '<tr><td></td><td></td><td></td></tr>'; 	
					}
				?>
			  </tbody>
			</table>

			<div class="12 columns">
			  <h3>Preslikavajući blokovi</h3>
			</div>
			<!-- tabela -->
			<table class="u-full-width">
			  <thead>
				<tr>
				  <th>Datum</th>
				  <th>Datoteka</th>
				</tr>
			  </thead>
			  <tbody>
				<?php
					//$orders = $db->getSavedOrders($_SESSION['user_info']->ID, 'Preslikavajuci blokovi');
					if($orders != null){
						for($i = 0; $i < count($orders[1]); $i++){
							echo '<tr class="clickable" name="orderRow">
									<form method="post" action="open_order.php">
										<input type="hidden" name="orderType" value="blokovi"/>					
										<input type="hidden" name="orderObject" value=\''.json_encode($orders[1][$i]).'\'>
										<td>'.json_encode($orders[1][$i]).'</td>
										<td>'.$orders[1].'</td>
									</form>
								</tr>';
						}
					} else {
						echo '<tr><td></td><td></td><td></td></tr>'; 	
					}
				?>
			  </tbody>
			</table>
			
			<div class="12 columns">
			  <h3>Uplatnice</h3>
			</div>
			<!-- tabela -->
			<table class="u-full-width">
			  <thead>
				<tr>
				  <th>Datum</th>
				  <th>Primalac</th>
				</tr>
			  </thead>
			  <tbody>
				<?php
					if($orders != null){
						for($i = 0; $i < count($orders[2]); $i++){
							echo '<tr class="clickable" name="orderRow">
									<form method="post" action="open_order.php">
										<input type="hidden" name="orderType" value="uplatnice/nalog-za-uplatu"/>					
										<input type="hidden" name="orderObject" value=\''.json_encode($orders[2][$i]).'\'>
										<td>'.$orders[2][$i]->OrderDate.'</td>
										<td>'.$orders[2][$i]->Name.'</td>
									</form>
								</tr>';
						}
					} else {
						echo '<tr><td></td><td></td><td></td></tr>'; 	
					}
				?>
			  </tbody>
			</table>
			
						<div class="12 columns">
			  <h3>Isplate</h3>
			</div>
			<!-- tabela -->
			<table class="u-full-width">
			  <thead>
				<tr>
				  <th>Datum</th>
				  <th>Primalac</th>
				</tr>
			  </thead>
			  <tbody>
				<?php
					if($orders != null){
						for($i = 0; $i < count($orders[3]); $i++){
							echo '<tr class="clickable" name="orderRow">
									<form method="post" action="open_order.php">
										<input type="hidden" name="orderType" value="uplatnice/nalog-za-isplatu"/>					
										<input type="hidden" name="orderObject" value=\''.json_encode($orders[3][$i]).'\'>
										<td>'.$orders[3][$i]->OrderDate.'</td>
										<td>'.$orders[3][$i]->Name.'</td>
									</form>
								</tr>';
						}
					} else {
						echo '<tr><td></td><td></td><td></td></tr>'; 	
					}
				?>
			  </tbody>
			</table>

			<div class="12 columns">
			  <h3>Nalozi za prenos</h3>
			</div>
			<!-- tabela -->
			<table class="u-full-width">
			  <thead>
				<tr>
				  <th>Datum</th>
				  <th>Primalac</th>
				</tr>
			  </thead>
			  <tbody>
				<?php
					if($orders != null){
						for($i = 0; $i < count($orders[4]); $i++){
							echo '<tr class="clickable" name="orderRow">
									<form method="post" action="open_order.php">
										<input type="hidden" name="orderType" value="uplatnice/nalog-za-prenos"/>					
										<input type="hidden" name="orderObject" value=\''.json_encode($orders[4][$i]).'\'>
										<td>'.$orders[4][$i]->OrderDate.'</td>
										<td>'.$orders[4][$i]->Name.'</td>
									</form>
								</tr>';
						}
					} else {
						echo '<tr><td></td><td></td><td></td></tr>'; 	
					}
				?>
			  </tbody>
			</table>
		
			<div class="12 columns">
			  <h3>Koverte sa povratnicom</h3>
			</div>
			<!-- tabela -->
			<table class="u-full-width">
			  <thead>
				<tr>
				  <th>Datum</th>
				  <th>Količina</th>
				</tr>
			  </thead>
			  <tbody>
				<?php
					if($orders != null){
						for($i = 0; $i < count($orders[5]); $i++){
							echo '<tr class="clickable" name="orderRow">
									<form method="post" action="open_order.php">
										<input type="hidden" name="orderType" value="koverte-dostavnice-formulari/koverte-sa-povratnicom"/>					
										<input type="hidden" name="orderObject" value=\''.json_encode($orders[5][$i]).'\'>
										<td>'.$orders[5][$i]->OrderDate.'</td>
										<td>'.$orders[5][$i]->Quantity.'</td>
									</form>
								</tr>';
						}
					} else {
						echo '<tr><td></td><td></td><td></td></tr>'; 	
					}
				?>
			  </tbody>
			</table>
			
			<div class="12 columns">
			  <h3>Dostavnice</h3>
			</div>
			<!-- tabela -->
			<table class="u-full-width">
			  <thead>
				<tr>
				  <th>Datum</th>
				  <th>Primalac</th>
				</tr>
			  </thead>
			  <tbody>
				<?php
					if($orders != null){
						for($i = 0; $i < count($orders[6]); $i++){
							echo '<tr class="clickable" name="orderRow">
									<form method="post" action="open_order.php">
										<input type="hidden" name="orderType" value="koverte-dostavnice-formulari/dostavnice"/>					
										<input type="hidden" name="orderObject" value=\''.json_encode($orders[6][$i]).'\'>
										<td>'.$orders[6][$i]->OrderDate.'</td>
										<td>'.$orders[6][$i]->Name.'</td>
									</form>
								</tr>';
						}
					} else {
						echo '<tr><td></td><td></td><td></td></tr>'; 	
					}
				?>
			  </tbody>
			</table>
			
			<div class="12 columns">
			  <h3>Koverte sa dostavnicom</h3>
			</div>
			<!-- tabela -->
			<table class="u-full-width">
			  <thead>
				<tr>
				  <th>Datum</th>
				  <th>Primalac</th>
				</tr>
			  </thead>
			  <tbody>
				<?php
					if($orders != null){
						for($i = 0; $i < count($orders[7]); $i++){
							echo '<tr class="clickable" name="orderRow">
									<form method="post" action="open_order.php">
										<input type="hidden" name="orderType" value="koverte-dostavnice-formulari/koverte-sa-dostavnicom"/>					
										<input type="hidden" name="orderObject" value=\''.json_encode($orders[7][$i]).'\'>
										<td>'.$orders[7][$i]->OrderDate.'</td>
										<td>'.$orders[7][$i]->Name.'</td>
									</form>
								</tr>';
						}
					} else {
						echo '<tr><td></td><td></td><td></td></tr>'; 	
					}
				?>
			  </tbody>
			</table>

			<div class="12 columns">
			  <h3>Formulari za adresiranje</h3>
			</div>
			<!-- tabela -->
			<table class="u-full-width">
			  <thead>
				<tr>
				  <th>Datum</th>
				  <th>Količina</th>
				</tr>
			  </thead>
			  <tbody>
				<?php
					if($orders != null){
						for($i = 0; $i < count($orders[8]); $i++){
							echo '<tr class="clickable" name="orderRow">
									<form method="post" action="open_order.php">
										<input type="hidden" name="orderType" value="koverte-dostavnice-formulari/formulari-za-adresiranje"/>					
										<input type="hidden" name="orderObject" value=\''.json_encode($orders[8][$i]).'\'>
										<td>'.$orders[8][$i]->OrderDate.'</td>
										<td>'.$orders[8][$i]->Quantity.'</td>
									</form>
								</tr>';
						}
					} else {
						echo '<tr><td></td><td></td><td></td></tr>'; 	
					}
				?>
			  </tbody>
			</table>
			
			<div class="12 columns">
			  <h3>Standardne koverte</h3>
			</div>
			<!-- tabela -->
			<table class="u-full-width">
			  <thead>
				<tr>
				  <th>Datum</th>
				  <th>Prvi red na poleđini</th>
				</tr>
			  </thead>
			  <tbody>
				<?php
					if($orders != null){
						for($i = 0; $i < count($orders[9]); $i++){
							echo '<tr class="clickable" name="orderRow">
									<form method="post" action="open_order.php">
										<input type="hidden" name="orderType" value="koverte-dostavnice-formulari/standardne-koverte"/>					
										<input type="hidden" name="orderObject" value=\''.json_encode($orders[9][$i]).'\'>
										<td>'.$orders[9][$i]->OrderDate.'</td>
										<td>'.$orders[9][$i]->BackPrintRow1.'</td>
									</form>
								</tr>';
						}
					} else {
						echo '<tr><td></td><td></td><td></td></tr>'; 	
					}
				?>
			  </tbody>
			</table>
			
			<div class="12 columns">
			  <h3>Omoti spisa</h3>
			</div>
			<!-- tabela -->
			<table class="u-full-width">
			  <thead>
				<tr>
				  <th>Datum</th>
				  <th>Primalac</th>
				</tr>
			  </thead>
			  <tbody>
				<?php
					if($orders != null){
						for($i = 0; $i < count($orders[10]); $i++){
							echo '<tr class="clickable" name="orderRow">
									<form method="post" action="open_order.php">
										<input type="hidden" name="orderType" value="omot-spisa"/>					
										<input type="hidden" name="orderObject" value=\''.json_encode($orders[10][$i]).'\'>
										<td>'.$orders[10][$i]->OrderDate.'</td>
										<td>'.$orders[10][$i]->Name.'</td>
									</form>
								</tr>';
						}
					} else {
						echo '<tr><td></td><td></td><td></td></tr>'; 	
					}
				?>
			  </tbody>
			</table>
			
		</section>

<?php
include("../footer.php");
?>
