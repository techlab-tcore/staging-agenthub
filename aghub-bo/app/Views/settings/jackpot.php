<section class="card border-light shadow">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <div class="px-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-addjackpot"><i class="las la-plus-circle me-1"></i><?=lang('Nav.addjackpot');?></button>
        </div>

        <article class="card-text p-3">
            <table id="jackpotTable" class="w-100 table table-sm table-bordered table-hover">
                <thead class="table-style">
                <tr>
                <th><?=lang('Input.status');?></th>
                <th><?=lang('Input.jackpotname');?></th>
                <th><?=lang('Input.types');?></th>
                <th><?=lang('Input.password');?></th>
                <th><?=lang('Input.accumat');?></th>
                <th><?=lang('Input.prize');?></th>
                <th class="none"><?=lang('Label.chip');?> (%)</th>
                <th class="none"><?=lang('Input.jdisplay');?></th>
                <th><?=lang('Input.resetby');?></th>
                <th class="none"><?=lang('Input.numwinner');?></th>
                <th class="none"><?=lang('Input.winnerduplicate');?></th>
                <th class="none"><?=lang('Input.randamt');?></th>
                <th class="none"><?=lang('Input.mins');?></th>
                <th class="none"><?=lang('Input.minturnover');?></th>
                <th class="none"><?=lang('Input.caltypes');?></th>
                <th class="none"><?=lang('Input.chipgroup');?></th>
                <th class="none"><?=lang('Input.winnerlist');?></th>
                <th class="none"><?=lang('Label.createddate');?></th>
                <th><?=lang('Label.action');?></th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </article>
    </div>
</section>

<section class="modal fade modal-addjackpot" id="modal-addjackpot" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-addjackpot" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.addjackpot');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate']);?>
                <div class="mb-3">
                    <label class="d-block"><?=lang('Input.types');?></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jtype" id="jt_login" value="1" checked>
                        <label class="form-check-label" for="jt_login"><?=lang('Label.jlogin');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jtype" id="jt_reg" value="2">
                        <label class="form-check-label" for="jt_reg"><?=lang('Label.jreg');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jtype" id="jt_select" value="3">
                        <label class="form-check-label" for="jt_select"><?=lang('Label.jselect');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jtype" id="jt_random" value="4">
                        <label class="form-check-label" for="jt_random"><?=lang('Label.jrandom');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jtype" id="jt_rolling" value="5">
                        <label class="form-check-label" for="jt_rolling"><?=lang('Label.jrolling');?></label>
                    </div>
                    <!--
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jtype" id="jt_betsummary" value="6">
                        <label class="form-check-label" for="jt_betsummary"><?//=lang('Label.jbetsummary');?></label>
                    </div>
                    -->
                </div>
                <div class="row betSummary">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                        <label><?=lang('Input.gpsummary');?></label>
                        <select class="form-select" name="gpid3" id="gameprovider3"></select>
                    </div>
                </div>
                <div class="row gameChip">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                        <label><?=lang('Input.game');?></label>
                        <select class="form-select" name="gpid" id="gameprovider"></select>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                        <label><?=lang('Input.category');?></label>
                        <select class="form-select" name="gcate" id="cateList"></select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="d-block"><?=lang('Input.password');?></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="usePass" id="usePass_yes" value="true">
                        <label class="form-check-label" for="usePass_yes"><?=lang('Label.yes');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="usePass" id="usePass_no" value="false" checked>
                        <label class="form-check-label" for="usePass_no"><?=lang('Label.no');?></label>
                    </div>
                </div>
                <div class="mb-3">
                    <label><?=lang('Input.jackpotname');?></label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="mb-3">
                    <label class="d-block"><?=lang('Input.randamt');?></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="random" id="randwyes2" value="true" required>
                        <label class="form-check-label" for="randwyes2"><?=lang('Label.yes');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="random" id="randwno2" value="false">
                        <label class="form-check-label" for="randwno2"><?=lang('Label.no');?></label>
                    </div>
                </div>
                <div class="mb-3">
                    <label><?=lang('Input.prize');?></label>
                    <div class="input-group">
                        <input type="number" step="any" min="0" class="form-control" name="prize" required>
                        <span class="input-group-text"><?=lang('Input.tomax');?></span>
                        <input type="number" step="any" min="0" class="form-control" name="maxjackpot" value="0" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-12">
                        <label><?=lang('Input.accumat');?></label>
                        <input type="number" min="0" step="any" class="form-control" name="accumulate" required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <label><?=lang('Label.chip');?> (%)</label>
                        <input type="number" min="0" step="any" class="form-control" name="chip" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label><?=lang('Input.chipgroup');?></label>
                    <input type="text" class="form-control" name="chipgroup">
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-12">
                        <label><?=lang('Input.numwinner');?></label>
                        <input type="number" min="0" step="any" class="form-control" name="maxwinner" required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <label class="d-block"><?=lang('Input.winnerduplicate');?></label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="duplicate" id="jyes2" value="true" checked>
                            <label class="form-check-label" for="jyes2"><?=lang('Label.yes');?></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="duplicate" id="jno2" value="false">
                            <label class="form-check-label" for="jno2"><?=lang('Label.no');?></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12 mb-3">
                        <label><?=lang('Input.mins');?></label>
                        <input type="number" min="0" step="any" class="form-control" name="intervalMin" value="0" required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 mb-3">
                        <label class="d-block"><?=lang('Input.minturnover');?></label>
                        <input type="number" min="0" step="any" class="form-control" name="minTurnover" value="0" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="d-block"><?=lang('Input.caltypes');?></label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="calType" id="caltype_none" value="0" checked>
                            <label class="form-check-label" for="caltype_none">None</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="calType" id="caltype_effect" value="1">
                            <label class="form-check-label" for="caltype_effect"><?=lang('Label.effectbet');?></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="calType" id="caltype_bet" value="2">
                            <label class="form-check-label" for="caltype_bet"><?=lang('Label.turnover');?></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="calType" id="caltype_deposit" value="3">
                            <label class="form-check-label" for="caltype_deposit"><?=lang('Label.deposit');?></label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="d-block"><?=lang('Input.resetby');?></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="resetby" id="jhit2" value="1" checked>
                        <label class="form-check-label" for="jhit2"><?=lang('Label.jhit');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="resetby" id="jday2" value="2">
                        <label class="form-check-label" for="jday2"><?=lang('Label.jday');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="resetby" id="jweek2" value="3">
                        <label class="form-check-label" for="jweek2"><?=lang('Label.jweek');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="resetby" id="jmonth2" value="4">
                        <label class="form-check-label" for="jmonth2"><?=lang('Label.jmonth');?></label>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="d-block"><?=lang('Input.typeduplicate');?></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="typeduplicate" id="tdpyes2" value="true" checked>
                        <label class="form-check-label" for="tdpyes2"><?=lang('Label.yes');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="typeduplicate" id="tdpno2" value="false">
                        <label class="form-check-label" for="tdpno2"><?=lang('Label.no');?></label>
                    </div>
                </div>
                <div class="mb-3">
                    <label><?=lang('Input.jdisplay');?></label>
                    <input type="number" min="0" step="any" class="form-control" name="displayamount" value="838988" required>
                    <small class="form-text">Leave it if not showing on frontend</small>
                </div>
                <div class="mb-3">
                    <label><?=lang('Input.winnerlist');?></label>
                    <textarea class="form-control" name="winners"></textarea>
                    <small class="form-text">For more than 1 winner, Ex. wong88, samson66</small>
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

<section class="modal fade modal-modifyJackpot" id="modal-modifyJackpot" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-modifyJackpot" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.editjackpot');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate'],['id'=>'', 'jtype'=>'']);?>
                <div class="row mb-3">
                    <div class="col-12 mb-3">
                        <label class="d-block"><?=lang('Input.status');?></label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="active_status" value="1" checked>
                            <label class="form-check-label" for="active_status"><?=lang('Label.active');?></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="inactive_status" value="2">
                            <label class="form-check-label" for="inactive_status"><?=lang('Label.inactive');?></label>
                        </div>
                    </div>
                    <div class="row betSummary">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                            <label><?=lang('Input.gpsummary');?></label>
                            <select class="form-select" name="gpid4" id="gameprovider4"></select>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3 gameChip">
                        <label><?=lang('Input.game');?></label>
                        <select class="form-select" name="gpid2" id="gameprovider2"></select>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3 gameChip">
                        <label><?=lang('Input.category');?></label>
                        <select class="form-select" name="gcate2" id="cateList2"></select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <label class="d-block"><?=lang('Input.password');?></label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="usePass" id="usePass_yes2" value="true" checked>
                            <label class="form-check-label" for="usePass_yes2"><?=lang('Label.yes');?></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="usePass" id="usePass_no2" value="false">
                            <label class="form-check-label" for="usePass_no2"><?=lang('Label.no');?></label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <label class="d-block"><?=lang('Input.randamt');?></label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="random" id="randwyes" value="true" required>
                            <label class="form-check-label" for="randwyes"><?=lang('Label.yes');?></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="random" id="randwno" value="false">
                            <label class="form-check-label" for="randwno"><?=lang('Label.no');?></label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label><?=lang('Input.jackpotname');?></label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="mb-3">
                    <label><?=lang('Input.prize');?></label>
                    <div class="input-group">
                        <input type="number" step="any" min="0" class="form-control" name="prize" required>
                        <span class="input-group-text"><?=lang('Input.tomax');?></span>
                        <input type="number" step="any" min="0" class="form-control" name="maxjackpot" value="0" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-12">
                        <label><?=lang('Input.accumat');?></label>
                        <input type="number" min="0" step="any" class="form-control" name="accumulate" required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <label><?=lang('Label.chip');?> (%)</label>
                        <input type="number" min="0" step="any" class="form-control" name="chip" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label><?=lang('Input.chipgroup');?></label>
                    <input type="text" class="form-control" name="chipgroup2">
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-12">
                        <label><?=lang('Input.numwinner');?></label>
                        <input type="number" min="0" step="any" class="form-control" name="maxwinner" required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <label class="d-block"><?=lang('Input.winnerduplicate');?></label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="duplicate" id="jyes" value="true" checked>
                            <label class="form-check-label" for="jyes"><?=lang('Label.yes');?></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="duplicate" id="jno" value="false">
                            <label class="form-check-label" for="jno"><?=lang('Label.no');?></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12 mb-3">
                        <label><?=lang('Input.mins');?></label>
                        <input type="number" min="0" step="any" class="form-control" name="intervalMin" value="0" required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 mb-3">
                        <label class="d-block"><?=lang('Input.minturnover');?></label>
                        <input type="number" min="0" step="any" class="form-control" name="minTurnover" value="0" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="d-block"><?=lang('Input.caltypes');?></label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="calType" id="caltype_none2" value="0" checked>
                            <label class="form-check-label" for="caltype_none2">None</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="calType" id="caltype_effect2" value="1">
                            <label class="form-check-label" for="caltype_effect2"><?=lang('Label.effectbet');?></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="calType" id="caltype_bet2" value="2">
                            <label class="form-check-label" for="caltype_bet2"><?=lang('Label.turnover');?></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="calType" id="caltype_deposit2" value="3">
                            <label class="form-check-label" for="caltype_deposit2"><?=lang('Label.deposit');?></label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="d-block"><?=lang('Input.resetby');?></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="resetby" id="jhit" value="1" checked>
                        <label class="form-check-label" for="jhit"><?=lang('Label.jhit');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="resetby" id="jday" value="2">
                        <label class="form-check-label" for="jday"><?=lang('Label.jday');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="resetby" id="jweek" value="3">
                        <label class="form-check-label" for="jweek"><?=lang('Label.jweek');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="resetby" id="jmonth" value="4">
                        <label class="form-check-label" for="jmonth"><?=lang('Label.jmonth');?></label>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="d-block"><?=lang('Input.typeduplicate');?></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="typeduplicate" id="tdpyes" value="true" checked>
                        <label class="form-check-label" for="tdpyes"><?=lang('Label.yes');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="typeduplicate" id="tdpno" value="false">
                        <label class="form-check-label" for="tdpno"><?=lang('Label.no');?></label>
                    </div>
                </div>
                <div class="mb-3">
                    <label><?=lang('Input.jdisplay');?></label>
                    <input type="number" min="0" step="any" class="form-control" name="displayamount" required>
                </div>
                <div class="mb-3">
                    <label><?=lang('Input.winnerlist');?></label>
                    <textarea class="form-control" name="winners"></textarea>
                    <small class="form-text">For more than 1 winner, Ex. wong88, samson66</small>
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

    const jackpotTable = $('#jackpotTable').DataTable({
        dom: "<'row mb-3'<'col-xl-6 col-lg-6 col-md-6 col-12'l><'col-xl-6 col-lg-6 col-md-6 col-12'f>>" + "<'row'<'col-12 overflow-auto'tr>>" + "<'row mt-3'<'col-xl-6 col-lg-6 col-md-6 col-12'i><'col-xl-6 col-lg-6 col-md-6 col-12'p>>",
        ajax: {
            type : "GET",
            contentType: "application/json; charset=utf-8",
            url: "/list/settings/jackpot",
            dataSrc: function(json) {
                if(json == "no data") {
                    return [];
                } else {
                    return json.data;
                }
            }
        },
        responsive: {
            details: {
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'w-100 nowrap table table-sm table-bordered'
                })
            }
        },
        language: langs,
        processing: true,
        stateSave: true,
        deferRender: true
    });

    $('.modal-addjackpot form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/settings/jackpot/add', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { jackpotTable.ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-addjackpot').modal('toggle');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    const addjackpotEvent = document.getElementById('modal-addjackpot');
    addjackpotEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });
    addjackpotEvent.addEventListener('shown.bs.modal', function (event) {
        gameProviderList3('gameprovider');
        gameProviderList3('gameprovider3');
        getGameCategoryList4('cateList');

        $('.modal-addjackpot .betSummary').addClass('visually-hidden');
        $('.modal-addjackpot [name=winners]').prop('disabled', true);
        $('.modal-addjackpot [name=usePass]').prop('disabled', true);
        $('.modal-addjackpot [name=intervalMin]').prop('disabled', true);
        $('.modal-addjackpot [name=minTurnover]').prop('disabled', true);
        $('.modal-addjackpot [name=calType]').prop('disabled', true);

        var radios = document.querySelectorAll('input[type=radio][name="jtype"]');
        radios.forEach(radio => radio.addEventListener('change', () => {
            // alert(radio.value);
            if( radio.value==3 || radio.value==5 ) {
                $('.modal-addjackpot [name=winners]').prop('disabled', false);
            } else {
                $('.modal-addjackpot [name=winners]').prop('disabled', true);
            }

            if( radio.value==5 ) {
                $('.modal-addjackpot .betSummary').removeClass('visually-hidden');
                $('.modal-addjackpot [name=usePass]').prop('disabled', false);
                $('.modal-addjackpot [name=intervalMin]').prop('disabled', false);
                $('.modal-addjackpot [name=minTurnover]').prop('disabled', false);
                $('.modal-addjackpot [name=calType]').prop('disabled', false);
            } else {
                $('.modal-addjackpot .betSummary').addClass('visually-hidden');
                $('.modal-addjackpot [name=usePass]').prop('disabled', true);
                $('.modal-addjackpot [name=intervalMin]').prop('disabled', true);
                $('.modal-addjackpot [name=minTurnover]').prop('disabled', true);
                $('.modal-addjackpot [name=calType]').prop('disabled', true);
            }
        }));
    });

    $('.modal-modifyJackpot form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/settings/jackpot/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => { jackpotTable.ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => { jackpotTable.ajax.reload(null,false); });
                }
            })
            .done(function() {
                $('.modal-modifyJackpot').modal('toggle');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    const modifyJackpotEvent = document.getElementById('modal-modifyJackpot');
    modifyJackpotEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');

        $('.modal-modifyJackpot [name=gpid2]').html(' ');
        $('.modal-modifyJackpot [name=gcate2]').html(' ');
        $('.modal-modifyJackpot [name=gpid4]').html(' ');
    });
    modifyJackpotEvent.addEventListener('shown.bs.modal', function (event) {
        gameProviderList3('gameprovider2');
        gameProviderList3('gameprovider4');
        getGameCategoryList4('cateList2');
    });
});

function modifyJackpot(id,name,accum,prize,reset,chip,display,status,type,numwin,duplicate,ppl,randomWin,maxJackpot,interval,turnover,caltype,usepass,typeduplicate,category,gprovider,chipgroup,summarygp)
{
    generalLoading();
    $('.modal-modifyJackpot').modal('toggle');

    if( type==3 || type==5 ) {
        $('.modal-modifyJackpot [name=winners]').prop('disabled', false);
    } else {
        $('.modal-modifyJackpot [name=winners]').prop('disabled', true);
    }

    if( type==5 ) {
        $('.modal-modifyJackpot .betSummary').removeClass('visually-hidden');
        // $('.modal-modifyJackpot [name=usePass]').prop('disabled', false);
        $('.modal-modifyJackpot [name=intervalMin]').prop('disabled', false);
        // $('.modal-modifyJackpot [name=minTurnover]').prop('disabled', false);
        // $('.modal-modifyJackpot [name=calType]').prop('disabled', false);
    } else {
        $('.modal-modifyJackpot .betSummary').addClass('visually-hidden');
        // $('.modal-modifyJackpot [name=usePass]').prop('disabled', true);
        $('.modal-modifyJackpot [name=intervalMin]').prop('disabled', true);
        // $('.modal-modifyJackpot [name=minTurnover]').prop('disabled', true);
        // $('.modal-modifyJackpot [name=calType]').prop('disabled', true);
    }

    status==1 ? $('.modal-modifyJackpot [name=status]#active_status').prop('checked',true) : $('.modal-modifyJackpot [name=status]#inactive_status').prop('checked',true);

    duplicate==true ? $('.modal-modifyJackpot [name=duplicate]#jyes').prop('checked',true) : $('.modal-modifyJackpot [name=duplicate]#jno').prop('checked',true);

    randomWin=='Yes' ? $('.modal-modifyJackpot [name=random]#randwyes').prop('checked',true) : $('.modal-modifyJackpot [name=random]#randwno').prop('checked',true);

    usepass=='Yes' ? $('.modal-modifyJackpot [name=usePass]#usePass_yes2').prop('checked',true) : $('.modal-modifyJackpot [name=usePass]#usePass_no2').prop('checked',true);

    typeduplicate==true ? $('.modal-modifyJackpot [name=typeduplicate]#tdpyes').prop('checked',true) : $('.modal-modifyJackpot [name=typeduplicate]#tdpno').prop('checked',true);

    if( reset==1 ) {
        $('.modal-modifyJackpot [name=resetby]#jhit').prop('checked',true);
    } else if( reset==2 ) {
        $('.modal-modifyJackpot [name=resetby]#jday').prop('checked',true);
    } else if( reset==3 ) {
        $('.modal-modifyJackpot [name=resetby]#jweek').prop('checked',true);
    } else if( reset==4 ) {
        $('.modal-modifyJackpot [name=resetby]#jmonth').prop('checked',true);
    }

    if( caltype==1 ) {
        $('.modal-modifyJackpot [name=calType]#caltype_effect2').prop('checked',true);
    } else if( caltype==2 ) {
        $('.modal-modifyJackpot [name=calType]#caltype_bet2').prop('checked',true);
    } else if( caltype==3 ) {
        $('.modal-modifyJackpot [name=calType]#caltype_deposit2').prop('checked',true);
    } else {
        $('.modal-modifyJackpot [name=calType]#caltype_none2').prop('checked',true);
    }
    
    if( gprovider!='' ) {
        setTimeout(function(){
            $('.modal-modifyJackpot [name=gpid2] option[value=' + gprovider + ']').attr('selected','selected');
        }, 1100);
    }
    
    if( category!=0 ) {
        setTimeout(function(){
            $('.modal-modifyJackpot [name=gcate2] option[value=' + category + ']').attr('selected','selected');
        }, 1200);
    }

    // if( type==6 ) {
    //     $('.modal-modifyJackpot .betSummary').removeClass('visually-hidden');
    //     $('.modal-modifyJackpot .gameChip').addClass('visually-hidden');
    // } else {
    //     $('.modal-modifyJackpot .betSummary').addClass('visually-hidden');
    //     $('.modal-modifyJackpot .gameChip').removeClass('visually-hidden');
    // }

    if( summarygp!='' ) {
        setTimeout(function(){
            $('.modal-modifyJackpot [name=gpid4] option[value=' + summarygp + ']').attr('selected','selected');
        }, 3300);
    }

    $('.modal-modifyJackpot [name=jtype]').val(type);
    $('.modal-modifyJackpot [name=id]').val(id);
    $('.modal-modifyJackpot [name=name]').val(name);
    $('.modal-modifyJackpot [name=prize]').val(prize);
    $('.modal-modifyJackpot [name=maxjackpot]').val(maxJackpot);
    $('.modal-modifyJackpot [name=accumulate]').val(accum);
    $('.modal-modifyJackpot [name=chip]').val(chip);
    $('.modal-modifyJackpot [name=maxwinner]').val(numwin);
    $('.modal-modifyJackpot [name=intervalMin]').val(interval);
    $('.modal-modifyJackpot [name=minTurnover]').val(turnover);
    $('.modal-modifyJackpot [name=displayamount]').val(display);
    $('.modal-modifyJackpot [name=winners]').html(atob(ppl));
    $('.modal-modifyJackpot [name=chipgroup2]').val(chipgroup);

    setTimeout(function(){
        swal.close();
    }, 3500);
}
</script>