<section class="card border-light">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <div class="px-3">
            <a class="btn btn-primary me-1" href="<?=base_url('announcement/open/add');?>"><?=lang('Nav.addannc');?></a>
            <a class="btn btn-primary" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".modal-addRoll"><?=lang('Nav.addrollannc');?></a>
        </div>

        <article class="card-text p-3">
            <table id="announcementTable" class="w-100 table table-sm table-bordered table-hover">
                <thead class="table-style">
                <tr>
                <th><?=lang('Label.createddate');?></th>
                <th><?=lang('Input.status');?></th>
                <th><?=lang('Input.usergroup');?></th>
                <th><?=lang('Input.popup');?></th>
                <th class="none"><?=lang('Input.msg');?></th>
                <th><?=lang('Label.action');?></th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </article>
    </div>
</section>

<section class="modal fade modal-addRoll" id="modal-addRoll" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-addRoll" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.addrollannc');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate']);?>
                <div class="mb-3">
                    <label class="d-block"><?=lang('Input.usergroup');?></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="trole" id="role_agent22" value="3">
                        <label class="form-check-label" for="role_agent22"><?=lang('Label.agent');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="trole" id="role_subacc22" value="5">
                        <label class="form-check-label" for="role_subacc22"><?=lang('Label.subacc');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="trole" id="role_member22" value="4">
                        <label class="form-check-label" for="role_member22"><?=lang('Label.member');?></label>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="d-block"><?=lang('Input.popup');?></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="popup" id="pyes22" value="1" disabled>
                        <label class="form-check-label" for="pyes22"><?=lang('Label.yes');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="popup" id="pno22" value="2" checked>
                        <label class="form-check-label" for="pno22"><?=lang('Label.no');?></label>
                    </div>
                </div>
                <div class="mb-3">
                    <label><?=lang('Input.msg');?></label>
                    <nav class="nav nav-tabs nav-fill">
                        <a class="nav-link active" id="en-tab" data-bs-toggle="tab" data-bs-target="#tab-en22" role="tab" aria-controls="tab-en22" aria-selected="true" href="javascript:void(0);">EN</a>
                        <a class="nav-link" id="my-tab" data-bs-toggle="tab" data-bs-target="#tab-my22" role="tab" aria-controls="tab-my22" aria-selected="false" href="javascript:void(0);">MY</a>
                        <a class="nav-link" id="cn-tab" data-bs-toggle="tab" data-bs-target="#tab-cn22" role="tab" aria-controls="tab-cn22" aria-selected="false" href="javascript:void(0);">CN</a>
                        <a class="nav-link" id="th-tab" data-bs-toggle="tab" data-bs-target="#tab-th22" role="tab" aria-controls="tab-th22" aria-selected="false" href="javascript:void(0);">TH</a>
                        <a class="nav-link" id="vn-tab" data-bs-toggle="tab" data-bs-target="#tab-vn22" role="tab" aria-controls="tab-vn22" aria-selected="false" href="javascript:void(0);">VN</a>
                        <!--<a class="nav-link" id="zh-tab" data-bs-toggle="tab" data-bs-target="#tab-zh22" role="tab" aria-controls="tab-zh22" aria-selected="false" href="javascript:void(0);">ZH</a>
                        <a class="nav-link" id="bgl-tab" data-bs-toggle="tab" data-bs-target="#tab-bgl22" role="tab" aria-controls="tab-bgl22" aria-selected="false" href="javascript:void(0);">BGL</a>
                        <a class="nav-link" id="bur-tab" data-bs-toggle="tab" data-bs-target="#tab-bur22" role="tab" aria-controls="tab-bur22" aria-selected="false" href="javascript:void(0);">BUR</a>
                        <a class="nav-link" id="in-tab" data-bs-toggle="tab" data-bs-target="#tab-in22" role="tab" aria-controls="tab-in22" aria-selected="false" href="javascript:void(0);">IN</a>-->
                    </nav>
                    <dl class="tab-content mt-2">
                        <dd class="tab-pane fade show active" id="tab-en22" role="tabpanel">
                            <textarea class="form-control" name="en"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-my22" role="tabpanel">
                            <textarea class="form-control" name="my"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-cn22" role="tabpanel">
                            <textarea class="form-control" name="cn"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-th22" role="tabpanel">
                            <textarea class="form-control" name="th"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-vn22" role="tabpanel">
                            <textarea class="form-control" name="vn"></textarea>
                        </dd>
                        <!--<dd class="tab-pane fade" id="tab-zh22" role="tabpanel">
                            <textarea class="form-control" name="zh"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-bgl22" role="tabpanel">
                            <textarea class="form-control" name="bgl"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-bur22" role="tabpanel">
                            <textarea class="form-control" name="bur"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-in22" role="tabpanel">
                            <textarea class="form-control" name="in"></textarea>
                        </dd>-->
                    </dl>
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

<section class="modal fade modal-modifyRoll" id="modal-modifyRoll" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-modifyRoll" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.editannc');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate'],['id'=>'']);?>
                <div class="mb-3">
                    <label class="d-block"><?=lang('Input.status');?></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="astatus_yes2" value="1">
                        <label class="form-check-label" for="astatus_yes2"><?=lang('Label.active');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="astatus_no2" value="2" checked>
                        <label class="form-check-label" for="astatus_no2"><?=lang('Label.inactive');?></label>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="d-block"><?=lang('Input.usergroup');?></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="trole" id="role_agent2" value="3">
                        <label class="form-check-label" for="role_agent2"><?=lang('Label.agent');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="trole" id="role_subacc2" value="5">
                        <label class="form-check-label" for="role_subacc2"><?=lang('Label.subacc');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="trole" id="role_member2" value="4">
                        <label class="form-check-label" for="role_member2"><?=lang('Label.member');?></label>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="d-block"><?=lang('Input.popup');?></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="popup" id="pyes2" value="1" disabled>
                        <label class="form-check-label" for="pyes2"><?=lang('Label.yes');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="popup" id="pno2" value="2" checked>
                        <label class="form-check-label" for="pno2"><?=lang('Label.no');?></label>
                    </div>
                </div>
                <div class="mb-3">
                    <label><?=lang('Input.msg');?></label>
                    <nav class="nav nav-tabs nav-fill">
                        <a class="nav-link active" id="en-tab" data-bs-toggle="tab" data-bs-target="#tab-en2" role="tab" aria-controls="tab-en2" aria-selected="true" href="javascript:void(0);">EN</a>
                        <a class="nav-link" id="my-tab" data-bs-toggle="tab" data-bs-target="#tab-my2" role="tab" aria-controls="tab-my2" aria-selected="false" href="javascript:void(0);">MY</a>
                        <a class="nav-link" id="cn-tab" data-bs-toggle="tab" data-bs-target="#tab-cn2" role="tab" aria-controls="tab-cn2" aria-selected="false" href="javascript:void(0);">CN</a>
                        <a class="nav-link" id="th-tab" data-bs-toggle="tab" data-bs-target="#tab-th2" role="tab" aria-controls="tab-th2" aria-selected="false" href="javascript:void(0);">TH</a>
                        <a class="nav-link" id="vn-tab" data-bs-toggle="tab" data-bs-target="#tab-vn2" role="tab" aria-controls="tab-vn2" aria-selected="false" href="javascript:void(0);">VN</a>
                        <!--<a class="nav-link" id="zh-tab" data-bs-toggle="tab" data-bs-target="#tab-zh2" role="tab" aria-controls="tab-zh2" aria-selected="false" href="javascript:void(0);">ZH</a>
                        <a class="nav-link" id="bgl-tab" data-bs-toggle="tab" data-bs-target="#tab-bgl2" role="tab" aria-controls="tab-bgl2" aria-selected="false" href="javascript:void(0);">BGL</a>
                        <a class="nav-link" id="bur-tab" data-bs-toggle="tab" data-bs-target="#tab-bur2" role="tab" aria-controls="tab-bur2" aria-selected="false" href="javascript:void(0);">BUR</a>
                        <a class="nav-link" id="in-tab" data-bs-toggle="tab" data-bs-target="#tab-in2" role="tab" aria-controls="tab-in2" aria-selected="false" href="javascript:void(0);">IN</a>-->
                    </nav>
                    <dl class="tab-content mt-2">
                        <dd class="tab-pane fade show active" id="tab-en2" role="tabpanel">
                            <textarea class="form-control" name="en"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-my2" role="tabpanel">
                            <textarea class="form-control" name="my"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-cn2" role="tabpanel">
                            <textarea class="form-control" name="cn"></textarea>
                        </dd>
                        <!--<dd class="tab-pane fade" id="tab-zh2" role="tabpanel">
                            <textarea class="form-control" name="zh"></textarea>
                        </dd>-->
                        <dd class="tab-pane fade" id="tab-th2" role="tabpanel">
                            <textarea class="form-control" name="th"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-vn2" role="tabpanel">
                            <textarea class="form-control" name="vn"></textarea>
                        </dd>
                        <!--<dd class="tab-pane fade" id="tab-bgl2" role="tabpanel">
                            <textarea class="form-control" name="bgl"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-bur2" role="tabpanel">
                            <textarea class="form-control" name="bur"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-in2" role="tabpanel">
                            <textarea class="form-control" name="in"></textarea>
                        </dd>-->
                    </dl>
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

<script src="<?=base_url('assets/vendors/ckeditor5/build/ckeditor.js');?>"></script>
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

    const announcementTable = $('#announcementTable').DataTable({
        dom: "<'row mb-3'<'col-xl-6 col-lg-6 col-md-6 col-12'l><'col-xl-6 col-lg-6 col-md-6 col-12'f>>" + "<'row'<'col-12'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
        ajax: {
            type : "GET",
            contentType: "application/json; charset=utf-8",
            url: "/list/announcement/sent",
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

    $('.modal-addRoll form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            const roles = [];
            $.each($(".modal-addRoll [name=trole]:checked"), function() {
                roles.push($(this).val());
            });

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/announcement/add', {
                params,roles
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { $('#announcementTable').DataTable().ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-addRoll').modal('toggle');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    const addRollEvent = document.getElementById('modal-addRoll');
    addRollEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });

    $('.modal-modifyRoll form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            const roles = [];
            $.each($(".modal-modifyRoll [name=trole]:checked"), function() {
                roles.push($(this).val());
            });

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/announcement/modify', {
                params,roles
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { $('#announcementTable').DataTable().ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-modifyRoll').modal('toggle');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    const modifyRollEvent = document.getElementById('modal-modifyRoll');
    modifyRollEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });
});

function modifyRoll(id)
{
    $('.modal-modifyRoll').modal('toggle');

    generalLoading();

    var params = {};
    params['id'] = id;

    $.post('/announcement/sent/get', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            $('.modal-modifyRoll [name=id]').val(btoa(obj.data.id));

            obj.data.targetRole.forEach(item => {
                if( item==3 ) { $('.modal-modifyRoll [name=trole]#role_agent2').prop('checked', true); }
                if( item==4 ) { $('.modal-modifyRoll [name=trole]#role_member2').prop('checked', true); }
                if( item==5 ) { $('.modal-modifyRoll [name=trole]#role_subacc2').prop('checked', true); }
            });

            obj.data.popUp==1 ? $('.modal-modifyRoll [name=popup]#pyes2').prop('checked', true) : $('.modal-modifyRoll [name=popup]#pno2').prop('checked', true);
            obj.data.status==1 ? $('.modal-modifyRoll [name=status]#astatus_yes2').prop('checked', true) : $('.modal-modifyRoll [name=status]#astatus_no2').prop('checked', true);

            obj.data.content.EN==null ? null : $('.modal-modifyRoll [name=en]').val(obj.data.content.EN);
            obj.data.content.MY==null ? null : $('.modal-modifyRoll [name=my]').val(obj.data.content.MY);
            obj.data.content.CN==null ? null : $('.modal-modifyRoll [name=cn]').val(obj.data.content.CN);
            //obj.data.content.ZH==null ? null : $('.modal-modifyRoll [name=zh]').val(obj.data.content.ZH);
            obj.data.content.TH==null ? null : $('.modal-modifyRoll [name=th]').val(obj.data.content.TH);
            obj.data.content.VN==null ? null : $('.modal-modifyRoll [name=vn]').val(obj.data.content.VN);
            //obj.data.content.BGL==null ? null : $('.modal-modifyRoll [name=bgl]').val(obj.data.content.BGL);
            //obj.data.content.BUR==null ? null : $('.modal-modifyRoll [name=bur]').val(obj.data.content.BUR);
            //obj.data.content.IN==null ? null : $('.modal-modifyRoll [name=in]').val(obj.data.content.IN);
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