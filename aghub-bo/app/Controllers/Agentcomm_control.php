<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Agentcomm_control extends BaseController
{
    // Protected
    
    protected function executeGameCategory()
    {
        $res = $this->gamecategory_model->selectAllGameCategory([
            'userid' => $_SESSION['token'],
        ]);
        return $res;
    }

    public function editAgentCommission()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'], 
            'code'=> $this->request->getpost('params')['code'], 
            'type'=> (int)$this->request->getpost('params')['type'], 
            'commission' => (float)$this->request->getpost('params')['agcomm']
        ];

        $res = $this->gameprovider_model->updateGpAgentCommission($payload);
        echo json_encode($res);
    }

    public function settingsAgentCommissionList()
    {
        if( !session()->get('logged_in') ): return false; endif;
        
        $res = $this->gameprovider_model->selectGp([
            'userid' => $_SESSION['token'],
            'code' => $this->request->getpost('provider')
        ]);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $lng = strtoupper($_SESSION['lang']);
            $cate = $this->executeGameCategory();

            $data = [];
            foreach( $res['data']['type'] as $gc ):
                switch($gc['type']):
                    case 1: $category = $cate['data'][0]['value'][$lng]; break;
                    case 2: $category = $cate['data'][1]['value'][$lng]; break;
                    case 3: $category = $cate['data'][2]['value'][$lng]; break;
                    case 4: $category = $cate['data'][3]['value'][$lng]; break;
                    case 5: $category = $cate['data'][4]['value'][$lng]; break;
                    case 6: $category = $cate['data'][5]['value'][$lng]; break;
                    case 7: $category = $cate['data'][6]['value'][$lng]; break;
                    case 8: $category = $cate['data'][7]['value'][$lng]; break;
                    default: $category = '---';
                endswitch;

                if($gc['commissionPercentage']!=[]):
                    $arr = end($gc['commissionPercentage']);
                    $agcomm = $arr['percentage'];
                else:
                    $agcomm = 0;
                endif;

                $action = '<div class="btn-group">';
                $action .= '<button type="button" class="btn btn-primary btn-sm" onclick="modifyAgComm(\''.$gc['type'].'\', \''.$agcomm.'\');">'.lang('Nav.edit').'</button>';
                $action .= '</div>';

                $row = [];
                $row[] = '<span class="badge bg-primary me-1 fw-normal">'.$res['data']['code'].'</span>'.$res['data']['name']['EN'];
                $row[] = $category;
                $row[] = $agcomm;
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(["data"=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function agCommPtReport()
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

        $settledate = !empty($this->request->getPost('date')) ? date('c', strtotime(date('Y-m-d 00:00:00', strtotime($this->request->getPost('date'))))) : null;

        $res = $this->agentcomm_model->selectAllAgCommPt([
            'userid' => base64_decode($this->request->getPost('parent')),
            'fromdate' => $from,
            'todate'=>$to,
            'date' => $settledate
        ]);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $data = [];
            foreach( $res['data'] as $u ):
                $totalAgComm = floor($u['commissionAmount'] * 10000)/10000;

                switch( $u['role'] ):
                    case 3:
                        $role = '<a class="text-decoration-none" href="javascript:void(0);" onclick="reload(\''.base64_encode($u['userId']).'+'.$u['loginId'].'\');">'.lang('Label.agent').'</a>';
                        // $selfAff = $u['playerAmount'] - $u['uplineAmount'];
                    break;
                    case 4:
                        $role = lang('Label.member');
                        // $selfAff = $u['playerAmount'];
                        // $selfAff = $u['selfAmount'];
                    break;
                endswitch;

                $row = [];
                $row[] = $role;
                $row[] = $u['loginId'];
                $row[] = $u['name'];
                $row[] = $totalAgComm;
                $data[] = $row;
            endforeach;
            echo json_encode(['data'=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function agCommReport()
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

        $settledate = !empty($raw['date']) ? date('c', strtotime(date('Y-m-d 00:00:00', strtotime($raw['date'])))) : null;

        $payload = $this->agentcomm_model->agentCommHistory([
            'pageindex' => $raw['pageindex'],
            'rowperpage' => $raw['rowperpage'],
            'userid' => base64_decode($raw['parent']), 
            'fromdate' => $from,
            'todate'=>$to,
            'date' => $settledate
        ]);
        // echo json_encode($payload);

        if( $payload['code'] == 1 && $payload['data'] != [] ):
            $cate = $this->executeGameCategory();

            $data = [];
            foreach( $payload['data'] as $c ):
                $date = Time::parse(date('Y-m-d H:i:s', strtotime($c['createDate'])));
                $created = $date->toDateTimeString();

                $settle = Time::parse(date('Y-m-d H:i:s', strtotime($c['date'])));
                $settledate = $settle->toDateTimeString();

                $used = $c['approve']==true ? lang('Label.success') : lang('Label.reject');

                $finalAmount = floor($c['amount'] * 10000)/10000;

                $row = [];
                // $row[] = $c['commissionId'];
                // $row[] = $user['remark'];
                $row[] = $used;
                $row[] = $c['loginId'];
                $row[] = $created;
                $row[] = date('Y-m-d', strtotime($settledate));
                $row[] = $finalAmount;
                foreach( $c['gameCommission2'] as $g ):
                    foreach( $g['value'] as $game ):
                        foreach( $game['turnoverCount'] as $tc ):
                            switch($game['gameType']):
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

                            $finalGameAmount = floor($game['amount'] * 10000)/10000;
                            $turncount = $tc['turnoverCount'] ? lang('Label.yes') : lang('Label.no');

                            $row[] = $turncount;
                            $row[] = '<span class="badge bg-primary fw-normal me-1">'.$g['gameProviderCode'].'</span>'.$category;
                            $row[] = $tc['bet'];
                            $row[] = $tc['turnover'];
                            $row[] = $game['percentage'].'%';
                            $row[] = $finalGameAmount;
                        endforeach;
                    endforeach;
                endforeach;
                $data[] = $row;
            endforeach;
            echo json_encode(['data'=>$data, 'code'=>1, 'pageIndex'=>$payload['pageIndex'], 'rowPerPage'=>$payload['rowPerPage'], 'totalPage'=>$payload['totalPage'], 'totalRecord'=>$payload['totalRecord']]);
        else:
            echo json_encode(['no data']);
        endif;
    }
}