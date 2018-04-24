    // Get the modal
    var modal = document.getElementById('loginModal');
    var modal2 = document.getElementById('registerModal');
	var pictureModal = document.getElementById('pictureModal');
	var closeButtons = document.getElementsByClassName('close');
	var cancelButtons = document.getElementsByClassName('cancelbtn');
	var pictureClose = document.getElementsByClassName("picture-close")[0];
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
		
	/*Ajax call on confirm of order*/
	var paymentConfirm = document.getElementById("paymentConfirm");
	var statusMessage = document.getElementById("statusMessage");
	
	if(paymentConfirm != null){
		paymentConfirm.addEventListener('click', function(event){
			event.preventDefault();	
			if(pictureModal != null)
				pictureModal.style.display = "none";
			var form = document.forms.namedItem('orderForm');
			var successMessage = document.getElementById('successMessage').getAttribute('value');
			var formData = new FormData(form);		
			
			var xhttp = (window.XMLHttpRequest) ? new XMLHttpRequest() : new activeXObject("Microsoft.XMLHTTP");
		
			let parameters = [...formData.entries()]
                     .map(e => encodeURIComponent(e[0]) + "=" + encodeURIComponent(e[1]))
			
			xhttp.open("POST",  window.location.origin + "/eprint/functions/confirm/", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.onload = function(e){
				//alert(this.responseText);
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
					statusMessage.innerHTML = successMessage;
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
			xhttp.send(parameters.join('&'));
		});
	}
	
	//var deliveryConfirm = document.getElementById("deliveryConfirm");
	
	function post(params) {
		method = method || "post"; // Set method to post by default if not specified.

		// The rest of this code assumes you are not using a library.
		// It can be made less wordy if you use one.
		/*var form = document.createElement("form");
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
		form.submit();*/
		alert(params);
	}
	
	var loginButton = document.getElementsByName("login")[0];
	var errorMessage = document.getElementById("errorLoginMsg");

	if(loginButton != null){
		loginButton.addEventListener('click', function(event) {
			event.preventDefault();
			var form = document.forms.namedItem('loginForm');		
			var formData = new FormData(form);					
			var xhttp = (window.XMLHttpRequest) ? new XMLHttpRequest() : new activeXObject("Microsoft.XMLHTTP");

			let parameters = [...formData.entries()]
						.map(e => encodeURIComponent(e[0]) + "=" + encodeURIComponent(e[1]))
			
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
//						alert(user.Email);
						modal.style.display = "none";
						location.reload();
					}
				}
			};
				
			xhttp.onerror = function(e) {
				errorMessage.innerHTML = "Oprostite, došlo je do greške prilikom logovanja. Molim Vas, pokušajte ponovo.";
				errorMessage.style.color = "red";
			}
			xhttp.send(parameters.join('&'));
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
			var formData = new FormData(form);					
			var xhttp = (window.XMLHttpRequest) ? new XMLHttpRequest() : new activeXObject("Microsoft.XMLHTTP");
			let parameters = [...formData.entries()]
						.map(e => encodeURIComponent(e[0]) + "=" + encodeURIComponent(e[1]))
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
			xhttp.send(parameters.join('&'));
		});	
	}
	
	var logoutButton = document.getElementsByName("logout")[0];
	
	if(logoutButton != null){
		logoutButton.addEventListener('click', function(event) {
			event.preventDefault();
			var form = document.forms.namedItem('logoutForm');
			var formData = new FormData(form);					

			var xhttp = (window.XMLHttpRequest) ? new XMLHttpRequest() : new activeXObject("Microsoft.XMLHTTP");
			xhttp.open("POST",  window.location.origin + "/eprint/registration/logout/", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.onreadystatechange = function(e){
				if(xhttp.readyState === XMLHttpRequest.DONE && xhttp.status === 200){
					form.reset();			
					var submitForm = document.forms.namedItem("orderForm"); 
					if(submitForm != null){
						//submitForm.reset();
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
	
	var saveOrderButton = document.getElementById("saveOrder");
	if(saveOrderButton != null){
		saveOrderButton.addEventListener('click', function(event){
			event.preventDefault();
			
			var form = document.forms.namedItem('orderForm');
			var formData = new FormData(form);
			
			var xhttp = (window.XMLHttpRequest) ? new XMLHttpRequest() : new activeXObject("Microsoft.XMLHTTP");
			let parameters = [...formData.entries()]
						.map(e => encodeURIComponent(e[0]) + "=" + encodeURIComponent(e[1]));
						
			var xhttp = (window.XMLHttpRequest) ? new XMLHttpRequest() : new activeXObject("Microsoft.XMLHTTP");
			xhttp.open("POST",  window.location.origin + "/eprint/save_order/", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			
			xhttp.onreadystatechange = function(e){			
				if(xhttp.readyState === XMLHttpRequest.DONE && xhttp.status === 200){
					if(this.responseText !== 0){	
						alert(this.responseText);
						form.reset();						
						window.location.replace(window.location.origin + "/eprint/" + form.orderType.value);
					}					
				}
			};

			xhttp.onerror = function(e) {
				//alert(this.responseText);
				statusMessage.innerHTML = "Oprostite, došlo je do greške prilikom skladištenja Vaše narudžbine. Molim Vas, pokušajte ponovo.";
				statusMessage.style.color = "red";
			}
			xhttp.send(parameters.join('&'));
		});
	}
	
	/*Make table rows of order clickable*/
	var ordersRows = document.getElementsByName('orderRow');
	if(ordersRows != null){
		for(var i = 0; i < ordersRows.length; i++){
			ordersRows[i].addEventListener('click', openOrder);
		}
	}	
	function openOrder(event){
		event.preventDefault();
		
		/*var orderObjectField = this.querySelector("input[name='orderObject']");
		var orderTypeField = this.querySelector("input[name='orderType']");
		var form = document.createElement('form');
		form.setAttribute("method", "POST");
		form.setAttribute("action", window.location.origin + "/eprint/" + orderTypeField.value + "/");
				
		form.appendChild(orderObjectField);
		form.appendChild(orderTypeField);

		//document.body.appendChild(form);*/
		
		var form = this.form;
		
		form.submit();
	}
	
