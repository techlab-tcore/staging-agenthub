<section class="mb-3 accordion">
    <button class="accordion-button bg-white fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><?=$secTitle;?></button>
    <article class="accordion-collapse collapse show" id="collapseOne">
        <div class="accordion-body bg-white">
            <?=form_open('', ['class'=>'filterForm p-2', 'novalidate'=>'novalidate']);?>
            <div class="row row-cols-lg-auto g-3 align-items-center">
                <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                    <label class="form-label"><?=lang('Input.from');?></label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="start" value="<?=date('Y-m-d');?>" readonly>
                        <span class="input-group-text"><?=lang('Label.to');?></span>
                        <input type="text" class="form-control" name="end" value="<?=date('Y-m-d');?>" readonly>
                    </div>
                </div>
                <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                    <label class="form-label w-100"><?=lang('Label.method');?></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="method_0" name="method" value="0" checked>
                        <label class="form-check-label" for="method_0"><?=lang('Label.all');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="method_1" name="method" value="1" checked>
                        <label class="form-check-label" for="method_1"><?=lang('Label.banktransfer');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="method_2" name="method" value="2" checked>
                        <label class="form-check-label" for="method_2"><?=lang('Label.paygateway');?></label>
                    </div>
                    <!--
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="method_3" name="method" value="3">
                        <label class="form-check-label" for="method_3"><?//=lang('Label.topupcode');?></label>
                    </div>
                    -->
                </div>
                <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                    <label class="form-label w-100"><?=lang('Input.status');?></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="status_1" name="status" value="1" checked>
                        <label class="form-check-label" for="status_1"><?=lang('Label.approve');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="status_2" name="status" value="2">
                        <label class="form-check-label" for="status_2"><?=lang('Label.reject');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="status_3" name="status" value="3">
                        <label class="form-check-label" for="status_3"><?=lang('Label.pending');?></label>
                    </div>
                    <!--
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="status_4" name="status" value="4">
                        <label class="form-check-label" for="status_4"><?//=lang('Label.check');?></label>
                    </div>
                    -->
                </div>
                <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                    <label class="form-label w-100"><?=lang('Input.types');?></label>
                    <select class="form-select" multiple name="types">
                    <option value="1" selected><?=lang('Label.deposit');?></option>
                    <option value="2" selected><?=lang('Label.withdrawal');?></option>
                    <option value="3" selected><?=lang('Label.promotion');?></option>
                    <!-- <option value="4"><?//=lang('Label.rebate');?></option> -->
                    <option value="5" selected><?=lang('Label.affiliate');?></option>
                    <option value="6" selected><?=lang('Label.credittransfer');?></option>
                    <option value="7" selected><?=lang('Label.wreturn');?></option>
                    <option value="8" selected><?=lang('Label.jackpot');?></option>
                    <option value="9" selected><?=lang('Label.fortunetoken');?></option>
                    <option value="10" selected><?=lang('Label.pgreplenishment');?></option>
                    <option value="11" selected><?=lang('Label.refdepcomm');?></option>
                    <option value="12" selected><?=lang('Label.depcomm');?></option>
                    <option value="13" selected><?=lang('Label.lossrebate');?></option>
                    <option value="14" selected><?=lang('Label.affsharereward');?></option>
                    <option value="15" selected><?=lang('Label.dailyfreereward');?></option>
                    <option value="16" selected><?=lang('Label.affloserebate');?></option>
                    <option value="17" selected><?=lang('Label.fortunereward');?></option>
                    <!-- <option value="18"><?//=lang('Label.checkin');?></option> -->
                    <!-- <option value="19"><?//=lang('Label.freescore');?></option> -->
                    <option value="20" selected><?=lang('Label.wallettransfer');?></option>
                    </select>
                </div>
                <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                    <label class="form-label w-100"><?=lang('Input.frmwallet');?></label>
                    <div class="input-group">
                        <select class="form-select" name="frmwallet">
                        <option value="" selected><?=lang('Label.all');?></option>
                        <option value="1"><?=lang('Label.userwallet');?></option>
                        <option value="2"><?=lang('Label.2ndwallet');?></option>
                        <option value="3"><?=lang('Label.chipwallet');?></option>
                        <option value="4"><?=lang('Label.tokenwallet');?></option>
                        </select>
                        <span class="input-group-text"><?=lang('Label.to');?></span>
                        <select class="form-select" name="towallet">
                        <option value="" selected><?=lang('Label.all');?></option>
                        <option value="1"><?=lang('Label.userwallet');?></option>
                        <option value="2"><?=lang('Label.2ndwallet');?></option>
                        <option value="3"><?=lang('Label.chipwallet');?></option>
                        <option value="4"><?=lang('Label.tokenwallet');?></option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                    <label class="form-label w-100"><?=lang('Input.frmaccno');?></label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="frmaccno">
                        <span class="input-group-text"><?=lang('Label.to');?></span>
                        <input type="text" class="form-control" name="toaccno">
                    </div>
                </div>
                <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                    <label class="form-label w-100"><?=lang('Input.frmbankid');?></label>
                    <div class="input-group">
                        <select class="form-select" name="frmbankid" id="frmbankid"></select>
                        <span class="input-group-text"><?=lang('Label.to');?></span>
                        <select class="form-select" name="tobankid" id="tobankid"></select>
                    </div>
                </div>

                <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                    <label class="form-label w-100"><?=lang('Input.frmuser');?></label>
                    <div class="input-group">
                        <select class="form-select" name="role-frmuser">
                        <option value="3"><?=lang('Label.agent');?></option>
                        <option value="4"><?=lang('Label.member');?></option>
                        </select>
                        <input type="text" class="form-control" name="frmusername" onkeyup="this.value=this.value.toUpperCase();">
                    </div>
                </div>

                <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                    <label class="form-label w-100"><?=lang('Input.touser');?></label>
                    <div class="input-group">
                        <select class="form-select" name="role-touser">
                        <option value="3"><?=lang('Label.agent');?></option>
                        <option value="4"><?=lang('Label.member');?></option>
                        <option value="2"><?=lang('Label.admin');?></option>
                        </select>
                        <input type="text" class="form-control" name="tousername" onkeyup="this.value=this.value.toUpperCase();">
                    </div>
                </div>
                <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                    <label class="form-label w-100"><?=lang('Input.createdby');?></label>
                    <div class="input-group">
                        <select class="form-select" name="role-createby">
                        <option value="3"><?=lang('Label.agent');?></option>
                        <option value="4"><?=lang('Label.member');?></option>
                        <option value="5"><?=lang('Label.subacc');?></option>
                        </select>
                        <input type="text" class="form-control" name="createby" onkeyup="this.value=this.value.toUpperCase();">
                    </div>
                </div>
                <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                    <label class="form-label w-100"><?=lang('Input.uplinecreatedby');?></label>
                    <div class="input-group">
                        <select class="form-select" name="role-uplinecreateby">
                        <option value="3"><?=lang('Label.agent');?></option>
                        <option value="4"><?=lang('Label.member');?></option>
                        </select>
                        <input type="text" class="form-control" name="uplinecreateby" onkeyup="this.value=this.value.toUpperCase();">
                    </div>
                </div>
                <div class="col-xl-auto col-lg-auto col-md-auto col-12">
                    <label class="form-label w-100"><?=lang('Label.payid');?></label>
                    <input type="text" class="form-control" name="payid">
                </div>
            </div>
            <div class="text-end">
                <button type="button" class="btn btn-outline-primary" onclick="exportTransaction();"><?=lang('Nav.export');?></button>
                <button type="submit" class="btn btn-primary"><?=lang('Nav.search');?></button>
            </div>
            <?=form_close();?>
        </div>
    </article>
</section>

<div class="card border-light">
    <div class="card-body">
        <article class="card-text p-3">

            <section class="btn-groups mb-3">
                <label class="badge bg-success fw-normal rounded-0"><?=lang('Label.totaldeposit');?>: <span class="totalDeposit">0</span></label>
                <label class="badge bg-danger fw-normal rounded-0"><?=lang('Label.totalwithdraw');?>: <span class="totalWithdrawal">0</span></label>
                <label class="badge bg-primary fw-normal rounded-0"><?=lang('Label.totaldwnett');?>: <span class="totalDWNett">0</span></label>
                <label class="badge bg-dark fw-normal rounded-0"><?=lang('Label.totalpromo');?>: <span class="totalPromo">0</span></label>
                <label class="badge bg-dark fw-normal rounded-0"><?=lang('Label.totalaff');?>: <span class="totalAffiliate">0</span></label>
                <label class="badge bg-dark fw-normal rounded-0"><?=lang('Label.totalcf');?>: <span class="totalCTransfer">0</span></label>
                <label class="badge bg-dark fw-normal rounded-0"><?=lang('Label.totalwr');?>: <span class="totalWReturn">0</span></label>
                <label class="badge bg-dark fw-normal rounded-0"><?=lang('Label.totaljackpot');?>: <span class="totalJackpot">0</span></label>
                <label class="badge bg-dark fw-normal rounded-0"><?=lang('Label.totalftoken');?>: <span class="totalFToken">0</span></label>
                <label class="badge bg-dark fw-normal rounded-0"><?=lang('Label.totalreplenish');?>: <span class="totalReplenishment">0</span></label>
                <label class="badge bg-dark fw-normal rounded-0"><?=lang('Label.totalrefdeposit');?>: <span class="totalRefDeposit">0</span></label>
                <label class="badge bg-dark fw-normal rounded-0"><?=lang('Label.totaldepositcomm');?>: <span class="totalDepositComm">0</span></label>
                <label class="badge bg-dark fw-normal rounded-0"><?=lang('Label.totallossrebate');?>: <span class="totalLossRebate">0</span></label>
                <label class="badge bg-dark fw-normal rounded-0"><?=lang('Label.totalsharereward');?>: <span class="totalSharedReward">0</span></label>
                <label class="badge bg-dark fw-normal rounded-0"><?=lang('Label.totaldailyreward');?>: <span class="totalDailyReward">0</span></label>
                <label class="badge bg-dark fw-normal rounded-0"><?=lang('Label.totalafflossrebate');?>: <span class="totalAffLossRebate">0</span></label>
                <label class="badge bg-dark fw-normal rounded-0"><?=lang('Label.totalfreward');?>: <span class="totalFortuneReward">0</span></label>
                <label class="badge bg-dark fw-normal rounded-0"><?=lang('Label.wallettransfer');?>: <span class="totalWalletTransfer">0</span></label>
            </section>

            <a class="btn btn-primary" href="<?=base_url('system-export');?>">Report List</a>

            <table id="paymentTable" class="w-100 table table-sm table-bordered table-hover">
                <thead class="table-style">
                <tr>
                <th><?=lang('Label.createddate');?></th>
                <th><?=lang('Input.username');?></th>
                <th><?=lang('Input.fname');?></th>
                <th><?=lang('Input.status');?></th>
                <th><?=lang('Input.types');?></th>
                <th><?=lang('Input.createdby');?></th>
                <th><?=lang('Input.amount');?></th>
                <th><?=lang('Input.convertamount');?></th>
                <th class="none"><?=lang('Label.payid');?></th>
                <th class="none"><?=lang('Label.reference');?></th>
                <th class="none"><?=lang('Label.referid');?></th>
                <th class="none"><?=lang('Label.promotion');?></th>
                <th class="none"><?=lang('Label.turnover');?></th>
                <th class="none"><?=lang('Input.remark');?></th>
                <th class="none"><?=lang('Input.bankinslip');?></th>
                <th class="none"><?=lang('Label.clientip');?></th>
                <th class="none"><?=lang('Label.approveby');?></th>
                </tr>
                </thead>
                <tfoot class="table-style">
                <tr>
                <th colspan="6" class="text-end"><?=lang('Label.totalamt');?>:</th>
                <th class="text-end">&nbsp;</th>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                </tr>
                </tfoot>
                <tbody></tbody>
            </table>

        </article>
    </div>
</div>

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
    getAllBankList('frmbankid');
    getAllBankList('tobankid');
    //getBankList('frmbankid');
    //getBankList('tobankid');

    $('[name=role-frmuser]').off().on('change', function(e) {
        let role = $(this).val();
        $('[name=frmusername]').val('');
        if( role==4 )
        {
            $('[name=frmusername]').attr('onkeyup','this.value=this.value.toLowerCase()');
        } else {
            $('[name=frmusername]').attr('onkeyup','this.value=this.value.toUpperCase()');
        }
    });

    $('[name=role-touser]').off().on('change', function(e) {
        let role = $(this).val();
        $('[name=tousername]').val('');
        if( role==4 )
        {
            $('[name=tousername]').attr('onkeyup','this.value=this.value.toLowerCase()');
        } else {
            $('[name=tousername]').attr('onkeyup','this.value=this.value.toUpperCase()');
        }
    });

    $('[name=role-createby]').off().on('change', function(e) {
        let role = $(this).val();
        $('[name=createby]').val('');
        if( role==4 )
        {
            $('[name=createby]').attr('onkeyup','this.value=this.value.toLowerCase()');
        } else {
            $('[name=createby]').attr('onkeyup','this.value=this.value.toUpperCase()');
        }
    });

    $('[name=role-uplinecreateby]').off().on('change', function(e) {
        let role = $(this).val();
        $('[name=uplinecreateby]').val('');
        if( role==4 )
        {
            $('[name=uplinecreateby]').attr('onkeyup','this.value=this.value.toLowerCase()');
        } else {
            $('[name=uplinecreateby]').attr('onkeyup','this.value=this.value.toUpperCase()');
        }
    });

    var pageindex = 1, debug = false;
    const paymentTable = $('#paymentTable').DataTable({
        // dom: 'B' + "<'row'<'col-12 overflow-auto'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
        dom: "<'row'<'col-12 overflow-auto'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
        lengthChange: false,
        // buttons: [
        //     {
        //         extend: 'excel',
        //         split: [ 'csv', 'print', 'copy'],
        //     }
        // ],
        responsive: {
            details: {
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table table-sm table-bordered'
                })
            }
        },
        language: langs,
        ordering: false,
        deferRender: true,
        serverSide: true,
        processing: true,
        destroy: true,
        pageLength: 20,
        ajax: function(data, callback, settings) {
            if (settings._iRecordsTotal == 0) {
                pageindex = 1;
            } else {
                var pageindex = settings._iDisplayStart/settings._iDisplayLength + 1;
            }

            const fromdate = $('.filterForm [name=start]').val();
            const todate = $('.filterForm [name=end]').val();
            const paytype = $('.filterForm [name=types]').val();
            const frmwallet = $('.filterForm [name=frmwallet]').val();
            const towallet = $('.filterForm [name=towallet]').val();
            const frmaccno = $('.filterForm [name=frmaccno]').val();
            const toaccno = $('.filterForm [name=toaccno]').val();
            const frmbankid = $('.filterForm [name=frmbankid]').val();
            const tobankid = $('.filterForm [name=tobankid]').val();
            const frmusername = $('.filterForm [name=frmusername]').val();
            const tousername = $('.filterForm [name=tousername]').val();
            const createby = $('.filterForm [name=createby]').val();
            const uplinecreateby = $('.filterForm [name=uplinecreateby]').val();

            const payid = $('.filterForm [name=payid]').val();
            const rolefrmuser = $('.filterForm [name=role-frmuser]').val();
            const role2user = $('.filterForm [name=role-touser]').val();
            const rolecreateby = $('.filterForm [name=role-createby]').val();
            const roleuplinecreateby = $('.filterForm [name=role-uplinecreateby]').val();

            const method = [];
            $.each($('.filterForm [name=method]:checked'), function() {
                method.push($(this).val());
            });

            const status = [];
            $.each($('.filterForm [name=status]:checked'), function() {
                status.push($(this).val());
            });
            
            var payload = JSON.stringify({
                pageindex: pageindex,
                rowperpage: data.length,
                parent: '<?=$parent;?>',
                rolefrmuser: rolefrmuser,
                role2user: role2user,
                rolecreateby: rolecreateby,
                roleuplinecreateby: roleuplinecreateby,
                start: fromdate,
                end: todate,
                payid: payid,
                method: method,
                type: paytype,
                status: status,
                frmwallet: frmwallet,
                towallet: towallet,
                frmaccno: frmaccno,
                toaccno: toaccno,
                frmbankid: frmbankid,
                tobankid: tobankid,
                frmusername: frmusername,
                tousername: tousername,
                createby: createby,
                uplinecreateby: uplinecreateby,
            });
            $.ajax({
                url: '/list/history/transaction',
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
                            data: res.data,
                            total: res.total
                        });

                        // console.log(res.total);
                        const totalNett = res.total[0].total + res.total[1].total;
                        $('.totalDWNett').html(parseFloat(totalNett).toFixed(2));
                        
                        $('.totalDeposit').html(parseFloat(res.total[0].total).toFixed(2));
                        $('.totalWithdrawal').html(parseFloat(res.total[1].total).toFixed(2));
                        $('.totalPromo').html(parseFloat(res.total[2].total).toFixed(2));
                        $('.totalAffiliate').html(parseFloat(res.total[4].total).toFixed(2));
                        $('.totalCTransfer').html(parseFloat(res.total[5].total).toFixed(2));
                        $('.totalWReturn').html(parseFloat(res.total[6].total).toFixed(2));
                        $('.totalJackpot').html(parseFloat(res.total[7].total).toFixed(2));
                        $('.totalFToken').html(parseFloat(res.total[8].total).toFixed(2));
                        $('.totalReplenishment').html(parseFloat(res.total[9].total).toFixed(2));
                        $('.totalRefDeposit').html(parseFloat(res.total[10].total).toFixed(2));
                        $('.totalDepositComm').html(parseFloat(res.total[11].total).toFixed(2));
                        $('.totalLossRebate').html(parseFloat(res.total[12].total).toFixed(2));
                        $('.totalSharedReward').html(parseFloat(res.total[13].total).toFixed(2));
                        $('.totalDailyReward').html(parseFloat(res.total[14].total).toFixed(2));
                        $('.totalAffLossRebate').html(parseFloat(res.total[15].total).toFixed(2));
                        $('.totalFortuneReward').html(parseFloat(res.total[16].total).toFixed(2));
                        $('.totalWalletTransfer').html(parseFloat(res.total[19].total).toFixed(2));
                    }
                    return;
                }
            });
        },
        footerCallback: function ( row, data, start, end, display ) {
            var api = this.api(), data;
            var intVal = function(i){ return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1 : typeof i === 'number' ? i : 0; };

            var totalOverPage = api.column(6, {page: 'current'}).data().reduce(function(a, b){ return intVal(a) + intVal(b); }, 0);
            var truncate = parseFloat(totalOverPage).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            var sum = parseFloat(truncate) < 0 ? '<span class="text-danger">'+truncate+'</span>' : truncate;
            $(api.column(6).footer()).html(sum);
        },
        drawCallback: function(oSettings, json) {
            $('#paymentTable tbody tr td.dataTables_empty').removeClass('text-end');
            $('#paymentTable tbody tr').find('td:nth-child(7)').addClass('text-end');

            // var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            // var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            //     return new bootstrap.Popover(popoverTriggerEl)
            // });

            const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
            const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));
        },
        aoColumnDefs: [{
            aTargets: [6,7],
            render: function ( data, type, row ) {
                return parseFloat(data).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
            }
        }]
    });

    $('.filterForm').off().on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            paymentTable.draw();

            const findPopover = document.querySelectorAll('.popover');
            $(findPopover).removeClass("show");
            $("[data-toggle='popover']").popover('hide');
            $(findPopover).remove();
        }
    });
});

function exportTransaction()
{
    const fromdate = $('.filterForm [name=start]').val();
    const todate = $('.filterForm [name=end]').val();
    const paytype = $('.filterForm [name=types]').val();
    const frmwallet = $('.filterForm [name=frmwallet]').val();
    const towallet = $('.filterForm [name=towallet]').val();
    const frmaccno = $('.filterForm [name=frmaccno]').val();
    const toaccno = $('.filterForm [name=toaccno]').val();
    const frmbankid = $('.filterForm [name=frmbankid]').val();
    const tobankid = $('.filterForm [name=tobankid]').val();
    const frmusername = $('.filterForm [name=frmusername]').val();
    const tousername = $('.filterForm [name=tousername]').val();
    const createby = $('.filterForm [name=createby]').val();
    const uplinecreateby = $('.filterForm [name=uplinecreateby]').val();

    const payid = $('.filterForm [name=payid]').val();
    const rolefrmuser = $('.filterForm [name=role-frmuser]').val();
    const role2user = $('.filterForm [name=role-touser]').val();
    const rolecreateby = $('.filterForm [name=role-createby]').val();
    const roleuplinecreateby = $('.filterForm [name=role-uplinecreateby]').val();

    const method = [];
    $.each($('.filterForm [name=method]:checked'), function() {
        method.push($(this).val());
    });

    const status = [];
    $.each($('.filterForm [name=status]:checked'), function() {
        status.push($(this).val());
    });

    var params = {};
    var formObj = $(this).closest("form");
    $.each($(formObj).serializeArray(), function (index, value) {
        params[value.name] = value.value;
    });

    // $('.filterForm').off().on('submit', function(e) {
        // e.preventDefault();

        // if (this.checkValidity() !== false) {
            generalLoading();

            // $('.filterForm [type=submit]').prop('disabled',true);

            var params = {};
            var formObj = $('.filterForm').closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['parent'] = '<?=$parent;?>';
                params['method'] = method;
                params['status'] = status;
                params['type'] = paytype;
            });

            $.post('/export/tranasaction-history/add', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                // console.log(obj);
                if( obj.code==0 ) {
                    swal.fire("", "Submitted", "success").then(() => {
                        
                    });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                // $('.modal-modify form [type=submit]').prop('disabled',false);
            })
            .fail(function() {
                swal.fire("", "Please try again later.", "error");
            });
        // }
    // });
}
</script>