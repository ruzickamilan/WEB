<!DOCTYPE html>
<html>
    <head>
        <title> {{ title }} </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Quatrofin s.r.o. - Ing. Bohumil Masojídek">
        <meta name="author" content="Milan Růžička">
        
        <link href="application/packages/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="application/packages/bootstrap/css/modern-business.css" rel="stylesheet">
        <link href="css/default.css" rel="stylesheet">
        
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
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
                <a class="navbar-brand" href="?page=uvod">QUATRO FIN s.r.o.</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="?page=uvod">O nás</a>
                    </li>
                    <li>
                        <a href="?page=minulost">Minulost</a>
                    </li>
                    <li>
                        <a href="?page=pritomnost">Přítomnost</a>
                    </li>
                    <li>
                        <a href="?page=diskuze">Diskuze</a>
                    </li>
                    <li>
                        <a href="?page=kontakt">Kontakt</a>
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
                <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide One');"></div>
                <div class="carousel-caption">
                    <h2>Nadpis 1</h2>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide Two');"></div>
                <div class="carousel-caption">
                    <h2>Nadpis 2</h2>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide Three');"></div>
                <div class="carousel-caption">
                    <h2>Nadpis 3</h2>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-3" style="margin-top: 45px;">
                <div class="accordion">
                    <!-- Prvni rozbalovaci polozka menu -->
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a href="#prvniRozbaleni" id="prvniPolozkaMenu" class="accordion-toggle" data-toggle="collapse">Finanční služby<span class="glyphicon glyphicon-chevron-down"></span></a>
                        </div>
                        <div id="prvniRozbaleni" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <ul class="menu-seznam-ul">
                                    <li><a href="?page=pro_obcany">Pro občany</a></li>
                                    <li>Pro podnikatele
                                        <ul> 
                                            <li><a href="?page=pro_podnikatele/sporeni">Spoření</a></li>
                                            <li><a href="?page=pro_podnikatele/stavebni_sporeni">Stavební spoření</a></li>
                                            <li><a href="?page=pro_podnikatele/uvery">Úvěry</a>
                                                <ul> 
                                                    <li>Bankovní</li>
                                                    <li>Nebankovní</li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>Pojištění
                                        <ul> 
                                            <li>Životní</li>
                                            <li>Majetkové</li>
                                            <li>Penzijní</li>
                                        </ul>
                                    </li>
                                    <li>Investiční plány</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a href="?page=neco" class="accordion-toggle">Oddlužení</a>
                        </div>
                    </div>
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a href="?page=neco" class="accordion-toggle">Insolvence</a>
                        </div>
                    </div>
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a href="?page=neco" class="accordion-toggle">Podnikatelské záměry</a>
                        </div>
                    </div>
                    <!-- Druha rozbalovaci polozka menu -->
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a href="#druheRozbaleni" class="accordion-toggle" data-toggle="collapse">Realitní služby<span class="glyphicon glyphicon-chevron-down"></span></a>
                        </div>
                        <div id="druheRozbaleni" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <ul class="menu-seznam-ul">
                                    <li>Nákup</li>
                                    <li>Prodej</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a href="?page=neco" class="accordion-toggle">Administrativní služby</a>
                        </div>
                    </div>
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a href="?page=neco" id="posledniPolozkaMenu" class="accordion-toggle">Právní servis</a>
                        </div>
                    </div>
                </div> 
            </div>
            <div id = "obsah" class="col-md-9">
                {{ obsah | raw }}
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; <a href="http://www.milanruzicka.wz.cz/">Milan Růžička</a></p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.0 -->
    <script src="application/packages/bootstrap/js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="application/packages/bootstrap/js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
        $('.carousel').carousel({
            interval: 5000 //changes the speed
        })
    </script>
    </body>
</html>