<section class="card border-light shadow">
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
                    <span class="input-group-text"><?=lang('Input.types');?></span>
                    <select class="form-select" name="dtype">
                    <option value="2"><?=lang('Label.enddate');?></option>
                    <option value="1"><?=lang('Label.createddate');?></option>
                    <option value="0"><?=lang('Label.approvedate');?></option>
                    </select>
                </div>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <button type="submit" class="btn btn-primary w-100"><?=lang('Nav.search');?></button>
            </div>
            <?=form_close();?>
            
            <table id="affiliateTable" class="w-100 nowrap table table-sm table-bordered table-hover">
                <thead class="table-style">
                <tr>
                <th>&nbsp;</th>
                <th><?=lang('Input.status');?></th>
                <th><?=lang('Label.createddate');?></th>
                <th><?=lang('Input.settledate');?></th>
                <th><?=lang('Label.approveby');?></th>
                <th><?=lang('Input.username');?></th>
                <th><?=lang('Label.turnover');?></th>
                <th><?=lang('Label.affiliate');?></th>
                <th><?=lang('Label.cash');?></th>
                <th><?=lang('Label.chip');?></th>
                </tr>
                </thead>
                <tfoot class="table-style">
                    <tr>
                    <th colspan="6" class="text-end"><?=lang('Label.totalamt');?>:</th>
                    <th class="text-end">&nbsp;</td>
                    <th class="text-end">&nbsp;</th>
                    <th class="text-end">&nbsp;</th>
                    <th class="text-end">&nbsp;</th>
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
    const affiliateTable = $('#affiliateTable').DataTable({
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
            const date = $('.filterForm [name=dtype]').val();
            
            var payload = JSON.stringify({
                pageindex: pageindex,
                rowperpage: data.length,
                start: fromdate,
                end: todate,
                dtype: date,
                parent: '<?=$parent;?>'
            });
            $.ajax({
                url: '/list/history/affiliate',
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
        columns: [
            {
                "className": 'details-control',
                "orderable": false,
                "data": null,
                "defaultContent": ''
            },
            { "data": "0" },
            { "data": "1" },
            { "data": "2" },
            { "data": "3" },
            { "data": "4" },
            { "data": "5" },
            { "data": "6" },
            { "data": "7" },
            { "data": "8" }
        ],
        footerCallback: function ( row, data, start, end, display ) {
            var api = this.api(), data;
            var intVal = function(i){ return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1 : typeof i === 'number' ? i : 0; };

            // var grandtotal = api.column(5).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            var subtotal = api.column(6, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            $(api.column(6).footer()).html(parseFloat(subtotal).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,"));

            var subtotal2 = api.column(7, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            $(api.column(7).footer()).html(parseFloat(subtotal2).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,"));
            
            var subtotal3 = api.column(8, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            $(api.column(8).footer()).html(parseFloat(subtotal3).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,"));

            var subtotal4 = api.column(9, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            $(api.column(9).footer()).html(parseFloat(subtotal4).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,"));
        },
        drawCallback: function(oSettings, json) {
            $('#affiliateTable tbody tr').find('td').not('td:first-child,td:nth-child(2),td:nth-child(3),td:nth-child(4),td:nth-child(5),td:nth-child(6)').addClass('text-end');
            $('#affiliateTable tbody tr td.dataTables_empty').removeClass('text-end');
        },
        aoColumnDefs: [{
            aTargets: [6],
            render: function ( data, type, row ) {
                // return data.replace(/\d(?=(\d{3})+\.)/g, '$&,');
                return parseFloat(data).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            },
            fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                parseFloat(sData) < 0 ? $(nTd).addClass('text-danger') : '';
            }
        }, {
            aTargets: [7,8,9],
            render: function ( data, type, row ) {
                // return data.replace(/\d(?=(\d{3})+\.)/g, '$&,');
                return parseFloat(data).toFixed(5).replace(/(\.\d{4})\d*/, "$1").replace(/(\d)(?=(\d{5})+\b)/g, "$1,");
            },
            fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                parseFloat(sData) < 0 ? $(nTd).addClass('text-danger') : '';
            }
        }]
    });

    $('#affiliateTable tbody').on('click', 'td.details-control', function() {
        var tr = $(this).closest('tr');
        var row = affiliateTable.row(tr);
 
        if(row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });

    $('.filterForm').off().on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            affiliateTable.draw();
        }
    });
});

function format(d)
{
    let obj = String(d).split(',').slice(9);

    var tbl='', res='', game='', value='', value2='', value3='', value4='', value5='', value6='', value57='', value8='', value9='';
    obj.forEach(function(item, index) {
        index % 10 === 0 ? game = '<td>' + item + '</td>' : value9 = '<td>' + item + '</td>';
        index % 10 === 1 ? value = '<td>' + item + '</td>' : '';
        index % 10 === 2 ? value2 = '<td>' + parseFloat(item).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,") + '</td>' : '';
        index % 10 === 3 ? value3= '<td>' + parseFloat(item).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,") + '</td>' : '';
        index % 10 === 4 ? value4 = '<td>' + item + '</td>' : '';
        index % 10 === 5 ? value5 = '<td>' + parseFloat(item).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,") + '</td>' : '';
        index % 10 === 6 ? value6 = '<td>' + item + '</td>' : '';
        index % 10 === 7 ? value7 = '<td>' + parseFloat(item).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,") + '</td>' : '';
        index % 10 === 8 ? value8 = '<td>' + parseFloat(item).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,") + '</td>' : '';
        index % 10 === 9 ? res += '<tr>' + game + value + value2 + value3 + value4 + value5 + value6 + value7 + value8 + value9 + '</tr>' : '';
    });

    tbl = '<table class="w-auto nowrap table table-sm table-bordered table-hover m-0">';
    tbl += '<thead><tr>';
    tbl += '<th><?=lang('Input.turnovercount');?></th>';
    tbl += '<th><?=lang('Label.games');?></th>';
    tbl += '<th><?=lang('Label.turnover');?></th>';
    tbl += '<th><?=lang('Label.effectbet');?></th>';
    tbl += '<th><?=lang('Input.rate');?>.%</th>';
    tbl += '<th><?=lang('Label.affiliate');?></th>';
    tbl += '<th><?=lang('Label.chip');?>.%</th>';
    tbl += '<th><?=lang('Label.cash');?></th>';
    tbl += '<th><?=lang('Label.chip');?></th>';
    tbl += '<th><?=lang('Input.chipgroup');?></th>';
    tbl += '</tr></thead>';

    tbl += '<tbody>' + res + '</tbody>';
    tbl += '</table>';
    return tbl;
}

function format_deposit(d)
{
    let obj = String(d).split(',').slice(10);

    var tbl='', res='', game='', value='', value2='', value3='', value4='';
    obj.forEach(function(item, index) {
        index % 5 === 0 ? game = '<td>' + item + '</td>' : value4 = '<td>' + item + '</td>';
        index % 5 === 1 ? value = '<td>' + item + '</td>' : '';
        index % 5 === 2 ? value2 = '<td>' + item + '</td>' : '';
        index % 5 === 3 ? value3 = '<td>' + item + '</td>' : '';
        index % 5 === 4 ? res += '<tr>' + game + value + value2 + value3 + value4 + '</tr>' : '';
    });

    tbl = '<table class="table-sm nowrap table-bordered table-hover">';
    tbl += '<thead><tr>';
    tbl += '<th><?=lang('Input.level');?></th>';
    tbl += '<th><?=lang('Label.rate');?></th>';
    tbl += '<th><?=lang('Label.deposit');?></th>';
    tbl += '<th><?=lang('Label.affiliate');?></th>';
    tbl += '<th><?=lang('Label.chipgroup');?></th>';
    tbl += '</tr></thead>';
    tbl += '<tbody>' + res + '</tbody>';
    tbl += '</table>';
    return tbl;
}
</script>