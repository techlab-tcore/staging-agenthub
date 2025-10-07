<section class="card border-light">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <div class="px-3">
            <?=form_open('', ['class'=>'row gy-2 gx-3 align-items-center configForm', 'novalidate'=>'novalidate']);?>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-addafflevel"><?=lang('Nav.addafflevel');?></button>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <div class="input-group">
                    <span class="input-group-text"><?=lang('Input.maxeffectdays');?></span>
                    <input type="number" min="0" max="30" class="form-control" name="max_day" required>
                </div>
            </div>
            <!-- <div class="col-xl-auto col-lg-auto col-md-auto col-12 mt-0 mb-3">
                <div class="input-group">
                    <span class="input-group-text"><?//=lang('Input.affceiling');?></span>
                    <input type="number" step="any" min="0" class="form-control" name="max_affiliate" required>
                </div>
            </div> -->
            <!-- <div class="col-xl-auto col-lg-auto col-md-auto col-12 mt-0 mb-3">
                <div class="input-group">
                    <span class="input-group-text"><?//=lang('Label.chip');?></span>
                    <input type="number" step="any" min="0" class="form-control" name="chip" required>
                    <span class="input-group-text">%</span>
                </div>
            </div> -->
            <!-- <div class="col-xl-auto col-lg-auto col-md-auto col-12 mt-0 mb-3">
                <div class="input-group">
                    <span class="input-group-text"><?//=lang('Label.chipgroup');?></span>
                    <input type="text" class="form-control" name="chipgroup">
                </div>
            </div> -->
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <button type="submit" class="btn btn-primary w-100"><?=lang('Nav.submit');?></button>
            </div>
            <?=form_close();?>
        </div>

        <article class="card-text p-3">
            <table id="affiliateTable" class="w-100 nowrap table table-sm table-bordered table-hover">
                <thead class="table-style">
                <tr>
                <th><?=lang('Input.level');?></th>
                <th><?=lang('Label.games');?></th>
                <th><?=lang('Input.category');?></th>
                <th><?=lang('Input.rate');?> (%)</th>
                <!-- <th>[<?//=lang('Label.deposit');?>] <?//=lang('Input.rate');?> (%)</th> -->
                <th><?=lang('Label.action');?></th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </article>
    </div>
</section>

<section class="modal fade modal-addafflevel" id="modal-addafflevel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-addafflevel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.addafflevel');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate']);?>
                <div class="mb-3">
                    <label><?=lang('Input.level');?></label>
                    <input type="number" min="0" class="form-control" name="level" required>
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

<section class="modal fade modal-modifyAff" id="modal-modifyAff" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-modifyAff" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.editaffsetting');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate'], ['provider'=>'', 'category'=>'']);?>
                <div class="mb-3">
                    <label><?=lang('Input.level');?></label>
                    <input type="number" min="0" class="form-control" name="level" readonly required>
                </div>
                <div class="mb-3">
                    <label class="d-block"><?=lang('Input.caltypes');?></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="calculate" id="betAffCal" value="1" checked>
                        <label class="form-check-label" for="betAffCal"><?=lang('Label.turnover');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="calculate" id="depositAffCal" value="2" disabled>
                        <label class="form-check-label" for="depositAffCal"><?=lang('Label.deposit');?></label>
                    </div>
                </div>
                <div class="mb-3">
                    <label><?=lang('Input.rate');?> (%)</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">0</span>
                        <input type="number" step="any" min="0" max="100" class="form-control" name="rate" required>
                        <span class="input-group-text">100</span>
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

    const affiliateTable = $('#affiliateTable').DataTable({
        dom: "<'row mb-3'<'col-xl-6 col-lg-6 col-md-6 col-12'l><'col-xl-6 col-lg-6 col-md-6 col-12'f>>" + "<'row'<'col-12 overflow-auto'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
        ajax: {
            type : "GET",
            contentType: "application/json; charset=utf-8",
            url: "/list/settings/affiliate",
            dataSrc: function(json) {
                if(json == "no data") {
                    return [];
                } else {
                    return json.data;
                }
            }
        },
        // responsive: {
        //     details: {
        //         renderer: $.fn.dataTable.Responsive.renderer.tableAll({
        //             tableClass: 'w-100 nowrap table table-sm table-bordered'
        //         })
        //     }
        // },
        language: langs,
        processing: true,
        stateSave: true,
        deferRender: true
    });

    preloadAffiliateDepositSettings();

    $('.configForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/settings/affiliate/ceiling/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { preloadAffiliateDepositSettings(); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.configForm').removeClass('was-validated');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    $('.modal-addafflevel form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/settings/affiliate/level/add', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { affiliateTable.ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-addafflevel').modal('toggle');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    const addafflevelEvent = document.getElementById('modal-addafflevel');
    addafflevelEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });

    $('.modal-modifyAff form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/settings/affiliate/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { affiliateTable.ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-modifyAff').modal('toggle');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    const modifyAffEvent = document.getElementById('modal-modifyAff');
    modifyAffEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });
});

function modifyAff(level,code,category)
{
    $('.modal-modifyAff').modal('toggle');
    $('.modal-modifyAff [name=level]').val(level);
    $('.modal-modifyAff [name=provider]').val(code);
    $('.modal-modifyAff [name=category]').val(category);
}

function preloadAffiliateDepositSettings()
{
    $.get('/settings/affiliate/ceiling', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            $('.configForm [name=max_day]').val(obj.maxday);
            $('.configForm [name=max_affiliate]').val(obj.maxaffiliate);
            $('.configForm [name=chip]').val(obj.chippercent4deposit);
            $('.configForm [name=chipgroup]').val(obj.groupname);
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