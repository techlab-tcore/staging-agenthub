<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'General_control::index');
$routes->get('dashboard', 'General_control::dashboard', ['filter' => 'preauth']);
$routes->get('history/transaction', 'General_control::index_transaction', ['filter' => 'preauth']);
$routes->get('history/transaction/(:any)', 'General_control::index_transaction/$1', ['filter' => 'preauth']);
$routes->get('administrator', 'General_control::index_administrator', ['filter' => 'preauth']);
$routes->get('administrator/add', 'General_control::index_addAdministrator', ['filter' => 'preauth']);
$routes->get('sub-account', 'General_control::index_subaccount', ['filter' => 'preauth']);
$routes->get('sub-account/add', 'General_control::index_addSubAccount', ['filter' => 'preauth']);
$routes->get('administrator/game-category/(:any)/(:any)', 'General_control::index_gameCategory/$1/$2', ['filter' => 'preauth']);
$routes->get('administrator/game-provider/(:any)/(:any)', 'General_control::index_gameProvider/$1/$2', ['filter' => 'preauth']);
$routes->get('game-provider/games/(:any)/(:any)/(:any)', 'General_control::index_games/$1/$2/$3', ['filter' => 'preauth']);
$routes->get('administrator/position-taking/(:any)/(:any)', 'General_control::index_gamePt/$1/$2', ['filter' => 'preauth']);
$routes->get('payment-provider/bank/(:any)', 'General_control::index_bank/$1', ['filter' => 'preauth']);
$routes->get('payment-provider/payment-gateway/(:any)', 'General_control::index_pGateway/$1', ['filter' => 'preauth']);
$routes->get('settings/languages/(:any)', 'General_control::index_settingLanguage/$1', ['filter' => 'preauth']);
$routes->get('settings/currencies/(:any)', 'General_control::index_settingCurrency/$1', ['filter' => 'preauth']);
$routes->get('settings/payment-types/(:any)', 'General_control::index_settingPaytype/$1', ['filter' => 'preauth']);
$routes->get('settings/payment-status/(:any)', 'General_control::index_settingPaystatus/$1', ['filter' => 'preauth']);
$routes->get('settings/error-code/(:any)', 'General_control::index_settingErrorcode/$1', ['filter' => 'preauth']);
$routes->get('announcement', 'General_control::index_announcement', ['filter' => 'preauth']);

$routes->resource('User_control');
$routes->get('user/logout', 'User_control::logout', ['filter' => 'auth']);
$routes->post('user/login', 'User_control::login');
$routes->post('user/profile', 'User_control::getUserProfile', ['filter' => 'auth']);
$routes->post('user/profile/hub', 'User_control::getUserProfileHub', ['filter' => 'auth']);
$routes->post('self/password/change', 'User_control::modifySelfPassword', ['filter' => 'auth']);
$routes->post('user/status/change', 'User_control::modifyUserStatus', ['filter' => 'auth']);
$routes->post('user/password/change', 'User_control::modifyUserPassword', ['filter' => 'auth']);
$routes->post('user/personal/change', 'User_control::modifyPersonal', ['filter' => 'auth']);
$routes->post('list/administrator', 'User_control::administratorList', ['filter' => 'auth']);
$routes->post('administrator/build', 'User_control::addAdministrator', ['filter' => 'auth']);
$routes->post('administrator/api-config', 'User_control::getAdminLink', ['filter' => 'auth']);
$routes->post('administrator/api-config/modify', 'User_control::modifyAdminLink', ['filter' => 'auth']);
$routes->post('user/register/bycurrency', 'User_control::registerByCurrency', ['filter' => 'auth']);

$routes->resource('Balance_control');
$routes->post('list/history/transaction', 'Balance_control::transactionHistoryList', ['filter' => 'auth']);
$routes->post('user/replenishment', 'Balance_control::userReplenishment', ['filter' => 'auth']);

$routes->resource('Gamecategory_control');
$routes->post('list/game-category/raw', 'Gamecategory_control::gameCategoryRawList', ['filter' => 'auth']);
$routes->post('list/game-provider/category', 'Gamecategory_control::gameCategoryList', ['filter' => 'auth']);
$routes->post('list/game-category', 'Gamecategory_control::allGameCategory', ['filter' => 'auth']);
$routes->post('game-category/get', 'Gamecategory_control::getGameCategory', ['filter' => 'auth']);
$routes->post('game-category/modify', 'Gamecategory_control::modifyGameCategory', ['filter' => 'auth']);

$routes->resource('Gameprovider_control');
$routes->post('list/game-provider/raw', 'Gameprovider_control::gameProviderList', ['filter' => 'auth']);
$routes->post('list/game-provider/all', 'Gameprovider_control::gameProviderAllList', ['filter' => 'auth']);
$routes->post('game-provider/get', 'Gameprovider_control::getGameProvider', ['filter' => 'auth']);
$routes->post('game-provider/add', 'Gameprovider_control::addGameProvider', ['filter' => 'auth']);
$routes->post('game-provider/modify', 'Gameprovider_control::editGameProvider', ['filter' => 'auth']);
$routes->post('game-provider/status/modify', 'Gameprovider_control::editStatusGameProvider', ['filter' => 'auth']);

$routes->resource('Game_control');
$routes->post('list/game-provider/games', 'Game_control::gamesAllList', ['filter' => 'auth']);
$routes->post('game-provider/game/get', 'Game_control::getGame', ['filter' => 'auth']);
$routes->post('game-provider/games/add', 'Game_control::addGame', ['filter' => 'auth']);
$routes->post('game-provider/games/edit', 'Game_control::editGame', ['filter' => 'auth']);
$routes->post('game-provider/games/status/edit', 'Game_control::editStatusGame', ['filter' => 'auth']);

$routes->resource('Gamept_control');
$routes->post('list/game-provider/position-taking', 'Gamept_control::gamePtList', ['filter' => 'auth']);
$routes->post('game-provider/position-taking/minmax', 'Gamept_control::minMaxGamePt', ['filter' => 'auth']);
$routes->post('game-provider/position-taking/modify', 'Gamept_control::modifyGamePt', ['filter' => 'auth']);
$routes->post('game-provider/position-taking/master/modify', 'Gamept_control::modifyMasterGamePt', ['filter' => 'auth']);

$routes->resource('Bank_control');
$routes->post('list/bank', 'Bank_control::bankList', ['filter' => 'auth']);
$routes->post('bank/get', 'Bank_control::bank', ['filter' => 'auth']);
$routes->post('bank/add', 'Bank_control::addBank', ['filter' => 'auth']);
$routes->post('bank/modify', 'Bank_control::modifyBank', ['filter' => 'auth']);

$routes->resource('Pgateway_control');
$routes->post('list/payment-gateway', 'Pgateway_control::bankList', ['filter' => 'auth']);
$routes->post('payment-gateway/get', 'Pgateway_control::bank', ['filter' => 'auth']);
$routes->post('payment-gateway/add', 'Pgateway_control::addBank', ['filter' => 'auth']);
$routes->post('payment-gateway/modify', 'Pgateway_control::modifyBank', ['filter' => 'auth']);

$routes->resource('Lang_control');
$routes->post('list/languages', 'Lang_control::langList', ['filter' => 'auth']);
$routes->post('settings/language/add', 'Lang_control::addLang', ['filter' => 'auth']);
$routes->post('settings/language/modify', 'Lang_control::modifyLang', ['filter' => 'auth']);

$routes->resource('Currency_control');
$routes->post('currencies', 'Currency_control::currencySelect', ['filter' => 'auth']);
$routes->post('list/currency', 'Currency_control::currencyList', ['filter' => 'auth']);
$routes->post('settings/currency/add', 'Currency_control::addCurrency', ['filter' => 'auth']);
$routes->post('settings/currency/modify', 'Currency_control::modifyCurrency', ['filter' => 'auth']);

$routes->resource('Paytype_control');
$routes->get('payment-types', 'Paytype_control::payTypeSelect', ['filter' => 'auth']);
$routes->post('list/payment-types', 'Paytype_control::payTypeList', ['filter' => 'auth']);
$routes->post('payment-types/get', 'Paytype_control::getPayType', ['filter' => 'auth']);
$routes->post('settings/payment-types/modify', 'Paytype_control::modifyPayType', ['filter' => 'auth']);

$routes->resource('Paystatus_control');
$routes->get('payment-status', 'Paystatus_control::payStatusSelect', ['filter' => 'auth']);
$routes->post('list/payment-status', 'Paystatus_control::payStatusList', ['filter' => 'auth']);
$routes->post('payment-status/get', 'Paystatus_control::getPayStatus', ['filter' => 'auth']);
$routes->post('settings/payment-status/modify', 'Paystatus_control::modifyPayStatus', ['filter' => 'auth']);

$routes->resource('Errorcode_control');
$routes->get('error-code', 'Errorcode_control::errorCodeSelect', ['filter' => 'auth']);
$routes->post('list/error-code', 'Errorcode_control::errorCodeList', ['filter' => 'auth']);
$routes->post('error-code/get', 'Errorcode_control::getErrorCode', ['filter' => 'auth']);
$routes->post('settings/error-code/modify', 'Errorcode_control::modifyErrorCode', ['filter' => 'auth']);

$routes->resource('Announcement_control');
$routes->get('list/announcement/self', 'Announcement_control::announcementSelfList', ['filter' => 'auth']);
$routes->post('announcement/self/get', 'Announcement_control::getSelfAnnouncement', ['filter' => 'auth']);
$routes->post('announcement/add', 'Announcement_control::addAnnouncement', ['filter' => 'auth']);
$routes->post('announcement/modify', 'Announcement_control::modifyAnnouncement', ['filter' => 'auth']);

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
