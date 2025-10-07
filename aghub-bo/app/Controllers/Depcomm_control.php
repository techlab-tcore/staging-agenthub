<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Depcomm_control extends BaseController
{
    /*
    History
    */

    public function depositCommHistoryList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $raw = json_decode(file_get_contents('php://input'),1);

        if( !empty($raw['start']) && !empty($raw['end']) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($raw['start']))));
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($raw['end']))));
        else:
            $from = date('c', strtotime(date('Y-m-d 00:00:00')));
            $to = date('c', strtotime(date('Y-m-d 23:59:59')));
        endif;

        $payload = $this->depcomm_model->selectAllDepositCommHistory([
            'userid' => base64_decode($raw['parent']), 
            'fromdate' => $from,
            'todate' => $to,
            'desc' => true,
            'pageindex' => $raw['pageindex'],
            'rowperpage' => $raw['rowperpage'],
        ]);
        // echo json_encode($payload);

        if( $payload['code'] == 1 && $payload['data'] != [] ):
            $data = [];
            foreach( $payload['data'] as $u ):
                switch($u['status']):
                    case 1: $status = lang('Label.approve'); break;
                    case 2: $status = lang('Label.reject'); break;
                    case 3: $status = lang('Label.pending'); break;
                    case 4: $status = lang('Label.check'); break;
                    default: $status = '';
                endswitch;

                $date = Time::parse(date('Y-m-d H:i:s', strtotime($u['createDate'])));
                $created = $date->toDateTimeString();

                $row = [];
                $row[] = date('Y-m-d H:i:s', strtotime($created));
                $row[] = $status;
                $row[] = $u['loginId'];
                $row[] = $u['name'];
                $row[] = !empty($u['toGroupName']) ? $u['toGroupName'] : '---';
                $row[] = $u['commAmount'];
                $row[] = $u['toBalance'];
                $row[] = $u['toWallet'];
                $data[] = $row;
            endforeach;
            echo json_encode(['data'=>$data, 'code'=>1, 'pageIndex'=>$payload['pageIndex'], 'rowPerPage'=>$payload['rowPerPage'], 'totalPage'=>$payload['totalPage'], 'totalRecord'=>$payload['totalRecord']]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    /*
    PT
    */

    public function modifyDepositCommPt()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid']),
            'percentage' => (float)$this->request->getpost('params')['depositcommpt']
        ];
        $res = $this->depcomm_model->updateDepositCommPt($payload);
        echo json_encode($res);
    }

    public function minMaxDepositCommPt()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $res = $this->depcomm_model->selectMinMaxDepositCommPt([
            'userid' => base64_decode($this->request->getpost('params')['uid'])
        ]);
        echo json_encode($res);
    }

    public function getDepositCommPt()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $res = $this->depcomm_model->selectDepositCommPt([
            'userid' => base64_decode($this->request->getpost('params')['uid'])
        ]);
        if( $res['code']==1 && $res['data']!=[] ):
            $arr = end($res['data']);
            $depositcommPt = $arr['percentage'];
        else:
            $depositcommPt = 0;
        endif;
        echo json_encode(['code'=>$res['code'], 'depositcommPt'=>$depositcommPt]);
    }

    public function depositCommPtReport()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $raw = json_decode(file_get_contents('php://input'),1);

        if( !empty($this->request->getPost('start')) && !empty($this->request->getPost('end')) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($this->request->getPost('start')))));
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($this->request->getPost('end')))));
        else:
            $from = date('c', strtotime(date('Y-m-d 00:00:00')));
            $to = date('c', strtotime(date('Y-m-d 23:59:59')));
        endif;

        $res = $this->depcomm_model->selectAllDepositCommPtList([
            'userid' => base64_decode($this->request->getPost('parent')),
            'fromdate' => $from,
            'todate' => $to,
            'desc' => true
        ]);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $data = [];
            foreach( $res['data'] as $u ):
                $totalComm = floor($u['playerAmount'] * 10000)/10000;
                $downlineComm = floor($u['downlineAmount'] * 10000)/10000;
                $selfComm = floor($u['selfAmount'] * 10000)/10000;
                $uplineComm = floor($u['uplineAmount'] * 10000)/10000;

                switch( $u['role'] ):
                    case 3:
                        $role = '<a class="text-decoration-none" href="javascript:void(0);" onclick="reload(\''.base64_encode($u['userId']).'+'.$u['loginId'].'\');">'.lang('Label.agent').'</a>';
                    break;
                    case 4: $role = lang('Label.member'); break;
                endswitch;

                $row = [];
                $row[] = $role;
                $row[] = $u['loginId'];
                $row[] = $u['name'];
                $row[] = $totalComm;
                $row[] = $downlineComm;
                $row[] = $selfComm;
                $row[] = $uplineComm;
                $data[] = $row;
            endforeach;
            echo json_encode(['data'=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }
}