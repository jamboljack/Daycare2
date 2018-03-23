<link href="<?=base_url();?>backend/js/sweetalert2.css" rel="stylesheet" type="text/css" />
<script src="<?=base_url();?>backend/js/sweetalert2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>backend/assets/global/plugins/bootstrap-summernote/summernote.css">

<?php
if ($this->session->flashdata('notification')) {?>
<script>
swal({
    title: "Sukses",
    text: "<?=$this->session->flashdata('notification');?>",
    timer: 2000,
    showConfirmButton: false,
    type: 'success'
});
</script>
<?}?>

<div class="page-content-wrapper">
    <div class="page-content">
        <h3 class="page-title">
            Profil Daycare
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?=site_url('admin/home');?>">Dashboard</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Menu Profil</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Profil Daycare</a>
                </li>
            </ul>
            <div class="page-toolbar">
                <div id="dashboard-report-range" class="pull-right tooltips btn btn-fit-height grey-salt">
                    <i class="icon-calendar">&nbsp; </i><span class="uppercase visible-lg-inline-block"><?=tgl_indo(date('Y-m-d'));?></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="portlet box grey-steel">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-edit"></i> Detail Profil Daycare
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <form role="form" class="form-horizontal" method="post" id="formInput" action="<?=site_url('admin/about/updatedata');?>">
                        <input type="hidden" name="id" value="<?=$detail->menu_id;?>">

                            <div class="form-body">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <textarea class="form-control" id="summernote" rows="25" name="desc"><?=$detail->menu_desc;?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-10">
                                        <button type="submit" class="btn green"><i class="fa fa-floppy-o"></i> Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script src="<?=base_url();?>backend/assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#summernote').summernote({
        height: 500,
        onImageUpload: function(files, editor, welEditable) {
            sendFile(files[0], editor, welEditable);
        }
    });

    function sendFile(file, editor, welEditable) {
        data = new FormData();
        data.append("file", file);
        $.ajax({
            data: data,
            type: "POST",
            url: '<?=site_url('admin/about/uploadimage');?>',
            cache: false,
            contentType: false,
            processData: false,
            success: function(url) {
                editor.insertImage(welEditable, url);
            }
        });
    }
});
</script>