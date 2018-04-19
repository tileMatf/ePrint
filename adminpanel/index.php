<?php
	//@session_start();
	//if(isset($_SESSION['user_info']) && $_SESSION['user_info']->Role === '1'){
?>

<!DOCTYPE html>
<html lang="sr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ePrint admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0,  shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="http://localhost/eprint/css/normalize.css">
  <link rel="stylesheet" href="http://localhost/eprint/css/skeleton.css">
  <!--Font from Google-->
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600&amp;subset=latin-ext" rel="stylesheet" type="text/css">
  <!--Favicon-->
  <link rel="icon" type="image/png" href="http://localhost/eprint/images/favicon.png">
  <link rel="apple-touch-icon" href="http://localhost/eprint/images/icon.png">

  <!--Internal style sheet-->
  <style>

    * {
      margin: 0;
      padding: 0;
    }

    body {
      background-color: linen;
    }

    header {
      background-color: #4CAF50;
      text-align: center;
      margin-bottom: 40px;
      padding: 10px 10px;
    }

    h3 {
			font-size: 24px;
			font-weight: bold;
      color: #444;
      text-align: center;
      margin-bottom: 30px;
			margin-top: 100px;
    }

		        h3::after {
                background: #a5faa9;
                content: "";
                display: block;
                height: 1px;
								padding-top: 2px;
                width: 200px;
                margin-top: 10px;
								margin-left: auto;
								margin-right: auto;
            }

		.first { margin-top: 0 !important; margin-bottom: 30px !important; }

    p {
      color: #FFF;
      margin: 0;
      padding: 0;
    }

    a {
      text-decoration: none;
      color: #FFF;
    }

    a:hover {
      color:#a7f3a7;
    }

		 button.admin-button {
			 background-color: #4CAF50;
			 border: none;
		 }

		 button.admin-button:hover{
			 background-color: #4CBA51;
		 }

  </style>
</head>

<body>
  	<form name="logoutForm">
	  <header>
		<div class="row">
		  <div class="six columns">
			<p>Dobrodosli, admine</p>
		  </div>
		  <div class="six columns">
				<a name="logout" href="">Izloguj se</a>
		  </div>
		</div>
	  </header>
  	</form>

  <div class="container">
    <!-- stampanje naslov iznad tabele -->
    <div class="12 columns">
      <h3 class="first">Štampanje</h3>
    </div>
    <!-- tabela -->
    <table class="u-full-width">
      <thead>
        <tr>
          <th>Datum</th>
          <th>Korisnik</th>
          <th>Datoteka</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
		<?php
			include("../registration/connection.php");
			$db = new DB();
			$orders = $db->getUnseenOrders('Stampanje');
			if($orders != null){
				for($i = 0; $i < count($orders); $i++){
					echo '<form action="../registration/checkOrder.php" method="POST"><tr>
							<td>'.$orders[$i]->OrderDate.'</td>
							<td>'.$orders[$i]->Email.'</td>
							<td>'.$orders[$i]->FileName.'</td>
							<td>
								<input type="hidden" name="orderID" value="'.$orders[$i]->OrderID.'">
								<button class="button-primary admin-button" name="checkOrder" title = "Označiti kao završenu narudžbinu">
									Urađeno
								</button>
							 </td>
							</tr> 
						</form>';
				}
			} else {
				echo '<tr><td>Nema novih narudžbina</td><td></td><td></td></tr>'; 	
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
          <th>Korisnik</th>
          <th>Datoteka</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
		<?php
			$orders = $db->getUnseenOrders('Preslikavajuci blokovi');
			if($orders != null){
				for($i = 0; $i < count($orders); $i++){
					echo '<form action="../registration/checkOrder.php" method="POST">
							<tr>
							  <td>'.$orders[$i]->OrderDate.'</td>
							  <td>'.$orders[$i]->Email.'</td>
							  <td>'.$orders[$i]->FileName.'</td>
							  <td>
									<input type="hidden" name="orderID" value="'.$orders[$i]->OrderID.'">
									<button class="button-primary admin-button" name="checkOrder" title = "Označiti kao završenu narudžbinu">
										Urađeno
									</button>
							  </td>
							</tr>
						</form>';
				}
			} else {
				echo '<tr><td>Nema novih narudžbina</td><td></td><td></td></tr>'; 	
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
          <th>Korisnik</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
		<?php
			$orders = $db->getUnseenOrders('Uplate');
			if($orders != null){
				for($i = 0; $i < count($orders); $i++){
					echo '<form action="../registration/checkOrder.php" method="POST">
							<tr>
							  <td>'.$orders[$i]->OrderDate.'</td>
							  <td>'.$orders[$i]->Email.'</td>
							  <td>
									<input type="hidden" name="orderID" value="'.$orders[$i]->OrderID.'">
									<button class="button-primary admin-button" name="checkOrder" title = "Označiti kao završenu narudžbinu">
										Urađeno
									</button>
							  </td>
							</tr>
						 </form>';
				}
			} else {
				echo '<tr><td>Nema novih narudžbina</td><td></td></tr>'; 	
			}
		?>
      </tbody>
    </table>

	<div class="12 columns">
      <h3>Isplatnice</h3>
    </div>
    <!-- tabela -->
    <table class="u-full-width">
      <thead>
        <tr>
          <th>Datum</th>
          <th>Korisnik</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
		<?php
			$orders = $db->getUnseenOrders('Isplate');
			if($orders != null){
				for($i = 0; $i < count($orders); $i++){
					echo '<form action="../registration/checkOrder.php" method="POST">
							<tr>
							  <td>'.$orders[$i]->OrderDate.'</td>
							  <td>'.$orders[$i]->Email.'</td>
							  <td>
									<input type="hidden" name="orderID" value="'.$orders[$i]->OrderID.'">
									<button class="button-primary admin-button" name="checkOrder" title = "Označiti kao završenu narudžbinu">
										Urađeno
									</button>
							  </td>
							</tr>
						</form>';
				}
			} else {
				echo '<tr><td>Nema novih narudžbina</td><td></td></tr>'; 	
			}
		?>
      </tbody>
    </table>
	
	<div class="12 columns">
      <h3>Prenosnice</h3>
    </div>
    <!-- tabela -->
    <table class="u-full-width">
      <thead>
        <tr>
          <th>Datum</th>
          <th>Korisnik</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
		<?php
			$orders = $db->getUnseenOrders('Prenos');
			if($orders != null){
				for($i = 0; $i < count($orders); $i++){
					echo '<form action="../registration/checkOrder.php" method="POST">
							<tr>
							  <td>'.$orders[$i]->OrderDate.'</td>
							  <td>'.$orders[$i]->Email.'</td>
							  <td>
								<input type="hidden" name="orderID" value="'.$orders[$i]->OrderID.'">
								<button class="button-primary admin-button" name="checkOrder" title = "Označiti kao završenu narudžbinu">
									Urađeno
								</button>
    						 </td>
							</tr>
						</form>';
				}
			} else {
				echo '<tr><td>Nema novih narudžbina</td><td></td></tr>'; 	
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
          <th>Korisnik</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
		<?php
			$orders = $db->getUnseenOrders('Koverta-sa-povratnicom');
			if($orders != null){
				for($i = 0; $i < count($orders); $i++){
					echo '<form action="../registration/checkOrder.php" method="POST">
							<tr>
							  <td>'.$orders[$i]->OrderDate.'</td>
							  <td>'.$orders[$i]->Email.'</td>
							  <td>
								<input type="hidden" name="orderID" value="'.$orders[$i]->OrderID.'">
								<button class="button-primary admin-button" name="checkOrder" title = "Označiti kao završenu narudžbinu">
									Urađeno
								</button>
							  </td>
						  </tr>
						</form>';
				}
			} else {
				echo '<tr><td>Nema novih narudžbina</td><td></td></tr>'; 	
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
          <th>Korisnik</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
		<?php
			$orders = $db->getUnseenOrders('Dostavnica');
			if($orders != null){
				for($i = 0; $i < count($orders); $i++){
					echo '<form action="../registration/checkOrder.php" method="POST">
							<tr>
							  <td>'.$orders[$i]->OrderDate.'</td>
							  <td>'.$orders[$i]->Email.'</td>
							  <td>								
								<input type="hidden" name="orderID" value="'.$orders[$i]->OrderID.'">
								<button class="button-primary admin-button" name="checkOrder" title = "Označiti kao završenu narudžbinu">
									Urađeno
								</button>
							  </td>
							</tr>
						</form>';
				}
			} else {
				echo '<tr><td>Nema novih narudžbina</td><td></td></tr>'; 	
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
          <th>Korisnik</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
		<?php
			$orders = $db->getUnseenOrders('Koverta-sa-dostavnicom');
			if($orders != null){
				for($i = 0; $i < count($orders); $i++){
					echo '<form action="../registration/checkOrder.php" method="POST">
							<tr>
							  <td>'.$orders[$i]->OrderDate.'</td>
							  <td>'.$orders[$i]->Email.'</td>
							  <td>
								<input type="hidden" name="orderID" value="'.$orders[$i]->OrderID.'">
								<button class="button-primary admin-button" name="checkOrder" title = "Označiti kao završenu narudžbinu">
									Urađeno
								</button>
							  </td>
							</tr>
						</form>';
				}
			} else {
				echo '<tr><td>Nema novih narudžbina</td><td></td></tr>'; 	
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
          <th>Korisnik</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
		<?php
			$orders = $db->getUnseenOrders('Formular-za-adresiranje');
			if($orders != null){
				for($i = 0; $i < count($orders); $i++){
					echo '<form action="../registration/checkOrder.php" method="POST">
							<tr>
							  <td>'.$orders[$i]->OrderDate.'</td>
							  <td>'.$orders[$i]->Email.'</td>
							  <td>
								<input type="hidden" name="orderID" value="'.$orders[$i]->OrderID.'">
								<button class="button-primary admin-button" name="checkOrder" title = "Označiti kao završenu narudžbinu">
									Urađeno
								</button>
							  </form>
						  </td>
					  </tr>
					</form>';
				}
			} else {
				echo '<tr><td>Nema novih narudžbina</td><td></td></tr>'; 	
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
          <th>Korisnik</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
		<?php
			$orders = $db->getUnseenOrders('Standardna-koverta');
			if($orders != null){
				for($i = 0; $i < count($orders); $i++){
					echo '<form action="../registration/checkOrder.php" method="POST">
							<tr>
							  <td>'.$orders[$i]->OrderDate.'</td>
							  <td>'.$orders[$i]->Email.'</td>
							  <td>
								<input type="hidden" name="orderID" value="'.$orders[$i]->OrderID.'">
								<button class="button-primary admin-button" name="checkOrder" title = "Označiti kao završenu narudžbinu">
									Urađeno
								</button>
							  </td>
						  </tr>
						</form>';
				}
			} else {
				echo '<tr><td>Nema novih narudžbina</td><td></td></tr>'; 	
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
          <th>Korisnik</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
		<?php
			$orders = $db->getUnseenOrders('Omot-spisa');
			if($orders != null){
				for($i = 0; $i < count($orders); $i++){
					echo '<form action="../registration/checkOrder.php" method="POST">
							<tr>
							  <td>'.$orders[$i]->OrderDate.'</td>
							  <td>'.$orders[$i]->Email.'</td>
							  <td>
								<input type="hidden" name="orderID" value="'.$orders[$i]->OrderID.'">
								<button class="button-primary admin-button" name="checkOrder" title = "Označiti kao završenu narudžbinu">
									Urađeno
								</button>
							  </td>
						  </tr>
						</form>';
				}
			} else {
				echo '<tr><td>Nema novih narudžbina</td><td></td></tr>'; 	
			}
		?>
      </tbody>
    </table>
	
  </div>  
  	<!-- JS files -->	
	<script src="http://localhost/eprint/js/main.js"></script>  
</body>

</html>
<?php
	//} else {
	//	header('Location: ../');
	//	exit();
	//}
?>