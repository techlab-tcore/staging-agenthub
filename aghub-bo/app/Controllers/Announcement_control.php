<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Announcement_control extends BaseController
{
    public function addAnnouncement()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $data = [
            'userid' => $_SESSION['token'],
            'targetrole' => array_map('intval', $this->request->getpost('roles')), 
            'popup' =>(int)$this->request->getpost('params')['popup']
        ];

        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['en'];
        $param->MY = $this->request->getpost('params')['my'];
        $param->CN = $this->request->getpost('params')['cn'];
        // $param->ZH = $this->request->getpost('params')['zh'];
        $param->TH = $this->request->getpost('params')['th'];
        $param->VN = $this->request->getpost('params')['vn'];
        // $param->BGL = $this->request->getpost('params')['bgl'];
        // $param->BUR = $this->request->getpost('params')['bur'];
        // $param->IN = $this->request->getpost('params')['in'];
        $name['content'] = $param;
        $payload = array_merge($data, $name);

        $res = $this->announcement_model->insertAnnouncement($payload);
        echo json_encode($res);
    }

    public function editAnnouncement()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $data = [
            'userid' => $_SESSION['token'],
            'announcementid' => base64_decode($this->request->getpost('params')['id']), 
            'targetrole' => array_map('intval', $this->request->getpost('roles')), 
            'popup' =>(int)$this->request->getpost('params')['popup'],
            'status' => (int)$this->request->getpost('params')['status']
        ];

        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['en'];
        $param->MY = $this->request->getpost('params')['my'];
        $param->CN = $this->request->getpost('params')['cn'];
        // $param->ZH = $this->request->getpost('params')['zh'];
        $param->TH = $this->request->getpost('params')['th'];
        $param->VN = $this->request->getpost('params')['vn'];
        // $param->BGL = $this->request->getpost('params')['bgl'];
        // $param->BUR = $this->request->getpost('params')['bur'];
        // $param->IN = $this->request->getpost('params')['in'];
        $name['content'] = $param;
        $payload = array_merge($data, $name);

        $res = $this->announcement_model->updateAnnouncement($payload);
        echo json_encode($res);
    }

    public function announcementSent()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'id' => base64_decode($this->request->getpost('params')['id'])
        ];
        $res = $this->announcement_model->selectAnnouncementSent($payload);
        echo json_encode($res);
    }

    public function announcementPopList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $lng = strtoupper($_SESSION['lang']);

        $payload = [
            'userid' => $_SESSION['token'],
        ];
        $res = $this->announcement_model->selectAllAnnouncementList($payload);
        // echo json_encode($res);

        if( $res['code']==1 && $res['data']!=[] ):
            $data = [];
            foreach( $res['data'] as $a ):
                if( $a['popUp']==1 ):
                    $date = Time::parse(date('Y-m-d H:i:s', strtotime($a['createDate'])));
                    $created = $date->toDateTimeString();

                    $row = [];
                    $row['created'] = date('Y-m-d h:i A', strtotime($created));
                    $row['content'] = $a['content'][$lng];
                    $row['pop'] = $a['popUp'];
                    $data[] = $row;
                endif;
            endforeach;
            $annc['data'] = $data;
        else:
            $annc['data'] = '';
        endif;
        $result = array_merge(['code'=>$res['code']],$annc);
        echo json_encode($result);
    }

    public function announcementSentList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'desc' => true
        ];

        $res = $this->announcement_model->selectAnnouncementSentList($payload);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $lng = strtoupper($_SESSION['lang']);

            $data = [];
            foreach( $res['data'] as $a ):
                switch( $a['status'] ):
                    case 1: $status=lang('Label.active'); break;
                    default: $status=lang('Label.inactive');
                endswitch;

                switch( $a['popUp'] ):
                    case 1: $popup=lang('Label.yes'); break;
                    default: $popup=lang('Label.no');
                endswitch;

                $role = '';
                foreach($a['targetRole'] as $r):
                    switch($r):
                        case 3: $tr = lang('Label.agent'); break;
                        case 4: $tr = lang('Label.member'); break;
                        case 5: $tr = lang('Label.subacc'); break;
                        default: $tr ='';
                    endswitch;
                    $role .= $r != end($a['targetRole']) ? $tr.', ' : $tr;
                endforeach;

                $date = Time::parse(date('Y-m-d H:i:s', strtotime($a['createDate'])));
                $created = $date->toDateTimeString();

                if( $a['popUp']==1 ):
                    // $action .= '<button type="button" class="btn btn-primary btn-sm" onclick="modify(\''.base64_encode($a['id']).'\')"><i class="las la-cog"></i></button>';

                    $action = '<a class="btn btn-primary btn-sm" href="'.base_url('announcement/open/modify/'.base64_encode($a['id'])).'">'.lang('Nav.edit').'</a>';
                else:
                    $action = '<button type="button" class="btn btn-primary btn-sm" onclick="modifyRoll(\''.base64_encode($a['id']).'\')">'.lang('Nav.edit').'</button>';
                endif;

                $row = [];
                $row[] = $created;
                $row[] = $status;
                $row[] = $role;
                $row[] = $popup;
                $row[] = $a['content'][$lng];
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(["data"=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function announcementList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'desc' => true
        ];

        $res = $this->announcement_model->selectAllAnnouncementList($payload);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $lng = strtoupper($_SESSION['lang']);

            $data = [];
            foreach( $res['data'] as $a ):
                if( $a['popUp']==2 ):
                    $date = Time::parse(date('Y-m-d H:i:s', strtotime($a['createDate'])));
                    $created = $date->toDateTimeString();

                    $row = [];
                    $row['date'] = date('M d, Y', strtotime($created));
                    $row['content'] = $a['content'][$lng];
                    $data[] = $row;
                endif;
            endforeach;
            echo json_encode(['code'=>$res['code'], 'message'=>$res['message'], "data"=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }
}