<div class="card border-light">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <section class="w-100 d-block px-3 pb-3" id="winloseStatus"></section>
        
        <article class="card-text p-3">
            <?=form_open('', ['class'=>'row gy-2 gx-3 align-items-center filterForm', 'novalidate'=>'novalidate'],['parent'=>$parent]);?>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <div class="input-group">
                    <span class="input-group-text"><?=lang('Input.from');?></span>
                    <input type="text" class="form-control" name="start" value="<?=date('Y-m-d',strtotime("-1 days"));?>" readonly>
                </div>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <div class="input-group">
                    <span class="input-group-text"><?=lang('Input.to');?></span>
                    <input type="text" class="form-control" name="end" value="<?=date('Y-m-d',strtotime("-1 days"));?>" readonly>
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

            <table id="winloseTable" class="w-100 nowrap table table-sm table-bordered table-hover">
                <thead class="table-style">
                    <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th><?=lang('Label.turnover');?></th>
                    <th><?=lang('Label.effectbet');?></th>
                    <th><?=lang('Label.winlose');?></th>
                    <th><?=lang('Label.jpwin');?></th>
                    <th><?=lang('Label.jpshare');?></th>
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
    winloseStatus();

    var pageindex = 1, debug = false;
    const winloseTable = $('#winloseTable').DataTable({
        dom: "<'row'<'col-12 overflow-auto'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'><'col-xl-6 col-lg-6 col-md-6 col-12'>>",
        language: langs,
        ordering: false,
        deferRender: true,
        serverSide: true,
        processing: true,
        destroy: true,
        pageLength: 15,
        ajax: function(data, callback, settings) {
            if (settings._iRecordsTotal == 0) {
                pageindex = 1;
            } else {
                var pageindex = settings._iDisplayStart/settings._iDisplayLength + 1;
            }

            const fromdate = $('.filterForm [name=start]').val();
            const todate = $('.filterForm [name=end]').val();
            const parent = $('.filterForm [name=parent]').val();
            
            var payload = JSON.stringify({
                pageindex: pageindex,
                rowperpage: data.length,
                start: fromdate,
                end: todate,
                parent: parent
            });
            $.ajax({
                url: '/list/report/self-games',
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
            { "data": "1", render: $.fn.dataTable.render.number( ',', '.', 2 ) },
            { "data": "2" },
            { "data": "3" },
            { "data": "4" },
            { "data": "5" }
        ],
        drawCallback: function(oSettings, json) {
            $('#winloseTable tbody tr').find('td:nth-child(2),td:nth-child(3)').addClass('text-end');
            $('#winloseTable tbody tr td.dataTables_empty').removeClass('text-end');
        },
        aoColumnDefs: [{
            aTargets: [3,5,6],
            render: function ( data, type, row ) {
                return parseFloat(data).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            },
        }, {
            aTargets: [4],
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

    $('.filterForm').off().on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            winloseTable.draw();
        }
    });
});

function format(d)
{
    let obj = String(d).split(',').slice(6);

    var tbl='', res='', game='', value='', value2='', value3='', value4='';
    obj.forEach(function(item, index) {
        if( index % 7 === 0 ) {
            game = '<td>' + item + '</td>';
        } else {
            value6 = '<td>' + parseFloat(item).toFixed(2) + '</td>';
        }

        index % 7 === 1 ? value = '<td>' + parseFloat(item).toFixed(2) + '</td>' : '';
        index % 7 === 2 ? value2 = '<td>' + parseFloat(item).toFixed(2) + '</td>' : '';
        index % 7 === 3 ? value3 = (parseFloat(item) < 0 ? '<td class="text-danger">' + parseFloat(item).toFixed(2) + '</td>' :  parseFloat(item) > 0 ? '<td class="text-success">' + parseFloat(item).toFixed(2) + '</td>' : '<td>' + item + '</td>') : '';
        index % 7 === 4 ? value4 = (parseFloat(item) < 0 ? '<td class="text-danger">' + parseFloat(item).toFixed(2) + '</td>' :  parseFloat(item) > 0 ? '<td class="text-success">' + parseFloat(item).toFixed(2) + '</td>' : '<td>' + item + '</td>') : '';
        index % 7 === 5 ? value5 = '<td>' + parseFloat(item).toFixed(2) + '</td>' : '';

        index % 7 === 6 ? res += '<tr>' + game + value.replace(/\d(?=(\d{3})+\.)/g, '$&,') + value2.replace(/\d(?=(\d{3})+\.)/g, '$&,') + value3.replace(/\d(?=(\d{3})+\.)/g, '$&,') + value4.replace(/\d(?=(\d{3})+\.)/g, '$&,') + value5.replace(/\d(?=(\d{3})+\.)/g, '$&,') + value6.replace(/\d(?=(\d{3})+\.)/g, '$&,') + '</tr>' : '';
    });

    tbl = '<table class="w-auto table nowrap table-bordered table-hover responseTable">';
    tbl += '<thead><tr>'
    tbl += '<th><?=lang('Label.games');?></th>';
    tbl += '<th><?=lang('Label.turnover');?></th>';
    tbl += '<th><?=lang('Label.effectbet');?></th>';
    tbl += '<th><?=lang('Label.win');?></th>';
    tbl += '<th><?=lang('Label.winlose');?></th>';
    tbl += '<th><?=lang('Label.jpwin');?></th>';
    tbl += '<th><?=lang('Label.jpshare');?></th>';
    tbl += '</tr></thead>';
    tbl += '<tbody>' + res + '</tbody>';
    tbl += '</table>';
    return tbl;
}

function loadparent()
{
    $('.filterForm [name=parent]').val('<?=$parent;?>');
    $('#winloseTable').DataTable().draw();
    
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

    $('.filterForm [name=parent]').val(parent);
    $('#winloseTable').DataTable().draw();

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

    $('.filterForm [name=parent]').val(parent);
    $('#winloseTable').DataTable().draw();

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