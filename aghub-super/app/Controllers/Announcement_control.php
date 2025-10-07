<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Announcement_control extends BaseController
{
    public function modifyAnnouncement()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $data = [
            'userid' => $_SESSION['token'],
            'announcementid' => base64_decode($this->request->getpost('params')['anid']), 
            'targetrole' => array_map('intval', $this->request->getpost('params')['roles']),
            'popup' => (int)$this->request->getpost('params')['popup'],
            'status' => (int)$this->request->getpost('params')['status']
        ];
        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['en'];
        $param->MY = $this->request->getpost('params')['my'];
        $param->CN = $this->request->getpost('params')['cn'];
        $param->ZH = $this->request->getpost('params')['zh'];
        $param->TH = $this->request->getpost('params')['th'];
        $param->VN = $this->request->getpost('params')['vn'];
        $param->BGL = $this->request->getpost('params')['bgl'];
        $name['content'] = $param;
        $payload = array_merge($data, $name);

        $res = $this->announcement_model->updateAnnouncement($payload);
        echo json_encode($res);
    }

    public function addAnnouncement()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $data = [
            'userid' => $_SESSION['token'],
            'targetrole' => array_map('intval', $this->request->getpost('params')['roles']),
            'popup' => (int)$this->request->getpost('params')['popup']
        ];
        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['en'];
        $param->MY = $this->request->getpost('params')['my'];
        $param->CN = $this->request->getpost('params')['cn'];
        $param->ZH = $this->request->getpost('params')['zh'];
        $param->TH = $this->request->getpost('params')['th'];
        $param->VN = $this->request->getpost('params')['vn'];
        $param->BGL = $this->request->getpost('params')['bgl'];
        $name['content'] = $param;
        $payload = array_merge($data, $name);

        $res = $this->announcement_model->insertAnnouncement($payload);
        echo json_encode($res);
    }

    public function getSelfAnnouncement()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'id' => base64_decode($this->request->getpost('params')['anid']), 
        ];
        $res = $this->announcement_model->selectSelfAnnouncement($payload);
        echo json_encode($res);
    }

    public function announcementSelfList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'desc' => true
        ];
        $res = $this->announcement_model->selectAllSelfAnnouncement($payload);
        // echo json_encode($res);

        if( $res['code']==1 && $res['data']!=[] ):
            $data = [];
            foreach( $res['data'] as $a ):
                switch( $a['status'] ):
                    case 1: $status='Active'; break;
                    case 2: $status='Inactive'; break;
                    default: $status='';
                endswitch;

                switch( $a['popUp'] ):
                    case 1: $popup = 'Yes'; break;
                    default: $popup = 'No';
                endswitch;

                $role = '';
                foreach($a['targetRole'] as $r):
                    switch($r):
                        case 2: $tr = 'Administrator'; break;
                        case 3: $tr = 'Agent'; break;
                        case 4: $tr = 'Member'; break;
                        case 5: $tr = 'Sub Account'; break;
                        default: $tr ='';
                    endswitch;
                    $role .= $r != end($a['targetRole']) ? $tr.',' : $tr;
                endforeach;

                $date = Time::parse(date('Y-m-d H:i:s', strtotime($a['createDate'])));
                $created = $date->toDateTimeString();

                $action = '<button type="button" class="btn btn-light btn-sm" onclick="editAnnouncement(\''.base64_encode($a['id']).'\')">Edit</button>';

                $row = [];
                $row[] = date('Y-m-d H:i:s', strtotime($created));
                $row[] = $status;
                $row[] = $popup;
                $row[] = $role;
                $row[] = $a['content']['EN'];
                $row[] = $a['content']['MY'];
                $row[] = $a['content']['CN'];
                $row[] = $a['content']['ZH'];
                $row[] = $a['content']['TH'];
                $row[] = $a['content']['VN'];
                $row[] = $a['content']['BGL'];
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
        $res = $this->announcement_model->selectAllAnnouncement($payload);
        // echo json_encode($res);

        if( $res['code']==1 && $res['data']!=[] ):
            $data = [];
            foreach( $res['data'] as $a ):
                $date = Time::parse(date('Y-m-d H:i:s', strtotime($a['createDate'])));
                $created = $date->toDateTimeString();

                $action = '<button type="button" class="btn btn-light btn-sm" onclick="editPaytype(\''.$a['code'].'\')">Edit</button>';

                $row = [];
                $row[] = date('Y-m-d H:i:s', strtotime($created));
                $row[] = $a['popUp'];
                $row[] = $a['content']['EN'];
                $row[] = $a['content']['MY'];
                $row[] = $a['content']['CN'];
                $row[] = $a['content']['ZH'];
                $row[] = $a['content']['TH'];
                $row[] = $a['content']['VN'];
                $row[] = $a['content']['BGL'];
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(["data"=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }
}