<div class="card border-light shadow">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <article class="card-text p-3">

            <?=form_open('', ['class'=>'row gy-2 gx-3 align-items-center filterForm pb-2', 'novalidate'=>'novalidate']);?>
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
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <button type="submit" class="btn btn-primary w-100"><?=lang('Nav.search');?></button>
            </div>
            <?=form_close();?>

            <table id="refcommTable" class="w-100 nowrap table table-sm table-bordered table-hover">
            <thead class="table-style">
                <tr>
                <th><?=lang('Label.createddate');?></th>
                <th><?=lang('Input.status');?></th>
                <th><?=lang('Input.username');?></th>
                <th><?=lang('Input.fname');?></th>
                <th><?=lang('Input.chipgroup');?></th>
                <th><?=lang('Label.balance');?></th>
                <th><?=lang('Label.cash');?></th>
                <th><?=lang('Label.chip');?></th>
                </tr>
            </thead>
            <tfoot class="table-style">
                <tr>
                <th colspan="5" class="text-end"><?=lang('Label.totalamt');?>:</th>
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

    var pageindex = 1, debug = false;
    const refcommTable = $('#refcommTable').DataTable({
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
        ajax: function(data, callback, settings) {
            if (settings._iRecordsTotal == 0) {
                pageindex = 1;
            } else {
                var pageindex = settings._iDisplayStart/settings._iDisplayLength + 1;
            }

            const fromdate = $('.filterForm [name=start]').val();
            const todate = $('.filterForm [name=end]').val();
            
            var payload = JSON.stringify({
                pageindex: pageindex,
                rowperpage: data.length,
                start: fromdate,
                end: todate,
                parent: '<?=$parent;?>'
            });
            $.ajax({
                url: '/list/report/referral-deposit-commission',
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
        drawCallback: function(oSettings, json) {
            $('#refcommTable tbody tr').find('td').not('td:first-child,td:nth-child(2),td:nth-child(3),td:nth-child(4),td:nth-child(5)').addClass('text-end');
            $('#refcommTable tbody tr td.dataTables_empty').removeClass('text-end');
        },
        footerCallback: function ( row, data, start, end, display ) {
            var api = this.api(), data;
            var intVal = function(i){ return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1 : typeof i === 'number' ? i : 0; };

            var subtotal = api.column(5, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            $(api.column(5).footer()).html(parseFloat(subtotal).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,"));

            var subtotal2 = api.column(6, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            $(api.column(6).footer()).html(parseFloat(subtotal2).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,"));

            var subtotal3 = api.column(7, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            $(api.column(7).footer()).html(parseFloat(subtotal3).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,"));
        },
        aoColumnDefs: [{
            aTargets: [5,6,7],
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
            refcommTable.draw();
        }
    });
});
</script>