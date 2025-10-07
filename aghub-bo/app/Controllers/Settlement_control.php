<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use CodeIgniter\API\ResponseTrait;

class Settlement_control extends BaseController
{
    use ResponseTrait;

    /*
    Protected
    */

    protected $superLock = 'tycoon99';

    /*
    Public
    */

    public function winloseStatus()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $from = date('c', strtotime(date('Y-m-d',strtotime("-6 days"))));
		$to = date('c', strtotime(date('Y-m-d',strtotime("+2 days"))));

		$payload = [
            'userid' => $_SESSION['token'],
            'fromdate' => $from,
            'todate' => $to,
            'type' => 5
        ];
        $res = $this->settlement_model->selectAllSettlement($payload);

        $be4yesterday = date('Y-m-d',strtotime("-2 days"));
        $yesterday = date('Y-m-d',strtotime("-1 days"));
        $today = date('Y-m-d');
        $tomorrow = date('Y-m-d',strtotime("+1 days"));

		$wStatus = [];
		foreach( $res['data'] as $s ):
			$date = Time::parse(date('Y-m-d H:i:s', strtotime($s['date'])));
            $settledate = $date->toDateTimeString();
			$sdate = date('Y-m-d', strtotime($settledate));
			$status = $s['done']==true ? 'btn-success' : 'btn-danger';
            
            if( $sdate==$be4yesterday || $sdate==$yesterday || $sdate==$today || $sdate==$tomorrow ):
                $row = [];
                $row['date'] = $sdate;
                $row['status'] = $s['done'];
                $wStatus[] = $row;
            endif;
		endforeach;

        if( !array_search($yesterday,array_column($wStatus, 'date')) ):
            $rowY = [];
            $rowY['date'] = $yesterday;
            $rowY['status'] = false;
            $wStatus[] = $rowY;
        endif;

        $row2 = [];
        $row2['date'] = $today;
        $row2['status'] = false;
        $wStatus[] = $row2;

        echo json_encode(['code'=>$res['code'], 'data'=>$wStatus]);
    }
    
    public function doSettlement()
    {
        if( !session()->get('logged_in') ): return false; endif;
        $secretlock = $this->superLock;

        $settledate = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($this->request->getPost('params')['settledate']))));

        if( $this->request->getPost('params')['superlock']===$secretlock ):
            $payload = [
                'userid' => $_SESSION['token'],
                'type' => (int)$this->request->getpost('params')['type'],
                'date' => $settledate,
                'ip' => $_SESSION['ip']
            ];

            $res = $this->settlement_model->updateSettlement($payload);
            // echo json_encode($res);
            if( $res['code']==1 ):
                $this->respondCreated();
                echo json_encode(['code'=>1, 'message'=>lang('Label.progress')]);
            else:
                echo json_encode($res);
            endif;
        else:
            echo json_encode(['code'=>-1, 'message'=>lang('Validation.incorrectsuperlock')]);
        endif;
    }

    public function settlementList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        // $raw = json_decode(file_get_contents('php://input'),1);

        if( !empty($this->request->getpost('start')) && !empty($this->request->getpost('end')) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($this->request->getpost('start')))));
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($this->request->getpost('end')))));
        else:
            $from = date('c', strtotime(date('Y-m-d 00:00:00')));
            $to = date('c', strtotime(date('Y-m-d 23:59:59')));
        endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'fromdate' => $from,
            'todate' => $to,
            'type' => (int)$this->request->getpost('type'),
            'desc' => true
        ];

        $res = $this->settlement_model->selectAllSettlement($payload);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $data = [];
            foreach( $res['data'] as $s ):
                switch( $s['type'] ):
                    case 0: $type = lang('Label.profitsharing'); break;
                    case 1: $type = lang('Label.agcomm'); break;
                    case 2: $type = lang('Label.rebate'); break;
                    case 3: $type = lang('Label.affiliate'); break;
                    case 4: $type = lang('Label.psgroup'); break;
                    case 5: $type = lang('Label.winlose'); break;
                    case 6: $type = lang('Label.lossrebate'); break;
                    case 7: $type = lang('Label.hg'); break;
                    case 8: $type = lang('Label.affloserebate'); break;
                    case 9: $type = lang('Label.ptps1'); break;
                    case 10: $type = lang('Label.ptps2'); break;
                endswitch;

                // switch( $s['done'] ):
                //     case true: $done = lang('Label.complete'); break;
                //     case false: $done = lang('Label.fail'); break;
                //     default:
                //         $done = lang('Label.progress');
                // endswitch;
                switch( $s['done'] ):
                    case true: $done = lang('Label.complete'); break;
                    case false: $done = lang('Label.progress'); break;
                endswitch;

                $date = Time::parse(date('Y-m-d H:i:s', strtotime($s['createDate'])));
                $created = $date->toDateTimeString();

                $date2 = Time::parse(date('Y-m-d', strtotime($s['date'])));
                $settledate = $date2->toDateTimeString();

                $row = [];
                $row[] = $created;
                $row[] = $type;
                $row[] = date('Y-m-d', strtotime($settledate));
                $row[] = $done;
                $row[] = !empty($s['remark']) ? $s['remark'] : '---';
                $data[] = $row;
            endforeach;
            echo json_encode(['data'=>$data, 'code'=>1]);
        else:
            echo json_encode(['no data']);
        endif;
    }
}