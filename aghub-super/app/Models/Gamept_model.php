<?php namespace App\Models;

use CodeIgniter\Model;

class Gamept_model extends Model
{
    //MYR
    protected $gamePtListMYR = 'https://api-ps.2833.online/settings/gamepts/getgameptslist';
    protected $minMaxGamePtMYR = 'https://api-ps.2833.online/settings/gamepts/getminmaxpt';
    protected $editGamePtMYR = 'https://api-ps.2833.online/settings/gamepts/editgamepts';

    //TUSDT
    protected $gamePtListTUSDT = 'https://api-ps2.2833.online/settings/gamepts/getgameptslist';
    protected $minMaxGamePtTUSDT = 'https://api-ps2.2833.online/settings/gamepts/getminmaxpt';
    protected $editGamePtTUSDT = 'https://api-ps2.2833.online/settings/gamepts/editgamepts';

    public function __construct()
	{
		$this->db = db_connect();
	}

    public function updateGamePt($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->editGamePtMYR); break;
            case 'TUSDT': $ch = curl_init($this->editGamePtTUSDT); break;
            default: $ch = '';
        endswitch;
        
        //$ch = curl_init($this->editGamePt);
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

    public function selectMinMaxGamePt($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->minMaxGamePtMYR); break;
            case 'TUSDT': $ch = curl_init($this->minMaxGamePtTUSDT); break;
            default: $ch = '';
        endswitch;
        
        //$ch = curl_init($this->minMaxGamePt);
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

    public function selectAllGamePt($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->gamePtListMYR); break;
            case 'TUSDT': $ch = curl_init($this->gamePtListTUSDT); break;
            default: $ch = '';
        endswitch;
        
        //$ch = curl_init($this->gamePtList);
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