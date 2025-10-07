<section class="card border-light shadow">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?> - <?=$currencycode;?></h4>
    <div class="card-body">
        <div class="px-3">
            <button type="button" class="btn btn-primary bg-gradient" data-bs-toggle="modal" data-bs-target="#modal-addgp"><i class="las la-plus-circle me-1"></i>Add Game Provider</button>
        </div>

        <article class="card-text p-3">
            <table id="gpTable" class="w-100 nowrap table table-sm table-bordered">
                <thead>
                <tr>
                <th>Status</th>
                <th>Games</th>
                <th>Category</th>
                <th>Provider Fee%</th>
                <th>Chip%/Max.Affiliate</th>
                <th class="none">Chip Group</th>
                <th>Order</th>
                <th>Actions</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </article>
    </div>
</section>

<section class="modal fade modal-addgp" id="modal-addgp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-addgp" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Game Provider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate']);?>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-12">
                        <label>Diminisher</label>
                        <input type="number" step="any" min="1" class="form-control" name="gpdiminisher" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-12">
                        <label>Code</label>
                        <input type="text" class="form-control" name="gpcode" required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <label>Game Provider</label>
                        <input type="text" class="form-control" name="gpen" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-12">
                        <label>Max.Affiliate</label>
                        <input type="number" step="any" min="0" class="form-control" name="gpaffcap" required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <label>Chip</label>
                        <div class="input-group">
                            <input type="number" step="any" min="0" class="form-control" name="gpaffchiprate" required>
                            <span class="input-group-text" id="basic-addon2">%</span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-12">
                        <label>Game Provider Fee</label>
                        <div class="input-group">
                            <input type="number" step="any" min="0" class="form-control" name="providerfee" required>
                            <span class="input-group-text" id="basic-addon2">%</span>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Chip Group</label>
                    <input type="text" class="form-control" name="gpchipgroup">
                </div>
                <div class="mb-3">
                    <label>Category</label>
                    <div id="cateList"></div>
                </div>
                <div class="text-end">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary bg-gradient">Submit</button>
                </div>
                <?=form_close();?>
            </div>
        </div>
    </div>
</section>

<section class="modal fade modal-modify" id="modal-modify" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-modify" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Game Provider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate'], ['currencycode'=>'']);?>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-12">
                        <label>Diminisher</label>
                        <input type="number" step="any" min="1" class="form-control" name="diminisher" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-12">
                        <label>Code</label>
                        <input type="text" class="form-control" name="code" readonly required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <label>Game Provider</label>
                        <input type="text" class="form-control" name="en" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-12">
                        <label>Max.Affiliate</label>
                        <input type="number" step="any" min="0" class="form-control" name="affcap" required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <label>Chip</label>
                        <div class="input-group">
                            <input type="number" step="any" min="0" class="form-control" name="affchiprate" required>
                            <span class="input-group-text" id="basic-addon2">%</span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-12">
                        <label>Game Provider Fee</label>
                        <div class="input-group">
                            <input type="number" step="any" min="0" class="form-control" name="gpfee" required>
                            <span class="input-group-text" id="basic-addon2">%</span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 gporder">
                        <label>Order</label>
                        <input type="number" step="any" min="0" class="form-control" name="order" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Chip Group</label>
                    <input type="text" class="form-control" name="chipgroup">
                </div>
                <div class="mb-3">
                    <label>Category</label>
                    <div id="cateList2"></div>
                </div>
                <div class="text-end">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary bg-gradient">Submit</button>
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

    const gpTable = $('#gpTable').DataTable({
        dom: "<'row mb-3'<'col-lg-6 col-md-6 col-12 d-lg-inline-block d-md-inline-block d-none'l><'col-lg-6 col-md-6 col-12'f>>" + "<'row'<'col-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        ajax: {
            type : "POST",
            url: "/list/game-provider/all",
            data: {"parent": '<?=$parent;?>',"currencycode": '<?=$currencycode;?>'},
            dataSrc: function(json) {
                if(json == "no data") {
                    return [];
                } else {
                    return json.data;
                }
            }
        },
        responsive: {
            details: {
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'w-100 nowrap table table-sm table-bordered'
                })
            }
        },
        language: langs,
        processing: true,
        stateSave: true,
        deferRender: true
    });

    const addgpEvent = document.getElementById('modal-addgp');
    addgpEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
        document.getElementById("cateList").innerHTML = '';
    });
    addgpEvent.addEventListener('shown.bs.modal', function (event) {
        getGameCategoryList('cateList',1,'');
    });

    const modifyEvent = document.getElementById('modal-modify');
    modifyEvent.addEventListener('shown.bs.modal', function (event) {
        
    });
    modifyEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
        document.getElementById("cateList2").innerHTML = '';
    });

    $('.modal-addgp form').on('submit', function(e) {
        e.preventDefault();

        const category = [];
        $.each($('.modal-addgp [name=gcate]:checked'), function() {
            category.push($(this).val());
        });

        if (this.checkValidity() !== false) {

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['parent'] = '<?=$parent;?>';
                params['currencycode'] = '<?=$currencycode;?>';
            });

            $.post('/game-provider/add', {
                params, category
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { gpTable.ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-addgp').modal('toggle');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    $('.modal-modify form').on('submit', function(e) {
        e.preventDefault();

        const category = [];
        $.each($('.modal-modify [name=gcate]:checked'), function() {
            category.push($(this).val());
        });

        if (this.checkValidity() !== false) {

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['parent'] = '<?=$parent;?>';
            });

            $.post('/game-provider/modify', {
                params, category
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { gpTable.ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-modify').modal('toggle');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });
});

function modifyGP(code, name, list, order, affcap, affchiprate, chipgroup, fees, diminisher, currencycode)
{
    $('.modal-modify').modal('toggle');

    swal.fire({
        title: 'Preparing Information...',
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
        customClass: {
            container: 'bg-major'
        }
    });currencycode

    document.getElementsByName("currencycode")[0].value = currencycode;
    document.getElementsByName("code")[0].value = code;
    document.getElementsByName("en")[0].value = name;
    document.getElementsByName("affcap")[0].value = affcap;
    document.getElementsByName("affchiprate")[0].value = affchiprate;
    document.getElementsByName("order")[0].value = order;
    document.getElementsByName("gpfee")[0].value = fees;
    document.getElementsByName("diminisher")[0].value = diminisher;
    
    var params = {};
    params['parent'] = '<?=$parent;?>';
    params['currencycode'] = currencycode;

    $.post('/list/game-provider/category', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            const gp = obj.data;
            gp.forEach( (item, index) => {
                var node = document.createElement("div");                
                var nodeInput = document.createElement("input");
                var nodeLabel = document.createElement("label");
                var textnode = document.createTextNode(item.value.EN);
                nodeInput.setAttribute("type", 'checkbox');
                nodeInput.setAttribute("name", 'gcate');
                nodeInput.setAttribute("value", item.code);
                nodeInput.classList.add('form-check-input');
                nodeInput.setAttribute("id", item.name);
                nodeLabel.classList.add('form-check-label');
                nodeLabel.setAttribute("for", item.name);
                nodeLabel.appendChild(textnode);
                node.appendChild(nodeInput);
                node.appendChild(nodeLabel);
                var ele = document.getElementById("cateList2").appendChild(node);
                ele.classList.add('form-check', 'form-check-inline');
            });

            checkOccupied(list);
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => { $('.modal-modify').modal('toggle'); });
        }
    })
    .done(function() {
        swal.close();
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function status(code,status,currencycode)
{
    var params = {};
    params['parent'] = '<?=$parent;?>';
    params['code'] = code;
    params['status'] = status;
    params['currencycode'] = currencycode;

    $.post('/game-provider/status/modify', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            swal.fire("Updated!", obj.message , "success").then(() => { $('#gpTable').DataTable().ajax.reload(null,false); });
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function getGameProvider(code,list)
{
    $('.modal-modify').modal('toggle');

    swal.fire({
        title: 'Preparing Information...',
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
        customClass: {
            container: 'bg-major'
        }
    });

    var params = {};
    params['parent'] = '<?=$parent;?>';
    params['code'] = code;

    $.post('/game-provider/get', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            const gp = obj.data;

            document.getElementsByName("code")[0].value = gp.code;
            document.getElementsByName("en")[0].value = gp.name.EN;
            document.getElementsByName("affcap")[0].value = gp.maxAffiliate;
            document.getElementsByName("affchiprate")[0].value = gp.affchiprate;
            document.getElementsByName("order")[0].value = order;
            document.getElementsByName("gpfee")[0].value = fees;

            getGameCategoryList('cateList2',2,list);
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => { $('.modal-modify').modal('toggle'); });
        }
    })
    .done(function() {
        swal.close();
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function getGameCategoryList(element,purpose,list)
{
    swal.fire({
        title: 'Preparing Information...',
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
        customClass: {
            container: 'bg-major'
        }
    });

    var params = {};
    params['parent'] = '<?=$parent;?>';
    params['currencycode'] = '<?=$currencycode;?>';

    $.post('/list/game-provider/category', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            const gp = obj.data;
            gp.forEach( (item, index) => {
                var node = document.createElement("div");                
                var nodeInput = document.createElement("input");
                var nodeLabel = document.createElement("label");
                var textnode = document.createTextNode(item.value.EN);
                nodeInput.setAttribute("type", 'checkbox');
                nodeInput.setAttribute("name", 'gcate');
                nodeInput.setAttribute("value", item.code);
                nodeInput.classList.add('form-check-input');
                nodeInput.setAttribute("id", item.name);
                nodeLabel.classList.add('form-check-label');
                nodeLabel.setAttribute("for", item.name);
                nodeLabel.appendChild(textnode);
                node.appendChild(nodeInput);
                node.appendChild(nodeLabel);
                var ele = document.getElementById(element).appendChild(node);
                ele.classList.add('form-check', 'form-check-inline');
            });

            if( purpose==2 ) { checkOccupied(list); }
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => {  });
        }
    })
    .done(function() {
        swal.close();
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function checkOccupied(list)
{
    const arr = JSON.parse(list);

    arr.forEach(item => {
        if( item==1 ) { document.getElementById("SLOT").checked = true; }
        if( item==2 ) { document.getElementById("CASINO").checked = true; }
        if( item==3 ) { document.getElementById("SPORTBOOK").checked = true; }
        if( item==4 ) { document.getElementById("KENO").checked = true; }
        if( item==5 ) { document.getElementById("LOTTERY").checked = true; }
        if( item==6 ) { document.getElementById("FISHING").checked = true; }
        if( item==7 ) { document.getElementById("OTHER").checked = true; }
        if( item==8 ) { document.getElementById("ESPORT").checked = true; }
    });
}
</script>