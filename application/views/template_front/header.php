<?php
$uri  = $this->uri->segment(1);
$uri1 = $this->uri->segment(2);

if ($uri == '' || $uri == 'home') {
    $beranda    = 'current_page_item';
    $profMenu   = '';
    $profDetail = '';
    $profil     = '';
    $prodMenu   = '';
    $produk     = '';
    $galeri     = '';
    $promo      = '';
    $artikel    = '';
    $register   = '';
    $kontak     = '';
} elseif ($uri == 'profil' && $uri1 == '') {
    $beranda    = '';
    $profMenu   = 'current_page_item';
    $profDetail = '';
    $profil     = 'current_page_item';
    $prodMenu   = '';
    $produk     = '';
    $galeri     = '';
    $promo      = '';
    $artikel    = '';
    $register   = '';
    $kontak     = '';
} elseif ($uri == 'profil' && $uri1 == 'id') {
    $beranda    = '';
    $profMenu   = 'current_page_item';
    $profDetail = 'current_page_item';
    $profil     = '';
    $prodMenu   = '';
    $produk     = '';
    $galeri     = '';
    $promo      = '';
    $artikel    = '';
    $register   = '';
    $kontak     = '';
} elseif ($uri == 'produk') {
    $beranda    = '';
    $profMenu   = '';
    $profDetail = '';
    $profil     = '';
    $prodMenu   = 'current_page_item';
    $produk     = 'current_page_item';
    $galeri     = '';
    $promo      = '';
    $artikel    = '';
    $register   = '';
    $kontak     = '';
} elseif ($uri == 'galeri') {
    $beranda    = '';
    $profMenu   = '';
    $profDetail = '';
    $profil     = '';
    $prodMenu   = '';
    $produk     = '';
    $galeri     = 'current_page_item';
    $promo      = '';
    $artikel    = '';
    $register   = '';
    $kontak     = '';
} elseif ($uri == 'promo') {
    $beranda    = '';
    $profMenu   = '';
    $profDetail = '';
    $profil     = '';
    $prodMenu   = '';
    $produk     = '';
    $galeri     = '';
    $promo      = 'current_page_item';
    $artikel    = '';
    $register   = '';
    $kontak     = '';
} elseif ($uri == 'artikel') {
    $beranda    = '';
    $profMenu   = '';
    $profDetail = '';
    $profil     = '';
    $prodMenu   = '';
    $produk     = '';
    $galeri     = '';
    $promo      = '';
    $artikel    = 'current_page_item';
    $register   = '';
    $kontak     = '';
} elseif ($uri == 'register') {
    $beranda    = '';
    $profMenu   = '';
    $profDetail = '';
    $profil     = '';
    $prodMenu   = '';
    $produk     = '';
    $galeri     = '';
    $promo      = '';
    $artikel    = '';
    $register   = 'current_page_item';
    $kontak     = '';
} elseif ($uri == 'kontak') {
    $beranda    = '';
    $profMenu   = '';
    $profDetail = '';
    $profil     = '';
    $prodMenu   = '';
    $produk     = '';
    $galeri     = '';
    $promo      = '';
    $artikel    = '';
    $register   = '';
    $kontak     = 'current_page_item';
} else {
    $beranda    = '';
    $profMenu   = '';
    $profDetail = '';
    $profil     = '';
    $prodMenu   = '';
    $produk     = '';
    $galeri     = '';
    $promo      = '';
    $artikel    = '';
    $register   = '';
    $kontak     = '';
}
?>
<header>
    <div class="container">
        <div class="logo">
            <a href="<?=base_url();?>" title="Kids Life"><img src="<?=base_url();?>img/alifa-dc.png" alt="ALIF-A Daycare" title="ALIF-A Daycare"></a>
        </div>
        <div class="contact-details">
            <p class="phone-no">
                <i>Chat dengan Kami, via Whatsapp ?</i>
            </p>
            <p class="mail">
                <a href="https://api.whatsapp.com/send?phone=6283867295429&text=Saya%20ingin%20bertanya%20tentang%20daycare%20Alifa" target="_blank">0838-6729-5429 <img src="<?=base_url('img/logo-wa.png');?>"></a> 
            </p>
        </div>
    </div>
    <div id="menu-container">
        <div class="container">
            <nav id="main-menu">
                <div class="dt-menu-toggle" id="dt-menu-toggle">Menu<span class="dt-menu-toggle-icon"></span></div>
                <ul id="menu-main-menu" class="menu">
                    <li class="<?=$beranda;?> green"><a href="<?=base_url();?>" title="Home">
                        <i class="fa fa-home"></i> Beranda</a>
                    </li>
                    <li class="<?=$profMenu;?> menu-item-simple-parent menu-item-depth-0 pink"> 
                        <a href="#"> Profil</a>
                        <ul class="sub-menu">
                            <li><a href="<?=site_url('profil/id/'.encrypt('4'));?>">Sambutan Direktur</a></li>
                            <li><a href="<?=site_url('profil/id/'.encrypt('2'));?>">Visi & Misi</a></li>
                            <li><a href="<?=site_url('profil');?>">Profil Daycare</a></li>
                            <li><a href="<?=site_url('profil/id/'.encrypt('5'));?>">Keunggulan</a></li>
                        </ul>
                        <a class="dt-menu-expand">+</a>
                    </li>
                    <li class="<?=$prodMenu;?> menu-item-simple-parent menu-item-depth-0 blue"> 
                        <a href="#"> Produk & Fasilitas </a>
                        <ul class="sub-menu">
                            <?php $listProduk = $this->menu_m->select_menu_product()->result();foreach ($listProduk as $p) {?>
                                <li><a href="<?=site_url('produk/id/' . encrypt($p->menu_id));?>"><?=$p->menu_name;?></a></li>
                            <?php }?>
                        </ul>
                        <a class="dt-menu-expand">+</a>
                    </li>
                    <li class="<?=$galeri;?> mustard"><a href="<?=site_url('galeri');?>"> Galeri</a></li>
                    <li class="<?=$promo;?> yellow"><a href="<?=site_url('promo');?>"> Promo </a></li>
                    <li class="<?=$artikel;?> steelblue"><a href="<?=site_url('artikel');?>"> Tabloid </a></li>
                    <li class="<?=$register;?> lavender"><a href="<?=site_url('register');?>"> Pendaftaran</a></li>
                    <li class="<?=$kontak;?> pink"><a href="<?=site_url('kontak');?>"> Kontak Kami </a> </li>
                </ul>
            </nav>
            <ul class="dt-sc-social-icons">
                <?php
                $social = $this->menu_m->select_social()->result();
                foreach ($social as $s) {
                ?>
                <li><a href="<?=$s->social_url;?>" title="<?=ucwords(strtolower($s->social_name));?>" target="_blank" class="dt-sc-tooltip-top <?=$s->social_class;?>"><span class="fa fa-<?=$s->social_class;?>"></span></a></li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</header>