<div class="page-content-wrapper">
    <div class="page-content">
        <h3 class="page-title">Dashboard <small>Informasi Umum</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i><a href="<?=site_url('admin/home');?>"> Dashboard</a>
                </li>
            </ul>
            <div class="page-toolbar">
                <div id="dashboard-report-range" class="pull-right tooltips btn btn-fit-height grey-salt">
                    <i class="icon-calendar">&nbsp; </i><span class="uppercase visible-lg-inline-block"><?=tgl_indo(date('Y-m-d'));?></span>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat blue-madison">
                    <div class="visual">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?=number_format($employee->total,0,'','');?>
                        </div>
                        <div class="desc">
                            Total Karyawan
                        </div>
                    </div>
                    <a class="more" href="<?=site_url('admin/employee');?>">
                    View <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat red-intense">
                    <div class="visual">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?=number_format($student->total,0,'','');?>
                        </div>
                        <div class="desc">
                            Total Siswa
                        </div>
                    </div>
                    <a class="more" href="<?=site_url('admin/student');?>">
                    View <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat purple-plum">
                    <div class="visual">
                        <i class="fa fa-tags"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?=number_format($promo->total,0,'','');?>
                        </div>
                        <div class="desc">
                            Total Promo
                        </div>
                    </div>
                    <a class="more" href="<?=site_url('admin/promo');?>">
                    View <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat green-haze">
                    <div class="visual">
                        <i class="fa fa-newspaper-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?=number_format($article->total,0,'','');?>
                        </div>
                        <div class="desc">
                            Total Artikel
                        </div>
                    </div>
                    <a class="more" href="<?=site_url('admin/article');?>">
                    View <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>