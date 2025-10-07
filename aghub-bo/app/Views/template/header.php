<header class="navbar navbar-expand-lg navbar-dark sticky-top flex-md-nowrap p-0">
    <div class="navbar-brand col-md-3 col-lg-2 me-0 p-0" href="javascript:void(0);">
        <a href="javascript:void(0);" class="d-inline-block text-decoration-none custom-nav-toggle d-xl-none d-md-none d-block" data-bs-toggle="collapse" data-bs-target="#topmenu" aria-controls="topmenu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bx bx-menu-alt-left"></i>
        </a>
        <span class="d-xl-inline-block d-md-inline-block d-none custom-nav-toggle"><?=$_ENV['company'];?></span>
    </div>

    <section class="px-3">
        <label><?=lang('Label.balance');?>: <span class="userbalance">---</span><a class="text-decoration-none text-dark ms-1" href="javascript:void(0);" onclick="refreshProfile();"><i class="bx bx-refresh ms-1"></i></a></label>
    </section>

    <ul class="nav px-lg-3 px-md-3 px-1 ms-auto">
        <!-- <li class="nav-item"><a class="nav-link text-dark" href="<?//=base_url('customer-service/live-chat');?>"><i class="las la-comments"></i></a></li> -->
        <!-- <li class="nav-item"><a class="nav-link text-dark" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".modal-commList"><i class="las la-clipboard-list"></i></a></li> -->
        <li class="nav-item dropdown profile d-flex align-items-center">
            <a class="nav-link dropdown-toggle p-3 shadow" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
            <ul class="dropdown-menu dropdown-menu-end border-white shadow" aria-labelledby="profileDropdown">
                <li><a class="dropdown-item" href="javascript:void(0);">
                    <b class="d-block fw-bold"><i class="las la-user-circle me-1"></i><?=$_SESSION['username'];?></b>
                    <i class="las la-wallet me-1"></i><span class="userbalance">---</span>
                </a></li>
                <div class="dropdown-divider"></div>
                <li>
                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".modal-selfmodify"><i class="bx bxs-cog me-1"></i><?=lang('Nav.editprofile');?></a>
                </li>
                <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".modal-changePass"><i class="bx bxs-lock me-1"></i><?=lang('Nav.chgpass');?></a></li>
                <div class="dropdown-divider"></div>
                <li><a class="dropdown-item" href="javascript:translation('en')"><i class="bx bxs-captions me-1"></i>English</a></li>
                <li><a class="dropdown-item" href="javascript:translation('cn')"><i class="bx bxs-captions me-1"></i>简体中文</a></li>
                <!-- <li><a class="dropdown-item" href="javascript:translation('zh')"><i class="bx bxs-captions me-1"></i>繁体中文</a></li> -->
                <li><a class="dropdown-item" href="javascript:translation('my')"><i class="bx bxs-captions me-1"></i>Bahasa</a></li>
                <!-- <li><a class="dropdown-item" href="javascript:translation('in')"><i class="bx bxs-captions me-1"></i>Indonesia</a></li> -->
                <!-- <li><a class="dropdown-item" href="javascript:translation('th')"><i class="bx bxs-captions me-1"></i>ไทย</a></li> -->
                <!-- <li><a class="dropdown-item" href="javascript:translation('vn')"><i class="bx bxs-captions me-1"></i>Tiếng Việt</a></li> -->
                <!-- <li><a class="dropdown-item" href="javascript:translation('bur')"><i class="bx bxs-captions me-1"></i>Tiếng Miến Điện</a></li> -->
                <!-- <li><a class="dropdown-item" href="javascript:translation('bgl')"><i class="bx bxs-captions me-1"></i>বাঙ্গালি</a></li> -->
                <div class="dropdown-divider"></div>
                <li><a class="dropdown-item text-danger" href="<?=base_url('user/logout');?>"><i class="bx bx-power-off me-1"></i><?=lang('Nav.logout');?></a></li>
            </ul>
        </li>
    </ul>
</header>

<menu class="navbar navbar-expand-lg navbar-light m-0 p-0 bg-white shadow">
    <div class="container-fluid">
        <nav class="collapse navbar-collapse topmenu" id="topmenu">
            <ul class="navbar-nav me-auto mb-xl-0 mb-lg-0 mb-md-0 mb-5">
                <li class="nav-item"><a class="nav-link" aria-current="page" href="<?=base_url('dashboard');?>"><i class="bx bxs-dashboard me-1"></i><?=lang('Nav.dashboard');?></a></li>
                
                <?php if( $_SESSION['role']==2 || (($_SESSION['uplinerole']==2 && $_SESSION['role']==5) && $_SESSION['transaction']==1) ): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="tranx-collapse" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-history me-1"></i><?=lang('Nav.transaction');?></a>
                        <ul class="dropdown-menu border-white rounded-0 m-0" aria-labelledby="tranx-collapse">
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="javascript:window.location.href='<?=base_url('transaction/pending/deposit');?>';"><?=lang('Nav.pendingdeposit');?></a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="javascript:window.location.href='<?=base_url('transaction/pending/withdrawal');?>';"><?=lang('Nav.pendingwithdrawal');?></a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="javascript:window.location.href='<?=base_url('transaction/pending/agent-withdrawal');?>';"><?=lang('Nav.pendingagwithdrawal');?></a>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?=base_url('history/transaction');?>"><?=lang('Nav.tranxhistory');?></a></li>
                            <!--
                            <li><a class="dropdown-item" href="<?//=base_url('history/DIY-promotion');?>"><?//=lang('Nav.diyhistory');?></a></li>
                            -->
                            <li class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="<?=base_url('history/promotion/claim-after');?>"><small class="badge bg-primary fw-normal me-1"><?=lang('Label.promotion');?></small><?=lang('Nav.claimafhistory');?></a>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="<?=base_url('system/jackpot/claim');?>"><i class="las la-gifts me-1"></i><?=lang('Nav.claimjackpot');?></a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                
                <?php if( $_SESSION['role']==2 || (($_SESSION['uplinerole']==2 && $_SESSION['role']==5) && $_SESSION['report']==1) ): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="report-collapse" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bxs-report me-1"></i><?=lang('Nav.report');?></a>
                        <ul class="dropdown-menu border-white rounded-0 m-0" aria-labelledby="report-collapse">
                            <!--s
                            <li><a class="dropdown-item" href="<?//=base_url('report/ptps-fight');?>"><i class="las la-chart-pie me-1"></i><?//=lang('Nav.fightlistreport');?></a></li>
                            <li><a class="dropdown-item" href="<?//=base_url('report/ptps-fight-history');?>"><i class="las la-chart-pie me-1"></i><?//=lang('Nav.fightlisthistoryreport');?></a></li>
                            <li><a class="dropdown-item" href="<?//=base_url('report/ptps-shares');?>"><i class="las la-chart-pie me-1"></i><?//=lang('Nav.shareslistreport');?></a></li>
                            <li><a class="dropdown-item" href="<?//=base_url('report/ptps-shares-history');?>"><i class="las la-chart-pie me-1"></i><?//=lang('Nav.shareslisthistoryreport');?></a></li>
                            <li><a class="dropdown-item" href="<?//=base_url('report/ptps-shares-lottery');?>"><i class="las la-chart-pie me-1"></i><?//=lang('Nav.shareslottolistreport');?></a></li>
                            <li><a class="dropdown-item" href="<?//=base_url('report/ptps-shares-lottery-history');?>"><i class="las la-chart-pie me-1"></i><?//=lang('Nav.shareslottolisthistoryreport');?></a></li>
                            <li class="dropdown-divider"></li>
                            -->
                            <li><a class="dropdown-item" href="<?=base_url('report/self-games');?>"><i class="las la-chart-pie me-1"></i><?=lang('Nav.totalgamereport');?></a></li>
                            <!-- <li><a class="dropdown-item" href="<?//=base_url('report/final/simple');?>"><i class="las la-chart-bar me-1"></i><?//=lang('Nav.simplefinalreport')?></a></li> -->
                            <!-- <li><a class="dropdown-item" href="<?=base_url('report/final');?>"><i class="las la-chart-bar me-1"></i><?//=lang('Nav.finalreport').' ('.lang('Label.details').')';?></a></li> -->
                            <!-- <li><a class="dropdown-item" href="<?//=base_url('report/games');?>"><i class="las la-chart-pie me-1"></i><?//=lang('Nav.gamereport');?></a></li> -->
                            <li><a class="dropdown-item" href="<?=base_url('report/winlose');?>"><i class="las la-chart-area me-1"></i><?=lang('Nav.winlosereport');?></a></li>
                            <li><a class="dropdown-item" href="<?=base_url('report/reference-winlose');?>"><i class="las la-chart-area me-1"></i><?=lang('Nav.refwinlosereport');?></a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?=base_url('report/agent-commission');?>"><i class="las la-handshake me-1"></i><?=lang('Nav.agcommreport');?></a></li>
                            <li><a class="dropdown-item" href="<?=base_url('report/agent-commission/pt');?>"><i class="las la-handshake me-1"></i><?=lang('Nav.agcommptreport');?></a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?=base_url('report/jackpot');?>"><i class="las la-gift me-1"></i><?=lang('Nav.jackpotreport');?></a></li>
                            <li><a class="dropdown-item" href="<?=base_url('report/jackpotpt');?>"><i class="las la-percentage me-1"></i><?=lang('Nav.jackpotptreport');?></a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?=base_url('report/affiliate');?>"><i class="las la-chart-line me-1"></i><?=lang('Nav.affiliatereport');?></a></li>
                            <li><a class="dropdown-item" href="<?=base_url('report/affiliate/pt');?>"><i class="las la-percentage me-1"></i><?=lang('Nav.affptreport');?></a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?=base_url('report/referral-deposit-commission');?>"><i class="las la-share-alt me-1"></i><?=lang('Nav.refdepcommreport');?></a></li>
                            <li><a class="dropdown-item" href="<?=base_url('report/referral-deposit-commission/pt');?>"><i class="las la-percentage me-1"></i><?=lang('Nav.refdepcommptreport');?></a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?=base_url('report/deposit-commission');?>"><i class="las la-cash-register me-1"></i><?=lang('Nav.depcommreport');?></a></li>
                            <li><a class="dropdown-item" href="<?=base_url('report/deposit-commission/pt');?>"><i class="las la-percentage me-1"></i><?=lang('Nav.depcommptreport');?></a></li>
                            <!--
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?=base_url('report/loss-rebate');?>"><i class="las la-sad-cry me-1"></i><?=lang('Nav.lossrebreport');?></a></li>
                            <li><a class="dropdown-item" href="<?=base_url('report/loss-rebate/pt');?>"><i class="las la-percentage me-1"></i><?=lang('Nav.lossrebptreport');?></a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?=base_url('report/affiliate/loss-rebate');?>"><i class="las la-sad-cry me-1"></i><?=lang('Nav.afflossrebreport');?></a></li>
                            <li><a class="dropdown-item" href="<?=base_url('report/affiliate/loss-rebate/pt');?>"><i class="las la-percentage me-1"></i><?=lang('Nav.afflossrebptreport');?></a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?=base_url('report/fortune-wheel');?>"><i class="las la-dharmachakra me-1"></i><?=lang('Nav.fortunereport');?></a></li>
                            <li><a class="dropdown-item" href="<?=base_url('report/fortune-wheel/pt');?>"><i class="las la-percentage me-1"></i><?=lang('Nav.fortuneptreport');?></a></li>
                            -->
                        </ul>
                    </li>
                <?php endif; ?>
                
                <?php if( $_SESSION['role']==2 || (($_SESSION['uplinerole']==2 && $_SESSION['role']==5) && $_SESSION['account']==1) ): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="account-collapse" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="las la-user-friends me-1"></i><?=lang('Label.agent');?></a>
                        <ul class="dropdown-menu border-white rounded-0 m-0" aria-labelledby="account-collapse">
                            <li><a class="dropdown-item" href="<?=base_url('agent');?>"><i class="las la-user-secret me-1"></i><?=lang('Nav.aglist');?></a></li>
                            <li><a class="dropdown-item" href="<?=base_url('add-agent');?>"><i class="las la-user-plus me-1"></i><?=lang('Nav.addag');?></a></li>
                            <!-- <li class="dropdown-divider"></li> -->
                            <!-- <li><a class="dropdown-item" href="<?//=base_url('member');?>"><i class="las la-users me-1"></i><?//=lang('Nav.memberlist');?></a></li> -->
                            <!-- <li><a class="dropdown-item" href="<?//=base_url('add-member');?>"><i class="las la-user-plus me-1"></i><?//=lang('Nav.addmember');?></a></li> -->
                        </ul>
                    </li>
                <?php endif; ?>
                
                <?php if( $_SESSION['role']==2 || (($_SESSION['uplinerole']==2 && $_SESSION['role']==5) && $_SESSION['gameprovider']==1) ): ?>
                    <li class="nav-item"><a class="nav-link" href="<?=base_url('game-provider');?>"><i class="las la-gamepad me-1"></i><?=lang('Nav.gp');?></a></li>
                <?php endif; ?>
                
                <?php if( $_SESSION['role']==2 || (($_SESSION['uplinerole']==2 && $_SESSION['role']==5) && $_SESSION['settings']==1) ): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="setting-collapse" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="las la-cog me-1"></i><?=lang('Nav.settings');?></a>
                        <ul class="dropdown-menu border-white rounded-0 m-0" aria-labelledby="setting-collapse">
                            <?php if( $_SESSION['role']==2 || (($_SESSION['uplinerole']==2 && $_SESSION['role']==5) && $_SESSION['confidential']==1) ): ?>
                            <li><a class="dropdown-item" href="<?=base_url('settings/company/fight-share');?>"><i class="bx bx-chip me-1"></i><?=lang('Nav.settingcompptps');?></a></li>
                            <li><a class="dropdown-item" href="<?=base_url('settings/additional-record');?>"><i class="bx bxs-file-archive me-1"></i><?=lang('Nav.settingfakerecord');?></a></li>
                            <li><a class="dropdown-item" href="<?=base_url('settings/company-summary');?>"><i class="bx bxs-file-archive me-1"></i><?=lang('Nav.settingcompsummary');?></a></li>
                            <?php if( $_SESSION['role']==2 ): ?>
                            <li><a class="dropdown-item" href="<?=base_url('settings/agent-withdrawal');?>"><i class="bx bxs-timer me-1"></i><?=lang('Nav.settingagentwithdrawal');?></a></li>
                            <?php endif; ?>
                            <li class="dropdown-divider"></li>
                            <!--
                            <li><a class="dropdown-item" href="<?=base_url('settings/loss-rebate');?>"><i class="las la-percent me-1"></i><?=lang('Nav.settinglossrebate');?></a></li>
                            -->
                            <li><a class="dropdown-item" href="<?=base_url('settings/affiliate');?>"><i class="bx bxs-dice-3 me-1"></i><?=lang('Nav.settingaff');?></a></li>
                            <li><a class="dropdown-item" href="<?=base_url('settings/jackpot');?>"><i class="bx bxs-magic-wand me-1"></i><?=lang('Nav.settingjackpot');?></a></li>
                            <!--
                            <li><a class="dropdown-item" href="<?=base_url('settings/fortune-wheel');?>"><i class="las la-dharmachakra me-1"></i><?=lang('Nav.settingfortune');?></a></li>
                            <li><a class="dropdown-item" href="<?=base_url('settings/affiliate-loss-rebate');?>"><i class="las la-share-alt me-1"></i><?=lang('Nav.settingafflossrebate');?></a></li>
                            -->
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?=base_url('settings/promotion');?>"><i class="las la-gifts me-1"></i><?=lang('Nav.settingpromotion');?></a></li>
                            <!--
                            <li><a class="dropdown-item" href="<?//=base_url('settings/DIY-promotion');?>"><i class="las la-hand-holding-heart me-1"></i><?//=lang('Nav.settingdiypromo');?></a></li>
                            -->
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?=base_url('settings/banner');?>"><i class="las la-image me-1"></i><?=lang('Nav.settingbanner');?></a></li>
                            <li class="dropdown-divider"></li>
                            <?php endif; ?>
                            
                            <li><a class="dropdown-item" href="<?=base_url('settings/bank-card');?>"><i class="las la-landmark me-1"></i><?=lang('Nav.settingbankcard');?></a></li>
                            <li><a class="dropdown-item" href="<?=base_url('settings/payment-gateway');?>"><i class="las la-cloud me-1"></i><?=lang('Nav.settingpg');?></a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?=base_url('settings/currency');?>"><i class="las la-coins me-1"></i><?=lang('Nav.settingcurrency');?></a></li>
                            
                            <?php if( $_SESSION['role']==2 || (($_SESSION['uplinerole']==2 && $_SESSION['role']==5) && $_SESSION['confidential']==1) ): ?>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?=base_url('system/settlement');?>"><i class="las la-wrench me-1"></i><?=lang('Nav.sysettlement');?></a></li>
                            <?php if( $_SESSION['role']==2 ): ?>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?=base_url('admin-config');?>"><i class="las la-sliders-h me-1"></i><?=lang('Nav.adminconfig');?></a></li>
                            <?php endif; ?>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                
                <?php if( $_SESSION['role']==2 || (($_SESSION['uplinerole']==2 && $_SESSION['role']==5) && $_SESSION['extra']==1) ): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="announcement-collapse" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="las la-cubes me-1"></i><?=lang('Nav.extra');?></a>
                        <ul class="dropdown-menu border-white rounded-0 m-0" aria-labelledby="announcement-collapse">
                            <li><a class="dropdown-item" href="<?=base_url('support/customer-service');?>"><i class="las la-headset me-1"></i><?=lang('Nav.settingsupport');?></a></li>
                            <!--
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?//=base_url('settings/contents');?>"><i class="las la-scroll me-1"></i><?//=lang('Nav.contentmanage');?></a></li>
                            -->
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?=base_url('extra/seo-config');?>"><i class="las la-scroll me-1"></i><?=lang('Nav.seoconfig');?></a></li>
                            <li><a class="dropdown-item" href="<?=base_url('extra/news-config');?>"><i class="las la-scroll me-1"></i><?=lang('Nav.newsconfig');?></a></li>
                            <li><a class="dropdown-item" href="<?=base_url('extra/agcomm-config');?>"><i class="las la-scroll me-1"></i><?=lang('Nav.agcommconfig');?></a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?=base_url('announcement');?>"><i class="las la-scroll me-1"></i><?=lang('Nav.anncs');?></a></li>
                            <li><a class="dropdown-item" href="<?=base_url('app-version');?>"><i class="las la-mobile me-1"></i><?=lang('Nav.appversion');?></a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if( $_SESSION['role']==2 ): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="announcement-collapse" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="las la-user-ninja me-1"></i><?=lang('Nav.subacc');?></a>
                        <ul class="dropdown-menu border-white rounded-0 m-0" aria-labelledby="announcement-collapse">
                            <li><a class="dropdown-item" href="<?=base_url('sub-account');?>"><i class="las la-user-ninja me-1"></i><?=lang('Nav.subacclist');?></a></li>
                            <li><a class="dropdown-item" href="<?=base_url('sub-account/add');?>"><i class="las la-user-plus me-1"></i><?=lang('Nav.addsubacc');?></a></li>
                        </ul>
                    </li>
                <?php endif; ?>
                
                <?php if( $_SESSION['role']==2 || (($_SESSION['uplinerole']==2 && $_SESSION['role']==5) && $_SESSION['usersearch']==1) ): ?>
                    <li class="nav-item"><a class="nav-link" href="<?=base_url('user-search');?>"><i class="las la-search me-1"></i><?=lang('Nav.usearch');?></a></li>
                    <li class="nav-item"><a class="nav-link" href="<?=base_url('user-search/gameid');?>"><i class="las la-search me-1"></i><?=lang('Nav.gameidsearch');?></a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</menu>

<main class="py-4">
    <div class="container">