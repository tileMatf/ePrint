    // Get the modal
    var modal = document.getElementById('modal1');
    var modal2 = document.getElementById('modal2');
	var pictureModal = document.getElementById('pictureModal');
	var closeButtons = document.getElementsByClassName('close');
	var cancelButtons = document.getElementsByClassName('cancelbtn');
	var pictureClose = document.getElementsByClassName("picture-close")[0];

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
    var checkbox = document.getElementById('sendCopy');
    var input = document.getElementById('sendCopyEmail');
    if(checkbox != null){
        checkbox.addEventListener('click', function () {
            if (input.style.display != 'block') {
                input.style.display = 'block';
            } else {
                input.style.display = '';
            }
        });
    }

    //Upload button

    var inputs = document.querySelectorAll( '.inputfile' );
    Array.prototype.forEach.call( inputs, function( input )
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

	/*Ajax call on confirm*/
	var paymentConfirm = document.getElementById("paymentConfirm");
	
	if(paymentConfirm != null){
		paymentConfirm.addEventListener('click', function(event){
			event.preventDefault();	
			pictureModal.style.display = "none";
			var form = document.forms.namedItem('orderForm');
			//var type = document.getElementById('orderType').getAttribute('value');
			var successMessage = document.getElementById('successMessage').getAttribute('value');
			var statusMessage = document.getElementById("statusMessage");
			var formData = new FormData(form);		
			
			var xhttp = (window.XMLHttpRequest) ? new XMLHttpRequest() : new activeXObject("Microsoft.XMLHTTP");
		
			let parameters = [...formData.entries()]
                     .map(e => encodeURIComponent(e[0]) + "=" + encodeURIComponent(e[1]))
			
			xhttp.open("POST", "../../functions/confirm/", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.onload = function(e){
				if(this.responseText == true){
					statusMessage.innerHTML = successMessage;
					statusMessage.style.color = "green";
				} else {
					statusMessage.innerHTML = "Oprostite, došlo je do greške prilikom slanja. Molim Vas, pokušajte ponovo.";
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
 /*$(function() {
	$(document).keydown(function(e) {
	// ESCAPE key pressed
		if (e.keyCode == 27) {
			if(pictureModal != null)
				pictureModal.style.display = 'none';
			if(modal != null)
				modal.style.display = 'none';
			if(modal2 != null)
				modal2.style.display = 'none';
		}
	});
});*/


