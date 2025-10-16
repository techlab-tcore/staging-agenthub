<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('General_control');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/translate/{locale}', 'Lang_control::translate');

$routes->get('/', 'General_control::index');
$routes->get('dashboard', 'General_control::dashboard', ['filter' => 'preauth']);
$routes->get('agent', 'General_control::index_agent', ['filter' => 'preauth']);
$routes->get('agent/downline/(:any)', 'General_control::index_agent/$1', ['filter' => 'preauth']);
//$routes->get('add-agent', 'General_control::index_addAgent', ['filter' => 'preauth']);
$routes->get('member', 'General_control::index_member', ['filter' => 'preauth']);
$routes->get('member/downline/(:any)', 'General_control::index_member/$1', ['filter' => 'preauth']);
$routes->get('member/affiliate-downline/(:any)', 'General_control::index_userAffiliate/$1', ['filter' => 'preauth']);
// $routes->get('add-member', 'General_control::index_addMember', ['filter' => 'preauth']);
$routes->get('user-search', 'General_control::index_userSearch', ['filter' => 'preauth']);
$routes->get('user-search/gameid', 'General_control::index_userGameIdSearch', ['filter' => 'preauth']);
$routes->get('settings/company/fight-share', 'General_control::index_companyPtPs', ['filter' => 'preauth']);
$routes->get('settings/company-summary', 'General_control::index_companySummary', ['filter' => 'preauth']);
$routes->get('settings/agent-withdrawal', 'General_control::index_agentWithdrawal', ['filter' => 'preauth']); //agent withdrwal period
$routes->get('agent/fight-shares/(:any)', 'General_control::index_agentPtPs/$1', ['filter' => 'preauth']);
$routes->get('history/transaction', 'General_control::index_tranxHistory', ['filter' => 'preauth']);
$routes->get('history/transaction/(:any)', 'General_control::index_tranxHistory/$1', ['filter' => 'preauth']);
$routes->get('system/settlement', 'General_control::index_systemSettlement', ['filter' => 'preauth']);
$routes->get('settings/jackpot', 'General_control::index_settingsJackpot', ['filter' => 'preauth']);
$routes->get('agent/position-taking/(:any)', 'General_control::index_agGamePt/$1', ['filter' => 'preauth']);
$routes->get('report/jackpot', 'General_control::index_jackpotReport', ['filter' => 'preauth']);
$routes->get('report/jackpotpt', 'General_control::index_jackpotptReport', ['filter' => 'preauth']);
$routes->get('report/agent-commission', 'General_control::index_agcommReport', ['filter' => 'preauth']);
$routes->get('user-report/agent-commission/(:any)', 'General_control::index_agcommReport/$1', ['filter' => 'preauth']);
$routes->get('report/agent-commission/pt', 'General_control::index_agcommPtReport', ['filter' => 'preauth']);
$routes->get('report/winlose', 'General_control::index_winloseReport', ['filter' => 'preauth']);
$routes->get('report/user/winlose/(:any)', 'General_control::index_winloseReport/$1', ['filter' => 'preauth']);
$routes->get('report/ptps-fight', 'General_control::index_fightListReport', ['filter' => 'preauth']);
$routes->get('report/ptps-fight-history', 'General_control::index_fightListHistoryReport', ['filter' => 'preauth']);
$routes->get('report/user-ptps-fight/(:any)', 'General_control::index_fightListReport/$1', ['filter' => 'preauth']);
$routes->get('report/ptps-shares', 'General_control::index_sharesListReport', ['filter' => 'preauth']);
$routes->get('report/ptps-shares-history', 'General_control::index_sharesListHistoryReport', ['filter' => 'preauth']);
$routes->get('report/user-ptps-shares/(:any)', 'General_control::index_sharesListReport/$1', ['filter' => 'preauth']);
$routes->get('announcement', 'General_control::index_announcement', ['filter' => 'preauth']);
$routes->get('announcement/open/add', 'General_control::index_addAnnouncement', ['filter' => 'preauth']);
$routes->get('announcement/open/modify/(:any)', 'General_control::index_editAnnouncement/$1', ['filter' => 'preauth']);
$routes->get('report/self-games', 'General_control::index_selfGamesReport', ['filter' => 'preauth']);
$routes->get('game-provider', 'General_control::index_gameProvider', ['filter' => 'preauth']);
$routes->get('game-provider/games/(:any)', 'General_control::index_games/$1', ['filter' => 'preauth']);
$routes->get('app-version', 'General_control::index_version', ['filter' => 'preauth']);
$routes->get('sub-account', 'General_control::index_subaccount', ['filter' => 'preauth']);
$routes->get('sub-account/add', 'General_control::index_addSubAccount', ['filter' => 'preauth']);
$routes->get('agent/games/(:any)', 'General_control::index_gpClosed/$1', ['filter' => 'preauth']);
$routes->get('member/games/(:any)', 'General_control::index_gpClosed/$1', ['filter' => 'preauth']);
$routes->get('score/log/(:any)', 'General_control::index_gameBalanceLog/$1', ['filter' => 'preauth']);
$routes->get('bet/log/(:any)', 'General_control::index_betLog/$1', ['filter' => 'preauth']);
$routes->get('actual/bet/log/(:any)', 'General_control::index_actualBetLog/$1', ['filter' => 'preauth']);
$routes->get('report/user/reference-winlose/(:any)', 'General_control::index_refWinloseReport/$1', ['filter' => 'preauth']);
$routes->get('settings/bank-card', 'General_control::index_settingsBankCard', ['filter' => 'preauth']);
$routes->get('settings/payment-gateway', 'General_control::index_settingsPgateway', ['filter' => 'preauth']);
$routes->get('settings/payment-gateway/channel/(:any)/(:any)', 'General_control::index_settingsPchannel/$1/$2', ['filter' => 'preauth']);
$routes->get('report/jackpot', 'General_control::index_jackpotReport', ['filter' => 'preauth']);
$routes->get('report/jackpotpt', 'General_control::index_jackpotptReport', ['filter' => 'preauth']);
$routes->get('report/affiliate', 'General_control::index_affiliateReport', ['filter' => 'preauth']);
$routes->get('report/affiliate/pt', 'General_control::index_affiliatePtReport', ['filter' => 'preauth']);
$routes->get('user-report/affiliate/(:any)', 'General_control::index_affiliateReport/$1', ['filter' => 'preauth']);
$routes->get('settings/affiliate', 'General_control::index_settingsAffiliate', ['filter' => 'preauth']);
$routes->get('support/customer-service', 'General_control::index_support', ['filter' => 'preauth']);
$routes->get('user/bank-card/(:any)', 'General_control::index_userBankCard/$1', ['filter' => 'preauth']);
$routes->get('transaction/pending/deposit', 'General_control::index_pendingDeposit', ['filter' => 'preauth']);
$routes->get('transaction/pending/withdrawal', 'General_control::index_pendingWithdrawal', ['filter' => 'preauth']);
$routes->get('transaction/pending/agent-withdrawal', 'General_control::index_pendingAgentWithdrawal', ['filter' => 'preauth']);
$routes->get('admin-config', 'General_control::index_adminLink', ['filter' => 'preauth']);
$routes->get('report/referral-deposit-commission', 'General_control::index_refDepCommReport', ['filter' => 'preauth']);
$routes->get('report/referral-deposit-commission/pt', 'General_control::index_refDepCommPtReport', ['filter' => 'preauth']);
$routes->get('report/deposit-commission', 'General_control::index_depositCommReport', ['filter' => 'preauth']);
$routes->get('report/deposit-commission/pt', 'General_control::index_depositCommPtReport', ['filter' => 'preauth']);
$routes->get('settings/promotion', 'General_control::index_promotion', ['filter' => 'preauth']);
$routes->get('settings/open-promotion/add', 'General_control::index_addPromotion', ['filter' => 'preauth']);
$routes->get('settings/open-promotion/modify/(:any)', 'General_control::index_modifyPromotion/$1', ['filter' => 'preauth']);
$routes->get('history/promotion/claim-after', 'General_control::index_afterPayHistory', ['filter' => 'preauth']);
$routes->get('settings/contents/add', 'General_control::index_addContent');
$routes->get('settings/contents/modify/(:any)/(:any)', 'General_control::index_editContent/$1/$2');
$routes->get('settings/contents/afflb/add', 'General_control::index_addAffLBContent');
$routes->get('report/statistics/company', 'General_control::index_statistics', ['filter' => 'preauth']);
$routes->get('settings/banner', 'General_control::index_banner', ['filter' => 'preauth']);
$routes->get('settings/additional-record', 'General_control::index_settingFakeRecord', ['filter' => 'preauth']);
$routes->get('settings/additional-record/add', 'General_control::index_settingAddFakeRecord', ['filter' => 'preauth']);
$routes->get('report/ptps-shares-lottery', 'General_control::index_sharesLottoListReport', ['filter' => 'preauth']);
$routes->get('report/ptps-shares-lottery-history', 'General_control::index_sharesLottoListHistoryReport', ['filter' => 'preauth']);
$routes->get('settings/agent-commission/(:any)', 'General_control::index_settingsAgentCommission/$1', ['filter' => 'preauth']);
$routes->get('user/inbox/(:any)', 'General_control::index_mailbox/$1', ['filter' => 'preauth']);

// $routes->get('/report/profit-sharing/(:any)', 'General_control::index_psReport/$1', ['filter' => 'preauth']);
// $routes->get('/report/profit-sharing-v2/(:any)', 'General_control::index_psReportV2/$1', ['filter' => 'preauth']);
$routes->get('/report4/profit-sharing/(:any)', 'General_control::index_psReport44/$1', ['filter' => 'preauth']);
$routes->get('/report4/profit-sharing-v2/(:any)', 'General_control::index_psReportV244/$1', ['filter' => 'preauth']);

$routes->get('/group-report/profit-sharing/(:any)', 'General_control::index_psReportGroup/$1', ['filter' => 'preauth']);
$routes->get('/personal-report/profit-sharing/(:any)', 'General_control::index_psReportPersonal/$1', ['filter' => 'preauth']);

$routes->get('report/reference-winlose', 'General_control::index_refWinloseReport', ['filter' => 'preauth']);
$routes->get('extra/seo-config', 'General_control::index_metaData', ['filter' => 'preauth']);
$routes->get('extra/seo-config/add', 'General_control::index_addMetaData');
$routes->get('extra/seo-config/modify/(:any)/(:any)', 'General_control::index_editMetaData/$1/$2', ['filter' => 'preauth']);
$routes->get('extra/news-config', 'General_control::index_newsData', ['filter' => 'preauth']);
$routes->get('extra/news-config/add', 'General_control::index_addNewsData');
$routes->get('extra/news-config/modify/(:any)/(:any)', 'General_control::index_editNewsData/$1/$2', ['filter' => 'preauth']);
$routes->get('extra/agcomm-config', 'General_control::index_adcommData', ['filter' => 'preauth']);
$routes->get('extra/agcomm-config/add', 'General_control::index_addAgcommData', ['filter' => 'preauth']);
$routes->get('extra/agcomm-config/modify/(:any)/(:any)', 'General_control::index_editAgcommData/$1/$2', ['filter' => 'preauth']);
$routes->get('system/jackpot/claim', 'General_control::index_claimJackpot', ['filter' => 'preauth']);
$routes->get('settings/currency', 'General_control::index_currency', ['filter' => 'preauth']);
$routes->get('system-export', 'General_control::index_export', ['filter' => 'preauth']);

$routes->get('dashboard-hub', 'General_control::index_hub', ['filter' => 'preauth']); //Hub
$routes->get('hub-agent', 'General_control::index_hubAgent', ['filter' => 'preauth']); //Hub
$routes->get('hub-agent/downline/(:any)', 'General_control::index_hubAgent/$1', ['filter' => 'preauth']); //Hub
$routes->get('hub-add-agent', 'General_control::index_addHubAgent', ['filter' => 'preauth']); //Hub
$routes->get('hub-sub-account', 'General_control::index_hubSubaccount', ['filter' => 'preauth']);
$routes->get('hub-sub-account/add', 'General_control::index_addHubSubAccount', ['filter' => 'preauth']);

$routes->resource('User_control');
$routes->post('user/login', 'User_control::login'); //Hub
$routes->get('user/logout', 'User_control::logout', ['filter' => 'auth']); //Hub
$routes->post('user/profile', 'User_control::getUserProfile', ['filter' => 'auth']);
$routes->post('user/profile/hub', 'User_control::getUserProfileHub', ['filter' => 'auth']); //Hub
$routes->get('user/confidential', 'User_control::selfBalance', ['filter' => 'auth']);
$routes->post('user/status-change', 'User_control::modifyUserStatus', ['filter' => 'auth']);
$routes->post('hub/user/status-change', 'User_control::modifyUserStatusHub', ['filter' => 'auth']);
$routes->post('user/personal-change/user', 'User_control::modifyPersonal', ['filter' => 'auth']);
$routes->post('user/personal-change/user/hub', 'User_control::modifyPersonalHub', ['filter' => 'auth']); //Hub
$routes->post('user/register/bycurrency', 'User_control::registerByCurrency', ['filter' => 'auth']); //Hub
$routes->post('user/vault-pin/reset', 'User_control::resetUserVaultPin', ['filter' => 'auth']);
$routes->post('user/second-password/reset', 'User_control::resetUser2ndPass', ['filter' => 'auth']);
$routes->post('self/password-change/company', 'User_control::modifySelfPassword', ['filter' => 'auth']);
$routes->post('self/password-change/company/hub', 'User_control::modifySelfPasswordHub', ['filter' => 'auth']);
$routes->post('list/agent', 'User_control::agentList', ['filter' => 'auth']);
$routes->post('list/agent/hub', 'User_control::agentListHub', ['filter' => 'auth']); //Hub
$routes->post('user/agent/add', 'User_control::addAgent', ['filter' => 'auth']);
$routes->post('hub/user/agent/add', 'User_control::addHubAgent', ['filter' => 'auth']); //Hub
$routes->post('list/member', 'User_control::memberList', ['filter' => 'auth']);
$routes->post('list/user/affiliate', 'User_control::userAffiliateDownline', ['filter' => 'auth']);
$routes->post('user/member/add', 'User_control::addMember', ['filter' => 'auth']);
$routes->post('user-upline', 'User_control::userUpline', ['filter' => 'auth']);
$routes->post('user/search', 'User_control::userSearch', ['filter' => 'auth']);
$routes->post('user/game-id/search', 'User_control::userGameIdSearch', ['filter' => 'auth']);
$routes->post('user/game-id', 'User_control::userGameId', ['filter' => 'auth']);
$routes->post('list/sub-account', 'User_control::subAccountList', ['filter' => 'auth']);
$routes->post('user/sub-account/add', 'User_control::addSubAccount', ['filter' => 'auth']);
$routes->post('hub/user/sub-account/add', 'User_control::addHubSubAccount', ['filter' => 'auth']); //Hub
$routes->post('list/user/permission', 'User_control::userPermissionList', ['filter' => 'auth']);
$routes->post('hub/list/sub-account', 'User_control::subAccountHubList', ['filter' => 'auth']); //Hub
$routes->post('hub/list/user/permission', 'User_control::userHubPermissionList', ['filter' => 'auth']); //Hub
$routes->post('list/agent/permission', 'User_control::agentPermissionList', ['filter' => 'auth']);
$routes->post('agent/permission/modify', 'User_control::editAgentPermission', ['filter' => 'auth']);
$routes->post('hub/list/agent/permission', 'User_control::agentHubPermissionList', ['filter' => 'auth']); //Hub
$routes->post('hub/agent/permission/modify', 'User_control::editAgentHubPermission', ['filter' => 'auth']); //Hub
$routes->post('user/permission/modify', 'User_control::editUserPermission', ['filter' => 'auth']);
$routes->post('hub/user/permission/modify', 'User_control::editHubUserPermission', ['filter' => 'auth']); //hub
$routes->post('user/reward-settings', 'User_control::userRewardSettings', ['filter' => 'auth']);
$routes->post('user/reward-settings/modify', 'User_control::editUserRewardSettings', ['filter' => 'auth']);
$routes->post('/user/administrator/negative-balance', 'User_control::getUserAdminNegativeSum', ['filter' => 'auth']);
$routes->post('kiosk/bycurrency', 'User_control::userKioskByCurrency', ['filter' => 'auth']); //Hub

$routes->resource('Gamept_control');
$routes->post('list/game-provider/position-taking', 'Gamept_control::gamePtList', ['filter' => 'auth']);
$routes->post('game-provider/position-taking/minmax', 'Gamept_control::minMaxGamePt', ['filter' => 'auth']);
$routes->post('game-provider/position-taking/modify', 'Gamept_control::modifyGamePt', ['filter' => 'auth']);
$routes->post('game-provider/position-taking/master/modify', 'Gamept_control::modifyMasterGamePt', ['filter' => 'auth']);

$routes->resource('Gameps_control');
$routes->get('company/pt-ps', 'Gameps_control::getCompanyPtPsSettings', ['filter' => 'auth']);
$routes->post('company/pt-ps/modify', 'Gameps_control::modifyCompanyPtPsSettings', ['filter' => 'auth']);
$routes->post('agent/pt-ps', 'Gameps_control::getAgentPtPs', ['filter' => 'auth']);
$routes->post('agent/pt-ps/modify', 'Gameps_control::getAgentPtPs', ['filter' => 'auth']);
$routes->post('agent/ps-expenses/min-max', 'Gameps_control::minMaxAgentPsExpenses', ['filter' => 'auth']);
$routes->post('agent/ps-expenses/modify', 'Gameps_control::modifyAgentPsExpenses', ['filter' => 'auth']);
$routes->post('agent/ps/min-max', 'Gameps_control::minMaxAgentPs', ['filter' => 'auth']);
$routes->post('agent/ps/modify', 'Gameps_control::modifyAgentPs', ['filter' => 'auth']);
$routes->post('agent/fight-expenses', 'Gameps_control::getAgentFightExpenses', ['filter' => 'auth']);
$routes->post('agent/fight-expenses/min-max', 'Gameps_control::getAgentMinMaxFightExpenses', ['filter' => 'auth']);
$routes->post('agent/fight-expenses/modify', 'Gameps_control::modifyAgentFightExpenses', ['filter' => 'auth']);
$routes->post('list/ptps-fight', 'Gameps_control::getPtPs1List', ['filter' => 'auth']);
$routes->post('list/ptps-fight/history', 'Gameps_control::getPtPs1History', ['filter' => 'auth']);
$routes->post('list/ptps-shares', 'Gameps_control::getPtPs2List', ['filter' => 'auth']);
$routes->post('list/ptps-shares/history', 'Gameps_control::getPtPs2History', ['filter' => 'auth']);
$routes->post('agent/lottery-expenses', 'Gameps_control::getAgentLottoExpenses', ['filter' => 'auth']);
$routes->post('agent/lottery-expenses/min-max', 'Gameps_control::minMaxAgentPsLottoExpenses', ['filter' => 'auth']);
$routes->post('agent/lottery-expenses/modify', 'Gameps_control::modifyAgentPsLottoExpenses', ['filter' => 'auth']);
$routes->post('list/ptps-shares-lottery', 'Gameps_control::getPtPs3List', ['filter' => 'auth']);
$routes->post('list/ptps-shares-lottery/history', 'Gameps_control::getPtPs3History', ['filter' => 'auth']);
$routes->post('/list/summary/company', 'Gameps_control::companySummary', ['filter' => 'auth']);
$routes->post('/list/summary/administrator', 'Gameps_control::adminSummary', ['filter' => 'auth']);

$routes->post('/list/summary-v2/company', 'Gameps_control::companySummaryV2', ['filter' => 'auth']);
$routes->post('/list/summary-v2/administrator', 'Gameps_control::adminSummaryV2', ['filter' => 'auth']);
$routes->post('/list/summary-v2/direct-member', 'Gameps_control::adminDirectMemberSummary', ['filter' => 'auth']);

$routes->post('/list4/summary-v2/company', 'Gameps_control::companySummaryV244', ['filter' => 'auth']);
$routes->post('/list4/summary/administrator', 'Gameps_control::adminSummary44', ['filter' => 'auth']);
$routes->post('/list4/summary-v2/administrator', 'Gameps_control::adminSummaryV244', ['filter' => 'auth']);
$routes->post('/list4/summary-v2/direct-member', 'Gameps_control::adminDirectMemberSummary44', ['filter' => 'auth']);

$routes->resource('Fake_control');
$routes->post('list/additional-record', 'Fake_control::getFakeRecord', ['filter' => 'auth']);
$routes->post('additional-record/add', 'Fake_control::addFakeRecord', ['filter' => 'auth']);

$routes->resource('Compsummary_control');
$routes->post('list/company-summary', 'Compsummary_control::companySummaryList', ['filter' => 'auth']);
$routes->post('company-summary/add', 'Compsummary_control::addCompanySummary', ['filter' => 'auth']);

$routes->resource('Balance_control');
$routes->get('availabel/pending-deposit/notify/(:num)', 'Balance_control::getIncomingDeposit/$1', ['filter' => 'auth']);
$routes->post('list/pending/deposit', 'Balance_control::pendingDepositList', ['filter' => 'auth']);
$routes->post('list/pending/withdrawal', 'Balance_control::pendingWithdrawalList', ['filter' => 'auth']);
$routes->post('list/pending/agent-withdrawal', 'Balance_control::pendingAgentWithdrawalList', ['filter' => 'auth']);
$routes->post('transaction/permission', 'Balance_control::approvalPermission', ['filter' => 'auth']);
$routes->post('list/history/transaction', 'Balance_control::transactionHistoryList', ['filter' => 'auth']);
$routes->post('user/credit-transfer/usertransfer', 'Balance_control::userCreditTransfer', ['filter' => 'auth']);
$routes->post('user/replenishment', 'Balance_control::userPgReplenishment', ['filter' => 'auth']);
$routes->post('user/fortune-token/transfer', 'Balance_control::userSpinTokenTransfer', ['filter' => 'auth']);
$routes->post('user/promotion-assigned', 'Balance_control::userSetPromotion', ['filter' => 'auth']);
$routes->post('turnover/user/clear', 'Balance_control::clearUserTurnover', ['filter' => 'auth']);
$routes->post('chip/user/clear', 'Balance_control::clearUserChip', ['filter' => 'auth']);

$routes->resource('Bankcard_control');
$routes->post('list/withdrawal-bank-card', 'Bankcard_control::withdrawalBankCardList', ['filter' => 'auth']);
$routes->get('bank-card/company/all', 'Bankcard_control::companyBankCards', ['filter' => 'auth']);
$routes->get('list/bank-card/company/all', 'Bankcard_control::userAllbankCardList', ['filter' => 'auth']);
$routes->post('list/bank-card/user/all', 'Bankcard_control::userAllbankCardList', ['filter' => 'auth']);
$routes->post('bank-card/company/get', 'Bankcard_control::bankCard', ['filter' => 'auth']);
$routes->post('bank-card/company/add', 'Bankcard_control::addBankCard', ['filter' => 'auth']);
$routes->post('user/bank-card/company/modify', 'Bankcard_control::editBankCard', ['filter' => 'auth']);
$routes->post('bank-card/company/status/modify', 'Bankcard_control::editStatusBankCard', ['filter' => 'auth']);
$routes->post('bank-card/user/set-default', 'Bankcard_control::setDefaultBankCard', ['filter' => 'auth']);

$routes->resource('Pgateway_control');
$routes->post('list-raw/payment-gateway', 'Pgateway_control::paymentGatewayRawList', ['filter' => 'auth']);
$routes->get('list/payment-gateway/company/all', 'Pgateway_control::userAllPaymentGatewayList', ['filter' => 'auth']);
$routes->post('list/payment-gateway/user/all', 'Pgateway_control::userAllPaymentGatewayList', ['filter' => 'auth']);
$routes->post('payment-gateway/get', 'Pgateway_control::paymentGateway', ['filter' => 'auth']);
$routes->post('payment-gateway/add', 'Pgateway_control::addPaymentGateway', ['filter' => 'auth']);
$routes->post('payment-gateway/modify', 'Pgateway_control::editPaymentGateway', ['filter' => 'auth']);
$routes->post('list/payment-gateway/position-taking', 'Pgateway_control::pGatewayPtReport', ['filter' => 'auth']);
$routes->post('payment-gateway/position-taking/minmax', 'Pgateway_control::minMaxPgatewayPt', ['filter' => 'auth']);
$routes->post('payment-gateway/position-taking', 'Pgateway_control::getPgatewayPt', ['filter' => 'auth']);
$routes->post('payment-gateway/position-taking/modify', 'Pgateway_control::modifyPgatewayPt', ['filter' => 'auth']);
$routes->post('payment-gateway/withdrawal/position-taking', 'Pgateway_control::getPgatewayWithdrawalPt', ['filter' => 'auth']);

$routes->resource('Pchannel_control');
$routes->post('list-raw/payment-channel', 'Pchannel_control::paymentChannelRawList', ['filter' => 'auth']);
$routes->post('list/payment-channel/company/all', 'Pchannel_control::userAllPaymentChannelList', ['filter' => 'auth']);
$routes->post('payment-gateway/channel/get', 'Pchannel_control::paymentChannel', ['filter' => 'auth']);
$routes->post('payment-gateway/channel/add', 'Pchannel_control::addPaymentChannel', ['filter' => 'auth']);
$routes->post('payment-gateway/channel/modify', 'Pchannel_control::editPaymentChannel', ['filter' => 'auth']);

$routes->resource('Bet_control');
$routes->post('list/report/winlose', 'Bet_control::winloseReport', ['filter' => 'auth']);
$routes->post('list/report/final', 'Bet_control::finalReport', ['filter' => 'auth']);
$routes->post('list/report/games', 'Bet_control::gamesReport', ['filter' => 'auth']);
$routes->post('list/report/self-games', 'Bet_control::selfGamesReport', ['filter' => 'auth']);
$routes->post('list/score/log', 'Bet_control::gameBalanceLog', ['filter' => 'auth']);
$routes->post('list/bet/log/reference', 'Bet_control::referenceBetLog', ['filter' => 'auth']);
$routes->post('list/bet/log/actual', 'Bet_control::actualBetLog', ['filter' => 'auth']);
$routes->post('list/report/ref-winlose', 'Bet_control::refWinloseReport', ['filter' => 'auth']);

$routes->resource('Gamecategory_control');
$routes->get('list/game-provider/category', 'Gamecategory_control::gameCategoryList', ['filter' => 'auth']);
$routes->get('list/game-category', 'Gamecategory_control::gameCategoryRawList', ['filter' => 'auth']);

$routes->resource('Gameprovider_control');
$routes->get('list/game-provider/all', 'Gameprovider_control::gameProviderAllList', ['filter' => 'auth']);
$routes->get('list/game-provider', 'Gameprovider_control::gameProviderList', ['filter' => 'auth']);
$routes->post('list/closed/game-provider', 'Gameprovider_control::gameProviderListClosedPurpose', ['filter' => 'auth']);
$routes->post('list/games/agent', 'Gameprovider_control::gameProviderClosedList', ['filter' => 'auth']);
$routes->post('agent/games/check', 'Gameprovider_control::checkClosed', ['filter' => 'auth']);
$routes->post('agent/games/modify', 'Gameprovider_control::editGameProviderClosedList', ['filter' => 'auth']);
$routes->post('user/game-balance/check', 'Gameprovider_control::getGameBalance', ['filter' => 'auth']);
$routes->post('user/free-credit/withdraw', 'Gameprovider_control::withdrawFreeCredit', ['filter' => 'auth']); //FreeCredit
$routes->post('user/game-balance/collect', 'Gameprovider_control::retrieveGameBalance', ['filter' => 'auth']);
$routes->post('user/game-balance/transfer-in', 'Gameprovider_control::depositGameBalance', ['filter' => 'auth']);
$routes->post('game-provider/add', 'Gameprovider_control::addGameProvider', ['filter' => 'auth']);
$routes->post('game-provider/modify', 'Gameprovider_control::editGameProvider', ['filter' => 'auth']);
$routes->post('game-provider/status/modify', 'Gameprovider_control::editStatusGameProvider', ['filter' => 'auth']);
$routes->post('game-provider/get', 'Gameprovider_control::getGameProvider', ['filter' => 'auth']);

$routes->resource('Game_control');
$routes->post('list/game-provider/games', 'Game_control::gamesAllList', ['filter' => 'auth']);
$routes->post('game-provider/game/get', 'Game_control::getGame', ['filter' => 'auth']);
$routes->post('game-provider/games/add', 'Game_control::addGame', ['filter' => 'auth']);
$routes->post('game-provider/games/edit', 'Game_control::editGame', ['filter' => 'auth']);
$routes->post('game-provider/games/status/edit', 'Game_control::editStatusGame', ['filter' => 'auth']);

$routes->resource('Paymentprovider_control');
$routes->get('list/payment-provider/bank/gateway/all', 'Paymentprovider_control::paymentAllProviderBankList', ['filter' => 'auth']);
$routes->get('list/payment-provider/payment-gateway/all', 'Paymentprovider_control::paymentProviderPayGatewayList', ['filter' => 'auth']);
$routes->get('list/payment-provider/bank/all', 'Paymentprovider_control::paymentProviderBankList', ['filter' => 'auth']);

$routes->resource('Agentcomm_control');
$routes->post('list/report/agent-commission', 'Agentcomm_control::agCommReport', ['filter' => 'auth']);
$routes->post('list/report/agent-commission-pt', 'Agentcomm_control::agCommPtReport', ['filter' => 'auth']);
$routes->post('list/settings/agent-commission', 'Agentcomm_control::settingsAgentCommissionList', ['filter' => 'auth']);
$routes->post('settings/agent-commission/edit', 'Agentcomm_control::editAgentCommission', ['filter' => 'auth']);

$routes->resource('Promotion_control');
$routes->get('list-raw/promotion', 'Promotion_control::rawPromotionList', ['filter' => 'auth']);
$routes->get('list/settings/promotion', 'Promotion_control::promotionList', ['filter' => 'auth']);
$routes->post('promotion/get', 'Promotion_control::getPromotion', ['filter' => 'auth']);
$routes->post('promotion/add', 'Promotion_control::addPromotion', ['filter' => 'auth']);
$routes->post('promotion/modify', 'Promotion_control::modifyPromotion', ['filter' => 'auth']);
$routes->post('promotion/status/change', 'Promotion_control::modifyStatus', ['filter' => 'auth']);
$routes->post('list/history/claim-after', 'Promotion_control::claimAfterHistory', ['filter' => 'auth']);

$routes->resource('Jackpot_control');
$routes->get('list/settings/jackpot', 'Jackpot_control::jackpotSettingsList', ['filter' => 'auth']);
$routes->post('list/report/jackpot', 'Jackpot_control::jackpotReport', ['filter' => 'auth']);
$routes->post('list/report/jackpotpt', 'Jackpot_control::jackpotPtReport', ['filter' => 'auth']);
$routes->post('jackpot/position-taking/minmax', 'Jackpot_control::minMaxJackpotPt', ['filter' => 'auth']);
$routes->post('jackpot/position-taking', 'Jackpot_control::getJackpotPt', ['filter' => 'auth']);
$routes->post('jackpot/position-taking/modify', 'Jackpot_control::modifyJackpotPt', ['filter' => 'auth']);
$routes->post('settings/jackpot/add', 'Jackpot_control::addJackpot', ['filter' => 'auth']);
$routes->post('settings/jackpot/modify', 'Jackpot_control::editJackpot', ['filter' => 'auth']);
$routes->post('jackpot/claim', 'Jackpot_control::claimJackpot', ['filter' => 'auth']);

$routes->resource('Affiliate_control');
$routes->get('settings/affiliate/ceiling', 'Affiliate_control::affiliateSettingsCeilingAndDeposit', ['filter' => 'auth']);
$routes->get('list/settings/affiliate', 'Affiliate_control::affiliateSettingsList', ['filter' => 'auth']);
$routes->post('affiliate/position-taking/minmax', 'Affiliate_control::minMaxAffiliatePt', ['filter' => 'auth']);
$routes->post('affiliate/position-taking', 'Affiliate_control::getAffiliatePt', ['filter' => 'auth']);
$routes->post('affiliate/position-taking/modify', 'Affiliate_control::modifyAffiliatePt', ['filter' => 'auth']);
$routes->post('list/history/affiliate', 'Affiliate_control::affiliateHistoryList', ['filter' => 'auth']);
$routes->post('settings/affiliate/ceiling/modify', 'Affiliate_control::modifyCeiling', ['filter' => 'auth']);
$routes->post('settings/affiliate/level/add', 'Affiliate_control::addAffiliateLevel', ['filter' => 'auth']);
$routes->post('settings/affiliate/modify', 'Affiliate_control::modifyAffiliateSettings', ['filter' => 'auth']);
$routes->post('list/report/affiliatept', 'Affiliate_control::affiliatePtReport', ['filter' => 'auth']);

$routes->resource('Admin_control');
$routes->get('administrator/api-config', 'Admin_control::getAdminLink', ['filter' => 'auth']);
$routes->post('administrator/api-config/general/modify', 'Admin_control::modifyGeneral', ['filter' => 'auth']);
$routes->post('administrator/api-config/deposit-comm/modify', 'Admin_control::modifyDepositComm', ['filter' => 'auth']);
$routes->post('administrator/api-config/referral-deposit-comm/modify', 'Admin_control::modifyRefDepositComm', ['filter' => 'auth']);
$routes->post('administrator/api-config/daily-reward/modify', 'Admin_control::modifyDailyReward', ['filter' => 'auth']);
$routes->post('administrator/api-config/affiliate-shared-reward/modify', 'Admin_control::modifyAffSharedReward', ['filter' => 'auth']);
$routes->get('administrator/api-config/agent-withdraw-time', 'Admin_control::getAgentWithdrawTime', ['filter' => 'auth']);
$routes->post('administrator/api-config/agent-withdraw-time/modify', 'Admin_control::modifyAgentWithdrawTime', ['filter' => 'auth']);

$routes->resource('Refdepcomm_control');
$routes->post('list/report/referral-deposit-commission', 'Refdepcomm_control::refCommHistoryList', ['filter' => 'auth']);
$routes->post('list/referral-deposit-commission/position-taking', 'Refdepcomm_control::refCommPtReport', ['filter' => 'auth']);
$routes->post('referral-deposit-commission/position-taking/minmax', 'Refdepcomm_control::minMaxRefCommPt', ['filter' => 'auth']);
$routes->post('referral-deposit-commission/position-taking', 'Refdepcomm_control::getRefCommPt', ['filter' => 'auth']);
$routes->post('referral-deposit-commission/position-taking/modify', 'Refdepcomm_control::modifyRefCommPt', ['filter' => 'auth']);

$routes->resource('Depcomm_control');
$routes->post('list/report/deposit-commission', 'Depcomm_control::depositCommHistoryList', ['filter' => 'auth']);
$routes->post('list/deposit-commission/position-taking', 'Depcomm_control::depositCommPtReport', ['filter' => 'auth']);
$routes->post('deposit-commission/position-taking/minmax', 'Depcomm_control::minMaxDepositCommPt', ['filter' => 'auth']);
$routes->post('deposit-commission/position-taking', 'Depcomm_control::getDepositCommPt', ['filter' => 'auth']);
$routes->post('deposit-commission/position-taking/modify', 'Depcomm_control::modifyDepositCommPt', ['filter' => 'auth']);

$routes->resource('Content_control');
$routes->get('list/content', 'Content_control::getContentList');
$routes->post('content/get', 'Content_control::getContent');
$routes->post('content/add', 'Content_control::addContent');
$routes->post('content/modify', 'Content_control::modifyContent');
$routes->get('list/promotion/read-only/content', 'Content_control::getPromoContentList');
$routes->post('promotion/read-only/content/add', 'Content_control::addPromoContent');
$routes->post('promotion/read-only/content/modify', 'Content_control::modifyPromoContent');
$routes->get('list/promotion/read-only/afflb-content', 'Content_control::getAffLBContentList');
$routes->post('promotion/read-only/afflb-content/add', 'Content_control::addAffLBContent');
$routes->get('list/read-only/seo', 'Content_control::seoList');
$routes->post('content/seo-add', 'Content_control::addMetaSeo');
$routes->post('content/seo/modify', 'Content_control::modifyMetaSeo');
$routes->get('list/read-only/news', 'Content_control::newsList');
$routes->post('content/news-add', 'Content_control::addNewsSeo');
$routes->post('content/news/modify', 'Content_control::modifyNewsSeo');
$routes->get('list/read-only/agcomm', 'Content_control::agcommList');
$routes->post('content/agcomm-add', 'Content_control::addAgcomm');
$routes->post('content/agcomm/modify', 'Content_control::modifyAgcomm');

$routes->resource('Settlement_control');
$routes->get('system/settlement/winlose/status', 'Settlement_control::winloseStatus', ['filter' => 'auth']);
$routes->post('list/settlement/history', 'Settlement_control::settlementList', ['filter' => 'auth']);
$routes->post('system/settlement/execute', 'Settlement_control::doSettlement', ['filter' => 'auth']);

$routes->resource('Support_control');
$routes->get('list/support', 'Support_control::supportList', ['filter' => 'auth']);
$routes->post('support/whatsapp/get', 'Support_control::getWhatsapp', ['filter' => 'auth']);
$routes->post('support/whatsapp/add', 'Support_control::addWhatsapp', ['filter' => 'auth']);
$routes->post('support/whatsapp/modify', 'Support_control::modifyWhatsapp', ['filter' => 'auth']);
$routes->get('list/live-chat', 'Support_control::getLiveChat', ['filter' => 'auth']);
$routes->post('live-chat/modify', 'Support_control::modifyLiveChat', ['filter' => 'auth']);

$routes->resource('Banner_control');
$routes->get('list/banner', 'Banner_control::bannerList', ['filter' => 'auth']);
$routes->post('banner/get', 'Banner_control::getBanner', ['filter' => 'auth']);
$routes->post('banner/add', 'Banner_control::addBanner', ['filter' => 'auth']);
$routes->post('banner/modify', 'Banner_control::modifyBanner', ['filter' => 'auth']);
$routes->post('banner/status/modify', 'Banner_control::modifyStatus', ['filter' => 'auth']);

$routes->resource('Overview_control');
$routes->get('statistics/company', 'Overview_control::getCompanyStatistics', ['filter' => 'auth']);
$routes->post('statistics/company-self', 'Overview_control::getSelfCompanyStatistics', ['filter' => 'auth']);
$routes->post('user/statistics/(:any)', 'Overview_control::getStatistics/$1', ['filter' => 'auth']);

$routes->resource('Announcement_control');
$routes->get('list/announcement/all', 'Announcement_control::announcementList', ['filter' => 'auth']);
$routes->get('list/announcement/pop/all', 'Announcement_control::announcementPopList', ['filter' => 'auth']);
$routes->get('list/announcement/sent', 'Announcement_control::announcementSentList', ['filter' => 'auth']);
$routes->post('announcement/sent/get', 'Announcement_control::announcementSent', ['filter' => 'auth']);
$routes->post('announcement/modify', 'Announcement_control::editAnnouncement', ['filter' => 'auth']);
$routes->post('announcement/add', 'Announcement_control::addAnnouncement', ['filter' => 'auth']);

$routes->resource('Version_control');
$routes->get('list/app-version/all', 'Version_control::versionList', ['filter' => 'auth']);
$routes->post('app-version/get', 'Version_control::version', ['filter' => 'auth']);
$routes->post('app-version/modify', 'Version_control::editVersion', ['filter' => 'auth']);

$routes->resource('Mail_control');
$routes->post('list/message/all', 'Mail_control::mailAllList', ['filter' => 'auth']);
$routes->post('message/new/add', 'Mail_control::addMail', ['filter' => 'auth']);

$routes->resource('Currency_control');
$routes->get('list/currency', 'Currency_control::currencyList', ['filter' => 'auth']);
$routes->post('currency/get', 'Currency_control::getCurrency', ['filter' => 'auth']);
$routes->post('currency/modify', 'Currency_control::modifyCurrency', ['filter' => 'auth']);

$routes->resource('Export_control');
$routes->post('list/export-history', 'Export_control::selectAllExportList', ['filter' => 'auth']);
$routes->post('export/tranasaction-history/add', 'Export_control::addTransactionExport', ['filter' => 'auth']);


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
