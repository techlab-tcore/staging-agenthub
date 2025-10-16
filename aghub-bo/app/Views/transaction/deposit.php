<div class="card border-light">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <article class="card-text p-3">

            <?=form_open('', ['class'=>'row gy-2 gx-3 align-items-center filterForm pb-3', 'novalidate'=>'novalidate'],['types'=>0]);?>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <button type="submit" class="btn btn-primary w-100"><?=lang('Nav.refresh');?></button>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <button type="button" class="btn btn-warning w-100" onclick="startRefresh();"><?=lang('Nav.autorefresh');?></button>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <button type="button" class="btn btn-danger w-100" onclick="stopRefresh();"><?=lang('Nav.stoprefresh');?></button>
            </div>
            <?=form_close();?>

            <table id="paymentTable" class="w-100 table table-sm table-bordered table-hover">
                <thead class="table-style">
                <tr>
                <th><?=lang('Label.createddate');?></th>
                <th class="none"><?=lang('Label.payid');?></th>
                <th><?=lang('Input.username');?></th>
                <!-- <th><?//=lang('Input.method');?></th> -->
                <th><?=lang('Input.fname');?></th>
                <th><?=lang('Input.accno');?></th>
                <th class="none"><?=lang('Label.referid');?></th>
                <th class="none"><?=lang('Label.promotion');?></th>
                <th class="none"><?=lang('Label.turnover');?>/<?=lang('Label.currentturnover');?></th>
                <th><?=lang('Input.amount');?></th>
                <th><?=lang('Input.convertamount');?></th>
                <th class="none"><?=lang('Input.bankinslip');?></th>
                <th><?=lang('Label.action');?></th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>

        </article>
    </div>
</div>

<section class="modal fade modal-permission" id="modal-permission" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-permission" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Label.permission');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate','autocomplete'=>'off'], ['pid'=>'','status'=>'','type'=>1]);?>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Input.username');?></label>
                    <div class="col-8">
                        <input type="text" class="form-control-plaintext" name="username" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Input.status');?></label>
                    <div class="col-8">
                        <input type="text" class="form-control-plaintext" name="decision" id="decision" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Input.remark');?></label>
                    <div class="col-8">
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

<audio id="audio" src="<?=base_url('assets/sound/cash-register.mp3');?>" autostart="false" ></audio>

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

    // refreshIncoming(30);

    var pageindex = 1, debug = false;
    const paymentTable = $('#paymentTable').DataTable({
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

            const paytype = $('.filterForm [name=types]').val();
            
            var payload = JSON.stringify({
                pageindex: pageindex,
                rowperpage: data.length,
                type: paytype,
                parent: '<?=$parent;?>'
            });
            $.ajax({
                url: '/list/pending/deposit',
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
        aoColumnDefs: [{
            aTargets: [8,9],
            render: function ( data, type, row ) {
                return parseFloat(data).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            }
        }]
    });

    $('.filterForm').off().on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            paymentTable.draw();
        }
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
                params['agentcode'] = '<?=$_SESSION['session'];?>'; //Test
            });

            $.post('/transaction/permission', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                // console.log(obj);
                if( obj.code == 1 ) {
                    swal.fire("Success!", obj.message, "success").then(() => {
                        // const findPopover = document.querySelectorAll('.popover');
                        // $(findPopover).removeClass("show");
                        // $("[data-toggle='popover']").popover('hide');
                        // $(findPopover).remove();
                        
                        refreshProfile();
                        // paymentTable.ajax.reload(null,false);
                        checkingPending();
                    });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-permission').modal('hide');
                $('.modal-permission form [type=submit]').prop('disabled',false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    const permissionEvent = document.getElementById('modal-permission');
    permissionEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });
});

function permission(pid, username, status)
{
    const decision = status==1 ? '<?=lang('Nav.approve');?>' : '<?=lang('Nav.reject');?>';

    $('.modal-permission').modal('toggle');
    $('.modal-permission [name=pid]').val(pid);
    $('.modal-permission [name=status]').val(status);
    $('.modal-permission [name=username]').val(username);
    $('.modal-permission [name=decision]').val(decision);

    if ( status==1 ) {
        document.getElementById("decision").classList.remove('bg-danger');
        document.getElementById("decision").classList.add('text-white', 'bg-success');
    } else {
        document.getElementById("decision").classList.remove('bg-success');
        document.getElementById("decision").classList.add('text-white', 'bg-danger');
    }
}

var schedule;
function refreshIncoming(timer)
{
    refresh = timer * 1000;
    schedule = setTimeout(function() {
        var x = document.getElementById("audio");
        $.get('/availabel/pending-deposit/notify/0', function(data, status) {
            const obj = JSON.parse(data);
            if( obj.code==1 && obj.available==true ) {
                x.play();
                $('#paymentTable').DataTable().ajax.reload(null,false);
            } else if( obj.code==39 ) {
                forceUserLogout();
            } else {
                x.pause();
                x.currentTime = 0;
                // swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
            }
        })
        .done(function() {
            refreshIncoming(timer);
        })
        .fail(function() {
        });
    }, refresh);
}

function checkingPending()
{
    var x = document.getElementById("audio");
    $.get('/availabel/pending-deposit/notify/0', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 && obj.available==true ) {
            x.play();
            $('#paymentTable').DataTable().ajax.reload(null,false);
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            x.pause();
            x.currentTime = 0;
            $('#paymentTable').DataTable().ajax.reload(null,false);
            // swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
    })
    .fail(function() {
    });
}

function startRefresh()
{
    alertToast('bg-success','Auto Refresh Activated');
    clearTimeout(schedule);
    refreshIncoming(30);
}

function stopRefresh()
{
    var x = document.getElementById("audio");
    x.pause();
    x.currentTime = 0;
    
    alertToast('bg-danger','Auto Refresh Deactivated');
    clearTimeout(schedule);
}
</script>