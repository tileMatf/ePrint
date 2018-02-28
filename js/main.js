    // Get the modal
    var modal = document.getElementById('modal1');
    var modal2 = document.getElementById('modal2');
    
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
