<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\User_model;
use App\Models\Overview_model;
use App\Models\Gamept_model;
use App\Models\Gameps_model;
use App\Models\Ptps_model;
use App\Models\Compsummary_model;
use App\Models\Fake_model;
use App\Models\Balance_model;
use App\Models\Bet_model;
use App\Models\Paymentprovider_model;
use App\Models\Gamecategory_model;
use App\Models\Gameprovider_model;
use App\Models\Game_model;
use App\Models\Bankcard_model;
use App\Models\Pgateway_model;
use App\Models\Pchannel_model;
use App\Models\Promotion_model;
use App\Models\Jackpot_model;
use App\Models\Affiliate_model;
use App\Models\Refdepcomm_model;
use App\Models\Depcomm_model;
use App\Models\Content_model;
use App\Models\Settlement_model;
use App\Models\Banner_model;
use App\Models\Support_model;
use App\Models\Announcement_model;
use App\Models\Version_model;
use App\Models\Mail_model;
use App\Models\Agentcomm_model;
use App\Models\Currency_model;
use App\Models\Export_model;

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
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
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
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

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
		$this->overview_model = new overview_model();
		$this->gamept_model = new gamept_model();
		$this->gameps_model = new gameps_model();
		$this->ptps_model = new ptps_model();
		$this->compsummary_model = new compsummary_model();
		$this->fake_model = new fake_model();
		$this->balance_model = new balance_model();
		$this->bet_model = new bet_model();
		$this->paymentprovider_model = new paymentprovider_model();
		$this->gamecategory_model = new gamecategory_model();
		$this->gameprovider_model = new gameprovider_model();
		$this->game_model = new game_model();
		$this->bankcard_model = new bankcard_model();
		$this->pgateway_model = new pgateway_model();
		$this->pchannel_model = new pchannel_model();
		$this->promotion_model = new promotion_model();
		$this->jackpot_model = new jackpot_model();
		$this->affiliate_model = new affiliate_model();
		$this->refdepcomm_model = new refdepcomm_model();
		$this->depcomm_model = new depcomm_model();
		$this->content_model = new content_model();
		$this->settlement_model = new settlement_model();
		$this->banner_model = new banner_model();
		$this->support_model = new support_model();
		$this->announcement_model = new announcement_model();
		$this->version_model = new version_model();
		$this->mail_model = new mail_model();
		$this->agentcomm_model = new agentcomm_model();
		$this->currency_model = new currency_model();
		$this->export_model = new export_model();

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

        // Check Permission
		if( isset($_SESSION['role']) && $_SESSION['role']==5 ):
			$user = $this->user_model->selectUser(['userid' => $_SESSION['token']]);
			if( $user['code']==1 && $user['data']!=[] ):
				$permission = json_decode($user['data']['permission']);
				$transaction = !isset($permission->major->transaction) ? 0 : (int)$permission->major->transaction;
				$report = !isset($permission->major->report) ? 0 : (int)$permission->major->report;
				$account = !isset($permission->major->account) ? 0 : (int)$permission->major->account;
				$gameprovider = !isset($permission->major->gameprovider) ? 0 : (int)$permission->major->gameprovider;
				$settings = !isset($permission->major->settings) ? 0 : (int)$permission->major->settings;
				$extra = !isset($permission->major->extra) ? 0 : (int)$permission->major->extra;
				$usersearch = !isset($permission->major->usersearch) ? 0 : (int)$permission->major->usersearch;
				$userprofile = !isset($permission->major->userprofile) ? 0 : (int)$permission->major->userprofile;
				$confidential = !isset($permission->major->confidential) ? 0 : (int)$permission->major->confidential;

				$session = session();
				$user_data = [
					'uplineid' => $user['data']['agentId'],
					'transaction' => $transaction,
					'report' => $report,
					'account' => $account,
					'gameprovider' => $gameprovider,
					'settings' => $settings,
					'extra' => $extra,
					'usersearch' => $usersearch,
					'userprofile' => $userprofile,
					'confidential' => $confidential,
				];
				$session->set($user_data);
			else:
				$session = session();
				$res = $this->user_model->updateUserLogout(['userid'=>$_SESSION['token']]);
				$session->destroy();
				clearstatcache();
				return redirect()->to(base_url());
			endif;
		endif;
    }
}
