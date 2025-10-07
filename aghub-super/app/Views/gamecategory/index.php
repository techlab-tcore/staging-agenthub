<section class="card border-light shadow">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?> - <?=$currencycode;?></h4>
    <div class="card-body">
        <article class="card-text p-3">
            <table id="gcategoryTable" class="w-100 nowrap table table-sm table-bordered">
                <thead>
                <tr>
                <th>Category</th>
                <th>Name</th>
                <th>Actions</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </article>
    </div>
</section>

<section class="modal fade modal-modify" id="modal-modify" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-modify" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modify Game Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate'],['code'=>'','currencycode'=>'']);?>
                <div class="mb-3">
                    <label>Category</label>
                    <input type="text" class="form-control" name="category">
                </div>
                <div class="row mb-3">
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
                        <label>မြန်မာ</label>
                        <input type="text" class="form-control" name="bur" required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 mb-3">
                        <label>Indonesia</label>
                        <input type="text" class="form-control" name="in" required>
                    </div>
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

    const gcategoryTable = $('#gcategoryTable').DataTable({
        dom: "<'row mb-3'<'col-lg-6 col-md-6 col-12 d-lg-inline-block d-md-inline-block d-none'l><'col-lg-6 col-md-6 col-12'f>>" + "<'row'<'col-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        ajax: {
            type : "POST",
            url: "/list/game-category",
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

    $('.modal-modify form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['parent'] = '<?=$parent;?>';
            });

            $.post('/game-category/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { gcategoryTable.ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-modify').modal('hide');
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
        document.getElementById("cateList2").innerHTML = '';
    });
});

function modify(code, $currencyCode)
{
    $('.modal-modify').modal('toggle');
    $('.modal-modify [name=code]').val(code);
    $('.modal-modify [name=currencycode]').val($currencyCode);

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
    params['currencycode'] = $currencyCode;
    params['code'] = code;

    $.post('/game-category/get', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            document.getElementsByName("category")[0].value = obj.data.name;
            document.getElementsByName("en")[0].value = obj.data.value.EN;
            document.getElementsByName("my")[0].value = obj.data.value.MY;
            document.getElementsByName("cn")[0].value = obj.data.value.CN;
            document.getElementsByName("zh")[0].value = obj.data.value.ZH;
            document.getElementsByName("th")[0].value = obj.data.value.TH;
            document.getElementsByName("vn")[0].value = obj.data.value.VN;
            document.getElementsByName("bgl")[0].value = obj.data.value.BGL;
            document.getElementsByName("bur")[0].value = obj.data.value.BUR;
            document.getElementsByName("in")[0].value = obj.data.value.IN;
            swal.close();
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => { $('.modal-modify').modal('hide'); });
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}
</script>