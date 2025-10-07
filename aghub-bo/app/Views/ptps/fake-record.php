<h4 class="p-3 bg-white fs-4 mb-3"><?=$secTitle;?></h4>

<section class="card border-vw">
    <div class="card-body">

        <?=form_open('', ['class'=>'row gy-2 gx-3 align-items-center filterForm mb-3', 'novalidate'=>'novalidate']);?>
        <div class="col-xl-auto col-lg-auto col-md-auto col-12">
            <div class="input-group">
                <span class="input-group-text"><?=lang('Input.settledate');?></span>
                <input type="text" class="form-control bg-white" name="settledate" value="<?=date('Y-m-d',strtotime("-1 days"));?>" readonly>
            </div>
        </div>
        <div class="col-xl-auto col-lg-auto col-md-auto col-12">
            <button type="submit" class="btn btn-primary w-100"><?=lang('Nav.search');?></button>
        </div>
        <div class="col-xl-auto col-lg-auto col-md-auto col-12">
            <a class="btn btn-primary" href="<?=base_url('settings/additional-record/add');?>"><?=lang('Nav.addfakerecord');?></a>
        </div>
        <?=form_close();?>

        <table id="additionTable" class="w-100 table table-sm table-bordered table-hover">
        <thead>
            <tr>
            <th>&nbsp;</th>
            <th><?=lang('Input.settledate');?></th>
            <th><?=lang('Label.createddate');?></th>
            <th><?=lang('Label.createdby');?></th>
            <th><?=lang('Label.jackpot');?></th>
            </tr>
        </thead>
        <tbody></tbody>
        </table>

    </div>
</section>

<link rel="stylesheet" href="<?=base_url('assets/vendors/datatable/datatables.min.css');?>">
<script src="<?=base_url('assets/vendors/datatable/datatables.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/table_lang.js');?>"></script>
<script>
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

    const settledate = $('.filterForm [name=settledate]').val();
    additionTable(settledate);

    $('.filterForm').off().on('submit', function(e) {
        e.preventDefault();

        const settledate = $('.filterForm [name=settledate]').val();

        if (this.checkValidity() !== false) {
            additionTable(settledate);
        }
    });
});

function additionTable(settledate)
{
    const additionTable = $('#additionTable').DataTable({
        dom: "<'row'<'col-12 overflow-auto'tr>>",
        ajax: {
            type : "POST",
            url: "/list/additional-record",
            data: {"settledate": settledate},
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
            { "data": "3" },
        ],
        // responsive: {
        //     details: {
        //         renderer: $.fn.dataTable.Responsive.renderer.tableAll({
        //             tableClass: 'ui display nowrap table-sm table-bordered'
        //         })
        //     }
        // },
        language: langs,
        processing: true,
        deferRender: true,
        destroy: true,
        ordering: false,
        paging: false,
        searching: false,
        fnInitComplete: function(oSettings, json) {
            // action_handle('done_search');
        }
    });

    $('#additionTable tbody').on('click', 'td.details-control', function() {
        var tr = $(this).closest('tr');
        var row = additionTable.row( tr );
 
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

    additionTable.draw();
}

function format(d)
{
    let obj = String(d).split(',').slice(4);

    var tbl='', res='', game='', value='', value2='', value3='';
    obj.forEach(function(item, index) {
        index % 4 === 0 ? game = '<td>' + item + '</td>' : value3 = '<td>' + item + '</td>';
        index % 4 === 1 ? value = '<td>' + item + '</td>' : '';
        index % 4 === 2 ? value2 = '<td>' + item + '</td>' : '';
        index % 4 === 3 ? res += '<tr>' + game + value + value2 + value3  + '</tr>' : '';
    });

    tbl = '<table class="table table-sm table-bordered table-hover">';
    tbl += '<thead>';
    tbl += '<tr>';
    tbl += '<th><?=lang('Label.games');?></th>';
    tbl += '<th><?=lang('Label.turnover');?></th>';
    tbl += '<th><?=lang('Label.winlose');?></th>';
    tbl += '<th><?=lang('Label.givechip');?></th>';
    tbl += '</tr>';
    tbl += '</thead>';
    tbl += '<tbody>' + res + '</tbody>';
    tbl += '</table>';
    return tbl;
}
</script>