<div class="card border-light">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <article class="card-text p-3">
        
            <dl class="row mb-0">
                <dd class="col-xl-5 col-lg-5 col-md-12 col-12">
                    <?=form_open('',['class'=>'form-validation addSubAccForm', 'novalidate'=>'novalidate']);?>
                    <div class="mb-3 row">
                        <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label"><?=lang('Input.username');?></label>
                        <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><?=strtoupper($_SESSION['username']);?>SUB</span>
                                <input type="text" class="form-control" pattern="[A-Z0-9]{4,}" name="username" onkeyup="this.value = this.value.toUpperCase();" required>
                                <small class="form-text"><?=lang('Validation.username',[6,12]);?></small>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label"><?=lang('Input.password');?></label>
                        <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                            <div class="input-group">
                                <input type="password" class="form-control" pattern=".{6,}" name="password" id="password" required>
                                <button type="button" class="btn btn-primary" data-bs-toggle="button" autocomplete="off" onclick="showhidepass('password')"><?=lang('Nav.show');?></button>
                            </div>
                            <small class="form-text"><?=lang('Validation.password',[6]);?></small>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label"><?=lang('Input.fname');?></label>
                        <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                            <input type="text" class="form-control" pattern="^[a-zA-Z ]{3,}$" name="fname" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label"><?=lang('Input.contact');?></label>
                        <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                            <input type="tel" class="form-control" pattern="[0-9]{10,}" name="contact" placeholder="e.g.<?=$_ENV['sampleMobile'];?>" required>
                            <small class="form-text"><?=lang('Validation.mobile',[10,11]);?></small>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-xl-4 col-lg-4 col-md-4 col-12 col-form-label"><?=lang('Input.remark');?></label>
                        <div class="col-xl-8 col-lg-8 col-md-8 col-12">
                            <textarea class="form-control" name="remark"></textarea>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="reset" class="btn btn-light bg-gradient"><?=lang('Nav.reset');?></button>
                        <button type="submit" class="btn btn-primary"><?=lang('Nav.submit');?></button>
                    </div>
                    <?=form_close();?>
                </dd>
            </dl>
            
        </article>
    </div>
</div>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', (event) => {
    $('.addSubAccForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            $('.addSubAccForm [type=submit]').prop('disabled',true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/user/sub-account/add', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                // console.log(obj);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success");
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.addSubAccForm [type=submit]').prop('disabled',false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });

            $('.addSubAccForm').removeClass('was-validated');
            $('.addSubAccForm').trigger('reset');
        }
    });
});
</script>