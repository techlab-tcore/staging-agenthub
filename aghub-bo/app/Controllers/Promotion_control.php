<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Promotion_control extends BaseController
{
    protected function executeGameCategory()
    {
        $res = $this->gamecategory_model->selectAllGameCategory([
            'userid' => $_SESSION['token'],
        ]);
        return $res;
    }

    /*
    After Pay
    */

    public function claimAfterHistory()
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

        $payload = $this->promotion_model->selectAllAfterPayList([
            'userid' => $_SESSION['token'],
            'fromdate' => $from,
            'todate' => $to,
            'bydate' => (int)$raw['bydate'],
            'desc' => true,
            'pageindex' => (int)$raw['pageindex'],
            'rowperpage' => (int)$raw['rowperpage'],
        ]);
        // echo json_encode($payload);

        if( $payload['code'] == 1 && $payload['data'] != [] ):
            $cate = $this->executeGameCategory();

            $data = [];
            foreach( $payload['data'] as $h ):
                switch($h['category']):
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

                $date = Time::parse(date('Y-m-d H:i:s', strtotime($h['createdDate'])));
                $created = $date->toDateTimeString();

                $date2 = Time::parse(date('Y-m-d H:i:s', strtotime($h['claimDate'])));
                $claimed = $date2->toDateTimeString();

                $row = [];
                $row[] = $h['paymentId'].'<br><small class="badge bg-dark fw-normal">PromoPayID: '.$h['promotionPaymentId'].'</small>';
                $row[] = $created.'<br><small class="badge bg-dark fw-normal">Claim Date: '.$claimed.'</small>';
                $row[] = '<small class="badge bg-primary fw-normal me-1">'.$category.'</small>'.$h['gameProviderId'];
                $row[] = $h['currentTurnover'].' | <small class="badge bg-primary fw-normal me-1">Required: '.$h['totalTurnover'].'</small>';
                $row[] = $h['amount'];
                $data[] = $row;
            endforeach;
            echo json_encode(['data'=>$data, 'code'=>1, 'pageIndex'=>$payload['pageIndex'], 'rowPerPage'=>$payload['rowPerPage'], 'totalPage'=>$payload['totalPage'], 'totalRecord'=>$payload['totalRecord']]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    /*
    DIY Promotion
    */

    public function modifyDiyPromoStatus()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'promotionid' => base64_decode($this->request->getpost('params')['promoid']),
            'status' => (int)$this->request->getpost('params')['status']
        ];
        $res = $this->promotion_model->updateDiyPromo($payload);
        echo json_encode($res);
    }

    public function modifyDiyPromotion()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $data = [
            'userid' => $_SESSION['token'],
            'promotionid' => base64_decode($this->request->getpost('params')['promoid']),
            'deductagentbalance' => 2,
            'percentage' => (float)$this->request->getpost('params')['bonusRate'],
        ];
        
        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['titleEN'];
        $param->MY = $this->request->getpost('params')['titleMY'];
        $param->CN = $this->request->getpost('params')['titleCN'];
        $param->ZH = $this->request->getpost('params')['titleCN'];
        $param->TH = $this->request->getpost('params')['titleTH'];
        $param->VN = $this->request->getpost('params')['titleVN'];
        $param->BGL = $this->request->getpost('params')['titleBGL'];
        $param->BUR = $this->request->getpost('params')['titleBUR'];
        $param->IN = $this->request->getpost('params')['titleIN'];
        $title['title'] = $param;

        $param2 = new \stdClass();
        $param2->EN = $this->request->getpost('params')['en'];
        $param2->MY = $this->request->getpost('params')['my'];
        $param2->CN = $this->request->getpost('params')['cn'];
        $param2->ZH = $this->request->getpost('params')['cn'];
        $param2->TH = $this->request->getpost('params')['th'];
        $param2->VN = $this->request->getpost('params')['vn'];
        $param2->BGL = $this->request->getpost('params')['bgl'];
        $param2->BUR = $this->request->getpost('params')['bur'];
        $param2->IN = $this->request->getpost('params')['in'];
        $content['content'] = $param2;

        $param3 = new \stdClass();
        $param3->EN = $this->request->getpost('params')['imgEN'];
        $param3->MY = $this->request->getpost('params')['imgMY'];
        $param3->CN = $this->request->getpost('params')['imgCN'];
        $param3->ZH = $this->request->getpost('params')['imgCN'];
        $param3->TH = $this->request->getpost('params')['imgTH'];
        $param3->VN = $this->request->getpost('params')['imgVN'];
        $param3->BGL = $this->request->getpost('params')['imgBGL'];
        $param3->BUR = $this->request->getpost('params')['imgBUR'];
        $param3->IN = $this->request->getpost('params')['imgIN'];
        $banner['thumbnail'] = $param3;

        $payload = array_merge($data, $content, $title, $banner);
        $res = $this->promotion_model->updateDiyPromo($payload);
        echo json_encode($res);
    }

    public function addDiyPromotion()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $data = [
            'userid' => $_SESSION['token'],
            'deductagentbalance' => 2,
            'gameprovidercode' => $this->request->getpost('params')['gameprovider'],
            'percentage' => (float)$this->request->getpost('params')['bonusRate']
        ];
        
        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['titleEN'];
        $param->MY = $this->request->getpost('params')['titleMY'];
        $param->CN = $this->request->getpost('params')['titleCN'];
        $param->ZH = $this->request->getpost('params')['titleCN'];
        $param->TH = $this->request->getpost('params')['titleTH'];
        $param->VN = $this->request->getpost('params')['titleVN'];
        $param->BGL = $this->request->getpost('params')['titleBGL'];
        $param->BUR = $this->request->getpost('params')['titleBUR'];
        $param->IN = $this->request->getpost('params')['titleIN'];
        $title['title'] = $param;

        $param2 = new \stdClass();
        $param2->EN = $this->request->getpost('params')['en'];
        $param2->MY = $this->request->getpost('params')['my'];
        $param2->CN = $this->request->getpost('params')['cn'];
        $param2->ZH = $this->request->getpost('params')['cn'];
        $param2->TH = $this->request->getpost('params')['th'];
        $param2->VN = $this->request->getpost('params')['vn'];
        $param2->BGL = $this->request->getpost('params')['bgl'];
        $param2->BUR = $this->request->getpost('params')['bur'];
        $param2->IN = $this->request->getpost('params')['in'];
        $content['content'] = $param2;

        $param3 = new \stdClass();
        $param3->EN = $this->request->getpost('params')['imgEN'];
        $param3->MY = $this->request->getpost('params')['imgMY'];
        $param3->CN = $this->request->getpost('params')['imgCN'];
        $param3->ZH = $this->request->getpost('params')['imgCN'];
        $param3->TH = $this->request->getpost('params')['imgTH'];
        $param3->VN = $this->request->getpost('params')['imgVN'];
        $param3->BGL = $this->request->getpost('params')['imgBGL'];
        $param3->BUR = $this->request->getpost('params')['imgBUR'];
        $param3->IN = $this->request->getpost('params')['imgIN'];
        $banner['thumbnail'] = $param3;

        $payload = array_merge($data, $content, $title, $banner);
        $res = $this->promotion_model->insertDiyPromo($payload);
        echo json_encode($res);
    }

    public function getDiyPromotion()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'promotionid' => base64_decode($this->request->getpost('params')['promoid'])
        ];
        $res = $this->promotion_model->selectDiyPromo($payload);
        echo json_encode($res);
    }

    public function DiyPromotionList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token']
        ];
        $res = $this->promotion_model->selectAllDiyPromo($payload);
        // echo json_encode($res);

        if( $res['code']==1 && $res['data']!=[] ):
            $lng = strtoupper($_SESSION['lang']);
            
            $data = [];
            foreach( $res['data'] as $p ):
                $date = Time::parse(date('Y-m-d H:i:s', strtotime($p['modifyDate'])));
                $modifiedDate = $date->toDateTimeString();

                switch($p['status']):
                    case 1: $status = lang('Label.active'); break;
                    case 2: $status = lang('Label.inactive'); break;
                    default: $status = '';
                endswitch;

                switch($p['deductAgentBalance']):
                    case 1: $uplineDeduct = lang('Label.enable'); break;
                    case 2: $uplineDeduct = lang('Label.disable'); break;
                endswitch;

                $action = '<div class="btn-groups">';
                $action .= '<a class="btn btn-primary btn-sm" href="'.base_url('settings/open-DIY-promotion/modify/'.base64_encode($p['promotionId'])).'"><i class="las la-cog"></i></a>';
                if( $p['status']==1 ):
                    $action .= '<a class="btn btn-success btn-sm bg-gradient" href="javascript:void(0);" onclick="modifyDiyStatus(\''.base64_encode($p['promotionId']).'\', 2)">'.lang('Label.active').'</a>';
                elseif( $p['status']==2 ):
                    $action .= '<a class="btn btn-danger btn-sm bg-gradient" href="javascript:void(0);" onclick="modifyDiyStatus(\''.base64_encode($p['promotionId']).'\', 1)">'.lang('Label.inactive').'</a>';
                endif;
                $action .= '</div>';

                $row = [];
                $row[] = $status;
                // $row[] = $p['deductAgentBalance'];
                $row[] = $p['gameProviderCode'];
                $row[] = $p['title'][$lng];
                $row[] = $p['percentage'].'%';
                $row[] = $modifiedDate;
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(['data'=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function DiyPromotionHistory()
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

        $payload = [
            'userid' => $_SESSION['token'],
            'fromdate' => $from,
            'todate' => $to,
            'desc' => true,
            'pageindex' => $raw['pageindex'],
            'rowperpage' => $raw['rowperpage'],
        ];
        $res = $this->promotion_model->selectAllDiyPromoHistory($payload);
        // echo json_encode($res);

        if( $res['code']==1 && $res['data']!=[] ):
            $data = [];
            foreach( $res['data'] as $ph ):
                $date = Time::parse(date('Y-m-d H:i:s', strtotime($ph['createDate'])));
                $created = $date->toDateTimeString();

                $action = '<div class="btn-groups">';
                $action .= '</div>';

                $row = [];
                $row[] = $created;
                $row[] = '<span class="badge bg-dark me-1">'.$ph['ip'].'</span>'.$ph['loginId'];
                $row[] = $ph['name'];
                $row[] = $ph['percentage'].'%';
                $row[] = $ph['amount'];
                $row[] = $ph['promotionAmount'];
                $data[] = $row;
            endforeach;
            echo json_encode([
                'code' => 1, 
                'data' => $data, 
                'pageIndex' => $res['pageIndex'], 
                'rowPerPage' => $res['rowPerPage'], 
                'totalPage' => $res['totalPage'], 
                'totalRecord' => $res['totalRecord'],
                'totalDeposit' => $res['totalAmount'],
                'totalBonus' => $res['totalPromotion']
            ]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    /*
    Promotion
    */

    public function modifyStatus()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'promotionid' => base64_decode($this->request->getpost('params')['promoid']),
            'status' => (int)$this->request->getpost('params')['status']
        ];
        $res = $this->promotion_model->updatePromotion($payload);
        echo json_encode($res);
    }

    public function addPromotion()
    {
        if( !session()->get('logged_in') ): return false; endif;

        if( !empty($this->request->getpost('params')['start5']) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($this->request->getpost('params')['start5']))));
        else:
            $from = null;
        endif;

        if( !empty($this->request->getpost('params')['end5']) ):
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($this->request->getpost('params')['end5']))));
        else:
            $to = null;
        endif;
        
        if( $this->request->getpost('params')['triggerWallet']==1 ):
            $triggerType = (int)$this->request->getpost('params')['triggerType'];
            if( $this->request->getpost('params')['triggerType']==1 ):
                // Game Provider
                $gprovider = $this->request->getpost('params')['gameprovider'];
                $category = null;
                $chipgroup = null;
            elseif( $this->request->getpost('params')['triggerType']==2 ):
                // Game Category
                $category = (int)$this->request->getpost('params')['gcate'];
                $gprovider = null;
                $chipgroup = null;
            else:
                // Chip Group
                $category = null;
                $gprovider = null;
                $chipgroup = $this->request->getpost('params')['chipgroup'];
            endif;
        else:
            $triggerType = 0;
            $category = null;
            $gprovider = null;
            $chipgroup = null;
        endif;

        $data = [
            'userid' => $_SESSION['token'],
            'afterincrease' => filter_var($this->request->getpost('params')['afterpay'], FILTER_VALIDATE_BOOLEAN),
            'totalresitby' => (int)$this->request->getpost('params')['resittype'],
            'totalresit' => (int)$this->request->getpost('params')['totalreceipt'],
            'actualamount' => (float)$this->request->getpost('params')['actualAmount'],
            'triggerwallet' => (int)$this->request->getpost('params')['triggerWallet'],
            'triggertype' => $triggerType,
            'category' => $category,
            'gameprovidercode' => $gprovider,
            'deductagentbalance' => 2,
            'percentage' => (float)$this->request->getpost('params')['bonusRate'],
            'depositstatus' => 1,
            'withdrawalstatus' => 2,
            'mindeposit' => (float)$this->request->getpost('params')['minDeposit'],
            'maxdeposit' => (float)$this->request->getpost('params')['maxDeposit'],
            'maxpromotion' => (float)$this->request->getpost('params')['maxBonus'],
            'minturnover' => (float)$this->request->getpost('params')['minTurnover'],
            'rollover' => (float)$this->request->getpost('params')['rollover'],
            'startdate' => $from,
            'enddate' => $to,
            'onlyonce' => $this->request->getpost('params')['activeMethod']==1 ? 1 : 2,
            'weekonce' => $this->request->getpost('params')['activeMethod']==2 ? 1 : 2,
            'monthonce' => $this->request->getpost('params')['activeMethod']==3 ? 1 : 2,
            'dayonce' => $this->request->getpost('params')['activeMethod']==4 ? 1 : 2,
            'days' => $this->request->getpost('params')['activeMethod']==5 ? array_map('intval', $this->request->getpost('params')['spDay']) : [],
            'randomamount' => filter_var($this->request->getpost('params')['random'], FILTER_VALIDATE_BOOLEAN),
            'maxactualamount' => (float)$this->request->getpost('params')['maxrandom'],
            'claimcount' => (int)$this->request->getpost('params')['numclaim'],
            'intervalmin' => (int)$this->request->getpost('params')['mins'],
            'afterclaim' => filter_var($this->request->getpost('params')['contclaim'], FILTER_VALIDATE_BOOLEAN),
            'afterclaimday' => (int)$this->request->getpost('params')['contclaimday'],
            'maxwithdrawal' => (float)$this->request->getpost('params')['maxWithdrawal'],
            'togroupname' => $chipgroup
        ];

        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['titleEN'];
        $param->MY = $this->request->getpost('params')['titleMY'];
        $param->CN = $this->request->getpost('params')['titleCN'];
        $param->ZH = $this->request->getpost('params')['titleCN'];
        $param->TH = $this->request->getpost('params')['titleTH'];
        $param->VN = $this->request->getpost('params')['titleVN'];
        $param->BGL = $this->request->getpost('params')['titleBGL'];
        $param->BUR = $this->request->getpost('params')['titleBUR'];
        $param->IN = $this->request->getpost('params')['titleIN'];
        $title['title'] = $param;

        $param2 = new \stdClass();
        $param2->EN = $this->request->getpost('params')['en'];
        $param2->MY = $this->request->getpost('params')['my'];
        $param2->CN = $this->request->getpost('params')['cn'];
        $param2->ZH = $this->request->getpost('params')['cn'];
        $param2->TH = $this->request->getpost('params')['th'];
        $param2->VN = $this->request->getpost('params')['vn'];
        $param2->BGL = $this->request->getpost('params')['bgl'];
        $param2->BUR = $this->request->getpost('params')['bur'];
        $param2->IN = $this->request->getpost('params')['in'];
        $content['content'] = $param2;

        $param3 = new \stdClass();
        $param3->EN = $this->request->getpost('params')['imgEN'];
        $param3->MY = $this->request->getpost('params')['imgMY'];
        $param3->CN = $this->request->getpost('params')['imgCN'];
        $param3->ZH = $this->request->getpost('params')['imgCN'];
        $param3->TH = $this->request->getpost('params')['imgTH'];
        $param3->VN = $this->request->getpost('params')['imgVN'];
        $param3->BGL = $this->request->getpost('params')['imgBGL'];
        $param3->BUR = $this->request->getpost('params')['imgBUR'];
        $param3->IN = $this->request->getpost('params')['imgIN'];
        $banner['thumbnail'] = $param3;

        $payload = array_merge($data, $content, $title, $banner);

        $res = $this->promotion_model->insertPromotion($payload);
        echo json_encode($res);
    }

    public function modifyPromotion()
    {
        if( !session()->get('logged_in') ): return false; endif;

        if( !empty($this->request->getpost('params')['start5']) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($this->request->getpost('params')['start5']))));
        else:
            $from = null;
        endif;

        if( !empty($this->request->getpost('params')['end5']) ):
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($this->request->getpost('params')['end5']))));
        else:
            $to = null;
        endif;
        
        if( $this->request->getpost('params')['triggerWallet']==1 ):
            $triggerType = (int)$this->request->getpost('params')['triggerType'];
            if( $this->request->getpost('params')['triggerType']==1 ):
                // Game Provider
                $gprovider = $this->request->getpost('params')['gameprovider'];
                $category = null;
                $chipgroup = null;
            elseif( $this->request->getpost('params')['triggerType']==2 ):
                // Game Category
                $category = (int)$this->request->getpost('params')['gcate'];
                $gprovider = null;
                $chipgroup = null;
            else:
                // Chip Group
                $category = null;
                $gprovider = null;
                $chipgroup = $this->request->getpost('params')['chipgroup'];
            endif;
        else:
            $triggerType = 0;
            $category = null;
            $gprovider = null;
            $chipgroup = null;
        endif;

        $data = [
            'userid' => $_SESSION['token'],
            'promotionid' => base64_decode($this->request->getpost('params')['promoid']),
            'afterincrease' => filter_var($this->request->getpost('params')['afterpay'], FILTER_VALIDATE_BOOLEAN),
            'totalresitby' => (int)$this->request->getpost('params')['resittype'],
            'totalresit' => (int)$this->request->getpost('params')['totalreceipt'],
            'actualamount' => (float)$this->request->getpost('params')['actualAmount'],
            'triggerwallet' => (int)$this->request->getpost('params')['triggerWallet'],
            'triggertype' => $triggerType,
            'category' => $category,
            'gameprovidercode' => $gprovider,
            'deductagentbalance' => 2,
            'percentage' => (float)$this->request->getpost('params')['bonusRate'],
            'depositstatus' => 1,
            'withdrawalstatus' => 2,
            'mindeposit' => (float)$this->request->getpost('params')['minDeposit'],
            'maxdeposit' => (float)$this->request->getpost('params')['maxDeposit'],
            'maxpromotion' => (float)$this->request->getpost('params')['maxBonus'],
            'minturnover' => (float)$this->request->getpost('params')['minTurnover'],
            'rollover' => (float)$this->request->getpost('params')['rollover'],
            'startdate' => $from,
            'enddate' => $to,
            'onlyonce' => $this->request->getpost('params')['activeMethod']==1 ? 1 : 2,
            'weekonce' => $this->request->getpost('params')['activeMethod']==2 ? 1 : 2,
            'monthonce' => $this->request->getpost('params')['activeMethod']==3 ? 1 : 2,
            'dayonce' => $this->request->getpost('params')['activeMethod']==4 ? 1 : 2,
            'days' => $this->request->getpost('params')['activeMethod']==5 ? array_map('intval', $this->request->getpost('params')['spDay']) : [],
            'order' => (int)$this->request->getpost('params')['order'],
            'randomamount' => filter_var($this->request->getpost('params')['random'], FILTER_VALIDATE_BOOLEAN),
            'maxactualamount' => (float)$this->request->getpost('params')['maxrandom'],
            'claimcount' => (int)$this->request->getpost('params')['numclaim'],
            'intervalmin' => (int)$this->request->getpost('params')['mins'],
            'afterclaim' => filter_var($this->request->getpost('params')['contclaim'], FILTER_VALIDATE_BOOLEAN),
            'afterclaimday' => (int)$this->request->getpost('params')['contclaimday'],
            'maxwithdrawal' => (float)$this->request->getpost('params')['maxWithdrawal'],
            'status' => 1,
            'togroupname' => $chipgroup
        ];

        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['titleEN'];
        $param->MY = $this->request->getpost('params')['titleMY'];
        $param->CN = $this->request->getpost('params')['titleCN'];
        $param->ZH = $this->request->getpost('params')['titleCN'];
        $param->TH = $this->request->getpost('params')['titleTH'];
        $param->VN = $this->request->getpost('params')['titleVN'];
        $param->BGL = $this->request->getpost('params')['titleBGL'];
        $param->BUR = $this->request->getpost('params')['titleBUR'];
        $param->IN = $this->request->getpost('params')['titleIN'];
        $title['title'] = $param;

        $param2 = new \stdClass();
        $param2->EN = $this->request->getpost('params')['en'];
        $param2->MY = $this->request->getpost('params')['my'];
        $param2->CN = $this->request->getpost('params')['cn'];
        $param2->ZH = $this->request->getpost('params')['cn'];
        $param2->TH = $this->request->getpost('params')['th'];
        $param2->VN = $this->request->getpost('params')['vn'];
        $param2->BGL = $this->request->getpost('params')['bgl'];
        $param2->BUR = $this->request->getpost('params')['bur'];
        $param2->IN = $this->request->getpost('params')['in'];
        $content['content'] = $param2;

        $param3 = new \stdClass();
        $param3->EN = $this->request->getpost('params')['imgEN'];
        $param3->MY = $this->request->getpost('params')['imgMY'];
        $param3->CN = $this->request->getpost('params')['imgCN'];
        $param3->ZH = $this->request->getpost('params')['imgCN'];
        $param3->TH = $this->request->getpost('params')['imgTH'];
        $param3->VN = $this->request->getpost('params')['imgVN'];
        $param3->BGL = $this->request->getpost('params')['imgBGL'];
        $param3->BUR = $this->request->getpost('params')['imgBUR'];
        $param3->IN = $this->request->getpost('params')['imgIN'];
        $banner['thumbnail'] = $param3;

        $payload = array_merge($data, $content, $title, $banner);

        $res = $this->promotion_model->updatePromotion($payload);
        echo json_encode($res);
    }

    public function getPromotion()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'promotionid' => base64_decode($this->request->getpost('params')['promoid'])
        ];
        $res = $this->promotion_model->selectPromotion($payload);
        echo json_encode($res);
    }

    public function promotionList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'category' => 0,
            'type' => 0
        ];
        $res = $this->promotion_model->selectAllPromotion($payload);
        // echo json_encode($res);

        if( $res['code']==1 && $res['data']!=[] ):
            $lng = strtoupper($_SESSION['lang']);
            $cate = $this->executeGameCategory();

            $data = [];
            foreach( $res['data'] as $p ):
                switch($p['status']):
                    case 1: $status = lang('Label.active'); break;
                    case 2: $status = lang('Label.inactive'); break;
                    default: $status = '';
                endswitch;

                switch($p['category']):
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

                // TriggerWallet types
                switch($p['triggerType']):
                    case 1:
                        $promoType = lang('Label.games');
                        $targetPromo = $promoType.'<span class="badge bg-primary fw-normal ms-1">'.$p['gameProviderCode'].'</span>';
                    break;
                    case 2:
                        $promoType = lang('Input.category');
                        $targetPromo = $promoType.'<span class="badge bg-info fw-normal ms-1">'.$category.'</span>';
                    break;
                    case 4:
                        $promoType = lang('Input.chipgroup');
                        $targetPromo = $promoType.'<span class="badge bg-warning fw-normal ms-1">'.$p['toGroupName'].'</span>';
                    break;
                    default:
                        $targetPromo = '---';
                endswitch;

                // All amount of bonus and deposit become chip and locked in game
                switch($p['triggerWallet']):
                    case 1: $triggerType = lang('Label.yes'); break;
                    case 2: $triggerType = lang('Label.no'); break;
                endswitch;

                switch($p['deductAgentBalance']):
                    case 1: $uplineDeduct = lang('Label.enable'); break;
                    case 2: $uplineDeduct = lang('Label.disable'); break;
                endswitch;

                $day = '';
                if( $p['days']!=[] ):
                    foreach($p['days'] as $d):
                        switch($d):
                            case 0: $d = lang('Label.sunday'); break;
                            case 1: $d = lang('Label.monday'); break;
                            case 2: $d = lang('Label.tuesday'); break;
                            case 3: $d = lang('Label.wednesday'); break;
                            case 4: $d = lang('Label.thursday'); break;
                            case 5: $d = lang('Label.friday'); break;
                            case 6: $d = lang('Label.saturday'); break;
                            default:
                                $d = '';
                        endswitch;
                        $day .= $d!=end($p['days']) ? $d.', ' : $d;
                    endforeach;
                else:
                    $day = '---';
                endif;

                $date = Time::parse(date('Y-m-d H:i:s', strtotime($p['startDate'])));
                $startDate = $date->toDateTimeString();
                
                $date2 = Time::parse(date('Y-m-d H:i:s', strtotime($p['endDate'])));
                $endDate = $date2->toDateTimeString();

                switch($p['onlyOnce']):
                    case 1: $onlyOnce = lang('Label.yes'); break;
                    case 2: $onlyOnce = lang('Label.no'); break;
                    default: $onlyOnce = '';
                endswitch;

                switch($p['weekOnce']):
                    case 1: $weekOnce = lang('Label.yes'); break;
                    case 2: $weekOnce = lang('Label.no'); break;
                    default: $weekOnce = '';
                endswitch;

                switch($p['monthOnce']):
                    case 1: $monthOnce = lang('Label.yes'); break;
                    case 2: $monthOnce = lang('Label.no'); break;
                    default: $monthOnce = '';
                endswitch;

                switch($p['dayOnce']):
                    case 1: $dayOnce = lang('Label.yes'); break;
                    case 2: $dayOnce = lang('Label.no'); break;
                    default: $dayOnce = '';
                endswitch;

                switch($p['depositStatus']):
                    case 1: $depositStatus = lang('Label.yes'); break;
                    case 2: $depositStatus = lang('Label.no'); break;
                    default: $depositStatus = '';
                endswitch;

                switch($p['withdrawalStatus']):
                    case 1: $withdrawalStatus = lang('Label.yes'); break;
                    case 2: $withdrawalStatus = lang('Label.no'); break;
                    default: $withdrawalStatus = '';
                endswitch;

                switch($p['randomAmount']):
                    case true: $random = lang('Label.yes'); break;
                    case false: $random = lang('Label.no'); break;
                    default: $random = '';
                endswitch;

                switch($p['totalResitBy']):
                    case 1: $resitby = lang('Label.deposit'); break;
                    case 2: $resitby = lang('Label.withdrawal'); break;
                    default: $resitby = '';
                endswitch;

                switch($p['afterClaim']):
                    case true: $contclaim = lang('Label.yes'); break;
                    case false: $contclaim = lang('Label.no'); break;
                    default: $contclaim = '';
                endswitch;

                $date3 = Time::parse(date('Y-m-d H:i:s', strtotime($p['modifyDate'])));
                $modifiedDate = $date3->toDateTimeString();

                $action = '<div class="btn-groups">';
                $action .= '<a class="btn btn-vw btn-sm" href="'.base_url('settings/open-promotion/modify/'.base64_encode($p['promotionId'])).'">'.lang('Nav.edit').'</a>';
                if( $p['status']==1 ):
                    $action .= '<a class="btn btn-success btn-sm bg-gradient" href="javascript:void(0);" onclick="modifyPromoStatus(\''.base64_encode($p['promotionId']).'\', 2)">'.lang('Label.active').'</a>';
                elseif( $p['status']==2 ):
                    $action .= '<a class="btn btn-danger btn-sm bg-gradient" href="javascript:void(0);" onclick="modifyPromoStatus(\''.base64_encode($p['promotionId']).'\', 1)">'.lang('Label.inactive').'</a>';
                endif;
                $action .= '</div>';

                $row = [];
                $row[] = $status;
                $row[] = $triggerType;
                // $row[] = $uplineDeduct;
                $row[] = $targetPromo;
                $row[] = $p['title'][$lng];
                $row[] = $random;
                $row[] = $p['percentage'].'%/'.$p['actualAmount'].'/'.$p['maxActualAmount'];
                $row[] = $p['rollover'];
                $row[] = $p['minTurnover'];
                $row[] = $p['minDeposit'].'-'.$p['maxDeposit'];
                $row[] = $p['maxPromotion'];
                $row[] = !empty($p['startDate']) ? $startDate : '---';
                $row[] = !empty($p['endDate']) ? $endDate : '---';
                $row[] = '<span class="badge bg-primary fw-normal me-1">'.$resitby.'</span>'.lang('Input.totalreceipt').': '.$p['totalResit'];
                $row[] = $p['claimCount'].'<span class="badge bg-primary fw-normal ms-1">'.lang('Input.mins').': '.$p['intervalMin'].'</span>';
                $row[] = $contclaim.'<span class="badge bg-primary fw-normal ms-1">'.lang('Input.days').': '.$p['afterClaimDay'].'</span>';
                $row[] = $onlyOnce;
                $row[] = $weekOnce;
                $row[] = $monthOnce;
                $row[] = $dayOnce;
                $row[] = $day;
                $row[] = $depositStatus;
                $row[] = $withdrawalStatus;
                $row[] = $p['order'];
                $row[] = $modifiedDate;
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(['data'=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function rawPromotionList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'category' => 0,
            'type' => 0
        ];
        $res = $this->promotion_model->selectAllPromotion($payload);
        echo json_encode($res);
    }
}