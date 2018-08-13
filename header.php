<!DOCTYPE html>
<html class="no-js" lang="sr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>ePrint</title>
    <!--Meta tags-->
    <meta name="description" content="Usluge se sastoje od pripreme za štampu, štampe, pečatiranja, kovertiranja, i otpremanja na poštu ili drugom dostavljaču.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,  shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Facebook meta tags-->
    <meta property="og:url" content="http://example.com/page.html">
    <meta property="og:title" content="ePrint">
    <meta property="og:image" content="http://example.com/image.jpg">
    <meta property="og:description" content="Usluge se sastoje od pripreme za štampu, štampe, pečatiranja, kovertiranja, i otpremanja na poštu ili drugom dostavljaču.">
    <meta property="og:site_name" content="Site Name">
    <meta property="og:locale" content="Sh_SP">
    <meta property="og:type" content="website" />
    <!-- Twitter meta tags -->
    <meta name="twitter:url" content="http://example.com/page.html">
    <meta name="twitter:title" content="ePrint">
    <meta name="twitter:image" content="http://example.com/image.jpg">
    <meta name="twitter:description" content="Usluge se sastoje od pripreme za štampu, štampe, pečatiranja, kovertiranja, i otpremanja na poštu ili drugom dostavljaču.">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:image:alt" content="Alt text for image">
    <!--Font from Google-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600&amp;subset=cyrillic-ext" rel="stylesheet">
    <!--CSS files-->
    <link rel="stylesheet" href="http://localhost/eprint/css/normalize.css">
    <link rel="stylesheet" href="http://localhost/eprint/css/skeleton.css">
    <link rel="stylesheet" href="http://localhost/eprint/css/style.css">
    <!--Favicon-->
    <link rel="icon" type="image/png" href="http://localhost/eprint/images/favicon.png">
    <link rel="apple-touch-icon" href="http://localhost/eprint/images/icon.png">
</head>

<body>
    <div class="container container__main shadow">
        <!--HEADER-->
        <header>
            <div class="row">
                <div class="six columns">
                    <a href="http://localhost/eprint/">
                        <img class="logo" src="http://localhost/eprint/images/eprint1.png" />
                    </a>
                </div>
                <!--NAVIGATION-->
                <?php 
				
			require_once("/registration/order.php");
			require_once("/registration/connection.php");	
				
			if(!isset($_SESSION['user_info'])){
				echo 
					'<div class="six columns navigation__header navigation__header--nav">
						<!--Registar and Login -->
						<ul class="nav login nav-reg-log">
						  <li>
                            <button id="loginButton" class="buttonStyle">Uloguj se</button>
						  </li>
						  <li>
                            <button id="registerButton" class="buttonStyle">Registruj se</button>
						  </li>
						</ul>
					</div>
					<!--end of column-->';
			} else if(isset($_SESSION['user_info']) && $_SESSION['user_info']->Role === '1') {				
				$url = isset($_SERVER['HTTPS']) ? "https" : "http" . "://" . $_SERVER['HTTP_HOST'] . "/eprint/adminpanel/";
				header("Location: ". $url);
				exit();
			}
			else {
				echo 
					'<form name="logoutForm">
					  <div class="six columns navigation__header navigation__header--nav">
						<!--Logout-->
                        <ul class="nav login nav-reg-log">
                            <li>
                            ' . $_SESSION['status_message']  . '
                            </li>
						  <li>
                            <button name="logout" class="buttonStyle">Odjavi se</button>
                          </li>
                          <li> 
                           <a href="http://localhost/eprint/password" class="linkPassword">Promeni lozinku</a>
                          </li>
						</ul>
	  				  </div>
					</form>
					<!--end of column-->';
			}
		?>
		<!-- Registration paragraf-->
		<p class="loginStatus">
			<?php 
				echo isset($_SESSION['registration']) && $_SESSION['registration'] === true ? $_SESSION['status_message'] : '';				
			?>
		</p> 
            </div>
            <!--end of row-->
        </header>
         <!-- LOGIN MODAL -->
        <div id="loginModal" class="modal">
            <span class="close" title="Close Modal">&times;</span>
            <form class="modal-content animate" name="loginForm" >
				<input type="hidden" name="path" value="../uplatnice/nalog-za-isplatu/">
                <div class="container">
                    <h1 class="log-reg__heading">Uloguj se</h1>
                    <p>Popunite navedena polja.</p>
					<p id="errorLoginMsg"> </p>
                    <hr>
                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Unesite email" name="email" id="email" required>
                
                    <label for="psw"><b>Lozinka</b></label>
                    <input type="password" placeholder="Unesite lozinku" name="psw" id="psw" required>
                        
                    <button type="submit" class="buttonStyle" name="login">Login</button>
                    <label>
                        <input type="checkbox" checked="checked" name="remember"> Zapamti me
                    </label>
                </div>
    
                <div class="container" style="background-color:#f1f1f1; margin-top: 40px;">
  
            </form>
        </div>
    </div>
    <!-- REGISTER MODAL 2 -->
    <div id="registerModal" class="modal">
        <span class="close" title="Close Modal">&times;</span>
        <form class="modal-content animate" name="registrationForm">
			<input type="hidden" name="path" value="../uplatnice/nalog-za-isplatu/">
            <div class="container">
                <h1 class="log-reg__heading">Registruj se</h1>
                <p>Popunite navedena polja.</p>
				<p id="registrationMsg">
				<?php 
					echo isset($_SESSION['registration']) && isset($_SESSION['status_message']) && $_SESSION['registration'] === false ? $_SESSION['status_message'] : '';				
				?>
				</p>
                <hr>
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Upišite Vašu email adresu" name="email" required>
            
                <label for="psw"><b>Lozinka</b></label>
                <input type="password" placeholder="Upišite Vašu lozinku" name="psw" required>
            
                <label for="psw-repeat"><b>Potvrdite lozinku</b></label>
                <input type="password" placeholder="Potvrdite Vašu lozinku" name="pswRepeat" required>
                    
                <!--<label>
                <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Zapamti me
                </label>-->
            
                <p>Pravljenjem naloga prihvatate naše <a href="#" style="color:dodgerblue">uslove</a> poslovanja</p>
            
                <div class="clearfix">
                    <button type="button" class="cancelbtn">Nazad</button>
                    <button type="submit" class="signupbtn" name="register">Registruj se</button>
                </div>
            </div>
        </form>
    </div>    