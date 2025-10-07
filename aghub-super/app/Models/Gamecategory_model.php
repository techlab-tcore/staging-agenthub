<?php namespace App\Models;

use CodeIgniter\Model;

class Gamecategory_model extends Model
{
    protected $gameCategoryList = 'https://agenthub.koba118.co/settings/gamecategory/getgamecategorylist';

    //MYR
    protected $gameCategoryListMYR = 'https://api-ps.2833.online/settings/gamecategory/getgamecategorylist';
    private $gameCategoryMYR = 'https://api-ps.2833.online/settings/gamecategory/getgamecategory';
    private $editGameCategoryMYR = 'https://api-ps.2833.online/settings/gamecategory/editgamecategory';

    //TUSDT
    protected $gameCategoryListTUSDT = 'https://api-ps2.2833.online/settings/gamecategory/getgamecategorylist';
    private $gameCategoryTUSDT = 'https://api-ps2.2833.online/settings/gamecategory/getgamecategory';
    private $editGameCategoryTUSDT = 'https://api-ps2.2833.online/settings/gamecategory/editgamecategory';

    public function __construct()
	{
		$this->db = db_connect();
	}

    public function updateGameCategory($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->editGameCategoryMYR); break;
            case 'TUSDT': $ch = curl_init($this->editGameCategoryTUSDT); break;
            default: $ch = '';
        endswitch;
        
        //$ch = curl_init($this->editGameCategory);
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

    public function selectGameCategory($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->gameCategoryMYR); break;
            case 'TUSDT': $ch = curl_init($this->gameCategoryTUSDT); break;
            default: $ch = '';
        endswitch;
        
        //$ch = curl_init($this->gameCategory);
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

    public function selectAllGameCategory($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->gameCategoryListMYR); break;
            case 'TUSDT': $ch = curl_init($this->gameCategoryListTUSDT); break;
            default: $ch = '';
        endswitch;
        
        //$ch = curl_init($this->gameCategoryList);
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