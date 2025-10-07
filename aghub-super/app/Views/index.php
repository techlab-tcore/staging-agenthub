<main class="wrap-form-signin">
    <div class="container text-center form-signin">

        <?=form_open('', ['class'=>'needs-validation pt-5 loginForm']);?>
        <h1 class="h3 mb-3 fw-normal">Please Sign In</h1>
        <input type="text" class="form-control" placeholder="Username" name="username" pattern=".{6,}" required autofocus>
        <input type="password" class="form-control" placeholder="Password" name="password" id="password" pattern=".{6,}" required>
        <div class="form-check my-3">
            <input class="form-check-input float-none" type="checkbox" id="loginshowpass" onclick="showhidepass('password')">
            <label class="form-check-label" for="loginshowpass">Show Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary bg-gradient" type="submit"><i class="las la-lock"></i>LOG IN</button>
        <small class="d-block mt-2 text-muted">&copy; 2018 - <?=date('Y');?> <span class="badge bg-secondary">ver <?=$_ENV['appversion']?></span></small>
        <?=form_close();?>

    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    $('.loginForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
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
                    alertToast('bg-success', obj.message);
                    window.location.replace("<?=base_url('dashboard');?>");
                } else {
                    $('.loginForm [type=submit]').prop('disabled', false);
                    alertToast('bg-warning', obj.message);
                }
            })
            .done(function() {
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