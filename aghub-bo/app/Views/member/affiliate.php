<section class="card border-light">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <article class="card-text p-3">
            <table id="userTable" class="w-100 table table-sm table-bordered table-hover">
            <thead class="table-style">
            <tr>
            <th><?=lang('Nav.affdownline');?></th>
            <th><?=lang('Input.username');?></th>
            <th><?=lang('Label.action');?></th>
            </tr>
            </thead>
            <tbody></tbody>
            </table>
        </article>
    </div>
</section>

<script src="<?=base_url('assets/vendors/echart/dist/echarts.min.js');?>"></script>
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

    const userTable = $('#userTable').DataTable({
        dom: "<'row mb-3'<'col-xl-6 col-lg-6 col-md-6 col-12'><'col-xl-6 col-lg-6 col-md-6 col-12'f>>" + "<'row'<'col-12'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
        responsive: {
            details: {
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table table-bordered'
                })
            }
        },
        language: langs,
        paging: true,
        stateSave: true,
        deferRender: true,
        processing: true,
        destroy: true,
        pageLength: 15,
        ajax: {
            type : "POST",
            url: '/list/user/affiliate',
            data: {"parent": '<?=$parent;?>'},
            dataSrc: function(json) {
                if(json == "no data") {
                    return [];
                } else {
                    return json.data;
                }
            }
        },
        // drawCallback: function(oSettings, json) {
        //     $('#gamesTable tbody tr').find('td').not('td:first-child,td:nth-child(2),td:nth-child(3)').addClass('text-end');
        //     $('#gamesTable tbody tr td.dataTables_empty').removeClass('text-end');
        // },
        // aoColumnDefs: [{
        //     aTargets: [3,4],
        //     render: function ( data, type, row ) {
        //         return parseFloat(data).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
        //     },
        //     fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
        //         parseFloat(sData) < 0 ? $(nTd).addClass('text-danger') : '';
        //     }
        // }]
    });
});
</script>