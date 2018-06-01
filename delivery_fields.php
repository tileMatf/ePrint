						<br><br>						
						<p class='silver non-bottom-space'>Detalji o isporuci</p>
						<hr>
						<!-- Ime i prezime za isporuku-->
						<input class="u-full-width" type="text" placeholder="Ime i prezime primaoca isporuke" name="deliveryName" required
							value="<?php if(isset($order)) 
											echo $order['DeliveryName'];
										 else if(isset($_POST['deliveryName']))
											echo $_POST['deliveryName']; ?>">
						<!-- ****************************** -->
						
						<!-- Email adresa -->
						<input class="u-full-width" type="text" placeholder="Email adresa" name="deliveryEmail" required
							value="<?php if(isset($order)) 
											echo $order['DeliveryEmail'];
										 else if(isset($_POST['deliveryEmail']))
											echo $_POST['deliveryEmail']; ?>">
						<!-- ****************************** -->
						
						<!-- Telefon -->
						<input class="u-full-width" type="text" placeholder="Broj telefona" name="deliveryPhone" required
							value="<?php if(isset($order)) 
											echo $order['DeliveryPhone'];
										 else if(isset($_POST['deliveryPhone']))
											echo $_POST['deliveryPhone']; ?>">
						<!-- ****************************** -->

						<!-- Adresa isporuka-->
						<input class="u-full-width" type="text" placeholder="Adresa isporuke" name="deliveryAddress" required
							value="<?php if(isset($order)) 
											echo $order['DeliveryAddress'];
										 else if(isset($_POST['deliveryAddress']))
											echo $_POST['deliveryAddress']; ?>">
						<!-- ****************************** -->

						<!-- Zip kod isporuka -->
						<input class="u-full-width" type="text" placeholder="Poštanski broj isporuke" name="deliveryZipCode" required
							value="<?php if(isset($order)) 
											echo $order['DeliveryZipCode'];
										 else if(isset($_POST['deliveryZipCode']))
											echo $_POST['deliveryZipCode']; ?>">
						<!-- ****************************** -->

						<!-- Mesto isporuke -->
						<input class="u-full-width" type="text" placeholder="Mesto isporuke" name="deliveryLocation" required
							value="<?php if(isset($order)) 
											echo $order['DeliveryLocation'];
										 else if(isset($_POST['deliveryLocation']))
											echo $_POST['deliveryLocation']; ?>">
						<!-- ****************************** -->
						<br>