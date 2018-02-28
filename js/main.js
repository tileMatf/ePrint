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
    checkbox.addEventListener('click', function () {
    if (input.style.display != 'block') {
        input.style.display = 'block';
    } else {
        input.style.display = '';
    }
});