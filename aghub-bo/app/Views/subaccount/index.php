<section class="card border-light">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <article class="card-text p-3">
            <table id="userTable" class="w-100 nowrap table table-sm table-bordered table-hover">
            <thead class="table-style">
            <tr>
            <th><?=lang('Input.status');?></th>
            <th><?=lang('Input.username');?></th>
            <th class="none"><?=lang('Input.fname');?></th>
            <th><?=lang('Input.contact');?></th>
            <th><?=lang('Input.remark');?></th>
            <th class="none"><?=lang('Label.lastlogindate');?></th>
            <th class="none"><?=lang('Label.createddate');?></th>
            <th><?=lang('Label.action');?></th>
            </tr>
            </thead>
            <tbody></tbody>
            </table>
        </article>
    </div>
</section>

<section class="modal fade modal-permission" id="modal-permission" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-permission" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Label.userpermission');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate'], ['uid'=>'']);?>
                <div class="mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="transaction" name="transaction" value="1">
                        <label class="form-check-label" for="transaction"><?=lang('Nav.transaction');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="report" name="report" value="1">
                        <label class="form-check-label" for="report"><?=lang('Nav.report');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="account" name="account" value="1">
                        <label class="form-check-label" for="account"><?=lang('Nav.account');?></label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="gprovider" name="gprovider" value="1">
                        <label class="form-check-label" for="gprovider"><?=lang('Nav.gp');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="settings" name="settings" value="1">
                        <label class="form-check-label" for="settings"><?=lang('Nav.settings');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="extra" name="extra" value="1">
                        <label class="form-check-label" for="extra"><?=lang('Nav.extra');?></label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="usearch" name="usearch" value="1">
                        <label class="form-check-label" for="usearch"><?=lang('Nav.usearch');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="uprofile" name="uprofile" value="1">
                        <label class="form-check-label" for="uprofile"><?=lang('Nav.uprofile');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="confidential" name="confidential" value="1">
                        <label class="form-check-label" for="confidential"><?=lang('Nav.confidential');?></label>
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

    var pageindex = 1, debug = false;
    const userTable = $('#userTable').DataTable({
        dom: "<'row'<'col-12 overflow-auto'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
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
        ajax: function(data, callback, settings) {
            if (settings._iRecordsTotal == 0) {
                pageindex = 1;
            } else {
                var pageindex = settings._iDisplayStart/settings._iDisplayLength + 1;
            }
            
            var payload = JSON.stringify({
                pageindex: pageindex,
                rowperpage: data.length
            });
            $.ajax({
                url: '/list/sub-account',
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
    });

    $('.modal-permission form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            $('.modal-permission form [type=submit]').prop('disabled',true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/user/permission/modify', {
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
                $('.modal-permission').modal('toggle');
                $('.modal-permission form [type=submit]').prop('disabled',false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => { $('.modal-permission form [type=submit]').prop('disabled',false); });
            });
        }
    });

    const permissionEvent = document.getElementById('modal-permission');
    permissionEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });
});

function permission(uid)
{
    $('.modal-permission').modal('toggle');

    generalLoading();

    var params = {};
    params['uid'] = uid;

    $.post('/list/user/permission', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            $('.modal-permission form [name=uid]').val(uid);
            obj.data.account==1 ? $('.modal-permission [name=account]').prop('checked', true) : $('.modal-permission [name=account]').prop('checked', false);
            obj.data.transaction==1 ? $('.modal-permission [name=transaction]').prop('checked', true) : $('.modal-permission [name=transaction]').prop('checked', false);
            obj.data.report==1 ? $('.modal-permission [name=report]').prop('checked', true) : $('.modal-permission [name=report]').prop('checked', false);
            obj.data.gameprovider==1 ? $('.modal-permission [name=gprovider]').prop('checked', true) : $('.modal-permission [name=gprovider]').prop('checked', false);
            obj.data.settings==1 ? $('.modal-permission [name=settings]').prop('checked', true) : $('.modal-permission [name=settings]').prop('checked', false);
            obj.data.extra==1 ? $('.modal-permission [name=extra]').prop('checked', true) : $('.modal-permission [name=extra]').prop('checked', false);
            obj.data.usersearch==1 ? $('.modal-permission [name=usearch]').prop('checked', true) : $('.modal-permission [name=usearch]').prop('checked', false);
            obj.data.userprofile==1 ? $('.modal-permission [name=uprofile]').prop('checked', true) : $('.modal-permission [name=uprofile]').prop('checked', false);
            obj.data.confidential==1 ? $('.modal-permission [name=confidential]').prop('checked', true) : $('.modal-permission [name=confidential]').prop('checked', false);
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
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => {  });
    });
}
</script>