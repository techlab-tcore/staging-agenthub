<h4 class="p-3 bg-white fs-4 mb-3"><?=$secTitle;?></h4>

<section class="card border-vw">
    <h4 class="card-header bg-white border-vw d-flex justify-content-between"><?=lang('Label.fight');?> & <?=lang('Label.shares');?> <button type="button" class="btn btn-light btn-sm" onclick="companyPtps();"><i class="bx bx-search-alt"></i></button></h4>
    <div class="card-body">

        <?=form_open('',['class'=>'form-validation row g-3 align-items-center companyPtPsForm','novalidate'=>'novalidate']);?>
        <div class="input-group col-12">
            <span class="input-group-text"><?=lang('Input.sharesexpenses');?></span>
            <input type="text" class="form-control" name="psExpenses" value="<?=$psExpenses;?>" required>
        </div>
        <div class="input-group col-12">
            <span class="input-group-text"><?=lang('Label.shares');?>%</span>
            <input type="text" class="form-control" name="psPercentage" value="<?=$ps;?>" required>
        </div>
        <hr class="mt-3 mb-2 border-vw">
        <div class="input-group col-12">
            <span class="input-group-text"><?=lang('Input.fightexpenses');?></span>
            <input type="text" class="form-control" name="ptExpenses" value="<?=$ptExpenses;?>" required>
        </div>
        <div class="input-group col-12">
            <span class="input-group-text"><?=lang('Label.fight');?>%</span>
            <input type="text" class="form-control" name="ptPercentage" value="<?=$ptps;?>" required>
        </div>
        <hr class="mt-3 mb-2 border-vw">
        <div class="input-group col-12">
            <span class="input-group-text"><?=lang('Input.lottoexpenses');?></span>
            <input type="text" class="form-control" name="psLotteryExpenses" value="<?=$psLottoExpenses;?>" required>
        </div>
        <div class="col-xl-auto col-lg-auto col-md-auto col-12 ms-auto text-end">
            <button type="submit" class="btn btn-primary w-100"><?=lang('Nav.submit');?></button>
        </div>
        <?=form_close();?>

    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    $('.companyPtPsForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $('.companyPtPsForm [type=submit]').prop('disabled',true);

            $.post('/company/pt-ps/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => {
                        location.reload();
                    });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.companyPtPsForm [type=submit]').prop('disabled',false);
                // $('.depositCommForm').trigger('reset');
                $('.companyPtPsForm').removeClass('was-validated');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => {
                    $('.companyPtPsForm [type=submit]').prop('disabled',false);
                });
            });
        }
    });
});

async function companyPtps()
{
    $.get('/company/pt-ps', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {

        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
        
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => {
            
        });
    });
}
</script>