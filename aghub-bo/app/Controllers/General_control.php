<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class General_control extends BaseController
{
	/*
    Protected
    */

    protected function agentPTPS($parent)
    {
        if( !session()->get('logged_in') ): return false; endif;

        $res = $this->ptps_model->selectAgPtExpenses(['userid' => $parent]);
		if( $res['code']==1 && $res['data']['ptExpenses']!=[] ):
			$arrPtExpenses = end($res['data']['ptExpenses']);
			$ptExpenses = $arrPtExpenses['percentage'];
		else:
			$ptExpenses = 0;
		endif;

		$res = $this->gameps_model->selectAgentPsSettings(['userid' => $parent]);
		if( $res['code']==1 && $res['data']['psExpenses']!=[] ):
			$arrPsExpenses = end($res['data']['psExpenses']);
			$psExpenses = $arrPsExpenses['percentage'];
		else:
			$psExpenses = 0;
		endif;

        return [
            'psExpenses' => $psExpenses,
            'ptExpenses' => $ptExpenses,
        ];
    }
	
	/*
	Common
	*/

    public function index()
	{
		if( session()->get('logged_in') ): return redirect()->to(base_url('dashboard')); endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;
		$data['templateColor'] = 'hub';
		
		echo view('template/start',$data);
        echo view('index');
		echo view('template/end',$data);
	}

    public function dashboard()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.dashboard');

		// Company PSPT Settings
        $res = $this->gameps_model->selectCompanyPsSettings(['userid' => $_ENV['host']]);
        if( $res['code']==1 && $res['psExpenses']!=[] ):
			$arrPsExpenses = end($res['psExpenses']);
			$psExpenses = $arrPsExpenses['amount'];
		else:
			$psExpenses = 0;
		endif;

		if( $res['code']==1 && $res['ptExpenses']!=[] ):
			$arrPtExpenses = end($res['ptExpenses']);
			$ptExpenses = $arrPtExpenses['amount'];
		else:
			$ptExpenses = 0;
		endif;

		if( $res['code']==1 && $res['psPercentage']!=[] ):
			$arrPs = end($res['psPercentage']);
			$ps = $arrPs['percentage'];
		else:
			$ps = 0;
		endif;
		// End Company PSPT Settings

		$data['psExpenses'] = $psExpenses;
		$data['ptExpenses'] = $ptExpenses;
		$data['ps'] = $ps;
		$data['ptps'] = $res['ptpsPercentage'];

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('dashboard',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	/*
	User Search
	*/

	public function index_userGameIdSearch()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.gameidsearch');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('usersearch-gameid',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_userSearch()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.usearch');
		//$data['secTitle'] = $_SESSION['uplinerole'];

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('usersearch',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	/*
	Game Provider
	*/

	public function index_gpClosed($parent)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.gamelist');

		$data['parent'] = $parent;

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('gameprovider/closedlist',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_games($provider)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.gamelist');
		$data['provider'] = $provider;

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('gameprovider/games',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_gameProvider()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.gp');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('gameprovider/index',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	/*
	Report
	*/

	public function index_psReportPersonal($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.profitreport');
		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('report/personal-shares',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_psReportGroup($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.sharesreport');
		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('report/group-shares',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}


	public function index_psReportV244($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.profitreport');
		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('report/psgroup4-2',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_psReport44($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.sharesreport');
		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('report/psgroup4-1',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}



	public function index_psReportV2($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.profitreport');
		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('report/psgroup-2',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_psReport($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.sharesreport');
		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('report/psgroup',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_sharesLottoListHistoryReport($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.shareslottolisthistoryreport');

		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('report/lottery-history',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_sharesLottoListReport($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.shareslottolistreport');

		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('report/lottery-list',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_sharesListHistoryReport($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.shareslisthistoryreport');

		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('report/shares-history',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_sharesListReport($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.shareslistreport');

		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('report/shares-list',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_fightListHistoryReport($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.fightlisthistoryreport');

		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('report/fight-history',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_fightListReport($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.fightlistreport');

		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('report/fight-list',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_depositCommPtReport($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.depcommptreport');

		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('report/depcommpt',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_depositCommReport($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.depcommreport');

		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('report/depcomm',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_refDepCommPtReport($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.refdepcommptreport');

		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('report/refdepcommpt',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_refDepCommReport($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.refdepcommreport');

		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('report/refdepcomm',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_affiliateReport($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.affiliatereport');

		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('report/affiliate',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_affiliatePtReport($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.affptreport');

		$data['parent'] = base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('report/affiliatept',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_agcommReport($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.agcommreport');

		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('report/agentcomm',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_agcommPtReport($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.agcommptreport');

		$data['parent'] = base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('report/agentcommpt',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_jackpotReport($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.jackpotreport');

		$data['parent'] = base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('report/jackpot',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_jackpotptReport($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.jackpotptreport');

		$data['parent'] = base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('report/jackpotpt',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_selfGamesReport($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.totalgamereport');

		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('report/selfgames',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_refWinloseReport($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.refwinlosereport');

		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('report/ref-winlose',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_winloseReport($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.winlosereport');

		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('report/index',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	/*
	Log
	*/

	public function index_betLog($parent)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.betlog');

		$data['parent'] = $parent;

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('transaction/bet-log',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_actualBetLog($parent)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.actualbetlog');

		$data['parent'] = $parent;

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('transaction/actual-betlog',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_gameBalanceLog($parent)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.scorelog');

		$data['parent'] = $parent;

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('transaction/score-log',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	/*
	Transaction
	*/

	public function index_claimJackpot()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.claimjackpot');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('transaction/claim-jackpot',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_pendingAgentWithdrawal($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.pendingagwithdrawal');

		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('transaction/agent-withdrawal',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_pendingWithdrawal($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.pendingwithdrawal');

		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start', $data);
			echo view('template/header');
			echo view('transaction/withdrawal', $data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_pendingDeposit($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.pendingdeposit');

		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start', $data);
			echo view('template/header');
			echo view('transaction/deposit', $data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_tranxHistory($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;
		
		$data['secTitle'] = lang('Nav.tranxhistory');

		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start', $data);
			echo view('template/header');
			echo view('transaction/index', $data);
			echo view('template/footer');
			echo view('template/end', $data);
		endif;
	}

	/*
	Promotion
	*/

	public function index_promotion()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.settingpromotion');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('promotion/index',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_addPromotion()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.addpromo');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('promotion/add-promotion',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_modifyPromotion($promoid)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.modifypromo');
		$data['promoid'] = $promoid;

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('promotion/edit-promotion',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_afterPayHistory()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.claimafhistory');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('promotion/afterpay',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	/*
	Content
	*/

	public function index_addContent()
	{
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.addreadonlypromo');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('content/add-promo-content',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_editContent($id,$contentid)
	{
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.addreadonlypromo');
		$data['id'] = $id;
		$data['contentid'] = $contentid;

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('content/edit-promo-content',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_addAffLBContent()
	{
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.addreadonlyafflb');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('content/add-afflb-content',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	/*
	Adminstrator
	*/

	public function index_adminLink()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.adminconfig');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('administrator/index',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	/*
	Settings
	*/

	public function index_currency()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.settingcurrency');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('settings/currency',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_settingAddFakeRecord()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.addfakerecord');

		// Games
		$gp = $this->gameprovider_model->selectAllGp(['userid'=>$_SESSION['token']]);
		$row = '';
		foreach( $gp['data'] as $g ):
            // $row .= '<div class="form-group row">';
            // $row .= '<label class="col-form-label col-lg-3 col-md-3 col-12 text-lg-right text-md-right">['.$g['code'].'] '.$g['name']['EN'].':</label>';

            // $row .= '<div class="col"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">Turnover</span></div>';
            // $row .= '<input type="number" step="any" class="form-control shadow-sm" data-gp="'.$g['code'].'" name="gp[]" value="0" required>';
            // $row .= '</div></div>';

            // $row .= '<div class="col"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">Winlose</span></div>';
            // $row .= '<input type="number" step="any" class="form-control shadow-sm" data-gp="'.$g['code'].'_w" name="gp[]" value="0" required>';
            // $row .= '</div></div>';

            // $row .= '<div class="col"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">Give Chip</span></div>';
            // $row .= '<input type="number" step="any" class="form-control shadow-sm" data-gp="'.$g['code'].'_c" name="gp[]" value="0" required>';
            // $row .= '</div></div>';

            // $row .= '</div>';

			$row .= '<div class="row gy-2 gx-3 align-items-center mb-3">';

			$row .= '<div class="col-xl-3 col-lg-3 col-md-3 col-3">';
			$row .= '<span class="badge bg-primary fw-normal me-1">'.$g['code'].'</span>'.$g['name']['EN'].':';
			$row .= '</div>';

			$row .= '<div class="col-xl-3 col-lg-3 col-md-3 col-3">';
			$row .= '<div class="input-group">';
			$row .= '<span class="input-group-text">Turnover</span>';
			$row .= '<input type="number" step="any" class="form-control shadow-sm" data-gp="'.$g['code'].'" name="gp[]" value="0" required>';
			$row .= '</div>';
			$row .= '</div>';

			$row .= '<div class="col-xl-3 col-lg-3 col-md-3 col-3">';
			$row .= '<div class="input-group">';
			$row .= '<span class="input-group-text">Winlose</span>';
			$row .= '<input type="number" step="any" class="form-control shadow-sm" data-gp="'.$g['code'].'_w" name="gp[]" value="0" required>';
			$row .= '</div>';
			$row .= '</div>';

			$row .= '<div class="col-xl-3 col-lg-3 col-md-3 col-3">';
			$row .= '<div class="input-group">';
			$row .= '<span class="input-group-text">Give Chip</span>';
			$row .= '<input type="number" step="any" class="form-control shadow-sm" data-gp="'.$g['code'].'_c" name="gp[]" value="0" required>';
			$row .= '</div>';
			$row .= '</div>';

			$row .= '</div>';
        endforeach;
		$data['gp'] = $row;
		// End Games

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('ptps/add-fake-record',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_settingFakeRecord()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.settingfakerecord');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('ptps/fake-record',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_companySummary()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.settingcompsummary');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('ptps/summary',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_agentWithdrawal()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.settingagentwithdrawal');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('settings/agent-withdrawal-period',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_companyPtPs()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.settingcompptps');

		// Company PSPT Settings
        $res = $this->gameps_model->selectCompanyPsSettings(['userid' => $_ENV['host']]);
        if( $res['code']==1 && $res['psExpenses']!=[] ):
			$arrPsExpenses = end($res['psExpenses']);
			$psExpenses = $arrPsExpenses['amount'];
		else:
			$psExpenses = 0;
		endif;

		if( $res['code']==1 && $res['ptExpenses']!=[] ):
			$arrPtExpenses = end($res['ptExpenses']);
			$ptExpenses = $arrPtExpenses['amount'];
		else:
			$ptExpenses = 0;
		endif;

		if( $res['code']==1 && $res['psPercentage']!=[] ):
			$arrPs = end($res['psPercentage']);
			$ps = $arrPs['percentage'];
		else:
			$ps = 0;
		endif;

		if( $res['code']==1 && $res['psLotteryExpenses']!=[] ):
			$arrPsLottoExpenses = end($res['psLotteryExpenses']);
			$psLottoExpenses = $arrPsLottoExpenses['amount'];
		else:
			$psLottoExpenses = 0;
		endif;

		$data['psExpenses'] = $psExpenses;
		$data['ptExpenses'] = $ptExpenses;
		$data['ps'] = $ps;
		$data['ptps'] = $res['ptpsPercentage'];
		$data['psLottoExpenses'] = $psLottoExpenses;
		// End Company PSPT Settings

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('ptps/index',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_settingsPchannel($provider,$merchant)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.settingpchannel');
		$data['provider'] = $provider;
		$data['merchant'] = $merchant;

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('settings/pchannel',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_settingsPgateway()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.settingpg');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('settings/pgateway',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_settingsBankCard()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.settingbankcard');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('settings/bankcard',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_settingsAffiliate()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.settingaff');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('settings/affiliate',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_settingsJackpot()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.settingjackpot');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('settings/jackpot',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_settingsAgentCommission($provider)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.settingagcomm');
		$data['provider'] = $provider;

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('settings/index',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	/*
	Agent
	*/

	public function index_agentPtPs($parent)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.agptps');

		$data['parent'] = $parent;

		// Agent PTPS
		$resPS = $this->gameps_model->selectAgentPsSettings(['userid' => base64_decode($parent)]);
		if( $resPS['code']==1 && $resPS['data']['psExpenses']!=[] ):
			$arrPsExpenses = end($resPS['data']['psExpenses']);
			$psExpenses = $arrPsExpenses['percentage'];
		else:
			$psExpenses = 0;
		endif;

		$data['psExpenses'] = $psExpenses;
		// End Agent PTPS

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('agent/ptps',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_agGamePt($parent)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.positiontaking');

		$data['parent'] = $parent;

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('agent/position-taking',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_addAgent()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.addag');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('agent/add-agent',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_agent($parent=FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.aglist');

		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			$data['templateColor'] = 'hub';
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('agent/index',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	/*
	Member
	*/

	public function index_userBankCard($parent)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.bankcard');
		$data['parent'] = $parent;

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('bankcard/index',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_userAffiliate($parent = FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.affdownline');

		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('member/affiliate',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	} 

	public function index_addMember($parent=FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.addmember');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('member/add-member',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_member($parent=FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.memberlist');

		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('member/index',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	/*
	Sub Account
	*/

	public function index_subaccount()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.subacc');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('subaccount/index',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_addSubAccount()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.addsubacc');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('subaccount/add-subacc',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	/*
	System Settlement
	*/

	public function index_export()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.exportreport');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('settlement/export',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_systemSettlement()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.sysettlement');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('settlement/index',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	/*
	Banner
	*/

	public function index_banner()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.settingbanner');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('banner/index',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	/*
	Support
	*/

	public function index_support()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.settingsupport');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('support/index',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	/*
	Announcement
	*/

	public function index_announcement()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.anncs');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('announcement/index',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_addAnnouncement()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.addannc');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('announcement/add-announcment',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_editAnnouncement($anncid)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.editannc');
		$data['anncid'] = $anncid;

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('announcement/edit-announcment',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	/*
	Mail
	*/

	public function index_mailbox($parent)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.inbox');
		$data['parent'] = $parent;

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('mail/index',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	/*
	APP Version
	*/

	public function index_version()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.appversion');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('version/index',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	/*
	Meta Data
	*/

	public function index_editMetaData($id,$contentid)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.editseoconfig');
		$data['id'] = $id;
		$data['contentid'] = $contentid;

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('content/edit-meta-data',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_addMetaData()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.addseoconfig');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('content/add-meta-data',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_metaData()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.seoconfig');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('content/meta-data',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	/*
	News Data
	*/

	public function index_editNewsData($id,$contentid)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.editnewsconfig');
		$data['id'] = $id;
		$data['contentid'] = $contentid;

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('content/edit-news-data',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_addNewsData()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.addnewsconfig');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('content/add-news-data',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_newsData()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.newsconfig');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('content/news-data',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	/*
	Ag Commission Data
	*/

	public function index_editAgcommData($id,$contentid)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.editagcommconfig');
		$data['id'] = $id;
		$data['contentid'] = $contentid;

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('content/edit-agcomm-data',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	public function index_addAgcommData()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.addagcommconfig');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('content/add-agcomm-data',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

		public function index_adcommData()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.agcommconfig');

		if ( !isset($_SESSION['apibycurrency']) ):
			return redirect()->to(base_url('dashboard-hub'));
		else:
			$data['templateColor'] = $_SESSION['apibycurrency'];
			echo view('template/start',$data);
			echo view('template/header');
			echo view('content/agcomm-data',$data);
			echo view('template/footer');
			echo view('template/end',$data);
		endif;
	}

	/*
	Hub
	*/

	public function index_hub()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.selectkioskcurrency');
		$data['templateColor'] = 'hub';

		//unset kiosk api
		unset($_SESSION['apibycurrency']); 

		//User Currency
		$payloadUser = [
			'userid' => $_ENV['host'],
			'currencycode' => 0
		];
		$resCurrency= $this->user_model->selectUserCurrency($payloadUser);
		$userCurrency = '';
        if ( $resCurrency['code']==1 && $resCurrency['data']!=[] ):
			foreach( $resCurrency['data'] as $ph ):
				if ($ph['existed']==true):
					switch($ph['currencyCode']):
						case 0: $currencyCode = 'MYR'; break;
						case 1: $currencyCode = 'VND'; break;
						case 2: $currencyCode = 'EUSDT'; break;
						case 3: $currencyCode = 'TUSDT'; break;
						case 4: $currencyCode = 'BTC'; break;
						case 5: $currencyCode = 'USD'; break;
						case 6: $currencyCode = 'MMK'; break;
						case 7: $currencyCode = 'EUR'; break;
						case 8: $currencyCode = 'SGD'; break;
						case 9: $currencyCode = 'CNY'; break;
						case 10: $currencyCode = 'THB'; break;
						case 11: $currencyCode = 'INR'; break;
						case 12: $currencyCode = 'BND'; break;
						case 13: $currencyCode = 'BDT'; break;
						case 14: $currencyCode = 'IDR'; break;
						default: $currencyCode = '';
					endswitch;

					if ($ph['status'] == 1):
						$currencyStatus = '<span class="badge bg-success shadow">'.lang('Label.active').'</span>';
					else:
						$currencyStatus = '<span class="badge bg-danger shadow">'.lang('Label.inactive').'</span>';
					endif;

					$userCurrency .= '<a href="javascript:void(0);" onclick="selectCurrencyKiosk(\''.$currencyCode.'\')" class="card col-xl-4 col-lg-4 col-md-4 col-12 border-light shadow text-decoration-none">';
					$userCurrency .= '<div class="card-body">';
					$userCurrency .= '<div class="row">';
					$userCurrency .= '<div class="col mt-0">';
					$userCurrency .= '<h5 class="card-title">'.lang('Input.currency').'</h5>';
					$userCurrency .= '</div>';
					$userCurrency .= '<div class="col-auto">';
					$userCurrency .= '<div class="stat text-primary">';
					$userCurrency .= '<i class="'.$currencyCode.' align-middle"></i>';
					$userCurrency .= '</div></div></div>';
					$userCurrency .= '<h1 class="mt-1 mb-3">'.$currencyCode.'</h1>';
					$userCurrency .= '<div class="mb-0">';
					$userCurrency .= $currencyStatus;
					$userCurrency .= '</div></div></a>';
				endif;
			endforeach;
			$data['userCurrency'] = $userCurrency;
		else:
			$data['userCurrency'] = '';
		endif;

		echo view('template/start',$data);
		echo view('template/header-hub');
        echo view('dashboard-hub',$data);
		echo view('template/footer');
		echo view('template/end',$data);
	}
	
	public function index_hubAgent($parent=FALSE)
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.aglist');
		$data['templateColor'] = 'hub';

		$data['parent'] = $parent ? $parent : base64_encode($_SESSION['token']);

		echo view('template/start',$data);
		echo view('template/header-hub');
        echo view('hub/agent/index',$data);
		echo view('template/footer');
		echo view('template/end',$data);
	}

	public function index_addHubAgent()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.addag');
		$data['templateColor'] = 'hub';

		echo view('template/start',$data);
		echo view('template/header-hub');
        echo view('hub/agent/add-agent',$data);
		echo view('template/footer');
		echo view('template/end',$data);
	}

	public function index_hubSubaccount()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.subacc');
		$data['templateColor'] = 'hub';

		echo view('template/start',$data);
		echo view('template/header-hub');
        echo view('hub/subaccount/index',$data);
		echo view('template/footer');
		echo view('template/end',$data);
	}

	public function index_addHubSubAccount()
	{
		if( !session()->get('logged_in') ): return false; endif;
		$data['session'] = isset($_SESSION['logged_in']) ? true : false;

		$data['secTitle'] = lang('Nav.addsubacc');
		$data['templateColor'] = 'hub';

		echo view('template/start',$data);
		echo view('template/header-hub');
        echo view('hub/subaccount/add-subacc',$data);
		echo view('template/footer');
		echo view('template/end',$data);
	}

	/*
	End Hub
	*/
}
