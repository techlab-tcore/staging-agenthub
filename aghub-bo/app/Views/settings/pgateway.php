<section class="card border-light shadow">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <div class="px-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-addpg"><i class="las la-plus-circle me-1"></i><?=lang('Nav.addpg');?></button>
        </div>

        <article class="card-text p-3">
            <table id="pgTable" class="w-100 nowrap table table-sm table-bordered">
                <thead class="table-style">
                <tr>
                <th><?=lang('Input.status');?></th>
                <th><?=lang('Input.merchantcode');?></th>
                <th><?=lang('Input.brand');?></th>
                <th><?=lang('Input.order');?></th>
                <th><?=lang('Input.domain');?></th>
                <th><?=lang('Input.apikey');?></th>
                <th class="none"><?=lang('Input.payurl');?></th>
                <th class="none"><?=lang('Input.callbackurl');?></th>
                <th class="none"><?=lang('Input.successurl');?></th>
                <th class="none"><?=lang('Input.failurl');?></th>
                <th class="none"><?=lang('Input.remark');?></th>
                <th><?=lang('Label.action');?></th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </article>
    </div>
</section>

<section class="modal fade modal-addpg" id="modal-addpg" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-addpg" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.addpg');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate']);?>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-3">
                        <div class="mb-3">
                            <label><?=lang('Input.brand');?></label>
                            <select class="form-select" id="pplist2" name="provider" required>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.merchantcode');?></label>
                            <input type="text" class="form-control" name="merchant" required>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.domain');?></label>
                            <input type="text" class="form-control" name="domain" required>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.apikey');?></label>
                            <input type="text" class="form-control" name="apikey" required>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.order');?></label>
                            <input type="number" class="form-control" min="0" value="0" name="ordering" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-3">
                        <div class="mb-3">
                            <label><?=lang('Input.payurl');?></label>
                            <input type="text" class="form-control" name="payurl" required>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.callbackurl');?></label>
                            <input type="text" class="form-control" name="callbackurl" required>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.successurl');?></label>
                            <input type="text" class="form-control" name="successurl" required>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.failurl');?></label>
                            <input type="text" class="form-control" name="failurl" required>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.remark');?></label>
                            <textarea class="form-control" name="remark"></textarea>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal"><?=lang('Nav.close');?></button>
                    <button type="submit" class="btn btn-primary"><?=lang('Nav.submit');?></button>
                </div>
                <?=form_close();?>
            </div>
        </div>
    </div>
</section>

<section class="modal fade modal-modifyPG" id="modal-modifyPG" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-modifyPG" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.editpg');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate'],['provider'=>'']);?>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-3">
                        <div class="mb-3">
                            <label><?=lang('Input.brand');?></label>
                            <!-- <select class="form-select" id="pplist" name="provider" required> -->
                            <!-- </select> -->
                            <input type="text" class="form-control" name="providername" readOnly>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.merchantcode');?></label>
                            <input type="text" class="form-control" name="merchant" required>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.domain');?></label>
                            <input type="text" class="form-control" name="domain" required>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.apikey');?></label>
                            <input type="text" class="form-control" name="apikey" required>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label class="d-block"><?=lang('Input.status');?></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="active_status" value="1" checked>
                                    <label class="form-check-label" for="active_status"><?=lang('Label.active');?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inactive_status" value="2">
                                    <label class="form-check-label" for="inactive_status"><?=lang('Label.inactive');?></label>
                                </div>
                            </div>
                            <div class="col-6">
                                <label><?=lang('Input.order');?></label>
                                <input type="number" class="form-control" min="0" name="ordering" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-3">
                        <div class="mb-3">
                            <label><?=lang('Input.payurl');?></label>
                            <input type="text" class="form-control" name="payurl" required>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.callbackurl');?></label>
                            <input type="text" class="form-control" name="callbackurl" required>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.successurl');?></label>
                            <input type="text" class="form-control" name="successurl" required>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.failurl');?></label>
                            <input type="text" class="form-control" name="failurl" required>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.remark');?></label>
                            <textarea class="form-control" name="remark"></textarea>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal"><?=lang('Nav.close');?></button>
                    <button type="submit" class="btn btn-primary"><?=lang('Nav.submit');?></button>
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

    const pgTable = $('#pgTable').DataTable({
        dom: "<'row mb-3'<'col-xl-6 col-lg-6 col-md-6 col-12'l><'col-xl-6 col-lg-6 col-md-6 col-12'f>>" + "<'row'<'col-12 overflow-auto'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
        ajax: {
            type : "GET",
            contentType: "application/json; charset=utf-8",
            url: "/list/payment-gateway/company/all",
            dataSrc: function(json) {
                if(json == "no data") {
                    return [];
                } else {
                    return json.data;
                }
            }
        },
        responsive: {
            details: {
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'w-100 nowrap table table-bordered'
                })
            }
        },
        language: langs,
        processing: true,
        stateSave: true,
        deferRender: true,
        destroy: true
    });

    const addpgEvent = document.getElementById('modal-addpg');
    addpgEvent.addEventListener('shown.bs.modal', function (event) {
        getPaymentProviderList('pplist2');
    });
    addpgEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
        document.getElementById("pplist2").innerHTML = '';
    });

    $('.modal-addpg form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/payment-gateway/add', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { pgTable.ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-addpg').modal('toggle');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    $('.modal-modifyPG form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/payment-gateway/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { pgTable.ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-modifyPG').modal('toggle');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    const modifyPGEvent = document.getElementById('modal-modifyPG');
    modifyPGEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
        document.getElementById("pplist").innerHTML = '';
    });
});

function modifyPG(provider,merchant)
{
    $('.modal-modifyPG').modal('toggle');
    // getPaymentProviderList2();

    generalLoading();

    var params = {};
    params['provider'] = provider;
    params['merchant'] = merchant;

    $.post('/payment-gateway/get', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            $('.modal-modifyPG [name=merchant]').val(obj.data.merchantCode);
            $('.modal-modifyPG [name=domain]').val(obj.data.tiedDomain);
            $('.modal-modifyPG [name=apikey]').val(obj.data.apiKey);
            $('.modal-modifyPG [name=payurl]').val(obj.data.payUrl);
            $('.modal-modifyPG [name=callbackurl]').val(obj.data.callBackUrl);
            $('.modal-modifyPG [name=successurl]').val(obj.data.successUrl);
            $('.modal-modifyPG [name=failurl]').val(obj.data.failureUrl);
            $('.modal-modifyPG [name=remark]').val(obj.data.remark);

            obj.data.status==1 ? $('.modal-modifyPG [name=status]#active_status').prop('checked',true) : $('.modal-modifyPG [name=status]#inactive_status').prop('checked',true);

            // $('.modal-modifyPG [name=provider] option[value=' + btoa(obj.data.bankId) + ']').attr('selected','selected');
            $('.modal-modifyPG [name=ordering]').val(obj.data.order);
            $('.modal-modifyPG [name=provider]').val(btoa(obj.data.bankId));
            $('.modal-modifyPG [name=providername]').val(obj.data.bankName.EN);
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
        swal.close();
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}
</script>