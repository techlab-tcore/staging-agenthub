<?php

namespace App\Controllers;

class Gamecategory_control extends BaseController
{
    public function modifyGameCategory()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('params')['currencycode'];

        $data = [
            'userid' => base64_decode($this->request->getpost('params')['parent']), 
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
        $param->BUR = $this->request->getpost('params')['bur'];
        $param->IN = $this->request->getpost('params')['in'];
        $trans['value'] = $param;
        $payload = array_merge($data, $trans);
        
        $res = $this->gamecategory_model->updateGameCategory($payload, $currencyCode);
        echo json_encode($res);
    }

    public function getGameCategory()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('params')['currencycode'];

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['parent']),
            'code' => (int)$this->request->getpost('params')['code']
        ];
        $res = $this->gamecategory_model->selectGameCategory($payload, $currencyCode);
        echo json_encode($res);
    }

    public function allGameCategory()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('currencycode');

        $payload = [
            'userid' => base64_decode($this->request->getpost('parent'))
        ];
        $res = $this->gamecategory_model->selectAllGameCategory($payload, $currencyCode);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $lng = strtoupper($_SESSION['lang']);

            $data = [];
            foreach( $res['data'] as $c ):
                $action = '<div class="btn-groups">';
                $action .= '<button type="button" class="btn btn-light btn-sm" onclick="modify(\''.$c['code'].'\',\''.$currencyCode.'\');">Edit</button>';
                $action .= '</div>';

                $row = [];
                $row[] = '['.$c['code'].'] '.$c['name'];
                $row[] = $c['value'][$lng];
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(["data"=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function gameCategoryList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('params')['currencycode'];

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['parent'])
        ];
        $res = $this->gamecategory_model->selectAllGameCategory($payload, $currencyCode);
        echo json_encode($res);
    }

    public function gameCategoryRawList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $lng = strtoupper($_SESSION['lang']);
        $currencyCode = $this->request->getpost('params')['currencycode'];

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['parent'])
        ];
        $res = $this->gamecategory_model->selectAllGameCategory($payload, $currencyCode);
        // echo json_encode($res);

        if( $res['code']==1 && $res['data']!=[] ):
            $data = [];
            foreach( $res['data'] as $c ):
                $row = [];
                $row['code'] = $c['code'];
                $row['name'] = $c['value'][$lng];
                $data[] = $row;
            endforeach;
            echo json_encode([
                'code' => $res['code'],
                'message' => $res['message'],
                'data' => $data
            ]);
        else:
            echo json_encode(['no data']);
        endif;
    }
}