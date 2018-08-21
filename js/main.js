   // Get the modal
   var modal = document.getElementById('loginModal');
   var modal2 = document.getElementById('registerModal');
   var pictureModal = document.getElementById('pictureModal');
   var closeButtons = document.getElementsByClassName('close');
   var cancelButtons = document.getElementsByClassName('cancelbtn');
   var pictureClose = document.getElementsByClassName("picture-close")[0];
   var pictureCloseBtn = document.getElementById("paymentCancel");
   var loginModalButton = document.getElementById("loginButton");
   var registerModalButton = document.getElementById("registerButton");
   var registrationMessage = document.getElementById("registrationMsg");
   
   /*Add event listener for login and register modal open*/
   if(loginModalButton != null){
	   loginModalButton.addEventListener('click', function(event){
		   modal.style.display = 'block';
	   });
   }
   if(registerModalButton != null){
	   registerModalButton.addEventListener('click', function(event){
		   modal2.style.display = 'block';
	   });
   }	
   
   /*Closing picture preview on click*/
   if(pictureClose != null){
	   pictureClose.onclick = function() { 
		   pictureModal.style.display = "none";
	   }
   }
   /*Closing picture preview on button click*/
   if(pictureCloseBtn != null){
	   pictureCloseBtn.onclick = function() { 
		   pictureModal.style.display = "none";
	   }
   }   
   
   /*adding event listener to close button*/
   for(var i = 0; i < closeButtons.length; i++){
	   var closeButton = closeButtons[i];
	   closeButton.addEventListener('click', closeModal, false);		
   }	
   for(var j = 0; j < cancelButtons.length; j++){
	   var cancelButton = cancelButtons[j];
	   cancelButton.addEventListener('click', closeModal, false);
   }
   
   function closeModal(e) {
	   if(modal != null)
		   modal.style.display='none';
	   if(modal2 != null)
		   modal2.style.display='none';	
	   if(pictureModal != null)
			pictureModal.style.display='none';		
   }
   
   /*close modals on ESC key press*/
   document.onkeydown = function (event) {
	   event = event || window.event;
	   if (event.keyCode == 27) {
		   if(pictureModal != null) {
			   pictureModal.style.display='none';
		   }
		   if(modal != null) {
			   modal.style.display='none';
		   }
		   if(modal2 != null) {
			   modal2.style.display='none';
		   }
	   }
   }
   
   // When the user clicks anywhere outside of the modal, close it
   window.onclick = function(event) {
	   if (event.target == modal) {
		   modal.style.display = "none";
	   }
	   else if (event.target == modal2) {
		 modal2.style.display = "none";
	   } 
	   
	   else if (event.target == pictureModal) {
		   pictureModal.style.display = "none";
		 } 
   }

   //Input for checked "send me copy"
   var sendCopyCheckbox = document.getElementById('sendCopy');
   var sendCopyEmail = document.getElementById('sendCopyEmail');
   
   if(sendCopyCheckbox != null){
	   if(sendCopyCheckbox.checked == true)
		   sendCopyEmail.style.display = 'block';
	   
	   sendCopyCheckbox.addEventListener('click', function () {            
		   if (sendCopyEmail.style.display != 'block') {
			   sendCopyEmail.style.display = 'block';
		   } else {
			   sendCopyEmail.style.display = '';
		   }
	   });
	   
	   sendCopyCheckbox.onchange = function(event) {		
		   if(sendCopyCheckbox.checked == true)
			   sendCopyEmail.setAttribute("required", "required");
		   else
			   sendCopyEmail.removeAttribute("required");
	   }
   }

   //Upload file button
   var fileInputs = document.querySelectorAll( '.inputfile' );
   Array.prototype.forEach.call(fileInputs, function(input)
   {
	   var label	 = input.nextElementSibling,
		   labelVal = label.innerHTML;

	   input.addEventListener( 'change', function( e )
	   {
		   var fileName = '';
		   if( this.files && this.files.length > 1 );
		   
		   else
			   fileName = e.target.value.split( '\\' ).pop();

		   if( fileName )
			   label.querySelector( 'span' ).innerHTML = fileName;
		   else
			   label.innerHTML = labelVal;
	   });
   });

   function validate(){
	   var file = document.getElementById('file');
	   if(file != null && file.files.length == 0){
		   alert("Kačenje fajla je obavezno.");
	   file.focus();
	   return false;
	   }
   }
	
	var saveOrderCheckbox = document.getElementById("savedOrder");
	if(saveOrderCheckbox != null){
		saveOrderCheckbox.addEventListener("change", function(e){
			if(e.checked){
				saveOrderCheckbox.nextSibling().value = "1";
			} else {
				saveOrderCheckbox.nextSibling().value = "0";
			}
		});
	}
	
   /*Ajax call on confirm of order*/
   var paymentConfirm = document.getElementById("paymentConfirm");
   var statusMessage = document.getElementById("statusMessage");
   var statusMessage2 = document.getElementById("statusMessage2");
   
   if(paymentConfirm != null){
	   paymentConfirm.addEventListener('click', function(event){
		   event.preventDefault();
		   
		   if(pictureModal != null)
			   pictureModal.style.display = "none";
		   var formData = document.forms.namedItem('orderForm').elements;
		   var successMessage = document.getElementById('successMessage').getAttribute('value');
		   var formDataObject = {};		   
		   var xhttp = (window.XMLHttpRequest) ? new XMLHttpRequest() : new activeXObject("Microsoft.XMLHTTP");
		 
		   Array.prototype.forEach.call(formData, function(field){
			if(field.type == "checkbox"){
				formDataObject[field.name] = field.checked;
			} else if(field.type == "radio") {
				if(field.checked)
					formDataObject[field.name] = field.value;
			} else {
				formDataObject[field.name] = field.value;
			}
		   });
			
		   xhttp.open("POST",  window.location.origin + "/eprint/functions/confirm/", true);
		   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		   xhttp.onload = function(e){
			   document.getElementById("gif_image").style.display = "none";
			   if(this.responseText === '1'){
				   statusMessage.innerHTML = "Greška prilikom skladištenja dodatog fajla. Molim Vas, pokušajte ponovo.";
				   statusMessage.style.color = "red";
			   } else if(this.responseText === '2'){
				   statusMessage.innerHTML = "Greška prilikom skladištenja dodatog fajla za korice. Molim Vas, pokušajte ponovo.";
				   statusMessage.style.color = "red";
			   } else if(this.responseText === '3'){
				   statusMessage.innerHTML = "Greška prilikom upisa narudžbine u bazu podataka. Molim Vas, pokušajte ponovo.";
				   statusMessage.style.color = "red";
			   } else if(this.responseText === '4'){
				   statusMessage.innerHTML = "Oprostite, došlo je do greške prilikom slanja i naručivanja porudžbine. Molim Vas, pokušajte ponovo.";
				   statusMessage.style.color = "red";
			   } else if(this.responseText === '5'){
				  // form.reset();
				   statusMessage.innerHTML = successMessage; 				   
				   statusMessage2.innerHTML = "Profaktura će biti poslata na Vaš mail. <br>  Isporuka u skladu sa uslovima poslovanja.";
				   statusMessage.style.color = "green";
			   } else {
				   statusMessage.innerHTML = "Došlo je do greške prilikom naručivanja. Molim Vas, pokušajte ponovo."
				   statusMessage.style.color = "red";
			   }
		   };	
		   
		   xhttp.onerror = function(e) {
			   statusMessage.innerHTML = "Oprostite, došlo je do greške na serveru prilikom slanja. Molim Vas, pokušajte ponovo.";
			   statusMessage.style.color = "red";
		   }
		   xhttp.send(JSON.stringify(formDataObject));
		   document.getElementById("gif_image").style.display = "block";		   
	   });		   
   }
		   
   var loginButton = document.getElementsByName("login")[0];
   var errorMessage = document.getElementById("errorLoginMsg");

   if(loginButton != null){
	   loginButton.addEventListener('click', function(event) {
		   event.preventDefault();		   		  
		   var formData = document.forms.namedItem('loginForm').elements;
		   var formDataObject = {};
		   var xhttp = (window.XMLHttpRequest) ? new XMLHttpRequest() : new activeXObject("Microsoft.XMLHTTP");

		   Array.prototype.forEach.call(formData, function(field){
			formDataObject[field.name] = field.value;
		   });
		   
		   /* for(let field of formData){
			formDataObject[field.name] = field.value;
		   }*/
		   /*var form = document.forms.namedItem('loginForm');		
		   var formData = new FormData(form);
		   let parameters = [...formData.entries()]
					   .map(e => encodeURIComponent(e[0]) + "=" + encodeURIComponent(e[1]))*/
		   
		   xhttp.open("POST",  window.location.origin + "/eprint/registration/login/", true);
		   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		   xhttp.onreadystatechange = function(e){
			   if(xhttp.readyState === XMLHttpRequest.DONE && xhttp.status === 200){
				   if(this.responseText == 0){
					   errorMessage.innerHTML = "Pogrešna lozinka, pokušajte ponovo.";
					   errorMessage.style.color = "red";
					   form.psw.focus();
					   modal.style.display = "block";
				   } else if(this.responseText == -1){
					   errorMessage.innerHTML = "Email adresa nije u bazi podataka, morate se prvo registrovati.";
					   errorMessage.style.color = "red";
					   modal.style.display = "block";
				   } else {				
//						var user = JSON.parse(this.responseText);						
					   modal.style.display = "none";
					   location.reload();
				   }
			   }
		   };
			   
		   xhttp.onerror = function(e) {
			   errorMessage.innerHTML = "Oprostite, došlo je do greške prilikom prijavljivanja. Molim Vas, pokušajte ponovo.";
			   errorMessage.style.color = "red";
		   }
		   xhttp.send(JSON.stringify(formDataObject));
		   //xhttp.send(parameters.join('&'));
	   });	
   }
   
   var registerButton = document.getElementsByName("register")[0];
   
   if(registerButton != null){
	   registerButton.addEventListener('click', function(event) {
		   event.preventDefault();
		   var form = document.forms.namedItem('registrationForm');
		   if(form.psw.value !== form.pswRepeat.value){
			   modal2.style.display = "block";
			   registrationMessage.innerHTML = "Unete lozinke nisu iste, pokušajte ponovo.";
			   form.pswRepeat.focus();
			   return;
		   }
		   var formData = form.elements;					
		   var formDataObject = {};
		   var xhttp = (window.XMLHttpRequest) ? new XMLHttpRequest() : new activeXObject("Microsoft.XMLHTTP");
			
		   Array.prototype.forEach.call(formData, function(field){
			formDataObject[field.name] = field.value;
		   });
		   xhttp.open("POST",  window.location.origin + "/eprint/registration/register/", true);
		   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		   xhttp.onreadystatechange = function(e){
			   if(xhttp.readyState === XMLHttpRequest.DONE && xhttp.status === 200){
				   if(this.responseText == true){
					   modal2.style.display = "none";
					   location.reload();
				   } else {
					   if(this.responseText == 0){					
						   registrationMessage.innerHTML = "Konekcija ka bazi je izgubljena, trenutno nije moguć pristup bazi.";
					   } else if(this.responseText == -1){
						   registrationMessage.innerHTML = "Postoji registracija sa ovom email adresom. Pokušajte sa logovanjem ili registracijom druge adrese.";
					   } else {
						   registrationMessage.innerHTML = "Došlo je do greške, pokušajte ponovo."
					   }
					   modal2.style.display = "block";
					   form.email.focus();
				   }
			   }
		   };
			   
		   xhttp.onerror = function(e) {
			   registrationMessage.innerHTML = "Oprostite, došlo je do greške prilikom registracije. Molim Vas, pokušajte ponovo.";
			   registrationMessage.style.color = "red";
		   }
		   xhttp.send(JSON.stringify(formDataObject));
	   });	
   }
   
   var logoutButton = document.getElementsByName("logout")[0];
   
   if(logoutButton != null){
	   logoutButton.addEventListener('click', function(event) {
		   event.preventDefault();	

		   var xhttp = (window.XMLHttpRequest) ? new XMLHttpRequest() : new activeXObject("Microsoft.XMLHTTP");
		   xhttp.open("POST",  window.location.origin + "/eprint/registration/logout/", true);
		   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		   xhttp.onreadystatechange = function(e){
			   if(xhttp.readyState === XMLHttpRequest.DONE && xhttp.status === 200){
				   var submitForm = document.forms.namedItem("orderForm"); 
				   if(submitForm != null){
					   window.location.replace(window.location.origin + "/eprint/" + submitForm.orderType.value);
				   } else {
					   window.location.reload();
				   }
			   }
		   };
			   
		   xhttp.onerror = function(e) {
			   statusMessage.innerHTML = "Oprostite, došlo je do greške prilikom odjavljivanja. Molim Vas, pokušajte ponovo.";
			   statusMessage.style.color = "red";
		   }
		   xhttp.send();
	   });	
   }
   
   /*CHANGE PASSWORD*/
   var changePassButton = document.getElementsByName("changePass")[0];
   
   if(changePassButton != null){
	   changePassButton.addEventListener('click', function(event) {
		   event.preventDefault();
		   
		   var password = document.getElementById("newPassword"), confirm_password = document.getElementById("confirmPassword");
		   if(password.value != confirm_password.value){
			   statusMessage.innerHTML = "Lozinke se ne podudaraju!"
			   confirm_password.focus();
			   return;
		   }
		   var form = document.forms.namedItem('changePassForm');
		   var formData = form.elements;					
		   var formDataObject = {};
		   Array.prototype.forEach.call(formData, function(field){
			formDataObject[field.name] = field.value;
		   });
		   
		   var xhttp = (window.XMLHttpRequest) ? new XMLHttpRequest() : new activeXObject("Microsoft.XMLHTTP");
		   xhttp.open("POST",  window.location.origin + "/eprint/registration/change_pass/", true);
		   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		   xhttp.onreadystatechange = function(e){
			   
			   if(xhttp.readyState === XMLHttpRequest.DONE && xhttp.status === 200){								   
				   if(this.responseText == true){
					   statusMessage.innerHTML = "Uspešno izmenjena lozinka!";
					   statusMessage.style.color = "green";
					   form.reset();
				   } else if(this.responseText == false){
					   statusMessage.innerHTML = "Pogrešna stara lozinka, probajte ponovo.";
					   statusMessage.style.color = "red";
				   } else {
					   statusMessage.innerHTML = this.responseText;
					   statusMessage.style.color = "red";
				   }
			   } else {
				   statusMessage.innerHTML = "Došlo je do greške prilikom promene lozinke, pokušajte ponovo.";
				   statusMessage.style.color = "red";
			   }				
		   };
			   
		   xhttp.onerror = function(e) {
			   statusMessage.innerHTML = "Došlo je do greške prilikom promene lozinke, pokušajte ponovo.";
		   }
		   xhttp.send(JSON.stringify(formDataObject));
	   });	
   }
	   
   
   /*Make table rows of order clickable*/
   /*var ordersRows = document.getElementsByName('orderRow');
   if(ordersRows != null){
	   for(var i = 0; i < ordersRows.length; i++){
		   ordersRows[i].addEventListener('click', openOrder);
	   }
   }	
   function openOrder(event){
	   event.preventDefault();
	   
	   var orderObjectField = this.querySelector("input[name='orderObject']");
	   var orderTypeField = this.querySelector("input[name='orderType']");
	   var form = document.createElement('form');
	   form.setAttribute("method", "POST");
	   form.setAttribute("action", window.location.origin + "/eprint/" + orderTypeField.value + "/");
			   
	   form.appendChild(orderObjectField);
	   form.appendChild(orderTypeField);

	   document.body.appendChild(form);
	   alert(form);
	   //form.submit();
   }*/
   
   /*For new page for delivery data*/
   /*var deliveryConfirm = document.getElementById("deliveryConfirm");	
   function post(params) {
	   //method = method || "post"; // Set method to post by default if not specified.

	   // The rest of this code assumes you are not using a library.
	   // It can be made less wordy if you use one.
	   var form = document.createElement("form");
	   form.setAttribute("method", method);
	   form.setAttribute("action", path);

	   for(var key in params) {
		   if(params.hasOwnProperty(key)) {
			   var hiddenField = document.createElement("input");
			   hiddenField.setAttribute("type", "hidden");
			   hiddenField.setAttribute("name", key);
			   hiddenField.setAttribute("value", params[key]);

			   form.appendChild(hiddenField);
		   }
	   }

	   document.body.appendChild(form);
	   form.submit();
	   //alert(params);
   }*/

