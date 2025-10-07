<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Admin_control extends BaseController
{
    /*
    Protected
    */

    protected function getInfor()
    {
        $payload = [
            'userid' => $_SESSION['token']
        ];
        $res = $this->user_model->selectAdminLink($payload);
        return $res;
    }

    /*
    Admin Link
    */

    public function modifyAgentWithdrawTime()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $info = $this->getInfor();

        $data = [
            'userid' => $_SESSION['token'],
            'paymentdeductupline' => filter_var($info['data']['paymentDeductUpline'], FILTER_VALIDATE_BOOLEAN),
            'checkturnover' => filter_var($info['data']['checkTurnover'], FILTER_VALIDATE_BOOLEAN),
            'maxgameaccount' => (int)$info['data']['maxGameAccount'],
            'maxdailywithdrawalcount' => (int)$info['data']['maxDailyWithdrawalCount'],
            'afterdailywithdrawalcountchargespercentage' => (float)$info['data']['afterDailyWithdrawalCountChargesPercentage'],
            'afterdailywithdrawalcountmincharges' => (float)$info['data']['afterDailyWithdrawalCountMinCharges'],
            'refRegCommission' => $info['data']['refRegCommission'],
            'freeCoin' => $info['data']['freeCoin'],
            'freecreditamount' => (float)$_ENV['fcAmount'],
        ];

        $param = new \stdClass();
        $param->block = filter_var($this->request->getpost('params')['status'], FILTER_VALIDATE_BOOLEAN);
        $param->startDay = (int)$this->request->getpost('params')['startDate'];
        $param->startTime = $this->request->getpost('params')['startTime'].':00';
        $param->endDay = (int)$this->request->getpost('params')['endDate'];
        $param->endTime = $this->request->getpost('params')['endTime'].':00';
        $name['paymentBlock'] = $param;

        //$name2['refRegCommission'] = json_encode($info['data']['refRegCommission']);
        //$name3['freeCoin'] = json_encode($info['data']['freeCoin']);

        $payload = array_merge($data,$name);
        $res = $this->user_model->updateAdminLink($payload);
        echo json_encode($res);
    }

    public function modifyAffSharedReward()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $info = $this->getInfor();

        $data = [
            'userid' => $_SESSION['token'],
            'paymentdeductupline' => filter_var($info['data']['paymentDeductUpline'], FILTER_VALIDATE_BOOLEAN),
            'checkturnover' => filter_var($info['data']['checkTurnover'], FILTER_VALIDATE_BOOLEAN),
            'maxgameaccount' => (int)$info['data']['maxGameAccount'],
            'maxdailywithdrawalcount' => (int)$info['data']['maxDailyWithdrawalCount'],
            'afterdailywithdrawalcountchargespercentage' => (float)$info['data']['afterDailyWithdrawalCountChargesPercentage'],
            'afterdailywithdrawalcountmincharges' => (float)$info['data']['afterDailyWithdrawalCountMinCharges'],
            'freecreditamount' => (float)$_ENV['fcAmount'],
        ];

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
                $param6->toself = isset($this->request->getpost('params')['affsharetoself2']) ? filter_var($this->request->getpost('params')['affsharetoself2'], FILTER_VALIDATE_BOOLEAN) : false;
                $param6->amount = (float)$this->request->getpost('params')['affshareamount2'];
                $param6->gameproviderid = base64_decode($this->request->getpost('params')['affsharegpid2']);
                $param6->gametype = (int)$this->request->getpost('params')['affsharegcate2'];
                $param6->wallettype = (int)$this->request->getpost('params')['affshare2wallet2'];
                $param6->togroupname = $this->request->getpost('params')['affsharechipgroup2'];
                $param6->deductownagent = filter_var($this->request->getpost('params')['affsharedeductdffrmupline2'], FILTER_VALIDATE_BOOLEAN);
                $param6->maxbalance = (float)$this->request->getpost('params')['affreg_maxbalance2'];
                $row[] = $param6;
            endif;

            $name['refRegCommission'] = $row;
        else:
            $name['refRegCommission'] = [];
        endif;

        $name2['freeCoin'] = json_decode($this->request->getpost('params')['dailyReward']);

        $payload = array_merge($data,$name,$name2);
        $res = $this->user_model->updateAdminLink($payload);
        echo json_encode($res);
    }

    public function modifyDailyReward()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $info = $this->getInfor();

        $data = [
            'userid' => $_SESSION['token'],
            'paymentdeductupline' => filter_var($info['data']['paymentDeductUpline'], FILTER_VALIDATE_BOOLEAN),
            'checkturnover' => filter_var($info['data']['checkTurnover'], FILTER_VALIDATE_BOOLEAN),
            'maxgameaccount' => (int)$info['data']['maxGameAccount'],
            'maxdailywithdrawalcount' => (int)$info['data']['maxDailyWithdrawalCount'],
            'afterdailywithdrawalcountchargespercentage' => (float)$info['data']['afterDailyWithdrawalCountChargesPercentage'],
            'afterdailywithdrawalcountmincharges' => (float)$info['data']['afterDailyWithdrawalCountMinCharges'],
            'freecreditamount' => (float)$_ENV['fcAmount'],
        ];

        $dailyFree = filter_var($this->request->getpost('params')['dailyfree'], FILTER_VALIDATE_BOOLEAN);
        if( $dailyFree ):
            $param = new \stdClass();
            $param->amount = (float)$this->request->getpost('params')['dailyfreeamount'];
            $param->gameproviderid = base64_decode($this->request->getpost('params')['gpid']);
            $param->gametype = (int)$this->request->getpost('params')['gcate'];
            $param->wallettype = (int)$this->request->getpost('params')['reward2wallet'];
            $param->togroupname = $this->request->getpost('params')['dfchipgroup'];
            $param->deductownagent = filter_var($this->request->getpost('params')['deductdffrmupline'], FILTER_VALIDATE_BOOLEAN);
            $param->maxbalance = (float)$this->request->getpost('params')['maxbalance'];
            $param->includetoday = filter_var($this->request->getpost('params')['includetoday'], FILTER_VALIDATE_BOOLEAN);
            $name['freeCoin'][] = $param;
        else:
            $name['freeCoin'] = [];
        endif;

        $name2['refRegCommission'] = json_decode($this->request->getpost('params')['affRefReward']);

        $payload = array_merge($data,$name,$name2);
        $res = $this->user_model->updateAdminLink($payload);
        echo json_encode($res);
    }

    public function modifyRefDepositComm()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $info = $this->getInfor();

        $data = [
            'userid' => $_SESSION['token'],
            'paymentdeductupline' => filter_var($info['data']['paymentDeductUpline'], FILTER_VALIDATE_BOOLEAN),
            'checkturnover' => filter_var($info['data']['checkTurnover'], FILTER_VALIDATE_BOOLEAN),
            'maxgameaccount' => (int)$info['data']['maxGameAccount'],
            'maxdailywithdrawalcount' => (int)$info['data']['maxDailyWithdrawalCount'],
            'afterdailywithdrawalcountchargespercentage' => (float)$info['data']['afterDailyWithdrawalCountChargesPercentage'],
            'afterdailywithdrawalcountmincharges' => (float)$info['data']['afterDailyWithdrawalCountMinCharges'],
            'freecreditamount' => (float)$_ENV['fcAmount'],
        ];

        $param = new \stdClass();
        $param->count = (int)$this->request->getpost('params')['refcomm_count'];
        $param->mindeposit = (float)$this->request->getpost('params')['refcomm_mindeposit'];
        $param->tobalance = (float)$this->request->getpost('params')['refcomm_cash'];
        $param->towallet = (float)$this->request->getpost('params')['refcomm_chip'];
        $param->togroupname = $this->request->getpost('params')['refcomm_chipgroup'];
        $param->onlyone = filter_var($this->request->getpost('params')['refcomm_once'], FILTER_VALIDATE_BOOLEAN);
        $name['referralCommission'] = $param;

        $name2['refRegCommission'] = json_decode($this->request->getpost('params')['affRefReward']);
        $name3['freeCoin'] = json_decode($this->request->getpost('params')['dailyReward']);

        $payload = array_merge($data,$name,$name2,$name3);
        $res = $this->user_model->updateAdminLink($payload);
        echo json_encode($res);
    }

    public function modifyDepositComm()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $info = $this->getInfor();

        $data = [
            'userid' => $_SESSION['token'],
            'paymentdeductupline' => filter_var($info['data']['paymentDeductUpline'], FILTER_VALIDATE_BOOLEAN),
            'checkturnover' => filter_var($info['data']['checkTurnover'], FILTER_VALIDATE_BOOLEAN),
            'maxgameaccount' => (int)$info['data']['maxGameAccount'],
            'maxdailywithdrawalcount' => (int)$info['data']['maxDailyWithdrawalCount'],
            'afterdailywithdrawalcountchargespercentage' => (float)$info['data']['afterDailyWithdrawalCountChargesPercentage'],
            'afterdailywithdrawalcountmincharges' => (float)$info['data']['afterDailyWithdrawalCountMinCharges'],
            'freecreditamount' => (float)$_ENV['fcAmount'],
        ];

        $param = new \stdClass();
        $param->mindeposit = (float)$this->request->getpost('params')['depcomm_mindeposit'];
        $param->percentage = (float)$this->request->getpost('params')['depcomm_rate'];
        $param->towalletpercentage = (float)$this->request->getpost('params')['depcomm_chippercent'];
        $param->togroupname = $this->request->getpost('params')['depcomm_chipgroup'];
        $name['topUpCommission'] = $param;

        $name2['refRegCommission'] = json_decode($this->request->getpost('params')['affRefReward']);
        $name3['freeCoin'] = json_decode($this->request->getpost('params')['dailyReward']);

        $payload = array_merge($data,$name,$name2,$name3);
        $res = $this->user_model->updateAdminLink($payload);
        echo json_encode($res);
    }

    public function modifyGeneral()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $info = $this->getInfor();

        $data = [
            'userid' => $_SESSION['token'],
            'paymentdeductupline' => filter_var($info['data']['paymentDeductUpline'], FILTER_VALIDATE_BOOLEAN),

            'checkturnover' => filter_var($this->request->getpost('params')['checkturn'], FILTER_VALIDATE_BOOLEAN),
            'maxgameaccount' => (int)$this->request->getpost('params')['numgameacct'],
            'maxdailywithdrawalcount' => (int)$this->request->getpost('params')['numdailywidthraw'],
            'afterdailywithdrawalcountchargespercentage' => (float)$this->request->getpost('params')['exceedwithdrawalcharges'],
            'afterdailywithdrawalcountmincharges' => (float)$this->request->getpost('params')['minexceedwithdrawalcharges'],
            'freecreditamount' => (float)$_ENV['fcAmount'],
        ];

        $name2['refRegCommission'] = json_decode($this->request->getpost('params')['affRefReward']);
        $name3['freeCoin'] = json_decode($this->request->getpost('params')['dailyReward']);

        $payload = array_merge($data,$name2,$name3);
        $res = $this->user_model->updateAdminLink($payload);
        echo json_encode($res);
    }

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
            'freecreditamount' => (float)$_ENV['fcAmount'],
        ];

        $param = new \stdClass();
        $param->URL = $this->request->getpost('params')['smsurl'];
        $param->Username = $this->request->getpost('params')['smsuser'];
        $param->Password = $this->request->getpost('params')['smspass'];
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
        if( $shareReward ):
            $param5 = new \stdClass();
            $param5->toself = filter_var($this->request->getpost('params')['affsharetoself'], FILTER_VALIDATE_BOOLEAN);
            $param5->amount = (float)$this->request->getpost('params')['affshareamount'];
            $param5->gameproviderid = base64_decode($this->request->getpost('params')['affsharegpid']);
            $param5->gametype = (int)$this->request->getpost('params')['affsharegcate'];
            $param5->wallettype = (int)$this->request->getpost('params')['affshare2wallet'];
            $param5->togroupname = $this->request->getpost('params')['affsharechipgroup'];
            $param5->deductownagent = filter_var($this->request->getpost('params')['affsharedeductdffrmupline'], FILTER_VALIDATE_BOOLEAN);

            $param6 = new \stdClass();
            $param6->toself = filter_var($this->request->getpost('params')['affsharetoself2'], FILTER_VALIDATE_BOOLEAN);
            $param6->amount = (float)$this->request->getpost('params')['affshareamount2'];
            $param6->gameproviderid = base64_decode($this->request->getpost('params')['affsharegpid2']);
            $param6->gametype = (int)$this->request->getpost('params')['affsharegcate2'];
            $param6->wallettype = (int)$this->request->getpost('params')['affshare2wallet2'];
            $param6->togroupname = $this->request->getpost('params')['affsharechipgroup2'];
            $param6->deductownagent = filter_var($this->request->getpost('params')['affsharedeductdffrmupline2'], FILTER_VALIDATE_BOOLEAN);
            $row = [];
            $row[] = $param5;
            $row[] = $param6;

            $name5['refRegCommission'] = $row;
        else:
            $name5['refRegCommission'] = [];
        endif;

        $payload = array_merge($data,$name,$name2,$name3,$name4,$name5);

        $res = $this->user_model->updateAdminLink($payload);
        echo json_encode($res);
    }

    public function getAdminLink()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token']
        ];
        $res = $this->user_model->selectAdminLink($payload);
        // echo json_encode($res);

        if( $res['code']==1 && $res['data']!=[] ):
            $generalData = [
                'checkTurnover' => filter_var($res['data']['checkTurnover'], FILTER_VALIDATE_BOOLEAN),
                'maxGameAccount' => (int)$res['data']['maxGameAccount'],
                'dailyWithdrawalCount' => (int)$res['data']['maxDailyWithdrawalCount'],
                'exceedNumWithdrawalCharges' => (float)$res['data']['afterDailyWithdrawalCountChargesPercentage'],
                'minChargesExceedWithdrawal' => (float)$res['data']['afterDailyWithdrawalCountMinCharges'],
            ];

            $row = [];
            $row['general'] = $generalData;
            $row['depositComm'] = $res['data']['topUpCommission'];
            $row['referralComm'] = $res['data']['referralCommission'];
            $row['dailyReward'] = $res['data']['freeCoin'];
            $row['affRegReward'] = $res['data']['refRegCommission'];

            echo json_encode([
                'code' => $res['code'],
                'message' => $res['message'],
                'data' => $row
            ]);
        else:
            echo json_encode($res);
        endif;
    }

    public function getAgentWithdrawTime()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token']
        ];
        $res = $this->user_model->selectAdminLink($payload);
        // echo json_encode($res);

        if( $res['code']==1 && $res['data']!=[] ):

            $startTime = date('H:i', strtotime($res['data']['paymentBlock']['startTime']));
            $endTime = date('H:i', strtotime($res['data']['paymentBlock']['endTime']));

            $row = [];
            $row['block'] = $res['data']['paymentBlock']['block'];
            $row['startDay'] = $res['data']['paymentBlock']['startDay'];
            $row['startTime'] = $startTime;
            $row['endDay'] = $res['data']['paymentBlock']['endDay'];
            $row['endTime'] = $endTime;
            //$row['dailyReward'] = $res['data']['freeCoin'];
            //$row['affRegReward'] = $res['data']['refRegCommission'];

            echo json_encode([
                'code' => $res['code'],
                'message' => $res['message'],
                'data' => $row
            ]);
        else:
            echo json_encode($res);
        endif;
    }
}