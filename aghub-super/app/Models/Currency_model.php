<?php namespace App\Models;

use CodeIgniter\Model;

class Currency_model extends Model
{

    //MYR
    protected $currencyListMYR = 'https://api-ps.2833.online/settings/currency/getcurrencylist';
    protected $editCurrencyMYR = 'https://api-ps.2833.online/settings/currency/editcurrency';
    protected $addCurrencyMYR = 'https://api-ps.2833.online/settings/currency/addcurrency';

    //TUSDT
    protected $currencyListTUSDT = 'https://api-ps2.2833.online/settings/currency/getcurrencylist';
    protected $editCurrencyTUSDT = 'https://api-ps2.2833.online/settings/currency/editcurrency';
    protected $addCurrencyTUSDT = 'https://api-ps2.2833.online/settings/currency/addcurrency';

    public function __construct()
	{
		$this->db = db_connect();
	}

    public function updateCurrency($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->editCurrencyMYR); break;
            case 'TUSDT': $ch = curl_init($this->editCurrencyTUSDT); break;
            default: $ch = '';
        endswitch;
        
        //$ch = curl_init($this->editCurrency);
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

    public function insertCurrency($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->addCurrencyMYR); break;
            case 'TUSDT': $ch = curl_init($this->addCurrencyTUSDT); break;
            default: $ch = '';
        endswitch;
        
        //$ch = curl_init($this->addCurrency);
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

    public function selectAllCurrencies($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->currencyListMYR); break;
            case 'TUSDT': $ch = curl_init($this->currencyListTUSDT); break;
            default: $ch = '';
        endswitch;
        
        //$ch = curl_init($this->currencyList);
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