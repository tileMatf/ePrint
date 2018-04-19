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


        <!--Stampanje section-->
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
</section>

<?php
include("../footer.php");
?>
