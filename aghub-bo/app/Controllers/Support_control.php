<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Support_control extends BaseController
{
    /*
    LiveChat
    */

    public function modifyLiveChat()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload  = [
            'userid' => $_SESSION['token'],
            'livechaturl' => $this->request->getpost('params')['livechat']
        ];
        $res = $this->support_model->updateLiveChat($payload);
        echo json_encode($res);
    }

    public function getLiveChat()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload  = [
            'userid' => $_SESSION['token']
        ];
        $res = $this->support_model->selectAllLiveChat($payload);
        echo json_encode($res);
    }

    /*
    Whatsapp
    */

    public function modifyWhatsapp()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $firstCharUsername = substr($this->request->getPost('params')['mobile'], 0, $_ENV['numMobileCode']);
        if( $firstCharUsername==$_ENV['mobileCode'] ):
            echo json_encode([
                'code' => -1,
                'message' => lang('Validation.mobile')
            ]);
        else:
            $payload  = [
                'userid' => $_SESSION['token'],
                'id' => base64_decode($this->request->getpost('params')['id']),
                'name' => $this->request->getpost('params')['name'],
                'mobilenumber' => $this->request->getpost('params')['mobile'],
                'remark' => $this->request->getpost('params')['remark'],
                'order' => (int)$this->request->getpost('params')['order'],
                'status' => (int)$this->request->getpost('params')['status']
            ];
            $res = $this->support_model->updateSupport($payload);
            echo json_encode($res);
        endif;
    }

    public function addWhatsapp()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $firstCharUsername = substr($this->request->getPost('params')['mobile'], 0, $_ENV['numMobileCode']);
        if( $firstCharUsername==$_ENV['mobileCode'] ):
            echo json_encode([
                'code' => -1,
                'message' => lang('Validation.mobile')
            ]);
        else:
            $payload  = [
                'userid' => $_SESSION['token'],
                'name' => $this->request->getpost('params')['name'],
                'mobilenumber' => $this->request->getpost('params')['mobile'],
                'remark' => $this->request->getpost('params')['remark'],
            ];
            $res = $this->support_model->insertSupport($payload);
            echo json_encode($res);
        endif;
    }

    public function getWhatsapp()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload  = [
            'userid' => $_SESSION['token'],
            'id' => base64_decode($this->request->getpost('params')['id'])
        ];
        $res = $this->support_model->selectSupport($payload);
        echo json_encode($res);
    }

    public function supportList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload  = [
            'userid' => $_SESSION['token']
        ];
        $res = $this->support_model->selectAllSupports($payload);
        // echo json_encode($res);

        if( $res['code']==1 && $res['data']!=[] ):
            $data = [];
            foreach( $res['data'] as $s ):
                switch($s['status']):
                    case 1: $status = lang('Label.active'); break;
                    case 2: $status = lang('Label.inactive'); break;
                    case 3: $status = lang('Label.freeze'); break;
                    default: $status = '---';
                endswitch;

                $action = '<div class="btn-groups">';
                $action .= '<a class="btn btn-primary btn-sm" href="javascript:void(0);" onclick="modifyCS(\''.base64_encode($s['id']).'\')">'.lang('Nav.edit').'</a>';
                $action .= '</div>';

                $row = [];
                $row[] = $status;
                $row[] = $s['name'];
                $row[] = $s['mobileNumber'];
                $row[] = $s['order'];
                $row[] = !empty($s['remark']) ? $s['remark'] : "---";
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(['data'=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }
}