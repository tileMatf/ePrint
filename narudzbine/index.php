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
         <a class="tile" href="../">Početna</a>
      </li>
      <span class="line">/</span>
      <li>
         <a class="tile" href="./" style="font-size: 1.6rem;">Sačuvane narudžbine</a>
      </li>
   </ul>
</div>
<!-- End of navigation -->

<section class="section__stampanje section__narudzbine">
<div class="container">
   <h2 class="section__heading">Sačuvane narudžbine</h2>
   <div class="twelve columns">
      <h3>Štampanje</h3>
   </div>
   <!-- tabela -->
   <table class="container">
      <thead>
         <tr>
            <th>Datum</th>
            <th>Datoteka</th>
            <th>Datoteka korica</th>
            <th></th>
         </tr>
      </thead>
      <tbody>
         <?php
            $db = new DB();
            $orders = $db->getOrders($_SESSION['user_info']->ID, 100);
            //$orders = $db->getSavedOrders($_SESSION['user_info']->ID, 'Stampanje');
            if($orders != null){
            	for($i = 0; $i < count($orders[0]); $i++){
            		echo '<tr name="orderRow">							
            				<td>'.$orders[0][$i]->OrderDate.'</td>
            				<td>'.$orders[0][$i]->FileName.'</td>
            				<td>'.$orders[0][$i]->BindingFile.'</td>
            				<td>
            					<form method="post" action="../stampanje/">			
            						<input type="hidden" name="orderObject" value=\''.json_encode($orders[0][$i]).'\'>
            						<input class="buttonForm" type="submit" name="openOrderButton" value="Otvoriti">
            					</form>
            				</td>
            			</tr>';
            	}
            } else {
            	echo '<tr><td></td><td></td><td></td><td></td></tr>'; 	
            }
            ?>
      </tbody>
   </table>
   <div class="twelve columns">
      <h3>Preslikavajući blokovi</h3>
   </div>
   <!-- tabela -->
   <table class="container">
      <thead>
         <tr>
            <th>Datum</th>
            <th>Datoteka</th>
            <th></th>
         </tr>
      </thead>
      <tbody>
         <?php
            //$orders = $db->getSavedOrders($_SESSION['user_info']->ID, 'Preslikavajuci blokovi');
            if($orders != null){
            	for($i = 0; $i < count($orders[1]); $i++){
            		echo '<tr name="orderRow">
            					<td>'.$orders[1][$i]->OrderDate.'</td>
            					<td>'.$orders[1][$i]->FileName.'</td>
            					<td>
            						<form method="post" action="../blokovi/">			
            							<input type="hidden" name="orderObject" value=\''.json_encode($orders[1][$i]).'\'>
            							<input class="buttonForm" type="submit" name="openOrderButton" value="Otvoriti">
            						</form>
            					</td>
            				</form>
            			</tr>';
            	}
            } else {
            	echo '<tr><td></td><td></td><td></td></tr>'; 	
            }
            ?>
      </tbody>
   </table>
   <div class="twelve columns">
      <h3>Uplatnice</h3>
   </div>
   <!-- tabela -->
   <table class="container">
      <thead>
         <tr>
            <th>Datum</th>
            <th>Primalac</th>
            <th></th>
         </tr>
      </thead>
      <tbody>
         <?php
            if($orders != null){
            	for($i = 0; $i < count($orders[2]); $i++){
            		echo '<tr name="orderRow">
            				<td>'.$orders[2][$i]->OrderDate.'</td>
            				<td>'.$orders[2][$i]->Name.'</td>
            				<td>
            					<form method="post" action="../uplatnice/nalog-za-uplatu/">			
            						<input type="hidden" name="orderObject" value=\''.json_encode($orders[2][$i]).'\'>
            						<input class="buttonForm" type="submit" name="openOrderButton" value="Otvoriti">
            					</form>
            				</td>
            			</tr>';
            	}
            } else {
            	echo '<tr><td></td><td></td><td></td></tr>'; 	
            }
            ?>
      </tbody>
   </table>
   <div>
      <h3>Nalozi za isplatu</h3>
   </div>
   <!-- tabela -->
   <table class="container">
      <thead>
         <tr>
            <th>Datum</th>
            <th>Primalac</th>
            <th></th>
         </tr>
      </thead>
      <tbody>
         <?php
            if($orders != null){
            	for($i = 0; $i < count($orders[3]); $i++){
            		echo '<tr name="orderRow">
            				<td>'.$orders[3][$i]->OrderDate.'</td>
            				<td>'.$orders[3][$i]->Name.'</td>
            				<td>
            					<form method="post" action="../uplatnice/nalog-za-isplatu/">			
            						<input type="hidden" name="orderObject" value=\''.json_encode($orders[3][$i]).'\'>
            						<input class="buttonForm" type="submit" name="openOrderButton" value="Otvoriti">
            					</form>
            				</td>
            			</tr>';
            	}
            } else {
            	echo '<tr><td></td><td></td><td></td></tr>'; 	
            }
            ?>
      </tbody>
   </table>
   <div class="twelve columns">
      <h3>Nalozi za prenos</h3>
   </div>
   <!-- tabela -->
   <table class="container">
      <thead>
         <tr>
            <th>Datum</th>
            <th>Primalac</th>
            <th></th>
         </tr>
      </thead>
      <tbody>
         <?php
            if($orders != null){
            	for($i = 0; $i < count($orders[4]); $i++){
            		echo '<tr name="orderRow">
            				<td>'.$orders[4][$i]->OrderDate.'</td>
            				<td>'.$orders[4][$i]->Name.'</td>
            				<td>
            					<form method="post" action="../uplatnice/nalog-za-prenos/">			
            						<input type="hidden" name="orderObject" value=\''.json_encode($orders[4][$i]).'\'>
            						<input class="buttonForm" type="submit" name="openOrderButton" value="Otvoriti">
            					</form>
            				</td>
            			</tr>';
            	}
            } else {
            	echo '<tr><td></td><td></td><td></td></tr>'; 	
            }
            ?>
      </tbody>
   </table>
   <div class="twelve columns">
      <h3>Koverte sa povratnicom</h3>
   </div>
   <!-- tabela -->
   <table class="container">
      <thead>
         <tr>
            <th>Datum</th>
            <th>Količina</th>
            <th></th>
         </tr>
      </thead>
      <tbody>
         <?php
            if($orders != null){
            	for($i = 0; $i < count($orders[5]); $i++){
            		echo '<tr name="orderRow">
            				<td>'.$orders[5][$i]->OrderDate.'</td>
            				<td>'.$orders[5][$i]->Quantity.'</td>
            				<td>
            					<form method="post" action="../koverte-dostavnice-formulari/koverte-sa-povratnicom/">			
            						<input type="hidden" name="orderObject" value=\''.json_encode($orders[5][$i]).'\'>
            						<input class="buttonForm" type="submit" name="openOrderButton" value="Otvoriti">
            					</form>
            				</td>
            			</tr>';
            	}
            } else {
            	echo '<tr><td></td><td></td><td></td></tr>'; 	
            }
            ?>
      </tbody>
   </table>
   <div class="twelve columns">
      <h3>Dostavnice</h3>
   </div>
   <!-- tabela -->
   <table class="container">
      <thead>
         <tr>
            <th>Datum</th>
            <th>Primalac</th>
            <th></th>
         </tr>
      </thead>
      <tbody>
         <?php
            if($orders != null){
            	for($i = 0; $i < count($orders[6]); $i++){
            		echo '<tr name="orderRow">
            				<td>'.$orders[6][$i]->OrderDate.'</td>
            				<td>'.$orders[6][$i]->Name.'</td>
            				<td>
            					<form method="post" action="../koverte-dostavnice-formulari/dostavnice/">			
            						<input type="hidden" name="orderObject" value=\''.json_encode($orders[6][$i]).'\'>
            						<input class="buttonForm" type="submit" name="openOrderButton" value="Otvoriti">
            					</form>
            				</td>
            			</tr>';
            	}
            } else {
            	echo '<tr><td></td><td></td><td></td></tr>'; 	
            }
            ?>
      </tbody>
   </table>
   <div class="twelve columns">
      <h3>Koverte sa dostavnicom</h3>
   </div>
   <!-- tabela -->
   <table class="container">
      <thead>
         <tr>
            <th>Datum</th>
            <th>Primalac</th>
            <th>Tip koverte</th>
            <th></th>
         </tr>
      </thead>
      <tbody>
         <?php
            if($orders != null){
            	for($i = 0; $i < count($orders[7]); $i++){
            		echo '<tr name="orderRow">
            				<td>'.$orders[7][$i]->OrderDate.'</td>
            				<td>'.$orders[7][$i]->Name.'</td>
            				<td>'.$orders[7][$i]->EnvelopeType.'</td>
            				<td>
            					<form method="post" action="../koverte-dostavnice-formulari/koverte-sa-dostavnicom/">			
            						<input type="hidden" name="orderObject" value=\''.json_encode($orders[7][$i]).'\'>
            						<input class="buttonForm" type="submit" name="openOrderButton" value="Otvoriti">
            					</form>
            				</td>
            			</tr>';
            	}
            } else {
            	echo '<tr><td></td><td></td><td></td><td></td></tr>'; 	
            }
            ?>
      </tbody>
   </table>
   <div class="twelve columns">
      <h3>Formulari za adresiranje</h3>
   </div>
   <!-- tabela -->
   <table class="container">
      <thead>
         <tr>
            <th>Datum</th>
            <th>Količina</th>
            <th></th>
         </tr>
      </thead>
      <tbody>
         <?php
            if($orders != null){
            	for($i = 0; $i < count($orders[8]); $i++){
            		echo '<tr name="orderRow">
            				<td>'.$orders[8][$i]->OrderDate.'</td>
            				<td>'.$orders[8][$i]->Quantity.'</td>
            				<td>
            					<form method="post" action="../koverte-dostavnice-formulari/formulari-za-adresiranje/">			
            						<input type="hidden" name="orderObject" value=\''.json_encode($orders[8][$i]).'\'>
            						<input class="buttonForm" type="submit" name="openOrderButton" value="Otvoriti">
            					</form>
            				</td>
            			</tr>';
            	}
            } else {
            	echo '<tr><td></td><td></td><td></td></tr>'; 	
            }
            ?>
      </tbody>
   </table>
   <div class="twelve columns">
      <h3>Standardne koverte</h3>
   </div>
   <!-- tabela -->
   <table class="container">
      <thead>
         <tr>
            <th>Datum</th>
            <th>Veličina</th>
            <th>Prvi red na poleđini</th>
            <th></th>
         </tr>
      </thead>
      <tbody>
         <?php
            if($orders != null){
            	for($i = 0; $i < count($orders[9]); $i++){
            		echo '<tr name="orderRow">
            				<td>'.$orders[9][$i]->OrderDate.'</td>
            				<td>'.$orders[9][$i]->Size.'</td>
            				<td>'.$orders[9][$i]->Quantity.'</td>
            				<td>
            					<form method="post" action="../koverte-dostavnice-formulari/standardne-koverte/">			
            						<input type="hidden" name="orderObject" value=\''.json_encode($orders[9][$i]).'\'>
            						<input class="buttonForm" type="submit" name="openOrderButton" value="Otvoriti">
            					</form>
            				</td>
            			</tr>';
            	}
            } else {
            	echo '<tr><td></td><td></td><td></td><td></td></tr>'; 	
            }
            ?>
      </tbody>
   </table>
   <div class="twelve columns">
      <h3>Omoti spisa</h3>
   </div>
   <!-- tabela -->
   <table class="container">
      <thead>
         <tr>
            <th>Datum</th>
            <th>Primalac</th>
            <th>Količina</th>
            <th></th>
         </tr>
      </thead>
      <tbody>
         <?php
            if($orders != null){
            	for($i = 0; $i < count($orders[10]); $i++){
            		echo '<tr name="orderRow">
            				<td>'.$orders[10][$i]->OrderDate.'</td>
            				<td>'.$orders[10][$i]->Name.'</td>
            				<td>'.$orders[10][$i]->Quantity.'</td>
            				<td>
            					<form method="post" action="../omot-spisa/">			
            						<input type="hidden" name="orderObject" value=\''.json_encode($orders[10][$i]).'\'>
            						<input class="buttonForm" type="submit" name="openOrderButton" value="Otvoriti">
            					</form>
            				</td>
            			</tr>';
            	}
            } else {
            	echo '<tr><td></td><td></td><td></td><td></td></tr>'; 	
            }
            ?>
      </tbody>
   </table>
</section>
</div>
<?php
   include("../footer.php");
   ?>