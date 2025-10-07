<section class="card border-light shadow">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <div class="px-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-addBanner"><i class="las la-plus-circle me-1"></i><?=lang('Nav.addbanner');?></button>
        </div>

        <article class="card-text p-3">
            <table id="bannerTable" class="w-100 nowrap table table-sm table-bordered table-hover">
                <thead class="table-style">
                <tr>
                <th><?=lang('Input.status');?></th>
                <th><?=lang('Input.title');?></th>
                <th><?=lang('Input.image');?></th>
                <th><?=lang('Input.order');?></th>
                <th><?=lang('Label.createddate');?></th>
                <th><?=lang('Label.action');?></th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </article>
    </div>
</section>

<section class="modal fade modal-addBanner" id="modal-addBanner" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-addBanner" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.addbanner');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate']);?>
                <div class="mb-3">
                    <label><?=lang('Input.title');?></label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                <div class="mb-3">
                    <label><?=lang('Input.image');?></label>
                    <nav class="nav nav-tabs nav-fill">
                        <a class="nav-link active" id="en-tab" data-bs-toggle="tab" data-bs-target="#tab-en" role="tab" aria-controls="tab-en" aria-selected="true" href="javascript:void(0);">EN</a>
                        <a class="nav-link" id="my-tab" data-bs-toggle="tab" data-bs-target="#tab-my" role="tab" aria-controls="tab-my" aria-selected="false" href="javascript:void(0);">MY</a>
                        <a class="nav-link" id="cn-tab" data-bs-toggle="tab" data-bs-target="#tab-cn" role="tab" aria-controls="tab-cn" aria-selected="false" href="javascript:void(0);">CN</a>
                        <a class="nav-link" id="th-tab" data-bs-toggle="tab" data-bs-target="#tab-th" role="tab" aria-controls="tab-th" aria-selected="false" href="javascript:void(0);">TH</a>
                        <a class="nav-link" id="vn-tab" data-bs-toggle="tab" data-bs-target="#tab-vn" role="tab" aria-controls="tab-vn" aria-selected="false" href="javascript:void(0);">VN</a>
                    </nav>
                    <dl class="tab-content mb-0 mt-2">
                        <dd class="tab-pane fade show active" id="tab-en" role="tabpanel">
                            <textarea class="form-control" name="en" placeholder="https://image.example.com"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-my" role="tabpanel">
                            <textarea class="form-control" name="my" placeholder="https://image.example.com"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-cn" role="tabpanel">
                            <textarea class="form-control" name="cn" placeholder="https://image.example.com"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-th" role="tabpanel">
                            <textarea class="form-control" name="th" placeholder="https://image.example.com"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-vn" role="tabpanel">
                            <textarea class="form-control" name="vn" placeholder="https://image.example.com"></textarea>
                        </dd>
                    </dl>
                    <small class="form-text">
                        Upload images to <a target="_blank" href="https://imgur.com/">cloud</a>.<br/>
                        Image dimension: 1920px (width) x 516px (height)
                    </small>
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

<section class="modal fade modal-modifyBanner" id="modal-modifyBanner" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-modifyBanner" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.editbanner');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate'],['id'=>'']);?>
                <div class="mb-3">
                    <label><?=lang('Input.title');?></label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                <div class="mb-3 row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                        <label><?=lang('Input.order');?></label>
                        <input type="number" step="any" min="0" class="form-control" name="order" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label><?=lang('Input.image');?></label>
                    <nav class="nav nav-tabs nav-fill">
                        <a class="nav-link active" id="en-tab" data-bs-toggle="tab" data-bs-target="#tab-en2" role="tab" aria-controls="tab-en2" aria-selected="true" href="javascript:void(0);">EN</a>
                        <a class="nav-link" id="my-tab" data-bs-toggle="tab" data-bs-target="#tab-my2" role="tab" aria-controls="tab-my2" aria-selected="false" href="javascript:void(0);">MY</a>
                        <a class="nav-link" id="cn-tab" data-bs-toggle="tab" data-bs-target="#tab-cn2" role="tab" aria-controls="tab-cn2" aria-selected="false" href="javascript:void(0);">CN</a>
                        <a class="nav-link" id="th-tab" data-bs-toggle="tab" data-bs-target="#tab-th2" role="tab" aria-controls="tab-th2" aria-selected="false" href="javascript:void(0);">TH</a>
                        <a class="nav-link" id="vn-tab" data-bs-toggle="tab" data-bs-target="#tab-vn2" role="tab" aria-controls="tab-vn2" aria-selected="false" href="javascript:void(0);">VN</a>
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
                        <dd class="tab-pane fade" id="tab-th2" role="tabpanel">
                            <textarea class="form-control" name="th"></textarea>
                        </dd>
                        <dd class="tab-pane fade" id="tab-vn2" role="tabpanel">
                            <textarea class="form-control" name="vn"></textarea>
                        </dd>
                    </dl>
                    <small class="form-text">
                        Upload images to <a target="_blank" href="https://imgur.com/">cloud</a>.<br/>
                        Image dimension: 1920px (width) x 516px (height)
                    </small>
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

    const bannerTable = $('#bannerTable').DataTable({
        dom: "<'row mb-3'<'col-xl-6 col-lg-6 col-md-6 col-12'l><'col-xl-6 col-lg-6 col-md-6 col-12'f>>" + "<'row'<'col-12 overflow-auto'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
        ajax: {
            type : "GET",
            contentType: "application/json; charset=utf-8",
            url: "/list/banner",
            dataSrc: function(json) {
                if(json == "no data") {
                    return [];
                } else {
                    return json.data;
                }
            }
        },
        // responsive: {
        //     details: {
        //         renderer: $.fn.dataTable.Responsive.renderer.tableAll({
        //             tableClass: 'w-100 nowrap table table-sm table-bordered'
        //         })
        //     }
        // },
        language: langs,
        processing: true,
        stateSave: true,
        deferRender: true
    });

    $('.modal-addBanner form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $('.modal-addBanner [type=submit]').prop('disabled',true);

            $.post('/banner/add', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { bannerTable.ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-addBanner').modal('hide');
                $('.modal-addBanner [type=submit]').prop('disabled',false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => { $('.modal-addBanner [type=submit]').prop('disabled',false); });
            });
        }
    });

    const addBannerEvent = document.getElementById('modal-addBanner');
    addBannerEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });

    $('.modal-modifyBanner form').on('submit', function(e) {
        e.preventDefault();

        const category = [];
        $.each($('.modal-modifyBanner [name=gcate]:checked'), function() {
            category.push($(this).val());
        });

        if (this.checkValidity() !== false) {

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/banner/modify', {
                params, category
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { bannerTable.ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-modifyBanner').modal('toggle');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    const modifyBannerEvent = document.getElementById('modal-modifyBanner');
    modifyBannerEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });
});

function modifyBanner(id)
{
    $('.modal-modifyBanner').modal('toggle');
    $('.modal-modifyBanner [name=id]').val(id);

    var params = {};
    params['id'] = id;

    $.post('/banner/get', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            $('.modal-modifyBanner [name=title]').val(obj.data.name);
            $('.modal-modifyBanner [name=order]').val(obj.data.order);
            $('.modal-modifyBanner [name=en]').val(obj.data.imageUrl.EN);
            $('.modal-modifyBanner [name=my]').val(obj.data.imageUrl.MY);
            $('.modal-modifyBanner [name=cn]').val(obj.data.imageUrl.CN);
            $('.modal-modifyBanner [name=th]').val(obj.data.imageUrl.TH);
            $('.modal-modifyBanner [name=vn]').val(obj.data.imageUrl.VN);
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

function modifyBannerStatus(id, status)
{
    var params = {};
    params['id'] = id;
    params['status'] = status;

    $.post('/banner/status/modify', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            alertToast('bg-success', obj.message);
            $('#bannerTable').DataTable().ajax.reload(null,false);
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            alertToast('bg-danger', obj.message);
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => { $('#bannerTable').DataTable().ajax.reload(null,false); });
    });
}
</script>