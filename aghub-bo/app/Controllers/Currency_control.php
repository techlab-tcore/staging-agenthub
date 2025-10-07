<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Currency_control extends BaseController
{
    public function modifyCurrency()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'code' => $this->request->getpost('params')['code'],
            'depositrate' => (float)$this->request->getpost('params')['deposit'],
            'withdrawalrate' => (float)$this->request->getpost('params')['withdrawal']
        ];
        $res = $this->currency_model->updateCurrency($payload);
        echo json_encode($res);
    }

    public function getCurrency()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'code' => $this->request->getpost('params')['code']
        ];
        $res = $this->currency_model->selectCurrency($payload);
        echo json_encode($res);
    }

    public function currencyList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token']
        ];
        $res = $this->currency_model->selectAllCurrencies($payload);
        // echo json_encode($res);

        if( $res['code']==1 && $res['data']!=[] ):
            $data = [];
            foreach( $res['data'] as $c ):
                $action = '<div class="btn-groups" role="group">';
                $action .= '<button type="button" class="btn btn-primary btn-sm" onclick="modifyCurrency(\''.$c['code'].'\');">'.lang('Nav.edit').'</button>';
                $action .= '</div>';

                $row = [];
                $row[] = $c['code'];
                $row[] = $c['name'];
                $row[] = $c['depositRate'];
                $row[] = $c['withdrawalRate'];
                $row[] = $c['remark'];
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(["data"=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }
}