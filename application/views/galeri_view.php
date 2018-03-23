<div id="main">
    <div class="breadcrumb-section">
        <div class="container">
            <h1>Galeri</h1>
            <div class="breadcrumb">
                <a href="<?=base_url();?>">Beranda</a>
                <span class="fa fa-angle-double-right"></span>
                <span class="current">Galeri</span>
            </div>
        </div>
    </div>
    <div class="container">
        <section id="primary" class="content-full-width">
            <div class="dt-sc-sorting-container">
                <a href="#" title="" class="active-sort" data-filter="*"> Semua</a>
                <?php foreach($listCategory as $r) { ?>
                <a href="#" title="" data-filter=".<?=$r->category_gallery_seo;?>"><?=ucwords(strtolower($r->category_gallery_name));?></a>
                <?php } ?>
            </div> 
            <div class="dt-sc-portfolio-container">
                <?php 
                $no = 1;
                foreach($listGalery as $r) {
                    $class      = ($no%4==1?'first':'');
                    $gallery_id = $r->gallery_id;
                    $jmlFoto    = $this->galeri_m->select_jumlah($gallery_id)->row();
                ?>
                <div class="portfolio dt-sc-one-fourth column <?=$class;?> <?=$r->category_gallery_seo;?>">
                <div class="portfolio-thumb">
                    <!-- <img class="item-mask" src="<?=base_url('front/images/mask.png');?>" alt="" title=""> -->
                    <img src="<?=base_url('img/gallery_folder/'.$r->gallery_image);?>" alt="" title="">
                        <div class="image-overlay">
                            <a href="<?=site_url('galeri/id'.'/'.encrypt($r->gallery_id).'/'.$r->gallery_seo);?>" class="link"><span class="fa fa-link"></span></a>
                            <a href="<?=base_url('img/gallery_folder/'.$r->gallery_image);?>" data-gal="prettyPhoto[gallery]" class="zoom"><span class="fa fa-search"></span></a>
                        </div>
                    </div>
                    <div class="portfolio-detail">
                        <div class="portfolio-title">
                            <h5><a href="<?=site_url('galeri/id'.'/'.encrypt($r->gallery_id).'/'.$r->gallery_seo);?>"><?=ucwords(strtolower($r->gallery_name));?></a></h5>
                            <p><a href="#"><?=$jmlFoto->jumlah;?> Foto</a></p>
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