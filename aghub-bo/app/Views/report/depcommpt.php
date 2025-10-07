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

            <section class="py-3">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb" id="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-decoration-none" href="javascript:void(0);" data-index="0" onclick="loadparent()"><i class="bx bx-home"></i></a></li>
                    </ol>
                </nav>
            </section>

            <table id="depositcommTable" class="w-100 nowrap table table-sm table-bordered table-hover">
            <thead class="table-style">
                <tr>
                <th><?=lang('Input.role');?></th>
                <th><?=lang('Input.username');?></th>
                <th><?=lang('Input.fname');?></th>
                <th><?=lang('Label.depcomm');?></th>
                <th><?=lang('Label.downline');?></th>
                <th><?=lang('Label.self');?></th>
                <th><?=lang('Label.upline');?></th>
                </tr>
            </thead>
            <tfoot class="table-style">
                <tr>
                <th colspan="3" class="text-end"><?=lang('Label.totalamt');?>:</th>
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

    const fromdate = $('.filterForm [name=start]').val();
    const todate = $('.filterForm [name=end]').val();
    depositcommTable(fromdate,todate,'<?=$parent;?>');

    $('.filterForm').off().on('submit', function(e) {
        e.preventDefault();
        const fromdate = $('.filterForm [name=start]').val();
        const todate = $('.filterForm [name=end]').val();

        if (this.checkValidity() !== false) {
            depositcommTable(fromdate,todate,'<?=$parent;?>');

            const fakeImages = document.querySelectorAll(".breadcrumb-item");
            fakeImages.forEach(function(item, index) {
                if( index > 0 ) {
                    item.remove();
                }
            });
        }
    });
});

function depositcommTable(from,to,parent)
{
    const depositcommTable = $('#depositcommTable').DataTable({
        dom: "<'row mb-3'<'col-xl-6 col-lg-6 col-md-6 col-12'l><'col-lg-6 col-md-6 col-12'f>>" + "<'row'<'col-12 overflow-auto'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
        ajax: {
            type : "POST",
            url: '/list/deposit-commission/position-taking',
            data: {"start": from, "end": to, "parent": parent},
            dataSrc: function(json) {
                if(json == "no data") {
                    return [];
                } else {
                    return json.data;
                }
            }
        },
        language: langs,
        processing: true,
        stateSave: true,
        deferRender: true,
        destroy: true,
        footerCallback: function ( row, data, start, end, display ) {
            var api = this.api(), data;
            var intVal = function(i){ return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1 : typeof i === 'number' ? i : 0; };

            var subtotal = api.column(3, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            $(api.column(3).footer()).html(parseFloat(subtotal).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,"));

            var subtotal2 = api.column(4, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            $(api.column(4).footer()).html(parseFloat(subtotal2).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,"));

            var subtotal3 = api.column(5, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            $(api.column(5).footer()).html(parseFloat(subtotal3).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,"));

            var subtotal4 = api.column(6, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            $(api.column(6).footer()).html(parseFloat(subtotal4).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,"));
        },
        fnInitComplete: function(oSettings, json) {
            
        },
        drawCallback: function(oSettings, json) {
            $('#depositcommTable tbody tr').find('td').not('td:first-child,td:nth-child(2),td:nth-child(3)').addClass('text-end');
            $('#depositcommTable tbody tr td.dataTables_empty').removeClass('text-end');
        },
        aoColumnDefs: [{
            aTargets: [3,4,5,6],
            render: function ( data, type, row ) {
                return parseFloat(data).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            },
            fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                parseFloat(sData) < 0 ? $(nTd).addClass('text-danger') : '';
            }
        }]
    });

    depositcommTable.draw();
}

function loadparent()
{
    let start = $('.filterForm [name=start]').val();
    let end = $('.filterForm [name=end]').val();
    depositcommTable(start,end,'<?=$parent;?>');
    
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
    depositcommTable(start,end,parent);

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

    depositcommTable(start,end,parent);

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