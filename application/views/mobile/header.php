<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">

	<link href="/assets/images/favicon/favicon.png" rel="shortcut icon" type="image/x-icon">

    <meta property="og:type" content="website" />
    <meta property="og:title" content="대한민국헌정회 복지장학재단">
    <meta property="og:site_name" content="대한민국헌정회 복지장학재단" />
    <meta property="og:title" content="대한민국헌정회 복지장학재단" />
    <meta property="og:description" content="대한민국헌정회 복지장학재단 홈페이지입니다." />

    <title>대한민국헌정회 복지장학재단</title>

    <link href="/assets/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="/assets/css/reset.css" rel="stylesheet">
    <link href="/assets/css/m_common.css" rel="stylesheet">
    <?if( $main == true) :?>
        <link href="/assets/css/m_main.css" rel="stylesheet">
    <?else:?>
        <link href="/assets/css/m_sub.css" rel="stylesheet">
    <?endif;?>
    <link href="/assets/css/jquery_ui.css" rel="stylesheet">
    <link href="/assets/css/owl.carousel.css" rel="stylesheet">
</head>
<body>
<!-- header -->
<header id="header">
    <div class="container">
        <h1 class="header_logo">
            <a href="/">
                <img src="/assets/images/img_header_logo.png" />
            </a>
        </h1>
        <nav class="gnb">
            <div class="nav-mobile">
                <a id="nav-toggle" href="#"><span></span></a>
            </div>
            <ul>

                <?foreach ($menu_bar as $key=>$val):?>
                    <li cl>
                        <a <?if(is_array($sub_menu_all[$key])):?>href="javascript:;"<?else:?>href="<?=$sub_menu_all[$key]?>"<?endif;?> class="border"><?=$val?></a>
                        <?if(is_array($sub_menu_all[$key])) :?>
                            <ul class="nav-dropdown">
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
