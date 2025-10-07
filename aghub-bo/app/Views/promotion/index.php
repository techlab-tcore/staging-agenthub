<section class="card border-light">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <div class="px-3 pb-3">
            <a class="btn btn-primary me-1" href="<?=base_url('settings/open-promotion/add');?>"><?=lang('Nav.addpromo');?></a>
            <a class="btn btn-primary" href="<?=base_url('settings/contents/add');?>"><?=lang('Nav.addreadonlypromo');?></a>
            <a class="btn btn-primary me-1" href="<?=base_url('settings/contents/afflb/add');?>"><?=lang('Nav.addreadonlyafflb');?></a>
        </div>

        <div class="card-text p-3">
            <nav class="nav nav-tabs">
                <a class="nav-link active" id="en-tab" data-bs-toggle="tab" data-bs-target="#tab-promo" aria-controls="tab-promo" aria-selected="true" href="javascript:void(0);"><?=lang('Label.promotion');?></a>
                <a class="nav-link" id="my-tab" data-bs-toggle="tab" data-bs-target="#tab-promoRead" aria-controls="tab-promoRead" aria-selected="false" href="javascript:void(0);"><?=lang('Label.readonlypromo');?></a>
                <a class="nav-link" id="my-tab" data-bs-toggle="tab" data-bs-target="#tab-promoReadAffLB" aria-controls="tab-promoReadAffLB" aria-selected="false" href="javascript:void(0);"><?=lang('Label.readonlyaddlb');?></a>
            </nav>
            <dl class="tab-content mt-2">
                <dd class="tab-pane fade show active" id="tab-promo" role="tabpanel">
                    <article class="p-3">
                        <table id="promotionTable" class="w-100 table table-sm table-bordered table-hover">
                        <thead class="table-style">
                        <tr>
                        <th><?=lang('Input.status');?></th>
                        <th><?=lang('Input.specialpromo');?></th>
                        <th><?=lang('Input.targetpromo');?></th>
                        <th><?=lang('Input.title');?></th>
                        <th class="none"><?=lang('Input.randamt');?></th>
                        <th class="none"><?=lang('Input.bonus');?>%/<?=lang('Input.extamount');?>/<?=lang('Input.tomax');?></th>
                        <th class="none"><?=lang('Input.rollover');?></th>
                        <th class="none"><?=lang('Input.minturnover');?></th>
                        <th class="none"><?=lang('Label.depositcondition');?></th>
                        <th class="none"><?=lang('Input.maxbonus');?></th>
                        <th class="none"><?=lang('Input.effectdate');?></th>
                        <th class="none"><?=lang('Input.expiredate');?></th>
                        <th class="none"><?=lang('Input.resitmode');?></th>
                        <th class="none"><?=lang('Input.numberclaim');?></th>
                        <th class="none"><?=lang('Input.continueclaim');?></th>
                        <th class="none"><?=lang('Label.onceonly');?></th>
                        <th class="none"><?=lang('Label.onceperweek');?></th>
                        <th class="none"><?=lang('Label.oncepermonth');?></th>
                        <th class="none"><?=lang('Label.onceperday');?></th>
                        <th class="none"><?=lang('Label.specificdays');?></th>
                        <th class="none"><?=lang('Label.deposit');?></th>
                        <th class="none"><?=lang('Label.withdrawal');?></th>
                        <th><?=lang('Input.order');?></th>
                        <th class="none"><?=lang('Label.modifieddate');?></th>
                        <th><?=lang('Label.action');?></th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                        </table>
                    </article>
                </dd>
                <dd class="tab-pane fade" id="tab-promoRead" role="tabpanel">
                    <article class="p-3">
                        <table id="contentTable" class="w-100 table table-sm table-bordered table-hover">
                        <thead class="table-style">
                        <tr>
                        <th>#ID</th>
                        <th><?=lang('Input.title');?></th>
                        <th><?=lang('Input.image');?></th>
                        <th class="none"><?=lang('Input.content');?></th>
                        <th><?=lang('Label.action');?></th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                        </table>
                    </article>
                </dd>
                <dd class="tab-pane fade" id="tab-promoReadAffLB" role="tabpanel">
                    <article class="p-3">
                        <table id="contentAffLBTable" class="w-100 table table-sm table-bordered table-hover">
                        <thead class="table-style">
                        <tr>
                        <th>#ID</th>
                        <th><?=lang('Input.title');?></th>
                        <th><?=lang('Input.image');?></th>
                        <th class="none"><?=lang('Input.content');?></th>
                        <th><?=lang('Label.action');?></th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                        </table>
                    </article>
                </dd>
            </dl>
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

    const promotionTable = $('#promotionTable').DataTable({
        dom: "<'row mb-3'<'col-xl-6 col-lg-6 col-md-6 col-12'l><'col-xl-6 col-lg-6 col-md-6 col-12'f>>" + "<'row'<'col-12 overflow-auto'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
        ajax: {
            type : "GET",
            contentType: "application/json; charset=utf-8",
            url: "/list/settings/promotion",
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
        deferRender: true,
        // aoColumnDefs: [{
        //     aTargets: [8],
        //     render: function ( data, type, row ) {
        //         return parseFloat(data).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
        //     }
        // }]
    });

    const contentTable = $('#contentTable').DataTable({
        dom: "<'row mb-3'<'col-xl-6 col-lg-6 col-md-6 col-12'l><'col-xl-6 col-lg-6 col-md-6 col-12'f>>" + "<'row'<'col-12 overflow-auto'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
        ajax: {
            type : "GET",
            contentType: "application/json; charset=utf-8",
            url: "/list/promotion/read-only/content",
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
                    tableClass: 'w-100 table table-sm table-bordered'
                })
            }
        },
        language: langs,
        processing: true,
        stateSave: true,
        deferRender: true
    });

    const contentAffLBTable = $('#contentAffLBTable').DataTable({
        dom: "<'row mb-3'<'col-xl-6 col-lg-6 col-md-6 col-12'l><'col-xl-6 col-lg-6 col-md-6 col-12'f>>" + "<'row'<'col-12 overflow-auto'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
        ajax: {
            type : "GET",
            contentType: "application/json; charset=utf-8",
            url: "/list/promotion/read-only/afflb-content",
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
                    tableClass: 'w-100 table table-sm table-bordered'
                })
            }
        },
        language: langs,
        processing: true,
        stateSave: true,
        deferRender: true
    });
});

function modifyPromoStatus(promoId, status)
{
    var params = {};
    params['promoid'] = promoId;
    params['status'] = status;

    $.post('/promotion/status/change', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            alertToast('bg-success', obj.message);
            $('#promotionTable').DataTable().ajax.reload(null,false);
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            alertToast('bg-danger', obj.message);
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => { $('#memberTable').DataTable().ajax.reload(null,false); });
    });
}
</script>