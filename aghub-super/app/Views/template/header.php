<header class="navbar navbar-expand-lg navbar-dark bg-white sticky-top flex-md-nowrap p-0 shadow-sm">
    <div class="navbar-brand col-md-3 col-lg-2 me-0 p-0 bg-primary" href="javascript:void(0);">
        <a href="javascript:void(0);" class="d-inline-block text-decoration-none custom-nav-toggle d-xl-none d-md-none d-block" data-bs-toggle="collapse" data-bs-target="#topmenu" aria-controls="topmenu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="las la-bars"></i>
        </a>
        <span class="d-xl-inline-block d-md-inline-block d-none custom-nav-toggle">AgentHub - Super</span>
    </div>

    <section class="px-3">
        <label>Balance: <span class="userbalance">&infin;</span></label>
    </section>

    <ul class="nav px-lg-3 px-md-3 px-1 ms-auto">
        <li class="nav-item dropdown profile d-flex align-items-center">
            <a class="nav-link dropdown-toggle p-3" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
            <ul class="dropdown-menu dropdown-menu-end border-white shadow" aria-labelledby="profileDropdown">
                <li><a class="dropdown-item" href="javascript:void(0);">
                    <b class="d-block fw-bold"><i class="las la-user-circle me-1"></i><?=$_SESSION['username'];?></b>
                    <i class="las la-wallet me-1"></i><span class="userbalance">&infin;</span>
                </a></li>
                <div class="dropdown-divider"></div>
                <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".modal-selfmodify"><i class="las la-user-cog me-1"></i>Edit Profile</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".modal-changePass"><i class="las la-lock me-1"></i>Change Password</a></li>
                <div class="dropdown-divider"></div>
                <li><a class="dropdown-item text-danger" href="<?=base_url('user/logout');?>"><i class="las la-power-off me-1"></i>Log Out</a></li>
            </ul>
        </li>
    </ul>
</header>

<menu class="navbar navbar-expand-lg navbar-light bg-white m-0 p-0">
    <div class="container-fluid">
        <nav class="collapse navbar-collapse topmenu" id="topmenu">
            <ul class="navbar-nav me-auto mb-xl-0 mb-lg-0 mb-md-0 mb-5">
                <li class="nav-item"><a class="nav-link" aria-current="page" href="<?=base_url('dashboard');?>"><i class="las la-home me-1"></i>Dashboard</a></li>
                <!--<li class="nav-item"><a class="nav-link" href="<?=base_url('history/transaction');?>"><i class="las la-file-invoice-dollar me-1"></i>Transaction</a></li>-->
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="admin-collapse" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="las la-building me-1"></i></i>Administrator</a>
                    <ul class="dropdown-menu border-white rounded-0 mb-xl-0 mb-lg-0 mb-md-0 mb-3" aria-labelledby="admin-collapse">
                        <li><a class="dropdown-item" href="<?=base_url('administrator');?>"><i class="las la-building me-1"></i>Administrators</a></li>
                        <li><a class="dropdown-item" href="<?=base_url('administrator/add');?>"><i class="las la-plus me-1"></i>Add Administrator</a></li>
                    </ul>
                </li>
                <!-- 
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="payment-collapse" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="las la-piggy-bank me-1"></i>Payment Provider</a>
                    <ul class="dropdown-menu border-white rounded-0 mb-xl-0 mb-lg-0 mb-md-0 mb-3" aria-labelledby="payment-collapse">
                        <li><a class="dropdown-item" href="<?=base_url('payment-provider/bank');?>"><i class="las la-university me-1"></i>Bank</a></li>
                        <li><a class="dropdown-item" href="<?=base_url('payment-provider/payment-gateway');?>"><i class="las la-cloud me-1"></i>Payment Gateway</a></li>
                    </ul>
                </li> -->

                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="subacc-collapse" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="las la-user-tie me-1"></i>Sub Account</a>
                    <ul class="dropdown-menu border-white rounded-0 mb-xl-0 mb-lg-0 mb-md-0 mb-3" aria-labelledby="subacc-collapse">
                        <li><a class="dropdown-item" href=""><i class="las la-user-tie me-1"></i>Sub Accounts</a></li>
                        <li><a class="dropdown-item" href=""><i class="las la-plus me-1"></i>Add Sub Account</a></li>
                    </ul>
                </li> -->

                <!-- 
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="payment-collapse" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="las la-cog me-1"></i>Settings</a>
                    <ul class="dropdown-menu border-white rounded-0 mb-xl-0 mb-lg-0 mb-md-0 mb-3" aria-labelledby="payment-collapse">
                        <li><a class="dropdown-item" href="<?=base_url('settings/languages');?>"><i class="las la-language me-1"></i>Languages</a></li>
                        <li><a class="dropdown-item" href="<?=base_url('settings/currencies');?>"><i class="las la-yen-sign me-1"></i>Currency</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?=base_url('settings/payment-types');?>"><i class="las la-cash-register me-1"></i>Payment Types</a></li>
                        <li><a class="dropdown-item" href="<?=base_url('settings/payment-status');?>"><i class="las la-money-bill me-1"></i>Payment Status</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?=base_url('settings/error-code');?>"><i class="las la-bug me-1"></i>Error Code</a></li>
                    </ul>
                </li>-->

                <!-- <li class="nav-item"><a class="nav-link" href=""><i class="las la-envelope me-1"></i>Email</a></li> -->

                <!--<li class="nav-item"><a class="nav-link" href="<?=base_url('announcement');?>"><i class="las la-broadcast-tower me-1"></i>Announcement</a></li>-->

            </ul>
        </nav>
    </div>
</menu>

<main class="py-3">
    <div class="container">
