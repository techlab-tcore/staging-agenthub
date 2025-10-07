<?php

namespace App\Controllers;

class Paytype_control extends BaseController
{
    public function modifyPayType()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('params')['currencycode'];
        $data = [
            'userid' => $_SESSION['token'],
            'code' => (int)$this->request->getpost('params')['code']
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
        $name['value'] = $param;
        $payload = array_merge($data, $name);

        $res = $this->paytype_model->updatePayType($payload, $currencyCode);
        echo json_encode($res);
    }

    public function getPayType()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('params')['currencycode'];
        $payload = [
            'userid' => $_SESSION['token'],
            'code' => (int)$this->request->getpost('params')['code']
        ];
        $res = $this->paytype_model->selectPayType($payload, $currencyCode);
        echo json_encode($res);
    }

    public function payTypeSelect()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token']
        ];
        $res = $this->paytype_model->selectAllPayTypes($payload);
        echo json_encode($res);
    }

    public function payTypeList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('currencycode');
        $payload = [
            'userid' => $_SESSION['token']
        ];
        $res = $this->paytype_model->selectAllPayTypes($payload, $currencyCode);
        // echo json_encode($res);

        if( $res['code']==1 && $res['data']!=[] ):
            $data = [];
            foreach( $res['data'] as $s ):
                $action = '<button type="button" class="btn btn-light btn-sm" onclick="editPaytype(\''.$s['code'].'\',\''.$currencyCode.'\')">Edit</button>';

                $row = [];
                $row[] = $s['code'];
                $row[] = $s['name'];
                $row[] = $s['value']['EN'];
                $row[] = $s['value']['MY'];
                $row[] = $s['value']['CN'];
                $row[] = $s['value']['ZH'];
                $row[] = $s['value']['TH'];
                $row[] = $s['value']['VN'];
                $row[] = $s['value']['BGL'];
                $row[] = $s['value']['IN'];
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(["data"=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }
}