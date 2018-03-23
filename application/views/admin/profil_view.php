<link rel="stylesheet" type="text/css" href="<?=base_url();?>backend/js/sweetalert2.css">
<script src="<?=base_url();?>backend/js/sweetalert2.min.js"></script>
<link href="<?=base_url();?>backend/assets/admin/pages/css/profile.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>backend/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>

<div class="page-content-wrapper">
    <div class="page-content">
        <h3 class="page-title">Profil</h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?=site_url('admin/home');?>">Dashboard</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Profil</a>
                </li>
            </ul>
            <div class="page-toolbar">
                <div id="dashboard-report-range" class="pull-right tooltips btn btn-fit-height grey-salt">
                    <i class="icon-calendar">&nbsp; </i><span class="uppercase visible-lg-inline-block"><?=tgl_indo(date('Y-m-d'));?></span>
                </div>
            </div>
        </div>

        <div class="row margin-top-20">
            <div class="col-md-12">
                <div class="profile-sidebar">
                    <div class="portlet light profile-sidebar-portlet">
                        <div class="profile-userpic">
                            <?php if (!empty($detail->user_avatar)) {?>
                            <img src="<?=base_url('img/icon/' . $detail->user_avatar);?>" class="img-responsive" alt="">
                            <?php } else {?>
                            <img src="<?=base_url('img/no-profil.png');?>" class="img-responsive" alt="">
                            <?php }?>
                        </div>
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name"><?=$detail->user_name;?></div>
                            <div class="profile-usertitle-job"><?=$detail->user_level;?></div>
                        </div>
                        <div class="profile-usermenu">

                        </div>
                    </div>
                </div>
                <div class="profile-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption caption-md">
                                        <i class="icon-globe theme-font hide"></i>
                                        <span class="caption-subject font-blue-madison bold uppercase">Setting Profil</span>
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_1" data-toggle="tab">Info Personal</a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_2" data-toggle="tab">Ganti Avatar</a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_3" data-toggle="tab">Ganti Password</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="portlet-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1_1">
                                            <form role="form" action="" method="post" id="formProfil">
                                                <div class="form-group">
                                                    <label class="control-label">Nama Lengkap</label>
                                                    <div class="input-icon right">
                                                    <i class="fa"></i>
                                                        <input type="text" name="name" class="form-control" value="<?=$detail->user_name;?>" autocomplete="off" autofocus>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">No. Handphone</label>
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="text" class="form-control" name="mobile" value="<?=$detail->user_mobile;?>" maxlength="12" placeholder="Input Handphone" autocomplete="off"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Email</label>
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="text" class="form-control" name="email" value="<?=$detail->user_email;?>" placeholder="Input Email" autocomplete="off" readonly/>
                                                    </div>
                                                </div>
                                                <div class="margiv-top-10">
                                                    <button type="submit" class="btn green">
                                                        <i class="fa fa-floppy-o"></i> Update
                                                    </button>
                                                </div>
                                                <br>
                                            </form>
                                        </div>
                                        <div class="tab-pane" id="tab_1_2">
                                            <form action="" method="post" id="formAvatar" role="form" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                            <img src="<?=base_url('img/no-image.png');?>" alt=""/>
                                                        </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px;"></div>
                                                        <div>
                                                            <span class="btn default btn-file">
                                                            <span class="fileinput-new">
                                                            Pilih Foto </span>
                                                            <span class="fileinput-exists">
                                                            Ubah </span>
                                                            <input type="file" name="foto" accept=".png,.jpg,.jpeg,.gif" required>
                                                            </span>
                                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">
                                                            Hapus </a>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix margin-top-10">
                                                        <span class="label label-danger">
                                                        INFO !</span>
                                                        Resolution : 150 x 150 Pixel
                                                    </div>
                                                </div>
                                                <div class="margin-top-10">
                                                    <button type="submit" class="btn green">
                                                        <i class="fa fa-floppy-o"></i> Update
                                                    </button>
                                                </div>
                                                <br>
                                            </form>
                                        </div>
                                        <div class="tab-pane" id="tab_1_3">
                                            <form action="" method="post" id="formPassword">
                                                <div class="form-group">
                                                    <label class="control-label">Password Lama</label>
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="password" class="form-control" name="oldpassword" id="oldpassword" autocomplete="off" required />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Password Baru</label>
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="password" class="form-control" name="newpassword" id="newpassword" autocomplete="off" required />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Konfirmasi Password Baru</label>
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" autocomplete="off" required />
                                                    </div>
                                                </div>
                                                <div class="margin-top-10">
                                                    <button type="submit" class="btn green">
                                                        <i class="fa fa-floppy-o"></i> Update
                                                    </button>
                                                </div>
                                                <br>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="<?=base_url();?>backend/assets/admin/pages/scripts/profile.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=base_url();?>backend/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>

<script type="text/javascript" src="<?=base_url();?>backend/assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    var form        = $('#formProfil');
    var error       = $('.alert-danger', form);
    var success     = $('.alert-success', form);

    $("#formProfil").validate({
        errorElement: 'span',
        errorClass: 'help-block help-block-error',
        focusInvalid: false,
        ignore: "",
        rules: {
            name: {
                required: true, minlength: 5
            },
            lstGender: {
                required: true
            },
            mobile: {
                required: true, minlength: 11, number: true
            }
        },
        messages: {
            name: {
                required:'Nama Lengkap harus diisi', minlength:'Minimal 5 Karakter'
            },
            lstGender: {
                required:'Jenis Kelamin harus dipilih'
            },
            mobile: {
                required:'Handphone harus diisi', minlength:'Minimal 11 Digit', number:'Hanya Angka'
            }
        },
        invalidHandler: function (event, validator) {
            success.hide();
            error.show();
            Metronic.scrollTo(error, -200);
        },
        errorPlacement: function (error, element) {
            var icon = $(element).parent('.input-icon').children('i');
            icon.removeClass('fa-check').addClass("fa-warning");
            icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
        },
        highlight: function (element) {
            $(element)
            .closest('.form-group').removeClass("has-success").addClass('has-error');
        },
        unhighlight: function (element) {
        },
        success: function (label, element) {
            var icon = $(element).parent('.input-icon').children('i');
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            icon.removeClass("fa-warning").addClass("fa-check");
        },
        submitHandler: function(form) {
            dataString = $("#formProfil").serialize();
            $.ajax({
                url: "<?=site_url('admin/profil/updatedataprofil');?>",
                type: "POST",
                data: dataString,
                dataType: 'JSON',
                success: function(data) {
                    swal({
                        title:"Sukses",
                        text: "Update Data Profil Sukses",
                        showConfirmButton: false,
                        type: "success",
                        timer: 2000
                    });
                    location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error Update Data Profil');
                }
            });
        }
    });
});

$(document).ready(function() {
    var form        = $('#formAvatar');
    var error       = $('.alert-danger', form);
    var success     = $('.alert-success', form);

    $("#formAvatar").validate({
        errorElement: 'span',
        errorClass: 'help-block help-block-error',
        focusInvalid: false,
        ignore: "",
        rules: {
            foto: { required: true }
        },
        messages: {
            foto: { required: 'Pilih Avatar' }
        },
        invalidHandler: function (event, validator) {
            success.hide();
            error.show();
            Metronic.scrollTo(error, -200);
        },
        errorPlacement: function (error, element) {
            var icon = $(element).parent('.input-icon').children('i');
            icon.removeClass('fa-check').addClass("fa-warning");
            icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
        },
        highlight: function (element) {
            $(element)
            .closest('.form-group').removeClass("has-success").addClass('has-error');
        },
        unhighlight: function (element) {
        },
        success: function (label, element) {
            var icon = $(element).parent('.input-icon').children('i');
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            icon.removeClass("fa-warning").addClass("fa-check");
        },
        submitHandler: function(form) {
            var formData = new FormData($('#formAvatar')[0]);
            $.ajax({
                dataType: 'json',
                data: formData,
                async: true,
                url: "<?=site_url('admin/profil/updateavatar');?>",
                type: "POST",
                success: function(data) {
                    if (data.status === 'success') {
                        swal({
                            title:"Sukses",
                            text: "Update Avatar Berhasil",
                            timer: 2000,
                            showConfirmButton: false,
                            type: "success"
                        }, function() {
                            location.reload();
                        });
                    } else {
                        swal({
                            title:"Gagal",
                            text: "File Tidak sesuai Format (JPG/PNG/JPEG)",
                            timer: 2000,
                            showConfirmButton: false,
                            type: "error"
                        }, function() {
                            location.reload();
                        });
                    }
                },
                error: function() {
                    swal({
                        title:"Gagal",
                        text: "Update Avatar Gagal",
                        timer: 2000,
                        showConfirmButton: false,
                        type: "error"
                    });
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
    });
});

$(document).ready(function() {
    var form        = $('#formPassword');
    var error       = $('.alert-danger', form);
    var success     = $('.alert-success', form);

    $("#formPassword").validate({
        errorElement: 'span',
        errorClass: 'help-block help-block-error',
        focusInvalid: false,
        ignore: "",
        rules: {
            oldpassword: {
                required: true,
                remote: {
                    url: "<?=site_url('admin/profil/check_old_password');?>",
                    type: "post",
                    data: {
                        oldpassword: function() {
                            return $("#oldpassword").val();
                        }
                    }
                }
            },
            newpassword: {
                required: true, minlength: 5
            },
            confirmpassword: {
                required: true, equalTo: "#newpassword"
            }
        },
        messages: {
            oldpassword: {
                required:'Password Lama harus di isi', remote:'Password Lama Salah'
            },
            newpassword: {
                required:'Password Baru harus di isi', minlength:'Password Baru minimal 5 karakter'
            },
            confirmpassword: {
                required:'Konfirmasi Password harus di isi', minlength:'Konfirmasi Password minimal 5 karakter',
                equalTo: "Konfirmasi Password harus sama dengan Password Baru"
            }
        },
        invalidHandler: function (event, validator) {
            success.hide();
            error.show();
            Metronic.scrollTo(error, -200);
        },
        errorPlacement: function (error, element) {
            var icon = $(element).parent('.input-icon').children('i');
            icon.removeClass('fa-check').addClass("fa-warning");
            icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
        },
        highlight: function (element) {
            $(element)
            .closest('.form-group').removeClass("has-success").addClass('has-error');
        },
        unhighlight: function (element) {
        },
        success: function (label, element) {
            var icon = $(element).parent('.input-icon').children('i');
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            icon.removeClass("fa-warning").addClass("fa-check");
        },
        submitHandler: function(form) {
            dataString = $("#formPassword").serialize();
            $.ajax({
                url: "<?=site_url('admin/profil/updatepassword');?>",
                type: "POST",
                data: dataString,
                success: function(data) {
                    swal({
                        title:"Sukses",
                        text: "Update Password Berhasil",
                        showConfirmButton: false,
                        type: "success",
                        timer: 2000
                    });
                    location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error Change Password');
                }
            });
        }
    });
});
</script>