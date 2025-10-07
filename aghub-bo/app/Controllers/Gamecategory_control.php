<?php

namespace App\Controllers;

class Gamecategory_control extends BaseController
{
    public function gameCategoryList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $lng = strtoupper($_SESSION['lang']);

        $payload = [
            'userid' => $_SESSION['token']
        ];
        $res = $this->gamecategory_model->selectAllGameCategory($payload);
        // echo json_encode($res);

        if( $res['code']==1 && $res['data']!=[] ):
            $data = [];
            foreach( $res['data'] as $c ):
                $row = [];
                $row['code'] = $c['code'];
                $row['name'] = $c['name'];
                $row['value'] = $c['value'][$lng];
                $data[] = $row;
            endforeach;
            echo json_encode([
                'code' => $res['code'],
                'message' => $res['message'],
                'data' => $data
            ]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function gameCategoryRawList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $lng = strtoupper($_SESSION['lang']);

        $payload = [
            'userid' => $_SESSION['token']
        ];
        $res = $this->gamecategory_model->selectAllGameCategory($payload);
        // echo json_encode($res);

        if( $res['code']==1 && $res['data']!=[] ):
            $data = [];
            foreach( $res['data'] as $c ):
                $row = [];
                $row['code'] = $c['code'];
                $row['name'] = $c['value'][$lng];
                $data[] = $row;
            endforeach;
            echo json_encode([
                'code' => $res['code'],
                'message' => $res['message'],
                'data' => $data
            ]);
        else:
            echo json_encode(['no data']);
        endif;
    }
}