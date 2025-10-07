<section class="card border-light">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <article class="card-text p-3">
            <?=form_open('', ['class'=>'row gy-2 gx-3 align-items-center filterForm pb-3', 'novalidate'=>'novalidate']);?>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <div class="input-group">
                    <span class="input-group-text"><?=lang('Input.gameid');?></span>
                    <input type="text" class="form-control" name="gameid">
                </div>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <div class="input-group">
                    <span class="input-group-text"><?=lang('Label.games');?></span>
                    <select class="form-select" id="gameprovider" name="gameprovider"></select>
                </div>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <button type="submit" class="btn btn-primary w-100"><?=lang('Nav.search');?></button>
            </div>
            <?=form_close();?>

            <table id="userTable" class="w-100 table table-sm table-bordered table-hover">
            <thead class="table-style">
            <tr>
            <th><?=lang('Input.username');?></th>
            <th><?=lang('Input.fname');?></th>
            <th class="none">#UID</th>
            <th class="none"><?=lang('Input.status');?></th>
            <th><?=lang('Label.balance');?></th>
            <th class="none"><?=lang('Label.vaultbalance');?></th>
            <th class="none"><?=lang('Input.contact');?></th>
            <th class="none"><?=lang('Input.telegram');?></th>
            <th class="none"><?=lang('Label.lastlogindate');?></th>
            <th class="none"><?=lang('Label.createddate');?></th>
            <th class="none"><?=lang('Input.remark');?></th>
            <th><?=lang('Label.action');?></th>
            </tr>
            </thead>
            <tbody></tbody>
            </table>
        </article>
    </div>
</section>

<!--FREE CREDIT -->
<section class="modal fade modal-withdrawFreeCredit" id="modal-withdrawFreeCredit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-withdrawFreeCredit" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Withdraw Credit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation clearCreditForm', 'novalidate'=>'novalidate','autocomplete'=>'off'],['uid'=>'']);?>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Label.games');?></label>
                    <div class="col-8">
                        <select class="form-select" name="gpCode" id="select-gpcode" required>
                        <option value="">--Choose--</option>
                        <option value="MVP">VPower</option>
                        <option value="MAVT">Avatar</option>
                        <option value="MCLP">Lengend Slot</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Input.amount');?></label>
                    <div class="col-8">
                        <input type="text" class="form-control-plaintext text-primary fw-semibold" name="amount" value="0" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Input.username');?></label>
                    <div class="col-8">
                        <input type="text" class="form-control-plaintext" name="username" readonly>
                    </div>
                </div>
                <div class="text-end">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal"><?=lang('Nav.close');?></button>
                    <button type="submit" class="btn btn-primary"><?=lang('Nav.submit');?></button>
                </div>
                <?=form_close();?>
            </div>
        </div>
    </div>
</section>

<script src="<?=base_url('assets/vendors/echart/dist/echarts.min.js');?>"></script>

<link rel="stylesheet" href="<?=base_url('assets/vendors/datatable/datatables.min.css');?>">
<script src="<?=base_url('assets/vendors/datatable/datatables.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/table_lang.js');?>"></script>
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', (event) => {
    if( '<?=$_SESSION['lang']?>' == 'my' ) {
        langs = malay;
    } else if( '<?=$_SESSION['lang']?>' == 'cn' ) {
        langs = chinese;
    } else if( '<?=$_SESSION['lang']?>' == 'zh' ) {
        langs = tradchinese;
    } else if( '<?=$_SESSION['lang']?>' == 'th' ) {
        langs = thai;
    } else if( '<?=$_SESSION['lang']?>' == 'vn' ) {
        langs = viet;
    } else {
        langs = english;
    }

    airdatepicker();
    gameProviderList('gameprovider');

    const userTable = $('#userTable').DataTable({
        dom: "<'row'<'col-12'tr>>",
        responsive: {
            details: {
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table table-bordered'
                })
            }
        },
        language: langs,
        ordering: false,
        deferRender: true,
        serverSide: true,
        processing: true,
        destroy: true,
        paging: false,
        ajax: function(data, callback, settings) {
            const provider = $('.filterForm [name=gameprovider]').val();
            const gameid = $('.filterForm [name=gameid]').val();
            
            var payload = JSON.stringify({
                provider: provider,
                gameid: gameid
            });
            $.ajax({
                url: '/user/game-id/search',
                type: 'post',
                data: payload,
                contentType:"application/json; charset=utf-8",
                dataType:"json",
                success: function(res){
                    if (res.code !== 1) {
                        // alert(res.message);
                        callback({
                            data: []
                        });

                        return;
                    } else {
                        callback({
                            data: res.data
                        });
                    }
                    return;
                }
            });
        },
        aoColumnDefs: [{
            aTargets: [4,5],
            render: function ( data, type, row ) {
                return parseFloat(data).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
                //return parseFloat(data).toFixed(2).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            }
        }]
    });

    $('.filterForm').off().on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            userTable.draw();
        }
    });

    // Free Credit
    document.getElementById("select-gpcode").onchange = function(item) {
        // console.log(this.value);
        getGameBalance(this.value);
    };

    $('.clearCreditForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            $('.clearCreditForm [type=submit]').prop('disabled',true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/user/free-credit/withdraw', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                // console.log(obj);
                if( obj.code == 1 ) {
                    swal.fire("Success!", obj.message, "success").then(() => {
                        refreshProfile();
                        $('#userTable').DataTable().ajax.reload(null,false);
                    });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-withdrawFreeCredit').modal('hide');
                $('.clearCreditForm [type=submit]').prop('disabled',false);
            })
            .fail(function() {
                swal.fire("", "Please try again later.", "error");
            });
        }
    });

    const withdrawFreeCreditEvent = document.getElementById('modal-withdrawFreeCredit');
    withdrawFreeCreditEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });
    // End Free Credit
});

function affiliateMember(uid)
{
    $('.modal-affiliateMember').modal('toggle');

    var params = {};
    params['uid'] = uid;

    $.post('/user/affiliate', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 && obj.havePassword ) {
            
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            
        }
    })
    .done(function() {  })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => {  });
    });
}

//FREE CREDIT
async function getGameBalance(gpCode)
{
    if( gpCode!='' )
    {
        generalLoading();

        var params = {};
        params['uid'] = $('.clearCreditForm [name=uid]').val();
        params['provider'] = gpCode;

        $.post('/user/game-balance/check', {
            params
        }, function(data, status) {
            const obj = JSON.parse(data);
            // console.log(obj);
            if( obj.code==1 ) {
                $('.clearCreditForm [name=amount]').val(obj.balance);
            } else {
                $('.clearCreditForm [name=amount]').val(obj.message);
            }
        })
        .done(function() {
            swal.close();
            //$('.modal-message [type=submit]').prop('disabled',false);
        })
        .fail(function() {
            
        });
    }
}

function withdrawCredit(uid,username)
{
    $('.modal-withdrawFreeCredit').modal('show');
    $('.clearCreditForm [name=uid]').val(uid);
    $('.clearCreditForm [name=username]').val(username);
}
</script>
