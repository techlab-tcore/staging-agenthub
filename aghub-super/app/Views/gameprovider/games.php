<section class="card border-light shadow">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle.'-'.$provider.'('.$currencycode.')';?></h4>
    <div class="card-body">
        <div class="px-3">
            <a class="btn btn-danger bg-gradient" href="javascript:history.go(-1)"><i class="las la-long-arrow-alt-left me-1"></i>Back</a>
            <button type="button" class="btn btn-primary bg-gradient" data-bs-toggle="modal" data-bs-target="#modal-addgame"><i class="las la-plus-circle me-1"></i>Add Game</button>
        </div>

        <article class="card-text p-3">
            <table id="gamesTable" class="w-100 nowrap table table-sm table-bordered">
                <thead>
                <tr>
                <th>Status</th>
                <th>Code</th>
                <th>Game</th>
                <th>Category</th>
                <th>Turnover Count</th>
                <th>Order</th>
                <th>Actions</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </article>
    </div>
</section>

<section class="modal fade modal-addgame" id="modal-addgame" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-addgame" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.addgame');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate'],['provider'=>$provider, 'currencycode'=>$currencycode]);?>
                <dl class="row m-0">
                    <dd class="col-lg-6 col-md-6 col-12 m-0">
                        <div class="mb-3">
                            <label>Category</label>
                            <div id="cateList"></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label>Code</label>
                                <input type="text" class="form-control" name="code" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="d-block">Turnover Count</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="turnovercount" id="tc_yes" value="true">
                                <label class="form-check-label" for="tc_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="turnovercount" id="tc_no" value="false">
                                <label class="form-check-label" for="tc_no">No</label>
                            </div>
                        </div>
                    </dd>
                    <dd class="col-lg-6 col-md-6 col-12 m-0">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label>English</label>
                                <input type="text" class="form-control" name="en" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label>Bahasa</label>
                                <input type="text" class="form-control" name="my" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label>简体中文</label>
                                <input type="text" class="form-control" name="cn" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label>繁体中文</label>
                                <input type="text" class="form-control" name="zh" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label>ภาษาไทย</label>
                                <input type="text" class="form-control" name="th" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label>Tiếng Việt</label>
                                <input type="text" class="form-control" name="vn" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label>বাংলা</label>
                                <input type="text" class="form-control" name="bgl" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label>Indonesia</label>
                                <input type="text" class="form-control" name="in" required>
                            </div>
                        </div>
                    </dd>
                </dl>
                <div class="text-end">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary bg-gradient">Submit</button>
                </div>
                <?=form_close();?>
            </div>
        </div>
    </div>
</section>

<section class="modal fade modal-editgame" id="modal-editgame" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-editgame" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Game</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate'],['provider'=>$provider, 'currencycode'=>$currencycode]);?>
                <dl class="row m-0">
                    <dd class="col-lg-6 col-md-6 col-12 m-0">
                        <div class="mb-3">
                            <label>Category</label>
                            <div id="cateList2"></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label>Code</label>
                                <input type="text" class="form-control" name="code" readonly required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-6 col-12">
                                <label class="d-block">Turnover Count</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="turnovercount" id="tc_yes2" value="true">
                                    <label class="form-check-label" for="tc_yes2">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="turnovercount" id="tc_no2" value="false">
                                    <label class="form-check-label" for="tc_no2">No</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <label>Order</label>
                                <input type="number" step="any" min="0" class="form-control" name="order" required>
                            </div>
                        </div>
                    </dd>
                    <dd class="col-lg-6 col-md-6 col-12 m-0">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label>English</label>
                                <input type="text" class="form-control" name="en" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label>Bahasa</label>
                                <input type="text" class="form-control" name="my" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label>简体中文</label>
                                <input type="text" class="form-control" name="cn" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label>繁体中文</label>
                                <input type="text" class="form-control" name="zh" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label>ภาษาไทย</label>
                                <input type="text" class="form-control" name="th" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label>Tiếng Việt</label>
                                <input type="text" class="form-control" name="vn" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label>বাংলা</label>
                                <input type="text" class="form-control" name="bgl" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <label>Indonesia</label>
                                <input type="text" class="form-control" name="in" required>
                            </div>
                        </div>
                    </dd>
                </dl>
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

    const gamesTable = $('#gamesTable').DataTable({
        dom: "<'row mb-3'<'col-lg-6 col-md-6 col-12 d-lg-inline-block d-md-inline-block d-none'l><'col-lg-6 col-md-6 col-12'f>>" + "<'row'<'col-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        ajax: {
            type : "POST",
            url: '/list/game-provider/games',
            data: {"parent": '<?=$parent;?>', "provider": '<?=$provider;?>', "currencycode": '<?=$currencycode;?>'},
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

    const addgameEvent = document.getElementById('modal-addgame');
    addgameEvent.addEventListener('shown.bs.modal', getGameCategoryList);
    addgameEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
        document.getElementById("cateList").innerHTML = '';
    });
    
    $('.modal-addgame form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['parent'] = '<?=$parent;?>';
            });

            $.post('/game-provider/games/add', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { gamesTable.ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-addgame').modal('toggle');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    const editgameEvent = document.getElementById('modal-editgame');
    editgameEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
        document.getElementById("cateList2").innerHTML = '';
    });

    $('.modal-editgame form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['parent'] = '<?=$parent;?>';
            });

            $.post('/game-provider/games/edit', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { gamesTable.ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-editgame').modal('toggle');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });
});

function showGame(code, currencycode)
{
    $('.modal-editgame').modal('toggle');

    swal.fire({
        title: '<?=lang('Label.prepareinfo')?>...',
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
        customClass: {
            container: 'bg-major'
        }
    });

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
                nodeInput.setAttribute("type", 'radio');
                nodeInput.setAttribute("name", 'gcate');
                nodeInput.setAttribute("value", item.code);
                nodeInput.classList.add('form-check-input');
                nodeInput.setAttribute("id", item.code);
                nodeLabel.classList.add('form-check-label');
                nodeLabel.setAttribute("for", item.code);
                nodeLabel.appendChild(textnode);
                node.appendChild(nodeInput);
                node.appendChild(nodeLabel);
                var ele = document.getElementById("cateList2").appendChild(node);
                ele.classList.add('form-check', 'form-check-inline');
            });

            getGameInfo(code, currencycode);
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => { $('.modal-editgame').modal('toggle'); });
        }
    })
    .done(function() { 
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function getGameInfo(code, currencycode)
{
    var params = {};
    params['parent'] = '<?=$parent;?>';
    params['provider'] = '<?=$provider;?>';
    params['code'] = code;
    params['currencycode'] = currencycode;

    $.post('/game-provider/game/get', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            $('.modal-editgame [name=code]').val(obj.data.code);
            $('.modal-editgame [name=gcate]#'+obj.data.type).prop('checked',true);
            $('.modal-editgame [name=order]').val(obj.data.order);
            obj.data.turnoverCount == true ? $('.modal-editgame [name=turnovercount]#tc_yes2').prop('checked',true) : $('.modal-editgame [name=turnovercount]#tc_no2').prop('checked',true);
            $('.modal-editgame [name=en]').val(obj.data.name.EN);
            $('.modal-editgame [name=my]').val(obj.data.name.MY);
            $('.modal-editgame [name=cn]').val(obj.data.name.CN);
            $('.modal-editgame [name=zh]').val(obj.data.name.ZH);
            $('.modal-editgame [name=th]').val(obj.data.name.TH);
            $('.modal-editgame [name=vn]').val(obj.data.name.VN);
            $('.modal-editgame [name=bgl]').val(obj.data.name.BGL);
            $('.modal-editgame [name=in]').val(obj.data.name.IN);
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

function modifyStatus(code,status,currencycode)
{
    var params = {};
    params['parent'] = '<?=$parent;?>';
    params['provider'] = '<?=$provider;?>';
    params['code'] = code;
    params['status'] = status;
    params['currencycode'] = currencycode;

    $.post('/game-provider/games/status/edit', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            swal.fire("Success!", obj.message, "success").then(() => { $('#gamesTable').DataTable().ajax.reload(null,false); });
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

function getGameCategoryList()
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
                nodeInput.setAttribute("type", 'radio');
                nodeInput.setAttribute("name", 'gcate');
                nodeInput.setAttribute("value", item.code);
                nodeInput.classList.add('form-check-input');
                nodeInput.setAttribute("id", item.code);
                nodeLabel.classList.add('form-check-label');
                nodeLabel.setAttribute("for", item.code);
                nodeLabel.appendChild(textnode);
                node.appendChild(nodeInput);
                node.appendChild(nodeLabel);
                var ele = document.getElementById("cateList").appendChild(node);
                ele.classList.add('form-check', 'form-check-inline');
            });
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => { $('.modal-addgame').modal('toggle'); });
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