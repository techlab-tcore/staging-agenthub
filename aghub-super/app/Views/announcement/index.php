<section class="card border-light">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <div class="px-3">
            <button type="button" class="btn btn-primary bg-gradient" data-bs-toggle="modal" data-bs-target="#modal-addannc"><i class="las la-plus-circle me-1"></i>Add Announcement</button>
        </div>

        <article class="card-text p-3">
            <table id="anncTable" class="w-100 nowrap table table-sm table-bordered">
                <thead>
                <tr>
                <th>Created Date</th>
                <th>Status</th>
                <th>Pop Up</th>
                <th>Roles</th>
                <th class="none">EN</th>
                <th class="none">MY</th>
                <th class="none">CN</th>
                <th class="none">ZH</th>
                <th class="none">TH</th>
                <th class="none">VN</th>
                <th class="none">BGL</th>
                <th>Actions</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </article>
    </div>
</section>

<section class="modal fade modal-addannc" id="modal-addannc" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-addannc" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Announcement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate']);?>
                <div class="mb-3">
                    <label class="d-block">Pop Up</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="popup" id="popup_yes" value="1" required>
                        <label class="form-check-label" for="popup_yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="popup" id="popup_no" value="2">
                        <label class="form-check-label" for="popup_no">No</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="d-block">User Group</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="trole_admin" name="targetRole" value="2">
                        <label class="form-check-label" for="trole_admin">Administrator</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="trole_subacc" name="targetRole" value="5">
                        <label class="form-check-label" for="trole_subacc">Sub Account</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Content</label>
                    <nav class="nav nav-tabs nav-fill">
                        <a class="nav-link active" id="en-tab2" data-bs-toggle="tab" data-bs-target="#tab-en" role="tab" aria-controls="tab-en2" aria-selected="true" href="javascript:void(0);">EN</a>
                        <a class="nav-link" id="my-tab2" data-bs-toggle="tab" data-bs-target="#tab-my2" role="tab" aria-controls="tab-my2" aria-selected="false" href="javascript:void(0);">MY</a>
                        <a class="nav-link" id="cn-tab2" data-bs-toggle="tab" data-bs-target="#tab-cn2" role="tab" aria-controls="tab-cn2" aria-selected="false" href="javascript:void(0);">CN</a>
                        <a class="nav-link" id="zh-tab2" data-bs-toggle="tab" data-bs-target="#tab-zh2" role="tab" aria-controls="tab-zh2" aria-selected="false" href="javascript:void(0);">ZH</a>
                        <a class="nav-link" id="th-tab2" data-bs-toggle="tab" data-bs-target="#tab-th2" role="tab" aria-controls="tab-th2" aria-selected="false" href="javascript:void(0);">TH</a>
                        <a class="nav-link" id="vn-tab2" data-bs-toggle="tab" data-bs-target="#tab-vn2" role="tab" aria-controls="tab-vn2" aria-selected="false" href="javascript:void(0);">VN</a>
                        <a class="nav-link" id="bgl-tab2" data-bs-toggle="tab" data-bs-target="#tab-bgl2" role="tab" aria-controls="tab-bgl2" aria-selected="false" href="javascript:void(0);">BGL</a>
                    </nav>
                    <dl class="tab-content mt-2">
                        <dd class="tab-pane fade show active" id="tab-en2" role="tabpanel">
                            <textarea rows="5" class="form-control" name="en"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-my2" role="tabpanel">
                            <textarea rows="5" class="form-control" name="my"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-cn2" role="tabpanel">
                            <textarea rows="5" class="form-control" name="cn"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-zh2" role="tabpanel">
                            <textarea rows="5" class="form-control" name="zh"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-th2" role="tabpanel">
                            <textarea rows="5" class="form-control" name="th"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-vn2" role="tabpanel">
                            <textarea rows="5" class="form-control" name="vn"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-bgl2" role="tabpanel">
                            <textarea rows="5" class="form-control" name="bgl"></textarea>
                        </dd>
                    </dl>
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
    <div class="modal-dialog modal-fullscreen-lg-down modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Announcement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate'],['anid'=>'']);?>
                <div class="mb-3">
                    <label class="d-block">Status</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="ancstatus_active" value="1">
                        <label class="form-check-label" for="ancstatus_active">Active</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="ancstatus_inactive" value="2">
                        <label class="form-check-label" for="ancstatus_inactive">Inactive</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="d-block">User Group</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="targetRole" id="trole_admin" value="2">
                        <label class="form-check-label" for="trole_admin">Administrator</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="targetRole" id="trole_subacc" value="5">
                        <label class="form-check-label" for="trole_subacc">Sub Account</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="d-block">Pop Up</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="popup" id="popup_yes" value="1">
                        <label class="form-check-label" for="popup_yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="popup" id="popup_no" value="2" checked>
                        <label class="form-check-label" for="popup_no">No</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Content</label>
                    <nav class="nav nav-tabs nav-fill">
                        <a class="nav-link active" id="en-tab" data-bs-toggle="tab" data-bs-target="#tab-en" role="tab" aria-controls="tab-en" aria-selected="true" href="javascript:void(0);">EN</a>
                        <a class="nav-link" id="my-tab" data-bs-toggle="tab" data-bs-target="#tab-my" role="tab" aria-controls="tab-my" aria-selected="false" href="javascript:void(0);">MY</a>
                        <a class="nav-link" id="cn-tab" data-bs-toggle="tab" data-bs-target="#tab-cn" role="tab" aria-controls="tab-cn" aria-selected="false" href="javascript:void(0);">CN</a>
                        <a class="nav-link" id="zh-tab" data-bs-toggle="tab" data-bs-target="#tab-zh" role="tab" aria-controls="tab-zh" aria-selected="false" href="javascript:void(0);">ZH</a>
                        <a class="nav-link" id="th-tab" data-bs-toggle="tab" data-bs-target="#tab-th" role="tab" aria-controls="tab-th" aria-selected="false" href="javascript:void(0);">TH</a>
                        <a class="nav-link" id="vn-tab" data-bs-toggle="tab" data-bs-target="#tab-vn" role="tab" aria-controls="tab-vn" aria-selected="false" href="javascript:void(0);">VN</a>
                        <a class="nav-link" id="bgl-tab" data-bs-toggle="tab" data-bs-target="#tab-bgl" role="tab" aria-controls="tab-bgl" aria-selected="false" href="javascript:void(0);">BGL</a>
                    </nav>
                    <dl class="tab-content mt-2">
                        <dd class="tab-pane fade show active" id="tab-en" role="tabpanel">
                            <textarea rows="5" class="form-control" name="en"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-my" role="tabpanel">
                            <textarea rows="5" class="form-control" name="my"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-cn" role="tabpanel">
                            <textarea rows="5" class="form-control" name="cn"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-zh" role="tabpanel">
                            <textarea rows="5" class="form-control" name="zh"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-th" role="tabpanel">
                            <textarea rows="5" class="form-control" name="th"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-vn" role="tabpanel">
                            <textarea rows="5" class="form-control" name="vn"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-bgl" role="tabpanel">
                            <textarea rows="5" class="form-control" name="bgl"></textarea>
                        </dd>
                    </dl>
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

    const anncTable = $('#anncTable').DataTable({
        dom: "<'row mb-3'<'col-lg-6 col-md-6 col-12'l><'col-lg-6 col-md-6 col-12'f>>" + "<'row'<'col-12 overflow-auto'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
        responsive: {
            details: {
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table table-bordered'
                })
            }
        },
        language: langs,
        ordering: true,
        paging: true,
        deferRender: true,
        processing: true,
        destroy: true,
        ajax: {
            type : "GET",
            url: '/list/announcement/self',
            contentType:"application/json; charset=utf-8",
            dataSrc: function(json) {
                if(json == "no data") {
                    return [];
                } else {
                    return json.data;
                }
            }
        },
    });

    $('.modal-addannc form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            const roles = [];
            $.each($(".modal-addannc [name=targetRole]:checked"), function() {
                roles.push($(this).val());
            });

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['roles'] = roles;
            });

            $.post('/announcement/add', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { anncTable.ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-addannc').modal('toggle');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    const addanncEvent = document.getElementById('modal-addannc');
    addanncEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });

    $('.modal-modify form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            const roles = [];
            $.each($(".modal-modify [name=targetRole]:checked"), function() {
                roles.push($(this).val());
            });

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['roles'] = roles;
            });

            $.post('/announcement/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { anncTable.ajax.reload(null,false); });
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

    const modifyEvent = document.getElementById('modal-modify');
    modifyEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });
});

function editAnnouncement(anid)
{
    $('.modal-modify').modal('toggle');
    
    var params = {};
    params['anid'] = anid;

    $.post('/announcement/self/get', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            $('.modal-modify [name=anid]').val(btoa(obj.data.id));
            $('.modal-modify [name=en]').val(obj.data.content.EN);
            $('.modal-modify [name=my]').val(obj.data.content.MY);
            $('.modal-modify [name=cn]').val(obj.data.content.CN);
            $('.modal-modify [name=zh]').val(obj.data.content.ZH);
            $('.modal-modify [name=th]').val(obj.data.content.TH);
            $('.modal-modify [name=vn]').val(obj.data.content.VN);
            $('.modal-modify [name=bgl]').val(obj.data.content.BGL);

            obj.data.status==1 ? $('.modal-modify [name=status]#ancstatus_active').prop('checked',true) : $('.modal-modify [name=status]#ancstatus_inactive').prop('checked',true);
            obj.data.popUp==1 ? $('.modal-modify [name=popup]#popup_yes').prop('checked',true) : $('.modal-modify [name=popup]#popup_no').prop('checked',true);

            obj.data.targetRole.forEach(item => {
                item==2 ? $('.modal-modify [name=targetRole]#trole_admin').prop('checked', true) : '';
                item==3 ? $('.modal-modify [name=targetRole]#trole_subacc').prop('checked', true) : '';
            });
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
</script>