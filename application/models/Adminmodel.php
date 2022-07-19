<?php
class adminmodel extends CI_Model {
    function __construct(){
        parent::__construct();
//        $this->load->library('session');
        $this->load->database();
    }
    // 로그인
    public function insert_login() {
        // $_POST['id'] = 'callget';
        // $_POST['pass'] = 'admin';
        foreach($_POST as $key => $value ){
            $key = 'admin_'.$key;
            if($key == "admin_pass") {
                $value = password_hash($value , PASSWORD_DEFAULT, ['cost'=>12]);
            }
            $array[$key] = $value;
        }
        $result = $this->db->insert('callget_admin', $array);
        return array('return'=>$result);
    }

    public function loginData() {
        // $_POST['id'] = 'callget';
        // $_POST['pass'] = 'admin';
        $sql="SELECT admin_idx, admin_id, admin_pass FROM admin_user WHERE admin_id = ?";
        $array = array($_POST['id']);
        $data = $this->db->query($sql, $array)->row();

        if (password_verify($_POST['pass'] ,$data->admin_pass) ) {
            $_SESSION['id'] = $_POST['id'];
            $_SESSION['idx'] = $data->admin_idx;
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }
//slide -----------------------------------------------------------------
    public function slideListData($page = 1) {
        $table = "slide_menu";
        $limit=10;
        $offset=$limit*($page-1);
        $sql="SELECT slide_idx, @rownum:=@rownum+1 num, slide_name, slide_image, slide_link, slide_date
                FROM slide_menu, (SELECT @rownum:={$offset}) TMP
                ORDER BY slide_idxs DESC
              limit {$limit} offset {$offset}";
        $result = $this->db->query($sql)->result();

        $sql="SELECT COUNT(*) count FROM $table";
        $count = $this->db->query($sql)->row();

        return array('return'=>true,'list'=>$result,'count'=>$count->count);
    }

    public function slideTotalNum() {

        $sql = "select count(*) count From slide_menu ";
        $count = $this->db->query($sql)->row();

        return $count->count;
    }

    public function slideinsertData() {
        $table = "slide_menu";

        $sql="SELECT slide_idxs FROM $table order by slide_idxs DESC LIMIT 1";
        $slide_idxs = $this->db->query($sql)->row()->slide_idxs + 1;
        foreach($_POST as $key => $value ){
            $key = 'slide_'.$key;
            $array[$key] = $value;
        }
        $array['slide_date'] = date('Y-m-d H:i:s');
        $array['slide_idxs'] = $slide_idxs;
        $result = $this->db->insert($table, $array);
        return array('return'=>$result);
    }

    public function slideData($idx) {
        $array = array($idx);
        $sql="SELECT slide_idx, slide_name, slide_image, slide_link
            FROM slide_menu WHERE slide_idx = ?";
        return $this->db->query($sql, $array)->row();
    }

    public function slideUpdate() {
        $array = array($_POST['name'], $_POST['image'], $_POST['link'], $_POST['idx']);
        $sql= "UPDATE slide_menu SET slide_name = ?, slide_image = ?,
                slide_link = ? WHERE slide_idx = ?";
        $result = $this->db->query($sql, $array);
        return array('return'=>$result);
    }

    public function slideIdxsUpdate() {
        $idxs = $_POST['idxs'];
        $idx = $_POST['idx'];
        $table = "slide_menu";
        for($i=0; $i<count($idxs); $i++) {
            $sql= "UPDATE slide_menu SET slide_idxs = ? WHERE slide_idx = ?";
            $array = array($idxs[$i], $idx[$i]);
            $result = $this->db->query($sql, $array);
        }
        return array('return'=>$result);
    }

    public function slidedel($idx) {
        $array = array($idx);
        $sql= "DELETE FROM slide_menu WHERE slide_idx = ?";
        $result = $this->db->query($sql, $array);
        return array('return'=>$result);
    }

    public function slideCount() {
        $sql="SELECT COUNT(*) count  FROM slide_menu";
        return $this->db->query($sql)->row()->count;
    }
















    public function reportGiveListData($page = 1) {
        $limit=10;
        $offset=$limit*($page-1);
//        $sql="SELECT * from report_give_menu ORDER BY idxs DESC
//              limit {$limit} offset {$offset}";


        $sql="SELECT idx, rice_name, rice_1,rice_2,rice_3,rice_sum,rice_note,
        scholarship_name, scholarship_1,scholarship_2,scholarship_3,scholarship_sum,scholarship_note,
        medical_name, medical_1,medical_2,medical_3,medical_sum,medical_note,
        lowincome_name, lowincome_1,lowincome_2,lowincome_3,lowincome_sum,lowincome_note,
        total_name, total_1,total_2,total_3,total_sum,total_note,reg_date,idxs
        FROM report_table ORDER BY idxs DESC";      

        $result = $this->db->query($sql)->result();

        $sql="SELECT COUNT(*) count FROM report_table";
        $count = $this->db->query($sql)->row();

        return array('return'=>true,'list'=>$result,'count'=>$count->count);
    }

    public function reportGiveData($idx) {
        $sql="SELECT * FROM report_table WHERE idx = ?";
        $array = array($idx);
        return $this->db->query($sql, $array)->row();
    }

    public function reportGiveInsertData($insert_data) {

//        $sql="SELECT idxs FROM report_give_menu order by idxs DESC LIMIT 1";
//        $idxs = $this->db->query($sql)->row()->idxs + 1;
//
//        $insert_data['idxs'] = $idxs;

        $sql="SELECT idxs FROM report_table order by idxs DESC LIMIT 1";
        $obj_idxs = $this->db->query($sql)->row();
        if( !$obj_idxs) {
            $idxs = 1;
        } else {
            $idxs = $obj_idxs->idxs+1;
        }
        $insert_data['idxs'] = $idxs;
        $result = $this->db->insert('report_table', $insert_data);
        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function reportUpdateData($update, $idx) {

        $this->db->where('idx', $idx);
        $result = $this->db->update('report_table', $update);

        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function reportGiveDel($idx) {
        $sql= "DELETE FROM report_table WHERE idx = ?";
        $result = $this->db->query($sql, [$idx]);
        if($result ) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function reportGiveCount() {
        $sql="SELECT COUNT(*) count  FROM report_table";
        return $this->db->query($sql)->row()->count;
    }

    public function reportGiveOrder($idxs, $idx) {
        for($i=0; $i<count($idxs); $i++) {
            $sql= "UPDATE report_table SET idxs = ? WHERE idx = ?";
            $array = array($idxs[$i], $idx[$i]);
            $result = $this->db->query($sql, $array);
        }
        return array('return'=>$result);
    }


    

    //report -----------------------------------------------------------------
    public function reportListData($page = 1) {
        $table = "report_table";
        $limit=10;
        $offset=$limit*($page-1);
        $sql="SELECT idx, @rownum:=@rownum+1 num, rice_name, rice_1,rice_2,rice_3,rice_sum,rice_note,
                scholarship_name, scholarship_1,scholarship_2,scholarship_3,scholarship_sum,scholarship_note,
                medical_name, medical_1,medical_2,medical_3,medical_sum,medical_note,
                lowincome_name, lowincome_1,lowincome_2,lowincome_3,lowincome_sum,lowincome_note,
                total_name, total_1,total_2,total_3,total_sum,total_note,reg_date,idxs
                FROM report_table, (SELECT @rownum:={$offset}) TMP
                ORDER BY idxs DESC
              limit {$limit} offset {$offset}";
        $result = $this->db->query($sql)->result();

        $sql="SELECT COUNT(*) count FROM $table";
        $count = $this->db->query($sql)->row();

        return array('return'=>true,'list'=>$result,'count'=>$count->count);
    }

    public function reportTotalNum() {

        $sql = "select count(*) count From report_table ";
        $count = $this->db->query($sql)->row();

        return $count->count;
    }

    public function reportinsertData() {
        $table = "report_table";

        $sql="SELECT idxs FROM $table order by idxs DESC LIMIT 1";
        $idxs = $this->db->query($sql)->row()->idxs + 1;
        foreach($_POST as $key => $value ){
            $key = 'report_'.$key;
            $array[$key] = $value;
        }
        $array['report_date'] = date('Y-m-d H:i:s');
        $array['idxs'] = $idxs;
        $result = $this->db->insert($table, $array);
        return array('return'=>$result);
    }

    public function reportData($idx) {
        $array = array($idx);
        $sql="SELECT idx, @rownum:=@rownum+1 num, rice_name, rice_1,rice_2,rice_3,rice_sum,rice_note,
        scholarship_name, scholarship_1,scholarship_2,scholarship_3,scholarship_sum,scholarship_note,
        medical_name, medical_1,medical_2,medical_3,medical_sum,medical_note,
        lowincome_name, lowincome_1,lowincome_2,lowincome_3,lowincome_sum,lowincome_note,
        total_name, total_1,total_2,total_3,total_sum,total_note,reg_date,idxs
            FROM report_table WHERE idx = ?";
        return $this->db->query($sql, $array)->row();
    }

    // public function reportUpdate() {
    //     $array = array($_POST['name'], $_POST['image'], $_POST['link'], $_POST['idx']);
    //     $sql= "UPDATE report_table SET report_name = ?, report_image = ?,
    //             report_link = ? WHERE idx = ?";
    //     $result = $this->db->query($sql, $array);
    //     return array('return'=>$result);
    // }

    public function reportIdxsUpdate() {
        $idxs = $_POST['idxs'];
        $idx = $_POST['idx'];
        $table = "report_table";
        for($i=0; $i<count($idxs); $i++) {
            $sql= "UPDATE report_table SET idxs = ? WHERE idx = ?";
            $array = array($idxs[$i], $idx[$i]);
            $result = $this->db->query($sql, $array);
        }
        return array('return'=>$result);
    }

    public function reportdel($idx) {
        $array = array($idx);
        $sql= "DELETE FROM report_table WHERE idx = ?";
        $result = $this->db->query($sql, $array);
        return array('return'=>$result);
    }

    public function reportCount() {
        $sql="SELECT COUNT(*) count  FROM report_table";
        return $this->db->query($sql)->row()->count;
    }

//----------------------------------------------------












    public function historyInsertData($insert_data) {


//        $sql="SELECT idxs FROM history_menu order by idxs DESC LIMIT 1";
//        $idxs = $this->db->query($sql)->row()->idxs + 1;

        $sql="SELECT idxs FROM history_menu order by idxs DESC LIMIT 1";
        $obj_idxs = $this->db->query($sql)->row();
        if( !$obj_idxs) {
            $idxs = 1;
        } else {
            $idxs = $obj_idxs->idxs+1;
        }

        $insert_data['idxs'] = $idxs;
        $result = $this->db->insert('history_menu', $insert_data);
        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function historyData($idx) {
        $sql="SELECT * FROM history_menu WHERE idx = ?";
        $array = array($idx);
        return $this->db->query($sql, $array)->row();
    }

    public function historyMenuData($page = 1) {
        $limit=10;
        $offset=$limit*($page-1);
        $sql="SELECT @rownum:=@rownum+1 num, history_menu.* from history_menu, (SELECT @rownum:= {$offset}) TMP ORDER BY idxs DESC
              limit {$limit} offset {$offset}";
        $result = $this->db->query($sql)->result();

        $sql="SELECT COUNT(*) count FROM history_menu";
        $count = $this->db->query($sql)->row();

        return array('return'=>true,'list'=>$result,'count'=>$count->count);
    }

    public function productUpdateData($update, $idx) {

        $this->db->where('idx', $idx);
        $result = $this->db->update('history_menu', $update);

        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function historyIdxsUpdate($idxs, $idx) {
        for($i=0; $i<count($idxs); $i++) {
            $sql= "UPDATE history_menu SET idxs = ? WHERE idx = ?";
            $array = array($idxs[$i], $idx[$i]);
            $result = $this->db->query($sql, $array);
        }
        return array('return'=>$result);
    }

    public function historyDelete($idx) {
        $sql= "DELETE FROM history_menu WHERE idx = ?";
        $result = $this->db->query($sql, [$idx]);
        if($result ) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function historyCount() {
        $sql="SELECT COUNT(*) count  FROM history_menu";
        return $this->db->query($sql)->row()->count;
    }


    

    public function productShow() {
        if($_POST['show'] == 1) $show = 0; else $show = 1;

        $sql= "UPDATE callget_product SET product_show = ?
          WHERE product_idx = ?";
        $array = array($show, $_POST['idx']);
        $result = $this->db->query($sql, $array);
        return array('return'=>$result);
    }

    public function bursaryGiveListData($page = 1) {
        $limit=10;
        $offset=$limit*($page-1);
//        $sql="SELECT * from bursary_give_menu ORDER BY idxs DESC
//              limit {$limit} offset {$offset}";


        $sql="SELECT @rownum:=@rownum+1 num, bursary_give_menu.idx, bursary_give_menu.name, bursary_give_menu.associate ,bursary_give_menu.give_money ,bursary_give_menu.reg_date
from bursary_give_menu, (SELECT @rownum:= {$offset}) TMP ORDER BY idxs DESC
              limit {$limit} offset {$offset}";

        $result = $this->db->query($sql)->result();

        $sql="SELECT COUNT(*) count FROM bursary_give_menu";
        $count = $this->db->query($sql)->row();

        return array('return'=>true,'list'=>$result,'count'=>$count->count);
    }

    public function bursaryGiveData($idx) {
        $sql="SELECT * FROM bursary_give_menu WHERE idx = ?";
        $array = array($idx);
        return $this->db->query($sql, $array)->row();
    }

    public function bursaryGiveInsertData($insert_data) {

//        $sql="SELECT idxs FROM bursary_give_menu order by idxs DESC LIMIT 1";
//        $idxs = $this->db->query($sql)->row()->idxs + 1;
//
//        $insert_data['idxs'] = $idxs;

        $sql="SELECT idxs FROM bursary_give_menu order by idxs DESC LIMIT 1";
        $obj_idxs = $this->db->query($sql)->row();
        if( !$obj_idxs) {
            $idxs = 1;
        } else {
            $idxs = $obj_idxs->idxs+1;
        }
        $insert_data['idxs'] = $idxs;
        $result = $this->db->insert('bursary_give_menu', $insert_data);
        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function bursaryGiveUpdateData($update, $idx) {

        $this->db->where('idx', $idx);
        $result = $this->db->update('bursary_give_menu', $update);

        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function bursaryGiveDel($idx) {
        $sql= "DELETE FROM bursary_give_menu WHERE idx = ?";
        $result = $this->db->query($sql, [$idx]);
        if($result ) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function bursaryGiveCount() {
        $sql="SELECT COUNT(*) count  FROM bursary_give_menu";
        return $this->db->query($sql)->row()->count;
    }

    public function bursaryGiveOrder($idxs, $idx) {
        for($i=0; $i<count($idxs); $i++) {
            $sql= "UPDATE bursary_give_menu SET idxs = ? WHERE idx = ?";
            $array = array($idxs[$i], $idx[$i]);
            $result = $this->db->query($sql, $array);
        }
        return array('return'=>$result);
    }

    public function bursaryDonationData($page = 1) {
        $limit=10;
        $offset=$limit*($page-1);
//        $sql="SELECT * from bursary_donation_menu ORDER BY idxs DESC
//              limit {$limit} offset {$offset}";

        $sql="SELECT @rownum:=@rownum+1 num, bursary_donation_menu.* from bursary_donation_menu, (SELECT @rownum:= {$offset}) TMP ORDER BY idxs DESC
              limit {$limit} offset {$offset}";

        $result = $this->db->query($sql)->result();

        $sql="SELECT COUNT(*) count FROM bursary_donation_menu";
        $count = $this->db->query($sql)->row();

        return array('return'=>true,'list'=>$result,'count'=>$count->count);
    }

    public function donationInsertData($insert_data) {

        $sql="SELECT idxs FROM bursary_donation_menu order by idxs DESC LIMIT 1";
        $obj_idxs = $this->db->query($sql)->row();
        if( !$obj_idxs) {
            $idxs = 1;
        } else {
            $idxs = $obj_idxs->idxs+1;
        }
        $insert_data['idxs'] = $idxs;
        $result = $this->db->insert('bursary_donation_menu', $insert_data);
        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function donationData($idx) {
        $sql="SELECT * FROM bursary_donation_menu WHERE idx = ?";
        $array = array($idx);
        return $this->db->query($sql, $array)->row();
    }

    public function donationUpdateData($update, $idx) {

        $this->db->where('idx', $idx);
        $result = $this->db->update('bursary_donation_menu', $update);

        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function donationDel($idx) {
        $sql= "DELETE FROM bursary_donation_menu WHERE idx = ?";
        $result = $this->db->query($sql, [$idx]);
        if($result ) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function donationCount() {
        $sql="SELECT COUNT(*) count  FROM bursary_donation_menu";
        return $this->db->query($sql)->row()->count;
    }

    public function donationOrder($idxs, $idx) {
        for($i=0; $i<count($idxs); $i++) {
            $sql= "UPDATE bursary_donation_menu SET idxs = ? WHERE idx = ?";
            $array = array($idxs[$i], $idx[$i]);
            $result = $this->db->query($sql, $array);
        }
        return array('return'=>$result);
    }

    public function bursaryGoodsList($page = 1) {
        $limit=10;
        $offset=$limit*($page-1);

//        $sql="SELECT @rownum:=@rownum+1 num, bursary_goods_menu.* from bursary_goods_menu, (SELECT @rownum:= {$offset}) TMP ORDER BY idxs DESC
//              limit {$limit} offset {$offset}";

        $sql="SELECT @rownum:=@rownum+1 num, bursary_goods_menu.idx, bursary_goods_menu.name, bursary_goods_menu.associate ,bursary_goods_menu.give_money ,bursary_goods_menu.reg_date
from bursary_goods_menu, (SELECT @rownum:= {$offset}) TMP ORDER BY idxs DESC
              limit {$limit} offset {$offset}";
        $result = $this->db->query($sql)->result();

        $sql="SELECT COUNT(*) count FROM bursary_goods_menu";
        $count = $this->db->query($sql)->row();

        return array('return'=>true,'list'=>$result,'count'=>$count->count);
    }

    public function goodsInsertData($insert_data) {
        $sql="SELECT idxs FROM bursary_goods_menu order by idxs DESC LIMIT 1";
        $obj_idxs = $this->db->query($sql)->row();
        if( !$obj_idxs) {
            $idxs = 1;
        } else {
            $idxs = $obj_idxs->idxs+1;
        }

        $insert_data['idxs'] = $idxs;
        $result = $this->db->insert('bursary_goods_menu', $insert_data);
        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function bursaryGoodsData($idx) {
        $sql="SELECT * FROM bursary_goods_menu WHERE idx = ?";
        $array = array($idx);
        return $this->db->query($sql, $array)->row();
    }

    public function goodsUpdateData($update, $idx) {

        $this->db->where('idx', $idx);
        $result = $this->db->update('bursary_goods_menu', $update);

        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function bursaryGoodsDel($idx) {
        $sql= "DELETE FROM bursary_goods_menu WHERE idx = ?";
        $result = $this->db->query($sql, [$idx]);
        if($result ) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function goodsCount() {
        $sql="SELECT COUNT(*) count  FROM bursary_goods_menu";
        return $this->db->query($sql)->row()->count;
    }

    public function goodsOrder($idxs, $idx) {
        for($i=0; $i<count($idxs); $i++) {
            $sql= "UPDATE bursary_goods_menu SET idxs = ? WHERE idx = ?";
            $array = array($idxs[$i], $idx[$i]);
            $result = $this->db->query($sql, $array);
        }
        return array('return'=>$result);
    }

    public function bbsNoticeList($page = 1) {
        $limit=10;
        $offset=$limit*($page-1);
//        $sql="SELECT idx,title,hit,reg_date,idxs from bbs_notice ORDER BY idxs DESC
//              limit {$limit} offset {$offset}";

        $sql="SELECT @rownum:=@rownum+1 num, idx, title,hit,reg_date,idxs  from bbs_notice, (SELECT @rownum:= {$offset}) TMP ORDER BY idxs DESC
              limit {$limit} offset {$offset}";

        $result = $this->db->query($sql)->result();

        $sql="SELECT COUNT(*) count FROM bbs_notice";
        $count = $this->db->query($sql)->row();

        return array('return'=>true,'list'=>$result,'count'=>$count->count);
    }

    public function noticeInsertData($insert_data) {

        $sql="SELECT idxs FROM bbs_notice order by idxs DESC LIMIT 1";
        $obj_idxs = $this->db->query($sql)->row();
        if( !$obj_idxs) {
            $idxs = 1;
        } else {
            $idxs = $obj_idxs->idxs+1;
        }
        $insert_data['idxs'] = $idxs;
        $result = $this->db->insert('bbs_notice', $insert_data);
        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function noticeData($idx) {
        $sql="SELECT * FROM bbs_notice WHERE idx = ?";
        $array = array($idx);
        return $this->db->query($sql, $array)->row();
    }

    public function noticeUpdateData($update, $idx) {

        $this->db->where('idx', $idx);
        $result = $this->db->update('bbs_notice', $update);

        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function noticeCount() {
        $sql="SELECT COUNT(*) count  FROM bbs_notice";
        return $this->db->query($sql)->row()->count;
    }

    public function noticeOrder($idxs, $idx) {
        for($i=0; $i<count($idxs); $i++) {
            $sql= "UPDATE bbs_notice SET idxs = ? WHERE idx = ?";
            $array = array($idxs[$i], $idx[$i]);
            $result = $this->db->query($sql, $array);
        }
        return array('return'=>$result);
    }

    public function noticeDel($idx) {
        $sql= "DELETE FROM bbs_notice WHERE idx = ?";
        $result = $this->db->query($sql, [$idx]);
        if($result ) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }
    public function bbsPressList($page = 1) {
        $limit=10;
        $offset=$limit*($page-1);
//        $sql="SELECT idx,thumbnail,title,hit, media_name,reg_date,idxs from bbs_press ORDER BY idxs DESC
//              limit {$limit} offset {$offset}";

        $sql="SELECT @rownum:=@rownum+1 num, idx,thumbnail,title,hit, media_name,reg_date,idxs  from bbs_press, (SELECT @rownum:= {$offset}) TMP ORDER BY idxs DESC
              limit {$limit} offset {$offset}";


        $result = $this->db->query($sql)->result();

        $sql="SELECT COUNT(*) count FROM bbs_press";
        $count = $this->db->query($sql)->row();

        return array('return'=>true,'list'=>$result,'count'=>$count->count);
    }

    public function pressInsertData($insert_data) {

        $sql="SELECT idxs FROM bbs_press order by idxs DESC LIMIT 1";
        $obj_idxs = $this->db->query($sql)->row();
        if( !$obj_idxs) {
            $idxs = 1;
        } else {
            $idxs = $obj_idxs->idxs+1;
        }
        $insert_data['idxs'] = $idxs;
        $result = $this->db->insert('bbs_press', $insert_data);
        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function pressData($idx) {
        $sql="SELECT * FROM bbs_press WHERE idx = ?";
        $array = array($idx);
        return $this->db->query($sql, $array)->row();
    }

    public function pressUpdateData($update, $idx) {

        $this->db->where('idx', $idx);
        $result = $this->db->update('bbs_press', $update);

        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function pressCount() {
        $sql="SELECT COUNT(*) count  FROM bbs_press";
        return $this->db->query($sql)->row()->count;
    }

    public function pressOrder($idxs, $idx) {
        for($i=0; $i<count($idxs); $i++) {
            $sql= "UPDATE bbs_press SET idxs = ? WHERE idx = ?";
            $array = array($idxs[$i], $idx[$i]);
            $result = $this->db->query($sql, $array);
        }
        return array('return'=>$result);
    }

    public function pressDel($idx) {
        $sql= "DELETE FROM bbs_press WHERE idx = ?";
        $result = $this->db->query($sql, [$idx]);
        if($result ) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function bbsgalleryList($page = 1) {
        $limit=10;
        $offset=$limit*($page-1);
//        $sql="SELECT idx,thumbnail,title,hit, reg_date,idxs from bbs_gallery ORDER BY idxs DESC
//              limit {$limit} offset {$offset}";

        $sql="SELECT @rownum:=@rownum+1 num, idx,thumbnail,title,hit, reg_date,idxs  from bbs_gallery, (SELECT @rownum:= {$offset}) TMP ORDER BY idxs DESC
              limit {$limit} offset {$offset}";

        $result = $this->db->query($sql)->result();

        $sql="SELECT COUNT(*) count FROM bbs_gallery";
        $count = $this->db->query($sql)->row();

        return array('return'=>true,'list'=>$result,'count'=>$count->count);
    }

    public function galleryInsertData($insert_data) {

        $sql="SELECT idxs FROM bbs_gallery order by idxs DESC LIMIT 1";
        $obj_idxs = $this->db->query($sql)->row();
        if( !$obj_idxs) {
            $idxs = 1;
        } else {
            $idxs = $obj_idxs->idxs+1;
        }
        $insert_data['idxs'] = $idxs;
        $result = $this->db->insert('bbs_gallery', $insert_data);
        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function galleryData($idx) {
        $sql="SELECT * FROM bbs_gallery WHERE idx = ?";
        $array = array($idx);
        return $this->db->query($sql, $array)->row();
    }

    public function galleryUpdateData($update, $idx) {

        $this->db->where('idx', $idx);
        $result = $this->db->update('bbs_gallery', $update);

        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function galleryCount() {
        $sql="SELECT COUNT(*) count  FROM bbs_gallery";
        return $this->db->query($sql)->row()->count;
    }

    public function galleryOrder($idxs, $idx) {
        for($i=0; $i<count($idxs); $i++) {
            $sql= "UPDATE bbs_gallery SET idxs = ? WHERE idx = ?";
            $array = array($idxs[$i], $idx[$i]);
            $result = $this->db->query($sql, $array);
        }
        return array('return'=>$result);
    }

    public function galleryDel($idx) {
        $sql= "DELETE FROM bbs_gallery WHERE idx = ?";
        $result = $this->db->query($sql, [$idx]);
        if($result ) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function historyGiveList($page = 1) {
        $limit=10;
        $offset=$limit*($page-1);
//        $sql="SELECT * from history_give ORDER BY idxs DESC
//              limit {$limit} offset {$offset}";

        $sql="SELECT @rownum:=@rownum+1 num, history_give.* from history_give, (SELECT @rownum:= {$offset}) TMP ORDER BY idxs DESC
              limit {$limit} offset {$offset}";

        $result = $this->db->query($sql)->result();

        $sql="SELECT COUNT(*) count FROM history_give";
        $count = $this->db->query($sql)->row();

        return array('return'=>true,'list'=>$result,'count'=>$count->count);
    }

    public function historyGiveInsertData($insert_data) {


//        $sql="SELECT idxs FROM history_menu order by idxs DESC LIMIT 1";
//        $idxs = $this->db->query($sql)->row()->idxs + 1;

        $sql="SELECT idxs FROM history_give order by idxs DESC LIMIT 1";
        $obj_idxs = $this->db->query($sql)->row();
        if( !$obj_idxs) {
            $idxs = 1;
        } else {
            $idxs = $obj_idxs->idxs+1;
        }

        $insert_data['idxs'] = $idxs;
        $result = $this->db->insert('history_give', $insert_data);
        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function historyGiveData($idx) {
        $sql="SELECT * FROM history_give WHERE idx = ?";
        $array = array($idx);
        return $this->db->query($sql, $array)->row();
    }

    public function historyGiveUpdateData($update_data, $idx) {
        $this->db->where('idx', $idx);
        $result = $this->db->update('history_give', $update_data);

        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function historyGiveIdxsUpdate($idxs, $idx) {
        for($i=0; $i<count($idxs); $i++) {
            $sql= "UPDATE history_give SET idxs = ? WHERE idx = ?";
            $array = array($idxs[$i], $idx[$i]);
            $result = $this->db->query($sql, $array);
        }
        return array('return'=>$result);
    }

    public function historyGiveDelete($idx) {
        $sql= "DELETE FROM history_give WHERE idx = ?";
        $result = $this->db->query($sql, [$idx]);
        if($result ) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function historyGiveCount() {
        $sql="SELECT COUNT(*) count  FROM history_give";
        return $this->db->query($sql)->row()->count;
    }

    public function historySupportList($page = 1) {
        $limit=10;
        $offset=$limit*($page-1);
//        $sql="SELECT * from history_support ORDER BY idxs DESC
//              limit {$limit} offset {$offset}";

        $sql="SELECT @rownum:=@rownum+1 num, history_support.* from history_support, (SELECT @rownum:= {$offset}) TMP ORDER BY idxs DESC
              limit {$limit} offset {$offset}";

        $result = $this->db->query($sql)->result();

        $sql="SELECT COUNT(*) count FROM history_support";
        $count = $this->db->query($sql)->row();

        return array('return'=>true,'list'=>$result,'count'=>$count->count);
    }

    public function historySupportInsertData($insert_data) {


//        $sql="SELECT idxs FROM history_menu order by idxs DESC LIMIT 1";
//        $idxs = $this->db->query($sql)->row()->idxs + 1;

        $sql="SELECT idxs FROM history_support order by idxs DESC LIMIT 1";
        $obj_idxs = $this->db->query($sql)->row();
        if( !$obj_idxs) {
            $idxs = 1;
        } else {
            $idxs = $obj_idxs->idxs+1;
        }

        $insert_data['idxs'] = $idxs;
        $result = $this->db->insert('history_support', $insert_data);
        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function historySupportData($idx) {
        $sql="SELECT * FROM history_support WHERE idx = ?";
        $array = array($idx);
        return $this->db->query($sql, $array)->row();
    }

    public function historySupportUpdateData($update_data, $idx) {
        $this->db->where('idx', $idx);
        $result = $this->db->update('history_support', $update_data);

        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function historySupportIdxsUpdate($idxs, $idx) {
        for($i=0; $i<count($idxs); $i++) {
            $sql= "UPDATE history_support SET idxs = ? WHERE idx = ?";
            $array = array($idxs[$i], $idx[$i]);
            $result = $this->db->query($sql, $array);
        }
        return array('return'=>$result);
    }

    public function historySupportCount() {
        $sql="SELECT COUNT(*) count  FROM history_support";
        return $this->db->query($sql)->row()->count;
    }

    public function historySupportDelete($idx) {
        $sql= "DELETE FROM history_support WHERE idx = ?";
        $result = $this->db->query($sql, [$idx]);
        if($result ) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }


    public function historyContributionList($page = 1) {
        $limit=10;
        $offset=$limit*($page-1);
//        $sql="SELECT * from history_contribution ORDER BY idxs DESC
//              limit {$limit} offset {$offset}";

        $sql="SELECT @rownum:=@rownum+1 num, history_contribution.* from history_contribution, (SELECT @rownum:= {$offset}) TMP ORDER BY idxs DESC
              limit {$limit} offset {$offset}";

        $result = $this->db->query($sql)->result();

        $sql="SELECT COUNT(*) count FROM history_contribution";
        $count = $this->db->query($sql)->row();

        return array('return'=>true,'list'=>$result,'count'=>$count->count);
    }

    public function historyContributionInsertData($insert_data) {


//        $sql="SELECT idxs FROM history_menu order by idxs DESC LIMIT 1";
//        $idxs = $this->db->query($sql)->row()->idxs + 1;

        $sql="SELECT idxs FROM history_contribution order by idxs DESC LIMIT 1";
        $obj_idxs = $this->db->query($sql)->row();
        if( !$obj_idxs) {
            $idxs = 1;
        } else {
            $idxs = $obj_idxs->idxs+1;
        }

        $insert_data['idxs'] = $idxs;
        $result = $this->db->insert('history_contribution', $insert_data);
        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function historyContributionData($idx) {
        $sql="SELECT * FROM history_contribution WHERE idx = ?";
        $array = array($idx);
        return $this->db->query($sql, $array)->row();
    }

    public function historyContributionUpdateData($update_data, $idx) {
        $this->db->where('idx', $idx);
        $result = $this->db->update('history_contribution', $update_data);

        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function historyContributionIdxsUpdate($idxs, $idx) {
        for($i=0; $i<count($idxs); $i++) {
            $sql= "UPDATE history_contribution SET idxs = ? WHERE idx = ?";
            $array = array($idxs[$i], $idx[$i]);
            $result = $this->db->query($sql, $array);
        }
        return array('return'=>$result);
    }

    public function historyContributionCount() {
        $sql="SELECT COUNT(*) count  FROM history_contribution";
        return $this->db->query($sql)->row()->count;
    }

    public function historyContributionDelete($idx) {
        $sql= "DELETE FROM history_contribution WHERE idx = ?";
        $result = $this->db->query($sql, [$idx]);
        if($result ) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function historyDonateList($page = 1) {
        $limit=10;
        $offset=$limit*($page-1);
//        $sql="SELECT * from history_donate ORDER BY idxs DESC
//              limit {$limit} offset {$offset}";

        $sql="SELECT @rownum:=@rownum+1 num, history_donate.* from history_donate, (SELECT @rownum:= {$offset}) TMP ORDER BY idxs DESC
              limit {$limit} offset {$offset}";

        $result = $this->db->query($sql)->result();


        $sql="SELECT COUNT(*) count FROM history_donate";
        $count = $this->db->query($sql)->row();


        return array('return'=>true,'list'=>$result,'count'=>$count->count);
    }

    public function historyDonateInsertData($insert_data) {


//        $sql="SELECT idxs FROM history_menu order by idxs DESC LIMIT 1";
//        $idxs = $this->db->query($sql)->row()->idxs + 1;

        $sql="SELECT idxs FROM history_donate order by idxs DESC LIMIT 1";
        $obj_idxs = $this->db->query($sql)->row();
        if( !$obj_idxs) {
            $idxs = 1;
        } else {
            $idxs = $obj_idxs->idxs+1;
        }

        $insert_data['idxs'] = $idxs;
        $result = $this->db->insert('history_donate', $insert_data);
        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function historyDonateData($idx) {
        $sql="SELECT * FROM history_donate WHERE idx = ?";
        $array = array($idx);
        return $this->db->query($sql, $array)->row();
    }

    public function historyDonateUpdateData($update_data, $idx) {
        $this->db->where('idx', $idx);
        $result = $this->db->update('history_donate', $update_data);

        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function historyDonateIdxsUpdate($idxs, $idx) {
        for($i=0; $i<count($idxs); $i++) {
            $sql= "UPDATE history_donate SET idxs = ? WHERE idx = ?";
            $array = array($idxs[$i], $idx[$i]);
            $result = $this->db->query($sql, $array);
        }
        return array('return'=>$result);
    }

    public function historyDonateCount() {
        $sql="SELECT COUNT(*) count  FROM history_donate";
        return $this->db->query($sql)->row()->count;
    }

    public function historyDonateDelete($idx) {
        $sql= "DELETE FROM history_donate WHERE idx = ?";
        $result = $this->db->query($sql, [$idx]);
        if($result ) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }


    public function historyCollaboList($page = 1) {
        $limit=10;
        $offset=$limit*($page-1);
//        $sql="SELECT * from history_collabo ORDER BY idxs DESC
//              limit {$limit} offset {$offset}";

        $sql="SELECT @rownum:=@rownum+1 num, history_collabo.* from history_collabo, (SELECT @rownum:= {$offset}) TMP ORDER BY idxs DESC
              limit {$limit} offset {$offset}";

        $result = $this->db->query($sql)->result();

        $sql="SELECT COUNT(*) count FROM history_collabo";
        $count = $this->db->query($sql)->row();

        return array('return'=>true,'list'=>$result,'count'=>$count->count);
    }

    public function historyCollaboInsertData($insert_data) {


//        $sql="SELECT idxs FROM history_menu order by idxs DESC LIMIT 1";
//        $idxs = $this->db->query($sql)->row()->idxs + 1;

        $sql="SELECT idxs FROM history_collabo order by idxs DESC LIMIT 1";
        $obj_idxs = $this->db->query($sql)->row();
        if( !$obj_idxs) {
            $idxs = 1;
        } else {
            $idxs = $obj_idxs->idxs+1;
        }

        $insert_data['idxs'] = $idxs;
        $result = $this->db->insert('history_collabo', $insert_data);
        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function historyCollaboData($idx) {
        $sql="SELECT * FROM history_collabo WHERE idx = ?";
        $array = array($idx);
        return $this->db->query($sql, $array)->row();
    }

    public function historyCollaboUpdateData($update_data, $idx) {
        $this->db->where('idx', $idx);
        $result = $this->db->update('history_collabo', $update_data);

        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function historyCollaboIdxsUpdate($idxs, $idx) {
        for($i=0; $i<count($idxs); $i++) {
            $sql= "UPDATE history_collabo SET idxs = ? WHERE idx = ?";
            $array = array($idxs[$i], $idx[$i]);
            $result = $this->db->query($sql, $array);
        }
        return array('return'=>$result);
    }

    public function historyCollaboCount() {
        $sql="SELECT COUNT(*) count  FROM history_collabo";
        return $this->db->query($sql)->row()->count;
    }

    public function historyCollaboDelete($idx) {
        $sql= "DELETE FROM history_collabo WHERE idx = ?";
        $result = $this->db->query($sql, [$idx]);
        if($result ) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function bursaryOneperList($page = 1) {
        $limit=10;
        $offset=$limit*($page-1);

//        $sql="SELECT @rownum:=@rownum+1 num, bursary_oneper_menu.* from bursary_oneper_menu, (SELECT @rownum:= {$offset}) TMP ORDER BY idxs DESC
//              limit {$limit} offset {$offset}";

        $sql="SELECT @rownum:=@rownum+1 num, bursary_oneper_menu.idx, bursary_oneper_menu.name, bursary_oneper_menu.give_money ,bursary_oneper_menu.memo ,bursary_oneper_menu.reg_date
from bursary_oneper_menu, (SELECT @rownum:= {$offset}) TMP ORDER BY idxs DESC
              limit {$limit} offset {$offset}";
        $result = $this->db->query($sql)->result();

        $sql="SELECT COUNT(*) count FROM bursary_oneper_menu";
        $count = $this->db->query($sql)->row();

        return array('return'=>true,'list'=>$result,'count'=>$count->count);
    }

    public function oneperInsertData($insert_data) {
        $sql="SELECT idxs FROM bursary_oneper_menu order by idxs DESC LIMIT 1";
        $obj_idxs = $this->db->query($sql)->row();
        if( !$obj_idxs) {
            $idxs = 1;
        } else {
            $idxs = $obj_idxs->idxs+1;
        }

        $insert_data['idxs'] = $idxs;
        $result = $this->db->insert('bursary_oneper_menu', $insert_data);
        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function bursaryOneperData($idx) {
        $sql="SELECT * FROM bursary_oneper_menu WHERE idx = ?";
        $array = array($idx);
        return $this->db->query($sql, $array)->row();
    }

    public function oneperUpdateData($update, $idx) {

        $this->db->where('idx', $idx);
        $result = $this->db->update('bursary_oneper_menu', $update);

        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function bursaryOneperDel($idx) {
        $sql= "DELETE FROM bursary_oneper_menu WHERE idx = ?";
        $result = $this->db->query($sql, [$idx]);
        if($result ) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function oneperCount() {
        $sql="SELECT COUNT(*) count  FROM bursary_oneper_menu";
        return $this->db->query($sql)->row()->count;
    }

    public function oneperOrder($idxs, $idx) {
        for($i=0; $i<count($idxs); $i++) {
            $sql= "UPDATE bursary_oneper_menu SET idxs = ? WHERE idx = ?";
            $array = array($idxs[$i], $idx[$i]);
            $result = $this->db->query($sql, $array);
        }
        return array('return'=>$result);
    }

    public function bursaryRollList($page = 1) {
        $limit=10;
        $offset=$limit*($page-1);

//        $sql="SELECT @rownum:=@rownum+1 num, bursary_roll_menu.* from bursary_roll_menu, (SELECT @rownum:= {$offset}) TMP ORDER BY idxs DESC
//              limit {$limit} offset {$offset}";

        $sql="SELECT @rownum:=@rownum+1 num, bursary_roll_menu.idx, bursary_roll_menu.name ,bursary_roll_menu.give_money ,bursary_roll_menu.memo ,bursary_roll_menu.reg_date
from bursary_roll_menu, (SELECT @rownum:= {$offset}) TMP ORDER BY idxs DESC
              limit {$limit} offset {$offset}";
        $result = $this->db->query($sql)->result();

        $sql="SELECT COUNT(*) count FROM bursary_roll_menu";
        $count = $this->db->query($sql)->row();

        return array('return'=>true,'list'=>$result,'count'=>$count->count);
    }

    public function rollInsertData($insert_data) {
        $sql="SELECT idxs FROM bursary_roll_menu order by idxs DESC LIMIT 1";
        $obj_idxs = $this->db->query($sql)->row();
        if( !$obj_idxs) {
            $idxs = 1;
        } else {
            $idxs = $obj_idxs->idxs+1;
        }

        $insert_data['idxs'] = $idxs;
        $result = $this->db->insert('bursary_roll_menu', $insert_data);
        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function bursaryRollData($idx) {
        $sql="SELECT * FROM bursary_roll_menu WHERE idx = ?";
        $array = array($idx);
        return $this->db->query($sql, $array)->row();
    }

    public function rollUpdateData($update, $idx) {

        $this->db->where('idx', $idx);
        $result = $this->db->update('bursary_roll_menu', $update);

        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function bursaryRollDel($idx) {
        $sql= "DELETE FROM bursary_roll_menu WHERE idx = ?";
        $result = $this->db->query($sql, [$idx]);
        if($result ) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function rollCount() {
        $sql="SELECT COUNT(*) count  FROM bursary_roll_menu";
        return $this->db->query($sql)->row()->count;
    }

    public function rollOrder($idxs, $idx) {
        for($i=0; $i<count($idxs); $i++) {
            $sql= "UPDATE bursary_roll_menu SET idxs = ? WHERE idx = ?";
            $array = array($idxs[$i], $idx[$i]);
            $result = $this->db->query($sql, $array);
        }
        return array('return'=>$result);
    }

    public function bursaryCmsList($page = 1) {
        $limit=10;
        $offset=$limit*($page-1);

//        $sql="SELECT @rownum:=@rownum+1 num, bursary_cms_menu.* from bursary_cms_menu, (SELECT @rownum:= {$offset}) TMP ORDER BY idxs DESC
//              limit {$limit} offset {$offset}";

        $sql="SELECT bursary_cms_menu.idx, bursary_cms_menu.name, bursary_cms_menu.associate ,bursary_cms_menu.give_money ,bursary_cms_menu.reg_date
from bursary_cms_menu, (SELECT @rownum:= {$offset}) TMP ORDER BY idxs DESC
              limit {$limit} offset {$offset}";
        $result = $this->db->query($sql)->result();

        $sql="SELECT COUNT(*) count FROM bursary_cms_menu";
        $count = $this->db->query($sql)->row();

        return array('return'=>true,'list'=>$result,'count'=>$count->count);
    }

    public function cmsInsertData($insert_data) {
        $sql="SELECT idxs FROM bursary_cms_menu order by idxs DESC LIMIT 1";
        $obj_idxs = $this->db->query($sql)->row();
        if( !$obj_idxs) {
            $idxs = 1;
        } else {
            $idxs = $obj_idxs->idxs+1;
        }

        $insert_data['idxs'] = $idxs;
        $result = $this->db->insert('bursary_cms_menu', $insert_data);
        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function bursaryCmsData($idx) {
        $sql="SELECT * FROM bursary_cms_menu WHERE idx = ?";
        $array = array($idx);
        return $this->db->query($sql, $array)->row();
    }

    public function cmsUpdateData($update, $idx) {

        $this->db->where('idx', $idx);
        $result = $this->db->update('bursary_cms_menu', $update);

        if($result) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }

    public function bursaryCmsDel($idx) {
        $sql= "DELETE FROM bursary_cms_menu WHERE idx = ?";
        $result = $this->db->query($sql, [$idx]);
        if($result ) {
            return array('return'=>true);
        }
        else {
            return array('return'=>false);
        }
    }
}
