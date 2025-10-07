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
                <div class="input-group">
                    <span class="input-group-text">Ref</span>
                    <input type="text" class="form-control" name="jackpotid">
                </div>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <button type="submit" class="btn btn-primary w-100"><?=lang('Nav.search');?></button>
            </div>
            <?=form_close();?>

            <table id="jackpotTable" class="w-100 nowrap table table-sm table-bordered table-hover">
            <thead class="table-style">
                <tr>
                <th><?=lang('Label.createddate');?></th>
                <th><?=lang('Label.windate');?></th>
                <th><?=lang('Input.jackpotname');?></th>
                <th><?=lang('Input.username');?></th>
                <th><?=lang('Label.chip');?></th>
                <th><?=lang('Label.cash');?></th>
                <th><?=lang('Input.amount');?></th>
                </tr>
            </thead>
            <tfoot class="table-style">
                <tr>
                <th class="text-end" colspan="6"><?=lang('Label.totalamt');?>:</th>
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
    const jackpotTable = $('#jackpotTable').DataTable({
        dom: "<'row'<'col-12 overflow-auto'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
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
            const id = $('.filterForm [name=jackpotid]').val();
            
            var payload = JSON.stringify({
                pageindex: pageindex,
                rowperpage: data.length,
                start: fromdate,
                end: todate,
                parent: '<?=$parent;?>',
                jackpotid: id
            });
            $.ajax({
                url: '/list/report/jackpot',
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

            // var totalOverAllPage = api.column(5).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            // var totalOverPage = api.column(5, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            // $(api.column(5).footer()).html('<span class="text-primary">' + totalOverPage.toFixed(2) +' ('+ totalOverAllPage.toFixed(2) +')</span>');

            var totalOverAllPage = api.column(6).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            let truncate = totalOverAllPage.toFixed(5).toString().match(/^-?\d+(?:\.\d{0,2})?/)[0];
            var sum = totalOverAllPage < 0 ? '<span class="text-danger">'+truncate+'</span>' : truncate;
            $(api.column(6).footer()).html(sum.replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        },
        drawCallback: function(oSettings, json) {
            $('#jackpotTable tbody tr td.dataTables_empty').removeClass('text-end');
            $('#jackpotTable tbody tr').find('td:nth-child(7)').addClass('text-end');
        },
        aoColumnDefs: [{
            aTargets: [5,6],
            render: function ( data, type, row ) {
                return parseFloat(data).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            }
        }]
    });

    $('.filterForm').off().on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            jackpotTable.draw();
        }
    });
});
</script>