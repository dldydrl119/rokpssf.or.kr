<?php
class loginmodel extends CI_Model {
    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
    }

    public function logindata() {

        $array = array("member_id"=>$_POST['id'],"member_pass"=>password_verify($_POST['pass'],null));
        $datr = $this->db->get_where("member",$array)->row();
        if($datr){
            $_SESSION['member_idx'] = $datr->member_idx;
            $_SESSION['member_name'] = $datr->member_name;
            var_dump($_SESSION);
            return array('result'=>true);
        }
        else{
            return array('return'=>false);
        }
    }
    public function ckid() {
        $datr = $this->db->get_where("member",array("member_id"=>$_POST['id']))->row();
        if($datr){
            return array('result'=>true);
        }
        else{
            return array('return'=>false);
        }
    }
    public function kakao() {
        return $this->snsjoin('kakao');
    }
    public function snsjoin($text) {
        $column = "member_".$text;
        $sql = "INSERT INTO member ({$column}) VALUES (?)";
        $array = array($_POST['id']);
        $return = $this->db->query($sql,$array);
        if($return){
            return array('result'=>true,'idx'=>$this->db->insert_id());
        }
        else{
            $datr = $this->db->get_where("member",array($column=>$_POST['id']))->row();
            if($datr->member_email){
                return array('result'=>false);
            }else{
                return array('result'=>true,'idx'=>$datr->member_idx);
            }
        }
    }
    public function joindata() {
        $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT, ['cost'=>12]);
        $address = $_POST['address1'].' '.$_POST['address2'];
        $sql = "INSERT INTO member (member_id, member_pass, member_name,
                member_address) VALUES (?, ?, ?, ?)";
        $array = array($_POST['id'], $pass, $_POST['name'], $address);
        $return = $this->db->query($sql,$array);
        return array('return'=>$return);
    }
    // private function localUpdate($return,$idx)
    // {
    //     $array=[':idx'=>($idx)?:((TOKEN)?MEMBER_IDX:$_POST['member_idx'])];
    //     foreach ($return as $key => $value) {
    //         if ($value) {
    //             $ke=preg_replace('/[\`\'\";#,]/', '', $key);
    //             $upload[]="`member_{$ke}`=:{$ke}";
    //             if (is_array($value)) {
    //                 $array[":{$ke}"]=implode(',', $value);
    //             } else {
    //                 $array[":{$ke}"]=$value;
    //             }
    //         }
    //     }
    //     $data=['id'=>$_POST['id'],'phone'=>$return->phone];
    //     $upload=implode(',', $upload);
    //     $sql="UPDATE {$this->dbname}_profile
    //         join {$this->dbname}_member using(member_idx)
    //         set {$upload}
    //         where member_idx=:idx
    //     ";
    //     list($rowcount,$result)=$this->query($sql,$array);
    //     if ($rowcount) {
    //         $_SESSION['member_idx']=$result[0]->idx;
    //         $_SESSION['member_type']=$result[0]->type;
    //         $_SESSION['member_name']=$result[0]->name;
    //         return ['return'=>'true','result'=>true,'type'=>'ok','data'=>$data];
    //     } else {
    //         return ['return'=>'false'];
    //     }
    // }
    public function session() {
        header('Location: '.URL.'/main');
    }
    public function logout() {
        session_destroy();
        header('Location: '.URL.'/main');
    }
}
?>
