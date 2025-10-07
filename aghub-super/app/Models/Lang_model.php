<?php namespace App\Models;

use CodeIgniter\Model;

class Lang_model extends Model
{
    //MYR
    protected $langListMYR = 'https://api-ps.2833.online/settings/language/getlanguagelist';
    private $editLangMYR = 'https://api-ps.2833.online/settings/language/editlanguage';
    private $addLangMYR = 'https://api-ps.2833.online/settings/language/addlanguage';

    //TUSDT
    protected $langListTUSDT = 'https://api-ps2.2833.online/settings/language/getlanguagelist';
    private $editLangTUSDT = 'https://api-ps2.2833.online/settings/language/editlanguage';
    private $addLangTUSDT = 'https://api-ps2.2833.online/settings/language/addlanguage';

    public function __construct()
	{
		$this->db = db_connect();
	}

    public function updateLanguage($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->editLangMYR); break;
            case 'TUSDT': $ch = curl_init($this->editLangTUSDT); break;
            default: $ch = '';
        endswitch;
        
        //$ch = curl_init($this->editLang);
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

    public function AddLanguage($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->addLangMYR); break;
            case 'TUSDT': $ch = curl_init($this->addLangTUSDT); break;
            default: $ch = '';
        endswitch;
        
        //$ch = curl_init($this->addLang);
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

    public function selectAllLanguage($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->langListMYR); break;
            case 'TUSDT': $ch = curl_init($this->langListTUSDT); break;
            default: $ch = '';
        endswitch;
        
        //$ch = curl_init($this->langList);
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