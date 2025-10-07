<?php namespace App\Models;

use CodeIgniter\Model;

class Game_model extends Model
{
    //MYR
    protected $gameListMYR = 'https://api-ps.2833.online/settings/game/getgamelist';
    protected $addGameMYR = 'https://api-ps.2833.online/settings/game/addgame';
    protected $gameMYR = 'https://api-ps.2833.online/settings/game/getgame';
    protected $editGameMYR = 'https://api-ps.2833.online/settings/game/editgame';

    //TUSDT
    protected $gameListTUSDT = 'https://api-ps2.2833.online/settings/game/getgamelist';
    protected $addGameTUSDT = 'https://api-ps2.2833.online/settings/game/addgame';
    protected $gameTUSDT = 'https://api-ps2.2833.online/settings/game/getgame';
    protected $editGameTUSDT = 'https://api-ps2.2833.online/settings/game/editgame';

    public function __construct()
	{
		$this->db = db_connect();
	}

    public function updateGame($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->editGameMYR); break;
            case 'TUSDT': $ch = curl_init($this->editGameTUSDT); break;
            default: $ch = '';
        endswitch;

        //$ch = curl_init($this->editGame);
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

    public function insertGame($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);
        
        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->addGameMYR); break;
            case 'TUSDT': $ch = curl_init($this->addGameTUSDT); break;
            default: $ch = '';
        endswitch;

        //$ch = curl_init($this->addGame);
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

    public function selectGame($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->gameMYR); break;
            case 'TUSDT': $ch = curl_init($this->gameTUSDT); break;
            default: $ch = '';
        endswitch;
        
        //$ch = curl_init($this->game);
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

    public function selectAllGames($where, $currencyCode)
	{
		$data = array_merge(['lang'=>$_SESSION['lang'], 'sessionid'=>$_SESSION['session'], 'agentid'=>$_SESSION['token']], $where);
		$payload = json_encode($data);

        switch( $currencyCode ):
            case 'MYR': $ch = curl_init($this->gameListMYR); break;
            case 'TUSDT': $ch = curl_init($this->gameListTUSDT); break;
            default: $ch = '';
        endswitch;
        
        //$ch = curl_init($this->gameList);
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