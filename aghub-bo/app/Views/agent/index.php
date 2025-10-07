<section class="card border-light">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <article class="card-text p-3">
            <?=form_open('', ['class'=>'row gy-2 gx-3 align-items-center filterForm pb-3', 'novalidate'=>'novalidate']);?>
            <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                <div class="input-group">
                    <span class="input-group-text"><?=lang('Input.username');?></span>
                    <input type="text" class="form-control" name="username">
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
                    <span class="input-group-text"><?=lang('Input.status');?></span>
                    <select class="form-select" name="status">
                    <option value=""><?=lang('Label.all');?></option>
                    <option value="1"><?=lang('Label.active');?></option>
                    <option value="2"><?=lang('Label.inactive');?></option>
                    <option value="3"><?=lang('Label.freeze');?></option>
                    </select>
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
            <th class="none"><?=lang('Input.status');?></th>
            <th><?=lang('Label.balance');?></th>
            <th><?=lang('Label.agwallet');?></th>
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

    var pageindex = 1, debug = false;
    const userTable = $('#userTable').DataTable({
        dom: "<'row'<'col-12'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
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
        pageLength: 15,
        ajax: function(data, callback, settings) {
            if (settings._iRecordsTotal == 0) {
                pageindex = 1;
            } else {
                var pageindex = settings._iDisplayStart/settings._iDisplayLength + 1;
            }

            const username = $('.filterForm [name=username]').val();
            const regioncode = $('.filterForm [name=regioncode]').val();
            const contact = $('.filterForm [name=contact]').val();
            const ucreated = $('.filterForm [name=ucreated]').val();
            const status = $('.filterForm [name=status]').val();
            
            var payload = JSON.stringify({
                pageindex: pageindex,
                rowperpage: data.length,
                parent: '<?=$parent;?>',
                username: username,
                regioncode: regioncode,
                contact: contact,
                ucreated: ucreated,
                status: status
            });

            $.ajax({
                url: '/list/agent',
                type: 'post',
                data: payload,
                contentType:"application/json; charset=utf-8",
                dataType:"json",
                success: function(res){
                    if (res.code !== 1) {
                        // alert(res.message);
                        callback({
                            recordsTotal: 0,
                            recordsFiltered: 0,
                            data: []
                        });

                        return;
                    } else {
                        callback({
                            recordsTotal: res.totalRecord,
                            recordsFiltered: res.totalRecord,
                            data: res.data
                        });
                    }
                    return;
                }
            });
        },
        aoColumnDefs: [{
            aTargets: [3,4],
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
</script>