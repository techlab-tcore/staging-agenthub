<div class="card border-light shadow">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <section class="w-100 d-block px-3 pb-3" id="winloseStatus"></section>
        
        <article class="card-text p-3">
            <?=form_open('', ['class'=>'row gy-2 gx-3 align-items-center filterForm', 'novalidate'=>'novalidate']);?>
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
                    <span class="input-group-text"><?=lang('Label.games');?></span>
                    <select class="form-select" id="gameprovider" name="gameprovider"></select>
                </div>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <button type="submit" class="btn btn-primary w-100"><?=lang('Nav.search');?></button>
            </div>
            <?=form_close();?>
            
            <section class="py-3">
                <button type="button" class="btn btn-primary btn-sm" onclick="setDate('filterForm',1);"><?=lang('Label.today');?></button>
                <button type="button" class="btn btn-primary btn-sm" onclick="setDate('filterForm',2);"><?=lang('Label.yesterday');?></button>
                <button type="button" class="btn btn-primary btn-sm" onclick="setDate('filterForm',3);"><?=lang('Label.thisweek');?></button>
                <button type="button" class="btn btn-primary btn-sm" onclick="setDate('filterForm',4);"><?=lang('Label.lastweek');?></button>
                <button type="button" class="btn btn-primary btn-sm" onclick="setDate('filterForm',5);"><?=lang('Label.thismonth');?></button>
                <button type="button" class="btn btn-primary btn-sm" onclick="setDate('filterForm',6);"><?=lang('Label.lastmonth');?></button>
            </section>

            <section class="py-3">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb" id="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-decoration-none" href="javascript:void(0);" data-index="0" onclick="loadparent()"><i class="bx bx-home"></i></a></li>
                    </ol>
                </nav>
            </section>

            <table id="winloseTable" class="w-100 nowrap table table-sm table-bordered table-hover">
                <thead class="table-style">
                    <tr>
                    <th>&nbsp;</th>
                    <th colspan="3">&nbsp;</th>
                    <th colspan="6" class="text-center"><?=lang('Label.member');?></th>
                    <th colspan="3" class="text-center"><?=lang('Label.agent');?></th>
                    <th colspan="3" class="text-center"><?=lang('Label.self');?></th>
                    <th colspan="3" class="text-center"><?=lang('Label.upline');?></th>
                    <th rowspan="2"><?=lang('Label.totalpl');?></th>
                    </tr>
                    <tr>
                    <th>&nbsp;</th>
                    <th><?=lang('Input.role');?></th>
                    <th><?=lang('Input.username');?></th>
                    <th><?=lang('Input.fname');?></th>
                    <th><?=lang('Label.turnover');?></th>
                    <th><?=lang('Label.effectbet');?></th>
                    <th><?=lang('Label.win');?></th>
                    <th><?=lang('Label.jpwin');?></th>
                    <th><?=lang('Label.jpshare');?></th>
                    <th><?=lang('Label.winlose');?></th>
                    <th><?=lang('Label.turnover');?></th>
                    <th><?=lang('Label.win');?></th>
                    <th><?=lang('Label.winlose');?></th>
                    <th><?=lang('Label.turnover');?></th>
                    <th><?=lang('Label.win');?></th>
                    <th><?=lang('Label.winlose');?></th>
                    <th><?=lang('Label.turnover');?></th>
                    <th><?=lang('Label.win');?></th>
                    <th><?=lang('Label.winlose');?></th>
                    </tr>
                </thead>
                <tfoot class="table-style">
                    <tr>
                    <th class="text-end" colspan="4"><?=lang('Label.totalamt');?>:</th>
                    <th class="text-end">&nbsp;</th>
                    <th class="text-end">&nbsp;</th>
                    <th class="text-end">&nbsp;</th>
                    <th class="text-end">&nbsp;</th>
                    <th class="text-end">&nbsp;</th>
                    <th class="text-end">&nbsp;</th>
                    <th class="text-end">&nbsp;</th>
                    <th class="text-end">&nbsp;</th>
                    <th class="text-end">&nbsp;</th>
                    <th class="text-end">&nbsp;</th>
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
    winloseStatus();

    const fromdate = $('.filterForm [name=start]').val();
    const todate = $('.filterForm [name=end]').val();
    winloseTable(fromdate,todate,'ALL','<?=$parent;?>');

    $('.filterForm').off().on('submit', function(e) {
        e.preventDefault();
        const fromdate = $('.filterForm [name=start]').val();
        const todate = $('.filterForm [name=end]').val();
        const gp = $('.filterForm [name=gameprovider]').val();

        if (this.checkValidity() !== false) {
            // winloseTable.draw();
            winloseTable(fromdate,todate,gp,'<?=$parent;?>');

            const fakeImages = document.querySelectorAll(".breadcrumb-item");
            fakeImages.forEach(function(item, index) {
                if( index > 0 ) {
                    item.remove();
                }
            });
        }
    });
});

function winloseTable(from,to,gp,parent)
{
    const winloseTable = $('#winloseTable').DataTable({
        dom: "<'row mb-3'<'col-xl-6 col-lg-6 col-md-6 col-12'l><'col-xl-6 col-lg-6 col-md-6 col-12'f>>" + "<'row'<'col-12 overflow-auto'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
        language: langs,
        paging: true,
        stateSave: true,
        deferRender: true,
        processing: true,
        destroy: true,
        ajax: {
            type : "POST",
            url: '/list/report/ref-winlose',
            data: {"start": from, "end": to, "parent": parent, "provider": gp},
            dataSrc: function(json) {
                if(json == "no data") {
                    return [];
                } else {
                    return json.data;
                }
            }
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
            { "data": "3", render: $.fn.dataTable.render.number( ',', '.', 2 ) },
            { "data": "4" },
            { "data": "5" },
            { "data": "6" },
            { "data": "7" },
            { "data": "8" },
            { "data": "9" },
            { "data": "10" },
            { "data": "11" },
            { "data": "12" },
            { "data": "13" },
            { "data": "14" },
            { "data": "15" },
            { "data": "16" },
            { "data": "17" },
            { "data": "18" }
        ],
        footerCallback: function ( row, data, start, end, display ) {
            var api = this.api(), data;
            var intVal = function(i){ return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1 : typeof i === 'number' ? i : 0; };

            // var grandtotal = api.column(4).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            // var subtotal = api.column(4, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            // $(api.column(4).footer()).html('<span class="text-primary">' + subtotal.toFixed(2) +' ('+ grandtotal.toFixed(2) +')</span>');

            var grandtotal = api.column(4).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            var subtotal = api.column(4, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            let grand = parseFloat(grandtotal).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            let sub = parseFloat(subtotal).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            $(api.column(4).footer()).html(sub + ' (' + grand + ')');

            var grandtotal2 = api.column(5).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            var subtotal2 = api.column(5, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            let grand2 = parseFloat(grandtotal2).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            let sub2 = parseFloat(subtotal2).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            $(api.column(5).footer()).html(sub2 + ' (' + grand2 + ')');

            var grandtotal3 = api.column(6).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            var subtotal3 = api.column(6, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            let grand3 = parseFloat(grandtotal3).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            let sub3 = parseFloat(subtotal3).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            $(api.column(6).footer()).html(sub3 + ' (' + grand3 + ')');

            var grandtotal4 = api.column(7).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            var subtotal4 = api.column(7, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            let grand4 = parseFloat(grandtotal4).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            let sub4 = parseFloat(subtotal4).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            $(api.column(7).footer()).html(sub4 + ' (' + grand4 + ')');

            var grandtotal5 = api.column(8).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            var subtotal5 = api.column(8, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            let grand5 = parseFloat(grandtotal5).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            let sub5 = parseFloat(subtotal5).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            $(api.column(8).footer()).html(sub5 + ' (' + grand5 + ')');

            var grandtotal6 = api.column(9).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            let truncate6 = parseFloat(grandtotal6).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            let sum6 = grandtotal6 < 0 ? '<span class="text-danger">'+truncate6+'</span>' : truncate6;
            var subtotal6 = api.column(9, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            let sub6 = parseFloat(subtotal6).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            $(api.column(9).footer()).html(sub6 + ' (' + sum6 + ')');

            var grandtotal7 = api.column(10).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            var subtotal7 = api.column(10, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            let grand7 = parseFloat(grandtotal7).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            let sub7 = parseFloat(subtotal7).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            $(api.column(10).footer()).html(sub7 + ' (' + grand7 + ')');

            var grandtotal8 = api.column(11).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            var subtotal8 = api.column(11, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            let grand8 = parseFloat(grandtotal8).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            let sub8 = parseFloat(subtotal8).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            $(api.column(11).footer()).html(sub8 + ' (' + grand8 + ')');

            var grandtotal9 = api.column(12).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            let truncate9 = parseFloat(grandtotal9).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            let sum9 = grandtotal9 < 0 ? '<span class="text-danger">'+truncate9+'</span>' : truncate9;
            var subtotal9 = api.column(12, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            let sub9 = parseFloat(subtotal9).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            $(api.column(12).footer()).html(sub9 + ' (' + sum9 + ')');

            var grandtotal10 = api.column(13).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            var subtotal10 = api.column(13, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            let grand10 = parseFloat(grandtotal10).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            let sub10 = parseFloat(subtotal10).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            $(api.column(13).footer()).html(sub10 + ' (' + grand10 + ')');

            var grandtotal11 = api.column(14).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            var subtotal11 = api.column(14, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            let grand11 = parseFloat(grandtotal11).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            let sub11 = parseFloat(subtotal11).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            $(api.column(14).footer()).html(sub11 + ' (' + grand11 + ')');

            var grandtotal12 = api.column(15).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            let truncate12 = parseFloat(grandtotal12).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            let sum12 = grandtotal12 < 0 ? '<span class="text-danger">'+truncate12+'</span>' : truncate12;
            var subtotal12 = api.column(15, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            let sub12 = parseFloat(subtotal12).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            $(api.column(15).footer()).html(sub12 + ' (' + sum12 + ')');

            var grandtotal13 = api.column(16).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            var subtotal13 = api.column(16, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            let grand13 = parseFloat(grandtotal13).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            let sub13 = parseFloat(subtotal13).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            $(api.column(16).footer()).html(sub13 + ' (' + grand13 + ')');

            var grandtotal14 = api.column(17).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            var subtotal14 = api.column(17, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            let grand14 = parseFloat(grandtotal14).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            let sub14 = parseFloat(subtotal14).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            $(api.column(17).footer()).html(sub14 + ' (' + grand14 + ')');

            var grandtotal15 = api.column(18).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            let truncate15 = parseFloat(grandtotal15).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            let sum15 = grandtotal15 < 0 ? '<span class="text-danger">'+truncate15+'</span>' : truncate15;
            var subtotal15 = api.column(18, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            let sub15 = parseFloat(subtotal15).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            $(api.column(18).footer()).html(sub15 + ' (' + sum15 + ')');

            var grandtotal16 = api.column(19).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            let truncate16 = parseFloat(grandtotal16).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            let sum16 = grandtotal16 < 0 ? '<span class="text-danger">'+truncate16+'</span>' : truncate16;
            var subtotal16 = api.column(19, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            let sub16 = parseFloat(subtotal16).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            $(api.column(19).footer()).html(sub16 + ' (' + sum16 + ')');


            // var grandtotal = api.column(17).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            // let truncate = parseFloat(grandtotal).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            // let sum = grandtotal < 0 ? '<span class="text-danger">'+truncate+'</span>' : truncate;
            // $(api.column(17).footer()).html(sum);

            // var grandtotal3 = api.column(15).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            // $(api.column(15).footer()).html(parseFloat(grandtotal3).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,"));  
        },
        drawCallback: function(oSettings, json) {
            $('#winloseTable tbody tr').find('td').not('td:first-child,td:nth-child(2),td:nth-child(3),td:nth-child(4)').addClass('text-end');
            $('#winloseTable tbody tr td.dataTables_empty').removeClass('text-end');
        },
        aoColumnDefs: [{
            aTargets: [4,5,6,7,8,10,11,12,13,14,16,17],
            render: function ( data, type, row ) {
                return parseFloat(data).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            }
        }, {
            aTargets: [9,15,18,19],
            render: function ( data, type, row ) {
                return parseFloat(data).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            },
            fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                parseFloat(sData) < 0 ? $(nTd).addClass('text-danger') : '';
            }
        }]
    });

    $('#winloseTable tbody').on('click', 'td.details-control', function() {
        var tr = $(this).closest('tr');
        var row = winloseTable.row( tr );
 
        if(row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(format(row.data())).show();
            tr.addClass('shown');

            $('.responseTable tbody tr').find('td').not('td:first-child').addClass('text-right');
        }
    });

    winloseTable.draw();
}

function format(d)
{
    let obj = String(d).split(',').slice(19);

    var tbl='', res='', game='', value='', value2='', value3='', value4='';
    obj.forEach(function(item, index) {
        if( index % 7 === 0 ) {
            game = '<td>' + item + '</td>';
        } else {
            value6 = (parseFloat(item) < 0 ? '<td class="text-danger">' + parseFloat(item).toFixed(2) + '</td>' :  parseFloat(item) > 0 ? '<td class="text-success">' + parseFloat(item).toFixed(2) + '</td>' : '<td>' + parseFloat(item).toFixed(2) + '</td>');
        }

        index % 7 === 1 ? value = '<td>' + parseFloat(item).toFixed(2) + '</td>' : '';
        index % 7 === 2 ? value2 = '<td>' + parseFloat(item).toFixed(2) + '</td>' : '';
        index % 7 === 3 ? value3 = (parseFloat(item) < 0 ? '<td class="text-danger">' + parseFloat(item).toFixed(2) + '</td>' :  parseFloat(item) > 0 ? '<td class="text-success">' + parseFloat(item).toFixed(2) + '</td>' : '<td>' + item + '</td>') : '';
        index % 7 === 4 ? value4 = '<td>' + parseFloat(item).toFixed(2) + '</td>' : '';
        index % 7 === 5 ? value5 = '<td>' + parseFloat(item).toFixed(2) + '</td>' : '';

        index % 7 === 6 ? res += '<tr>' + game + value.replace(/\d(?=(\d{3})+\.)/g, '$&,') + value2.replace(/\d(?=(\d{3})+\.)/g, '$&,') + value3.replace(/\d(?=(\d{3})+\.)/g, '$&,') + value4.replace(/\d(?=(\d{3})+\.)/g, '$&,') + value5.replace(/\d(?=(\d{3})+\.)/g, '$&,') + value6.replace(/\d(?=(\d{3})+\.)/g, '$&,') + '</tr>' : '';
    });

    tbl = '<table class="w-auto table nowrap table-bordered table-hover responseTable">';
    tbl += '<thead><tr>'
    tbl += '<th><?=lang('Label.games');?></th>';
    tbl += '<th><?=lang('Label.turnover');?></th>';
    tbl += '<th><?=lang('Label.effectbet');?></th>';
    tbl += '<th><?=lang('Label.win');?></th>';
    tbl += '<th><?=lang('Label.jpwin');?></th>';
    tbl += '<th><?=lang('Label.jpshare');?></th>';
    tbl += '<th><?=lang('Label.winlose');?></th>';
    tbl += '</tr></thead>';
    tbl += '<tbody>' + res + '</tbody>';
    tbl += '</table>';
    return tbl;
}

function loadparent()
{
    let start = $('.filterForm [name=start]').val();
    let end = $('.filterForm [name=end]').val();
    let gp = $('.filterForm [name=gameprovider]').val();
    winloseTable(start,end,gp,'<?=$parent;?>');
    
    const fakeImages = document.querySelectorAll(".breadcrumb-item");
    fakeImages.forEach(function(item, index) {
        if( index > 0 ) {
            item.remove();
        }
	});
}

function reload(user)
{
    var refer = user.split("+");
    var parent = refer[0];
    var username = refer[1];

    let start = $('.filterForm [name=start]').val();
    let end = $('.filterForm [name=end]').val();
    let gp = $('.filterForm [name=gameprovider]').val();
    winloseTable(start,end,gp,parent);

    breadcrumb(parent,username);
}

function breadcrumb(parent,username)
{
    var count = document.getElementById("breadcrumb").children.length;

    var node = document.createElement("li");
    var nodeHref = document.createElement("a");
    var textnode = document.createTextNode(username);
    node.setAttribute("class", 'breadcrumb-item');
    nodeHref.setAttribute("class", 'text-decoration-none');
    nodeHref.setAttribute("data-index", count);
    nodeHref.setAttribute("href", "javascript:reloadCustom(" + count + ",'"+parent+"')");
    nodeHref.appendChild(textnode);
    node.appendChild(nodeHref);
    document.getElementById("breadcrumb").appendChild(node);
    // console.log(count);
}

function reloadCustom(gene,parent)
{
    var hh = document.getElementById("breadcrumb");
    var count = document.getElementById("breadcrumb").children;

    let start = $('.filterForm [name=start]').val();
    let end = $('.filterForm [name=end]').val();
    let gp = $('.filterForm [name=gameprovider]').val();

    winloseTable(start,end,gp,parent);

    const fakeImages = document.querySelectorAll(".breadcrumb-item");
    fakeImages.forEach(function(item, index) {
        // if( index==gene ) {
	    //     console.log(item);
        // }

        if( index > gene ) {
            item.remove();
        }
	});
}
</script>