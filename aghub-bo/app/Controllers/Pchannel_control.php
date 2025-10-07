<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Pchannel_control extends BaseController
{
    public function editPaymentChannel()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $parent = isset($this->request->getpost('params')['uid']) ? base64_decode($this->request->getpost('params')['uid']) : $_SESSION['token'];

        $data = [
            'userid' => $parent,
            'bankid'=> base64_decode($this->request->getpost('params')['bankid']), 
            'merchantcode' => $this->request->getpost('params')['merchant'], 
            'code' => $this->request->getpost('params')['channel'],
            'isdeposit' => (int)$this->request->getpost('params')['isdeposit'],
            'iswithdrawal' => (int)$this->request->getpost('params')['iswithdrawal'],
            'mindeposit' => (float)$this->request->getpost('params')['mindeposit'],
            'maxdeposit' => (float)$this->request->getpost('params')['maxdeposit'],
            'minwithdrawal' => (float)$this->request->getpost('params')['minwithdrawal'],
            'maxwithdrawal' => (float)$this->request->getpost('params')['maxwithdrawal'],
            'maxdailydeposit' => (float)$this->request->getpost('params')['dailymaxdeposit'],
            'maxdailywithdrawal' => (float)$this->request->getpost('params')['dailymaxwithdrawal'],
            'charges' => (float)$this->request->getpost('params')['charges'],
            'remark' => $this->request->getpost('params')['remark'],
            'accountid' => $this->request->getpost('params')['accountid'],
            'bankcode' => $this->request->getpost('params')['bankcode']
        ];

        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['en'];
        $param->MY = $this->request->getpost('params')['en'];
        $param->CN = $this->request->getpost('params')['en'];
        $param->ZH = $this->request->getpost('params')['en'];
        $param->TH = $this->request->getpost('params')['en'];
        $param->VN = $this->request->getpost('params')['en'];
        $param->BGL = $this->request->getpost('params')['en'];
        $name['name'] = $param;
        $payload = array_merge($data, $name);

        $res = $this->pchannel_model->updatePaymentChannel($payload);
        echo json_encode($res);
    }

    public function addPaymentChannel()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $parent = isset($this->request->getpost('params')['uid']) ? base64_decode($this->request->getpost('params')['uid']) : $_SESSION['token'];

        $data = [
            'userid' => $parent,
            'bankid'=> base64_decode($this->request->getpost('params')['bankid']), 
            'merchantcode' => $this->request->getpost('params')['merchant'], 
            'code' => $this->request->getpost('params')['channel'],
            'isdeposit' => (int)$this->request->getpost('params')['isdeposit'],
            'iswithdrawal' => (int)$this->request->getpost('params')['iswithdrawal'],
            'mindeposit' => (float)$this->request->getpost('params')['mindeposit'],
            'maxdeposit' => (float)$this->request->getpost('params')['maxdeposit'],
            'minwithdrawal' => (float)$this->request->getpost('params')['minwithdrawal'],
            'maxwithdrawal' => (float)$this->request->getpost('params')['maxwithdrawal'],
            'maxdailydeposit' => (float)$this->request->getpost('params')['dailymaxdeposit'],
            'maxdailywithdrawal' => (float)$this->request->getpost('params')['dailymaxwithdrawal'],
            'charges' => (float)$this->request->getpost('params')['charges'],
            'remark' => $this->request->getpost('params')['remark'],
            'accountid' => $this->request->getpost('params')['accountid'],
            'bankcode' => $this->request->getpost('params')['bankcode']
        ];

        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['en'];
        $param->MY = $this->request->getpost('params')['en'];
        $param->CN = $this->request->getpost('params')['en'];
        $param->ZH = $this->request->getpost('params')['en'];
        $param->TH = $this->request->getpost('params')['en'];
        $param->VN = $this->request->getpost('params')['en'];
        $param->BGL = $this->request->getpost('params')['en'];
        $name['name'] = $param;
        $payload = array_merge($data, $name);

        $res = $this->pchannel_model->insertPaymentChannel($payload);
        echo json_encode($res);
    }

    public function paymentChannel()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $parent = isset($this->request->getpost('params')['uid']) ? base64_decode($this->request->getpost('params')['uid']) : $_SESSION['token'];

        $payload = [
            'userid' => $parent,
            'bankid' => base64_decode($this->request->getpost('params')['provider']),
            'merchantcode' => $this->request->getpost('params')['merchant'],
            'code' => $this->request->getpost('params')['channel']
        ];
        $res = $this->pchannel_model->selectPaymentChannel($payload);
        echo json_encode($res);
    }

    public function userAllPaymentChannelList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $parent = $this->request->getpost('parent') ? base64_decode($this->request->getpost('parent')) : $_SESSION['token'];

        $payload = [
            'userid' => $parent,
            'bankid' => base64_decode($this->request->getpost('provider')),
            'merchantcode' => $this->request->getpost('merchant')
        ];
        $res = $this->pchannel_model->selectAllPaymentChannel($payload);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $data = [];
            foreach( $res['data'] as $pc ):
                switch($pc['isDeposit']):
                    case 1: $isdeposit = lang('Label.yes'); break;
                    default: $isdeposit = lang('Label.no');
                endswitch;

                switch($pc['isWithdrawal']):
                    case 1: $iswithdrawal = lang('Label.yes'); break;
                    default: $iswithdrawal = lang('Label.no');
                endswitch;

                $action = '<div class="btn-groups">';
                $action .= '<button type="button" class="btn btn-primary btn-sm" onclick="modifyPC(\''.$pc['code'].'\')">'.lang('Nav.edit').'</button>';
                $action .= '</div>';

                $row = [];
                $row[] = $pc['code'];
                $row[] = !empty($pc['accountId']) ? $pc['accountId'] : '---';
                $row[] = !empty($pc['bankCode']) ? $pc['bankCode'] : '---';
                $row[] = $isdeposit;
                $row[] = $iswithdrawal;
                $row[] = $pc['channelName']['EN'];
                $row[] = $pc['charges'];
                $row[] = bcdiv($pc['minDeposit'],1,2).'-'.bcdiv($pc['maxDeposit'],1,2);
                $row[] = bcdiv($pc['minWithdrawal'],1,2).'-'.bcdiv($pc['maxWithdrawal'],1,2);
                $row[] = $pc['maxDailyDeposit'];
                $row[] = $pc['maxDailyWithdrawal'];
                $row[] = $pc['remark'];
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(["data"=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function paymentChannelRawList()
    {
        if( !session()->get('logged_in') ): return false; endif;
        $lng = strtoupper($_SESSION['lang']);

        $parent = !empty($this->request->getpost('params')['parent']) ? base64_decode($this->request->getpost('params')['parent']) : $_SESSION['token'];

        $payload = [
            'userid' => $parent,
            'bankid' => base64_decode($this->request->getpost('params')['provider']),
            'merchantcode' => $this->request->getpost('params')['merchant']
        ];
        $res = $this->pchannel_model->selectAllPaymentChannel($payload);
        // echo json_encode($res);

        if( $res['code']==1 && $res['data']!=[] ):
            $data = [];
            foreach( $res['data'] as $pc ):
                if( $pc['isDeposit']==1 ):
                    $row = [];
                    $row['code'] = $pc['code'];
                    $row['name'] = $pc['channelName'][$lng].'-'.$pc['charges'].'%';
                    $row['minDeposit'] = $pc['minDeposit'];
                    $row['maxDeposit'] = $pc['maxDeposit'];
                    $row['minWithdrawal'] = $pc['minWithdrawal'];
                    $row['maxWithdrawal'] = $pc['maxWithdrawal'];
                    $row['charges'] = $pc['charges'];
                    $data[] = $row;
                endif;
            endforeach;
            echo json_encode([
                'data' => $data, 
                'code' => $res['code'], 
            ]);
        else:
            echo json_encode($res);
        endif;
    }
}