<section class="section-slider">
    <h1 class="element-invisible">Slider</h1>
    <div id="slider-revolution">
        <ul>
            <?php
            $no = 1;
            foreach ($listSlider as $s) {
                if ($no % 2 == 0) {
                    $transisi = 'boxslide';
                    $bgpos    = 'right';
                } else {
                    $transisi = 'curtain-1';
                    $bgpos    = 'left';
                }
            ?>
            <li data-transition="<?=$transisi;?>">
                <img src="<?=base_url();?>img/slider_folder/<?=$s->slider_image;?>" data-bgrepeat="no-repeat" data-bgfit="cover" data-bgposition="center center" data-duration="14000" data-bgpositionend="<?=$bgpos;?> center" alt="">
                <div class="tp-caption sft fadeout slider-caption-sub slider-caption-1" data-x="center" data-y="100" data-speed="700" data-start="1500" data-easing="easeOutBack">
                </div>
            </li>
            <?php 
                $no++;
            }
            ?>
        </ul>
    </div>
</section>

<section class="section-blog bg-white">
    <div class="container">
        <div class="blog">
            <div class="row">
                <h1 class="element-invisible">Tabloid</h1>
                <div class="col-md-8 col-md-push-4">
                    <div class="blog-content">
                        <?php 
                        foreach($listArticle as $a) {
                            $tgl     = date('Y-m-d', strtotime($a->article_post));
                            $tanggal = substr($tgl,8,2);
                            $tahun   = substr($tgl,0,4);
                        ?>
                        <article class="post">
                            <div class="entry-media">
                                <a href="<?=site_url('artikel/id/'.encrypt($a->article_id).'/'.$a->article_seo);?>" class="post-thumbnail hover-zoom">
                                    <img src="<?=base_url('img/article_folder/'.$a->article_image);?>" alt="">
                                </a>
                                <span class="posted-on"><strong><?=$tanggal;?></strong><?=getBln(substr($tgl,5,2));?></span>
                            </div>
                            <div class="entry-header">
                                <h2 class="entry-title">
                                    <a href="<?=site_url('artikel/id/'.encrypt($a->article_id).'/'.$a->article_seo);?>"><?=$a->article_title;?></a>
                                </h2>
                            </div>
                            <div class="entry-content">
                                <p align="justify"><?=word_limiter($a->article_desc,40);?></p>
                            </div>
                            <div class="entry-footer">
                                <p class="entry-meta">
                                    <span class="posted-on">
                                        <span class="screen-reader-text">Posted on</span>
                                        <span class="entry-time"><?=tgl_indo($a->article_post);?></span>
                                    </span>
                                    <span class="entry-author">
                                        <span class="screen-reader-text">Posting oleh </span>
                                        <a href="#" class="entry-author-link">
                                            <span class="entry-author-name"><?=$a->user_name;?></span>
                                        </a>
                                    </span>
                                    <span class="entry-categories">
                                        <a href="<?=site_url('category/id/'.encrypt($a->category_id).'/'.$a->category_seo);?>"><?=ucwords(strtolower($a->category_name));?></a>
                                    </span>
                                    <span class="entry-tags">
                                        <span class="screen-reader-text"><i class="fa fa-eye"></i></span>
                                        <a href="#"><?=$a->article_read;?> kali</a>
                                    </span>
                                </p>
                            </div>
                        </article>
                        <?php } ?>
                        <?php echo $pages; ?>
                    </div>
                </div> 
                <div class="col-md-4 col-md-pull-8">
                    <div class="sidebar">
                        <div class="widget widget_categories">
                            <h4 class="widget-title">KATEGORI</h4>
                            <ul>
                                <?php 
                                $listKategori = $this->menu_m->select_category()->result(); 
                                foreach($listKategori as $r) {
                                ?>
                                <li><a href="<?=site_url('artikel/kategori/'.encrypt($r->category_id).'/'.$r->category_seo);?>"><?=ucwords(strtolower($r->category_name));?></a></li>
                                <?php } ?>
                            </ul>
                        </div>

                        <div class="widget widget_deal">
                            <h4 class="widget-title">PROMO</h4>
                            <div class="widget-deal owl-single">
                                <?php 
                                $listPromo = $this->menu_m->select_promo()->result(); 
                                foreach($listPromo as $r) {
                                ?>
                                <div class="item-isotope">
                                    <div class="gallery_item">
                                        <a href="<?=base_url('img/promo_folder/'.$r->promo_image);?>" class="mfp-image">
                                            <img src="<?=base_url('img/promo_folder/'.$r->promo_image);?>" alt="">
                                        </a>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        
                        <div class="widget widget_recent_entries has_thumbnail">        
                            <h4 class="widget-title">Artikel Terbaru</h4>
                            <ul>
                                <?php 
                                $listArticle = $this->menu_m->select_article()->result(); 
                                foreach($listArticle as $r) {
                                ?>
                                <li>
                                    <div class="img">
                                        <a href="<?=site_url('artikel/id/'.encrypt($r->article_id).'/'.$r->article_seo);?>">
                                            <img src="<?=base_url('img/article_folder/'.$r->article_image);?>" alt="">
                                        </a>
                                    </div>
                                    <div class="text">
                                        <a href="<?=site_url('artikel/id/'.encrypt($r->article_id).'/'.$r->article_seo);?>"><?=word_limiter($r->article_title,3);?></a>
                                        <span class="date"><?=tgl_indo($r->article_post);?></span>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>

                        <div class="widget widget_social">
                            <h4 class="widget-title">Sosial Media</h4>
                            <div class="widget-social">
                                <?php
                                $social = $this->menu_m->select_social()->result();
                                foreach ($social as $s) {
                                ?>
                                <a href="<?=$s->social_url;?>" target="_blank"><i class="fa fa-<?=$s->social_class;?>"></i></a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>