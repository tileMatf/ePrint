<?php
	@session_start();
	include("../header.php");
?>

        <!-- Navigation -->
        <div class="twelve columns">
            <ul class="nav1">
                <li>
                    <a class="tile" href="../">
                        <i class="fas fa-home" aria-hidden="true"></i>Početna</a>
                </li>
                <span class="line">/</span>
                <li>
                    <a class="tile" href="./" style="font-size: 1.6rem;">Cenovnik</a>
                </li>
            </ul>
        </div>
        <!-- End of navigation -->

        <!--MAIN PAGE SECTION-->
        <section class="section__main">
            <div class="row">
                <h2 class="section__heading">Cenovnik</h2>
            </div>
            <!--Cenovnik-->
            <div class="container container__cenovnik">
                <table class="u-full-width">
                    <thead>
                        <tr>
                            <th>Usluga</th>
                            <th>Cena</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Stampanje</td>
                            <td>150 din</td>
                        </tr>
                        <tr>
                            <td>Kovertiranje</td>
                            <td>200 din</td>
                        </tr>
                        <tr>
                            <td>Stampanje</td>
                            <td>150 din</td>
                        </tr>
                        <tr>
                            <td>Kovertiranje</td>
                            <td>200 din</td>
                        </tr>
                        <tr>
                            <td>Stampanje</td>
                            <td>150 din</td>
                        </tr>
                        <tr>
                            <td>Kovertiranje</td>
                            <td>200 din</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </section>

<?php
	include("../footer.php");
?>