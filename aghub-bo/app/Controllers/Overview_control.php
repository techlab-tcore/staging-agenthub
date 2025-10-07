<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Overview_control extends BaseController
{
    public function getStatistics($parent = FALSE)
    {
        if( !session()->get('logged_in') ): return false; endif;

        $user = $parent ? base64_decode($parent) : $_SESSION['token'];

        if( !empty($this->request->getPost('params')['start']) && !empty($this->request->getPost('params')['end']) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($this->request->getPost('params')['start']))));
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($this->request->getPost('params')['end']))));
        else:
            $from = date('c', strtotime(date('Y-m-d 00:00:00')));
            $to = date('c', strtotime(date('Y-m-d 23:59:59')));
        endif;

        $payload = [
            'userid' => $user,
            'timezone' => 8,
            'fromdate' => $from,
            'todate' => $to
        ];
        $res = $this->overview_model->selectAllOverview($payload);
        echo json_encode($res);
    }

    public function getCompanyStatistics($parent = FALSE)
    {
        if( !session()->get('logged_in') ): return false; endif;

        $user = $parent ? base64_decode($parent) : $_SESSION['token'];

        $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime('monday this week'))));
        $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime('sunday this week'))));

        $payload = [
            'userid' => $user,
            'timezone' => 8
        ];
        $res = $this->overview_model->selectAllOverview($payload);
        echo json_encode($res);
    }

    public function getSelfCompanyStatistics($parent = FALSE)
    {
        if( !session()->get('logged_in') ): return false; endif;

        // $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime('monday this week'))));
        // $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime('sunday this week'))));

        if( !empty($this->request->getPost('params')['start']) && !empty($this->request->getPost('params')['end']) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($this->request->getPost('params')['start']))));
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($this->request->getPost('params')['end']))));
        else:
            $from = date('c', strtotime(date('Y-m-d 00:00:00')));
            $to = date('c', strtotime(date('Y-m-d 23:59:59')));
        endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'timezone' => 8,
            'fromdate' => $from,
            'todate' => $to
        ];
        $res = $this->overview_model->selectAllOverview($payload);
        echo json_encode($res);
    }
}