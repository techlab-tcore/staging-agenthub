<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Gameprovider_control extends BaseController
{
    // Protected
    
    protected function executeGameCategory()
    {
        $res = $this->gamecategory_model->selectAllGameCategory([
            'userid' => $_SESSION['token'],
        ]);
        return $res;
    }

    /*
    Game Balance
    */

    public function depositGameBalance()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $uid = base64_decode($this->request->getpost('params')['uid']);
        $amount = $this->request->getpost('params')['amount'];
        $gameUserId = isset($this->request->getpost('params')['gameid']) ? $this->request->getpost('params')['gameid'] : '';

        $payload = [
            'userid' => $uid,
            'gameprovidercode' => $this->request->getpost('params')['provider'],
            'gpuserid' => $gameUserId,
            'transfertype' => 1,
            'amount' => (float)$amount
        ];
        $res = $this->gameprovider_model->updateGameBalance($payload);
        echo json_encode($res);
    }

    public function retrieveGameBalance()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid']),
            'gameprovidercode' => $this->request->getpost('params')['provider'],
            'transfertype' => 2,
            'amount' => (float)$this->request->getpost('params')['amount']
        ];
        $res = $this->gameprovider_model->updateGameBalance($payload);
        echo json_encode($res);
    }

    public function getGameBalance()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid']),
            'gameprovidercode' => $this->request->getpost('params')['provider']
        ];
        $res = $this->gameprovider_model->selectGameBalance($payload);
        echo json_encode($res);
    }

    //WITHDRAW FREE CREDIT
    public function withdrawFreeCredit()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $limit = 2000; //5000
        $amount = $this->request->getpost('params')['amount'];
        $manualAmount = isset($this->request->getpost('params')['transferAmount']) ? $this->request->getpost('params')['transferAmount'] : 0;

        if( $amount>=$limit ):
            $payload = [
                'userid' => base64_decode($this->request->getpost('params')['uid']),
                'gameprovidercode' => $this->request->getpost('params')['gpCode']
            ];
            $res = $this->gameprovider_model->updateFreeCredit($payload);
            // echo json_encode($res);

            if( $res['code']==1 && $manualAmount>0 ):
                // Manual Transfer
                $payloadTransfer = [
                    'userid' => base64_decode($this->request->getpost('params')['uid']),
                    'method' => 1,
                    'wallettype' => 1,
                    'amount' => (float)$manualAmount,
                    'remark' => $this->request->getpost('params')['remark'],
                    'ip' => $_SESSION['ip'],
                    'followdate' => false,
                    'deductownagent' => false,
                    'type' => 6, // credit transfer
        
                    'turnover' => 0,
                    'triggertype' => null,
                    'category' => null,
                    'gameprovidercode' => null,
                    'togroupname' => null,
                ];
                $resTransfer = $this->balance_model->updateUserTransfer($payloadTransfer);
                echo json_encode($resTransfer);
                // End Manual Transfer
            else:
                echo json_encode($res);
            endif;
        else:
            echo json_encode([
                'code' => -1,
                'message' => 'Balance does not meet requirement',
            ]);
        endif;
    }

    /*
    Agent Game Provider Closed List
    */

    public function editGameProviderClosedList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $gplist = $this->request->getpost('codes') ? $this->request->getpost('codes') : [];

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid']), 
            'gameprovidercodes'=> $gplist
        ];
        
        $res = $this->gameprovider_model->updateGpClosed($payload);
        echo json_encode($res);
    }

    public function checkClosed()
    {
        if( !session()->get('logged_in') ): return false; endif;
        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['parent'])
        ];
        $res = $this->gameprovider_model->selectAllPpClosedList($payload);
        echo json_encode($res);
    }

    public function gameProviderClosedList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('parent'))
        ];
        $res = $this->gameprovider_model->selectAllPpClosedList($payload);
        // echo json_encode($res);
        
        if( $res['code']==1 ):
            $aglist = '';
            foreach( $res['agentCloseGame'] as $agc ):
                $aglist .= $agc != end($res['agentCloseGame']) ? $agc.', ' : $agc;
            endforeach;

            $list = '';
            foreach( $res['closeGame'] as $c ):
                $list .= $c != end($res['closeGame']) ? $c.', ' : $c;
            endforeach;

            $data = [];
            $action = '<div class="btn-group">';
            $action .= '<button type="button" class="btn btn-primary btn-sm" onclick="modifyGameClosedList();">'.lang('Nav.edit').'</button>';
            $action .= '</div>';

            $agclose = [];
            $agclose[] = lang('Label.uplineclosegames');
            $agclose[] = $aglist;
            $agclose[] = '';
            $data[] = $agclose;

            $closegp = [];
            $closegp[] = lang('Label.selfclosegames');
            $closegp[] = $list;
            $closegp[] = $action;
            $data[] = $closegp;
            echo json_encode(["data"=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    /*
    Game Provider
    */

    public function editStatusGameProvider()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'code'=> $this->request->getpost('params')['code'], 
            'status'=>(int)$this->request->getpost('params')['status'],
        ];
        $res = $this->gameprovider_model->updateGameProvider($payload);
        echo json_encode($res);
    }

    public function editGameProvider()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $data = [
            'userid' => $_SESSION['token'],
            'code'=> $this->request->getpost('params')['code'], 
            'typelist'=> array_map('intval', $this->request->getpost('category')), 
            'order'=>(int)$this->request->getpost('params')['order'],
            'maxaffiliate' => (float)$this->request->getpost('params')['affcap'],
            'affiliatetowalletpercentage' => (float)$this->request->getpost('params')['affchiprate'],
            'togroupname' => $this->request->getpost('params')['chipgroup'],
            'ptrent' => (float)$this->request->getpost('params')['gpfee'],
            'maxwinloserebate' => (float)$this->request->getpost('params')['maxLossRebate'],
            'winloserebatepercentage' => (float)$this->request->getpost('params')['lossRebateRate'],
            'winloserebatetowalletpercentage' => (float)$this->request->getpost('params')['lossRebateToChip'],
            'diminisher' => (int)$this->request->getpost('params')['diminisher'],
            'displaytype' => array_map('intval', $this->request->getpost('categoryDisplay')), 
            'calculateps' => true,
        ];

        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['en'];
        $param->MY = $this->request->getpost('params')['en'];
        $param->CN = $this->request->getpost('params')['en'];
        $param->ZH = $this->request->getpost('params')['en'];
        $param->TH = $this->request->getpost('params')['en'];
        $param->VN = $this->request->getpost('params')['en'];
        $param->BGL = $this->request->getpost('params')['en'];
        $name['name'] = $param;
        $payload = array_merge($data, $name);

        $res = $this->gameprovider_model->updateGameProvider($payload);
        echo json_encode($res);
    }

    public function addGameProvider()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $data = [
            'userid' => $_SESSION['token'],
            'code'=> $this->request->getpost('params')['gpcode'], 
            'typelist'=> array_map('intval', $this->request->getpost('category')), 
            'maxaffiliate' => (float)$this->request->getpost('params')['gpaffcap'],
            'affiliatetowalletpercentage' => (float)$this->request->getpost('params')['gpaffchiprate'],
            'togroupname' => $this->request->getpost('params')['gpchipgroup'],
            'ptrent' => (float)$this->request->getpost('params')['providerfee'],
            'diminisher' => (int)$this->request->getpost('params')['diminisher'],
            'displaytype' => array_map('intval', $this->request->getpost('category')), 
            'calculateps' => true,
        ];

        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['gpen'];
        $param->MY = $this->request->getpost('params')['gpen'];
        $param->CN = $this->request->getpost('params')['gpen'];
        $param->ZH = $this->request->getpost('params')['gpen'];
        $param->TH = $this->request->getpost('params')['gpen'];
        $param->VN = $this->request->getpost('params')['gpen'];
        $param->BGL = $this->request->getpost('params')['gpen'];
        $name['name'] = $param;
        $payload = array_merge($data, $name);

        $res = $this->gameprovider_model->insertGameProvider($payload);
        echo json_encode($res);
    }

    public function getGameProvider()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'code' => $this->request->getpost('params')['gpcode']
        ];
        $res = $this->gameprovider_model->selectGp($payload);
        echo json_encode($res);
    }

    public function gameProviderAllList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $res = $this->gameprovider_model->selectAllGp(['userid' => $_SESSION['token']]);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $lng = strtoupper($_SESSION['lang']);
            $cate = $this->executeGameCategory();

            $data = [];
            foreach( $res['data'] as $gp ):
                if( $gp['affiliateToWalletPercentage']!=[] ):
                    $aff = end($gp['affiliateToWalletPercentage']);
                    $aff_chip = $aff['percentage'];
                else:
                    $aff_chip = 0;
                endif;

                if( $gp['ptRent']!=[] ):
                    $fee = end($gp['ptRent']);
                    $gpfee = $fee['percentage'];
                else:
                    $gpfee = 0;
                endif;

                if( $gp['winloseRebateToWalletPercentage']!=[] ):
                    $lossRebate = end($gp['winloseRebateToWalletPercentage']);
                    $lossRebateChip = $lossRebate['percentage'];
                else:
                    $lossRebateChip = 0;
                endif;

                $type = '';
                $tlist = [];
                $game = '';
                foreach($gp['type'] as $gc):
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
                    
                    $type .= $gc != end($gp['type']) ? $category.', ' : $category;
                    $tlist[] .= $gc != end($gp['type']) ? (int)$gc['type'].', ' : (int)$gc['type'];
                    // $game = $gc['type']==1 || $gc['type']==2 || $gc['type']==6 ? '<a class="btn btn-primary btn-sm" href="'.base_url('game-provider/games/'.$gp['code']).'">'.lang('Nav.gamelist').'</a>' : '';
                    $game = '<a class="btn btn-primary btn-sm" href="'.base_url('game-provider/games/'.$gp['code']).'">'.lang('Nav.gamelist').'</a>';
                endforeach;

                $tlistDisplay = [];
                if( !empty($gp['displayType']) ):
                    foreach($gp['displayType'] as $gcd):
                        $tlistDisplay[] .= $gcd;
                    endforeach;
                else:
                    $tlistDisplay[] .= null;
                endif;

                switch($gp['status']):
                    case 1: $status = lang('Label.active'); break;
                    case 2: $status = lang('Label.inactive'); break;
                    case 3: $status = lang('Label.freeze'); break;
                    default: $status = '---';
                endswitch;

                $action = '<div class="btn-groups" role="group">';

                // $action .= '<button type="button" class="btn btn-light btn-sm" onclick="modifyGP(\''.$gp['code'].'\',\''.$gp['name']['EN'].'\',\''.json_encode(array_map('intval', $tlist)).'\', \''.$gp['order'].'\',\''.$gp['maxAffiliate'].'\',\''.$aff_chip.'\',\''.$gp['affToGroupName'].'\',\''.$gpfee.'\');">'.lang('Nav.edit').'</button>';

                $action .= '<a class="btn btn-primary btn-sm" href="'.base_url('settings/agent-commission/'.$gp['code']).'">'.lang('Label.agcomm').'</a>';
                $action .= $game;
                $action .= '<button type="button" class="btn btn-primary btn-sm" onclick="modifyGP(\''.$gp['code'].'\',\''.json_encode(array_map('intval', $tlist)).'\',\''.json_encode(array_map('intval', $tlistDisplay)).'\')">'.lang('Nav.edit').'</i></button>';
                $action .= '<div class="btn-group me-1 mb-1" role="group">';
                $action .= '<button id="gbtnStatus" type="button" class="btn btn-light btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">'.lang('Input.status').'</button>';
                $action .= '<ul class="dropdown-menu dropdown-menu-end border-white" aria-labelledby="gbtnStatus">';
                $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="status(\''.$gp['code'].'\',\'1\');">'.lang('Label.active').'</a></li>';
                $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="status(\''.$gp['code'].'\',\'2\');">'.lang('Label.inactive').'</a></li>';
                $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="status(\''.$gp['code'].'\',\'3\');">'.lang('Label.freeze').'</a></li>';
                $action .= '</ul>';
                $action .= '</div>';
                $action .= '</div>';

                $row = [];
                $row[] = $status;
                $row[] = '<small class="badge bg-primary fw-normal me-1">'.$gp['code'].'</small>'.$gp['name'][$lng];
                $row[] = '<small class="badge bg-primary fw-normal me-1">'.$gp['diminisher'].'x</small>'.$type;
                $row[] = $gpfee.'%';
                $row[] = $aff_chip.'%/'.$gp['maxAffiliate'];
                $row[] = !empty($gp['affToGroupName']) ? $gp['affToGroupName'] : '---';
                $row[] = $gp['winloseRebatePercentage'].'%';
                $row[] = $lossRebateChip.'%/'.$gp['maxWinloseRebate'];
                $row[] = $gp['order'];
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(["data"=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function gameProviderListClosedPurpose()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $refer = $this->request->getpost('params')['parent'] ? base64_decode($this->request->getpost('params')['parent']) : $_SESSION['token'];
        $payload = [
            'userid' => $_SESSION['token']
        ];
        $res = $this->gameprovider_model->selectAllGp($payload);
        // echo json_encode($res);
        $raw = $this->gameprovider_model->selectAllPpClosedList(['userid'=>$refer]);

        $sequen = [];
        foreach( $raw['agentCloseGame'] as $agc ):
            $key = array_search($agc, array_column($res['data'], 'code'));
            // unset($res['data'][$key]);
            // $aa[] = $res['data'][$key]['code'];
            // $aa[] = $agc;
            $sequen[] = $key;
        endforeach;
        foreach( $sequen as $idx ):
            unset($res['data'][$idx]);
        endforeach;

        $iOne = array_combine(range(0, count($res['data'])-1), array_values($res['data']));
        // $ss = array_values($res['data']);
        // $cc = count($res['data']);
        $result = array_merge($res,['data'=>$iOne]);
        unset($res['data']);
        // echo json_encode($result);

        if( $result['code']==1 && $result['data']!=[] ):
            $data = [];
            foreach( $result['data'] as $gp ):
                if( $gp['status']!=3 ):
                    $row = [];
                    $row['code'] = $gp['code'];
                    $row['name'] = $gp['name'];
                    $row['order'] = $gp['order'];
                    $data[] = $row;
                endif;
            endforeach;
            echo json_encode([
                'code' => $result['code'],
                'message' => $result['message'],
                'data' => $data
            ]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function gameProviderList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $lng = strtoupper($_SESSION['lang']);

        $payload = [
            'userid' => $_SESSION['token']
        ];
        $res = $this->gameprovider_model->selectAllGp($payload);
        // echo json_encode($res);

        if( $res['code']==1 && $res['data']!=[] ):
            $data = [];
            foreach( $res['data'] as $gp ):
                if( $gp['status']!=3 ):
                    $row = [];
                    $row['id'] = base64_encode($gp['id']);
                    $row['code'] = $gp['code'];
                    $row['name'] = $gp['name'][$lng];
                    $row['order'] = $gp['order'];
                    $data[] = $row;
                endif;
            endforeach;
            echo json_encode([
                'code' => $res['code'],
                'message' => $res['message'],
                'data' => $data
            ]);
        else:
            echo json_encode(['no data']);
        endif;
    }
}