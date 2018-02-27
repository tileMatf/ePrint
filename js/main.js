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
