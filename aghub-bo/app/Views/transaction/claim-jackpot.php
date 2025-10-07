<div class="card border-light">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <article class="card-text p-3">

            <?=form_open('', ['class'=>'form-validation claimJackpotForm', 'novalidate'=>'novalidate'],['types'=>0]);?>
            <div class="mb-3">
                <label><?=lang('Input.username');?></label>
                <input type="text" class="form-control" name="uid" required>
            </div>
            <div class="mb-3">
                <label><?=lang('Input.redeempass');?></label>
                <input type="text" class="form-control" name="password">
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary"><?=lang('Nav.submit');?></button>
            </div>
            <?=form_close();?>

        </article>
    </div>
</div>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', (event) => {
    $('.claimJackpotForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            $('.claimJackpotForm [type=submit]').prop('disabled',true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/jackpot/claim', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                // console.log(obj);
                if( obj.code == 1 ) {
                    swal.fire("Success!", obj.message, "success").then(() => {
                        refreshProfile();
                    });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.claimJackpotForm [type=submit]').prop('disabled',false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });
});
</script>