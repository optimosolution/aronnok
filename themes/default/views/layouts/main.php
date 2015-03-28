<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="S.M. Saidur Rahman">
        <meta name="generator" content="Optimo Solution" />
        <!-- FAVICONS -->
        <link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/img/favicon/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/img/favicon/favicon.ico" type="image/x-icon">
        <!-- Basic Styles -->
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/bootstrap/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/bootstrap/css/bootstrap-responsive.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/hotel.css" type="text/css">
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" type="text/css">
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/hotel-responsive.css" type="text/css">
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/js/slider/default.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/nivo-slider.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/socialcount-with-icons.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/fancybox/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
        <style>
            div.ui-datepicker{
                font-size:11px;
            }
        </style>
        <!--[if lt IE 9]>
                <link rel="stylesheet" href="css/bootstrap_ie7.css" type="text/css">
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container-fluid">
            <div class="row"><!-- start header -->
                <div class="span3 logo">
                    <?php $this->get_banner_logo(8); ?>
                </div>		
                <div class="span9 pull-right main_menu">
                    <div class="navbar">
                        <div class="container">
                            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </a>
                            <div class="nav-collapse">
                                <ul class="nav nav-pills">
                                    <?php
                                    if (Yii::app()->controller->id == 'site' && Yii::app()->controller->action->id == 'index') {
                                        echo '<li class="active">' . CHtml::link('<i class="icon-home"></i>', array('site/index'), array('class' => '', 'title' => 'Home')) . '</li>';
                                    } else {
                                        echo '<li>' . CHtml::link('<i class="icon-home"></i>', array('site/index'), array('class' => '', 'title' => 'Home')) . '</li>';
                                    }
                                    if (Yii::app()->controller->id == 'resort' && Yii::app()->controller->action->id == 'index') {
                                        echo '<li class="active">' . CHtml::link('Resorts', array('resort/index'), array('class' => '', 'title' => '')) . '</li>';
                                    } else {
                                        echo '<li>' . CHtml::link('Resorts', array('resort/index'), array('class' => '', 'title' => '')) . '</li>';
                                    }
                                    if (Yii::app()->controller->id == 'content' && Yii::app()->controller->action->id == 'services') {
                                        echo '<li class="active">' . CHtml::link('Facilities', array('content/services'), array('class' => '', 'title' => '')) . '</li>';
                                    } else {
                                        echo '<li>' . CHtml::link('Facilities', array('content/services'), array('class' => '', 'title' => '')) . '</li>';
                                    }
                                    if (Yii::app()->controller->id == 'gallery' && Yii::app()->controller->action->id == 'index') {
                                        echo '<li class="active">' . CHtml::link('Gallery', array('gallery/index'), array('class' => '', 'title' => '')) . '</li>';
                                    } else {
                                        echo '<li>' . CHtml::link('Gallery', array('gallery/index'), array('class' => '', 'title' => '')) . '</li>';
                                    }
                                    if (Yii::app()->controller->id == 'content' && Yii::app()->controller->action->id == 'faq') {
                                        echo '<li class="active">' . CHtml::link('FAQs', array('content/faq'), array('class' => '', 'title' => '')) . '</li>';
                                    } else {
                                        echo '<li>' . CHtml::link('FAQs', array('content/faq'), array('class' => '', 'title' => '')) . '</li>';
                                    }
                                    if (Yii::app()->controller->id == 'reservation' && Yii::app()->controller->action->id == 'index') {
                                        echo '<li class="active">' . CHtml::link('Reservation', array('reservation/index'), array('class' => '', 'title' => '')) . '</li>';
                                    } else {
                                        echo '<li>' . CHtml::link('Reservation', array('reservation/index'), array('class' => '', 'title' => '')) . '</li>';
                                    }
                                    if (Yii::app()->user->id) {
                                        echo '<li>' . CHtml::link('Profile', array('user/update', 'id' => Yii::app()->user->id), array('class' => '', 'title' => '')) . '</li>';
                                    } else {
                                        echo '<li>' . CHtml::link('Login', array('site/login'), array('class' => '', 'title' => '')) . '</li>';
                                    }
                                    if (Yii::app()->user->id) {
                                        echo '<li>' . CHtml::link('Logout', array('site/logout'), array('class' => '', 'title' => '')) . '</li>';
                                    }
                                    ?>
                                </ul>
                            </div><!-- /.nav-collapse -->
                        </div>
                    </div><!-- /navbar -->
                </div>
            </div><!-- end header -->
            <?php echo $content; ?>
            <div class="row">
                <div class="span12 what_people_say">
                    <?php $this->get_quote(); ?>
                </div>	
            </div>
        </div> <!-- /container -->
        <footer>
            <div class="container">
                <div class="row footer_section_pre">
                    <div class="span5">
                        <h4><?php echo Yii::app()->name; ?></h4>
                        <p>Rangamati Cantonment, Rangamati</p>
                        <p>Mobile: +880 1769 312021-2  <br />Contact: <a href="mailto:contact@aronnok.com" style="color:white;">contact@aronnok.com</a><br />Booking: <a href="mailto:booking@aronnok.com" style="color:white;">booking@aronnok.com</a>  </p>
                        <ul data-facebook-action="recommend" data-url="#" class="socialcount socialcount-small recommend grade-a">
                            <li class="facebook"><a title="Share on Facebook" href="https://www.facebook.com/sharer/sharer.php?u=#"><span class="social-icon icon-facebook"></span><span class="count"></span></a></li>
                            <li class="twitter"><a title="Share on Twitter" href="https://twitter.com/intent/tweet?text=#"><span class="social-icon icon-twitter"></span><span class="count"></span></a></li>
                            <li class="googleplus"><a title="Share on Google Plus" href="https://plus.appsarea.com/share?url=#"><span class="social-icon icon-googleplus"></span><span class="count"></span></a></li>
                        </ul>
                        <br />
                        <p class="copy" >&copy; <?php echo Yii::app()->name; ?> <?php echo date('Y'); ?>.</p>
                    </div>
                    <div class="span3">
                        <h4>Quick Links</h4>
                        <ul class="">
                            <li><?php echo CHtml::link('Resorts', array('resort/index'), array('class' => '', 'style' => 'color:#FFF;')); ?></li> 
                            <li><?php echo CHtml::link('Reservation', array('reservation/index'), array('class' => '', 'style' => 'color:#FFF;')); ?></li> 
                            <li><?php echo CHtml::link('Meetings', array('content/view', 'id' => 33), array('class' => '', 'style' => 'color:#FFF;')); ?></li>
                            <li><?php echo CHtml::link('Guest Rooms', array('content/view', 'id' => 12), array('class' => '', 'style' => 'color:#FFF;')); ?></li>                            
                            <li><?php echo CHtml::link('Destination Guide', array('content/view', 'id' => 34), array('class' => '', 'style' => 'color:#FFF;')); ?></li>
                            <li><?php echo CHtml::link('Reviews', array('content/index', 'id' => 7), array('class' => '', 'style' => 'color:#FFF;')); ?></li>
                            <li><?php echo CHtml::link('Contact Us', array('site/contact'), array('class' => '', 'style' => 'color:#FFF;')); ?></li>                            
                        </ul>
                    </div>
                    <div class="span4">
                        <h4>Sponsors<span class="line"></span></h4>
                        <?php $this->get_sponsors(7); ?>
                        <div class="copy text-right text-warning" style="font-size:11px;">Developed by <?php echo CHtml::link('Optimo Solution', 'http://www.optimosolution.com', array('target' => '_blank')); ?></div>
                    </div>
                </div>
            </div>
        </footer>
        <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.nivo.slider.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/socialcount.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.quicksand.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/global.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.chained.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.livequery.js"></script>
        <!-- Add mousewheel plugin (this is optional) -->
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.mousewheel-3.0.6.pack.js"></script>
        <!-- Add fancyBox -->
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/fancybox/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-39621594-4', 'auto');
            ga('send', 'pageview');

        </script>
    </body>
</html>