<?php
	@session_start();	
	include("../header.php");
?>

        <!-- Navigation -->
        <div class="twelve columns">
            <ul class="nav1">
                <li>
                    <a class="tile" href="../">Početna</a>
                </li>
                <span class="line">/</span>
                <li>
                    <a class="tile" href="./" style="font-size: 1.6rem;">Uplatnice</a>
                </li>
            </ul>
        </div>
        <!-- End of navigation -->
    <!-- LOGIN MODAL1 -->
    <div id="modal1" class="modal">
        <span class="close" title="Close Modal">&times;</span>
        <form class="modal-content animate" action="../registration/login.php">
		  <input type="hidden" name="path" value="../uplatnice/">
          <div class="container">
            <h1 class="log-reg__heading">Uloguj se</h1>
            <p>Popunite navedena polja.</p>
            <hr>
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Unesite email" name="email" required>
      
            <label for="psw"><b>Lozinka</b></label>
            <input type="password" placeholder="Unesite lozinku" name="psw" required>
              
            <button type="submit" class="login-btn" name="login">Login</button>
            <label>
              <input type="checkbox" checked="checked" name="remember"> Zapamti me
            </label>
          </div>
      
          <div class="container" style="background-color:#f1f1f1; margin-top: 40px;">
            <div class="row">
              <div class="seven columns">
                <button type="button" class="cancelbtn">Nazad</button>
              </div>
              <div class="five columns" style="padding-top: 5px;">
                  <a href="#">Zaboravili ste šifru?</a></span>
              </div>
            </div>
          </div>
        </form>
      </div>
  
          <!-- REGISTER MODAL 2 -->
          <div id="modal2" class="modal">
              <span class="close" title="Close Modal">&times;</span>
              <form class="modal-content animate" action="../registration/register.php">
				<input type="hidden" name="path" value="../uplatnice/">
                <div class="container">
                  <h1 class="log-reg__heading">Registruj se</h1>
                  <p>Popunite navedena polja.</p>
                  <hr>
                  <label for="email"><b>Email</b></label>
                  <input type="text" placeholder="Upišite Vašu email adresu" name="email" required>
            
                  <label for="psw"><b>Lozinka</b></label>
                  <input type="password" placeholder="Upišite Vašu lozinku" name="psw" required>
            
                  <label for="psw-repeat"><b>Potvrdite lozinku</b></label>
                  <input type="password" placeholder="Potvrdite Vašu lozinku" name="psw-repeat" required>
                  
                  <label>
                    <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Zapamti me
                  </label>
            
                  <p>Pravljenjem naloga prihvatate naše <a href="#" style="color:dodgerblue">uslove</a> poslovanja</p>
            
                  <div class="clearfix">
                    <button type="button" class="cancelbtn">Nazad</button>
                    <button type="submit" class="signupbtn" name="register">Registruj se</button>
                  </div>
                </div>
              </form>
            </div>
  


        <!--MAIN PAGE SECTION-->
        <section class="section__main">
            <!--first row-->
            <div class="container">
                <div class="row">
                    <h2 class="section__heading">Uplatnice</h2>
                </div>
            </div>
            <div class="container">
                <!--first three icons/h3-->
                <div class="row  row-padding">
                    <div class="one-third column">
                        <a href="./nalog-za-uplatu/" class="link">
                            <img class="" src="../images/icons/nalog-za-uplatu.png">
                            <h3>Nalog za uplatu</h3>
                        </a>
                    </div>

                    <div class="one-third column">
                        <a href="./nalog-za-prenos/" class="link">
                            <img class="" src="../images/icons/nalog-za-prenos.png">
                            <h3>Nalog za prenos</h3>
                        </a>
                    </div>

                    <div class="one-third column">
                        <a href="./nalog-za-isplatu/" class="link">
                            <img class="" src="../images/icons/nalog-za-isplatu.png">
                            <h3>Nalog za isplatu</h3>
                        </a>
                    </div>
                    <!--end of last column-->
                </div>
                <!--end of three icons/h3-->
            </div>
            <!--end of container-->
        </section>

<?php
	include("../footer.php");
?>