<section class="card border-light shadow">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <?=form_open('', ['class'=>'form-validation liveChatForm','novalidate'=>'novalidate']);?>
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="las la-headset me-1"></i><?=lang('Input.livechat');?></span>
            <input type="text" class="form-control" name="livechat" required>
            <button type="submit" class="btn btn-primary"><?=lang('Nav.submit');?></button>
        </div>
        <?=form_close();?>
        <hr>
        <div class="px-3">
            <a class="btn btn-primary me-1" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".modal-addWhatsapp"><i class="las la-plus-circle me-1"></i><?=lang('Nav.addwhatsapp');?></a>
        </div>

        <article class="card-text p-3">
            <table id="wsTable" class="w-100 table table-sm table-bordered table-hover">
                <thead class="table-style">
                <tr>
                <th><?=lang('Input.status');?></th>
                <th><?=lang('Input.fname');?></th>
                <th><?=lang('Input.contact');?></th>
                <th><?=lang('Input.order');?></th>
                <th class="none"><?=lang('Input.remark');?></th>
                <th><?=lang('Label.action');?></th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </article>
    </div>
</section>

<section class="modal fade modal-modifyCS" id="modal-modifyCS" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-modifyCS" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.editws');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation editWhatsappForm', 'novalidate'=>'novalidate'],['id'=>'']);?>
                <div class="mb-3">
                    <label class="d-block"><?=lang('Input.status');?></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="wsStatus_yes" value="1">
                        <label class="form-check-label" for="wsStatus_yes"><?=lang('Label.active');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="wsStatus_no" value="2" checked>
                        <label class="form-check-label" for="wsStatus_no"><?=lang('Label.inactive');?></label>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="required"><?=lang('Input.fname');?></label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="mb-3">
                    <label class="required"><?=lang('Input.contact');?></label>
                    <div class="input-group">
                        <span class="input-group-text">+<?=$_ENV['mobileCode'];?></span>
                        <input type="text" class="form-control" pattern="^[0-9]{10,}$" name="mobile" placeholder="e.g. <?=$_ENV['sampleMobile'];?>" required>
                        <small class="form-text"><?=lang('Validation.mobile',[10,11]);?></small>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="required"><?=lang('Input.order');?></label>
                    <input type="number" min="1" class="form-control" name="order" required>
                </div>
                <div class="mb-3">
                    <label class="required"><?=lang('Input.remark');?></label>
                    <textarea class="form-control" name="remark"></textarea>
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

<section class="modal fade modal-addWhatsapp" id="modal-addWhatsapp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-addWhatsapp" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.addwhatsapp');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation addWhatsappForm', 'novalidate'=>'novalidate']);?>
                <div class="mb-3">
                    <label class="required"><?=lang('Input.fname');?></label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="mb-3">
                    <label class="required"><?=lang('Input.contact');?></label>
                    <div class="input-group">
                        <span class="input-group-text">+<?=$_ENV['mobileCode'];?></span>
                        <input type="text" class="form-control" pattern="^[0-9]{10,}$" name="mobile" placeholder="e.g. <?=$_ENV['sampleMobile'];?>" required>
                        <small class="form-text"><?=lang('Validation.mobile',[10,11]);?></small>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="required"><?=lang('Input.remark');?></label>
                    <textarea class="form-control" name="remark"></textarea>
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

    getLiveChat();

    const wsTable = $('#wsTable').DataTable({
        dom: "<'row mb-3'<'col-xl-6 col-lg-6 col-md-6 col-12'l><'col-xl-6 col-lg-6 col-md-6 col-12'f>>" + "<'row'<'col-12'tr>>" + "<'row'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
        ajax: {
            type : "GET",
            contentType: "application/json; charset=utf-8",
            url: "/list/support",
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
                    tableClass: 'w-100 table table-bordered'
                })
            }
        },
        language: langs,
        processing: true,
        stateSave: true,
        deferRender: true
    });

    $('.addWhatsappForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/support/whatsapp/add', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => {
                        $('#wsTable').DataTable().ajax.reload(null,false);
                        $('.modal-addWhatsapp').modal('hide');
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
    });

    const addWhatsappEvent = document.getElementById('modal-addWhatsapp');
    addWhatsappEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });

    $('.editWhatsappForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/support/whatsapp/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => {
                        $('#wsTable').DataTable().ajax.reload(null,false);
                        $('.modal-modifyCS').modal('hide');
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
    });

    const modifyCSEvent = document.getElementById('modal-modifyCS');
    modifyCSEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });

    $('.liveChatForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/live-chat/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => {
                        $('.liveChatForm').removeClass('was-validated');
                        // $('.liveChatForm').trigger('reset');
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
    });
});

function modifyCS(id)
{
    $('.modal-modifyCS').modal('toggle');

    generalLoading();

    var params = {};
    params['id'] = id;

    $.post('/support/whatsapp/get', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            obj.data.status==1 ? $('.editWhatsappForm [name=status]#wsStatus_yes').prop('checked',true) : $('.editWhatsappForm [name=status]#wsStatus_no').prop('checked',true);

            $('.editWhatsappForm [name=id]').val(btoa(obj.data.id));
            $('.editWhatsappForm [name=name]').val(obj.data.name);
            $('.editWhatsappForm [name=mobile]').val(obj.data.mobileNumber);
            $('.editWhatsappForm [name=remark]').val(obj.data.remark);
            $('.editWhatsappForm [name=order]').val(obj.data.order);
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

function getLiveChat()
{
    $.get('/list/live-chat', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            $('.liveChatForm [name=livechat]').val(obj.liveChatUrl);
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