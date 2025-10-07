<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Gamept_control extends BaseController
{
    public function modifyMasterGamePt()
    {
        if( !session()->get('logged_in') ): return false; endif;
        
        $auth = ['userid'=> base64_decode($this->request->getpost('params')['uid'])];
        $raw = $this->gameprovider_model->selectAllGp(['userid' => $_SESSION['token']]);
        $data = [];
        $param = new \stdClass();
        foreach( $raw['data'] as $gp ):
            if( $gp['code']!='GD' && $gp['code']!='GDS' && $gp['code']!='GD8' && $gp['code']!='GD2' && $gp['code']!='MN8' ):
                $data[$gp['code']] = (float)$this->request->getpost('params')['gamept'];
            endif;
        endforeach;
        $param = $data;
        $pt['value'] = $param;
        $payload = array_merge($auth, $pt);
        
        $res = $this->gamept_model->updateGamePt($payload);
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
        
        $res = $this->gamept_model->updateGamePt($payload);
        echo json_encode($res);
    }

    public function minMaxGamePt()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $res = $this->gamept_model->selectMinMaxGamePt([
            'userid' => base64_decode($this->request->getpost('params')['uid']),
            'gameprovidercode' => $this->request->getpost('params')['code'],
            'self' => true
        ]);
        if( $this->request->getpost('params')['code']=='GD' || $this->request->getpost('params')['code']=='GDS' || $this->request->getpost('params')['code']=='GD8' || $this->request->getpost('params')['code']=='MN8' ):
            $res['maxPt'] = 0;
        endif;
        echo json_encode($res);
    }

    public function gamePtList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $raw = $this->gamept_model->selectAllGamePt(['userid'=>base64_decode($this->request->getpost('parent'))]);
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
                $action .= '<button type="button" class="btn btn-primary btn-sm" onclick="showMinMax(\''.$gpt['gameProviderCode'].'\',\''.$gpt['name'].'\',\''.$precent.'\');">'.lang('Nav.edit').'</button>';
                $action .= '</div>';

                $row = [];
                $row[] = '<small class="badge bg-primary me-1">'.$gpt['gameProviderCode'].'</small>'.$gpt['name'];
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