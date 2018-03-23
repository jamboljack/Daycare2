<div id="main">
    <div class="breadcrumb-section">
        <div class="container">
            <h1><?=$detail->menu_name;?></h1>
            <div class="breadcrumb">
                <a href="<?=base_url();?>">Beranda</a>
                <span class="fa fa-angle-double-right"></span>
                <a href="#">Profil</a>
                <span class="fa fa-angle-double-right"></span>
                <span class="current"><?=$detail->menu_name;?></span>
            </div>
        </div>
    </div>
    <div class="container">
        <section id="primary" class="content-full-width">
            <?=$detail->menu_desc;?>
        </section>
    </div>
</div>