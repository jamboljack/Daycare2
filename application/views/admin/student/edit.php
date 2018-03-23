<link href="<?=base_url();?>backend/js/sweetalert2.css" rel="stylesheet" type="text/css" />
<script src="<?=base_url();?>backend/js/sweetalert2.min.js"></script>
<link href="<?=base_url();?>backend/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css"/>

<div class="page-content-wrapper">
    <div class="page-content">
        <h3 class="page-title">
            Siswa
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?=site_url('admin/home');?>">Dashboard</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Penerimaan Siswa</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="<?=site_url('admin/student');?>">Siswa</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Edit Siswa</a>
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
                            <i class="fa fa-edit"></i> Form Edit Siswa
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <form role="form" class="form-horizontal" method="post" id="formInput" name="formInput" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?=$detail->student_id;?>">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Paket</label>
                                    <div class="col-md-5">
                                        <div class="input-icon right"><i class="fa"></i>
                                            <select class="form-control" name="lstPaket" required autofocus>
                                                <option value="">- PILIH PAKET -</option>
                                                <?php
                                                foreach ($listPaket as $r) {
                                                    if ($detail->paket_id == $r->paket_id) {
                                                        $selected = 'selected';
                                                    } else {
                                                        $selected = '';
                                                    }
                                                ?>
                                                <option value="<?=$r->paket_id;?>" <?=$selected;?>><?=$r->paket_name;?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tahun Ajaran</label>
                                    <div class="col-md-5">
                                        <div class="input-icon right"><i class="fa"></i>
                                            <select class="form-control" name="lstTahun" required>
                                                <option value="">- PILIH TAHUN AJARAN -</option>
                                                <?php
                                                foreach ($listTahun as $r) {
                                                    if ($detail->year_id == $r->year_id) {
                                                        $selected = 'selected';
                                                    } else {
                                                        $selected = '';
                                                    }
                                                ?>
                                                <option value="<?=$r->year_id;?>" <?=$selected;?>><?=$r->year_name;?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Daycare</label>
                                    <div class="col-md-5">
                                        <div class="input-icon right"><i class="fa"></i>
                                            <select class="form-control" name="lstOffice" required>
                                                <option value="">- PILIH DAYCARE -</option>
                                                <?php
                                                foreach ($listOffice as $r) {
                                                    if ($detail->office_id == $r->office_id) {
                                                        $selected = 'selected';
                                                    } else {
                                                        $selected = '';
                                                    }
                                                ?>
                                                <option value="<?=$r->office_id;?>" <?=$selected;?>><?=$r->office_name;?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nama Anak</label>
                                    <div class="col-md-9">
                                        <div class="input-icon right">
                                            <i class="fa"></i>
                                            <input type="text" class="form-control" name="name" placeholder="Input Nama Siswa" value="<?=$detail->student_name;?>" autocomplete="off" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tempat Lahir</label>
                                    <div class="col-md-5">
                                        <div class="input-icon right">
                                            <i class="fa"></i>
                                            <input type="text" class="form-control" name="place" placeholder="Input Tempat Lahir" value="<?=$detail->student_birth;?>" autocomplete="off" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tanggal Lahir</label>
                                    <div class="col-md-5">
                                        <div class="input-icon right">
                                            <i class="fa"></i>
                                            <input type="text" class="form-control" name="date" id="date" placeholder="Input Tanggal Lahir" value="<?=date('d-m-Y', strtotime($detail->student_birth));?>" autocomplete="off" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Jenis Kelamin</label>
                                    <div class="col-md-5">
                                        <div class="input-icon right"><i class="fa"></i>
                                            <select class="form-control" name="lstJK" required>
                                                <option value="">- PILIH JENIS KELAMIN -</option>
                                                <option value="LAKI-LAKI" <?php if ($detail->student_gender=='LAKI-LAKI') { echo 'selected'; }; ?>>LAKI-LAKI</option>
                                                <option value="PEREMPUAN" <?php if ($detail->student_gender=='PEREMPUAN') { echo 'selected'; }; ?>>PEREMPUAN</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Agama</label>
                                    <div class="col-md-5">
                                        <div class="input-icon right"><i class="fa"></i>
                                            <select class="form-control" name="lstAgama" required>
                                                <option value="">- PILIH AGAMA -</option>
                                                <option value="ISLAM" <?php if ($detail->student_agama=='ISLAM') { echo 'selected'; }; ?>>ISLAM</option>
                                                <option value="KRISTEN" <?php if ($detail->student_agama=='KRISTEN') { echo 'selected'; }; ?>>KRISTEN</option>
                                                <option value="KATHOLIK" <?php if ($detail->student_agama=='KATHOLIK') { echo 'selected'; }; ?>>KATHOLIK</option>
                                                <option value="HINDU" <?php if ($detail->student_agama=='HINDU') { echo 'selected'; }; ?>>HINDU</option>
                                                <option value="BUDHA" <?php if ($detail->student_agama=='BUDHA') { echo 'selected'; }; ?>>BUDHA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Provinsi</label>
                                    <div class="col-md-5">
                                        <div class="input-icon right"><i class="fa"></i>
                                            <select class="form-control" name="lstProvinsi" id="lstProvinsi" onchange="tampilKabupaten()" required>
                                                <option value="">- PILIH PROVINSI -</option>
                                                <?php
                                                foreach ($listProvinsi as $r) {
                                                    if ($detail->provinsi_id == $r->provinsi_id) {
                                                        $selected = 'selected';
                                                    } else {
                                                        $selected = '';
                                                    }
                                                ?>
                                                <option value="<?=$r->provinsi_id;?>" <?=$selected;?>><?=$r->provinsi_nama;?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Kabupaten</label>
                                    <div class="col-md-5">
                                        <div class="input-icon right"><i class="fa"></i>
                                            <select class="form-control" name="lstKabupaten" id="lstKabupaten" onchange="tampilKecamatan()" required>
                                                <option value="">- PILIH KABUPATEN -</option>
                                                <?php
                                                foreach ($listKabupaten as $r) {
                                                    if ($detail->kabupaten_id == $r->kabupaten_id) {
                                                        $selected = 'selected';
                                                    } else {
                                                        $selected = '';
                                                    }
                                                ?>
                                                <option value="<?=$r->kabupaten_id;?>" <?=$selected;?>><?=$r->kabupaten_nama;?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Kecamatan</label>
                                    <div class="col-md-5">
                                        <div class="input-icon right"><i class="fa"></i>
                                            <select class="form-control" name="lstKecamatan" id="lstKecamatan" onchange="tampilDesa()" required>
                                                <option value="">- PILIH KECAMATAN -</option>
                                                <?php
                                                foreach ($listKecamatan as $r) {
                                                    if ($detail->kecamatan_id == $r->kecamatan_id) {
                                                        $selected = 'selected';
                                                    } else {
                                                        $selected = '';
                                                    }
                                                ?>
                                                <option value="<?=$r->kecamatan_id;?>" <?=$selected;?>><?=$r->kecamatan_nama;?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Desa</label>
                                    <div class="col-md-5">
                                        <div class="input-icon right"><i class="fa"></i>
                                            <select class="form-control" name="lstDesa" id="lstDesa" required>
                                                <option value="">- PILIH DESA -</option>
                                                <?php
                                                foreach ($listDesa as $r) {
                                                    if ($detail->desa_id == $r->desa_id) {
                                                        $selected = 'selected';
                                                    } else {
                                                        $selected = '';
                                                    }
                                                ?>
                                                <option value="<?=$r->desa_id;?>" <?=$selected;?>><?=$r->desa_nama;?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Alamat</label>
                                    <div class="col-md-9">
                                        <div class="input-icon right">
                                            <i class="fa"></i>
                                            <input type="text" class="form-control" name="address" placeholder="Input Alamat Siswa" value="<?=$detail->student_address;?>" autocomplete="off" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">No. Handphone</label>
                                    <div class="col-md-5">
                                        <div class="input-icon right">
                                            <i class="fa"></i>
                                            <input type="text" class="form-control" name="phone" placeholder="Input No. Handphone" value="<?=$detail->student_phone;?>" maxlength="12" autocomplete="off" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Email</label>
                                    <div class="col-md-5">
                                        <div class="input-icon right">
                                            <i class="fa"></i>
                                            <input type="text" class="form-control" name="email" placeholder="Input Email" value="<?=$detail->student_email;?>" autocomplete="off" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nama Orang Tua/Wali Murid</label>
                                    <div class="col-md-9">
                                        <div class="input-icon right">
                                            <i class="fa"></i>
                                            <input type="text" class="form-control" name="ortu" placeholder="Input Nama Orang Tua/Wali Murid" value="<?=$detail->student_parent;?>" autocomplete="off" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Foto</label>
                                    <div class="col-md-9">
                                        <?php
                                        if (empty($detail->student_image)) {
                                        ?>
                                        <img src="<?=base_url('img/no-image.png');?>" alt=""/>
                                        <?php } else {?>
                                        <img src="<?=base_url('img/student_folder/' . $detail->student_image);?>" width="20%"/>
                                        <?php }?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Ubah Foto</label>
                                    <div class="col-md-9">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="<?=base_url('img/no-image.png');?>" alt=""/>
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; max-height: 200px;"></div>
                                            <div>
                                                <span class="btn default btn-file">
                                                <span class="fileinput-new">
                                                Pilih Foto </span>
                                                <span class="fileinput-exists">
                                                Ubah </span>
                                                <input type="file" name="foto" accept=".png,.jpg,.jpeg,.gif">
                                                </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">
                                                Hapus </a>
                                            </div>
                                        </div>
                                        <div class="clearfix margin-top-10">
                                            <span class="label label-danger">INFO !</span> Resolution : 150 x 200 Pixel
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Update</button>
                                        <a href="<?=site_url('admin/student');?>" type="button" class="btn btn-warning"><i class="fa fa-times"></i> Batal</a>
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

<script type="text/javascript" src="<?=base_url();?>backend/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>backend/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script type="text/javascript" src="<?=base_url();?>backend/assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript">
function tampilKabupaten() {
    provinsi_id = document.getElementById("lstProvinsi").value;
    $.ajax({
        url:"<?=site_url('admin/student/select_kabupaten_change/');?>"+provinsi_id,
        success: function(response) {
            $("#lstKabupaten").html(response);
        },
        dataType:"html"
    });
    return false;
}

function tampilKecamatan() {
    kabupaten_id = document.getElementById("lstKabupaten").value;
    $.ajax({
        url:"<?=site_url('admin/student/select_kecamatan_change/');?>"+kabupaten_id,
        success: function(response) {
            $("#lstKecamatan").html(response);
        },
        dataType:"html"
    });
    return false;
}

function tampilDesa() {
    kecamatan_id = document.getElementById("lstKecamatan").value;
    $.ajax({
        url:"<?=site_url('admin/student/select_desa_change/');?>"+kecamatan_id,
        success: function(response) {
            $("#lstDesa").html(response);
        },
        dataType:"html"
    });
    return false;
}

$(document).ready(function() {
    $("#date").inputmask("d-m-y", {
        autoUnmask: true
    });

    var form        = $('#formInput');
    var error       = $('.alert-danger', form);
    var success     = $('.alert-success', form);

    $("#formInput").validate({
        errorElement: 'span',
        errorClass: 'help-block help-block-error',
        focusInvalid: false,
        ignore: "",
        rules: {
            lstPaket: { required: true },
            lstTahun: { required: true },
            lstOffice: { required: true },
            name: { required: true, minlength: 3 },
            place: { required: true, minlength: 3 },
            date: { required: true, minlength: 3 },
            lstJK: { required: true },
            lstAgama: { required: true },
            lstProvinsi: { required: true },
            lstKabupaten: { required: true },
            lstKecamatan: { required: true },
            lstDesa: { required: true },
            address: { required: true, minlength: 5 },
            phone: { required: true, number: true, minlength: 11 },
            email: { required: true, email: true, minlength: 10 },
            ortu: { required: true, minlength: 5 }
        },
        messages: {
            lstPaket: {
                required:'Silahkan Pilih Paket'
            },
            lstTahun: {
                required:'Silahkan Pilih Tahun Ajaran'
            },
            lstOffice: {
                required:'Silahkan Pilih Daycare'
            },
            name: {
                required:'Silahkan Masukkan Nama Anak', minlength: 'Minimal 3 Karakter'
            },
            place: {
                required:'Silahkan Masukkan Tempat Lahir Anak', minlength: 'Minimal 3 Karakter'
            },
            date: {
                required:'Silahkan Masukkan Tanggal Lahir Anak'
            },
            lstJK: {
                required:'Silahkan Pilih Jenis Kelamin'
            },
            lstAgama: {
                required:'Silahkan Pilih Agama'
            },
            lstProvinsi: {
                required:'Silahkan Pilih Provinsi'
            },
            lstKabupaten: {
                required:'Silahkan Pilih Kabupaten'
            },
            lstKecamatan: {
                required:'Silahkan Pilih Kecamatan'
            },
            lstDesa: {
                required:'Silahkan Pilih Desa'
            },
            address: {
                required:'Silahkan Masukkan Alamat Sekarang', minlength:'Minimal 5 Karakter'
            },
            phone: {
                required:'Silahkan Masukkan No. Handphone', minlength:'Minimal 12 Digit'
            },
            email: {
                required:'Silahkan Masukkan Email Anda', minlength:'Minimal 10 Karakter', email:'Email Tidak Valid'
            },
            ortu: {
                required:'Silahkan Masukkan Nama Orang Tua/Wali Murid', minlength:'Minimal 5 Karakter'
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
            var formData = new FormData($('#formInput')[0]);
            $.ajax({
                url: '<?=site_url('admin/student/updatedata');?>',
                type: "POST",
                dataType: 'json',
                data: formData,
                async: true,
                success: function(data) {
                    if (data.status === 'success') {
                        swal({
                            title:"Sukses",
                            text: "Update Data Sukses",
                            showConfirmButton: false,
                            type: "success",
                            timer: 2000
                        }, function() {
                            window.location="<?=site_url('admin/student');?>";
                        });
                    } else {
                        swal({
                            title:"Gagal",
                            text: "Gagal ! Type File harus (JPG/PNG/JPEG)",
                            timer: 2000,
                            showConfirmButton: false,
                            type: "error"
                        });
                    }
                },
                error: function (response) {
                    swal({
                        title:"Error",
                        text: "Simpan Data Gagal",
                        showConfirmButton: false,
                        type: "error",
                        timer: 2000
                    });
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
    });
});
</script>