<div id="main">
    <div id="slider">
        <div id="layerslider_4" class="ls-wp-container" style="width:100%; height:980px;max-width:1920px;margin:0 auto;margin-bottom: 0px;">
            <?php
            foreach ($listSlider as $s) {
            ?>
            <div class="ls-slide" data-ls="slidedelay:7000; transition2d: all;">
                <img src="<?=base_url();?>img/slider_folder/<?=$s->slider_image;?>" class="ls-bg" alt="Slider Image" />
            </div>
            <?php
            }
            ?>
        </div>
    </div>
    
    <section id="primary" class="content-full-width">
        <section class="fullwidth-background dt-sc-parallax-section orange-bg">
            <div class="container">
                <h2 class="dt-sc-hr-white-title">Berita Utama</h2>
                <?php 
                $no = 1;
                foreach($listArticle as $a) {
                    $tgl     = date('Y-m-d', strtotime($a->article_post));
                    $tanggal = substr($tgl,8,2);
                    $tahun   = substr($tgl,0,4);
                    $class   = ($no%2==1?'first':'');
                ?>
                <div class="column dt-sc-one-half <?=$class;?>">
                    <article class="blog-entry">
                        <div class="blog-entry-inner">
                            <div class="entry-meta">
                            <a href="<?=site_url('artikel/id/'.encrypt($a->article_id).'/'.$a->article_seo);?>" class="blog-author"><img src="<?=base_url('img/emo.png');?>" alt="" title=""></a>
                                <div class="date">
                                    <span> <?=$tanggal;?> </span><p> <?=getBln(substr($tgl,5,2));?> <br> <?=$tahun;?></p>
                                </div>
                                <a href="#" class="comments">
                                    <?=$a->article_read;?> <span class="fa fa-eye"> </span>
                                </a>
                            </div>
                            <div class="entry-thumb">
                                <a href="<?=site_url('artikel/id/'.encrypt($a->article_id).'/'.$a->article_seo);?>"><img src="<?=base_url('img/article_folder/'.$a->article_image);?>" alt="" title=""></a>
                            </div>
                            <div class="entry-details">
                                <div class="entry-title">
                                    <h3><a href="<?=site_url('artikel/id/'.encrypt($a->article_id).'/'.$a->article_seo);?>"> <?=$a->article_title;?> </a></h3>
                                </div>
                                <div class="entry-body">
                                    <p><?=word_limiter($a->article_desc,20);?></p>
                                </div>
                                <a href="<?=site_url('artikel/id/'.encrypt($a->article_id).'/'.$a->article_seo);?>" class="dt-sc-button small"> Selengkapnya <span class="fa fa-chevron-circle-right"> </span></a>
                            </div>
                        </div>
                    </article>
                </div>
                <?php 
                    $no++;
                } 
                ?>
            </div>
        </section>

    </section>
</div>