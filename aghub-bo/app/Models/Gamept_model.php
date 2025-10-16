<?php namespace App\Models;

use CodeIgniter\Model;

class Gamept_model extends Model
{
    protected $gamePtList = '/settings/gamepts/getgameptslist';
    protected $editGamePt = '/settings/gamepts/editgamepts';
    protected $minMaxGamePt = '/settings/gamepts/getminmaxpt';

    public function __construct()
	{
		$this->db = db_connect();
	}

    public function updateGamePt($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->editGamePt);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->editGamePt);
        endif;
        
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

    public function selectMinMaxGamePt($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->minMaxGamePt);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->minMaxGamePt);
        endif;
        
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

    public function selectAllGamePt($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        

        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->gamePtList);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->gamePtList);
        endif;

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