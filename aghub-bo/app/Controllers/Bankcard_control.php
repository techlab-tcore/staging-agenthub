<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Bankcard_control extends BaseController
{
    public function setDefaultBankCard()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $parent = isset($this->request->getpost('params')['uid']) ? base64_decode($this->request->getpost('params')['uid']) : $_SESSION['token'];

        $payload = [
            'userid' => $parent,
            'bankid' => base64_decode($this->request->getpost('params')['provider']),
            'cardno' => $this->request->getpost('params')['cardno'],
            'accountno' => $this->request->getpost('params')['accno'],
            'isdefault' => (int)$this->request->getpost('params')['isdefault'],
        ];
        $res = $this->bankcard_model->updateBankCard($payload);
        echo json_encode($res);
    }

    public function editStatusBankCard()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $parent = isset($this->request->getpost('params')['uid']) ? base64_decode($this->request->getpost('params')['uid']) : $_SESSION['token'];

        $payload = [
            'userid' => $parent,
            'bankid' => base64_decode($this->request->getpost('params')['provider']),
            'cardno' => $this->request->getpost('params')['cardno'],
            'accountno' => $this->request->getpost('params')['accno'],
            'status' => (int)$this->request->getpost('params')['status'],
        ];
        $res = $this->bankcard_model->updateBankCard($payload);
        echo json_encode($res);
    }

    public function editBankCard()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $parent = isset($this->request->getpost('params')['uid']) ? base64_decode($this->request->getpost('params')['uid']) : $_SESSION['token'];

        $payload = [
            'userid' => $parent,
            'bankid' => base64_decode($this->request->getpost('params')['provider']),
            'cardno' => $this->request->getpost('params')['cardno'],
            'accountno' => $this->request->getpost('params')['accno'],
            'accountholder' => $this->request->getpost('params')['holder'],
            'charges' => (float)$this->request->getpost('params')['charges'],
            'mindeposit' => (float)$this->request->getpost('params')['mindeposit'],
            'maxdeposit' => (float)$this->request->getpost('params')['maxdeposit'], 
            'minwithdrawal' => (float)$this->request->getpost('params')['minwithdrawal'],
            'maxwithdrawal' => (float)$this->request->getpost('params')['maxwithdrawal'],
            'maxdailydeposit' => (float)$this->request->getpost('params')['dailymaxdeposit'],
            'maxdailywithdrawal' => (float)$this->request->getpost('params')['dailymaxwithdrawal'],
            'remark' => $this->request->getpost('params')['remark'],
            'display' => (int)$this->request->getpost('params')['frontend'],
        ];
        $res = $this->bankcard_model->updateBankCard($payload);
        echo json_encode($res);
    }

    public function addBankCard()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $parent = isset($this->request->getpost('params')['uid']) ? base64_decode($this->request->getpost('params')['uid']) : $_SESSION['token'];

        $payload = [
            'userid' => $parent,
            'bankid' => base64_decode($this->request->getpost('params')['provider']),
            'cardno' => $this->request->getpost('params')['accno'],
            'accountno' => $this->request->getpost('params')['accno'],
            'accountholder' => $this->request->getpost('params')['holder'],
            'branch' => $this->request->getpost('params')['branch'],
            'charges' => (float)$this->request->getpost('params')['charges'],
            'mindeposit' => (float)$this->request->getpost('params')['mindeposit'],
            'maxdeposit' => (float)$this->request->getpost('params')['maxdeposit'], 
            'minwithdrawal' => (float)$this->request->getpost('params')['minwithdrawal'],
            'maxwithdrawal' => (float)$this->request->getpost('params')['maxwithdrawal'],
            'maxdailydeposit' => (float)$this->request->getpost('params')['dailymaxdeposit'],
            'maxdailywithdrawal' => (float)$this->request->getpost('params')['dailymaxwithdrawal'],
            'remark' => $this->request->getpost('params')['remark'],
            'display' => (int)$this->request->getpost('params')['frontend']
        ];
        $res = $this->bankcard_model->insertBankCard($payload);
        echo json_encode($res);
    }

    public function bankCard()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $parent = isset($this->request->getpost('params')['uid']) ? base64_decode($this->request->getpost('params')['uid']) : $_SESSION['token'];

        $payload = [
            'userid' => $parent,
            'bankid' => base64_decode($this->request->getpost('params')['provider']),
            'cardno' => $this->request->getpost('params')['cardno'],
            'accountno' => $this->request->getpost('params')['accno']
        ];
        $res = $this->bankcard_model->selectBankCard($payload);
        echo json_encode($res);
    }

    public function companyBankCards()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token']
        ];
        $res = $this->bankcard_model->selectAllBankCard($payload);
        echo json_encode($res);
    }

    public function userAllbankCardList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $parent = $this->request->getpost('parent') ? base64_decode($this->request->getpost('parent')) : $_SESSION['token'];

        $payload = [
            'userid' => $parent
        ];
        $res = $this->bankcard_model->selectAllBankCard($payload);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $data = [];
            foreach( $res['data'] as $bc ):
                switch($bc['status']):
                    case 1: $status = lang('Label.active'); break;
                    case 2: $status = lang('Label.inactive'); break;
                endswitch;

                switch($bc['display']):
                    case 1: $frontend = lang('Label.yes'); break;
                    case 2: $frontend = lang('Label.no'); break;
                    default: $frontend = ''; break;
                endswitch;

                $action = '<div class="btn-groups">';
                $action .= '<button type="button" class="btn btn-primary btn-sm" onclick="modifyBC(\''.base64_encode($bc['bankId']).'\',\''.$bc['cardNo'].'\',\''.$bc['accountNo'].'\');">'.lang('Nav.edit').'</button>';

                if( $this->request->getpost('parent') ):
                    if( $bc['isDefault']==1 ):
                        $action .= '<button type="button" class="btn btn-success bg-gradient btn-sm" onclick="setDefaultBC(\''.base64_encode($bc['bankId']).'\',\''.$bc['cardNo'].'\',\''.$bc['accountNo'].'\',2);">'.lang('Input.setdefault').'</button>';
                    else:
                        $action .= '<button type="button" class="btn btn-danger bg-gradient btn-sm" onclick="setDefaultBC(\''.base64_encode($bc['bankId']).'\',\''.$bc['cardNo'].'\',\''.$bc['accountNo'].'\',1);">'.lang('Input.setdefault').'</button>';
                    endif;
                endif;

                if( $bc['status']==1 ):
                    $action .= '<button type="button" class="btn btn-success bg-gradient btn-sm" onclick="statusBC(\''.base64_encode($bc['bankId']).'\',\''.$bc['cardNo'].'\',\''.$bc['accountNo'].'\',2);">'.lang('Label.active').'</button>';
                else:
                    $action .= '<button type="button" class="btn btn-danger bg-gradient btn-sm" onclick="statusBC(\''.base64_encode($bc['bankId']).'\',\''.$bc['cardNo'].'\',\''.$bc['accountNo'].'\',1);">'.lang('Label.inactive').'</button>';
                endif;
                $action .= '</div>';

                $row = [];
                $row[] = $status;
                $row[] = $frontend;
                $row[] = $bc['name']['EN'];
                $row[] = $bc['cardNo'];
                $row[] = $bc['accountNo'];
                $row[] = $bc['accountHolder'];
                $row[] = $bc['branch'];
                $row[] = bcdiv($bc['charges'], 1, 2);
                $row[] = bcdiv($bc['minDeposit'], 1, 2).'-'.bcdiv($bc['maxDeposit'], 1, 2);
                $row[] = bcdiv($bc['minWithdrawal'], 1, 2).'-'.bcdiv($bc['maxWithdrawal'], 1, 2);
                $row[] = bcdiv($bc['maxDailyDeposit'], 1, 2);
                $row[] = bcdiv($bc['maxDailyWithdrawal'], 1, 2);
                $row[] = $bc['remark'];
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(["data"=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }
}