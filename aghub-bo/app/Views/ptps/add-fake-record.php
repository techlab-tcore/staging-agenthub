<h4 class="p-3 bg-white fs-4 mb-3"><?=$secTitle;?></h4>

<section class="card border-vw">
    <div class="card-body">

        <?=form_open('', ['class'=>'form-validation addAdditionRecordForm mb-3', 'novalidate'=>'novalidate']);?>
        <div class="row gy-2 gx-3 align-items-center mb-3">
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <label><?=lang('Input.effectdate');?></label>
                <input type="text" class="form-control" name="settledate" required>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <label><?=lang('Label.jackpot');?></label>
                <input type="number" step="any" class="form-control" name="jackpot" value="0" required>
            </div>
        </div>
        <!-- <div class="row gy-2 gx-3 align-items-center"> -->
            <?=$gp?>
        <!-- </div> -->
        <div class="text-end">
            <button type="reset" class="btn btn-light"><?=lang('Nav.reset');?></button>
            <button type="submit" class="btn btn-primary"><?=lang('Nav.submit');?></button>
        </div>
        <?=form_close();?>

    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    airdatepicker();

    $('.addAdditionRecordForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            var gp = [];
            $('input[name="gp[]"]').each(function() {
                gp.push($(this).data('gp'));
            });

            var values = [];
            $('input[name="gp[]"]').each(function() {
                values.push($(this).val());
            });

            var values2 = [];
            $('input[name="gp[]"]').each(function() {
                values2.push($(this).val());
            });

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $('.addAdditionRecordForm [type=submit]').prop('disabled',true);

            $.post('/additional-record/add', {
                params, gp, values, values2
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => {
                        // const settledate = $('.filterForm [name=settledate]').val();
                        // compsumTable(settledate);
                    });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.addAdditionRecordForm [type=submit]').prop('disabled',false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => {
                    $('.addAdditionRecordForm [type=submit]').prop('disabled',false);
                });
            });
        }
    });
});
</script>