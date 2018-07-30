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
                    <a class="tile" href="./" style="font-size: 1.6rem;">Koverte, dostavnice, formulari za adresiranje</a>
                </li>
            </ul>
        </div>
        <!-- End of navigation -->



        <!--MAIN PAGE SECTION-->
        <section class="section__main">
        <div class="container">
            <div class="row">
                <h2 class="section__heading-second">Koverte, dostavnice, formulari za adresiranje</h2>
            </div>
        </div>
            <div class="container">
                <!--first row-->      
                <div class="row row-padding-main-page">
                    <div class="one-third column">
                        <a href="./koverte-sa-dostavnicom" class="link">
                            <img class="" src="../images/icons/koverta-rucno.png">
                            <h3 style="display: inline-block;">Koverte sa povratnicom za ručno popunjavanje</h3>
                        </a>
                    </div>

                    <div class="one-third column">
                        <a href="./koverte-sa-povratnicom" class="link">
                            <img class="" src="../images/icons/koverta-sa-povratnicom.png">
                            <h3>Koverte sa povratnicom za štampanje</h3>
                        </a>
                    </div>

                    <div class="one-third column">
                        <a href="./standardne-koverte" class="link">
                            <img class="" src="../images/icons/koverta.png">
                            <h3>Standardne koverte</h3>
                        </a>
                    </div>
                </div>
                <!--second row-->
                <div class="row row-padding-main-page">
                    <div class="one-third column">
                        <a href="./koverte-sa-dostavnicom" class="link">
                         <img class="" src="../images/icons/dostavnice.png">
                            <h3>Dostavnice</h3>
                        </a>
                    </div>

                    <div class="one-third column">
                        <a href="./formulari-za-adresiranje" class="link">
                          <img class="" src="../images/icons/adresiranje.png">
                            <h3>Formulari za adresiranje</h3>
                        </a>
                    </div>
                </div>
               
                <!--end of three rows-->
            </div>
            <!--end of container-->
        </section>
<?php
	include("../footer.php");
?>