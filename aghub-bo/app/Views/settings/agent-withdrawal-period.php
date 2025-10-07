<section class="card border-vw">
    <h4 class="card-header bg-white border-vw d-flex justify-content-between"><?=$secTitle;?></h4>
    <div class="card-body">

        <?=form_open('',['class'=>'form-validation row g-2 align-items-center withdrawTimeForm','novalidate'=>'novalidate']);?>
        <div class="">
            <label class="d-block"><?=lang('Input.status');?></label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="awth_true" value="true">
                <label class="form-check-label" for="awth_true"><?=lang('Label.active');?></label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="awth_false" value="false">
                <label class="form-check-label" for="awth_false"><?=lang('Label.inactive');?></label>
            </div>
        </div>
        <hr class="mt-3 mb-2 border-vw">
        <h5 class=""><?=lang('Label.starttime');?></h5>
        <div class="row gx-2">
            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                <label class="form-label"><?=lang('Input.day');?></label>
                <div class="input-group">
                    <span class="input-group-text"><i class='bx bxs-calendar'></i></span>
                    <select class="form-select" name="startDate" id="startDate" required>
                        <option value="">-- Select Day --</option>
                        <option value="1"><?=lang('Label.monday');?></option>
                        <option value="2"><?=lang('Label.tuesday');?></option>
                        <option value="3"><?=lang('Label.wednesday');?></option>
                        <option value="4"><?=lang('Label.thursday');?></option>
                        <option value="5"><?=lang('Label.friday');?></option>
                        <option value="6"><?=lang('Label.saturday');?></option>
                        <option value="0"><?=lang('Label.sunday');?></option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                <label class="form-label"><?=lang('Input.time');?></label>
                <div class="input-group">
                    <span class="input-group-text"><i class='bx bxs-time'></i></span>
                    <input type="text" class="form-control" name="startTime" value="" readonly>
                </div>
            </div>
        </div>
        <hr class="mt-3 mb-2 border-vw">
        <h5 class=""><?=lang('Label.endtime');?></h5>
        <div class="row gx-2">
            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                <label class="form-label"><?=lang('Input.day');?></label>
                <div class="input-group">
                    <span class="input-group-text"><i class='bx bxs-calendar'></i></span>
                    <select class="form-select" name="endDate" id="endDate" required>
                        <option value="">-- Select Day --</option>
                        <option value="1"><?=lang('Label.monday');?></option>
                        <option value="2"><?=lang('Label.tuesday');?></option>
                        <option value="3"><?=lang('Label.wednesday');?></option>
                        <option value="4"><?=lang('Label.thursday');?></option>
                        <option value="5"><?=lang('Label.friday');?></option>
                        <option value="6"><?=lang('Label.saturday');?></option>
                        <option value="0"><?=lang('Label.sunday');?></option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                <label class="form-label"><?=lang('Input.time');?></label>
                <div class="input-group">
                    <span class="input-group-text"><i class='bx bxs-time'></i></span>
                    <input type="text" class="form-control" name="endTime" value="" readonly>
                </div>
            </div>
        </div>
        <hr class="mt-3 mb-2 border-vw">
        <div class="col-xl-auto col-lg-auto col-md-auto col-12 ms-auto text-end">
            <button type="submit" class="btn btn-primary w-100"><?=lang('Nav.submit');?></button>
        </div>
        <?=form_close();?>

    </div>
</section>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', (event) => {

    airdatepicker();
    getWithdrawTime();
    
    $('.withdrawTimeForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $('.withdrawTimeForm [type=submit]').prop('disabled',true);

            $.post('/administrator/api-config/agent-withdraw-time/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("", obj.message , "success").then(() => {
                        $('.withdrawTimeForm [type=submit]').prop('disabled',false);
                    });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("", obj.message + " (Code: "+obj.code+")", "error");
                    $('.withdrawTimeForm [type=submit]').prop('disabled',false);
                }
            })
            .done(function() {
                $('.withdrawTimeForm').removeClass('was-validated');
            })
            .fail(function() {
                swal.fire("", "Please try again later.", "error").then(() => {
                    $('.withdrawTimeForm [type=submit]').prop('disabled',false);
                });
            });
        }
    });

});

function getWithdrawTime()
{
    $.get('/administrator/api-config/agent-withdraw-time', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            //default admin data
            //$('.withdrawTimeForm [name=affRefReward]').val(JSON.stringify(obj.data.affRegReward));
            //$('.withdrawTimeForm [name=dailyReward]').val(JSON.stringify(obj.data.dailyReward));

            if( obj.data.block == true ) {
                $('.withdrawTimeForm [name=status]#awth_true').prop('checked',true);
            } else {
                $('.withdrawTimeForm [name=status]#awth_false').prop('checked',true);
            }

            $('.withdrawTimeForm [name=startTime]').val(obj.data.startTime);
            $('.withdrawTimeForm [name=startDate] option[value=' + obj.data.startDay + ']').attr('selected','selected');
            $('.withdrawTimeForm [name=endTime]').val(obj.data.endTime);
            $('.withdrawTimeForm [name=endDate] option[value=' + obj.data.endDay + ']').attr('selected','selected');
        } else if( obj.code==39 ) {
            // forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
        swal.close();
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

</script>