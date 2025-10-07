<section class="card border-light">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <article class="card-text p-3">
            <?=form_open('', ['class'=>'row gy-2 gx-3 align-items-center filterForm pb-2', 'novalidate'=>'novalidate']);?>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <div class="input-group">
                    <span class="input-group-text"><?=lang('Input.from');?></span>
                    <input type="text" class="form-control bg-white" name="start" value="<?=date('Y-m-d',strtotime("-6 days"));?>" readonly>
                </div>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <div class="input-group">
                    <span class="input-group-text"><?=lang('Input.to');?></span>
                    <input type="text" class="form-control bg-white" name="end" value="<?=date('Y-m-d');?>" readonly>
                </div>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <div class="input-group">
                    <span class="input-group-text"><?=lang('Input.types');?></span>
                    <select class="form-select" name="type" required>
                    <option value="5"><?=lang('Label.winlose');?></option>
                    <option value="3"><?=lang('Label.affiliate');?></option>
                    <option value="4"><?=lang('Label.ps');?></option>
                    <option value="1"><?=lang('Label.agcomm');?></option>
                    <option value="6"><?=lang('Label.lossrebate');?></option>
                    <option value="8"><?=lang('Label.affloserebate');?></option>
                    <option value="9"><?=lang('Label.ptps1');?></option>
                    <option value="10"><?=lang('Label.ptps2');?></option>
                    </select>
                </div>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <button type="submit" class="btn btn-primary w-100"><?=lang('Nav.search');?></button>
            </div>
            <?=form_close();?>

            <div class="my-3">
                <div class="row">
                    <label class="col-xl-auto col-lg-auto col-md-auto col-12 col-form-label col-form-label-sm d-flex align-items-center"><?=lang('Input.types');?>:</label>
                    <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                        <button type="button" class="btn btn-primary my-0" onclick="doSettlement('<?=lang('Label.winlose');?>',5);"><?=lang('Label.winlose');?></button>
                        <button type="button" class="btn btn-primary my-0" onclick="doSettlement('<?=lang('Label.agcomm');?>',1);"><?=lang('Label.agcomm');?></button>
                        <button type="button" class="btn btn-primary my-0" onclick="doSettlement('<?=lang('Label.affiliate');?>',3);"><?=lang('Label.affiliate');?></button>
                        <button type="button" class="btn btn-primary my-0" onclick="doSettlement('<?=lang('Label.ps');?>',4);"><?=lang('Label.ps');?></button>
                        <button type="button" class="btn btn-primary my-0" onclick="doSettlement('<?=lang('Label.lossrebate');?>',6);"><?=lang('Label.lossrebate');?></button>
                        <button type="button" class="btn btn-primary my-0" onclick="doSettlement('<?=lang('Label.lossrebate');?>',8);"><?=lang('Label.affloserebate');?></button>
                        <!-- <button type="button" class="btn btn-primary my-0" onclick="doSettlement('<?//=lang('Label.ptps1');?>',9);"><?//=lang('Label.ptps1');?></button> -->
                        <!-- <button type="button" class="btn btn-primary my-0" onclick="doSettlement('<?//=lang('Label.ptps2');?>',10);"><?//=lang('Label.ptps2');?></button> -->
                    </div>
                </div>
            </div>

            <table id="settlementTable" class="w-100 nowrap table table-bordered table-hover">
                <thead class="table-style">
                <tr>
                <th><?=lang('Label.createddate');?></th>
                <th><?=lang('Input.types');?></th>
                <th><?=lang('Input.settledate');?></th>
                <th><?=lang('Input.status');?></th>
                <th class="none"><?=lang('Input.remark');?></th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </article>
    </div>
</section>

<section class="modal fade modal-settlement" id="modal-settlement" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-settlement" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.sysettlement');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate'],['type'=>'']);?>
                <div class="input-group mb-3">
                    <span class="input-group-text"><?=lang('Input.types');?></span>
                    <input type="text" class="form-control bg-white" name="settletype" readonly required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><?=lang('Input.settledate');?></span>
                    <input type="text" class="form-control bg-white" name="settledate" value="<?=date('Y-m-d',strtotime("-1 days"));?>" readonly required>
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

<section class="modal fade modal-superLock" id="modal-superLock" tabindex="-1" aria-labelledby="modal-superLock" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Please enter SuperLock</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate'],['type'=>'','settletype'=>'','settledate'=>'']);?>
                <div class="input-group mb-3">
                    <span class="input-group-text"><?=lang('Input.password');?></span>
                    <input type="text" class="form-control" name="superlock" required>
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

    airdatepicker();

    const fromdate = $('.filterForm [name=start]').val();
    const todate = $('.filterForm [name=end]').val();
    const type = $('.filterForm [name=type]').val();
    settlementTable(fromdate,todate,type);

    $('.filterForm').off().on('submit', function(e) {
        e.preventDefault();
        const fromdate = $('.filterForm [name=start]').val();
        const todate = $('.filterForm [name=end]').val();
        const type = $('.filterForm [name=type]').val();

        if (this.checkValidity() !== false) {
            settlementTable(fromdate,todate,type);
        }
    });

    $('.modal-settlement form').on('submit', function(e) {
        e.preventDefault();
        $('.modal-settlement form [type=submit]').prop('disabled',true);

        if (this.checkValidity() !== false) {
            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $('.modal-superLock').modal('show');
            $('.modal-superLock [name=type]').val(params['type']);
            $('.modal-superLock [name=settletype]').val(params['settletype']);
            $('.modal-superLock [name=settledate]').val(params['settledate']);
            $('.modal-settlement').modal('hide');
        }
    });

    // const settleEvent = document.getElementById('modal-settlement');
    // settleEvent.addEventListener('hidden.bs.modal', function (event) {
    //     $('.modal').find('form').removeClass('was-validated');
    //     $('.modal').find('form').trigger('reset');
    // });

    $('.modal-superLock form').on('submit', function(e) {
        e.preventDefault();
        $('.modal-superLock form [type=submit]').prop('disabled',true);

        if (this.checkValidity() !== false) {
            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/system/settlement/execute', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Done!", obj.message, "success").then(() => {
                        const fromdate = $('.filterForm [name=start]').val();
                        const todate = $('.filterForm [name=end]').val();
                        const type = $('.filterForm [name=type]').val();
                        settlementTable(fromdate,todate,type);
                    });
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal').modal('hide');
                $('.modal-settlement form [type=submit]').prop('disabled',false);
                $('.modal-superLock form [type=submit]').prop('disabled',false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    const superLockEvent = document.getElementById('modal-superLock');
    superLockEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });
});

function settlementTable(from,to,type)
{
    const settlementTable = $('#settlementTable').DataTable({
        dom: "<'row mb-3'<'col-xl-6 col-lg-6 col-md-6 col-12'l><'col-lg-6 col-md-6 col-12'f>>" + "<'row'<'col-12 overflow-auto'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
        responsive: {
            details: {
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table table-bordered'
                })
            }
        },
        ajax: {
            type : "POST",
            url: '/list/settlement/history',
            data: {"start": from, "end": to, "type": type},
            dataSrc: function(json) {
                if(json == "no data") {
                    return [];
                } else {
                    return json.data;
                }
            }
        },
        language: langs,
        paging: true,
        processing: true,
        stateSave: true,
        deferRender: true,
        destroy: true
    });

    settlementTable.draw();
}

function doSettlement(type,stype)
{
    $('.modal-settlement').modal('toggle');
    $('.modal-settlement [name=settletype]').val(type);
    $('.modal-settlement [name=type]').val(stype);
}
</script>