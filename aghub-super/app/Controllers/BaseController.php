<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\User_model;
use App\Models\Balance_model;
use App\Models\Gamecategory_model;
use App\Models\Gameprovider_model;
use App\Models\Game_model;
use App\Models\Gamept_model;
use App\Models\Currency_model;
use App\Models\Bank_model;
use App\Models\Lang_model;
use App\Models\Paytype_model;
use App\Models\Paystatus_model;
use App\Models\Errorcode_model;
use App\Models\Announcement_model;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	/**
	 * Instance of the main Request object.
	 *
	 * @var IncomingRequest|CLIRequest
	 */
	protected $request;

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['url','form','text','filesystem','date','array','language','security'];

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.: $this->session = \Config\Services::session();

		// Libraries
		$session = \Config\Services::session();
		$language = \Config\Services::language();
		$security = \Config\Services::security();
		$validation =  \Config\Services::validation();

		!$session->lang ? $session->set('lang', 'en') : '';
		$language->setLocale($session->lang);

		// Models
		$this->user_model = new user_model();
		$this->balance_model = new balance_model();
		$this->gamecategory_model = new gamecategory_model();
		$this->gameprovider_model = new gameprovider_model();
		$this->game_model = new game_model();
		$this->gamept_model = new gamept_model();
		$this->currency_model = new currency_model();
		$this->bank_model = new bank_model();
		$this->lang_model = new lang_model();
		$this->paytype_model = new paytype_model();
		$this->paystatus_model = new paystatus_model();
		$this->errorcode_model = new errorcode_model();
		$this->announcement_model = new announcement_model();

		// Global Usage
		$client  = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  = $_SERVER['REMOTE_ADDR'];

		if(filter_var($client, FILTER_VALIDATE_IP)) {
			$ip = $client;
		} elseif(filter_var($forward, FILTER_VALIDATE_IP)) {
			$ip = $forward;
		} else {
			$ip = $remote;
		}
		$session->set('ip', $ip);
	}
}
