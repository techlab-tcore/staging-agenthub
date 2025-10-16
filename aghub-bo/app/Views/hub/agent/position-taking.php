<h4 class="p-3 bg-white fs-4"><?=$secTitle;?></h4>

<dl class="row mb-0 g-3">
    <dd class="col-xl-3 col-lg-3 col-md-3 col-12">
        <section class="card border-white shadow">
            <a class="card-header bg-white border-white text-decoration-none fw-bold text-dark d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href=".gamePt" aria-expanded="false" aria-controls="gamePt"><?=lang('Nav.gp');?><i class="las la-arrows-alt-v"></i></a>
            <div class="card-body gamePt collapse show">
                <article class="card-text">
                    <?=form_open('',['class'=>'form-validation modifyMasterGamePtForm', 'novalidate'=>'novalidate']);?>
                    <small><?=lang('Label.ptmastersetting');?></small>
                    <label class="form-label d-block fs-4 fw-bold"><?=lang('Nav.gp');?></label>
                    <input type="number" step="any" min="0" class="form-control" name="gamept" placeholder="0" required>
                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-primary"><?=lang('Nav.submit');?></button>
                    </div>
                    <?=form_close();?>
                </article>
            </div>
        </section>
    </dd>
</dl>

<section class="card shadow border-white mt-2">
    <a class="card-header bg-white border-white text-decoration-none fw-bold text-dark d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href=".providerpt" aria-expanded="false" aria-controls="providerpt"><?=lang('Nav.gp');?><i class="las la-arrows-alt-v"></i></a>
    <article class="card-body providerpt collapse">
        <table id="gameptTable" class="w-100 nowrap table table-bordered">
        <thead class="table-style">
            <tr>
            <th><?=lang('Label.games');?></th>
            <th><?=lang('Nav.positiontaking');?></th>
            <th><?=lang('Input.username');?></th>
            <th><?=lang('Label.modifieddate');?></th>
            <th><?=lang('Label.action');?></th>
            </tr>
        </thead>
        <tbody></tbody>
        </table>
    </article>
</section>

<!--
<section class="card shadow border-white mt-3">
    <a class="card-header bg-white border-white text-decoration-none fw-bold text-dark d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href=".ptcomm" aria-expanded="false" aria-controls="ptcomm"><?=lang('Label.agcomm');?><i class="las la-arrows-alt-v"></i></a>
    <article class="card-body ptcomm collapse">
        <table id="ptcommTable" class="w-100 nowrap table table-bordered">
        <thead class="table-style">
            <tr>
            <th><?=lang('Label.games');?></th>
            <th><?=lang('Label.agcomm');?></th>
            <th><?=lang('Input.username');?></th>
            <th><?=lang('Label.modifieddate');?></th>
            <th><?=lang('Label.action');?></th>
            </tr>
        </thead>
        <tbody></tbody>
        </table>
    </article>
</section>
-->

<section class="modal fade modal-modifyPT" id="modal-modifyPT" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-modifyPT" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Label.editpt');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation modifyPtForm', 'novalidate'=>'novalidate'], ['code'=>'']);?>
                <small><?=lang('Nav.positiontaking');?></small>
                <label class="form-label d-block fs-4 fw-bold gameName"></label>
                <div class="input-group">
                    <span class="input-group-text minGamePt">0</span>
                    <input type="number" step="any" min="0" class="form-control" name="gamept" required>
                    <span class="input-group-text maxGamePt">0</span>
                </div>
                <div class="d-grid gap-2 mt-3">
                    <button type="submit" class="btn btn-primary"><?=lang('Nav.submit');?></button>
                </div>
                <?=form_close();?>
            </div>
        </div>
    </div>
</section>

<section class="modal fade modal-modifyAgRebate" id="modal-modifyAgRebate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-modifyAgRebate" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Label.editpt');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation modifyAgRebatePtForm', 'novalidate'=>'novalidate'], ['code'=>'']);?>
                <small><?=lang('Nav.positiontaking');?></small>
                <label class="form-label d-block fs-4 fw-bold gameName"></label>
                <div class="input-group">
                    <span class="input-group-text minGamePt">0</span>
                    <input type="number" step="any" min="0" class="form-control" name="gamept" required>
                    <span class="input-group-text maxGamePt">0</span>
                </div>
                <div class="d-grid gap-2 mt-3">
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

    // generalLoading();

    const gameptTable = $('#gameptTable').DataTable({
        dom: "<'row mb-3'<'col-lg-6 col-md-6 col-12 d-lg-block d-md-block d-none'l><'col-lg-6 col-md-6 col-12'f>>" + "<'row'<'col-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        ajax: {
            type : "POST",
            url: "/list/game-provider/position-taking",
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
                    tableClass: 'nowrap table table-bordered'
                })
            }
        },
        language: langs,
        retrieve: true,
        processing: true,
        stateSave: true,
        deferRender: true,
        destroy: true
    });

    const modifyPTEvent = document.getElementById('modal-modifyPT');
    modifyPTEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
        $('.minGamePt').html('0');
        $('.maxGamePt').html('0');
    });

    $('.modal-modifyPT form').on('submit', function(e) {
        e.preventDefault();
    
        var params = {};
        var formObj = $(this).closest("form");
        $.each($(formObj).serializeArray(), function (index, value) {
            params[value.name] = value.value;
            params['uid'] = '<?=$parent;?>';
        });

        if (this.checkValidity() !== false) {
            $('.modal-modifyPT form [type=submit]').prop('disabled',true);

            $.post('/game-provider/position-taking/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                // console.log(obj);
                if( obj.code == 1 ) {
                    swal.fire("Success!", obj.message, "success").then(() => { $('#gameptTable').DataTable().ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-modifyPT').modal('toggle');
                $('.modal-modifyPT form [type=submit]').prop('disabled',false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    $('.modifyMasterGamePtForm').on('submit', function(e) {
        e.preventDefault();
    
        var params = {};
        var formObj = $(this).closest("form");
        $.each($(formObj).serializeArray(), function (index, value) {
            params[value.name] = value.value;
            params['uid'] = '<?=$parent;?>';
        });

        if (this.checkValidity() !== false) {
            $('.modifyMasterGamePtForm [type=submit]').prop('disabled',true);

            $.post('/game-provider/position-taking/master/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                // console.log(obj);
                if( obj.code == 1 ) {
                    swal.fire("Success!", obj.message, "success").then(() => { $('#gameptTable').DataTable().ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modifyMasterGamePtForm [type=submit]').prop('disabled',false);
                $('.modifyMasterGamePtForm').removeClass('was-validated');
                $('.modifyMasterGamePtForm').trigger('reset');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => { $('.modifyMasterGamePtForm [type=submit]').prop('disabled',false); });
            });
        }
    });
});
</script>