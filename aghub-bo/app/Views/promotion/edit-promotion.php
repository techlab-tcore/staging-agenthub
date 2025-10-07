<section class="card border-light shadow">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <div class="px-3 mb-3">
            <a class="btn btn-danger bg-gradient shadow" href="<?=base_url('settings/promotion');?>"><?=lang('Nav.b2promo');?></a>
        </div>

        <article class="card-text p-3">
            <?=form_open('',['class'=>'form-validation modifyPromoForm', 'id'=>'modifyPromoForm', 'novalidate'=>'novalidate']);?>
            <dl class="row m-0">
                <dd class="col-xl-6 col-lg-6 col-md-6 col-12 m-0">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="mb-3">
                                <label class="w-100"><?=lang('Input.specialpromo');?></label>
                                <data class="d-block mt-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="triggerWallet" id="trgw_on" value="1" required>
                                        <label class="form-check-label" for="trgw_on"><?=lang('Label.enable');?></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="triggerWallet" id="trgw_off" value="2">
                                        <label class="form-check-label" for="trgw_off"><?=lang('Label.disable');?></label>
                                    </div>
                                </data>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="mb-3">
                                <label class="w-100"><?=lang('Input.claimafter');?></label>
                                <data class="d-block mt-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="afterpay" id="afp_true" value="true" required>
                                        <label class="form-check-label" for="afp_true"><?=lang('Label.enable');?></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="afterpay" id="afp_false" value="false">
                                        <label class="form-check-label" for="afp_false"><?=lang('Label.disable');?></label>
                                    </div>
                                </data>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 targetPromotion">
                        <label class="w-100"><?=lang('Input.targetpromo');?></label>
                        <data class="d-block mt-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="triggerType" id="trgt_game" value="1">
                                <label class="form-check-label" for="trgt_game"><?=lang('Label.games');?></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="triggerType" id="trgw_category" value="2">
                                <label class="form-check-label" for="trgw_category"><?=lang('Input.category');?></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="triggerType" id="trgw_chipgroup" value="4">
                                <label class="form-check-label" for="trgw_chipgroup"><?=lang('Input.chipgroup');?></label>
                            </div>
                        </data>
                    </div>
                    <div class="mb-3 category">
                        <label class="w-100"><?=lang('Input.category');?></label>
                        <data class="d-block mt-2" id="cateList"></data>
                    </div>
                    <div class="input-group mb-3 gameProvider">
                        <span class="input-group-text"><?=lang('Label.games');?></span>
                        <select class="form-select" id="gameprovider" name="gameprovider"></select>
                    </div>
                    <div class="input-group mb-3 chipGroup">
                        <span class="input-group-text"><?=lang('Input.chipgroup');?></span>
                        <input type="text" class="form-control" name="chipgroup">
                    </div>
                    <div class="mb-3">
                        <label class="w-100"><?=lang('Input.restrictapply');?></label>
                        <data class="d-block mt-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="activeMethod" id="am_unlimited" value="0" required>
                                <label class="form-check-label" for="am_unlimited"><?=lang('Label.unlimited');?></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="activeMethod" id="am_once" value="1">
                                <label class="form-check-label" for="am_once"><?=lang('Label.onceonly');?></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="activeMethod" id="am_week" value="2">
                                <label class="form-check-label" for="am_week"><?=lang('Label.onceperweek');?></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="activeMethod" id="am_month" value="3">
                                <label class="form-check-label" for="am_month"><?=lang('Label.oncepermonth');?></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="activeMethod" id="am_day" value="4">
                                <label class="form-check-label" for="am_day"><?=lang('Label.onceperday');?></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="activeMethod" id="am_specific" value="5">
                                <label class="form-check-label" for="am_specific"><?=lang('Label.specificdays');?></label>
                            </div>
                        </data>
                    </div>
                    <div class="mb-3 specificDays">
                        <label class="w-100"><?=lang('Input.choosespdays');?></label>
                        <data class="d-block mt-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="spDay" id="spDay_mon" value="1">
                                <label class="form-check-label" for="spDay_mon"><?=lang('Label.monday');?></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="spDay" id="spDay_tue" value="2">
                                <label class="form-check-label" for="spDay_tue"><?=lang('Label.tuesday');?></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="spDay" id="spDay_wed" value="3">
                                <label class="form-check-label" for="spDay_wed"><?=lang('Label.wednesday');?></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="spDay" id="spDay_thu" value="4">
                                <label class="form-check-label" for="spDay_thu"><?=lang('Label.thursday');?></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="spDay" id="spDay_fri" value="5">
                                <label class="form-check-label" for="spDay_fri"><?=lang('Label.friday');?></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="spDay" id="spDay_sat" value="6">
                                <label class="form-check-label" for="spDay_sat"><?=lang('Label.saturday');?></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="spDay" id="spDay_sun" value="0">
                                <label class="form-check-label" for="spDay_sun"><?=lang('Label.sunday');?></label>
                            </div>
                        </data>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><?=lang('Input.numberclaim');?></span>
                                <input type="number" min="0" class="form-control" name="numclaim" value="1" required>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><?=lang('Input.mins');?></span>
                                <input type="number" min="0" class="form-control" name="mins" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="mb-3">
                                <label class="w-100"><?=lang('Input.resitmode');?></label>
                                <data class="d-block mt-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="resittype" id="resit_deposit" value="1" required>
                                        <label class="form-check-label" for="resit_deposit"><?=lang('Label.deposit');?></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="resittype" id="resit_withdraw" value="2">
                                        <label class="form-check-label" for="resit_withdraw"><?=lang('Label.withdrawal');?></label>
                                    </div>
                                </data>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><?=lang('Input.totalreceipt');?></span>
                                <input type="number" min="0" class="form-control" name="totalreceipt" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="mb-3">
                                <label class="w-100"><?=lang('Input.continueclaim');?></label>
                                <data class="d-block mt-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="contclaim" id="contclaim_yes" value="1" required>
                                        <label class="form-check-label" for="contclaim_yes"><?=lang('Label.yes');?></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="contclaim" id="contclaim_no" value="2">
                                        <label class="form-check-label" for="contclaim_no"><?=lang('Label.no');?></label>
                                    </div>
                                </data>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><?=lang('Input.contclaimday');?></span>
                                <input type="number" min="0" class="form-control" name="contclaimday" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><?=lang('Input.order');?></span>
                                <input type="number" min="0" class="form-control" name="order" required>
                            </div>
                        </div>
                    </div>
                </dd>
                <dd class="col-xl-6 col-lg-6 col-md-6 col-12 m-0">
                    <div class="mb-3">
                        <label class="w-100"><?=lang('Input.randamt');?></label>
                        <data class="d-block mt-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="random" id="randwyes" value="true" required>
                                <label class="form-check-label" for="randwyes"><?=lang('Label.yes');?></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="random" id="randwno" value="false">
                                <label class="form-check-label" for="randwno"><?=lang('Label.no');?></label>
                            </div>
                        </data>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><?=lang('Input.bonus');?></span>
                                <input type="number" step="any" min="0" class="form-control" name="bonusRate" placeholder="0" required>
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><?=lang('Input.extamount');?></span>
                                <input type="number" step="any" min="0" class="form-control" name="actualAmount" placeholder="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><?=lang('Input.randmax');?></span>
                                <input type="number" step="any" min="0" class="form-control" name="maxrandom" value="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><?=lang('Input.maxbonus');?></span>
                        <input type="number" step="any" min="0" class="form-control" name="maxBonus" placeholder="100" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><?=lang('Input.rollover');?></span>
                        <input type="number" step="any" min="0" class="form-control" name="rollover" placeholder="3" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><?=lang('Input.minturnover');?></span>
                        <input type="number" step="any" min="0" class="form-control" name="minTurnover" placeholder="300" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><?=lang('Input.mindeposit');?></span>
                        <input type="number" step="any" min="0" class="form-control" name="minDeposit" placeholder="30" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><?=lang('Input.maxdeposit');?></span>
                        <input type="number" step="any" min="0" class="form-control" name="maxDeposit" placeholder="1000" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><?=lang('Input.maxwithdrawal');?></span>
                        <input type="number" step="any" min="0" class="form-control" name="maxWithdrawal" value="0" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><?=lang('Input.effectdate');?></span>
                        <input type="text" class="form-control bg-white" name="start5" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><?=lang('Input.expiredate');?></span>
                        <input type="text" class="form-control bg-white" name="end5" readonly>
                    </div>
                </dd>
            </dl>
            <div class="mb-3">
                <div class="card border-0">
                    <button class="btn btn-primary card-header" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEN" aria-expanded="false" aria-controls="collapseEN"><?=lang('Input.content');?> - ENGLISH</button>
                    <article class="card-body collapse show p-0" id="collapseEN">
                        <div class="input-group my-3">
                            <span class="input-group-text"><?=lang('Input.title');?></span>
                            <textarea class="form-control" name="titleEN" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="input-group">
                                <span class="input-group-text"><?=lang('Input.image');?></span>
                                <input type="text" class="form-control" placeholder="https://image.example.com/" name="imgEN">
                                <a target="_blank" class="btn btn-primary" href="https://imgur.com/"><i class="bx bxs-image"></i></a>
                            </div>
                            <small class="form-text">Image dimension: 640px (width) x 167px (height)</small>
                        </div>
                        <textarea class="form-control" name="en" id="promoEN"></textarea>
                    </article>
                </div>
            </div>
            <div class="mb-3">
                <div class="card border-0">
                    <button class="btn btn-primary card-header" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMY" aria-expanded="false" aria-controls="collapseMY"><?=lang('Input.content');?> - BAHASA</button>
                    <article class="card-body collapse p-0" id="collapseMY">
                        <div class="input-group my-3">
                            <span class="input-group-text"><?=lang('Input.title');?></span>
                            <textarea class="form-control" name="titleMY"></textarea>
                        </div>
                        <div class="my-3">
                            <div class="input-group">
                                <span class="input-group-text"><?=lang('Input.image');?></span>
                                <input type="text" class="form-control" placeholder="https://image.example.com/" name="imgMY">
                                <a target="_blank" class="btn btn-primary" href="https://imgur.com/"><i class="bx bxs-image"></i></a>
                            </div>
                            <small class="form-text">Image dimension: 640px (width) x 167px (height)</small>
                        </div>
                        <textarea class="form-control" name="my" id="promoMY"></textarea>
                    </article>
                </div>
            </div>
            <div class="mb-3">
                <div class="card border-0">
                    <button class="btn btn-primary card-header" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCN" aria-expanded="false" aria-controls="collapseCN"><?=lang('Input.content');?> - 简体中文</button>
                    <article class="card-body collapse p-0" id="collapseCN">
                        <div class="input-group my-3">
                            <span class="input-group-text"><?=lang('Input.title');?></span>
                            <textarea class="form-control" name="titleCN"></textarea>
                        </div>
                        <div class="my-3">
                            <div class="input-group">
                                <span class="input-group-text"><?=lang('Input.image');?></span>
                                <input type="text" class="form-control" placeholder="https://image.example.com/" name="imgCN">
                                <a target="_blank" class="btn btn-primary" href="https://imgur.com/"><i class="bx bxs-image"></i></a>
                            </div>
                            <small class="form-text">Image dimension: 640px (width) x 167px (height)</small>
                        </div>
                        <textarea class="form-control" name="cn" id="promoCN"></textarea>
                    </article>
                </div>
            </div>
            <div class="mb-3">
                <div class="card border-0">
                    <button class="btn btn-primary card-header" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTH" aria-expanded="false" aria-controls="collapseTH"><?=lang('Input.content');?> - ไทย</button>
                    <article class="card-body collapse p-0" id="collapseTH">
                        <div class="input-group my-3">
                            <span class="input-group-text"><?=lang('Input.title');?></span>
                            <textarea class="form-control" name="titleTH"></textarea>
                        </div>
                        <div class="my-3">
                            <div class="input-group">
                                <span class="input-group-text"><?=lang('Input.image');?></span>
                                <input type="text" class="form-control" placeholder="https://image.example.com/" name="imgTH">
                                <a target="_blank" class="btn btn-primary" href="https://imgur.com/"><i class="bx bxs-image"></i></a>
                            </div>
                            <small class="form-text">Image dimension: 640px (width) x 167px (height)</small>
                        </div>
                        <textarea class="form-control" name="th" id="promoTH"></textarea>
                    </article>
                </div>
            </div>
            <div class="mb-3">
                <div class="card border-0">
                    <button class="btn btn-primary card-header" type="button" data-bs-toggle="collapse" data-bs-target="#collapseVN" aria-expanded="false" aria-controls="collapseVN"><?=lang('Input.content');?> - TIẾNG VIỆT</button>
                    <article class="card-body collapse p-0" id="collapseVN">
                        <div class="input-group my-3">
                            <span class="input-group-text"><?=lang('Input.title');?></span>
                            <textarea class="form-control" name="titleVN"></textarea>
                        </div>
                        <div class="my-3">
                            <div class="input-group">
                                <span class="input-group-text"><?=lang('Input.image');?></span>
                                <input type="text" class="form-control" placeholder="https://image.example.com/" name="imgVN">
                                <a target="_blank" class="btn btn-primary" href="https://imgur.com/"><i class="bx bxs-image"></i></a>
                            </div>
                            <small class="form-text">Image dimension: 640px (width) x 167px (height)</small>
                        </div>
                        <textarea class="form-control" name="vn" id="promoVN"></textarea>
                    </article>
                </div>
            </div>
            <div class="mb-3">
                <div class="card border-0">
                    <button class="btn btn-primary card-header" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBGL" aria-expanded="false" aria-controls="collapseBGL"><?=lang('Input.content');?> - বাংলা</button>
                    <article class="card-body collapse p-0" id="collapseBGL">
                        <div class="input-group my-3">
                            <span class="input-group-text"><?=lang('Input.title');?></span>
                            <textarea class="form-control" name="titleBGL"></textarea>
                        </div>
                        <div class="my-3">
                            <div class="input-group">
                                <span class="input-group-text"><?=lang('Input.image');?></span>
                                <input type="text" class="form-control" placeholder="https://image.example.com/" name="imgBGL">
                                <a target="_blank" class="btn btn-primary" href="https://imgur.com/"><i class="bx bxs-image"></i></a>
                            </div>
                            <small class="form-text">Image dimension: 640px (width) x 167px (height)</small>
                        </div>
                        <textarea class="form-control" name="bgl" id="promoBGL"></textarea>
                    </article>
                </div>
            </div>
            <div class="mb-3">
                <div class="card border-0">
                    <button class="btn btn-primary card-header" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBUR" aria-expanded="false" aria-controls="collapseBUR"><?=lang('Input.content');?> - BURMESE</button>
                    <article class="card-body collapse p-0" id="collapseBUR">
                        <div class="input-group my-3">
                            <span class="input-group-text"><?=lang('Input.title');?></span>
                            <textarea class="form-control" name="titleBUR"></textarea>
                        </div>
                        <div class="my-3">
                            <div class="input-group">
                                <span class="input-group-text"><?=lang('Input.image');?></span>
                                <input type="text" class="form-control" placeholder="https://image.example.com/" name="imgBUR">
                                <a target="_blank" class="btn btn-primary" href="https://imgur.com/"><i class="bx bxs-image"></i></a>
                            </div>
                            <small class="form-text">Image dimension: 640px (width) x 167px (height)</small>
                        </div>
                        <textarea class="form-control" name="bur" id="promoBUR"></textarea>
                    </article>
                </div>
            </div>
            <div class="mb-3">
                <div class="card border-0">
                    <button class="btn btn-primary card-header" type="button" data-bs-toggle="collapse" data-bs-target="#collapseIN" aria-expanded="false" aria-controls="collapseIN"><?=lang('Input.content');?> - INDONESIA</button>
                    <article class="card-body collapse p-0" id="collapseIN">
                        <div class="input-group my-3">
                            <span class="input-group-text"><?=lang('Input.title');?></span>
                            <textarea class="form-control" name="titleIN"></textarea>
                        </div>
                        <div class="my-3">
                            <div class="input-group">
                                <span class="input-group-text"><?=lang('Input.image');?></span>
                                <input type="text" class="form-control" placeholder="https://image.example.com/" name="imgIN">
                                <a target="_blank" class="btn btn-primary" href="https://imgur.com/"><i class="bx bxs-image"></i></a>
                            </div>
                            <small class="form-text">Image dimension: 640px (width) x 167px (height)</small>
                        </div>
                        <textarea class="form-control" name="in" id="promoIN"></textarea>
                    </article>
                </div>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary"><?=lang('Nav.submit');?></button>
            </div>
            <?=form_close();?>
        </article>
    </div>
</section>

<script src="<?=base_url('assets/vendors/ckeditor5/build/ckeditor.js');?>"></script>
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', (event) => {
    airdatepicker();
    gameProviderList2('gameprovider')
    getGameCategoryList3('cateList');
    getPromotion();

    const rootElement = document.getElementsByClassName('modifyPromoForm')[0];
    rootElement.getElementsByClassName('targetPromotion')[0].style.display='none';
    rootElement.getElementsByClassName('category')[0].style.display='none';
    rootElement.getElementsByClassName('gameProvider')[0].style.display='none';
    rootElement.getElementsByClassName('chipGroup')[0].style.display='none';
    rootElement.getElementsByClassName('specificDays')[0].style.display='none';

    $('[name=triggerWallet]').click(() => {
        const targetPromo = rootElement.getElementsByClassName('targetPromotion')[0];

        if( $('[name=triggerWallet]#trgw_on').is(':checked') )
        {
            targetPromo.style.display='block';
        } else {
            targetPromo.style.display='none';
            rootElement.getElementsByClassName('gameProvider')[0].style.display='none';
            rootElement.getElementsByClassName('category')[0].style.display='none';
            rootElement.getElementsByClassName('chipGroup')[0].style.display='none';
        }
    });

    $('[name=triggerType]').click(() => {
        const gameProvider = rootElement.getElementsByClassName('gameProvider')[0];
        const category = rootElement.getElementsByClassName('category')[0];
        const chipGroup = rootElement.getElementsByClassName('chipGroup')[0];
        $('[name=triggerType]#trgt_game').is(':checked') ? gameProvider.style.display='flex' : gameProvider.style.display='none';
        $('[name=triggerType]#trgw_category').is(':checked') ? category.style.display='block' : category.style.display='none';
        $('[name=triggerType]#trgw_chipgroup').is(':checked') ? chipGroup.style.display='flex' : chipGroup.style.display='none';
    });

    $('[name=activeMethod]').click(() => {
        const spdays = rootElement.getElementsByClassName('specificDays')[0];
        $('[name=activeMethod]#am_specific').is(':checked') ? spdays.style.display='block' : spdays.style.display='none';
    });

    $('.modifyPromoForm').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            const spDay = [];
            $.each($(".modifyPromoForm [name=spDay]:checked"), function() {
                spDay.push($(this).val());
            });

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['promoid'] = '<?=$promoid;?>';
                params['spDay'] = spDay;
            });

            $.post('/promotion/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                if( obj.code == 1 ) {
                    swal.fire("Updated!", obj.message , "success").then(() => {  });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                // $('.modal').find('form').removeClass('was-validated');
                // $('.modal').find('form').trigger('reset');
                $('.modifyPromoForm').removeClass('was-validated');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });
});

function getPromotion()
{
    generalLoading();

    var params = {};
    params['promoid'] = '<?=$promoid;?>';

    $.post('/promotion/get', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            const v = document.getElementsByClassName('modifyPromoForm')[0];
            // let contentEN = str_replace('&', '&amp;', obj.data.content.EN);
            $('.modifyPromoForm [name=order]').val(obj.data.order);

            document.getElementsByName('titleEN')[0].value=obj.data.title.EN;
            document.getElementsByName('titleMY')[0].value=obj.data.title.MY;
            document.getElementsByName('titleCN')[0].value=obj.data.title.CN;
            document.getElementsByName('titleTH')[0].value=obj.data.title.TH;
            document.getElementsByName('titleVN')[0].value=obj.data.title.VN;
            document.getElementsByName('titleBGL')[0].value=obj.data.title.BGL;
            document.getElementsByName('titleBUR')[0].value=obj.data.title.BUR;
            document.getElementsByName('titleIN')[0].value=obj.data.title.IN;

            document.getElementsByName('imgEN')[0].value=obj.data.thumbnail.EN;
            document.getElementsByName('imgMY')[0].value=obj.data.thumbnail.MY;
            document.getElementsByName('imgCN')[0].value=obj.data.thumbnail.CN;
            document.getElementsByName('imgTH')[0].value=obj.data.thumbnail.TH;
            document.getElementsByName('imgVN')[0].value=obj.data.thumbnail.VN;
            document.getElementsByName('imgBGL')[0].value=obj.data.thumbnail.BGL;
            document.getElementsByName('imgBUR')[0].value=obj.data.thumbnail.BUR;
            document.getElementsByName('imgIN')[0].value=obj.data.thumbnail.IN;

            obj.data.content.EN==null ? editorEN.data.set('') : editorEN.data.set(obj.data.content.EN);
            obj.data.content.MY==null ? editorMY.data.set('') : editorMY.data.set(obj.data.content.MY);
            obj.data.content.CN==null ? editorCN.data.set('') : editorCN.data.set(obj.data.content.CN);
            obj.data.content.TH==null ? editorTH.data.set('') : editorTH.data.set(obj.data.content.TH);
            obj.data.content.VN==null ? editorVN.data.set('') : editorVN.data.set(obj.data.content.VN);
            obj.data.content.BGL==null ? editorBGL.data.set('') : editorBGL.data.set(obj.data.content.BGL);
            obj.data.content.BUR==null ? editorBUR.data.set('') : editorBUR.data.set(obj.data.content.BUR);
            obj.data.content.IN==null ? editorIN.data.set('') : editorIN.data.set(obj.data.content.IN);

            document.getElementsByName('bonusRate')[0].value=obj.data.percentage;
            document.getElementsByName('maxBonus')[0].value=obj.data.maxPromotion;
            document.getElementsByName('rollover')[0].value=obj.data.rollover;
            document.getElementsByName('minTurnover')[0].value=obj.data.minTurnover;
            document.getElementsByName('minDeposit')[0].value=obj.data.minDeposit;
            document.getElementsByName('maxDeposit')[0].value=obj.data.maxDeposit;
            document.getElementsByName('maxDeposit')[0].value=obj.data.maxDeposit;
            document.getElementsByName('start5')[0].value=obj.data.startDate;
            document.getElementsByName('end5')[0].value=obj.data.endDate;
            document.getElementsByName('totalreceipt')[0].value=obj.data.totalResit;
            document.getElementsByName('actualAmount')[0].value=obj.data.actualAmount;
            document.getElementsByName('numclaim')[0].value=obj.data.claimCount;
            document.getElementsByName('mins')[0].value=obj.data.intervalMin;
            document.getElementsByName('maxrandom')[0].value=obj.data.maxActualAmount;
            document.getElementsByName('contclaimday')[0].value=obj.data.afterClaimDay;
            document.getElementsByName('maxWithdrawal')[0].value=obj.data.maxWithdrawal;

            obj.data.afterIncrease==true ? $('.modifyPromoForm [name=afterpay]#afp_true').prop('checked',true) : $('.modifyPromoForm [name=afterpay]#afp_false').prop('checked',true);

            obj.data.randomAmount==true ? $('.modifyPromoForm [name=random]#randwyes').prop('checked',true) : $('.modifyPromoForm [name=random]#randwno').prop('checked',true);

            obj.data.totalResitBy==1 ? $('.modifyPromoForm [name=resittype]#resit_deposit').prop('checked',true) : $('.modifyPromoForm [name=resittype]#resit_withdraw').prop('checked',true);

            obj.data.afterClaim==true ? $('.modifyPromoForm [name=contclaim]#contclaim_yes').prop('checked',true) : $('.modifyPromoForm [name=contclaim]#contclaim_no').prop('checked',true);

            if( obj.data.triggerWallet==1 )
            {
                $('.modifyPromoForm [name=triggerWallet]#trgw_on').prop('checked',true);

                obj.data.triggerType==1 ? $('.modifyPromoForm [name=triggerType]#trgt_game').prop('checked',true) : obj.data.triggerType==2 ? $('.modifyPromoForm [name=triggerType]#trgw_category').prop('checked',true) : '';

                $('.modifyPromoForm [name=gcate]#' + obj.data.category).prop('checked',true);

                $('.modifyPromoForm [name=gameprovider] option[value=' + obj.data.gameProviderCode + ']').attr('selected','selected');

                $('.modifyPromoForm [name=chipgroup]').val(obj.data.toGroupName);

                let checkSpecialPromo = document.querySelector('.modifyPromoForm [name=triggerWallet]#trgw_on:checked');
                checkSpecialPromo ? v.getElementsByClassName('targetPromotion')[0].style.display='block' : '';

                let checkTargetGame = document.querySelector('.modifyPromoForm [name=triggerType]#trgt_game:checked');
                checkTargetGame ? v.getElementsByClassName('gameProvider')[0].style.display='flex' : '';

                let checkTargetCategory = document.querySelector('.modifyPromoForm [name=triggerType]#trgw_category:checked');
                checkTargetCategory ? v.getElementsByClassName('category')[0].style.display='block' : '';

                let checkTargetChipGroup = document.querySelector('.modifyPromoForm [name=triggerType]#trgw_chipgroup:checked');
                checkTargetChipGroup ? v.getElementsByClassName('chipGroup')[0].style.display='flex' : '';
            } else if( obj.data.triggerWallet==2 )
            {
                $('.modifyPromoForm [name=triggerWallet]#trgw_off').prop('checked',true);
            }

            if( obj.data.onlyOnce==2 && obj.data.dayOnce==2 && obj.data.weekOnce==2 && obj.data.monthOnce==2 && obj.data.days=='' )
            {
                $('.modifyPromoForm [name=activeMethod]#am_unlimited').prop('checked',true);
            }

            obj.data.onlyOnce==1 ? $('.modifyPromoForm [name=activeMethod]#am_once').prop('checked',true) : '';
            obj.data.weekOnce==1 ? $('.modifyPromoForm [name=activeMethod]#am_week').prop('checked',true) : '';
            obj.data.monthOnce==1 ? $('.modifyPromoForm [name=activeMethod]#am_month').prop('checked',true) : '';
            obj.data.dayOnce==1 ? $('.modifyPromoForm [name=activeMethod]#am_day').prop('checked',true) : '';
            obj.data.days!='' ? $('.modifyPromoForm [name=activeMethod]#am_specific').prop('checked',true) : '';

            let checkSpecificDays = document.querySelector('.modifyPromoForm [name=activeMethod]#am_specific:checked');
            if( checkSpecificDays )
            {
                const spday = obj.data.days;
                v.getElementsByClassName('specificDays')[0].style.display='block';

                spday.forEach(function(item) {
                    switch( item ) {
                        case 1: 
                            $('.modifyPromoForm [name=spDay]#spDay_mon').prop('checked', true);
                        break;
                        case 2: 
                            $('.modifyPromoForm [name=spDay]#spDay_tue').prop('checked', true);
                        break;
                        case 3: 
                            $('.modifyPromoForm [name=spDay]#spDay_wed').prop('checked', true);
                        break;
                        case 4: 
                            $('.modifyPromoForm [name=spDay]#spDay_thu').prop('checked', true);
                        break;
                        case 5: 
                            $('.modifyPromoForm [name=spDay]#spDay_fri').prop('checked', true);
                        break;
                        case 6: 
                            $('.modifyPromoForm [name=spDay]#spDay_sat').prop('checked', true);
                        break;
                        case 0: 
                            $('.modifyPromoForm [name=spDay]#spDay_sun').prop('checked', true);
                        break;

                        default:
                    }
                });
            }
        } else if( obj.code==39 ) {
            forceUserLogout();
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

let editorEN, editorMY, editorCN, editorTH, editorVN, editorBGL, editorBUR, editorIN;
ClassicEditor.create(document.querySelector('#promoEN'), {
    // plugins: [ Table, TableToolbar, Bold],
    toolbar: {
        items: [
            'sourceEditing',
            'imageInsert',
            'insertTable',
            'heading',
            '|',
            'bold',
            'italic',
            'link',
            'bulletedList',
            'numberedList',
            '|',
            'outdent',
            'indent',
            '|',
            'blockQuote',
            'undo',
            'redo',
            'alignment',
            'fontBackgroundColor',
            'fontColor',
            'fontFamily',
            'highlight',
            'fontSize',
            'horizontalLine',
            'underline'
        ]
    },
    language: 'en',
    image: {
        toolbar: [
            'imageTextAlternative',
            'imageStyle:inline',
            'imageStyle:block',
            'imageStyle:side',
            'linkImage'
        ]
    },
    table: {
        contentToolbar: [
            'tableColumn',
            'tableRow',
            'mergeTableCells',
            'tableCellProperties',
            'tableProperties'
        ]
    },
    licenseKey: '',
})
.then( editor => {
    // window.editor = editor;
    editorEN = editor;
})
.catch( error => {
    console.error( error );
});

ClassicEditor.create(document.querySelector('#promoMY'), {
    // plugins: [ Table, TableToolbar, Bold],
    toolbar: {
        items: [
            'sourceEditing',
            'imageInsert',
            'insertTable',
            'heading',
            '|',
            'bold',
            'italic',
            'link',
            'bulletedList',
            'numberedList',
            '|',
            'outdent',
            'indent',
            '|',
            'blockQuote',
            'undo',
            'redo',
            'alignment',
            'fontBackgroundColor',
            'fontColor',
            'fontFamily',
            'highlight',
            'fontSize',
            'horizontalLine',
            'underline'
        ]
    },
    language: 'en',
    image: {
        toolbar: [
            'imageTextAlternative',
            'imageStyle:inline',
            'imageStyle:block',
            'imageStyle:side',
            'linkImage'
        ]
    },
    table: {
        contentToolbar: [
            'tableColumn',
            'tableRow',
            'mergeTableCells',
            'tableCellProperties',
            'tableProperties'
        ]
    },
    licenseKey: '',
})
.then( editor => {
    editorMY = editor;
})
.catch( error => {
    console.error( error );
});

ClassicEditor.create(document.querySelector('#promoCN'), {
    // plugins: [ Table, TableToolbar, Bold],
    toolbar: {
        items: [
            'sourceEditing',
            'imageInsert',
            'insertTable',
            'heading',
            '|',
            'bold',
            'italic',
            'link',
            'bulletedList',
            'numberedList',
            '|',
            'outdent',
            'indent',
            '|',
            'blockQuote',
            'undo',
            'redo',
            'alignment',
            'fontBackgroundColor',
            'fontColor',
            'fontFamily',
            'highlight',
            'fontSize',
            'horizontalLine',
            'underline'
        ]
    },
    language: 'cn',
    image: {
        toolbar: [
            'imageTextAlternative',
            'imageStyle:inline',
            'imageStyle:block',
            'imageStyle:side',
            'linkImage'
        ]
    },
    table: {
        contentToolbar: [
            'tableColumn',
            'tableRow',
            'mergeTableCells',
            'tableCellProperties',
            'tableProperties'
        ]
    },
    licenseKey: '',
})
.then( editor => {
    editorCN = editor;
})
.catch( error => {
    console.error( error );
});

ClassicEditor.create(document.querySelector('#promoTH'), {
    // plugins: [ Table, TableToolbar, Bold],
    toolbar: {
        items: [
            'sourceEditing',
            'imageInsert',
            'insertTable',
            'heading',
            '|',
            'bold',
            'italic',
            'link',
            'bulletedList',
            'numberedList',
            '|',
            'outdent',
            'indent',
            '|',
            'blockQuote',
            'undo',
            'redo',
            'alignment',
            'fontBackgroundColor',
            'fontColor',
            'fontFamily',
            'highlight',
            'fontSize',
            'horizontalLine',
            'underline'
        ]
    },
    language: 'th',
    image: {
        toolbar: [
            'imageTextAlternative',
            'imageStyle:inline',
            'imageStyle:block',
            'imageStyle:side',
            'linkImage'
        ]
    },
    table: {
        contentToolbar: [
            'tableColumn',
            'tableRow',
            'mergeTableCells',
            'tableCellProperties',
            'tableProperties'
        ]
    },
    licenseKey: '',
})
.then( editor => {
    editorTH = editor;
})
.catch( error => {
    console.error( error );
});

ClassicEditor.create(document.querySelector('#promoVN'), {
    // plugins: [ Table, TableToolbar, Bold],
    toolbar: {
        items: [
            'sourceEditing',
            'imageInsert',
            'insertTable',
            'heading',
            '|',
            'bold',
            'italic',
            'link',
            'bulletedList',
            'numberedList',
            '|',
            'outdent',
            'indent',
            '|',
            'blockQuote',
            'undo',
            'redo',
            'alignment',
            'fontBackgroundColor',
            'fontColor',
            'fontFamily',
            'highlight',
            'fontSize',
            'horizontalLine',
            'underline'
        ]
    },
    language: 'vn',
    image: {
        toolbar: [
            'imageTextAlternative',
            'imageStyle:inline',
            'imageStyle:block',
            'imageStyle:side',
            'linkImage'
        ]
    },
    table: {
        contentToolbar: [
            'tableColumn',
            'tableRow',
            'mergeTableCells',
            'tableCellProperties',
            'tableProperties'
        ]
    },
    licenseKey: '',
})
.then( editor => {
    editorVN = editor;
})
.catch( error => {
    console.error( error );
});

ClassicEditor.create(document.querySelector('#promoBGL'), {
    // plugins: [ Table, TableToolbar, Bold],
    toolbar: {
        items: [
            'sourceEditing',
            'imageInsert',
            'insertTable',
            'heading',
            '|',
            'bold',
            'italic',
            'link',
            'bulletedList',
            'numberedList',
            '|',
            'outdent',
            'indent',
            '|',
            'blockQuote',
            'undo',
            'redo',
            'alignment',
            'fontBackgroundColor',
            'fontColor',
            'fontFamily',
            'highlight',
            'fontSize',
            'horizontalLine',
            'underline'
        ]
    },
    language: 'en',
    image: {
        toolbar: [
            'imageTextAlternative',
            'imageStyle:inline',
            'imageStyle:block',
            'imageStyle:side',
            'linkImage'
        ]
    },
    table: {
        contentToolbar: [
            'tableColumn',
            'tableRow',
            'mergeTableCells',
            'tableCellProperties',
            'tableProperties'
        ]
    },
    licenseKey: '',
})
.then( editor => {
    editorBGL = editor;
})
.catch( error => {
    console.error( error );
});

ClassicEditor.create(document.querySelector('#promoBUR'), {
    // plugins: [ Table, TableToolbar, Bold],
    toolbar: {
        items: [
            'sourceEditing',
            'imageInsert',
            'insertTable',
            'heading',
            '|',
            'bold',
            'italic',
            'link',
            'bulletedList',
            'numberedList',
            '|',
            'outdent',
            'indent',
            '|',
            'blockQuote',
            'undo',
            'redo',
            'alignment',
            'fontBackgroundColor',
            'fontColor',
            'fontFamily',
            'highlight',
            'fontSize',
            'horizontalLine',
            'underline'
        ]
    },
    language: 'en',
    image: {
        toolbar: [
            'imageTextAlternative',
            'imageStyle:inline',
            'imageStyle:block',
            'imageStyle:side',
            'linkImage'
        ]
    },
    table: {
        contentToolbar: [
            'tableColumn',
            'tableRow',
            'mergeTableCells',
            'tableCellProperties',
            'tableProperties'
        ]
    },
    licenseKey: '',
})
.then( editor => {
    editorBUR = editor;
})
.catch( error => {
    console.error( error );
});

ClassicEditor.create(document.querySelector('#promoIN'), {
    // plugins: [ Table, TableToolbar, Bold],
    toolbar: {
        items: [
            'sourceEditing',
            'imageInsert',
            'insertTable',
            'heading',
            '|',
            'bold',
            'italic',
            'link',
            'bulletedList',
            'numberedList',
            '|',
            'outdent',
            'indent',
            '|',
            'blockQuote',
            'undo',
            'redo',
            'alignment',
            'fontBackgroundColor',
            'fontColor',
            'fontFamily',
            'highlight',
            'fontSize',
            'horizontalLine',
            'underline'
        ]
    },
    language: 'en',
    image: {
        toolbar: [
            'imageTextAlternative',
            'imageStyle:inline',
            'imageStyle:block',
            'imageStyle:side',
            'linkImage'
        ]
    },
    table: {
        contentToolbar: [
            'tableColumn',
            'tableRow',
            'mergeTableCells',
            'tableCellProperties',
            'tableProperties'
        ]
    },
    licenseKey: '',
})
.then( editor => {
    editorIN = editor;
})
.catch( error => {
    console.error( error );
});
</script>