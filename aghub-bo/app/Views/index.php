<main class="wrap-form-signin">
    <div class="form-signin">

        <h2 class="text-center text-uppercase text-dark mb-4">V2 Agent Hub</h2>
        <?=form_open('',['class'=>'form-validation loginForm','novalidate'=>'novalidate']);?>
        <div class="input-group mb-3 rounded shadow-vw">
            <span class="input-group-text" id="basic-addon1"><i class="bx bxs-user color-vw"></i></span>
            <input type="text" class="form-control" name="username" placeholder="<?=lang('Input.username');?>" required>
        </div>
        <div class="input-group mb-3 rounded shadow-vw">
            <span class="input-group-text" id="basic-addon1"><i class="bx bxs-lock color-vw"></i></span>
            <input type="password" class="form-control" name="password" placeholder="<?=lang('Input.password');?>" required>
        </div>
        <button type="submit" class="btn btn-primary btn-lg w-100"><?=lang('Nav.login');?></button>
        <small class="d-block text-center mt-3 color-vw2">Ver <?=$_ENV['appversion'];?></small>
        <?=form_close();?>

        <!-- Languages -->
        <section class="mt-2">
            <select class="form-select form-select-sm select-lang w-auto mx-auto" onchange="translation();">
            <option value="en" <?=$_SESSION['lang']=='en'?'selected':''?> >English</option>
            <option value="cn" <?=$_SESSION['lang']=='cn'?'selected':''?> >简体中文</option>
            <option value="my" <?=$_SESSION['lang']=='my'?'selected':''?> >Bahasa</option>
            </select>
        </section>
        <!-- End Languages -->

    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    $('.loginForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();
            $('.loginForm [type=submit]').prop('disabled', true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/user/login', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code==1 ) {
                    swal.close();
                    alertToast('bg-success', obj.message);
                    window.location.replace("<?=base_url('dashboard-hub');?>");
                } else {
                    alertToast('bg-warning', obj.message);
                    $('.loginForm [type=submit]').prop('disabled', false);
                }
            })
            .done(function() {
                swal.close();
                $('.loginForm [type=submit]').prop('disabled', false);
            })
            .fail(function() {
                $('.loginForm [type=submit]').prop('disabled', false);
                alertToast('bg-danger', obj.message);
            });
        }
    });
});
</script>