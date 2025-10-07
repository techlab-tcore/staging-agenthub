<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Game_control extends BaseController
{
    public function editStatusGame()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('params')['currencycode'];
        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['parent']),
            'gameprovidercode' => $this->request->getpost('params')['provider'], 
            'code' => $this->request->getpost('params')['code'], 
            'status' => (int)$this->request->getpost('params')['status']
        ];
        $res = $this->game_model->updateGame($payload, $currencyCode);
        echo json_encode($res);
    }

    public function editGame()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('params')['currencycode'];
        $data = [
            'userid' => base64_decode($this->request->getpost('params')['parent']),
            'gameprovidercode' => $this->request->getpost('params')['provider'], 
            'code' => $this->request->getpost('params')['code'], 
            'type' => (int)$this->request->getpost('params')['gcate'],
            'order' => (int)$this->request->getpost('params')['order'],
            'turnovercount' => filter_var($this->request->getpost('params')['turnovercount'], FILTER_VALIDATE_BOOLEAN)
        ];
        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['en'];
        $param->MY = $this->request->getpost('params')['my'];
        $param->CN = $this->request->getpost('params')['cn'];
        $param->ZH = $this->request->getpost('params')['zh'];
        $param->TH = $this->request->getpost('params')['th'];
        $param->VN = $this->request->getpost('params')['vn'];
        $param->BGL = $this->request->getpost('params')['bgl'];
        $param->IN = $this->request->getpost('params')['in'];
        $name['name'] = $param;
        $payload = array_merge($data, $name);

        $res = $this->game_model->updateGame($payload, $currencyCode);
        echo json_encode($res);
    }

    public function addGame()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('params')['currencycode'];
        $data = [
            'userid' => base64_decode($this->request->getpost('params')['parent']),
            'gameprovidercode' => $this->request->getpost('params')['provider'], 
            'code' => $this->request->getpost('params')['code'], 
            'type' => (int)$this->request->getpost('params')['gcate'],
            'turnovercount' => filter_var($this->request->getpost('params')['turnovercount'], FILTER_VALIDATE_BOOLEAN)
        ];
        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['en'];
        $param->MY = $this->request->getpost('params')['my'];
        $param->CN = $this->request->getpost('params')['cn'];
        $param->ZH = $this->request->getpost('params')['zh'];
        $param->TH = $this->request->getpost('params')['th'];
        $param->VN = $this->request->getpost('params')['vn'];
        $param->BGL = $this->request->getpost('params')['bgl'];
        $param->IN = $this->request->getpost('params')['in'];
        $name['name'] = $param;
        $payload = array_merge($data, $name);

        $res = $this->game_model->insertGame($payload, $currencyCode);
        echo json_encode($res);
    }

    public function getGame()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('params')['currencycode'];
        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['parent']),
            'gameprovidercode' => $this->request->getpost('params')['provider'], 
            'code' => $this->request->getpost('params')['code']
        ];

        $res = $this->game_model->selectGame($payload, $currencyCode);
        echo json_encode($res);
    }

    public function gamesAllList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('currencycode');
        $payload = [
            'userid' => base64_decode($this->request->getpost('parent')),
            'gameprovidercode' => $this->request->getpost('provider')
        ];
        $res = $this->game_model->selectAllGames($payload, $currencyCode);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $lng = strtoupper($_SESSION['lang']);

            $data = [];
            foreach( $res['data'] as $g ):
                switch($g['type']):
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

                switch($g['status']):
                    case 1: $status = 'Active'; break;
                    case 2: $status = 'Inactive'; break;
                    case 3: $status = 'Freeze'; break;
                    default: $status = '';
                endswitch;

                switch($g['turnoverCount']):
                    case true: $tcount = 'Yes'; break;
                    case false: $tcount = 'No'; break;
                    default: $tcount = '';
                endswitch;

                $action = '<div class="btn-groups">';
                $action .= '<button type="button" class="btn btn-light btn-sm" onclick="showGame(\''.$g['code'].'\',\''.$currencyCode.'\');">Edit</button>';
                $action .= '<div class="btn-group">';
                $action .= '<button id="gbtnStatus" type="button" class="btn btn-light btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Status</button>';
                $action .= '<ul class="dropdown-menu dropdown-menu-end border-white" aria-labelledby="gbtnStatus">';
                $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="modifyStatus(\''.$g['code'].'\',\'1\',\''.$currencyCode.'\');">Active</a></li>';
                $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="modifyStatus(\''.$g['code'].'\',\'2\',\''.$currencyCode.'\');">Inactive</a></li>';
                $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="modifyStatus(\''.$g['code'].'\',\'3\',\''.$currencyCode.'\');">Freeze</a></li>';
                $action .= '</ul>';
                $action .= '</div>';
                $action .= '</div>';

                $row = [];
                $row[] = $status;
                $row[] = $g['code'];
                $row[] = $g['name'][$lng];
                $row[] = $category;
                $row[] = $tcount;
                $row[] = $g['order'];
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(["data"=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }
}