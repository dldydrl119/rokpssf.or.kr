<!-- container -->
<div id="content">
    <div class="sub_container">
        <div class="sub_banner">
            <div class="cover">
                <h1>SNS</h1>
            </div>
        </div>
        <div class="breadcrumb">
            <a href="#"><i class="fas fa-home"></i></a>
            <i class="far fa-chevron-right"></i>
            <a href="#">정보마당</a>
            <i class="far fa-chevron-right"></i>
            <a href="#">SNS</a>
        </div>
        <div class="sub_contents sns">
            <div class="left_side">
                <nav class="side_nav">
                    <ul class="nav">
                        <?foreach ($sub_menu as $key=>$val) :?>
                            <li <?if($key==$fic_sub_menu):?>class="curr"<?endif;?>><a href="/<?=$key?>"><?=$val?><?if($key==$fic_sub_menu):?><i class="far fa-chevron-right"></i><?endif;?></a></li>
                        <?endforeach;?>
                    </ul>
                </nav>
            </div>
            <div class="contents">
                <article class="page_cont">
                    <div class="details">
                        <div class="sns_block">
                            <a href="#">
                                <i class="fab fa-facebook-square fb"></i>
                                <p>대한민국헌정회 복지재단</p>
                                <p>페이스북</p>
                            </a>
                        </div>
                        <div class="sns_block">
                            <a href="#">
                                <i class="fab fa-youtube yt"></i>
                                <p>대한민국헌정회 복지재단</p>
                                <p>유튜브</p>
                            </a>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
<!-- //container -->