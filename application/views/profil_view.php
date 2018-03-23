<div id="main">
    <div class="breadcrumb-section">
        <div class="container">
            <h1>Profil Daycare</h1>
            <div class="breadcrumb">
                <a href="<?=base_url();?>">Beranda</a>
                <span class="fa fa-angle-double-right"></span>
                <a href="#">Profil</a>
                <span class="fa fa-angle-double-right"></span>
                <span class="current">Profil Daycare</span>
            </div>
        </div>
    </div>
    <div class="container">
        <section id="primary" class="content-full-width">
            <div class="column dt-sc-one-half first">
                <div class="about-slider-wrapper">
                    <ul class="about-slider">
                        <?php foreach($listImage as $r) { ?>
                        <li><img src="<?=base_url('img/img_about_folder/'.$r->img_about_image);?>" alt=""></li>
                        <?php } ?>
                    </ul>
                </div>  
            </div>
            <div class="column dt-sc-one-half">                  
                <h2>Tentang Kami</h2>
                <?php
                $desc =  str_replace('&lt;', '<', str_replace('&gt;', '>', $detailprofil->menu_desc));
                echo $desc;
                ?>
            </div> 
            <div class="dt-sc-hr"></div>
            
            <?php foreach($listTeam as $t) { ?>
            <h2 class="dt-sc-hr-green-title"><?=ucwords(strtolower($t->team_name));?></h2>
            <?php 
            $no      = 1;
            $team_id = $t->team_id;
            $listStaff = $this->profil_m->select_staff($team_id)->result();
            foreach($listStaff as $s) {
                $class   = ($no%4==1?'first':'');
            ?>
            <div class="column dt-sc-one-fourth <?=$class;?>">
                <div class="dt-sc-team">    
                    <div class="image">
                        <img class="item-mask" src="<?=base_url('front/images/mask.png');?>" alt="" title="">
                        <img src="<?=base_url('img/employee_folder/'.$s->employee_image);?>" alt="" title="">
                    </div>
                    <div class="team-details">
                        <h4><?=$s->employee_name;?></h4>
                        <h6><?=$s->employee_position;?></h6>
                    </div>
                </div>
            </div>
            <?php
                if ($no%4==0) {
                    echo '<div class="dt-sc-hr"></div>';
                }

                $no++;
                }
            } 
            ?>
        </section>
    </div>
</div>