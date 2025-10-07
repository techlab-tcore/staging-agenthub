<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Banner_control extends BaseController
{
    public function modifyStatus()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'id' => base64_decode($this->request->getpost('params')['id']),
            'status' => (int)$this->request->getpost('params')['status']
        ];

        $res = $this->banner_model->updateBanner($payload);
        echo json_encode($res);
    }

    public function modifyBanner()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $data = [
            'userid' => $_SESSION['token'],
            'id' => base64_decode($this->request->getpost('params')['id']),
            'name' => $this->request->getpost('params')['title'],
            'order' => (int)$this->request->getpost('params')['order']
        ];

        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['en'];
        $param->MY = $this->request->getpost('params')['my'];
        $param->CN = $this->request->getpost('params')['cn'];
        // $param->ZH = $this->request->getpost('params')['cn'];
        $param->TH = $this->request->getpost('params')['th'];
        $param->VN = $this->request->getpost('params')['vn'];
        // $param->BGL = $this->request->getpost('params')['en'];
        // $param->BUR = $this->request->getpost('params')['en'];
        // $param->IN = $this->request->getpost('params')['in'];
        $name['imageurl'] = $param;
        $payload = array_merge($data, $name);

        $res = $this->banner_model->updateBanner($payload);
        echo json_encode($res);
    }

    public function addBanner()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $data = [
            'userid' => $_SESSION['token'],
            'name' => $this->request->getpost('params')['title'],
            'status' => 1
        ];

        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['en'];
        $param->MY = $this->request->getpost('params')['my'];
        $param->CN = $this->request->getpost('params')['cn'];
        // $param->ZH = $this->request->getpost('params')['cn'];
        $param->TH = $this->request->getpost('params')['th'];
        $param->VN = $this->request->getpost('params')['vn'];
        // $param->BGL = $this->request->getpost('params')['en'];
        // $param->BUR = $this->request->getpost('params')['en'];
        // $param->IN = $this->request->getpost('params')['in'];
        $name['imageurl'] = $param;
        $payload = array_merge($data, $name);

        $res = $this->banner_model->insertBanner($payload);
        echo json_encode($res);
    }

    public function getBanner()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'code' => base64_decode($this->request->getpost('params')['id'])
        ];
        $res = $this->banner_model->selectBanner($payload);
        echo json_encode($res);
    }

    public function bannerList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $lng = strtoupper($_SESSION['lang']);

        $payload = [
            'userid' => $_SESSION['token']
        ];
        $res = $this->banner_model->selectAllBanners($payload);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $data = [];
            foreach( $res['data'] as $b ):
                switch($b['status']):
                    case 1: $status = lang('Label.active'); break;
                    case 2: $status = lang('Label.inactive'); break;
                    default: $status = '';
                endswitch;

                $date = Time::parse(date('Y-m-d H:i:s', strtotime($b['createDate'])));
                $created = $date->toDateTimeString();

                $action = '<div class="btn-groups" role="group">';
                $action .= '<button type="button" class="btn btn-vw btn-sm" onclick="modifyBanner(\''.base64_encode($b['id']).'\');">'.lang('Nav.edit').'</button>';
                if( $b['status']==1 ):
                    $action .= '<a class="btn btn-success btn-sm bg-gradient" href="javascript:void(0);" onclick="modifyBannerStatus(\''.base64_encode($b['id']).'\', 2)">'.lang('Label.active').'</a>';
                else:
                    $action .= '<a class="btn btn-danger btn-sm bg-gradient" href="javascript:void(0);" onclick="modifyBannerStatus(\''.base64_encode($b['id']).'\', 1)">'.lang('Label.inactive').'</a>';
                endif;
                $action .= '</div>';

                $row = [];
                $row[] = $status;
                $row[] = $b['name'];
                $row[] = '<a target="_blank" href="'.$b['imageUrl'][$lng].'">'.$b['imageUrl'][$lng].'</a>';
                $row[] = $b['order'];
                $row[] = $created;
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(["data"=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }
}