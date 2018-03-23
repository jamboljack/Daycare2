<div id="main">
    <div class="breadcrumb-section">
        <div class="container">
            <h1>Tabloid</h1>
            <div class="breadcrumb">
                <a href="<?=base_url();?>">Beranda</a>
                <span class="fa fa-angle-double-right"></span>
                <a href="<?=site_url('artikel');?>">Tabloid</a>
                <span class="fa fa-angle-double-right"></span>
                <span class="current"><?=ucwords(strtolower($detail->category_name));?></span>
            </div>
        </div>
    </div>
    <div class="container">
        <section id="primary" class="with-sidebar">
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

            <?=$pages;?>
        </section>

        <section id="secondary">
            <aside class="widget widget_categories">
                <h3 class="widgettitle">Kategori</h3>
                <ul>
                    <?php 
                    $listKategori = $this->menu_m->select_category()->result(); 
                    foreach($listKategori as $r) {
                    ?>
                    <li><a href="<?=site_url('artikel/kategori/'.encrypt($r->category_id).'/'.$r->category_seo);?>"><?=ucwords(strtolower($r->category_name));?></a></li>
                    <?php } ?>
                </ul>
            </aside>
            <aside class="widget widget_recent_entries">
                <h3 class="widgettitle green_sketch"> Latest Post </h3>
                <ul>
                    <?php 
                    $listArticle = $this->menu_m->select_article()->result(); 
                    foreach($listArticle as $r) {
                    ?>
                    <li>
                        <a href="<?=site_url('artikel/id/'.encrypt($r->article_id).'/'.$r->article_seo);?>">
                            <img src="<?=base_url('img/article_folder/'.$r->article_image);?>" alt="" title="">
                        </a>
                        <h6>
                            <a href="<?=site_url('artikel/id/'.encrypt($r->article_id).'/'.$r->article_seo);?>"><?=word_limiter($r->article_title,3);?></a>
                        </h6>
                        <span><?=tgl_indo($r->article_post);?></span>
                    </li>
                    <?php } ?>
                </ul>
            </aside>
            
            <aside class="widget widget_recent_entries">
                <h3 class="widgettitle green_sketch">Visitors</h3>
                <a href='https://acadooghostwriter.com/'>https://AcadooGhostwriter.com</a><script type='text/javascript' src='https://www.freevisitorcounters.com/auth.php?id=dd4d9711ef515a1e8c0b710020396043fcea5a4b'></script><script type="text/javascript" src="https://www.freevisitorcounters.com/en/home/counter/336909/t/0"></script>
            </aside>
            
        </section>
    </div>
</div>