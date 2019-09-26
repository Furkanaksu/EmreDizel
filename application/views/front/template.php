<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <?php if(isset($MetaTitle)) { ?>
        <title><?php echo $MetaTitle; ?> - Emre Dizel</title>
    <?php } else { ?>
        <title>Movie Poster Turk</title>
    <?php } ?>
    <?php if(isset($MetaDescription)) { ?>
        <meta name="description" content="<?php echo $MetaDescription; ?>">
    <?php } else { ?>
        <meta name="description" content="Site Description Here">
    <?php } ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo base_url(); ?>assets/front/css/bootstrap.css?v=<?php echo CSS_VERSION; ?>" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo base_url(); ?>assets/front/css/stack-interface.css?v=<?php echo CSS_VERSION; ?>" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo base_url(); ?>assets/front/css/socicon.css?v=<?php echo CSS_VERSION; ?>" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo base_url(); ?>assets/front/css/flickity.css?v=<?php echo CSS_VERSION; ?>" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo base_url(); ?>assets/front/css/iconsmind.css?v=<?php echo CSS_VERSION; ?>" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo base_url(); ?>assets/front/css/jquery.steps.css?v=<?php echo CSS_VERSION; ?>" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo base_url(); ?>assets/front/css/theme.css?v=<?php echo CSS_VERSION; ?>" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo base_url(); ?>assets/front/css/custom.css?v=<?php echo CSS_VERSION; ?>" rel="stylesheet" type="text/css" media="all" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:200,300,400,400i,500,600,700%7CMerriweather:300,300i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class=" ">
<a id="start"></a>
<section class="bar bar-3 bar--sm bg--secondary">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="bar__module">
                    <span class="type--fade">Movie Poster Turk</span>
                </div>
            </div>
            <div class="col-lg-6 text-right text-left-xs text-left-sm">
                <div class="bar__module">
                    <ul class="menu-horizontal">
                        <li>
                            <a href="#" data-notification-link="search-box">
                                <i class="stack-search"></i>
                            </a>
                        </li>
                        <li class="dropdown dropdown--absolute">
                                    <span class="dropdown__trigger">
                                        <img alt="Image" class="flag" src="<?php echo base_url(); ?><?php echo $this->lang->line('flag'); ?>" />
                                    </span>
                            <div class="dropdown__container">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-1 dropdown__content">
                                            <ul class="menu-vertical text-left">
                                                <li>
                                                    <a href="<?php echo site_url(); ?>home/setLang/en">ENG</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo site_url(); ?>home/setLang/tr">TR</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--end of row-->
    </div>  <!--right menu-->
    <!--end of container-->
</section>
<!--end bar-->
<div class="notification pos-top pos-right search-box bg--white border--bottom" data-animation="from-top" data-notification-link="search-box">
    <form id="searchForm" action="<?php echo site_url()?>search" onsubmit="return search();">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <input type="search" id="searchInput" name="query" placeholder="Type search query and hit enter" />
            </div>
        </div>
        <!--end of row-->
    </form>
</div>
<!--end of notification-->
<div class="nav-container ">
    <div class="bar bar--sm visible-xs">
        <div class="container">
            <div class="row">
                <div class="col-3 col-md-2">
                    <a href="<?php echo site_url(); ?>">
                        <img class="logo logo-dark" alt="logo" src="<?php echo base_url(); ?>assets/front/img/logo-dark.png?v=<?php echo CSS_VERSION; ?>" />
                        <img class="logo logo-light" alt="logo" src="<?php echo base_url(); ?>assets/front/img/logo-light.png?v=<?php echo CSS_VERSION; ?>" />
                    </a>
                </div>
                <div class="col-9 col-md-10 text-right">
                    <a href="#" class="hamburger-toggle" data-toggle-class="#menu1;hidden-xs">
                        <i class="icon icon--sm stack-interface stack-menu"></i>
                    </a>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </div>
    <!--end bar-->
    <nav id="menu1" class="bar bar--sm bar-1 hidden-xs ">
        <div class="container">
            <div class="row">
                <div class="col-lg-1 col-md-2 hidden-xs">
                    <div class="bar__module">
                        <a href="<?php echo site_url(); ?>">
                            <img class="logo logo-dark" alt="logo" src="<?php echo base_url(); ?>assets/front/img/logo-dark.png?v=<?php echo CSS_VERSION; ?>" />
                            <img class="logo logo-light" alt="logo" src="<?php echo base_url(); ?>assets/front/img/logo-light.png?v=<?php echo CSS_VERSION; ?>" />
                        </a>
                    </div>
                    <!--end module-->
                </div>
                <div class="col-lg-11 col-md-12 text-right text-left-xs text-left-sm">
                    <div class="bar__module">
                        <ul class="menu-horizontal text-left">
                            <li><a href="<?php echo site_url() ?>"><?php echo $this->lang->line('home'); ?></a></li>
                            <li><a href="<?php echo site_url(); ?>about"><?php echo $this->lang->line('about'); ?></a></li>
                            <li class="dropdown">
                                <span class="dropdown__trigger"><?php echo $this->lang->line('categories'); ?></span>
                                <div class="dropdown__container">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-8 dropdown__content dropdown__content--lg">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-10">
                                                        <ul class="menu-vertical">
                                                        <?php
                                                        $countCategories = count($Categories);
                                                        $index = 0;
                                                        foreach ($Categories as $row){
                                                            $index++;
                                                            if($index > ($countCategories/2)){ continue; }
                                                            ?>
                                                                <li>
                                                                    <a href="<?php echo site_url(); ?>category/<?php echo $row->Id; ?>">
                                                                        <?php echo $row->Title; ?>
                                                                    </a>
                                                                </li>
                                                        <?php } ?>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-6 col-md-10">
                                                        <ul class="menu-vertical">
                                                            <?php
                                                            $index = 0;
                                                            foreach ($Categories as $row){
                                                                $index++;
                                                                if($index <= ($countCategories/2)){ continue; }
                                                                ?>
                                                                <li>
                                                                    <a href="<?php echo site_url(); ?>category/<?php echo $row->Id; ?>">
                                                                        <?php echo $row->Title; ?>
                                                                    </a>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!--end of row-->
                                            </div>
                                            <!--end dropdown content-->
                                        </div>
                                    </div>
                                </div>
                                <!--end dropdown container-->
                            </li>
                            <li><a href="<?php echo site_url(); ?>contact"><?php echo $this->lang->line('contact'); ?></a></li>
                        </ul>
                    </div>
                    <!--end module-->
                    <!--end module-->
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </nav>
    <!--end bar-->



</div>
<div class="main-container">
    <?php $this->load->view($View);?>

<!--------------------------------------------------------------FOOTER---------------------------------------------->
<footer class="footer-3 text-center-xs space--xs ">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img alt="Image" class="logo" src="<?php echo base_url(); ?>assets/front/img/logo-dark.png" />
                <ul class="list-inline list--hover">
                    <li class="list-inline-item">
                        <a href="#">
                            <span class="type--fine-print">Get Started</span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                            <span class="type--fine-print">help@stack.io</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-6 text-right text-center-xs">
                <ul class="social-list list-inline list--hover">
                    <li class="list-inline-item">
                        <a href="#">
                            <i class="socicon socicon-google icon icon--xs"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                            <i class="socicon socicon-twitter icon icon--xs"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                            <i class="socicon socicon-facebook icon icon--xs"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                            <i class="socicon socicon-instagram icon icon--xs"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!--end of row-->
        <div class="row">
            <div class="col-md-6">
                <p class="type--fine-print">
                    Supercharge your web workflow
                </p>
            </div>
            <div class="col-md-6 text-right text-center-xs">
                            <span class="type--fine-print">&copy;
                                <span class="update-year"></span> Stack Inc.</span>
                <a class="type--fine-print" href="#">Privacy Policy</a>
                <a class="type--fine-print" href="#">Legal</a>
            </div>
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->
</footer>
</div>
<!--------------------------------------------------------------FOOTER---------------------------------------------->
<a class="back-to-top inner-link" href="#start" data-scroll-class="100vh:active">
    <i class="stack-interface stack-up-open-big"></i>
</a>
<script src="<?php echo base_url(); ?>assets/front/js/jquery-3.1.1.min.js?v=<?php echo JS_VERSION; ?>"></script>
<script src="<?php echo base_url(); ?>assets/front/js/flickity.min.js?v=<?php echo JS_VERSION; ?>"></script>
<script src="<?php echo base_url(); ?>assets/front/js/easypiechart.min.js?v=<?php echo JS_VERSION; ?>"></script>
<script src="<?php echo base_url(); ?>assets/front/js/parallax.js?v=<?php echo JS_VERSION; ?>"></script>
<script src="<?php echo base_url(); ?>assets/front/js/typed.min.js?v=<?php echo JS_VERSION; ?>"></script>
<script src="<?php echo base_url(); ?>assets/front/js/datepicker.js?v=<?php echo JS_VERSION; ?>"></script>
<script src="<?php echo base_url(); ?>assets/front/js/isotope.min.js?v=<?php echo JS_VERSION; ?>"></script>
<script src="<?php echo base_url(); ?>assets/front/js/ytplayer.min.js?v=<?php echo JS_VERSION; ?>"></script>
<script src="<?php echo base_url(); ?>assets/front/js/lightbox.min.js?v=<?php echo JS_VERSION; ?>"></script>
<script src="<?php echo base_url(); ?>assets/front/js/granim.min.js?v=<?php echo JS_VERSION; ?>"></script>
<script src="<?php echo base_url(); ?>assets/front/js/jquery.steps.min.js?v=<?php echo JS_VERSION; ?>"></script>
<script src="<?php echo base_url(); ?>assets/front/js/countdown.min.js?v=<?php echo JS_VERSION; ?>"></script>
<script src="<?php echo base_url(); ?>assets/front/js/twitterfetcher.min.js?v=<?php echo JS_VERSION; ?>"></script>
<script src="<?php echo base_url(); ?>assets/front/js/spectragram.min.js?v=<?php echo JS_VERSION; ?>"></script>
<script src="<?php echo base_url(); ?>assets/front/js/smooth-scroll.min.js?v=<?php echo JS_VERSION; ?>"></script>
<script src="<?php echo base_url(); ?>assets/front/js/scripts.js?v=<?php echo JS_VERSION; ?>"></script>


<script type="text/javascript">
    $(function(){
        var path = window.location.pathname;
        var page = path.split("/").pop();
        var title = document.title;

        if(page=='about') {
            $('#menu1').addClass('bar--transparent bar--absolute');
            $('body').find('.bar').eq(0).remove();
        }

        $('.flickity-slider li').css({'height':'100%'});
        $('.flickity-slider li img').css({'top':'50%', 'position':'absolute','transform':'translateY(-50%)'});

    });
</script>

<script type="text/javascript">
    $(function(){
        //$('#searchForm').submit(false);

        //$('#searchInput').on('keypress', function (e) {
        //    if(e.which === 13){
         //       search();
         //   }
       // })

    });



    function search()
    {
        var keyword = $('#searchInput').val();
        if(keyword == ''){
            alert("search keyword cannot be blank");
            return false;
        }

        var url = $('#searchForm').attr('action')+'/'+ keyword;

        location.href = url ;

        return false;
    }
</script>


</body>
</html>