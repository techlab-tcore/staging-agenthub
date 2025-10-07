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
            <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target=".modal-addExpenses"><?=lang('Nav.addexpenses');?></button>
        </div>
        <?=form_close();?>

        <table id="compsumTable" class="w-100 table table-sm table-bordered table-hover">
        <thead>
            <tr>
            <th>&nbsp;</th>
            <th><?=lang('Label.turnover');?></th>
            <th><?=lang('Label.effectbet');?></th>
            <th><?=lang('Label.win');?></th>
            <th><?=lang('Label.winlose');?></th>
            <th><?=lang('Label.givechip');?></th>
            <th><?=lang('Input.fightexpenses');?></th>
            <th><?=lang('Input.sharesexpenses');?></th>
            </tr>
        </thead>
        <tbody></tbody>
        </table>

    </div>
</section>

<section class="modal fade modal-addExpenses" id="modal-addExpenses" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-addExpenses" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><?=lang('Nav.addexpenses');?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('',['class'=>'form-validation row g-3 align-items-center addSummayExpensesForm','novalidate'=>'novalidate']);?>
                <div class="input-group col-12">
                    <span class="input-group-text"><?=lang('Input.settledate');?></span>
                    <input type="text" class="form-control bg-white" name="settledate" required>
                </div>
                <div class="input-group col-12">
                    <span class="input-group-text"><?=lang('Input.sharesexpenses');?></span>
                    <input type="text" class="form-control" name="psExpenses" required>
                </div>
                <div class="input-group col-12">
                    <span class="input-group-text"><?=lang('Input.fightexpenses');?></span>
                    <input type="text" class="form-control" name="ptExpenses" required>
                </div>
                <div class="col-xl-auto col-lg-auto col-md-auto col-12 ms-auto text-end">
                    <button type="submit" class="btn btn-primary w-100"><?=lang('Nav.submit');?></button>
                </div>
                <?=form_close();?>
            </div>
        </div>
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
    compsumTable(settledate);

    $('.filterForm').off().on('submit', function(e) {
        e.preventDefault();

        const settledate = $('.filterForm [name=settledate]').val();

        if (this.checkValidity() !== false) {
            compsumTable(settledate);
        }
    });

    $('.addSummayExpensesForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $('.addSummayExpensesForm [type=submit]').prop('disabled',true);

            $.post('/company-summary/add', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => {
                        const settledate = $('.filterForm [name=settledate]').val();
                        compsumTable(settledate);
                    });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.addSummayExpensesForm [type=submit]').prop('disabled',false);
                $('.modal-addExpenses').modal('hide');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => {
                    
                });
            });
        }
    });

    const addExpensesEvent = document.getElementById('modal-addExpenses');
    addExpensesEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });
});

function compsumTable(settledate)
{
    const compsumTable = $('#compsumTable').DataTable({
        dom: "<'row'<'col-12 overflow-auto'tr>>",
        ajax: {
            type : "POST",
            url: "/list/company-summary",
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
            { "data": "4" },
            { "data": "5" },
            { "data": "6" }
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

    $('#compsumTable tbody').on('click', 'td.details-control', function() {
        var tr = $(this).closest('tr');
        var row = compsumTable.row( tr );
 
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

    compsumTable.draw();
}

function format(d)
{
    let obj = String(d).split(',').slice(7);

    var tbl='', res='', game='', value='', value2='', value3='', value4='', value5='', value6='', value7='', value8='';
    obj.forEach(function(item, index) {
        index % 9 === 0 ? game = '<td>' + item + '</td>' : value8 = '<td>' + item + '</td>';
        index % 9 === 1 ? value = '<td>' + item + '</td>' : '';
        index % 9 === 2 ? value2 = '<td>' + item + '</td>' : '';
        index % 9 === 3 ? value3 = '<td>' + item + '</td>' : '';
        index % 9 === 4 ? value4 = '<td>' + item + '</td>' : '';
        index % 9 === 5 ? value5 = '<td>' + item + '</td>' : '';
        index % 9 === 6 ? value6 = '<td>' + item + '</td>' : '';
        index % 9 === 7 ? value7 = '<td>' + item + '</td>' : '';
        index % 9 === 8 ? res += '<tr>' + game + value + value2 + value3 + value4 + value5 + value6 + value7 + value8 + '</tr>' : '';
    });

    tbl = '<table class="table table-sm table-bordered table-hover">';
    tbl += '<thead>';
    tbl += '<tr>';
    tbl += '<th><?=lang('Label.games');?></th>';
    tbl += '<th><?=lang('Label.turnover');?></th>';
    tbl += '<th><?=lang('Label.effectbet');?></th>';
    tbl += '<th><?=lang('Label.win');?></th>';
    tbl += '<th><?=lang('Label.winlose');?></th>';
    tbl += '<th><?=lang('Label.givechip');?></th>';
    tbl += '<th><?=lang('Label.agcomm');?></th>';
    tbl += '<th><?=lang('Label.affiliate');?></th>';
    tbl += '<th><?=lang('Label.affloserebate');?></th>';
    tbl += '</tr>';
    tbl += '</thead>';
    tbl += '<tbody>' + res + '</tbody>';
    tbl += '</table>';
    return tbl;
}

async function getSummary()
{
    $.get('/list/company-summary', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {

        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
        
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => {
            
        });
    });
}
</script>