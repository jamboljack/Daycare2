<?php
$meta = $this->menu_m->select_meta()->row();
?>
<!DOCTYPE HTML>
<html lang="en-gb" class="no-js">
<head>
<meta charset="utf-8">
<meta name="keywords" content="<?=$meta->meta_keyword;?>" />
<meta name="description" content="<?=$meta->meta_desc;?>" />
<meta name="Distribution" content="Global">
<meta name="Author" content="<?=$meta->meta_author;?>">
<meta name="Developer" content="<?=$meta->meta_developer;?>">
<meta name="robots" content="<?=$meta->meta_robots;?>" />
<meta name="Googlebot" content="<?=$meta->meta_googlebots;?>" />
<title><?=$meta->meta_name;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link rel="shortcut icon" href="<?=base_url('img/logo-icon.png');?>">
<link href="<?=base_url();?>front/style.css" rel="stylesheet" type="text/css">
<link href="<?=base_url();?>front/css/shortcodes.css" rel="stylesheet" type="text/css">
<link href="<?=base_url();?>front/css/responsive.css" rel="stylesheet" type="text/css">
<link href="<?=base_url();?>front/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<?php if ($this->uri->segment(1)=='') { ?>
<link rel="stylesheet" href="<?=base_url();?>front/css/layerslider.css" type="text/css">
<?php } ?>
<link href="<?=base_url();?>front/css/prettyPhoto.css" rel="stylesheet" type="text/css" media="all" />
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Bubblegum+Sans' rel='stylesheet' type='text/css'>
<script src="<?=base_url();?>front/js/modernizr-2.6.2.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>front/js/jquery.js"></script>
<script type="text/javascript" src="<?=base_url();?>front/js/jquery-migrate.min.js"></script>
</head>
<?php if ($this->uri->segment(1)=='') { ?>
<body class="main">
<?php } else { ?>
<body>
<?php } ?>
    <div class="wrapper">
        <?=$_header;?>
        <?=$content;?>
        <?=$_footer;?>
    </div>
    <a href="" title="Go to Top" class="back-to-top">To Top ↑</a>
    <script type="text/javascript" src="<?=base_url();?>front/js/jquery.tabs.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>front/js/jquery-easing-1.3.js"></script>
    <script type="text/javascript" src="<?=base_url();?>front/js/jquery.sticky.js"></script>
    <script type="text/javascript" src="<?=base_url();?>front/js/jquery.nicescroll.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>front/js/jquery.inview.js"></script>
    <script type="text/javascript" src="<?=base_url();?>front/js/validation.js"></script>
    <script type="text/javascript" src="<?=base_url();?>front/js/jquery.tipTip.minified.js"></script>
    <script type="text/javascript" src="<?=base_url();?>front/js/jquery.isotope.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>front/js/jquery.bxslider.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>front/js/jquery.prettyPhoto.js"></script>
    <script type="text/javascript" src="<?=base_url();?>front/js/twitter/jquery.tweet.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>front/js/jquery.parallax-1.1.3.js"></script>
    <script type="text/javascript" src="<?=base_url();?>front/js/shortcodes.js"></script>
    <script type="text/javascript" src="<?=base_url();?>front/js/custom.js"></script>
    <?php if ($this->uri->segment(1)=='') { ?>
    <script type="text/javascript" src="<?=base_url();?>front/js/jquery-transit-modified.js"></script>
    <script type="text/javascript" src="<?=base_url();?>front/js/layerslider.kreaturamedia.jquery.js"></script>
    <script type='text/javascript' src="<?=base_url();?>front/js/greensock.js"></script>
    <script type='text/javascript' src="<?=base_url();?>front/js/layerslider.transitions.js"></script>
    <script type="text/javascript">var lsjQuery = jQuery;</script>
    <script type="text/javascript"> 
    lsjQuery(document).ready(function() { 
        if(typeof lsjQuery.fn.layerSlider == "undefined") { 
            lsShowNotice('layerslider_1','jquery'); 
        } else { 
            lsjQuery("#layerslider_4").layerSlider({
                responsiveUnder: 1920, 
                layersContainer: 1920, 
                skinsPath: 'front/js/layerslider/skins/',
                responsive: false
            }) 
        } 
    }); 
    </script>
    <?php } else { ?>
    <script type="text/javascript" src="<?=base_url();?>front/js/jquery.carouFredSel-6.2.0-packed.js"></script>
    <?php } ?>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-59838993-11"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-59838993-11');
    </script>
</body>
</html>