<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		self::$instance =& $this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');
		$this->load->initialize();
		log_message('info', 'Controller Class Initialized');
	}

	function json($array) {
		header('Content-Type: application/json');
        echo json_encode($array);
	}


	function upload($type, $target=false)
	{
		if (count($_FILES)) {
			$target_dir = "assets/uploads/";
			switch ($type) {
				case 'image':
					if ( empty($_POST['x']) && empty($_POST['y'])) {
						$over=false;
						$_POST['x']=600;
					} else {
						$over=true;
					}
					foreach ($_FILES as $k=>$v) {
						$array=[];
						if (gettype($v['tmp_name'])!='array') {
							if ($filename=$this->uploadImages($v['tmp_name'], $target_dir, $over, $v['name'])) {
								$array[]=$filename;
							}
							// $filename=$this->uploadImages($v['tmp_name'], $target_dir, $over);
						} else {
							for ($i=0;$i<count($v['tmp_name']);$i++) {
								if ($filename=$this->uploadImages($v['tmp_name'][$i], $target_dir, $over, $v['name'][$i])) {
									$array[]=$filename;
								}
								// $filename=$this->uploadImages($v['tmp_name'][$i], $target_dir, $over);
							}
						}
						if ($array) {
							$_POST[$k]=$array;
						}
					}
					break;
				case 'file':
					foreach ($_FILES as $k=>$v) {
						$array=[];
						if (gettype($v['tmp_name'])!='array') {
							if ($filename=$this->uploadFile($v['tmp_name'], $v['name'], $target_dir)) {
								$array[]=$filename;
							}
						} else {
							for ($i=0;$i<count($v['tmp_name']);$i++) {
								if ($filename=$this->uploadFile($v['tmp_name'][$i], $v['name'][$i], $target_dir)) {
									$array[]=$filename;
								}
							}
						}
						if ($array) {
							$_POST[$k]=$array;
						}
					}
					break;
				case 'video':
					foreach ($_FILES as $k=>$v) {
						$array=[];
						if (gettype($v['tmp_name'])!='array') {
							if ($filename=uploadVideo($v['tmp_name'], $v['name'], $target_dir)) {
								$array[]=$filename;
							}
						} else {
							for ($i=0;$i<count($v['tmp_name']);$i++) {
								if ($filename=uploadVideo($v['tmp_name'][$i], $v['name'][$i], $target_dir)) {
									$array[]=$filename;
								}
							}
						}
						if ($array) {
							$_POST[$k]=$array;
						}
					}
					break;
				default:
					break;
			}
		}
		if ($target) {
			return true;
		} else {
			if (count($array)) {
				return ['return'=>'true','url'=>$array,'path'=>URL."/download/{$type}/"];
			} else {
				return ['return'=>'false'];
			}
		}
	}
	function img_limit_resize($real,$wid_size){   //이미지경로,변경할가로길이
		$img_info = GetImageSize($real);
		$img_wid = $img_info[0];
		$img_hei = $img_info[1];
		$img_type = $img_info['mime'];
		if($img_wid>$wid_size){ //업로드이미지가 기준사이즈보다 클경우 이미지 사이즈 축소저장
			$re_hei = (int)(($img_hei*$wid_size)/$img_wid);
			$im=imagecreatetruecolor($wid_size,$re_hei); //이미지의 크기를 정합니다.
			if ($img_type == 'image/png')
				$im2 = imagecreatefrompng($real);
			else
				$im2 = imagecreatefromjpeg($real);
            // $n2_img=$this->imageframe($img_wid, $re_hei);
			imagecopyresized($im, $im2,0,0,0,0,$wid_size,$re_hei,$img_wid,$img_hei);
			imagepng($im,$real); //ImagePNG(이미지, 저장될파일)
			ImageDestroy($im); // 이미지에 사용한 메모리 제거
		}
	}

	function uploadImages($tmp_name, $target_dir, $over, $origin_name=null)
	{
	    if ($tmp_name) {
	        if( is_null($origin_name)) {
                $ex_name = '';
            } else {
                $ex_sub = explode('.', $origin_name);
                $ex_name = '.'.end($ex_sub);
            }

            $o_info=getimagesize($tmp_name);
	        $mime=explode('/', $o_info['mime']);
	        if ($mime[0]=='image') {
	            $filename=md5_file($tmp_name). $ex_name;
	            $target_file=$target_dir.$filename;
	            if (!is_file($target_file)) {
	                if (move_uploaded_file($tmp_name, $target_file)) {
	                    // $this->resizing($target_file, $_POST['x'], $_POST['y'], $over);
											$this->img_limit_resize($target_file, 6000000);
	                }
	            }
	            return $filename;
	        }
	    }
	    return false;
	}
	function resizing($file, $x, $y=null, $over=false)
	{
	    ini_set('memory_limit', -1);
	    if ($over) {
	        $resize_file=$file;
	    } else {
	        $resize_file=preg_replace('/(web)\/image/i', 'mobile/image', $file);
	    }
	    $o_info=getimagesize($file);
	    $mime=explode('/', $o_info['mime']);
	    switch ($mime[1]) {
	        case 'gif':
	            //gif리사이징 안함
	            // $o_img=imagecreatefromgif($file);
	            break;
	        case 'jpeg':case 'jpg':
	            $o_img=imagecreatefromjpeg($file);
	            $exif=@exif_read_data($file);
	            if (!empty($exif['Orientation'])) {
	                switch ($exif['Orientation']) {
	                    case 8:
	                        $o_img=imagerotate($o_img, 90, 0);
	                        $temp=$o_info[0];
	                        $o_info[0]=$o_info[1];
	                        $o_info[1]=$temp;
	                        break;
	                    case 3:
	                        $o_img=imagerotate($o_img, 180, 0);
	                        break;
	                    case 6:
	                        $o_img=imagerotate($o_img, -90, 0);
	                        $temp=$o_info[0];
	                        $o_info[0]=$o_info[1];
	                        $o_info[1]=$temp;
	                        break;
	                }
	            }
	            break;
	        case 'bmp':case 'wbmp':
	            $o_img=imagecreatefromwbmp($file);
	            break;
	        case 'png':
	            $o_img=imagecreatefrompng($file);
	            break;
	        default:
	            return false;
	            break;
	    }

	    if ($o_img) {
	        $o_x=$o_info[0];
	        $o_y=$o_info[1];
	        if (!$y) {
	            $y=$o_y*($x/$o_x);
	        }
	        if (!($x>=$o_x&&$y>=$o_y)) {
	            $n_img=$this->imageframe($x, $y);
	            imagecopyresampled($n_img, $o_img, 0, 0, 0, 0, $x, $y, $o_x, $o_y);
	            imagepng($n_img, $resize_file);
	            imagedestroy($n_img);
	            $n2_img=$this->imageframe($o_x, $o_y);
	            imagecopy($n2_img, $o_img, 0, 0, 0, 0, $o_x, $o_y);
	            imagepng($n2_img, $file);
	            imagedestroy($n2_img);
	            imagedestroy($o_img);
	        } else {
	            $n2_img=$this->imageframe($o_x, $o_y);
	            imagecopy($n2_img, $o_img, 0, 0, 0, 0, $o_x, $o_y);
	            imagepng($n2_img, $file);
	            imagedestroy($n2_img);
	            imagedestroy($o_img);
	        }
	    }
	}
	function imageframe($x, $y)
	{
	    $canvas=imagecreatetruecolor($x, $y);
	    imagealphablending($canvas, false);
	    imagesavealpha($canvas, true);
	    $transparent = imagecolorallocatealpha($canvas, 255, 255, 255, 127);
	    imagefill($canvas, 0, 0, $transparent);
	    imageinterlace($canvas);
	    return $canvas;
	}

	function uploadFile($tmp_name, $name, $target_dir)
	{
	    if ($tmp_name) {
	        $path=pathinfo($name);
	        $ext=strtolower($path['extension']);
	        if (!preg_match('/(php|css|html|js|htm)/', $ext)) {
	            $filename=md5_file($tmp_name).".".$ext;
	            $target_file=$target_dir.$filename;
	            if (!is_file($target_file)) {
	                move_uploaded_file($tmp_name, $target_file);
	            }
	        }
	        return $filename;
	    }
	    return false;
	}

	function email()
	{
			require "PHPMailer/src/PHPMailer.php";
			require "PHPMailer/src/SMTP.php";
			require "PHPMailer/src/Exception.php";
			$mail = new PHPMailer\PHPMailer\PHPMailer();

			// $mail = $_POST['email'];
			$title = $_POST['title'];
			$text = $_POST['text'];
			$mail->IsSMTP(); // enable SMTP

	    // $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
	    $mail->SMTPAuth = true; // authentication enabled
	    $mail->Username = "sbj710w@gmail.com";
	    $mail->Password = "sbj!@0710";
	    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
	    $mail->Host = "smtp.gmail.com:465";
	    $mail->Port = 465; // or 587
	    $mail->IsHTML(true);
	  	$mail -> setFrom("ssdsd@naver.com");
		  $mail->CharSet = "utf-8";

	    $mail->Subject = $title;
	    $mail->Body = $text;
	    $mail->AddAddress("sbj710w@gmail.com");

			$mail -> SMTPOptions = array(
	       "ssl" => array(
	           "verify_peer" => false
	         , "verify_peer_name" => false
	         , "allow_self_signed" => true
	       )
	   );

	     if(!$mail->Send()) {
			 	return ['return'=>'false','type'=>'sendmail'];
	     } else {
			 	return ['return'=>'true','result'=>true];
	   	}

	}

	function paging($row,$url) {
		$config['base_url'] = $url;
		$config['total_rows'] = $row['count'];
		$config['per_page'] = 10; // 페이지당 표시할 게시물수
		$config['num_links'] = 5; // 표시될 페이지수 / 2 (5면 10개씩 표시됨)
		$config['uri_segment'] = 3;

		$config['full_tag_open'] = "<ul class='pagination pagnations'>";
		$config['full_tag_close'] = '</ul>';

		$config['num_tag_open'] = '<li class = "pages" style="display: inline-block;">';
		$config['num_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active pages" style="display: inline-block;">';
		$config['cur_tag_close'] = '</li>';

		$config['prev_tag_open'] = '<li class = "pages" style="display: inline-block;">';
		$config['prev_tag_close'] = '</li>';

		$config['first_tag_open'] = '<li class = "pages style="display: inline-block;"">';
		$config['first_tag_close'] = '</li>';

		$config['last_tag_open'] = '<li class = "pages" style="display: inline-block;">';
		$config['last_tag_close'] = '</li>';

		$config['prev_link'] = '이전';
		$config['next_link'] = '다음';
		$config['next_tag_open'] = '<li class = "pages" style="display: inline-block;">';
		$config['next_tag_close'] = '</li>';


        if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
		$this->pagination->initialize($config);

		return $data['pagination'] = $this->pagination->create_links();
	}

		function pagings($row,$url) {
			$config['base_url'] = $url;
			$config['total_rows'] = $row['count'];
			$config['per_page'] = 6; // 페이지당 표시할 게시물수
			$config['num_links'] = 5; // 표시될 페이지수 / 2 (5면 10개씩 표시됨)
			$config['uri_segment'] = 3;

			$config['full_tag_open'] = "<ul class='pagination pagnations'>";
			$config['full_tag_close'] = '</ul>';

			$config['num_tag_open'] = '<li class = "pages" style="display: inline-block;">';
			$config['num_tag_close'] = '</li>';

			$config['cur_tag_open'] = '<li class="active pages" style="display: inline-block;">';
			$config['cur_tag_close'] = '</li>';

			$config['prev_tag_open'] = '<li class = "pages" style="display: inline-block;">';
			$config['prev_tag_close'] = '</li>';

			$config['first_tag_open'] = '<li class = "pages style="display: inline-block;"">';
			$config['first_tag_close'] = '</li>';

			$config['last_tag_open'] = '<li class = "pages" style="display: inline-block;">';
			$config['last_tag_close'] = '</li>';

			$config['prev_link'] = '이전';
			$config['next_link'] = '다음';
			$config['next_tag_open'] = '<li class = "pages" style="display: inline-block;">';
			$config['next_tag_close'] = '</li>';


	    if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
	    $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
			$this->pagination->initialize($config);

			return $data['pagination'] = $this->pagination->create_links();
		}

	function nologin() {
		if(!$_SESSION['idx']) {
			header('Location: '.URL.'admin/login');
		    exit;
		}

	}

	//admin
	function adminButton($col) {
		$button = '';
		foreach($col as $row) {
		  switch($row) {
			case '보기' :
				$button .= '<td class="">
				<button type="button" class="btn btn-info adminview">보기</button>
				</td>';
				break;
			case '수정' :
				$button .= '<td class="">
				<button type="button" class="btn btn-primary adminedit">수정</button>
				</td>';
				break;
			case '삭제' :
				$button .= '<td class="">
				<button type="button" class="btn btn-danger admindel">삭제</button>
				</td>';
				break;
		  }
		}
		return $button;
	}
	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}

}
