<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class User_control extends BaseController
{  
    /*
    User Permission
    */

    public function editUserRewardSettings()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $data = [];
        $data['displayAgentBankCard'] = isset($this->request->getpost('params')['agbankcard']) ? filter_var($this->request->getpost('params')['agbankcard'], FILTER_VALIDATE_BOOLEAN) : false;
        $data['displayAgentPaymentGateway'] = isset($this->request->getpost('params')['agpgateway']) ? filter_var($this->request->getpost('params')['agpgateway'], FILTER_VALIDATE_BOOLEAN) : false;
        $data['noDeposit'] = isset($this->request->getpost('params')['nobanktransferdeposit']) ? filter_var($this->request->getpost('params')['nobanktransferdeposit'], FILTER_VALIDATE_BOOLEAN) : false;
        $data['noDepositPaymentGateway'] = isset($this->request->getpost('params')['nopaygatetwaydeposit']) ? filter_var($this->request->getpost('params')['nopaygatetwaydeposit'], FILTER_VALIDATE_BOOLEAN) : false;
        $data['noWithdrawal'] = isset($this->request->getpost('params')['nowithdrawal']) ? filter_var($this->request->getpost('params')['nowithdrawal'], FILTER_VALIDATE_BOOLEAN) : false;
        $data['noWithdrawalPaymentGateway'] = isset($this->request->getpost('params')['nopgwithdrawal']) ? filter_var($this->request->getpost('params')['nopgwithdrawal'], FILTER_VALIDATE_BOOLEAN) : false;
        $data['noJackpot'] = isset($this->request->getpost('params')['nojackpot']) ? filter_var($this->request->getpost('params')['nojackpot'], FILTER_VALIDATE_BOOLEAN) : false;
        $data['noSpin'] = isset($this->request->getpost('params')['nofortunewheel']) ? filter_var($this->request->getpost('params')['nofortunewheel'], FILTER_VALIDATE_BOOLEAN) : false;
        $data['noCommission'] = isset($this->request->getpost('params')['noagcomm']) ? filter_var($this->request->getpost('params')['noagcomm'], FILTER_VALIDATE_BOOLEAN) : false;
        $data['noAffiliate'] = isset($this->request->getpost('params')['noaffilliate']) ? filter_var($this->request->getpost('params')['noaffilliate'], FILTER_VALIDATE_BOOLEAN) : false;
        $data['noLoseRebate'] = isset($this->request->getpost('params')['nolossrebate']) ? filter_var($this->request->getpost('params')['nolossrebate'], FILTER_VALIDATE_BOOLEAN) : false;
        $data['noWinloseRebate'] = isset($this->request->getpost('params')['noafflossrebate']) ? filter_var($this->request->getpost('params')['noafflossrebate'], FILTER_VALIDATE_BOOLEAN) : false;
        $data['noTopUpComm'] = isset($this->request->getpost('params')['nodepositreward']) ? filter_var($this->request->getpost('params')['nodepositreward'], FILTER_VALIDATE_BOOLEAN) : false;
        $data['noRefComm'] = isset($this->request->getpost('params')['noaffdeposit']) ? filter_var($this->request->getpost('params')['noaffdeposit'], FILTER_VALIDATE_BOOLEAN) : false;
        $data['noFreeCoin'] = isset($this->request->getpost('params')['nodailyfree']) ? filter_var($this->request->getpost('params')['nodailyfree'], FILTER_VALIDATE_BOOLEAN) : false;
        $data['noRefRegComm'] = isset($this->request->getpost('params')['nosharereward']) ? filter_var($this->request->getpost('params')['nosharereward'], FILTER_VALIDATE_BOOLEAN) : false;

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid']),
            'rewardSettings' => $data
        ];
        $res = $this->user_model->updateUser($payload);
        echo json_encode($res);
    }

    public function userRewardSettings()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid'])
        ];
        $res = $this->user_model->selectUser($payload);
        // echo json_encode($res);
        $data = [];
        if( $res['code']==1 && $res['data']!=[] ):
            $set = $res['data']['rewardSettings'];
            $data['agbankcard'] = $set['displayAgentBankCard'];
            $data['agpgateway'] = $set['displayAgentPaymentGateway'];
            $data['nobanktransferdeposit'] = $set['noDeposit'];
            $data['nopaygatetwaydeposit'] = $set['noDepositPaymentGateway'];
            $data['nowithdrawal'] = $set['noWithdrawal'];
            $data['nopgwithdrawal'] = $set['noWithdrawalPaymentGateway'];
            $data['nojackpot'] = $set['noJackpot'];
            $data['nofortunewheel'] = $set['noSpin'];
            $data['noagcomm'] = $set['noCommission'];
            $data['noaffilliate'] = $set['noAffiliate'];
            $data['nolossrebate'] = $set['noLoseRebate'];
            $data['noafflossrebate'] = $set['noWinloseRebate'];
            $data['nodepositreward'] = $set['noTopUpComm'];
            $data['noaffdeposit'] = $set['noRefComm'];
            $data['nodailyfree'] = $set['noFreeCoin'];
            $data['nosharereward'] = $set['noRefRegComm'];
        else:
            $data['agbankcard'] = false;
            $data['agpgateway'] = false;
            $data['nobanktransferdeposit'] = false;
            $data['nopaygatetwaydeposit'] = false;
            $data['nowithdrawal'] = false;
            $data['nopgwithdrawal'] = false;
            $data['nojackpot'] = false;
            $data['nofortunewheel'] = false;
            $data['noagcomm'] = false;
            $data['noaffilliate'] = false;
            $data['nolossrebate'] = false;
            $data['noafflossrebate'] = false;
            $data['nodepositreward'] = false;
            $data['noaffdeposit'] = false;
            $data['nodailyfree'] = false;
            $data['nosharereward'] = false;
        endif;

        echo json_encode([
            'code' => $res['code'],
            'message' => $res['message'],
            'data' => $data
        ]);
    }

    public function editUserPermission()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $param = new \stdClass();
        $param->transaction = isset($this->request->getpost('params')['transaction']) ? $this->request->getpost('params')['transaction'] : 0;
        $param->report = isset($this->request->getpost('params')['report']) ? $this->request->getpost('params')['report'] : 0;
        $param->account = isset($this->request->getpost('params')['account']) ? $this->request->getpost('params')['account'] : 0;
        $param->gameprovider = isset($this->request->getpost('params')['gprovider']) ? $this->request->getpost('params')['gprovider'] : 0;
        $param->settings = isset($this->request->getpost('params')['settings']) ? $this->request->getpost('params')['settings'] : 0;
        $param->extra = isset($this->request->getpost('params')['extra']) ? $this->request->getpost('params')['extra'] : 0;
        $param->usersearch = isset($this->request->getpost('params')['usearch']) ? $this->request->getpost('params')['usearch'] : 0;
        $param->userprofile = isset($this->request->getpost('params')['uprofile']) ? $this->request->getpost('params')['uprofile'] : 0;
        $param->confidential = isset($this->request->getpost('params')['confidential']) ? $this->request->getpost('params')['confidential'] : 0;
        $payload['major'] = $param;

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid']),
            'permission' => json_encode($payload)
        ];
        $res = $this->user_model->updateUser($payload);
        echo json_encode($res);
    }

    public function editHubUserPermission()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $param = new \stdClass();
        $param->transaction = isset($this->request->getpost('params')['transaction']) ? $this->request->getpost('params')['transaction'] : 0;
        $param->report = isset($this->request->getpost('params')['report']) ? $this->request->getpost('params')['report'] : 0;
        $param->account = isset($this->request->getpost('params')['account']) ? $this->request->getpost('params')['account'] : 0;
        $param->gameprovider = isset($this->request->getpost('params')['gprovider']) ? $this->request->getpost('params')['gprovider'] : 0;
        $param->settings = isset($this->request->getpost('params')['settings']) ? $this->request->getpost('params')['settings'] : 0;
        $param->extra = isset($this->request->getpost('params')['extra']) ? $this->request->getpost('params')['extra'] : 0;
        $param->usersearch = isset($this->request->getpost('params')['usearch']) ? $this->request->getpost('params')['usearch'] : 0;
        $param->userprofile = isset($this->request->getpost('params')['uprofile']) ? $this->request->getpost('params')['uprofile'] : 0;
        $param->confidential = isset($this->request->getpost('params')['confidential']) ? $this->request->getpost('params')['confidential'] : 0;
        $payload['major'] = $param;

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid']),
            'permission' => json_encode($payload)
        ];
        $res = $this->user_model->updateUserHub($payload);
        echo json_encode($res);
    }

    //Agent Permit
    public function editAgentPermission()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $param = new \stdClass();
        //Defaut
        $param->transaction = 1;
        $param->report = 1;
        $param->account = 1;
        $param->usersearch = 1;
        //Permit
        $param->transfercomm = isset($this->request->getpost('params')['transfercomm']) ? $this->request->getpost('params')['transfercomm'] : 0;
        $param->createmember = isset($this->request->getpost('params')['createmember']) ? $this->request->getpost('params')['createmember'] : 0;
        $payload['major'] = $param;

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid']),
            'permission' => json_encode($payload)
        ];
        $res = $this->user_model->updateUser($payload);
        echo json_encode($res);
    }

    //Agent Permit Hub
    public function editAgentHubPermission()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $param = new \stdClass();
        //Defaut
        $param->transaction = 1;
        $param->report = 1;
        $param->account = 1;
        $param->usersearch = 1;
        //Permit
        $param->transfercomm = isset($this->request->getpost('params')['transfercomm']) ? $this->request->getpost('params')['transfercomm'] : 0;
        $param->createmember = isset($this->request->getpost('params')['createmember']) ? $this->request->getpost('params')['createmember'] : 0;
        $payload['major'] = $param;

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid']),
            'permission' => json_encode($payload)
        ];
        $res = $this->user_model->updateUserHub($payload);
        echo json_encode($res);
    }

    public function userPermissionList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $res = $this->user_model->selectUser(['userid' => base64_decode($this->request->getpost('params')['uid'])]);
        $data = [];
        if( $res['code']==1 && $res['data']!=[] && $res['data']['permission']!=[] ):
            $permission = json_decode($res['data']['permission']);
            $data['transaction'] = !isset($permission->major->transaction) ? 0 : (int)$permission->major->transaction;
            $data['report'] = !isset($permission->major->report) ? 0 : (int)$permission->major->report;
            $data['account'] = !isset($permission->major->account) ? 0 : (int)$permission->major->account;
            $data['gameprovider'] = !isset($permission->major->gameprovider) ? 0 : (int)$permission->major->gameprovider;
            $data['settings'] = !isset($permission->major->settings) ? 0 : (int)$permission->major->settings;
            $data['extra'] = !isset($permission->major->extra) ? 0 : (int)$permission->major->extra;
            $data['usersearch'] = !isset($permission->major->usersearch) ? 0 : (int)$permission->major->usersearch;
            $data['userprofile'] = !isset($permission->major->userprofile) ? 0 : (int)$permission->major->userprofile;
            $data['confidential'] = !isset($permission->major->confidential) ? 0 : (int)$permission->major->confidential;
        else:
            $data['transaction'] = 0;
            $data['report'] = 0;
            $data['account'] = 0;
            $data['gameprovider'] = 0;
            $data['settings'] = 0;
            $data['extra'] = 0;
            $data['usersearch'] = 0;
            $data['userprofile'] = 0;
            $data['confidential'] = 0;
        endif;

        echo json_encode(['code'=>$res['code'], 'message'=>$res['message'], 'data'=>$data]);
    }

    //hub
    public function userHubPermissionList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $res = $this->user_model->selectUserHub(['userid' => base64_decode($this->request->getpost('params')['uid'])]);
        $data = [];
        if( $res['code']==1 && $res['data']!=[] && $res['data']['permission']!=[] ):
            $permission = json_decode($res['data']['permission']);
            $data['transaction'] = !isset($permission->major->transaction) ? 0 : (int)$permission->major->transaction;
            $data['report'] = !isset($permission->major->report) ? 0 : (int)$permission->major->report;
            $data['account'] = !isset($permission->major->account) ? 0 : (int)$permission->major->account;
            $data['gameprovider'] = !isset($permission->major->gameprovider) ? 0 : (int)$permission->major->gameprovider;
            $data['settings'] = !isset($permission->major->settings) ? 0 : (int)$permission->major->settings;
            $data['extra'] = !isset($permission->major->extra) ? 0 : (int)$permission->major->extra;
            $data['usersearch'] = !isset($permission->major->usersearch) ? 0 : (int)$permission->major->usersearch;
            $data['userprofile'] = !isset($permission->major->userprofile) ? 0 : (int)$permission->major->userprofile;
            $data['confidential'] = !isset($permission->major->confidential) ? 0 : (int)$permission->major->confidential;
        else:
            $data['transaction'] = 0;
            $data['report'] = 0;
            $data['account'] = 0;
            $data['gameprovider'] = 0;
            $data['settings'] = 0;
            $data['extra'] = 0;
            $data['usersearch'] = 0;
            $data['userprofile'] = 0;
            $data['confidential'] = 0;
        endif;

        echo json_encode(['code'=>$res['code'], 'message'=>$res['message'], 'data'=>$data]);
    }

    //agent permission
    public function agentPermissionList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $res = $this->user_model->selectUser(['userid' => base64_decode($this->request->getpost('params')['uid'])]);
        $data = [];
        if( $res['code']==1 && $res['data']!=[] && $res['data']['permission']!=[] ):
            $permission = json_decode($res['data']['permission']);
            //Permit
            $data['transfercomm'] = !isset($permission->major->transfercomm) ? 0 : (int)$permission->major->transfercomm;
            $data['createmember'] = !isset($permission->major->createmember) ? 1 : (int)$permission->major->createmember;
        else:
            //Permit
            $data['transfercomm'] = 0;
            $data['createmember'] = 1;
        endif;

        echo json_encode(['code'=>$res['code'], 'message'=>$res['message'], 'data'=>$data]);
    }

    //agent permission hub
    public function agentHubPermissionList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $res = $this->user_model->selectUserHub(['userid' => base64_decode($this->request->getpost('params')['uid'])]);
        $data = [];
        if( $res['code']==1 && $res['data']!=[] && $res['data']['permission']!=[] ):
            $permission = json_decode($res['data']['permission']);
            //Permit
            $data['transfercomm'] = !isset($permission->major->transfercomm) ? 0 : (int)$permission->major->transfercomm;
            $data['createmember'] = !isset($permission->major->createmember) ? 1 : (int)$permission->major->createmember;
        else:
            //Permit
            $data['transfercomm'] = 0;
            $data['createmember'] = 1;
        endif;

        echo json_encode(['code'=>$res['code'], 'message'=>$res['message'], 'data'=>$data]);
    }


    /*
    User Search
    */

    public function userUpline()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $data = $this->user_model->selectUser(['userid' => base64_decode($this->request->getpost('params')['uid'])]);
        $payload = [
            'userid' => $data['data']['agentId']
        ];
        $res = $this->user_model->selectUserUpline($payload);
        echo json_encode($res);
    }

    public function userGameIdSearch()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $raw = json_decode(file_get_contents('php://input'),1);

        $payload = $this->user_model->selectUserByGameId([
            'username' => $raw['gameid'],
            'gameprovidercode' => $raw['provider']
        ]);
        // echo json_encode($payload);

        if( $payload['code'] == 1 && $payload['data'] != [] ):
            $data = [];
            $u = $payload['data'];

            switch($u['status']):
                case 1: $status = lang('Label.active'); break;
                case 2: $status = lang('Label.inactive'); break;
                case 3: $status = lang('Label.freeze'); break;
                default: $status = '';
            endswitch;

            $date = Time::parse(date('Y-m-d H:i:s', strtotime($u['createDate'])));
            $created = $date->toDateTimeString();

            $loginDate = Time::parse(date('Y-m-d H:i:s', strtotime($u['lastLoginDate'])));
            $lastLogin = $loginDate->toDateTimeString();

            $action = '<div class="btn-groups">';
            $action .= '<div class="btn-group me-1 mb-1" role="group">';
            $action .= '<button id="credittranf" type="button" class="btn btn-vw btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">'.lang('Nav.credittransfer').'</button>';
            $action .= '<ul class="dropdown-menu dropdown-menu-end border-white" aria-labelledby="credittranf">';
            $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="openTransfer(\'4\',\''.base64_encode($u['userId']).'\',\''.$u['loginId'].'\',\''.$u['balance'].'\')">'.lang('Nav.credittransfer').'</a></li>';
            $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="openPGTransfer(\''.base64_encode($u['userId']).'\',\''.$u['loginId'].'\',\''.$u['balance'].'\')">'.lang('Nav.pgreplenishment').'</a></li>';
            $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="openFortuneToken(\''.base64_encode($u['userId']).'\',\''.$u['loginId'].'\')">'.lang('Nav.fortunetoken').'</a></li>';
            $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="setPromo(\''.base64_encode($u['userId']).'\',\''.$u['loginId'].'\')">'.lang('Label.setpromotion').'</a></li>';
            $action .= '</ul>';
            $action .= '</div>';
            $action .= '<a class="btn btn-vw btn-sm" href="'.base_url('score/log/'.base64_encode($u['userId'])).'">'.lang('Nav.scorelog').'</a>';
            $action .= '<a class="btn btn-vw btn-sm" href="'.base_url('bet/log/'.base64_encode($u['userId'])).'">'.lang('Nav.betlog').'</a>';
            $action .= '<a class="btn btn-vw btn-sm" href="'.base_url('actual/bet/log/'.base64_encode($u['userId'])).'">'.lang('Nav.actualbetlog').'</a>';
            // $action .= '<a class="btn btn-primary btn-sm" href="'.base_url('user-transfer/log/'.base64_encode($u['userId'])).'">'.lang('Nav.transferlog').'</a>';
            $action .= '<a class="btn btn-vw btn-sm" href="'.base_url('member/games/'.base64_encode($u['userId'])).'">'.lang('Nav.gamelist').'</a>';

            $action .= '<div class="btn-group me-1 mb-1" role="group">';
            $action .= '<button id="navProfile" type="button" class="btn btn-vw btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">'.lang('Nav.profile').'</button>';
            $action .= '<ul class="dropdown-menu dropdown-menu-end border-white" aria-labelledby="navProfile">';
            $action .= '<li><a class="dropdown-item" href="'.base_url('history/transaction/'.base64_encode($u['userId'])).'">'.lang('Nav.transaction').'</a></li>';
            $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="userStatistics(\''.base64_encode($u['userId']).'\')">'.lang('Nav.statistic').'</a></li>';
            $action .= '<li><a class="dropdown-item" href="'.base_url('user/bank-card/'.base64_encode($u['userId'])).'">'.lang('Nav.bankcard').'</a></li>';
            $action .= '<li><a class="dropdown-item" href="'.base_url('member/affiliate-downline/'.base64_encode($u['userId'])).'">'.lang('Nav.affdownline').'</a></li>';
            $action .= '<li class="dropdown-divider"></li>';
            // $action .= '<li><a class="dropdown-item" href="'.base_url('report/user/winlose/'.base64_encode($u['userId'])).'">'.lang('Nav.report').'</a></li>';
            $action .= '<li><a class="dropdown-item" href="'.base_url('report/user/winlose/'.base64_encode($u['userId'])).'">'.lang('Nav.winlosereport').'</a></li>';
            $action .= '<li><a class="dropdown-item" href="'.base_url('report/user/reference-winlose/'.base64_encode($u['userId'])).'">'.lang('Nav.refwinlosereport').'</a></li>';
            $action .= '<li class="dropdown-divider"></li>';
            $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="writeMessage(\''.base64_encode($u['userId']).'\')">'.lang('Nav.sendmail').'</a></li>';
            $action .= '<li><a class="dropdown-item" href="'.base_url('user/inbox/'.base64_encode($u['userId'])).'">'.lang('Nav.inbox').'</a></li>';
            $action .= '<li class="dropdown-divider"></li>';
            $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="modifyRewardSettings(\''.base64_encode($u['userId']).'\');">'.lang('Nav.settings').'</a></li>';
            $action .= '</ul>';
            $action .= '</div>';

            $action .= '<div class="btn-group me-1 mb-1" role="group">';
            $action .= '<button id="credittranf" type="button" class="btn btn-vw btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">'.lang('Nav.password').'</button>';
            $action .= '<ul class="dropdown-menu dropdown-menu-end border-white" aria-labelledby="credittranf">';
            $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="resetVaultPin(\''.base64_encode($u['userId']).'\')">'.lang('Nav.resetvault').'</a></li>';
            $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="resetSecondPass(\''.base64_encode($u['userId']).'\')">'.lang('Nav.reset2ndpass').'</a></li>';
            $action .= '</ul>';
            $action .= '</div>';

            if( $_SESSION['role']==2 || (($_SESSION['uplinerole']==2 && $_SESSION['role']==5) && $_SESSION['userprofile']==1) ):
            $action .= '<a class="btn btn-vw btn-sm" href="javascript:void(0);" onclick="modify(\''.base64_encode($u['userId']).'\',\''.$u['loginId'].'\');">'.lang('Nav.edit').'</a>';
            endif;
            $action .= '<a class="btn btn-vw btn-sm" href="javascript:void(0);" onclick="affiliateQR(\''.base64_encode($u['userId']).'\');">'.lang('Nav.share').'</a>';

            if( $u['status']==1 ):
                $action .= '<a class="btn btn-success btn-sm bg-gradient" href="javascript:void(0);" onclick="modifyStatus(\''.base64_encode($u['userId']).'\', 2)">'.lang('Label.active').'</a>';
            else:
                $action .= '<a class="btn btn-danger btn-sm bg-gradient" href="javascript:void(0);" onclick="modifyStatus(\''.base64_encode($u['userId']).'\', 1)">'.lang('Label.inactive').'</a>';
            endif;
            $action .= '</div>';
            $action .= '</div>';

            $btngame = '<button class="btn btn-light btn-sm getupline ms-1" data-uid="'.base64_encode($u['userId']).'"><i class="bx bxs-user-account"></i></button>';
            if( !empty($u['affiliateId']) ):
                $btngame = '<button class="btn btn-light btn-sm ms-1" onclick="affiliateUpline(\''.base64_encode($u['affiliateId']).'\');"><i class="bx bxs-purchase-tag-alt"></i></button>';
            else:
                $btngame = '';
            endif;

            $gameid = '<button class="btn btn-light btn-sm ms-1" onclick="gameid(\''.base64_encode($u['userId']).'\');"><i class="bx bx-joystick"></i></button>';
            $clearTurnover = '<button class="btn btn-light btn-sm ms-1" onclick="clearTurnover(\''.base64_encode($u['userId']).'\')"><i class="bx bxs-shield-x text-danger"></i></button>';

            $blc = '<button class="btn btn-light btn-sm ms-1" onclick="coinBag(\''.base64_encode($u['userId']).'\');"><i class="bx bx-coin"></i></button>';
            $blc .= '<button class="btn btn-light btn-sm ms-1" onclick="gameBalance(\''.base64_encode($u['userId']).'\');"><i class="bx bx-wallet"></i></button>';

            //FREE CREDIT
            $clear = '<button class="btn btn-light btn-sm ms-1" onclick="withdrawCredit(\''.base64_encode($u['userId']).'\',\''.$u['loginId'].'\');"><i class="bx bx-eraser"></i></button>';

            if( $_SESSION['role']==2 || (($_SESSION['uplinerole']==2 && $_SESSION['role']==5) && $_SESSION['userprofile']==1) ):
                $rightMobile = !empty($u['contact'])?$u['contact']:'---';
            else:
                $rightMobile = '---';
            endif;

            $row = [];
            $row[] = $u['loginId'];
            //$row[] = $u['name'].$btngame.$gameid.$blc.$clearTurnover;
            $row[] = $u['name'].$btngame.$gameid.$blc.$clearTurnover.$clear;
            $row[] = $u['userId'];
            $row[] = $status;
            $row[] = $u['balance'];
            $row[] = $u['safeBalance'];
            $row[] = '<small class="badge bg-primary fw-normal me-1">'.$u['regionCode'].'</small>'.$rightMobile;
            $row[] = !empty($u['telegram']) ? $u['telegram'] : '---';
            $row[] = '<small class="badge bg-dark me-1">'.$u['lastLoginIP'].'</small>'.$lastLogin;
            $row[] = $created;
            $row[] = !empty($u['remark']) ? $u['remark'] : '---';
            $row[] = $action;
            $data[] = $row;
            echo json_encode(['data'=>$data, 'code'=>1]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function userSearch()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $raw = json_decode(file_get_contents('php://input'),1);

        $usercreated = !empty($raw['ucreated']) ? $raw['ucreated'] : null;

        $payload = $this->user_model->selectSomeUser([
            'userid' => $_SESSION['token'],
            'role' => (int)$raw['role'],
            'id' => preg_replace('/\s+/', '', $raw['uid']),
            'loginid' => preg_replace('/\s+/', '', $raw['username']),
            'regioncode' => $raw['regioncode'],
            'contactno' => $raw['contact'],
            'name' => $raw['fname'],
            'ip' => $raw['ip'],
            'date' => $usercreated,
            'timezone' => 8
        ]);
        // echo json_encode($payload);

        if( $payload['code'] == 1 && $payload['data'] != [] ):
            $data = [];
            foreach( $payload['data'] as $u ):
                switch($u['status']):
                    case 1: $status = lang('Label.active'); break;
                    case 2: $status = lang('Label.inactive'); break;
                    case 3: $status = lang('Label.freeze'); break;
                    default: $status = '';
                endswitch;

                $date = Time::parse(date('Y-m-d H:i:s', strtotime($u['createDate'])));
                $created = $date->toDateTimeString();

                $loginDate = Time::parse(date('Y-m-d H:i:s', strtotime($u['lastLoginDate'])));
                $lastLogin = $loginDate->toDateTimeString();

                // MobileNo with Region
                $region = !empty($u['regionCode']) ? $u['regionCode'] : $_ENV['currencyCode'];
                // $contact = '<span class="badge bg-primary fw-normal rounded-0 me-1">'.$region.'</span>'.$u['contact'];
                $contact = '<span class="badge bg-dark fw-normal me-1">'.$region.'</span>';
                // End MobileNo with Region

                if( $raw['role']==4 ):
                    $action = '<div class="btn-groups">';
                    $action .= '<div class="btn-group me-1 mb-1" role="group">';
                    $action .= '<button id="credittranf" type="button" class="btn btn-vw btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">'.lang('Nav.credittransfer').'</button>';
                    $action .= '<ul class="dropdown-menu dropdown-menu-end border-white" aria-labelledby="credittranf">';
                    $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="openTransfer(\'4\',\''.base64_encode($u['userId']).'\',\''.$u['loginId'].'\',\''.$u['balance'].'\')">'.lang('Nav.credittransfer').'</a></li>';
                    $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="openPGTransfer(\''.base64_encode($u['userId']).'\',\''.$u['loginId'].'\',\''.$u['balance'].'\')">'.lang('Nav.pgreplenishment').'</a></li>';
                    $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="openFortuneToken(\''.base64_encode($u['userId']).'\',\''.$u['loginId'].'\')">'.lang('Nav.fortunetoken').'</a></li>';
                    $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="setPromo(\''.base64_encode($u['userId']).'\',\''.$u['loginId'].'\')">'.lang('Label.setpromotion').'</a></li>';
                    $action .= '</ul>';
                    $action .= '</div>';
                    $action .= '<a class="btn btn-vw btn-sm" href="'.base_url('score/log/'.base64_encode($u['userId'])).'">'.lang('Nav.scorelog').'</a>';
                    $action .= '<a class="btn btn-vw btn-sm" href="'.base_url('bet/log/'.base64_encode($u['userId'])).'">'.lang('Nav.betlog').'</a>';
                    $action .= '<a class="btn btn-vw btn-sm" href="'.base_url('actual/bet/log/'.base64_encode($u['userId'])).'">'.lang('Nav.actualbetlog').'</a>';
                    // $action .= '<a class="btn btn-primary btn-sm" href="'.base_url('user-transfer/log/'.base64_encode($u['userId'])).'">'.lang('Nav.transferlog').'</a>';
                    $action .= '<a class="btn btn-vw btn-sm" href="'.base_url('member/games/'.base64_encode($u['userId'])).'">'.lang('Nav.gamelist').'</a>';

                    $action .= '<div class="btn-group me-1 mb-1" role="group">';
                    $action .= '<button id="navProfile" type="button" class="btn btn-vw btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">'.lang('Nav.profile').'</button>';
                    $action .= '<ul class="dropdown-menu dropdown-menu-end border-white" aria-labelledby="navProfile">';
                    $action .= '<li><a class="dropdown-item" href="'.base_url('history/transaction/'.base64_encode($u['userId'])).'">'.lang('Nav.transaction').'</a></li>';
                    $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="userStatistics(\''.base64_encode($u['userId']).'\')">'.lang('Nav.statistic').'</a></li>';
                    $action .= '<li><a class="dropdown-item" href="'.base_url('user/bank-card/'.base64_encode($u['userId'])).'">'.lang('Nav.bankcard').'</a></li>';
                    $action .= '<li><a class="dropdown-item" href="'.base_url('member/affiliate-downline/'.base64_encode($u['userId'])).'">'.lang('Nav.affdownline').'</a></li>';
                    $action .= '<li class="dropdown-divider"></li>';
                    $action .= '<li><a class="dropdown-item" href="'.base_url('report/user/winlose/'.base64_encode($u['userId'])).'">'.lang('Nav.winlosereport').'</a></li>';
                    $action .= '<li><a class="dropdown-item" href="'.base_url('report/user/reference-winlose/'.base64_encode($u['userId'])).'">'.lang('Nav.refwinlosereport').'</a></li>';
                    $action .= '<li><a class="dropdown-item" href="'.base_url('user-report/affiliate/'.base64_encode($u['userId'])).'">'.lang('Nav.affiliatereport').'</a></li>';
                    $action .= '<li class="dropdown-divider"></li>';
                    $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="writeMessage(\''.base64_encode($u['userId']).'\')">'.lang('Nav.sendmail').'</a></li>';
                    $action .= '<li><a class="dropdown-item" href="'.base_url('user/inbox/'.base64_encode($u['userId'])).'">'.lang('Nav.inbox').'</a></li>';
                    $action .= '<li class="dropdown-divider"></li>';
                    $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="modifyRewardSettings(\''.base64_encode($u['userId']).'\');">'.lang('Nav.settings').'</a></li>';
                    $action .= '</ul>';
                    $action .= '</div>';

                    $action .= '<div class="btn-group me-1 mb-1" role="group">';
                    $action .= '<button id="credittranf" type="button" class="btn btn-vw btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">'.lang('Nav.password').'</button>';
                    $action .= '<ul class="dropdown-menu dropdown-menu-end border-white" aria-labelledby="credittranf">';
                    $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="resetVaultPin(\''.base64_encode($u['userId']).'\')">'.lang('Nav.resetvault').'</a></li>';
                    $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="resetSecondPass(\''.base64_encode($u['userId']).'\')">'.lang('Nav.reset2ndpass').'</a></li>';
                    $action .= '</ul>';
                    $action .= '</div>';

                    if( $_SESSION['role']==2 || (($_SESSION['uplinerole']==2 && $_SESSION['role']==5) && $_SESSION['userprofile']==1) ):
                    $action .= '<a class="btn btn-vw btn-sm" href="javascript:void(0);" onclick="modify(\''.base64_encode($u['userId']).'\',\''.$u['loginId'].'\');">'.lang('Nav.edit').'</a>';
                    endif;

                    $action .= '<a class="btn btn-vw btn-sm" href="javascript:void(0);" onclick="affiliateQR(\''.base64_encode($u['userId']).'\');">'.lang('Nav.share').'</a>';

                    if( $u['status']==1 ):
                        $action .= '<a class="btn btn-success btn-sm bg-gradient" href="javascript:void(0);" onclick="modifyStatus(\''.base64_encode($u['userId']).'\', 2)">'.lang('Label.active').'</a>';
                    else:
                        $action .= '<a class="btn btn-danger btn-sm bg-gradient" href="javascript:void(0);" onclick="modifyStatus(\''.base64_encode($u['userId']).'\', 1)">'.lang('Label.inactive').'</a>';
                    endif;
                    $action .= '</div>';

                    $btngame = '<button class="btn btn-light btn-sm getupline ms-1" data-uid="'.base64_encode($u['userId']).'"><i class="bx bxs-user-account"></i></button>';
                    if( !empty($u['affiliateId']) ):
                        $btngame .= '<button class="btn btn-light btn-sm ms-1" onclick="affiliateUpline(\''.base64_encode($u['affiliateId']).'\');"><i class="bx bxs-purchase-tag-alt"></i></button>';
                    else:
                        $btngame .= '';
                    endif;
    
                    $gameid = '<button class="btn btn-light btn-sm ms-1" onclick="gameid(\''.base64_encode($u['userId']).'\');"><i class="bx bx-joystick"></i></button>';
                    $clearTurnover = '<button class="btn btn-light btn-sm ms-1" onclick="clearTurnover(\''.base64_encode($u['userId']).'\')"><i class="bx bxs-shield-x text-danger"></i></button>';
    
                    $blc = '<button class="btn btn-light btn-sm ms-1" onclick="coinBag(\''.base64_encode($u['userId']).'\');"><i class="bx bx-coin"></i></button>';
                    $blc .= '<button class="btn btn-light btn-sm ms-1" onclick="gameBalance(\''.base64_encode($u['userId']).'\');"><i class="bx bx-wallet"></i></button>';

                    //FREE CREDIT
                    $clear = '<button class="btn btn-light btn-sm ms-1" onclick="withdrawCredit(\''.base64_encode($u['userId']).'\',\''.$u['loginId'].'\');"><i class="bx bx-eraser"></i></button>';

                    if( $_SESSION['role']==2 || (($_SESSION['uplinerole']==2 && $_SESSION['role']==5) && $_SESSION['userprofile']==1) ):
                        $rightMobile = !empty($u['contact'])?$contact.$u['contact']:'---';
                    else:
                        $rightMobile = '---';
                    endif;

                    //Get user cash and chip
                    $resFindUser = $this->user_model->selectUser(['userid' => $u['userId']]);
                    if( $resFindUser['code']==1 && $resFindUser['data']!=[] ):
                        $grandbgw = 0;
                        $subgwamt = 0;
                        $subgwafter = 0;
                        foreach( $resFindUser['data']['gameWallet'] as $gw ):
                            $subgwamt += $gw['amount'];
                            $subgwafter += $gw['afterAmount'];
                        endforeach;
                        $grandbgw = $subgwamt - $subgwafter;

                        $grandbw = 0;
                        $subwamt = 0;
                        $subwafter = 0;
                        foreach( $resFindUser['data']['wallet'] as $w ):
                            $subwamt += $w['amount'];
                            $subwafter += $w['afterAmount'];
                        endforeach;
                        $grandbw = $subwamt - $subwafter;

                        $grandcgw = 0;
                        $subcgamt = 0;
                        $subcgafter = 0;
                        foreach( $resFindUser['data']['gpGroupWalletList'] as $cg ):
                            $subcgamt += $cg['amount'];
                            $subcgafter += $cg['afterAmount'];
                        endforeach;
                        $grandcgw = $subcgamt - $subcgafter;

                        $grandcash = $resFindUser['data']['balance'] - ($grandbw + $grandbgw + $grandcgw);
                        $grandchip = $grandbw + $grandbgw + $grandcgw;
            
                        // $final_grandcash = floor($grandcash * 10000)/10000;
                        $final_grandcash = $grandcash>0 ? floor($grandcash * 10000)/10000 : 0;
                        $final_grandchip = floor($grandchip * 10000)/10000;
                    endif;

                    $row = [];
                    $row[] = $u['loginId'];
                    //$row[] = $u['name'].$btngame.$gameid.$blc.$clearTurnover;
                    $row[] = $u['name'].$btngame.$gameid.$blc.$clearTurnover.$clear;
                    $row[] = $u['userId'];
                    $row[] = $status;
                    $row[] = $u['balance'];
                    $row[] = $final_grandcash;
                    $row[] = $final_grandchip;
                    $row[] = $u['agentBalance'];
                    //$row[] = $u['safeBalance'];
                    $row[] = $rightMobile;
                    $row[] = !empty($u['telegram']) ? $u['telegram'] : '---';
                    $row[] = '<small class="badge bg-dark me-1">'.$u['lastLoginIP'].'</small>'.$lastLogin;
                    $row[] = $created;
                    $row[] = !empty($u['remark']) ? $u['remark'] : '---';
                    $row[] = $action;
                    $data[] = $row;
                elseif( $raw['role']==3 ):
                    $action = '<div class="btn-groups">';
                    $action .= '<a class="btn btn-vw btn-sm" href="javascript:void(0);" onclick="openTransfer(\'3\',\''.base64_encode($u['userId']).'\',\''.$u['loginId'].'\', \''.$u['balance'].'\');">'.lang('Nav.credittransfer').'</a>';
                    $action .= '<a class="btn btn-vw btn-sm" href="'.base_url('agent/fight-shares/'.base64_encode($u['userId'])).'">'.lang('Nav.shares').'</a>';

                    // $action .= '<a class="btn btn-vw btn-sm" href="'.base_url('agent/position-taking/'.base64_encode($u['userId'])).'">'.lang('Nav.positiontaking').'</a>';

                    // $action .= '<a class="btn btn-vw btn-sm" href="'.base_url('agent/downline/'.base64_encode($u['userId'])).'">'.lang('Label.agent').'</a>';
                    $action .= '<a class="btn btn-vw btn-sm" href="'.base_url('member/downline/'.base64_encode($u['userId'])).'">'.lang('Label.member').'</a>';
                    $action .= '<a class="btn btn-vw btn-sm" href="'.base_url('agent/games/'.base64_encode($u['userId'])).'">'.lang('Nav.gamelist').'</a>';

                    $action .= '<div class="btn-group me-1 mb-1" role="group">';
                    $action .= '<button id="navProfile" type="button" class="btn btn-vw btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">'.lang('Nav.profile').'</button>';
                    $action .= '<ul class="dropdown-menu dropdown-menu-end border-white" aria-labelledby="navProfile">';
                    $action .= '<li><a class="dropdown-item" href="'.base_url('history/transaction/'.base64_encode($u['userId'])).'">'.lang('Nav.transaction').'</a></li>';
                    $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="agentStatistics(\''.base64_encode($u['userId']).'\')">'.lang('Nav.statistic').'</a></li>';
                    $action .= '<li class="dropdown-divider"></li>';
                    // $action .= '<li><a class="dropdown-item" href="'.base_url('report/user-ptps-fight/'.base64_encode($u['userId'])).'">'.lang('Nav.fightlistreport').'</a></li>';
                    // $action .= '<li><a class="dropdown-item" href="'.base_url('report/user-ptps-shares/'.base64_encode($u['userId'])).'">'.lang('Nav.shareslistreport').'</a></li>';
                    // $action .= '<li><a class="dropdown-item" href="'.base_url('report/profit-sharing/'.base64_encode($u['userId'])).'">'.lang('Nav.sharesreport').'</a></li>';
                    // $action .= '<li><a class="dropdown-item" href="'.base_url('report/profit-sharing-v2/'.base64_encode($u['userId'])).'">'.lang('Nav.profitreport').'</a></li>';

                    $action .= '<li><a class="dropdown-item" href="'.base_url('group-report/profit-sharing/'.base64_encode($u['userId'])).'">'.lang('Nav.sharesreport').'-New</a></li>';
                    $action .= '<li><a class="dropdown-item" href="'.base_url('personal-report/profit-sharing/'.base64_encode($u['userId'])).'">'.lang('Nav.profitreport').'-New</a></li>';

                    $action .= '<li><a class="dropdown-item" href="'.base_url('report4/profit-sharing/'.base64_encode($u['userId'])).'">'.lang('Nav.sharesreport').'</a></li>';
                    $action .= '<li><a class="dropdown-item" href="'.base_url('report4/profit-sharing-v2/'.base64_encode($u['userId'])).'">'.lang('Nav.profitreport').'</a></li>';

                    $action .= '<li class="dropdown-divider"></li>';
                    $action .= '<li><a class="dropdown-item" href="'.base_url('report/user/winlose/'.base64_encode($u['userId'])).'">'.lang('Nav.winlosereport').'</a></li>';
                    $action .= '<li><a class="dropdown-item" href="'.base_url('report/user/reference-winlose/'.base64_encode($u['userId'])).'">'.lang('Nav.refwinlosereport').'</a></li>';
                    $action .= '<li><a class="dropdown-item" href="'.base_url('user-report/agent-commission/'.base64_encode($u['userId'])).'">'.lang('Nav.agcommreport').'</a></li>';
                    $action .= '<li class="dropdown-divider"></li>';

                    if( $u['rewardSettings']['displayAgentBankCard']==true ):
                        $action .= '<li><a class="dropdown-item" href="'.base_url('user/bank-card/'.base64_encode($u['userId'])).'">'.lang('Nav.bankcard').'</a></li>';
                    endif;

                    if( $u['rewardSettings']['displayAgentPaymentGateway']==true ):
                        $action .= '<li><a class="dropdown-item" href="'.base_url('user/payment-gateway/'.base64_encode($u['userId'])).'">'.lang('Label.paygateway').'</a></li>';
                    endif;

                    $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="modifyRewardSettings(\''.base64_encode($u['userId']).'\');">'.lang('Nav.settings').'</a></li>';
                    $action .= '</ul>';
                    $action .= '</div>';

                    $action .= '<div class="btn-group me-1 mb-1" role="group">';
                    $action .= '<button id="credittranf" type="button" class="btn btn-vw btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">'.lang('Nav.password').'</button>';
                    $action .= '<ul class="dropdown-menu dropdown-menu-end border-white" aria-labelledby="credittranf">';
                    // $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="resetVaultPin(\''.base64_encode($u['userId']).'\')">'.lang('Nav.resetvault').'</a></li>';
                    $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="resetSecondPass(\''.base64_encode($u['userId']).'\')">'.lang('Nav.reset2ndpass').'</a></li>';
                    $action .= '</ul>';
                    $action .= '</div>';

                    //if( $_SESSION['role']==2 || (($_SESSION['uplinerole']==2 && $_SESSION['role']==5) && $_SESSION['userprofile']==1) ):
                    //$action .= '<a class="btn btn-vw btn-sm" href="javascript:void(0);" onclick="modify(\''.base64_encode($u['userId']).'\',\''.$u['loginId'].'\');">'.lang('Nav.edit').'</a>';
                    //endif;
                    $action .= '<a class="btn btn-vw btn-sm" href="javascript:void(0);" onclick="affiliateQR(\''.base64_encode($u['userId']).'\');">'.lang('Nav.share').'</a>';

                    $action .= '<a class="btn btn-vw btn-sm" href="javascript:void(0);" onclick="agentPermission(\''.base64_encode($u['userId']).'\')">'.lang('Nav.userpermission').'</a>'; //permit

                    //if( $u['status']==1 ):
                    //    $action .= '<a class="btn btn-success btn-sm bg-gradient" href="javascript:void(0);" onclick="modifyStatus(\''.base64_encode($u['userId']).'\', 2)">'.lang('Label.active').'</a>';
                    //else:
                    //    $action .= '<a class="btn btn-danger btn-sm bg-gradient" href="javascript:void(0);" onclick="modifyStatus(\''.base64_encode($u['userId']).'\', 1)">'.lang('Label.inactive').'</a>';
                    //endif;
                    $action .= '</div>';

                    $btngame = '<button class="btn btn-light btn-sm getupline ms-1" data-uid="'.base64_encode($u['userId']).'"><i class="bx bxs-user-account"></i></button>';
                    $checkNegative = '<button type="button" class="btn btn-primary btn-sm ms-1" onclick="getNegSum(\''.base64_encode($u['userId']).'\');"><i class="bx bx-math"></i></button>';

                    if( $_SESSION['role']==2 || (($_SESSION['uplinerole']==2 && $_SESSION['role']==5) && $_SESSION['userprofile']==1) ):
                        $rightMobile = !empty($u['contact'])?$contact.$u['contact']:'---';
                    else:
                        $rightMobile = '---';
                    endif;

                    $row = [];
                    $row[] = $u['loginId'];
                    $row[] = '<a class="" href="'.base_url('agent/downline/'.base64_encode($u['userId'])).'">'.$u['name'].'</a>'.$checkNegative.$btngame;
                    $row[] = $u['userId'];
                    $row[] = $status;
                    $row[] = $u['balance'];
                    $row[] = 0;
                    $row[] = 0;
                    $row[] = $u['agentBalance'];
                    //$row[] = $u['safeBalance'];
                    $row[] = $rightMobile;
                    $row[] = !empty($u['telegram']) ? $u['telegram'] : '---';
                    $row[] = '<small class="badge bg-dark me-1">'.$u['lastLoginIP'].'</small>'.$lastLogin;
                    $row[] = $created;
                    $row[] = !empty($u['remark']) ? $u['remark'] : '---';
                    $row[] = $action;
                    $data[] = $row;
                endif;
            endforeach;
            echo json_encode(['data'=>$data, 'code'=>1]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    /*
    Sub Account
    */

    public function addSubAccount()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $permission = '{"major":{"transaction":"1","report":"1","account":"0","gameprovider":"0","settings":"0","extra":"0","usersearch":"0","userprofile":"0","confidential":"0"}}';

        $username  = strtoupper($_SESSION['username']).'SUB'.$this->request->getpost('params')['username'];

        $payload = [
            'loginid' => strtoupper($username),
            'password' => $this->request->getpost('params')['password'],
            'name' => $this->request->getpost('params')['fname'],
            'contact' => $this->request->getpost('params')['contact'],
            'remark' => $this->request->getpost('params')['remark'],
            'permission' => $permission,
            'role' => 5 // SubAccount
        ];
        $res = $this->user_model->insertUser($payload);
        echo json_encode($res);
    }
    
    //Hub
    public function addHubSubAccount()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $permission = '{"major":{"transaction":"1","report":"1","account":"0","gameprovider":"0","settings":"0","extra":"0","usersearch":"0","userprofile":"0","confidential":"0"}}';

        $username  = strtoupper($_SESSION['username']).'SUB'.$this->request->getpost('params')['username'];

        $payload = [
            'loginid' => strtoupper($username),
            'password' => $this->request->getpost('params')['password'],
            'name' => $this->request->getpost('params')['fname'],
            'regioncode' => $this->request->getpost('params')['regioncode'],
            'contact' => $this->request->getpost('params')['contact'],
            'remark' => $this->request->getpost('params')['remark'],
            'permission' => $permission,
            'role' => 5, // SubAccount
            'currencycode' => 0
        ];
        $res = $this->user_model->insertHubUser($payload);
        echo json_encode($res);
    }

    public function subAccountList()
    {
        $raw = json_decode(file_get_contents('php://input'),1);

        $payload = $this->user_model->selectAllUser([
            'userid' => $_SESSION['token'], 
            'role' => 5, 
            'pageindex' => $raw['pageindex'],
            'rowperpage' => $raw['rowperpage']
        ]);
        // echo json_encode($payload);

        if( $payload['code'] == 1 && $payload['data'] != [] ):
            $data = [];
            foreach( $payload['data'] as $u ):
                switch($u['status']):
                    case 1: $status = lang('Label.active'); break;
                    case 2: $status = lang('Label.inactive'); break;
                    case 3: $status = lang('Label.freeze'); break;
                    default: $status = '';
                endswitch;
                
                $date = Time::parse(date('Y-m-d H:i:s', strtotime($u['createDate'])), 'Asia/Kuala_Lumpur');
                $created = $date->toDateTimeString();

                $loginDate = Time::parse(date('Y-m-d H:i:s', strtotime($u['lastLoginDate'])), 'Asia/Kuala_Lumpur');
                $lastLogin = $loginDate->toDateTimeString();

                $action = '<div class="btn-groups">';
                // $action .= '<a class="btn btn-primary btn-sm" href="javascript:void(0);" onclick="resetPass(\''.base64_encode($u['userId']).'\')">'.lang('Nav.resetpass').'</a>';
                // $action .= '<a class="btn btn-primary btn-sm" href="javascript:void(0);" onclick="modifyPass(\''.base64_encode($u['userId']).'\')">'.lang('Nav.chgpass').'</a>';
                $action .= '<a class="btn btn-primary btn-sm" href="javascript:void(0);" onclick="permission(\''.base64_encode($u['userId']).'\')">'.lang('Nav.userpermission').'</a>';
                $action .= '<a class="btn btn-primary btn-sm" href="javascript:void(0);" onclick="modify(\''.base64_encode($u['userId']).'\',\''.$u['loginId'].'\')">'.lang('Nav.edit').'</a>';
                if( $u['status']==1 ):
                    $action .= '<a class="btn btn-success btn-sm" href="javascript:void(0);" onclick="modifyStatus(\''.base64_encode($u['userId']).'\', 3)">'.lang('Label.active').'</a>';
                else:
                    $action .= '<a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="modifyStatus(\''.base64_encode($u['userId']).'\', 1)">'.lang('Label.inactive').'</a>';
                endif;
                $action .= '</div>';

                $row = [];
                $row[] = $status;
                $row[] = $u['loginId'];
                $row[] = $u['name'];
                $row[] = !empty($u['contact']) ? $u['contact'] : '---';
                $row[] = !empty($u['remark']) ? $u['remark'] : '---';
                $row[] = '<small class="badge bg-dark me-1">'.$u['lastLoginIP'].'</small>'.$lastLogin;
                $row[] = $created;
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(['data'=>$data, 'code'=>1, 'pageIndex'=>$payload['pageIndex'], 'rowPerPage'=>$payload['rowPerPage'], 'totalPage'=>$payload['totalPage'], 'totalRecord'=>$payload['totalRecord']]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    //Hub
    public function subAccountHubList()
    {
        $raw = json_decode(file_get_contents('php://input'),1);

        $payload = $this->user_model->selectAllUserHub([
            'userid' => $_SESSION['token'], 
            'role' => 5, 
            'pageindex' => $raw['pageindex'],
            'rowperpage' => $raw['rowperpage']
        ]);
        // echo json_encode($payload);

        if( $payload['code'] == 1 && $payload['data'] != [] ):
            $data = [];
            foreach( $payload['data'] as $u ):
                switch($u['status']):
                    case 1: $status = lang('Label.active'); break;
                    case 2: $status = lang('Label.inactive'); break;
                    case 3: $status = lang('Label.freeze'); break;
                    default: $status = '';
                endswitch;
                
                $date = Time::parse(date('Y-m-d H:i:s', strtotime($u['createDate'])), 'Asia/Kuala_Lumpur');
                $created = $date->toDateTimeString();

                $loginDate = Time::parse(date('Y-m-d H:i:s', strtotime($u['lastLoginDate'])), 'Asia/Kuala_Lumpur');
                $lastLogin = $loginDate->toDateTimeString();

                $action = '<div class="btn-groups">';
                // $action .= '<a class="btn btn-primary btn-sm" href="javascript:void(0);" onclick="resetPass(\''.base64_encode($u['userId']).'\')">'.lang('Nav.resetpass').'</a>';
                // $action .= '<a class="btn btn-primary btn-sm" href="javascript:void(0);" onclick="modifyPass(\''.base64_encode($u['userId']).'\')">'.lang('Nav.chgpass').'</a>';
                $action .= '<a class="btn btn-primary btn-sm" href="javascript:void(0);" onclick="subAccPermission(\''.base64_encode($u['id']).'\')">'.lang('Nav.userpermission').'</a>';
                $action .= '<a class="btn btn-primary btn-sm" href="javascript:void(0);" onclick="modifyHubUser(\''.base64_encode($u['id']).'\',\''.$u['loginId'].'\')">'.lang('Nav.edit').'</a>';
                if( $u['status']==1 ):
                    $action .= '<a class="btn btn-success btn-sm" href="javascript:void(0);" onclick="modifyHubStatus(\''.base64_encode($u['id']).'\', 3)">'.lang('Label.active').'</a>';
                else:
                    $action .= '<a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="modifyHubStatus(\''.base64_encode($u['id']).'\', 1)">'.lang('Label.inactive').'</a>';
                endif;
                $action .= '</div>';

                $row = [];
                $row[] = $status;
                $row[] = $u['loginId'];
                $row[] = $u['name'];
                $row[] = !empty($u['contact']) ? $u['contact'] : '---';
                $row[] = !empty($u['remark']) ? $u['remark'] : '---';
                $row[] = '<small class="badge bg-dark me-1">'.$u['lastLoginIP'].'</small>'.$lastLogin;
                $row[] = $created;
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(['data'=>$data, 'code'=>1, 'pageIndex'=>$payload['pageIndex'], 'rowPerPage'=>$payload['rowPerPage'], 'totalPage'=>$payload['totalPage'], 'totalRecord'=>$payload['totalRecord']]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    /*
    Member
    */

    public function userGameId()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('uid')),
        ];
        $res = $this->user_model->selectUserGameId($payload);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $data = [];
            foreach( $res['data'] as $u ):
                $password = !empty($u['username']) && !empty($u['password']) ? '<span class="ms-2 me-1 badge bg-primary fw-normal">'.lang('Input.password').':</span>'.$u['password'] : '';

                $row = [];
                $row[] = '<span class="badge bg-primary fw-normal me-1">'.$u['gameProviderCode'].'</span>'.$u['gameProviderName'];
                $row[] = $u['username'].$password;
                $data[] = $row;
            endforeach;

            $output = $data!=[] ? ['data'=>$data] : ['no data'];
            echo json_encode($output);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function userAffiliateDownline()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('parent'))
        ];
        $res = $this->user_model->selectAllAffiliate($payload);
        // echo json_encode($res);

        if( $res['code']==1 && $res['data']!=[] ):
            $data = [];
            if( $res['data']['data']!=[] ):
                foreach( $res['data']['data'] as $u ):
                    $action = '<div class="btn-groups">';

                    $action .= '<a class="btn btn-primary btn-sm" href="'.base_url('score/log/'.base64_encode($u['userId'])).'">'.lang('Nav.scorelog').'</a>';
                    $action .= '<a class="btn btn-primary btn-sm" href="'.base_url('bet/log/'.base64_encode($u['userId'])).'">'.lang('Nav.betlog').'</a>';
                    $action .= '<a class="btn btn-primary btn-sm" href="'.base_url('actual/bet/log/'.base64_encode($u['userId'])).'">'.lang('Nav.actualbetlog').'</a>';
                    $action .= '<a class="btn btn-primary btn-sm" href="'.base_url('member/games/'.base64_encode($u['userId'])).'">'.lang('Nav.gamelist').'</a>';

                    $action .= '<div class="btn-group me-1 mb-1" role="group">';
                    $action .= '<button id="navProfile" type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">'.lang('Nav.profile').'</button>';
                    $action .= '<ul class="dropdown-menu dropdown-menu-end border-white" aria-labelledby="navProfile">';
                    $action .= '<li><a class="dropdown-item" href="'.base_url('history/transaction/'.base64_encode($u['userId'])).'">'.lang('Nav.transaction').'</a></li>';
                    $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="userStatistics(\''.base64_encode($u['userId']).'\')">'.lang('Nav.statistic').'</a></li>';
                    $action .= '<li><a class="dropdown-item" href="'.base_url('user/bank-card/'.base64_encode($u['userId'])).'">'.lang('Nav.bankcard').'</a></li>';
                    $action .= '<li><a class="dropdown-item" href="'.base_url('member/affiliate-downline/'.base64_encode($u['userId'])).'">'.lang('Nav.affdownline').'</a></li>';
                    $action .= '<li class="dropdown-divider"></li>';
                    $action .= '<li><a class="dropdown-item" href="'.base_url('report/user/winlose/'.base64_encode($u['userId'])).'">'.lang('Nav.winlosereport').'</a></li>';
                    $action .= '<li><a class="dropdown-item" href="'.base_url('report/user/reference-winlose/'.base64_encode($u['userId'])).'">'.lang('Nav.refwinlosereport').'</a></li>';
                    $action .= '<li class="dropdown-divider"></li>';
                    $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="writeMessage(\''.base64_encode($u['userId']).'\')">'.lang('Nav.sendmail').'</a></li>';
                    $action .= '<li><a class="dropdown-item" href="'.base_url('user/inbox').'">'.lang('Nav.inbox').'</a></li>';
                    $action .= '<li class="dropdown-divider"></li>';
                    $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="modifyRewardSettings(\''.base64_encode($u['userId']).'\');">'.lang('Nav.settings').'</a></li>';
                    $action .= '</ul>';
                    $action .= '</div>';

                    if( $_SESSION['role']==2 || (($_SESSION['uplinerole']==2 && $_SESSION['role']==5) && $_SESSION['userprofile']==1) ):
                    $action .= '<a class="btn btn-primary btn-sm" href="javascript:void(0);" onclick="modify(\''.base64_encode($u['userId']).'\',\''.$u['loginId'].'\');">'.lang('Nav.edit').'</a>';
                    endif;
                    $action .= '<a class="btn btn-primary btn-sm" href="javascript:void(0);" onclick="copyRegUrl(\''.$_ENV['affiliate'].'/'.base64_encode($u['userId']).'\');">'.lang('Nav.share').'</a>';
                    $action .= '</div>';

                    $row = [];
                    $row[] = $u['downlineCount'];
                    $row[] = '<a href="'.base_url('member/affiliate-downline/'.base64_encode($u['userId'])).'">'.$u['loginId'].'</a>';
                    $row[] = $action;
                    $data[] = $row;
                endforeach;
                echo json_encode(['data'=>$data]);
            else:
                echo json_encode(['no data']);
            endif;
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function addMember()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $rules = [
            'params.password' => ['label'=>'Password','rules'=>'required|min_length[6]|max_length[15]'],
        ];

        $referrer = !empty($this->request->getpost('params')['referral']) ? $this->request->getpost('params')['referral'] : $_SESSION['token'];

        $subStandard = strtoupper($_SESSION['username']).'SUB';
        if( strpos($this->request->getPost('params')['username'], $subStandard)!== false ):
            echo json_encode(['code'=>-1, 'message'=>lang('Validation.usernameforbidden')]);
        else:
            $name = strtoupper($this->request->getpost('params')['username']);
            if( $name=='AGENT' || $name=='ADMINISTRATOR' ):
                echo json_encode(['code'=>-1, 'message'=>lang('Validation.usernameforbidden')]);
            else:
                if( $this->validate($rules) ):
                    $payload = [
                        'agentid' => strtolower($referrer),
                        'realname' => $this->request->getpost('params')['fname'],
                        'loginid'=> preg_replace("/\s+/", "", strtolower($this->request->getpost('params')['username'])),
                        'password'=> $this->request->getpost('params')['password'],
                        'name'=> $this->request->getpost('params')['fname'],
                        'contact'=> $this->request->getpost('params')['contact'],
                        'gender' => 1,
                        'remark' => $this->request->getpost('params')['remark'],
                        'role'=> 4 // Member
                    ];
                    $res = $this->user_model->insertUserMember($payload);
                    echo json_encode($res);
                else:
                    echo json_encode([
                        'code' => -1,
                        'message' => $this->validator->getError('params.password')
                    ]);
                endif;
            endif;
        endif;
    }

    public function memberList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $raw = json_decode(file_get_contents('php://input'),1);

        $usercreated = !empty($raw['ucreated']) ? $raw['ucreated'] : null;

        $refer = $raw['parent'] ? base64_decode($raw['parent']) : $_SESSION['token'];
        $payload = $this->user_model->selectAllUser([
            'userid' => $refer, 
            'role' => 4, 
            'timezone' => 8,
            'loginid' => $raw['username'],
            'regioncode' => $raw['regioncode'],
            'contactno' => $raw['contact'],
            'status' => (int)$raw['status'],
            'date' => $usercreated,
            'pageindex' => $raw['pageindex'],
            'rowperpage' => $raw['rowperpage']
        ]);
        // echo json_encode($payload);

        if( $payload['code'] == 1 && $payload['data'] != [] ):
            $data = [];
            foreach( $payload['data'] as $u ):
                switch($u['status']):
                    case 1: $status = lang('Label.active'); break;
                    case 2: $status = lang('Label.inactive'); break;
                    case 3: $status = lang('Label.freeze'); break;
                    default: $status = '';
                endswitch;
                
                $date = Time::parse(date('Y-m-d H:i:s', strtotime($u['createDate'])));
                $created = $date->toDateTimeString();

                $loginDate = Time::parse(date('Y-m-d H:i:s', strtotime($u['lastLoginDate'])));
                $lastLogin = $loginDate->toDateTimeString();

                $action = '<div class="btn-groups">';

                $action .= '<div class="btn-group me-1 mb-1" role="group">';
                $action .= '<button id="credittranf" type="button" class="btn btn-vw btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">'.lang('Nav.credittransfer').'</button>';
                $action .= '<ul class="dropdown-menu dropdown-menu-end border-white" aria-labelledby="credittranf">';
                $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="openTransfer(\'4\',\''.base64_encode($u['userId']).'\',\''.$u['loginId'].'\',\''.$u['balance'].'\')">'.lang('Nav.credittransfer').'</a></li>';
                $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="openPGTransfer(\''.base64_encode($u['userId']).'\',\''.$u['loginId'].'\',\''.$u['balance'].'\')">'.lang('Nav.pgreplenishment').'</a></li>';
                $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="openFortuneToken(\''.base64_encode($u['userId']).'\',\''.$u['loginId'].'\')">'.lang('Nav.fortunetoken').'</a></li>';
                $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="setPromo(\''.base64_encode($u['userId']).'\',\''.$u['loginId'].'\')">'.lang('Label.setpromotion').'</a></li>';
                $action .= '</ul>';
                $action .= '</div>';
                $action .= '<a class="btn btn-vw btn-sm" href="'.base_url('score/log/'.base64_encode($u['userId'])).'">'.lang('Nav.scorelog').'</a>';

                $action .= '<a class="btn btn-vw btn-sm" href="'.base_url('bet/log/'.base64_encode($u['userId'])).'">'.lang('Nav.betlog').'</a>';
                $action .= '<a class="btn btn-vw btn-sm" href="'.base_url('actual/bet/log/'.base64_encode($u['userId'])).'">'.lang('Nav.actualbetlog').'</a>';
                // $action .= '<a class="btn btn-primary btn-sm" href="'.base_url('user-transfer/log/'.base64_encode($u['userId'])).'">'.lang('Nav.transferlog').'</a>';
                $action .= '<a class="btn btn-vw btn-sm" href="'.base_url('member/games/'.base64_encode($u['userId'])).'">'.lang('Nav.gamelist').'</a>';

                $action .= '<div class="btn-group me-1 mb-1" role="group">';
                $action .= '<button id="navProfile" type="button" class="btn btn-vw btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">'.lang('Nav.profile').'</button>';
                $action .= '<ul class="dropdown-menu dropdown-menu-end border-white" aria-labelledby="navProfile">';
                $action .= '<li><a class="dropdown-item" href="'.base_url('history/transaction/'.base64_encode($u['userId'])).'">'.lang('Nav.transaction').'</a></li>';
                $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="userStatistics(\''.base64_encode($u['userId']).'\')">'.lang('Nav.statistic').'</a></li>';
                $action .= '<li><a class="dropdown-item" href="'.base_url('user/bank-card/'.base64_encode($u['userId'])).'">'.lang('Nav.bankcard').'</a></li>';
                $action .= '<li><a class="dropdown-item" href="'.base_url('member/affiliate-downline/'.base64_encode($u['userId'])).'">'.lang('Nav.affdownline').'</a></li>';
                $action .= '<li class="dropdown-divider"></li>';
                // $action .= '<li><a class="dropdown-item" href="'.base_url('report/user/winlose/'.base64_encode($u['userId'])).'">'.lang('Nav.report').'</a></li>';
                $action .= '<li><a class="dropdown-item" href="'.base_url('report/user/winlose/'.base64_encode($u['userId'])).'">'.lang('Nav.winlosereport').'</a></li>';
                $action .= '<li><a class="dropdown-item" href="'.base_url('report/user/reference-winlose/'.base64_encode($u['userId'])).'">'.lang('Nav.refwinlosereport').'</a></li>';
                $action .= '<li><a class="dropdown-item" href="'.base_url('user-report/affiliate/'.base64_encode($u['userId'])).'">'.lang('Nav.affiliatereport').'</a></li>';
                $action .= '<li class="dropdown-divider"></li>';
                $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="writeMessage(\''.base64_encode($u['userId']).'\')">'.lang('Nav.sendmail').'</a></li>';
                $action .= '<li><a class="dropdown-item" href="'.base_url('user/inbox/'.base64_encode($u['userId'])).'">'.lang('Nav.inbox').'</a></li>';
                $action .= '<li class="dropdown-divider"></li>';
                $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="modifyRewardSettings(\''.base64_encode($u['userId']).'\');">'.lang('Nav.settings').'</a></li>';
                $action .= '</ul>';
                $action .= '</div>';

                $action .= '<div class="btn-group me-1 mb-1" role="group">';
                $action .= '<button id="credittranf" type="button" class="btn btn-vw btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">'.lang('Nav.password').'</button>';
                $action .= '<ul class="dropdown-menu dropdown-menu-end border-white" aria-labelledby="credittranf">';
                $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="resetVaultPin(\''.base64_encode($u['userId']).'\')">'.lang('Nav.resetvault').'</a></li>';
                $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="resetSecondPass(\''.base64_encode($u['userId']).'\')">'.lang('Nav.reset2ndpass').'</a></li>';
                $action .= '</ul>';
                $action .= '</div>';

                if( $_SESSION['role']==2 || (($_SESSION['uplinerole']==2 && $_SESSION['role']==5) && $_SESSION['userprofile']==1) ):
                $action .= '<a class="btn btn-vw btn-sm" href="javascript:void(0);" onclick="modify(\''.base64_encode($u['userId']).'\',\''.$u['loginId'].'\');">'.lang('Nav.edit').'</a>';
                endif;

                $action .= '<a class="btn btn-vw btn-sm" href="javascript:void(0);" onclick="affiliateQR(\''.base64_encode($u['userId']).'\');">'.lang('Nav.share').'</a>';

                if( $u['status']==1 ):
                    $action .= '<a class="btn btn-success btn-sm bg-gradient" href="javascript:void(0);" onclick="modifyStatus(\''.base64_encode($u['userId']).'\', 2)">'.lang('Label.active').'</a>';
                else:
                    $action .= '<a class="btn btn-danger btn-sm bg-gradient" href="javascript:void(0);" onclick="modifyStatus(\''.base64_encode($u['userId']).'\', 1)">'.lang('Label.inactive').'</a>';
                endif;
                $action .= '</div>';

                if( !empty($u['affiliateId']) ):
                    $btngame = '<button class="btn btn-light btn-sm ms-1" onclick="affiliateUpline(\''.base64_encode($u['affiliateId']).'\');"><i class="bx bxs-purchase-tag-alt"></i></button>';
                else:
                    $btngame = '';
                endif;

                $gameid = '<button class="btn btn-light btn-sm ms-1" onclick="gameid(\''.base64_encode($u['userId']).'\');"><i class="bx bx-joystick"></i></button>';
                $clearTurnover = '<button class="btn btn-light btn-sm ms-1" onclick="clearTurnover(\''.base64_encode($u['userId']).'\')"><i class="bx bxs-shield-x text-danger"></i></button>';

                $blc = '<button class="btn btn-light btn-sm ms-1" onclick="coinBag(\''.base64_encode($u['userId']).'\');"><i class="bx bx-coin"></i></button>';
                $blc .= '<button class="btn btn-light btn-sm ms-1" onclick="gameBalance(\''.base64_encode($u['userId']).'\');"><i class="bx bx-wallet"></i></button>';

                //FREE CREDIT
                $clear = '<button class="btn btn-light btn-sm ms-1" onclick="withdrawCredit(\''.base64_encode($u['userId']).'\',\''.$u['loginId'].'\');"><i class="bx bx-eraser"></i></button>';

                // MobileNo with Region
                $region = !empty($u['regionCode']) ? $u['regionCode'] : $_ENV['currencyCode'];
                // $contact = '<span class="badge bg-primary fw-normal rounded-0 me-1">'.$region.'</span>'.$u['contact'];
                $contact = '<span class="badge bg-dark fw-normal me-1">'.$region.'</span>';
                // End MobileNo with Region

                if( $_SESSION['role']==2 || (($_SESSION['uplinerole']==2 && $_SESSION['role']==5) && $_SESSION['userprofile']==1) ):
                    $rightMobile = !empty($u['contact'])?$contact.$u['contact']:'---';
                else:
                    $rightMobile = '---';
                endif;

                //Get user cash and chip
                $resFindUser = $this->user_model->selectUser(['userid' => $u['userId']]);
                if( $resFindUser['code']==1 && $resFindUser['data']!=[] ):
                    $grandbgw = 0;
                    $subgwamt = 0;
                    $subgwafter = 0;
                    foreach( $resFindUser['data']['gameWallet'] as $gw ):
                        $subgwamt += $gw['amount'];
                        $subgwafter += $gw['afterAmount'];
                    endforeach;
                    $grandbgw = $subgwamt - $subgwafter;

                    $grandbw = 0;
                    $subwamt = 0;
                    $subwafter = 0;
                    foreach( $resFindUser['data']['wallet'] as $w ):
                        $subwamt += $w['amount'];
                        $subwafter += $w['afterAmount'];
                    endforeach;
                    $grandbw = $subwamt - $subwafter;

                    $grandcgw = 0;
                    $subcgamt = 0;
                    $subcgafter = 0;
                    foreach( $resFindUser['data']['gpGroupWalletList'] as $cg ):
                        $subcgamt += $cg['amount'];
                        $subcgafter += $cg['afterAmount'];
                    endforeach;
                    $grandcgw = $subcgamt - $subcgafter;

                    $grandcash = $resFindUser['data']['balance'] - ($grandbw + $grandbgw + $grandcgw);
                    $grandchip = $grandbw + $grandbgw + $grandcgw;
        
                    // $final_grandcash = floor($grandcash * 10000)/10000;
                    $final_grandcash = $grandcash>0 ? floor($grandcash * 10000)/10000 : 0;
                    $final_grandchip = floor($grandchip * 10000)/10000;
                endif;

                $row = [];
                $row[] = $u['loginId'];
                //$row[] = $u['name'].$btngame.$gameid.$blc.$clearTurnover;
                $row[] = $u['name'].$btngame.$gameid.$blc.$clearTurnover.$clear;
                $row[] = $status;
                $row[] = $u['balance'];
                $row[] = $final_grandcash;
                $row[] = $final_grandchip;
                //$row[] = $u['safeBalance'];
                $row[] = $rightMobile;
                $row[] = '<small class="badge bg-dark me-1">'.$u['lastLoginIP'].'</small>'.$lastLogin;
                $row[] = $created;
                $row[] = !empty($u['remark']) ? $u['remark'] : '---';
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(['data'=>$data, 'code'=>1, 'pageIndex'=>$payload['pageIndex'], 'rowPerPage'=>$payload['rowPerPage'], 'totalPage'=>$payload['totalPage'], 'totalRecord'=>$payload['totalRecord']]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    /*
	Agent
	*/
    
    public function addAgent()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $subStandard = strtoupper($_SESSION['username']).'SUB';
        if( strpos($this->request->getPost('params')['username'], $subStandard)!== false ):
            echo json_encode(['code'=>-1, 'message'=>lang('Validation.usernameforbidden')]);
        else:
            $name = strtoupper($this->request->getpost('params')['username']);
            if( $name=='AGENT' || $name=='ADMINISTRATOR' ):
                echo json_encode([
                    'code' => -1,
                    'message' => lang('Validation.usernameforbidden')
                ]);
            else:
                $payload = [
                    'loginid' => preg_replace("/\s+/", "", strtoupper($this->request->getpost('params')['username'])),
                    'password' => $this->request->getpost('params')['password'],
                    'name' => $this->request->getpost('params')['fname'],
                    'regioncode' => $this->request->getpost('params')['regioncode'],
                    'contact' => $this->request->getpost('params')['contact'],
                    'telegram' => $this->request->getpost('params')['telegram'],
                    'permission' => '{"major":{"transaction":"1","report":"1","account":"1","usersearch":"1"}}',
                    'gender' => 1,
                    'remark' => $this->request->getpost('params')['remark'],
                    'role' => 3 // Agent
                ];
                $res = $this->user_model->insertUser($payload);
                echo json_encode($res);
            endif;
        endif;
    }

    //Hub
    public function addHubAgent()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $subStandard = strtoupper($_SESSION['username']).'SUB';
        if( strpos($this->request->getPost('params')['username'], $subStandard)!== false ):
            echo json_encode(['code'=>-1, 'message'=>lang('Validation.usernameforbidden')]);
        else:
            $name = strtoupper($this->request->getpost('params')['username']);
            if( $name=='AGENT' || $name=='ADMINISTRATOR' ):
                echo json_encode([
                    'code' => -1,
                    'message' => lang('Validation.usernameforbidden')
                ]);
            else:
                $payload = [
                    'loginid' => preg_replace("/\s+/", "", strtoupper($this->request->getpost('params')['username'])),
                    'password' => $this->request->getpost('params')['password'],
                    'name' => $this->request->getpost('params')['fname'],
                    'regioncode' => $this->request->getpost('params')['regioncode'],
                    'contact' => $this->request->getpost('params')['contact'],
                    'telegram' => $this->request->getpost('params')['telegram'],
                    'permission' => '{"major":{"transaction":"1","report":"1","account":"1","usersearch":"1"}}',
                    'gender' => 1,
                    'remark' => $this->request->getpost('params')['remark'],
                    'role' => 3, // Agent
                    'currencycode' => 0
                ];
                $res = $this->user_model->insertHubUser($payload);
                echo json_encode($res);
            endif;
        endif;
    }

    public function agentList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $raw = json_decode(file_get_contents('php://input'),1);
        $usercreated = !empty($raw['ucreated']) ? $raw['ucreated'] : null;
        $refer = $raw['parent'] ? base64_decode($raw['parent']) : $_SESSION['token'];

        $payload = $this->user_model->selectAllUser([
            'userid' => $refer, 
            'role' => 3, 
            'timezone' => 8,
            'loginid' => $raw['username'],
            'regioncode' => $raw['regioncode'],
            'contactno' => $raw['contact'],
            'status' => (int)$raw['status'],
            'date' => $usercreated,
            'pageindex' => $raw['pageindex'],
            'rowperpage' => $raw['rowperpage']
        ]);
        if( $payload['code']==1 && $payload['data']!=[] ):
            $data = [];
            foreach( $payload['data'] as $u ):
                switch($u['status']):
                    case 1: $status = lang('Label.active'); break;
                    case 2: $status = lang('Label.inactive'); break;
                    case 3: $status = lang('Label.freeze'); break;
                    default: $status = '';
                endswitch;
                
                $date = Time::parse(date('Y-m-d H:i:s', strtotime($u['createDate'])));
                $created = $date->toDateTimeString();

                $loginDate = Time::parse(date('Y-m-d H:i:s', strtotime($u['lastLoginDate'])));
                $lastLogin = $loginDate->toDateTimeString();

                $action = '<div class="btn-groups">';
                $action .= '<a class="btn btn-vw btn-sm" href="javascript:void(0);" onclick="openTransfer(\'3\',\''.base64_encode($u['userId']).'\',\''.$u['loginId'].'\',\''.$u['balance'].'\');">'.lang('Nav.credittransfer').'</a>';
                $action .= '<a class="btn btn-vw btn-sm" href="'.base_url('agent/fight-shares/'.base64_encode($u['userId'])).'">'.lang('Nav.shares').'</a>';

                // $action .= '<a class="btn btn-vw btn-sm" href="'.base_url('agent/position-taking/'.base64_encode($u['userId'])).'">'.lang('Nav.positiontaking').'</a>';

                $action .= '<a class="btn btn-vw btn-sm" href="'.base_url('member/downline/'.base64_encode($u['userId'])).'">'.lang('Label.member').'</a>';
                $action .= '<a class="btn btn-vw btn-sm" href="'.base_url('agent/games/'.base64_encode($u['userId'])).'">'.lang('Nav.gamelist').'</a>';

                $action .= '<div class="btn-group me-1 mb-1" role="group">';
                $action .= '<button id="navProfile" type="button" class="btn btn-vw btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">'.lang('Nav.profile').'</button>';
                $action .= '<ul class="dropdown-menu dropdown-menu-end border-white" aria-labelledby="navProfile">';
                $action .= '<li><a class="dropdown-item" href="'.base_url('history/transaction/'.base64_encode($u['userId'])).'">'.lang('Nav.transaction').'</a></li>';
                $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="userStatistics(\''.base64_encode($u['userId']).'\')">'.lang('Nav.statistic').'</a></li>';
                $action .= '<li class="dropdown-divider"></li>';
                // $action .= '<li><a class="dropdown-item" href="'.base_url('report/user-ptps-fight/'.base64_encode($u['userId'])).'">'.lang('Nav.fightlistreport').'</a></li>';
                // $action .= '<li><a class="dropdown-item" href="'.base_url('report/user-ptps-shares/'.base64_encode($u['userId'])).'">'.lang('Nav.shareslistreport').'</a></li>';
                // $action .= '<li><a class="dropdown-item" href="'.base_url('report/profit-sharing/'.base64_encode($u['userId'])).'">'.lang('Nav.sharesreport').'</a></li>';
                // $action .= '<li><a class="dropdown-item" href="'.base_url('report/profit-sharing-v2/'.base64_encode($u['userId'])).'">'.lang('Nav.profitreport').'</a></li>';

                $action .= '<li><a class="dropdown-item" href="'.base_url('group-report/profit-sharing/'.base64_encode($u['userId'])).'">'.lang('Nav.sharesreport').'-New</a></li>';
                $action .= '<li><a class="dropdown-item" href="'.base_url('personal-report/profit-sharing/'.base64_encode($u['userId'])).'">'.lang('Nav.profitreport').'-New</a></li>';

                $action .= '<li><a class="dropdown-item" href="'.base_url('report4/profit-sharing/'.base64_encode($u['userId'])).'">'.lang('Nav.sharesreport').'</a></li>';
                $action .= '<li><a class="dropdown-item" href="'.base_url('report4/profit-sharing-v2/'.base64_encode($u['userId'])).'">'.lang('Nav.profitreport').'</a></li>';
                $action .= '<li class="dropdown-divider"></li>';
                $action .= '<li><a class="dropdown-item" href="'.base_url('report/user/winlose/'.base64_encode($u['userId'])).'">'.lang('Nav.winlosereport').'</a></li>';
                $action .= '<li><a class="dropdown-item" href="'.base_url('report/user/reference-winlose/'.base64_encode($u['userId'])).'">'.lang('Nav.refwinlosereport').'</a></li>';
                $action .= '<li><a class="dropdown-item" href="'.base_url('user-report/agent-commission/'.base64_encode($u['userId'])).'">'.lang('Nav.agcommreport').'</a></li>';
                // $action .= '<li class="dropdown-divider"></li>';
                // $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="writeMessage(\''.base64_encode($u['userId']).'\')">'.lang('Nav.sendmail').'</a></li>';
                $action .= '<li class="dropdown-divider"></li>';
                $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="modifyRewardSettings(\''.base64_encode($u['userId']).'\');">'.lang('Nav.settings').'</a></li>';
                $action .= '</ul>';
                $action .= '</div>';

                $action .= '<div class="btn-group me-1 mb-1" role="group">';
                $action .= '<button id="credittranf" type="button" class="btn btn-vw btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">'.lang('Nav.password').'</button>';
                $action .= '<ul class="dropdown-menu dropdown-menu-end border-white" aria-labelledby="credittranf">';
                // $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="resetVaultPin(\''.base64_encode($u['userId']).'\')">'.lang('Nav.resetvault').'</a></li>';
                $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="resetSecondPass(\''.base64_encode($u['userId']).'\')">'.lang('Nav.reset2ndpass').'</a></li>';
                $action .= '</ul>';
                $action .= '</div>';

                //if( $_SESSION['role']==2 || (($_SESSION['uplinerole']==2 && $_SESSION['role']==5) && $_SESSION['userprofile']==1) ):
                //$action .= '<a class="btn btn-vw btn-sm" href="javascript:void(0);" onclick="modify(\''.base64_encode($u['userId']).'\',\''.$u['loginId'].'\');">'.lang('Nav.edit').'</a>';
                //endif;

                $action .= '<a class="btn btn-vw btn-sm" href="javascript:void(0);" onclick="affiliateQR(\''.base64_encode($u['userId']).'\');">'.lang('Nav.share').'</a>';

                $action .= '<a class="btn btn-vw btn-sm" href="javascript:void(0);" onclick="agentPermission(\''.base64_encode($u['userId']).'\')">'.lang('Nav.userpermission').'</a>'; //permit

                $checkNegative = '<button type="button" class="btn btn-primary btn-sm ms-1" onclick="getNegSum(\''.base64_encode($u['userId']).'\');"><i class="bx bx-math"></i></button>';
                
                //if( $u['status']==1 ):
                //    $action .= '<a class="btn btn-success btn-sm bg-gradient" href="javascript:void(0);" onclick="modifyStatus(\''.base64_encode($u['userId']).'\', 2)">'.lang('Label.active').'</a>';
                //else:
                //    $action .= '<a class="btn btn-danger btn-sm bg-gradient" href="javascript:void(0);" onclick="modifyStatus(\''.base64_encode($u['userId']).'\', 1)">'.lang('Label.inactive').'</a>';
                //endif;
                $action .= '</div>';

                // MobileNo with Region
                $region = !empty($u['regionCode']) ? $u['regionCode'] : $_ENV['currencyCode'];
                // $contact = '<span class="badge bg-primary fw-normal rounded-0 me-1">'.$region.'</span>'.$u['contact'];
                $contact = '<span class="badge bg-dark fw-normal me-1">'.$region.'</span>';
                // End MobileNo with Region

                if( $_SESSION['role']==2 || (($_SESSION['uplinerole']==2 && $_SESSION['role']==5) && $_SESSION['userprofile']==1) ):
                    $rightMobile = !empty($u['contact'])?$contact.$u['contact']:'---';
                else:
                    $rightMobile = '---';
                endif;

                $row = [];
                $row[] = $u['loginId'];
                $row[] = '<a class="" href="'.base_url('agent/downline/'.base64_encode($u['userId'])).'">'.$u['name'].'</a>'.$checkNegative;
                $row[] = $status;
                $row[] = $u['balance'];
                $row[] = $u['agentBalance'];
                $row[] = $rightMobile;
                $row[] = !empty($u['telegram'])?$u['telegram']:'---';
                $row[] = '<small class="badge bg-dark me-1">'.$u['lastLoginIP'].'</small>'.$lastLogin;
                $row[] = $created;
                $row[] = !empty($u['remark']) ? $u['remark'] : '---';
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(['data'=>$data, 'code'=>1, 'pageIndex'=>$payload['pageIndex'], 'rowPerPage'=>$payload['rowPerPage'], 'totalPage'=>$payload['totalPage'], 'totalRecord'=>$payload['totalRecord']]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    //Hub
    public function agentListHub()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $raw = json_decode(file_get_contents('php://input'),1);
        $usercreated = !empty($raw['ucreated']) ? $raw['ucreated'] : null;
        $refer = $raw['parent'] ? base64_decode($raw['parent']) : $_SESSION['token'];

        $payload = $this->user_model->selectAllUserHub([
            'userid' => $refer, 
            'role' => 3, 
            'timezone' => 8,
            'loginid' => $raw['username'],
            'regioncode' => $raw['regioncode'],
            'contactno' => $raw['contact'],
            'status' => (int)$raw['status'],
            'date' => $usercreated,
            'pageindex' => $raw['pageindex'],
            'rowperpage' => $raw['rowperpage']
        ]);
        if( $payload['code']==1 && $payload['data']!=[] ):
            $data = [];
            foreach( $payload['data'] as $u ):

                //User Currency Check
                $payloadUser = [
                    'userid' => $u['id'],
                    'currencycode' => 0
                ];
                $resCurrency= $this->user_model->selectUserCurrency($payloadUser);
                $currencyCode = '';
                if ( $resCurrency['code']==1 && $resCurrency['data']!=[] ):
                    foreach( $resCurrency['data'] as $ph ):
                        if ($ph['existed']==true):
                            switch($ph['currencyCode']):
                                case 0: $currencyCode .= '<span class="badge bg-primary fw-normal me-1">MYR</span>'; break;
                                case 1: $currencyCode .= '<span class="badge bg-warning fw-normal me-1">VND</span>'; break;
                                case 2: $currencyCode .= '<span class="badge bg-warning fw-normal me-1">EUSDT</span>'; break;
                                case 3: $currencyCode .= '<span class="badge bg-success fw-normal me-1">TUSDT</span>'; break;
                                case 4: $currencyCode .= '<span class="badge bg-warning fw-normal me-1">BTC</span>'; break;
                                case 5: $currencyCode .= '<span class="badge bg-warning fw-normal me-1">USD</span>'; break;
                                case 6: $currencyCode .= '<span class="badge bg-warning fw-normal me-1">MMK</span>'; break;
                                case 7: $currencyCode .= '<span class="badge bg-warning fw-normal me-1">EUR</span>'; break;
                                case 8: $currencyCode .= '<span class="badge bg-warning fw-normal me-1">SGD</span>'; break;
                                case 9: $currencyCode .= '<span class="badge bg-warning fw-normal me-1">CNY</span>'; break;
                                case 10: $currencyCode .= '<span class="badge bg-warning fw-normal me-1">THB</span>'; break;
                                case 11: $currencyCode .= '<span class="badge bg-warning fw-normal me-1">INR</span>'; break;
                                case 12: $currencyCode .= '<span class="badge bg-warning fw-normal me-1">BND</span>'; break;
                                case 13: $currencyCode .= '<span class="badge bg-warning fw-normal me-1">BDT</span>'; break;
                                case 14: $currencyCode .= '<span class="badge bg-warning fw-normal me-1">IDR</span>'; break;
                                default: $currencyCode .= '';
                            endswitch;
                        endif;
                    endforeach;
                else:
                    echo json_encode($resCurrency);
                endif;

                switch($u['status']):
                    case 1: $status = lang('Label.active'); break;
                    case 2: $status = lang('Label.inactive'); break;
                    case 3: $status = lang('Label.freeze'); break;
                    default: $status = '';
                endswitch;
                
                $date = Time::parse(date('Y-m-d H:i:s', strtotime($u['createDate'])));
                $created = $date->toDateTimeString();

                $loginDate = Time::parse(date('Y-m-d H:i:s', strtotime($u['lastLoginDate'])));
                $lastLogin = $loginDate->toDateTimeString();

                $action = '<div class="btn-groups">';
                if( $_SESSION['role']==2 || (($_SESSION['uplinerole']==2 && $_SESSION['role']==5) && $_SESSION['userprofile']==1) ):
                $action .= '<a class="btn btn-vw btn-sm" href="javascript:void(0);" onclick="modifyHubUser(\''.base64_encode($u['id']).'\',\''.$u['loginId'].'\');">'.lang('Nav.edit').'</a>';
                endif;

                $action .= '<a class="btn btn-vw btn-sm" href="javascript:void(0);" onclick="registerByCurrency(\''.base64_encode($u['id']).'\');">'.lang('Nav.addcurrency').'</a>';

                $action .= '<a class="btn btn-vw btn-sm" href="javascript:void(0);" onclick="agentHubPermission(\''.base64_encode($u['id']).'\')">'.lang('Nav.userpermission').'</a>'; //permit

                if( $u['status']==1 ):
                    $action .= '<a class="btn btn-success btn-sm bg-gradient" href="javascript:void(0);" onclick="modifyHubStatus(\''.base64_encode($u['id']).'\', 2)">'.lang('Label.active').'</a>';
                else:
                    $action .= '<a class="btn btn-danger btn-sm bg-gradient" href="javascript:void(0);" onclick="modifyHubStatus(\''.base64_encode($u['id']).'\', 1)">'.lang('Label.inactive').'</a>';
                endif;
                $action .= '</div>';

                // MobileNo with Region
                $region = !empty($u['regionCode']) ? $u['regionCode'] : $_ENV['currencyCode'];
                // $contact = '<span class="badge bg-primary fw-normal rounded-0 me-1">'.$region.'</span>'.$u['contact'];
                $contact = '<span class="badge bg-dark fw-normal me-1">'.$region.'</span>';
                // End MobileNo with Region

                if( $_SESSION['role']==2 || (($_SESSION['uplinerole']==2 && $_SESSION['role']==5) && $_SESSION['userprofile']==1) ):
                    $rightMobile = !empty($u['contact'])?$contact.$u['contact']:'---';
                else:
                    $rightMobile = '---';
                endif;

                $row = [];
                $row[] = $u['loginId'];
                $row[] = '<a class="" href="'.base_url('hub-agent/downline/'.base64_encode($u['id'])).'">'.$u['name'].'</a>';
                $row[] = $currencyCode;
                $row[] = $status;
                $row[] = $rightMobile;
                $row[] = !empty($u['telegram'])?$u['telegram']:'---';
                $row[] = '<small class="badge bg-dark me-1">'.$u['lastLoginIP'].'</small>'.$lastLogin;
                $row[] = $created;
                $row[] = !empty($u['remark']) ? $u['remark'] : '---';
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(['data'=>$data, 'code'=>1, 'pageIndex'=>$payload['pageIndex'], 'rowPerPage'=>$payload['rowPerPage'], 'totalPage'=>$payload['totalPage'], 'totalRecord'=>$payload['totalRecord']]);
        else:
            echo json_encode($payload);
        endif;
    }

    /*
    User
    */

    public function getUserAdminNegativeSum()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid'])
        ];
        $res = $this->user_model->selectAllUserAdminNegative($payload);
        echo json_encode($res);
    }

    public function resetUser2ndPass()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid']),
            'resetpassword' => true
        ];

        $res = $this->user_model->updateUser2ndPass($payload);
        echo json_encode($res);
    }

    public function resetUserVaultPin()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid']),
            'resetpassword' => true
        ];

        $res = $this->user_model->updateUserVaultPin($payload);
        echo json_encode($res);
    }

    public function modifyPersonal()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $parent = isset($this->request->getpost('params')['uid']) ? base64_decode($this->request->getpost('params')['uid']) : $_SESSION['token'];

        if( !isset($this->request->getpost('params')['usertype']) ): 
            echo json_encode(['code'=>-1]); 
        elseif( $this->request->getpost('params')['usertype'] != $_SESSION['session'] ) :
            echo json_encode(['code'=>-1, 'message'=>'fatal error']); 
        else:
            if( isset($this->request->getpost('params')['newpass']) && !empty($this->request->getpost('params')['newpass']) ):
                $payloadCredentialReset = [
                    'userid' => $parent,
                    'resetpassword' => true
                ];
                $resReset = $this->user_model->updateUserPassword($payloadCredentialReset);
                if( $resReset['code']==1 ):
                    $payloadCredential = [
                        'userid' => $parent,
                        'password' => $resReset['password'],
                        'newpassword' => $this->request->getpost('params')['newpass'],
                        'resetpassword' => false
                    ];
                    $resCredential = $this->user_model->updateUserPassword($payloadCredential);
                    if( $resCredential['code']==1 ):
                        $payloadProfile = [
                            'userid' => $parent,
                            'name' => !empty($this->request->getpost('params')['fname']) ? $this->request->getpost('params')['fname'] : '',
                            'contact' => !empty($this->request->getpost('params')['contact']) ? $this->request->getpost('params')['contact'] : '',
                            'telegram' => !empty($this->request->getpost('params')['telegram']) ? $this->request->getpost('params')['telegram'] : '',
                            'remark' => !empty($this->request->getpost('params')['remark']) ? $this->request->getpost('params')['remark'] : ' ',
                            'regioncode' => $this->request->getpost('params')['regioncode'],
                        ];
                        $res = $this->user_model->updateUser($payloadProfile);
                        if( $res['code']==22 ):
                            echo json_encode(['code'=>1, 'message'=>'SUCCESS']);
                        else:
                            echo json_encode($res);
                        endif;
                    else:
                        echo json_encode($resCredential);
                    endif;
                else:
                    echo json_encode($resReset);
                endif;
            else:
            $payloadProfile = [
                'userid' => $parent,
                'name' => !empty($this->request->getpost('params')['fname']) ? $this->request->getpost('params')['fname'] : '',
                'contact' => !empty($this->request->getpost('params')['contact']) ? $this->request->getpost('params')['contact'] : '',
                'telegram' => !empty($this->request->getpost('params')['telegram']) ? $this->request->getpost('params')['telegram'] : '',
                'remark' => !empty($this->request->getpost('params')['remark']) ? $this->request->getpost('params')['remark'] : ' ',
                'regioncode' => $this->request->getpost('params')['regioncode'],
            ];
            $res = $this->user_model->updateUser($payloadProfile);
            echo json_encode($res);
            endif;

        endif;
    }

    public function modifyPersonalHub()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $parent = isset($this->request->getpost('params')['uid']) ? base64_decode($this->request->getpost('params')['uid']) : $_SESSION['token'];

        if( !isset($this->request->getpost('params')['usertype']) ): 
            echo json_encode(['code'=>-1]); 
        elseif( $this->request->getpost('params')['usertype'] != $_SESSION['session'] ) :
            echo json_encode(['code'=>-1, 'message'=>'fatal error']); 
        else:
            if( isset($this->request->getpost('params')['newpass']) && !empty($this->request->getpost('params')['newpass']) ):
                $payloadCredentialReset = [
                    'userid' => $parent,
                    'resetpassword' => true
                ];
                $resReset = $this->user_model->updateUserPasswordHub($payloadCredentialReset);
                if( $resReset['code']==1 ):
                    $payloadCredential = [
                        'userid' => $parent,
                        'password' => $resReset['password'],
                        'newpassword' => $this->request->getpost('params')['newpass'],
                        'resetpassword' => false
                    ];
                    $resCredential = $this->user_model->updateUserPasswordHub($payloadCredential);
                    if( $resCredential['code']==1 ):
                        $payloadProfile = [
                            'userid' => $parent,
                            'name' => !empty($this->request->getpost('params')['fname']) ? $this->request->getpost('params')['fname'] : '',
                            'contact' => !empty($this->request->getpost('params')['contact']) ? $this->request->getpost('params')['contact'] : '',
                            'telegram' => !empty($this->request->getpost('params')['telegram']) ? $this->request->getpost('params')['telegram'] : '',
                            'remark' => !empty($this->request->getpost('params')['remark']) ? $this->request->getpost('params')['remark'] : ' ',
                            'regioncode' => $this->request->getpost('params')['regioncode'],
                        ];
                        $res = $this->user_model->updateUserHub($payloadProfile);
                        if( $res['code']==2 ):
                            echo json_encode(['code'=>1, 'message'=>'SUCCESS']);
                        else:
                            echo json_encode($res);
                        endif;
                    else:
                        echo json_encode($resCredential);
                    endif;
                else:
                    echo json_encode($resReset);
                endif;
            else:
            $payloadProfile = [
                'userid' => $parent,
                'name' => !empty($this->request->getpost('params')['fname']) ? $this->request->getpost('params')['fname'] : '',
                'contact' => !empty($this->request->getpost('params')['contact']) ? $this->request->getpost('params')['contact'] : '',
                'telegram' => !empty($this->request->getpost('params')['telegram']) ? $this->request->getpost('params')['telegram'] : '',
                'remark' => !empty($this->request->getpost('params')['remark']) ? $this->request->getpost('params')['remark'] : ' ',
                'regioncode' => $this->request->getpost('params')['regioncode'],
            ];
            $res = $this->user_model->updateUserHub($payloadProfile);
            echo json_encode($res);
            endif;

        endif;
    }

    public function modifyUserStatus()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid']),
            'status' => (int)$this->request->getpost('params')['status']
        ];

        $res = $this->user_model->updateUser($payload);
        echo json_encode($res);
    }

    public function modifyUserStatusHub()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid']),
            'status' => (int)$this->request->getpost('params')['status']
        ];

        $res = $this->user_model->updateUserHub($payload);
        echo json_encode($res);
    }

    public function getUserProfile()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $parent = isset($this->request->getpost('params')['uid']) ? base64_decode($this->request->getpost('params')['uid']) : $_SESSION['token'];

        $payload = [
            'userid' => $parent
        ];
        $res = $this->user_model->selectUser($payload);
        echo json_encode($res);
    }

    public function getUserProfileHub()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $parent = isset($this->request->getpost('params')['uid']) ? base64_decode($this->request->getpost('params')['uid']) : $_SESSION['token'];

        $payload = [
            'userid' => $parent
        ];
        $res = $this->user_model->selectUserHub($payload);
        echo json_encode($res);
    }

    public function registerByCurrency()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid']),
            'apiurl' => null,
            'lobbyurl' => null,
            'currencycode' => (int)$this->request->getpost('params')['currencycode']
        ];

        $res = $this->user_model->userRegisterByCurrency($payload);
        echo json_encode($res);
    }

    /*
    Self
    */

    public function modifySelfPassword()
    {
        if( !session()->get('logged_in') ): return false; endif;

        if( !isset($this->request->getpost('params')['agentname']) ): 
            echo json_encode(['code'=>-1, 'message'=>'error']); 
        else :

            $payload = [
                'userid' => $_SESSION['token'],
                'password' => $this->request->getpost('params')['currentloginpass'],
                'newpassword' => $this->request->getpost('params')['newcloginpass'],
                'resetpassword' => false
            ];

            $res = $this->user_model->updateUserPassword($payload);
            echo json_encode($res);
        endif;
    }

    public function modifySelfPasswordHub()
    {
        if( !session()->get('logged_in') ): return false; endif;

        if( !isset($this->request->getpost('params')['agentname']) ): 
            echo json_encode(['code'=>-1, 'message'=>'error']); 
        else :

            $payload = [
                'userid' => $_SESSION['token'],
                'password' => $this->request->getpost('params')['currentloginpass'],
                'newpassword' => $this->request->getpost('params')['newcloginpass'],
                'resetpassword' => false
            ];

            $res = $this->user_model->updateUserPasswordHub($payload);
            echo json_encode($res);
        endif;
    }

    public function selfBalance()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token']
        ];
        $res = $this->user_model->selectUser($payload);
        if( $res['code']==1 && $res['data']!=[] ):
            $balance = floor($res['data']['balance'] * 10000)/10000;

            $result = [
                'code' => $res['code'],
                'balance' => bcdiv($balance,1,2)
            ];
            echo json_encode($result);
        else:
            echo json_encode($res);
        endif;
    }

    public function login()
	{
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $parsedUrl = parse_url($url);

        $subStandard = 'SUB';
        if( strpos($this->request->getPost('params')['username'], $subStandard)!== false ):
            $role = 5;
            $refer = $_ENV['host'];
        else:
            $role = 2;
            if( $parsedUrl['host']==$_ENV['domain'] && $this->request->getPost('params')['username']==$_ENV['merchant'] ):
                $refer = $_ENV['secret'];
            else:
                $refer = '';
            endif;
        endif;

        if( !$refer ):
            echo json_encode(['code'=>17, 'message'=>lang('Validation.usernotfound')]);
        else:
            $payload = [
                'agentid' => $refer,
                'loginid' => strtoupper(preg_replace("/\s+/", "", $this->request->getpost('params')['username'])),
                'password' => $this->request->getPost('params')['password'],
                'ip' => $_SESSION['ip'],
                'role' => (int)$role
            ];
    
            $res = $this->user_model->updateUserLogin($payload);
            //if( $res['code']==1 ):
            if( $res['code']==1 && $res['data']!=[] ):
                $ph = $res['data'];
                $session = session();
                $user_data = [
                    'logged_in' => TRUE,
                    //'token' => $res['userId'],
                    'token' => $ph['id'],
                    'session' => $ph['sessionId'],
                    //'uplinerole' => $ph['uplineRole'],
                    'uplinerole' => $ph['agentRole'],
                    'role' => $ph['role'],
                    'username' => strtoupper($this->request->getPost('params')['username']),
                    //'affiliate' => $res['affiliateCalculation'],
                    //'promotion' => $res['deductPromoCalculation'],
                    //'agcomm' => $res['commissionCalculation'],
                    //'ptcomm' => $res['ptCommissionCalculation']
                ];
                $session->set($user_data);
            endif;
            echo json_encode($res);
        endif;
    }

    public function userKioskByCurrency()
    {
        if( !session()->get('logged_in') ): return false; endif;

        if( !isset($this->request->getpost('params')['currencycode']) ): 
            echo json_encode(['code'=>-1, 'message'=>'error']); 
        else:
            $session = session();
            $user_data = [
                'apibycurrency' => $this->request->getpost('params')['currencycode'],
            ];
            $session->set($user_data);

            if( !isset($_SESSION['apibycurrency']) ):
                echo json_encode(['code'=>-2, 'message'=>'session not set']); 
            else:
                echo json_encode(['code'=>1, 'message'=>'SUCCESS']);
            endif;
        endif;
    }

    public function logout()
    {
        $session = session();
        $res = $this->user_model->updateUserLogout(['loginuserid'=>$_SESSION['token']]);
        $session->destroy();
        clearstatcache();
        return redirect()->to(base_url());
    }
}