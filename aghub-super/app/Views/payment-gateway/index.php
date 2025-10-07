<section class="card border-light">
    <h4 class="card-header p-3 bg-white fs-4">Payment Provider - <?=$secTitle;?> (<?=$currencycode;?>)</h4>
    <div class="card-body">
        <div class="px-3">
            <button type="button" class="btn btn-primary bg-gradient" data-bs-toggle="modal" data-bs-target="#modal-addbank"><i class="las la-plus-circle me-1"></i>Add Payment Gateway</button>
        </div>

        <article class="card-text p-3">
            <table id="bankTable" class="w-100 nowrap table table-sm table-bordered">
                <thead>
                <tr>
                <th>#ID</th>
                <th>Status</th>
                <th>Bank</th>
                <th>Method</th>
                <th>Currency</th>
                <th>Is Mobile</th>
                <th>Actions</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </article>
    </div>
</section>

<section class="modal fade modal-addbank" id="modal-addbank" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-addbank" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Bank</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate'], ['currencycode'=>$currencycode]);?>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                        <label>English</label>
                        <input type="text" class="form-control" name="en" required>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                        <label>Bahasa</label>
                        <input type="text" class="form-control" name="my" required>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                        <label>简体中文</label>
                        <input type="text" class="form-control" name="cn" required>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                        <label>繁體中文</label>
                        <input type="text" class="form-control" name="zh" required>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                        <label>ภาษาไทย</label>
                        <input type="text" class="form-control" name="th" required>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                        <label>Tiếng Việt</label>
                        <input type="text" class="form-control" name="vn" required>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                        <label>বাংলা</label>
                        <input type="text" class="form-control" name="bgl" required>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                        <label>Indonesia</label>
                        <input type="text" class="form-control" name="in" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Currency</label>
                    <div id="currencyOptions2"></div>
                </div>
                <div class="mb-3">
                    <label class="d-block">Display on Mobile</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="isMobile" id="ism_yes2" value="1">
                        <label class="form-check-label" for="ism_yes2">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="isMobile" id="ism_no2" value="2">
                        <label class="form-check-label" for="ism_no2">No</label>
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

<section class="modal fade modal-modify" id="modal-modify" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-modify" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Bank</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate'],['bid'=>'', 'currencycode'=>'']);?>
                <div class="mb-3">
                    <label class="d-block">Status</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="bankStatus_yes" value="1">
                        <label class="form-check-label" for="bankStatus_yes">Active</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="bankStatus_no" value="2">
                        <label class="form-check-label" for="bankStatus_no">Inactive</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                        <label>English</label>
                        <input type="text" class="form-control" name="en" required>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                        <label>Bahasa</label>
                        <input type="text" class="form-control" name="my" required>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                        <label>简体中文</label>
                        <input type="text" class="form-control" name="cn" required>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                        <label>繁體中文</label>
                        <input type="text" class="form-control" name="zh" required>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                        <label>ภาษาไทย</label>
                        <input type="text" class="form-control" name="th" required>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                        <label>Tiếng Việt</label>
                        <input type="text" class="form-control" name="vn" required>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                        <label>বাংলা</label>
                        <input type="text" class="form-control" name="bgl" required>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                        <label>Indonesia</label>
                        <input type="text" class="form-control" name="in" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Currency</label>
                    <div id="currencyOptions"></div>
                </div>
                <div class="mb-3">
                    <label class="d-block">Display on Mobile</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="isMobile" id="ism_yes" value="1">
                        <label class="form-check-label" for="ism_yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="isMobile" id="ism_no" value="2">
                        <label class="form-check-label" for="ism_no">No</label>
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

    const bankTable = $('#bankTable').DataTable({
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
            url: '/list/payment-gateway',
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

    $('.modal-addbank form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            const currency = [];
            $.each($('.modal-addbank [name=currency]:checked'), function() {
                currency.push($(this).val());
            });

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['currency'] = currency;
            });

            $.post('/payment-gateway/add', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { bankTable.ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-addbank').modal('toggle');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    const addbankEvent = document.getElementById('modal-addbank');
    addbankEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
        document.getElementById("currencyOptions2").innerHTML = '';
    });
    addbankEvent.addEventListener('shown.bs.modal', function (event) {
        currencies('currencyOptions2');
    });

    $('.modal-modify form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            const currency = [];
            $.each($('.modal-modify [name=currency]:checked'), function() {
                currency.push($(this).val());
            });

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['currency'] = currency;
            });

            $.post('/payment-gateway/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { bankTable.ajax.reload(null,false); });
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
        document.getElementById("currencyOptions").innerHTML = '';
    });
});

function getBank(bid, currencycode)
{
    $('.modal-modify').modal('toggle');
    currencies('currencyOptions');

    swal.fire({
        title: 'Preparing Information...',
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
        customClass: {
            container: 'bg-major'
        }
    });

    var params = {};
    params['bid'] = bid;
    params['currencycode'] = currencycode;

    $.post('/bank/get', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            const cu = obj.data.currencyCode;
            cu.forEach( (item, index)=>{
                $('.modal-modify [name=currency]#'+item).prop('checked',true);
            });
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }

        $('.modal-modify [name=bid]').val(bid);
        $('.modal-modify [name=currencycode]').val(currencycode);
        $('.modal-modify [name=en]').val(obj.data.name.EN);
        $('.modal-modify [name=my]').val(obj.data.name.MY);
        $('.modal-modify [name=cn]').val(obj.data.name.CN);
        $('.modal-modify [name=zh]').val(obj.data.name.ZH);
        $('.modal-modify [name=th]').val(obj.data.name.TH);
        $('.modal-modify [name=vn]').val(obj.data.name.VN);
        $('.modal-modify [name=bgl]').val(obj.data.name.BGL);
        $('.modal-modify [name=in]').val(obj.data.name.IN);

        obj.data.status==1 ? $('.modal-modify [name=status]#bankStatus_yes').prop('checked',true) : $('.modal-modify [name=status]#bankStatus_no').prop('checked',true);

        obj.data.isMobile==1 ? $('.modal-modify [name=isMobile]#ism_yes').prop('checked',true) : $('.modal-modify [name=isMobile]#ism_no').prop('checked',true);
    })
    .done(function() {
        swal.close();
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function currencies(element)
{
    var params = {};
    params['currencycode'] = '<?=$currencycode;?>';

    $.post('/currencies', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            const cu = obj.data;
            cu.forEach(function(item, index) {
                var node = document.createElement("div");
                var nodeInput = document.createElement("input");
                var nodeLabel = document.createElement("label");
                var nodeLabelText = document.createTextNode(item.name + ' (' + item.code + ')');
                node.classList.add('form-check');
                nodeInput.setAttribute("type", 'checkbox');
                nodeInput.setAttribute("name", 'currency');
                nodeInput.setAttribute("id", item.code);
                nodeInput.setAttribute("value", item.code);
                nodeInput.classList.add('form-check-input');
                nodeLabel.setAttribute("for", item.code);
                nodeLabel.classList.add('form-check-label');
                nodeLabel.appendChild(nodeLabelText);
                node.appendChild(nodeInput);
                node.appendChild(nodeLabel);
                document.getElementById(element).appendChild(node);
            });
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