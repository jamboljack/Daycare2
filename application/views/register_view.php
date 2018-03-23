<style type="text/css">
    .error {
        color: #FF0000;
    }

    .contactform .list-select {
        font-family: 'Bubblegum Sans', cursive;
        font-weight: normal;
        width: 100%;
        padding: 14.5px 18px;
        font-size: 16px;
        color: #a9a7a7;
        background: #FFFFFF;
        border: 1px solid #eaeaea;
        outline: none;
        -webkit-border-radius: 2px;
    }
</style>

<div id="main">
    <div class="breadcrumb-section">
        <div class="container">
            <h1>Pendaftaran Siswa</h1>
            <div class="breadcrumb">
                <a href="<?=base_url();?>">Beranda</a>
                <span class="fa fa-angle-double-right"></span>
                <span class="current">Pendaftaran Siswa</span>
            </div>
        </div>
    </div>
    <div class="container">
        <section id="primary" class="content-full-width">
            <div class="column dt-sc-one-fourth first">
                <p></p>
            </div>
            <div class="column dt-sc-one-half">
                <div class="dt-sc-titled-box blue">
                    <h4 class="dt-sc-titled-box-title"> Form Pendaftaran Siswa </h4>
                    <div class="dt-sc-titled-box-content">
                        <p>Silahkan Isi Biodata Anak Anda dibawah ini :</p>
                        <form class="contactform" id="contact_form" method="post">
                            <p class="column dt-sc-one-half first">
                                <select class="list-select" name="lstPaket" id="lstPaket" required autofocus>
                                    <option value="">- PILIH PAKET -</option>
                                    <?php
                                    foreach ($listPaket as $r) {
                                    ?>
                                    <option value="<?=$r->paket_id;?>"><?=$r->paket_name;?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </p>
                            <p class="column dt-sc-one-half">
                                <input type="hidden" name="year_id" value="<?=$tahun->year_id;?>">
                                <input type="text" name="year" value="Tahun : <?=$tahun->year_name;?>" disabled>
                            </p>
                            <p>
                                <select class="list-select" name="lstOffice" id="lstOffice" required>
                                    <option value="">- PILIH DAYCARE -</option>
                                    <?php
                                    foreach ($listOffice as $r) {
                                    ?>
                                    <option value="<?=$r->office_id;?>"><?=$r->office_name;?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </p>
                            <p>
                                <input type="text" name="name" id="name" placeholder="Nama Anak" autocomplete="off" required>
                            </p>
                            <p class="column dt-sc-one-half first">
                                <input type="text" name="place" id="place" placeholder="Tempat Lahir" autocomplete="off" required>
                            </p>
                            <p class="column dt-sc-one-half">
                                <input type="text" name="date" id="date" placeholder="Tanggal Lahir (dd-mm-yyyy)" required>
                            </p>
                            <p class="column dt-sc-one-half first">
                                <select class="list-select" name="lstJK" id="lstJK" required>
                                    <option value="">- PILIH JENIS KELAMIN -</option>
                                    <option value="LAKI-LAKI">LAKI-LAKI</option>
                                    <option value="PEREMPUAN">PEREMPUAN</option>
                                </select>
                            </p>
                            <p class="column dt-sc-one-half">
                                <select class="list-select" name="lstAgama" id="lstAgama" required>
                                    <option value="">- PILIH AGAMA -</option>
                                    <option value="ISLAM">ISLAM</option>
                                    <option value="KRISTEN">KRISTEN</option>
                                    <option value="KATHOLIK">KATHOLIK</option>
                                    <option value="HINDU">HINDU</option>
                                    <option value="BUDHA">BUDHA</option>
                                </select>
                            </p>
                            <p>
                                <select class="list-select" name="lstProvinsi" id="lstProvinsi" onchange="tampilKabupaten()" required>
                                    <option value="">- PILIH PROVINSI -</option>
                                    <?php
                                    foreach ($listProvince as $r) {
                                    ?>
                                    <option value="<?=$r->provinsi_id;?>"><?=$r->provinsi_nama;?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </p>
                            <p id="PgKabupaten">
                                <?php
                                $style_kabupaten = 'class="list-select" id="lstKabupaten" required onchange="tampilKecamatan()"';
                                echo form_dropdown("lstKabupaten", array('' => '- PILIH KABUPATEN -'), '', $style_kabupaten);
                                ?>
                            </p>
                            <p id="PgKecamatan">
                                <?php
                                $style_kecamatan = 'class="list-select" id="lstKecamatan" required onchange="tampilDesa()"';
                                echo form_dropdown("lstKecamatan", array('' => '- PILIH KECAMATAN -'), '', $style_kecamatan);
                                ?>
                            </p>
                            <p id="PgDesa">
                                <?php
                                $style_desa = 'class="list-select" id="lstDesa" required';
                                echo form_dropdown("lstDesa", array('' => '- PILIH DESA -'), '', $style_desa);
                                ?>
                            </p>
                            <p id="PgAlamat">
                                <input type="text" name="address" id="address" placeholder="Alamat Lengkap" autocomplete="off" required>
                            </p>
                            <p class="column dt-sc-one-half first">
                                <input type="text" name="phone" id="phone" maxlength="12" placeholder="No. Handphone" autocomplete="off" required>
                            </p>
                            <p class="column dt-sc-one-half">
                                <input type="text" name="email" id="email" placeholder="Email" autocomplete="off" required>
                            </p>
                            <p>
                                <input type="text" name="ortu" id="ortu" placeholder="Nama Orang Tua/Wali Murid" autocomplete="off" required>
                            </p>
                            <?=$this->recaptcha->render();?>
                            <p>
                                <input name="submit" type="submit" id="submit" class="dt-sc-button medium" value="Daftar">
                            </p>
                        </form>
                    </div>
                </div>
            </div>
            <div class="column dt-sc-one-fourth">
                <p></p>
            </div>
        </section>
    </div>
</div>

<script type="text/javascript" src="<?=base_url();?>backend/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>front/js/jquery.validate.min.js"></script>
<script type="text/javascript">
var lsjQuery = jQuery;
function tampilKabupaten() {
    provinsi_id = document.getElementById("lstProvinsi").value;
    lsjQuery.ajax({
        url:"<?=site_url('register/select_kabupaten_change/');?>"+provinsi_id,
        success: function(response) {
            lsjQuery("#PgKabupaten").show();
            lsjQuery("#lstKabupaten").html(response);
        },
        dataType:"html"
    });
    return false;
}

function tampilKecamatan() {
    kabupaten_id = document.getElementById("lstKabupaten").value;
    lsjQuery.ajax({
        url:"<?=site_url('register/select_kecamatan_change/');?>"+kabupaten_id,
        success: function(response) {
            lsjQuery("#PgKecamatan").show();
            lsjQuery("#lstKecamatan").html(response);
        },
        dataType:"html"
    });
    return false;
}

function tampilDesa() {
    kecamatan_id = document.getElementById("lstKecamatan").value;
    lsjQuery.ajax({
        url:"<?=site_url('register/select_desa_change/');?>"+kecamatan_id,
        success: function(response) {
            lsjQuery("#PgDesa").show();
            lsjQuery("#PgAlamat").show();
            lsjQuery("#lstDesa").html(response);
        },
        dataType:"html"
    });
    return false;
}

lsjQuery(document).ready(function() {
    lsjQuery("#PgKabupaten").hide();
    lsjQuery("#PgKecamatan").hide();
    lsjQuery("#PgDesa").hide();
    lsjQuery("#PgAlamat").hide();
    lsjQuery("#date").inputmask("d-m-y", {
        autoUnmask: true
    });

    lsjQuery("#contact_form").validate({
        rules: {
            lstPaket: { required: true },
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
                required:'Silahkan Masukkan No. Handphone', number:'Harus Angka', minlength:'Minimal 11 Digit'
            },
            email: {
                required:'Silahkan Masukkan Email Anda', minlength:'Minimal 10 Karakter', email:'Email Tidak Valid'
            },
            ortu: {
                required:'Silahkan Masukkan Nama Orang Tua/Wali Murid', minlength:'Minimal 5 Karakter'
            }
        },
        submitHandler: function(form) {
            dataString = lsjQuery("#contact_form").serialize();
            lsjQuery.ajax({
                url: "<?=site_url('register/savedata');?>",
                type: "POST",
                dataType: 'json',
                data: dataString,
                success: function(data) {
                    if (data.status === 'success') {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                },
                error: function() {
                    alert("Error, Proses ke Server.");
                }
            });
        }
    });
});
</script>