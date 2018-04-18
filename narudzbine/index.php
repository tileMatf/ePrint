<?php
@session_start();

	if(!isset($_SESSION['user_info'])){
		header("Location: ../");
		exit();
	}
	include("../header.php");
	require_once("../registration/connection.php");
?>
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
			$orders = $db->getSavedOrders($_SESSION['user_info']->ID, 'Stampanje');
			if($orders != null){
				for($i = 0; $i < count($orders); $i++){
					echo '<tr class="clickable" name="orderRow">
								<input type="hidden" name="orderType" value="stampanje"/>					
								<input type="hidden" name="orderObject" value=\''.json_encode($orders[$i]).'\'>
								<td>'.$orders[$i]->OrderDate.'</td>
								<td>'.$orders[$i]->FileName.'</td>
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
			$orders = $db->getSavedOrders($_SESSION['user_info']->ID, 'Preslikavajuci blokovi');
			if($orders != null){
				for($i = 0; $i < count($orders); $i++){
					echo '<form action="" method="POST">
							<tr>
							  <td>'.$orders[$i]->OrderDate.'</td>
							  <td>'.$orders[$i]->FileName.'</td>
							</tr>
						</form>';
				}
			} else {
				echo '<tr><td></td><td></td><td></td></tr>'; 	
			}
		?>
      </tbody>
    </table>


<?php
include("../footer.php");
?>
