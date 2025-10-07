<section class="card border-light shadow">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <div class="px-3">
            <a class="btn btn-danger bg-gradient" href="<?=base_url('settings/payment-gateway');?>"><?=lang('Nav.b2pg');?></a>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-addpchannel"><?=lang('Nav.addpchannel');?></button>
        </div>

        <article class="card-text p-3">
            <table id="channelTable" class="w-100 nowrap table table-sm table-bordered">
                <thead class="table-style">
                <tr>
                <th><?=lang('Input.channelcode');?></th>
                <th class="none"><?=lang('Input.accid');?></th>
                <th class="none"><?=lang('Input.bankcode');?></th>
                <th><?=lang('Label.deposit');?></th>
                <th><?=lang('Label.withdrawal');?></th>
                <th><?=lang('Input.bank');?></th>
                <th><?=lang('Input.charges');?> (%)</th>
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

<section class="modal fade modal-addpchannel" id="modal-addpchannel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-addpchannel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.addpchannel');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate']);?>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-3">
                        <div class="mb-3">
                            <label><?=lang('Input.bank');?></label>
                            <input type="text" class="form-control" name="en" required>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.channelcode');?></label>
                            <input type="text" class="form-control" name="channel" required>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.charges');?> (%)</label>
                            <input type="number" step="any" min="0" class="form-control" name="charges" required>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label class="d-block"><?=lang('Label.deposit');?></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="isdeposit" id="dyes2" value="1" checked>
                                    <label class="form-check-label" for="dyes2"><?=lang('Label.yes');?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="isdeposit" id="dno2" value="2">
                                    <label class="form-check-label" for="dno2"><?=lang('Label.no');?></label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label class="d-block"><?=lang('Label.withdrawal');?></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="iswithdrawal" id="wyes2" value="1">
                                    <label class="form-check-label" for="wyes2"><?=lang('Label.yes');?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="iswithdrawal" id="wno2" value="2" checked>
                                    <label class="form-check-label" for="wno2"><?=lang('Label.no');?></label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.remark');?></label>
                            <textarea class="form-control" name="remark"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-3">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label><?=lang('Input.accid');?></label>
                                <input type="text" class="form-control" name="accountid">
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label><?=lang('Input.bankcode');?></label>
                                <input type="text" class="form-control" name="bankcode">
                            </div>
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

<section class="modal fade modal-editpchannel" id="modal-editpchannel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-editpchannel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.editpchannel');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate']);?>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-3">
                        <div class="mb-3">
                            <label><?=lang('Input.bank');?></</label>
                            <input type="text" class="form-control" name="en" required>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.channelcode');?></label>
                            <input type="text" class="form-control" name="channel" readonly required>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.charges');?> (%)</label>
                            <input type="number" step="any" min="0" class="form-control" name="charges" required>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label class="d-block"><?=lang('Label.deposit');?></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="isdeposit" id="dyes" value="1" checked>
                                    <label class="form-check-label" for="dyes"><?=lang('Label.yes');?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="isdeposit" id="dno" value="2">
                                    <label class="form-check-label" for="dno"><?=lang('Label.no');?></label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label class="d-block"><?=lang('Label.withdrawal');?></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="iswithdrawal" id="wyes" value="1">
                                    <label class="form-check-label" for="wyes"><?=lang('Label.yes');?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="iswithdrawal" id="wno" value="2" checked>
                                    <label class="form-check-label" for="wno"><?=lang('Label.no');?></label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label><?=lang('Input.remark');?></label>
                            <textarea class="form-control" name="remark"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 mb-lg-0 mb-md-0 mb-3">
                    <div class="row">
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label><?=lang('Input.accid');?></label>
                                <input type="text" class="form-control" name="accountid">
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label><?=lang('Input.bankcode');?></label>
                                <input type="text" class="form-control" name="bankcode">
                            </div>
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

    const channelTable = $('#channelTable').DataTable({
        dom: "<'row mb-3'<'col-xl-6 col-lg-6 col-md-6 col-12'l><'col-xl-6 col-lg-6 col-md-6 col-12'f>>" + "<'row'<'col-12 overflow-auto'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
        ajax: {
            type : "POST",
            url: '/list/payment-channel/company/all',
            data: {"provider": '<?=$provider;?>', "merchant": '<?=$merchant;?>'},
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

    const addchannelEvent = document.getElementById('modal-addpchannel');
    addchannelEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });

    $('.modal-addpchannel form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['bankid'] = '<?=$provider;?>';
                params['merchant'] = '<?=$merchant;?>';
            });

            $.post('/payment-gateway/channel/add', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { channelTable.ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-addpchannel').modal('toggle');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    const editchannelEvent = document.getElementById('modal-editpchannel');
    editchannelEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });

    $('.modal-editpchannel form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['bankid'] = '<?=$provider;?>';
                params['merchant'] = '<?=$merchant;?>';
            });

            $.post('/payment-gateway/channel/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { channelTable.ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-editpchannel').modal('toggle');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });
});

function modifyPC(channel)
{
    $('.modal-editpchannel').modal('toggle');

    var params = {};
    params['provider'] = '<?=$provider;?>';
    params['merchant'] = '<?=$merchant;?>';
    params['channel'] = channel;

    $.post('/payment-gateway/channel/get', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            $('.modal-editpchannel [name=channel]').val(obj.data.code);
            $('.modal-editpchannel [name=en]').val(obj.data.channelName.EN);
            $('.modal-editpchannel [name=charges]').val(obj.data.charges);
            $('.modal-editpchannel [name=remark]').val(obj.data.remark);
            $('.modal-editpchannel [name=accountid]').val(obj.data.accountId);
            $('.modal-editpchannel [name=bankcode]').val(obj.data.bankCode);
            $('.modal-editpchannel [name=mindeposit]').val(obj.data.minDeposit);
            $('.modal-editpchannel [name=maxdeposit]').val(obj.data.maxDeposit);
            $('.modal-editpchannel [name=minwithdrawal]').val(obj.data.minWithdrawal);
            $('.modal-editpchannel [name=maxwithdrawal]').val(obj.data.maxWithdrawal);
            $('.modal-editpchannel [name=dailymaxdeposit]').val(obj.data.maxDailyDeposit);
            $('.modal-editpchannel [name=dailymaxwithdrawal]').val(obj.data.maxDailyWithdrawal);

            obj.data.isDeposit==1 ? $('.modal-editpchannel [name=isdeposit]#dyes').prop('checked',true) : $('.modal-editpchannel [name=isdeposit]#dno').prop('checked',true);
            obj.data.isWithdrawal==1 ? $('.modal-editpchannel [name=iswithdrawal]#wyes').prop('checked',true) : $('.modal-editpchannel [name=iswithdrawal]#wno').prop('checked',true);
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