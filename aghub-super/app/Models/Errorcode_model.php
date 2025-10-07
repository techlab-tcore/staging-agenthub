<?php namespace App\Models;

use CodeIgniter\Model;

class Errorcode_model extends Model
{
    //MYR
    protected $errorCodeListMYR = 'https://api-ps.2833.online/settings/errormessage/geterrormessagelist';
    private $errorCodeMYR = 'https://api-ps.2833.online/settings/errormessage/geterrormessage';
    private $editErrorCodeMYR = 'https://api-ps.2833.online/settings/errormessage/editerrormessage';

    //TUSDT
    protected $errorCodeListTUSDT = 'https://api-ps2.2833.online/settings/errormessage/geterrormessagelist';
    private $errorCodeTUSDT = 'https://api-ps2.2833.online/settings/errormessage/geterrormessage';
    private $editErrorCodeTUSDT = 'https://api-ps2.2833.online/settings/errormessage/editerrormessage';

    public function __construct()
	{
		$this->db = db_connect();
	}

    public function updateErrorCode($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->editErrorCodeMYR); break;
            case 'TUSDT': $ch = curl_init($this->editErrorCodeTUSDT); break;
            default: $ch = '';
        endswitch;
        
       // $ch = curl_init($this->editErrorCode);
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

    public function selectErrorCode($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->errorCodeMYR); break;
            case 'TUSDT': $ch = curl_init($this->errorCodeTUSDT); break;
            default: $ch = '';
        endswitch;
        
        //$ch = curl_init($this->errorCode);
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

    public function selectAllErrorCode($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->errorCodeListMYR); break;
            case 'TUSDT': $ch = curl_init($this->errorCodeListTUSDT); break;
            default: $ch = '';
        endswitch;
        
        //$ch = curl_init($this->errorCodeList);
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