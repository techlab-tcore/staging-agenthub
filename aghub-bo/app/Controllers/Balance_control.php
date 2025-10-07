<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Balance_control extends BaseController
{
    // Protected

    protected function searchProfile($parent)
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $parent
        ];
        $res = $this->user_model->selectUser($payload);
        return $res;
    }

    protected function companyCashBank()
    {
        $payload = [
            'userid' => $_ENV['host']
        ];
        $res = $this->bankcard_model->selectAllBankCard($payload);
        return $res;
    }

    protected function searchUsername($role,$uid)
    {
        $payload = $this->user_model->selectSomeUser([
            'userid' => $_SESSION['token'],
            'role' => (int)$role,
            'id' => '',
            'loginid' => preg_replace('/\s+/', '', $uid),
            'contactno' => '',
            'name' => '',
            'ip' => '',
            'date' => null,
            'timezone' => 8
        ]);
        return $payload;
    }
    
    /*
    Notification
    */

    public function getIncomingDeposit($type)
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'], 
            'type' => (int)$type, 
            'self' => true,
            'pageindex' => 1,
            'rowperpage' => 10,
        ];

        $res = $this->balance_model->selectAllPendingTransaction($payload);
        // echo json_encode($res);

        if( $res['code']==1 && $res['data']!=[] ):
            $numPending = count($res['data']);
            $notif = [
                'code' => $res['code'],
                'available' => true,
                'pending' => $numPending
            ];
        else:
            $notif = [
                'code' => $res['code'],
                'available' => false,
                'pending' => 0
            ];
        endif;
        echo json_encode($notif);
    }

    /*
    User
    */

    public function clearUserChip()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid']),
            'chippassword' => null,
            'type' => (int)$this->request->getpost('params')['category'],
            'gameprovidercode' => $this->request->getpost('params')['provider'],
            'gamegroupname' => $this->request->getpost('params')['chipgroup'],
            'remark' => '',
        ];
        $res = $this->balance_model->updateUserChip($payload);
        echo json_encode($res);
    }

    public function clearUserTurnover()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid']),
            'turnoverpassword' => null,
            // 'remark' => $this->request->getpost('params')['remark']
            'remark' => '',
        ];
        $res = $this->balance_model->updateUserTurnover($payload);
        echo json_encode($res);
    }

    public function userSetPromotion()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $uid = base64_decode($this->request->getPost('params')['uid']);

        $now = new Time('now');

        $comp = $this->companyCashBank();
        if( $comp['code']==1 && $comp['data']!=[] ):
            foreach( $comp['data'] as $cbc ):
                if( $cbc['status']==1 && $cbc['cardNo']=='000000' && $cbc['accountNo']=='000000' ):
                    $payload = [
                        'userid' => $uid,
                        'type' => 1,
                        'method' => 1,
                        'wallettype' => 1,
                        'currencycode' => 'MYR',
                        'amount' => (float)$this->request->getPost('params')['amount'],
                        'depositdate' => date('c', strtotime($now)),
                        'ip' => $_SESSION['ip'],
                        'adminbankid' => $cbc['bankId'],
                        'admincardno' => $cbc['cardNo'],
                        'adminaccountno' => $cbc['accountNo'],
                        'slipname' => null,
                        'promotionid' => base64_decode($this->request->getPost('params')['promoId']),
                        'remark' => $this->request->getPost('params')['remark'],
                    ];

                    $res = $this->balance_model->updateUserTransfer($payload);
                    echo json_encode($res); 
                endif;
            endforeach;
        else:
            echo json_encode([
                'code' => -1,
                'message' => lang('Validation.compbankcard'),
            ]);
        endif;
    }

    public function userSpinTokenTransfer()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid']),
            'method' => 1,
            'wallettype' => 4,
            'amount' => (float)$this->request->getpost('params')['amount'],
            'remark' => $this->request->getpost('params')['remark'],
            'ip' => $_SESSION['ip'],
            'followdate' => false,
            'deductownagent' => false,
            'type' => 9
        ];
        $res = $this->balance_model->updateUserTransfer($payload);
        echo json_encode($res);
    }

    public function userPgReplenishment()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid']),
            'method' => 2,
            'wallettype' => 1,
            'amount' => (float)$this->request->getpost('params')['amount'],
            'remark' => $this->request->getpost('params')['remark'],
            'ip' => $_SESSION['ip'],
            'followdate' => false,
            'deductownagent' => false,
            'type' => 10,
            
            'bankid' => base64_decode($this->request->getPost('params')['compPayGateway']),
            'merchantcode' => $this->request->getPost('params')['merchant'],
            'channelcode' => $this->request->getPost('params')['compPayChannel'],
        ];
        $res = $this->balance_model->updateUserTransfer($payload);
        echo json_encode($res);
    }

    public function userCreditTransfer()
    {
        if( !session()->get('logged_in') ): return false; endif;

        if( !isset($this->request->getpost('params')['groupwallet']) ): 
            echo json_encode(['code'=>-1]); 
        elseif( $this->request->getpost('params')['groupwallet'] != $_SESSION['session'] ) :
            echo json_encode(['code'=>-1, 'message'=>'fatal error']); 
        else:

            $walletType = !isset($this->request->getpost('params')['type']) ? 1 : $this->request->getpost('params')['type'];

            if( isset($this->request->getpost('params')['triggertype']) ):
                $triggerType = $this->request->getpost('params')['triggertype'];
                $gameProviderCode = $triggerType==1 ? $this->request->getpost('params')['gameprovidercode'] : null;
                $category = $triggerType==2 ? $this->request->getpost('params')['gcate'] : null;
                $chipgroup = $triggerType==4 ? $this->request->getpost('params')['chipgroup'] : null;
            else:
                $triggerType = null;
                $gameProviderCode = null;
                $category = null;
                $chipgroup = null;
            endif;

            $payload = [
                'userid' => base64_decode($this->request->getpost('params')['uid']),
                'method' => 1,
                'wallettype' => (int)$walletType,
                'amount' => (float)$this->request->getpost('params')['amount'],
                'remark' => $this->request->getpost('params')['remark'],
                'ip' => $_SESSION['ip'],
                'followdate' => false,
                'deductownagent' => false,
                'type' => 6, // credit transfer

                'turnover' => (float)$this->request->getpost('params')['turnover'],
                'triggertype' => (int)$triggerType,
                'category' => (int)$category,
                'gameprovidercode' => $gameProviderCode,
                'togroupname' => $chipgroup,
            ];
            $res = $this->balance_model->updateUserTransfer($payload);
            echo json_encode($res);
        endif;
    }

    /*
    Transaction
    */

    function approvalPermission()
    {
        if( !session()->get('logged_in') ): return false; endif;

        if( !isset($this->request->getpost('params')['agentcode']) ): 
            echo json_encode(['code'=>-1, 'message'=>'error']); 
        elseif( $this->request->getpost('params')['agentcode'] != $_SESSION['session'] ) :
            echo json_encode(['code'=>-2, 'message'=>'fatal error']);
        else:
            if( $this->request->getpost('params')['type']==1 ):
                $payload = [
                    'userid' => $_SESSION['token'], 
                    'paymentid' => base64_decode($this->request->getpost('params')['pid']), 
                    'status' => (int)$this->request->getpost('params')['status'],
                    'remark' => $this->request->getpost('params')['remark'],
                    'ip' => $_SESSION['ip'],
                    'followdate' => false,
                    'deductownagent' => false
                ];
            elseif( $this->request->getpost('params')['type']==2 ):
                $payload = [
                    'userid' => $_SESSION['token'], 
                    'paymentid' => base64_decode($this->request->getpost('params')['pid']), 
                    'status' => (int)$this->request->getpost('params')['status'],
                    'remark' => $this->request->getpost('params')['remark'],
                    'ip' => $_SESSION['ip'],
                    'followdate' => false,
                    'deductownagent' => false,

                    'frombankid' => base64_decode($this->request->getpost('params')['compbankcard']),
                    'fromaccountno' => $this->request->getpost('params')['acc'],
                    'fromcardno' => $this->request->getpost('params')['card'],
                ];
            endif;
        endif;

        $res = $this->balance_model->updatePendingTransaction($payload);
        echo json_encode($res);
    }

    public function pendingAgentWithdrawalList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $lng = strtoupper($_SESSION['lang']);

        $raw = json_decode(file_get_contents('php://input'),1);

        $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime('-31 days'))));
        $to = date('c', strtotime(date('Y-m-d 23:59:59')));

        $payload = $this->balance_model->selectAllTransaction3([
            'userid' => base64_decode($raw['parent']),
            'method' => [],
            'type' => [6],
            'status' => [3],
            'fromcreatedate' => $from,
            'tocreatedate' => $to,
            'paymentid' => '',
            'fromwallettype' => [],
            'towallettype' => [],
            'fromaccountno' => '',
            'toaccountno' => '',
            'frombankid' => '',
            'tobankid' => '',
            'fromuserid' => '',
            'touserid' => '',
            'createby' => '',
            'AgentCreateBy' => "",
            'fromuseragentid' => "",
            'touseragentid' => "",

            'self' => true,
            'desc' => false,
            'pageindex' => $raw['pageindex'],
            'rowperpage' => $raw['rowperpage'],
        ]);
        // echo json_encode($payload);

        if( $payload['code']==1 && $payload['data']!=[] ):
            $data = [];
            foreach( $payload['data'] as $ph ):
                $searchProfile = $this->searchProfile($ph['toUserId']);
                if( $searchProfile['data']['role']==3 ):
                    switch($ph['status']):
                        case 1: $status = lang('Label.approve'); break;
                        case 2: $status = lang('Label.reject'); break;
                        case 3: $status = lang('Label.pending'); break;
                        case 4: $status = lang('Label.check'); break;
                        default: $status = '';
                    endswitch;

                    switch($ph['type']):
                        case 1: $type = lang('Label.deposit'); break;
                        case 2: $type = lang('Label.withdrawal'); break;
                        case 3: $type = lang('Label.promotion'); break;
                        case 4: $type = lang('Label.rebate'); break;
                        case 5: $type = lang('Label.affiliate'); break;
                        case 6: $type = lang('Label.credittransfer'); break;
                        case 7: $type = lang('Label.wreturn'); break;
                        case 8: $type = lang('Label.jackpot'); break;
                        case 9: $type = lang('Label.spintoken'); break;
                        case 10: $type = lang('Label.pgtransfer'); break;
                        case 11: $type = lang('Label.refcomm'); break;
                        case 12: $type = lang('Label.depcomm'); break;
                        case 13: $type = lang('Label.lossrebate'); break;
                        case 14: $type = lang('Label.affsharereward'); break;
                        case 15: $type = lang('Label.dailyfreereward'); break;
                        default: $type = '---';
                    endswitch;

                    switch($ph['method']):
                        case 1: $method = lang('Label.banktransfer'); break;
                        case 2: $method = lang('Label.paygateway'); break;
                        case 3: $method = lang('Label.topupcode'); break;
                        default: $method = '';
                    endswitch;

                    $date = Time::parse(date('Y-m-d H:i:s', strtotime($ph['createDate'])));
                    $created = $date->toDateTimeString();

                    $btngame = '<button class="btn btn-light btn-sm getupline ms-1" data-uid="'.base64_encode($ph['toUserId']).'"><i class="bx bxs-user-account"></i></button>';

                    $action = '<div class="btn-group" role="group">';
                    $action .= '<button type="button" class="btn btn-danger btn-sm bg-gradient" onclick="permission(\''.base64_encode($ph['paymentId']).'\',\''.$ph['toLoginId'].'\',\'2\')">'.lang('Nav.reject').'</button>';
                    $action .= '<button type="button" class="btn btn-success btn-sm bg-gradient" onclick="permission(\''.base64_encode($ph['paymentId']).'\',\''.$ph['toLoginId'].'\',\'1\')">'.lang('Nav.approve').'</button>';
                    $action .= '</div>';

                    $row = [];
                    $row[] = $created;
                    $row[] = $ph['paymentId'];
                    $row[] = $ph['toLoginId'].$btngame;
                    $row[] = $ph['toUserName'];
                    $row[] = $ph['turnover'].'/'.$ph['currentTurnover'];
                    $row[] = $ph['amount'];
                    $row[] = !empty($ph['remark']) ? $ph['remark'] : '---';
                    $row[] = $action;
                    $data[] = $row;
                endif;
            endforeach;
            echo json_encode(['data'=>$data, 'code'=>1, 'pageIndex'=>$payload['pageIndex'], 'rowPerPage'=>$payload['rowPerPage'], 'totalPage'=>$payload['totalPage'], 'totalRecord'=>$payload['totalRecord']]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function pendingWithdrawalList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $lng = strtoupper($_SESSION['lang']);

        $raw = json_decode(file_get_contents('php://input'),1);

        $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime('-31 days'))));
        $to = date('c', strtotime(date('Y-m-d 23:59:59')));

        $payload = $this->balance_model->selectAllTransaction3([
            'userid' => base64_decode($raw['parent']),
            'method' => [1],
            'type' => [2],
            'status' => [3],
            'fromcreatedate' => $from,
            'tocreatedate' => $to,
            'paymentid' => '',
            'fromwallettype' => [],
            'towallettype' => [],
            'fromaccountno' => '',
            'toaccountno' => '',
            'frombankid' => '',
            'tobankid' => '',
            'fromuserid' => '',
            'touserid' => '',
            'createby' => '',
            'AgentCreateBy' => "",
            'fromuseragentid' => "",
            'touseragentid' => "",

            'self' => true,
            'desc' => false,
            'pageindex' => $raw['pageindex'],
            'rowperpage' => $raw['rowperpage'],
        ]);
        // echo json_encode($payload);

        if( $payload['code']==1 && $payload['data']!=[] ):
            $data = [];
            foreach( $payload['data'] as $ph ):
                switch($ph['status']):
                    case 1: $status = lang('Label.approve'); break;
                    case 2: $status = lang('Label.reject'); break;
                    case 3: $status = lang('Label.pending'); break;
                    case 4: $status = lang('Label.check'); break;
                    default: $status = '';
                endswitch;

                switch($ph['type']):
                    case 1: $type = lang('Label.deposit'); break;
                    case 2: $type = lang('Label.withdrawal'); break;
                    case 3: $type = lang('Label.promotion'); break;
                    case 4: $type = lang('Label.rebate'); break;
                    case 5: $type = lang('Label.affiliate'); break;
                    case 6: $type = lang('Label.credittransfer'); break;
                    case 7: $type = lang('Label.wreturn'); break;
                    case 8: $type = lang('Label.jackpot'); break;
                    case 9: $type = lang('Label.spintoken'); break;
                    case 10: $type = lang('Label.pgtransfer'); break;
                    case 11: $type = lang('Label.refcomm'); break;
                    case 12: $type = lang('Label.depcomm'); break;
                    case 13: $type = lang('Label.lossrebate'); break;
                    case 14: $type = lang('Label.affsharereward'); break;
                    case 15: $type = lang('Label.dailyfreereward'); break;
                    default: $type = '---';
                endswitch;

                switch($ph['method']):
                    case 1: $method = lang('Label.banktransfer'); break;
                    case 2: $method = lang('Label.paygateway'); break;
                    case 3: $method = lang('Label.topupcode'); break;
                    default: $method = '';
                endswitch;

                $toBank = $ph['toBankName'][$lng];
                $frmBank = $ph['fromBankName'][$lng];
                $bank = $ph['toBankName'][$lng];

                if( $ph['fromUserId']!=$_ENV['secret'] && ($ph['type']==1 || $ph['type']==2) ):
                    if( $ph['method']==1 ):
                        $kind = '<span class="badge bg-primary fw-normal me-1">'.$type.'</span>'.$method;
                    else:
                        $kind = '<span class="badge bg-primary fw-normal me-1">'.$type.'</span>';
                        $kind .= '<span class="badge bg-primary fw-normal me-1">'.$frmBank.'</span>';
                        $kind .= $method;
                    endif;
                else:
                    $kind = $type;
                endif;

                $date = Time::parse(date('Y-m-d H:i:s', strtotime($ph['createDate'])));
                $created = $date->toDateTimeString();

                $btngame = '<button class="btn btn-light btn-sm getupline ms-1" data-uid="'.base64_encode($ph['toUserId']).'"><i class="bx bxs-user-account"></i></button>';

                $action = '<div class="btn-group" role="group">';
                $action .= '<button type="button" class="btn btn-danger btn-sm bg-gradient" onclick="permission(\''.base64_encode($ph['paymentId']).'\',\''.$ph['toLoginId'].'\',\'2\')">'.lang('Nav.reject').'</button>';
                $action .= '<button type="button" class="btn btn-success btn-sm bg-gradient" onclick="permission(\''.base64_encode($ph['paymentId']).'\',\''.$ph['toLoginId'].'\',\'1\')">'.lang('Nav.approve').'</button>';
                $action .= '</div>';

                $accHolder = '<a href="javascript:void(0);" class="text-primary" onclick="cardOwner(\''.base64_encode($ph['toUserId']).'\',\''.base64_encode($ph['toBankId']).'\',\''.$ph['toCardNo'].'\',\''.$ph['toAccountNo'].'\');"><i class="bx bxs-credit-card"></i></a><small class="holder"></small>';

                if( $ph['fromUserId']!=$_ENV['secret'] && $ph['type']==1 ):
                    if( $ph['method']==1 ):
                        $relatedCard = '<a href="#" class="d-inline-block mx-1 popoverButton" onclick="cardOwner(\''.base64_encode($ph['fromUserId']).'\',\''.base64_encode($ph['fromBankId']).'\',\''.$ph['fromCardNo'].'\',\''.$ph['fromAccountNo'].'\',\''.$frmBank.'\',\''.$ph['type'].'\');"><i class="bx bxs-credit-card"></i></a>';
                    else:
                        $relatedCard = '';
                    endif;
                elseif( $ph['fromUserId']!=$_ENV['secret'] && $ph['type']==2 ):
                    $relatedCard = '<a href="#" class="d-inline-block mx-1 popoverButton" onclick="cardOwner(\''.base64_encode($ph['toUserId']).'\',\''.base64_encode($ph['toBankId']).'\',\''.$ph['toCardNo'].'\',\''.$ph['toAccountNo'].'\',\''.$toBank.'\',\''.$ph['type'].'\');"><i class="bx bxs-credit-card"></i></a>';
                else:
                    $relatedCard = '';
                endif;

                $row = [];
                $row[] = $created;
                $row[] = $ph['paymentId'];
                $row[] = $ph['toLoginId'].$btngame;
                $row[] = $ph['toUserName'];
                // $row[] = $kind.$relatedCard;
                $row[] = $ph['type']!=3 ? '<small class="badge bg-primary fw-normal me-1">'.$bank.'</small>'.$ph['toAccountNo'].$relatedCard : '--- '.lang('Label.promotion').' ---';
                $row[] = $ph['turnover'].'/'.$ph['currentTurnover'];
                $row[] = $ph['systemAmount'];
                $row[] = $ph['amount'];
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(['data'=>$data, 'code'=>1, 'pageIndex'=>$payload['pageIndex'], 'rowPerPage'=>$payload['rowPerPage'], 'totalPage'=>$payload['totalPage'], 'totalRecord'=>$payload['totalRecord']]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function pendingDepositList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $lng = strtoupper($_SESSION['lang']);

        $raw = json_decode(file_get_contents('php://input'),1);

        $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime('-29 days'))));
        $to = date('c', strtotime(date('Y-m-d 23:59:59')));

        $payload = $this->balance_model->selectAllTransaction3([
            'userid' => base64_decode($raw['parent']),
            'method' => [1],
            'type' => [1,3],
            'status' => [3],
            'fromcreatedate' => $from,
            'tocreatedate' => $to,
            'paymentid' => '',
            'fromwallettype' => [],
            'towallettype' => [],
            'fromaccountno' => '',
            'toaccountno' => '',
            'frombankid' => '',
            'tobankid' => '',
            'fromuserid' => '',
            'touserid' => '',
            'createby' => '',
            'AgentCreateBy' => "",
            'fromuseragentid' => "",
            'touseragentid' => "",

            'self' => true,
            'desc' => false,
            'pageindex' => $raw['pageindex'],
            'rowperpage' => $raw['rowperpage'],
        ]);
        // echo json_encode($payload);

        if( $payload['code']==1 && $payload['data']!=[] ):
            $data = [];
            foreach( $payload['data'] as $ph ):
                switch($ph['status']):
                    case 1: $status = lang('Label.approve'); break;
                    case 2: $status = lang('Label.reject'); break;
                    case 3: $status = lang('Label.pending'); break;
                    case 4: $status = lang('Label.check'); break;
                    default: $status = '';
                endswitch;

                switch($ph['method']):
                    case 1: $method = lang('Label.banktransfer'); break;
                    case 2: $method = lang('Label.paygateway'); break;
                    case 3: $method = lang('Label.topupcode'); break;
                    default: $method = '';
                endswitch;

                $toBank = $ph['toBankName'][$lng];
                $frmBank = $ph['fromBankName'][$lng];
                $bank = $ph['fromBankName'][$lng];
                $promo = $ph['promotionTitle'][$lng];

                $date = Time::parse(date('Y-m-d H:i:s', strtotime($ph['createDate'])));
                $created = $date->toDateTimeString();

                $btngame = '<button class="btn btn-light btn-sm getupline ms-1" data-uid="'.base64_encode($ph['toUserId']).'"><i class="bx bxs-user-account"></i></button>';

                if( $ph['fromUserId']!=$_ENV['secret'] && $ph['type']==1 ):
                    if( $ph['method']==1 ):
                        $relatedCard = '<a href="#" class="d-inline-block mx-1 popoverButton" onclick="cardOwner(\''.base64_encode($ph['fromUserId']).'\',\''.base64_encode($ph['fromBankId']).'\',\''.$ph['fromCardNo'].'\',\''.$ph['fromAccountNo'].'\',\''.$frmBank.'\',\''.$ph['type'].'\');"><i class="bx bxs-credit-card"></i></a>';
                    else:
                        $relatedCard = '';
                    endif;
                elseif( $ph['fromUserId']!=$_ENV['secret'] && $ph['type']==2 ):
                    $relatedCard = '<a href="#" class="d-inline-block mx-1 popoverButton" onclick="cardOwner(\''.base64_encode($ph['toUserId']).'\',\''.base64_encode($ph['toBankId']).'\',\''.$ph['toCardNo'].'\',\''.$ph['toAccountNo'].'\',\''.$toBank.'\',\''.$ph['type'].'\');"><i class="bx bxs-credit-card"></i></a>';
                else:
                    $relatedCard = '';
                endif;

                $action = '<div class="btn-group" role="group">';
                $action .= '<button type="button" class="btn btn-danger btn-sm bg-gradient" onclick="permission(\''.base64_encode($ph['paymentId']).'\',\''.$ph['toLoginId'].'\',\'2\')">'.lang('Nav.reject').'</button>';
                $action .= '<button type="button" class="btn btn-success btn-sm bg-gradient" onclick="permission(\''.base64_encode($ph['paymentId']).'\',\''.$ph['toLoginId'].'\',\'1\')">'.lang('Nav.approve').'</button>';
                $action .= '</div>';

                $row = [];
                $row[] = $created;
                $row[] = $ph['paymentId'];
                // $row[] = '['.$ph['toLoginId'].'] '.$ph['toUserName'].$btngame;
                $row[] = $ph['toLoginId'].$btngame;
                // $row[] = $method;
                $row[] = $ph['toUserName'];
                $row[] = $ph['type']!=3 ? '<small class="badge bg-primary fw-normal me-1">'.$bank.'</small>'.$ph['fromAccountNo'].$relatedCard : '--- '.lang('Label.promotion').' ---';
                $row[] = $ph['referId'];
                $row[] = !empty($promo) ? '<small class="badge bg-dark me-1">'.$ph['promotionId'].'</small>'.$promo : '---';
                $row[] = bcdiv($ph['turnover'],1,2).'/'.bcdiv($ph['currentTurnover'],1,2);
                $row[] = $ph['systemAmount'];
                $row[] = $ph['amount'];
                $row[] = !empty($ph['slipPath']) ? '<a target="_blank" href="'.$ph['slipPath'].'">'.$ph['slipPath'].'</a>' : '---';
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(['data'=>$data, 'code'=>1, 'pageIndex'=>$payload['pageIndex'], 'rowPerPage'=>$payload['rowPerPage'], 'totalPage'=>$payload['totalPage'], 'totalRecord'=>$payload['totalRecord']]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function transactionHistoryList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $lng = strtoupper($_SESSION['lang']);

        $raw = json_decode(file_get_contents('php://input'),1);

        if( !empty($raw['start']) && !empty($raw['end']) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($raw['start']))));
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($raw['end']))));
        else:
            $from = date('c', strtotime(date('Y-m-d 00:00:00')));
            $to = date('c', strtotime(date('Y-m-d 23:59:59')));
        endif;

        // Convert Username to UID
        if( !empty($raw['uplinecreateby']) ):
            $searchUplineCreateBy= $this->searchUsername($raw['roleuplinecreateby'],$raw['uplinecreateby']);
            if( $searchUplineCreateBy['code']==1 && $searchUplineCreateBy['data']!=[] ):
                foreach( $searchUplineCreateBy['data'] as $u ):
                    $uplinecreateby = $u['userId'];
                endforeach;
            else:
                $uplinecreateby = '';
            endif;
        else:
            $uplinecreateby = '';
        endif;

        if( !empty($raw['createby']) ):
            $searchCreateBy= $this->searchUsername($raw['rolecreateby'],$raw['createby']);
            if( $searchCreateBy['code']==1 && $searchCreateBy['data']!=[] ):
                foreach( $searchCreateBy['data'] as $u ):
                    $createby = $u['userId'];
                endforeach;
            else:
                $createby = '';
            endif;
        else:
            $createby = '';
        endif;

        if( !empty($raw['frmusername']) ):
            $searchFrmUser= $this->searchUsername($raw['rolefrmuser'],$raw['frmusername']);
            if( $searchFrmUser['code']==1 && $searchFrmUser['data']!=[] ):
                foreach( $searchFrmUser['data'] as $u ):
                    $fromuser = $u['userId'];
                endforeach;
            else:
                $fromuser = '';
            endif;
        else:
            $fromuser = '';
        endif;

        if( !empty($raw['tousername']) ):
            $searchToUser= $this->searchUsername($raw['role2user'],$raw['tousername']);
            if( $searchToUser['code']==1 && $searchToUser['data']!=[] ):
                foreach( $searchToUser['data'] as $u ):
                    $touser = $u['userId'];
                endforeach;
            else:
                $touser = '';
            endif;
        else:
            if( $raw['role2user']==2 ):
                $fromuser = $_ENV['secret'];
                $touser = $_ENV['host'];
            else:
                $touser = '';
            endif;
        endif;
        // End Convert Username to UID

        // Wallet Types
        if( !empty($raw['frmwallet']) ):
            $frmWallet = array_map('intval', [$raw['frmwallet']]);
        else:
            $frmWallet = [];
        endif;

        if( !empty($raw['towallet']) ):
            $toWallet = array_map('intval', [$raw['towallet']]);
        else:
            $toWallet = [];
        endif;
        // End Wallet Types

        // Payment Transaction
        $payload = $this->balance_model->selectAllTransaction3([
            'userid' => base64_decode($raw['parent']),
            'method' => array_map('intval', $raw['method']),
            'type' => array_map('intval', $raw['type']),
            'status' => array_map('intval', $raw['status']),
            // 'FromApprovedDate' => $from,
            // 'ToApprovedDate' => $to,
            'fromcreatedate' => $from,
            'tocreatedate' => $to,
            'paymentid' => $raw['payid'],
            'fromwallettype' => $frmWallet,
            'towallettype' => $toWallet,
            'fromaccountno' => $raw['frmaccno'],
            'toaccountno' => $raw['toaccno'],
            'frombankid' => base64_decode($raw['frmbankid']),
            'tobankid' => base64_decode($raw['tobankid']),
            'fromuserid' => $fromuser,
            'touserid' => $touser,
            'createby' => $createby,
            // 'uplinecreateby' => $uplinecreateby,
            'AgentCreateBy' => "",
            'fromuseragentid' => "",
            'touseragentid' => $uplinecreateby,

            'desc' => true,
            'pageindex' => $raw['pageindex'],
            'rowperpage' => $raw['rowperpage'],
        ]);
        //echo json_encode($payload);

        if( $payload['code'] == 1 && $payload['data'] != [] ):
            $data = [];
            foreach( $payload['data'] as $ph ):
                switch($ph['status']):
                    case 1: $status = lang('Label.success'); break;
                    case 2: $status = lang('Label.reject'); break;
                    case 3: $status = lang('Label.pending'); break;
                    case 4: $status = lang('Label.check'); break;
                    default: $status = '---';
                endswitch;

                switch($ph['type']):
                    case 1: $type = lang('Label.deposit'); break;
                    case 2: $type = lang('Label.withdrawal'); break;
                    case 3: $type = lang('Label.promotion'); break;
                    case 4: $type = lang('Label.rebate'); break;
                    case 5: $type = lang('Label.affiliate'); break;
                    case 6: $type = lang('Label.credittransfer'); break;
                    case 7: $type = lang('Label.wreturn'); break;
                    case 8: $type = lang('Label.jackpot'); break;
                    case 9: $type = lang('Label.fortunetoken'); break;
                    case 10: $type = lang('Label.pgreplenishment'); break;
                    case 11: $type = lang('Label.refdepcomm'); break;
                    case 12: $type = lang('Label.depcomm'); break;
                    case 13: $type = lang('Label.lossrebate'); break;
                    case 14: $type = lang('Label.affsharereward'); break;
                    case 15: $type = lang('Label.dailyfreereward'); break;
                    case 16: $type = lang('Label.affloserebate'); break;
                    case 17: $type = lang('Label.fortunereward'); break;
                    case 18: $type = lang('Label.checkin'); break;
                    case 19: $type = lang('Label.freescore');
                    case 20: $type = lang('Label.wallettransfer'); break;
                    default: $type = '---';
                endswitch;

                $toBank = $ph['toBankName'][$lng];
                $frmBank = $ph['fromBankName'][$lng];
                $promo = $ph['promotionTitle'][$lng];

                switch($ph['method']):
                    case 1: $method = lang('Label.banktransfer'); break;
                    case 2: $method = lang('Label.paygateway'); break;
                    case 3: $method = lang('Label.topupcode'); break;
                    default: $method = '---';
                endswitch;

                if( $ph['fromUserId']!=$_ENV['secret'] && ($ph['type']==1 || $ph['type']==2) ):
                    if( $ph['method']==1 ):
                        $kind = '<span class="badge bg-primary fw-normal me-1">'.$type.'</span>'.$method;
                    else:
                        $kind = '<span class="badge bg-primary fw-normal me-1">'.$type.'</span>';
                        $kind .= '<span class="badge bg-primary fw-normal me-1">'.$frmBank.'</span>';
                        $kind .= $method;
                    endif;
                else:
                    $kind = $type;
                endif;

                $date = Time::parse(date('Y-m-d H:i:s', strtotime($ph['createDate'])));
                $created = $date->toDateTimeString();

                $date2 = Time::parse(date('Y-m-d H:i:s', strtotime($ph['approvedDate'])));
                $approveDate = $date2->toDateTimeString();

                if( $ph['fromUserId']!=$_ENV['secret'] ):
                    $btngame = '<button class="btn btn-light btn-sm getupline ms-1" data-uid="'.base64_encode($ph['toUserId']).'"><i class="bx bxs-user-rectangle"></i></button>';
                else:
                    $btngame = '';
                endif;

                $accHolder = '<a href="javascript:void(0);" class="text-primary" onclick="cardOwner(\''.base64_encode($ph['toUserId']).'\',\''.base64_encode($ph['toBankId']).'\',\''.$ph['toCardNo'].'\',\''.$ph['toAccountNo'].'\');"><i class="las la-credit-card"></i></a><small class="holder"></small>';

                if( $ph['fromUserId']!=$_ENV['secret'] && $ph['type']==1 ):
                    if( $ph['method']==1 ):
                        // $relatedCard = '<span class="d-inline-block mx-1" data-uid="'.base64_encode($ph['fromUserId']).'" data-bid="'.base64_encode($ph['fromBankId']).'" data-card="'.$ph['fromCardNo'].'" data-accno="'.$ph['fromAccountNo'].'" data-bs-html="true" data-bs-toggle="popover" data-bs-placement="top" title="Company Card.Info" data-bs-content="';
                        // $relatedCard .= "Bank: ".$frmBank."<br>";
                        // $relatedCard .= "Holder: <b class='holder text-primary'></b><br>";
                        // $relatedCard .= 'Account No.: '.$ph['fromAccountNo'];
                        // $relatedCard .= '"><i class="las la-credit-card text-primary"></i></span>';

                        $relatedCard = '<a href="#" class="d-inline-block mx-1 popoverButton" onclick="cardOwner(\''.base64_encode($ph['fromUserId']).'\',\''.base64_encode($ph['fromBankId']).'\',\''.$ph['fromCardNo'].'\',\''.$ph['fromAccountNo'].'\',\''.$frmBank.'\',\''.$ph['type'].'\');"><i class="las la-credit-card text-primary"></i></a>';
                    else:
                        $relatedCard = '';
                    endif;
                elseif( $ph['fromUserId']!=$_ENV['secret'] && $ph['type']==2 ):
                    // $relatedCard = '<span class="d-inline-block mx-1" data-uid="'.base64_encode($ph['toUserId']).'" data-bid="'.base64_encode($ph['toBankId']).'" data-card="'.$ph['toCardNo'].'" data-accno="'.$ph['toAccountNo'].'" data-bs-html="true" data-bs-toggle="popover" data-bs-placement="top" title="Member Card.Info" data-bs-content="';
                    // $relatedCard .= "Bank: ".$toBank."<br>";
                    // $relatedCard .= "Holder: <b class='holder text-primary'></b><br>";
                    // $relatedCard .= 'Account No.: '.$ph['toAccountNo'];
                    // $relatedCard .= '"><i class="las la-credit-card text-primary"></i></span>';

                    $relatedCard = '<a href="#" class="d-inline-block mx-1 popoverButton" onclick="cardOwner(\''.base64_encode($ph['toUserId']).'\',\''.base64_encode($ph['toBankId']).'\',\''.$ph['toCardNo'].'\',\''.$ph['toAccountNo'].'\',\''.$toBank.'\',\''.$ph['type'].'\');"><i class="las la-credit-card text-primary"></i></a>';
                else:
                    $relatedCard = '';
                endif;

                $approveIP = !empty($ph['approvedIP']) ? $ph['approvedIP'] : $ph['ip'];

                $row = [];
                $row[] = $created;
                $row[] = $ph['toLoginId'].$btngame;
                $row[] = $ph['toUserName'];
                $row[] = $status;
                $row[] = $kind.$relatedCard;
                $row[] = $ph['createBy'];
                $row[] = $ph['systemAmount'];
                $row[] = $ph['amount'];
                $row[] = $ph['paymentId'];
                $row[] = !empty($ph['reference']) ? $ph['reference'] : '---';
                $row[] = !empty($ph['referId']) ? $ph['referId'] : '---';
                $row[] = !empty($promo) ? '<small class="badge bg-dark me-1">'.$ph['promotionId'].'</small>'.$promo : '---';
                $row[] = $ph['turnover'].' | <small class="badge bg-primary fw-normal me-1">Required: '.$ph['currentTurnover'].'</small>';
                $row[] = !empty($ph['remark']) ? $ph['remark'] : '---';
                $row[] = !empty($ph['slipPath']) ? '<a target="_blank" href="'.$ph['slipPath'].'">'.$ph['slipPath'].'</a>' : '---';
                $row[] = $ph['ip'];
                $row[] = '<small class="badge bg-dark fw-normal me-1">'.$approveIP.'</small><small class="badge bg-dark fw-normal me-1">'.$approveDate.'</small>'.$ph['approvedBy'];
                $data[] = $row;
            endforeach;
            echo json_encode([
                'data' => $data, 
                'code' => 1, 
                'pageIndex' => $payload['pageIndex'], 
                'rowPerPage' => $payload['rowPerPage'], 
                'totalPage' => $payload['totalPage'],
                'totalRecord' => $payload['totalRecord'],
                'total' => $payload['total']
            ]);
        else:
            echo json_encode(['no data']);
        endif;
    }
}