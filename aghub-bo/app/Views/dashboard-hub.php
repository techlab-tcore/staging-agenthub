<section class="card border-light shadow">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <article class="userCurrency card-text p-3 row gap-3">
            <?=$userCurrency;?>
        </article>
    </div>
</section>

<script>
function selectCurrencyKiosk(currencyCode)
{
    generalLoading();
    
    var params = {};
    params['currencycode'] = currencyCode;

    $.post('/kiosk/bycurrency', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            swal.close();
            window.location.replace("<?=base_url('user-search');?>");
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}
</script>
