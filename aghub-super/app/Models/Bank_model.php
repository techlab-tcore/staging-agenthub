<?php namespace App\Models;

use CodeIgniter\Model;

class Bank_model extends Model
{
    //MYR
    protected $bankListMYR = 'https://api-ps.2833.online/bank/getlist';
    protected $addBankMYR = 'https://api-ps.2833.online/bank/add';
    protected $bankMYR = 'https://api-ps.2833.online/bank/get';
    protected $editBankMYR = 'https://api-ps.2833.online/bank/edit';

    //TUSDT
    protected $bankListTUSDT = 'https://api-ps2.2833.online/bank/getlist';
    protected $addBankTUSDT = 'https://api-ps2.2833.online/bank/add';
    protected $bankTUSDT = 'https://api-ps2.2833.online/bank/get';
    protected $editBankTUSDT = 'https://api-ps2.2833.online/bank/edit';

    public function __construct()
	{
		$this->db = db_connect();
	}

    public function updateBank($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->editBankMYR); break;
            case 'TUSDT': $ch = curl_init($this->editBankTUSDT); break;
            default: $ch = '';
        endswitch;
        
        //$ch = curl_init($this->editBank);
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

    public function insertBank($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->addBankMYR); break;
            case 'TUSDT': $ch = curl_init($this->addBankTUSDT); break;
            default: $ch = '';
        endswitch;

        //$ch = curl_init($this->addBank);
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

    public function SelectBank($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->bankMYR); break;
            case 'TUSDT': $ch = curl_init($this->bankTUSDT); break;
            default: $ch = '';
        endswitch;
        
        //$ch = curl_init($this->bank);
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

    public function SelectAllBank($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->bankListMYR); break;
            case 'TUSDT': $ch = curl_init($this->bankListTUSDT); break;
            default: $ch = '';
        endswitch;

        //$ch = curl_init($this->bankList);
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