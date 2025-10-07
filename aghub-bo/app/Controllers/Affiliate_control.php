<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Affiliate_control extends BaseController
{
    protected function executeGameCategory()
    {
        $res = $this->gamecategory_model->selectAllGameCategory([
            'userid' => $_SESSION['token'],
        ]);
        return $res;
    }

    /*
    Affiliate Settings
    */

    public function modifyAffiliateSettings()
    {
        if( !session()->get('logged_in') ): return false; endif;
        
        if( $this->request->getpost('params')['calculate']==2 ):
            $payload = [
                'userid' => $_SESSION['token'],
                'level' => (int)$this->request->getpost('params')['level'],
                'percentage' => (float)$this->request->getpost('params')['rate']
            ];
        else:
            $payload = [
                'userid' => $_SESSION['token'],
                'level' => (int)$this->request->getpost('params')['level'],
                'percentage' => (float)$this->request->getpost('params')['rate'],
                'gameprovidercode' => $this->request->getpost('params')['provider'],
                'type' => (int)$this->request->getpost('params')['category']
            ];
        endif;

        $res = $this->affiliate_model->updateAffiliateSettings($payload);
        echo json_encode($res);
    }

    public function addAffiliateLevel()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'level' => (int)$this->request->getpost('params')['level']
        ];
        $res = $this->affiliate_model->insertAffililateLevel($payload);
        echo json_encode($res);
    }

    public function modifyCeiling()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            // 'maxaffiliate' => (float)$this->request->getpost('params')['max_affiliate'],
            'maxaffiliate' => 0,
            'maxaffiliateday' => (int)$this->request->getpost('params')['max_day'],
            // 'towalletpercentage' => (float)$this->request->getpost('params')['chip'],
            // 'togroupname' => $this->request->getpost('params')['chipgroup']
            'towalletpercentage' => 0,
            'togroupname' => null
        ];
        $res = $this->affiliate_model->updateCeilingAffiliate($payload);
        echo json_encode($res);
    }

    public function affiliateSettingsCeilingAndDeposit()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token']
        ];
        $res = $this->affiliate_model->selectAffiliateSettings($payload);
        // echo json_encode($res);

        if( $res['code']==1 ):
            if( $res['affiliateToWalletPercentage']!=[] ):
                $percent = end($res['affiliateToWalletPercentage']);
                $chippercent = $percent['percentage'];
            else:
                $chippercent = 0;
            endif;
            
            $returns = [
                'maxday' => $res['maxAffiliateDay'],
                'maxaffiliate' => $res['maxAffiliate'],
                'chippercent4deposit' => $chippercent,
                'groupname' => $res['toGroupName']
            ];
        else:
            $returns = [
                'maxday' => 0,
                'maxaffiliate' => 0,
                'chippercent4deposit' => 0,
                'groupname' => $res['toGroupName']
            ];
        endif;
        $result = array_merge(['code'=>1],$returns);
        echo json_encode($result);
    }

    public function affiliateSettingsList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token']
        ];
        $res = $this->affiliate_model->selectAffiliateSettings($payload);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $lng = strtoupper($_SESSION['lang']);
            $cate = $this->executeGameCategory();

            $data = [];
            foreach( $res['data'] as $lvl ):
                foreach($lvl['value'] as $gp):
                    foreach($gp['value'] as $type):
                        switch($type['gameType']):
                            case 1: $category = $cate['data'][0]['value'][$lng]; break;
                            case 2: $category = $cate['data'][1]['value'][$lng]; break;
                            case 3: $category = $cate['data'][2]['value'][$lng]; break;
                            case 4: $category = $cate['data'][3]['value'][$lng]; break;
                            case 5: $category = $cate['data'][4]['value'][$lng]; break;
                            case 6: $category = $cate['data'][5]['value'][$lng]; break;
                            case 7: $category = $cate['data'][6]['value'][$lng]; break;
                            case 8: $category = $cate['data'][7]['value'][$lng]; break;
                            default: $category = '';
                        endswitch;

                        if($type['pt']!=[]):
                            $rt = end($type['pt']);
                            $aff = $rt['percentage'];
                        else:
                            $aff = 0;
                        endif;

                        if($lvl['valueByDeposit']!=[]):
                            $depo = end($lvl['valueByDeposit']);
                            $aff_deposit = $depo['percentage'];
                        else:
                            $aff_deposit = 0;
                        endif;

                        $action = '<div class="btn-group">';
                        $action .= '<button type="button" class="btn btn-primary btn-sm" onclick="modifyAff(\''.$lvl['level'].'\',\''.$gp['gameProviderCode'].'\',\''.$type['gameType'].'\');">'.lang('Nav.edit').'</button>';
                        $action .= '</div>';

                        $row = [];
                        $row[] = $lvl['level'];
                        $row[] = $gp['gameProviderCode'];
                        $row[] = $category;
                        $row[] = $aff;
                        // $row[] = $aff_deposit;
                        $row[] = $action;
                        $data[] = $row;
                    endforeach;
                endforeach;
            endforeach;
            echo json_encode(['data'=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    /*
    Affiliate History
    */

    public function affiliateHistoryList($parent=FALSE)
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

        $payload = $this->affiliate_model->selectAffiliateHistory([
            'userid' => base64_decode($raw['parent']), 
            'fromdate' => $from,
            'todate' => $to,
            'dateby' => (int)$raw['dtype'],
            'pageindex' => $raw['pageindex'],
            'rowperpage' => $raw['rowperpage'],
            'desc' => true
        ]);
        // echo json_encode($payload);

        if( $payload['code']==1 && $payload['data']!=[] ):
            $cate = $this->executeGameCategory();

            $data = [];
            foreach( $payload['data'] as $h ):
                switch($h['status']):
                    case 1: $status = lang('Label.active'); break;
                    case 2: $status = lang('Label.inactive'); break;
                    case 3: $status = lang('Label.freeze'); break;
                    default: $status = '';
                endswitch;

                $date = Time::parse(date('Y-m-d H:i:s', strtotime($h['createDate'])));
                $created = $date->toDateTimeString();

                $date2 = Time::parse(date('Y-m-d H:i:s', strtotime($h['approvedDate'])));
                $approvedate = $date2->toDateTimeString();

                $date3 = Time::parse(date('Y-m-d H:i:s', strtotime($h['fromDate'])));
                $fromdate = $date3->toDateTimeString();

                $date4 = Time::parse(date('Y-m-d H:i:s', strtotime($h['toDate'])));
                $todate = $date4->toDateTimeString();

                $finalAff = floor($h['affiliateAmount'] * 100000)/100000;
                $finalActualAff = floor($h['actualAffiliate'] * 100000)/100000;
                $finalAffChip = floor($h['affiliateToWallet'] * 100000)/100000;
                $finalAffCash = floor($h['affiliateToBalance'] * 100000)/100000;

                $row = [];
                $row[] = $status;
                $row[] = $created;
                $row[] = date('Y-m-d', strtotime($fromdate)).' '.lang('Input.to').' '.date('Y-m-d', strtotime($todate));
                $row[] = '<small class="badge bg-dark me-1">'.$h['approvedIP'].'</small>'.$h['approvedBy'];
                $row[] = $h['loginId'];
                $row[] = $h['amount'];
                $row[] = $finalActualAff;
                $row[] = $finalAffCash;
                $row[] = $finalAffChip;
                
                if( $_SESSION['affiliate']!=3 ):
                    foreach( $h['data2'] as $gp ):
                        foreach( $gp['affiliateList'] as $game ):
                            foreach( $game['value'] as $v ):
                                foreach( $v['countType'] as $tc ):
                                    switch($v['type']):
                                        case 1: $category = $cate['data'][0]['value']['EN']; break;
                                        case 2: $category = $cate['data'][1]['value']['EN']; break;
                                        case 3: $category = $cate['data'][2]['value']['EN']; break;
                                        case 4: $category = $cate['data'][3]['value']['EN']; break;
                                        case 5: $category = $cate['data'][4]['value']['EN']; break;
                                        case 6: $category = $cate['data'][5]['value']['EN']; break;
                                        case 7: $category = $cate['data'][6]['value']['EN']; break;
                                        case 8: $category = $cate['data'][7]['value']['EN']; break;
                                        default: $category = '';
                                    endswitch;

                                    $turncount = $tc['turnoverCount'] ? lang('Label.yes') : lang('Label.no');
                                    
                                    $actualAff = floor($v['affiliateAmount'] * 100000)/100000;
                                    $finalActualAff = $tc['bet']<=0 ? 0 : $actualAff;

                                    $cashPortion = 100 - $gp['toWalletPercentage'];
                                    $chipPortion = $gp['toWalletPercentage'];

                                    $affProfit = ($tc['turnover'] * $v['percentage'] / 100);
                                    $aff2Cash = $finalActualAff * $cashPortion / 100;
                                    $aff2Chip = $finalActualAff * $chipPortion / 100;

                                    $row[] = $turncount;
                                    $row[] = '<span class="badge bg-dark fw-normal me-1"><span class="badge bg-primary fw-normal me-1">'.$game['level'].'</span>'.$gp['gameProviderCode'].'</span>'.$category;
                                    $row[] = $tc['bet'];
                                    $row[] = $tc['turnover'];
                                    $row[] = $v['percentage'].'%';
                                    $row[] = $finalActualAff;
                                    $row[] = $gp['toWalletPercentage'].'%';
                                    $row[] = $aff2Cash;
                                    $row[] = $aff2Chip;
                                    $row[] = !empty($gp['toGroupName']) ? $gp['toGroupName'] : '---';
                                endforeach;
                            endforeach;
                        endforeach;
                    endforeach;
                else:
                    if( $h['dataByDeposit']!=[] ):
                        foreach( $h['dataByDeposit']['affiliateList'] as $lvl ):
                            $final_lvlaff = floor($lvl['amount'] * 100000)/100000;
                            $final_lvlaffamt = floor($lvl['affiliateAmount'] * 100000)/100000;

                            $row[] = $lvl['level'];
                            $row[] = $lvl['percentage'];
                            $row[] = $final_lvlaff;
                            $row[] = $final_lvlaffamt;
                            $row[] = $h['dataByDeposit']['toGroupName'];
                        endforeach;
                    endif;
                endif;
                $data[] = $row;
            endforeach;
            echo json_encode(['data'=>$data, 'code'=>1, 'pageIndex'=>$payload['pageIndex'], 'rowPerPage'=>$payload['rowPerPage'], 'totalPage'=>$payload['totalPage'], 'totalRecord'=>$payload['totalRecord']]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    /*
    Affiliate PT
    */

    public function modifyAffiliatePt()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid']),
            'percentage' => (float)$this->request->getpost('params')['affpt']
        ];
        $res = $this->affiliate_model->updateAffiliatePt($payload);
        echo json_encode($res);
    }

    public function getAffiliatePt()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $res = $this->affiliate_model->selectAffiliatePt([
            'userid' => base64_decode($this->request->getpost('params')['uid'])
        ]);
        if( $res['code']==1 && $res['data']!=[] ):
            $arr = end($res['data']);
            $affiliatePt = $arr['percentage'];
        else:
            $affiliatePt = 0;
        endif;
        echo json_encode(['code'=>$res['code'], 'affiliatePt'=>$affiliatePt]);
    }

    public function minMaxAffiliatePt()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $res = $this->affiliate_model->selectMinMaxAffiliatePt([
            'userid' => base64_decode($this->request->getpost('params')['uid'])
        ]);
        echo json_encode($res);
    }

    public function affiliatePtReport()
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

        $res = $this->affiliate_model->selectAllAffiliatePt([
            'userid' => base64_decode($this->request->getPost('parent')),
            'fromdate' => $from,
            'todate' => $to,
            'desc' => true
        ]);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $data = [];
            foreach( $res['data'] as $u ):
                $totalAff = floor($u['playerAmount'] * 10000)/10000;
                $downlineAff = floor($u['uplineAmount'] * 10000)/10000;

                switch( $u['role'] ):
                    case 3:
                        $role = '<a class="text-decoration-none" href="javascript:void(0);" onclick="reload(\''.base64_encode($u['userId']).'+'.$u['loginId'].'\');">'.lang('Label.agent').'</a>';
                        $selfAff = $u['playerAmount'] - $u['uplineAmount'];
                    break;
                    case 4:
                        $role = lang('Label.member');
                        $selfAff = $u['playerAmount'];
                        // $selfAff = $u['selfAmount'];
                    break;
                endswitch;

                $row = [];
                $row[] = $role;
                $row[] = $u['loginId'];
                $row[] = $u['name'];
                $row[] = $totalAff;
                $row[] = $downlineAff;
                $row[] = floor($selfAff * 10000)/10000;
                $data[] = $row;
            endforeach;
            echo json_encode(['data'=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }
}