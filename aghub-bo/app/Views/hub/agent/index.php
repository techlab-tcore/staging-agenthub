<section class="card border-light">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <article class="card-text p-3">
            <?=form_open('', ['class'=>'row gy-2 gx-3 align-items-center filterForm pb-3', 'novalidate'=>'novalidate']);?>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <div class="input-group">
                    <span class="input-group-text"><?=lang('Input.username');?></span>
                    <input type="text" class="form-control" name="username">
                </div>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <div class="input-group">
                    <span class="input-group-text"><?=lang('Input.regioncode');?></span>
                    <select class="form-select" name="regioncode">
                    <option value="">--</option>
                    <option value="MYR">Malaysia (+60)</option>
                    <option value="SGD">Singapore (+65)</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <div class="input-group">
                    <span class="input-group-text"><?=lang('Input.contact');?></span>
                    <input type="text" class="form-control" name="contact">
                </div>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <div class="input-group">
                    <span class="input-group-text"><?=lang('Input.usercreated');?></span>
                    <input type="text" class="form-control bg-white" name="ucreated" readonly>
                </div>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <div class="input-group">
                    <span class="input-group-text"><?=lang('Input.status');?></span>
                    <select class="form-select" name="status">
                    <option value=""><?=lang('Label.all');?></option>
                    <option value="1"><?=lang('Label.active');?></option>
                    <option value="2"><?=lang('Label.inactive');?></option>
                    <option value="3"><?=lang('Label.freeze');?></option>
                    </select>
                </div>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <button type="submit" class="btn btn-primary w-100"><?=lang('Nav.search');?></button>
            </div>
            <?=form_close();?>

            <table id="userTable" class="w-100 table table-sm table-bordered table-hover">
            <thead class="table-style">
            <tr>
            <th><?=lang('Input.username');?></th>
            <th><?=lang('Input.fname');?></th>
            <th><?=lang('Input.currency');?></th>
            <th class="none"><?=lang('Input.status');?></th>
            <th class="none"><?=lang('Input.contact');?></th>
            <th class="none"><?=lang('Input.telegram');?></th>
            <th class="none"><?=lang('Label.lastlogindate');?></th>
            <th class="none"><?=lang('Label.createddate');?></th>
            <th class="none"><?=lang('Input.remark');?></th>
            <th><?=lang('Label.action');?></th>
            </tr>
            </thead>
            <tbody></tbody>
            </table>
        </article>
    </div>
</section>

<section class="modal fade modal-modifyHubUser" id="modal-modifyHubUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-modifyHubUser" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.edit');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation modifyPersonalForm', 'novalidate'=>'novalidate']);?>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label"><?=lang('Input.username');?></label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <input type="text" class="form-control-plaintext" name="username" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label"><?=lang('Input.newpass');?></label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <div class="input-group">
                            <input type="password" class="form-control" pattern=".{6,}" name="newpass" id="newpass">
                            <button type="button" class="btn btn-primary" data-bs-toggle="button" autocomplete="off" onclick="showhidepass('newpass')"><?=lang('Nav.show');?></button>
                        </div>
                        <small class="form-text"><?=lang('Validation.password',[6]);?></small>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label"><?=lang('Input.fname');?></label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <input type="text" class="form-control" name="fname" required>
                        <small class="form-text"><?=lang('Validation.fullname');?></small>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label"><?=lang('Input.contact');?></label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <div class="input-group">
                            <select class="form-select" name="regioncode">
                            <option value="MYR">(+60)</option>
                            <option value="SGD">(+65)</option>
                            </select>
                            <input type="text" class="form-control" pattern="^[0-9]{8,11}$" name="contact" placeholder="e.g. <?=$_ENV['sampleMobile'];?>">
                            <small class="form-text"><?=lang('Validation.mobile',[8,11]);?></small>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label"><?=lang('Input.telegram');?></label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <input type="text" class="form-control" name="telegram">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label"><?=lang('Input.remark');?></label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <textarea class="form-control" name="remark"></textarea>
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

<section class="modal fade modal-currencyRegis" id="modal-currencyRegis" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-currencyRegis" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Label.regisbycurrency');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate','autocomplete'=>'off'], ['uid'=>'']);?>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label">Currency</label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <select class="form-select" name="currencycode" required>
                        <option value="">---</option>
                        <option value="0">MYR</option>
                        <option value="3">TUSDT</option>
                        </select>
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

<!--- Agent Permission --->
<section class="modal fade modal-agentHubPermission" id="modal-agentHubPermission" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-agentHubPermission" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Label.agentpermission');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate'], ['uid'=>'']);?>
                <!--Permit-->
                <div class="mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="transfercomm" name="transfercomm" value="1">
                        <label class="form-check-label" for="transfercomm"><?=lang('Nav.notransfercomm');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="createmember" name="createmember" value="1">
                        <label class="form-check-label" for="createmember"><?=lang('Nav.nocreatemember');?></label>
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
<!--- End Agent Permission --->

<script src="<?=base_url('assets/vendors/echart/dist/echarts.min.js');?>"></script>
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

    airdatepicker();

    var pageindex = 1, debug = false;
    const userTable = $('#userTable').DataTable({
        dom: "<'row'<'col-12'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
        responsive: {
            details: {
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table table-bordered'
                })
            }
        },
        language: langs,
        ordering: false,
        deferRender: true,
        serverSide: true,
        processing: true,
        destroy: true,
        pageLength: 15,
        ajax: function(data, callback, settings) {
            if (settings._iRecordsTotal == 0) {
                pageindex = 1;
            } else {
                var pageindex = settings._iDisplayStart/settings._iDisplayLength + 1;
            }

            const username = $('.filterForm [name=username]').val();
            const regioncode = $('.filterForm [name=regioncode]').val();
            const contact = $('.filterForm [name=contact]').val();
            const ucreated = $('.filterForm [name=ucreated]').val();
            const status = $('.filterForm [name=status]').val();
            
            var payload = JSON.stringify({
                pageindex: pageindex,
                rowperpage: data.length,
                parent: '<?=$parent;?>',
                username: username,
                regioncode: regioncode,
                contact: contact,
                ucreated: ucreated,
                status: status
            });

            $.ajax({
                url: '/list/agent/hub',
                type: 'post',
                data: payload,
                contentType:"application/json; charset=utf-8",
                dataType:"json",
                success: function(res){
                    if (res.code !== 1) {
                        // alert(res.message);
                        callback({
                            recordsTotal: 0,
                            recordsFiltered: 0,
                            data: []
                        });

                        return;
                    } else {
                        callback({
                            recordsTotal: res.totalRecord,
                            recordsFiltered: res.totalRecord,
                            data: res.data
                        });
                    }
                    return;
                }
            });
        },
        //aoColumnDefs: [{
        //    aTargets: [3,4],
        //    render: function ( data, type, row ) {
        //        return parseFloat(data).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
        //        //return parseFloat(data).toFixed(2).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
        //    }
        //}]
    });

    $('.filterForm').off().on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            userTable.draw();
        }
    });

    const modifyHubUserEvent = document.getElementById('modal-modifyHubUser');
    modifyHubUserEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });

    const modifyCurrencyRegis = document.getElementById('modal-currencyRegis');
    modifyCurrencyRegis.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });

    $('.modal-currencyRegis form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            swal.fire({
                title: 'Transferring...',
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                customClass: {
                    container: 'bg-major'
                }
            });

            $('.modal-currencyRegis form [type=submit]').prop('disabled',true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/user/register/bycurrency', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                // console.log(obj);
                if( obj.code == 1 ) {
                    swal.fire("Success!", obj.message, "success").then(() => { $('#userTable').DataTable().ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-currencyRegis').modal('toggle');
                $('.modal-currencyRegis form [type=submit]').prop('disabled',false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    //agent permit
    $('.modal-agentHubPermission form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            $('.modal-agentHubPermission form [type=submit]').prop('disabled',true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/hub/agent/permission/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                // console.log(obj);
                if( obj.code == 1 ) {
                    alertToast('bg-success', obj.message);
                    $('#userTable').DataTable().ajax.reload(null,false);
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    alertToast('bg-danger', obj.message);
                }
            })
            .done(function() {
                swal.close();
                $('.modal-agentHubPermission').modal('toggle');
                $('.modal-agentHubPermission form [type=submit]').prop('disabled',false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => { $('.modal-permission form [type=submit]').prop('disabled',false); });
            });
        }
    });

    const agentHubpermissionEvent = document.getElementById('modal-agentHubPermission');
    agentHubpermissionEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });
    //End agent permit
});

function modifyHubUser(uid, username)
{
    $('.modal-modifyHubUser').modal('show');
    $('.modal-modifyHubUser form [name=username]').val(username);

    coordinateHubProfile(uid);

    $('.modal-modifyHubUser form').off().on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            $('.modal-modifyHubUser form [type=submit]').prop('disabled',true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['uid'] = uid;
                params['usertype'] = '<?=$_SESSION['session'];?>';
            });

            $.post('/user/personal-change/user/hub', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                // console.log(obj);
                if( obj.code == 1 ) {
                    swal.fire("Success!", obj.message, "success").then(() => { $('#userTable').DataTable().ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-modifyHubUser').modal('hide');
                $('.modal-modifyHubUser form [type=submit]').prop('disabled',false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });
}

function coordinateHubProfile(uid)
{
    generalLoading();

    var params = {};
    params['uid'] = uid;

    $.post('/user/profile/hub', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            swal.close();
            
            // if( obj.data.currency=='MYR' && obj.data.contact!='' )
            // {
            //     $('.modal-modify form [name=contact]').val('0'+obj.data.contact);
            // } else {
            //     $('.modal-modify form [name=contact]').val(obj.data.contact);
            // }

            $('.modal-modifyHubUser form [name=contact]').val(obj.data.contact);
            $('.modal-modifyHubUser form [name=telegram]').val(obj.data.telegram);
            $('.modal-modifyHubUser form [name=remark]').val(obj.data.remark);
            $('.modal-modifyHubUser form [name=fname]').val(obj.data.name);

            $('.modal-modifyHubUser [name=regioncode] option[value=MYR]').removeAttr('selected','selected');
            $('.modal-modifyHubUser [name=regioncode] option[value=SGD]').removeAttr('selected','selected');
            if( obj.data.regionCode=='' ) {
                $('.modal-modifyHubUser [name=regioncode] option[value=MYR]').attr('selected','selected');
            } else {
                $('.modal-modifyHubUser [name=regioncode] option[value=' + obj.data.regionCode + ']').attr('selected','selected');
            }
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

function modifyHubStatus(uid, status)
{
    generalLoading();

    var params = {};
    params['uid'] = uid;
    params['status'] = status;

    $.post('hub/user/status-change', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            alertToast('bg-success', obj.message);
            $('#userTable').DataTable().ajax.reload(null,false);
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            alertToast('bg-danger', obj.message);
        }
    })
    .done(function() {
        swal.close();
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => { $('#userTable').DataTable().ajax.reload(null,false); });
    });
}

function registerByCurrency(uid)
{
    $('.modal-currencyRegis').modal('toggle');
    $('.modal-currencyRegis form [name=uid]').val(uid);
}

//Agent permission
function agentHubPermission(uid)
{
    $('.modal-agentHubPermission').modal('toggle');

    generalLoading();

    var params = {};
    params['uid'] = uid;

    $.post('hub/list/agent/permission', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            $('.modal-agentHubPermission form [name=uid]').val(uid);
            //Permit
            obj.data.transfercomm==1 ? $('.modal-agentHubPermission [name=transfercomm]').prop('checked', true) : $('.modal-agentHubPermission [name=transfercomm]').prop('checked', false);
            obj.data.createmember==1 ? $('.modal-agentHubPermission [name=createmember]').prop('checked', true) : $('.modal-agentHubPermission [name=createmember]').prop('checked', false);
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message, "error");
        }
    })
    .done(function() {
        swal.close();
    })
    .fail(function() {
        swal.fire("", "Please try again later.", "error").then(() => {  });
    });
}
//End Agent permission

</script>