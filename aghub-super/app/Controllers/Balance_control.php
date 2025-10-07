<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Balance_control extends BaseController
{
    public function userReplenishment()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $type = $this->request->getpost('params')['amount']<0 ? 2 : 1;
        $currencyCode = $this->request->getpost('params')['currencycode'];

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid']),
            'method' => 1,
            'wallettype' => 1,
            'amount' => (float)$this->request->getpost('params')['amount'],
            'remark' => $this->request->getpost('params')['remark'],
            'ip' => $_SESSION['ip'],
            'followdate' => false,
            'deductownagent' => false,
            'type' => 6
        ];
        $res = $this->balance_model->updateUserTransfer($payload, $currencyCode);
        echo json_encode($res);
    }

    /*
    History
    */

    public function transactionHistoryList()
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

        $currencyCode = $raw['currencycode'];

        $payload = $this->balance_model->selectAllTransaction([
            'userid' => base64_decode($raw['parent']), 
            'type' => (int)$raw['type'], 
            'status' => (int)$raw['status'], 
            'fromdate' => $from,
            'todate'=>$to,
            'self' => true,
            'desc' => true,
            'pageindex' => $raw['pageindex'],
            'rowperpage' => $raw['rowperpage'],
        ], $currencyCode);
        // echo json_encode($payload);

        if( $payload['code'] == 1 && $payload['data'] != [] ):
            $data = [];
            foreach( $payload['data'] as $ph ):
                switch($ph['status']):
                    case 1: $status = 'Approved'; break;
                    case 2: $status = 'Rejected'; break;
                    case 3: $status = 'Pending'; break;
                    case 4: $status = 'Checked'; break;
                    default: $status = '';
                endswitch;

                switch($ph['type']):
                    case 1: $type = 'Deposit'; break;
                    case 2: $type = 'Withdrawal'; break;
                    case 3: $type = 'Promotion'; break;
                    case 4: $type = 'Rebate'; break;
                    case 5: $type = 'Affiliate'; break;
                    case 6: $type = 'Credit Transfer'; break;
                    case 7: $type = 'Wallet Return'; break;
                    case 8: $type = 'Jackpot'; break;
                    case 9: $type = 'Fortune Wheel'; break;
                    case 10: $type = 'Replenishment'; break;
                    default: $type = '';
                endswitch;

                $date = Time::parse(date('Y-m-d H:i:s', strtotime($ph['createDate'])));
                $created = $date->toDateTimeString();

                $amount = floor($ph['amount'] * 10000)/10000;

                $row = [];
                $row[] = date('Y-m-d H:i:s', strtotime($created));
                $row[] = $ph['toLoginId'];
                $row[] = $status;
                $row[] = $type;
                $row[] = $ph['createBy'];
                $row[] = $amount;
                $row[] = !empty($ph['remark']) ? $ph['remark'] : '---';
                $data[] = $row;
            endforeach;
            echo json_encode(['data'=>$data, 'code'=>1, 'pageIndex'=>$payload['pageIndex'], 'rowPerPage'=>$payload['rowPerPage'], 'totalPage'=>$payload['totalPage'], 'totalRecord'=>$payload['totalRecord']]);
        else:
            echo json_encode(['no data']);
        endif;
    }
}