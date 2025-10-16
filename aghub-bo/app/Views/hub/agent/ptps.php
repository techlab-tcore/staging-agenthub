<h4 class="p-3 bg-white fs-4 mb-3"><?=$secTitle;?></h4>

<dl class="row gy-2 gx-3 align-items-center">
    <!--
    <dd class="col-xl-6 col-lg-6 col-md-6 col-12">
        <section class="card border-vw">
            <h4 class="card-header bg-white border-vw d-flex justify-content-between"><?//=lang('Input.fightexpenses');?> <button type="button" class="btn btn-light btn-sm" onclick="agFightExpenses();"><i class="bx bx-search-alt"></i></button></h4>
            <div class="card-body">

                <?//=form_open('',['class'=>'form-validation row align-items-center agentFightExpensesForm','novalidate'=>'novalidate']);?>
                <label><?//=lang('Input.fightexpenses');?></label>
                <div class="input-group mb-3">
                    <span class="input-group-text minFightExpenses">0</span>
                    <input type="text" class="form-control" name="ptExpenses" value="<?//=$ptExpenses;?>" required>
                    <span class="input-group-text maxFightExpenses">0</span>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-100"><?//=lang('Nav.submit');?></button>
                </div>
                <?//=form_close();?>

            </div>
        </section>
    </dd>
    -->
    <dd class="col-xl-6 col-lg-6 col-md-6 col-12">
        <section class="card border-vw">
            <h4 class="card-header bg-white border-vw d-flex justify-content-between"><?=lang('Input.sharesexpenses');?> <button type="button" class="btn btn-light btn-sm" onclick="agSharesExpenses();"><i class="bx bx-search-alt"></i></button></h4>
            <div class="card-body">

                <?=form_open('',['class'=>'form-validation row align-items-center agentSharesExpensesForm','novalidate'=>'novalidate']);?>
                <label><?=lang('Input.sharesexpenses');?></label>
                <div class="input-group mb-3">
                    <span class="input-group-text minSharesExpenses">0</span>
                    <input type="text" class="form-control" name="psExpenses" value="<?=$psExpenses;?>" required>
                    <span class="input-group-text maxSharesExpenses">0</span>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-100"><?=lang('Nav.submit');?></button>
                </div>
                <?=form_close();?>

            </div>
        </section>
    </dd>
    <!--
    <dd class="col-xl-6 col-lg-6 col-md-6 col-12">
        <section class="card border-vw">
            <h4 class="card-header bg-white border-vw d-flex justify-content-between"><?//=lang('Input.lottoexpenses');?> <button type="button" class="btn btn-light btn-sm" onclick="agLotteryExpenses();"><i class="bx bx-search-alt"></i></button></h4>
            <div class="card-body">

                <?//=form_open('',['class'=>'form-validation row align-items-center agentLottoExpensesForm','novalidate'=>'novalidate']);?>
                <label><?//=lang('Input.lottoexpenses');?></label>
                <div class="input-group mb-3">
                    <span class="input-group-text minLottoExpenses">0</span>
                    <input type="text" class="form-control" name="psLottoExpenses" value="<?//=$psLottoExpenses;?>" required>
                    <span class="input-group-text maxLottoExpenses">0</span>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-100"><?//=lang('Nav.submit');?></button>
                </div>
                <?//=form_close();?>

            </div>
        </section>
    </dd>
    -->
</dl>

<!--
<section class="card border-vw mt-3">
    <h4 class="card-header bg-white border-vw">Shares%</h4>
    <div class="card-body">
        <table id="userTable" class="w-100 table table-sm table-bordered table-hover">
        <thead>
            <tr>
            <th>Games</th>
            </tr>
        </thead>
        <tfoot></tfoot>
        <tbody></tbody>
        </table>
    </div>
</section>
-->

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    getAgMinMaxFightExpenses();
    // agFightExpenses();
    // agSharesExpenses();

    $('.agentLottoExpensesForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['parent'] = '<?=$parent;?>';
            });

            $('.agentLottoExpensesForm [type=submit]').prop('disabled',true);

            $.post('/agent/lottery-expenses/modify', {
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
                $('.agentLottoExpensesForm [type=submit]').prop('disabled',false);
                // $('.depositCommForm').trigger('reset');
                $('.agentLottoExpensesForm').removeClass('was-validated');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => {
                    $('.agentLottoExpensesForm [type=submit]').prop('disabled',false);
                });
            });
        }
    });

    $('.agentFightExpensesForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['parent'] = '<?=$parent;?>';
            });

            $('.agentFightExpensesForm [type=submit]').prop('disabled',true);

            $.post('/agent/fight-expenses/modify', {
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
                $('.agentFightExpensesForm [type=submit]').prop('disabled',false);
                // $('.depositCommForm').trigger('reset');
                $('.agentFightExpensesForm').removeClass('was-validated');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => {
                    $('.agentFightExpensesForm [type=submit]').prop('disabled',false);
                });
            });
        }
    });

    $('.agentSharesExpensesForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['parent'] = '<?=$parent;?>';
            });

            $('.agentSharesExpensesForm [type=submit]').prop('disabled',true);

            $.post('/agent/ps-expenses/modify', {
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
                $('.agentSharesExpensesForm [type=submit]').prop('disabled',false);
                // $('.depositCommForm').trigger('reset');
                $('.agentSharesExpensesForm').removeClass('was-validated');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => {
                    $('.agentSharesExpensesForm [type=submit]').prop('disabled',false);
                });
            });
        }
    });
});

function getAgMinMaxSharesLottoExpenses()
{
    var params = {};
    params['parent'] = '<?=$parent;?>';

    $.post('/agent/lottery-expenses/min-max', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            $('.minLottoExpenses').html(obj.minPS);
            $('.maxLottoExpenses').html(obj.maxPS);
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

async function agLotteryExpenses()
{
    var params = {};
    params['parent'] = '<?=$parent;?>';

    $.post('/agent/lottery-expenses', {
        params
    }, function(data, status) {
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

async function getAgMinMaxFightExpenses()
{
    var params = {};
    params['parent'] = '<?=$parent;?>';

    $.post('/agent/fight-expenses/min-max', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            $('.minFightExpenses').html(obj.minPS);
            $('.maxFightExpenses').html(obj.maxPS);

            getAgMinMaxSharesExpenses();
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

async function agFightExpenses()
{
    var params = {};
    params['parent'] = '<?=$parent;?>';

    $.post('/agent/fight-expenses', {
        params
    }, function(data, status) {
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

function getAgMinMaxSharesExpenses()
{
    var params = {};
    params['parent'] = '<?=$parent;?>';

    $.post('/agent/ps-expenses/min-max', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            $('.minSharesExpenses').html(obj.minPS);
            $('.maxSharesExpenses').html(obj.maxPS);

            getAgMinMaxSharesLottoExpenses();
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

async function agSharesExpenses()
{
    var params = {};
    params['parent'] = '<?=$parent;?>';

    $.post('/agent/pt-ps', {
        params
    }, function(data, status) {
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