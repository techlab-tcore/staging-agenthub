<section class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast hide align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</section>

<section class="modal fade modal-selfmodify" id="modal-selfmodify" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-selfmodify" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.editprofile');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate']);?>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label"><?=lang('Input.username');?></label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <input type="text" class="form-control-plaintext" name="username" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label"><?=lang('Input.contact');?></label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <div class="input-group">
                            <select class="form-select" name="regioncode">
                            <option value="MYR">(+60)</option>
                            <option value="SGD">(+65)</option>
                            </select>
                            <input type="text" class="form-control" pattern="^[0-9]{8,11}$" name="contact" placeholder="e.g. <?=$_ENV['sampleMobile'];?>">
                            <small class="form-text"><?=lang('Validation.mobile',[8,11]);?></small>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label"><?=lang('Input.telegram');?></label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <input type="text" class="form-control" name="telegram">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label"><?=lang('Input.remark');?></label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <textarea class="form-control" name="remark"></textarea>
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

<section class="modal fade modal-changePass" id="modal-changePass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-changePass" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.chgpass');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('',['class'=>'form-validation changePassForm', 'novalidate'=>'novalidate']);?>
                <div class="mb-3 row">
                    <label class="col-lg-5 col-lg-5 col-12 col-form-label"><?=lang('Input.currentpass');?></label>
                    <div class="col-lg-7 col-md-7 col-12">
                        <div class="input-group">
                            <input type="password" class="form-control" pattern=".{6,}" name="currentloginpass" id="currentloginpass" required>
                            <button type="button" class="btn btn-primary" data-bs-toggle="button" autocomplete="off" onclick="showhidepass('currentloginpass')"><?=lang('Nav.show');?></button>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-lg-5 col-lg-5 col-12 col-form-label"><?=lang('Input.newpass');?></label>
                    <div class="col-lg-7 col-md-7 col-12">
                        <div class="input-group">
                            <input type="password" class="form-control" pattern=".{6,}" name="newloginpass" id="newloginpass" required>
                            <button type="button" class="btn btn-primary" data-bs-toggle="button" autocomplete="off" onclick="showhidepass('newloginpass')"><?=lang('Nav.show');?></button>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-lg-5 col-lg-5 col-12 col-form-label"><?=lang('Input.cnewpass');?></label>
                    <div class="col-lg-7 col-md-7 col-12">
                        <div class="input-group">
                            <input type="password" class="form-control" pattern=".{6,}" name="newcloginpass" id="newcloginpass" required>
                            <button type="button" class="btn btn-primary" data-bs-toggle="button" autocomplete="off" onclick="showhidepass('newcloginpass')"><?=lang('Nav.show');?></button>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <button type="reset" class="btn btn-light bg-gradient"><?=lang('Nav.reset');?></button>
                    <button type="submit" class="btn btn-primary"><?=lang('Nav.submit');?></button>
                </div>
                <?=form_close();?>
            </div>
        </div>
    </div>
</section>

<section class="modal fade modal-modify" id="modal-modify" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-modify" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.edit');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation modifyPersonalForm', 'novalidate'=>'novalidate']);?>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label"><?=lang('Input.username');?></label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <input type="text" class="form-control-plaintext" name="username" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label"><?=lang('Input.newpass');?></label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <div class="input-group">
                            <input type="password" class="form-control" pattern=".{6,}" name="newpass" id="newpass">
                            <button type="button" class="btn btn-primary" data-bs-toggle="button" autocomplete="off" onclick="showhidepass('newpass')"><?=lang('Nav.show');?></button>
                        </div>
                        <small class="form-text"><?=lang('Validation.password',[6]);?></small>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label"><?=lang('Input.fname');?></label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <input type="text" class="form-control" name="fname" required>
                        <small class="form-text"><?=lang('Validation.fullname');?></small>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label"><?=lang('Input.contact');?></label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <div class="input-group">
                            <select class="form-select" name="regioncode">
                            <option value="MYR">(+60)</option>
                            <option value="SGD">(+65)</option>
                            </select>
                            <input type="text" class="form-control" pattern="^[0-9]{8,11}$" name="contact" placeholder="e.g. <?=$_ENV['sampleMobile'];?>">
                            <small class="form-text"><?=lang('Validation.mobile',[8,11]);?></small>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label"><?=lang('Input.telegram');?></label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <input type="text" class="form-control" name="telegram">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label"><?=lang('Input.remark');?></label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <textarea class="form-control" name="remark"></textarea>
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

<section class="modal fade modal-creditTransfer" id="modal-creditTransfer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-creditTransfer" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5"><?=lang('Nav.credittransfer');?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('',['class'=>'form-validation creditTransferForm','novalidate'=>'novalidate'],['uid'=>'']);?>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Input.username');?></label>
                    <div class="col-8">
                        <input type="text" class="form-control-plaintext" name="username" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Input.types');?></label>
                    <div class="col-8 d-flex align-items-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type" id="type_cash" value="1" checked required>
                            <label class="form-check-label" for="type_cash"><?=lang('Label.cash');?></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type" id="type_chip" value="3">
                            <label class="form-check-label" for="type_chip"><?=lang('Label.chip');?></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type" id="type_agcash" value="2">
                            <label class="form-check-label" for="type_agcash"><?=lang('Label.agwallet');?></label>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Input.amount');?></label>
                    <div class="col-8">
                        <small class="fw-bold"><?=lang('Label.currentscore');?> <span class="badge bg-vw rounded-pill personbalance">0</span></small>
                        <small class="fw-bold d-block mb-1"><?=lang('Label.setscore');?> <span class="badge bg-light fw-normal text-dark"><?=lang('Label.maxvalue');?>: <span class="userbalance">0</span></span></small>
                        <input type="number" step="any" class="form-control" name="amount" required>
                    </div>
                </div>
                <div class="mb-3 row chipAllow">
                    <label class="col-4 col-form-label"><?=lang('Input.rollovermultiple');?></label>
                    <div class="col-8">
                        <input type="number" step="any" min="0" class="form-control" onkeyup="multipleTurnover()" onmouseup="multipleTurnover()" name="turnoverMultiple" value="0">
                    </div>
                </div>
                <div class="mb-3 row chipAllow">
                    <label class="col-4 col-form-label"><?=lang('Input.turnover');?></label>
                    <div class="col-8">
                        <input type="number" step="any" min="0" class="form-control" name="turnover" value="0" readonly>
                    </div>
                </div>
                <div class="mb-3 row trigger-group chipAllow">
                    <label class="col-4 col-form-label"><?=lang('Input.triggertype');?></label>
                    <div class="col-8 d-flex align-items-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="triggertype" id="trigger_gp" value="1">
                            <label class="form-check-label" for="trigger_gp"><?=lang('Input.gameprovider');?></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="triggertype" id="trigger_category" value="2">
                            <label class="form-check-label" for="trigger_category"><?=lang('Input.gamecategory');?></label>
                        </div>
                        <!--
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="triggertype" id="trigger_winover" value="3">
                            <label class="form-check-label" for="trigger_winover"><?//=lang('Label.winover');?></label>
                        </div>
                        -->
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="triggertype" id="trigger_chipgroup" value="4">
                            <label class="form-check-label" for="trigger_chipgroup"><?=lang('Input.chipgroup');?></label>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row gameProvider-group chipAllow">
                    <label class="col-4 col-form-label"><?=lang('Input.gameprovider');?></label>
                    <div class="col-8">
                        <select class="form-select" id="gameprovider" name="gameprovidercode"></select>
                    </div>
                </div>
                <div class="mb-3 row gameCategory-group chipAllow">
                    <label class="col-4 col-form-label"><?=lang('Input.gamecategory');?></label>
                    <div class="col-8">
                        <div id="cateList"></div>
                    </div>
                </div>
                <div class="mb-3 row gameChip-group chipAllow">
                    <label class="col-4 col-form-label"><?=lang('Input.chipgroup');?></label>
                    <div class="col-8">
                        <input type="text" class="form-control" name="chipgroup">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Input.remark');?></label>
                    <div class="col-8">
                        <textarea class="form-control" name="remark"></textarea>
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

<section class="modal fade modal-replenishment" id="modal-replenishment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-replenishment" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Label.pgreplenishment');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation replenishmentForm', 'novalidate'=>'novalidate'], ['uid'=>'','merchant'=>'']);?>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Label.compaccno');?></label>
                    <div class="col-8">
                        <select class="form-select" name="compPayGateway" id="compPayGateway" required></select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Label.compaccno');?></label>
                    <div class="col-8">
                        <select class="form-select" name="compPayChannel" id="compPayChannel" required></select>
                    </div>
                </div>
                <hr>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Input.username');?></label>
                    <div class="col-8">
                        <input type="text" class="form-control-plaintext" name="username" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Input.amount');?></label>
                    <div class="col-8">
                        <small class="fw-bold"><?=lang('Label.currentscore');?> <span class="badge bg-warning rounded-pill personbalance">0</span></small>
                        <small class="fw-bold d-block mb-1"><?=lang('Label.setscore');?> <span class="badge bg-light rounded-pill text-dark"><?=lang('Label.maxvalue');?>: <span class="userbalance">0</span></span></small>
                        <input type="number" step="any" class="form-control" name="amount" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Input.remark');?></label>
                    <div class="col-8">
                        <textarea class="form-control" name="remark"></textarea>
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

<section class="modal fade modal-fortuneToken" id="modal-fortuneToken" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-fortuneToken" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Label.spintoken');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation fortuneTokenForm', 'novalidate'=>'novalidate'], ['uid'=>'']);?>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Input.username');?></label>
                    <div class="col-8">
                        <input type="text" class="form-control-plaintext" name="username" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Input.amount');?></label>
                    <div class="col-8">
                        <small class="fw-bold"><?=lang('Label.currentscore');?> <span class="badge bg-warning rounded-pill personbalance">0</span></small>
                        <small class="fw-bold d-block mb-1"><?=lang('Label.setscore');?> <span class="badge bg-light rounded-pill text-dark"><?=lang('Label.maxvalue');?>: <span class="userbalance">0</span></span></small>
                        <input type="number" step="any" class="form-control" name="amount" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Input.remark');?></label>
                    <div class="col-8">
                        <textarea class="form-control" name="remark"></textarea>
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

<section class="modal fade modal-setPromotion" id="modal-setPromotion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-setPromotion" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Label.setpromotion');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate','autocomplete'=>'off'], ['uid'=>'']);?>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Input.username');?></label>
                    <div class="col-8">
                        <input type="text" class="form-control-plaintext" name="username" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Input.amount');?></label>
                    <div class="col-8">
                        <small class="fw-bold"><?=lang('Label.currentscore');?> <span class="badge bg-vw fw-normal personbalance">0.00</span></small>
                        <small class="fw-bold d-block mb-1"><?=lang('Label.setscore');?> <span class="badge bg-light fw-normal text-dark"><?=lang('Label.maxvalue');?>: <span class="userbalance">0.00</span></span></small>
                        <input type="number" step="any" class="form-control" name="amount" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Label.promotion');?></label>
                    <div class="col-8">
                        <select class="form-select" name="promoId" id="promotion-list" required></select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Input.remark');?></label>
                    <div class="col-8">
                        <textarea class="form-control" name="remark"></textarea>
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

<section class="modal fade modal-rewardSettings" id="modal-rewardSettings" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-rewardSettings" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.settings');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation rewardSettingForm', 'novalidate'=>'novalidate'], ['uid'=>'']);?>
                <div class="mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="agbankcard" name="agbankcard" value="1">
                        <label class="form-check-label" for="agbankcard"><?=lang('Input.agbankcard');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="agpgateway" name="agpgateway" value="1">
                        <label class="form-check-label" for="agpgateway"><?=lang('Input.agpgateway');?></label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="nobanktransferdeposit" name="nobanktransferdeposit" value="1">
                        <label class="form-check-label" for="nobanktransferdeposit"><?=lang('Input.nobanktransferdeposit');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="nopaygatetwaydeposit" name="nopaygatetwaydeposit" value="1">
                        <label class="form-check-label" for="nopaygatetwaydeposit"><?=lang('Input.nopaygatetwaydeposit');?></label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="nowithdrawal" name="nowithdrawal" value="1">
                        <label class="form-check-label" for="nowithdrawal"><?=lang('Input.nowithdrawal');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="nopgwithdrawal" name="nopgwithdrawal" value="1">
                        <label class="form-check-label" for="nopgwithdrawal"><?=lang('Input.nopgwithdrawal');?></label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="nojackpot" name="nojackpot" value="1">
                        <label class="form-check-label" for="nojackpot"><?=lang('Input.nojackpot');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="nofortunewheel" name="nofortunewheel" value="1">
                        <label class="form-check-label" for="nofortunewheel"><?=lang('Input.nofortunewheel');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="noagcomm" name="noagcomm" value="1">
                        <label class="form-check-label" for="noagcomm"><?=lang('Input.noagcomm');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="noaffilliate" name="noaffilliate" value="1">
                        <label class="form-check-label" for="noaffilliate"><?=lang('Input.noaffilliate');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="nolossrebate" name="nolossrebate" value="1">
                        <label class="form-check-label" for="nolossrebate"><?=lang('Input.nolossrebate');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="noafflossrebate" name="noafflossrebate" value="1">
                        <label class="form-check-label" for="noafflossrebate"><?=lang('Input.noafflossrebate');?></label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="nodepositreward" name="nodepositreward" value="1">
                        <label class="form-check-label" for="nodepositreward"><?=lang('Input.nodepositreward');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="noaffdeposit" name="noaffdeposit" value="1">
                        <label class="form-check-label" for="noaffdeposit"><?=lang('Input.noaffdeposit');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="nodailyfree" name="nodailyfree" value="1">
                        <label class="form-check-label" for="nodailyfree"><?=lang('Input.nodailyfree');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="nosharereward" name="nosharereward" value="1">
                        <label class="form-check-label" for="nosharereward"><?=lang('Input.nosharereward');?></label>
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

<section class="modal fade modal-affiliateQR" id="modal-affiliateQR" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-affiliateQR" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-xl-down">
        <article class="modal-content border-0 bg-major">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Label.affqr');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-0 pb-3 text-center">
                <div class="qrcard">
                    <figure class="px-3 pt-2 pb-3 w-50 mx-auto my-0">
                        <img class="w-100" src="<?=base_url('assets/img/logo/logo.png');?>" title="<?=$_ENV['company'];?>" alt="<?=$_ENV['company'];?>">
                    </figure>
                    <div class="text-center w-50 mx-auto p-2 bg-white rounded-3">
                        <figure id="qrcode" class="w-100 p-0 m-0"></figure>
                    </div>

                    <!-- <span class="fs-5 color-major"><?//=$_SESSION['username'];?></span> -->
                    <input type="text" class="form-control border-0 my-0 w-75 mx-auto bg-transparent text-warning text-center" placeholder="<?=lang('Validation.nickname');?>">

                    <div class="bg-vw p-2 my-3">
                        <span class="d-block">SCAN UNTUK DAFTAR</span>
                        <span class="d-block">SCAN TO REGISTER</span>
                        <span class="d-block">只需扫二维码即马上可注册</span>
                    </div>
                </div>
                <div class="">
                    <a href="javascript:void(0);" class="btn btn-primary btn-qrreg"><?=lang('Nav.share');?></a>
                    <!-- <a href="javascript:void(0);" class="btn btn-primary btn-lg getscreen" onclick="getScreen();"><?//=lang('Nav.save');?></a> -->
                </div>
            </div>
        </article>
    </div>
</section>

<section class="modal fade modal-gameId" id="modal-gameId" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-gameId" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Label.games');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="gameidTable" class="w-100 table nowrap table-bordered">
                <thead>
                    <tr>
                    <th><?=lang('Label.games');?></th>
                    <th><?=lang('Input.username');?></th>
                    </tr>
                </thead>
                <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<section class="modal fade modal-gameBalance" id="modal-gameBalance" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-gameBalance" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Label.gamescore');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate'], ['uid'=>'']);?>
                <article class="mb-3" id="gamelist">
                </article>
                <?=form_close();?>
            </div>
        </div>
    </div>
</section>

<section class="modal fade modal-coinBag" id="modal-coinBag" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-coinBag" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.coinbag');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <article class="">
                    <table class="w-100 nowrap table table-sm table-bordered">
                    <tbody>
                        <tr>
                        <th class="bg-light"><?=lang('Label.fortunetoken');?></th>
                        <td id="fortuneToken"></td>
                        </tr>
                        <tr>
                        <th class="bg-light"><?=lang('Label.promoturnover');?></th>
                        <td id="promoTurnover"></td>
                        </tr>
                    </tbody>
                    </table>
                    <hr>
                    <table class="w-100 nowrap table table-sm table-bordered table-hover">
                    <thead class="bg-light" id="categoryCoinHeader"></thead>
                    <tbody id="categoryCoin"></tbody>
                    </table>
                    <hr>
                    <!--
                    <table class="w-100 nowrap table table-sm table-bordered table-hover">
                    <thead class="bg-light" id="promoCoinHeader"></thead>
                    <tbody id="promoCoin"></tbody>
                    </table>
                    -->
                    <table class="w-100 nowrap table table-sm table-bordered table-hover">
                    <thead class="bg-light" id="chipGroupCoinHeader"></thead>
                    <tbody id="chipGroupCoin"></tbody>
                    </table>
                    <hr>
                    <table class="w-100 nowrap table table-sm table-bordered table-hover">
                    <thead class="bg-light" id="providerCoinHeader"></thead>
                    <tbody id="providerCoin"></tbody>
                    </table>
                </article>
            </div>
        </div>
    </div>
</section>

<section class="modal fade modal-message" id="modal-message" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-message" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Nav.sendmail');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate']);?>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label"><?=lang('Input.title');?></label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <input type="text" class="form-control" name="title" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label"><?=lang('Input.msg');?></label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <textarea class="form-control" name="msg"></textarea>
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

<!--- Free Credit --->
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
                <hr>
                <label class="w-100 d-block text-secondary"><?=lang('Label.manualtransfer');?></label>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Input.amount');?></label>
                    <div class="col-8">
                        <input type="text" class="form-control" name="transferAmount" value="0">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label"><?=lang('Input.remark');?></label>
                    <div class="col-8">
                        <textarea class="form-control" name="remark"></textarea>
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
<!--- End Free Credit --->

<!--- Agent Permission --->
<section class="modal fade modal-agentPermission" id="modal-agentPermission" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-agentPermission" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang('Label.agentpermission');?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate'], ['uid'=>'']);?>
                <!--Permit-->
                <div class="mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="transfercomm" name="transfercomm" value="1">
                        <label class="form-check-label" for="transfercomm"><?=lang('Nav.notransfercomm');?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="createmember" name="createmember" value="1">
                        <label class="form-check-label" for="createmember"><?=lang('Nav.nocreatemember');?></label>
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
<!--- End Agent Permission --->

<script src="<?=base_url('assets/vendors/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
<script src="<?=base_url('assets/vendors/sweetalert2/sweetalert2.min.js');?>"></script>
<script src="<?=base_url('assets/vendors/airdatepicker/js/datepicker.min.js');?>"></script>
<script src="<?=base_url('assets/vendors/airdatepicker/js/i18n/datepicker.en.js');?>"></script>
<script src="<?=base_url('assets/vendors/airdatepicker/js/i18n/datepicker.zh.js');?>"></script>
<script src="<?=base_url('assets/js/master.js?v='.rand());?>"></script>
<script src="<?=base_url('assets/vendors/html2canvas/html2canvas.js');?>"></script>
<script src="<?=base_url('assets/vendors/qrcode/qrcode.min.js');?>"></script>
</body>
</html>

<script>
const logged = '<?=$session;?>';
document.addEventListener('DOMContentLoaded', (event) => {
    if( logged )
    {
        refreshProfile();

        const affiliateQREvent = document.getElementById('modal-affiliateQR');
        affiliateQREvent.addEventListener('hidden.bs.modal', function (event) {
            document.getElementById("qrcode").innerHTML = '';
        });
    }

    $('.modal-selfmodify form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            $('.modal-selfmodify [type=submit]').prop('disabled',true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['usertype'] = '<?=$_SESSION['session'];?>';
                // params['uid'] = btoa('<?//=$_SESSION['token'];?>');
            });

            $.post('/user/personal-change/user/hub', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                // console.log(obj);
                if( obj.code == 1 ) {
                    alertToast('bg-success', obj.message);
                } else {
                    alertToast('bg-danger', obj.message);
                }
            })
            .done(function() {
                swal.close();
                $('.modal-selfmodify [type=submit]').prop('disabled',false);
                $('.modal-selfmodify').modal('toggle');
            })
            .fail(function() {
                alertToast('bg-danger', obj.message);
            });
        }
    });

    const selfmodifyEvent = document.getElementById('modal-selfmodify');
    selfmodifyEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });
    selfmodifyEvent.addEventListener('shown.bs.modal', function (event) {
        selfProfile();
    });

    $('.modal-changePass form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            $('.changePassForm [type=submit]').prop('disabled',true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['agentname'] = '<?=$_SESSION['session'];?>';
            });

            $.post('/self/password-change/company/hub', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                // console.log(obj);
                if( obj.code == 1 ) {
                    alertToast('bg-success', obj.message);
                } else {
                    alertToast('bg-danger', obj.message);
                }
            })
            .done(function() {
                swal.close();
                $('.changePassForm [type=submit]').prop('disabled',false);
                $('.modal-changePass').modal('toggle');
            })
            .fail(function() {
                alertToast('bg-danger', obj.message);
            });

            $('.changePassForm').removeClass('was-validated');
            $('.changePassForm').trigger('reset');
        }
    });

    const changepassEvent = document.getElementById('modal-changePass');
    changepassEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });

    const modifyEvent = document.getElementById('modal-modify');
    modifyEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });

    const messageEvent = document.getElementById('modal-message');
    messageEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });

    $('.modal-creditTransfer form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            $('.creditTransferForm [type=submit]').prop('disabled',true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['groupwallet'] = '<?=$_SESSION['session'];?>';
            });

            $.post('/user/credit-transfer/usertransfer', {
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
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => { 
                        $('.creditTransferForm [type=submit]').prop('disabled',false);
                    });
                }
            })
            .done(function() {
                $('.modal-creditTransfer').modal('hide');
                $('.creditTransferForm [type=submit]').prop('disabled',false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    const creditTransferEvent = document.getElementById('modal-creditTransfer');
    creditTransferEvent.addEventListener('shown.bs.modal', function (event) {
        selectGameProviderList('gameprovider');
        radioGameCategoryList('cateList');
        $('.trigger-group input').prop('disabled', true);
        $('.gameProvider-group select').prop('disabled', true);
        $('.gameCategory-group input').prop('disabled', true);
        $('.gameChip-group input').prop('disabled', true);

        var radios = document.querySelectorAll('input[type=radio][name=triggertype]');
        radios.forEach(radio => radio.addEventListener('change', () => {
            // console.log(radio.value);
            radio.value==1 ? $('.gameProvider-group select').prop('disabled', false) : $('.gameProvider-group select').prop('disabled', true);
            radio.value==2 ? $('.gameCategory-group input').prop('disabled', false) : $('.gameCategory-group input').prop('disabled', true);
            radio.value==4 ? $('.gameChip-group input').prop('disabled', false) : $('.gameChip-group input').prop('disabled', true);
        }));

        var typeradios = document.querySelectorAll('input[type=radio][name=type]');
        typeradios.forEach(radio => radio.addEventListener('change', () => {
            // console.log(radio.value);
            if (radio.value==1) {
                $('.trigger-group input').prop('disabled', true);
                $('.trigger-group input').prop('checked', false);
                $('.gameProvider-group select').prop('disabled', true);
                $('.gameCategory-group input').prop('disabled', true);
                $('.gameChip-group input').prop('disabled', true);
                $('.modal-creditTransfer [name=chipgroup]').val('');
            } else {
                $('.trigger-group input').prop('disabled', false);
            }
        }));
    });
    creditTransferEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
        $('.modal-creditTransfer .personbalance').html('0');

        $('#gameprovider').html(' ');
        $('#cateList').html(' ');
    });

    $('.modal-replenishment form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            $('.replenishmentForm [type=submit]').prop('disabled',true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/user/replenishment', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                // console.log(obj);
                if( obj.code == 1 ) {
                    swal.fire("", obj.message, "success").then(() => {
                        refreshProfile();
                        $('#userTable').DataTable().ajax.reload(null,false);
                    });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("", obj.message + " (Code: "+obj.code+")", "error").then(() => { 
                        $('.replenishmentForm [type=submit]').prop('disabled',false);
                    });
                }
            })
            .done(function() {
                $('.modal-replenishment').modal('hide');
                $('.replenishmentForm [type=submit]').prop('disabled',false);
            })
            .fail(function() {
                swal.fire("", "Please try again later.", "error");
            });
        }
    });

    const replenishmentEvent = document.getElementById('modal-replenishment');
    replenishmentEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
        $('.modal-replenishment .personbalance').html('0');

        $('.modal-replenishment [name=compPayGateway]').html('');
        $('.modal-replenishment [name=compPayChannel]').html('');
    });
    replenishmentEvent.addEventListener('shown.bs.modal', function (event) {
        getCompPaymentGatewayList('compPayGateway');
        document.getElementById("compPayGateway").onchange = function(item) {
            // console.log(this.value);
            var merchant = item.target.options[item.target.selectedIndex].dataset.merchant;
            $('.modal-replenishment [name=merchant]').val(merchant);

            getCompPayGatewayChannelList('compPayChannel',this.value,merchant);
        };
    });

    $('.modal-fortuneToken form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            $('.fortuneTokenForm [type=submit]').prop('disabled',true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/user/fortune-token/transfer', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                // console.log(obj);
                if( obj.code == 1 ) {
                    swal.fire("Success!", obj.message, "success");
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => {
                        $('.fortuneTokenForm [type=submit]').prop('disabled',false);
                    });
                }
            })
            .done(function() {
                $('.modal-fortuneToken').modal('hide');
                $('.fortuneTokenForm [type=submit]').prop('disabled',false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    const fortuneTokenEvent = document.getElementById('modal-fortuneToken');
    fortuneTokenEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
        $('.fortuneTokenForm .personbalance').html('0');
    });

    $('.modal-setPromotion form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            $('.modal-setPromotion form [type=submit]').prop('disabled',true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/user/promotion-assigned', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                // console.log(obj);
                if( obj.code == 1 ) {
                    swal.fire("", obj.message, "success").then(() => { refreshProfile(); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-setPromotion').modal('toggle');
                $('.modal-setPromotion form [type=submit]').prop('disabled',false);
            })
            .fail(function() {
                swal.fire("", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    const setPromotionEvent = document.getElementById('modal-setPromotion');
    setPromotionEvent.addEventListener('shown.bs.modal', function (event) {
        getSelectPromotionList('promotion-list');
    });
    setPromotionEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
        $('.modal-setPromotion form .personBalance').html('0');
        $('#promotion-list').html(' ');
    });

    const gameBalanceEvent = document.getElementById('modal-gameBalance');
    gameBalanceEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal-gameBalance #gamelist').html(' ');
    });

    const coinbagEvent = document.getElementById('modal-coinBag');
    coinbagEvent.addEventListener('hidden.bs.modal', function (event) {
        $(this).find('.modal-body #fortuneToken').html('');
        $(this).find('.modal-body #categoryCoinHeader').html('');
        $(this).find('.modal-body #categoryCoin').html('');
        $(this).find('.modal-body #promoCoinHeader').html('');
        $(this).find('.modal-body #promoCoin').html('');
        $(this).find('.modal-body #providerCoinHeader').html('');
        $(this).find('.modal-body #providerCoin').html('');
        $(this).find('.modal-body #chipGroupCoinHeader').html('');
        $(this).find('.modal-body #chipGroupCoin').html('');
    });

    $('.modal-rewardSettings form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            $('.modal-rewardSettings [type=submit]').prop('disabled',true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/user/reward-settings/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                // console.log(obj);
                if( obj.code == 1 ) {
                    swal.fire("Success!", obj.message, "success").then(() => { 
                        $('#userTable').DataTable().ajax.reload(null,false);
                    });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-rewardSettings [type=submit]').prop('disabled',false);
                $('.modal-rewardSettings').modal('hide');
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => { });
            });
        }
    });

    const rewardSettingsEvent = document.getElementById('modal-rewardSettings');
    rewardSettingsEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });

    //agent permit
    $('.modal-agentPermission form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            $('.modal-agentPermission form [type=submit]').prop('disabled',true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/agent/permission/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                // console.log(obj);
                if( obj.code == 1 ) {
                    alertToast('bg-success', obj.message);
                    $('#userTable').DataTable().ajax.reload(null,false);
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    alertToast('bg-danger', obj.message);
                }
            })
            .done(function() {
                swal.close();
                $('.modal-agentPermission').modal('toggle');
                $('.modal-agentPermission form [type=submit]').prop('disabled',false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => { $('.modal-agentPermission form [type=submit]').prop('disabled',false); });
            });
        }
    });

    const agentpermissionEvent = document.getElementById('modal-agentPermission');
    agentpermissionEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });
    //End agent permit

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

// Free Credit
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
// End Free Credit

// Turnover
function clearChip(uid,category,provider,chipgroup)
{
    var params = {};
    params['uid'] = uid;
    params['category'] = category;
    params['provider'] = provider;
    params['chipgroup'] = chipgroup;

    $.post('/chip/user/clear', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            swal.fire("Success!", obj.message, "success");
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

function clearTurnover(uid)
{
    generalLoading();
    
    var params = {};
    params['uid'] = uid;

    $.post('/turnover/user/clear', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            swal.fire("Success!", obj.message, "success");
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
// End Turnover

// Game Balance
function gameid(uid)
{
    $('.modal-gameId').modal('toggle');

    const gameidTable = $('#gameidTable').DataTable({
        dom: "<'row'<'col-12 overflow-auto'tr>>",
        ajax: {
            type : "POST",
            url: "/user/game-id",
            data: {"uid": uid},
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
                    tableClass: 'ui display nowrap table-sm table-bordered'
                })
            }
        },
        language: langs,
        processing: true,
        stateSave: true,
        deferRender: true,
        destroy: true,
        paging: false,
        ordering: false,
        info: false,
        searching: false
    });

    gameidTable.draw();
}

function gameBalance(uid)
{
    $('.modal-gameBalance').modal('show');

    generalLoading();

    $.get('/list/game-provider', function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            const gp = obj.data;
            gp.forEach(function(item, index) {
                var node = '<dd class="border p-3 mb-3 wrap-' + item.code + '">';
                node += '<section class="d-flex justify-content-between align-items-center mb-3">';
                node += '<div>';
                node += '<h5 class="m-0">' + item.name + '</h5><small>Balance: <span class="gpbalance">0.00</span></small>';
                node += '</div>';
                node += '<div>';
                node += '<button type="button" class="btn btn-primary btn-sm me-1 btn-getbalance" onclick="checkbalance(\''+uid+'\',\'' + item.code + '\');"><?=lang('Nav.check');?></button>';
                node += '<button type="button" class="btn btn-success btn-sm btn-retrievebalance" data-gpcode="' + item.code + '"><?=lang('Nav.retrieve');?></button>';
                node += '</div>';
                node += '</section>';
                node += '<div class="input-group input-group-sm">';
                node += '<span class="input-group-text" id="gameScoreTransfer"><?=lang('Input.amount');?></span>';
                node += '<input type="text" class="form-control scoreInput score-' + item.code + '" aria-describedby="gameScoreTransfer">';
                node += '<button type="button" class="btn btn-primary btn-sm btn-transferIn" onclick="gameTransferScore(\'' + uid + '\',\'' + item.code + '\')"><?=lang('Nav.transfer');?></button>';
                node += '</div>';
                node += '</dd>';
                $('#gamelist').append(node);

                // checkbalance(uid);
            });
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => { });
        }
    })
    .done(function() {
        swal.close();
        $('.modal-gameBalance .btn-retrievebalance').hide();
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function gameTransferScore(uid,game)
{
    $('.modal-gameBalance .btn-transferIn').prop('disabled', true);
    const score = document.getElementsByClassName('score-'+game)[0].value;

    params = {};
    params['uid'] = uid;
    params['provider'] = game;
    params['amount'] = score;

    $.post('/user/game-balance/transfer-in', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            $('.scoreInput').val(0);
            checkbalance(uid,game);
            $('#userTable').DataTable().ajax.reload(null,false);
            $('.modal-gameBalance .btn-transferIn').prop('disabled', false);
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            $('.modal-gameBalance .wrap-'+gp+' .gpbalance').html(obj.message);
        }
    })
    .done(function() {
        $('.modal-gameBalance .btn-transferIn').prop('disabled', false);
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => { $('.modal-gameBalance .btn-transferIn').prop('disabled', false); });
    });
}

function checkbalance(uid,gp)
{
    $('.modal-gameBalance .btn-getbalance').prop('disabled', true);
    $('.modal-gameBalance .btn-retrievebalance').prop('disabled', true);
    $(this).html('<?=lang('Label.checking');?>');

    // const gp = $(this).data('gpcode');

    params = {};
    params['uid'] = uid;
    params['provider'] = gp;

    $.post('/user/game-balance/check', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            let amt = Math.floor(obj.balance*100)/100 ;

            if( amt>0 ) {
                $('.modal-gameBalance .wrap-'+gp+' .btn-retrievebalance').show();
                retrievegamebalance(uid, amt);
                $('.modal-gameBalance .wrap-'+gp+' .gpbalance').html(amt);
            } else {
                $('.modal-gameBalance .wrap-'+gp+' .gpbalance').html('0.00');
            }
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            $('.modal-gameBalance .wrap-'+gp+' .gpbalance').html(obj.message);
        }
    })
    .done(function() {
        $('.modal-gameBalance .btn-getbalance').prop('disabled', false);
        $('.modal-gameBalance .btn-retrievebalance').prop('disabled', false);
        $('.modal-gameBalance .wrap-'+gp+' .btn-getbalance').html('<?=lang('Nav.check');?>');
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
        $('.modal-gameBalance .btn-getbalance').prop('disabled', false);
        $('.modal-gameBalance .btn-retrievebalance').prop('disabled', false);
        $('.modal-gameBalance .wrap-'+gp+' .btn-getbalance').html('<?=lang('Nav.check');?>');
    });
}

function retrievegamebalance(uid, amount)
{
    $('.modal-gameBalance .btn-retrievebalance').off().on('click', function(e) {
        e.preventDefault();
        $('.modal-gameBalance .btn-getbalance').prop('disabled', true);
        $('.modal-gameBalance .btn-retrievebalance').prop('disabled', true);
        $(this).html('<?=lang('Label.retrieve');?>');

        const gp = $(this).data('gpcode');

        let amt = Math.floor(amount*100)/100 ;

        params = {};
        params['uid'] = uid;
        params['provider'] = gp;
        params['amount'] = parseFloat(amt);

        $.post('/user/game-balance/collect', {
            params
        }, function(data, status) {
            const obj = JSON.parse(data);
            if( obj.code == 1 ) {
                $('#userTable').DataTable().ajax.reload(null,false);
                $('.modal-gameBalance .wrap-'+gp+' .gpbalance').html('0.00');
            } else if( obj.code==39 ) {
                forceUserLogout();
            } else {
                $('.modal-gameBalance .wrap-'+gp+' .gpbalance').html(obj.message);
            }
        })
        .done(function() {
            $('.modal-gameBalance .btn-getbalance').prop('disabled', false);
            $('.modal-gameBalance .btn-retrievebalance').prop('disabled', false);
            $('.modal-gameBalance .wrap-'+gp+' .btn-retrievebalance').hide();
            $('.modal-gameBalance .wrap-'+gp+' .btn-retrievebalance').html('<?=lang('Nav.retrieve');?>');
        })
        .fail(function() {
            swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            $('.modal-gameBalance .btn-getbalance').prop('disabled', false);
            $('.modal-gameBalance .btn-retrievebalance').prop('disabled', false);
            $('.modal-gameBalance .wrap-'+gp+' .btn-retrievebalance').hide();
            $('.modal-gameBalance .wrap-'+gp+' .btn-retrievebalance').html('<?=lang('Nav.retrieve');?>');
        });
    });
}

function coinBag(uid)
{
    $('.modal-coinBag').modal('show');

    generalLoading();

    var params = {};
    params['uid'] = uid;

    $.post('/user/profile', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            document.getElementById("fortuneToken").innerHTML = obj.data.spinChip;
            document.getElementById("promoTurnover").innerHTML = obj.data.promotionTurnover;

            const categoryCoin = obj.data.wallet;
            var header = '<tr><th colspan="3" class="text-center"><?=lang('Nav.coinbag').' ('.lang('Input.category').')';?></th></tr>';
            header += '<tr><th><?=lang('Input.category');?></th><th><?=lang('Label.turnover');?></th><th><?=lang('Label.balance');?>/<?=lang('Label.afterscore');?></th></tr>';
            document.getElementById("categoryCoinHeader").innerHTML = header;
            categoryCoin.forEach( (item, index) => {
                let category;
                switch(item.type) {
                    case 0: category='<?=lang('Label.chip');?>'; break;
                    case 1: category='<?=lang('Label.slot');?>'; break;
                    case 2: category='<?=lang('Label.casino');?>'; break;
                    case 3: category='<?=lang('Label.sport');?>'; break;
                    case 4: category='<?=lang('Label.keno');?>'; break;
                    case 5: category='<?=lang('Label.lottery');?>'; break;
                    case 6: category='<?=lang('Label.fishing');?>'; break;
                    case 7: category='<?=lang('Label.other');?>'; break;
                    case 8: category='<?=lang('Label.esport');?>'; break;
                }

                var node = document.createElement("tr");
                var ctgy = document.createElement("td");
                var btn = document.createElement("button");
                btn.classList.add('btn','btn-light','btn-sm','ms-1');
                btn.innerHTML = '<i class="bx bxs-shield-x text-danger"></i>';
                btn.setAttribute("onclick", 'clearChip(\'' + btoa(obj.data.userId) + '\',\''+item.type+'\',\'\',\'\')');
                // var ctgytext = document.createTextNode(item.type);
                var ctgytext = document.createTextNode(category);
                var turnover = document.createElement("td");
                var turnovertext = document.createTextNode(item.turnover);
                var score = document.createElement("td");
                var scoretext = document.createTextNode(item.amount + '/' + item.afterAmount);
                
                ctgy.appendChild(ctgytext);
                turnover.appendChild(turnovertext);
                score.appendChild(scoretext);
                score.appendChild(btn);
                node.appendChild(ctgy);
                node.appendChild(turnover);
                node.appendChild(score);
                document.getElementById("categoryCoin").appendChild(node);
            });

            // const promoCoin = obj.data.playerPromotionWallet;
            // var header2 = '<tr><th colspan="2" class="text-center"><?=lang('Nav.coinbag').' ('.lang('Label.promotion').')';?></th></tr>';
            // header2 += '<tr><th><?=lang('Label.games');?></th><th><?=lang('Label.balance');?></th></tr>';
            // document.getElementById("promoCoinHeader").innerHTML = header2;
            // promoCoin.forEach( (item, index) => {
            //     var node = document.createElement("tr");
            //     var game = document.createElement("td");
            //     var gamename = document.createTextNode('['+item.gameProviderCode+'] '+item.gameProviderName);
            //     var coin = document.createElement("td");
            //     var cointext = document.createTextNode(item.amount);
            //     game.appendChild(gamename);
            //     coin.appendChild(cointext);
            //     node.appendChild(game);
            //     node.appendChild(coin);
            //     document.getElementById("promoCoin").appendChild(node);
            // });

            const chipGroupCoin = obj.data.gpGroupWalletList;
            var header3 = '<tr><th colspan="3" class="text-center"><?=lang('Input.chipgroup');?></th></tr>';
            header3 += '<tr><th><?=lang('Label.games');?></th><th><?=lang('Label.turnover');?></th><th><?=lang('Label.balance');?>/<?=lang('Label.afterscore');?></th></tr>';
            document.getElementById("chipGroupCoinHeader").innerHTML = header3;
            chipGroupCoin.forEach( (item, index) => {
                var node = document.createElement("tr");
                var game = document.createElement("td");
                var btn = document.createElement("button");
                btn.classList.add('btn','btn-light','btn-sm','ms-1');
                btn.innerHTML = '<i class="bx bxs-shield-x text-danger"></i>';
                btn.setAttribute("onclick", 'clearChip(\'' + btoa(obj.data.userId) + '\',\'\',\'\',\''+item.name+'\')');
                var gamename = document.createTextNode(item.name);
                var turnover = document.createElement("td");
                var turnovertext = document.createTextNode(item.turnover);
                var score = document.createElement("td");
                var scoretext = document.createTextNode(item.amount + '/' + item.afterAmount);
                game.appendChild(gamename);
                turnover.appendChild(turnovertext);
                score.appendChild(scoretext);
                score.appendChild(btn);
                node.appendChild(game);
                node.appendChild(turnover);
                node.appendChild(score);
                document.getElementById("chipGroupCoin").appendChild(node);
            });

            const providerCoin = obj.data.gameWallet;
            var header3 = '<tr><th colspan="3" class="text-center"><?=lang('Nav.coinbag').' ('.lang('Label.games').')';?></th></tr>';
            header3 += '<tr><th><?=lang('Label.games');?></th><th><?=lang('Label.turnover');?></th><th><?=lang('Label.balance');?>/<?=lang('Label.afterscore');?></th></tr>';
            document.getElementById("providerCoinHeader").innerHTML = header3;
            providerCoin.forEach( (item, index) => {
                var node = document.createElement("tr");
                var game = document.createElement("td");
                var btn = document.createElement("button");
                btn.classList.add('btn','btn-light','btn-sm','ms-1');
                btn.innerHTML = '<i class="bx bxs-shield-x text-danger"></i>';
                btn.setAttribute("onclick", 'clearChip(\'' + btoa(obj.data.userId) + '\',\'\',\''+item.gameProviderCode+'\',\'\')');
                var gamename = document.createTextNode('['+item.gameProviderCode+'] '+item.gameProviderName);
                var turnover = document.createElement("td");
                var turnovertext = document.createTextNode(item.turnover);
                var score = document.createElement("td");
                var scoretext = document.createTextNode(item.amount + '/' + item.afterAmount);
                game.appendChild(gamename);
                turnover.appendChild(turnovertext);
                score.appendChild(scoretext);
                score.appendChild(btn);
                node.appendChild(game);
                node.appendChild(turnover);
                node.appendChild(score);
                document.getElementById("providerCoin").appendChild(node);
            });
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
// End Game Balance

// User Balance
function setPromo(uid, username)
{
    $('.modal-setPromotion').modal('toggle');
    $('.modal-setPromotion form [name=username]').val(username);
    $('.modal-setPromotion form [name=uid]').val(uid);
}

function openFortuneToken(uid,username)
{
    $('.modal-fortuneToken').modal('show');
    $('.fortuneTokenForm [name=username]').val(username);
    $('.fortuneTokenForm [name=uid]').val(uid);

    generalLoading();

    var params = {};
    params['uid'] = uid;

    $.post('/user/profile', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            $('.fortuneTokenForm .personbalance').html(obj.data.spinChip);
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

function openPGTransfer(uid,username,balance)
{
    $('.modal-replenishment').modal('show');
    $('.modal-replenishment [name=username]').val(username);
    $('.modal-replenishment [name=uid]').val(uid);
    $('.modal-replenishment .personbalance').html(balance);
}

function openTransfer(role,uid,username,balance)
{
    $('.modal-creditTransfer').modal('show');
    $('.modal-creditTransfer [name=username]').val(username);
    $('.modal-creditTransfer [name=uid]').val(uid);
    $('.modal-creditTransfer .personbalance').html(balance);

    if( role==3 ) {
        $('#type_agcash').prop('disabled',false);

        $('.chipAllow').hide();
    } else if( role==4 ) {
        $('#type_agcash').prop('disabled',true);
    }
}

function multipleTurnover()
{
    let amount = $('.modal-creditTransfer [name=amount]').val();
    let multiple = $('.modal-creditTransfer [name=turnoverMultiple]').val();
    let finalTurnover = multiple * amount;
    //let fnum = finalTurnover.toFixed(2);

    $('.modal-creditTransfer [name=turnover]').val(finalTurnover);  
}
// End User Balance

// Company PG and Bank Card
async function selectDomWithdrawalBankCard(element)
{
    generalLoading();

    var params = {};
    params['parent'] = '';

    $.post('/list/withdrawal-bank-card', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            swal.close();

            const pp = obj.data;
            var nodeLast = document.createElement("option");
            var textnodeLast = document.createTextNode('-- Choose --');
            nodeLast.setAttribute("value", '');
            nodeLast.appendChild(textnodeLast);
            document.getElementById(element).appendChild(nodeLast);

            pp.forEach(function(item, index) {
                var node = document.createElement("option");
                var textnode = document.createTextNode(item.name);
                node.setAttribute("value", item.bankId);
                node.setAttribute("data-accNo", item.accNo);
                node.setAttribute("data-cardNo", item.cardNo);
                node.appendChild(textnode);
                document.getElementById(element).appendChild(node);
            });
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("", obj.message + " (Code: "+obj.code+")", "error").then(() => {
                
            });
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("", "Please try again later.", "error");
    });
}

async function getCompPayGatewayChannelList(element,bankId,merchant)
{
    generalLoading();
    $('.modal-replenishment [name=compPayChannel]').html('');

    var params = {};
    params['parent'] = '';
    params['provider'] = bankId;
    params['merchant'] = merchant;

    $.post('/list-raw/payment-channel', {
        params
    },function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            swal.close();
            const pp = obj.data;
            pp.forEach(function(item, index) {
                var node = document.createElement("option");
                var textnode = document.createTextNode(item.name);
                node.setAttribute("value", item.code);
                node.appendChild(textnode);
                document.getElementById(element).appendChild(node);
            });
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("", obj.message + " (Code: "+obj.code+")", "error").then(() => { });
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("", "Please try again later.", "error");
    });
}

async function getCompPaymentGatewayList(element)
{
    generalLoading();

    var params = {};
    params['parent'] = '';

    $.post('/list-raw/payment-gateway', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            swal.close();

            const pp = obj.data;
            var nodeLast = document.createElement("option");
            var textnodeLast = document.createTextNode('-- Choose --');
            nodeLast.setAttribute("value", '');
            nodeLast.appendChild(textnodeLast);
            document.getElementById(element).appendChild(nodeLast);

            pp.forEach(function(item, index) {
                var node = document.createElement("option");
                var textnode = document.createTextNode(item.name);
                node.setAttribute("value", item.bankId);
                node.setAttribute("data-merchant", item.merchant);
                node.appendChild(textnode);
                document.getElementById(element).appendChild(node);
            });
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("", obj.message + " (Code: "+obj.code+")", "error").then(() => { });
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("", "Please try again later.", "error");
    });
}
// End Company PG and Bank Card

// Affiliate
function affiliateQR(uid)
{
    $('.modal-affiliateQR').modal('show');

    const affURL = '<?=$_ENV['affiliate'].'/';?>' + uid;
    var qcode = new QRCode(document.getElementById("qrcode"), {
        text: affURL,
        correctLevel : QRCode.CorrectLevel.H
    });

    $('.modal-affiliateQR .btn-qrreg').attr('onclick', "copyRegUrl('" + affURL + "')");
}

function copyRegUrl(url)
{
    swal.fire({
        title: '<?=lang('Label.shareurl');?>',
        text: url,  
        showCancelButton: true,
        confirmButtonText: '<?=lang('Nav.copy');?>',
    })
    .then((value) => {
        if (value.isConfirmed) {
            var str = $('.swal2-html-container')[0].innerText;
            // console.log(str);
            navigator.clipboard.writeText(str);
        }
    });
}

function getScreen()
{
	html2canvas($(".modal-affiliateQR .qrcard"), {
        dpi: 1024,
        // scale: 4,
        logging: false,
        // width: 466,
        // height: 772,
        letterRendering: true,
        allowTaint: true,
        useCORS: false,
        foreignObjectRendering : true,
		onrendered: function(canvas) {
			$(".modal-affiliateQR .getscreen").attr('href', canvas.toDataURL("image/png").replace(/^data:image\/png/, "data:application/octet-stream"));
			$(".modal-affiliateQR .getscreen").attr('download', '<?=$_ENV['company'];?>.png');
			$(".modal-affiliateQR .getscreen")[0].click();
		}
	});
}

function affiliateUpline(uid)
{
    generalLoading();

    params = {};
    params['uid'] = uid;

    $.post('/user/profile', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        // swal.fire(obj.data.loginId);
        swal.fire({
            title: '<?=lang('Label.affinviter');?>',
            text: obj.data.loginId
        });
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}
// End Affiliate

$('#userTable tbody, #paymentTable tbody').on('click', '.getupline', function() {
    generalLoading();

    const uid = $(this).data('uid');

    params = {};
    params['uid'] = uid;

    $.post('/user-upline', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        swal.fire(obj.data.loginId);
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
});

function writeMessage(uid)
{
    $('.modal-message').modal('show');

    $('.modal-message form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            $('.modal-message [type=submit]').prop('disabled',true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['recipient'] = uid;
            });

            $.post('/message/new/add', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                // console.log(obj);
                if( obj.code == 1 ) {
                    alertToast('bg-success', obj.message);
                    $('.modal-message').modal('hide');
                } else {
                    alertToast('bg-danger', obj.message);
                }
            })
            .done(function() {
                swal.close();
                $('.modal-message [type=submit]').prop('disabled',false);
            })
            .fail(function() {
                alertToast('bg-danger', obj.message);
            });
        }
    });
}

function modifyRewardSettings(uid)
{
    $('.modal-rewardSettings').modal('show');
    $('.modal-rewardSettings form [name=uid]').val(uid);

    generalLoading();

    var params = {};
    params['uid'] = uid;

    $.post('/user/reward-settings', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            $('.rewardSettingForm [name=uid]').val(uid);
            obj.data.agbankcard==true ? $('.rewardSettingForm [name=agbankcard]').prop('checked', true) : $('.rewardSettingForm [name=agbankcard]').prop('checked', false);
            obj.data.agpgateway==true ? $('.rewardSettingForm [name=agpgateway]').prop('checked', true) : $('.rewardSettingForm [name=agpgateway]').prop('checked', false);

            obj.data.nobanktransferdeposit==true ? $('.rewardSettingForm [name=nobanktransferdeposit]').prop('checked', true) : $('.rewardSettingForm [name=nobanktransferdeposit]').prop('checked', false);
            obj.data.nopaygatetwaydeposit==true ? $('.rewardSettingForm [name=nopaygatetwaydeposit]').prop('checked', true) : $('.rewardSettingForm [name=nopaygatetwaydeposit]').prop('checked', false);
            obj.data.nowithdrawal==true ? $('.rewardSettingForm [name=nowithdrawal]').prop('checked', true) : $('.rewardSettingForm [name=nowithdrawal]').prop('checked', false);
            obj.data.nopgwithdrawal==true ? $('.rewardSettingForm [name=nopgwithdrawal]').prop('checked', true) : $('.rewardSettingForm [name=nopgwithdrawal]').prop('checked', false);

            obj.data.nojackpot==true ? $('.rewardSettingForm [name=nojackpot]').prop('checked', true) : $('.rewardSettingForm [name=nojackpot]').prop('checked', false);
            obj.data.nofortunewheel==true ? $('.rewardSettingForm [name=nofortunewheel]').prop('checked', true) : $('.rewardSettingForm [name=nofortunewheel]').prop('checked', false);
            obj.data.noagcomm==true ? $('.rewardSettingForm [name=noagcomm]').prop('checked', true) : $('.rewardSettingForm [name=noagcomm]').prop('checked', false);
            obj.data.noaffilliate==true ? $('.rewardSettingForm [name=noaffilliate]').prop('checked', true) : $('.rewardSettingForm [name=noaffilliate]').prop('checked', false);
            obj.data.nolossrebate==true ? $('.rewardSettingForm [name=nolossrebate]').prop('checked', true) : $('.rewardSettingForm [name=nolossrebate]').prop('checked', false);
            obj.data.noafflossrebate==true ? $('.rewardSettingForm [name=noafflossrebate]').prop('checked', true) : $('.rewardSettingForm [name=noafflossrebate]').prop('checked', false);

            obj.data.nodepositreward==true ? $('.rewardSettingForm [name=nodepositreward]').prop('checked', true) : $('.rewardSettingForm [name=nodepositreward]').prop('checked', false);
            obj.data.noaffdeposit==true ? $('.rewardSettingForm [name=noaffdeposit]').prop('checked', true) : $('.rewardSettingForm [name=noaffdeposit]').prop('checked', false);
            obj.data.nodailyfree==true ? $('.rewardSettingForm [name=nodailyfree]').prop('checked', true) : $('.rewardSettingForm [name=nodailyfree]').prop('checked', false);
            obj.data.nosharereward==true ? $('.rewardSettingForm [name=nosharereward]').prop('checked', true) : $('.rewardSettingForm [name=nosharereward]').prop('checked', false);
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

function modify(uid, username)
{
    $('.modal-modify').modal('show');
    $('.modal-modify form [name=username]').val(username);

    coordinateProfile(uid);

    $('.modal-modify form').off().on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            generalLoading();

            $('.modal-modify form [type=submit]').prop('disabled',true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['uid'] = uid;
                params['usertype'] = '<?=$_SESSION['session'];?>';
            });

            $.post('/user/personal-change/user', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                // console.log(obj);
                if( obj.code == 1 ) {
                    swal.fire("Success!", obj.message, "success").then(() => { $('#userTable').DataTable().ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-modify').modal('hide');
                $('.modal-modify form [type=submit]').prop('disabled',false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });
}

function modifyStatus(uid, status)
{
    generalLoading();

    var params = {};
    params['uid'] = uid;
    params['status'] = status;

    $.post('/user/status-change', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            alertToast('bg-success', obj.message);
            $('#userTable').DataTable().ajax.reload(null,false);
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            alertToast('bg-danger', obj.message);
        }
    })
    .done(function() {
        swal.close();
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error").then(() => { $('#userTable').DataTable().ajax.reload(null,false); });
    });
}

function resetVaultPin(uid)
{
    generalLoading();

    var params = {};
    params['uid'] = uid;

    $.post('/user/vault-pin/reset', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            // swal.fire("Success!", 'New Vault Pin: ' + obj.password, "success");
            swal.fire({
                icon: 'success',
                text: '<?=lang('Label.newvaultpin');?>: ' + obj.password
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

function resetSecondPass(uid)
{
    generalLoading();

    var params = {};
    params['uid'] = uid;

    $.post('/user/second-password/reset', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            // swal.fire("Success!", 'New Vault Pin: ' + obj.password, "success");
            swal.fire({
                icon: 'success',
                text: '<?=lang('Label.new2ndpass');?>: ' + obj.password
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

function cardOwner(uid,provider,card,accno,bankname,type)
{
    generalLoading();

    var params = {};
    params['uid'] = uid;
    params['provider'] = provider;
    params['cardno'] = card;
    params['accno'] = accno;

    $.post('/bank-card/company/get', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            // $('#paymentTable .holder').html(obj.data.accountHolder);

            if( type==1 ) {
                cardType = '<?=lang('Label.compbcinfo');?>';
            } else if( type==2 ) {
                cardType = '<?=lang('Label.memberbcinfo');?>';
            }

            var str = '<?=lang('Input.bank');?>: <b class="text-primary">' + bankname + '</b><br>';
            str += '<?=lang('Input.accholder');?>: <b class="text-primary">' + obj.data.accountHolder + '</b><br>';
            str += '<?=lang('Input.accno');?>: <b class="text-primary">' + obj.data.accountNo + '</b>';

            swal.fire({
                allowOutsideClick: false,
                title: cardType,
                html: str
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

function getCompBankCard(element)
{
    $.get('/bank-card/company/all', function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            const bc = obj.data;
            bc.forEach( (item, index) => {
                if( item.status==1 && item.display==2 ) {
                    var node = document.createElement("option");
                    var nodetext = document.createTextNode('['+item.name.EN+'] '+item.accountNo);
                    node.setAttribute("value", btoa(item.bankId));
                    node.dataset.card = item.cardNo;
                    node.dataset.acc = item.accountNo;
                    node.appendChild(nodetext);
                    document.getElementById(element).appendChild(node);
                }
            });
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
        // swal.close();
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function gameProviderList3(element)
{
    $.get('/list/game-provider', function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            const gp = obj.data;
            var nodeLast = document.createElement("option");
            var textnodeLast = document.createTextNode('Not Specify');
            nodeLast.setAttribute("value", '0');
            nodeLast.appendChild(textnodeLast);
            document.getElementById(element).appendChild(nodeLast);

            gp.forEach(function(item, index) {
                var node = document.createElement("option");
                var textnode = document.createTextNode(item.name);
                node.setAttribute("value", item.id);
                node.appendChild(textnode);
                document.getElementById(element).appendChild(node);
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

function gameProviderList2(element)
{
    $.get('/list/game-provider', function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            const gp = obj.data;
            var nodeLast = document.createElement("option");
            var textnodeLast = document.createTextNode('Not Specify');
            nodeLast.setAttribute("value", '0');
            nodeLast.appendChild(textnodeLast);
            document.getElementById(element).appendChild(nodeLast);

            gp.forEach(function(item, index) {
                var node = document.createElement("option");
                var textnode = document.createTextNode(item.name);
                node.setAttribute("value", item.code);
                node.appendChild(textnode);
                document.getElementById(element).appendChild(node);
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

function gameProviderList(element)
{
    $.get('/list/game-provider', function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            const gp = obj.data;
            var nodeLast = document.createElement("option");
            var textnodeLast = document.createTextNode('ALL');
            nodeLast.setAttribute("value", 'ALL');
            nodeLast.appendChild(textnodeLast);
            document.getElementById(element).appendChild(nodeLast);
            
            gp.forEach(function(item, index) {
                var node = document.createElement("option");
                var textnode = document.createTextNode(item.name);
                node.setAttribute("value", item.code);
                node.appendChild(textnode);
                document.getElementById(element).appendChild(node);
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

function getBankList(element)
{
    generalLoading();

    $.get('/list/payment-provider/bank/all', function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            const pp = obj.data;

            var nodeLast = document.createElement("option");
            var textnodeLast = document.createTextNode('-- Choose --');
            nodeLast.setAttribute("value", '');
            nodeLast.appendChild(textnodeLast);
            document.getElementById(element).appendChild(nodeLast);

            pp.forEach(function(item, index) {
                if( item.status==1 ) {
                    var node = document.createElement("option");
                    var textnode = document.createTextNode(item.name.EN);
                    node.setAttribute("value", btoa(item.bankId));
                    node.appendChild(textnode);
                    document.getElementById(element).appendChild(node);
                }
            });
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => { $('.modal-addpg').modal('toggle'); });
        }
    })
    .done(function() {
        swal.close();
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function getAllBankList(element)
{
    generalLoading();

    $.get('/list/payment-provider/bank/gateway/all', function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            const pp = obj.data;

            var nodeLast = document.createElement("option");
            var textnodeLast = document.createTextNode('-- Choose --');
            nodeLast.setAttribute("value", '');
            nodeLast.appendChild(textnodeLast);
            document.getElementById(element).appendChild(nodeLast);

            var nodeBankTitle= document.createElement("optgroup");
            //var textnodeBankTitle = document.createTextNode('Bank');
            nodeBankTitle.setAttribute("label", "<?=lang('Label.banktransfer');?>");
            //nodeBankTitle.appendChild(textnodeBankTitle);
            document.getElementById(element).appendChild(nodeBankTitle);


            pp.forEach(function(item, index) {
                if( item.paymentMethod==1 ) {
                    var node = document.createElement("option");
                    var textnode = document.createTextNode(item.name.EN);
                    node.setAttribute("value", btoa(item.bankId));
                    node.appendChild(textnode);
                    document.getElementById(element).appendChild(node);
                }
            });

            var nodePGTitle= document.createElement("optgroup");
            //var textnodePGTitle = document.createTextNode('Payment Gateway');
            nodePGTitle.setAttribute("label", "<?=lang('Label.paygateway');?>");
            //nodePGTitle.appendChild(textnodePGTitle);
            document.getElementById(element).appendChild(nodePGTitle);

            pp.forEach(function(item, index) {
                if( item.paymentMethod==2 ) {
                    var node = document.createElement("option");
                    var textnode = document.createTextNode(item.name.EN);
                    node.setAttribute("value", btoa(item.bankId));
                    node.appendChild(textnode);
                    document.getElementById(element).appendChild(node);
                }
            });
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => { $('.modal-addpg').modal('toggle'); });
        }
    })
    .done(function() {
        swal.close();
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function getPaymentProviderList(element)
{
    generalLoading();

    $.get('/list/payment-provider/payment-gateway/all', function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            const pp = obj.data;

            var nodeLast = document.createElement("option");
            var textnodeLast = document.createTextNode('-- Choose --');
            nodeLast.setAttribute("value", '');
            nodeLast.appendChild(textnodeLast);
            document.getElementById(element).appendChild(nodeLast);

            pp.forEach(function(item, index) {
                if( item.status==1 ) {
                    var node = document.createElement("option");
                    var textnode = document.createTextNode(item.name.EN);
                    node.setAttribute("value", btoa(item.bankId));
                    node.appendChild(textnode);
                    document.getElementById(element).appendChild(node);
                }
            });
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => { $('.modal-addpg').modal('toggle'); });
        }
    })
    .done(function() {
        swal.close();
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

async function getSelectPromotionList(element)
{
    generalLoading();

    $.get('/list-raw/promotion', function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            swal.close();
            var lang = '<?=$_SESSION['lang'];?>';

            const promo = obj.data;
            var nodeLast = document.createElement("option");
            var textnodeLast = document.createTextNode('-- Choose --');
            nodeLast.setAttribute("value", '');
            nodeLast.appendChild(textnodeLast);
            document.getElementById(element).appendChild(nodeLast);

            promo.forEach(function(item, index) {
                if( item.status==1 ) {
                    var node = document.createElement("option");
                    // var textnode = document.createTextNode(item.name.EN);
                    node.setAttribute("value", btoa(item.promotionId));
                    // node.appendChild(textnode);
                    node.innerHTML = item.title[lang.toUpperCase()];
                    document.getElementById(element).appendChild(node);
                }
            });
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("", obj.message + " (Code: "+obj.code+")", "error").then(() => {

            });
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("", "Please try again later.", "error");
    });
}

async function selectGameProviderList(element)
{
    generalLoading();

    $.get('/list/game-provider', function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            swal.close();

            var nodeLast = document.createElement("option");
            var textnodeLast = document.createTextNode('--- Select ---');
            nodeLast.setAttribute("value", '');
            nodeLast.appendChild(textnodeLast);
            document.getElementById(element).appendChild(nodeLast);
            
            const gp = obj.data;
            gp.forEach(function(item, index) {
                var node = document.createElement("option");
                var textnode = document.createTextNode(item.name);
                node.setAttribute("value", item.code);
                node.appendChild(textnode);
                document.getElementById(element).appendChild(node);
            });
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("", "Please try again later.", "error");
    });
}

async function radioGameCategoryList(element)
{
    generalLoading();

    $.get('/list/game-provider/category', function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            swal.close();

            const gp = obj.data;
            gp.forEach( (item, index) => {
                var node = document.createElement("div");                
                var nodeInput = document.createElement("input");
                var nodeLabel = document.createElement("label");
                var textnode = document.createTextNode(item.value);
                nodeInput.setAttribute("type", 'radio');
                nodeInput.setAttribute("name", 'gcate');
                nodeInput.setAttribute("value", item.code);
                nodeInput.setAttribute("disabled", true);
                nodeInput.classList.add('form-check-input');
                nodeInput.setAttribute("id", item.code);
                nodeLabel.classList.add('form-check-label');
                nodeLabel.setAttribute("for", item.code);
                nodeLabel.appendChild(textnode);
                node.appendChild(nodeInput);
                node.appendChild(nodeLabel);
                var ele = document.getElementById(element).appendChild(node);
                ele.classList.add('form-check', 'form-check-inline');
            });
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            // swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => { $('.modal-modifyGP').modal('toggle'); });
        }
    })
    .done(function() {

    })
    .fail(function() {
        swal.fire("", "Please try again later.", "error");
    });
}

function getGameCategoryList4(element)
{
    document.getElementById(element).innerHTML = '';

    $.get('/list/game-category', function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            const gc = obj.data;
            var nodeLast = document.createElement("option");
            var textnodeLast = document.createTextNode('Not Specify');
            nodeLast.setAttribute("value", '0');
            nodeLast.appendChild(textnodeLast);
            document.getElementById(element).appendChild(nodeLast);

            gc.forEach( (item, index) => {
                var node = document.createElement("option");
                var textnode = document.createTextNode(item.name);
                node.setAttribute("value", item.code);
                node.appendChild(textnode);
                document.getElementById(element).appendChild(node);
            });

        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => { $('.modal-addgame').modal('toggle'); });
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function getGameCategoryList3(element)
{
    generalLoading();

    $.get('/list/game-provider/category', function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            const gp = obj.data;
            gp.forEach( (item, index) => {
                var node = document.createElement("div");                
                var nodeInput = document.createElement("input");
                var nodeLabel = document.createElement("label");
                var textnode = document.createTextNode(item.value);
                nodeInput.setAttribute("type", 'radio');
                nodeInput.setAttribute("name", 'gcate');
                nodeInput.setAttribute("value", item.code);
                nodeInput.classList.add('form-check-input');
                nodeInput.setAttribute("id", item.code);
                nodeLabel.classList.add('form-check-label');
                nodeLabel.setAttribute("for", item.name);
                nodeLabel.appendChild(textnode);
                node.appendChild(nodeInput);
                node.appendChild(nodeLabel);
                var ele = document.getElementById(element).appendChild(node);
                ele.classList.add('form-check', 'form-check-inline');
            });

            // checkOccupied(list);
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => { $('.modal-modifyGP').modal('toggle'); });
        }
    })
    .done(function() {
        element=='cateList' ? swal.close() : '';
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function getGameCategoryList2(element)
{
    document.getElementById(element).innerHTML = '';

    $.get('/list/game-category', function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            const gc = obj.data;
            var nodeLast = document.createElement("option");
            var textnodeLast = document.createTextNode('Not Specify');
            nodeLast.setAttribute("value", '0');
            nodeLast.appendChild(textnodeLast);
            document.getElementById(element).appendChild(nodeLast);

            gc.forEach( (item, index) => {
                var node = document.createElement("option");
                var textnode = document.createTextNode(item.name);
                node.setAttribute("value", item.code);
                node.appendChild(textnode);
                document.getElementById(element).appendChild(node);
            });

            getAdminConfig();
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => { $('.modal-addgame').modal('toggle'); });
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function getGameCategoryList(element)
{
    generalLoading();

    $.get('/list/game-provider/category', function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            const gp = obj.data;
            gp.forEach( (item, index) => {
                var node = document.createElement("div");                
                var nodeInput = document.createElement("input");
                var nodeLabel = document.createElement("label");
                var textnode = document.createTextNode(item.value);
                nodeInput.setAttribute("type", 'checkbox');
                nodeInput.setAttribute("name", 'gcate');
                nodeInput.setAttribute("value", item.code);
                nodeInput.classList.add('form-check-input');
                nodeInput.setAttribute("id", item.name);
                nodeLabel.classList.add('form-check-label');
                nodeLabel.setAttribute("for", item.name);
                nodeLabel.appendChild(textnode);
                node.appendChild(nodeInput);
                node.appendChild(nodeLabel);
                var ele = document.getElementById(element).appendChild(node);
                ele.classList.add('form-check', 'form-check-inline');
            });

            // checkOccupied(list);
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => { $('.modal-modifyGP').modal('toggle'); });
        }
    })
    .done(function() {
        element=='cateList' ? swal.close() : '';
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function getGameCategoryDisplayList(element)
{
    generalLoading();

    $.get('/list/game-provider/category', function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            const gp = obj.data;
            gp.forEach( (item, index) => {
                var node = document.createElement("div");                
                var nodeInput = document.createElement("input");
                var nodeLabel = document.createElement("label");
                var textnode = document.createTextNode(item.value);
                nodeInput.setAttribute("type", 'checkbox');
                nodeInput.setAttribute("name", 'gcatedisplay');
                nodeInput.setAttribute("value", item.code);
                nodeInput.classList.add('form-check-input');
                nodeInput.setAttribute("id", item.name);
                nodeLabel.classList.add('form-check-label');
                nodeLabel.setAttribute("for", item.name);
                nodeLabel.appendChild(textnode);
                node.appendChild(nodeInput);
                node.appendChild(nodeLabel);
                var ele = document.getElementById(element).appendChild(node);
                ele.classList.add('form-check', 'form-check-inline');
            });

            // checkOccupied(list);
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            // swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error").then(() => { $('.modal-modifyGP').modal('toggle'); });
        }
    })
    .done(function() {
        // element=='cateList' ? swal.close() : '';
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function getNegSum(uid)
{
    generalLoading();

    var params = {};
    params['uid'] = uid;

    $.post('/user/administrator/negative-balance', {
        params
    } ,function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj.sumBalance);
        if( obj.code==1 ) {
            swal.fire("<?=lang('Label.teamoutstanding');?>", obj.sumBalance.toFixed(2));
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

function selfProfile()
{
    var params = {};

    $.post('/user/profile/hub', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            $('.modal-selfmodify form [name=username]').val(obj.data.loginId);
            $('.modal-selfmodify form [name=contact]').val(obj.data.contact);

            $('.modal-selfmodify [name=regioncode] option[value=MYR]').removeAttr('selected','selected');
            $('.modal-selfmodify [name=regioncode] option[value=SGD]').removeAttr('selected','selected');
            if( obj.data.regionCode=='' ) {
                $('.modal-selfmodify [name=regioncode] option[value=MYR]').attr('selected','selected');
            } else {
                $('.modal-selfmodify [name=regioncode] option[value=' + obj.data.regionCode + ']').attr('selected','selected');
            }

            $('.modal-selfmodify form [name=telegram]').val(obj.data.telegram);
            $('.modal-selfmodify form [name=remark]').val(obj.data.remark);
        } else {
            swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
        }
    })
    .done(function() {
    })
    .fail(function() {
        alertToast('bg-danger', obj.message);
    });
}

function coordinateProfile(uid)
{
    generalLoading();

    var params = {};
    params['uid'] = uid;

    $.post('/user/profile', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            swal.close();
            
            // if( obj.data.currency=='MYR' && obj.data.contact!='' )
            // {
            //     $('.modal-modify form [name=contact]').val('0'+obj.data.contact);
            // } else {
            //     $('.modal-modify form [name=contact]').val(obj.data.contact);
            // }

            $('.modal-modify form [name=contact]').val(obj.data.contact);
            $('.modal-modify form [name=telegram]').val(obj.data.telegram);
            $('.modal-modify form [name=remark]').val(obj.data.remark);
            $('.modal-modify form [name=fname]').val(obj.data.name);

            $('.modal-modify [name=regioncode] option[value=MYR]').removeAttr('selected','selected');
            $('.modal-modify [name=regioncode] option[value=SGD]').removeAttr('selected','selected');
            if( obj.data.regionCode=='' ) {
                $('.modal-modify [name=regioncode] option[value=MYR]').attr('selected','selected');
            } else {
                $('.modal-modify [name=regioncode] option[value=' + obj.data.regionCode + ']').attr('selected','selected');
            }
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

//Agent permission
function agentPermission(uid)
{
    $('.modal-agentPermission').modal('toggle');

    generalLoading();

    var params = {};
    params['uid'] = uid;

    $.post('/list/agent/permission', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code==1 ) {
            $('.modal-agentPermission form [name=uid]').val(uid);
            //Permit
            obj.data.transfercomm==1 ? $('.modal-agentPermission [name=transfercomm]').prop('checked', true) : $('.modal-agentPermission [name=transfercomm]').prop('checked', false);
            obj.data.createmember==1 ? $('.modal-agentPermission [name=createmember]').prop('checked', true) : $('.modal-agentPermission [name=createmember]').prop('checked', false);
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            swal.fire("Error!", obj.message, "error");
        }
    })
    .done(function() {
        swal.close();
    })
    .fail(function() {
        swal.fire("", "Please try again later.", "error").then(() => {  });
    });
}
//End Agent permission

function setDate2024(element,dateStyle)
{
    if( dateStyle==1 )
    {
        $('.'+element+' [name=start2024]').val("<?=date('Y-m-d',strtotime('Today'));?>");
        $('.'+element+' [name=end2024]').val("<?=date('Y-m-d',strtotime('Today'));?>");
    } else if( dateStyle==2 ) {
        $('.'+element+' [name=start2024]').val("<?=date('Y-m-d',strtotime('-1 day'));?>");
        $('.'+element+' [name=end2024]').val("<?=date('Y-m-d',strtotime('-1 day'));?>");
    } else if( dateStyle==3 ) {
        $('.'+element+' [name=start2024]').val("<?=date('Y-m-d',strtotime('monday this week'));?>");
        $('.'+element+' [name=end2024]').val("<?=date('Y-m-d',strtotime('sunday this week'));?>");
    } else if( dateStyle==4 ) {
        $('.'+element+' [name=start2024]').val("<?=date('Y-m-d',strtotime('last week monday'));?>");
        $('.'+element+' [name=end2024]').val("<?=date('Y-m-d',strtotime('last week sunday'));?>");
    } else if( dateStyle==5 ) {
        $('.'+element+' [name=start2024]').val("<?=date('Y-m-01');?>");
        $('.'+element+' [name=end2024]').val("<?=date('Y-m-t');?>");
    } else if( dateStyle==6 ) {
        $('.'+element+' [name=start2024]').val("<?=date('Y-m-d',strtotime('first day of last month'));?>");
        $('.'+element+' [name=end2024]').val("<?=date('Y-m-d',strtotime('last day of last month'));?>");
    }
}

function setDate(element,dateStyle)
{
    if( dateStyle==1 )
    {
        $('.'+element+' [name=start]').val("<?=date('Y-m-d',strtotime('Today'));?>");
        $('.'+element+' [name=end]').val("<?=date('Y-m-d',strtotime('Today'));?>");
    } else if( dateStyle==2 ) {
        $('.'+element+' [name=start]').val("<?=date('Y-m-d',strtotime('-1 day'));?>");
        $('.'+element+' [name=end]').val("<?=date('Y-m-d',strtotime('-1 day'));?>");
    } else if( dateStyle==3 ) {
        $('.'+element+' [name=start]').val("<?=date('Y-m-d',strtotime('monday this week'));?>");
        $('.'+element+' [name=end]').val("<?=date('Y-m-d',strtotime('sunday this week'));?>");
    } else if( dateStyle==4 ) {
        $('.'+element+' [name=start]').val("<?=date('Y-m-d',strtotime('last week monday'));?>");
        $('.'+element+' [name=end]').val("<?=date('Y-m-d',strtotime('last week sunday'));?>");
    } else if( dateStyle==5 ) {
        $('.'+element+' [name=start]').val("<?=date('Y-m-01');?>");
        $('.'+element+' [name=end]').val("<?=date('Y-m-t');?>");
    } else if( dateStyle==6 ) {
        $('.'+element+' [name=start]').val("<?=date('Y-m-d',strtotime('first day of last month'));?>");
        $('.'+element+' [name=end]').val("<?=date('Y-m-d',strtotime('last day of last month'));?>");
    }
}

function airdatepicker()
{
    const start = $('[name="start"]'), end = $('[name="end"]'), 
        start2 = $('[name="start2"]'), end2 = $('[name="end2"]'),
        start3 = $('[name="start3"]'), end3 = $('[name="end3"]'),
        start4 = $('[name="start4"]'), end4 = $('[name="end4"]'),
        start5 = $('[name="start5"]'), end5 = $('[name="end5"]'),
        start6 = $('[name="start6"]'), end6 = $('[name="end6"]'),
        start2024 = $('[name="start2024"]'), end2024 = $('[name="end2024"]'),
        startLast = $('[name="startLast"]'), endLast = $('[name="endLast"]'),
        ucreated = $('[name="ucreated"]'), settledate = $('[name="settledate"]'),
        startTime = $('[name="startTime"]'), endTime = $('[name="endTime"]');

    start.datepicker({
        autoClose: true,
        changeMonth: true,
        changeYear: true,
        language: '<?=$_SESSION['lang']=='cn' || $_SESSION['lang']=='zh' ? 'zh' : 'en'?>',
        dateFormat: 'yyyy-mm-dd',
        maxDate: new Date(),
        todayButton: new Date(),
        clearButton: true
    });
    
    end.datepicker({
        autoClose: true,
        changeMonth: true,
        changeYear: true,
        language: '<?=$_SESSION['lang']=='cn' || $_SESSION['lang']=='zh' ? 'zh' : 'en'?>',
        dateFormat: 'yyyy-mm-dd',
        maxDate: new Date(),
        todayButton: new Date(),
        clearButton: true
    });

    start2.datepicker({
        onSelect: function(fd, date){
            let endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 7);
            end2.data('datepicker').update({
                minDate: date,
                maxDate: endDate
            });
            end2.focus();
        },
        // onHide: function(fd, date) {
        //     start.data('datepicker').clear();
        // },
        autoClose: true,
        changeMonth: true,
        changeYear: true,
        language: '<?=$_SESSION['lang']=='cn' || $_SESSION['lang']=='zh' ? 'zh' : 'en'?>',
        dateFormat: 'yyyy-mm-dd',
        todayButton: new Date(),
        clearButton: true,
        
    });

    end2.datepicker({
        // onSelect: function(fd, date){
        //     start.data('datepicker').update('maxDate', date);
        // },
        // onHide: function(fd, date) {
        //     end.data('datepicker').clear();
        // },
        onShow: function(fd, date) {
            end2.data('datepicker').clear();
        },
        autoClose: true,
        changeMonth: true,
        changeYear: true,
        language: '<?=$_SESSION['lang']=='cn' || $_SESSION['lang']=='zh' ? 'zh' : 'en'?>',
        dateFormat: 'yyyy-mm-dd',
        todayButton: new Date(),
        clearButton: true
    });

    start3.datepicker({
        onSelect: function(fd, date){
            let endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 7);
            end3.data('datepicker').update({
                minDate: date,
                maxDate: endDate
            });
            end3.focus();
        },
        // onHide: function(fd, date) {
        //     start.data('datepicker').clear();
        // },
        autoClose: true,
        changeMonth: true,
        changeYear: true,
        language: '<?=$_SESSION['lang']=='cn' || $_SESSION['lang']=='zh' ? 'zh' : 'en'?>',
        dateFormat: 'yyyy-mm-dd',
        todayButton: new Date(),
        clearButton: true,
        
    });

    end3.datepicker({
        // onSelect: function(fd, date){
        //     start.data('datepicker').update('maxDate', date);
        // },
        // onHide: function(fd, date) {
        //     end.data('datepicker').clear();
        // },
        onShow: function(fd, date) {
            end3.data('datepicker').clear();
        },
        autoClose: true,
        changeMonth: true,
        changeYear: true,
        language: '<?=$_SESSION['lang']=='cn' || $_SESSION['lang']=='zh' ? 'zh' : 'en'?>',
        dateFormat: 'yyyy-mm-dd',
        todayButton: new Date(),
        clearButton: true
    });

    start4.datepicker({
        onSelect: function(fd, date){
            let endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 7);
            end4.data('datepicker').update({
                minDate: date,
                maxDate: endDate
            });
            end4.focus();
        },
        // onHide: function(fd, date) {
        //     start.data('datepicker').clear();
        // },
        autoClose: true,
        changeMonth: true,
        changeYear: true,
        language: '<?=$_SESSION['lang']=='cn' || $_SESSION['lang']=='zh' ? 'zh' : 'en'?>',
        dateFormat: 'yyyy-mm-dd',
        todayButton: new Date(),
        clearButton: true,
        
    });

    end4.datepicker({
        // onSelect: function(fd, date){
        //     start.data('datepicker').update('maxDate', date);
        // },
        // onHide: function(fd, date) {
        //     end.data('datepicker').clear();
        // },
        onShow: function(fd, date) {
            end4.data('datepicker').clear();
        },
        autoClose: true,
        changeMonth: true,
        changeYear: true,
        language: '<?=$_SESSION['lang']=='cn' || $_SESSION['lang']=='zh' ? 'zh' : 'en'?>',
        dateFormat: 'yyyy-mm-dd',
        todayButton: new Date(),
        clearButton: true
    });

    start5.datepicker({
        autoClose: true,
        changeMonth: true,
        changeYear: true,
        language: '<?=$_SESSION['lang']=='cn' || $_SESSION['lang']=='zh' ? 'zh' : 'en'?>',
        dateFormat: 'yyyy-mm-dd',
        todayButton: new Date(),
        clearButton: true
    });
    
    end5.datepicker({
        autoClose: true,
        changeMonth: true,
        changeYear: true,
        language: '<?=$_SESSION['lang']=='cn' || $_SESSION['lang']=='zh' ? 'zh' : 'en'?>',
        dateFormat: 'yyyy-mm-dd',
        todayButton: new Date(),
        clearButton: true
    });

    start6.datepicker({
        // onSelect: function(fd, date){
        //     let endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 7);
        //     end6.data('datepicker').update({
        //         minDate: date,
        //         maxDate: endDate
        //     });
        //     end6.focus();
        // },
        // onHide: function(fd, date) {
        //     start.data('datepicker').clear();
        // },
        autoClose: true,
        changeMonth: false,
        changeYear: false,
        language: '<?=$_SESSION['lang']=='cn' || $_SESSION['lang']=='zh' ? 'zh' : 'en'?>',
        dateFormat: 'yyyy-mm-dd',
        // todayButton: new Date(),
        clearButton: true,
        minDate: new Date('2024-01-01'),
    });

    end6.datepicker({
        // onSelect: function(fd, date){
        //     start.data('datepicker').update('maxDate', date);
        // },
        // onHide: function(fd, date) {
        //     end.data('datepicker').clear();
        // },
        // onShow: function(fd, date) {
        //     end6.data('datepicker').clear();
        // },
        autoClose: true,
        changeMonth: false,
        changeYear: false,
        language: '<?=$_SESSION['lang']=='cn' || $_SESSION['lang']=='zh' ? 'zh' : 'en'?>',
        dateFormat: 'yyyy-mm-dd',
        // todayButton: new Date(),
        clearButton: true,
        minDate: new Date('2024-01-01'),
    });

    start2024.datepicker({
        // onSelect: function(fd, date){
        //     let endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 7);
        //     end6.data('datepicker').update({
        //         minDate: date,
        //         maxDate: endDate
        //     });
        //     end6.focus();
        // },
        // onHide: function(fd, date) {
        //     start.data('datepicker').clear();
        // },
        autoClose: true,
        changeMonth: false,
        changeYear: false,
        language: '<?=$_SESSION['lang']=='cn' || $_SESSION['lang']=='zh' ? 'zh' : 'en'?>',
        dateFormat: 'yyyy-mm-dd',
        // todayButton: new Date(),
        clearButton: true,
        minDate: new Date('2024-01-01'),
    });

    end2024.datepicker({
        // onSelect: function(fd, date){
        //     start.data('datepicker').update('maxDate', date);
        // },
        // onHide: function(fd, date) {
        //     end.data('datepicker').clear();
        // },
        // onShow: function(fd, date) {
        //     end6.data('datepicker').clear();
        // },
        autoClose: true,
        changeMonth: false,
        changeYear: false,
        language: '<?=$_SESSION['lang']=='cn' || $_SESSION['lang']=='zh' ? 'zh' : 'en'?>',
        dateFormat: 'yyyy-mm-dd',
        // todayButton: new Date(),
        clearButton: true,
        minDate: new Date('2024-01-01'),
    });

    startLast.datepicker({
        // onSelect: function(fd, date){
        //     let endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 7);
        //     endLast.data('datepicker').update({
        //         minDate: date,
        //         maxDate: endDate
        //     });
        //     endLast.focus();
        // },
        // onHide: function(fd, date) {
        //     start.data('datepicker').clear();
        // },
        autoClose: true,
        changeMonth: false,
        changeYear: false,
        language: '<?=$_SESSION['lang']=='cn' || $_SESSION['lang']=='zh' ? 'zh' : 'en'?>',
        dateFormat: 'yyyy-mm-dd',
        // todayButton: new Date(),
        clearButton: true,
        maxDate: new Date('2023-12-31'),
    });

    endLast.datepicker({
        // onSelect: function(fd, date){
        //     start.data('datepicker').update('maxDate', date);
        // },
        // onHide: function(fd, date) {
        //     end.data('datepicker').clear();
        // },
        // onShow: function(fd, date) {
        //     endLast.data('datepicker').clear();
        // },
        autoClose: true,
        changeMonth: false,
        changeYear: false,
        language: '<?=$_SESSION['lang']=='cn' || $_SESSION['lang']=='zh' ? 'zh' : 'en'?>',
        dateFormat: 'yyyy-mm-dd',
        // todayButton: new Date(),
        clearButton: true,
        maxDate: new Date('2023-12-31'),
    });

    ucreated.datepicker({
        autoClose: true,
        changeMonth: true,
        changeYear: true,
        language: '<?=$_SESSION['lang']=='cn' || $_SESSION['lang']=='zh' ? 'zh' : 'en'?>',
        dateFormat: 'yyyy-mm-dd',
        maxDate: new Date(),
        todayButton: new Date(),
        clearButton: true
    });

    settledate.datepicker({
        autoClose: true,
        changeMonth: true,
        changeYear: true,
        language: '<?=$_SESSION['lang']=='cn' || $_SESSION['lang']=='zh' ? 'zh' : 'en'?>',
        dateFormat: 'yyyy-mm-dd',
        maxDate: new Date(),
        todayButton: new Date(),
        clearButton: true
    });

    startTime.datepicker({
        autoClose: true,
        timepicker: true,
        onlyTimepicker: true,
        language: '<?=$_SESSION['lang']=='cn' || $_SESSION['lang']=='zh' ? 'zh' : 'en'?>',
        timeFormat: 'hh:ii',
        clearButton: true
    });
    
    endTime.datepicker({
        autoClose: true,
        timepicker: true,
        onlyTimepicker: true,
        language: '<?=$_SESSION['lang']=='cn' || $_SESSION['lang']=='zh' ? 'zh' : 'en'?>',
        timeFormat: 'hh:ii',
        clearButton: true
    });
}

function generalLoading()
{
    swal.fire({
        title: '<?=lang('Label.loading');?>...',
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
        customClass: {
            container: 'bg-major'
        }
    });
}
</script>