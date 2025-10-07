<section class="card border-light shadow">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <article class="card-text p-3">
        
            <dl class="row mb-0">
                <dd class="col-xl-6 col-lg-6 col-md-6 col-12">
                    <?=form_open('',['class'=>'form-validation addAdminForm', 'novalidate'=>'novalidate']);?>
                    <div class="mb-3 row">
                        <label class="col-xl-3 col-lg-3 col-md-3 col-12 col-form-label">API URL</label>
                        <div class="col-xl-9 col-lg-9 col-md-9 col-12">
                            <input type="text" class="form-control" name="apiurl" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-xl-3 col-lg-3 col-md-3 col-12 col-form-label">Lobby URL</label>
                        <div class="col-xl-9 col-lg-9 col-md-9 col-12">
                            <input type="text" class="form-control" name="lobbyurl" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-xl-3 col-lg-3 col-md-3 col-12 col-form-label">Username</label>
                        <div class="col-xl-9 col-lg-9 col-md-9 col-12">
                            <input type="text" class="form-control" pattern=".{6,}" name="username" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-xl-3 col-lg-3 col-md-3 col-12 col-form-label">Password</label>
                        <div class="col-xl-9 col-lg-9 col-md-9 col-12">
                            <div class="input-group">
                                <input type="password" class="form-control" pattern=".{6,}" name="password" id="password" required>
                                <button type="button" class="btn btn-primary bg-gradient" data-bs-toggle="button" autocomplete="off" onclick="showhidepass('password')">Show</button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-xl-3 col-lg-3 col-md-3 col-12 col-form-label">Name</label>
                        <div class="col-xl-9 col-lg-9 col-md-9 col-12">
                            <input type="text" class="form-control" name="fname" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-xl-3 col-lg-3 col-md-3 col-12 col-form-label">Contact</label>
                        <div class="col-xl-9 col-lg-9 col-md-9 col-12">
                            <div class="input-group">
                            <select class="form-select" name="regioncode">
                                <option value="MYR">(MYR) +60</option>
                                <option value="SGD">(SGD) +65</option>
                                <option value="HKD">(HKD) +852</option>
                                <option value="JPN">(JPN) +81</option>
                                <option value="THB">(THB) +66</option>
                                <option value="VND">(VND) +84</option>
                            </select>
                            <input type="tel" class="form-control" name="contact" required>
                        </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-xl-3 col-lg-3 col-md-3 col-12 col-form-label">Currency Code</label>
                        <div class="col-xl-9 col-lg-9 col-md-9 col-12">
                            <select class="form-select" name="currencycode">
                            <option value="0">MYR</option>
                            <option value="1">VND</option>
                            <option value="2">EUSDT</option>
                            <option value="3">TUSDT</option>
                            <option value="4">BTC</option>
                            <option value="5">USD</option>
                            <option value="8">SGD</option>
                            <option value="10">THB</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-xl-3 col-lg-3 col-md-3 col-12 col-form-label">Telegram</label>
                        <div class="col-xl-9 col-lg-9 col-md-9 col-12">
                            <input type="text" class="form-control" name="telegram">
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="reset" class="btn btn-light bg-gradient">Reset</button>
                        <button type="submit" class="btn btn-primary bg-gradient">Submit</button>
                    </div>
                    <?=form_close();?>
                </dd>
            </dl>
            
        </article>
    </div>
</section>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', (event) => {
    //currencies();

    $('.addAdminForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            swal.fire({
                title: 'Creating Company...',
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                customClass: {
                    container: 'bg-major'
                }
            });

            $('.addAdminForm [type=submit]').prop('disabled',true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/administrator/build', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                console.log(obj);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success");
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.addAdminForm [type=submit]').prop('disabled',false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });

            $('.addAdminForm').removeClass('was-validated');
            $('.addAdminForm').trigger('reset');
        }
    });
});

function currencies()
{
    var params = {};
    params['currencycode'] = 'MYR';

    $.post('/currencies', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            const cu = obj.data;
            cu.forEach(function(item, index) {
                var node = document.createElement("option");
                var textnode = document.createTextNode(item.name + ' (' + item.code + ')');
                node.setAttribute("value", item.code);
                node.appendChild(textnode);
                document.getElementById("regioncode").appendChild(node);
            });
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