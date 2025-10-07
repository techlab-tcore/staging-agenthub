<div class="card border-light">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <article class="card-text p-3">

            <?=form_open('', ['class'=>'row row-cols-lg-auto g-3 align-items-center filterForm pb-2', 'novalidate'=>'novalidate']);?>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <div class="input-group">
                    <span class="input-group-text"><?=lang('Input.from');?></span>
                    <input type="text" class="form-control bg-white" name="start" value="<?=date('Y-m-d');?>" readonly>
                </div>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <div class="input-group">
                    <span class="input-group-text"><?=lang('Input.to');?></span>
                    <input type="text" class="form-control bg-white" name="end" value="<?=date('Y-m-d');?>" readonly>
                </div>
            </div>
            <!--
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <div class="input-group">
                    <span class="input-group-text"><?//=lang('Label.games');?></span>
                    <select class="form-select" id="gameprovider" name="gameprovider"></select>
                </div>
            </div>
            -->
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <button type="submit" class="btn btn-primary w-100"><?=lang('Nav.search');?></button>
            </div>
            <?=form_close();?>

            <table id="paymentTable" class="w-100 nowrap table table-sm table-bordered table-hover">
                <thead class="table-style">
                <tr>
                <th><?=lang('Label.createddate');?></th>
                <th><?=lang('Input.username');?></th>
                <th><?=lang('Label.games');?></th>
                <th><?=lang('Label.roundid');?></th>
                <th><?=lang('Label.turnover');?></th>
                <th><?=lang('Label.effectbet');?></th>
                <th><?=lang('Label.win');?></th>
                <th><?=lang('Label.winlose');?></th>
                <th class="none"><?=lang('Label.jpwin');?></th>
                <th class="none"><?=lang('Label.jpshare');?></th>
                </tr>
                </thead>
                <tfoot class="table-style">
                <tr>
                <th colspan="4" class="text-end"><?=lang('Label.totalamt');?>:</th>
                <th class="text-end">&nbsp;</th>
                <th class="text-end">&nbsp;</th>
                <th class="text-end">&nbsp;</th>
                <th class="text-end">&nbsp;</th>
                <th class="text-end">&nbsp;</th>
                <th class="text-end">&nbsp;</th>
                </tr>
                </tfoot>
                <tbody></tbody>
            </table>

        </article>
    </div>
</div>

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
    gameProviderList('gameprovider');

    var pageindex = 1, debug = false;
    const paymentTable = $('#paymentTable').DataTable({
        dom: "<'row'<'col-12 overflow-auto'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
        // responsive: {
        //     details: {
        //         renderer: $.fn.dataTable.Responsive.renderer.tableAll({
        //             tableClass: 'table table-bordered'
        //         })
        //     }
        // },
        language: langs,
        ordering: false,
        deferRender: true,
        serverSide: true,
        processing: true,
        destroy: true,
        pageLength: 20,
        ajax: function(data, callback, settings) {
            if (settings._iRecordsTotal == 0) {
                pageindex = 1;
            } else {
                var pageindex = settings._iDisplayStart/settings._iDisplayLength + 1;
            }

            const fromdate = $('.filterForm [name=start]').val();
            const todate = $('.filterForm [name=end]').val();
            // const gp = $('.filterForm [name=gameprovider]').val()==null ? 'ALL' : $('.filterForm [name=gameprovider]').val();
            
            var payload = JSON.stringify({
                pageindex: pageindex,
                rowperpage: data.length,
                start: fromdate,
                end: todate,
                parent: '<?=$parent;?>',
                // provider: gp
            });
            $.ajax({
                url: '/list/bet/log/reference',
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
        footerCallback: function ( row, data, start, end, display ) {
            var api = this.api(), data;
            var intVal = function(i){ return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1 : typeof i === 'number' ? i : 0; };

            // var grandtotal = api.column(17).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            // var totalOverPage = api.column(4, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);

            var totalOverPage = api.column(4).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            var truncate = parseFloat(totalOverPage).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            var sum = parseFloat(truncate) < 0 ? '<span class="text-danger">'+truncate+'</span>' : truncate;
            $(api.column(4).footer()).html(sum);

            var totalOverPage2 = api.column(5).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            var truncate2 = parseFloat(totalOverPage2).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            var sum2 = parseFloat(truncate2) < 0 ? '<span class="text-danger">'+truncate2+'</span>' : truncate2;
            $(api.column(5).footer()).html(sum2);

            var totalOverPage3 = api.column(6).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            var truncate3 = parseFloat(totalOverPage3).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            var sum3 = parseFloat(truncate3) < 0 ? '<span class="text-danger">'+truncate3+'</span>' : truncate3;
            $(api.column(6).footer()).html(sum3);

            var totalOverPage4 = api.column(7).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            var truncate4 = parseFloat(totalOverPage4).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            var sum4 = parseFloat(truncate4) < 0 ? '<span class="text-danger">'+truncate4+'</span>' : truncate4;
            $(api.column(7).footer()).html(sum4);

            var totalOverPage5 = api.column(8).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            var truncate5 = parseFloat(totalOverPage5).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            var sum5 = parseFloat(truncate5) < 0 ? '<span class="text-danger">'+truncate5+'</span>' : truncate5;
            $(api.column(8).footer()).html(sum5);

            var totalOverPage6 = api.column(9).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            var truncate6 = parseFloat(totalOverPage6).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            var sum6 = parseFloat(truncate6) < 0 ? '<span class="text-danger">'+truncate6+'</span>' : truncate6;
            $(api.column(9).footer()).html(sum6);
        },
        drawCallback: function(oSettings, json) {
            $('#paymentTable tbody tr td.dataTables_empty').removeClass('text-end');
            $('#paymentTable tbody tr').find('td').not('td:first-child,td:nth-child(2),td:nth-child(3),td:nth-child(4)').addClass('text-end');
        },
        aoColumnDefs: [{
            aTargets: [4,5,6,7,8,9],
            render: function ( data, type, row ) {
                return parseFloat(data).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            },
            fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                parseFloat(sData) < 0 ? $(nTd).addClass('text-danger') : '';
            }
        }]
    });

    $('.filterForm').off().on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            paymentTable.draw();
        }
    });
});
</script>