<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('adminmodel');
        $this->load->library('pagination');

        $this->arr_select1 = ['후원금', 'CMS'];
    }

    public function index()
    {
        $this->nologin();
        redirect('/admin/slideList');
    }

    public function login()
    {
        $this->load->view('admin/admin_login');
    }

    public function loginData() //로그인 데이터
    {
        $json = $this->adminmodel->loginData();
        $this->json($json);
    }

    public function logout()
    {
        session_destroy();
        header("location: " . URL . 'admin/login');
    }

    ////////콜겟////////////
    //슬라이드//
    public function slideList($page = 1)
    {
        $this->nologin();
        $name = "메인배너 관리";
        $insert = "/admin/slide-add";
        $url = URL . 'admin/slideList/';
        $col = ['번호', '정렬', '슬라이드 이름', '슬라이드 이미지', ' 클릭 시 링크주소 ', '등록 시간', '수정', '삭제'];
        $button = $this->adminButton($col);

        //이전 페이지 마지막 데이터
        if ($page > 1) {
            $temp = $this->adminmodel->slidelistData($page - 1);
            $pre_one = [end($temp['list'])];
        } else {
            $pre_one = [];
        }
        $json = $this->adminmodel->slidelistData($page);
        //다음 페이지 첫번째 데이터
        $next_one = $this->adminmodel->slidelistData($page + 1);


        $this->paging($json, $url);
        $data = array(
            'name' => $name,
            'col' => $col,
            'pre_one' => $pre_one,
            'list' => $json['list'],
            'next_one' => !empty($next_one['list']) ? [$next_one['list'][0]] : [],
            'adminbutton' => $button,
            'insert' => $insert,
            'page' => $page
        );

        $this->load->view('admin/admin_header');
        $this->load->view('admin/slide_list', $data);
    }

    public function insertSlide()  //등록
    {
        $this->nologin();

        $total_cnt = $this->adminmodel->slideTotalNum();
        if ($total_cnt >= 5) {
            echo '<script>alert("데이터 제한수를 넘었습니다."); history.back();</script>';
            //            $this->json(array('return'=>false, 'err_msg'=>'데이터 제한수를 넘었습니다.'));
            exit;
        }

        $name = "메인배너 등록";
        $data = array('name' => $name);
        $this->load->view('admin/admin_header');
        $this->load->view('admin/slideinsert', $data);
    }

    public function slideinsertData()
    {
        $total_cnt = $this->adminmodel->slideTotalNum();
        if ($total_cnt >= 5) {
            $this->json(array('return' => false, 'err_msg' => '데이터 제한수를 넘었습니다.'));
            exit;
        }
        $json = $this->adminmodel->slideinsertData();
        $this->json($json);
    }

    public function slideedit($idx) //보기
    {
        $this->nologin();
        $name = "메인배너 수정";
        $json = $this->adminmodel->slideData($idx);
        $data = array('name' => $name, 'data' => $json);

        $this->load->view('admin/admin_header');
        $this->load->view('admin/slideinsert', $data);
    }

    public function slideUpdate()
    {
        $json = $this->adminmodel->slideUpdate();
        $this->json($json);
    }

    public function slideIdxsUpdate()
    {
        $json = $this->adminmodel->slideIdxsUpdate();
        $this->json($json);
    }

    public function slidedel($idx)
    {
        $json = $this->adminmodel->slidedel($idx);
        $this->json($json);
    }
    public function slideCount()
    {
        $json = $this->adminmodel->slideCount();
        $this->json($json);
    }


    public function reportList($page = 1)
    {
        $this->nologin();
        $name = "리포트작성";
        $insert = "/admin/reportInsert";
        $url = URL . 'admin/report';
        $col = ['순서','번호', '제목', '금액','금액','금액', '합계', '메모', '제목', '금액','금액','금액', '합계', '메모', '제목', '금액','금액','금액', '합계', '메모', '제목', '금액','금액','금액', '합계', '메모', '제목', '금액','금액','금액', '합계', '메모', '등록 시간', '수정', '삭제'];
        $button = $this->adminButton($col);

        //이전 페이지 마지막 데이터
        if ($page > 1) {
            $temp = $this->adminmodel->reportListData($page - 1);
            $pre_one = [end($temp['list'])];
        } else {
            $pre_one = [];
        }
        $json = $this->adminmodel->reportListData($page);
        //다음 페이지 첫번째 데이터
        $next_one = $this->adminmodel->reportListData($page + 1);

        $this->paging($json, $url);

        $data = array(
            'name' => $name,
            'col' => $col,
            'pre_one' => $pre_one,
            'list' => $json['list'],
            'next_one' => !empty($next_one['list']) ? [$next_one['list'][0]] : [],
            'adminbutton' => $button,
            'insert' => $insert,
            'page' => $page
        );

        $this->load->view('admin/admin_header');
        $this->load->view('admin/report_list', $data);
    }


    
    public function reportInsert()
    {
        $this->nologin();
        $this->load->view('admin/admin_header');
        $name = "리포트 등록";

        $data = array('name' => $name);
        $this->load->view('admin/reportinsert', $data);
    }


    public function reportInsertData()
    {
        $rice_1 = $this->input->post('rice_1');
        $rice_2 = $this->input->post('rice_2');
        $rice_3 = $this->input->post('rice_3');
        $rice_sum = $this->input->post('rice_sum');
        $rice_note = $this->input->post('rice_note');
        $scholarship_1 = $this->input->post('scholarship_1');
        $scholarship_2 = $this->input->post('scholarship_2');
        $scholarship_3 = $this->input->post('scholarship_3');
        $scholarship_sum = $this->input->post('scholarship_sum');
        $scholarship_note = $this->input->post('scholarship_note');
        $medical_1 = $this->input->post('medical_1');
        $medical_2 = $this->input->post('medical_2');
        $medical_3 = $this->input->post('medical_3');
        $medical_sum = $this->input->post('medical_sum');
        $medical_note = $this->input->post('medical_note');
        $lowincome_1 = $this->input->post('lowincome_1');
        $lowincome_2 = $this->input->post('lowincome_2');
        $lowincome_3 = $this->input->post('lowincome_3');
        $lowincome_sum = $this->input->post('lowincome_sum');
        $lowincome_note = $this->input->post('lowincome_note');
        $total_1 = $this->input->post('total_1');
        $total_2 = $this->input->post('total_2');
        $total_3 = $this->input->post('total_3');
        $total_sum = $this->input->post('total_sum');
        $total_note = $this->input->post('total_note');

        $insert_data = [
            'rice_1' => $rice_1,
            'rice_2' => $rice_2,
            'rice_3' => $rice_3,
            'rice_sum' => $rice_sum,
            'rice_note' => $rice_note,
            'scholarship_1' => $scholarship_1,
            'scholarship_2' => $scholarship_2,
            'scholarship_3' => $scholarship_3,
            'scholarship_sum' => $scholarship_sum,
            'scholarship_note' => $scholarship_note,
            'medical_1' => $medical_1,
            'medical_2' => $medical_2,
            'medical_3' => $medical_3,
            'medical_sum' => $medical_sum,
            'medical_note' => $medical_note,
            'lowincome_1' => $lowincome_1,
            'lowincome_2' => $lowincome_2,
            'lowincome_3' => $lowincome_3,
            'lowincome_sum' => $lowincome_sum,
            'lowincome_note' => $lowincome_note,
            'total_1' => $total_1,
            'total_2' => $total_2,
            'total_3' => $total_3,
            'total_sum' => $total_sum,
            'total_note' => $total_note,
        ];

        $json = $this->adminmodel->reportInsertData($insert_data);
        $this->json($json);
    }

    public function reportEdit($idx)
    {
        $this->nologin();
        $name = "리포트 수정";

        $json = $this->adminmodel->reportData($idx);
        $data = array('name' => $name, 'data' => $json);

        $this->load->view('admin/admin_header');
        $this->load->view('admin/reportinsert', $data);
    }

    public function reportUpdateData()
    {
        $update_data = [
            'rice_1' => $this->input->post('rice_1'),
            'rice_2' => $this->input->post('rice_2'),
            'rice_3' => $this->input->post('rice_3'),
            'rice_sum' => $this->input->post('rice_sum'),
            'rice_note' => $this->input->post('rice_note'),
            'scholarship_1' => $this->input->post('scholarship_1'),
            'scholarship_2' => $this->input->post('scholarship_2'),
            'scholarship_3' => $this->input->post('scholarship_3'),
            'scholarship_sum' => $this->input->post('scholarship_sum'),
            'scholarship_note' => $this->input->post('scholarship_note'),
            'medical_1' => $this->input->post('medical_1'),
            'medical_2' => $this->input->post('medical_2'),
            'medical_3' => $this->input->post('medical_3'),
            'medical_sum' => $this->input->post('medical_sum'),
            'medical_note' => $this->input->post('medical_note'),
            'lowincome_1' => $this->input->post('lowincome_1'),
            'lowincome_2' => $this->input->post('lowincome_2'),
            'lowincome_3' => $this->input->post('lowincome_3'),
            'lowincome_sum' => $this->input->post('lowincome_sum'),
            'lowincome_note' => $this->input->post('lowincome_note'),
            'total_1' => $this->input->post('total_1'),
            'total_2' => $this->input->post('total_2'),
            'total_3' => $this->input->post('total_3'),
            'total_sum' => $this->input->post('total_sum'),
            'total_note' => $this->input->post('total_note')
        ];

        $idx = $this->input->post('idx');
        if (!$idx) {
            $this->json(['return' => false, 'err_msg' => 'idx값이 없습니다.']);
        }
        $json = $this->adminmodel->reportUpdateData($update_data, $idx);
        $this->json($json);
    }
    public function reportCount()
    {
        $json = $this->adminmodel->reportCount();
        $this->json($json);
    }

    public function reportDel($idx)
    {
        $json = $this->adminmodel->reportDel($idx);
        $this->json($json);
    }

    public function reportOrder()
    {
        $idxs = $_POST['idxs'];
        $idx = $_POST['idx'];


        if (!$idxs) {
            array('return' => false);
        }
        $json = $this->adminmodel->reportOrder($idxs, $idx);
        $this->json($json);
    }









    


    //상품 관리
    public function historyMenu($page = 1)
    {
        $this->nologin();
        $name = "연혁 관리";
        $insert = "/admin/insert-history";
        $url = URL . 'admin/history-menu/';
        $col = ['번호', '정렬', '연도', '설립과정', '등록 시간', '수정', '삭제'];
        $button = $this->adminButton($col);
        //이전 페이지 마지막 데이터
        if ($page > 1) {
            $temp = $this->adminmodel->historyMenuData($page - 1);
            $pre_one = [end($temp['list'])];
        } else {
            $pre_one = [];
        }
        $json = $this->adminmodel->historyMenuData($page);
        //다음 페이지 첫번째 데이터
        $next_one = $this->adminmodel->historyMenuData($page + 1);

        $this->paging($json, $url);

        $data = array(
            'name' => $name,
            'col' => $col,
            'pre_one' => $pre_one,
            'list' => $json['list'],
            'next_one' => !empty($next_one['list']) ? [$next_one['list'][0]] : [],
            'adminbutton' => $button,
            'insert' => $insert,
            'page' => $page
        );

        $this->load->view('admin/admin_header');
        $this->load->view('admin/history_list', $data);
    }

    public function insertHistory()
    {
        $this->nologin();
        $this->load->view('admin/admin_header');
        $name = "연혁 등록";

        $data = array('name' => $name);
        $this->load->view('admin/insert_history', $data);
    }

    public function historyInsertData()
    {
        $year = $this->input->post('year');
        $memo = $this->input->post('memo');

        $insert_data = [
            'year' => $year,
            'memo' => $memo,
        ];

        $json = $this->adminmodel->historyInsertData($insert_data);
        $this->json($json);
    }

    public function historyEdit($idx) //보기
    {
        $this->nologin();
        $name = "연혁 수정";

        $json = $this->adminmodel->historyData($idx);
        $data = array('name' => $name, 'data' => $json);

        $this->load->view('admin/admin_header');
        $this->load->view('admin/insert_history', $data);
    }

    public function historyUpdateData()
    {
        $year = $this->input->post('year');
        $memo = $this->input->post('memo');
        $idx = $this->input->post('idx');
        $update_data = [
            'year' => $year,
            'memo' => $memo,
        ];

        $json = $this->adminmodel->productUpdateData($update_data, $idx);
        $this->json($json);
    }

    public function historyIdxsUpdate()
    {
        $idxs = $_POST['idxs'];
        $idx = $_POST['idx'];


        if (!$idxs) {
            array('return' => false);
        }
        $json = $this->adminmodel->historyIdxsUpdate($idxs, $idx);
        $this->json($json);
    }

    public function historyDelete($idx)
    {
        $json = $this->adminmodel->historyDelete($idx);
        $this->json($json);
    }

    public function historyCount()
    {
        $json = $this->adminmodel->historyCount();
        $this->json($json);
    }

    public function productShow()
    {
        $json = $this->adminmodel->productShow();
        $this->json($json);
    }


    public function bursaryGiveList($page = 1)
    {
        $this->nologin();
        $name = "장학금지급";
        $insert = "/admin/bursary-give-add";
        $url = URL . 'admin/bursary-give';
        $col = ['번호', '정렬', '성명', '학교', '금액', '등록 시간', '수정', '삭제'];
        $button = $this->adminButton($col);

        //이전 페이지 마지막 데이터
        if ($page > 1) {
            $temp = $this->adminmodel->bursaryGiveListData($page - 1);
            $pre_one = [end($temp['list'])];
        } else {
            $pre_one = [];
        }
        $json = $this->adminmodel->bursaryGiveListData($page);
        //다음 페이지 첫번째 데이터
        $next_one = $this->adminmodel->bursaryGiveListData($page + 1);

        $this->paging($json, $url);

        $data = array(
            'name' => $name,
            'col' => $col,
            'pre_one' => $pre_one,
            'list' => $json['list'],
            'next_one' => !empty($next_one['list']) ? [$next_one['list'][0]] : [],
            'adminbutton' => $button,
            'insert' => $insert,
            'page' => $page
        );

        $this->load->view('admin/admin_header');
        $this->load->view('admin/bursary_list', $data);
    }

    public function bursaryGiveInsert()
    {
        $this->nologin();
        $this->load->view('admin/admin_header');
        $name = "장학금지급 등록";

        $data = array('name' => $name);
        $this->load->view('admin/insert_give', $data);
    }

    public function bursaryGiveInsertData()
    {
        $insert_data = [
            'name' => $this->input->post('name'),
            'associate' => $this->input->post('associate'),
            'give_money' => $this->input->post('give_money'),
        ];

        $json = $this->adminmodel->bursaryGiveInsertData($insert_data);
        $this->json($json);
    }

    public function bursaryGiveEdit($idx)
    {
        $this->nologin();
        $name = "장학금지급 수정";

        $json = $this->adminmodel->bursaryGiveData($idx);
        $data = array('name' => $name, 'data' => $json);

        $this->load->view('admin/admin_header');
        $this->load->view('admin/insert_give', $data);
    }

    public function bursaryGiveUpdateData()
    {
        $update_data = [
            'name' => $this->input->post('name'),
            'associate' => $this->input->post('associate'),
            'give_money' => $this->input->post('give_money'),
        ];

        $idx = $this->input->post('idx');
        if (!$idx) {
            $this->json(['return' => false, 'err_msg' => 'idx값이 없습니다.']);
        }
        $json = $this->adminmodel->bursaryGiveUpdateData($update_data, $idx);
        $this->json($json);
    }
    public function bursaryGiveCount()
    {
        $json = $this->adminmodel->bursaryGiveCount();
        $this->json($json);
    }

    public function bursaryGiveDel($idx)
    {
        $json = $this->adminmodel->bursaryGiveDel($idx);
        $this->json($json);
    }

    public function bursaryGiveOrder()
    {
        $idxs = $_POST['idxs'];
        $idx = $_POST['idx'];


        if (!$idxs) {
            array('return' => false);
        }
        $json = $this->adminmodel->bursaryGiveOrder($idxs, $idx);
        $this->json($json);
    }

    public function bursaryDonation($page = 1)
    {
        $this->nologin();
        $name = "장학금 기부 내역";
        $insert = "/admin/donation-add";
        $url = URL . 'admin/bursary-donation';
        $col = ['번호', '정렬', '성명', '연락처', '학교', '가족', '비고', '지급액', '등록 시간', '수정', '삭제'];
        $button = $this->adminButton($col);

        //이전 페이지 마지막 데이터
        if ($page > 1) {
            $temp = $this->adminmodel->bursaryDonationData($page - 1);
            $pre_one = [end($temp['list'])];
        } else {
            $pre_one = [];
        }
        $json = $this->adminmodel->bursaryDonationData($page);
        //다음 페이지 첫번째 데이터
        $next_one = $this->adminmodel->bursaryDonationData($page + 1);

        $this->paging($json, $url);

        $data = array(
            'name' => $name,
            'col' => $col,
            'pre_one' => $pre_one,
            'list' => $json['list'],
            'next_one' => !empty($next_one['list']) ? [$next_one['list'][0]] : [],
            'adminbutton' => $button,
            'insert' => $insert,
            'page' => $page
        );

        $this->load->view('admin/admin_header');
        $this->load->view('admin/donation_list', $data);
    }

    public function donationInsert()
    {
        $this->nologin();
        $this->load->view('admin/admin_header');
        $name = "장학금 기부 내역 등록";

        $data = array('name' => $name);
        $this->load->view('admin/donation_insert', $data);
    }

    public function donationInsertData()
    {
        $insert_data = [
            'name' => $this->input->post('name'),
            'phon' => $this->input->post('phon'),
            'school' => $this->input->post('school'),
            'family' => $this->input->post('family'),
            'memo' => $this->input->post('memo'),
            'give_money' => $this->input->post('give_money'),
        ];

        $json = $this->adminmodel->donationInsertData($insert_data);
        $this->json($json);
    }

    public function donationEdit($idx)
    {
        $this->nologin();
        $name = "장학금 기부 내역 수정";

        $json = $this->adminmodel->donationData($idx);
        $data = array('name' => $name, 'data' => $json);

        $this->load->view('admin/admin_header');
        $this->load->view('admin/donation_insert', $data);
    }

    public function donationUpdateData()
    {
        $update_data = [
            'name' => $this->input->post('name'),
            'phon' => $this->input->post('phon'),
            'school' => $this->input->post('school'),
            'family' => $this->input->post('family'),
            'memo' => $this->input->post('memo'),
            'give_money' => $this->input->post('give_money'),
        ];

        $idx = $this->input->post('idx');
        if (!$idx) {
            $this->json(['return' => false, 'err_msg' => 'idx값이 없습니다.']);
        }
        $json = $this->adminmodel->donationUpdateData($update_data, $idx);
        $this->json($json);
    }

    public function donationDel($idx)
    {
        $json = $this->adminmodel->donationDel($idx);
        $this->json($json);
    }

    public function donationCount()
    {
        $json = $this->adminmodel->donationCount();
        $this->json($json);
    }

    public function donationOrder()
    {
        $idxs = $_POST['idxs'];
        $idx = $_POST['idx'];


        if (!$idxs) {
            array('return' => false);
        }
        $json = $this->adminmodel->donationOrder($idxs, $idx);
        $this->json($json);
    }

    public function bursaryGoods($page = 1)
    {
        $this->nologin();
        $name = "물품기부명단";
        $insert = "/admin/goods-add";
        $url = URL . 'admin/bursary-goods';
        $col = ['번호', '정렬', '성명', '단체 및 모임명', '금액 및 물품', '등록 시간', '수정', '삭제'];
        $button = $this->adminButton($col);

        //이전 페이지 마지막 데이터
        if ($page > 1) {
            $temp = $this->adminmodel->bursaryGoodsList($page - 1);
            $pre_one = [end($temp['list'])];
        } else {
            $pre_one = [];
        }
        $json = $this->adminmodel->bursaryGoodsList($page);
        //다음 페이지 첫번째 데이터
        $next_one = $this->adminmodel->bursaryGoodsList($page + 1);

        $this->paging($json, $url);

        $data = array(
            'name' => $name,
            'col' => $col,
            'pre_one' => $pre_one,
            'list' => $json['list'],
            'next_one' => !empty($next_one['list']) ? [$next_one['list'][0]] : [],
            'adminbutton' => $button,
            'insert' => $insert,
            'page' => $page
        );

        $this->load->view('admin/admin_header');
        $this->load->view('admin/goods_list', $data);
    }

    public function goodsInsert()
    {
        $this->nologin();
        $this->load->view('admin/admin_header');
        $name = "물품기부명단 등록";

        $data = array('name' => $name);
        $this->load->view('admin/goods_insert', $data);
    }

    public function goodsInsertData()
    {
        $insert_data = [
            'name' => $this->input->post('name'),
            'associate' => $this->input->post('associate'),
            'give_money' => $this->input->post('give_money'),
        ];


        $json = $this->adminmodel->goodsInsertData($insert_data);
        $this->json($json);
    }

    public function goodsEdit($idx)
    {
        $this->nologin();
        $name = "물품기부명단 수정";

        $json = $this->adminmodel->bursaryGoodsData($idx);
        $data = array('name' => $name, 'data' => $json);

        $this->load->view('admin/admin_header');
        $this->load->view('admin/goods_insert', $data);
    }

    public function goodsUpdateData()
    {
        $update_data = [
            'name' => $this->input->post('name'),
            'associate' => $this->input->post('associate'),
            'give_money' => $this->input->post('give_money'),
        ];

        $idx = $this->input->post('idx');
        if (!$idx) {
            $this->json(['return' => false, 'err_msg' => 'idx값이 없습니다.']);
        }
        $json = $this->adminmodel->goodsUpdateData($update_data, $idx);
        $this->json($json);
    }

    public function bursaryGoodsDel($idx)
    {
        $json = $this->adminmodel->bursaryGoodsDel($idx);
        $this->json($json);
    }

    public function goodsCount()
    {
        $json = $this->adminmodel->goodsCount();
        $this->json($json);
    }

    public function goodsOrder()
    {
        $idxs = $_POST['idxs'];
        $idx = $_POST['idx'];


        if (!$idxs) {
            array('return' => false);
        }
        $json = $this->adminmodel->goodsOrder($idxs, $idx);
        $this->json($json);
    }

    public function notice($page = 1)
    {
        $this->nologin();
        $name = "공지사항 관리";
        $insert = "/admin/notice-add";
        $url = URL . 'admin/notice';
        $col = ['번호', '정렬', '제목', '조회수', '등록 시간', '수정', '삭제'];
        $button = $this->adminButton($col);

        //이전 페이지 마지막 데이터
        if ($page > 1) {
            $temp = $this->adminmodel->bbsNoticeList($page - 1);
            $pre_one = [end($temp['list'])];
        } else {
            $pre_one = [];
        }
        $json = $this->adminmodel->bbsNoticeList($page);
        //다음 페이지 첫번째 데이터
        $next_one = $this->adminmodel->bbsNoticeList($page + 1);

        $this->paging($json, $url);

        $data = array(
            'name' => $name,
            'col' => $col,
            'pre_one' => $pre_one,
            'list' => $json['list'],
            'next_one' => !empty($next_one['list']) ? [$next_one['list'][0]] : [],
            'adminbutton' => $button,
            'insert' => $insert,
            'page' => $page
        );

        $this->load->view('admin/admin_header');
        $this->load->view('admin/notice_list', $data);
    }


    public function noticeInsert()
    {
        $this->nologin();
        $this->load->view('admin/admin_header');
        $name = "공지사항 등록";

        $data = array('name' => $name);
        $this->load->view('admin/notice_insert', $data);
    }

    public function noticeInsertData()
    {

        $insert_data = [
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
        ];

        if (!empty($_FILES['up_file'])) {
            foreach ($_FILES['up_file']['tmp_name'] as $key => $val) {
                if ($val) {
                    $f_result = move_uploaded_file($val, 'assets/uploads/file/' . $_FILES['up_file']['name'][$key]);
                    if ($f_result) {
                        $num = $key + 1;
                        $insert_data['up_file' . $num] = $_FILES['up_file']['name'][$key];
                    }
                }
            }
        }

        $json = $this->adminmodel->noticeInsertData($insert_data);
        $this->json($json);
    }

    public function noticeEdit($idx)
    {
        $this->nologin();
        $name = "공지사항 수정";

        $json = $this->adminmodel->noticeData($idx);
        $data = array('name' => $name, 'data' => $json);

        $this->load->view('admin/admin_header');
        $this->load->view('admin/notice_insert', $data);
    }

    public function noticeUpdateData()
    {
        $update_data = [
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
        ];

        if (!empty($_POST['upfile_del'])) {
            foreach ($_POST['upfile_del'] as $delno) {
                $update_data['up_file' . $delno] = null;
            };
        }

        if (!empty($_FILES['up_file'])) {
            foreach ($_FILES['up_file']['tmp_name'] as $key => $val) {
                if ($val) {
                    $f_result = move_uploaded_file($val, 'assets/uploads/file/' . $_FILES['up_file']['name'][$key]);
                    if ($f_result) {
                        $num = $key + 1;
                        $update_data['up_file' . $num] = $_FILES['up_file']['name'][$key];
                    }
                }
            }
        }

        $idx = $this->input->post('idx');
        if (!$idx) {
            $this->json(['return' => false, 'err_msg' => 'idx값이 없습니다.']);
        }
        $json = $this->adminmodel->noticeUpdateData($update_data, $idx);
        $this->json($json);
    }

    public function noticeFiledel()
    {
        $idx = $this->input->post('idx');
        $no = $this->input->post('no');
        $key = 'up_file' . $no;
        $update_data = [
            'up_file' . $no => null,
        ];
        $json = $this->adminmodel->noticeUpdateData($update_data, $idx);
    }

    public function noticeCount()
    {
        $json = $this->adminmodel->noticeCount();
        $this->json($json);
    }

    public function noticeOrder()
    {
        $idxs = $_POST['idxs'];
        $idx = $_POST['idx'];


        if (!$idxs) {
            array('return' => false);
        }
        $json = $this->adminmodel->noticeOrder($idxs, $idx);
        $this->json($json);
    }

    public function noticeDel($idx)
    {
        $json = $this->adminmodel->noticeDel($idx);
        $this->json($json);
    }

    public function press($page = 1)
    {
        $this->nologin();
        $name = "언론보도 관리";
        $insert = "/admin/press-add";
        $url = URL . 'admin/press';
        $col = ['번호', '정렬', '썸네일', '제목', '조회수', '언론사', '등록 시간', '수정', '삭제'];
        $button = $this->adminButton($col);

        //이전 페이지 마지막 데이터
        if ($page > 1) {
            $temp = $this->adminmodel->bbsPressList($page - 1);
            $pre_one = [end($temp['list'])];
        } else {
            $pre_one = [];
        }
        $json = $this->adminmodel->bbsPressList($page);
        //다음 페이지 첫번째 데이터
        $next_one = $this->adminmodel->bbsPressList($page + 1);

        $this->paging($json, $url);

        $data = array(
            'name' => $name,
            'col' => $col,
            'pre_one' => $pre_one,
            'list' => $json['list'],
            'next_one' => !empty($next_one['list']) ? [$next_one['list'][0]] : [],
            'adminbutton' => $button,
            'insert' => $insert,
            'page' => $page
        );

        $this->load->view('admin/admin_header');
        $this->load->view('admin/press_list', $data);
    }

    public function pressInsert()
    {
        $this->nologin();
        $this->load->view('admin/admin_header');
        $name = "언론보도 등록";

        $data = array('name' => $name);
        $this->load->view('admin/press_insert', $data);
    }

    public function pressInsertData()
    {

        $insert_data = [
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'media_name' => $this->input->post('media_name'),
            'thumbnail' => $this->input->post('image'),
            'media_url' => $this->input->post('media_url'),
        ];


        $json = $this->adminmodel->pressInsertData($insert_data);
        $this->json($json);
    }

    public function pressEdit($idx)
    {
        $this->nologin();
        $name = "언론보도 수정";
        $json = $this->adminmodel->pressData($idx);

        $data = array('name' => $name, 'data' => $json);

        $this->load->view('admin/admin_header');
        $this->load->view('admin/press_insert', $data);
    }

    public function pressUpdateData()
    {
        $update_data = [
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'media_name' => $this->input->post('media_name'),
            'media_url' => $this->input->post('media_url'),
            'thumbnail' => $this->input->post('image'),

        ];

        $idx = $this->input->post('idx');
        if (!$idx) {
            $this->json(['return' => false, 'err_msg' => 'idx값이 없습니다.']);
        }
        $json = $this->adminmodel->pressUpdateData($update_data, $idx);
        $this->json($json);
    }

    public function pressCount()
    {
        $json = $this->adminmodel->pressCount();
        $this->json($json);
    }

    public function pressOrder()
    {
        $idxs = $_POST['idxs'];
        $idx = $_POST['idx'];


        if (!$idxs) {
            array('return' => false);
        }
        $json = $this->adminmodel->pressOrder($idxs, $idx);
        $this->json($json);
    }

    public function pressDel($idx)
    {
        $json = $this->adminmodel->pressDel($idx);
        $this->json($json);
    }

    public function gallery($page = 1)
    {
        $this->nologin();
        $name = "갤러리 관리";
        $insert = "/admin/gallery-add";
        $url = URL . 'admin/gallery';
        $col = ['번호', '정렬', '썸네일', '제목', '조회수', '등록 시간', '수정', '삭제'];
        $button = $this->adminButton($col);

        //이전 페이지 마지막 데이터
        if ($page > 1) {
            $temp = $this->adminmodel->bbsgalleryList($page - 1);
            $pre_one = [end($temp['list'])];
        } else {
            $pre_one = [];
        }
        $json = $this->adminmodel->bbsgalleryList($page);
        //다음 페이지 첫번째 데이터
        $next_one = $this->adminmodel->bbsgalleryList($page + 1);

        $this->paging($json, $url);

        $data = array(
            'name' => $name,
            'col' => $col,
            'pre_one' => $pre_one,
            'list' => $json['list'],
            'next_one' => !empty($next_one['list']) ? [$next_one['list'][0]] : [],
            'adminbutton' => $button,
            'insert' => $insert,
            'page' => $page
        );

        $this->load->view('admin/admin_header');
        $this->load->view('admin/gallery_list', $data);
    }

    public function galleryInsert()
    {
        $this->nologin();
        $this->load->view('admin/admin_header');
        $name = "갤러리 등록";

        $data = array('name' => $name);
        $this->load->view('admin/gallery_insert', $data);
    }

    public function galleryInsertData()
    {

        $insert_data = [
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'thumbnail' => $this->input->post('image'),
        ];


        $json = $this->adminmodel->galleryInsertData($insert_data);
        $this->json($json);
    }

    public function galleryEdit($idx)
    {
        $this->nologin();
        $name = "갤러리 수정";
        $json = $this->adminmodel->galleryData($idx);

        $data = array('name' => $name, 'data' => $json);

        $this->load->view('admin/admin_header');
        $this->load->view('admin/gallery_insert', $data);
    }

    public function galleryUpdateData()
    {
        $update_data = [
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'thumbnail' => $this->input->post('image'),
        ];

        $idx = $this->input->post('idx');
        if (!$idx) {
            $this->json(['return' => false, 'err_msg' => 'idx값이 없습니다.']);
        }
        $json = $this->adminmodel->galleryUpdateData($update_data, $idx);
        $this->json($json);
    }

    public function galleryCount()
    {
        $json = $this->adminmodel->galleryCount();
        $this->json($json);
    }

    public function galleryOrder()
    {
        $idxs = $_POST['idxs'];
        $idx = $_POST['idx'];


        if (!$idxs) {
            array('return' => false);
        }
        $json = $this->adminmodel->galleryOrder($idxs, $idx);
        $this->json($json);
    }

    public function galleryDel($idx)
    {
        $json = $this->adminmodel->galleryDel($idx);
        $this->json($json);
    }

    public function historyGiveList($page = 1)
    {
        $this->nologin();
        $name = "장학금 지급 내역";
        $insert = "/admin/history-giveadd";
        $url = URL . 'admin/history-give';
        $col = ['번호', '정렬', '년도', '장학금 지급 내역', '장학금', '등록 시간', '수정', '삭제'];
        $button = $this->adminButton($col);

        //이전 페이지 마지막 데이터
        if ($page > 1) {
            $temp = $this->adminmodel->historyGiveList($page - 1);
            $pre_one = [end($temp['list'])];
        } else {
            $pre_one = [];
        }
        $json = $this->adminmodel->historyGiveList($page);
        //다음 페이지 첫번째 데이터
        $next_one = $this->adminmodel->historyGiveList($page + 1);


        $this->paging($json, $url);
        $data = array(
            'name' => $name,
            'col' => $col,
            'pre_one' => $pre_one,
            'list' => $json['list'],
            'next_one' => !empty($next_one['list']) ? [$next_one['list'][0]] : [],
            'adminbutton' => $button,
            'insert' => $insert,
            'page' => $page
        );

        $this->load->view('admin/admin_header');
        $this->load->view('admin/history_give_list', $data);
    }

    public function historyGiveInsert()
    {
        $this->nologin();
        $this->load->view('admin/admin_header');
        $name = "장학금 지급 내역 등록";

        $data = array('name' => $name);
        $this->load->view('admin/history_give_insert', $data);
    }

    public function historyGiveInsertData()
    {
        $year = $this->input->post('year');
        $memo = $this->input->post('memo');
        $bur_val = $this->input->post('bur_val');

        $insert_data = [
            'year' => $year,
            'memo' => $memo,
            'bur_val' => $bur_val,
        ];

        $json = $this->adminmodel->historyGiveInsertData($insert_data);
        $this->json($json);
    }

    public function historyGiveUpdate($idx)
    {
        $this->nologin();
        $name = "장학금 지급 내역 수정";

        $json = $this->adminmodel->historyGiveData($idx);
        $data = array('name' => $name, 'data' => $json);

        $this->load->view('admin/admin_header');
        $this->load->view('admin/history_give_insert', $data);
    }

    public function historyGiveUpdateData()
    {
        $year = $this->input->post('year');
        $memo = $this->input->post('memo');
        $bur_val = $this->input->post('bur_val');
        $idx = $this->input->post('idx');

        $update_data = [
            'year' => $year,
            'memo' => $memo,
            'bur_val' => $bur_val,
        ];

        $json = $this->adminmodel->historyGiveUpdateData($update_data, $idx);
        $this->json($json);
    }

    public function historyGiveIdxsUpdate()
    {
        $idxs = $_POST['idxs'];
        $idx = $_POST['idx'];


        if (!$idxs) {
            array('return' => false);
        }
        $json = $this->adminmodel->historyGiveIdxsUpdate($idxs, $idx);
        $this->json($json);
    }

    public function historyGiveCount()
    {
        $json = $this->adminmodel->historyGiveCount();
        $this->json($json);
    }

    public function historyGiveDelete($idx)
    {
        $json = $this->adminmodel->historyGiveDelete($idx);
        $this->json($json);
    }


    public function historySupportList($page = 1)
    {
        $this->nologin();
        $name = "물품 지원 내역";
        $insert = "/admin/history-supportadd";
        $url = URL . 'admin/history-support';
        $col = ['번호', '정렬', '년도', '물품 지원 내역', '세대', '쌀', '금액', '등록 시간', '수정', '삭제'];
        $button = $this->adminButton($col);

        //이전 페이지 마지막 데이터
        if ($page > 1) {
            $temp = $this->adminmodel->historySupportList($page - 1);
            $pre_one = [end($temp['list'])];
        } else {
            $pre_one = [];
        }
        $json = $this->adminmodel->historySupportList($page);
        //다음 페이지 첫번째 데이터
        $next_one = $this->adminmodel->historySupportList($page + 1);

        $this->paging($json, $url);

        $data = array(
            'name' => $name,
            'col' => $col,
            'pre_one' => $pre_one,
            'list' => $json['list'],
            'next_one' => !empty($next_one['list']) ? [$next_one['list'][0]] : [],
            'adminbutton' => $button,
            'insert' => $insert,
            'page' => $page
        );


        $this->load->view('admin/admin_header');
        $this->load->view('admin/history_support_list', $data);
    }

    public function historySupportInsert()
    {
        $this->nologin();
        $this->load->view('admin/admin_header');
        $name = "물품 지원 내역 등록";

        $data = array('name' => $name);
        $this->load->view('admin/history_support_insert', $data);
    }

    public function historySupportInsertData()
    {
        $year = $this->input->post('year');
        $memo = $this->input->post('memo');
        $bur_val = $this->input->post('bur_val');

        $insert_data = [
            'year' => $year,
            'memo' => $memo,
            'bur_val' => $bur_val,
            'household' => $this->input->post('household'),
            'rice' => $this->input->post('rice')
        ];

        $json = $this->adminmodel->historySupportInsertData($insert_data);
        $this->json($json);
    }

    public function historySupportUpdate($idx)
    {
        $this->nologin();
        $name = "물품 지원 내역 수정";

        $json = $this->adminmodel->historySupportData($idx);
        $data = array('name' => $name, 'data' => $json);

        $this->load->view('admin/admin_header');
        $this->load->view('admin/history_support_insert', $data);
    }

    public function historySupportUpdateData()
    {
        $year = $this->input->post('year');
        $memo = $this->input->post('memo');
        $bur_val = $this->input->post('bur_val');
        $idx = $this->input->post('idx');

        $update_data = [
            'year' => $year,
            'memo' => $memo,
            'bur_val' => $bur_val,
            'household' => $this->input->post('household'),
            'rice' => $this->input->post('rice')
        ];

        $json = $this->adminmodel->historySupportUpdateData($update_data, $idx);
        $this->json($json);
    }

    public function historySupportIdxsUpdate()
    {
        $idxs = $_POST['idxs'];
        $idx = $_POST['idx'];


        if (!$idxs) {
            array('return' => false);
        }
        $json = $this->adminmodel->historySupportIdxsUpdate($idxs, $idx);
        $this->json($json);
    }

    public function historySupportCount()
    {
        $json = $this->adminmodel->historySupportCount();
        $this->json($json);
    }

    public function historySupportDelete($idx)
    {
        $json = $this->adminmodel->historySupportDelete($idx);
        $this->json($json);
    }


    public function historyContributionList($page = 1)
    {
        $this->nologin();
        $name = "성금 지원 내역";
        $insert = "/admin/history-contributionadd";
        $url = URL . 'admin/history-contribution';
        $col = ['번호', '정렬', '년도', '성금 지급 내역', '성금', '등록 시간', '수정', '삭제'];
        $button = $this->adminButton($col);

        //이전 페이지 마지막 데이터
        if ($page > 1) {
            $temp = $this->adminmodel->historyContributionList($page - 1);
            $pre_one = [end($temp['list'])];
        } else {
            $pre_one = [];
        }
        $json = $this->adminmodel->historyContributionList($page);
        //다음 페이지 첫번째 데이터
        $next_one = $this->adminmodel->historyContributionList($page + 1);

        $this->paging($json, $url);

        $data = array(
            'name' => $name,
            'col' => $col,
            'pre_one' => $pre_one,
            'list' => $json['list'],
            'next_one' => !empty($next_one['list']) ? [$next_one['list'][0]] : [],
            'adminbutton' => $button,
            'insert' => $insert,
            'page' => $page
        );

        $this->load->view('admin/admin_header');
        $this->load->view('admin/history_contribution_list', $data);
    }

    public function historyContributionInsert()
    {
        $this->nologin();
        $this->load->view('admin/admin_header');
        $name = "성금 지급 내역 등록";

        $data = array('name' => $name);
        $this->load->view('admin/history_contribution_insert', $data);
    }

    public function historyContributionInsertData()
    {
        $year = $this->input->post('year');
        $memo = $this->input->post('memo');
        $bur_val = $this->input->post('bur_val');

        $insert_data = [
            'year' => $year,
            'memo' => $memo,
            'bur_val' => $bur_val,
        ];

        $json = $this->adminmodel->historyContributionInsertData($insert_data);
        $this->json($json);
    }

    public function historyContributionUpdate($idx)
    {
        $this->nologin();
        $name = "성금 지급 내역 수정";

        $json = $this->adminmodel->historyContributionData($idx);
        $data = array('name' => $name, 'data' => $json);

        $this->load->view('admin/admin_header');
        $this->load->view('admin/history_contribution_insert', $data);
    }

    public function historyContributionUpdateData()
    {
        $year = $this->input->post('year');
        $memo = $this->input->post('memo');
        $bur_val = $this->input->post('bur_val');
        $idx = $this->input->post('idx');

        $update_data = [
            'year' => $year,
            'memo' => $memo,
            'bur_val' => $bur_val,
        ];

        $json = $this->adminmodel->historyContributionUpdateData($update_data, $idx);
        $this->json($json);
    }

    public function historyContributionIdxsUpdate()
    {
        $idxs = $_POST['idxs'];
        $idx = $_POST['idx'];


        if (!$idxs) {
            array('return' => false);
        }
        $json = $this->adminmodel->historyContributionIdxsUpdate($idxs, $idx);
        $this->json($json);
    }

    public function historyContributionCount()
    {
        $json = $this->adminmodel->historyContributionCount();
        $this->json($json);
    }

    public function historyContributionDelete($idx)
    {
        $json = $this->adminmodel->historyContributionDelete($idx);
        $this->json($json);
    }

    public function historyDonateList($page = 1)
    {
        $this->nologin();
        $name = "기부 내역";
        $insert = "/admin/history-donateadd";
        $url = URL . 'admin/history-donate';
        $col = ['번호', '정렬', '종류', '기부 내역', '기부금', '등록 시간', '수정', '삭제'];
        $button = $this->adminButton($col);
        //이전 페이지 마지막 데이터
        if ($page > 1) {
            $temp = $this->adminmodel->historyDonateList($page - 1);
            $pre_one = [end($temp['list'])];
        } else {
            $pre_one = [];
        }
        $json = $this->adminmodel->historyDonateList($page);
        //다음 페이지 첫번째 데이터
        $next_one = $this->adminmodel->historyDonateList($page + 1);

        $this->paging($json, $url);

        $data = array(
            'name' => $name,
            'col' => $col,
            'pre_one' => $pre_one,
            'list' => $json['list'],
            'next_one' => !empty($next_one['list']) ? [$next_one['list'][0]] : [],
            'adminbutton' => $button,
            'insert' => $insert,
            'page' => $page
        );


        $this->load->view('admin/admin_header');
        $this->load->view('admin/history_donate_list', $data);
    }

    public function historyDonateInsert()
    {
        $this->nologin();
        $this->load->view('admin/admin_header');
        $name = "기부 내역 등록";

        $data = array(
            'name' => $name,
            'select1' => $this->arr_select1,
        );

        $this->load->view('admin/history_donate_insert', $data);
    }

    public function historyDonateInsertData()
    {
        $kind = $this->input->post('kind');
        $memo = $this->input->post('memo');
        $bur_val = $this->input->post('bur_val');

        $insert_data = [
            'kind' => $kind,
            'memo' => $memo,
            'bur_val' => $bur_val,
        ];

        $json = $this->adminmodel->historyDonateInsertData($insert_data);
        $this->json($json);
    }

    public function historyDonateUpdate($idx)
    {
        $this->nologin();
        $name = "기부 내역 수정";

        $json = $this->adminmodel->historyDonateData($idx);
        $data = array('name' => $name, 'data' => $json);
        $data['select1'] = $this->arr_select1;
        $this->load->view('admin/admin_header');
        $this->load->view('admin/history_donate_insert', $data);
    }

    public function historyDonateUpdateData()
    {
        $kind = $this->input->post('kind');
        $memo = $this->input->post('memo');
        $bur_val = $this->input->post('bur_val');
        $idx = $this->input->post('idx');

        $update_data = [
            'kind' => $kind,
            'memo' => $memo,
            'bur_val' => $bur_val,
        ];

        $json = $this->adminmodel->historyDonateUpdateData($update_data, $idx);
        $this->json($json);
    }

    public function historyDonateIdxsUpdate()
    {
        $idxs = $_POST['idxs'];
        $idx = $_POST['idx'];


        if (!$idxs) {
            array('return' => false);
        }
        $json = $this->adminmodel->historyDonateIdxsUpdate($idxs, $idx);
        $this->json($json);
    }

    public function historyDonateCount()
    {
        $json = $this->adminmodel->historyDonateCount();
        $this->json($json);
    }

    public function historyDonateDelete($idx)
    {
        $json = $this->adminmodel->historyDonateDelete($idx);
        $this->json($json);
    }

    public function historyCollaboList($page = 1)
    {
        $this->nologin();
        $name = "협력 법인";
        $insert = "/admin/history-collaboadd";
        $url = URL . 'admin/history-collabo';
        $col = ['번호', '정렬', '협력법인', '등록 시간', '수정', '삭제'];
        $button = $this->adminButton($col);

        //이전 페이지 마지막 데이터
        if ($page > 1) {
            $temp = $this->adminmodel->historyCollaboList($page - 1);
            $pre_one = [end($temp['list'])];
        } else {
            $pre_one = [];
        }
        $json = $this->adminmodel->historyCollaboList($page);
        //다음 페이지 첫번째 데이터
        $next_one = $this->adminmodel->historyCollaboList($page + 1);

        $this->paging($json, $url);

        $data = array(
            'name' => $name,
            'col' => $col,
            'pre_one' => $pre_one,
            'list' => $json['list'],
            'next_one' => !empty($next_one['list']) ? [$next_one['list'][0]] : [],
            'adminbutton' => $button,
            'insert' => $insert,
            'page' => $page
        );

        $this->load->view('admin/admin_header');
        $this->load->view('admin/history_collabo_list', $data);
    }

    public function historyCollaboInsert()
    {
        $this->nologin();
        $this->load->view('admin/admin_header');
        $name = "협력 법인 등록";

        $data = array('name' => $name);
        $this->load->view('admin/history_collabo_insert', $data);
    }

    public function historyCollaboInsertData()
    {
        $memo = $this->input->post('memo');

        $insert_data = [
            'memo' => $memo,
        ];

        $json = $this->adminmodel->historyCollaboInsertData($insert_data);
        $this->json($json);
    }

    public function historyCollaboUpdate($idx)
    {
        $this->nologin();
        $name = "협력 법인 수정";

        $json = $this->adminmodel->historyCollaboData($idx);
        $data = array('name' => $name, 'data' => $json);

        $this->load->view('admin/admin_header');
        $this->load->view('admin/history_collabo_insert', $data);
    }

    public function historyCollaboUpdateData()
    {
        $memo = $this->input->post('memo');
        $idx = $this->input->post('idx');

        $update_data = [
            'memo' => $memo,
        ];

        $json = $this->adminmodel->historyCollaboUpdateData($update_data, $idx);
        $this->json($json);
    }

    public function historyCollaboIdxsUpdate()
    {
        $idxs = $_POST['idxs'];
        $idx = $_POST['idx'];


        if (!$idxs) {
            array('return' => false);
        }
        $json = $this->adminmodel->historyCollaboIdxsUpdate($idxs, $idx);
        $this->json($json);
    }

    public function historyCollaboCount()
    {
        $json = $this->adminmodel->historyCollaboCount();
        $this->json($json);
    }

    public function historyCollaboDelete($idx)
    {
        $json = $this->adminmodel->historyCollaboDelete($idx);
        $this->json($json);
    }

    public function bursaryOneper($page = 1)
    {
        $this->nologin();
        $name = "1% 기부자 명단";
        $insert = "/admin/oneper-add";
        $url = URL . 'admin/bursary-oneper';
        $col = ['번호', '정렬', '성명', '금액', '비고', '등록 시간', '수정', '삭제'];
        $button = $this->adminButton($col);

        //이전 페이지 마지막 데이터
        if ($page > 1) {
            $temp = $this->adminmodel->bursaryOneperList($page - 1);
            $pre_one = [end($temp['list'])];
        } else {
            $pre_one = [];
        }
        $json = $this->adminmodel->bursaryOneperList($page);
        //다음 페이지 첫번째 데이터
        $next_one = $this->adminmodel->bursaryOneperList($page + 1);

        $this->paging($json, $url);

        $data = array(
            'name' => $name,
            'col' => $col,
            'pre_one' => $pre_one,
            'list' => $json['list'],
            'next_one' => !empty($next_one['list']) ? [$next_one['list'][0]] : [],
            'adminbutton' => $button,
            'insert' => $insert,
            'page' => $page
        );

        $this->load->view('admin/admin_header');
        $this->load->view('admin/oneper_list', $data);
    }

    public function oneperInsert()
    {
        $this->nologin();
        $this->load->view('admin/admin_header');
        $name = "1% 기부자 명단 등록";

        $data = array('name' => $name);
        $this->load->view('admin/oneper_insert', $data);
    }

    public function oneperInsertData()
    {
        $insert_data = [
            'name' => $this->input->post('name'),
            'memo' => $this->input->post('memo'),
            'give_money' => $this->input->post('give_money'),
        ];


        $json = $this->adminmodel->oneperInsertData($insert_data);
        $this->json($json);
    }

    public function oneperEdit($idx)
    {
        $this->nologin();
        $name = "1% 기부자 명단 수정";

        $json = $this->adminmodel->bursaryOneperData($idx);
        $data = array('name' => $name, 'data' => $json);

        $this->load->view('admin/admin_header');
        $this->load->view('admin/oneper_insert', $data);
    }

    public function oneperUpdateData()
    {
        $update_data = [
            'name' => $this->input->post('name'),
            'memo' => $this->input->post('memo'),
            'give_money' => $this->input->post('give_money'),
        ];

        $idx = $this->input->post('idx');
        if (!$idx) {
            $this->json(['return' => false, 'err_msg' => 'idx값이 없습니다.']);
        }
        $json = $this->adminmodel->oneperUpdateData($update_data, $idx);
        $this->json($json);
    }

    public function bursaryOneperDel($idx)
    {
        $json = $this->adminmodel->bursaryOneperDel($idx);
        $this->json($json);
    }

    public function oneperCount()
    {
        $json = $this->adminmodel->oneperCount();
        $this->json($json);
    }

    public function oneperOrder()
    {
        $idxs = $_POST['idxs'];
        $idx = $_POST['idx'];


        if (!$idxs) {
            array('return' => false);
        }
        $json = $this->adminmodel->oneperOrder($idxs, $idx);
        $this->json($json);
    }

    public function bursaryRoll($page = 1)
    {
        $this->nologin();
        $name = "물품기부명단";
        $insert = "/admin/roll-add";
        $url = URL . 'admin/bursary-roll';
        $col = ['번호', '정렬', '성명', '금액', '비고', '등록 시간', '수정', '삭제'];
        $button = $this->adminButton($col);

        //이전 페이지 마지막 데이터
        if ($page > 1) {
            $temp = $this->adminmodel->bursaryRollList($page - 1);
            $pre_one = [end($temp['list'])];
        } else {
            $pre_one = [];
        }
        $json = $this->adminmodel->bursaryRollList($page);
        //다음 페이지 첫번째 데이터
        $next_one = $this->adminmodel->bursaryRollList($page + 1);

        $this->paging($json, $url);

        $data = array(
            'name' => $name,
            'col' => $col,
            'pre_one' => $pre_one,
            'list' => $json['list'],
            'next_one' => !empty($next_one['list']) ? [$next_one['list'][0]] : [],
            'adminbutton' => $button,
            'insert' => $insert,
            'page' => $page
        );

        $this->load->view('admin/admin_header');
        $this->load->view('admin/roll_list', $data);
    }

    public function rollInsert()
    {
        $this->nologin();
        $this->load->view('admin/admin_header');
        $name = "물품기부명단 등록";

        $data = array('name' => $name);
        $this->load->view('admin/roll_insert', $data);
    }

    public function rollInsertData()
    {
        $insert_data = [
            'name' => $this->input->post('name'),
            'memo' => $this->input->post('memo'),
            'give_money' => $this->input->post('give_money'),
        ];


        $json = $this->adminmodel->rollInsertData($insert_data);
        $this->json($json);
    }

    public function rollEdit($idx)
    {
        $this->nologin();
        $name = "물품기부명단 수정";

        $json = $this->adminmodel->bursaryRollData($idx);
        $data = array('name' => $name, 'data' => $json);

        $this->load->view('admin/admin_header');
        $this->load->view('admin/roll_insert', $data);
    }

    public function rollUpdateData()
    {
        $update_data = [
            'name' => $this->input->post('name'),
            'memo' => $this->input->post('memo'),
            'give_money' => $this->input->post('give_money'),
        ];

        $idx = $this->input->post('idx');
        if (!$idx) {
            $this->json(['return' => false, 'err_msg' => 'idx값이 없습니다.']);
        }
        $json = $this->adminmodel->rollUpdateData($update_data, $idx);
        $this->json($json);
    }

    public function bursaryRollDel($idx)
    {
        $json = $this->adminmodel->bursaryRollDel($idx);
        $this->json($json);
    }

    public function rollCount()
    {
        $json = $this->adminmodel->rollCount();
        $this->json($json);
    }

    public function rollOrder()
    {
        $idxs = $_POST['idxs'];
        $idx = $_POST['idx'];


        if (!$idxs) {
            array('return' => false);
        }
        $json = $this->adminmodel->rollOrder($idxs, $idx);
        $this->json($json);
    }

    public function bursaryCms($page = 1)
    {
        $this->nologin();
        $name = "물품기부명단";
        $insert = "/admin/cms-add";
        $url = URL . 'admin/bursary-cms';
        $col = ['성명', '총 인원', '금액', '등록 시간', '수정', '삭제'];
        $button = $this->adminButton($col);

        //이전 페이지 마지막 데이터
        if ($page > 1) {
            $temp = $this->adminmodel->bursaryCmsList($page - 1);
            $pre_one = [end($temp['list'])];
        } else {
            $pre_one = [];
        }
        $json = $this->adminmodel->bursaryCmsList($page);
        //다음 페이지 첫번째 데이터
        $next_one = $this->adminmodel->bursaryCmsList($page + 1);

        $this->paging($json, $url);

        $data = array(
            'name' => $name,
            'col' => $col,
            'pre_one' => $pre_one,
            'list' => $json['list'],
            'next_one' => !empty($next_one['list']) ? [$next_one['list'][0]] : [],
            'adminbutton' => $button,
            'insert' => $insert,
            'page' => $page
        );

        $this->load->view('admin/admin_header');
        $this->load->view('admin/cms_list', $data);
    }

    public function cmsInsert()
    {
        $this->nologin();
        $this->load->view('admin/admin_header');
        $name = "물품기부명단 등록";

        $data = array('name' => $name);
        $this->load->view('admin/cms_insert', $data);
    }

    public function cmsInsertData()
    {
        $insert_data = [
            'name' => $this->input->post('name'),
            'associate' => $this->input->post('associate'),
            'give_money' => $this->input->post('give_money'),
        ];


        $json = $this->adminmodel->cmsInsertData($insert_data);
        $this->json($json);
    }

    public function cmsEdit($idx)
    {
        $this->nologin();
        $name = "물품기부명단 수정";

        $json = $this->adminmodel->bursaryCmsData($idx);
        $data = array('name' => $name, 'data' => $json);

        $this->load->view('admin/admin_header');
        $this->load->view('admin/cms_insert', $data);
    }

    public function cmsUpdateData()
    {
        $update_data = [
            'name' => $this->input->post('name'),
            'associate' => $this->input->post('associate'),
            'give_money' => $this->input->post('give_money'),
        ];

        $idx = $this->input->post('idx');
        if (!$idx) {
            $this->json(['return' => false, 'err_msg' => 'idx값이 없습니다.']);
        }
        $json = $this->adminmodel->cmsUpdateData($update_data, $idx);
        $this->json($json);
    }

    public function bursaryCmsDel($idx)
    {
        $json = $this->adminmodel->bursaryCmsDel($idx);
        $this->json($json);
    }

    public function cmsCount()
    {
        $json = $this->adminmodel->cmsCount();
        $this->json($json);
    }

    public function cmsOrder()
    {
        $idxs = $_POST['idxs'];
        $idx = $_POST['idx'];


        if (!$idxs) {
            array('return' => false);
        }
        $json = $this->adminmodel->cmsOrder($idxs, $idx);
        $this->json($json);
    }
}
