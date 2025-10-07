<?php

namespace App\Controllers;

class Currency_control extends BaseController
{
    public function modifyCurrency()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('params')['currencycode'];
        $payload = [
            'userid' => $_SESSION['token'],
            'code' => $this->request->getpost('params')['code'],
            'name' => $this->request->getpost('params')['currency'],
            'remark' => $this->request->getpost('params')['remark'],
        ];
        $res = $this->currency_model->updateCurrency($payload, $currencyCode);
        echo json_encode($res);
    }

    public function addCurrency()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('params')['currencycode'];
        $payload = [
            'userid' => $_SESSION['token'],
            'code' => $this->request->getpost('params')['code'],
            'name' => $this->request->getpost('params')['currency'],
            'remark' => $this->request->getpost('params')['remark'],
        ];
        $res = $this->currency_model->insertCurrency($payload, $currencyCode);
        echo json_encode($res);
    }

    public function currencySelect()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('params')['currencycode'];
        $payload = [
            'userid' => $_SESSION['token']
        ];
        $res = $this->currency_model->selectAllCurrencies($payload, $currencyCode);
        echo json_encode($res);
    }

    public function currencyList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('currencycode');
        $payload = [
            'userid' => $_SESSION['token']
        ];
        $res = $this->currency_model->selectAllCurrencies($payload, $currencyCode);
        // echo json_encode($res);
        if( $res['code']==1 && $res['data']!=[] ):
            $data = [];
            foreach( $res['data'] as $s ):
                $action = '<button type="button" class="btn btn-light btn-sm" onclick="editCurrency(\''.$s['code'].'\',\''.$s['name'].'\',\''.$currencyCode.'\')">Edit</button>';

                $row = [];
                $row[] = $s['code'];
                $row[] = $s['name'];
                $row[] = !empty($s['remark']) ? $s['remark'] : '---';
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(["data"=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }
}