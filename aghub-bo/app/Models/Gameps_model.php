<?php namespace App\Models;

use CodeIgniter\Model;

class Gameps_model extends Model
{
    protected $companyPsSettings = '/settings/gamepss/getadminpssettings';
    protected $editCompanyPsSettings = '/settings/gamepss/editadminpssettings';

    protected $agPsSettings = '/settings/gamepss/getagentps';
    protected $editAgPsSettings = '/settings/gamepss/editagentps';
    protected $minMaxAgPsSettings = '/settings/gamepss/getminmaxps';
    protected $editAgPsExpenses = '/settings/gamepss/editpsexpensespercentage';
    protected $minMaxAgPsExpenses = '/settings/gamepss/getminmaxpsexpenses';

    protected $psGroup5 = '/settings/gamepss/getgametransactionpslistbygroup5';
    protected $psGroup4 = '/settings/gamepss/getgametransactionpslistbygroup4';
    protected $psGroup3 = '/settings/gamepss/getgametransactionpslistbygroup3';

    public function __construct()
	{
		$this->db = db_connect();
	}

    public function selectPsSummary4($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
        // $data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session']], $where);
		$payload = json_encode($data);
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->psGroup4);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->psGroup4);
        endif;
        
        //$ch = curl_init($this->psGroup4);
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

    public function selectPsSummary($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
        // $data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session']], $where);
		$payload = json_encode($data);
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->psGroup5);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->psGroup5);
        endif;
        
        //$ch = curl_init($this->psGroup5);
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

    public function updateAgentPsExpenses($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->editAgPsExpenses);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->editAgPsExpenses);
        endif;
        
        //$ch = curl_init($this->editAgPsExpenses);
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

    public function selectMinMaxAgentPsExpenses($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->minMaxAgPsExpenses);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->minMaxAgPsExpenses);
        endif;
        
        //$ch = curl_init($this->minMaxAgPsExpenses);
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

    public function selectMinMaxAgentPsSettings($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->minMaxAgPsSettings);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->minMaxAgPsSettings);
        endif;
        
        //$ch = curl_init($this->minMaxAgPsSettings);
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

    public function updateAgentPsSettings($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->editAgPsSettings);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->editAgPsSettings);
        endif;
        
        //$ch = curl_init($this->editAgPsSettings);
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

    public function selectAgentPsSettings($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->agPsSettings);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->agPsSettings);
        endif;
        
        //$ch = curl_init($this->agPsSettings);
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

    public function updateCompanyPsSettings($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->editCompanyPsSettings);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->editCompanyPsSettings);
        endif;

        //$ch = curl_init($this->editCompanyPsSettings);
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

    public function selectCompanyPsSettings($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->companyPsSettings);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->companyPsSettings);
        endif;
        
        //$ch = curl_init($this->companyPsSettings);
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