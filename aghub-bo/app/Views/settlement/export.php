<section class="card border-light">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <article class="card-text p-3">
            <?=form_open('', ['class'=>'row gy-2 gx-3 align-items-center filterForm pb-2', 'novalidate'=>'novalidate']);?>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <div class="input-group">
                    <span class="input-group-text"><?=lang('Input.from');?></span>
                    <input type="text" class="form-control" name="start" value="<?=date('Y-m-d');?>" readonly>
                </div>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <div class="input-group">
                    <span class="input-group-text"><?=lang('Input.to');?></span>
                    <input type="text" class="form-control" name="end" value="<?=date('Y-m-d');?>" readonly>
                </div>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <button type="submit" class="btn btn-primary w-100"><?=lang('Nav.search');?></button>
            </div>
            <?=form_close();?>

            <table id="settlementTable" class="w-100 nowrap table table-sm table-bordered table-hover">
                <thead class="table-style">
                <tr>
                <th><?=lang('Label.createddate');?></th>
                <th><?=lang('Input.types');?></th>
                <th><?=lang('Input.status');?></th>
                <th><?=lang('Input.filename');?></th>
                <th class="none"><?=lang('Input.remark');?></th>
                </tr>
                </thead>
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

    const fromdate = $('.filterForm [name=start]').val();
    const todate = $('.filterForm [name=end]').val();
    settlementTable(fromdate,todate);

    $('.filterForm').off().on('submit', function(e) {
        e.preventDefault();
        const fromdate = $('.filterForm [name=start]').val();
        const todate = $('.filterForm [name=end]').val();

        if (this.checkValidity() !== false) {
            settlementTable(fromdate,todate);
        }
    });
});

function settlementTable(from,to)
{
    const settlementTable = $('#settlementTable').DataTable({
        dom: "<'row mb-3'<'col-xl-6 col-lg-6 col-md-6 col-12'l><'col-lg-6 col-md-6 col-12'f>>" + "<'row'<'col-12 overflow-auto'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
        responsive: {
            details: {
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'w-100 nowrap table table-sm table-bordered table-hover'
                })
            }
        },
        ajax: {
            type : "POST",
            url: '/list/export-history',
            data: {"start": from, "end": to},
            dataSrc: function(json) {
                if(json == "no data") {
                    return [];
                } else {
                    return json.data;
                }
            }
        },
        language: langs,
        paging: true,
        processing: true,
        stateSave: true,
        deferRender: true,
        destroy: true
    });

    settlementTable.draw();
}
</script>