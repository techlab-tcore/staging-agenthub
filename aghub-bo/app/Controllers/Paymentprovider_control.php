<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Paymentprovider_control extends BaseController
{
    public function paymentProviderBankList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'paymentmethod' => 1
        ];
        $res = $this->paymentprovider_model->selectAllPaymentProvider($payload);
        echo json_encode($res);
    }

    public function paymentProviderPayGatewayList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token'],
            'paymentmethod' => 2
        ];
        $res = $this->paymentprovider_model->selectAllPaymentProvider($payload);
        echo json_encode($res);
    }

    public function paymentAllProviderBankList()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $payload = [
            'userid' => $_SESSION['token']
        ];
        $res = $this->paymentprovider_model->selectAllPaymentProvider($payload);
        echo json_encode($res);
    }
}