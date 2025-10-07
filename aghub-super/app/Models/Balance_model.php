<?php namespace App\Models;

use CodeIgniter\Model;

class Balance_model extends Model
{
    protected $transactionHistory = 'https://agenthub.koba118.co/payment/getpaymenthistory2';

    //MYR
    protected $userTransferMYR = 'https://api-ps.2833.online/payment/transfer';
    protected $transactionHistoryMYR = 'https://api-ps.2833.online/payment/getpaymenthistory2';

    //TUSDT
    protected $userTransferTUSDT = 'https://api-ps2.2833.online/payment/transfer';
    protected $transactionHistoryTUSDT = 'https://api-ps2.2833.online/payment/getpaymenthistory2';

    public function __construct()
	{
		$this->db = db_connect();
	}

    public function updateUserTransfer($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->userTransferMYR); break;
            case 'TUSDT': $ch = curl_init($this->userTransferTUSDT); break;
            default: $ch = '';
        endswitch;
        
        //$ch = curl_init($this->userTransfer);
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

    public function selectAllTransaction($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->transactionHistoryMYR); break;
            case 'TUSDT': $ch = curl_init($this->transactionHistoryTUSDT); break;
            default: $ch = '';
        endswitch;
        
        //$ch = curl_init($this->transactionHistory);
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