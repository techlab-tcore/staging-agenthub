<section class="card border-light">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?> - <?=$currencycode;?></h4>
    <div class="card-body">
        <article class="card-text p-3">

            <?=form_open('', ['class'=>'row row-cols-lg-auto g-3 align-items-center filterForm pb-2', 'novalidate'=>'novalidate']);?>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12 mt-0 mb-3">
                <div class="input-group">
                    <span class="input-group-text">From</span>
                    <input type="text" class="form-control bg-white" name="start" value="<?=date('Y-m-d');?>" readonly>
                </div>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12 mt-0 mb-3">
                <div class="input-group">
                    <span class="input-group-text">To</span>
                    <input type="text" class="form-control bg-white" name="end" value="<?=date('Y-m-d');?>" readonly>
                </div>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12 mt-0 mb-3">
                <div class="input-group">
                    <span class="input-group-text">Types</span>
                    <select class="form-select" name="types">
                    <option value="0">All</option>
                    <option value="1">Deposit</option>
                    <option value="2">Withdrawal</option>
                    <option value="3">Promotion</option>
                    <option value="4">Rebate</option>
                    <option value="5">Affiliate</option>
                    <option value="6">Credit Transfer</option>
                    <option value="7">Wallet Return</option>
                    <option value="8">Jackpot</option>
                    <option value="9">Fortune Wheel</option>
                    <option value="10">Replenishment</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12 mt-0 mb-3">
                <div class="input-group">
                    <span class="input-group-text">Status</span>
                    <select class="form-select" name="status">
                    <option value="0">All</option>
                    <option value="1">Approved</option>
                    <option value="2">Rejected</option>
                    <option value="3">Pending</option>
                    <option value="4">Checked</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary ms-lg-3 ms-md-3 ms-0 mt-0 mb-3">Search</button>
            <?=form_close();?>

            <table id="paymentTable" class="w-100 nowrap table table-sm table-bordered">
                <thead>
                <tr>
                <th>Created Date</th>
                <th>Username</th>
                <th>Status</th>
                <th>Types</th>
                <th>Created By</th>
                <th>Amount</th>
                <th class="none">Remark</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                <th colspan="5" class="text-end">Total:</th>
                <th class="text-end">&nbsp;</th>
                <td>&nbsp;</td>
                </tr>
                </tfoot>
                <tbody></tbody>
            </table>

        </article>
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

            const fromdate = $('.filterForm [name=start]').val();
            const todate = $('.filterForm [name=end]').val();
            const paytype = $('.filterForm [name=types]').val();
            const status = $('.filterForm [name=status]').val();
            
            var payload = JSON.stringify({
                pageindex: pageindex,
                rowperpage: data.length,
                start: fromdate,
                end: todate,
                type: paytype,
                status: status,
                parent: '<?=$parent;?>',
                currencycode: '<?=$currencycode;?>'
            });
            $.ajax({
                url: '/list/history/transaction',
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

            var totalOverPage = api.column(5, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            let truncate = parseFloat(totalOverPage).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            let sum = totalOverPage < 0 ? '<span class="text-danger">'+truncate+'</span>' : truncate;
            $(api.column(5).footer()).html(sum);
        },
        drawCallback: function(oSettings, json) {
            $('#paymentTable tbody tr td.dataTables_empty').removeClass('text-end');
            $('#paymentTable tbody tr').find('td:nth-child(6)').addClass('text-end');
        },
        aoColumnDefs: [{
            aTargets: [5],
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

function airdatepicker()
{
    $('[name=start]').datepicker({
        autoClose: true,
        changeMonth: true,
        changeYear: true,
        language: '<?=$_SESSION['lang']=='cn' || $_SESSION['lang']=='zh' ? 'zh' : 'en'?>',
        dateFormat: 'yyyy-mm-dd',
        maxDate: new Date(),
        todayButton: new Date(),
        clearButton: true
    });
    $('[name=end]').datepicker({
        autoClose: true,
        changeMonth: true,
        changeYear: true,
        language: '<?=$_SESSION['lang']=='cn' || $_SESSION['lang']=='zh' ? 'zh' : 'en'?>',
        dateFormat: 'yyyy-mm-dd',
        maxDate: new Date(),
        todayButton: new Date(),
        clearButton: true
    });
}
</script>