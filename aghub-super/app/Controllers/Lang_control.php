<?php

namespace App\Controllers;

class Lang_control extends BaseController
{
    public function modifyLang()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('params')['currencycode'];
        $payload = [
            'userid' => $_SESSION['token'],
            'code' => $this->request->getpost('params')['code'],
            'name' => $this->request->getpost('params')['language'],
        ];
        $res = $this->lang_model->updateLanguage($payload, $currencyCode );
        echo json_encode($res);
    }

    public function addLang()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('params')['currencycode'];
        $payload = [
            'userid' => $_SESSION['token'],
            'code' => $this->request->getpost('params')['code'],
            'name' => $this->request->getpost('params')['language'],
        ];
        $res = $this->lang_model->AddLanguage($payload, $currencyCode );
        echo json_encode($res);
    }

    public function langList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $currencyCode = $this->request->getpost('currencycode');
        $payload = [
            'userid' => $_SESSION['token'],
        ];
        $res = $this->lang_model->selectAllLanguage($payload, $currencyCode);
        // echo json_encode($res);

        if( $res['code']==1 && $res['data']!=[] ):
            $data = [];
            foreach( $res['data'] as $s ):
                $action = '<button type="button" class="btn btn-light btn-sm" onclick="editLang(\''.$s['code'].'\',\''.$s['name'].'\',\''.$currencyCode.'\')">Edit</button>';

                $row = [];
                $row[] = $s['code'];
                $row[] = $s['name'];
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(["data"=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }
}