<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Fake_control extends BaseController
{
    public function addFakeRecord()
    {
        if( !session()->get('logged_in') ): return false; endif;

        if( !empty($this->request->getpost('params')['settledate']) ):
            $settledate = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($this->request->getpost('params')['settledate']))));
        else:
            $settledate = date('c', strtotime(date('Y-m-d 00:00:00')));
        endif;

        $data = [
            'userid' => $_SESSION['token'],
            'date' => $settledate,
            'jackpot' => (float)$this->request->getpost('params')['jackpot']
        ];

        $arr = array_combine($this->request->getpost('gp'), $this->request->getpost('values'));
        $arr = array_combine($this->request->getpost('gp'), $this->request->getpost('values2'));
        $up = [];
        $param = new \stdClass();
        foreach( $arr as $key=>$val ):
            if( substr($key, -2)!='_w' && substr($key, -2)!='_c' ):
                $dd = [];
                $dd['gameprovidercode'] = $key;
                $dd['turnover'] = (float)$val;

                foreach( $arr as $key2=>$val2 ):
                    if( substr($key2, -2)=='_w' ):
                        $gp = rtrim($key2, "_w");
                        if( $gp==$key ):
                            $dd['amount'] = (float)$val2;
                        endif;
                    endif;
                endforeach;

                foreach( $arr as $key3=>$val3 ):
                    if( substr($key3, -2)=='_c' ):
                        $gp = rtrim($key3, "_c");
                        if( $gp==$key ):
                            $dd['givechip'] = (float)$val3;
                        endif;
                    endif;
                endforeach;

                $up[] = $dd;
            endif;
        endforeach;
        $param = $up;
        
        $game['data'] = $param;
        $payload = array_merge($data, $game);

        $res = $this->fake_model->insertFakeRecord($payload);
        echo json_encode($res);
    }

    public function getFakeRecord()
    {
        if( !session()->get('logged_in') ): return false; endif;

        if( !empty($this->request->getpost('settledate')) ):
            $settledate = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($this->request->getpost('settledate')))));
        else:
            $settledate = date('c', strtotime(date('Y-m-d 00:00:00')));
        endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'date' => $settledate,
        ];
        $res = $this->fake_model->selectFakeRecord($payload);
        // echo json_encode($res);

        if( $res['code']==1 && $res['data']!=[] ):
            $data = [];

            $date = Time::parse(date('Y-m-d H:i:s', strtotime($res['data']['date'])));
            $settleDate = $date->toDateTimeString();

            $date2 = Time::parse(date('Y-m-d H:i:s', strtotime($res['data']['createDate'])));
            $createDate = $date2->toDateTimeString();

            $row = [];
            $row[] = date('Y-m-d',strtotime($settleDate));
            $row[] = date('Y-m-d',strtotime($createDate));
            $row[] = $res['data']['createByLoginId'];
            $row[] = $res['data']['jackpot'];

            foreach( $res['data']['data'] as $gp ):
                $row[] = $gp['gameProviderCode'];
                $row[] = $gp['turnover'];
                $row[] = $gp['amount'];
                $row[] = $gp['giveChip'];
            endforeach;
            $data[] = $row;
            echo json_encode(['data' => $data]);
        else:
            echo json_encode(['no data']);
        endif;
    }
}