<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Content_control extends BaseController
{
        /*
    Ag Commission
    */

    public function modifyAgcomm()
    {
        $data = [
            'id' => base64_decode($this->request->getpost('params')['id']), 
            'contentid' => $this->request->getpost('params')['contentid'], 
            'status' => filter_var($this->request->getpost('params')['status'], FILTER_VALIDATE_BOOLEAN)
        ];

        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['titleEN'];
        $param->MY = $this->request->getpost('params')['titleEN'];
        $param->CN = $this->request->getpost('params')['titleEN'];
        //$param->ZH = $this->request->getpost('params')['titleEN'];
        $param->TH = $this->request->getpost('params')['titleEN'];
        $param->VN = $this->request->getpost('params')['titleEN'];
        // $param->BGL = $this->request->getpost('params')['titleEN'];
        // $param->IN = $this->request->getpost('params')['titleEN'];
        $title['title'] = $param;

        $param2 = new \stdClass();
        $param2->EN = '';
        $param2->MY = '';
        $param2->CN = '';
        //$param2->ZH = '';
        $param2->TH = '';
        $param2->VN = '';
        // $param2->BGL = $this->request->getpost('params')['contentEN'];
        // $param2->IN = $this->request->getpost('params')['contentEN'];
        $content['content'] = $param2;

        $param3 = new \stdClass();
        $param3->EN = $this->request->getpost('params')['imgEN'];
        $param3->MY = $this->request->getpost('params')['imgMY'];
        $param3->CN = $this->request->getpost('params')['imgCN'];
        // $param3->ZH = '';
        $param3->TH = $this->request->getpost('params')['imgTH'];
        $param3->VN = $this->request->getpost('params')['imgVN'];
        // $param3->BGL = '';
        // $param3->IN = '';
        $thumbnail['thumbnail'] = $param3;

        $payload = array_merge($data,$title,$content,$thumbnail);

        $res = $this->content_model->updateContent($payload);
        echo json_encode($res);
    }

    public function addAgcomm()
    {
        $data = [
            'contentid' => 'AGCOM'.date('YmdHis'), 
            'status' => filter_var($this->request->getpost('params')['status'], FILTER_VALIDATE_BOOLEAN)
        ];

        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['titleEN'];
        $param->MY = $this->request->getpost('params')['titleEN'];
        $param->CN = $this->request->getpost('params')['titleEN'];
        // $param->ZH = $this->request->getpost('params')['titleEN'];
        $param->TH = $this->request->getpost('params')['titleTH'];
        $param->VN = $this->request->getpost('params')['titleVN'];
        // $param->BGL = $this->request->getpost('params')['titleEN'];
        // $param->IN = $this->request->getpost('params')['titleEN'];
        $title['title'] = $param;

        $param2 = new \stdClass();
        $param2->EN = '';
        $param2->MY = '';
        $param2->CN = '';
        // $param2->ZH = $this->request->getpost('params')['contentEN'];
        $param2->TH = '';
        $param2->VN = '';
        // $param2->BGL = $this->request->getpost('params')['contentEN'];
        // $param2->IN = $this->request->getpost('params')['contentEN'];
        $content['content'] = $param2;

        $param3 = new \stdClass();
        $param3->EN = $this->request->getpost('params')['imgEN'];
        $param3->MY = $this->request->getpost('params')['imgMY'];
        $param3->CN = $this->request->getpost('params')['imgCN'];
        // $param3->ZH = '';
        $param3->TH = $this->request->getpost('params')['imgTH'];
        $param3->VN = $this->request->getpost('params')['imgVN'];
        // $param3->BGL = '';
        // $param3->IN = '';
        $thumbnail['thumbnail'] = $param3;

        $payload = array_merge($data,$title,$content,$thumbnail);

        $res = $this->content_model->insertContent($payload);
        echo json_encode($res);
    }

    public function agcommList()
    {
        $lng = strtoupper($_SESSION['lang']);

        $payload = [
            // 'contentid' => $this->request->getpost('params')['contentid'], 
        ];
        $res = $this->content_model->selectAllContents($payload);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $data = [];
            foreach( $res['data'] as $c ):
                $verify = substr($c['contentId'],0,5);
                if( $verify=='AGCOM' ):
                    switch( $c['status'] ):
                        case TRUE: $status = lang('Label.active'); break;
                        case FALSE: $status = lang('Label.inactive'); break;
                        default: $status='';
                    endswitch;

                    $action = '<div class="btn-groups" role="group">';
                    $action .= '<a class="btn btn-primary btn-sm" href="'.base_url('extra/agcomm-config/modify/'.base64_encode($c['id'])).'/'.$c['contentId'].'">'.lang('Nav.edit').'</a>';
                    $action .= '</div>';

                    $row = [];
                    $row[] = '<span class="badge bg-primary me-1">'.$status.'</span>'.$c['contentId'];
                    $row[] = $c['title'][$lng];
                    $row[] = !empty($c['thumbnail'][$lng]) ? '<a target="_blank" href="'.$c['thumbnail'][$lng].'">'.$c['thumbnail'][$lng].'</a>' : '---';
                    //$row[] = !empty($c['content'][$lng]) ? $c['content'][$lng] : '---';
                    $row[] = $action;
                    $data[] = $row;
                endif;
            endforeach;
            echo json_encode(["data"=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }
    
    /*
    News
    */

    public function modifyNewsSeo()
    {
        $data = [
            'id' => base64_decode($this->request->getpost('params')['id']), 
            'contentid' => $this->request->getpost('params')['contentid'], 
            'status' => filter_var($this->request->getpost('params')['status'], FILTER_VALIDATE_BOOLEAN)
        ];

        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['titleEN'];
        $param->MY = $this->request->getpost('params')['titleMY'];
        $param->CN = $this->request->getpost('params')['titleCN'];
        // $param->ZH = $this->request->getpost('params')['titleEN'];
        $param->TH = $this->request->getpost('params')['titleTH'];
        $param->VN = $this->request->getpost('params')['titleVN'];
        // $param->BGL = $this->request->getpost('params')['titleEN'];
        // $param->IN = $this->request->getpost('params')['titleEN'];
        $title['title'] = $param;

        $param2 = new \stdClass();
        $param2->EN = $this->request->getpost('params')['contentEN'];
        $param2->MY = $this->request->getpost('params')['contentMY'];
        $param2->CN = $this->request->getpost('params')['contentCN'];
        // $param2->ZH = $this->request->getpost('params')['contentEN'];
        $param2->TH = $this->request->getpost('params')['contentTH'];
        $param2->VN = $this->request->getpost('params')['contentVN'];
        // $param2->BGL = $this->request->getpost('params')['contentEN'];
        // $param2->IN = $this->request->getpost('params')['contentEN'];
        $content['content'] = $param2;

        $param3 = new \stdClass();
        $param3->EN = '';
        $param3->MY = '';
        $param3->CN = '';
        // $param3->ZH = '';
        $param3->TH = '';
        $param3->VN = '';
        // $param3->BGL = '';
        // $param3->IN = '';
        $thumbnail['thumbnail'] = $param3;

        $payload = array_merge($data,$title,$content,$thumbnail);

        $res = $this->content_model->updateContent($payload);
        echo json_encode($res);
    }

    public function addNewsSeo()
    {
        $data = [
            'contentid' => 'NEWS'.date('YmdHis'), 
            'status' => filter_var($this->request->getpost('params')['status'], FILTER_VALIDATE_BOOLEAN)
        ];

        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['titleEN'];
        $param->MY = $this->request->getpost('params')['titleMY'];
        $param->CN = $this->request->getpost('params')['titleCN'];
        // $param->ZH = $this->request->getpost('params')['titleEN'];
        $param->TH = $this->request->getpost('params')['titleTH'];
        $param->VN = $this->request->getpost('params')['titleVN'];
        // $param->BGL = $this->request->getpost('params')['titleEN'];
        // $param->IN = $this->request->getpost('params')['titleEN'];
        $title['title'] = $param;

        $param2 = new \stdClass();
        $param2->EN = $this->request->getpost('params')['contentEN'];
        $param2->MY = $this->request->getpost('params')['contentMY'];
        $param2->CN = $this->request->getpost('params')['contentCN'];
        // $param2->ZH = $this->request->getpost('params')['contentEN'];
        $param2->TH = $this->request->getpost('params')['contentTH'];
        $param2->VN = $this->request->getpost('params')['contentVN'];
        // $param2->BGL = $this->request->getpost('params')['contentEN'];
        // $param2->IN = $this->request->getpost('params')['contentEN'];
        $content['content'] = $param2;

        $param3 = new \stdClass();
        $param3->EN = $this->request->getpost('params')['imgEN'];
        $param3->MY = $this->request->getpost('params')['imgMY'];
        $param3->CN = $this->request->getpost('params')['imgCN'];
        // $param3->ZH = '';
        $param3->TH = $this->request->getpost('params')['imgTH'];
        $param3->VN = $this->request->getpost('params')['imgVN'];
        // $param3->BGL = '';
        // $param3->IN = '';
        $thumbnail['thumbnail'] = $param3;

        $payload = array_merge($data,$title,$content,$thumbnail);

        $res = $this->content_model->insertContent($payload);
        echo json_encode($res);
    }

    public function newsList()
    {
        $lng = strtoupper($_SESSION['lang']);

        $payload = [
            // 'contentid' => $this->request->getpost('params')['contentid'], 
        ];
        $res = $this->content_model->selectAllContents($payload);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $data = [];
            foreach( $res['data'] as $c ):
                $verify = substr($c['contentId'],0,4);
                if( $verify=='NEWS' ):
                    switch( $c['status'] ):
                        case TRUE: $status = lang('Label.active'); break;
                        case FALSE: $status = lang('Label.inactive'); break;
                        default: $status='';
                    endswitch;

                    $action = '<div class="btn-groups" role="group">';
                    $action .= '<a class="btn btn-primary btn-sm" href="'.base_url('extra/news-config/modify/'.base64_encode($c['id'])).'/'.$c['contentId'].'">'.lang('Nav.edit').'</a>';
                    $action .= '</div>';

                    $row = [];
                    $row[] = '<span class="badge bg-primary me-1">'.$status.'</span>'.$c['contentId'];
                    $row[] = $c['title'][$lng];
                    // $row[] = !empty($c['thumbnail'][$lng]) ? '<a target="_blank" href="'.$c['thumbnail'][$lng].'">'.$c['thumbnail'][$lng].'</a>' : '---';
                    $row[] = !empty($c['content'][$lng]) ? $c['content'][$lng] : '---';
                    $row[] = $action;
                    $data[] = $row;
                endif;
            endforeach;
            echo json_encode(["data"=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    /*
    SEO
    */

    public function modifyMetaSeo()
    {
        $data = [
            'id' => base64_decode($this->request->getpost('params')['id']), 
            'contentid' => $this->request->getpost('params')['contentid'], 
            'status' => filter_var($this->request->getpost('params')['status'], FILTER_VALIDATE_BOOLEAN)
        ];

        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['titleEN'];
        $param->MY = $this->request->getpost('params')['titleMY'];
        $param->CN = $this->request->getpost('params')['titleCN'];
        // $param->ZH = $this->request->getpost('params')['titleEN'];
        $param->TH = $this->request->getpost('params')['titleTH'];
        $param->VN = $this->request->getpost('params')['titleVN'];
        // $param->BGL = $this->request->getpost('params')['titleEN'];
        // $param->IN = $this->request->getpost('params')['titleEN'];
        $title['title'] = $param;

        $param2 = new \stdClass();
        $param2->EN = $this->request->getpost('params')['contentEN'];
        $param2->MY = $this->request->getpost('params')['contentMY'];
        $param2->CN = $this->request->getpost('params')['contentCN'];
        // $param2->ZH = $this->request->getpost('params')['contentEN'];
        $param2->TH = $this->request->getpost('params')['contentTH'];
        $param2->VN = $this->request->getpost('params')['contentVN'];
        // $param2->BGL = $this->request->getpost('params')['contentEN'];
        // $param2->IN = $this->request->getpost('params')['contentEN'];
        $content['content'] = $param2;

        $param3 = new \stdClass();
        $param3->EN = '';
        $param3->MY = '';
        $param3->CN = '';
        // $param3->ZH = '';
        // $param3->TH = '';
        // $param3->VN = '';
        // $param3->BGL = '';
        // $param3->IN = '';
        $thumbnail['thumbnail'] = $param3;

        $payload = array_merge($data,$title,$content,$thumbnail);

        $res = $this->content_model->updateContent($payload);
        echo json_encode($res);
    }

    public function addMetaSeo()
    {
        $data = [
            'contentid' => 'SEO'.date('YmdHis'), 
            'status' => filter_var($this->request->getpost('params')['status'], FILTER_VALIDATE_BOOLEAN)
        ];

        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['titleEN'];
        $param->MY = $this->request->getpost('params')['titleMY'];
        $param->CN = $this->request->getpost('params')['titleCN'];
        // $param->ZH = $this->request->getpost('params')['titleEN'];
        $param->TH = $this->request->getpost('params')['titleTH'];
        $param->VN = $this->request->getpost('params')['titleVN'];
        // $param->BGL = $this->request->getpost('params')['titleEN'];
        // $param->IN = $this->request->getpost('params')['titleEN'];
        $title['title'] = $param;

        $param2 = new \stdClass();
        $param2->EN = $this->request->getpost('params')['contentEN'];
        $param2->MY = $this->request->getpost('params')['contentMY'];
        $param2->CN = $this->request->getpost('params')['contentCN'];
        // $param2->ZH = $this->request->getpost('params')['contentEN'];
        $param2->TH = $this->request->getpost('params')['contentTH'];
        $param2->VN = $this->request->getpost('params')['contentVN'];
        // $param2->BGL = $this->request->getpost('params')['contentEN'];
        // $param2->IN = $this->request->getpost('params')['contentEN'];
        $content['content'] = $param2;

        $param3 = new \stdClass();
        $param3->EN = $this->request->getpost('params')['imgEN'];
        $param3->MY = $this->request->getpost('params')['imgMY'];
        $param3->CN = $this->request->getpost('params')['imgCN'];
        // $param3->ZH = '';
        $param3->TH = $this->request->getpost('params')['imgTH'];
        $param3->VN = $this->request->getpost('params')['imgVN'];
        // $param3->BGL = '';
        // $param3->IN = '';
        $thumbnail['thumbnail'] = $param3;

        $payload = array_merge($data,$title,$content,$thumbnail);

        $res = $this->content_model->insertContent($payload);
        echo json_encode($res);
    }

    public function seoList()
    {
        $lng = strtoupper($_SESSION['lang']);

        $payload = [
            // 'contentid' => $this->request->getpost('params')['contentid'], 
        ];
        $res = $this->content_model->selectAllContents($payload);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $data = [];
            foreach( $res['data'] as $c ):
                $verify = substr($c['contentId'],0,3);
                if( $verify=='SEO' ):
                    switch( $c['status'] ):
                        case TRUE: $status = lang('Label.active'); break;
                        case FALSE: $status = lang('Label.inactive'); break;
                        default: $status='';
                    endswitch;

                    $action = '<div class="btn-groups" role="group">';
                    $action .= '<a class="btn btn-primary btn-sm" href="'.base_url('extra/seo-config/modify/'.base64_encode($c['id'])).'/'.$c['contentId'].'">'.lang('Nav.edit').'</a>';
                    $action .= '</div>';

                    $row = [];
                    $row[] = '<span class="badge bg-primary me-1">'.$status.'</span>'.$c['contentId'];
                    $row[] = $c['title'][$lng];
                    // $row[] = !empty($c['thumbnail'][$lng]) ? '<a target="_blank" href="'.$c['thumbnail'][$lng].'">'.$c['thumbnail'][$lng].'</a>' : '---';
                    $row[] = !empty($c['content'][$lng]) ? $c['content'][$lng] : '---';
                    $row[] = $action;
                    $data[] = $row;
                endif;
            endforeach;
            echo json_encode(["data"=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    /*
    Affiliate LossRebate Content
    */

    public function addAffLBContent()
    {
        $data = [
            'contentid' => 'AFFLB'.date('YmdHis'), 
            'status' => filter_var($this->request->getpost('params')['status'], FILTER_VALIDATE_BOOLEAN)
        ];

        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['titleEN'];
        $param->MY = $this->request->getpost('params')['titleMY'];
        $param->CN = $this->request->getpost('params')['titleCN'];
        // $param->ZH = $this->request->getpost('params')['titleCN'];
        $param->TH = $this->request->getpost('params')['titleTH'];
        $param->VN = $this->request->getpost('params')['titleVN'];
        // $param->BGL = $this->request->getpost('params')['titleEN'];
        // $param->IN = $this->request->getpost('params')['titleIN'];
        $title['title'] = $param;

        $param2 = new \stdClass();
        $param2->EN = $this->request->getpost('params')['contentEN'];
        $param2->MY = $this->request->getpost('params')['contentMY'];
        $param2->CN = $this->request->getpost('params')['contentCN'];
        // $param2->ZH = $this->request->getpost('params')['contentCN'];
        $param2->TH = $this->request->getpost('params')['contentTH'];
        $param2->VN = $this->request->getpost('params')['contentVN'];
        // $param2->BGL = $this->request->getpost('params')['contentEN'];
        // $param2->IN = $this->request->getpost('params')['contentIN'];
        $content['content'] = $param2;

        $param3 = new \stdClass();
        $param3->EN = $this->request->getpost('params')['imgEN'];
        $param3->MY = $this->request->getpost('params')['imgMY'];
        $param3->CN = $this->request->getpost('params')['imgCN'];
        // $param3->ZH = $this->request->getpost('params')['imgCN'];
        $param3->TH = $this->request->getpost('params')['imgTH'];
        $param3->VN = $this->request->getpost('params')['imgVN'];
        // $param3->BGL = $this->request->getpost('params')['imgEN'];
        // $param3->IN = $this->request->getpost('params')['imgIN'];
        $thumbnail['thumbnail'] = $param3;

        $payload = array_merge($data,$title,$content,$thumbnail);

        $res = $this->content_model->insertContent($payload);
        echo json_encode($res);
    }

    public function getAffLBContentList()
    {
        $lng = strtoupper($_SESSION['lang']);

        $payload = [
            // 'contentid' => $this->request->getpost('params')['contentid'], 
        ];
        $res = $this->content_model->selectAllContents($payload);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $data = [];
            foreach( $res['data'] as $c ):
                $verify = substr($c['contentId'],0,5);
                if( $verify=='AFFLB' ):
                    switch( $c['status'] ):
                        case TRUE: $status = lang('Label.active'); break;
                        case FALSE: $status = lang('Label.inactive'); break;
                        default: $status='';
                    endswitch;

                    $action = '<div class="btn-groups" role="group">';
                    $action .= '<a class="btn btn-primary btn-sm" href="'.base_url('settings/contents/modify/'.base64_encode($c['id'])).'/'.$c['contentId'].'">'.lang('Nav.edit').'</a>';
                    $action .= '</div>';

                    $row = [];
                    $row[] = '<span class="badge bg-primary me-1">'.$status.'</span>'.$c['contentId'];
                    $row[] = $c['title'][$lng];
                    $row[] = !empty($c['thumbnail'][$lng]) ? '<a target="_blank" href="'.$c['thumbnail'][$lng].'">'.$c['thumbnail'][$lng].'</a>' : '---';
                    $row[] = !empty($c['content'][$lng]) ? $c['content'][$lng] : '---';
                    $row[] = $action;
                    $data[] = $row;
                endif;
            endforeach;
            echo json_encode(["data"=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    /*
    Read-Only Promotion Content
    */

    public function modifyPromoContent()
    {
        $data = [
            'id' => base64_decode($this->request->getpost('params')['id']), 
            'contentid' => $this->request->getpost('params')['contentid'], 
            'status' => filter_var($this->request->getpost('params')['status'], FILTER_VALIDATE_BOOLEAN)
        ];

        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['titleEN'];
        $param->MY = $this->request->getpost('params')['titleMY'];
        $param->CN = $this->request->getpost('params')['titleCN'];
        // $param->ZH = $this->request->getpost('params')['titleCN'];
        $param->TH = $this->request->getpost('params')['titleTH'];
        $param->VN = $this->request->getpost('params')['titleVN'];
        // $param->BGL = $this->request->getpost('params')['titleEN'];
        // $param->IN = $this->request->getpost('params')['titleIN'];
        $title['title'] = $param;

        $param2 = new \stdClass();
        $param2->EN = $this->request->getpost('params')['contentEN'];
        $param2->MY = $this->request->getpost('params')['contentMY'];
        $param2->CN = $this->request->getpost('params')['contentCN'];
        // $param2->ZH = $this->request->getpost('params')['contentCN'];
        $param2->TH = $this->request->getpost('params')['contentTH'];
        $param2->VN = $this->request->getpost('params')['contentVN'];
        // $param2->BGL = $this->request->getpost('params')['contentEN'];
        // $param2->IN = $this->request->getpost('params')['contentIN'];
        $content['content'] = $param2;

        $param3 = new \stdClass();
        $param3->EN = $this->request->getpost('params')['imgEN'];
        $param3->MY = $this->request->getpost('params')['imgMY'];
        $param3->CN = $this->request->getpost('params')['imgCN'];
        // $param3->ZH = $this->request->getpost('params')['imgCN'];
        $param3->TH = $this->request->getpost('params')['imgTH'];
        $param3->VN = $this->request->getpost('params')['imgVN'];
        // $param3->BGL = $this->request->getpost('params')['imgEN'];
        // $param3->IN = $this->request->getpost('params')['imgIN'];
        $thumbnail['thumbnail'] = $param3;

        $payload = array_merge($data,$title,$content,$thumbnail);

        $res = $this->content_model->updateContent($payload);
        echo json_encode($res);
    }

    public function addPromoContent()
    {
        $data = [
            'contentid' => 'PRO'.date('YmdHis'), 
            'status' => filter_var($this->request->getpost('params')['status'], FILTER_VALIDATE_BOOLEAN)
        ];

        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['titleEN'];
        $param->MY = $this->request->getpost('params')['titleMY'];
        $param->CN = $this->request->getpost('params')['titleCN'];
        // $param->ZH = $this->request->getpost('params')['titleCN'];
        $param->TH = $this->request->getpost('params')['titleTH'];
        $param->VN = $this->request->getpost('params')['titleVN'];
        // $param->BGL = $this->request->getpost('params')['titleEN'];
        // $param->IN = $this->request->getpost('params')['titleIN'];
        $title['title'] = $param;

        $param2 = new \stdClass();
        $param2->EN = $this->request->getpost('params')['contentEN'];
        $param2->MY = $this->request->getpost('params')['contentMY'];
        $param2->CN = $this->request->getpost('params')['contentCN'];
        // $param2->ZH = $this->request->getpost('params')['contentCN'];
        $param2->TH = $this->request->getpost('params')['contentTH'];
        $param2->VN = $this->request->getpost('params')['contentVN'];
        // $param2->BGL = $this->request->getpost('params')['contentEN'];
        // $param2->IN = $this->request->getpost('params')['contentIN'];
        $content['content'] = $param2;

        $param3 = new \stdClass();
        $param3->EN = $this->request->getpost('params')['imgEN'];
        $param3->MY = $this->request->getpost('params')['imgMY'];
        $param3->CN = $this->request->getpost('params')['imgCN'];
        // $param3->ZH = $this->request->getpost('params')['imgCN'];
        $param3->TH = $this->request->getpost('params')['imgTH'];
        $param3->VN = $this->request->getpost('params')['imgVN'];
        // $param3->BGL = $this->request->getpost('params')['imgEN'];
        // $param3->IN = $this->request->getpost('params')['imgIN'];
        $thumbnail['thumbnail'] = $param3;

        $payload = array_merge($data,$title,$content,$thumbnail);

        $res = $this->content_model->insertContent($payload);
        echo json_encode($res);
    }

    public function getPromoContentList()
    {
        $lng = strtoupper($_SESSION['lang']);

        $payload = [
            // 'contentid' => $this->request->getpost('params')['contentid'], 
        ];
        $res = $this->content_model->selectAllContents($payload);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $data = [];
            foreach( $res['data'] as $c ):
                $verify = substr($c['contentId'],0,3);
                if( $verify=='PRO' ):
                    switch( $c['status'] ):
                        case TRUE: $status = lang('Label.active'); break;
                        case FALSE: $status = lang('Label.inactive'); break;
                        default: $status='';
                    endswitch;

                    $action = '<div class="btn-groups" role="group">';
                    $action .= '<a class="btn btn-primary btn-sm" href="'.base_url('settings/contents/modify/'.base64_encode($c['id'])).'/'.$c['contentId'].'">'.lang('Nav.edit').'</a>';
                    $action .= '</div>';

                    $row = [];
                    $row[] = '<span class="badge bg-primary me-1">'.$status.'</span>'.$c['contentId'];
                    $row[] = $c['title'][$lng];
                    $row[] = !empty($c['thumbnail'][$lng]) ? '<a target="_blank" href="'.$c['thumbnail'][$lng].'">'.$c['thumbnail'][$lng].'</a>' : '---';
                    $row[] = !empty($c['content'][$lng]) ? $c['content'][$lng] : '---';
                    $row[] = $action;
                    $data[] = $row;
                endif;
            endforeach;
            echo json_encode(["data"=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    /*
    Contents
    */

    public function modifyContent()
    {
        $data = [
            'id' => base64_decode($this->request->getpost('params')['id']), 
            'contentid' => $this->request->getpost('params')['contentid'], 
        ];

        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['titleEN'];
        $param->MY = $this->request->getpost('params')['titleMY'];
        $param->CN = $this->request->getpost('params')['titleCN'];
        $param->ZH = $this->request->getpost('params')['titleCN'];
        $param->TH = $this->request->getpost('params')['titleEN'];
        $param->VN = $this->request->getpost('params')['titleEN'];
        $param->BGL = $this->request->getpost('params')['titleEN'];
        $title['title'] = $param;

        $param2 = new \stdClass();
        $param2->EN = $this->request->getpost('params')['contentEN'];
        $param2->MY = $this->request->getpost('params')['contentMY'];
        $param2->CN = $this->request->getpost('params')['contentCN'];
        $param2->ZH = $this->request->getpost('params')['contentCN'];
        $param2->TH = $this->request->getpost('params')['contentEN'];
        $param2->VN = $this->request->getpost('params')['contentEN'];
        $param2->BGL = $this->request->getpost('params')['contentEN'];
        $content['content'] = $param2;

        $param3 = new \stdClass();
        $param3->EN = $this->request->getpost('params')['imgEN'];
        $param3->MY = $this->request->getpost('params')['imgMY'];
        $param3->CN = $this->request->getpost('params')['imgCN'];
        $param3->ZH = $this->request->getpost('params')['imgCN'];
        $param3->TH = $this->request->getpost('params')['imgEN'];
        $param3->VN = $this->request->getpost('params')['imgEN'];
        $param3->BGL = $this->request->getpost('params')['imgEN'];
        $thumbnail['thumbnail'] = $param3;

        $payload = array_merge($data,$title,$content,$thumbnail);

        $res = $this->content_model->updateContent($payload);
        echo json_encode($res);
    }

    public function addContent()
    {
        $data = [
            'contentid' => 'PRO'.date('YmdHis'), 
        ];

        $param = new \stdClass();
        $param->EN = $this->request->getpost('params')['titleEN'];
        $param->MY = $this->request->getpost('params')['titleMY'];
        $param->CN = $this->request->getpost('params')['titleCN'];
        $param->ZH = $this->request->getpost('params')['titleCN'];
        $param->TH = $this->request->getpost('params')['titleEN'];
        $param->VN = $this->request->getpost('params')['titleEN'];
        $param->BGL = $this->request->getpost('params')['titleEN'];
        $title['title'] = $param;

        $param2 = new \stdClass();
        $param2->EN = $this->request->getpost('params')['contentEN'];
        $param2->MY = $this->request->getpost('params')['contentMY'];
        $param2->CN = $this->request->getpost('params')['contentCN'];
        $param2->ZH = $this->request->getpost('params')['contentCN'];
        $param2->TH = $this->request->getpost('params')['contentEN'];
        $param2->VN = $this->request->getpost('params')['contentEN'];
        $param2->BGL = $this->request->getpost('params')['contentEN'];
        $content['content'] = $param2;

        $param3 = new \stdClass();
        $param3->EN = $this->request->getpost('params')['imgEN'];
        $param3->MY = $this->request->getpost('params')['imgMY'];
        $param3->CN = $this->request->getpost('params')['imgCN'];
        $param3->ZH = $this->request->getpost('params')['imgCN'];
        $param3->TH = $this->request->getpost('params')['imgEN'];
        $param3->VN = $this->request->getpost('params')['imgEN'];
        $param3->BGL = $this->request->getpost('params')['imgEN'];
        $thumbnail['thumbnail'] = $param3;

        $payload = array_merge($data,$title,$content,$thumbnail);

        $res = $this->content_model->insertContent($payload);
        echo json_encode($res);
    }

    public function getContent()
    {
        $payload = [
            'id' => base64_decode($this->request->getpost('params')['id']),
        ];
        $res = $this->content_model->selectContent($payload);
        echo json_encode($res);

        // if( $res['code'] == 1 && $res['data'] != [] ):
        //     foreach( $res['data'] as $c ):
        //         $row = [];
        //         $row[] = $c['contentId'];
        //         $row[] = $c['title'];
        //         $row[] = $c['thumbnail'];
        //         $row[] = $c['content'];
        //     endforeach;
        //     echo json_encode([
        //         'code' => $res['code'],
        //         'message' => $res['message'],
        //         'data' => $row
        //     ]);
        // else:
        // endif;
    }

    public function getContentList()
    {
        $lng = strtoupper($_SESSION['lang']);

        $payload = [
            // 'contentid' => $this->request->getpost('params')['contentid'], 
        ];
        $res = $this->content_model->selectAllContents($payload);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $data = [];
            foreach( $res['data'] as $c ):
                $action = '<div class="btn-groups" role="group">';
                $action .= '<button type="button" class="btn btn-primary btn-sm" onclick="modify(\''.base64_encode($c['id']).'\');">'.lang('Nav.edit').'</button>';
                $action .= '</div>';

                $row = [];
                $row[] = $c['contentId'];
                $row[] = $c['title'][$lng];
                $row[] = !empty($c['thumbnail'][$lng]) ? '<a target="_blank" href="'.$c['thumbnail'][$lng].'">'.$c['thumbnail'][$lng].'</a>' : '---';
                $row[] = !empty($c['content'][$lng]) ? $c['content'][$lng] : '---';
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(["data"=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }
}