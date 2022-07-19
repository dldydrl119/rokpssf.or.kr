<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['admin/slide-add'] = 'admin/insertSlide';
$route['admin/slide-add/(:num)'] = 'admin/insertSlide/$1';
$route['admin/slide-count'] = 'admin/slideCount';
$route['admin/slide-idxs-update'] = 'admin/slideIdxsUpdate';

$route['admin/history-menu'] = 'admin/historyMenu';
$route['admin/history-menu/(:num)'] = 'admin/historyMenu/$1';
$route['admin/insert-history'] = 'admin/insertHistory';
$route['admin/history-insert'] = 'admin/historyInsertData';
$route['admin/history-edit/(:num)'] = 'admin/historyEdit/$1';
$route['admin/history-update'] = 'admin/historyUpdateData';
$route['admin/history-del/(:num)'] = 'admin/historyDelete/$1';
$route['admin/history-number-update'] = 'admin/historyIdxsUpdate';
$route['admin/history-count'] = 'admin/historyCount';

$route['admin/history-give/(:num)'] = 'admin/historyGiveList/$1';
$route['admin/history-give'] = 'admin/historyGiveList';
$route['admin/history-giveadd'] = 'admin/historyGiveInsert';
$route['admin/history-give-addInsert'] = 'admin/historyGiveInsertData';
$route['admin/history-give-edit/(:num)'] = 'admin/historyGiveUpdate/$1';
$route['admin/history-give-editdata'] = 'admin/historyGiveUpdateData';
$route['admin/history-give-del/(:num)'] = 'admin/historyGiveDelete/$1';
$route['admin/history-give-numberUpdate'] = 'admin/historyGiveIdxsUpdate';
$route['admin/history-give-count'] = 'admin/historyGiveCount';

$route['admin/history-support'] = 'admin/historySupportList';
$route['admin/history-support/(:num)'] = 'admin/historySupportList/$1';
$route['admin/history-supportadd'] = 'admin/historySupportInsert';
$route['admin/history-support-addInsert'] = 'admin/historySupportInsertData';
$route['admin/history-support-edit/(:num)'] = 'admin/historySupportUpdate/$1';
$route['admin/history-support-editdata'] = 'admin/historySupportUpdateData';
$route['admin/history-support-del/(:num)'] = 'admin/historySupportDelete/$1';
$route['admin/history-support-numberUpdate'] = 'admin/historySupportIdxsUpdate';
$route['admin/history-support-count'] = 'admin/historySupportCount';

$route['admin/history-contribution'] = 'admin/historyContributionList';
$route['admin/history-contribution/(:num)'] = 'admin/historyContributionList/$1';
$route['admin/history-contributionadd'] = 'admin/historyContributionInsert';
$route['admin/history-contribution-addInsert'] = 'admin/historyContributionInsertData';
$route['admin/history-contribution-edit/(:num)'] = 'admin/historyContributionUpdate/$1';
$route['admin/history-contribution-editdata'] = 'admin/historyContributionUpdateData';
$route['admin/history-contribution-del/(:num)'] = 'admin/historyContributionDelete/$1';
$route['admin/history-contribution-numberUpdate'] = 'admin/historyContributionIdxsUpdate';
$route['admin/history-contribution-count'] = 'admin/historyContributionCount';

$route['admin/history-donate'] = 'admin/historyDonateList';
$route['admin/history-donate/(:num)'] = 'admin/historyDonateList/$1';
$route['admin/history-donateadd'] = 'admin/historyDonateInsert';
$route['admin/history-donate-addInsert'] = 'admin/historyDonateInsertData';
$route['admin/history-donate-edit/(:num)'] = 'admin/historyDonateUpdate/$1';
$route['admin/history-donate-editdata'] = 'admin/historyDonateUpdateData';
$route['admin/history-donate-del/(:num)'] = 'admin/historyDonateDelete/$1';
$route['admin/history-donate-numberUpdate'] = 'admin/historyDonateIdxsUpdate';
$route['admin/history-donate-count'] = 'admin/historyDonateCount';


$route['admin/history-collabo'] = 'admin/historyCollaboList';
$route['admin/history-collabo/(:num)'] = 'admin/historyCollaboList/$1';
$route['admin/history-collaboadd'] = 'admin/historyCollaboInsert';

$route['admin/history-collabo-addInsert'] = 'admin/historyCollaboInsertData';

$route['admin/history-collabo-edit/(:num)'] = 'admin/historyCollaboUpdate/$1';
$route['admin/history-collabo-editdata'] = 'admin/historyCollaboUpdateData';
$route['admin/history-collabo-del/(:num)'] = 'admin/historyCollaboDelete/$1';
$route['admin/history-collabo-numberUpdate'] = 'admin/historyCollaboIdxsUpdate';
$route['admin/history-collabo-count'] = 'admin/historyCollaboCount';


$route['admin/bursary-give'] = 'admin/bursaryGiveList';
$route['admin/bursary-give/(:num)'] = 'admin/bursaryGiveList/$1';
//$route['admin/bursary-give/(:num)/(:num)'] = 'admin/bursaryGiveList/$1/$2';
$route['admin/bursary-give-add'] = 'admin/bursaryGiveInsert';
$route['admin/give-add-data'] = 'admin/bursaryGiveInsertData';
$route['admin/bursary-give-edit/(:num)'] = 'admin/bursaryGiveEdit/$1';
$route['admin/bursary-give-update'] = 'admin/bursaryGiveUpdateData';
$route['admin/bursary-give-del/(:num)'] = 'admin/bursaryGiveDel/$1';
$route['admin/bursary-give-count'] = 'admin/bursaryGiveCount';
$route['admin/bursary-give-order'] = 'admin/bursaryGiveOrder';




$route['admin/report-add'] = 'admin/reportInsert';

$route['admin/report-add-data'] = 'admin/reportInsertData';

$route['admin/report-edit/(:num)'] = 'admin/reportEdit/$1';
$route['admin/report-update'] = 'admin/reportUpdateData';
$route['admin/report-del/(:num)'] = 'admin/reportDel/$1';
$route['admin/report-order'] = 'admin/reportOrder';
$route['admin/report-count'] = 'admin/reportCount';


$route['admin/bursary-donation'] = 'admin/bursaryDonation';
$route['admin/bursary-donation/(:num)'] = 'admin/bursaryDonation/$1';
$route['admin/donation-add'] = 'admin/donationInsert';
$route['admin/donation-add-data'] = 'admin/donationInsertData';
$route['admin/donation-edit/(:num)'] = 'admin/donationEdit/$1';
$route['admin/donation-update'] = 'admin/donationUpdateData';
$route['admin/donation-del/(:num)'] = 'admin/donationDel/$1';
$route['admin/donation-order'] = 'admin/donationOrder';
$route['admin/donation-count'] = 'admin/donationCount';

$route['admin/bursary-goods'] = 'admin/bursaryGoods';
$route['admin/bursary-goods/(:num)'] = 'admin/bursaryGoods/$1';
$route['admin/goods-add'] = 'admin/goodsInsert';
$route['admin/goods-add-data'] = 'admin/goodsInsertData';
$route['admin/goods-edit/(:num)'] = 'admin/goodsEdit/$1';
$route['admin/goods-update'] = 'admin/goodsUpdateData';
$route['admin/goods-del/(:num)'] = 'admin/bursaryGoodsDel/$1';
$route['admin/goods-order'] = 'admin/goodsOrder';
$route['admin/goods-count'] = 'admin/goodsCount';

$route['admin/notice-add'] = 'admin/noticeInsert';
$route['admin/notice-add-data'] = 'admin/noticeInsertData';
$route['admin/notice-edit/(:num)'] = 'admin/noticeEdit/$1';
$route['admin/notice-update'] = 'admin/noticeUpdateData';
$route['admin/notice-del/(:num)'] = 'admin/noticeDel/$1';
$route['admin/notice-order'] = 'admin/noticeOrder';
$route['admin/notice-count'] = 'admin/noticeCount';
$route['admin/notice-filedel'] = 'admin/noticeFiledel';


$route['admin/press-add'] = 'admin/pressInsert';
$route['admin/press-add-data'] = 'admin/pressInsertData';
$route['admin/press-edit/(:num)'] = 'admin/pressEdit/$1';
$route['admin/press-update'] = 'admin/pressUpdateData';
$route['admin/press-del/(:num)'] = 'admin/pressDel/$1';
$route['admin/press-order'] = 'admin/pressOrder';
$route['admin/press-count'] = 'admin/pressCount';

$route['admin/gallery-add'] = 'admin/galleryInsert';
$route['admin/gallery-add-data'] = 'admin/galleryInsertData';
$route['admin/gallery-edit/(:num)'] = 'admin/galleryEdit/$1';
$route['admin/gallery-update'] = 'admin/galleryUpdateData';
$route['admin/gallery-del/(:num)'] = 'admin/galleryDel/$1';
$route['admin/gallery-order'] = 'admin/galleryOrder';
$route['admin/gallery-count'] = 'admin/galleryCount';


$route['admin/gallery-count'] = 'admin/galleryCount';



$route['admin/bursary-oneper'] = 'admin/bursaryOneper';
$route['admin/bursary-oneper/(:num)'] = 'admin/bursaryOneper/$1';
$route['admin/oneper-add'] = 'admin/oneperInsert';
$route['admin/oneper-add-data'] = 'admin/oneperInsertData';
$route['admin/oneper-edit/(:num)'] = 'admin/oneperEdit/$1';
$route['admin/oneper-update'] = 'admin/oneperUpdateData';
$route['admin/oneper-del/(:num)'] = 'admin/bursaryOneperDel/$1';
$route['admin/oneper-order'] = 'admin/oneperOrder';
$route['admin/oneper-count'] = 'admin/oneperCount';


$route['admin/bursary-roll'] = 'admin/bursaryRoll';
$route['admin/bursary-roll/(:num)'] = 'admin/bursaryRoll/$1';
$route['admin/roll-add'] = 'admin/rollInsert';
$route['admin/roll-add-data'] = 'admin/rollInsertData';
$route['admin/roll-edit/(:num)'] = 'admin/rollEdit/$1';
$route['admin/roll-update'] = 'admin/rollUpdateData';
$route['admin/roll-del/(:num)'] = 'admin/bursaryRollDel/$1';
$route['admin/roll-order'] = 'admin/rollOrder';
$route['admin/roll-count'] = 'admin/rollCount';

$route['admin/bursary-cms'] = 'admin/bursaryCms';
$route['admin/bursary-cms/(:num)'] = 'admin/bursaryCms/$1';
$route['admin/cms-add'] = 'admin/cmsInsert';
$route['admin/cms-add-data'] = 'admin/cmsInsertData';
$route['admin/cms-edit/(:num)'] = 'admin/cmsEdit/$1';
$route['admin/cms-update'] = 'admin/cmsUpdateData';
$route['admin/cms-del/(:num)'] = 'admin/bursaryCmsDel/$1';
$route['admin/cms-order'] = 'admin/cmsOrder';
$route['admin/cms-count'] = 'admin/cmsCount';

$route['greeting'] = 'main/greeting';
$route['found']    = 'main/found';
$route['history']  = 'main/history';
$route['contactus']= 'main/contactus';
$route['business']= 'main/business';
$route['bursary']= 'main/bursary';
$route['donation']= 'main/donation';
$route['notice']= 'main/notice';
$route['notice/(:num)'] = 'main/notice/$1';
$route['press']= 'main/press';
$route['press/(:num)'] = 'main/press/$1';
$route['gallery']= 'main/gallery';
$route['gallery/(:num)'] = 'main/gallery/$1';
$route['social']= 'main/social';
$route['notice-view/(:num)'] = 'main/noticeView/$1';
$route['press-view/(:num)'] = 'main/pressView/$1';
$route['gallery-view/(:num)'] = 'main/galleryView/$1';
$route['roll']= 'main/roll';
$route['cms']= 'main/cms';

