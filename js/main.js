    // Get the modal
    var modal = document.getElementById('modal1');
    var modal2 = document.getElementById('modal2');
	var pictureModal = document.getElementById('pictureModal');
	var closeButtons = document.getElementsByClassName('close');
	var cancelButtons = document.getElementsByClassName('cancelbtn');
	
	/*close modals on ESC key press*/
	document.onkeydown = function (event) {
		event = event || window.event;
		if (event.keyCode == 27) {
			if(pictureModal != null && pictureModal.style.display=='block') {
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
		//closeButton1.onclick = function(event) {
		if(pictureModal != null)
			pictureModal.style.display='none';
		if (modal != null)
			modal.style.display='none';
		if (modal2 != null){
			modal2.style.display='none';			
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
    var input = document.getElementById('email');
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


