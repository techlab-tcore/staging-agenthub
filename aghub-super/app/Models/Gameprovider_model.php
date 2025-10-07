<?php namespace App\Models;

use CodeIgniter\Model;

class Gameprovider_model extends Model
{
    protected $gpList = 'https://agenthub.koba118.co/settings/gameprovider/getgameproviderlist';
    protected $gp = 'https://agenthub.koba118.co/settings/gameprovider/getgameprovider';

    //MYR
    protected $gpListMYR = 'https://api-ps.2833.online/settings/gameprovider/getgameproviderlist';
    protected $addGpMYR = 'https://api-ps.2833.online/settings/gameprovider/addgameprovider';
    protected $editGpMYR = 'https://api-ps.2833.online/settings/gameprovider/editgameprovider';

    //TUSDT
    protected $gpListTUSDT = 'https://api-ps2.2833.online/settings/gameprovider/getgameproviderlist';
    protected $addGpTUSDT = 'https://api-ps2.2833.online/settings/gameprovider/addgameprovider';
    protected $editGpTUSDT = 'https://api-ps2.2833.online/settings/gameprovider/editgameprovider';

    public function __construct()
	{
		$this->db = db_connect();
	}

    public function updateGameProvider($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->editGpMYR); break;
            case 'TUSDT': $ch = curl_init($this->editGpTUSDT); break;
            default: $ch = '';
        endswitch;

        //$ch = curl_init($this->editGp);
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

    public function insertGameProvider($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->addGpMYR); break;
            case 'TUSDT': $ch = curl_init($this->addGpTUSDT); break;
            default: $ch = '';
        endswitch;

        //$ch = curl_init($this->addGp);
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

    public function selectGp($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        $ch = curl_init($this->gp);
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

    public function selectAllGp($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->gpListMYR); break;
            case 'TUSDT': $ch = curl_init($this->gpListTUSDT); break;
            default: $ch = '';
        endswitch;
        
        //$ch = curl_init($this->gpList);
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