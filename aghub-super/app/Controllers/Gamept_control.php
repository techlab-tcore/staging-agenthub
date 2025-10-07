<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Gamept_control extends BaseController
{
    public function modifyMasterGamePt()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('params')['currencycode'];
        $auth = ['userid'=> base64_decode($this->request->getpost('params')['parent'])];
        $raw = $this->gameprovider_model->selectAllGp(['userid' => base64_decode($this->request->getpost('params')['parent'])], $currencyCode);
        $data = [];
        $param = new \stdClass();
        foreach( $raw['data'] as $gp ):
            $data[$gp['code']] = (float)$this->request->getpost('params')['gamept'];
        endforeach;
        $param = $data;
        $pt['value'] = $param;
        $payload = array_merge($auth, $pt);
        
        $res = $this->gamept_model->updateGamePt($payload, $currencyCode);
        echo json_encode($res);
    }

    public function modifyGamePt()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $data = ['userid'=> base64_decode($this->request->getpost('params')['uid'])];
        $code = $this->request->getpost('params')['code'];
        $param = new \stdClass();
        $param->$code = (float)$this->request->getpost('params')['gamept'];
        $pt['value'] = $param;
        $payload = array_merge($data, $pt);

        $currencyCode = $this->request->getpost('params')['currencycode'];
        
        $res = $this->gamept_model->updateGamePt($payload, $currencyCode);
        echo json_encode($res);
    }

    public function minMaxGamePt()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('params')['currencycode'];

        $res = $this->gamept_model->selectMinMaxGamePt([
            'userid' => base64_decode($this->request->getpost('params')['uid']),
            'gameprovidercode' => $this->request->getpost('params')['code']
        ], $currencyCode);
        echo json_encode($res);
    }

    public function gamePtList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('currencycode');

        $raw = $this->gamept_model->selectAllGamePt(['userid'=>base64_decode($this->request->getpost('parent'))], $currencyCode);
        // echo json_encode($raw);

        if( $raw['code'] == 1 && $raw['data'] != [] ):
            $data = [];
            foreach( $raw['data']['data'] as $gpt ):
                if( $gpt['value']!=[] ):
                    $arr = end($gpt['value']);
                    $precent = $arr['percentage'];

                    $date = Time::parse(date('Y-m-d H:i:s', strtotime($arr['createDate'])));
                    $created = $date->toDateTimeString();
                else:
                    $precent = 0;
                    $created = '';
                endif;

                $action = '<div class="btn-group">';
                $action .= '<button type="button" class="btn btn-light btn-sm" onclick="showMinMax(\''.$gpt['gameProviderCode'].'\',\''.$gpt['name'].'\',\''.$precent.'\',\''.$currencyCode.'\');">Edit</button>';
                $action .= '</div>';

                $row = [];
                $row[] = '['.$gpt['gameProviderCode'].'] '.$gpt['name'];
                $row[] = $precent;
                $row[] = $raw['data']['loginId'];
                $row[] = $created;
                $row[] = $action;
                $data[] = $row;
            endforeach;

            $output = array("data"=>$data);
            echo json_encode($output, JSON_PRETTY_PRINT);
        else:
            echo json_encode(['no data']);
        endif;
    }
}