						<br><br>						
						<p class='silver non-bottom-space'>Detalji o isporuci</p>
						<hr>
						<!-- Ime i prezime za isporuku-->
						<label for="deliveryName" class="label__heading">Ime i prezime primaoca isporuke</label>
						<input class="u-full-width" type="text" placeholder="" name="deliveryName" required
							value="<?php if(isset($order)) 
											echo $order['DeliveryName'];
										 else if(isset($_POST['deliveryName']))
											echo $_POST['deliveryName']; ?>">
						<!-- ****************************** -->

						<!-- Adresa isporuka-->
						<label for="deliveryAddress" class="label__heading">Adresa isporuke</label>
						<input class="u-full-width" type="text" placeholder="" name="deliveryAddress" required
							value="<?php if(isset($order)) 
											echo $order['DeliveryAddress'];
										 else if(isset($_POST['deliveryAddress']))
											echo $_POST['deliveryAddress']; ?>">
						<!-- ****************************** -->

						<!-- Zip kod isporuka -->
						<label for="deliveryZipCode" class="label__heading">Poštanski broj isporuke</label>
						<input class="u-full-width" type="text" placeholder="" name="deliveryZipCode" required
							value="<?php if(isset($order)) 
											echo $order['DeliveryZipCode'];
										 else if(isset($_POST['deliveryZipCode']))
											echo $_POST['deliveryZipCode']; ?>">
						<!-- ****************************** -->

						<!-- Mesto isporuke -->
						<label for="deliveryLocation" class="label__heading">Mesto isporuke</label>
						<input class="u-full-width" type="text" placeholder="" name="deliveryLocation" required
							value="<?php if(isset($order)) 
											echo $order['DeliveryLocation'];
										 else if(isset($_POST['deliveryLocation']))
											echo $_POST['deliveryLocation']; ?>">
						<!-- ****************************** -->
						<br>