<section class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast hide align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</section>

<section class="modal fade modal-selfmodify" id="modal-selfmodify" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-selfmodify" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate'], ['uid'=>'']);?>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label">Username</label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <input type="text" class="form-control-plaintext" name="username" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label">Contact</label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <input type="text" class="form-control" name="contact">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label">Telegram</label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <input type="text" class="form-control" name="telegram">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label">Remark</label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <textarea class="form-control" name="remark"></textarea>
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

<section class="modal fade modal-changePass" id="modal-changePass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-changePass" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('',['class'=>'form-validation changePassForm', 'novalidate'=>'novalidate']);?>
                <div class="mb-3 row">
                    <label class="col-lg-5 col-lg-5 col-12 col-form-label">Current Password</label>
                    <div class="col-lg-7 col-md-7 col-12">
                        <div class="input-group">
                            <input type="password" class="form-control" pattern=".{6,}" name="currentloginpass" id="currentloginpass" placeholder="Min.6 characters" required>
                            <button type="button" class="btn btn-primary bg-gradient" data-bs-toggle="button" autocomplete="off" onclick="showhidepass('currentloginpass')">Show</button>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-lg-5 col-lg-5 col-12 col-form-label">New Password</label>
                    <div class="col-lg-7 col-md-7 col-12">
                        <div class="input-group">
                            <input type="password" class="form-control" pattern=".{6,}" name="newloginpass" id="newloginpass" placeholder="Min.6 characters" required>
                            <button type="button" class="btn btn-primary bg-gradient" data-bs-toggle="button" autocomplete="off" onclick="showhidepass('newloginpass')">Show</button>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-lg-5 col-lg-5 col-12 col-form-label">Confirm New Password</label>
                    <div class="col-lg-7 col-md-7 col-12">
                        <div class="input-group">
                            <input type="password" class="form-control" pattern=".{6,}" name="newcloginpass" id="newcloginpass" placeholder="Min.6 characters" required>
                            <button type="button" class="btn btn-primary bg-gradient" data-bs-toggle="button" autocomplete="off" onclick="showhidepass('newcloginpass')">Show</button>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <button type="reset" class="btn btn-light bg-gradient">Reset</button>
                    <button type="submit" class="btn btn-primary bg-gradient">Submit</button>
                </div>
                <?=form_close();?>
            </div>
        </div>
    </div>
</section>

<script src="<?=base_url('assets/vendors/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
<script src="<?=base_url('assets/vendors/sweetalert2/sweetalert2.min.js');?>"></script>
<script src="<?=base_url('assets/vendors/airdatepicker/js/datepicker.min.js');?>"></script>
<script src="<?=base_url('assets/vendors/airdatepicker/js/i18n/datepicker.en.js');?>"></script>
<script src="<?=base_url('assets/vendors/airdatepicker/js/i18n/datepicker.zh.js');?>"></script>
<script src="<?=base_url('assets/js/master.js?v='.rand());?>"></script>
</body>
</html>

<?php if( isset($_SESSION['logged_in']) ): ?>
<script>
document.addEventListener('DOMContentLoaded', (event) => {
    const changepassEvent = document.getElementById('modal-changePass');
    changepassEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });

    $('.modal-changePass form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            swal.fire({
                title: 'Updating Credential...',
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                customClass: {
                    container: 'bg-major'
                }
            });

            $('.changePassForm [type=submit]').prop('disabled',true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/self/password/change', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                // console.log(obj);
                if( obj.code == 1 ) {
                    alertToast('bg-success', obj.message);
                } else {
                    alertToast('bg-danger', obj.message);
                }
            })
            .done(function() {
                swal.close();
                $('.changePassForm [type=submit]').prop('disabled',false);
                $('.modal-changePass').modal('toggle');
            })
            .fail(function() {
                alertToast('bg-danger', obj.message);
            });

            $('.changePassForm').removeClass('was-validated');
            $('.changePassForm').trigger('reset');
        }
    });

    const selfmodifyEvent = document.getElementById('modal-selfmodify');
    selfmodifyEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });
    selfmodifyEvent.addEventListener('shown.bs.modal', function (event) {
        selfProfile();
    });

    $('.modal-selfmodify form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            swal.fire({
                title: 'Updating...',
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                customClass: {
                    container: 'bg-major'
                }
            });

            $('.modal-selfmodify [type=submit]').prop('disabled',true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['uid'] = btoa('<?=$_SESSION['token'];?>');
            });

            $.post('/user/personal/change', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                // console.log(obj);
                if( obj.code == 1 ) {
                    alertToast('bg-success', obj.message);
                } else {
                    alertToast('bg-danger', obj.message);
                }
            })
            .done(function() {
                swal.close();
                $('.modal-selfmodify [type=submit]').prop('disabled',false);
                $('.modal-selfmodify').modal('toggle');
            })
            .fail(function() {
                alertToast('bg-danger', obj.message);
            });
        }
    });
});

function selfProfile()
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
    params['uid'] = btoa('<?=$_SESSION['token'];?>');

    $.post('/user/profile', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            $('.modal-selfmodify form [name=username]').val('<?=$_SESSION['username'];?>');
            $('.modal-selfmodify form [name=contact]').val(obj.data.contact);
            $('.modal-selfmodify form [name=telegram]').val(obj.data.telegram);
            $('.modal-selfmodify form [name=remark]').val(obj.data.remark);
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
        alertToast('bg-danger', obj.message);
    });
}
</script>
<?php endif; ?>