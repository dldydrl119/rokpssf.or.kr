<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
	<meta name="robots" content="index,follow">

	<meta name="naver-site-verification" content="67a37b6b98c65182ff94db0676316e01927dddb4" />
	<meta name="google-site-verification" content="qT8jCFiLioNPbfh7qIdGjFiD4aFY1DGW4OFuv3ES0Mo" />

	<title>대한민국헌정회 공익재단</title>
	
	<meta name="title" content="대한민국헌정회 공익재단" />
	<meta name="description" content="헌정회 공익재단 소개, 빈곤층 지원 사업, 장학 사업, 치매환자 지원 사업" />
	<meta name="keywords" content="대한민국헌정회 공익재단, 대한민국헌정회, 복지장학재단" />
	<meta name="author" content="대한민국헌정회 공익재단">

	<link href="/assets/images/favicon/favicon.png" rel="shortcut icon" type="image/x-icon">
	<link href="http://rokpssf.or.kr" rel="canonical">

    <!-- SNS -->
	<meta property="og:type" content="website" />
    <meta property="og:title" content="대한민국헌정회 공익재단">
    <meta property="og:site_name" content="대한민국헌정회 공익재단" />
    <meta property="og:description" content="대한민국헌정회 공익재단 홈페이지입니다." />
	<meta property="og:image" content="/assets/images/logo.png"/>
	<meta property="og:url" content="http://rokpssf.or.kr"/>

	<!--네이버웹마스터도구 사이트구조개선코드-->
	<meta name="NaverBot" content="All"/>
	<meta name="NaverBot" content="index,follow"/>
	<meta name="Yeti" content="All"/>
	<meta name="Yeti" content="index,follow"/>

    <link href="/assets/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="/assets/css/reset.css" rel="stylesheet">
    <link href="/assets/css/common.css" rel="stylesheet">

    <?if( $main == true) :?>
        <link href="/assets/css/main.css" rel="stylesheet">
    <?else:?>
        <link href="/assets/css/sub.css" rel="stylesheet">
    <?endif;?>

    <link href="/assets/css/jquery_ui.css" rel="stylesheet">
    <link href="/assets/css/owl.carousel.css" rel="stylesheet">
</head>
<body>
<!-- header -->
<header id="header">
    <div class="container">
        <h1 class="header_logo">
            <a href="/  ">
                <img src="/assets/images/img_header_logo.png" alt="서울시자원봉사센터" />
            </a>
        </h1>
        <nav class="gnb">
            <ul>
                <?foreach ($menu_bar as $key=>$val):?>
                    <li class="dropdown">
                        <a <?if(is_array($sub_menu_all[$key])):?>href="javascript:;"<?else:?>href="<?=$sub_menu_all[$key]?>"<?endif;?> class="border"><?=$val?></a>
                        <?if(is_array($sub_menu_all[$key])) :?>
                        <ul class="dropdown-menu">
                        <?foreach ($sub_menu_all[$key] as $skey=>$sval):?>
                            <li><a href="/<?=$skey?>"><?=$sval?></a></li>
                        <?endforeach;?>
                        </ul>
                        <?endif;?>
                    </li>
                <?endforeach;?>
            </ul>
        </nav>
    </div>
</header>
<!-- //header -->
