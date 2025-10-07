<?php

namespace App\Controllers;

class Version_control extends BaseController
{
    public function editVersion()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'type' => (int)$this->request->getpost('params')['type'],
            'value' => $this->request->getpost('params')['version']
        ];
        $res = $this->version_model->updateVersion($payload);
        echo json_encode($res);
    }

    public function version()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'type' => (int)$this->request->getpost('params')['type']
        ];
        $res = $this->version_model->selectVersion($payload);
        echo json_encode($res);
    }

    public function versionList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $res = $this->version_model->selectVersionList([]);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $data = [];
            foreach( $res['data'] as $v ):
                $platform = $v['type']==0 ? 'IOS' : 'Android';

                $action = '<div class="btn-group">';
                $action .= '<button type="button" class="btn btn-primary btn-sm" onclick="modifyVer(\''.$platform.'\',\''.$v['type'].'\',\''.$v['value'].'\');">'.lang('Nav.edit').'</button>';
                $action .= '</div>';

                $row = [];
                $row[] = $platform;
                $row[] = $v['value'];
                $row[] = $action;
                $data[] = $row;
            endforeach;
            echo json_encode(["data"=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }
}