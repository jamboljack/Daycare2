<div id="main">
    <div class="breadcrumb-section">
        <div class="container">
            <h1>Galeri</h1>
            <div class="breadcrumb">
                <a href="<?=base_url();?>">Beranda</a>
                <span class="fa fa-angle-double-right"></span>
                <a href="<?=site_url('galeri');?>">Galeri</a>
                <span class="fa fa-angle-double-right"></span>
                <span class="current"><?=ucwords(strtolower($detail->gallery_name));?></span>
            </div>
        </div>
    </div>
    <div class="container">
        <section id="primary" class="content-full-width">
            <div class="dt-sc-portfolio-container">
                <?php 
                $no = 1;
                foreach($listGalery as $r) { 
                    $class   = ($no%4==1?'first':'');
                ?>
                <div class="portfolio dt-sc-one-fourth column first">
                <div class="portfolio-thumb">
                    <!-- <img class="item-mask" src="<?=base_url('front/images/mask.png');?>" alt="" title=""> -->
                    <img src="<?=base_url('img/gallery_folder/'.$r->detail_image);?>" alt="" title="">
                        <div class="image-overlay">
                            <a href="<?=base_url('img/gallery_folder/'.$r->detail_image);?>" data-gal="prettyPhoto[gallery]" class="zoom"><span class="fa fa-search"></span></a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section>
    </div>
</div>