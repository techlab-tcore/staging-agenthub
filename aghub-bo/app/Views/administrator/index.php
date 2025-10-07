<section class="card border-light mb-3">
    <h4 class="card-header p-3 bg-white fs-4 border-0"><?=$secTitle;?></h4>
</section>

<section class="card border-light mb-3">
    <h4 class="card-header p-3 bg-white"><?=lang('Label.general');?></h4>
    <article class="card-body">
        <?=form_open('', ['class'=>'form-validation row row-cols-lg-auto g-3 align-items-center generalForm','novalidate'=>'novalidate'], ['affRefReward'=>'', 'dailyReward'=>'']);?>
        <div class="col-xl-auto col-lg-auto col-md-auto col-12">
            <label class="d-block"><?=lang('Input.checkturnover');?></label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="checkturn" id="checkturn_yes" value="true" required>
                <label class="form-check-label" for="checkturn_yes"><?=lang('Label.yes');?></label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="checkturn" id="checkturn_no" value="false">
                <label class="form-check-label" for="checkturn_no"><?=lang('Label.no');?></label>
            </div>
        </div>
        <div class="col-xl-auto col-lg-auto col-md-auto col-12 visually-hidden">
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><?=lang('Input.numgameacct');?></span>
                <input type="number" min="0" class="form-control" name="numgameacct" required>
            </div>
        </div>
        <div class="col-xl-auto col-lg-auto col-md-auto col-12">
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><?=lang('Input.numdailywidthraw');?></span>
                <input type="number" min="0" class="form-control" name="numdailywidthraw" required>
            </div>
        </div>
        <div class="col-xl-auto col-lg-auto col-md-auto col-12">
            <div class="input-group">
                <span class="input-group-text"><?=lang('Input.exceedwithdrawalcharges');?></span>
                <input type="number" min="0" step="any" class="form-control" name="exceedwithdrawalcharges" required>
                <span class="input-group-text">%</span>
            </div>
        </div>
        <div class="col-xl-auto col-lg-auto col-md-auto col-12">
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><?=lang('Input.minexceedwithdrawalcharges');?></span>
                <input type="number" min="0" step="any" class="form-control" name="minexceedwithdrawalcharges" required>
            </div>
        </div>
        <div class="col-xl-auto col-lg-auto col-md-auto col-12">
            <button type="submit" class="btn btn-primary w-100"><?=lang('Nav.submit');?></button>
        </div>
        <?=form_close();?>
    </article>
</section>

<dl class="row m-0">
    <dd class="col-xl-4 col-lg-4 col-md-4 col-12">
        <section class="card border-light shadow">
            <h4 class="card-header p-3 bg-white"><?=lang('Label.depcomm');?></h4>
            <div class="card-body">
                <?=form_open('', ['class'=>'form-validation depositCommForm','novalidate'=>'novalidate'], ['affRefReward'=>'', 'dailyReward'=>'']);?>
                <div class="mb-3">
                    <label><?=lang('Input.mindeposit');?></label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><?=$_ENV['currency'];?></span>
                        <input type="number" step="any" min="0" class="form-control" name="depcomm_mindeposit" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label><?=lang('Label.cash');?></label>
                    <div class="input-group">
                        <input type="number" step="any" min="0" class="form-control" name="depcomm_rate" required>
                        <span class="input-group-text" id="basic-addon2">%</span>
                    </div>
                </div>
                <div class="mb-3">
                    <label><?=lang('Label.chip');?></label>
                    <div class="input-group">
                        <input type="number" step="any" min="0" class="form-control" name="depcomm_chippercent" value="0" required>
                        <span class="input-group-text" id="basic-addon2">%</span>
                    </div>
                </div>
                <div class="mb-3">
                    <label><?=lang('Input.chipgroup');?></label>
                    <input type="text" class="form-control" name="depcomm_chipgroup">
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary"><?=lang('Nav.submit');?></button>
                </div>
                <?=form_close();?>
            </div>
        </section>
    </dd>
    <dd class="col-xl-4 col-lg-4 col-md-4 col-12">
        <section class="card border-light shadow">
            <h4 class="card-header p-3 bg-white"><?=lang('Label.refdepcomm');?></h4>
            <div class="card-body">
                <?=form_open('', ['class'=>'form-validation refDepositCommForm','novalidate'=>'novalidate'], ['affRefReward'=>'', 'dailyReward'=>'']);?>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                        <label><?=lang('Input.nummember');?></label>
                        <input type="number" step="any" min="0" class="form-control" name="refcomm_count" required>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                        <label class="d-block"><?=lang('Input.triggeronce');?></label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="refcomm_once" id="refcomm_yes" value="true" required>
                            <label class="form-check-label" for="refcomm_yes"><?=lang('Label.yes');?></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="refcomm_once" id="refcomm_no" value="false">
                            <label class="form-check-label" for="refcomm_no"><?=lang('Label.no');?></label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label><?=lang('Input.mindeposit');?></label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><?=$_ENV['currency'];?></span>
                        <input type="number" step="any" min="0" class="form-control" name="refcomm_mindeposit" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                        <label><?=lang('Label.cash');?></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><?=$_ENV['currency'];?></span>
                            <input type="number" step="any" min="0" class="form-control" name="refcomm_cash" required>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                        <label><?=lang('Label.chip');?></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="bx bxs-coin"></i></span>
                            <input type="number" step="any" min="0" class="form-control" name="refcomm_chip" required>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label><?=lang('Input.chipgroup');?></label>
                    <input type="text" class="form-control" name="refcomm_chipgroup">
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary"><?=lang('Nav.submit');?></button>
                </div>
                <?=form_close();?>
            </div>
        </section>
    </dd>
    <dd class="col-xl-7 col-lg-7 col-md-7 col-12">
        <section class="card border-light shadow">
            <h4 class="card-header p-3 bg-white"><?=lang('Label.affsharereward');?></h4>
            <div class="card-body">
                <?=form_open('', ['class'=>'form-validation affRegRewardForm','novalidate'=>'novalidate'], ['dailyReward'=>'']);?>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                        <article>
                            <div class="mb-3">
                                <label class="d-block"><?=lang('Input.status');?></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sharedreward" id="sr_true" value="true">
                                    <label class="form-check-label" for="sr_true"><?=lang('Label.active');?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sharedreward" id="sr_false" value="false">
                                    <label class="form-check-label" for="sr_false"><?=lang('Label.inactive');?></label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="d-block"><?=lang('Input.beneficiary');?></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affsharetoself" id="affsrwdto_true" value="true">
                                    <label class="form-check-label" for="affsrwdto_true"><?=lang('Label.introducer');?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affsharetoself" id="affsrwdto_false" value="false">
                                    <label class="form-check-label" for="affsrwdto_false"><?=lang('Label.newmember');?></label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label><?=lang('Input.amount');?></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><?=$_ENV['currency'];?></span>
                                    <input type="number" step="any" min="0" class="form-control" name="affshareamount">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label><?=lang('Input.maxbalance');?></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><?=$_ENV['currency'];?></span>
                                    <input type="number" step="any" min="0" class="form-control" name="affreg_maxbalance" value="0" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                    <label><?=lang('Input.game');?></label>
                                    <select class="form-select" name="affsharegpid" id="gameprovider2"></select>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                    <label><?=lang('Input.category');?></label>
                                    <select class="form-select" name="affsharegcate" id="cateList2"></select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="d-block"><?=lang('Input.types');?></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affshare2wallet" id="affs_cash" value="1">
                                    <label class="form-check-label" for="affs_cash"><?=lang('Label.cash');?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affshare2wallet" id="affs_chip" value="3">
                                    <label class="form-check-label" for="affs_chip"><?=lang('Label.chip');?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affshare2wallet" id="affs_fortunetoken" value="4">
                                    <label class="form-check-label" for="affs_fortunetoken"><?=lang('Label.fortunetoken');?></label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label><?=lang('Input.chipgroup');?></label>
                                <input type="text" class="form-control" name="affsharechipgroup">
                            </div>
                            <div class="mb-3">
                                <label class="d-block"><?=lang('Input.deductupline');?></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affsharedeductdffrmupline" id="affshareupline_yes" value="true">
                                    <label class="form-check-label" for="affshareupline_yes"><?=lang('Label.yes');?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affsharedeductdffrmupline" id="affshareupline_no" value="false">
                                    <label class="form-check-label" for="affshareupline_no"><?=lang('Label.no');?></label>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                        <article>
                            <div class="mb-3">
                                <label class="d-block"><?=lang('Input.status');?></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sharedreward2" id="sr_true2" value="true">
                                    <label class="form-check-label" for="sr_true2"><?=lang('Label.active');?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sharedreward2" id="sr_false2" value="false">
                                    <label class="form-check-label" for="sr_false2"><?=lang('Label.inactive');?></label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="d-block"><?=lang('Input.beneficiary');?></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affsharetoself2" id="affsrwdto_true2" value="true">
                                    <label class="form-check-label" for="affsrwdto_true2"><?=lang('Label.introducer');?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affsharetoself2" id="affsrwdto_false2" value="false">
                                    <label class="form-check-label" for="affsrwdto_false2"><?=lang('Label.newmember');?></label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label><?=lang('Input.amount');?></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><?=$_ENV['currency'];?></span>
                                    <input type="number" step="any" min="0" class="form-control" name="affshareamount2">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label><?=lang('Input.maxbalance');?></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><?=$_ENV['currency'];?></span>
                                    <input type="number" step="any" min="0" class="form-control" name="affreg_maxbalance2" value="0" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                    <label><?=lang('Input.game');?></label>
                                    <select class="form-select" name="affsharegpid2" id="gameprovider3"></select>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                    <label><?=lang('Input.category');?></label>
                                    <select class="form-select" name="affsharegcate2" id="cateList3"></select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="d-block"><?=lang('Input.types');?></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affshare2wallet2" id="affs_cash2" value="1">
                                    <label class="form-check-label" for="affs_cash2"><?=lang('Label.cash');?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affshare2wallet2" id="affs_chip2" value="3">
                                    <label class="form-check-label" for="affs_chip2"><?=lang('Label.chip');?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affshare2wallet2" id="affs_fortunetoken2" value="4">
                                    <label class="form-check-label" for="affs_fortunetoken2"><?=lang('Label.fortunetoken');?></label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label><?=lang('Input.chipgroup');?></label>
                                <input type="text" class="form-control" name="affsharechipgroup2">
                            </div>
                            <div class="mb-3">
                                <label class="d-block"><?=lang('Input.deductupline');?></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affsharedeductdffrmupline2" id="affshareupline_yes2" value="true">
                                    <label class="form-check-label" for="affshareupline_yes2"><?=lang('Label.yes');?></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affsharedeductdffrmupline2" id="affshareupline_no2" value="false">
                                    <label class="form-check-label" for="affshareupline_no2"><?=lang('Label.no');?></label>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary"><?=lang('Nav.submit');?></button>
                </div>
                <?=form_close();?>
            </div>
        </section>
    </dd>
    <dd class="col-xl-5 col-lg-5 col-md-5 col-12">
        <section class="card border-light shadow">
            <h4 class="card-header p-3 bg-white"><?=lang('Label.dailyfreereward');?></h4>
            <div class="card-body">
                <?=form_open('', ['class'=>'form-validation dailyRewardForm','novalidate'=>'novalidate'], ['affRefReward'=>'']);?>
                <div class="mb-3">
                    <label class="d-block"><?=lang('Input.status');?></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="dailyfree" id="dfr_true" value="true">
                        <label class="form-check-label" for="dfr_true"><?=lang('Label.active');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="dailyfree" id="dfr_false" value="false">
                        <label class="form-check-label" for="dfr_false"><?=lang('Label.inactive');?></label>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="d-block"><?=lang('Input.includetoday');?></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="includetoday" id="intdy_true" value="true" required>
                        <label class="form-check-label" for="intdy_true"><?=lang('Label.yes');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="includetoday" id="intdy_false" value="false">
                        <label class="form-check-label" for="intdy_false"><?=lang('Label.no');?></label>
                    </div>
                </div>
                <div class="mb-3">
                    <label><?=lang('Input.amount');?></label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><?=$_ENV['currency'];?></span>
                        <input type="number" step="any" min="0" class="form-control" name="dailyfreeamount">
                    </div>
                </div>
                <div class="mb-3">
                    <label><?=lang('Input.maxbalance');?></label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><?=$_ENV['currency'];?></span>
                        <input type="number" step="any" min="0" class="form-control" name="maxbalance" value="0" required>
                    </div>
                </div>
                <div class="row">
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
                    <label class="d-block"><?=lang('Input.types');?></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="reward2wallet" id="rwdw_cash" value="1">
                        <label class="form-check-label" for="rwdw_cash"><?=lang('Label.cash');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="reward2wallet" id="rwdw_chip" value="3">
                        <label class="form-check-label" for="rwdw_chip"><?=lang('Label.chip');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="reward2wallet" id="rwdw_fortunetoken" value="4">
                        <label class="form-check-label" for="rwdw_fortunetoken"><?=lang('Label.fortunetoken');?></label>
                    </div>
                </div>
                <div class="mb-3">
                    <label><?=lang('Input.chipgroup');?></label>
                    <input type="text" class="form-control" name="dfchipgroup">
                </div>
                <div class="mb-3">
                    <label class="d-block"><?=lang('Input.deductupline');?></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="deductdffrmupline" id="dffupline_yes" value="true">
                        <label class="form-check-label" for="dffupline_yes"><?=lang('Label.yes');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="deductdffrmupline" id="dffupline_no" value="false">
                        <label class="form-check-label" for="dffupline_no"><?=lang('Label.no');?></label>
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary"><?=lang('Nav.submit');?></button>
                </div>
                <?=form_close();?>
            </div>
        </section>
    </dd>
</dl>

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

    gameProviderList3('gameprovider');
    gameProviderList3('gameprovider2');
    gameProviderList3('gameprovider3');

    getGameCategoryList2('cateList');
    getGameCategoryList2('cateList2');
    getGameCategoryList2('cateList3');

    $('.depositCommForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $('.depositCommForm [type=submit]').prop('disabled',true);

            $.post('/administrator/api-config/deposit-comm/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => {

                    });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.depositCommForm [type=submit]').prop('disabled',false);
                // $('.depositCommForm').trigger('reset');
                $('.depositCommForm').removeClass('was-validated');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => {
                    $('.depositCommForm [type=submit]').prop('disabled',false);
                });
            });
        }
    });

    $('.refDepositCommForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $('.refDepositCommForm [type=submit]').prop('disabled',true);

            $.post('/administrator/api-config/referral-deposit-comm/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => {

                    });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.refDepositCommForm [type=submit]').prop('disabled',false);
                // $('.refDepositCommForm').trigger('reset');
                $('.refDepositCommForm').removeClass('was-validated');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => {
                    $('.refDepositCommForm [type=submit]').prop('disabled',false);
                });
            });
        }
    });

    $('.dailyRewardForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $('.dailyRewardForm [type=submit]').prop('disabled',true);

            $.post('/administrator/api-config/daily-reward/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => {

                    });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.dailyRewardForm [type=submit]').prop('disabled',false);
                // $('.refDepositCommForm').trigger('reset');
                $('.dailyRewardForm').removeClass('was-validated');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => {
                    $('.dailyRewardForm [type=submit]').prop('disabled',false);
                });
            });
        }
    });

    $('.affRegRewardForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $('.affRegRewardForm [type=submit]').prop('disabled',true);

            $.post('/administrator/api-config/affiliate-shared-reward/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => {

                    });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.affRegRewardForm [type=submit]').prop('disabled',false);
                // $('.refDepositCommForm').trigger('reset');
                $('.affRegRewardForm').removeClass('was-validated');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => {
                    $('.affRegRewardForm [type=submit]').prop('disabled',false);
                });
            });
        }
    });

    $('.generalForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $('.generalForm [type=submit]').prop('disabled',true);

            $.post('/administrator/api-config/general/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => {

                    });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.generalForm [type=submit]').prop('disabled',false);
                // $('.depositCommForm').trigger('reset');
                $('.generalForm').removeClass('was-validated');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => {
                    $('.generalForm [type=submit]').prop('disabled',false);
                });
            });
        }
    });
});

function getAdminConfig()
{
    $.get('/administrator/api-config', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            $('.depositCommForm [name=affRefReward], .refDepositCommForm [name=affRefReward], .dailyRewardForm [name=affRefReward], .generalForm [name=affRefReward]').val(JSON.stringify(obj.data.affRegReward));
            $('.depositCommForm [name=dailyReward], .refDepositCommForm [name=dailyReward], .affRegRewardForm [name=dailyReward], .generalForm [name=dailyReward]').val(JSON.stringify(obj.data.dailyReward));

            // General
            obj.data.general.checkTurnover==true ? $('.generalForm [name=checkturn]#checkturn_yes').prop('checked',true) : $('.generalForm [name=checkturn]#checkturn_no').prop('checked',true);
            document.getElementsByName('numgameacct')[0].value = obj.data.general.maxGameAccount;
            document.getElementsByName('numdailywidthraw')[0].value = obj.data.general.dailyWithdrawalCount;
            document.getElementsByName('exceedwithdrawalcharges')[0].value = obj.data.general.exceedNumWithdrawalCharges;
            document.getElementsByName('minexceedwithdrawalcharges')[0].value = obj.data.general.minChargesExceedWithdrawal;

            // Deposit Comm
            document.getElementsByName('depcomm_mindeposit')[0].value = obj.data.depositComm.minDeposit;
            document.getElementsByName('depcomm_rate')[0].value = obj.data.depositComm.percentage;
            document.getElementsByName('depcomm_chippercent')[0].value = obj.data.depositComm.toWalletPercentage;
            document.getElementsByName('depcomm_chipgroup')[0].value = obj.data.depositComm.toGroupName;

            // Referral Deposit Comm
            document.getElementsByName('refcomm_count')[0].value = obj.data.referralComm.count;
            document.getElementsByName('refcomm_mindeposit')[0].value = obj.data.referralComm.minDeposit;
            document.getElementsByName('refcomm_cash')[0].value = obj.data.referralComm.toBalance;
            document.getElementsByName('refcomm_chip')[0].value = obj.data.referralComm.toWallet;
            document.getElementsByName('refcomm_chipgroup')[0].value = obj.data.referralComm.toGroupName;

            obj.data.referralComm.onlyOne==true ? $('.refDepositCommForm [name=refcomm_once]#refcomm_yes').prop('checked',true) : $('.refDepositCommForm [name=refcomm_once]#refcomm_no').prop('checked',true);

            // Daily Reward
            let dailyFree = obj.data.dailyReward;
            if( dailyFree.length>0 ) {
                $('.dailyRewardForm [name=dailyfree]#dfr_true').prop('checked',true);

                $('.dailyRewardForm [name=maxbalance]').val(obj.data.dailyReward[0].maxBalance);
                document.getElementsByName('dailyfreeamount')[0].value = obj.data.dailyReward[0].amount;
                document.getElementsByName('dfchipgroup')[0].value = obj.data.dailyReward[0].toGroupName;

                obj.data.dailyReward[0].includeToday==true ? $('.dailyRewardForm [name=includetoday]#intdy_true').prop('checked',true) : $('.dailyRewardForm [name=includetoday]#intdy_false').prop('checked',true);

                obj.data.dailyReward[0].deductOwnAgent==true ? $('.dailyRewardForm [name=deductdffrmupline]#dffupline_yes').prop('checked',true) : $('.dailyRewardForm [name=deductdffrmupline]#dffupline_no').prop('checked',true);

                if( obj.data.dailyReward[0].gameProviderId!='' ) {
                    $('.dailyRewardForm [name=gpid] option[value=' + btoa(obj.data.dailyReward[0].gameProviderId) + ']').attr('selected','selected');
                }

                if( obj.data.dailyReward[0].gameType!='' ) {
                    $('.dailyRewardForm [name=gcate] option[value=' + obj.data.dailyReward[0].gameType + ']').attr('selected','selected');
                }

                if( obj.data.dailyReward[0].walletType==1 ) {
                    $('.dailyRewardForm [name=reward2wallet]#rwdw_cash').prop('checked',true);
                } else if( obj.data.dailyReward[0].walletType==3 ) {
                    $('.dailyRewardForm [name=reward2wallet]#rwdw_chip').prop('checked',true);
                } else if( obj.data.dailyReward[0].walletType==4 ) {
                    $('.dailyRewardForm [name=reward2wallet]#rwdw_fortunetoken').prop('checked',true);
                }
            } else {
                $('.dailyRewardForm [name=dailyfree]#dfr_false').prop('checked',true);
            }

            // Affiliate Shared Reward
            let shareReward = obj.data.affRegReward;
            if( shareReward.length>0 ) {
                $('.affRegRewardForm [name=sharedreward]#sr_true').prop('checked',true);

                $('.affRegRewardForm [name=affreg_maxbalance]').val(obj.data.affRegReward[0].maxBalance);
                document.getElementsByName('affshareamount')[0].value = obj.data.affRegReward[0].amount;
                document.getElementsByName('affsharechipgroup')[0].value = obj.data.affRegReward[0].toGroupName;

                obj.data.affRegReward[0].toSelf==true ? $('.affRegRewardForm [name=affsharetoself]#affsrwdto_true').prop('checked',true) : $('.affRegRewardForm [name=affsharetoself]#affsrwdto_false').prop('checked',true);

                obj.data.affRegReward[0].deductOwnAgent==true ? $('.affRegRewardForm [name=affsharedeductdffrmupline]#affshareupline_yes').prop('checked',true) : $('.affRegRewardForm [name=affsharedeductdffrmupline]#affshareupline_no').prop('checked',true);

                if( obj.data.affRegReward[0].gameProviderId!='' ) {
                    $('.affRegRewardForm [name=affsharegpid] option[value=' + btoa(obj.data.affRegReward[0].gameProviderId) + ']').attr('selected','selected');
                }

                if( obj.data.affRegReward[0].gameType!='' ) {
                    $('.affRegRewardForm [name=affsharegcate] option[value=' + obj.data.affRegReward[0].gameType + ']').attr('selected','selected');
                }

                if( obj.data.affRegReward[0].walletType==1 ) {
                    $('.affRegRewardForm [name=affshare2wallet]#affs_cash').prop('checked',true);
                } else if( obj.data.affRegReward[0].walletType==3 ) {
                    $('.affRegRewardForm [name=affshare2wallet]#affs_chip').prop('checked',true);
                } else if( obj.data.affRegReward[0].walletType==4 ) {
                    $('.affRegRewardForm [name=affshare2wallet]#affs_fortunetoken').prop('checked',true);
                }

                if( shareReward.length==2 ) {
                    $('.affRegRewardForm [name=sharedreward2]#sr_true2').prop('checked',true);

                    $('.affRegRewardForm [name=affreg_maxbalance2]').val(obj.data.affRegReward[1].maxBalance);
                    document.getElementsByName('affshareamount2')[0].value = obj.data.affRegReward[1].amount;
                    document.getElementsByName('affsharechipgroup2')[0].value = obj.data.affRegReward[1].toGroupName;

                    obj.data.affRegReward[1].toSelf==true ? $('.affRegRewardForm [name=affsharetoself2]#affsrwdto_true2').prop('checked',true) : $('.affRegRewardForm [name=affsharetoself2]#affsrwdto_false2').prop('checked',true);

                    obj.data.affRegReward[1].deductOwnAgent==true ? $('.affRegRewardForm [name=affsharedeductdffrmupline2]#affshareupline_yes2').prop('checked',true) : $('.affRegRewardForm [name=affsharedeductdffrmupline2]#affshareupline_no2').prop('checked',true);

                    if( obj.data.affRegReward[1].gameProviderId!='' ) {
                        $('.affRegRewardForm [name=affsharegpid2] option[value=' + btoa(obj.data.affRegReward[1].gameProviderId) + ']').attr('selected','selected');
                    }

                    if( obj.data.affRegReward[1].gameType!='' ) {
                        $('.affRegRewardForm [name=affsharegcate2] option[value=' + obj.data.affRegReward[1].gameType + ']').attr('selected','selected');
                    }

                    if( obj.data.affRegReward[1].walletType==1 ) {
                        $('.affRegRewardForm [name=affshare2wallet2]#affs_cash2').prop('checked',true);
                    } else if( obj.data.affRegReward[1].walletType==3 ) {
                        $('.affRegRewardForm [name=affshare2wallet2]#affs_chip2').prop('checked',true);
                    } else if( obj.data.affRegReward[1].walletType==4 ) {
                        $('.affRegRewardForm [name=affshare2wallet2]#affs_fortunetoken2').prop('checked',true);
                    }
                }
            } else {
                if( shareReward.length==0 ) {
                    $('.affRegRewardForm [name=sharedreward]#sr_false').prop('checked',true);
                }
                
                if( shareReward.length==1 || shareReward.length==0 ) {
                    $('.affRegRewardForm [name=sharedreward2]#sr_false2').prop('checked',true);
                }
            }
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