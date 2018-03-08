<!DOCTYPE html>
<html class="no-js" lang="sr">

<head>
  <meta charset="UTF-8">
  <title>ePrint</title>
  <!--Meta tags-->
  <meta name="description" content="Usluge se sastoje od pripreme za štampu, štampe, pečatiranja, kovertiranja, i otpremanja na poštu ili drugom dostavljaču.">
  <meta name="viewport" content="width=device-width, initial-scale=1.0,  shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!--Facebook meta tags-->
  <meta property="og:url" content="http://example .com/page.html">
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
  <meta name="twitter:description" content=Usluge se sastoje od pripreme za štampu, štampe, pečatiranja, kovertiranja, i otpremanja na poštu ili drugom dostavljaču.>
  <meta name="twitter:card" content="summary">
  <meta name="twitter:image:alt" content="Alt text for image">
  <!--Font from Google-->
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600&amp;subset=latin-ext" rel="stylesheet" type="text/css">
  <!--CSS files-->
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/skeleton.css">
  <link rel="stylesheet" href="../css/style.css">
  <!--Favicon-->
  <link rel="icon" type="image/png" href="../images/favicon.png">
  <link rel="apple-touch-icon" href="../images/icon.png">
  <!--FA icons-->
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
</head>

<body>
    <div class="container container__main shadow">
        <!--HEADER-->
        <header>
            <div class="row">
                <div class="six columns">
                    <a href="./">
                        <img class="logo" src="../images/eprint1.png" />
                    </a>
                </div>
                <!--NAVIGATION-->
                <div class="six columns navigation__header">
                    <div class="navigation__header--nav">
                        <ul class="nav login nav-reg-log">
                            <li>
                            <button onclick="document.getElementById('modal1').style.display='block'">Uloguj se<i class="fas fa-user-plus" aria-hidden="true"></i></button>
                            </li>
                            <li>
                            <button onclick="document.getElementById('modal2').style.display='block'">Registruj se<i class="fas fa-user-plus" aria-hidden="true"></i></button>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--end of second one-half column-->
            </div>
            <!--end of row-->
        </header>
    <!-- LOGIN MODAL1 -->
    <div id="modal1" class="modal">
      <span onclick="document.getElementById('modal1').style.display='none'" class="close" title="Close Modal">&times;</span>
      <form class="modal-content animate" action="/action_page.php">
        <div class="container">
          <h1 class="log-reg__heading">Uloguj se</h1>
          <p>Popunite navedena polja.</p>
          <hr>
          <label for="email"><b>Email</b></label>
          <input type="text" placeholder="Unesite email" name="email" required>
    
          <label for="psw"><b>Lozinka</b></label>
          <input type="password" placeholder="Unesite lozinku" name="psw" required>
            
          <button type="submit" class="login-btn">Login</button>
          <label>
            <input type="checkbox" checked="checked" name="remember"> Zapamti me
          </label>
        </div>
    
        <div class="container" style="background-color:#f1f1f1; margin-top: 40px;">
          <div class="row">
            <div class="seven columns">
              <button type="button" onclick="document.getElementById('modal1').style.display='none'" class="cancelbtn">Nazad</button>
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
            <span onclick="document.getElementById('modal2').style.display='none'" class="close" title="Close Modal">&times;</span>
            <form class="modal-content animate" action="/action_page.php">
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
                  <button type="button" onclick="document.getElementById('modal2').style.display='none'" class="cancelbtn">Nazad</button>
                  <button type="submit" class="signupbtn">Registruj se</button>
                </div>
              </div>
            </form>
          </div>    

        <!-- Navigation -->
        <div class="twelve columns">
            <ul class="nav1">
                <li>
                    <a class="tile" href="../">
                        <i class="fas fa-home" aria-hidden="true"></i>Početna</a>
                </li>
                <span class="line">/</span>
                <li>
                    <a class="tile" href="./" style="font-size: 1.6rem;">O nama</a>
                </li>
            </ul>
        </div>
        <!-- End of navigation -->

        <!--MAIN PAGE SECTION-->
        <section class="section__main">
            <div class="row">
                <h2 class="section__heading">O nama</h2>
            </div>

        </section>





        <!--Footer-->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="one-half column">
                        <p>26232 Pančevo, Matije Gupca 24</p>
                    </div>
                    <div class="one-half column">
                        <p>065 983 983 8</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
<!-- JS files -->
<script src="../js/main.js"></script>
</body>

</html>