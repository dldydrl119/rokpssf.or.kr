<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('pagination');
        $this->load->model('mainmodel');
        $this->load->model('adminmodel');
        $this->load->library('user_agent');
        $this->load->library('pagination');

        $this->menu_bar = [
            1=>'재단소개', 2=>'사업소개', 3=>'장학금 · 기부자 명단', 4=>'정보마당'
        ];

        $this->sub_menu = [
            1=>[
                'greeting'=>'이사장 인사말',
                'found'=>'설립취지',
                'history'=> '연혁',
                'contactus' => '오시는 길',
            ],
            2 => '/business',
            3 => [
                'bursary'=>'지원사업 활동내역',
                'roll'=>'기부자 및 후원자 명단',
                'cms'=> 'CMS 기부자 명단'
            ],
            4=> [
                'notice' => '공지사항',
                'press' => '언론보도',
                'gallery' => '갤러리',
                'social' => 'SNS'
            ]
        ];

        $this->page_limit = 10;
        $this->search_terms = ['all' => '전체', 'title'=>'제목', 'content'=>'내용'];
    }

    public function index()
    {

        $data = [
            'slide_data' => $this->mainmodel->slideListDataAll(),
            'give_data' => $this->mainmodel->bursaryGiveData(5, 1) ,
            'goods_data' => $this->mainmodel->goodsData(5, 1),
            'gallery_data' => $this->mainmodel->galleryData(10, 1),
            'notice_data' => $this->mainmodel->noticeData(10, 1),
            'press_data' => $this->mainmodel->pressData(10, 1),
            'report_data' => $this->mainmodel->reportData(10, 1)
        ];

        $this->load->template('index',$data, true);
    }

    public function greeting()
    {

        $data['fic_main_menu'] = $this->menu_bar[1];
        $data['sub_menu'] = $this->sub_menu[1];
        $data['fic_sub_menu'] = __FUNCTION__;
        $this->load->template('greeting',$data);
    }

    public function found()
    {

        $data['fic_main_menu'] = $this->menu_bar[1];
        $data['sub_menu'] = $this->sub_menu[1];
        $data['fic_sub_menu'] = __FUNCTION__;
        $this->load->template('found',$data);
    }

    public function history()
    {
        $data['history'] = $this->mainmodel->historyMenuAll();
        $data['history_give'] = $this->mainmodel->historyGiveAll();
        $data['history_support'] = $this->mainmodel->historySupportAll();
        $data['history_contribution'] = $this->mainmodel->historyContributionAll();
        $data['history_donate'] = $this->mainmodel->historyDonateAll();
        $data['history_collabo'] = $this->mainmodel->historyCollaboAll();


        $data['fic_main_menu'] = $this->menu_bar[1];
        $data['sub_menu'] = $this->sub_menu[1];
        $data['fic_sub_menu'] = __FUNCTION__;
        $this->load->template('history',$data);
    }

    public function contactus()
    {

        $data['fic_main_menu'] = $this->menu_bar[1];
        $data['sub_menu'] = $this->sub_menu[1];
        $data['fic_sub_menu'] = __FUNCTION__;
        $this->load->template('contactus',$data);
    }

    public function business()
    {
        $data['fic_main_menu'] = $this->menu_bar[2];

        $this->load->template('business',$data  );
    }
    public function bursary($page=1)
    {

        /*$total_num= $this->mainmodel->bursaryGiveDataTotalNum();
        $data['bursary'] = $this->mainmodel->bursaryGiveData($this->page_limit, $page);


        $goods_total_num= $this->mainmodel->goodsDataTotalNum();
        $goods = $this->mainmodel->goodsData($this->page_limit, $page);

        $url = URL.'main/bursary';
        $data['paging'] = $this->page_link($total_num,$page, $url);
        $data['number'] = $total_num - (($page-1)*$this->page_limit);

        $data['fic_main_menu'] = $this->menu_bar[3];
        $data['sub_menu'] = $this->sub_menu[3];
        $data['fic_sub_menu'] = __FUNCTION__;
*/

        $give_total_num= $this->mainmodel->bursaryGiveDataTotalNum();
        $give = $this->mainmodel->bursaryGiveData($this->page_limit, $page);

        $data['donation'] = $give;
        $data['donation_page'] = $this->page_link2($give_total_num,$page, 'donation_js_page');
        $data['donation_number'] = $give_total_num - (($page-1)*$this->page_limit);

        $goods_total_num= $this->mainmodel->goodsDataTotalNum();
        $goods = $this->mainmodel->goodsData($this->page_limit, $page);

        $data['goods'] = $goods;
        $data['goods_page'] = $this->page_link2($goods_total_num,$page, 'goods_js_page');
        $data['goods_number'] = $goods_total_num - (($page-1)*$this->page_limit);

        $data['fic_main_menu'] = $this->menu_bar[3];
        $data['sub_menu'] = $this->sub_menu[3];
        $data['fic_sub_menu'] = __FUNCTION__;

        $this->load->template('bursary', $data);
    }

    public function donation($page=1) {

        $donation_total_num= $this->mainmodel->donationDataTotalNum();
        $donation = $this->mainmodel->donationData($this->page_limit, $page);

        $data['donation'] = $donation;
        $data['donation_page'] = $this->page_link2($donation_total_num,$page, 'donation_js_page');
        $data['donation_number'] = $donation_total_num - (($page-1)*$this->page_limit);

        $goods_total_num= $this->mainmodel->goodsDataTotalNum();
        $goods = $this->mainmodel->goodsData($this->page_limit, $page);

        $data['goods'] = $goods;
        $data['goods_page'] = $this->page_link2($goods_total_num,$page, 'goods_js_page');
        $data['goods_number'] = $goods_total_num - (($page-1)*$this->page_limit);

        $data['fic_main_menu'] = $this->menu_bar[3];
        $data['sub_menu'] = $this->sub_menu[3];
        $data['fic_sub_menu'] = __FUNCTION__;
        $this->load->template('donation', $data);
    }

    public function donationPage($page) {
        $give_total_num= $this->mainmodel->bursaryGiveDataTotalNum();
        $give = $this->mainmodel->bursaryGiveData($this->page_limit, $page);

        $data['donation'] = $give;
        $data['donation_page'] = $this->page_link2($give_total_num,$page, 'donation_js_page');
        $data['donation_number'] = $give_total_num - (($page-1)*$this->page_limit);

        echo json_encode($data);
        exit;
    }

    public function goodsPage($page) {
        $goods_total_num= $this->mainmodel->goodsDataTotalNum();
        $goods = $this->mainmodel->goodsData($this->page_limit, $page);

        $data['goods'] = $goods;
        $data['goods_page'] = $this->page_link2($goods_total_num,$page, 'goods_js_page');
        $data['goods_number'] = $goods_total_num - (($page-1)*$this->page_limit);

        echo json_encode($data);
        exit;
    }

    public function page_link($total_num,$page, $url, $build_query='')
    {
        $page = $page;
        $list = $this->page_limit;
        $block = 5;

        $num =$total_num;
        $pageNum = ceil($num/$list); // 총 페이지
        $blockNum = ceil($pageNum/$block); // 총 블록
        $nowBlock = ceil($page/$block);

        //총 페이지수가 1이면 페이징 안함
        if($pageNum <=1) {
            return '';
        }



        $paging = '<nav class="page_nate">'; // 페이징을 저장할 변수

        if($build_query) {
            $build_query = '?'.$build_query;
        }
        $paging .= " <a href=\"{$url}/1{$build_query}\" class=\"btn_page first\">처음으로</a>";
        if($page <= $pageNum && $page > 1 ) {
            $pre_page = $page +1 ;
            $paging .= " <a href=\"{$url}/{$pre_page}{$build_query}\" class=\"btn_page prev\">이전</a>";
        }
        for ($p=1; $p<=$pageNum; $p++) {
            if($p == $page) {
                $paging .= " <a href=\"javascript:;\" class=\"direct curr\">{$p}</a>";
            } else {

                $paging .= " <a href=\"{$url}/{$p}{$build_query}\" class=\"direct\">{$p}</a>";
            }
        }

        if($page < $pageNum) {
            $next_page = $page +1 ;
            $paging .= " <a href=\"{$url}/{$next_page}{$build_query}\" class=\"btn_page next\">다음</a>";
        }
        $paging .= " <a href=\"{$url}/{$pageNum}{$build_query}\" class=\"btn_page last\">마지막</a>";
        $paging .= ' </nav>';

        return $paging;
    }

    public function page_link2($total_num,$page, $js_fun)
    {
        $page = $page;
        $list = $this->page_limit;
        $block = 5;

        $num =$total_num;
        $pageNum = ceil($num/$list); // 총 페이지
        $blockNum = ceil($pageNum/$block); // 총 블록
        $nowBlock = ceil($page/$block);

        //총 페이지수가 1이면 페이징 안함
        if($pageNum <=1) {
            return '';
        }

        $paging = '<nav class="page_nate">'; // 페이징을 저장할 변수

        $paging .= " <a href=\"javascript:{$js_fun}(1)\" class=\"btn_page first\">처음으로</a>";
        if($page <= $pageNum && $page > 1 ) {
            $pre_page = $page +1 ;
            $paging .= " <a href=\"javascript:{$js_fun}({$pre_page})\" class=\"btn_page prev\">이전</a>";
        }
        for ($p=1; $p<=$pageNum; $p++) {
            if($p == $page) {
                $paging .= " <a href=\"javascript:;\" class=\"direct curr\">{$p}</a>";
            } else {

                $paging .= " <a href=\"javascript:{$js_fun}({$p})\" class=\"direct\">{$p}</a>";
            }
        }

        if($page < $pageNum) {
            $next_page = $page +1 ;
            $paging .= " <a href=\"javascript:{$js_fun}({$next_page})\" class=\"btn_page next\">다음</a>";
        }
        $paging .= " <a href=\"javascript:{$js_fun}({$pageNum})\" class=\"btn_page last\">마지막</a>";
        $paging .= ' </nav>';

        return $paging;
    }

    public function uploadimage() {
        $json = $this->upload('image');
        return $this->json($json);
    }

    public function notice($page=1) {
        $search_kind = $this->input->get('search_kind');
        $search_txt= $this->input->get('search_txt');
        $build_query = http_build_query(['search_kind' => $search_kind, 'search_txt'=> $search_txt]);
        $data['search_terms'] =$this->search_terms;

        $total_num= $this->mainmodel->noticeTotalNum($search_kind, $search_txt);
        $data['notice'] = $this->mainmodel->noticeData($this->page_limit, $page, $search_kind, $search_txt);

        $data['search_txt'] = $search_txt;
        $data['search_kind'] = $search_kind;

        $url = URL.'notice';
        $data['paging'] = $this->page_link($total_num,$page, $url, $build_query);
        $data['number'] = $total_num - (($page-1)*$this->page_limit);

        $data['sub_menu'] = $this->sub_menu[4];
        $data['fic_sub_menu'] = __FUNCTION__;

        $data['fic_main_menu'] = $this->menu_bar[4];

        $this->load->template('notice', $data);
    }

    public function noticeView($idx) {

        $notice = $this->adminmodel->noticeData($idx);
        if( empty($_COOKIE['notice_view_'.$idx]) && !empty($notice)) {
            $_COOKIE['notice_view_'.$idx]= 1;
            $notice->hit = $notice->hit+1;

            $hit = ['hit' => $notice->hit];

            $this->adminmodel->noticeUpdateData($hit, $idx);
            setcookie('notice_view_' . $idx, TRUE, time() + (60 * 60 * 24), '/');
        }
        $data = [
            'notice' => $notice
        ];

        $data['sub_menu'] = $this->sub_menu[4];
        $data['fic_sub_menu'] = 'notice';
        $data['fic_main_menu'] = $this->menu_bar[4];

        $this->load->template('notice_view', $data);
    }

    public function press($page=1) {
        $this->page_limit = 6;
        $search_kind = $this->input->get('search_kind');
        $search_txt= $this->input->get('search_txt');
        $build_query = http_build_query(['search_kind' => $search_kind, 'search_txt'=> $search_txt]);
        $data['search_terms'] =$this->search_terms;

        $total_num= $this->mainmodel->pressTotalNum($search_kind, $search_txt);
        $data['press'] = $this->mainmodel->pressData($this->page_limit, $page, $search_kind, $search_txt);

        $data['search_txt'] = $search_txt;
        $data['search_kind'] = $search_kind;

        $url = URL.'press';
        $data['paging'] = $this->page_link($total_num,$page, $url, $build_query);
        $data['number'] = $total_num - (($page-1)*$this->page_limit);

        $data['sub_menu'] = $this->sub_menu[4];
        $data['fic_sub_menu'] = __FUNCTION__;

        $data['fic_main_menu'] = $this->menu_bar[4];
        $this->load->template('press', $data);
    }

    public function pressView($idx) {
        $press = $this->adminmodel->pressData($idx);
        if( empty($_COOKIE['press_view_'.$idx])) {
            $_COOKIE['press_view_'.$idx]= 1;
            $press->hit = $press->hit+1;

            $hit = ['hit' => $press->hit];

            $this->adminmodel->pressUpdateData($hit, $idx);
            setcookie('press_view_' . $idx, TRUE, time() + (60 * 60 * 24), '/');
        }
        $data = [
            'press' => $press
        ];

        $data['fic_main_menu'] = $this->menu_bar[4];
        $data['sub_menu'] = $this->sub_menu[4];
        $data['fic_sub_menu'] = 'press';
        $this->load->template('press_view', $data);
    }

    public function gallery($page=1) {
        $this->page_limit = 6;
        $search_kind = $this->input->get('search_kind');
        $search_txt= $this->input->get('search_txt');
        $build_query = http_build_query(['search_kind' => $search_kind, 'search_txt'=> $search_txt]);
        $data['search_terms'] =$this->search_terms;

        $total_num= $this->mainmodel->galleryTotalNum($search_kind, $search_txt);
        $data['gallery'] = $this->mainmodel->galleryData($this->page_limit, $page, $search_kind, $search_txt);

        $data['search_txt'] = $search_txt;
        $data['search_kind'] = $search_kind;

        $url = URL.'gallery';
        $data['paging'] = $this->page_link($total_num,$page, $url, $build_query);
        $data['number'] = $total_num - (($page-1)*$this->page_limit);

        $data['sub_menu'] = $this->sub_menu[4];
        $data['fic_sub_menu'] = __FUNCTION__;
        $data['fic_main_menu'] = $this->menu_bar[4];
        $this->load->template('gallery', $data);
    }

    public function galleryView($idx) {
        $gallery = $this->adminmodel->galleryData($idx);
        if( empty($_COOKIE['gallery_view_'.$idx])) {
            $_COOKIE['gallery_view_'.$idx]= 1;
            $gallery->hit = $gallery->hit+1;

            $hit = ['hit' => $gallery->hit];

            $this->adminmodel->galleryUpdateData($hit, $idx);
            setcookie('gallery_view_' . $idx, TRUE, time() + (60 * 60 * 24), '/');
        }
        $data = [
            'gallery' => $gallery
        ];

        $data['fic_main_menu'] = $this->menu_bar[4];
        $data['sub_menu'] = $this->sub_menu[4];
        $data['fic_sub_menu'] = 'gallery';
        $this->load->template('gallery_view', $data);
    }

    public function social() {
        $data['sub_menu'] = $this->sub_menu[4];
        $data['fic_sub_menu'] = __FUNCTION__;
        $this->load->template('social',$data);
    }

    public function roll($page=1)
    {
        /*
		$total_num= $this->mainmodel->bursaryGiveDataTotalNum();
        $data['bursary'] = $this->mainmodel->bursaryGiveData($this->page_limit, $page);

        $goods_total_num= $this->mainmodel->goodsDataTotalNum();
        $goods = $this->mainmodel->goodsData($this->page_limit, $page);

        $url = URL.'main/bursary';
        $data['paging'] = $this->page_link($total_num,$page, $url);
        $data['number'] = $total_num - (($page-1)*$this->page_limit);

        $data['fic_main_menu'] = $this->menu_bar[3];
        $data['sub_menu'] = $this->sub_menu[3];
        $data['fic_sub_menu'] = __FUNCTION__;
		*/
        $give_total_num= $this->mainmodel->bursaryOneperDataTotalNum();
        $give = $this->mainmodel->bursaryOneperData($this->page_limit, $page);

        $data['donation'] = $give;
        $data['donation_page'] = $this->page_link2($give_total_num,$page, 'oneper_js_page');
        $data['donation_number'] = $give_total_num - (($page-1)*$this->page_limit);

        $goods_total_num= $this->mainmodel->bursaryRollDataTotalNum();
        $goods = $this->mainmodel->bursaryRollData($this->page_limit, $page);

        $data['goods'] = $goods;
        $data['goods_page'] = $this->page_link2($goods_total_num,$page, 'roll_js_page');
        $data['goods_number'] = $goods_total_num - (($page-1)*$this->page_limit);

        $data['fic_main_menu'] = $this->menu_bar[3];
        $data['sub_menu'] = $this->sub_menu[3];
        $data['fic_sub_menu'] = __FUNCTION__;

        $this->load->template('roll', $data);
    }

    public function oneperPage($page) {
        $total_num= $this->mainmodel->bursaryOneperDataTotalNum();
        $give = $this->mainmodel->bursaryOneperData($this->page_limit, $page);

        $data['oneper'] = $give;
        $data['oneper_page'] = $this->page_link2($total_num,$page, 'oneper_js_page');
        $data['oneper_number'] = $total_num - (($page-1)*$this->page_limit);

        echo json_encode($data);
        exit;
    }

    public function rollPage($page) {
        $total_num= $this->mainmodel->bursaryOneperDataTotalNum();
        $give = $this->mainmodel->bursaryOneperData($this->page_limit, $page);

        $data['roll'] = $give;
        $data['roll_page'] = $this->page_link2($total_num,$page, 'roll_js_page');
        $data['roll_number'] = $total_num - (($page-1)*$this->page_limit);

        echo json_encode($data);
        exit;
    }

    public function cms($page=1)
    {
        $total_num= $this->mainmodel->bursaryCmsDataTotalNum();
        $data['bursary'] = $this->mainmodel->bursaryCmsData($this->page_limit, $page);

        $url = URL.'main/cms';
        $data['paging'] = $this->page_link($total_num,$page, $url);
        $data['number'] = $total_num - (($page-1)*$this->page_limit);

        $data['fic_main_menu'] = $this->menu_bar[3];
        $data['sub_menu'] = $this->sub_menu[3];
        $data['fic_sub_menu'] = __FUNCTION__;
        $this->load->template('cms', $data);
    }
}
