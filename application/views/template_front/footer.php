<?php 
$meta    = $this->menu_m->select_meta()->row();
$contact = $this->menu_m->select_contact()->row();
?>
<footer>
    <div class="footer-widgets-wrapper">
        <div class="container">
            <div class="column dt-sc-one-fourth first">
                <aside class="widget widget_recent_entries">
                    <h3 class="widgettitle green_sketch">Instagram</h3>
                    <!-- LightWidget WIDGET --><script src="https://cdn.lightwidget.com/widgets/lightwidget.js"></script><iframe src="//lightwidget.com/widgets/c11790e4217650d3bca61941d889a5e2.html" scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width: 100%; border: 0; overflow: hidden;"></iframe>
                </aside>
            </div>
            <div class="column dt-sc-one-fourth">
                <aside class="widget tweetbox">
                    <h3 class="widgettitle yellow_sketch"><a href="#"> Twitter Feeds </a></h3>
                    <div id="tweets_container"></div>
                </aside>
            </div>
            <div class="column dt-sc-one-fourth">
                <aside class="widget widget_text">
                    <h3 class="widgettitle red_sketch"> Paket Kami</h3>
                    <ul>
                        <?php 
                        $listPaket = $this->menu_m->select_paket()->result();
                        foreach($listPaket as $r) {
                        ?>
                        <li><a href="<?=site_url('paket/id/'.encrypt($r->paket_id).'/'.$r->paket_seo);?>"><?=ucwords(strtolower($r->paket_name));?></a></li>
                        <?php 
                        }
                        ?>
                    </ul>
                </aside>
            </div>
            <div class="column dt-sc-one-fourth">
                <aside class="widget widget_text">
                    <h3 class="widgettitle steelblue_sketch">Kontak Kami</h3>
                    <div class="textwidget">
                        <img src="<?=base_url();?>img/alifa-dc.png">
                        <p class="dt-sc-contact-info"><span class="fa fa-map-marker"></span> <?=$contact->contact_address;?></p>
                        <p class="dt-sc-contact-info"><span class="fa fa-phone"></span> <?=$contact->contact_phone;?></p>
                        <p class="dt-sc-contact-info"><span class="fa fa-envelope"></span><a href="mailto:<?=$contact->contact_email;?>"> <?=$contact->contact_email;?></a></p>
                        <p class="dt-sc-contact-info"><span class="fa fa-globe"></span><a href="<?=$contact->contact_web;?>"> <?=$contact->contact_web;?></a></p>
                    </div>
                </aside>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <p class="copyright-info">&copy; <?=date('Y');?> - <?=$meta->meta_name;?></p>
            <div class="footer-links">
            </div>
        </div>
    </div>
</footer>