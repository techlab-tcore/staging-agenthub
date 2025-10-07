<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Gameps_control extends BaseController
{
    /*
    Protected
    */

    protected function isMultipleOf5($n)
    {
        while ( $n > 0 )
            $n = $n - 5;
        if ( $n == 0 )
            return true;
        return false;
    }

    protected function modifyMasterGamePt($parent,$ptPercentage)
    {
        if( !session()->get('logged_in') ): return false; endif;
        
        $auth = [
            'userid' => base64_decode($parent)
        ];

        $raw = $this->gameprovider_model->selectAllGp(['userid' => $_SESSION['token']]);
        $data = [];
        $param = new \stdClass();
        foreach( $raw['data'] as $gp ):
            if( $gp['code']!='GD' && $gp['code']!='GDS' && $gp['code']!='GD8' && $gp['code']!='GD2' && $gp['code']!='MN8' ):
                $data[$gp['code']] = (float)$ptPercentage;
            endif;
        endforeach;
        $param = $data;
        $pt['value'] = $param;
        $payload = array_merge($auth, $pt);
        
        $res = $this->gamept_model->updateGamePt($payload);
        return $res;
    }

    protected function modifyAgentPs($parent,$share)
    {
        if( !session()->get('logged_in') ): return false; endif;

        // $parent = $this->request->getPost('params')['parent'];
        // $share = $this->request->getPost('params')['psRate'];

        $payloadPs = [
            'userid' => base64_decode($parent)
        ];
        $resPs = $this->gameps_model->selectAgentPsSettings($payloadPs);
        // return $resPs;
        if( $resPs['code']==1 && $resPs['data']['data']!=[] ):
            $data = [];
            $param = new \stdClass();
            // $param->EN = $this->request->getpost('params')['en'];
            foreach( $resPs['data']['data'] as $gp ):
                // if( $gp['gameProviderCode']!='GD' && $gp['gameProviderCode']!='c' && $gp['gameProviderCode']!='GD8' && $gp['gameProviderCode']!='GD2' && $gp['gameProviderCode']!='MN8' ):
                    $data[$gp['gameProviderCode']] = (float)$share;
                // endif;
            endforeach;
            $param = $data;
            $ps['value'] = $param;

            $auth = ['userid' => base64_decode($parent)];
            $payload = array_merge($auth, $ps);
            $res = $this->gameps_model->updateAgentPsSettings($payload);
            return $res;
        // else:
            // return $resPs;
        endif;
    }

    /*
    Agent Lottery
    */

    public function modifyAgentPsLottoExpenses()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getPost('params')['parent']),
            'percentage' => (float)$this->request->getPost('params')['psLottoExpenses']
        ];
        $res = $this->ptps_model->updateAgLottoPsExpenses($payload);
        echo json_encode($res);
    }

    public function minMaxAgentPsLottoExpenses()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getPost('params')['parent']),
            'self' => true
        ];
        $res = $this->ptps_model->selectAgLottoMinMaxPsExpenses($payload);
        echo json_encode($res);
    }

    public function getAgentLottoExpenses()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getPost('params')['parent']),
        ];
        $res = $this->ptps_model->selectAgLottoPsExpenses($payload);
        echo json_encode($res);
    }

    /*
    Agent PT
    */

    public function modifyAgentFightExpenses()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $parent = $this->request->getPost('params')['parent'];
        $ptExpenses = $this->request->getPost('params')['ptExpenses'];

        $payload = [
            'userid' => base64_decode($parent),
            'percentage' => (float)$ptExpenses
        ];
        $res = $this->ptps_model->updateAgPtExpenses($payload);
        if( $res['code']==1 ):
            $resPS = $this->modifyAgentPs($parent,$ptExpenses);
            // echo json_encode($res);
            if( $resPS['code']==1 ):
                $resGamePt = $this->modifyMasterGamePt($parent,$ptExpenses);
                echo json_encode($resGamePt);
            else:
                echo json_encode($resPS);
            endif;
        else:
            echo json_encode($res);
        endif;
    }

    public function getAgentMinMaxFightExpenses()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getPost('params')['parent']),
            'self' => true
        ];
        $res = $this->ptps_model->selectAgMinMaxPtExpenses($payload);
        echo json_encode($res);
    }

    public function getAgentFightExpenses()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getPost('params')['parent'])
        ];
        $res = $this->ptps_model->selectAgPtExpenses($payload);
        echo json_encode($res);
    }

    /*
    Agent PS
    */

    public function minMaxAgentPs()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getPost('params')['parent']),
            'self' => true,
            'gameprovidercode' => '',
        ];
        $res = $this->gameps_model->selectMinMaxAgentPsSettings($payload);
        echo json_encode($res);
    }

    public function modifyAgentPsExpenses()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $parent = $this->request->getPost('params')['parent'];
        $psExpenses = $this->request->getPost('params')['psExpenses'];

        // $mul5 = $this->isMultipleof5($psExpenses);
        // if ( $mul5==true )
        if( $psExpenses>1 )
        {
            $payload = [
                'userid' => base64_decode($parent),
                'percentage' => (float)$psExpenses
            ];
            $res = $this->gameps_model->updateAgentPsExpenses($payload);
            // echo json_encode($res);
            if( $res['code']==1 ):
                $resGamePs = $this->modifyAgentPs($parent,$psExpenses);
                echo json_encode($resGamePs);
            else:
                echo json_encode($res);
            endif;
        } else {
            echo json_encode(['code'=>-1, 'message'=>lang('Label.leastshare', [1])]);
        }
    }

    public function minMaxAgentPsExpenses()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getPost('params')['parent']),
            'self' => true
        ];
        $res = $this->gameps_model->selectMinMaxAgentPsExpenses($payload);
        echo json_encode($res);
    }

    public function getAgentPtPs()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getPost('params')['parent'])
        ];
        $res = $this->gameps_model->selectAgentPsSettings($payload);
        echo json_encode($res);
    }

    /*
    Listing & History
    */

    public function getPtPs3History()
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

        $data = [
            'userid' => base64_decode($raw['parent']),
            'fromdate' => $from,
            'todate' => $to,
            'date' => date('c', strtotime(date('Y-m-d 00:00:00', strtotime($raw['settledate'])))),
            'pageindex' => $raw['pageindex'],
            'rowperpage' => $raw['rowperpage'],
        ];
        $payload = $this->ptps_model->selectAllLottoSharesHistory($data);
        // echo json_encode($payload);

        if( $payload['code']==1 && $payload['data']!=[] ):
            $data = [];
            foreach( $payload['data'] as $h ):
                $date = Time::parse(date('Y-m-d H:i:s', strtotime($h['createDate'])));
                $created = $date->toDateTimeString();

                $date2 = Time::parse(date('Y-m-d H:i:s', strtotime($h['date'])));
                $settleDate = $date2->toDateTimeString();

                $row = [];
                $row[] = $created;
                $row[] = date('Y-m-d',strtotime($settleDate));
                $row[] = $h['loginId'];
                $row[] = $h['name'];
                $row[] = $h['grossProfit'];
                $row[] = $h['expenses'];
                $row[] = $h['netProfit'];

                // $row[] = $h['recordId'];
                // $row[] = $h['userId'];
                $data[] = $row;
            endforeach;
            echo json_encode([
                'data' => $data, 
                'code' => 1, 
                'pageIndex' => $payload['pageIndex'], 
                'rowPerPage' => $payload['rowPerPage'], 
                'totalPage' => $payload['totalPage'],
                'totalRecord' => $payload['totalRecord'],
            ]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function getPtPs3List()
    {
        if( !session()->get('logged_in') ): return false; endif;

        if( !empty($this->request->getpost('settledate')) ):
            $settledate = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($this->request->getpost('settledate')))));
        else:
            $settledate = date('c', strtotime(date('Y-m-d 00:00:00')));
        endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('parent')),
            'date' => $settledate,
            'timezone' => 8
        ];
        $res = $this->ptps_model->selectAllLottoSharesList($payload);
        // echo json_encode($res);

        if( $this->request->getpost('side')==0 ):
            if( $res['code']==1 && $res['company']!=[] ):
                $data = [];
                $row = [];
                $row[] = $res['company']['bet'];
                $row[] = $res['company']['turnover'];
                $row[] = $res['company']['win'];
                $row[] = $res['company']['winlose'];
                $row[] = $res['company']['expenses'];
                $row[] = $res['company']['grossProfit'];
                $row[] = $res['company']['netProfit'];
                $data[] = $row;
                echo json_encode(['data' => $data]);
            else:
                echo json_encode(['no data']);
            endif;
        else:
            if( $res['code']==1 && $res['self']!=[] ):
                $data = [];
                $row = [];
                $row[] = $res['self']['bet'];
                $row[] = $res['self']['turnover'];
                $row[] = $res['self']['win'];
                $row[] = $res['self']['winlose'];
                $row[] = $res['self']['expenses'];
                $row[] = $res['self']['grossProfit'];
                $row[] = $res['self']['netProfit'];
                $data[] = $row;
                echo json_encode(['data' => $data]);
            else:
                echo json_encode(['no data']);
            endif;
        endif;
    }

    public function getPtPs2List()
    {
        // Side = 0, Company
        // Side = 1, Agent

        if( !session()->get('logged_in') ): return false; endif;

        if( !empty($this->request->getpost('settledate')) ):
            $settledate = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($this->request->getpost('settledate')))));
        else:
            $settledate = date('c', strtotime(date('Y-m-d 00:00:00')));
        endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('parent')),
            'date' => $settledate,
            'timezone' => 8
        ];
        $res = $this->ptps_model->selectAllSharesList($payload);
        // echo json_encode($res);
        
        if( $this->request->getpost('side')==0 ):
            if( $res['code']==1 && $res['company']!=[] ):
                $data = [];
                $row = [];
                $row[] = $res['company']['bet'];
                $row[] = $res['company']['turnover'];
                $row[] = $res['company']['win'];
                $row[] = $res['company']['winlose'];
                $row[] = $res['company']['ptpsBet'];
                $row[] = $res['company']['ptpsTurnover'];
                $row[] = $res['company']['ptpsWin'];
                $row[] = $res['company']['ptpsWinlose'];
                $row[] = $res['company']['expenses'];
                $row[] = $res['company']['grossProfit'];
                $row[] = $res['company']['netProfit'];
                $data[] = $row;
                echo json_encode(['data' => $data]);
            else:
                echo json_encode(['no data']);
            endif;
        else:
            if( $res['code']==1 && $res['self']!=[] ):
                $data = [];
                $row = [];
                $row[] = $res['self']['bet'];
                $row[] = $res['self']['turnover'];
                $row[] = $res['self']['win'];
                $row[] = $res['self']['winlose'];
                $row[] = $res['self']['expenses'];
                $row[] = $res['self']['grossProfit'];
                $row[] = $res['self']['netProfit'];
                $data[] = $row;
                echo json_encode(['data' => $data]);
            else:
                echo json_encode(['no data']);
            endif;
        endif;
    }

    public function getPtPs2History()
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

        $data = [
            'userid' => base64_decode($raw['parent']),
            'fromdate' => $from,
            'todate' => $to,
            'date' => date('c', strtotime(date('Y-m-d 00:00:00', strtotime($raw['settledate'])))),
            'pageindex' => $raw['pageindex'],
            'rowperpage' => $raw['rowperpage'],
        ];
        $payload = $this->ptps_model->selectAllSharesHistory($data);
        // echo json_encode($payload);

        if( $payload['code']==1 && $payload['data']!=[] ):
            $data = [];
            foreach( $payload['data'] as $h ):
                $date = Time::parse(date('Y-m-d H:i:s', strtotime($h['createDate'])));
                $created = $date->toDateTimeString();

                $date2 = Time::parse(date('Y-m-d H:i:s', strtotime($h['date'])));
                $settleDate = $date2->toDateTimeString();

                $row = [];
                $row[] = $created;
                $row[] = date('Y-m-d',strtotime($settleDate));
                $row[] = $h['loginId'];
                $row[] = $h['name'];
                $row[] = $h['grossProfit'];
                $row[] = $h['expenses'];
                $row[] = $h['netProfit'];

                // $row[] = $h['recordId'];
                // $row[] = $h['userId'];
                $data[] = $row;
            endforeach;
            echo json_encode([
                'data' => $data, 
                'code' => 1, 
                'pageIndex' => $payload['pageIndex'], 
                'rowPerPage' => $payload['rowPerPage'], 
                'totalPage' => $payload['totalPage'],
                'totalRecord' => $payload['totalRecord'],
            ]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function getPtPs1List()
    {
        if( !session()->get('logged_in') ): return false; endif;

        if( !empty($this->request->getpost('settledate')) ):
            $settledate = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($this->request->getpost('settledate')))));
        else:
            $settledate = date('c', strtotime(date('Y-m-d 00:00:00')));
        endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('parent')),
            'date' => $settledate,
            'timezone' => 8
        ];
        $res = $this->ptps_model->selectAllFightList($payload);
        // echo json_encode($res);

        if( $this->request->getpost('side')==0 ):
            if( $res['code']==1 && $res['data']!=[] ):
                $data = [];
                foreach( $res['data'] as $u ):
                    switch( $u['role'] ):
                        case 3:
                            $role = '<a class="text-decoration-none" href="javascript:void(0);" onclick="reload(\''.base64_encode($u['userId']).'+'.$u['loginId'].'\');">'.$u['loginId'].'</a>';
                        break;

                        case 4: $role = $u['loginId']; break;
                    endswitch;

                    $playerBet = 0;
                    $playerEffective = 0;
                    $playerWin = 0;
                    $playerWinlose = 0;
                    foreach( $u['data'] as $g ):
                        $playerBet += $g['playerBet'];
                        $playerEffective += $g['playerTurnover'];
                        $playerWin += $g['playerWin'];
                        $playerWinlose += $g['playerWinlose'];
                    endforeach;

                    $pwin = substr($playerWin, 0, 1)=='-' ? substr($playerWin, 1) : '-'.$playerWin;
                    $pwinlose = substr($playerWinlose, 0, 1)=='-' ? substr($playerWinlose, 1) : '-'.$playerWinlose;
                    
                    $row = [];
                    $row[] = $role;
                    $row[] = $u['name'];
                    $row[] = $playerBet;
                    $row[] = $playerEffective;
                    $row[] = $playerWin;
                    $row[] = $playerWinlose;

                    foreach( $u['data'] as $gp ):
                        $row[] = '<small class="badge bg-primary fw-normal me-1">'.$gp['gameProviderCode'].'</small>'.$gp['gameProviderName'];
                        $row[] = $gp['playerBet'];
                        $row[] = $gp['playerTurnover'];
                        $row[] = $gp['playerWin'];
                        $row[] = $gp['playerWinlose'];
                        // $row[] = $gp['selfBet'];
                        // $row[] = $gp['selfTurnover'];
                        // $row[] = $gp['selfWin'];
                        // $row[] = $gp['selfWinlose'];
                    endforeach;

                    $data[] = $row;
                endforeach;
                echo json_encode(['data' => $data]);
            else:
                echo json_encode(['no data']);
            endif;
        else:
            if( $res['code']==1 && $res['self']!=[] ):
                $data = [];
                $row = [];
                $row[] = $res['self']['loginId'];
                $row[] = $res['self']['name'];
                $row[] = $res['self']['grossProfit'];
                $row[] = $res['self']['expenses'];
                $row[] = $res['self']['otherExpenses'];
                $row[] = $res['self']['netProfit'];

                foreach( $res['self']['data'] as $gp ):
                    $row[] = '<span class="badge bg-primary fw-normal me-1">'.$gp['gameProviderCode'].'</span>'.$gp['gameProviderName'];
                    $row[] = $gp['selfBet'];
                    $row[] = $gp['selfTurnover'];
                    $row[] = $gp['selfWin'];
                    $row[] = $gp['selfWinlose'];
                endforeach;
                
                $data[] = $row;
                echo json_encode(['data' => $data]);
            else:
                echo json_encode(['no data']);
            endif;
        endif;
    }

    public function getPtPs1History()
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

        $data = [
            'userid' => base64_decode($raw['parent']),
            'fromdate' => $from,
            'todate' => $to,
            'date' => date('c', strtotime(date('Y-m-d 00:00:00', strtotime($raw['settledate'])))),
            'pageindex' => $raw['pageindex'],
            'rowperpage' => $raw['rowperpage'],
        ];
        $payload = $this->ptps_model->selectAllFightHistory($data);
        // echo json_encode($res);

        if( $payload['code']==1 && $payload['data']!=[] ):
            $data = [];
            foreach( $payload['data'] as $h ):
                $date = Time::parse(date('Y-m-d H:i:s', strtotime($h['createDate'])));
                $created = $date->toDateTimeString();

                $date2 = Time::parse(date('Y-m-d H:i:s', strtotime($h['date'])));
                $settleDate = $date2->toDateTimeString();

                $row = [];
                $row[] = $created;
                $row[] = date('Y-m-d',strtotime($settleDate));
                $row[] = $h['loginId'];
                $row[] = $h['name'];
                $row[] = $h['grossProfit'];
                $row[] = $h['expenses'];
                $row[] = $h['otherExpenses'];
                $row[] = $h['netProfit'];

                // $row[] = $h['recordId'];
                // $row[] = $h['userId'];
                $data[] = $row;
            endforeach;
            echo json_encode([
                'data' => $data, 
                'code' => 1, 
                'pageIndex' => $payload['pageIndex'], 
                'rowPerPage' => $payload['rowPerPage'], 
                'totalPage' => $payload['totalPage'],
                'totalRecord' => $payload['totalRecord'],
            ]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    /*
    PS Group Report
    */

    // 44
    public function adminDirectMemberSummary44()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $rawProfile = $this->user_model->selectUser(['userid' => $_SESSION['token']]);
        $directUpline = $rawProfile['data']['agentId'];

        $rawSource = json_decode(file_get_contents('php://input'),1);

        if( !empty($rawSource['start']) && !empty($rawSource['end']) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($rawSource['start']))));
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($rawSource['end']))));
        else:
            $from = date('c', strtotime(date('Y-m-d 00:00:00')));
            $to = date('c', strtotime(date('Y-m-d 23:59:59')));
        endif;

        $refer = $rawSource['parent'] ? base64_decode($rawSource['parent']) : $_SESSION['token'];
        $raw = $this->gameps_model->selectPsSummary([
            'userid'=>$refer, 
            'fromdate'=>$from, 
            'todate'=>$to,
            'turnovercount' => true
        ]);
        // echo json_encode($raw);

        if( $raw['code']==1 && $raw['data']!=[] ):
            $data = [];

            // Upline Shares
            $uplineShares = $raw['data'][0]['expensesPSRate'];
            // End Upline Shares

            $order_by = array('Casino Group','Slot Group','Slot2 Group','Lottery Group','Sport Group','Keno Group');
            usort($raw['companyGPData'], function($a,$b) use ($order_by) {
                $pos_a = array_search($a['groupName'], $order_by);
                $pos_b = array_search($b['groupName'], $order_by);
                return $pos_a - $pos_b;
            });

            foreach( $raw['companyGPData'] as $general ):
                // if( $general['totalProfit']>0 ):
                if( $general['groupName']!='NO GROUP' ):
                $row = [];
                $row[] = $general['groupName'];

                // Company
                $compBet = 0;
                $compEff = 0;
                $compWinlose = 0;
                $groupBet = 0;
                $groupEff = 0;
                $groupWinlose = 0;
                $groupCompProfit = 0;
                foreach( $raw['companyGPData'] as $comp ):
                    // Company Total
                    foreach( $comp['totalCountType'] as $t ):
                        if( $t['turnoverCount']==true ):
                            $compBet += $t['totalBet'];
                            $compEff += $t['totalTurnover'];
                            $compWinlose += $t['totalWinLose'];
                        endif;
                    endforeach;
                    // End Company Total

                    // Group Details
                    if( $comp['groupName']===$general['groupName'] ):
                        foreach( $comp['totalCountType'] as $d ):
                            if( $d['turnoverCount']==true ):
                                $groupBet += $d['totalBet'];
                                $groupEff += $d['totalTurnover'];
                                $groupWinlose += $d['totalWinLose'];
                            endif;
                        endforeach;
                    endif;
                    $groupCompProfit = $comp['totalProfit'];
                    // End Group Details
                endforeach;
                // End Company

                $groupProfit = 0;
                $nettExpenses = 0;

                $groupPlayerBet = 0;
                $groupPlayerEff = 0;
                $groupPlayerWinlose = 0;
                foreach($raw['data'] as $m):
                    $playerBet = 0;
                    $playerEff = 0;
                    $playerWinlose = 0;
                    $playerExpenses = 0;
                    if( $m['role']==4 && $m['expensesWeightByBet']>0 ):
                        foreach( $m['data'] as $group ):
                            if( $group['groupName']==$general['groupName'] ):
                                // Player
                                foreach( $group['countType'] as $ct ):
                                    if( $ct['turnoverCount']==true ):
                                        $playerBet += $ct['playerBet'];
                                        $playerEff += $ct['playerTurnover'];
                                        $playerWinlose += $ct['playerWinLose'];
                                    endif;
                                endforeach;
                                // End Player
                            endif;
                        endforeach;
                    endif;

                    $groupPlayerBet += $playerBet;
                    $groupPlayerEff += $playerEff;
                    $groupPlayerWinlose += $playerWinlose;
                endforeach;

                if( $groupEff>0 ):
                    $playerWeight = $groupPlayerEff / $groupEff;
                else:
                    $playerWeight = 0;
                endif;

                $groupProfit += $general['totalProfit']/$raw['psPercentage']*$uplineShares*$playerWeight;

                // Expenses
                $weight = $groupPlayerEff / $compEff;
                $nettExpenses += $raw['expenses']/$raw['psPercentage']*$uplineShares*$weight;
                // End Expenses

                // Owner Nett Profit
                $groupOwnerNett = $groupProfit - $nettExpenses;
                // End Owner Nett Profit

                $row[] = $groupPlayerEff;
                $row[] = $uplineShares.'/'.$raw['psPercentage'];
                // $row[] = $general['totalProfit'].'=='.$groupBet.'=='.$compBet;
                // $row[] = $groupPlayerWinlose;
                $row[] = $groupProfit;
                $row[] = $nettExpenses;
                $row[] = $groupOwnerNett;
                $data[] = $row;
                endif;
            endforeach;
            echo json_encode(['code'=>1, 'data' => $data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function adminSummaryV244()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $rawProfile = $this->user_model->selectUser(['userid' => $_SESSION['token']]);
        $directUpline = $rawProfile['data']['agentId'];

        $rawSource = json_decode(file_get_contents('php://input'),1);

        if( !empty($rawSource['start']) && !empty($rawSource['end']) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($rawSource['start']))));
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($rawSource['end']))));
        else:
            $from = date('c', strtotime(date('Y-m-d 00:00:00')));
            $to = date('c', strtotime(date('Y-m-d 23:59:59')));
        endif;

        $refer = $rawSource['parent'] ? base64_decode($rawSource['parent']) : $_SESSION['token'];
        $raw = $this->gameps_model->selectPsSummary([
            'userid'=>$refer, 
            'fromdate'=>$from, 
            'todate'=>$to,
            'turnovercount' => true
        ]);
        // echo json_encode($raw);

        if( $_SESSION['role']==5 && $_SESSION['uplinerole']==3 ):
            $rid = $directUpline;
        elseif( $_SESSION['role']==2 || $_SESSION['role']==3 || ($_SESSION['role']==5 && $_SESSION['uplinerole']==2) ):
            $rid = base64_decode($rawSource['parent']);
        else:
            $rid = $_SESSION['token'];
        endif;

        if( $raw['code'] == 1 &&  $raw['data'] != [] ):
            $data = [];

            // Upline Shares
            $uplineShares = $raw['data'][0]['expensesPSRate'];
            // End Upline Shares

            // Company Expenses Summary
            $compExpBet = 0;
            $compExpEff = 0;
            $compExpWinlose = 0;
            $compExpProfit = 0;
            foreach( $raw['companyGPData'] as $sumExpComp ):
                foreach( $sumExpComp['totalCountType'] as $sumExpCompTC ):
                    if( $sumExpCompTC['turnoverCount']==TRUE ):
                        $compExpBet += $sumExpCompTC['totalBet'];
                        $compExpEff += $sumExpCompTC['totalTurnover'];
                        $compExpWinlose += $sumExpCompTC['totalWinLose'];
                    endif;
                endforeach;
                $compExpProfit += $sumExpComp['totalProfit'];
            endforeach;
            // End Company Expenses Summary

            // Settlement
            $sumAllExpensesBet = 0;
            $sumAllExpensesEff = 0;
            $sumAllUserExpenses = 0;
            foreach( $raw['data'] as $sumExpUser ):
                if( $sumExpUser['role']==3 ):
                    // Sub-Loop User Expenses Sum
                    $sumExpUserBet = 0;
                    $sumExpUserEff = 0;
                    foreach( $raw['data'] as $sumExpUserLoop ):
                        if( $sumExpUserLoop['userId']===$sumExpUser['userId'] && $sumExpUserLoop['userId']!==$rid ):
                            foreach( $sumExpUserLoop['data'] as $sumExpUserGroup ):
                                foreach( $sumExpUserGroup['countType'] as $sumExpGroupTC ):
                                    if( $sumExpGroupTC['turnoverCount']==TRUE ):
                                        $sumExpUserBet += $sumExpGroupTC['playerBet'];
                                        $sumExpUserEff += $sumExpGroupTC['playerTurnover'];
                                    endif;
                                endforeach;
                            endforeach;
                        elseif( $sumExpUserLoop['userId']===$sumExpUser['userId'] && $sumExpUserLoop['userId']===$rid ):
                            foreach( $raw['data'] as $sumExpUplinePlayerLoop ):
                                if( $sumExpUplinePlayerLoop['role']==4 ):
                                    foreach( $sumExpUplinePlayerLoop['data'] as $sumExpUplinePlayerGroup ):
                                        foreach( $sumExpUplinePlayerGroup['countType'] as $sumExpUplineGroupTC ):
                                            if( $sumExpUplineGroupTC['turnoverCount']==TRUE ):
                                                $sumExpUserBet += $sumExpUplineGroupTC['playerBet'];
                                                $sumExpUserEff += $sumExpUplineGroupTC['playerTurnover'];
                                            endif;
                                        endforeach;
                                    endforeach;
                                endif;
                            endforeach;
                        endif;
                    endforeach;
                    // End Sub-Loop User Expenses Sum

                    if( $sumExpUser['userId']===$rid ):
                        $sumExpShares2Upline = $uplineShares;
                    else:
                        $sumExpShares2Upline = $uplineShares - $sumExpUser['expensesPSRate'];
                    endif;

                    $sumExpWeight = $sumExpUserEff / $compExpEff;
                    $sumExpUserTook = ($raw['expenses']+$raw['totalJackpot']) / $raw['psPercentage'] * $sumExpShares2Upline * $sumExpWeight;
                    $roundSumExpUserTook = floor($sumExpUserTook * 10000)/10000;

                    $sumAllExpensesBet += $sumExpUserEff;
                    $sumAllExpensesEff += $sumExpUserEff;
                    $sumAllUserExpenses += $roundSumExpUserTook;
                endif;
            endforeach;

            $roundSumAllUserExpenses = floor($sumAllUserExpenses * 10000)/10000;

            $rowExp = [];
            $rowExp[] = '<b>'.lang('Label.expenses').'</b>';
            $rowExp[] = bcdiv($sumAllExpensesEff,1,2);
            $rowExp[] = '-'.bcdiv($roundSumAllUserExpenses, 1, 2);

            // Expenses
            foreach( $raw['data'] as $expUser ):
                if( $expUser['role']==3 ):
                    // Sub-Loop User Bet
                    $expUserBet = 0;
                    $expUserEff = 0;
                    foreach( $raw['data'] as $expUserLoop ):
                        if( $expUserLoop['userId']===$expUser['userId'] && $expUserLoop['userId']!==$rid ):
                            foreach( $expUserLoop['data'] as $expUserGroup ):
                                foreach( $expUserGroup['countType'] as $expGroupTC ):
                                    if( $expGroupTC['turnoverCount']==TRUE ):
                                        $expUserBet += $expGroupTC['playerBet'];
                                        $expUserEff += $expGroupTC['playerTurnover'];
                                    endif;
                                endforeach;
                            endforeach;
                        elseif( $expUserLoop['userId']===$expUser['userId'] && $expUserLoop['userId']===$rid ):
                            foreach( $raw['data'] as $expUplinePlayerLoop ):
                                if( $expUplinePlayerLoop['role']==4 ):
                                    foreach( $expUplinePlayerLoop['data'] as $expUplinePlayerGroup ):
                                        foreach( $expUplinePlayerGroup['countType'] as $expUplineGroupTC ):
                                            if( $expUplineGroupTC['turnoverCount']==TRUE ):
                                                $expUserBet += $expUplineGroupTC['playerBet'];
                                                $expUserEff += $expUplineGroupTC['playerTurnover'];
                                            endif;
                                        endforeach;
                                    endforeach;
                                endif;
                            endforeach;
                        endif;
                    endforeach;
                    // End Sub-Loop User Bet

                    if( $expUser['userId']===$rid ):
                        $expShares2Upline = $uplineShares;
                    else:
                        $expShares2Upline = $uplineShares - $expUser['expensesPSRate'];
                    endif;

                    $expWeight = $expUserEff / $compExpEff;
                    $expUserTook = ($raw['expenses']+$raw['totalJackpot']) / $raw['psPercentage'] * $expShares2Upline * $expWeight;
                    $roundExpUserTook = floor($expUserTook * 10000)/10000;

                    $rowExp[] = $expUser['loginId'];
                    $rowExp[] = '-';
                    $rowExp[] = $expShares2Upline.'/'.$raw['psPercentage'];
                    $rowExp[] = bcdiv($roundExpUserTook,1,2);
                endif;
            endforeach;
            $data[] = $rowExp;
            // End Expenses
            // End Settlement

            // Game Group
            $order_by = array('Casino Group','Slot Group','Slot2 Group','Lottery Group','Sport Group','Keno Group');
            usort($raw['companyGPData'], function($a,$b) use ($order_by) {
                $pos_a = array_search($a['groupName'], $order_by);
                $pos_b = array_search($b['groupName'], $order_by);
                return $pos_a - $pos_b;
            });

            $sumAllGroupProfit = 0;
            foreach( $raw['companyGPData'] as $compGroup ):
                // Company Group Summary
                $compGroupBet = 0;
                $compGroupEff = 0;
                $compGroupWinlose = 0;
                $compGroupProfit = 0;
                foreach( $raw['companyGPData'] as $sumComp ):
                    if( $sumComp['groupName']===$compGroup['groupName'] ):
                        foreach( $sumComp['totalCountType'] as $sumCompTC ):
                            if( $sumCompTC['turnoverCount']==TRUE ):
                                $compGroupBet = $sumCompTC['totalBet'];
                                $compGroupEff = $sumCompTC['totalTurnover'];
                                $compGroupWinlose = $sumCompTC['totalWinLose'];
                            endif;
                        endforeach;
                        $compGroupProfit = $sumComp['totalProfit'];
                    endif;
                endforeach;
                // End Company Group Summary

                // Sum User Game Group
                $sumUserGroupBet = 0;
                $sumUserGroupEff = 0;
                foreach( $raw['data'] as $sumUser ):
                    if( $sumUser['userId']===$rid ):
                        foreach( $sumUser['data'] as $sumGroup ):
                            if( $sumGroup['groupName']===$compGroup['groupName'] ):
                                foreach( $sumGroup['countType'] as $compUgTC ):
                                    if( $compUgTC['turnoverCount']==TRUE ):
                                        $sumUserGroupBet += $compUgTC['playerBet'];
                                        $sumUserGroupEff += $compUgTC['playerTurnover'];
                                    endif;
                                endforeach;
                            endif;
                        endforeach;
                    endif;
                endforeach;
                // End Sum User Game Group

                // Sub-Loop Other Users for Upline
                $dwGroupProfit = 0;
                foreach( $raw['data'] as $userUpline ):
                    foreach( $userUpline['data'] as $groupUpline ):
                        if( $groupUpline['groupName']===$compGroup['groupName'] ):
                            foreach( $groupUpline['countType'] as $ugTCUpline ):
                                if( $ugTCUpline['turnoverCount']==TRUE ):
                                    if( $userUpline['userId']!==$rid ): 
                                        $user2UplineSharesUpline = $uplineShares - $userUpline['expensesPSRate'];
                                        $userGroupWeightUpline = $ugTCUpline['playerTurnover'] / $compGroupEff;
                                        $userGroupProfitUpline = $compGroupProfit / $raw['psPercentage'] * $user2UplineSharesUpline * $userGroupWeightUpline;
                                    else: 
                                        $uplineSalesUpline = $sumUserGroupEff - $ugTCUpline['playerTurnover'];
                                        $userGroupWeightUpline = $uplineSalesUpline / $compGroupEff;
                                        $userGroupProfitUpline = $compGroupProfit / $raw['psPercentage'] * $uplineShares * $userGroupWeightUpline;
                                    endif;
                                    $dwGroupProfit += $userGroupProfitUpline;
                                endif;
                            endforeach;
                        endif;
                    endforeach;
                endforeach;
                // End Sub-Loop Other Users for Upline


                if( $sumUserGroupEff>0 ):
                    $rowGroup = [];
                    $rowGroup[] = $compGroup['groupName'];
                    $rowGroup[] = bcdiv($sumUserGroupEff,1,2);
                    //$rowGroup[] = bcdiv($dwGroupProfit,1,2); 
                    //$rowGroup[] = bcdiv(number_format($dwGroupProfit, 3),1,2); //edited number format
                    $rowGroup[] = bcdiv(sprintf("%.4F", $dwGroupProfit),1,2); //edited number format
                    
                    // User Game Group
                    foreach( $raw['data'] as $user ):
                        if( $user['role']==3 ):
                            foreach( $user['data'] as $group ):
                                if( $group['groupName']===$compGroup['groupName'] ):
                                    foreach( $group['countType'] as $ugTC ):
                                        if( $ugTC['turnoverCount']==TRUE ):
                                            $rowGroup[] = $user['loginId'];

                                            // Non Upline
                                            if( $user['userId']!==$rid ): 
                                                $user2UplineShares = $uplineShares - $user['expensesPSRate'];
                                                $userGroupWeight = $ugTC['playerTurnover'] / $compGroupEff;
                                                $userGroupProfit = ($compGroupProfit / $raw['psPercentage']) * $user2UplineShares * $userGroupWeight;
                                                $roundUserGroupProfit = floor($userGroupProfit * 10000)/10000;

                                                $rowGroup[] = bcdiv($ugTC['playerTurnover'],1,2);
                                                $rowGroup[] = $user2UplineShares.'/'.$raw['psPercentage'];
                                                $rowGroup[] = bcdiv($roundUserGroupProfit,1,2);
                                            else:
                                            // Upline
                                                // Self Player
                                                $UplinePlayerBet = 0;
                                                $UplinePlayerEff = 0;
                                                foreach( $raw['data'] as $p ):
                                                    if( $p['role']==4 ):
                                                        foreach( $p['data'] as $b ):
                                                            if( $b['groupName']===$compGroup['groupName'] ):
                                                                foreach( $b['countType'] as $playerTC ):
                                                                    if( $playerTC['turnoverCount']==TRUE ):
                                                                        $UplinePlayerBet += $playerTC['playerBet'];
                                                                        $UplinePlayerEff += $playerTC['playerTurnover'];
                                                                    endif;
                                                                endforeach;
                                                            endif;
                                                        endforeach;
                                                    endif;
                                                endforeach;
                                                // End Self Player

                                                $uplineSales = $UplinePlayerEff;
                                                $userGroupWeight = $uplineSales / $compGroupEff;
                                                $userGroupProfit = ($compGroupProfit / $raw['psPercentage']) * $uplineShares * $userGroupWeight;

                                                $rowGroup[] = bcdiv($uplineSales,1,2);
                                                $rowGroup[] = $uplineShares.'/'.$raw['psPercentage'];
                                                $rowGroup[] = bcdiv($userGroupProfit,1,2);
                                            endif;
                                        endif;
                                    endforeach;
                                endif;
                            endforeach;
                        endif;
                    endforeach;
                    // End User Game Group
                    $data[] = $rowGroup;
                endif;
                $sumAllGroupProfit += $dwGroupProfit;
            endforeach;
            // End Game Group

            // Nett Summary
            $agentNett = $sumAllGroupProfit - $sumAllUserExpenses;
            // End Nett Summary

            $rowUserNett = [];
            $rowUserNett[] = null;
            $rowUserNett[] = '<b class="d-block text-end">'.lang('Label.nettprofit').':</b>';
            $rowUserNett[] = bcdiv($agentNett,1,2).'<small class="w-100 d-block text-end text-danger">* '.lang('Label.scoredesc').'</small>';

            $data[] = $rowUserNett;
            echo json_encode(['code'=>1, 'data' => $data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function adminSummary44()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $rawProfile = $this->user_model->selectUser(['userid' => $_SESSION['token']]);
        $directUpline = $rawProfile['data']['agentId'];

        $rawSource = json_decode(file_get_contents('php://input'),1);
        // echo json_encode($rawSource);
        if( !empty($rawSource['start']) && !empty($rawSource['end']) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($rawSource['start']))));
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($rawSource['end']))));
        else:
            $from = date('c', strtotime(date('Y-m-d 00:00:00')));
            $to = date('c', strtotime(date('Y-m-d 23:59:59')));
        endif;

        $refer = isset($rawSource['parent']) ? base64_decode($rawSource['parent']) : $_SESSION['token'];
        $raw = $this->gameps_model->selectPsSummary([
            'userid'=>$refer, 
            'fromdate'=>$from, 
            'todate'=>$to,
            'turnovercount' => true
        ]);
        // echo json_encode($raw);

        if( $_SESSION['role']==5 && $_SESSION['uplinerole']==3 ):
            $rid = $directUpline;
        elseif( $_SESSION['role']==2 || $_SESSION['role']==3 || ($_SESSION['role']==5 && $_SESSION['uplinerole']==2) ):
            $rid = base64_decode($rawSource['parent']);
        else:
            $rid = $_SESSION['token'];
        endif;

        if( $raw['code'] == 1 &&  $raw['data'] != [] ):
            $data = [];

            // Settlement
            $sturnover = 0;
            $seffective = 0;
            $swin = 0;
            $swinlose = 0;
            $sprofitturnover = 0;
            $sprofiteffective = 0;

            $selfturnover = 0;
            $selfeffective = 0;

            foreach($raw['data'] as $settleuser):
                foreach($settleuser['data'] as $settle):
                    // if( $settleuser['loginId']===$this->global['profile']['loginId'] ):
                    if( $settleuser['userId']===$rid ):
                        foreach($settle['countType'] as $settleCT):
                            if( $settleCT['turnoverCount']==true ):
                                $sturnover += $settleCT['playerBet'];
                                $seffective += $settleCT['playerTurnover'];
                                $swin += $settleCT['playerWin'];
                                $swinlose += $settleCT['playerWinLose'];
                            endif;
                        endforeach;

                        $sprofitturnover += $settle['profitByBet'];
                        $sprofiteffective += $settle['profitByTurnover'];
                    endif;
                endforeach;

                // if( $settleuser['loginId']===$this->global['profile']['loginId'] ):
                if( $settleuser['userId']===$rid ):
                    $tt = $settleuser['expensesByBet'];
                    $ss = $settleuser['expensesByTurnover'];
                endif;
            endforeach;

            $final_tt = floor($tt * 10000)/10000;
            $final_ss = floor($ss * 10000)/10000;

            $row_settle = [];
            $row_settle[] = '<b>'.lang('Label.expenses').'</button>';
            // $row_settle[] = bcdiv($seffective, 1, 2);
            $row_settle[] = null;
            $row_settle[] = '-'.bcdiv($final_ss, 1, 2);

            // Expenses
            $eself_turnover = 0;
            $eself_effective = 0;
            foreach($raw['data'] as $euser):
                if( $euser['expensesByBet']!=0 || $euser['expensesByTurnover']!=0 ):
                    // if( $euser['loginId']===$this->global['profile']['loginId'] ):
                    if( $euser['userId']===$rid ):
                        foreach($raw['data'] as $eself):
                            // if( $eself['loginId']!==$this->global['profile']['loginId'] ):
                            if( $eself['userId']!==$rid ):
                                $eself_turnover += $eself['expensesByBet'];
                                $eself_effective += $eself['expensesByTurnover'];
                            endif;
                        endforeach;
                        $selfturnover = $euser['expensesByBet'] - $eself_turnover;
                        $selfeffective = $euser['expensesByTurnover'] - $eself_effective;
                        $final_selfturnover = floor($selfturnover * 10000)/10000;
                        $final_selfeffective = floor($selfeffective * 10000)/10000;

                        $row_settle[] = $euser['loginId'];
                        $row_settle[] = '<span class="d-block text-center">-</span>';
                        $row_settle[] = $euser['expensesPSRate'].' / 130';
                        $row_settle[] = '<span class="text-danger">'.bcdiv($final_selfeffective, 1, 2).'</span>';
                    else:
                        $final_eusTexpense = floor($euser['expensesByBet'] * 10000)/10000;
                        $final_eusEexpense = floor($euser['expensesByTurnover'] * 10000)/10000;

                        $row_settle[] = $euser['loginId'];
                        $row_settle[] = '<span class="d-block text-center">-</span>';
                        $row_settle[] = $euser['expensesPSRate'].' / 130';
                        $row_settle[] = '<span class="text-danger">'.bcdiv($final_eusEexpense,1,2).'</span>';
                    endif;
                endif;
            endforeach;
            $data[] = $row_settle;
            
            // Game Provider
            $gpprofile = 0;
            $nettselfprofile = 0;
            foreach( $raw['data'] as $user ):
                $order_by = array('Casino Group','Slot Group','Slot2 Group','Lottery Group','Sport Group','Keno Group');
                usort($user['data'], function($a,$b) use ($order_by) {
                    $pos_a = array_search($a['groupName'], $order_by);
                    $pos_b = array_search($b['groupName'], $order_by);
                    return $pos_a - $pos_b;
                });

                foreach( $user['data'] as $gp ):
                    // if( $user['loginId'] == $this->global['profile']['loginId'] ):
                    if( $user['userId'] == $rid ):
                        foreach( $gp['countType'] as $gpTC ):
                            if( $gpTC['turnoverCount']==true ):
                                $TCplayerbet = $gpTC['playerBet'];
                                $TCplayerturnover = $gpTC['playerTurnover'];
                                $TCplayerwin = $gpTC['playerWin'];
                                $TCplayerwinlose = $gpTC['playerWinLose'];
                            endif;
                        endforeach;

                        $final_profitbet = floor($gp['profitByBet'] * 10000)/10000;
                        $final_profitturnover = floor($gp['profitByTurnover'] * 10000)/10000;

                        $playerwin = (float)$TCplayerwin<0 ? bcdiv($TCplayerwin, 1, 2) : bcdiv($TCplayerwin, 1, 2);
                        $playerwinlose = (float)$TCplayerwinlose<0 ? bcdiv($TCplayerwinlose, 1, 2) : bcdiv($TCplayerwinlose, 1, 2);
                        $profitbybet = (float)$final_profitbet<0 ? bcdiv($final_profitbet, 1,2) : bcdiv($final_profitbet, 1,2);
                        $profitbyturnover = (float)$final_profitturnover<0 ? bcdiv($final_profitturnover, 1,2) : bcdiv($final_profitturnover, 1,2);

                        $row = [];
                        $row[] = $gp['groupName'];
                        $row[] = bcdiv($TCplayerturnover,1,2);
                        $row[] = $profitbyturnover;
                        
                        foreach( $raw['data'] as $breakdown ):
                            $pselft = 0;
                            $pselfeff = 0;
                            $pturnover = 0;
                            $peffective = 0;
                            $nspp = 0;
                            if( $breakdown['profitByBet']!=0 || $breakdown['profitByTurnover']!=0 ):
                                foreach( $breakdown['data'] as $bgp ):
                                    $onet = 0;
                                    $onee = 0;
                                    $ones = 0;
                                    $oneseff = 0;
                                    // foreach( $raw['data'] as $down ):
                                    //     if( $down['profitByBet']!=0 || $down['profitByTurnover']!=0 ):
                                    //         foreach( $down['data'] as $downgp ):
                                    //             if( $down['loginId']!==$breakdown['loginId'] && $downgp['groupName']===$bgp['groupName'] ):
                                    //                 $onet += $downgp['profitByBet'];
                                    //                 $onee += $downgp['profitByTurnover'];
                                    //                 $ones += $downgp['playerBet'];
                                    //                 $oneseff += $downgp['playerTurnover'];
                                    //             endif;
                                    //         endforeach;
                                    //     endif;
                                    // endforeach;

                                    foreach( $raw['data'] as $down ):
                                        if( $down['profitByBet']!=0 || $down['profitByTurnover']!=0 ):
                                            foreach( $down['data'] as $downgp ):
                                                if( $down['loginId']!==$breakdown['loginId'] && $downgp['groupName']===$bgp['groupName'] ):
                                                    foreach( $downgp['countType'] as $ddgp ):
                                                        if( $ddgp['turnoverCount']==true ):
                                                        $onet += $downgp['profitByBet'];
                                                        $onee += $downgp['profitByTurnover'];
                                                        $ones += $ddgp['playerBet'];
                                                        $oneseff += $ddgp['playerTurnover'];
                                                        endif;
                                                    endforeach;
                                                endif;
                                            endforeach;
                                        endif;
                                    endforeach;

                                    if( $bgp['groupName']===$gp['groupName'] ):
                                        // if( $breakdown['loginId']===$this->global['profile']['loginId'] ):
                                        foreach( $bgp['countType'] as $bgpCT ):
                                            if( $bgpCT['turnoverCount']==true ):
                                                $bgpBet = $bgpCT['playerBet'];
                                                $bgpTurnover = $bgpCT['playerTurnover'];
                                            endif;
                                        endforeach;

                                        if( $breakdown['userId']===$rid ):
                                            $pselft = $bgpBet - $ones;
                                            $pselfeff = $bgpTurnover - $oneseff;
                                            $pturnover = $bgp['profitByBet'] - $onet;
                                            $peffective = $bgp['profitByTurnover'] - $onee;

                                            // $nspp += $pturnover;
                                            $nspp += $peffective;
                                        else:
                                            $pselft = $bgpBet;
                                            $pselfeff = $bgpTurnover;
                                            $pturnover = $bgp['profitByBet'];
                                            $peffective = $bgp['profitByTurnover'];

                                            $nspp += 0;
                                        endif;
                                    endif;
                                endforeach;

                                $final_pselft = floor($pselft * 10000)/10000;
                                $final_pselfeff = floor($pselfeff * 10000)/10000;
                                $final_pturnover = floor($pturnover * 10000)/10000;
                                $final_peffective = floor($peffective * 10000)/10000;
                                
                                $row[] = $breakdown['loginId'];
                                // $row[] = (float)$pselft>=0 ? bcdiv($final_pselft, 1, 2) : '0.00';
                                $row[] = (float)$pselfeff>=0 ? bcdiv($final_pselfeff, 1, 2) : '0.00';
                                $row[] = $bgp['psRate'].' / '.$raw['psPercentage'];
                                // $row[] = (float)$pturnover>=0 ? bcdiv($final_pturnover, 1, 2) : '<span class="text-danger">'.bcdiv($final_pturnover, 1, 2).'</span>';
                                $row[] = (float)$peffective>0 ? bcdiv($final_peffective, 1, 2) : '<span class="text-danger">'.bcdiv($final_peffective, 1, 2).'</span>';
                            endif;
                            $nettselfprofile += $nspp;
                        endforeach;
  
                        $data[] = $row;
                        
                        // $gpprofile += (float)$gp['profitByBet'];
                        $gpprofile += (float)$gp['profitByTurnover'];
                    endif;
                endforeach;
            endforeach;


            // Footer
            // $groupnett = floatval($gpprofile) - floatval($tt);
            // $nett = floatval($nettselfprofile) - floatval($selfturnover);
            $groupnett = floatval($gpprofile) - floatval($ss);
            $nett = floatval($nettselfprofile) - floatval($selfeffective);

            $final_groupnett = floor($groupnett * 10000)/10000;
            $final_nett = floor($nett * 10000)/10000;

            $groupnett_final = bcdiv($final_groupnett, 1, 2);
            $nett_final = bcdiv($final_nett, 1, 2);

            $row_groupnett = [];
            // $row_groupnett[] = null;
            // $row_groupnett[] = null;
            // $row_groupnett[] = null;
            $row_groupnett[] = '<b class="d-block text-end">'.lang('Label.groupnettprofit').':</b>';
            $row_groupnett[] = bcdiv($seffective,1,2);
            $row_groupnett[] = $groupnett_final;
            $data[] = $row_groupnett;

            $row_nett = [];
            $row_nett[] = null;
            // $row_nett[] = null;
            // $row_nett[] = null;
            $row_nett[] = '<b class="d-block text-end">'.lang('Label.nettprofit').':</b>';
            $row_nett[] = $nett_final.'<small class="d-block text-end text-danger">* '.lang('Label.scoredesc').'</small>';
            $data[] = $row_nett;

            echo json_encode(['code'=>1, 'data' => $data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function companySummaryV244()
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

        $refer = $this->request->getpost('parent') ? base64_decode($this->request->getpost('parent')) : $_SESSION['token'];
        $raw = $this->gameps_model->selectPsSummary(['userid'=>$refer, 'fromdate'=>$from, 'todate'=>$to]);
        // echo json_encode($raw);

        $order_by = array('Casino Group','Slot Group','Slot2 Group','Lottery Group','Sport Group','Keno Group');
        // $order_by = array('Casino Group','Slot Group','No GROUP','Lottery Group','Sport Group','Keno Group');
        usort($raw['companyGPData'], function($a,$b) use ($order_by) {
            $pos_a = array_search($a['groupName'], $order_by);
            $pos_b = array_search($b['groupName'], $order_by);
            return $pos_a - $pos_b;
        });
        // echo json_encode([$raw['companyGPData']]);
        // echo json_encode($raw);

        if( $raw['code']==1 && $raw['companyGPData']!=[] && $raw['data']!=[] ):
            $data = [];

            foreach( $raw['totalCountType'] as $tc ):
                if( $tc['turnoverCount']==true ):
                    $bet = $tc['totalBet'];
                    $turnover = $tc['totalTurnover'];
                    $win = $tc['totalWin'];
                endif;
            endforeach;

            $totalpayout = $win - $raw['totalJackpot'];
            $final_totalpayout = floor($totalpayout * 10000)/10000;

            $down = '<div class="collapse givechip pt-2">';
            $down .= '<table class="w-100 table table-sm table-bordered ms-auto"><tbody>';
            $down .= '<tr>';
            $down .= '<th class="text-dark">'.lang('Label.totalgivechip').':</th><td>'.bcdiv($raw['totalGiveChip'], 1, 2).'</td>';
            $down .= '</tr>';
            $down .= '<tr>';
            $down .= '<th class="text-dark">'.lang('Label.totaljackpot').':</th><td>'.bcdiv($raw['totalJackpot'], 1, 2).'</td>';
            $down .= '</tr>';
            $down .= '</tbody></table>';
            $down .= '</div>';

            $expense = '<span class="text-danger">-'.bcdiv($raw['expenses'], 1, 2).'</span>';

            $row_settle = [];
            $row_settle[] = '<b>'.lang('Label.expenses').'</b>';
            // $row_settle[] = bcdiv($bet, 1, 2);
            // $row_settle[] = bcdiv($final_totalpayout, 1, 2).$down;
            $row_settle[] = '';
            $row_settle[] = '';
            $row_settle[] = '-'.bcdiv($raw['expenses'], 1, 2);
            // $row_settle[] = $expense.'<a class="d-inline-block text-decoration-none ml-2" href="javascript:void(0);"><i class="las la-chevron-circle-down" data-bs-toggle="collapse" data-bs-target=".givechip"></i></a>';
            $data[] = $row_settle;

            $totalGroupBet = 0;
            $totalGroupTurnover = 0;
            $totalGroupWin = 0;
            $totalGroupGiveChip = 0;
            foreach( $raw['companyGPData'] as $c ):
                foreach( $c['totalCountType'] as $tct ):
                    if( $tct['turnoverCount']==true ):
                        $totalbet = $tct['totalBet'];
                        $totalturnover = $tct['totalTurnover'];
                        $totalwin = $tct['totalWin'];
                    endif;
                endforeach;

                $final_tprofit = floor($c['totalProfit'] * 10000)/10000;
                // $compwin = $totalwin - $c['totalGiveChip']; // original win
                $compwin = $final_tprofit - $totalturnover;

                if( $totalturnover>0 ):
                $row = [];
                $row[] = $c['groupName'];
                $row[] = $totalturnover;
                $row[] = $compwin;
                $row[] = $final_tprofit;

                foreach( $c['companyGPDataDetails'] as $cv ):
                    foreach( $cv['totalCountType'] as $game ):
                        if( $game['turnoverCount']==true ):
                            $gamebet = $game['totalBet'];
                            $gameturnover = $game['totalTurnover'];
                            $gamewin = $game['totalWin'];
                            $totalGroupBet += $gamebet;
                            $totalGroupTurnover += $gameturnover;
                            $totalGroupWin += $gamewin;
                        endif;
                    endforeach;

                    $final_gpprofit = floor($cv['totalProfit'] * 10000)/10000;

                    $gwin = $gamewin - $cv['totalGiveChip'];
                    // $finalGroupWin = floor($gwin * 10000)/10000;
                    $finalGroupWin = $final_gpprofit - $gameturnover;

                    $row[] = $cv['name'];
                    $row[] = $gameturnover;
                    $row[] = $finalGroupWin;
                    $row[] = $final_gpprofit;
                endforeach;

                $data[] = $row;

                // $totalGroupBet += $gamebet;
                // $totalGroupWin += $gwin;
                $totalGroupGiveChip += $c['totalGiveChip'];
                endif;
            endforeach;

            $settlement = 0;
            foreach( $raw['totalCountType'] as $cTC ):
                if( $cTC['turnoverCount']==TRUE ):
                    $settlement = $cTC['totalWinLose'] - $raw['totalGiveChip'];
                endif;
            endforeach;

            // $compSettleGroupWin = $totalGroupWin - $totalGroupGiveChip;
            $compSettleGroupWin = $settlement - $totalGroupTurnover;

            $rowSettlement = [];
            $rowSettlement[] = lang('Label.settlement');
            $rowSettlement[] = $totalGroupTurnover;
            $rowSettlement[] = $compSettleGroupWin;
            $rowSettlement[] = $settlement;
            $data[] = $rowSettlement;
            echo json_encode(['code'=>1, 'data' => $data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    // public function companySummaryV244()
    // {
    //     if( !session()->get('logged_in') ): return false; endif;

    //     $raw = json_decode(file_get_contents('php://input'),1);

    //     if( !empty($raw['start']) && !empty($raw['end']) ):
    //         $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($raw['start']))));
    //         $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($raw['end']))));
    //     else:
    //         $from = date('c', strtotime(date('Y-m-d 00:00:00')));
    //         $to = date('c', strtotime(date('Y-m-d 23:59:59')));
    //     endif;

    //     $refer = $this->request->getpost('parent') ? base64_decode($this->request->getpost('parent')) : $_SESSION['token'];
    //     $raw = $this->gameps_model->selectPsSummary(['userid'=>$refer, 'fromdate'=>$from, 'todate'=>$to]);
    //     // echo json_encode($raw);

    //     if( $raw['code'] == 1 && $raw['companyGPData'] != [] && $raw['data'] != [] ):
    //         $data = [];

    //         foreach( $raw['totalCountType'] as $tc ):
    //             if( $tc['turnoverCount']==true ):
    //                 $bet = $tc['totalBet'];
    //                 $turnover = $tc['totalTurnover'];
    //                 $win = $tc['totalWin'];
    //             endif;
    //         endforeach;

    //         $totalpayout = $win - $raw['totalJackpot'];
    //         $final_totalpayout = floor($totalpayout * 10000)/10000;

    //         $down = '<div class="collapse givechip pt-2">';
    //         $down .= '<table class="w-100 table table-sm table-bordered ms-auto"><tbody>';
    //         $down .= '<tr>';
    //         $down .= '<th class="text-dark">'.lang('Label.totalgivechip').':</th><td>'.bcdiv($raw['totalGiveChip'], 1, 2).'</td>';
    //         $down .= '</tr>';
    //         $down .= '<tr>';
    //         $down .= '<th class="text-dark">'.lang('Label.totaljackpot').':</th><td>'.bcdiv($raw['totalJackpot'], 1, 2).'</td>';
    //         $down .= '</tr>';
    //         $down .= '</tbody></table>';
    //         $down .= '</div>';

    //         $expense = '<span class="text-danger">-'.bcdiv($raw['expenses'], 1, 2).'</span>';

    //         $row_settle = [];
    //         $row_settle[] = '<b>'.lang('Label.expenses').'</b>';
    //         // $row_settle[] = bcdiv($bet, 1, 2);
    //         // $row_settle[] = bcdiv($final_totalpayout, 1, 2).$down;
    //         $row_settle[] = '';
    //         $row_settle[] = '';
    //         $row_settle[] = '-'.bcdiv($raw['expenses'], 1, 2);
    //         // $row_settle[] = $expense.'<a class="d-inline-block text-decoration-none ml-2" href="javascript:void(0);"><i class="las la-chevron-circle-down" data-bs-toggle="collapse" data-bs-target=".givechip"></i></a>';
    //         $data[] = $row_settle;

    //         $totalGroupBet = 0;
    //         $totalGroupTurnover = 0;
    //         $totalGroupWin = 0;
    //         $totalGroupGiveChip = 0;
    //         foreach( $raw['companyGPData'] as $c ):
    //             foreach( $c['totalCountType'] as $tct ):
    //                 if( $tct['turnoverCount']==true ):
    //                     $totalbet = $tct['totalBet'];
    //                     $totalturnover = $tct['totalTurnover'];
    //                     $totalwin = $tct['totalWin'];
    //                 endif;
    //             endforeach;

    //             $final_tprofit = floor($c['totalProfit'] * 10000)/10000;
    //             // $compwin = $totalwin - $c['totalGiveChip']; // original win
    //             $compwin = $final_tprofit - $totalturnover;

    //             if( $totalturnover>0 ):
    //             $row = [];
    //             $row[] = $c['groupName'];
    //             $row[] = $totalturnover;
    //             $row[] = $compwin;
    //             $row[] = $final_tprofit;

    //             foreach( $c['companyGPDataDetails'] as $cv ):
    //                 foreach( $cv['totalCountType'] as $game ):
    //                     if( $game['turnoverCount']==true ):
    //                         $gamebet = $game['totalBet'];
    //                         $gameturnover = $game['totalTurnover'];
    //                         $gamewin = $game['totalWin'];
    //                         $totalGroupBet += $gamebet;
    //                         $totalGroupTurnover += $gameturnover;
    //                         $totalGroupWin += $gamewin;
    //                     endif;
    //                 endforeach;

    //                 $final_gpprofit = floor($cv['totalProfit'] * 10000)/10000;

    //                 $gwin = $gamewin - $cv['totalGiveChip'];
    //                 // $finalGroupWin = floor($gwin * 10000)/10000;
    //                 $finalGroupWin = $final_gpprofit - $gameturnover;

    //                 $row[] = $cv['name'];
    //                 $row[] = $gameturnover;
    //                 $row[] = $finalGroupWin;
    //                 $row[] = $final_gpprofit;
    //             endforeach;

    //             $data[] = $row;

    //             // $totalGroupBet += $gamebet;
    //             // $totalGroupWin += $gwin;
    //             $totalGroupGiveChip += $c['totalGiveChip'];
    //             endif;
    //         endforeach;

    //         $settlement = 0;
    //         foreach( $raw['totalCountType'] as $cTC ):
    //             if( $cTC['turnoverCount']==TRUE ):
    //                 $settlement = $cTC['totalWinLose'] - $raw['totalGiveChip'];
    //             endif;
    //         endforeach;

    //         // $compSettleGroupWin = $totalGroupWin - $totalGroupGiveChip;
    //         $compSettleGroupWin = $settlement - $totalGroupTurnover;

    //         $rowSettlement = [];
    //         $rowSettlement[] = lang('Label.settlement');
    //         $rowSettlement[] = $totalGroupTurnover;
    //         $rowSettlement[] = $compSettleGroupWin;
    //         $rowSettlement[] = $settlement;
    //         $data[] = $rowSettlement;
    //         echo json_encode(['code'=>1, 'data' => $data]);
    //     else:
    //         echo json_encode(['no data']);
    //     endif;
    // }
    // 44

    public function adminDirectMemberSummary()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $rawProfile = $this->user_model->selectUser(['userid' => $_SESSION['token']]);
        $directUpline = $rawProfile['data']['agentId'];

        $rawSource = json_decode(file_get_contents('php://input'),1);

        if( !empty($rawSource['start']) && !empty($rawSource['end']) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($rawSource['start']))));
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($rawSource['end']))));
        else:
            $from = date('c', strtotime(date('Y-m-d 00:00:00')));
            $to = date('c', strtotime(date('Y-m-d 23:59:59')));
        endif;

        $refer = $rawSource['parent'] ? base64_decode($rawSource['parent']) : $_SESSION['token'];
        $raw = $this->gameps_model->selectPsSummary(['userid'=>$refer, 'fromdate'=>$from, 'todate'=>$to]);
        // echo json_encode($raw);

        if( $raw['code']==1 && $raw['data']!=[] ):
            $data = [];

            // Upline Shares
            $uplineShares = $raw['data'][0]['expensesPSRate'];
            // End Upline Shares

            foreach( $raw['companyGPData'] as $general ):
                $row = [];
                $row[] = $general['groupName'];

                // Company
                $compBet = 0;
                $compEff = 0;
                $compWinlose = 0;
                $groupBet = 0;
                $groupEff = 0;
                $groupWinlose = 0;
                $groupCompProfit = 0;
                foreach( $raw['companyGPData'] as $comp ):
                    // Company Total
                    foreach( $comp['totalCountType'] as $t ):
                        if( $t['turnoverCount']==true ):
                            $compBet += $t['totalBet'];
                            $compEff += $t['totalTurnover'];
                            $compWinlose += $t['totalWinLose'];
                        endif;
                    endforeach;
                    // End Company Total

                    // Group Details
                    if( $comp['groupName']===$general['groupName'] ):
                        foreach( $comp['totalCountType'] as $d ):
                            if( $d['turnoverCount']==true ):
                                $groupBet += $d['totalBet'];
                                $groupEff += $d['totalTurnover'];
                                $groupWinlose += $d['totalWinLose'];
                            endif;
                        endforeach;
                    endif;
                    $groupCompProfit = $comp['totalProfit'];
                    // End Group Details
                endforeach;
                // End Company

                $groupProfit = 0;
                $nettExpenses = 0;

                $groupPlayerBet = 0;
                $groupPlayerEff = 0;
                $groupPlayerWinlose = 0;
                foreach($raw['data'] as $m):
                    $playerBet = 0;
                    $playerEff = 0;
                    $playerWinlose = 0;
                    $playerExpenses = 0;
                    if( $m['role']==4 && $m['expensesWeightByBet']>0 ):
                        foreach( $m['data'] as $group ):
                            if( $group['groupName']==$general['groupName'] ):
                                // Player
                                foreach( $group['countType'] as $ct ):
                                    if( $ct['turnoverCount']==true ):
                                        $playerBet += $ct['playerBet'];
                                        $playerEff += $ct['playerTurnover'];
                                        $playerWinlose += $ct['playerWinLose'];
                                    endif;
                                endforeach;
                                // End Player
                            endif;
                        endforeach;
                    endif;

                    $groupPlayerBet += $playerBet;
                    $groupPlayerEff += $playerEff;
                    $groupPlayerWinlose += $playerWinlose;
                endforeach;

                $playerWeight = $groupPlayerBet / $groupBet;
                $groupProfit += $general['totalProfit']/$raw['psPercentage']*$uplineShares*$playerWeight;

                // Expenses
                $weight = $groupPlayerBet / $compBet;
                $nettExpenses += $raw['expenses']/$raw['psPercentage']*$uplineShares*$weight;
                // End Expenses

                // Owner Nett Profit
                $groupOwnerNett = $groupProfit - $nettExpenses;
                // End Owner Nett Profit

                $row[] = $groupPlayerBet;
                $row[] = $uplineShares.'/'.$raw['psPercentage'];
                // $row[] = $general['totalProfit'].'=='.$groupBet.'=='.$compBet;
                // $row[] = $groupPlayerWinlose;
                $row[] = $groupProfit;
                $row[] = $nettExpenses;
                $row[] = $groupOwnerNett;
                $data[] = $row;
            endforeach;
            echo json_encode(['code'=>1, 'data' => $data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function adminSummaryV2()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $rawProfile = $this->user_model->selectUser(['userid' => $_SESSION['token']]);
        $directUpline = $rawProfile['data']['agentId'];

        $rawSource = json_decode(file_get_contents('php://input'),1);

        if( !empty($rawSource['start']) && !empty($rawSource['end']) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($rawSource['start']))));
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($rawSource['end']))));
        else:
            $from = date('c', strtotime(date('Y-m-d 00:00:00')));
            $to = date('c', strtotime(date('Y-m-d 23:59:59')));
        endif;

        $refer = $rawSource['parent'] ? base64_decode($rawSource['parent']) : $_SESSION['token'];
        $raw = $this->gameps_model->selectPsSummary(['userid'=>$refer, 'fromdate'=>$from, 'todate'=>$to]);
        // echo json_encode($raw);

        if( $_SESSION['role']==5 && $_SESSION['uplinerole']==3 ):
            $rid = $directUpline;
        elseif( $_SESSION['role']==2 || $_SESSION['role']==3 || ($_SESSION['role']==5 && $_SESSION['uplinerole']==2) ):
            $rid = base64_decode($rawSource['parent']);
        else:
            $rid = $_SESSION['token'];
        endif;

        if( $raw['code'] == 1 &&  $raw['data'] != [] ):
            $data = [];

            // Upline Shares
            $uplineShares = $raw['data'][0]['expensesPSRate'];
            // End Upline Shares

            // Company Expenses Summary
            $compExpBet = 0;
            $compExpEff = 0;
            $compExpWinlose = 0;
            $compExpProfit = 0;
            foreach( $raw['companyGPData'] as $sumExpComp ):
                foreach( $sumExpComp['totalCountType'] as $sumExpCompTC ):
                    if( $sumExpCompTC['turnoverCount']==TRUE ):
                        $compExpBet += $sumExpCompTC['totalBet'];
                        $compExpEff += $sumExpCompTC['totalTurnover'];
                        $compExpWinlose += $sumExpCompTC['totalWinLose'];
                    endif;
                endforeach;
                $compExpProfit += $sumExpComp['totalProfit'];
            endforeach;
            // End Company Expenses Summary

            // Settlement
            $sumAllExpensesBet = 0;
            $sumAllUserExpenses = 0;
            foreach( $raw['data'] as $sumExpUser ):
                if( $sumExpUser['role']==3 ):
                    // Sub-Loop User Expenses Sum
                    $sumExpUserBet = 0;
                    $sumExpUserEff = 0;
                    foreach( $raw['data'] as $sumExpUserLoop ):
                        if( $sumExpUserLoop['userId']===$sumExpUser['userId'] && $sumExpUserLoop['userId']!==$rid ):
                            foreach( $sumExpUserLoop['data'] as $sumExpUserGroup ):
                                foreach( $sumExpUserGroup['countType'] as $sumExpGroupTC ):
                                    if( $sumExpGroupTC['turnoverCount']==TRUE ):
                                        $sumExpUserBet += $sumExpGroupTC['playerBet'];
                                        $sumExpUserEff += $sumExpGroupTC['playerTurnover'];
                                    endif;
                                endforeach;
                            endforeach;
                        elseif( $sumExpUserLoop['userId']===$sumExpUser['userId'] && $sumExpUserLoop['userId']===$rid ):
                            foreach( $raw['data'] as $sumExpUplinePlayerLoop ):
                                if( $sumExpUplinePlayerLoop['role']==4 ):
                                    foreach( $sumExpUplinePlayerLoop['data'] as $sumExpUplinePlayerGroup ):
                                        foreach( $sumExpUplinePlayerGroup['countType'] as $sumExpUplineGroupTC ):
                                            if( $sumExpUplineGroupTC['turnoverCount']==TRUE ):
                                                $sumExpUserBet += $sumExpUplineGroupTC['playerBet'];
                                                $sumExpUserEff += $sumExpUplineGroupTC['playerTurnover'];
                                            endif;
                                        endforeach;
                                    endforeach;
                                endif;
                            endforeach;
                        endif;
                    endforeach;
                    // End Sub-Loop User Expenses Sum

                    if( $sumExpUser['userId']===$rid ):
                        $sumExpShares2Upline = $uplineShares;
                    else:
                        $sumExpShares2Upline = $uplineShares - $sumExpUser['expensesPSRate'];
                    endif;

                    $sumExpWeight = $sumExpUserBet / $compExpBet;
                    $sumExpUserTook = ($raw['expenses']+$raw['totalJackpot']) / $raw['psPercentage'] * $sumExpShares2Upline * $sumExpWeight;
                    $roundSumExpUserTook = floor($sumExpUserTook * 10000)/10000;

                    $sumAllExpensesBet += $sumExpUserBet;
                    $sumAllUserExpenses += $roundSumExpUserTook;
                endif;
            endforeach;

            $roundSumAllUserExpenses = floor($sumAllUserExpenses * 10000)/10000;

            $rowExp = [];
            $rowExp[] = '<b>'.lang('Label.expenses').'</b>';
            $rowExp[] = bcdiv($sumAllExpensesBet,1,2);
            $rowExp[] = '-'.bcdiv($roundSumAllUserExpenses, 1, 2);

            // Expenses
            foreach( $raw['data'] as $expUser ):
                if( $expUser['role']==3 ):
                    // Sub-Loop User Bet
                    $expUserBet = 0;
                    $expUserEff = 0;
                    foreach( $raw['data'] as $expUserLoop ):
                        if( $expUserLoop['userId']===$expUser['userId'] && $expUserLoop['userId']!==$rid ):
                            foreach( $expUserLoop['data'] as $expUserGroup ):
                                foreach( $expUserGroup['countType'] as $expGroupTC ):
                                    if( $expGroupTC['turnoverCount']==TRUE ):
                                        $expUserBet += $expGroupTC['playerBet'];
                                        $expUserEff += $expGroupTC['playerTurnover'];
                                    endif;
                                endforeach;
                            endforeach;
                        elseif( $expUserLoop['userId']===$expUser['userId'] && $expUserLoop['userId']===$rid ):
                            foreach( $raw['data'] as $expUplinePlayerLoop ):
                                if( $expUplinePlayerLoop['role']==4 ):
                                    foreach( $expUplinePlayerLoop['data'] as $expUplinePlayerGroup ):
                                        foreach( $expUplinePlayerGroup['countType'] as $expUplineGroupTC ):
                                            if( $expUplineGroupTC['turnoverCount']==TRUE ):
                                                $expUserBet += $expUplineGroupTC['playerBet'];
                                                $expUserEff += $expUplineGroupTC['playerTurnover'];
                                            endif;
                                        endforeach;
                                    endforeach;
                                endif;
                            endforeach;
                        endif;
                    endforeach;
                    // End Sub-Loop User Bet

                    if( $expUser['userId']===$rid ):
                        $expShares2Upline = $uplineShares;
                    else:
                        $expShares2Upline = $uplineShares - $expUser['expensesPSRate'];
                    endif;

                    $expWeight = $expUserBet / $compExpBet;
                    $expUserTook = ($raw['expenses']+$raw['totalJackpot']) / $raw['psPercentage'] * $expShares2Upline * $expWeight;
                    $roundExpUserTook = floor($expUserTook * 10000)/10000;

                    $rowExp[] = $expUser['loginId'];
                    $rowExp[] = '-';
                    $rowExp[] = $expShares2Upline.'/'.$raw['psPercentage'];
                    $rowExp[] = bcdiv($roundExpUserTook,1,2);
                endif;
            endforeach;
            $data[] = $rowExp;
            // End Expenses
            // End Settlement

            // Game Group
            $sumAllGroupProfit = 0;
            foreach( $raw['companyGPData'] as $compGroup ):
                // Company Group Summary
                $compGroupBet = 0;
                $compGroupEff = 0;
                $compGroupWinlose = 0;
                $compGroupProfit = 0;
                foreach( $raw['companyGPData'] as $sumComp ):
                    if( $sumComp['groupName']===$compGroup['groupName'] ):
                        foreach( $sumComp['totalCountType'] as $sumCompTC ):
                            if( $sumCompTC['turnoverCount']==TRUE ):
                                $compGroupBet = $sumCompTC['totalBet'];
                                $compGroupEff = $sumCompTC['totalTurnover'];
                                $compGroupWinlose = $sumCompTC['totalWinLose'];
                            endif;
                        endforeach;
                        $compGroupProfit = $sumComp['totalProfit'];
                    endif;
                endforeach;
                // End Company Group Summary

                // Sum User Game Group
                $sumUserGroupBet = 0;
                $sumUserGroupEff = 0;
                foreach( $raw['data'] as $sumUser ):
                    if( $sumUser['userId']===$rid ):
                        foreach( $sumUser['data'] as $sumGroup ):
                            if( $sumGroup['groupName']===$compGroup['groupName'] ):
                                foreach( $sumGroup['countType'] as $compUgTC ):
                                    if( $compUgTC['turnoverCount']==TRUE ):
                                        $sumUserGroupBet += $compUgTC['playerBet'];
                                        $sumUserGroupEff += $compUgTC['playerTurnover'];
                                    endif;
                                endforeach;
                            endif;
                        endforeach;
                    endif;
                endforeach;
                // End Sum User Game Group

                // Sub-Loop Other Users for Upline
                $dwGroupProfit = 0;
                foreach( $raw['data'] as $userUpline ):
                    foreach( $userUpline['data'] as $groupUpline ):
                        if( $groupUpline['groupName']===$compGroup['groupName'] ):
                            foreach( $groupUpline['countType'] as $ugTCUpline ):
                                if( $ugTCUpline['turnoverCount']==TRUE ):
                                    if( $userUpline['userId']!==$rid ): 
                                        $user2UplineSharesUpline = $uplineShares - $userUpline['expensesPSRate'];
                                        $userGroupWeightUpline = $ugTCUpline['playerBet'] / $compGroupBet;
                                        $userGroupProfitUpline = $compGroupProfit / $raw['psPercentage'] * $user2UplineSharesUpline * $userGroupWeightUpline;
                                    else: 
                                        $uplineSalesUpline = $sumUserGroupBet - $ugTCUpline['playerBet'];
                                        $userGroupWeightUpline = $uplineSalesUpline / $compGroupBet;
                                        $userGroupProfitUpline = $compGroupProfit / $raw['psPercentage'] * $uplineShares * $userGroupWeightUpline;
                                    endif;
                                    $dwGroupProfit += $userGroupProfitUpline;
                                endif;
                            endforeach;
                        endif;
                    endforeach;
                endforeach;
                // End Sub-Loop Other Users for Upline

                $roundDwGroupProfit = floor($dwGroupProfit * 10000)/10000;

                if( $sumUserGroupBet>0 ):
                    $rowGroup = [];
                    $rowGroup[] = $compGroup['groupName'];
                    $rowGroup[] = bcdiv($sumUserGroupBet,1,2);
                    $rowGroup[] = bcdiv($roundDwGroupProfit,1,2);
                    
                    // User Game Group
                    foreach( $raw['data'] as $user ):
                        if( $user['role']==3 ):
                            foreach( $user['data'] as $group ):
                                if( $group['groupName']===$compGroup['groupName'] ):
                                    foreach( $group['countType'] as $ugTC ):
                                        if( $ugTC['turnoverCount']==TRUE ):
                                            $rowGroup[] = $user['loginId'];

                                            // Non Upline
                                            if( $user['userId']!==$rid ): 
                                                $user2UplineShares = $uplineShares - $user['expensesPSRate'];
                                                $userGroupWeight = $ugTC['playerBet'] / $compGroupBet;
                                                $userGroupProfit = ($compGroupProfit / $raw['psPercentage']) * $user2UplineShares * $userGroupWeight;
                                                $roundUserGroupProfit = floor($userGroupProfit * 10000)/10000;

                                                $rowGroup[] = bcdiv($ugTC['playerBet'],1,2);
                                                $rowGroup[] = $user2UplineShares.'/'.$raw['psPercentage'];
                                                $rowGroup[] = bcdiv($roundUserGroupProfit,1,2);
                                            else:
                                            // Upline
                                                // Self Player
                                                $UplinePlayerBet = 0;
                                                $UplinePlayerEff = 0;
                                                foreach( $raw['data'] as $p ):
                                                    if( $p['role']==4 ):
                                                        foreach( $p['data'] as $b ):
                                                            if( $b['groupName']===$compGroup['groupName'] ):
                                                                foreach( $b['countType'] as $playerTC ):
                                                                    if( $playerTC['turnoverCount']==TRUE ):
                                                                        $UplinePlayerBet += $playerTC['playerBet'];
                                                                        $UplinePlayerEff += $playerTC['playerTurnover'];
                                                                    endif;
                                                                endforeach;
                                                            endif;
                                                        endforeach;
                                                    endif;
                                                endforeach;
                                                // End Self Player

                                                $uplineSales = $UplinePlayerBet;
                                                $userGroupWeight = $uplineSales / $compGroupBet;
                                                $userGroupProfit = ($compGroupProfit / $raw['psPercentage']) * $uplineShares * $userGroupWeight;

                                                $rowGroup[] = bcdiv($uplineSales,1,2);
                                                $rowGroup[] = $uplineShares.'/'.$raw['psPercentage'];
                                                $rowGroup[] = bcdiv($userGroupProfit,1,2);
                                            endif;
                                        endif;
                                    endforeach;
                                endif;
                            endforeach;
                        endif;
                    endforeach;
                    // End User Game Group
                    $data[] = $rowGroup;
                endif;
                $sumAllGroupProfit += $dwGroupProfit;
            endforeach;
            // End Game Group

            // Nett Summary
            $agentNett = $sumAllGroupProfit - $sumAllUserExpenses;
            // End Nett Summary

            $rowUserNett = [];
            $rowUserNett[] = null;
            $rowUserNett[] = '<b class="d-block text-end">'.lang('Label.nettprofit').':</b>';
            $rowUserNett[] = bcdiv($agentNett,1,2).'<small class="w-100 d-block text-end text-danger">* '.lang('Label.scoredesc').'</small>';

            $data[] = $rowUserNett;
            echo json_encode(['code'=>1, 'data' => $data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function adminSummary()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $rawProfile = $this->user_model->selectUser(['userid' => $_SESSION['token']]);
        $directUpline = $rawProfile['data']['agentId'];

        $rawSource = json_decode(file_get_contents('php://input'),1);
        // echo json_encode($rawSource);
        if( !empty($rawSource['start']) && !empty($rawSource['end']) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($rawSource['start']))));
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($rawSource['end']))));
        else:
            $from = date('c', strtotime(date('Y-m-d 00:00:00')));
            $to = date('c', strtotime(date('Y-m-d 23:59:59')));
        endif;

        $refer = isset($rawSource['parent']) ? base64_decode($rawSource['parent']) : $_SESSION['token'];
        $raw = $this->gameps_model->selectPsSummary(['userid'=>$refer, 'fromdate'=>$from, 'todate'=>$to]);
        // echo json_encode($raw);

        if( $_SESSION['role']==5 && $_SESSION['uplinerole']==3 ):
            $rid = $directUpline;
        elseif( $_SESSION['role']==2 || $_SESSION['role']==3 || ($_SESSION['role']==5 && $_SESSION['uplinerole']==2) ):
            $rid = base64_decode($rawSource['parent']);
        else:
            $rid = $_SESSION['token'];
        endif;

        if( $raw['code'] == 1 &&  $raw['data'] != [] ):
            $data = [];

            // Settlement
            $sturnover = 0;
            $seffective = 0;
            $swin = 0;
            $swinlose = 0;
            $sprofitturnover = 0;
            $sprofiteffective = 0;

            $selfturnover = 0;
            $selfeffective = 0;

            foreach($raw['data'] as $settleuser):
                foreach($settleuser['data'] as $settle):
                    // if( $settleuser['loginId']===$this->global['profile']['loginId'] ):
                    if( $settleuser['userId']===$rid ):
                        foreach($settle['countType'] as $settleCT):
                            if( $settleCT['turnoverCount']==true ):
                                $sturnover += $settleCT['playerBet'];
                                $seffective += $settleCT['playerTurnover'];
                                $swin += $settleCT['playerWin'];
                                $swinlose += $settleCT['playerWinLose'];
                            endif;
                        endforeach;

                        $sprofitturnover += $settle['profitByBet'];
                        $sprofiteffective += $settle['profitByTurnover'];
                    endif;
                endforeach;

                // if( $settleuser['loginId']===$this->global['profile']['loginId'] ):
                if( $settleuser['userId']===$rid ):
                    $tt = $settleuser['expensesByBet'];
                    $ss = $settleuser['expensesByTurnover'];
                endif;
            endforeach;

            $final_tt = floor($tt * 10000)/10000;
            $final_ss = floor($ss * 10000)/10000;

            $row_settle = [];
            $row_settle[] = '<b>'.lang('Label.settlement').'</button>';
            $row_settle[] = bcdiv($sturnover, 1, 2);
            $row_settle[] = '-'.bcdiv($final_tt, 1, 2);

            // Expenses
            $eself_turnover = 0;
            $eself_effective = 0;
            foreach($raw['data'] as $euser):
                if( $euser['expensesByBet']!=0 || $euser['expensesByTurnover']!=0 ):
                    // if( $euser['loginId']===$this->global['profile']['loginId'] ):
                    if( $euser['userId']===$rid ):
                        foreach($raw['data'] as $eself):
                            // if( $eself['loginId']!==$this->global['profile']['loginId'] ):
                            if( $eself['userId']!==$rid ):
                                $eself_turnover += $eself['expensesByBet'];
                                $eself_effective += $eself['expensesByTurnover'];
                            endif;
                        endforeach;
                        $selfturnover = $euser['expensesByBet'] - $eself_turnover;
                        $selfeffective = $euser['expensesByTurnover'] - $eself_effective;
                        $final_selfturnover = floor($selfturnover * 10000)/10000;
                        $final_selfeffective = floor($selfeffective * 10000)/10000;

                        $row_settle[] = $euser['loginId'];
                        $row_settle[] = '<span class="d-block text-center">-</span>';
                        $row_settle[] = $euser['expensesPSRate'].' / 130';
                        $row_settle[] = '<span class="text-danger">'.bcdiv($final_selfturnover, 1, 2).'</span>';
                    else:
                        $final_eusexpense = floor($euser['expensesByBet'] * 10000)/10000;

                        $row_settle[] = $euser['loginId'];
                        $row_settle[] = '<span class="d-block text-center">-</span>';
                        $row_settle[] = $euser['expensesPSRate'].' / 130';
                        $row_settle[] = '<span class="text-danger">'.bcdiv($final_eusexpense,1,2).'</span>';
                    endif;
                endif;
            endforeach;
            $data[] = $row_settle;
            
            // Game Provider
            $gpprofile = 0;
            $nettselfprofile = 0;
            foreach( $raw['data'] as $user ):
                foreach( $user['data'] as $gp ):
                    // if( $user['loginId'] == $this->global['profile']['loginId'] ):
                    if( $user['userId'] == $rid ):
                        foreach( $gp['countType'] as $gpTC ):
                            if( $gpTC['turnoverCount']==true ):
                                $TCplayerbet = $gpTC['playerBet'];
                                $TCplayerwin = $gpTC['playerWin'];
                                $TCplayerwinlose = $gpTC['playerWinLose'];
                            endif;
                        endforeach;

                        $final_profitbet = floor($gp['profitByBet'] * 10000)/10000;
                        $final_profitturnover = floor($gp['profitByTurnover'] * 10000)/10000;

                        $playerwin = (float)$TCplayerwin<0 ? '<span class="text-danger">'.bcdiv($TCplayerwin, 1, 2).'</span>' : bcdiv($TCplayerwin, 1, 2);
                        $playerwinlose = (float)$TCplayerwinlose<0 ? '<span class="text-danger">'.bcdiv($TCplayerwinlose, 1, 2).'</span>' : bcdiv($TCplayerwinlose, 1, 2);
                        $profitbybet = (float)$final_profitbet<0 ? '<span class="text-danger">'.bcdiv($final_profitbet, 1,2).'</span>' : bcdiv($final_profitbet, 1,2);
                        $profitbyturnover = (float)$final_profitturnover<0 ? '<span class="text-danger">'.bcdiv($final_profitturnover, 1,2).'</span>' : bcdiv($final_profitturnover, 1,2);

                        $row = [];
                        $row[] = $gp['groupName'];
                        $row[] = bcdiv($TCplayerbet, 1, 2);
                        $row[] = $profitbybet;
                        
                        foreach( $raw['data'] as $breakdown ):
                            $pselft = 0;
                            $pselfeff = 0;
                            $pturnover = 0;
                            $peffective = 0;
                            $nspp = 0;
                            if( $breakdown['profitByBet']!=0 || $breakdown['profitByTurnover']!=0 ):
                                foreach( $breakdown['data'] as $bgp ):
                                    $onet = 0;
                                    $onee = 0;
                                    $ones = 0;
                                    $oneseff = 0;
                                    // foreach( $raw['data'] as $down ):
                                    //     if( $down['profitByBet']!=0 || $down['profitByTurnover']!=0 ):
                                    //         foreach( $down['data'] as $downgp ):
                                    //             if( $down['loginId']!==$breakdown['loginId'] && $downgp['groupName']===$bgp['groupName'] ):
                                    //                 $onet += $downgp['profitByBet'];
                                    //                 $onee += $downgp['profitByTurnover'];
                                    //                 $ones += $downgp['playerBet'];
                                    //                 $oneseff += $downgp['playerTurnover'];
                                    //             endif;
                                    //         endforeach;
                                    //     endif;
                                    // endforeach;

                                    foreach( $raw['data'] as $down ):
                                        if( $down['profitByBet']!=0 || $down['profitByTurnover']!=0 ):
                                            foreach( $down['data'] as $downgp ):
                                                if( $down['loginId']!==$breakdown['loginId'] && $downgp['groupName']===$bgp['groupName'] ):
                                                    foreach( $downgp['countType'] as $ddgp ):
                                                        if( $ddgp['turnoverCount']==true ):
                                                        $onet += $downgp['profitByBet'];
                                                        $onee += $downgp['profitByTurnover'];
                                                        $ones += $ddgp['playerBet'];
                                                        $oneseff += $ddgp['playerTurnover'];
                                                        endif;
                                                    endforeach;
                                                endif;
                                            endforeach;
                                        endif;
                                    endforeach;

                                    if( $bgp['groupName']===$gp['groupName'] ):
                                        // if( $breakdown['loginId']===$this->global['profile']['loginId'] ):
                                        foreach( $bgp['countType'] as $bgpCT ):
                                            if( $bgpCT['turnoverCount']==true ):
                                                $bgpBet = $bgpCT['playerBet'];
                                                $bgpTurnover = $bgpCT['playerTurnover'];
                                            endif;
                                        endforeach;

                                        if( $breakdown['userId']===$rid ):
                                            $pselft = $bgpBet - $ones;
                                            $pselfeff = $bgpTurnover - $oneseff;
                                            $pturnover = $bgp['profitByBet'] - $onet;
                                            $peffective = $bgp['profitByTurnover'] - $onee;

                                            $nspp += $pturnover;
                                            // $nspp += $peffective;
                                        else:
                                            $pselft = $bgpBet;
                                            $pselfeff = $bgpTurnover;
                                            $pturnover = $bgp['profitByBet'];
                                            $peffective = $bgp['profitByTurnover'];

                                            $nspp += 0;
                                        endif;
                                    endif;
                                endforeach;

                                $final_pselft = floor($pselft * 10000)/10000;
                                $final_pselfeff = floor($pselfeff * 10000)/10000;
                                $final_pturnover = floor($pturnover * 10000)/10000;
                                $final_peffective = floor($peffective * 10000)/10000;
                                
                                $row[] = $breakdown['loginId'];
                                $row[] = (float)$pselft>=0 ? bcdiv($final_pselft, 1, 2) : '0.00';
                                // $row[] = (float)$pselfeff>=0 ? bcdiv($final_pselfeff, 1, 2) : '0.00';
                                $row[] = $bgp['psRate'].' / '.$raw['psPercentage'];
                                $row[] = (float)$pturnover>=0 ? bcdiv($final_pturnover, 1, 2) : '<span class="text-danger">'.bcdiv($final_pturnover, 1, 2).'</span>';
                                // $row[] = (float)$peffective>0 ? bcdiv($final_peffective, 1, 2) : '<span class="text-danger">'.bcdiv($final_peffective, 1, 2).'</span>';
                            endif;
                            $nettselfprofile += $nspp;
                        endforeach;
  
                        $data[] = $row;
                        
                        $gpprofile += (float)$gp['profitByBet'];
                        // $gpprofile += (float)$gp['profitByTurnover'];
                    endif;
                endforeach;
            endforeach;

            // Footer
            $groupnett = floatval($gpprofile) - floatval($tt);
            $nett = floatval($nettselfprofile) - floatval($selfturnover);
            // $groupnett = floatval($gpprofile) - floatval($ss);
            // $nett = floatval($nettselfprofile) - floatval($selfeffective);

            $final_groupnett = floor($groupnett * 10000)/10000;
            $final_nett = floor($nett * 10000)/10000;

            $groupnett_final = bcdiv($final_groupnett, 1, 2);
            $nett_final = bcdiv($final_nett, 1, 2);

            $row_groupnett = [];
            $row_groupnett[] = null;
            // $row_groupnett[] = null;
            // $row_groupnett[] = null;
            $row_groupnett[] = '<b class="d-block text-end">'.lang('Label.groupnettprofit').':</b>';
            $row_groupnett[] = $groupnett_final;
            $data[] = $row_groupnett;

            $row_nett = [];
            $row_nett[] = null;
            // $row_nett[] = null;
            // $row_nett[] = null;
            $row_nett[] = '<b class="d-block text-end">'.lang('Label.nettprofit').':</b>';
            $row_nett[] = $nett_final.'<small class="d-block text-end text-danger">* '.lang('Label.scoredesc').'</small>';
            $data[] = $row_nett;

            echo json_encode(['code'=>1, 'data' => $data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function adminSummaryOri()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $rawProfile = $this->user_model->selectUser(['userid' => $_SESSION['token']]);
        $directUpline = $rawProfile['data']['agentId'];

        $rawSource = json_decode(file_get_contents('php://input'),1);
        // echo json_encode($rawSource);
        if( !empty($rawSource['start']) && !empty($rawSource['end']) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($rawSource['start']))));
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($rawSource['end']))));
        else:
            $from = date('c', strtotime(date('Y-m-d 00:00:00')));
            $to = date('c', strtotime(date('Y-m-d 23:59:59')));
        endif;

        $refer = isset($rawSource['parent']) ? base64_decode($rawSource['parent']) : $_SESSION['token'];
        $raw = $this->gameps_model->selectPsSummary(['userid'=>$refer, 'fromdate'=>$from, 'todate'=>$to]);
        // echo json_encode($raw);

        $rid = $_SESSION['role']==5 && $_SESSION['uplinerole']==3 ?  $directUpline : $_SESSION['token'];

        if( $_SESSION['role']==5 && $_SESSION['uplinerole']==3 ):
            $rid = $directUpline;
        elseif( $_SESSION['role']==2 || ($_SESSION['role']==5 && $_SESSION['uplinerole']==2) ):
            $rid = base64_decode($rawSource['parent']);
        else:
            $rid = $_SESSION['token'];
        endif;

        if( $raw['code'] == 1 &&  $raw['data'] != [] ):
            $data = [];

            // Settlement
            $sturnover = 0;
            $seffective = 0;
            $swin = 0;
            $swinlose = 0;
            $sprofitturnover = 0;
            $sprofiteffective = 0;

            $selfturnover = 0;
            $selfeffective = 0;

            foreach($raw['data'] as $settleuser):
                foreach($settleuser['data'] as $settle):
                    // if( $settleuser['loginId']===$this->global['profile']['loginId'] ):
                    if( $settleuser['userId']===$rid ):
                        foreach($settle['countType'] as $settleCT):
                            if( $settleCT['turnoverCount']==true ):
                                $sturnover += $settleCT['playerBet'];
                                $seffective += $settleCT['playerTurnover'];
                                $swin += $settleCT['playerWin'];
                                $swinlose += $settleCT['playerWinLose'];
                            endif;
                        endforeach;

                        $sprofitturnover += $settle['profitByBet'];
                        $sprofiteffective += $settle['profitByTurnover'];
                    endif;
                endforeach;

                // if( $settleuser['loginId']===$this->global['profile']['loginId'] ):
                if( $settleuser['userId']===$rid ):
                    $tt = $settleuser['expensesByBet'];
                    $ss = $settleuser['expensesByTurnover'];
                endif;
            endforeach;

            $final_tt = floor($tt * 10000)/10000;
            $final_ss = floor($ss * 10000)/10000;

            $row_settle = [];
            $row_settle[] = '<b>'.lang('Label.settlement').'</button>';
            $row_settle[] = bcdiv($sturnover, 1, 2);
            $row_settle[] = '-'.bcdiv($final_ss, 1, 2);

            // Expenses
            $eself_turnover = 0;
            $eself_effective = 0;
            foreach($raw['data'] as $euser):
                if( $euser['expensesByBet']!=0 || $euser['expensesByTurnover']!=0 ):
                    // if( $euser['loginId']===$this->global['profile']['loginId'] ):
                    if( $euser['userId']===$rid ):
                        foreach($raw['data'] as $eself):
                            // if( $eself['loginId']!==$this->global['profile']['loginId'] ):
                            if( $eself['userId']!==$rid ):
                                $eself_turnover += $eself['expensesByBet'];
                                $eself_effective += $eself['expensesByTurnover'];
                            endif;
                        endforeach;
                        $selfturnover = $euser['expensesByBet'] - $eself_turnover;
                        $selfeffective = $euser['expensesByTurnover'] - $eself_effective;
                        $final_selfturnover = floor($selfturnover * 10000)/10000;
                        $final_selfeffective = floor($selfeffective * 10000)/10000;

                        $row_settle[] = $euser['loginId'];
                        $row_settle[] = '<span class="d-block text-center">-</span>';
                        $row_settle[] = $euser['expensesPSRate'].' / 130';
                        // $row_settle[] = '<span class="text-danger">'.bcdiv($final_selfturnover, 1, 2).'</span>';
                        $row_settle[] = '<span class="text-danger">'.bcdiv($final_selfeffective, 1, 2).'</span>';
                    else:
                        $final_eusexpense = floor($euser['expensesByBet'] * 10000)/10000;
                        $final_euseffexpense = floor($euser['expensesByTurnover'] * 10000)/10000;

                        $row_settle[] = $euser['loginId'];
                        $row_settle[] = '<span class="d-block text-center">-</span>';
                        $row_settle[] = $euser['expensesPSRate'].' / 130';
                        // $row_settle[] = '<span class="text-danger">'.bcdiv($final_eusexpense,1,2).'</span>';
                        $row_settle[] = '<span class="text-danger">'.bcdiv($final_euseffexpense,1,2).'</span>';
                    endif;
                endif;
            endforeach;
            $data[] = $row_settle;
            
            // Game Provider
            $gpprofile = 0;
            $nettselfprofile = 0;
            foreach( $raw['data'] as $user ):
                foreach( $user['data'] as $gp ):
                    // if( $user['loginId'] == $this->global['profile']['loginId'] ):
                    if( $user['userId'] == $rid ):
                        foreach( $gp['countType'] as $gpTC ):
                            if( $gpTC['turnoverCount']==true ):
                                $TCplayerbet = $gpTC['playerBet'];
                                $TCplayerwin = $gpTC['playerWin'];
                                $TCplayerwinlose = $gpTC['playerWinLose'];
                            endif;
                        endforeach;

                        $final_profitbet = floor($gp['profitByBet'] * 10000)/10000;
                        $final_profitturnover = floor($gp['profitByTurnover'] * 10000)/10000;

                        $playerwin = (float)$TCplayerwin<0 ? '<span class="text-danger">'.bcdiv($TCplayerwin, 1, 2).'</span>' : bcdiv($TCplayerwin, 1, 2);
                        $playerwinlose = (float)$TCplayerwinlose<0 ? '<span class="text-danger">'.bcdiv($TCplayerwinlose, 1, 2).'</span>' : bcdiv($TCplayerwinlose, 1, 2);
                        $profitbybet = (float)$final_profitbet<0 ? '<span class="text-danger">'.bcdiv($final_profitbet, 1,2).'</span>' : bcdiv($final_profitbet, 1,2);
                        $profitbyturnover = (float)$final_profitturnover<0 ? '<span class="text-danger">'.bcdiv($final_profitturnover, 1,2).'</span>' : bcdiv($final_profitturnover, 1,2);

                        $row = [];
                        $row[] = $gp['groupName'];
                        $row[] = bcdiv($TCplayerbet, 1, 2);
                        $row[] = $profitbybet;
                        
                        foreach( $raw['data'] as $breakdown ):
                            $pselft = 0;
                            $pselfeff = 0;
                            $pturnover = 0;
                            $peffective = 0;
                            $nspp = 0;
                            if( $breakdown['profitByBet']!=0 || $breakdown['profitByTurnover']!=0 ):
                                foreach( $breakdown['data'] as $bgp ):
                                    $onet = 0;
                                    $onee = 0;
                                    $ones = 0;
                                    $oneseff = 0;
                                    // foreach( $raw['data'] as $down ):
                                    //     if( $down['profitByBet']!=0 || $down['profitByTurnover']!=0 ):
                                    //         foreach( $down['data'] as $downgp ):
                                    //             if( $down['loginId']!==$breakdown['loginId'] && $downgp['groupName']===$bgp['groupName'] ):
                                    //                 $onet += $downgp['profitByBet'];
                                    //                 $onee += $downgp['profitByTurnover'];
                                    //                 $ones += $downgp['playerBet'];
                                    //                 $oneseff += $downgp['playerTurnover'];
                                    //             endif;
                                    //         endforeach;
                                    //     endif;
                                    // endforeach;

                                    foreach( $raw['data'] as $down ):
                                        if( $down['profitByBet']!=0 || $down['profitByTurnover']!=0 ):
                                            foreach( $down['data'] as $downgp ):
                                                if( $down['loginId']!==$breakdown['loginId'] && $downgp['groupName']===$bgp['groupName'] ):
                                                    foreach( $downgp['countType'] as $ddgp ):
                                                        if( $ddgp['turnoverCount']==true ):
                                                        $onet += $downgp['profitByBet'];
                                                        $onee += $downgp['profitByTurnover'];
                                                        $ones += $ddgp['playerBet'];
                                                        $oneseff += $ddgp['playerTurnover'];
                                                        endif;
                                                    endforeach;
                                                endif;
                                            endforeach;
                                        endif;
                                    endforeach;

                                    if( $bgp['groupName']===$gp['groupName'] ):
                                        // if( $breakdown['loginId']===$this->global['profile']['loginId'] ):
                                        foreach( $bgp['countType'] as $bgpCT ):
                                            if( $bgpCT['turnoverCount']==true ):
                                                $bgpBet = $bgpCT['playerBet'];
                                                $bgpTurnover = $bgpCT['playerTurnover'];
                                            endif;
                                        endforeach;

                                        if( $breakdown['userId']===$rid ):
                                            $pselft = $bgpBet - $ones;
                                            $pselfeff = $bgpTurnover - $oneseff;
                                            $pturnover = $bgp['profitByBet'] - $onet;
                                            $peffective = $bgp['profitByTurnover'] - $onee;

                                            // $nspp += $pturnover;
                                            $nspp += $peffective;
                                        else:
                                            $pselft = $bgpBet;
                                            $pselfeff = $bgpTurnover;
                                            $pturnover = $bgp['profitByBet'];
                                            $peffective = $bgp['profitByTurnover'];

                                            $nspp += 0;
                                        endif;
                                    endif;
                                endforeach;

                                $final_pselft = floor($pselft * 10000)/10000;
                                $final_pselfeff = floor($pselfeff * 10000)/10000;
                                $final_pturnover = floor($pturnover * 10000)/10000;
                                $final_peffective = floor($peffective * 10000)/10000;
                                
                                $row[] = $breakdown['loginId'];
                                // $row[] = (float)$pselft>=0 ? bcdiv($final_pselft, 1, 2) : '0.00';
                                $row[] = (float)$pselfeff>=0 ? bcdiv($final_pselfeff, 1, 2) : '0.00';
                                $row[] = $bgp['psRate'].' / '.$raw['psPercentage'];
                                // $row[] = (float)$pturnover>=0 ? bcdiv($final_pturnover, 1, 2) : '<span class="text-danger">'.bcdiv($final_pturnover, 1, 2).'</span>';
                                $row[] = (float)$peffective>0 ? bcdiv($final_peffective, 1, 2) : '<span class="text-danger">'.bcdiv($final_peffective, 1, 2).'</span>';
                            endif;
                            $nettselfprofile += $nspp;
                        endforeach;
  
                        $data[] = $row;
                        
                        // $gpprofile += (float)$gp['profitByBet'];
                        $gpprofile += (float)$gp['profitByTurnover'];
                    endif;
                endforeach;
            endforeach;

            // Footer
            // $groupnett = floatval($gpprofile) - floatval($tt);
            // $nett = floatval($nettselfprofile) - floatval($selfturnover);
            $groupnett = floatval($gpprofile) - floatval($ss);
            $nett = floatval($nettselfprofile) - floatval($selfeffective);

            $final_groupnett = floor($groupnett * 10000)/10000;
            $final_nett = floor($nett * 10000)/10000;

            $groupnett_final = bcdiv($final_groupnett, 1, 2);
            $nett_final = bcdiv($final_nett, 1, 2);

            $row_groupnett = [];
            $row_groupnett[] = null;
            // $row_groupnett[] = null;
            // $row_groupnett[] = null;
            $row_groupnett[] = '<b class="d-block text-end">'.lang('Label.groupnettprofit').':</b>';
            $row_groupnett[] = $groupnett_final;
            $data[] = $row_groupnett;

            $row_nett = [];
            $row_nett[] = null;
            // $row_nett[] = null;
            // $row_nett[] = null;
            $row_nett[] = '<b class="d-block text-end">'.lang('Label.nettprofit').':</b>';
            $row_nett[] = $nett_final.'<small class="d-block text-end text-danger">* '.lang('Label.scoredesc').'</small>';
            $data[] = $row_nett;

            echo json_encode(['code'=>1, 'data' => $data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function companySummaryV2()
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

        $refer = $this->request->getpost('parent') ? base64_decode($this->request->getpost('parent')) : $_SESSION['token'];
        $raw = $this->gameps_model->selectPsSummary(['userid'=>$refer, 'fromdate'=>$from, 'todate'=>$to]);
        // echo json_encode($raw);

        if( $raw['code'] == 1 && $raw['companyGPData'] != [] && $raw['data'] != [] ):
            $data = [];

            foreach( $raw['totalCountType'] as $tc ):
                if( $tc['turnoverCount']==true ):
                    $bet = $tc['totalBet'];
                    $win = $tc['totalWin'];
                endif;
            endforeach;

            $totalpayout = $win - $raw['totalJackpot'];
            $final_totalpayout = floor($totalpayout * 10000)/10000;

            $down = '<div class="collapse givechip pt-2">';
            $down .= '<table class="w-100 table table-sm table-bordered ms-auto"><tbody>';
            $down .= '<tr>';
            $down .= '<th class="text-dark">'.lang('Label.totalgivechip').':</th><td>'.bcdiv($raw['totalGiveChip'], 1, 2).'</td>';
            $down .= '</tr>';
            $down .= '<tr>';
            $down .= '<th class="text-dark">'.lang('Label.totaljackpot').':</th><td>'.bcdiv($raw['totalJackpot'], 1, 2).'</td>';
            $down .= '</tr>';
            $down .= '</tbody></table>';
            $down .= '</div>';

            $expense = '<span class="text-danger">-'.bcdiv($raw['expenses'], 1, 2).'</span>';

            $row_settle = [];
            $row_settle[] = '<b>'.lang('Label.expenses').'</b>';
            // $row_settle[] = bcdiv($bet, 1, 2);
            // $row_settle[] = bcdiv($final_totalpayout, 1, 2).$down;
            $row_settle[] = '';
            $row_settle[] = '';
            $row_settle[] = '-'.bcdiv($raw['expenses'], 1, 2);
            // $row_settle[] = $expense.'<a class="d-inline-block text-decoration-none ml-2" href="javascript:void(0);"><i class="las la-chevron-circle-down" data-bs-toggle="collapse" data-bs-target=".givechip"></i></a>';
            $data[] = $row_settle;

            $totalGroupBet = 0;
            $totalGroupWin = 0;
            $totalGroupGiveChip = 0;
            foreach( $raw['companyGPData'] as $c ):
                foreach( $c['totalCountType'] as $tct ):
                    if( $tct['turnoverCount']==true ):
                        $totalbet = $tct['totalBet'];
                        $totalwin = $tct['totalWin'];
                    endif;
                endforeach;

                $compwin = $totalwin - $c['totalGiveChip'];
                $final_tprofit = floor($c['totalProfit'] * 10000)/10000;

                $row = [];
                $row[] = $c['groupName'];
                $row[] = $totalbet;
                $row[] = $compwin;
                $row[] = $final_tprofit;

                foreach( $c['companyGPDataDetails'] as $cv ):
                    foreach( $cv['totalCountType'] as $game ):
                        if( $game['turnoverCount']==true ):
                            $gamebet = $game['totalBet'];
                            $gamewin = $game['totalWin'];
                            $totalGroupBet += $gamebet;
                            $totalGroupWin += $gamewin;
                        endif;
                    endforeach;

                    $gwin = $gamewin - $cv['totalGiveChip'];
                    $finalGroupWin = floor($gwin * 10000)/10000;

                    $final_gpprofit = floor($cv['totalProfit'] * 10000)/10000;

                    $row[] = $cv['name'];
                    $row[] = $gamebet;
                    $row[] = $finalGroupWin;
                    $row[] = $final_gpprofit;
                endforeach;

                $data[] = $row;

                // $totalGroupBet += $gamebet;
                // $totalGroupWin += $gwin;
                $totalGroupGiveChip += $c['totalGiveChip'];
            endforeach;

            $settlement = 0;
            foreach( $raw['totalCountType'] as $cTC ):
                if( $cTC['turnoverCount']==TRUE ):
                    $settlement = $cTC['totalWinLose'] - $raw['totalGiveChip'];
                endif;
            endforeach;

            $rowSettlement = [];
            $rowSettlement[] = lang('Label.settlement');
            $rowSettlement[] = $totalGroupBet;
            $rowSettlement[] = $totalGroupWin - $totalGroupGiveChip;
            $rowSettlement[] = $settlement;
            $data[] = $rowSettlement;
            echo json_encode(['code'=>1, 'data' => $data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function companySummary()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $rawSource = json_decode(file_get_contents('php://input'),1);
        // echo json_encode($rawSource);
        if( !empty($rawSource['start']) && !empty($rawSource['end']) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($rawSource['start']))));
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($rawSource['end']))));
        else:
            $from = date('c', strtotime(date('Y-m-d 00:00:00')));
            $to = date('c', strtotime(date('Y-m-d 23:59:59')));
        endif;

        $refer = isset($rawSource['parent']) ? base64_decode($rawSource['parent']) : $_SESSION['token'];
        $raw = $this->gameps_model->selectPsSummary(['userid'=>$refer, 'fromdate'=>$from, 'todate'=>$to]);
        // echo json_encode($raw);

        if( $raw['code'] == 1 &&  $raw['companyGPData'] != [] && $raw['data'] != [] ):
            $data = [];

            foreach( $raw['totalCountType'] as $tc ):
                if( $tc['turnoverCount']==true ):
                    $bet = $tc['totalBet'];
                    $win = $tc['totalWin'];
                endif;
            endforeach;

            // $totalpayout = $win - $raw['totalJackpot'];
            $totalpayout = $win - $raw['totalJackpot'] - $raw['totalGiveChip'];
            $final_totalpayout = floor($totalpayout * 10000)/10000;

            $down = '<div class="collapse givechip pt-2">';
            $down .= '<table class="w-100 table table-sm table-bordered ms-auto"><tbody>';
            $down .= '<tr>';
            $down .= '<th class="text-dark">'.lang('Label.totalgivechip').':</th><td>'.bcdiv($raw['totalGiveChip'], 1, 2).'</td>';
            $down .= '</tr>';
            $down .= '<tr>';
            $down .= '<th class="text-dark">'.lang('Label.totaljackpot').':</th><td>'.bcdiv($raw['totalJackpot'], 1, 2).'</td>';
            $down .= '</tr>';
            $down .= '</tbody></table>';
            $down .= '</div>';

            $expense = '<span class="text-danger">-'.bcdiv($raw['expenses'], 1, 2).'</span>';

            $row_settle = [];
            $row_settle[] = '<b>'.lang('Label.settlement').'</b>';
            $row_settle[] = bcdiv($bet, 1, 2);
            $row_settle[] = bcdiv($final_totalpayout, 1, 2).$down;
            $row_settle[] = $expense.'<a class="d-inline-block text-decoration-none ml-2" href="javascript:void(0);"><i class="bx bxs-chevron-down-circle" data-bs-toggle="collapse" data-bs-target=".givechip"></i></a>';
            $data[] = $row_settle;

            foreach( $raw['companyGPData'] as $c ):
                foreach( $c['totalCountType'] as $tct ):
                    if( $tct['turnoverCount']==true ):
                        $totalbet = $tct['totalBet'];
                        $totalwin = $tct['totalWin'];
                    endif;
                endforeach;

                $compwin = $totalwin - $c['totalGiveChip'];
                $final_tprofit = floor($c['totalProfit'] * 10000)/10000;

                $row = [];
                $row[] = $c['groupName'];
                $row[] = bcdiv($totalbet, 1, 2);
                $row[] = bcdiv($compwin, 1, 2);
                $row[] = bcdiv($final_tprofit, 1, 2);

                foreach( $c['companyGPDataDetails'] as $cv ):
                    foreach( $cv['totalCountType'] as $game ):
                        if( $game['turnoverCount']==true ):
                            $gamebet = $game['totalBet'];
                            $gamewin = $game['totalWin'];
                        endif;
                    endforeach;

                    $gwin = $gamewin - $cv['totalGiveChip'];
                    $final_gpprofit = floor($cv['totalProfit'] * 10000)/10000;

                    $row[] = $cv['name'];
                    $row[] = bcdiv($gamebet, 1, 2);
                    $row[] = bcdiv($gwin, 1, 2);
                    $row[] = bcdiv($final_gpprofit, 1, 2);
                endforeach;

                $data[] = $row;
            endforeach;
            echo json_encode(['code'=>1, 'data' => $data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    /*
    Company PTPS Settings
    */

    public function modifyCompanyPtPsSettings()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'expenses' => (float)$this->request->getPost('params')['psExpenses'],
            'ptexpenses' => (float)$this->request->getPost('params')['ptExpenses'],
            'percentage' => (float)$this->request->getPost('params')['psPercentage'],
            'ptpspercentage' => (float)$this->request->getPost('params')['ptPercentage'],
            'pslotteryexpenses' => (float)$this->request->getPost('params')['psLotteryExpenses'],
        ];
        $res = $this->gameps_model->updateCompanyPsSettings($payload);
        echo json_encode($res);
    }

    public function getCompanyPtPsSettings()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_ENV['host']
        ];
        $res = $this->gameps_model->selectCompanyPsSettings($payload);
        echo json_encode($res);
    }
}