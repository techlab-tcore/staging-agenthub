<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Mail_control extends BaseController
{
    public function addMail()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'fromuserid' => $_SESSION['token'], 
            'touserid' => base64_decode($this->request->getpost('params')['recipient']), 
            'title' => $this->request->getpost('params')['title'], 
            'content' => $this->request->getpost('params')['msg']
        ];
        $res = $this->mail_model->insertMail($payload);
        echo json_encode($res);
    }

    public function mailAllList()
    {
        if( !session()->get('logged_in') ): return false; endif;
        
        $raw = json_decode(file_get_contents('php://input'),1);

        $payload = [
            'userid' => base64_decode($raw['parent'])
        ];
        $res = $this->mail_model->selectAllMails($payload);
        // echo json_encode($res);

        if( $res['code']==1 && $res['data']!=[] ):
            $data = [];
            foreach( $res['data'] as $m ):
                $date = Time::parse(date('Y-m-d H:i:s', strtotime($m['createDate'])));
                $created = $date->toDateTimeString();

                $row = [];
                $row[] = $created;
                $row[] = '<small class="d-block w-100 text-secondary">'.lang('Input.title').': '.$m['title'].'</small>'.$m['content'];
                $row[] = $m['toLoginId'];
                $row[] = $m['fromLoginId'];
                $data[] = $row;
            endforeach;
            echo json_encode(['code'=>1,'data'=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }
}