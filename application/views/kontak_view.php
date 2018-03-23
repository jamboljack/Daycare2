<style type="text/css">
    .error {
        color: #FF0000;
    }
</style>

<?=$map['js'];?>
<div id="main">
    <div class="breadcrumb-section">
        <div class="container">
            <h1>Kontak Kami</h1>
            <div class="breadcrumb">
                <a href="<?=base_url();?>">Beranda</a>
                <span class="fa fa-angle-double-right"></span>
                <span class="current">Kontak Kami</span>
            </div>
        </div>
    </div>
    <div class="container">
        <section id="primary" class="content-full-width">
            <?=$map['html'];?>
            <div class="dt-sc-hr"></div>
            <h2 class="dt-sc-hr-green-title">Kantor Kami</h2>
            <table>
                <?php foreach ($listBranch as $r) { ?>
                <thead>
                    <tr>
                        <th colspan="5"><?=$r->branch_name;?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $branch_id  = $r->branch_id;
                    $listOffice = $this->kontak_m->select_list($branch_id)->result();
                    foreach ($listOffice as $o) {
                    ?>
                    <tr>
                        <td align="left"><b><?=ucwords(strtolower($o->office_name));?></b></td>
                        <td align="left"><?=$o->office_address;?></td>
                        <td><?=$o->office_phone;?></td>
                        <td><?=$o->office_mobile;?></td>
                        <td><a href="mailto:<?=$o->office_email;?>"><?=$o->office_email;?></a></td>
                    </tr>
                    <?php } ?>
                </tbody>
                <?php } ?>
            </table> 
            <div class="dt-sc-hr"></div>
            <div class="column dt-sc-three-fourth first contact_form_outer">
                <form class="contact-form" id="contact_form" method="post">
                    <h2>Kirim Pertanyaan, Kritik dan Saran</h2>
                    <p class="column dt-sc-one-half first">
                         <input type="text" name="name" id="name" placeholder="Nama Anda" autocomplete="off" required autofocus>
                    </p>
                    <p class="column dt-sc-one-half">
                        <input type="email" name="email" id="email" placeholder="Email Anda" autocomplete="off" required>
                    </p>
                    <p class="column dt-sc-one-half first">
                        <input type="text" name="subject" id="subject" placeholder="Judul Anda" autocomplete="off" required>
                    </p>
                    <p class="column dt-sc-one-half">
                        <input type="text" name="phone" id="phone" placeholder="No. Handphone Anda" autocomplete="off" required>
                    </p>
                    <p>
                        <textarea name="message" id="message" placeholder="Tuliskan Pesan Anda" required></textarea>
                    </p>
                    <?=$this->recaptcha->render();?>
                    <br>
                    <p>
                        <input name="submit" type="submit" id="submit" class="dt-sc-button medium" value="Kirim">
                    </p>
                </form>
            </div>
            <div class="column dt-sc-one-fourth class_hours">
                <h2>Jam Pelayanan</h2>
                <ul class="class_hours">
                    <li>Senin<span>07.00-18.00 WIB</span></li>
                    <li>Selasa<span>07.00-18.00 WIB</span></li>
                    <li>Rabu<span>07.00-18.00 WIB</span></li>
                    <li>Kamis<span>07.00-18.00 WIB</span></li>
                    <li>Jum'at<span>07.00-18.00 WIB</span></li>
                    <li>Sabtu<span>07.00-13.00 WIB</span></li>
                    <li>Minggu<span>LIBUR</span></li>
                </ul>
            </div>
        </section>
    </div>
</div>

<script type="text/javascript" src="<?=base_url();?>front/js/jquery.validate.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
    $("#contact_form").validate({
        rules: { 
            name: {
                required: true, minlength: 3
            },
            email: { 
                required: true, minlength: 5, email: true
            },
            subject: { 
                required: true, minlength: 5
            },
            phone: { 
                required: true, number:true, minlength: 11
            },
            message: { 
                required: true, minlength: 5
            }
        },
        messages: {
            name: {
                required:'Silahkan Masukkan Nama Anda', minlength:'Minimal 3 Karakter'
            },
            email: { 
                required:'Silahkan Masukkan Email Anda', minlength:'Minimal 5 Karakter', email:'Email Anda Tidak Valid'
            },
            subject: { 
                required:'Silahkan Masukkan Judul Anda', minlength:'Minimal 5 Karakter'
            },
            phone: { 
                required:'Silahkan Masukkan No. Handphone Anda', number:'Harus Angka', minlength:'Minimal 11 Digit'
            },
            message: { 
                required:'Silahkan Masukkan Pesan Anda', minlength:'Minimal 5 Karakter'
            }
        },
        submitHandler: function(form) {
            dataString = $("#contact_form").serialize();
            $.ajax({
                url: "<?=site_url('kontak/send_data');?>",
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