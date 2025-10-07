<section class="card border-light">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <!--
        <div class="px-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-addgp"><i class="las la-plus-circle me-1"></i><?//=lang('Nav.addgp');?></button>
        </div>
        -->

        <table id="gpTable" class="w-100 table table-sm table-bordered table-hover">
            <thead class="table-style">
            <tr>
            <th><?=lang('Input.status');?></th>
            <th><?=lang('Label.games');?></th>
            <th><?=lang('Input.category');?></th>
            <th class="none"><?=lang('Input.gpfee');?>%</th>
            <th class="none"><?=lang('Label.chip').'%/'.lang('Input.affceiling');?></th>
            <th class="none"><?=lang('Input.chipgroup');?></th>
            <th class="none"><?=lang('Label.lossrebate');?></th>
            <th class="none"><?=lang('Label.chip').'%/'.lang('Input.lossrebceiling');?></th>
            <th><?=lang('Input.order');?></th>
            <th><?=lang('Label.action');?></th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</section>

<section class="modal fade modal-addgp" id="modal-addgp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-addgp" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.addgp');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate']);?>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-12">
                        <label><?=lang('Input.diminisher');?></label>
                        <input type="number" step="any" min="1" class="form-control" name="gpdiminisher" value="1" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-12">
                        <label><?=lang('Input.gpcode');?></label>
                        <input type="text" class="form-control" name="gpcode" required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <label><?=lang('Input.gpname');?></label>
                        <input type="text" class="form-control" name="gpen" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-12">
                        <label><?=lang('Input.affceiling');?></label>
                        <input type="number" step="any" min="0" class="form-control" name="gpaffcap" required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <label><?=lang('Label.chippercent');?></label>
                        <input type="number" step="any" min="0" class="form-control" name="gpaffchiprate" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-12">
                        <label><?=lang('Input.gpfee');?>%</label>
                        <input type="number" step="any" min="0" class="form-control" name="providerfee" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label><?=lang('Input.chipgroup');?></label>
                    <input type="text" class="form-control" name="gpchipgroup">
                </div>
                <div class="mb-3">
                    <label><?=lang('Input.category');?></label>
                    <div id="cateList"></div>
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

<section class="modal fade modal-modifyGP" id="modal-modifyGP" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-modifyGP" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.edit');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate']);?>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-12">
                        <label><?=lang('Input.diminisher');?></label>
                        <input type="number" step="any" min="1" class="form-control" name="diminisher" value="1" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-12">
                        <label><?=lang('Input.gpcode');?></label>
                        <input type="text" class="form-control" name="code" readonly required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <label><?=lang('Input.gpname');?></label>
                        <input type="text" class="form-control" name="en" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-12">
                        <label><?=lang('Input.affceiling');?></label>
                        <input type="number" step="any" min="0" class="form-control" name="affcap" required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <label><?=lang('Label.chip');?></label>
                        <div class="input-group">
                            <input type="number" step="any" min="0" class="form-control" name="affchiprate" required>
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-12">
                        <label><?=lang('Input.gpfee');?></label>
                        <div class="input-group">
                            <input type="number" step="any" min="0" class="form-control" name="gpfee" required>
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 gporder">
                        <label><?=lang('Input.order');?></label>
                        <input type="number" step="any" min="0" class="form-control" name="order" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label><?=lang('Input.chipgroup');?></label>
                    <input type="text" class="form-control" name="chipgroup">
                </div>
                <hr>
                <h4><?=lang('Label.lossrebate');?></h4>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-12">
                        <label><?=lang('Input.lossrebceiling');?></label>
                        <input type="number" step="any" min="0" class="form-control" name="maxLossRebate" required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 gporder">
                        <label><?=lang('Label.lossrebate');?></label>
                        <div class="input-group">
                            <input type="number" step="any" min="0" class="form-control" name="lossRebateRate" required>
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-12">
                        <label><?=lang('Label.chip');?></label>
                        <div class="input-group">
                            <input type="number" step="any" min="0" class="form-control" name="lossRebateToChip" required>
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="mb-3">
                    <label><?=lang('Input.categorydisplay');?></label>
                    <div id="cateList-display"></div>
                </div>
                <hr>
                <div class="mb-3">
                    <label><?=lang('Input.category');?></label>
                    <div id="cateList2"></div>
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

    const gpTable = $('#gpTable').DataTable({
        dom: "<'row mb-3'<'col-xl-6 col-lg-6 col-md-6 col-12'l><'col-xl-6 col-lg-6 col-md-6 col-12'f>>" + "<'row'<'col-12'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
        ajax: {
            type : "GET",
            contentType: "application/json; charset=utf-8",
            url: "/list/game-provider/all",
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
                    tableClass: 'w-100 nowrap table table-sm table-bordered'
                })
            }
        },
        language: langs,
        processing: true,
        stateSave: true,
        deferRender: true
    });

    const addgpEvent = document.getElementById('modal-addgp');
    addgpEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
        document.getElementById("cateList").innerHTML = '';
    });
    addgpEvent.addEventListener('shown.bs.modal', function (event) {
        getGameCategoryList('cateList');
    });

    const modifyGPEvent = document.getElementById('modal-modifyGP');
    modifyGPEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
        document.getElementById("cateList2").innerHTML = '';
        document.getElementById("cateList-display").innerHTML = '';
    });
    modifyGPEvent.addEventListener('shown.bs.modal', function (event) {
        getGameCategoryDisplayList('cateList-display');
    });

    $('.modal-addgp form').on('submit', function(e) {
        e.preventDefault();

        const category = [];
        $.each($('.modal-addgp [name=gcate]:checked'), function() {
            category.push($(this).val());
        });

        if (this.checkValidity() !== false) {

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/game-provider/add', {
                params, category
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { gpTable.ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-addgp').modal('toggle');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    $('.modal-modifyGP form').on('submit', function(e) {
        e.preventDefault();

        const category = [];
        $.each($('.modal-modifyGP [name=gcate]:checked'), function() {
            category.push($(this).val());
        });

        const categoryDisplay = [];
        $.each($('.modal-modifyGP [name=gcatedisplay]:checked'), function() {
            categoryDisplay.push($(this).val());
        });

        if (this.checkValidity() !== false) {

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/game-provider/modify', {
                params, category, categoryDisplay
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { gpTable.ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-modifyGP').modal('toggle');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });
});

function modifyGP(code,list,displayList)
{
    $('.modal-modifyGP').modal('toggle');
    getGameCategoryList('cateList2');

    generalLoading();

    var params = {};
    params['gpcode'] = code;

    $.post('/game-provider/get', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            var affToChipRate, gpRent, lossRebToChipRate;
            if( obj.data.affiliateToWalletPercentage==null || obj.data.affiliateToWalletPercentage=='' ) {
                affToChipRate = 0;
            } else {
                affToChipRate = obj.data.affiliateToWalletPercentage[obj.data.affiliateToWalletPercentage.length-1].percentage;
            }

            if( obj.data.ptRent==null || obj.data.ptRent=='' ) {
                gpRent = 0;
            } else {
                gpRent = obj.data.ptRent[obj.data.ptRent.length-1].percentage;
            }

            if( obj.data.winloseRebateToWalletPercentage==null || obj.data.winloseRebateToWalletPercentage=='' ) {
                lossRebToChipRate = 0;
            } else {
                lossRebToChipRate = obj.data.winloseRebateToWalletPercentage[obj.data.winloseRebateToWalletPercentage.length-1].percentage;
            }

            document.getElementsByName("code")[0].value = obj.data.code;
            document.getElementsByName("en")[0].value = obj.data.name.EN;
            document.getElementsByName("affcap")[0].value = obj.data.maxAffiliate;
            document.getElementsByName("affchiprate")[0].value = affToChipRate;
            document.getElementsByName("order")[0].value = obj.data.order;
            document.getElementsByName("gpfee")[0].value = gpRent;
            document.getElementsByName("chipgroup")[0].value = obj.data.affToGroupName;
            document.getElementsByName("maxLossRebate")[0].value = obj.data.maxWinloseRebate;
            document.getElementsByName("lossRebateRate")[0].value = obj.data.winloseRebatePercentage;
            document.getElementsByName("lossRebateToChip")[0].value = lossRebToChipRate;
            document.getElementsByName("diminisher")[0].value = obj.data.diminisher;

            // $('#cateList2 [name=gcate]').prop('disabled',true);
            setTimeout(function(){
                $('#cateList2 [name=gcate]').prop('disabled',true);
            }, 3000);
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => { $('.modal-modifyGP').modal('hide'); });
        }
    })
    .done(function() {
        setTimeout(function(){
            checkOccupied(list);
            checkDisplayOccupied(displayList);
            swal.close();
        }, 1100); 
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function status(code,status)
{
    var params = {};
    params['code'] = code;
    params['status'] = status;

    $.post('/game-provider/status/modify', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            swal.fire("Updated!", obj.message , "success").then(() => { $('#gpTable').DataTable().ajax.reload(null,false); });
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

function checkDisplayOccupied(list)
{
    const arr = JSON.parse(list);

    arr.forEach(item => {
        if( item==1 ) {
            // document.getElementById("SLOT").checked = true;
            $('.modal-modifyGP [name=gcatedisplay]#SLOT').prop('checked',true);
        }
        if( item==2 ) { $('.modal-modifyGP [name=gcatedisplay]#CASINO').prop('checked',true); }
        if( item==3 ) { $('.modal-modifyGP [name=gcatedisplay]#SPORTBOOK').prop('checked',true); }
        if( item==4 ) { $('.modal-modifyGP [name=gcatedisplay]#KENO').prop('checked',true); }
        if( item==5 ) { $('.modal-modifyGP [name=gcatedisplay]#LOTTERY').prop('checked',true); }
        if( item==6 ) { $('.modal-modifyGP [name=gcatedisplay]#FISHING').prop('checked',true); }
        if( item==7 ) { $('.modal-modifyGP [name=gcatedisplay]#OTHER').prop('checked',true); }
        if( item==8 ) { $('.modal-modifyGP [name=gcatedisplay]#ESPORT').prop('checked',true); }
    });
}

function checkOccupied(list)
{
    const arr = JSON.parse(list);

    arr.forEach(item => {
        if( item==1 ) {
            // document.getElementById("SLOT").checked = true;
            $('.modal-modifyGP [name=gcate]#SLOT').prop('checked',true);
        }
        if( item==2 ) { $('.modal-modifyGP [name=gcate]#CASINO').prop('checked',true); }
        if( item==3 ) { $('.modal-modifyGP [name=gcate]#SPORTBOOK').prop('checked',true); }
        if( item==4 ) { $('.modal-modifyGP [name=gcate]#KENO').prop('checked',true); }
        if( item==5 ) { $('.modal-modifyGP [name=gcate]#LOTTERY').prop('checked',true); }
        if( item==6 ) { $('.modal-modifyGP [name=gcate]#FISHING').prop('checked',true); }
        if( item==7 ) { $('.modal-modifyGP [name=gcate]#OTHER').prop('checked',true); }
        if( item==8 ) { $('.modal-modifyGP [name=gcate]#ESPORT').prop('checked',true); }
    });
}
</script>