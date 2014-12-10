<!DOCTYPE html>
<html>
    <head>
        <title> {{ title }} </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Quatrofin s.r.o. - Ing. Bohumil Masojídek">
        <meta name="author" content="Milan Růžička">

        <link rel="icon" href="images/ikona.png" type="image/x-icon">
        <link rel="shortcut icon" href="images/ikona.png" type="image/x-icon"> 

        <link href="application/packages/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="application/packages/bootstrap/css/modern-business.css" rel="stylesheet">
        <link href="application/packages/bootstrap/css/metismenu.min.css" rel="stylesheet">
        <link href="application/packages/bootstrap/css/font-awesome.min.css" rel="stylesheet">
        <link href="application/packages/simptip/simptip.css" rel="stylesheet">
        <link href="css/default.css" rel="stylesheet">

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <link href="css/ie.css" rel="stylesheet">
        <![endif]-->
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="?page=uvod"><div class="logo-prvni-pismeno">Q</div><div class="logo-zbytek">UATRO FIN s.r.o.</div></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul id="hornimenu" class="nav navbar-nav navbar-right">
                        <li>
                            <a href="?page=uvod">O nás</a>
                        </li>
                        <li>
                            <a href="?page=obsah/minulost">Minulost</a>
                        </li>
                        <li>
                            <a href="?page=obsah/pritomnost">Přítomnost</a>
                        </li>
                        <li>
                            <a href="?page=diskuze">Diskuze</a>
                        </li>
                        <li>
                            <a href="?page=kontakt">Kontakt</a>
                        </li>
                        <li>
                            {{ prihlaseni | raw }}
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <!-- Header Carousel -->
        <header id="myCarousel" class="carousel slide">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">

                <div class="item active">
                    <div class="fill" style="background-image:url('images/fotka1.jpg');"></div>
                    <div class="carousel-caption">
                        <!-- Popisek 1 -->
                    </div>
                </div>
                <div class="item">
                    <div class="fill" style="background-image:url('images/fotka2.jpg');"></div>
                    <div class="carousel-caption">
                        <!-- Popisek 2 -->
                    </div>
                </div>
                <div class="item">
                    <div class="fill" style="background-image:url('images/fotka3.jpg')"></div>
                    <div class="carousel-caption">
                        <!-- Popisek 3 -->
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="container">
            <div class="row">
                <div class="col-md-3" style="margin-top: 45px;">

                    <!-- Zacatek menu -->
                    <ul style = "border: 1px solid lightgray;" id="postranniMenu" class="menu">
                        <li style="border-top: none;">
                            <a href="#">Finanční služby <span class="glyphicon arrow"></span></a>
                            <ul>
                                <li><a href="?page=obsah/pro_obcany">Pro občany</a></li>
                                <li>
                                    <a href="#">Pro podnikatele <span class="fa plus-minus"></span></a>
                                    <ul>
                                        <li><a href="?page=obsah/pro_podnikatele/sporeni">Spoření</a></li>
                                        <li><a href="?page=obsah/pro_podnikatele/stavebni_sporeni">Stavební spoření</a></li>
                                        <li>
                                            <a href="#">Úvěry <span class="fa plus-minus"></span></a>
                                            <ul>
                                                <li><a href="?page=obsah/pro_podnikatele/uvery/bankovni">Bankovní</a></li>
                                                <li><a href="?page=obsah/pro_podnikatele/uvery/nebankovni">Nebankovní</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#">Pojištění <span class="fa plus-minus"></span></a>
                                            <ul>
                                                <li><a href="?page=obsah/pro_podnikatele/pojisteni/zivotni">Životní</a></li>
                                                <li><a href="?page=obsah/pro_podnikatele/pojisteni/majetkove">Majetkové</a></li>
                                                <li><a href="?page=obsah/pro_podnikatele/pojisteni/penzijni">Penzijní</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="?page=obsah/pro_podnikatele/investicni_plany">Investiční plány</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="?page=obsah/oddluzeni">Oddlužení</a>
                        </li>
                        <li>
                            <a href="?page=obsah/insolvence">Insolvence</a>
                        </li>
                        <li>
                            <a href="?page=obsah/podnikatelske_zamery">Podnikatelské záměry</a>
                        </li>
                        <li>
                            <a href="#">Realitní služby <span class="glyphicon arrow"></span></a>
                            <ul>
                                <li><a href="?page=obsah/nakup">Nákup</a></li>
                                <li><a href="?page=obsah/prodej">Prodej</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="?page=obsah/administrativni_sluzby">Administrativní služby</a>
                        </li>
                        <li>
                            <a href="?page=obsah/pravni_servis" id="posledniPolozkaMenu">Právní servis</a>
                        </li>
                    </ul>
                </div>
                <!-- Konec menu -->

                <div id = "obsah" class="col-md-9">
                    <div id = "infoProuzek">
                        {{ info | raw }}
                    </div>
                    {{ obsah | raw }}
                </div>
            </div>
            <!-- /.row -->

            <hr>

            <!-- Footer -->
            <footer>
                <div class="row">
                    <div class="col-lg-12">
                        <p>Copyright &copy; 2014, <a href="http://www.milanruzicka.wz.cz/">Milan Růžička</a></p>
                    </div>
                </div>
            </footer>

        </div>
        <!-- /.container -->

        <!-- jQuery, Bootstrap, Metismenu -->
        <script src="application/packages/bootstrap/js/jquery.min.js"></script>
        <script src="application/packages/bootstrap/js/bootstrap.min.js"></script>
        <script src="application/packages/bootstrap/js/metismenu.min.js"></script>
        <!-- Animace přechodu k dané reakci -->
        <!--<script>
            document.getElementById("myCarousel").style.display = "none";
            
            $('html, body').animate({
                scrollTop: $('#skok').offset().top
            }, 0);
        </script>-->
        <script>
            $('html, body').animate({
                scrollTop: $('#reakce').offset().top
            }, 1000);
        </script>
        <!-- Script to Activate the Carousel and menu -->
        <script>
            $('.carousel').carousel({
                interval: 5000
            });
            $(document).ready(function () {
                $('#postranniMenu').metisMenu();
            });
        </script>
        
        <script src="application/packages/validationengine/validate.js"></script>
        <script src="application/packages/validationengine/pravidla.js"></script>
    </body>
</html>