<?php namespace App\Models;

use CodeIgniter\Model;

class Gamecategory_model extends Model
{
    protected $gameCategoryList = '/settings/gamecategory/getgamecategorylist';

    public function __construct()
	{
		$this->db = db_connect();
	}

    public function selectAllGameCategory($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->gameCategoryList);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->gameCategoryList);
        endif;
        
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