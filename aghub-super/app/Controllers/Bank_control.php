<?php

namespace App\Controllers;

class Bank_control extends BaseController
{
    public function modifyBank()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('params')['currencycode'];
        $data = [
            'userid' => $_SESSION['token'],
            'bankid' => base64_decode($this->request->getpost('params')['bid']),
            'currencycode' => $this->request->getpost('params')['currency'],
            'ismobile' => (int)$this->request->getpost('params')['isMobile'],
            'status' => (int)$this->request->getpost('params')['status'],
        ];

        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['en'];
        $param->MY = $this->request->getpost('params')['my'];
        $param->CN = $this->request->getpost('params')['cn'];
        $param->ZH = $this->request->getpost('params')['zh'];
        $param->TH = $this->request->getpost('params')['th'];
        $param->VN = $this->request->getpost('params')['vn'];
        $param->BGL = $this->request->getpost('params')['bgl'];
        $param->IN = $this->request->getpost('params')['in'];
        $name['name'] = $param;
        $payload = array_merge($data, $name);

        $res = $this->bank_model->updateBank($payload, $currencyCode);
        echo json_encode($res);
    }

    public function addBank()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('params')['currencycode'];
        $data = [
            'userid' => $_SESSION['token'],
            'paymentmethod' => 1,
            'currencycode' => $this->request->getpost('params')['currency'],
            'ismobile' => (int)$this->request->getpost('params')['isMobile'],
        ];

        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['en'];
        $param->MY = $this->request->getpost('params')['my'];
        $param->CN = $this->request->getpost('params')['cn'];
        $param->ZH = $this->request->getpost('params')['zh'];
        $param->TH = $this->request->getpost('params')['th'];
        $param->VN = $this->request->getpost('params')['vn'];
        $param->BGL = $this->request->getpost('params')['bgl'];
        $param->IN = $this->request->getpost('params')['in'];
        $name['name'] = $param;
        $payload = array_merge($data, $name);

        $res = $this->bank_model->insertBank($payload, $currencyCode);
        echo json_encode($res);
    }

    public function bank()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('params')['currencycode'];
        $payload = [
            'userid' => $_SESSION['token'],
            'bankid' => base64_decode($this->request->getpost('params')['bid'])
        ];
        $res = $this->bank_model->SelectBank($payload, $currencyCode);
        echo json_encode($res);
    }

    public function bankList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('currencycode');
        $payload = [
            'userid' => $_SESSION['token'],
            'paymentmethod' => 1
        ];
        $res = $this->bank_model->SelectAllBank($payload, $currencyCode);
        // echo json_encode($res);

        if( $res['code']==1 && $res['data']!=[] ):
            $data = [];
            foreach( $res['data'] as $p ):
                switch($p['status']):
                    case 1: $status = 'Active'; break;
                    case 2: $status = 'Inactive'; break;
                    case 3: $status = 'Freeze'; break;
                    default: $status = '';
                endswitch;

                switch($p['paymentMethod']):
                    case 1: $method = 'Bank Transfer'; break;
                    case 2: $method = 'Payment Gateway'; break;
                    case 3: $method = 'Topup Code'; break;
                    default: $method = '';
                endswitch;

                switch($p['isMobile']):
                    case 1: $isMobile = 'Yes'; break;
                    case 2: $isMobile = 'No'; break;
                    default: $isMobile = '';
                endswitch;

                $action = '<button type="button" class="btn btn-light btn-sm" onclick="getBank(\''.base64_encode($p['bankId']).'\',\''.$currencyCode.'\')">Edit</button>';

                $row = [];
                $row[] = $p['bankId'];
                $row[] = $status;
                $row[] = $p['name']['EN'];
                $row[] = $method;
                $row[] = implode(',',$p['currencyCode']);
                $row[] = $isMobile;
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(["data"=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }
}