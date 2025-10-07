<div class="card border-light shadow">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <article class="card-text p-3">

            <?=form_open('', ['class'=>'row row-cols-lg-auto g-3 align-items-center filterForm pb-2', 'novalidate'=>'novalidate']);?>
            <div class="col-12 mt-0 mb-3">
                <div class="input-group">
                    <span class="input-group-text"><?=lang('Input.from');?></span>
                    <input type="text" class="form-control bg-white" name="start" value="<?=date('Y-m-d',strtotime("-1 days"));?>" readonly>
                </div>
            </div>
            <div class="col-12 mt-0 mb-3">
                <div class="input-group">
                    <span class="input-group-text"><?=lang('Input.to');?></span>
                    <input type="text" class="form-control bg-white" name="end" value="<?=date('Y-m-d',strtotime("-1 days"));?>" readonly>
                </div>
            </div>
            <button type="submit" class="btn btn-primary bg-gradient ms-lg-3 ms-md-3 ms-0 mt-0 mb-3"><i class="fas fa-search me-1"></i><?=lang('Nav.search');?></button>
            <?=form_close();?>
            
            <table id="pssettleTable" class="w-100 mb-0 table table-bordered">
            <thead>
                <tr>
                <th>&nbsp;</th>
                <th><?=lang('Label.games');?></th>
                <th><?=lang('Label.turnover');?></th>
                <th><?=lang('Label.gamepayout');?></th>
                <th><?=lang('Label.gamescore');?></th>
                </tr>
            </thead>
            <tbody></tbody>
            </table>

        </article>
    </div>
</div>

<div class="card border-light shadow mt-4">
    <div class="card-body">
        <article class="card-text p-3">
            <table id="psTable" class="w-100 mb-0 table table-bordered">
            <thead>
                <tr>
                <th>&nbsp;</th>
                <th><?=lang('Label.games');?></th>
                <th class="bg-hightlight"><?=lang('Label.turnover');?></th>
                <th class="bg-hightlight"><?=lang('Label.gamescore');?></th>
                </tr>
            </thead>
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

    $('.filterForm').on('submit', function(e) {
        e.preventDefault();
        if (this.checkValidity() !== false) {
            $('#pssettleTable').DataTable().ajax.reload();
            $('#psTable').DataTable().ajax.reload();
        }
    });

    const pssettleTable = $('#pssettleTable').DataTable({
        dom: "<'row'<'col-12 overflow-auto'tr>>",
        ajax: function(data, callback, settings) {
            const fromdate = $('.filterForm [name=start]').val();
            const todate = $('.filterForm [name=end]').val();
            
            var payload = JSON.stringify({
                parent: '<?=$parent;?>',
                start: fromdate,
                end: todate
            });
            $.ajax({
                url: '/list/summary/company',
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
                "className": 'details-control text-center',
                "orderable": false,
                "data": null,
                "defaultContent": ''
            },
            { "data": "0" },
            { "data": "1", render: $.fn.dataTable.render.number( ',', '.', 2 ) },
            { "data": "2" },
            { "data": "3" }
        ],
        language: langs,
        processing: true,
        stateSave: true,
        deferRender: true,
        destroy: true,
        ordering: false,
        paging: false,
        fnInitComplete: function(oSettings, json) {
            
        },
        drawCallback: function(oSettings, json) {
            $('#pssettleTable tbody tr').find('td').addClass('text-end align-top');
            $('#pssettleTable tbody tr td.dataTables_empty').removeClass('text-end');
            // $('#pssettleTable tbody tr:first-child').find('td:first-child').removeClass('details-control');
            // $('#pssettleTable tbody tr:first-child').find('td:first-child').html('');
        },
        aoColumnDefs: [{
            aTargets: [3,4],
            render: function ( data, type, row ) {
                return data.replace(/\d(?=(\d{3})+\.)/g, '$&,');
            },
            fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                parseFloat(sData) < 0 ? $(nTd).addClass('text-danger') :  parseFloat(sData) > 0 ? $(nTd).addClass('text-success') : '';
            }
        }]
    });

    $('#pssettleTable tbody').off().on('click', 'td.details-control', function() {
        var tr = $(this).closest('tr');
        var row = pssettleTable.row(tr);

        if(row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            if(row.child() && row.child().length) {
                row.child.show();
            } else {
                row.child( format_comp(row.data()) ).show();
            }
            tr.addClass('shown');

        }
    });

    const psTable = $('#psTable').DataTable({
        dom: "<'row'<'col-12 overflow-auto'tr>>",

        ajax: function(data, callback, settings) {
            const fromdate = $('.filterForm [name=start]').val();
            const todate = $('.filterForm [name=end]').val();
            
            var payload = JSON.stringify({
                parent: '<?=$parent;?>',
                start: fromdate,
                end: todate
            });
            $.ajax({
                url: '/list/summary/administrator',
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
                "className": 'details-control text-center',
                "orderable": false,
                "data": null,
                "defaultContent": ''
            },
            { "data": "0" },
            { "data": "1" },
            { "data": "2" }
        ],
        language: langs,
        processing: true,
        stateSave: false,
        deferRender: true,
        destroy: true,
        ordering: false,
        paging: false,
        fnInitComplete: function(oSettings, json) {
        },
        drawCallback: function(oSettings, json) {
            $('#psTable tbody tr').find('td').addClass('text-end align-top');
            $('#psTable tbody tr td.dataTables_empty').removeClass('text-end');
            $('#psTable tfoot tr:last').find('td').removeClass('details-control');
            $('#psTable tbody tr').find('td').not('td:nth-child(1), td:nth-child(2)').addClass('bg-hightlight');
            $('#psTable tbody tr:last, #psTable tbody tr:nth-last-child(2)').find('td:first-child').removeClass('details-control');
        },
        aoColumnDefs: [{
            aTargets: [2,3],
            render: function ( data, type, row ) {
                return data.replace(/\d(?=(\d{3})+\.)/g, '$&,');
            },
            fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                parseFloat(sData) < 0 ? $(nTd).addClass('text-danger') : '';
            }
        }]
    });

    $('#psTable tbody').off().on('click', 'td.details-control', function() {
        var tr = $(this).closest('tr');
        var row = psTable.row(tr);

        if(row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            if(row.child() && row.child().length) {
                row.child.show();
            } else {
                row.child( format(row.data()) ).show();
            }
            tr.addClass('shown');
        }
    });
});

function format_comp(d) {
    let obj = String(d).split(',').slice(4);

    var tbl='', res='', game='', value='', value2='', value3='';
    obj.forEach(function(item, index) {
        index % 4 === 0 ? game = '<td>' + item + '</td>' : value3 = '<td class="text-end">' + item + '</td>';
        index % 4 === 1 ? value = '<td class="text-end">' + item + '</td>' : '';
        index % 4 === 2 ? value2 = '<td class="text-end">' + item + '</td>' : '';
        index % 4 === 3 ? res += '<tr>' + game + value.replace(/\d(?=(\d{3})+\.)/g, '$&,') + value2.replace(/\d(?=(\d{3})+\.)/g, '$&,') + value3.replace(/\d(?=(\d{3})+\.)/g, '$&,') + '</tr>' : '';
    });

    tbl = '<table class="w-100 mb-0 table table-bordered subtable table-hover">';

    tbl += '<thead><tr>';
    tbl += '<th class="text-center"><?=lang('Label.games');?></th>';
    tbl += '<th class="text-center"><?=lang('Label.turnover');?></th>';
    tbl += '<th class="text-center"><?=lang('Label.gamepayout');?></th>';
    tbl += '<th class="text-center"><?=lang('Label.gamescore');?></th>';
    tbl += '</thead></tr>';

    tbl += '<tbody>' + res + '</tbody>';
    tbl += '</table>';
    return tbl;
}

function format(d) {
    let obj = String(d).split(',').slice(3);

    var tbl='', res='', game='', value='', value2='', value3='';
    obj.forEach(function(item, index) {
        if( index % 4 === 0 ) {
            game = item=='<?=$_SESSION['username'];?>' ? '<td class="bg-hightlight3 text-light">' + item + '</td>' : '<td>' + item + '</td>';
        } else {
            value3 = '<td class="text-end">' + item + '</td>';
        }

        index % 4 === 1 ? value = '<td class="bg-hightlight2 text-end">' + item + '</td>' : '';
        index % 4 === 2 ? value2 = '<td class="text-end">' + item + '</td>' : '';
        index % 4 === 3 ? res += '<tr>' + game + value.replace(/\d(?=(\d{3})+\.)/g, '$&,') + value2.replace(/\d(?=(\d{3})+\.)/g, '$&,') + value3.replace(/\d(?=(\d{3})+\.)/g, '$&,') + '</tr>' : '';
    });

    tbl = '<table class="w-100 mb-0 table table-bordered subtable table-hover">';

    tbl += '<thead><tr>';
    tbl += '<th class="text-center"><?=lang('Input.username');?></th>';
    tbl += '<th class="text-center"><?=lang('Label.selfturnover');?></th>';
    tbl += '<th class="text-center"><?=lang('Label.sharehold');?></th>';
    tbl += '<th class="text-center"><?=lang('Label.gamescore');?></th>';
    tbl += '</thead></tr>';

    tbl += '<tbody>' + res + '</tbody>';
    tbl += '</table>';
    return tbl;
}
</script>