<h4 class="p-3 bg-white fs-4"><?=$secTitle;?> - <?=$currencycode;?></h4>

<section class="card border-white">
    <a class="card-header bg-white border-white text-decoration-none fw-bold text-dark d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href=".gamePt" aria-expanded="false" aria-controls="gamePt">Master Settings<i class="las la-arrows-alt-v"></i></a>
    <div class="card-body gamePt collapse show">
        <?=form_open('',['class'=>'form-validation row row-cols-lg-auto g-3 align-items-center modifyMasterGamePtForm', 'novalidate'=>'novalidate']);?>
        <div class="col-xl-auto col-lg-auto col-md-auto col-12 mt-0 mb-3">
            <div class="input-group">
                <span class="input-group-text">Game Provider</span>
                <input type="number" step="any" min="0" class="form-control" name="gamept" placeholder="0" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary bg-gradient ms-lg-3 ms-md-3 ms-0 mt-0 mb-3">Submit</button>
        <?=form_close();?>
    </div>
</section>

<section class="card border-white mt-2">
    <a class="card-header bg-white border-white text-decoration-none fw-bold text-dark d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href=".providerpt" aria-expanded="false" aria-controls="providerpt">Game Provider List<i class="las la-arrows-alt-v"></i></a>
    <article class="card-body providerpt collapse show">
        <table id="gameptTable" class="w-100 nowrap table table-sm table-bordered">
        <thead>
            <tr>
            <th>Games</th>
            <th>Position Taking</th>
            <th>Username</th>
            <th>Modified Date</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
        </table>
    </article>
</section>

<section class="modal fade modal-modify" id="modal-modify" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-modify" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Position Taking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation modifyPtForm', 'novalidate'=>'novalidate'], ['code'=>'','currencycode'=>'']);?>
                <small>Position Taking</small>
                <label class="form-label d-block fs-4 fw-bold gameName"></label>
                <div class="input-group">
                    <span class="input-group-text minGamePt">0</span>
                    <input type="number" step="any" min="0" class="form-control" name="gamept" required>
                    <span class="input-group-text maxGamePt">0</span>
                </div>
                <div class="d-grid gap-2 mt-3">
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

    const gameptTable = $('#gameptTable').DataTable({
        dom: "<'row mb-3'<'col-xl-6 col-lg-6 col-md-6 col-12'l><'col-xl-6 col-lg-6 col-md-6 col-12'f>>" + "<'row'<'col-12'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
        ajax: {
            type : "POST",
            url: "/list/game-provider/position-taking",
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
                    tableClass: 'nowrap table table-bordered'
                })
            }
        },
        language: langs,
        retrieve: true,
        processing: true,
        stateSave: true,
        deferRender: true,
        destroy: true
    });

    const modifyEvent = document.getElementById('modal-modify');
    modifyEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
        $('.minGamePt').html('0');
        $('.maxGamePt').html('0');
    });

    $('.modal-modify form').on('submit', function(e) {
        e.preventDefault();
    
        var params = {};
        var formObj = $(this).closest("form");
        $.each($(formObj).serializeArray(), function (index, value) {
            params[value.name] = value.value;
            params['uid'] = '<?=$parent;?>';
        });

        if (this.checkValidity() !== false) {
            $('.modal-modify form [type=submit]').prop('disabled',true);

            $.post('/game-provider/position-taking/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                // console.log(obj);
                if( obj.code == 1 ) {
                    swal.fire("Success!", obj.message, "success").then(() => { $('#gameptTable').DataTable().ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-modify').modal('toggle');
                $('.modal-modify form [type=submit]').prop('disabled',false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    $('.modifyMasterGamePtForm').on('submit', function(e) {
        e.preventDefault();
    
        var params = {};
        var formObj = $(this).closest("form");
        $.each($(formObj).serializeArray(), function (index, value) {
            params[value.name] = value.value;
            params['parent'] = '<?=$parent;?>';
            params['currencycode'] = '<?=$currencycode;?>';
        });

        if (this.checkValidity() !== false) {
            $('.modifyMasterGamePtForm [type=submit]').prop('disabled',true);

            $.post('/game-provider/position-taking/master/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                // console.log(obj);
                if( obj.code == 1 ) {
                    swal.fire("Success!", obj.message, "success").then(() => { $('#gameptTable').DataTable().ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modifyMasterGamePtForm [type=submit]').prop('disabled',false);
                $('.modifyMasterGamePtForm').removeClass('was-validated');
                $('.modifyMasterGamePtForm').trigger('reset');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => { $('.modifyMasterGamePtForm [type=submit]').prop('disabled',false); });
            });
        }
    });
});

function showMinMax(code,name,pt,currencyCode)
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

    $('.modal-modify').modal('toggle');
    $('.modal-modify [name=code]').val(code);
    $('.modal-modify [name=currencycode]').val(currencyCode);
    $('.modal-modify [name=gamept]').val(pt);
    $('.modal-modify .gameName').html(name);

    var params = {};
    params['uid'] = '<?=$parent;?>';
    params['code'] = code;
    params['currencycode'] = currencyCode;

    $.post('/game-provider/position-taking/minmax', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            $('.modal-modify [name=gamept]').attr('min',obj.minPt);
            $('.modal-modify [name=gamept]').attr('max',obj.maxPt);

            $('.modal-modify .minGamePt').html(obj.minPt);
            $('.modal-modify .maxGamePt').html(obj.maxPt);
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