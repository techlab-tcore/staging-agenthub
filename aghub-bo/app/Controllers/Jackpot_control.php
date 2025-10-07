<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Jackpot_control extends BaseController
{
    /*
    Protected
    */

    protected function executeGameCategory()
    {
        $res = $this->gamecategory_model->selectAllGameCategory([
            'userid' => $_SESSION['token'],
        ]);
        return $res;
    }

    protected function executeGameProvider()
    {
        $lng = strtoupper($_SESSION['lang']);

        $res = $this->gameprovider_model->selectAllGp([
            'userid' => $_SESSION['token']
        ]);
        
        if( $res['code']==1 && $res['data']!=[] ):
            $data = [];
            foreach( $res['data'] as $g ):
                if( $g['status']==1 ):
                    $row = [];
                    $row['id'] = $g['id'];
                    $row['code'] = $g['code'];
                    $row['name'] = $g['name'][$lng];
                    $row['diminisher'] = $g['diminisher'];
                    $row['order'] = $g['order'];
                    $data[] = $row;
                endif;
            endforeach;
            $result = $data;
        else:
            $result = [];
        endif;
        return $result;
    }

    /*
    Jackpot Settings
    */

    public function claimJackpot()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $this->request->getpost('params')['uid'],
            'password' => $this->request->getpost('params')['password']
        ];
        $res = $this->jackpot_model->updateClaimJackpot($payload);
        echo json_encode($res);
    }

    public function editJackpot()
    {
        if( !session()->get('logged_in') ): return false; endif;

        if( $this->request->getpost('params')['jtype']==3 || $this->request->getpost('params')['jtype']==5 ):
            if( !empty($this->request->getpost('params')['winners']) && $this->request->getpost('params')['winners']!=[] ):
                $winners = explode(',', str_replace(' ', '', $this->request->getpost('params')['winners']));
            else:
                $winners = [];
            endif;
        else:
            $winners = [];
        endif;

        $usePass = !isset($this->request->getpost('params')['usePass']) ? false : filter_var($this->request->getpost('params')['usePass'], FILTER_VALIDATE_BOOLEAN);
        $interval = !isset($this->request->getpost('params')['intervalMin']) ? 0 : $this->request->getpost('params')['intervalMin'];
        $minTurnover = !isset($this->request->getpost('params')['minTurnover']) ? 0 : $this->request->getpost('params')['minTurnover'];
        $calType = !isset($this->request->getpost('params')['calType']) ? 0 : $this->request->getpost('params')['calType'];
        $typeDuplicate = !isset($this->request->getpost('params')['typeduplicate']) ? false : filter_var($this->request->getpost('params')['typeduplicate'], FILTER_VALIDATE_BOOLEAN);
        $accumulate = !isset($this->request->getpost('params')['accumulate']) || $this->request->getpost('params')['accumulate']==0 ? null : (int)$this->request->getpost('params')['accumulate'];

        $category = !isset($this->request->getpost('params')['gcate2']) || !empty($this->request->getpost('params')['gcate2']) ? $this->request->getpost('params')['gcate2'] : 0;
        $gprovider = !isset($this->request->getpost('params')['gpid2']) || !empty($this->request->getpost('params')['gpid2']) ? base64_decode($this->request->getpost('params')['gpid2']) : "";
        $summarygprovider = !isset($this->request->getpost('params')['gpid4']) || !empty($this->request->getpost('params')['gpid4']) ? base64_decode($this->request->getpost('params')['gpid4']) : "";

        $payload = [
            'userid' => $_SESSION['token'],
            'jackpotid' => base64_decode($this->request->getpost('params')['id']),
            'name' => $this->request->getpost('params')['name'],
            'accumulatedamount' => $accumulate,
            'jackpotamount' => (float)$this->request->getpost('params')['prize'],
            'status' => (int)$this->request->getpost('params')['status'],
            'resetby' => (int)$this->request->getpost('params')['resetby'],
            'towalletpercentage' => (float)$this->request->getpost('params')['chip'],
            'displayleastamount' => (float)$this->request->getpost('params')['displayamount'],
            'maximumwinner' => (int)$this->request->getpost('params')['maxwinner'],
            'duplicate' => filter_var($this->request->getpost('params')['duplicate'], FILTER_VALIDATE_BOOLEAN),
            'winner' => $winners,
            'randomamount' => filter_var($this->request->getpost('params')['random'], FILTER_VALIDATE_BOOLEAN),
            'maxjackpotamount' => (float)$this->request->getpost('params')['maxjackpot'],
            'winnerintervalmin' => (int)$interval,
            'minturnover' => (float)$minTurnover,
            'calculationtype' => (int)$calType,
            'usepassword' => $usePass,
            'typeduplicate' => $typeDuplicate,
            'category' => (int)$category,
            'gameproviderid' => $gprovider,
            'togroupname' => $this->request->getpost('params')['chipgroup2'],
            'accumulategameproviderid' => $summarygprovider,
        ];
        $res = $this->jackpot_model->updateJackpot($payload);
        echo json_encode($res);
    }

    public function addJackpot()
    {
        if( !session()->get('logged_in') ): return false; endif;

        if( $this->request->getpost('params')['jtype']==3 || $this->request->getpost('params')['jtype']==5 ):
            if( !empty($this->request->getpost('params')['winners']) && $this->request->getpost('params')['winners']!=[] ):
                $winners = explode(',', str_replace(' ', '', $this->request->getpost('params')['winners']));
            else:
                $winners = [];
            endif;
        else:
            $winners = [];
        endif;

        $usePass = !isset($this->request->getpost('params')['usePass']) ? false : filter_var($this->request->getpost('params')['usePass'], FILTER_VALIDATE_BOOLEAN);
        $interval = !isset($this->request->getpost('params')['intervalMin']) ? 0 : $this->request->getpost('params')['intervalMin'];
        $minTurnover = !isset($this->request->getpost('params')['minTurnover']) ? 0 : $this->request->getpost('params')['minTurnover'];
        $calType = !isset($this->request->getpost('params')['calType']) ? 0 : $this->request->getpost('params')['calType'];
        $typeDuplicate = !isset($this->request->getpost('params')['typeduplicate']) ? false : filter_var($this->request->getpost('params')['typeduplicate'], FILTER_VALIDATE_BOOLEAN);
        $accumulate = !isset($this->request->getpost('params')['accumulate']) || $this->request->getpost('params')['accumulate']==0 ? null : (int)$this->request->getpost('params')['accumulate'];

        $category = !isset($this->request->getpost('params')['gcate']) || !empty($this->request->getpost('params')['gcate']) ? $this->request->getpost('params')['gcate'] : 0;
        $gprovider = !isset($this->request->getpost('params')['gpid']) || !empty($this->request->getpost('params')['gpid']) ? base64_decode($this->request->getpost('params')['gpid']) : "";
        $summarygprovider = !isset($this->request->getpost('params')['gpid3']) || !empty($this->request->getpost('params')['gpid3']) ? base64_decode($this->request->getpost('params')['gpid3']) : "";

        $payload = [
            'userid' => $_SESSION['token'],
            'name' => $this->request->getpost('params')['name'],
            'accumulatedamount' => $accumulate,
            'jackpotamount' => (float)$this->request->getpost('params')['prize'],
            'type' => (int)$this->request->getpost('params')['jtype'],
            'status' => 1,
            'resetby' => (int)$this->request->getpost('params')['resetby'],
            'towalletpercentage' => (float)$this->request->getpost('params')['chip'],
            'displayleastamount' => (float)$this->request->getpost('params')['displayamount'],
            'maximumwinner' => (int)$this->request->getpost('params')['maxwinner'],
            'duplicate' => filter_var($this->request->getpost('params')['duplicate'], FILTER_VALIDATE_BOOLEAN),
            'winner' => $winners,
            'randomamount' => filter_var($this->request->getpost('params')['random'], FILTER_VALIDATE_BOOLEAN),
            'maxjackpotamount' => (float)$this->request->getpost('params')['maxjackpot'],
            'winnerintervalmin' => (int)$interval,
            'minturnover' => (float)$minTurnover,
            'calculationtype' => (int)$calType,
            'usepassword' => $usePass,
            'typeduplicate' => $typeDuplicate,
            'category' => (int)$category,
            'gameproviderid' => $gprovider,
            'togroupname' => $this->request->getpost('params')['chipgroup'],
            'accumulategameproviderid' => $summarygprovider,
        ];
        $res = $this->jackpot_model->insertJackpot($payload);
        echo json_encode($res);
    }

    public function jackpotSettingsList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $lng = strtoupper($_SESSION['lang']);
        $cate = $this->executeGameCategory();
        $gp = $this->executeGameProvider();

        $payload = [
            'userid' => $_SESSION['token']
        ];
        $res = $this->jackpot_model->selectJackpotSetting($payload);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $data = [];
            foreach($res['data'] as $j):
                switch($j['status']):
                    case 1: $status = lang('Label.active'); break;
                    default: $status = lang('Label.inactive');
                endswitch;

                switch($j['usePassword']):
                    case 1: $usePass = lang('Label.yes'); break;
                    default: $usePass = lang('Label.no');
                endswitch;

                switch($j['type']):
                    case 1: $type = lang('Label.jlogin'); break;
                    case 2: $type = lang('Label.jreg'); break;
                    case 3: $type = lang('Label.jselect'); break;
                    case 4: $type = lang('Label.jrandom'); break;
                    case 5: $type = lang('Label.jrolling'); break;
                    case 6: $type = lang('Label.jbetsummary'); break;
                    default: $type = '';
                endswitch;

                switch($j['calculationType']):
                    case 1: $calType = lang('Label.effectbet'); break;
                    case 2: $calType = lang('Label.turnover'); break;
                    case 3: $calType = lang('Label.deposit'); break;
                    default: $calType = '';
                endswitch;

                switch($j['resetBy']):
                    case 1: $resetby = lang('Label.jhit'); break;
                    case 2: $resetby = lang('Label.jday'); break;
                    case 3: $resetby = lang('Label.jweek'); break;
                    case 4: $resetby = lang('Label.jmonth'); break;
                    default: $resetby = '';
                endswitch;

                $date = Time::parse(date('Y-m-d H:i:s', strtotime($j['createDate'])));
                $created = $date->toDateTimeString();

                if($j['jackpotToWalletPercentage']!=[]):
                    $arr = end($j['jackpotToWalletPercentage']);
                    $chip = $arr['percentage'];
                else:
                    $chip = 0;
                endif;

                $duplicate = $j['duplicate'] ? lang('Label.yes') : lang('Label.no');
                $randomWin = $j['randomAmount'] ? lang('Label.yes') : lang('Label.no');
                $typeduplicate = $j['typeDuplicate'] ? lang('Label.yes') : lang('Label.no');

                $people = '';
                $len = count($j['winner']);
                foreach( $j['winner'] as $key=>$winp ):
                    // $people .= $winp != end($j['winner']) ? $winp.', ' : $winp;
                    if( ($key==0 && $len!=1 ) || ($key>0 && $key<($len-1)) ) {
                        $people .= $winp.', ';
                    } elseif( $key==0 && $len==1 ) {
                        $people .= $winp;
                    } else {
                        $people .= $winp;
                    }
                endforeach;

                if( $j['maxJackpotAmount'] > 0 ):
                    $jamount = $j['jackpotAmount'].' (Max: '.$j['maxJackpotAmount'].')';
                else:
                    $jamount = $j['jackpotAmount'].' (Max: ---)';
                endif;

                $action = '<div class="btn-group">';
                $action .= '<button type="button" class="btn btn-primary btn-sm" onclick="modifyJackpot(\''.base64_encode($j['id']).'\', \''.$j['name'].'\', \''.$j['accumulatedAmount'].'\', \''.$j['jackpotAmount'].'\', \''.$j['resetBy'].'\', \''.$chip.'\', \''.$j['displayLeastAmount'].'\', \''.$j['status'].'\', \''.$j['type'].'\', \''.$j['maximumWinner'].'\', \''.$j['duplicate'].'\', \''.base64_encode($people).'\', \''.$randomWin.'\', \''.$j['maxJackpotAmount'].'\', \''.$j['winnerIntervalMin'].'\', \''.$j['minTurnover'].'\', \''.$j['calculationType'].'\', \''.$usePass.'\', \''.$typeduplicate.'\', \''.$j['category'].'\', \''.base64_encode($j['gameProviderId']).'\', \''.$j['toGroupName'].'\', \''.base64_encode($j['accumulateGameProviderId']).'\');">'.lang('Nav.edit').'</button>';
                $action .= '</div>';

                $gname = '';
                if( $gp!=[] ):
                    foreach( $gp as $g ):
                        if( $g['id']==$j['gameProviderId'] ):
                            $gname = '<span class="badge bg-primary fw-normal me-1">'.$g['name'].'</span>';
                        endif;
                    endforeach;
                endif;

                switch($j['category']):
                    case 1: $cateName = $cate['data'][0]['value'][$lng]; break;
                    case 2: $cateName = $cate['data'][1]['value'][$lng]; break;
                    case 3: $cateName = $cate['data'][2]['value'][$lng]; break;
                    case 4: $cateName = $cate['data'][3]['value'][$lng]; break;
                    case 5: $cateName = $cate['data'][4]['value'][$lng]; break;
                    case 6: $cateName = $cate['data'][5]['value'][$lng]; break;
                    case 7: $cateName = $cate['data'][6]['value'][$lng]; break;
                    case 8: $cateName = $cate['data'][7]['value'][$lng]; break;
                    default: $cateName = '';
                endswitch;
                $category = $j['category']!=0 ? '<span class="badge bg-primary fw-normal me-1">'.$cateName.'</span>' : '';

                $row = [];
                $row[] = $status;
                $row[] = $j['name'].'<br><small class="badge bg-primary fw-normal">'.$j['id'].'</small>';
                $row[] = $type;
                $row[] = $usePass;
                $row[] = $j['accumulatedAmount'];
                $row[] = $jamount;
                $row[] = $gname.$category.$chip;
                $row[] = bcdiv($j['displayLeastAmount'], 1, 2);
                $row[] = $resetby;
                $row[] = $j['maximumWinner'];
                $row[] = $duplicate.'<span class="badge bg-primary ms-1">'.lang('Input.typeduplicate').': '.$typeduplicate.'</span>';
                $row[] = $randomWin;
                $row[] = $j['winnerIntervalMin'];
                $row[] = $j['minTurnover'];
                $row[] = $calType;
                $row[] = $j['toGroupName'];
                $row[] = $people;
                $row[] = date('Y-m-d H:i:s', strtotime($created));
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(['data'=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    /*
    Jackpot PT
    */

    public function modifyJackpotPt()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid']),
            'percentage' => (float)$this->request->getpost('params')['jackpotpt']
        ];
        $res = $this->jackpot_model->updateJackpotPt($payload);
        echo json_encode($res);
    }

    public function getJackpotPt()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $res = $this->jackpot_model->selectJackpotPt([
            'userid' => base64_decode($this->request->getpost('params')['uid'])
        ]);
        if( $res['code']==1 && $res['data']!=[] ):
            $arr = end($res['data']);
            $jackpotPt = $arr['percentage'];
        else:
            $jackpotPt = 0;
        endif;
        echo json_encode(['code'=>$res['code'], 'jackpotPt'=>$jackpotPt]);
    }

    public function minMaxJackpotPt()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid'])
        ];
        $res = $this->jackpot_model->selectMinMaxJackpotPt($payload);
        echo json_encode($res);
    }

    /*
    Report
    */

    public function jackpotReport()
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

        $payload = $this->jackpot_model->selectJackpotHistory([
            'pageindex' => $raw['pageindex'],
            'rowperpage' => $raw['rowperpage'],
            'userid' => base64_decode($raw['parent']),
            'fromdate' => $from,
            'todate' => $to,
            'desc' => true,
            'jackpotid' => $raw['jackpotid']
        ]);
        // echo json_encode($payload);

        if( $payload['code'] == 1 && $payload['data'] != [] ):
            $data = [];
            foreach( $payload['data'] as $j ):
                $date = Time::parse(date('Y-m-d H:i:s', strtotime($j['createDate'])));
                $created = $date->toDateTimeString();

                $date2 = Time::parse(date('Y-m-d H:i:s', strtotime($j['winDate'])));
                $winDate = $date2->toDateTimeString();

                $finalAmount = floor($j['amount'] * 10000)/10000;
                $finalCash = floor($j['jackpotToBalance'] * 10000)/10000;
                $finalChip = floor($j['jackpotToWallet'] * 10000)/10000;

                $row = [];
                $row[] = $created.'<br><small class="badge bg-primary fw-normal">ID: '.$j['jackpotId'].'</small>';
                $row[] = $winDate;
                $row[] = $j['jackpotName'].'<br><small class="badge bg-primary fw-normal">Ref: '.$j['jackpotReferenceId'].'</small>';
                $row[] = $j['loginId'];
                $row[] = '<span class="badge bg-primary me-1">'.$j['toWalletPercentage'].'%</span>'.$finalChip;
                $row[] = $finalCash;
                $row[] = $finalAmount;
                $data[] = $row;
            endforeach;
            echo json_encode([
                'data'=>$data, 
                'code'=>1, 
                'pageIndex'=>$payload['pageIndex'], 
                'rowPerPage'=>$payload['rowPerPage'], 
                'totalPage'=>$payload['totalPage'], 
                'totalRecord'=>$payload['totalRecord']
            ]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function jackpotPtReport()
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

        $res = $this->jackpot_model->selectAllJackpotPtList([
            'userid' => base64_decode($this->request->getPost('parent')),
            'fromdate' => $from,
            'todate' => $to,
            'desc' => true
        ]);
        // echo json_encode($res);

        if( $res['code']==1 && $res['data']!=[] ):
            $data = [];
            foreach( $res['data'] as $u ):
                foreach( $u['data'] as $j ):
                    $totalJackpot = floor($j['playerJackpotAmount'] * 10000)/10000;
                    $downlineJackpot = floor($j['uplineJackpotAmount'] * 10000)/10000;

                    switch( $u['role'] ):
                        case 3:
                            $role = '<a class="text-decoration-none" href="javascript:void(0);" onclick="reload(\''.base64_encode($u['userId']).'+'.$u['loginId'].'\');">'.lang('Label.agent').'</a>';
                            $selfJackpot = $j['playerJackpotAmount'] - $j['uplineJackpotAmount'];
                        break;
                        case 4:
                            $role = lang('Label.member');
                            $selfJackpot = $j['playerJackpotAmount'];
                        break;
                    endswitch;

                    $row = [];
                    $row[] = $role;
                    $row[] = $u['loginId'];
                    $row[] = $u['name'];
                    $row[] = $totalJackpot;
                    $row[] = $downlineJackpot;
                    $row[] = floor($selfJackpot * 10000)/10000;
                    $data[] = $row;
                endforeach;
            endforeach;
            echo json_encode(['data' => $data]);
        else:
            echo json_encode(['no data']);
        endif;
    }
}