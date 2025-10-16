<header class="navbar navbar-expand-lg navbar-dark sticky-top flex-md-nowrap p-0">
    <div class="navbar-brand-hub col-md-3 col-lg-2 me-0 p-0" href="javascript:void(0);">
        <a href="javascript:void(0);" class="d-inline-block text-decoration-none custom-nav-toggle d-xl-none d-md-none d-block" data-bs-toggle="collapse" data-bs-target="#topmenu" aria-controls="topmenu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bx bx-menu"></i>
        </a>
        <span class="d-xl-inline-block d-md-inline-block d-none custom-nav-toggle"><?=$_ENV['companyHub'];?></span>
    </div>

    <!--<section class="px-3">
        <label><?=lang('Label.balance');?>: <span class="userbalance">---</span><a class="text-decoration-none text-dark ms-1" href="javascript:void(0);" onclick="refreshProfile();"><i class="bx bx-refresh ms-1"></i></a></label>
    </section>-->

    <ul class="nav px-lg-3 px-md-3 px-1 ms-auto">
        <!-- <li class="nav-item"><a class="nav-link text-dark" href="<?//=base_url('customer-service/live-chat');?>"><i class="las la-comments"></i></a></li> -->
        <!-- <li class="nav-item"><a class="nav-link text-dark" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".modal-commList"><i class="las la-clipboard-list"></i></a></li> -->
        <li class="nav-item dropdown profile d-flex align-items-center">
            <a class="nav-link dropdown-toggle p-3 shadow" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
            <ul class="dropdown-menu dropdown-menu-end border-white shadow" aria-labelledby="profileDropdown">
                <li><a class="dropdown-item" href="javascript:void(0);">
                    <b class="d-block fw-bold"><i class="las la-user-circle me-1"></i><?=$_SESSION['username'];?></b>
                    <!--<i class="las la-wallet me-1"></i><span class="userbalance">---</span>-->
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
                <li class="nav-item"><a class="nav-link" aria-current="page" href="<?=base_url('dashboard-hub');?>"><i class='bx bxs-bank me-1'></i><?=lang('Nav.kioskbycurrency');?></a></li>

                <?php if( $_SESSION['role']==2 || (($_SESSION['uplinerole']==2 && $_SESSION['role']==5) && $_SESSION['account']==1) ): ?>
                    <li class="nav-item dropdown"> <!-- agent list -->
                        <a class="nav-link dropdown-toggle" href="#" id="account-collapse" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="las la-user-friends me-1"></i><?=lang('Label.agent');?></a>
                        <ul class="dropdown-menu border-white rounded-0 m-0" aria-labelledby="account-collapse">
                            <li><a class="dropdown-item" href="<?=base_url('hub-agent');?>"><i class="las la-user-secret me-1"></i><?=lang('Nav.aglist');?></a></li>
                            <li><a class="dropdown-item" href="<?=base_url('hub-add-agent');?>"><i class="las la-user-plus me-1"></i><?=lang('Nav.addag');?></a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if( $_SESSION['role']==2 ): ?> <!-- sub account -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="announcement-collapse" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="las la-user-ninja me-1"></i><?=lang('Nav.subacc');?></a>
                        <ul class="dropdown-menu border-white rounded-0 m-0" aria-labelledby="announcement-collapse">
                            <li><a class="dropdown-item" href="<?=base_url('hub-sub-account');?>"><i class="las la-user-ninja me-1"></i><?=lang('Nav.subacclist');?></a></li>
                            <li><a class="dropdown-item" href="<?=base_url('hub-sub-account/add');?>"><i class="las la-user-plus me-1"></i><?=lang('Nav.addsubacc');?></a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</menu>


<main class="py-4">
    <div class="container">