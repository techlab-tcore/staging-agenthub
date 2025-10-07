<section class="card border-light">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <article class="card-text p-3">
            <?=form_open('', ['class'=>'row gy-2 gx-3 align-items-center filterForm pb-3', 'novalidate'=>'novalidate']);?>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <div class="input-group">
                    <span class="input-group-text"><?=lang('Input.role');?></span>
                    <select class="form-select" name="role">
                    <option value="4"><?=lang('Label.member');?></option>
                    <option value="3"><?=lang('Label.agent');?></option>
                    </select>
                </div>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <div class="input-group">
                    <span class="input-group-text">#UID</span>
                    <input type="text" class="form-control" name="uid">
                </div>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <div class="input-group">
                    <span class="input-group-text"><?=lang('Input.username');?></span>
                    <input type="text" class="form-control" name="username">
                </div>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <div class="input-group">
                    <span class="input-group-text"><?=lang('Input.fname');?></span>
                    <input type="text" class="form-control" name="fname">
                </div>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <div class="input-group">
                    <span class="input-group-text"><?=lang('Input.regioncode');?></span>
                    <select class="form-select" name="regioncode">
                    <option value="MYR">Malaysia (+60)</option>
                    <option value="SGD">Singapore (+65)</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <div class="input-group">
                    <span class="input-group-text"><?=lang('Input.contact');?></span>
                    <input type="text" class="form-control" name="contact">
                </div>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <div class="input-group">
                    <span class="input-group-text"><?=lang('Input.usercreated');?></span>
                    <input type="text" class="form-control bg-white" name="ucreated" readonly>
                </div>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <div class="input-group">
                    <span class="input-group-text">IP</span>
                    <input type="text" class="form-control" name="ip">
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
            <th><?=lang('Label.cash');?></th>
            <th><?=lang('Label.chip');?></th>
            <th><?=lang('Label.agwallet');?></th>
            <!--<th class="none"><?//=lang('Label.vaultbalance');?></th>-->
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
            const role = $('.filterForm [name=role]').val();
            const uid = $('.filterForm [name=uid]').val();
            const username = $('.filterForm [name=username]').val();
            const fname = $('.filterForm [name=fname]').val();
            const regioncode = $('.filterForm [name=regioncode]').val();
            const contact = $('.filterForm [name=contact]').val();
            const ip = $('.filterForm [name=ip]').val();
            const ucreated = $('.filterForm [name=ucreated]').val();
            
            var payload = JSON.stringify({
                role: role,
                uid: uid,
                username: username,
                fname: fname,
                regioncode: regioncode,
                contact: contact,
                ip: ip,
                ucreated: ucreated
            });
            $.ajax({
                url: '/user/search',
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
            aTargets: [4,5,6,7],
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
</script>
