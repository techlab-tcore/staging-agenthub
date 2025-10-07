<section class="card border-light">
    <h4 class="card-header p-3 bg-white fs-4"><?=$secTitle;?></h4>
    <div class="card-body">
        <article class="card-text p-3">
            <table id="adminTable" class="w-100 table table-sm table-bordered table-hover">
            <thead class="table-style">
            <tr>
            <th>Username</th>
            <th>#UID</th>
            <th class="none">Name</th>
            <th class="none">Contact</th>
            <th class="none">Telegram</th>
            <th class="none">Remark</th>
            <th class="none">Last Login</th>
            <th class="none">Created Date</th>
            <th>Currency</th>
            </tr>
            </thead>
            <tbody></tbody>
            </table>
        </article>
    </div>
</section>

<section class="modal fade modal-currencyRegis" id="modal-currencyRegis" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-currencyRegis" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Register By Currency</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate','autocomplete'=>'off'], ['uid'=>'']);?>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label">Api Url</label>
                    <div class="col-8">
                        <input type="text" class="form-control" name="apiurlregis" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label">Lobby Url</label>
                    <div class="col-8">
                        <input type="text" class="form-control" name="lobbyurlregis" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label">Currency</label>
                    <div class="col-8">
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
                <div class="text-end">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary bg-gradient">Submit</button>
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
                <h5 class="modal-title">Set Score</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate','autocomplete'=>'off'], ['uid'=>'','currencycode'=>'']);?>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label">Username</label>
                    <div class="col-8">
                        <input type="text" class="form-control-plaintext" name="username" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label">Currency</label>
                    <div class="col-8">
                        <input type="text" class="form-control-plaintext" name="usercurrency" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label">Score</label>
                    <div class="col-8">
                        <small class="fw-bold">Current Score <span class="badge bg-warning rounded-pill personbalance">0</span></small>
                        <small class="fw-bold d-block mb-1">Set Score <span class="badge bg-light rounded-pill text-dark">Max.Value: <span class="userbalance">&infin;</span></span></small>
                        <input type="number" step="any" class="form-control" name="amount" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4 col-form-label">Remark</label>
                    <div class="col-8">
                        <textarea class="form-control" name="remark"></textarea>
                    </div>
                </div>
                <div class="text-end">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary bg-gradient">Submit</button>
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
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate'], ['uid'=>'']);?>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label">Username</label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <input type="text" class="form-control-plaintext" name="username" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label">New Password</label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <div class="input-group">
                            <input type="password" class="form-control" pattern=".{6,}" name="newpass" id="newpass" placeholder="Min.6 characters">
                            <button type="button" class="btn btn-primary bg-gradient" data-bs-toggle="button" autocomplete="off" onclick="showhidepass('newpass')">Show</button>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label">Name</label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <input type="text" class="form-control" name="fname" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label">Contact</label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <input type="text" class="form-control" name="contact">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label">Telegram</label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <input type="text" class="form-control" name="telegram">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-lg-4 col-md-4 col-12 col-form-label">Remark</label>
                    <div class="col-lg-8 col-md-8 col-12">
                        <textarea class="form-control" name="remark"></textarea>
                    </div>
                </div>
                <div class="text-end">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary bg-gradient">Submit</button>
                </div>
                <?=form_close();?>
            </div>
        </div>
    </div>
</section>

<section class="modal fade modal-adminLink" id="modal-adminLink" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-adminLink" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-lg-down modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Admin Link - <span class="usercurrency"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['class'=>'form-validation', 'novalidate'=>'novalidate'],['uid'=>'', 'currencycode'=>'']);?>
                <dl class="row">
                    <dd class="col-xl-4 col-lg-4 col-md-4 col-12">
                        <div class="mb-3">
                            <label>Api URL</label>
                            <input type="text" class="form-control" name="apiurl" required>
                        </div>
                        <div class="mb-3">
                            <label>Lobby URL</label>
                            <input type="text" class="form-control" name="lobbyurl" required>
                        </div>
                        <div class="mb-3">
                            <label class="d-block">Business Model</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="mode" id="mode_711" value="1" required>
                                <label class="form-check-label" for="mode_711">711</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="mode" id="mode_ps" value="2">
                                <label class="form-check-label" for="mode_ps">Profit Sharing</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="mode" id="mode_pt" value="3">
                                <label class="form-check-label" for="mode_pt">Position Taking</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="d-block">Game Provider Fee Mode</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gpfee" id="gpfee_share" value="1" required>
                                <label class="form-check-label" for="gpfee_share">Agent Sharing (PT)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gpfee" id="gpfee_comp" value="2">
                                <label class="form-check-label" for="gpfee_comp">Company</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="d-block">Mobile.No Verification</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="mobileveri" id="mveri_yes" value="1" required>
                                <label class="form-check-label" for="mveri_yes">Enable</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="mobileveri" id="mveri_no" value="2">
                                <label class="form-check-label" for="mveri_no">Disable</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="d-block">Payment Deduct Upline</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="paydeductupline" id="pdupline_yes" value="true" required>
                                <label class="form-check-label" for="pdupline_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="paydeductupline" id="pdupline_no" value="false">
                                <label class="form-check-label" for="pdupline_no">No</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="d-block">Withdrawal Check Turnover</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="checkturnover" id="checkturnover_yes" value="true" required>
                                <label class="form-check-label" for="checkturnover_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="checkturnover" id="checkturnover_no" value="false">
                                <label class="form-check-label" for="checkturnover_no">No</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Multi-Promotion</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="multipromo" id="mp_yes" value="true" required>
                                    <label class="form-check-label" for="mp_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="multipromo" id="mp_no" value="false">
                                    <label class="form-check-label" for="mp_no">No</label>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Min.Turnover Clear</label>
                                <input type="number" step="any" min="0" class="form-control" name="minclear" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>No.of Mobile Allowed</label>
                                <input type="number" step="any" min="0" class="form-control" name="mobilecount" required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>No.of ICName Allowed</label>
                                <input type="number" step="any" min="0" class="form-control" name="realnamecount" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Affiliate Time Allowed</label>
                            <div class="input-group">
                                <input type="number" step="any" min="0" class="form-control" placeholder="Username" name="affhour" required>
                                <input type="number" step="any" min="0" class="form-control" placeholder="Username" name="affmin" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Check BankCard</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="uniquebankcard" id="ubc_yes" value="1" checked required>
                                    <label class="form-check-label" for="ubc_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="uniquebankcard" id="ubc_no" value="2">
                                    <label class="form-check-label" for="ubc_no">No</label>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>No.of Bank Card Allowed</label>
                                <input type="number" step="any" min="0" class="form-control" name="bankcardcount" value="1" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>No.of Game Account</label>
                                <input type="number" step="any" min="0" class="form-control" name="numgameacct" required>
                            </div>
                        </div>
                    </dd>
                    <dd class="col-xl-4 col-lg-4 col-md-4 col-12">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>No.of Daily Withdrawal</label>
                                <input type="number" min="0" class="form-control" name="numdailywithdrawal" required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Exceed Withdrawal Charges</label>
                                <div class="input-group">
                                    <input type="text" type="number" step="any" min="0" class="form-control" name="exceedwithdrawalcharges" required>
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Min.Exceed Withdrawal Charges</label>
                                <input type="number" step="any" min="0" class="form-control" name="minexceedwithdrawalcharges" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Rebate Cal.Types</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rebcal" id="rebcal_bet" value="2" required>
                                    <label class="form-check-label" for="rebcal_bet">Turnover (Stake)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rebcal" id="rebcal_effect" value="1">
                                    <label class="form-check-label" for="rebcal_effect">Effective Bet</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rebcal" id="rebcal_deposit" value="3">
                                    <label class="form-check-label" for="rebcal_deposit">Deposit</label>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Affiliate Cal.Types</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="affcal" id="affcal_bet" value="2" required>
                                    <label class="form-check-label" for="affcal_bet">Turnover (Stake)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="affcal" id="affcal_effect" value="1">
                                    <label class="form-check-label" for="affcal_effect">Effective Bet</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="affcal" id="affcal_deposit" value="3">
                                    <label class="form-check-label" for="affcal_deposit">Deposit</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Promo Cal.Types</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="promocal" id="promocal_bet" value="2" required>
                                    <label class="form-check-label" for="promocal_bet">Turnover (Stake)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="promocal" id="promocal_effect" value="1">
                                    <label class="form-check-label" for="promocal_effect">Effective Bet</label>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>AgentComm. Cal.Types</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="agcommcal" id="agcommcal_bet" value="2" required>
                                    <label class="form-check-label" for="agcommcal_bet">Turnover (Stake)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="agcommcal" id="agcommcal_effect" value="1">
                                    <label class="form-check-label" for="agcommcal_effect">Effective Bet</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>PS Cal.Types</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pscal" id="pscal_bet" value="2" required>
                                    <label class="form-check-label" for="pscal_bet">Turnover (Stake)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pscal" id="pscal_effect" value="1">
                                    <label class="form-check-label" for="pscal_effect">Effective Bet</label>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>PTComm. Cal.Types</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ptcommcal" id="ptcommcal_bet" value="2" required>
                                    <label class="form-check-label" for="ptcommcal_bet">Turnover (Stake)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ptcommcal" id="ptcommcal_effect" value="1">
                                    <label class="form-check-label" for="ptcommcal_effect">Effective Bet</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ptcommcal" id="ptcommcal_deposit" value="3">
                                    <label class="form-check-label" for="ptcommcal_deposit">Deposit</label>
                                </div>
                            </div>
                        </div>
                    </dd>
                    <dd class="col-xl-4 col-lg-4 col-md-4 col-12">
                        <h5 class="text-primary">Deposit Comm.</h5>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Min.Deposit</label>
                                <input type="number" step="any" min="0" class="form-control" name="depcomm_mindeposit">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Commission</label>
                                <div class="input-group mb-3">
                                    <input type="number" step="any" min="0" class="form-control" name="depcomm_rate">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Chip</label>
                                <div class="input-group mb-3">
                                    <input type="number" step="any" min="0" class="form-control" name="depcomm_chippercent">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Chip Group</label>
                                <input type="text" class="form-control" name="depcomm_chipgroup">
                            </div>
                        </div>
                        <h5 class="text-primary">Referral Comm.</h5>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>No.of Member</label>
                                <input type="number" step="any" min="0" class="form-control" name="refcomm_count">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Min.Deposit</label>
                                <input type="number" step="any" min="0" class="form-control" name="refcomm_mindeposit">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Cash Reward</label>
                                <input type="number" step="any" min="0" class="form-control" name="refcomm_cash">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Chip Reward</label>
                                <input type="number" step="any" min="0" class="form-control" name="refcomm_chip">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Chip Group</label>
                                <input type="text" class="form-control" name="refcomm_chipgroup">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="d-block">Trigger Once</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="refcomm_once" id="refcomm_yes" value="true" required>
                                    <label class="form-check-label" for="refcomm_yes">Enable</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="refcomm_once" id="refcomm_no" value="false">
                                    <label class="form-check-label" for="refcomm_no">Disable</label>
                                </div>
                            </div>
                        </div>
                    </dd>
                </dl>
                <hr>
                <dl class="row">
                    <!--Front End SMS-->
                    <dd class="col-xl-4 col-lg-4 col-md-4 col-12">
                        <h5 class="text-primary">SMS Config (Front End)</h5>
                        <div class="mb-3">
                            <label class="d-block">SMS Types</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="smstype" id="sms_1" value="1" required>
                                <label class="form-check-label" for="sms_1">JackySMS</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="smstype" id="sms_2" value="2">
                                <label class="form-check-label" for="sms_2">SMS360</label>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                            <label>Maxsend</label>
                            <input type="number" step="any" min="0" class="form-control" name="maxsend">
                        </div>
                        <div class="mb-3 text-primary">MYR</div>
                        <div class="mb-3">
                            <label>SMS URL</label>
                            <input type="text" class="form-control" name="myr_smsurl">
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Username</label>
                                <input type="text" class="form-control" name="myr_smsuser">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Password</label>
                                <input type="text" class="form-control" name="myr_smspass">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label class="d-block">Whatsapp OTP</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="myr_whatsapp" id="myrw_true" value="true">
                                    <label class="form-check-label" for="myrw_true">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="myr_whatsapp" id="myrw_false" value="false">
                                    <label class="form-check-label" for="myrw_false">No</label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3 text-primary">SGD</div>
                        <div class="mb-3">
                            <label>SMS URL</label>
                            <input type="text" class="form-control" name="sgd_smsurl">
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Username</label>
                                <input type="text" class="form-control" name="sgd_smsuser">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Password</label>
                                <input type="text" class="form-control" name="sgd_smspass">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label class="d-block">Whatsapp OTP</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sgd_whatsapp" id="sgdw_true" value="true">
                                    <label class="form-check-label" for="sgdw_true">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sgd_whatsapp" id="sgdw_false" value="false">
                                    <label class="form-check-label" for="sgdw_false">No</label>
                                </div>
                            </div>
                        </div>
                    </dd>
                    <!--Back End SMS-->
                    <dd class="col-xl-4 col-lg-4 col-md-4 col-12">
                        <h5 class="text-primary">SMS Config (Back End)</h5>
                        <div class="mb-3">
                            <label class="d-block">SMS Types</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="bsmstype" id="bsms_1" value="1">
                                <label class="form-check-label" for="bsms_1">JackySMS</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="bsmstype" id="bsms_2" value="2">
                                <label class="form-check-label" for="bsms_2">SMS360</label>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                            <label>Maxsend</label>
                            <input type="number" step="any" min="0" class="form-control" name="bmaxsend">
                        </div>
                        <div class="mb-3 text-primary">MYR</div>
                        <div class="mb-3">
                            <label>SMS URL</label>
                            <input type="text" class="form-control" name="bmyr_smsurl">
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Username</label>
                                <input type="text" class="form-control" name="bmyr_smsuser">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Password</label>
                                <input type="text" class="form-control" name="bmyr_smspass">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label class="d-block">Whatsapp OTP</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="bmyr_whatsapp" id="bmyrw_true" value="true">
                                    <label class="form-check-label" for="bmyrw_true">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="bmyr_whatsapp" id="bmyrw_false" value="false">
                                    <label class="form-check-label" for="bmyrw_false">No</label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3 text-primary">SGD</div>
                        <div class="mb-3">
                            <label>SMS URL</label>
                            <input type="text" class="form-control" name="bsgd_smsurl">
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Username</label>
                                <input type="text" class="form-control" name="bsgd_smsuser">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Password</label>
                                <input type="text" class="form-control" name="bsgd_smspass">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label class="d-block">Whatsapp OTP</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="bsgd_whatsapp" id="bsgdw_true" value="true">
                                    <label class="form-check-label" for="bsgdw_true">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="bsgd_whatsapp" id="bsgdw_false" value="false">
                                    <label class="form-check-label" for="bsgdw_false">No</label>
                                </div>
                            </div>
                        </div>
                    </dd>
                </dl>
                <hr>
                <dl class="row">
                    <dd class="col-xl-4 col-lg-4 col-md-4 col-12">
                        <h5 class="text-primary">Daily Free Reward</h5>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="d-block">Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="dailyfree" id="dfr_true" value="true">
                                    <label class="form-check-label" for="dfr_true">On</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="dailyfree" id="dfr_false" value="false">
                                    <label class="form-check-label" for="dfr_false">Off</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="d-block">Include Today</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="includetoday" id="intdy_true" value="true">
                                    <label class="form-check-label" for="intdy_true">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="includetoday" id="intdy_false" value="false">
                                    <label class="form-check-label" for="intdy_false">No</label>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label>Amount</label>
                                <input type="number" step="any" min="0" class="form-control" name="dailyfreeamount">
                            </div>
                            <div class="mb-3">
                                <label>Max.Balance</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="las la-coins"></i></span>
                                    <input type="number" step="any" min="0" class="form-control" name="maxbalance" value="0" required>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Game Provider</label>
                                <select class="form-select" name="gpid" id="gameprovider"></select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Game Category</label>
                                <select class="form-select" name="gcate" id="cateList"></select>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="d-block">Rewarded Wallet</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="reward2wallet" id="rwdw_cash" value="1">
                                    <label class="form-check-label" for="rwdw_cash">Cash</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="reward2wallet" id="rwdw_chip" value="3">
                                    <label class="form-check-label" for="rwdw_chip">Chip</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="reward2wallet" id="rwdw_fortunetoken" value="4">
                                    <label class="form-check-label" for="rwdw_fortunetoken">Fortune Token</label>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Chip Group</label>
                                <input type="text" class="form-control" name="dfchipgroup">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="d-block">Deduct From Upline</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="deductdffrmupline" id="dffupline_yes" value="true">
                                    <label class="form-check-label" for="dffupline_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="deductdffrmupline" id="dffupline_no" value="false">
                                    <label class="form-check-label" for="dffupline_no">No</label>
                                </div>
                            </div>
                        </div>
                    </dd>
                    <dd class="col-xl-4 col-lg-4 col-md-4 col-12">
                        <h5 class="text-primary">Affiliate Share Reward</h5>
                        <div class="col-12 mb-3">
                            <label class="d-block">Status</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sharedreward" id="sr_true" value="true">
                                <label class="form-check-label" for="sr_true">On</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sharedreward" id="sr_false" value="false">
                                <label class="form-check-label" for="sr_false">Off</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="d-block">Rewarded Person</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affsharetoself" id="affsrwdto_true" value="true">
                                    <label class="form-check-label" for="affsrwdto_true">Introducer</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affsharetoself" id="affsrwdto_false" value="false">
                                    <label class="form-check-label" for="affsrwdto_false">New Member</label>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label>Amount</label>
                                <input type="number" step="any" min="0" class="form-control" name="affshareamount">
                            </div>
                            <div class="mb-3">
                                <label>Max.Balance</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="las la-coins"></i></span>
                                    <input type="number" step="any" min="0" class="form-control" name="affreg_maxbalance" value="0" required>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Game Provider</label>
                                <select class="form-select" name="affsharegpid" id="gameprovider2"></select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Game Category</label>
                                <select class="form-select" name="affsharegcate" id="cateList2"></select>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="d-block">Rewarded Wallet</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affshare2wallet" id="affs_cash" value="1">
                                    <label class="form-check-label" for="affs_cash">Cash</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affshare2wallet" id="affs_chip" value="3">
                                    <label class="form-check-label" for="affs_chip">Chip</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affshare2wallet" id="affs_fortunetoken" value="4">
                                    <label class="form-check-label" for="affs_fortunetoken">Fortune Token</label>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Chip Group</label>
                                <input type="text" class="form-control" name="affsharechipgroup">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="d-block">Deduct From Upline</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affsharedeductdffrmupline" id="affshareupline_yes" value="true">
                                    <label class="form-check-label" for="affshareupline_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affsharedeductdffrmupline" id="affshareupline_no" value="false">
                                    <label class="form-check-label" for="affshareupline_no">No</label>
                                </div>
                            </div>
                        </div>
                    </dd>
                    <dd class="col-xl-4 col-lg-4 col-md-4 col-12">
                        <h5 class="text-primary">Affiliate Share Reward</h5>
                        <div class="col-12 mb-3">
                            <label class="d-block">Status</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sharedreward2" id="sr_true2" value="true">
                                <label class="form-check-label" for="sr_true2">On</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sharedreward2" id="sr_false2" value="false">
                                <label class="form-check-label" for="sr_false2">Off</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="d-block">Rewarded Person</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affsharetoself2" id="affsrwdto_true2" value="true">
                                    <label class="form-check-label" for="affsrwdto_true2">Introducer</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affsharetoself2" id="affsrwdto_false2" value="false">
                                    <label class="form-check-label" for="affsrwdto_false2">New Member</label>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label>Amount</label>
                                <input type="number" step="any" min="0" class="form-control" name="affshareamount2">
                            </div>
                            <div class="mb-3">
                                <label>Max.Balance</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="las la-coins"></i></span>
                                    <input type="number" step="any" min="0" class="form-control" name="affreg_maxbalance2" value="0" required>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Game Provider</label>
                                <select class="form-select" name="affsharegpid2" id="gameprovider3"></select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Game Category</label>
                                <select class="form-select" name="affsharegcate2" id="cateList3"></select>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="d-block">Rewarded Wallet</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affshare2wallet2" id="affs_cash2" value="1">
                                    <label class="form-check-label" for="affs_cash2">Cash</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affshare2wallet2" id="affs_chip2" value="3">
                                    <label class="form-check-label" for="affs_chip2">Chip</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affshare2wallet2" id="affs_fortunetoken2" value="4">
                                    <label class="form-check-label" for="affs_fortunetoken2">Fortune Token</label>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
                                <label>Chip Group</label>
                                <input type="text" class="form-control" name="affsharechipgroup2">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="d-block">Deduct From Upline</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affsharedeductdffrmupline2" id="affshareupline_yes2" value="true">
                                    <label class="form-check-label" for="affshareupline_yes2">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affsharedeductdffrmupline2" id="affshareupline_no2" value="false">
                                    <label class="form-check-label" for="affshareupline_no2">No</label>
                                </div>
                            </div>
                        </div>
                    </dd>
                </dl>
                <div class="text-end">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary bg-gradient">Submit</button>
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

    var pageindex = 1, debug = false;
    const adminTable = $('#adminTable').DataTable({
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
        ajax: function(data, callback, settings) {
            if (settings._iRecordsTotal == 0) {
                pageindex = 1;
            } else {
                var pageindex = settings._iDisplayStart/settings._iDisplayLength + 1;
            }
            
            var payload = JSON.stringify({
                pageindex: pageindex,
                rowperpage: data.length
            });
            $.ajax({
                url: '/list/administrator',
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
        //aoColumnDefs: [{
        //    aTargets: [2],
        //    render: function ( data, type, row ) {
        //        return parseFloat(data).toFixed(5).replace(/(\.\d{2})\d*/, "$1").replace(/(\d)(?=(\d{3})+\b)/g, "$1,");
        //    }
        //}]
    });

    const credittransferEvent = document.getElementById('modal-creditTransfer');
    credittransferEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
        $('.modal-creditTransfer form .personbalance').html('0');
    });

    const modifyEvent = document.getElementById('modal-modify');
    modifyEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });

    $('.modal-creditTransfer form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            swal.fire({
                title: 'Transferring...',
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                customClass: {
                    container: 'bg-major'
                }
            });

            $('.modal-creditTransfer form [type=submit]').prop('disabled',true);

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
                    swal.fire("Success!", obj.message, "success").then(() => { $('#adminTable').DataTable().ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-creditTransfer').modal('toggle');
                $('.modal-creditTransfer form [type=submit]').prop('disabled',false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    const adminlinkEvent = document.getElementById('modal-adminLink');
    adminlinkEvent.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
        $('#gameprovider').html('');
        $('#gameprovider2').html('');
        $('#cateList').html('');
        $('#cateList2').html('');
        $('.modal-adminLink .usercurrency').html('');
    });

    $('.modal-adminLink form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            swal.fire({
                title: 'Updating...',
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                customClass: {
                    container: 'bg-major'
                }
            });

            $('.modal-adminLink form [type=submit]').prop('disabled',true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/administrator/api-config/modify', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                // console.log(obj);
                if( obj.code == 1 ) {
                    swal.fire("Success!", obj.message, "success");
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-adminLink').modal('hide');
                $('.modal-adminLink form [type=submit]').prop('disabled',false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });

    const modifyCurrencyRegis = document.getElementById('modal-currencyRegis');
    modifyCurrencyRegis.addEventListener('hidden.bs.modal', function (event) {
        $('.modal').find('form').removeClass('was-validated');
        $('.modal').find('form').trigger('reset');
    });

    $('.modal-currencyRegis form').on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            swal.fire({
                title: 'Transferring...',
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                customClass: {
                    container: 'bg-major'
                }
            });

            $('.modal-currencyRegis form [type=submit]').prop('disabled',true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
            });

            $.post('/user/register/bycurrency', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                // console.log(obj);
                if( obj.code == 1 ) {
                    swal.fire("Success!", obj.message, "success").then(() => { $('#adminTable').DataTable().ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-currencyRegis').modal('toggle');
                $('.modal-currencyRegis form [type=submit]').prop('disabled',false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });
});

function registerByCurrency(uid)
{
    $('.modal-currencyRegis').modal('toggle');
    $('.modal-currencyRegis form [name=uid]').val(uid);
}

function adminLink(uid, currencyCode)
{
    $('.modal-adminLink').modal('toggle');
    $('.modal-adminLink .usercurrency').html(currencyCode);
    $('.modal-adminLink [name=currencycode]').val(currencyCode);

    gameProviderList('gameprovider',uid,currencyCode);
    getGameCategoryList('cateList',uid,currencyCode);

    gameProviderList('gameprovider2',uid,currencyCode);
    getGameCategoryList('cateList2',uid,currencyCode);

    gameProviderList('gameprovider3',uid,currencyCode);
    getGameCategoryList('cateList3',uid,currencyCode);

    var params = {};
    params['uid'] = uid;
    params['currencycode'] = currencyCode;
    $('.modal-adminLink [name=uid]').val(uid);

    $.post('/administrator/api-config', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            document.getElementsByName('apiurl')[0].value = obj.data.apiUrl;
            document.getElementsByName('lobbyurl')[0].value = obj.data.lobbyUrl;
            document.getElementsByName('mobilecount')[0].value = obj.data.mobileNoCount;
            document.getElementsByName('realnamecount')[0].value = obj.data.realNameCount;
            document.getElementsByName('affhour')[0].value = obj.data.affiliateControl.hour;
            document.getElementsByName('affmin')[0].value = obj.data.affiliateControl.minute;

            //Font End SMS
            document.getElementsByName('maxsend')[0].value = obj.data.smsInfo.maxsend;
            document.getElementsByName('myr_smsurl')[0].value = obj.data.smsInfo.myr_url;
            document.getElementsByName('myr_smsuser')[0].value = obj.data.smsInfo.myr_username;
            document.getElementsByName('myr_smspass')[0].value = obj.data.smsInfo.myr_password;
            document.getElementsByName('sgd_smsurl')[0].value = obj.data.smsInfo.sgd_url;
            document.getElementsByName('sgd_smsuser')[0].value = obj.data.smsInfo.sgd_username;
            document.getElementsByName('sgd_smspass')[0].value = obj.data.smsInfo.sgd_password;

            //Back End SMS
            document.getElementsByName('bmaxsend')[0].value = obj.data.smsInfo.bo_maxsend;
            //obj.data.smsInfo.bo_myr_url=='undefined' ? document.getElementsByName('bmyr_smsurl')[0].value = obj.data.smsInfo.bo_myr_url : document.getElementsByName('bmyr_smsurl')[0].value = "" ;
            obj.data.smsInfo.bo_myr_url=='undefined' ? document.getElementsByName('bmyr_smsurl')[0].value = "" : document.getElementsByName('bmyr_smsurl')[0].value = obj.data.smsInfo.bo_myr_url;
            obj.data.smsInfo.bo_myr_username=='undefined' ? document.getElementsByName('bmyr_smsuser')[0].value = "" : document.getElementsByName('bmyr_smsuser')[0].value = obj.data.smsInfo.bo_myr_username;
            obj.data.smsInfo.bo_myr_password=='undefined' ? document.getElementsByName('bmyr_smspass')[0].value = "" : document.getElementsByName('bmyr_smspass')[0].value = obj.data.smsInfo.bo_myr_password;
            obj.data.smsInfo.bo_sgd_url=='undefined' ? document.getElementsByName('bsgd_smsurl')[0].value = "" : document.getElementsByName('bsgd_smsurl')[0].value = obj.data.smsInfo.bo_sgd_url;
            obj.data.smsInfo.bo_sgd_username=='undefined' ? document.getElementsByName('bsgd_smsuser')[0].value = "" : document.getElementsByName('bsgd_smsuser')[0].value = obj.data.smsInfo.bo_sgd_username;
            obj.data.smsInfo.bo_sgd_password=='undefined' ? document.getElementsByName('bsgd_smspass')[0].value = "" : document.getElementsByName('bsgd_smspass')[0].value = obj.data.smsInfo.bo_sgd_password;

            document.getElementsByName('depcomm_mindeposit')[0].value = obj.data.topUpCommission.minDeposit;
            document.getElementsByName('depcomm_rate')[0].value = obj.data.topUpCommission.percentage;
            document.getElementsByName('depcomm_chippercent')[0].value = obj.data.topUpCommission.toWalletPercentage;
            document.getElementsByName('depcomm_chipgroup')[0].value = obj.data.topUpCommission.toGroupName;

            document.getElementsByName('refcomm_count')[0].value = obj.data.referralCommission.count;
            document.getElementsByName('refcomm_mindeposit')[0].value = obj.data.referralCommission.minDeposit;
            document.getElementsByName('refcomm_cash')[0].value = obj.data.referralCommission.toBalance;
            document.getElementsByName('refcomm_chip')[0].value = obj.data.referralCommission.toWallet;

            document.getElementsByName('minclear')[0].value = obj.data.clearTurnoverLeastAmount;

            document.getElementsByName('numdailywithdrawal')[0].value = obj.data.maxDailyWithdrawalCount;
            document.getElementsByName('exceedwithdrawalcharges')[0].value = obj.data.afterDailyWithdrawalCountChargesPercentage;
            document.getElementsByName('minexceedwithdrawalcharges')[0].value = obj.data.afterDailyWithdrawalCountMinCharges;

            document.getElementsByName('numgameacct')[0].value = obj.data.maxGameAccount;

            if( obj.data.mode==1 ) { $('.modal-adminLink [name=mode]#mode_711').prop('checked',true); }
            else if( obj.data.mode==2 ) { $('.modal-adminLink [name=mode]#mode_ps').prop('checked',true); }
            else if( obj.data.mode==3 ) { $('.modal-adminLink [name=mode]#mode_pt').prop('checked',true); }

            obj.data.ptRentPtCal==1 ? $('.modal-adminLink [name=gpfee]#gpfee_share').prop('checked',true) : $('.modal-adminLink [name=gpfee]#gpfee_comp').prop('checked',true);
            obj.data.checkMobile==1 ? $('.modal-adminLink [name=mobileveri]#mveri_yes').prop('checked',true) : $('.modal-adminLink [name=mobileveri]#mveri_no').prop('checked',true);
            obj.data.referralCommission.onlyOne==true ? $('.modal-adminLink [name=refcomm_once]#refcomm_yes').prop('checked',true) : $('.modal-adminLink [name=refcomm_once]#refcomm_no').prop('checked',true);

            //Front End SMS
            if( obj.data.smsInfo.myr_whatsapp=='true' )
            {
                $('.modal-adminLink [name=myr_whatsapp]#myrw_true').prop('checked',true);
            } 
            else if( obj.data.smsInfo.myr_whatsapp=='false' )
            {
                $('.modal-adminLink [name=myr_whatsapp]#myrw_false').prop('checked',true);
            }

            if( obj.data.smsInfo.sgd_whatsapp=='true' )
            {
                $('.modal-adminLink [name=sgd_whatsapp]#sgdw_true').prop('checked',true);
            } 
            else if( obj.data.smsInfo.sgd_whatsapp=='false' )
            {
                $('.modal-adminLink [name=sgd_whatsapp]#sgdw_false').prop('checked',true);
            }

            if( obj.data.smsInfo.type==1 )
            {
                $('.modal-adminLink [name=smstype]#sms_1').prop('checked',true);
            } 
            else if( obj.data.smsInfo.type==2 )
            {
                $('.modal-adminLink [name=smstype]#sms_2').prop('checked',true);
            }

            //Back End SMS
            if( obj.data.smsInfo.bo_myr_whatsapp=='true' )
            {
                $('.modal-adminLink [name=bmyr_whatsapp]#bmyrw_true').prop('checked',true);
            } 
            else if( obj.data.smsInfo.bo_myr_whatsapp=='false' )
            {
                $('.modal-adminLink [name=bmyr_whatsapp]#bmyrw_false').prop('checked',true);
            }

            if( obj.data.smsInfo.bo_sgd_whatsapp=='true' )
            {
                $('.modal-adminLink [name=bsgd_whatsapp]#bsgdw_true').prop('checked',true);
            } 
            else if( obj.data.smsInfo.bo_sgd_whatsapp=='false' )
            {
                $('.modal-adminLink [name=bsgd_whatsapp]#bsgdw_false').prop('checked',true);
            }

            if( obj.data.smsInfo.bo_type==1 )
            {
                $('.modal-adminLink [name=bsmstype]#bsms_1').prop('checked',true);
            } 
            else if( obj.data.smsInfo.bo_type==2 )
            {
                $('.modal-adminLink [name=bsmstype]#bsms_2').prop('checked',true);
            }

            obj.data.checkBankCard==1 ? $('.modal-adminLink [name=uniquebankcard]#ubc_yes').prop('checked',true) : $('.modal-adminLink [name=uniquebankcard]#ubc_no').prop('checked',true);
            document.getElementsByName('bankcardcount')[0].value = obj.data.bankCardCount;

            obj.data.checkTurnover==1 ? $('.modal-adminLink [name=checkturnover]#checkturnover_yes').prop('checked',true) : $('.modal-adminLink [name=checkturnover]#checkturnover_no').prop('checked',true);

            obj.data.paymentDeductUpline==true ? $('.modal-adminLink [name=paydeductupline]#pdupline_yes').prop('checked',true) : $('.modal-adminLink [name=paydeductupline]#pdupline_no').prop('checked',true);

            obj.data.multiPromotion==true ? $('.modal-adminLink [name=multipromo]#mp_yes').prop('checked',true) : $('.modal-adminLink [name=multipromo]#mp_no').prop('checked',true);

            obj.data.rebateCalculation[Object.keys(obj.data.rebateCalculation)[Object.keys(obj.data.rebateCalculation).length-1]]['type']==1 ? $('.modal-adminLink [name=rebcal]#rebcal_effect').prop('checked', true) : obj.data.rebateCalculation[Object.keys(obj.data.rebateCalculation)[Object.keys(obj.data.rebateCalculation).length-1]]['type']==2 ? $('.modal-adminLink [name=rebcal]#rebcal_bet').prop('checked', true) : $('.modal-adminLink [name=rebcal]#rebcal_deposit').prop('checked', true);

            obj.data.affiliateCalculation[Object.keys(obj.data.affiliateCalculation)[Object.keys(obj.data.affiliateCalculation).length-1]]['type']==1 ? $('.modal-adminLink [name=affcal]#affcal_effect').prop('checked', true) : obj.data.affiliateCalculation[Object.keys(obj.data.affiliateCalculation)[Object.keys(obj.data.affiliateCalculation).length-1]]['type']==2 ? $('.modal-adminLink [name=affcal]#affcal_bet').prop('checked', true) : $('.modal-adminLink [name=affcal]#affcal_deposit').prop('checked', true);

            obj.data.deductPromoCalculation[Object.keys(obj.data.deductPromoCalculation)[Object.keys(obj.data.deductPromoCalculation).length-1]]['type']==1 ? $('.modal-adminLink [name=promocal]#promocal_effect').prop('checked', true) : $('.modal-adminLink [name=promocal]#promocal_bet').prop('checked', true);

            obj.data.commissionCalculation[Object.keys(obj.data.commissionCalculation)[Object.keys(obj.data.commissionCalculation).length-1]]['type']==1 ? $('.modal-adminLink [name=agcommcal]#agcommcal_effect').prop('checked', true) : $('.modal-adminLink [name=agcommcal]#agcommcal_bet').prop('checked', true);

            obj.data.psSettlementCalculation[Object.keys(obj.data.psSettlementCalculation)[Object.keys(obj.data.psSettlementCalculation).length-1]]['type']==1 ? $('.modal-adminLink [name=pscal]#pscal_effect').prop('checked', true) : $('.modal-adminLink [name=pscal]#pscal_bet').prop('checked', true);

            obj.data.ptCommissionCalculation[Object.keys(obj.data.ptCommissionCalculation)[Object.keys(obj.data.ptCommissionCalculation).length-1]]['type']==1 ? $('.modal-adminLink [name=ptcommcal]#ptcommcal_effect').prop('checked', true) : obj.data.ptCommissionCalculation[Object.keys(obj.data.ptCommissionCalculation)[Object.keys(obj.data.ptCommissionCalculation).length-1]]['type']==2 ? $('.modal-adminLink [name=ptcommcal]#ptcommcal_bet').prop('checked', true) : $('.modal-adminLink [name=ptcommcal]#ptcommcal_deposit').prop('checked', true);

            let dailyFree = obj.data.freeCoin;
            if( dailyFree.length>0 ) {
                $('.modal-adminLink [name=dailyfree]#dfr_true').prop('checked',true);

                document.getElementsByName('maxbalance')[0].value = obj.data.freeCoin[0].maxBalance;
                document.getElementsByName('dailyfreeamount')[0].value = obj.data.freeCoin[0].amount;
                document.getElementsByName('dfchipgroup')[0].value = obj.data.freeCoin[0].toGroupName;

                obj.data.freeCoin[0].includeToday==true ? $('.modal-adminLink [name=includetoday]#intdy_true').prop('checked',true) : $('.modal-adminLink [name=includetoday]#intdy_false').prop('checked',true);

                obj.data.freeCoin[0].deductOwnAgent==true ? $('.modal-adminLink [name=deductdffrmupline]#dffupline_yes').prop('checked',true) : $('.modal-adminLink [name=deductdffrmupline]#dffupline_no').prop('checked',true);

                if( obj.data.freeCoin[0].gameProviderId!='' ) {
                    $('.modal-adminLink [name=gpid] option[value=' + btoa(obj.data.freeCoin[0].gameProviderId) + ']').attr('selected','selected');
                }

                if( obj.data.freeCoin[0].gameType!='' ) {
                    $('.modal-adminLink [name=gcate] option[value=' + obj.data.freeCoin[0].gameType + ']').attr('selected','selected');
                }

                if( obj.data.freeCoin[0].walletType==1 ) {
                    $('.modal-adminLink [name=reward2wallet]#rwdw_cash').prop('checked',true);
                } else if( obj.data.freeCoin[0].walletType==3 ) {
                    $('.modal-adminLink [name=reward2wallet]#rwdw_chip').prop('checked',true);
                } else if( obj.data.freeCoin[0].walletType==4 ) {
                    $('.modal-adminLink [name=reward2wallet]#rwdw_fortunetoken').prop('checked',true);
                }
            } else {
                $('.modal-adminLink [name=dailyfree]#dfr_false').prop('checked',true);
            }

            let shareReward = obj.data.refRegCommission;
            if( shareReward.length>0 ) {
                $('.modal-adminLink [name=sharedreward]#sr_true').prop('checked',true);

                document.getElementsByName('affreg_maxbalance')[0].value = obj.data.refRegCommission[0].maxBalance;
                document.getElementsByName('affshareamount')[0].value = obj.data.refRegCommission[0].amount;
                document.getElementsByName('affsharechipgroup')[0].value = obj.data.refRegCommission[0].toGroupName;

                obj.data.refRegCommission[0].toSelf==true ? $('.modal-adminLink [name=affsharetoself]#affsrwdto_true').prop('checked',true) : $('.modal-adminLink [name=affsharetoself]#affsrwdto_false').prop('checked',true);

                obj.data.refRegCommission[0].deductOwnAgent==true ? $('.modal-adminLink [name=affsharedeductdffrmupline]#affshareupline_yes').prop('checked',true) : $('.modal-adminLink [name=affsharedeductdffrmupline]#affshareupline_no').prop('checked',true);

                if( obj.data.refRegCommission[0].gameProviderId!='' ) {
                    $('.modal-adminLink [name=affsharegpid] option[value=' + btoa(obj.data.refRegCommission[0].gameProviderId) + ']').attr('selected','selected');
                }

                if( obj.data.refRegCommission[0].gameType!='' ) {
                    $('.modal-adminLink [name=affsharegcate] option[value=' + obj.data.refRegCommission[0].gameType + ']').attr('selected','selected');
                }

                if( obj.data.refRegCommission[0].walletType==1 ) {
                    $('.modal-adminLink [name=affshare2wallet]#affs_cash').prop('checked',true);
                } else if( obj.data.refRegCommission[0].walletType==3 ) {
                    $('.modal-adminLink [name=affshare2wallet]#affs_chip').prop('checked',true);
                } else if( obj.data.refRegCommission[0].walletType==4 ) {
                    $('.modal-adminLink [name=affshare2wallet]#affs_fortunetoken').prop('checked',true);
                }

                if( shareReward.length==2 ) {
                    $('.modal-adminLink [name=sharedreward2]#sr_true2').prop('checked',true);

                    document.getElementsByName('affreg_maxbalance2')[0].value = obj.data.refRegCommission[1].maxBalance;
                    document.getElementsByName('affshareamount2')[0].value = obj.data.refRegCommission[1].amount;
                    document.getElementsByName('affsharechipgroup2')[0].value = obj.data.refRegCommission[1].toGroupName;

                    obj.data.refRegCommission[1].toSelf==true ? $('.modal-adminLink [name=affsharetoself2]#affsrwdto_true2').prop('checked',true) : $('.modal-adminLink [name=affsharetoself2]#affsrwdto_false2').prop('checked',true);

                    obj.data.refRegCommission[1].deductOwnAgent==true ? $('.modal-adminLink [name=affsharedeductdffrmupline2]#affshareupline_yes2').prop('checked',true) : $('.modal-adminLink [name=affsharedeductdffrmupline2]#affshareupline_no2').prop('checked',true);

                    if( obj.data.refRegCommission[1].gameProviderId!='' ) {
                        $('.modal-adminLink [name=affsharegpid2] option[value=' + btoa(obj.data.refRegCommission[1].gameProviderId) + ']').attr('selected','selected');
                    }

                    if( obj.data.refRegCommission[1].gameType!='' ) {
                        $('.modal-adminLink [name=affsharegcate2] option[value=' + obj.data.refRegCommission[1].gameType + ']').attr('selected','selected');
                    }

                    if( obj.data.refRegCommission[1].walletType==1 ) {
                        $('.modal-adminLink [name=affshare2wallet2]#affs_cash2').prop('checked',true);
                    } else if( obj.data.refRegCommission[1].walletType==3 ) {
                        $('.modal-adminLink [name=affshare2wallet2]#affs_chip2').prop('checked',true);
                    } else if( obj.data.refRegCommission[1].walletType==4 ) {
                        $('.modal-adminLink [name=affshare2wallet2]#affs_fortunetoken2').prop('checked',true);
                    }
                }
            } else {
                if( shareReward.length==0 ) {
                    $('.modal-adminLink [name=sharedreward]#sr_false').prop('checked',true);
                }
                
                if( shareReward.length==1 || shareReward.length==0 ) {
                    $('.modal-adminLink [name=sharedreward2]#sr_false2').prop('checked',true);
                }
            }
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            alertToast('bg-danger', obj.message);
        }
    })
    .done(function() {
        
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function modify(uid, username)
{
    $('.modal-modify').modal('toggle');
    $('.modal-modify form [name=username]').val(username);

    coordinateProfileHub(uid);

    $('.modal-modify form').off().on('submit', function(e) {
        e.preventDefault();

        if (this.checkValidity() !== false) {
            swal.fire({
                title: 'Preparing Information...',
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                customClass: {
                    container: 'bg-major'
                }
            });

            $('.modal-modify form [type=submit]').prop('disabled',true);

            var params = {};
            var formObj = $(this).closest("form");
            $.each($(formObj).serializeArray(), function (index, value) {
                params[value.name] = value.value;
                params['uid'] = uid;
            });

            $.post('/user/personal/change', {
                params
            }, function(data, status) {
                const obj = JSON.parse(data);
                //console.log(obj);
                if( obj.code == 1 ) {
                    swal.fire("Success!", obj.message, "success").then(() => { $('#adminTable').DataTable().ajax.reload(null,false); });
                } else if( obj.code==39 ) {
                    forceUserLogout();
                } else {
                    swal.fire("Error!", obj.message + " (Code: "+obj.code+")", "error");
                }
            })
            .done(function() {
                $('.modal-modify').modal('toggle');
                $('.modal-modify form [type=submit]').prop('disabled',false);
            })
            .fail(function() {
                swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
            });
        }
    });
}

function openTransfer(uid, username, currencyCode)
{
    $('.modal-creditTransfer').modal('toggle');
    $('.modal-creditTransfer form [name=username]').val(username);
    $('.modal-creditTransfer form [name=uid]').val(uid);
    $('.modal-creditTransfer form [name=usercurrency]').val(currencyCode);
    $('.modal-creditTransfer form [name=currencycode]').val(currencyCode);
    //$('.modal-creditTransfer form .personbalance').html(balance);

    var params = {};
    params['uid'] = uid;
    params['currencycode'] = currencyCode;

    $.post('/user/profile', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        if( obj.code == 1 ) {
            $('.modal-creditTransfer form .personbalance').html(obj.data.balance);
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

function modifyStatus(uid, status)
{
    var params = {};
    params['uid'] = uid;
    params['status'] = status;

    $.post('/user/status/change', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            alertToast('bg-success', obj.message);
            $('#adminTable').DataTable().ajax.reload(null,false);
        } else if( obj.code==39 ) {
            forceUserLogout();
        } else {
            alertToast('bg-danger', obj.message);
        }
    })
    .done(function() {
    })
    .fail(function() {
        swal.fire("Error!", "Oopss! There are something wrong. Please try again later.", "error");
    });
}

function gameProviderList(element,uid,currencyCode)
{
    var params = {};
    params['parent'] = uid;
    params['currencycode'] = currencyCode;

    $.post('/list/game-provider/raw', {
        params
    }, function(data, status) {
        const obj = JSON.parse(data);
        // console.log(obj);
        if( obj.code == 1 ) {
            const gp = obj.data;
            var nodeLast = document.createElement("option");
            var textnodeLast = document.createTextNode('Not Specify');
            nodeLast.setAttribute("value", '');
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

function getGameCategoryList(element,uid,currencyCode)
{
    var params = {};
    params['parent'] = uid;
    params['currencycode'] = currencyCode;

    $.post('/list/game-category/raw', {
        params
    }, function(data, status) {
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
</script>