<?php namespace App\Models;

use CodeIgniter\Model;

class Paystatus_model extends Model
{
    //MYR
    protected $payStatusListMYR = 'https://api-ps.2833.online/settings/paymentstatus/getlist';
    protected $payStatusMYR = 'https://api-ps.2833.online/settings/paymentstatus/get';
    protected $editPayStatusMYR = 'https://api-ps.2833.online/settings/paymentstatus/edit';

    //TUSDT
    protected $payStatusListTUSDT = 'https://api-ps2.2833.online/settings/paymentstatus/getlist';
    protected $payStatusTUSDT = 'https://api-ps2.2833.online/settings/paymentstatus/get';
    protected $editPayStatusTUSDT = 'https://api-ps2.2833.online/settings/paymentstatus/edit';

    public function __construct()
	{
		$this->db = db_connect();
	}

    public function updatePayStatus($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->editPayStatusMYR); break;
            case 'TUSDT': $ch = curl_init($this->editPayStatusTUSDT); break;
            default: $ch = '';
        endswitch;
        
        //$ch = curl_init($this->editPayStatus);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload))
        );
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    public function selectPayStatus($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->payStatusMYR); break;
            case 'TUSDT': $ch = curl_init($this->payStatusTUSDT); break;
            default: $ch = '';
        endswitch;
        
        //$ch = curl_init($this->payStatus);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload))
        );
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    public function selectAllPayStatus($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->payStatusListMYR); break;
            case 'TUSDT': $ch = curl_init($this->payStatusListTUSDT); break;
            default: $ch = '';
        endswitch;
        
        //$ch = curl_init($this->payStatusList);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload))
        );
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}