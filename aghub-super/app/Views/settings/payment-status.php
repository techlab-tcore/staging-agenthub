<section class="card border-light">
    <h4 class="card-header p-3 bg-white fs-4">Setting - <?=$secTitle;?> (<?=$currencycode;?>)</h4>
    <div class="card-body">
        <article class="card-text p-3">
            <table id="paystatusTable" class="w-100 nowrap table table-sm table-bordered">
                <thead>
                <tr>
                <th>Code</th>
                <th>Payment Status</th>
                <th>EN</th>
                <th>MY</th>
                <th>CN</th>
                <th class="none">ZH</th>
                <th class="none">TH</th>
                <th class="none">VN</th>
                <th class="none">BGL</th>
                <th class="none">IN</th>
                <th>Actions</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </article>
    </div>
</section>

<section class="modal fade modal-modify" id="modal-modify" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-modify" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Payment Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate'], ['currencycode'=>'']);?>
                <div class="mb-3">
                    <label class="d-block">Code</label>
                    <input type="text" class="form-control" name="code" readonly required>
                </div>
                <div class="mb-3">
                    <label class="d-block">Payment Status</label>
                    <input type="text" class="form-control" name="name" readonly required>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12 mb-3">
                        <label>English</label>
                        <input type="text" class="form-control" name="en" required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 mb-3">
                        <label>Bahasa</label>
                        <input type="text" class="form-control" name="my" required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 mb-3">
                        <label>简体中文</label>
                        <input type="text" class="form-control" name="cn" required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 mb-3">
                        <label>繁体中文</label>
                        <input type="text" class="form-control" name="zh" required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 mb-3">
                        <label>ภาษาไทย</label>
                        <input type="text" class="form-control" name="th" required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 mb-3">
                        <label>Tiếng Việt</label>
                        <input type="text" class="form-control" name="vn" required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 mb-3">
                        <label>বাংলা</label>
                        <input type="text" class="form-control" name="bgl" required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 mb-3">
                        <label>Indonesia</label>
                        <input type="text" class="form-control" name="in" required>
                    </div>
                </div>
                <div class="text-end">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary bg-gradient">Submit</button>
                </div>
                <?=form_close();?>
            </div>
        </div>
    </div>
</section>

<link rel="stylesheet" href="<?=base_url('assets/vendors/datatable/datatables.min.css');?>">
<script src="<?=base_url('assets/vendors/datatable/datatables.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/table_lang.js');?>"></script>
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', (event) => {
    if( '<?=$_SESSION['lang']?>' == 'my' ) {
        langs = malay;
    } else if( '<?=$_SESSION['lang']?>' == 'cn' ) {
        langs = chinese;
    } else if( '<?=$_SESSION['lang']?>' == 'zh' ) {
        langs = tradchinese;
    } else if( '<?=$_SESSION['lang']?>' == 'th' ) {
        langs = thai;
    } else if( '<?=$_SESSION['lang']?>' == 'vn' ) {
        langs = viet;
    } else {
        langs = english;
    }

    const paystatusTable = $('#paystatusTable').DataTable({
        dom: "<'row mb-3'<'col-lg-6 col-md-6 col-12'l><'col-lg-6 col-md-6 col-12'f>>" + "<'row'<'col-12 overflow-auto'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
        responsive: {
            details: {
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table table-bordered'
                })
            }
        },
        language: langs,
        ordering: true,
        paging: true,
        deferRender: true,
        processing: true,
        destroy: true,
        ajax: {
            type : "POST",
            url: '/list/payment-status',
            data: {"currencycode": '<?=$currencycode;?>'},
            //contentType:"application/json; charset=utf-8",
            dataSrc: function(json) {
                if(json == "no data") {
                    return [];
                } else {
                    return json.data;
                }
            }
        },
    });

    $('.modal-modify form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/settings/payment-status/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { paystatusTable.ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-modify').modal('toggle');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    const modifyEvent = document.getElementById('modal-modify');
    modifyEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });
});

function editPaystatus(code, currencycode)
{
    $('.modal-modify').modal('toggle');
    
    var params = {};
    params['code'] = code;
    params['currencycode'] = currencycode;

    $.post('/payment-status/get', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            $('.modal-modify [name=currencycode]').val(currencycode);
            $('.modal-modify [name=code]').val(obj.data.code);
            $('.modal-modify [name=name]').val(obj.data.name);
            $('.modal-modify [name=en]').val(obj.data.value.EN);
            $('.modal-modify [name=my]').val(obj.data.value.MY);
            $('.modal-modify [name=cn]').val(obj.data.value.CN);
            $('.modal-modify [name=zh]').val(obj.data.value.ZH);
            $('.modal-modify [name=th]').val(obj.data.value.TH);
            $('.modal-modify [name=vn]').val(obj.data.value.VN);
            $('.modal-modify [name=bgl]').val(obj.data.value.BGL);
            $('.modal-modify [name=in]').val(obj.data.value.IN);
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}
</script>