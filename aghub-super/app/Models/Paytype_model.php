<?php namespace App\Models;

use CodeIgniter\Model;

class Paytype_model extends Model
{
    //MYR
    protected $payTypeListMYR = 'https://api-ps.2833.online/settings/paymenttype/getlist';
    protected $payTypeMYR = 'https://api-ps.2833.online/settings/paymenttype/get';
    protected $editPayTypeMYR = 'https://api-ps.2833.online/settings/paymenttype/edit';

    //TUSDT
    protected $payTypeListTUSDT = 'https://api-ps2.2833.online/settings/paymenttype/getlist';
    protected $payTypeTUSDT = 'https://api-ps2.2833.online/settings/paymenttype/get';
    protected $editPayTypeTUSDT = 'https://api-ps2.2833.online/settings/paymenttype/edit';

    public function __construct()
	{
		$this->db = db_connect();
	}

    public function updatePayType($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->editPayTypeMYR); break;
            case 'TUSDT': $ch = curl_init($this->editPayTypeTUSDT); break;
            default: $ch = '';
        endswitch;
        
        //$ch = curl_init($this->editPayType);
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

    public function selectPayType($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->payTypeMYR); break;
            case 'TUSDT': $ch = curl_init($this->payTypeTUSDT); break;
            default: $ch = '';
        endswitch;
        
        //$ch = curl_init($this->payType);
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

    public function selectAllPayTypes($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->payTypeListMYR); break;
            case 'TUSDT': $ch = curl_init($this->payTypeListTUSDT); break;
            default: $ch = '';
        endswitch;
        
        //$ch = curl_init($this->payTypeList);
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