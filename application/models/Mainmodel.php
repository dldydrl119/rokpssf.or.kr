<?php
class mainmodel extends CI_Model {
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function slideListDataAll() {
        $sql="SELECT *
                FROM slide_menu
                ORDER BY slide_idxs DESC limit 5";
        $result = $this->db->query($sql)->result();

        return $result;
    }
    public function reportData() {
        $sql="SELECT * from report_table ORDER BY idxs DESC";
        $result = $this->db->query($sql)->result();
        return $result;
    }

    public function bursaryGiveDataAll() {
        $sql="SELECT * from bursary_give_menu ORDER BY idxs DESC";
        $result = $this->db->query($sql)->result();
        return $result;
    }

    public function bursaryGiveDataTotalNum() {
        $sql="SELECT count(*) cnt from bursary_give_menu ORDER BY idxs DESC";
        $result = $this->db->query($sql)->result();

        return $result[0]->cnt;
    }

    public function bursaryGiveData($limit, $start) {

        $slimit = ($start-1)*$limit;
        $sql="SELECT * from bursary_give_menu ORDER BY idxs DESC LIMIT {$slimit}, $limit";
        $result = $this->db->query($sql)->result();

        return $result;
    }

    public function donationDataTotalNum() {
        $sql="SELECT count(*) cnt from bursary_donation_menu ORDER BY idxs DESC";
        $result = $this->db->query($sql)->result();

        return $result[0]->cnt;
    }

    public function donationData($limit, $start) {

        $slimit = ($start-1)*$limit;
        $sql="SELECT * from bursary_donation_menu ORDER BY idxs DESC LIMIT {$slimit}, $limit";
        $result = $this->db->query($sql)->result();

        return $result;
    }

    public function goodsDataTotalNum() {
        $sql="SELECT count(*) cnt from bursary_goods_menu ORDER BY idxs DESC";
        $result = $this->db->query($sql)->result();

        return $result[0]->cnt;
    }

    public function goodsData($limit, $start) {

        $slimit = ($start-1)*$limit;
        $sql="SELECT * from bursary_goods_menu ORDER BY idxs DESC LIMIT {$slimit}, $limit";
        $result = $this->db->query($sql)->result();

        return $result;
    }

    public function bursaryGoodsAll() {
        $sql="SELECT * from bursary_goods_menu ORDER BY idxs DESC";
        $result = $this->db->query($sql)->result();

        return $result;
    }

    public function galleryAll() {
        $sql="SELECT * from bbs_gallery ORDER BY idxs DESC";
        $result = $this->db->query($sql)->result();

        return $result;
    }

    public function noticeAll() {
        $sql="SELECT * from bbs_notice ORDER BY idxs DESC";
        $result = $this->db->query($sql)->result();

        return $result;
    }

    public function pressAll() {
        $sql="SELECT * from bbs_press ORDER BY idxs DESC";
        $result = $this->db->query($sql)->result();

        return $result;
    }

    public function noticeData($limit, $start, $search_kind=null, $search_txt=null) {
        $search_where = '';
        if(!$search_kind || !$search_txt) {
            $search_where = '';
        }elseif($search_kind == 'all') {
            $search_where = " where (title like '%{$search_txt}%' or  content like '%{$search_txt}%')";
        } else {
            $search_where = " where {$search_kind} like '%{$search_txt}%' ";
        }
        $slimit = ($start-1)*$limit;
        $sql="SELECT * from bbs_notice {$search_where} ORDER BY idxs DESC LIMIT {$slimit}, $limit";
        $result = $this->db->query($sql)->result();

        return $result;
    }

    public function noticeTotalNum($search_kind=null, $search_txt=null) {
        $search_where = '';
        if(!$search_kind || !$search_txt) {
            $search_where = '';
        }elseif($search_kind == 'all') {
            $search_where = " where (title like '%{$search_txt}%' or  content like '%{$search_txt}%')";
        } else {
            $search_where = " where {$search_kind} like '%{$search_txt}%' ";
        }
        $sql="SELECT count(*) cnt from bbs_notice {$search_where} ORDER BY idxs DESC";
        $result = $this->db->query($sql)->result();

        return $result[0]->cnt;
    }

    public function pressData($limit, $start, $search_kind=null, $search_txt=null) {
        $search_where = '';
        if(!$search_kind || !$search_txt) {
            $search_where = '';
        }elseif($search_kind == 'all') {
            $search_where = " where (title like '%{$search_txt}%' or  content like '%{$search_txt}%')";
        } else {
            $search_where = " where {$search_kind} like '%{$search_txt}%' ";
        }
        $slimit = ($start-1)*$limit;
        $sql="SELECT * from bbs_press {$search_where} ORDER BY idxs DESC LIMIT {$slimit}, $limit";
        $result = $this->db->query($sql)->result();

        return $result;
    }

    public function pressTotalNum($search_kind=null, $search_txt=null) {
        $search_where = '';
        if(!$search_kind || !$search_txt) {
            $search_where = '';
        }elseif($search_kind == 'all') {
            $search_where = " where (title like '%{$search_txt}%' or  content like '%{$search_txt}%')";
        } else {
            $search_where = " where {$search_kind} like '%{$search_txt}%' ";
        }
        $sql="SELECT count(*) cnt from bbs_press {$search_where} ORDER BY idxs DESC";
        $result = $this->db->query($sql)->result();

        return $result[0]->cnt;
    }

    public function galleryData($limit, $start, $search_kind=null, $search_txt=null) {
        $search_where = '';
        if(!$search_kind || !$search_txt) {
            $search_where = '';
        }elseif($search_kind == 'all') {
            $search_where = " where (title like '%{$search_txt}%' or  content like '%{$search_txt}%')";
        } else {
            $search_where = " where {$search_kind} like '%{$search_txt}%' ";
        }
        $slimit = ($start-1)*$limit;
        $sql="SELECT * from bbs_gallery {$search_where} ORDER BY idxs DESC LIMIT {$slimit}, $limit";
        $result = $this->db->query($sql)->result();

        return $result;
    }

    public function galleryTotalNum($search_kind=null, $search_txt=null) {
        $search_where = '';
        if(!$search_kind || !$search_txt) {
            $search_where = '';
        }elseif($search_kind == 'all') {
            $search_where = " where (title like '%{$search_txt}%' or  content like '%{$search_txt}%')";
        } else {
            $search_where = " where {$search_kind} like '%{$search_txt}%' ";
        }
        $sql="SELECT count(*) cnt from bbs_gallery {$search_where} ORDER BY idxs DESC";
        $result = $this->db->query($sql)->result();

        return $result[0]->cnt;
    }

    public function historyMenuAll() {
        $sql="SELECT * from history_menu ORDER BY idxs DESC";
        return $this->db->query($sql)->result();
    }

    public function historyGiveAll() {
        $sql="SELECT * from history_give ORDER BY idxs DESC";
        return $this->db->query($sql)->result();
    }

    public function historySupportAll() {
        $sql="SELECT * from history_support ORDER BY idxs DESC";
        return $this->db->query($sql)->result();
    }

    public function historyContributionAll() {
        $sql="SELECT * from history_contribution ORDER BY idxs DESC";
        return $this->db->query($sql)->result();
    }

    public function historyDonateAll() {
        $sql="SELECT * from history_donate ORDER BY idxs DESC";
        return $this->db->query($sql)->result();
    }

    public function historyCollaboAll() {
        $sql="SELECT * from history_collabo ORDER BY idxs DESC";
        return $this->db->query($sql)->result();
    }

    public function bursaryOneperDataTotalNum() {
        $sql="SELECT count(*) cnt from bursary_oneper_menu ORDER BY idxs DESC";
        $result = $this->db->query($sql)->result();

        return $result[0]->cnt;
    }

    public function bursaryOneperData($limit, $start) {

        $slimit = ($start-1)*$limit;
        $sql="SELECT * from bursary_oneper_menu ORDER BY idxs DESC LIMIT {$slimit}, $limit";
        $result = $this->db->query($sql)->result();

        return $result;
    }

    public function bursaryRollDataTotalNum() {
        $sql="SELECT count(*) cnt from bursary_roll_menu ORDER BY idxs DESC";
        $result = $this->db->query($sql)->result();

        return $result[0]->cnt;
    }

    public function bursaryRollData($limit, $start) {

        $slimit = ($start-1)*$limit;
        $sql="SELECT * from bursary_roll_menu ORDER BY idxs DESC LIMIT {$slimit}, $limit";
        $result = $this->db->query($sql)->result();

        return $result;
    }

    public function bursaryCmsDataTotalNum() {
        $sql="SELECT count(*) cnt from bursary_cms_menu ORDER BY idxs DESC";
        $result = $this->db->query($sql)->result();

        return $result[0]->cnt;
    }

    public function bursaryCmsData($limit, $start) {

        $slimit = ($start-1)*$limit;
        $sql="SELECT * from bursary_cms_menu ORDER BY idxs DESC LIMIT {$slimit}, $limit";
        $result = $this->db->query($sql)->result();

        return $result;
    }
}
