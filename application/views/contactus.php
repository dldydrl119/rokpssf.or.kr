<!-- container -->
<div id="content">
    <div class="sub_container">
        <div class="sub_banner">
            <div class="cover">
                <h1>오시는 길</h1>
            </div>
        </div>
        <div class="breadcrumb">
            <a href="#"><i class="fas fa-home"></i></a>
            <i class="far fa-chevron-right"></i>
            <a href="#">재단소개</a>
            <i class="far fa-chevron-right"></i>
            <a href="#">오시는 길</a>
        </div>
        <div class="sub_contents contactus">
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
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3164.0174669325015!2d126.91436141558762!3d37.53108553391475!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357c9f268dc3b8b3%3A0xce0084701a8c8e75!2zKOyCrOuLqCnrjIDtlZzrr7zqta3tl4zsoJXtmow!5e0!3m2!1sko!2skr!4v1582710475640!5m2!1sko!2skr" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                        <p>주소 : 서울특별시 영등포구 의사당대로1, 대한민국 헌정회</p>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
<!-- //container -->