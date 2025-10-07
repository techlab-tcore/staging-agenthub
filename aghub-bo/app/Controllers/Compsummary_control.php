<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Compsummary_control extends BaseController
{
    /*
    This API is to add or modify the PT Expenses and PS Expenses ONLY
    */

    public function addCompanySummary()
    {
        if( !session()->get('logged_in') ): return false; endif;

        if( $this->request->getPost('params')['settledate'] || !empty($this->request->getPost('params')['settledate']) ):
            $settledate = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($this->request->getPost('params')['settledate']))));
        else:
            $settledate = date('c', strtotime(date('Y-m-d 00:00:00')));
        endif;

        $payloadSummary = [
            'userid' => $_SESSION['token'],
            'timezone' => 8,
            'date' => $settledate,
        ];
        $resSummary = $this->compsummary_model->selectAllCompanySummary($payloadSummary);
        unset($resSummary['code']);
        unset($resSummary['message']);

        $data = [
            'userid' => $_SESSION['token'],
            'timezone' => 8,
            'date' => $settledate,
            'psexpenses' => (float)$this->request->getpost('params')['psExpenses'],
            'ptexpenses' => (float)$this->request->getpost('params')['ptExpenses'],
        ];
        $payload = array_merge($data, $resSummary);
        $res = $this->compsummary_model->insertCompanySummary($payload);
        echo json_encode($res);
    }

    public function companySummaryList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        if( !empty($this->request->getpost('settledate')) ):
            $settledate = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($this->request->getpost('settledate')))));
        else:
            $settledate = date('c', strtotime(date('Y-m-d 00:00:00')));
        endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'timezone' => 8,
            'date' => $settledate,
        ];
        $res = $this->compsummary_model->selectAllCompanySummary($payload);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $data = [];
            $row = [];
            $row[] = $res['data']['totalBet'];
            $row[] = $res['data']['totalTurnover'];
            $row[] = $res['data']['totalWin'];
            $row[] = $res['data']['totalWinlose'];
            $row[] = $res['data']['useJackpotAmount']+$res['data']['freeCoin'] + $res['data']['topUpComm'] + $res['data']['referralComm'] + $res['data']['refReg'] + $res['data']['promotion'];
            $row[] = $res['data']['ptExpenses'];
            $row[] = $res['data']['psExpenses'];

            // foreach( $res['data']['data'] as $gp ):
            //     $row[] = $gp['gameProviderCode'];
            //     $row[] = $gp['actual']['bet'];
            //     $row[] = $gp['actual']['turnover'];
            //     $row[] = $gp['actual']['win'];
            //     $row[] = $gp['actual']['amount'];
            //     $row[] = $gp['giveChip'];
            //     $row[] = $gp['affiliateAmount'];
            //     $row[] = $gp['loseRebateAmount'];
            // endforeach;
            
            foreach( $res['data']['data'] as $gp ):
                $row[] = $gp['gameProviderCode'];
                $row[] = $gp['use']['bet'];
                $row[] = $gp['use']['turnover'];
                $row[] = $gp['use']['win'];
                $row[] = $gp['use']['amount'];
                $row[] = $gp['giveChip'];
                $row[] = $gp['commissionAmount'];
                $row[] = $gp['affiliateAmount'];
                $row[] = $gp['loseRebateAmount'] + $gp['winloseRebateAmount'];
            endforeach;
            $data[] = $row;
            echo json_encode(['data' => $data]);
        else:
            echo json_encode(['no data']);
        endif;
    }
}