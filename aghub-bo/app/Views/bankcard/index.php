<section class="card border-light shadow">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <div class="px-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-addbc"><i class="las la-plus-circle me-1"></i><?=lang('Nav.addbankcard');?></button>
        </div>

        <article class="card-text p-3">
            <table id="bankcardTable" class="w-100 nowrap table table-sm table-bordered table-hover">
                <thead class="table-style">
                <tr>
                <th><?=lang('Input.status');?></th>
                <th><?=lang('Input.setfrontend');?></th>
                <th><?=lang('Input.bank');?></th>
                <th class="none"><?=lang('Input.cardno');?></th>
                <th><?=lang('Input.accno');?></th>
                <th><?=lang('Input.accholder');?></th>
                <th class="none"><?=lang('Input.branch');?></th>
                <th class="none"><?=lang('Input.charges');?> (%)</th>
                <th class="none"><?=lang('Input.minmaxdeposit');?></th>
                <th class="none"><?=lang('Input.minmaxwithdrawal');?></th>
                <th class="none"><?=lang('Input.maxdailydeposit');?></th>
                <th class="none"><?=lang('Input.maxdailywithdrawal');?></th>
                <th class="none"><?=lang('Input.remark');?></th>
                <th><?=lang('Label.action');?></th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </article>
    </div>
</section>

<section class="modal fade modal-addbc" id="modal-addbc" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-addbc" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.addbankcard');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate']);?>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-3">
                        <div class="mb-3">
                            <label><?=lang('Input.bank');?></label>
                            <select class="form-select" id="banklist" name="provider" required>
                            </select>
                        </div>
                        <!--
                        <div class="mb-3">
                            <label><?//=lang('Input.cardno');?></label>
                            <input type="text" class="form-control" name="cardno" required>
                        </div>
                        -->
                        <div class="mb-3">
                            <label><?=lang('Input.accno');?></label>
                            <input type="text" class="form-control" name="accno" required>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.accholder');?></label>
                            <input type="text" class="form-control" name="holder" onkeyup="this.value=this.value.replace(/[^a-zA-Z0-9 ]/g, '')" required>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.branch');?></label>
                            <input type="text" class="form-control" name="branch">
                        </div>
                        <div class="mb-3">
                            <label class="d-block"><?=lang('Input.setfrontend');?></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="frontend" id="fyes2" value="1" checked>
                                <label class="form-check-label" for="fyes2"><?=lang('Label.yes');?></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="frontend" id="fno2" value="2">
                                <label class="form-check-label" for="fno2"><?=lang('Label.no');?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-3">
                        <div class="mb-3">
                            <label><?=lang('Input.charges');?> (%)</label>
                            <input type="number" step="any" min="0" class="form-control" name="charges" required>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label><?=lang('Input.mindeposit');?></label>
                                <input type="number" step="any" min="0" class="form-control" name="mindeposit" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label><?=lang('Input.maxdeposit');?></label>
                                <input type="number" step="any" min="0" class="form-control" name="maxdeposit" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label><?=lang('Input.minwithdrawal');?></label>
                                <input type="number" step="any" min="0" class="form-control" name="minwithdrawal" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label><?=lang('Input.maxwithdrawal');?></label>
                                <input type="number" step="any" min="0" class="form-control" name="maxwithdrawal" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.maxdailydeposit');?></label>
                            <input type="number" step="any" min="0" class="form-control" name="dailymaxdeposit" required>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.maxdailywithdrawal');?></label>
                            <input type="number" step="any" min="0" class="form-control" name="dailymaxwithdrawal" required>
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

<section class="modal fade modal-modifyBC" id="modal-modifyBC" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-modifyBC" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.addbankcard');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate'],['provider'=>'']);?>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-3">
                        <div class="mb-3">
                            <label><?=lang('Input.bank');?></label>
                            <input type="text" class="form-control" name="bank" readonly required>
                        </div>
                        <!--
                        <div class="mb-3">
                            <label><?//=lang('Input.cardno');?></label>
                            <input type="text" class="form-control" name="cardno" readonly required>
                        </div>
                        -->
                        <div class="mb-3">
                            <label><?=lang('Input.accno');?></label>
                            <input type="text" class="form-control" name="accno" readonly required>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.accholder');?></label>
                            <input type="text" class="form-control" name="holder" required>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.branch');?></label>
                            <input type="text" class="form-control" name="branch">
                        </div>
                        <div class="mb-3">
                            <label class="d-block"><?=lang('Input.setfrontend');?></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="frontend" id="fyes" value="1" checked>
                                <label class="form-check-label" for="fyes"><?=lang('Label.yes');?></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="frontend" id="fno" value="2">
                                <label class="form-check-label" for="fno"><?=lang('Label.no');?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-3">
                        <div class="mb-3">
                            <label><?=lang('Input.charges');?> (%)</label>
                            <input type="number" step="any" min="0" class="form-control" name="charges" required>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label><?=lang('Input.mindeposit');?></label>
                                <input type="number" step="any" min="0" class="form-control" name="mindeposit" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label><?=lang('Input.maxdeposit');?></label>
                                <input type="number" step="any" min="0" class="form-control" name="maxdeposit" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label><?=lang('Input.minwithdrawal');?></label>
                                <input type="number" step="any" min="0" class="form-control" name="minwithdrawal" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label><?=lang('Input.maxwithdrawal');?></label>
                                <input type="number" step="any" min="0" class="form-control" name="maxwithdrawal" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.maxdailydeposit');?></label>
                            <input type="number" step="any" min="0" class="form-control" name="dailymaxdeposit" required>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.maxdailywithdrawal');?></label>
                            <input type="number" step="any" min="0" class="form-control" name="dailymaxwithdrawal" required>
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

    const bankcardTable = $('#bankcardTable').DataTable({
        dom: "<'row mb-3'<'col-xl-6 col-lg-6 col-md-6 col-12'l><'col-xl-6 col-lg-6 col-md-6 col-12'f>>" + "<'row'<'col-12 overflow-auto'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
        ajax: {
            type : "POST",
            // contentType: "application/json; charset=utf-8",
            url: "/list/bank-card/user/all",
            data: {"parent": '<?=$parent;?>'},
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

    const addbcEvent = document.getElementById('modal-addbc');
    addbcEvent.addEventListener('shown.bs.modal', function (event) {
        getBankList('banklist');
    });
    addbcEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
        document.getElementById("banklist").innerHTML = '';
    });

    $('.modal-addbc form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['uid'] = '<?=$parent;?>';
            });

            $.post('/bank-card/company/add', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { bankcardTable.ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-addbc').modal('toggle');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    const modifyBCEvent = document.getElementById('modal-modifyBC');
    modifyBCEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });

    $('.modal-modifyBC form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['uid'] = '<?=$parent;?>';
            });

            $.post('/user/bank-card/company/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { bankcardTable.ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-modifyBC').modal('toggle');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });
});

function modifyBC(provider,card,accno)
{
    $('.modal-modifyBC').modal('toggle');

    var params = {};
    params['uid'] = '<?=$parent;?>';
    params['provider'] = provider;
    params['cardno'] = card;
    params['accno'] = accno;

    $.post('/bank-card/company/get', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            $('.modal-modifyBC [name=provider]').val(btoa(obj.data.bankId));
            $('.modal-modifyBC [name=bank]').val(obj.data.name.EN);
            $('.modal-modifyBC [name=cardno]').val(obj.data.cardNo);
            $('.modal-modifyBC [name=accno]').val(obj.data.accountNo);
            $('.modal-modifyBC [name=holder]').val(obj.data.accountHolder);
            $('.modal-modifyBC [name=branch]').val(obj.data.branch);
            $('.modal-modifyBC [name=charges]').val(obj.data.charges);
            $('.modal-modifyBC [name=mindeposit]').val(obj.data.minDeposit);
            $('.modal-modifyBC [name=maxdeposit]').val(obj.data.maxDeposit);
            $('.modal-modifyBC [name=minwithdrawal]').val(obj.data.minWithdrawal);
            $('.modal-modifyBC [name=maxwithdrawal]').val(obj.data.maxWithdrawal);
            $('.modal-modifyBC [name=dailymaxdeposit]').val(obj.data.maxDailyDeposit);
            $('.modal-modifyBC [name=dailymaxwithdrawal]').val(obj.data.maxDailyWithdrawal);
            $('.modal-modifyBC [name=remark]').val(obj.data.remark);

            obj.data.display==1 ? $('.modal-modifyBC [name=frontend]#fyes').prop('checked',true) : $('.modal-modifyBC [name=frontend]#fno').prop('checked',true);
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

function statusBC(provider,card,accno,status)
{
    var params = {};
    params['uid'] = '<?=$parent;?>';
    params['provider'] = provider;
    params['cardno'] = card;
    params['accno'] = accno;
    params['status'] = status;

    $.post('/bank-card/company/status/modify', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            swal.fire("Updated!", obj.message , "success").then(() => { $('#bankcardTable').DataTable().ajax.reload(null,false); });
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

function setDefaultBC(provider,card,accno,status)
{
    var params = {};
    params['uid'] = '<?=$parent;?>';
    params['provider'] = provider;
    params['cardno'] = card;
    params['accno'] = accno;
    params['isdefault'] = status;

    $.post('/bank-card/user/set-default', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            swal.fire("Updated!", obj.message , "success").then(() => { $('#bankcardTable').DataTable().ajax.reload(null,false); });
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