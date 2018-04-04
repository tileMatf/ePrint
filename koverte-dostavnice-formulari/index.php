<?php
	@session_start();
	include("../header.php");
?>  
        <!-- Navigation -->
        <div class="twelve columns">
            <ul class="nav1">
                <li>
                    <a class="tile" href="../index.html">
                        <i class="fas fa-home" aria-hidden="true"></i>Početna</a>
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
            <div class="container" style="padding-top:70px; padding-bottom: 70px;">
                <!--first row-->
                <div class="row">
                    <div class="one-half column">
                        <i class="far fa-envelope fa-2x"></i>
                        <a href="./koverte-sa-povratnicom" class="link">
                            <h3>Koverte sa povratnicom za štampanje</h3>
                        </a>
                    </div>

                    <div class="one-half column">
                        <i class="far fa-envelope fa-2x"></i>
                        <a href="./dostavnice" class="link">
                            <h3>Dostavnice</h3>
                        </a>
                    </div>
                </div>
                <!--second row-->
                <div class="row">
                    <div class="one-half column">
                        <i class="far fa-envelope fa-2x"></i>
                        <a href="./koverte-sa-dostavnicom" class="link">
                            <h3>Koverte sa dostavnicom za ručno popunjavanje</h3>
                        </a>
                    </div>

                    <div class="one-half column">
                        <i class="far fa-envelope fa-2x"></i>
                        <a href="./formulari-za-adresiranje" class="link">
                            <h3>Formulari za adresiranje</h3>
                        </a>
                    </div>
                </div>
                <!-- third row-->
                <div class="row">
                    <div class="one-half column">
                        <i class="far fa-envelope fa-2x"></i>
                        <a href="./standardne-koverte" class="link">
                            <h3>Standardne koverte</h3>
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