<?php

namespace App\Controllers;

class Gameprovider_control extends BaseController
{
    /*
    Game Provider
    */

    public function editStatusGameProvider()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('params')['currencycode'];
        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['parent']),
            'code'=> $this->request->getpost('params')['code'], 
            'status'=>(int)$this->request->getpost('params')['status'],
        ];
        $res = $this->gameprovider_model->updateGameProvider($payload, $currencyCode);
        echo json_encode($res);
    }

    public function editGameProvider()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('params')['currencycode'];
        $data = [
            'userid' => base64_decode($this->request->getpost('params')['parent']),
            'code'=> $this->request->getpost('params')['code'], 
            'typelist'=> array_map('intval', $this->request->getpost('category')), 
            'order'=>(int)$this->request->getpost('params')['order'],
            'maxaffiliate' => (float)$this->request->getpost('params')['affcap'],
            'affiliatetowalletpercentage' => (float)$this->request->getpost('params')['affchiprate'],
            'togroupname' => $this->request->getpost('params')['chipgroup'],
            'ptrent' => (float)$this->request->getpost('params')['gpfee'],
            'diminisher' => (int)$this->request->getpost('params')['diminisher']
        ];

        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['en'];
        $param->MY = $this->request->getpost('params')['en'];
        $param->CN = $this->request->getpost('params')['en'];
        $param->ZH = $this->request->getpost('params')['en'];
        $param->TH = $this->request->getpost('params')['en'];
        $param->VN = $this->request->getpost('params')['en'];
        $param->BGL = $this->request->getpost('params')['en'];
        $param->IN = $this->request->getpost('params')['en'];
        $name['name'] = $param;
        $payload = array_merge($data, $name);

        $res = $this->gameprovider_model->updateGameProvider($payload, $currencyCode);
        echo json_encode($res);
    }

    public function addGameProvider()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('params')['currencycode'];
        $data = [
            'userid' => base64_decode($this->request->getpost('params')['parent']),
            'code'=> $this->request->getpost('params')['gpcode'], 
            'typelist'=> array_map('intval', $this->request->getpost('category')), 
            'maxaffiliate' => (float)$this->request->getpost('params')['gpaffcap'],
            'affiliatetowalletpercentage' => (float)$this->request->getpost('params')['gpaffchiprate'],
            'togroupname' => $this->request->getpost('params')['gpchipgroup'],
            'ptrent' => (float)$this->request->getpost('params')['providerfee'],
            'diminisher' => (int)$this->request->getpost('params')['gpdiminisher']
        ];

        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['gpen'];
        $param->MY = $this->request->getpost('params')['gpen'];
        $param->CN = $this->request->getpost('params')['gpen'];
        $param->ZH = $this->request->getpost('params')['gpen'];
        $param->TH = $this->request->getpost('params')['gpen'];
        $param->VN = $this->request->getpost('params')['gpen'];
        $param->BGL = $this->request->getpost('params')['gpen'];
        $param->IN = $this->request->getpost('params')['gpen'];
        $name['name'] = $param;
        $payload = array_merge($data, $name);

        $res = $this->gameprovider_model->insertGameProvider($payload, $currencyCode);
        echo json_encode($res);
    }

    public function getGameProvider()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['parent']),
            'code' => $this->request->getpost('params')['code']
        ];
        $res = $this->gameprovider_model->selectGp($payload);
        echo json_encode($res);
    }

    public function gameProviderAllList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('currencycode');

        $payload = [
            'userid' => base64_decode($this->request->getpost('parent'))
        ];
        $res = $this->gameprovider_model->selectAllGp($payload, $currencyCode);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
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

                $type = '';
                $tlist = [];
                $game = '';
                foreach($gp['type'] as $gc):
                    switch($gc['type']):
                        case 1: $category = 'Slot'; break;
                        case 2: $category = 'Live Casino'; break;
                        case 3: $category = 'Sportbook'; break;
                        case 4: $category = 'Keno'; break;
                        case 5: $category = 'Lottery'; break;
                        case 6: $category = 'Fishing'; break;
                        case 7: $category = 'Others'; break;
                        case 8: $category = 'ESport'; break;
                        default: $category = '';
                    endswitch;
                    
                    $type .= $gc != end($gp['type']) ? $category.', ' : $category;
                    $tlist[] .= $gc != end($gp['type']) ? (int)$gc['type'].', ' : (int)$gc['type'];
                    $gc['type']==1 || $gc['type']==2 || $gc['type']==6 ? $game = '<a class="btn btn-light btn-sm" href="'.base_url('game-provider/games/'.$this->request->getpost('parent').'/'.$gp['code'].'/'.$currencyCode).'">Games</a>' : '';
                endforeach;

                switch($gp['status']):
                    case 1: $status = 'Active'; break;
                    case 2: $status = 'Inactive'; break;
                    case 3: $status = 'Freeze'; break;
                    default: $status = '';
                endswitch;

                $final_maxaff = floor($gp['maxAffiliate'] * 10000)/10000;

                $action = '<div class="btn-groups">';
                $action .= '<button type="button" class="btn btn-light btn-sm" onclick="modifyGP(\''.$gp['code'].'\',\''.$gp['name']['EN'].'\',\''.json_encode(array_map('intval', $tlist)).'\', \''.$gp['order'].'\',\''.$gp['maxAffiliate'].'\',\''.$aff_chip.'\',\''.$gp['affToGroupName'].'\',\''.$gpfee.'\',\''.$gp['diminisher'].'\',\''.$currencyCode.'\');">Edit</button>';
                // $action .= '<button type="button" class="btn btn-light btn-sm" onclick="getGameProvider(\''.$gp['code'].'\',\''.json_encode(array_map('intval', $tlist)).'\');">Edit</button>';

                $action .= '<div class="btn-group">';
                $action .= '<button id="gbtnStatus" type="button" class="btn btn-light btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Status</button>';
                $action .= '<ul class="dropdown-menu dropdown-menu-end border-white" aria-labelledby="gbtnStatus">';
                $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="status(\''.$gp['code'].'\',\'1\',\''.$currencyCode.'\');">Active</a></li>';
                $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="status(\''.$gp['code'].'\',\'2\',\''.$currencyCode.'\');">Inactive</a></li>';
                $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="status(\''.$gp['code'].'\',\'3\',\''.$currencyCode.'\');">Freeze</a></li>';
                $action .= '</ul>';
                $action .= '</div>';
                $action .= $game;
                $action .= '</div>';

                $row = [];
                $row[] = $status;
                $row[] = '['.$gp['code'].'] '.$gp['name']['EN'];
                $row[] = '<small class="badge bg-primary me-1">'.$gp['diminisher'].'x</small>'.$type;
                $row[] = $gpfee.'%';
                $row[] = $aff_chip.'%/'.bcdiv($final_maxaff,1,2);
                $row[] = !empty($gp['affToGroupName']) ? $gp['affToGroupName'] : '---';
                $row[] = $gp['order'];
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(["data"=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function gameProviderList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $lng = strtoupper($_SESSION['lang']);
        $currencyCode = $this->request->getpost('params')['currencycode'];

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['parent']),
        ];
        $res = $this->gameprovider_model->selectAllGp($payload, $currencyCode);
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