<div id="main">
    <div class="breadcrumb-section">
        <div class="container">
            <h1>Promo</h1>
            <div class="breadcrumb">
                <a href="<?=base_url();?>">Beranda</a>
                <span class="fa fa-angle-double-right"></span>
                <span class="current">Promo</span>
            </div>
        </div>
    </div>
    <div class="container">
        <section id="primary" class="content-full-width">
            <div class="dt-sc-sorting-container">
                <a href="#" title="" class="active-sort" data-filter="*"> Semua</a>
                <?php foreach($listCategory as $r) { ?>
                <a href="#" title="" data-filter=".<?=$r->promo_category_seo;?>"><?=ucwords(strtolower($r->promo_category_name));?></a>
                <?php } ?>
            </div> 
            <div class="dt-sc-portfolio-container">
                <?php 
                $no = 1;
                foreach($listPromo as $r) {
                    $class      = ($no%4==1?'first':'');
                ?>
                <div class="portfolio dt-sc-one-fourth column <?=$class;?> <?=$r->promo_category_seo;?>">
                <div class="portfolio-thumb">
                    <!-- <img class="item-mask" src="<?=base_url('front/images/mask.png');?>" alt="" title=""> -->
                    <img src="<?=base_url('img/promo_folder/'.$r->promo_image);?>" alt="" title="">
                        <div class="image-overlay">
                            <a href="<?=base_url('img/promo_folder/'.$r->promo_image);?>" data-gal="prettyPhoto[gallery]" class="zoom"><span class="fa fa-search"></span></a>
                        </div>
                    </div>
                    <div class="portfolio-detail">
                        <div class="portfolio-title">
                            <h5><a href="#"><?=ucwords(strtolower($r->promo_name));?></a></h5>
                        </div>
                    </div>
                </div>
                <?php 
                    $no++;
                } 
                ?>
            </div>
        </section>
    </div>
</div>