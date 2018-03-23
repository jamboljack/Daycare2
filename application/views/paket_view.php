<div id="main">
    <div class="breadcrumb-section">
        <div class="container">
            <h1>Paket</h1>
            <div class="breadcrumb">
                <a href="<?=base_url();?>">Beranda</a>
                <span class="fa fa-angle-double-right"></span>
                <a href="#">Paket</a>
                <span class="fa fa-angle-double-right"></span>
                <span class="current"><?=ucwords(strtolower($detail->paket_name));?></span>
            </div>
        </div>
    </div>
    
    <div class="container">
        <section id="primary" class="with-sidebar">
            <h3><?=$detail->paket_name;?></h3>
            <p align="justify"><?=$detail->paket_desc;?></p>
        </section>
                
        <section id="secondary">
            <aside class="widget widget_categories">
                <h3 class="widgettitle">Jenis Paket</h3>
                <ul>
                    <?php 
                    foreach($listPaket as $r) {
                    ?>
                    <li><a href="<?=site_url('paket/id/'.encrypt($r->paket_id).'/'.$r->paket_seo);?>"><?=ucwords(strtolower($r->paket_name));?></a></li>
                    <?php } ?>
                </ul>
            </aside>
        </section>
    </div>
</div>