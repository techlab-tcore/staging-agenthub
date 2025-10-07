<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class User_control extends BaseController
{
    /*
    Sub Account
    */

    public function addSubAccount()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $permission = '{"major":{"transaction":"1","report":"1","account":"0","gameprovider":"0","settings":"0","extra":"0","usersearch":"0"}}';

        $payload = [
            'loginid' => $this->request->getpost('params')['username'],
            'password' => $this->request->getpost('params')['password'],
            'name' => $this->request->getpost('params')['username'],
            'contact' => '',
            'remark' => $this->request->getpost('params')['remark'],
            'permission' => $permission,
            'role' => 5 // SubAccount
        ];
        $res = $this->user_model->insertUser($payload);
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

                $action = '<div class="btn-group">';
                $action .= '<a class="btn btn-light btn-sm" href="javascript:void(0);" onclick="modify(\''.base64_encode($u['userId']).'\',\''.$u['loginId'].'\')">'.lang('Nav.edit').'</a>';
                $action .= '<a class="btn btn-light btn-sm" href="javascript:void(0);" onclick="resetPass(\''.base64_encode($u['userId']).'\')">'.lang('Nav.resetpass').'</a>';
                $action .= '<a class="btn btn-light btn-sm" href="javascript:void(0);" onclick="modifyPass(\''.base64_encode($u['userId']).'\')">'.lang('Nav.chgpass').'</a>';
                $action .= '<a class="btn btn-light btn-sm" href="javascript:void(0);" onclick="permission(\''.base64_encode($u['userId']).'\')">'.lang('Nav.userpermission').'</a>';
                if( $u['status']==1 ):
                    $action .= '<a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="modifyStatus(\''.base64_encode($u['userId']).'\', 2)">'.lang('Label.inactive').'</a>';
                else:
                    $action .= '<a class="btn btn-success btn-sm" href="javascript:void(0);" onclick="modifyStatus(\''.base64_encode($u['userId']).'\', 1)">'.lang('Label.active').'</a>';
                endif;
                $action .= '</div>';

                $row = [];
                $row[] = $status;
                $row[] = $u['loginId'];
                $row[] = $u['remark'];
                $row[] = $lastLogin;
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
    Administrator
    */

    public function modifyAdminLink()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $data = [
            'userid' => base64_decode($this->request->getpost('params')['uid']),
            'apiurl' => $this->request->getpost('params')['apiurl'],
            'lobbyurl' => $this->request->getpost('params')['lobbyurl'],
            'mode' => (int)$this->request->getpost('params')['mode'],
            'ptrentptcal' => (int)$this->request->getpost('params')['gpfee'],
            'paymentdeductupline' => filter_var($this->request->getpost('params')['paydeductupline'], FILTER_VALIDATE_BOOLEAN),
            'checkmobile' => (int)$this->request->getpost('params')['mobileveri'],
            'mobilenocount' => (int)$this->request->getpost('params')['mobilecount'],
            'realnamecount' => (int)$this->request->getpost('params')['realnamecount'],
            'hour' => (int)$this->request->getpost('params')['affhour'],
            'min' => (int)$this->request->getpost('params')['affmin'],
            'rebatecalculation' => (int)$this->request->getpost('params')['rebcal'],
            'affiliatecalculation' => (int)$this->request->getpost('params')['affcal'],
            'deductpromocalculation' => (int)$this->request->getpost('params')['promocal'],
            'commissioncalculation' => (int)$this->request->getpost('params')['agcommcal'],
            'pssettlementcalculation' => (int)$this->request->getpost('params')['pscal'],
            'ptcommissioncalculation' => (int)$this->request->getpost('params')['ptcommcal'],
            'multipromotion' => filter_var($this->request->getpost('params')['multipromo'], FILTER_VALIDATE_BOOLEAN),
            'clearturnoverleastamount' => (float)$this->request->getpost('params')['minclear'],
            'checkturnover' => filter_var($this->request->getpost('params')['checkturnover'], FILTER_VALIDATE_BOOLEAN),
            'maxdailywithdrawalcount' => (int)$this->request->getpost('params')['numdailywithdrawal'],
            'afterdailywithdrawalcountchargespercentage' => (float)$this->request->getpost('params')['exceedwithdrawalcharges'],
            'afterdailywithdrawalcountmincharges' => (float)$this->request->getpost('params')['minexceedwithdrawalcharges'],
            'checkbankcard' => (int)$this->request->getpost('params')['uniquebankcard'],
            'bankcardcount' => (int)$this->request->getpost('params')['bankcardcount'],
            'maxgameaccount' => (int)$this->request->getpost('params')['numgameacct'],
            'freecreditamount' => (float)$_ENV['fcAmount'],
        ];

        $param = new \stdClass();
        //Front End
        $param->Maxsend = $this->request->getpost('params')['maxsend'];
        $param->Type = $this->request->getpost('params')['smstype'];
        $param->MYR_URL = $this->request->getpost('params')['myr_smsurl'];
        $param->MYR_Username = $this->request->getpost('params')['myr_smsuser'];
        $param->MYR_Password = $this->request->getpost('params')['myr_smspass'];
        $param->MYR_Whatsapp = $this->request->getpost('params')['myr_whatsapp'];
        $param->SGD_URL = $this->request->getpost('params')['sgd_smsurl'];
        $param->SGD_Username = $this->request->getpost('params')['sgd_smsuser'];
        $param->SGD_Password = $this->request->getpost('params')['sgd_smspass'];
        $param->SGD_Whatsapp = $this->request->getpost('params')['sgd_whatsapp'];
        //Back End
        $param->BO_Maxsend = $this->request->getpost('params')['bmaxsend'];
        $param->BO_Type = $this->request->getpost('params')['bsmstype'];
        $param->BO_MYR_URL = $this->request->getpost('params')['bmyr_smsurl'];
        $param->BO_MYR_Username = $this->request->getpost('params')['bmyr_smsuser'];
        $param->BO_MYR_Password = $this->request->getpost('params')['bmyr_smspass'];
        $param->BO_MYR_Whatsapp = $this->request->getpost('params')['bmyr_whatsapp'];
        $param->BO_SGD_URL = $this->request->getpost('params')['bsgd_smsurl'];
        $param->BO_SGD_Username = $this->request->getpost('params')['bsgd_smsuser'];
        $param->BO_SGD_Password = $this->request->getpost('params')['bsgd_smspass'];
        $param->BO_SGD_Whatsapp = $this->request->getpost('params')['bsgd_whatsapp'];
        $name['smsinfo'] = $param;

        $param2 = new \stdClass();
        $param2->mindeposit = (float)$this->request->getpost('params')['depcomm_mindeposit'];
        $param2->percentage = (float)$this->request->getpost('params')['depcomm_rate'];
        $param2->towalletpercentage = (float)$this->request->getpost('params')['depcomm_chippercent'];
        $param2->togroupname = $this->request->getpost('params')['depcomm_chipgroup'];
        $name2['topUpCommission'] = $param2;

        $param3 = new \stdClass();
        $param3->count = (int)$this->request->getpost('params')['refcomm_count'];
        $param3->mindeposit = (float)$this->request->getpost('params')['refcomm_mindeposit'];
        $param3->tobalance = (float)$this->request->getpost('params')['refcomm_cash'];
        $param3->towallet = (float)$this->request->getpost('params')['refcomm_chip'];
        $param3->togroupname = $this->request->getpost('params')['refcomm_chipgroup'];
        $param3->onlyone = filter_var($this->request->getpost('params')['refcomm_once'], FILTER_VALIDATE_BOOLEAN);
        $name3['referralCommission'] = $param3;

        $dailyFree = filter_var($this->request->getpost('params')['dailyfree'], FILTER_VALIDATE_BOOLEAN);
        if( $dailyFree ):
            $param4 = new \stdClass();
            $param4->amount = (float)$this->request->getpost('params')['dailyfreeamount'];
            $param4->gameproviderid = base64_decode($this->request->getpost('params')['gpid']);
            $param4->gametype = (int)$this->request->getpost('params')['gcate'];
            $param4->wallettype = (int)$this->request->getpost('params')['reward2wallet'];
            $param4->togroupname = $this->request->getpost('params')['dfchipgroup'];
            $param4->deductownagent = filter_var($this->request->getpost('params')['deductdffrmupline'], FILTER_VALIDATE_BOOLEAN);
            $param4->maxbalance = (float)$this->request->getpost('params')['maxbalance'];
            $param4->includetoday = filter_var($this->request->getpost('params')['includetoday'], FILTER_VALIDATE_BOOLEAN);
            $name4['freeCoin'][] = $param4;
        else:
            $name4['freeCoin'] = [];
        endif;

        // $shareReward = filter_var($this->request->getpost('params')['sharedreward'], FILTER_VALIDATE_BOOLEAN);
        // if( $shareReward ):
        //     $param5 = new \stdClass();
        //     $param5->toself = filter_var($this->request->getpost('params')['affsharetoself'], FILTER_VALIDATE_BOOLEAN);
        //     $param5->amount = (float)$this->request->getpost('params')['affshareamount'];
        //     $param5->gameproviderid = base64_decode($this->request->getpost('params')['affsharegpid']);
        //     $param5->gametype = (int)$this->request->getpost('params')['affsharegcate'];
        //     $param5->wallettype = (int)$this->request->getpost('params')['affshare2wallet'];
        //     $param5->togroupname = $this->request->getpost('params')['affsharechipgroup'];
        //     $param5->deductownagent = filter_var($this->request->getpost('params')['affsharedeductdffrmupline'], FILTER_VALIDATE_BOOLEAN);
        //     $name5['refRegCommission'][] = $param5;
        // else:
        //     $name5['refRegCommission'] = [];
        // endif;

        $shareReward = filter_var($this->request->getpost('params')['sharedreward'], FILTER_VALIDATE_BOOLEAN);
        $shareReward2 = isset($this->request->getpost('params')['sharedreward2']) ? filter_var($this->request->getpost('params')['sharedreward2'], FILTER_VALIDATE_BOOLEAN) : false;
        if( $shareReward ):
            $row = [];

            if( $shareReward ):
                $param5 = new \stdClass();
                $param5->toself = filter_var($this->request->getpost('params')['affsharetoself'], FILTER_VALIDATE_BOOLEAN);
                $param5->amount = (float)$this->request->getpost('params')['affshareamount'];
                $param5->gameproviderid = base64_decode($this->request->getpost('params')['affsharegpid']);
                $param5->gametype = (int)$this->request->getpost('params')['affsharegcate'];
                $param5->wallettype = (int)$this->request->getpost('params')['affshare2wallet'];
                $param5->togroupname = $this->request->getpost('params')['affsharechipgroup'];
                $param5->deductownagent = filter_var($this->request->getpost('params')['affsharedeductdffrmupline'], FILTER_VALIDATE_BOOLEAN);
                $param5->maxbalance = (float)$this->request->getpost('params')['affreg_maxbalance'];
                $row[] = $param5;
            endif;

            if( $shareReward2 ):
                $param6 = new \stdClass();
                $param6->toself = filter_var($this->request->getpost('params')['affsharetoself2'], FILTER_VALIDATE_BOOLEAN);
                $param6->amount = (float)$this->request->getpost('params')['affshareamount2'];
                $param6->gameproviderid = base64_decode($this->request->getpost('params')['affsharegpid2']);
                $param6->gametype = (int)$this->request->getpost('params')['affsharegcate2'];
                $param6->wallettype = (int)$this->request->getpost('params')['affshare2wallet2'];
                $param6->togroupname = $this->request->getpost('params')['affsharechipgroup2'];
                $param6->deductownagent = filter_var($this->request->getpost('params')['affsharedeductdffrmupline2'], FILTER_VALIDATE_BOOLEAN);
                $param6->maxbalance = (float)$this->request->getpost('params')['affreg_maxbalance2'];
                $row[] = $param6;
            endif;

            $name5['refRegCommission'] = $row;
        else:
            $name5['refRegCommission'] = [];
        endif;

        $currencyCode = $this->request->getpost('params')['currencycode'];
        $payload = array_merge($data,$name,$name2,$name3,$name4,$name5);

        $res = $this->user_model->updateAdminLink($payload, $currencyCode);
        echo json_encode($res);
    }

    public function getAdminLink()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('params')['currencycode'];

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid'])
        ];
        $res = $this->user_model->selectAdminLink($payload, $currencyCode);
        echo json_encode($res);
    }

    public function addAdministratorOLD()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'agentid' => $_SESSION['token'],
            'loginid' => strtoupper($this->request->getpost('params')['username']),
            'password' => $this->request->getpost('params')['password'],
            'name' => $this->request->getpost('params')['fname'],
            'dob' => date('Y-m-d',time()),
            'contact' => $this->request->getpost('params')['contact'],
            'email' => $this->request->getpost('params')['email'],
            'telegram' => $this->request->getpost('params')['telegram'],
            'currency' => $this->request->getpost('params')['currency'],
            'gender' => 1,
            'address' => null,
            'permission' => null,
            'apiurl' => $this->request->getpost('params')['apiurl'],
            'lobbyurl' => $this->request->getpost('params')['lobbyurl'],
            'role' => 2
        ];
        $res = $this->user_model->insertUser($payload);
        echo json_encode($res);
    }

    public function addAdministrator()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'agentid' => $_SESSION['token'],
            'loginid' => strtoupper($this->request->getpost('params')['username']),
            'password' => $this->request->getpost('params')['password'],
            'name' => $this->request->getpost('params')['fname'],
            'regioncode' => $this->request->getpost('params')['regioncode'],
            'contact' => $this->request->getpost('params')['contact'],
            'telegram' => $this->request->getpost('params')['telegram'],
            'permission' => null,
            'gender' => 1,
            'remark' => null,
            'role' => 2,
            'address' => null,
            'apiurl' => $this->request->getpost('params')['apiurl'],
            'lobbyurl' => $this->request->getpost('params')['lobbyurl'],
            'currencycode' => (int)$this->request->getpost('params')['currencycode'],
        ];
        $res = $this->user_model->insertUser($payload);
        echo json_encode($res);
    }

    public function administratorList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $raw = json_decode(file_get_contents('php://input'),1);

        $payload = [
            'userid' => $_SESSION['token'],
            'role' => 2,
            'pageindex' => $raw['pageindex'],
            'rowperpage' => $raw['rowperpage']
        ];
        $res = $this->user_model->selectAllUsersHub($payload);

        if( $res['code']==1 && $res['data']!=[] ):
            $data = [];
            foreach( $res['data'] as $u ):

                //User Currency Check
                $payloadUser = [
                    'userid' => $u['id'],
                    'currencycode' => 0
                ];
                $resCurrency= $this->user_model->selectUserCurrency($payloadUser);
                $currency = '';
                if ( $resCurrency['code']==1 && $resCurrency['data']!=[] ):
                    foreach( $resCurrency['data'] as $ph ):
                        if ($ph['existed']==true):
                            switch($ph['currencyCode']):
                                case 0: $currencyCode = 'MYR'; break;
                                case 1: $currencyCode = 'VND'; break;
                                case 2: $currencyCode = 'EUSDT'; break;
                                case 3: $currencyCode = 'TUSDT'; break;
                                case 4: $currencyCode = 'BTC'; break;
                                case 5: $currencyCode = 'USD'; break;
                                case 6: $currencyCode = 'MMK'; break;
                                case 7: $currencyCode = 'EUR'; break;
                                case 8: $currencyCode = 'SGD'; break;
                                case 9: $currencyCode = 'CNY'; break;
                                case 10: $currencyCode = 'THB'; break;
                                case 11: $currencyCode = 'INR'; break;
                                case 12: $currencyCode = 'BND'; break;
                                case 13: $currencyCode = 'BDT'; break;
                                case 14: $currencyCode = 'IDR'; break;
                                default: $currencyCode = '';
                            endswitch;

                            $currency .= '<div class="btn-group me-1">';
                            $currency .= '<a class="btn btn-warning btn-sm dropdown-toggle fw-bolder" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">'.$currencyCode.'</a>';
                            $currency .= '<ul class="dropdown-menu dropdown-menu-end border-white" aria-labelledby="navProfile">';
                            $currency .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="openTransfer(\''.base64_encode($u['id']).'\',\''.$u['loginId'].'\',\''.$currencyCode.'\');"><small class="badge bg-primary fw-normal me-1"><i class="las la-coins"></i></small>Credit Transfer</a></li>';
                            $currency .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="adminLink(\''.base64_encode($u['id']).'\',\''.$currencyCode.'\');"><small class="badge bg-primary fw-normal me-1"><i class="las la-tools"></i></small>Admin Link</a></li>';
                            $currency .= '<li><a class="dropdown-item" href="'.base_url('administrator/position-taking/'.base64_encode($u['id']).'/'.$currencyCode).'"><small class="badge bg-primary fw-normal me-1"><i class="las la-percentage"></i></small>Position Taking</a></li>';
                            $currency .= '<li><a class="dropdown-item" href="'.base_url('administrator/game-provider/'.base64_encode($u['id']).'/'.$currencyCode).'"><small class="badge bg-primary fw-normal me-1"><i class="las la-gamepad"></i></small>Game Provider</a></li>';
                            $currency .= '<li><a class="dropdown-item" href="'.base_url('administrator/game-category/'.base64_encode($u['id']).'/'.$currencyCode).'"><small class="badge bg-primary fw-normal me-1"><i class="las la-stream"></i></small>Game Category</a></li>';
                            $currency .= '<li class="dropdown-divider"></li>';
                            $currency .= '<li><a class="dropdown-item" href="'.base_url('payment-provider/bank/'.$currencyCode).'"><small class="badge bg-primary fw-normal me-1"><i class="las la-university"></i></small>Bank</a></li>';
                            $currency .= '<li><a class="dropdown-item" href="'.base_url('payment-provider/payment-gateway/'.$currencyCode).'"><small class="badge bg-primary fw-normal me-1"><i class="las la-cloud"></i></small>Payment Gateway</a></li>';
                            $currency .= '<li class="dropdown-divider"></li>';
                            $currency .= '<li><a class="dropdown-item" href="'.base_url('settings/languages/'.$currencyCode).'"><small class="badge bg-primary fw-normal me-1"><i class="las la-language"></i></small>Languages</a></li>';
                            $currency .= '<li><a class="dropdown-item" href="'.base_url('settings/currencies/'.$currencyCode).'"><small class="badge bg-primary fw-normal me-1"><i class="las la-yen-sign"></i></small>Currency</a></li>';
                            $currency .= '<li class="dropdown-divider"></li>';
                            $currency .= '<li><a class="dropdown-item" href="'.base_url('settings/payment-types/'.$currencyCode).'"><small class="badge bg-primary fw-normal me-1"><i class="las la-cash-register"></i></small>Payment Types</a></li>';
                            $currency .= '<li><a class="dropdown-item" href="'.base_url('settings/payment-status/'.$currencyCode).'"><small class="badge bg-primary fw-normal me-1"><i class="las la-money-bill"></i></small>Payment Status</a></li>';
                            $currency .= '<li><a class="dropdown-item" href="'.base_url('settings/error-code/'.$currencyCode).'"><small class="badge bg-primary fw-normal me-1"><i class="las la-bug"></i></small>Error Code</a></li>';
                            //$currency .= '<li class="dropdown-divider"></li>';
                            //$currency .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="modify(\''.base64_encode($u['id']).'\',\''.$u['loginId'].'\',\''.$currencyCode.'\');"><small class="badge bg-primary fw-normal me-1"><i class="las la-cog"></i></small>Edit</a></li>';
                            $currency .= '</ul>';
                            $currency .= '<a class="btn btn-secondary btn-sm fw-bolder me-1" href="'.base_url('history/transaction/'.$currencyCode).'"><i class="las la-file-invoice-dollar"></i></a>';
                            $currency .= '</div>';
                        endif;
                    endforeach;
                else:
                    echo json_encode($resCurrency);
                endif;

                $action = '<div class="btn-group">';
                $action .= '<a class="btn btn-primary btn-sm fw-bolder me-1" href="javascript:void(0);" onclick="modify(\''.base64_encode($u['id']).'\',\''.$u['loginId'].'\',\''.$currencyCode.'\');"><i class="las la-edit"></i></a>';
                $action .= '<a class="btn btn-primary btn-sm fw-bolder me-1" href="javascript:void(0);" onclick="registerByCurrency(\''.base64_encode($u['id']).'\')"><i class="las la-plus-circle"></i></a>';
                if( $u['status']==1 ):
                    $action .= '<a class="btn btn-success btn-sm bg-gradient" href="javascript:void(0);" onclick="modifyStatus(\''.base64_encode($u['id']).'\', 2)">Active</a>';
                else:
                    $action .= '<a class="btn btn-danger btn-sm bg-gradient" href="javascript:void(0);" onclick="modifyStatus(\''.base64_encode($u['id']).'\', 1)">Inactive</a>';
                endif;
                $action .= '</div>';

                $date = Time::parse(date('Y-m-d H:i:s', strtotime($u['createDate'])));
                $created = $date->toDateTimeString();

                $date2 = Time::parse(date('Y-m-d H:i:s', strtotime($u['lastLoginDate'])));
                $lastLogin = $date2->toDateTimeString();

                $row = [];
                $row[] = $u['loginId'];
                $row[] = $u['id'];
                $row[] = $u['name'];
                $row[] = !empty($u['contact']) ? $u['contact'] : '---';
                $row[] = !empty($u['telegram']) ? $u['telegram'] : '---';
                $row[] = !empty($u['remark']) ? $u['remark'] : '---';
                $row[] = $lastLogin;
                $row[] = $created;
                $row[] = $currency.$action;
                $data[] = $row;
            endforeach;
            echo json_encode(['data'=>$data, 'code'=>1, 'pageIndex'=>$res['pageIndex'], 'rowPerPage'=>$res['rowPerPage'], 'totalPage'=>$res['totalPage'], 'totalRecord'=>$res['totalRecord']]);
        else:
            echo json_encode($res);
        endif;
    }
    
    /*
    User
    */

    //HUB
    public function getUserProfileHub()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid'])
        ];
        $res = $this->user_model->selectUserHub($payload);
        echo json_encode($res);
    }

    public function registerByCurrency()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid']),
            'apiurl' => $this->request->getpost('params')['apiurlregis'],
            'lobbyurl' => $this->request->getpost('params')['lobbyurlregis'],
            'currencycode' => (int)$this->request->getpost('params')['currencycode']
        ];

        $res = $this->user_model->userRegisterByCurrency($payload);
        echo json_encode($res);
    }

    //MYR
    public function getUserProfile()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('params')['currencycode'];

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid'])
        ];
        $res = $this->user_model->selectUser($payload, $currencyCode);
        echo json_encode($res);
    }

    public function modifyPersonal()
    {
        if( !session()->get('logged_in') ): return false; endif;

        if( !empty($this->request->getpost('params')['newpass']) ):
            $payloadCredentialReset = [
                'userid' => base64_decode($this->request->getpost('params')['uid']),
                'resetpassword' => true
            ];
            $resReset = $this->user_model->updateUserPassword($payloadCredentialReset);
            if( $resReset['code']==1 ):
                $payloadCredential = [
                    'userid' => base64_decode($this->request->getpost('params')['uid']),
                    'password' => $resReset['password'],
                    'newpassword' => $this->request->getpost('params')['newpass'],
                    'resetpassword' => false
                ];
                $resCredential = $this->user_model->updateUserPassword($payloadCredential);
                if( $resCredential['code']==1 ):
                    $payloadProfile = [
                        'userid' => base64_decode($this->request->getpost('params')['uid']),
                        'name' => !empty($this->request->getpost('params')['fname']) ? $this->request->getpost('params')['fname'] : '',
                        'contact' => !empty($this->request->getpost('params')['contact']) ? $this->request->getpost('params')['contact'] : '',
                        'telegram' => !empty($this->request->getpost('params')['telegram']) ? $this->request->getpost('params')['telegram'] : '',
                        'remark' => !empty($this->request->getpost('params')['remark']) ? $this->request->getpost('params')['remark'] : ''
                    ];
                    $res = $this->user_model->updateUser($payloadProfile);
                    if( $res['code']==2 ):
                        echo json_encode(['code'=>1, 'message'=>'SUCCESS']);
                    else:
                        echo json_encode($res);
                    endif;
                    //echo json_encode($res);
                else:
                    echo json_encode($resCredential);
                endif;
            else:
                echo json_encode($resReset);
            endif;
        else:
            $payloadProfile = [
                'userid' => base64_decode($this->request->getpost('params')['uid']),
                'name' => !empty($this->request->getpost('params')['fname']) ? $this->request->getpost('params')['fname'] : '',
                'contact' => !empty($this->request->getpost('params')['contact']) ? $this->request->getpost('params')['contact'] : '',
                'telegram' => !empty($this->request->getpost('params')['telegram']) ? $this->request->getpost('params')['telegram'] : '',
                'remark' => !empty($this->request->getpost('params')['remark']) ? $this->request->getpost('params')['remark'] : ''
            ];
            $res = $this->user_model->updateUser($payloadProfile);
            echo json_encode($res);
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

    public function resetUserPassword()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid']),
            'resetpassword' => true
        ];

        $res = $this->user_model->updateUserPassword($payload);
        echo json_encode($res);
    }

    public function modifyUserPassword()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid']),
            'password' => $this->request->getpost('params')['currentpass'],
            'newpassword' => $this->request->getpost('params')['newcpass'],
            'resetpassword' => false
        ];

        $res = $this->user_model->updateUserPassword($payload);
        echo json_encode($res);
    }

    public function modifySelfPassword()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'password' => $this->request->getpost('params')['currentloginpass'],
            'newpassword' => $this->request->getpost('params')['newcloginpass'],
            'resetpassword' => false
        ];

        $res = $this->user_model->updateUserPassword($payload);
        echo json_encode($res);
    }

    public function getSelfProfile()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $rawProfile = $this->user_model->selectUser(['userid' => $_SESSION['token']]);
        if( $rawProfile['code']==1 && $rawProfile['data']!=null ):
            $final_balance = floor($rawProfile['data']['balance'] * 10000)/10000;
            $result = [
                'code' => $rawProfile['code'],
                'balance' => bcdiv($final_balance,1,2)
            ];
            echo json_encode($result);
        else:
            echo json_encode($rawProfile);
        endif;
    }

    public function logout()
    {
        $session = session();
        $res = $this->user_model->updateUserLogout(['userid'=>$_SESSION['token']]);
        $session->destroy();
        clearstatcache();
        return redirect()->to(base_url());
    }

    public function login()
	{
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $parsedUrl = parse_url($url);
        switch( $parsedUrl['host'] ):
            case 'aghub-super.2833.online':
                $role = 1;
                $refer = $_ENV['secret'];
            break;
            
            case 'aghub-supersub.2833.online':
                $role = 5;
                $refer = $_ENV['host'];
            break;
            endswitch;

        $payload = [
            'agentid' => $refer,
            'loginid' => $this->request->getPost('params')['username'],
            'password' => $this->request->getPost('params')['password'],
            'ip' => $_SESSION['ip'],
            'role' => (int)$role
        ];

        $res = $this->user_model->updateUserLogin($payload);
        if( $res['code']==1 && $res['data']!=[] ):
            $ph = $res['data'];
            $session = session();
            $user_data = [
                'logged_in' => TRUE,
                'token' => $ph['id'],
                'session' => $ph['sessionId'],
                'role' => $ph['role'],
                'username' => $this->request->getPost('params')['username']
            ];
            $session->set($user_data);
        endif;
        echo json_encode($res);
    }
}