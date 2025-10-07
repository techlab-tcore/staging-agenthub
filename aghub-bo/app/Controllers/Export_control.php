<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Export_control extends BaseController
{
    /*
    Protected
    */

    protected function searchUsername($role,$uid)
    {
        $payload = $this->user_model->selectSomeUser([
            'userid' => $_SESSION['token'],
            'role' => (int)$role,
            'id' => '',
            'loginid' => preg_replace('/\s+/', '', $uid),
            'contactno' => '',
            'name' => '',
            'ip' => '',
            'date' => null,
            'timezone' => 8
        ]);
        return $payload;
    }

    /*
    End Protected
    */

    public function addTransactionExport()
    {
        if( !session()->get('logged_in') ): return false; endif;

        if( !empty($this->request->getpost('params')['start']) && !empty($this->request->getpost('params')['end']) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($this->request->getpost('params')['start']))));
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($this->request->getpost('params')['end']))));
        else:
            $from = date('c', strtotime(date('Y-m-d 00:00:00')));
            $to = date('c', strtotime(date('Y-m-d 23:59:59')));
        endif;

        // Convert Username to UID
        if( !empty($this->request->getpost('params')['uplinecreateby']) ):
            $searchUplineCreateBy= $this->searchUsername($this->request->getpost('params')['roleuplinecreateby'],$this->request->getpost('params')['uplinecreateby']);
            if( $searchUplineCreateBy['code']==1 && $searchUplineCreateBy['data']!=[] ):
                foreach( $searchUplineCreateBy['data'] as $u ):
                    $uplinecreateby = $u['userId'];
                endforeach;
            else:
                $uplinecreateby = '';
            endif;
        else:
            $uplinecreateby = '';
        endif;

        if( !empty($this->request->getpost('params')['createby']) ):
            $searchCreateBy= $this->searchUsername($this->request->getpost('params')['rolecreateby'],$this->request->getpost('params')['createby']);
            if( $searchCreateBy['code']==1 && $searchCreateBy['data']!=[] ):
                foreach( $searchCreateBy['data'] as $u ):
                    $createby = $u['userId'];
                endforeach;
            else:
                $createby = '';
            endif;
        else:
            $createby = '';
        endif;

        if( !empty($this->request->getpost('params')['frmusername']) ):
            $searchFrmUser= $this->searchUsername($this->request->getpost('params')['rolefrmuser'],$this->request->getpost('params')['frmusername']);
            if( $searchFrmUser['code']==1 && $searchFrmUser['data']!=[] ):
                foreach( $searchFrmUser['data'] as $u ):
                    $fromuser = $u['userId'];
                endforeach;
            else:
                $fromuser = '';
            endif;
        else:
            $fromuser = '';
        endif;

        if( !empty($this->request->getpost('params')['tousername']) ):
            $searchToUser= $this->searchUsername($this->request->getpost('params')['role2user'],$this->request->getpost('params')['tousername']);
            if( $searchToUser['code']==1 && $searchToUser['data']!=[] ):
                foreach( $searchToUser['data'] as $u ):
                    $touser = $u['userId'];
                endforeach;
            else:
                $touser = '';
            endif;
        else:
            $touser = '';
        endif;
        // End Convert Username to UID

        // Wallet Types
        if( !empty($raw['frmwallet']) ):
            $frmWallet = array_map('intval', [$raw['frmwallet']]);
        else:
            $frmWallet = [];
        endif;

        if( !empty($raw['towallet']) ):
            $toWallet = array_map('intval', [$raw['towallet']]);
        else:
            $toWallet = [];
        endif;
        // End Wallet Types

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['parent']),
            'method' => array_map('intval', $this->request->getpost('params')['method']),
            'type' => array_map('intval', $this->request->getpost('params')['type']),
            'status' => array_map('intval', $this->request->getpost('params')['status']),
            'fromcreatedate' => $from,
            'tocreatedate' => $to,
            'paymentid' => $this->request->getpost('params')['payid'],
            'fromwallettype' => $frmWallet,
            'towallettype' => $toWallet,
            'fromaccountno' => $this->request->getpost('params')['frmaccno'],
            'toaccountno' => $this->request->getpost('params')['toaccno'],
            'frombankid' => $this->request->getpost('params')['frmbankid'],
            'tobankid' => $this->request->getpost('params')['tobankid'],
            'fromuserid' => $fromuser,
            'touserid' => $touser,
            'createby' => $createby,
            'uplinecreateby' => $uplinecreateby,

            'self' => true,
            'desc' => true,
            'pageindex' => 1,
            'rowperpage' => 15,
        ];
        $res = $this->export_model->insertNewExport($payload);
        echo json_encode($res);
    }


    /*
    Export History
    */

    public function selectAllExportList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        if( !empty($this->request->getpost('start')) && !empty($this->request->getpost('end')) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($this->request->getpost('start')))));
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($this->request->getpost('end')))));
        else:
            $from = date('c', strtotime(date('Y-m-d 00:00:00')));
            $to = date('c', strtotime(date('Y-m-d 23:59:59')));
        endif;

        $payload = [
            'fromdate' => $from,
            'todate' => $to,
        ];
        $res = $this->export_model->selectAllExportList($payload);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $data = [];
            foreach( $res['data'] as $s ):
                switch($s['type']):
                    case 1: $type = lang('Label.deposit'); break;
                    case 2: $type = lang('Label.withdrawal'); break;
                    case 3: $type = lang('Label.promotion'); break;
                    case 4: $type = lang('Label.rebate'); break;
                    case 5: $type = lang('Label.affiliate'); break;
                    case 6: $type = lang('Label.credittransfer'); break;
                    case 7: $type = lang('Label.wreturn'); break;
                    case 8: $type = lang('Label.jackpot'); break;
                    case 9: $type = lang('Label.spintoken'); break;
                    case 10: $type = lang('Label.pgtransfer'); break;
                    case 11: $type = lang('Label.refcomm'); break;
                    case 12: $type = lang('Label.depcomm'); break;
                    case 13: $type = lang('Label.lossrebate'); break;
                    case 14: $type = lang('Label.affsharereward'); break;
                    case 15: $type = lang('Label.dailyfreereward'); break;
                    case 16: $type = lang('Label.affloserebate'); break;
                    case 17: $type = lang('Label.fortunereward'); break;
                    default: $type = '---';
                endswitch;

                switch( $s['status'] ):
                    case 2: $status = lang('Label.pending'); break;
                    case 3: $status = lang('Label.approve'); break;
                    default:
                        $status = lang('Label.reject');
                endswitch;

                $date = Time::parse(date('Y-m-d H:i:s', strtotime($s['createDate'])));
                $created = $date->toDateTimeString();

                $row = [];
                // $row[] = $s['id'];
                $row[] = $created;
                $row[] = $type;
                $row[] = $status;
                $row[] = '<a target="_blank" href="'.$s['fileName'].'"><ins>'.lang('Nav.dwfile').'</ins></a>';
                $row[] = !empty($s['remark']) ? $s['remark'] : '---';
                $data[] = $row;
            endforeach;
            echo json_encode(['data'=>$data, 'code'=>1]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    /*
    End Export History
    */
}