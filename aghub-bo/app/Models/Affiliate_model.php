<?php namespace App\Models;

use CodeIgniter\Model;

class Affiliate_model extends Model
{
    protected $affiliatePtList = '/settings/affiliate/getaffiliateptlist';
    protected $affiliatePt = '/settings/affiliate/getaffiliatept';
    protected $editAffiliatePt = '/settings/affiliate/editaffiliatept';
    protected $minMaxAffiliatePt = '/settings/affiliate/getminmaxpt';

    protected $affiliateHistory = '/settings/affiliate/getaffiliatehistory';

    protected $addAffiliateLevel = '/settings/affiliate/addnewlevel';
    protected $affiliateSettings = '/settings/affiliate/getaffiliatesettings';
    protected $editAffiliateSettings = '/settings/affiliate/editaffiliatesettings';
    protected $editCeilingAffiliate = '/settings/affiliate/editmaxaffiliate';

    public function __construct()
	{
		$this->db = db_connect();
	}

    public function updateCeilingAffiliate($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->editCeilingAffiliate);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->editCeilingAffiliate);
        endif;

        //$ch = curl_init($this->editCeilingAffiliate);
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

    public function updateAffiliateSettings($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->editAffiliateSettings);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->editAffiliateSettings);
        endif;

        //$ch = curl_init($this->editAffiliateSettings);
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

    public function selectAffiliateSettings($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->affiliateSettings);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->affiliateSettings);
        endif;

        //$ch = curl_init($this->affiliateSettings);
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

    public function insertAffililateLevel($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->addAffiliateLevel);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->addAffiliateLevel);
        endif;

        //$ch = curl_init($this->addAffiliateLevel);
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

    public function selectAffiliateHistory($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->affiliateHistory);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->affiliateHistory);
        endif;

        //$ch = curl_init($this->affiliateHistory);
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

    public function updateAffiliatePt($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->editAffiliatePt);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->editAffiliatePt);
        endif;

        //$ch = curl_init($this->editAffiliatePt);
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

    public function selectMinMaxAffiliatePt($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->minMaxAffiliatePt);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->minMaxAffiliatePt);
        endif;

        //$ch = curl_init($this->minMaxAffiliatePt);
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

    public function selectAffiliatePt($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->affiliatePt);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->affiliatePt);
        endif;

        //$ch = curl_init($this->affiliatePt);
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

    public function selectAllAffiliatePt($where)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        if ( $_SESSION['apibycurrency'] == 'MYR' ):
            $ch = curl_init($_ENV['apiMyr'].$this->affiliatePtList);
        else:
            $ch = curl_init($_ENV['apiTusdt'].$this->affiliatePtList);
        endif;

        //$ch = curl_init($this->affiliatePtList);
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