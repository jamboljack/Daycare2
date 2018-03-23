<link rel="stylesheet" type="text/css" href="<?=base_url();?>backend/js/sweetalert2.css">
<script src="<?=base_url();?>backend/js/sweetalert2.min.js"></script>

<script>
    function hapusData(student_id) {
        var id = student_id;
        swal({
            title: 'Anda Yakin ?',
            text: 'Data ini akan di Hapus !',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Tidak',
            closeOnConfirm: true
        }, function(isConfirm) {
            if (!isConfirm) return;
            $.ajax({
                url : "<?=site_url('admin/student/deletedata')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    swal({
                        title:"Sukses",
                        text: "Hapus Data Sukses",
                        showConfirmButton: false,
                        type: "success",
                        timer: 2000
                    });
                    reload_table();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error Hapus Data');
                }
            });
        });
    }
</script>

<div class="modal" id="filterData" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" id="form-filter" class="form-horizontal">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Filter Data</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Paket</label>
                    <div class="col-md-9">
                        <select class="form-control" name="lstPaket" id="lstPaket">
                            <option value="">SEMUA</option>
                            <?php
                            foreach ($listPaket as $r) {
                            ?>
                            <option value="<?=$r->paket_id;?>"><?=$r->paket_name;?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Daycare</label>
                    <div class="col-md-9">
                        <select class="form-control" name="lstOffice" id="lstOffice">
                            <option value="">SEMUA</option>
                            <?php
                            foreach ($listOffice as $r) {
                            ?>
                            <option value="<?=$r->office_id;?>"><?=$r->office_name;?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Tahun Ajaran</label>
                    <div class="col-md-9">
                        <select class="form-control" name="lstTahun" id="lstTahun">
                            <option value="">SEMUA</option>
                            <?php
                            foreach ($listTahun as $r) {
                            ?>
                            <option value="<?=$r->year_id;?>"><?=$r->year_name;?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" id="btn-filter"><i class="fa fa-search"></i> Filter</button>
                <button type="button" class="btn btn-default" id="btn-reset"><i class="fa fa-refresh"></i> Reset</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="page-content-wrapper">
    <div class="page-content">
        <h3 class="page-title">Siswa</h3>
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
                    <a href="#">Siswa</a>
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
                            <i class="fa fa-list"></i> Daftar Siswa
                        </div>
                    </div>
                    <div class="portlet-body">
                        <a data-toggle="modal" data-target="#filterData">
                            <button type="button" class="btn btn-warning"><i class="fa fa-search"></i> Filter Data</button>
                        </a>
                        <br><br>
                        <table class="table table-striped table-hover" id="tableData">
                            <thead>
                                <tr>
                                    <th width="8%"></th>
                                    <th width="5%">No</th>
                                    <th width="10%">Tgl. Daftar</th>
                                    <th>Nama Anak</th>
                                    <th width="10%">JK</th>
                                    <th width="15%">Paket</th>
                                    <th width="25%">Daycare</th>
                                    <th width="5%">Tahun</th>
                                </tr>
                            </thead>

                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
    </div>
</div>

<script type="text/javascript" src="<?=base_url();?>backend/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>backend/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>

<script type="text/javascript">
function reload_table() {
    table.ajax.reload(null,false);
}

var table;
$(document).ready(function() {
    table = $('#tableData').DataTable({
        "pageLength" : 10,
        "responsive": true,
        "processing": false,
        "serverSide": true,
        "order": [2, 'desc'],
        "ajax": {
            "url": "<?=site_url('admin/student/data_list');?>",
            "type": "POST",
            "data": function(data) {
                data.lstPaket  = $('#lstPaket').val();
                data.lstOffice = $('#lstOffice').val();
                data.lstTahun  = $('#lstTahun').val();
            }
        },
        "columnDefs": [
        {
            "targets": [ 0, 1],
            "orderable": false,
        },
        ],
    });

    $('#btn-filter').click(function() {
        reload_table();
        $('#filterData').modal('hide');
    });

    $('#btn-reset').click(function() {
        $('#form-filter')[0].reset();
        reload_table();
        $('#filterData').modal('hide');
    });
});
</script>