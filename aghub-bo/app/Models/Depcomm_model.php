<?php namespace App\Models;

use CodeIgniter\Model;

class Depcomm_model extends Model
{
    protected $depositCommHistory = '/topupcomm/gethistory';

    protected $depositCommPt = '/topupcomm/get';
    protected $editDepositCommPt = '/topupcomm/edit';
    protected $minMaxDepositCommPt = '/topupcomm/getminmaxpt';
    protected $depositCommPtList = '/topupcomm/gettrxptlist';

    public function __construct()
    {
        $this->db = db_connect();
    }

    public function updateDepositCommPt($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->editDepositCommPt);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->editDepositCommPt);
        endif;


        //$ch = curl_init($this->editDepositCommPt);
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

    public function selectMinMaxDepositCommPt($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->minMaxDepositCommPt);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->minMaxDepositCommPt);
        endif;
        
        //$ch = curl_init($this->minMaxDepositCommPt);
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

    public function selectDepositCommPt($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->depositCommPt);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->depositCommPt);
        endif;

        //$ch = curl_init($this->depositCommPt);
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

    public function selectAllDepositCommPtList($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->depositCommPtList);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->depositCommPtList);
        endif;

        //$ch = curl_init($this->depositCommPtList);
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

    public function selectAllDepositCommHistory($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->depositCommHistory);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->depositCommHistory);
        endif;
        
        //$ch = curl_init($this->depositCommHistory);
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