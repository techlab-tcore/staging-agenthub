<?php namespace App\Models;

use CodeIgniter\Model;

class Pgateway_model extends Model
{
    protected $pgList = '/paymentgateway/getlist';
    protected $pgateway = '/paymentgateway/get';
    protected $addPg = '/paymentgateway/add';
    protected $editPg = '/paymentgateway/edit';

    protected $pgDepositPt = '/gatewaydepositpts/get';
    protected $editPgDepositPt = '/gatewaydepositpts/edit';
    protected $pgDepositMinMax = '/gatewaydepositpts/getminmaxpt';
    protected $pgDepositPtList = '/gatewaydepositpts/getgatewaytrxptlist';

    protected $pgWithdrawalPt = '/gatewaywithdrawpts/get';
    protected $editPgWithdrawalPt = '/gatewaywithdrawpts/edit';
    protected $pgWithdrawalMinMax = '/gatewaywithdrawpts/getminmaxpt';
    protected $pgWithdrawalPtList = '/gatewaywithdrawpts/getgatewaytrxptlist';

    public function __construct()
	{
		$this->db = db_connect();
	}

    public function updatePgatewayWithdrawalPt($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->editPgWithdrawalPt);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->editPgWithdrawalPt);
        endif;

        //$ch = curl_init($this->editPgWithdrawalPt);
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

    public function selectPgatewayWithdrawalPt($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->pgWithdrawalPt);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->pgWithdrawalPt);
        endif;

        //$ch = curl_init($this->pgWithdrawalPt);
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

    public function updatePgatewayDepositPt($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->editPgDepositPt);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->editPgDepositPt);
        endif;

        //$ch = curl_init($this->editPgDepositPt);
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

    public function selectMinMaxPgatewayDepositPt($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->pgDepositMinMax);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->pgDepositMinMax);
        endif;

        //$ch = curl_init($this->pgDepositMinMax);
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

    public function selectPgatewayDepositPt($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->pgDepositPt);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->pgDepositPt);
        endif;

        //$ch = curl_init($this->pgDepositPt);
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

    public function selectAllPgatewayDepositPtList($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->pgDepositPtList);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->pgDepositPtList);
        endif;

        //$ch = curl_init($this->pgDepositPtList);
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

    public function updatePg($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        

        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->editPg);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->editPg);
        endif;

        //$ch = curl_init($this->editPg);
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

    public function insertPg($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->addPg);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->addPg);
        endif;
        
        //$ch = curl_init($this->addPg);
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

    public function selectPg($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->pgateway);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->pgateway);
        endif;
        
        //$ch = curl_init($this->pgateway);
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

    public function selectAllPg($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->pgList);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->pgList);
        endif;
        
        //$ch = curl_init($this->pgList);
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