<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Game_control extends BaseController
{
    protected function executeGameCategory()
    {
        $res = $this->gamecategory_model->selectAllGameCategory([
            'userid' => $_SESSION['token'],
        ]);
        return $res;
    }

    public function editStatusGame()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'], 
            'gameprovidercode' => $this->request->getpost('params')['provider'], 
            'code' => $this->request->getpost('params')['code'], 
            'status' => (int)$this->request->getpost('params')['status']
        ];
        $res = $this->game_model->updateGame($payload);
        echo json_encode($res);
    }

    public function editGame()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $data = [
            'userid' => $_SESSION['token'], 
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
        $param->IN = $this->request->getpost('params')['en'];
        $name['name'] = $param;
        $payload = array_merge($data, $name);

        $res = $this->game_model->updateGame($payload);
        echo json_encode($res);
    }

    public function addGame()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $data = [
            'userid' => $_SESSION['token'], 
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
        $param->IN = $this->request->getpost('params')['en'];
        $name['name'] = $param;
        $payload = array_merge($data, $name);

        $res = $this->game_model->insertGame($payload);
        echo json_encode($res);
    }

    public function getGame()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'], 
            'gameprovidercode' => $this->request->getpost('params')['provider'], 
            'code' => $this->request->getpost('params')['code']
        ];

        $res = $this->game_model->selectGame($payload);
        echo json_encode($res);
    }

    public function gamesAllList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'gameprovidercode' => $this->request->getpost('provider')
        ];
        $res = $this->game_model->selectAllGames($payload);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $lng = strtoupper($_SESSION['lang']);
            $cate = $this->executeGameCategory();

            $data = [];
            foreach( $res['data'] as $g ):
                switch($g['type']):
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

                switch($g['status']):
                    case 1: $status = lang('Label.active'); break;
                    case 2: $status = lang('Label.inactive'); break;
                    case 3: $status = lang('Label.freeze'); break;
                    default: $status = '';
                endswitch;

                switch($g['turnoverCount']):
                    case true: $tcount = lang('Label.yes'); break;
                    case false: $tcount = lang('Label.no'); break;
                    default: $tcount = '';
                endswitch;

                $action = '<div class="btn-groups" role="group">';
                $action .= '<button type="button" class="btn btn-primary btn-sm" onclick="showGame(\''.$g['code'].'\');">'.lang('Nav.edit').'</button>';
                $action .= '<div class="btn-group" role="group">';
                $action .= '<button id="gbtnStatus" type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">'.lang('Input.status').'</button>';
                $action .= '<ul class="dropdown-menu dropdown-menu-end border-white" aria-labelledby="gbtnStatus">';
                $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="modifyGStatus(\''.$g['code'].'\',\'1\');">'.lang('Label.active').'</a></li>';
                $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="modifyGStatus(\''.$g['code'].'\',\'2\');">'.lang('Label.inactive').'</a></li>';
                $action .= '<li><a class="dropdown-item" href="javascript:void(0);" onclick="modifyGStatus(\''.$g['code'].'\',\'3\');">'.lang('Label.freeze').'</a></li>';
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