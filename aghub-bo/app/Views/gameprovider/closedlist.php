<section class="card border-light shadow">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <article class="card-text p-3">

            <table id="aggameTable" class="w-100 nowrap table table-sm table-bordered">
                <thead class="table-style">
                <tr>
                <th>&nbsp;</th>
                <th><?=lang('Label.closegames');?></th>
                <th><?=lang('Label.action');?></th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>

        </article>
    </div>
</section>

<section class="modal fade modal-modifyCloseGame" id="modal-modifyCloseGame" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-modifyCloseGame" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.editclosedgames');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate'], ['uid'=>'']);?>
                <div class="mb-3" id="closedList">
                </div>
                <div class="text-end">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal"><?=lang('Nav.close');?></button>
                    <button type="submit" class="btn btn-primary"><?=lang('Nav.submit');?></button>
                </div>
                <?=form_close();?>
            </div>
        </div>
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

    const aggameTable = $('#aggameTable').DataTable({
        dom: "<'row'<'col-12 overflow-auto'tr>>",
        language: langs,
        ordering: false,
        paging: false,
        deferRender: true,
        processing: true,
        destroy: true,
        ajax: {
            type : "POST",
            url: '/list/games/agent',
            data: {"parent": '<?=$parent;?>'},
            dataSrc: function(json) {
                if(json == "no data") {
                    return [];
                } else {
                    return json.data;
                }
            }
        },
        drawCallback: function(oSettings, json) {
        }
    });

    const modifyCloseGameEvent = document.getElementById('modal-modifyCloseGame');
    modifyCloseGameEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
        $('#closedList').html('');
    });

    $('.modal-modifyCloseGame form').on('submit', function(e) {
        e.preventDefault();

        const codes = [];
        $.each($('.modal-modifyCloseGame [name=gpcode]:checked'), function() {
            codes.push($(this).val());
        });

        if (this.checkValidity() !== false) {

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['uid'] = '<?=$parent;?>';
            });

            $.post('/agent/games/modify', {
                params, codes
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { aggameTable.ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => { aggameTable.ajax.reload(null,false); });
                }
            })
            .done(function() {
                $('.modal-modifyCloseGame').modal('toggle');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => { aggameTable.ajax.reload(null,false); });
            });
        }
    });
});

function modifyGameClosedList()
{
    $('.modal-modifyCloseGame').modal('toggle');

    generalLoading();

    var params = {};
    params['parent'] = '<?=$parent;?>';

    $.post('/list/closed/game-provider', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            const gp = obj.data;
            gp.forEach(function(item, index) {
                var node = document.createElement("div");                
                var nodeInput = document.createElement("input");
                var nodeLabel = document.createElement("label");
                var textnode = document.createTextNode('[' + item.code + '] ' + item.name.EN);
                nodeInput.setAttribute("type", 'checkbox');
                nodeInput.setAttribute("name", 'gpcode');
                nodeInput.setAttribute("value", item.code);
                nodeInput.classList.add('form-check-input');
                nodeInput.setAttribute("id", item.code);
                nodeLabel.classList.add('form-check-label');
                nodeLabel.setAttribute("for", item.code);
                nodeLabel.appendChild(textnode);
                node.appendChild(nodeInput);
                node.appendChild(nodeLabel);
                var ele = document.getElementById("closedList").appendChild(node);
                ele.classList.add('form-check', 'form-switch');
            });

            checkClosed();
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => { $('.modal-modifyCloseGame').modal('toggle'); });
        }
    })
    .done(function() {
        
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function checkClosed()
{
    var params = {};
    params['parent'] = '<?=$parent;?>';

    $.post('/agent/games/check', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            const clist = obj.closeGame;
            clist.forEach(function(item, index) {
                let domExist = document.getElementById(item);
                if( domExist ) {
                    document.getElementById(item).checked = true;
                }
            });
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
        swal.close();
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}
</script>