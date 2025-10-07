<section class="card border-light mb-4">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <section class="w-100 d-block pb-3" id="winloseStatus"></section>

        <?=form_open('', ['class'=>'row gy-2 gx-3 align-items-center filterForm mb-4', 'novalidate'=>'novalidate']);?>
        <div class="col-xl-auto col-lg-auto col-md-auto col-12">
            <div class="input-group">
                <span class="input-group-text"><?=lang('Input.settledate');?></span>
                <input type="text" class="form-control" name="settledate" value="<?=date('Y-m-d',strtotime("-1 days"));?>" readonly required>
            </div>
        </div>
        <div class="col-xl-auto col-lg-auto col-md-auto col-12">
            <button type="submit" class="btn btn-primary w-100"><?=lang('Nav.search');?></button>
        </div>
        <?=form_close();?>
    </div>
</section>

<div class="card border-light mb-4">
    <h4 class="card-header p-3 bg-white fs-4"><?=lang('Label.company');?></h4>
    <article class="card-body">
        <table id="compTable" class="w-100 nowrap table table-sm table-bordered table-hover">
            <thead class="bg-vw">
                <tr>
                <th><?=lang('Label.turnover');?></th>
                <th><?=lang('Label.effectbet');?></th>
                <th><?=lang('Label.win');?></th>
                <th><?=lang('Label.winlose');?></th>
                <th><?=lang('Label.expenses');?></th>
                <th><?=lang('Label.grossprofit');?></th>
                <th><?=lang('Label.netprofit');?></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </article>
</div>

<section class="card border-light mb-4">
    <h4 class="card-header p-3 bg-white fs-4"><?=lang('Label.yourprofit');?></h4>
    <div class="card-body">
        <table id="psTable" class="w-100 nowrap table table-sm table-bordered table-hover">
        <thead>
            <tr>
            <th><?=lang('Label.turnover');?></th>
            <th><?=lang('Label.effectbet');?></th>
            <th><?=lang('Label.win');?></th>
            <th><?=lang('Label.winlose');?></th>
            <th><?=lang('Label.expenses');?></th>
            <th><?=lang('Label.grossprofit');?></th>
            <th><?=lang('Label.netprofit');?></th>
            </tr>
        </thead>
        <tbody></tbody>
        </table>
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
    winloseStatus();

    const settledate = $('.filterForm [name=settledate]').val();
    compTable(settledate,'<?=$parent;?>');
    psTable(settledate,'<?=$parent;?>');

    $('.filterForm').off().on('submit', function(e) {
        e.preventDefault();
        const settledate = $('.filterForm [name=settledate]').val();

        if (this.checkValidity() !== false) {
            compTable(settledate,'<?=$parent;?>');
            psTable(settledate,'<?=$parent;?>');
        }
    });
});

async function psTable(settledate,parent)
{
    const psTable = $('#psTable').DataTable({
        dom: "<'row'<'col-12 overflow-auto'tr>>",
        language: langs,
        paging: false,
        stateSave: true,
        deferRender: true,
        processing: true,
        destroy: true,
        responsive: {
            details: {
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table table-bordered'
                })
            }
        },
        ajax: {
            type : "POST",
            url: '/list/ptps-shares-lottery',
            data: {"settledate": settledate,"parent": parent,"side": 1},
            dataSrc: function(json) {
                if(json == "no data") {
                    return [];
                } else {
                    return json.data;
                }
            }
        },
        drawCallback: function(oSettings, json) {
            $('#psTable tbody tr td.dataTables_empty').removeClass('text-end');
        },
        aoColumnDefs: [{
            aTargets: [0,1,2,3,4,5,6],
            render: function ( data, type, row ) {
                return parseFloat(data).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            },
            fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                parseFloat(sData) < 0 ? $(nTd).addClass('text-danger') : '';
            }
        }]
    });

    psTable.draw();
}

function compTable(settledate,parent)
{
    const compTable = $('#compTable').DataTable({
        dom: "<'row'<'col-12 overflow-auto'tr>>",
        language: langs,
        paging: false,
        stateSave: true,
        deferRender: true,
        processing: true,
        destroy: true,
        responsive: {
            details: {
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table table-bordered'
                })
            }
        },
        ajax: {
            type : "POST",
            url: '/list/ptps-shares-lottery',
            data: {"settledate": settledate,"parent": parent,"side": 0},
            dataSrc: function(json) {
                if(json == "no data") {
                    return [];
                } else {
                    return json.data;
                }
            }
        },
        drawCallback: function(oSettings, json) {
            $('#compTable tbody tr td.dataTables_empty').removeClass('text-end');
        },
        // aoColumnDefs: [{
        //     aTargets: [0,1,2,3,4,5,6,7,8,9,10],
        //     render: function ( data, type, row ) {
        //         return parseFloat(data).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
        //     },
        //     fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
        //         parseFloat(sData) < 0 ? $(nTd).addClass('text-danger') : '';
        //     }
        // }]
    });

    compTable.draw();
}
</script>