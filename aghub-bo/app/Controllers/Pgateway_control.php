<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Pgateway_control extends BaseController
{
    /*
    Protected
    */

    protected function userProfile($parent)
    {
        $payload = [
            'userid' => $parent
        ];
        $res = $this->user_model->selectUser($payload);
        return $res;
    }

    /*
    PT
    */

    public function modifyPgatewayPt()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => base64_decode($this->request->getpost('params')['uid']),
            'percentage' => (float)$this->request->getpost('params')['pgatewaypt']
        ];
        $res = $this->pgateway_model->updatePgatewayDepositPt($payload);
        // echo json_encode($res);
        if( $res['code']==1 ):
            $payloadWithdrawal = [
                'userid' => base64_decode($this->request->getpost('params')['uid']),
                'percentage' => (float)$this->request->getpost('params')['pgatewaypt']
            ];
            $resWithdrawal = $this->pgateway_model->updatePgatewayWithdrawalPt($payload);
            echo json_encode($resWithdrawal);
        else:
            echo json_encode($res);
        endif;
    }

    public function minMaxPgatewayPt()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $res = $this->pgateway_model->selectMinMaxPgatewayDepositPt([
            'userid' => base64_decode($this->request->getpost('params')['uid'])
        ]);
        echo json_encode($res);
    }

    public function getPgatewayWithdrawalPt()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $res = $this->pgateway_model->selectPgatewayWithdrawalPt([
            'userid' => base64_decode($this->request->getpost('params')['uid'])
        ]);
        if( $res['code']==1 && $res['data']!=[] ):
            $arr = end($res['data']);
            $pgatewayPt = $arr['percentage'];
        else:
            $pgatewayPt = 0;
        endif;
        echo json_encode(['code'=>$res['code'], 'pgatewayPt'=>$pgatewayPt]);
    }

    public function getPgatewayPt()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $res = $this->pgateway_model->selectPgatewayDepositPt([
            'userid' => base64_decode($this->request->getpost('params')['uid'])
        ]);
        if( $res['code']==1 && $res['data']!=[] ):
            $arr = end($res['data']);
            $pgatewayPt = $arr['percentage'];
        else:
            $pgatewayPt = 0;
        endif;
        echo json_encode(['code'=>$res['code'], 'pgatewayPt'=>$pgatewayPt]);
    }

    public function pGatewayPtReport()
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

        $res = $this->pgateway_model->selectAllPgatewayDepositPtList([
            'userid' => base64_decode($this->request->getPost('parent')),
            'fromdate' => $from,
            'todate' => $to,
            'desc' => true
        ]);
        echo json_encode($res);

        // if( $res['code'] == 1 && $res['data'] != [] ):
        //     $data = [];
        //     foreach( $res['data'] as $u ):
        //         $totalComm = floor($u['playerAmount'] * 10000)/10000;
        //         $downlineComm = floor($u['downlineAmount'] * 10000)/10000;
        //         $selfComm = floor($u['selfAmount'] * 10000)/10000;
        //         $uplineComm = floor($u['uplineAmount'] * 10000)/10000;

        //         switch( $u['role'] ):
        //             case 3:
        //                 $role = '<a class="text-decoration-none" href="javascript:void(0);" onclick="reload(\''.base64_encode($u['userId']).'+'.$u['loginId'].'\');">'.lang('Label.agent').'</a>';
        //             break;
        //             case 4: $role = lang('Label.member'); break;
        //         endswitch;

        //         $row = [];
        //         $row[] = $role;
        //         $row[] = $u['loginId'];
        //         $row[] = $u['name'];
        //         $row[] = $totalComm;
        //         $row[] = $downlineComm;
        //         $row[] = $selfComm;
        //         $row[] = $uplineComm;
        //         $data[] = $row;
        //     endforeach;
        //     echo json_encode(['data'=>$data]);
        // else:
        //     echo json_encode(['no data']);
        // endif;
    }

    /*
    Settings
    */

    public function editPaymentGateway()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $parent = isset($this->request->getpost('params')['uid']) ? base64_decode($this->request->getpost('params')['uid']) : $_SESSION['token'];

        $payload = [
            'userid' => $parent,
            'bankid' => base64_decode($this->request->getpost('params')['provider']), 
            'apikey' => $this->request->getpost('params')['apikey'], 
            'payurl' => $this->request->getpost('params')['payurl'],
            'callbackurl' => $this->request->getpost('params')['callbackurl'],
            'successurl' => $this->request->getpost('params')['successurl'],
            'failureurl' => $this->request->getpost('params')['failurl'],
            'merchantcode' => $this->request->getpost('params')['merchant'],
            'tieddomain' => $this->request->getpost('params')['domain'],
            'remark' => $this->request->getpost('params')['remark'],
            'order' => (int)$this->request->getpost('params')['ordering'],
            'status' => (int)$this->request->getpost('params')['status']
        ];
        $res = $this->pgateway_model->updatePg($payload);
        echo json_encode($res);
    }

    public function addPaymentGateway()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $parent = isset($this->request->getpost('params')['uid']) ? base64_decode($this->request->getpost('params')['uid']) : $_SESSION['token'];

        $payload = [
            'userid' => $parent,
            'bankid' => base64_decode($this->request->getpost('params')['provider']), 
            'apikey' => $this->request->getpost('params')['apikey'], 
            'payurl' => $this->request->getpost('params')['payurl'],
            'callbackurl' => $this->request->getpost('params')['callbackurl'],
            'successurl' => $this->request->getpost('params')['successurl'],
            'failureurl' => $this->request->getpost('params')['failurl'],
            'merchantcode' => $this->request->getpost('params')['merchant'],
            'tieddomain' => $this->request->getpost('params')['domain'],
            'remark' => $this->request->getpost('params')['remark'],
            'order' => (int)$this->request->getpost('params')['ordering']
        ];
        $res = $this->pgateway_model->insertPg($payload);
        echo json_encode($res);
    }

    public function paymentGateway()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $parent = isset($this->request->getpost('params')['uid']) ? base64_decode($this->request->getpost('params')['uid']) : $_SESSION['token'];

        $payload = [
            'userid' => $parent,
            'bankid' => base64_decode($this->request->getpost('params')['provider']),
            'merchantcode' => $this->request->getpost('params')['merchant']
        ];
        $res = $this->pgateway_model->selectPg($payload);
        echo json_encode($res);
    }

    public function userAllPaymentGatewayList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $parent = $this->request->getpost('parent') ? base64_decode($this->request->getpost('parent')) : $_SESSION['token'];

        $payload = [
            'userid' => $parent
        ];
        $res = $this->pgateway_model->selectAllPg($payload);
        // echo json_encode($res);

        $resProfile = $this->userProfile($parent);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $data = [];
            foreach( $res['data'] as $pg ):
                switch($pg['status']):
                    case 1: $status = lang('Label.active'); break;
                    case 2: $status = lang('Label.inactive'); break;
                endswitch;

                $action = '<div class="btn-groups">';
                $action .= '<button type="button" class="btn btn-primary btn-sm" onclick="modifyPG(\''.base64_encode($pg['bankId']).'\',\''.$pg['merchantCode'].'\');">'.lang('Nav.edit').'</button>';

                if( $resProfile['data']['role']==2 || ($resProfile['data']['role']==5 && $_SESSION['uplinerole']==2 ) ):
                    $action .= '<a class="btn btn-primary btn-sm" href="'.base_url('settings/payment-gateway/channel/'.base64_encode($pg['bankId']).'/'.$pg['merchantCode']).'">'.lang('Nav.pchannel').'</a>';
                else:
                    $action .= '<a class="btn btn-primary btn-sm" href="'.base_url('user/payment-channel/'.base64_encode($parent).'/'.base64_encode($pg['bankId']).'/'.$pg['merchantCode']).'">'.lang('Nav.pchannel').'</a>';
                endif;

                $action .= '</div>';

                $row = [];
                $row[] = $status;
                $row[] = $pg['merchantCode'];
                $row[] = $pg['bankName']['EN'];
                $row[] = $pg['order'];
                $row[] = $pg['tiedDomain'];
                $row[] = $pg['apiKey'];
                $row[] = $pg['payUrl'];
                $row[] = $pg['callBackUrl'];
                $row[] = $pg['successUrl'];
                $row[] = $pg['failureUrl'];
                $row[] = $pg['remark'];
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(["data"=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function paymentGatewayRawList()
    {
        if( !session()->get('logged_in') ): return false; endif;
        $lng = strtoupper($_SESSION['lang']);

        $parent = !empty($this->request->getpost('params')['parent']) ? base64_decode($this->request->getpost('params')['parent']) : $_SESSION['token'];

        $payload = [
            'userid' => $parent
        ];
        $res = $this->pgateway_model->selectAllPg($payload);
        // echo json_encode($res);

        if( $res['code']==1 && $res['data']!=[] ):
            $data = [];
            foreach( $res['data'] as $pg ):
                if( $pg['status']==1 ):
                    $row = [];
                    $row['status'] = $pg['status'];
                    $row['bankId'] = base64_encode($pg['bankId']);
                    $row['name'] = $pg['bankName'][$lng].'-'.$pg['merchantCode'];
                    $row['merchant'] = $pg['merchantCode'];
                    $data[] = $row;
                endif;
            endforeach;
            echo json_encode([
                'data' => $data, 
                'code' => $res['code'], 
            ]);
        else:
            echo json_encode($res);
        endif;
    }
}