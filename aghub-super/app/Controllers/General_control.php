<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class General_control extends BaseController
{
    public function index()
	{
		if( session()->get('logged_in') ): return redirect()->to(base_url('dashboard')); endif;
		
		echo view('template/start');
        echo view('index');
		echo view('template/end');
	}

	public function dashboard()
	{
		if( !session()->get('logged_in') ): return false; endif;

		echo view('template/start');
		echo view('template/header');
        echo view('dashboard');
		echo view('template/footer');
		echo view('template/end');
	}

	/*
	Transaction
	*/

	public function index_transaction($currencycode)
	{
		if( !session()->get('logged_in') ): return false; endif;

		$data['secTitle'] = 'Transaction';

		$data['parent'] = base64_encode($_SESSION['token']);
		$data['currencycode'] = $currencycode;

		echo view('template/start');
		echo view('template/header');
        echo view('transaction/index', $data);
		echo view('template/footer');
		echo view('template/end');
	}

	/*
	Administrator
	*/

	public function index_addAdministrator()
	{
		if( !session()->get('logged_in') ): return false; endif;

		$data['secTitle'] = 'Add Administrator';

		echo view('template/start');
		echo view('template/header');
        echo view('administrator/add_admin',$data);
		echo view('template/footer');
		echo view('template/end');
	}

	public function index_administrator()
	{
		if( !session()->get('logged_in') ): return false; endif;

		$data['secTitle'] = 'Administrator List';

		echo view('template/start');
		echo view('template/header');
        echo view('administrator/index',$data);
		echo view('template/footer');
		echo view('template/end');
	}

	/*
	Game Category
	*/

	public function index_gameCategory($parent,$currencycode)
	{
		if( !session()->get('logged_in') ): return false; endif;

		$data['secTitle'] = 'Game Category';
		$data['parent'] = $parent;
		$data['currencycode'] = $currencycode;

		echo view('template/start');
		echo view('template/header');
        echo view('gamecategory/index',$data);
		echo view('template/footer');
		echo view('template/end');
	}

	/*
	Game Provider
	*/

	public function index_games($parent,$provider,$currencycode)
	{
		if( !session()->get('logged_in') ): return false; endif;

		$data['secTitle'] = 'Games';
		$data['parent'] = $parent;
		$data['provider'] = $provider;
		$data['currencycode'] = $currencycode;

		echo view('template/start');
		echo view('template/header');
        echo view('gameprovider/games',$data);
		echo view('template/footer');
		echo view('template/end');
	}

	public function index_gameProvider($parent,$currencycode)
	{
		if( !session()->get('logged_in') ): return false; endif;

		$data['secTitle'] = 'Game Provider List';
		$data['parent'] = $parent;
		$data['currencycode'] = $currencycode;

		echo view('template/start');
		echo view('template/header');
        echo view('gameprovider/index',$data);
		echo view('template/footer');
		echo view('template/end');
	}

	/*
	Game PT
	*/

	public function index_gamePt($parent,$currencycode)
	{
		if( !session()->get('logged_in') ): return false; endif;

		$data['secTitle'] = 'Position Taking';
		$data['parent'] = $parent;
		$data['currencycode'] = $currencycode;

		echo view('template/start');
		echo view('template/header');
        echo view('position-taking/index',$data);
		echo view('template/footer');
		echo view('template/end');
	}

	/*
	Payment Provider
	*/

	public function index_bank($currencycode)
	{
		if( !session()->get('logged_in') ): return false; endif;

		$data['secTitle'] = 'Bank';
		$data['currencycode'] = $currencycode;

		echo view('template/start');
		echo view('template/header');
        echo view('bank/index',$data);
		echo view('template/footer');
		echo view('template/end');
	}

	public function index_pGateway($currencycode)
	{
		if( !session()->get('logged_in') ): return false; endif;

		$data['secTitle'] = 'Payment Gateway';
		$data['currencycode'] = $currencycode;

		echo view('template/start');
		echo view('template/header');
        echo view('payment-gateway/index',$data);
		echo view('template/footer');
		echo view('template/end');
	}

	/*
	Settings
	*/

	public function index_settingLanguage($currencycode)
	{
		if( !session()->get('logged_in') ): return false; endif;

		$data['secTitle'] = 'Languages';
		$data['currencycode'] = $currencycode;

		echo view('template/start');
		echo view('template/header');
        echo view('settings/index',$data);
		echo view('template/footer');
		echo view('template/end');
	}

	public function index_settingCurrency($currencycode)
	{
		if( !session()->get('logged_in') ): return false; endif;

		$data['secTitle'] = 'Currencies';
		$data['currencycode'] = $currencycode;

		echo view('template/start');
		echo view('template/header');
        echo view('settings/currency',$data);
		echo view('template/footer');
		echo view('template/end');
	}

	public function index_settingPaytype($currencycode)
	{
		if( !session()->get('logged_in') ): return false; endif;

		$data['secTitle'] = 'Payment Types';
		$data['currencycode'] = $currencycode;

		echo view('template/start');
		echo view('template/header');
        echo view('settings/payment-type',$data);
		echo view('template/footer');
		echo view('template/end');
	}

	public function index_settingPaystatus($currencycode)
	{
		if( !session()->get('logged_in') ): return false; endif;

		$data['secTitle'] = 'Payment Status';
		$data['currencycode'] = $currencycode;

		echo view('template/start');
		echo view('template/header');
        echo view('settings/payment-status',$data);
		echo view('template/footer');
		echo view('template/end');
	}

	public function index_settingErrorcode($currencycode)
	{
		if( !session()->get('logged_in') ): return false; endif;

		$data['secTitle'] = 'Error Code';
		$data['currencycode'] = $currencycode;

		echo view('template/start');
		echo view('template/header');
        echo view('settings/error-code',$data);
		echo view('template/footer');
		echo view('template/end');
	}

	/*
	Announcement
	*/

	public function index_announcement()
	{
		if( !session()->get('logged_in') ): return false; endif;

		$data['secTitle'] = 'Announcement';

		echo view('template/start');
		echo view('template/header');
        echo view('announcement/index',$data);
		echo view('template/footer');
		echo view('template/end');
	}
}