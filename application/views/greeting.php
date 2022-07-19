<!-- container -->
<div id="content">
    <div class="sub_container">
        <div class="sub_banner">
            <div class="cover">
                <h1>이사장 인사말</h1>
            </div>
        </div>
        <div class="breadcrumb">
            <a href="#"><i class="fas fa-home"></i></a>
            <i class="far fa-chevron-right"></i>
            <a href="#"><?=$fic_main_menu?></a>
            <i class="far fa-chevron-right"></i>
            <a href="#"><?=$sub_menu[$fic_sub_menu]?></a>
        </div>
        <div class="sub_contents greeting">
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
                        <div class="left">
                            <img src="/assets/images/sub/img_greeting.jpg" alt="대한민국헌정회 공익재단 이사장 김병태" class="photo">
                            <p>대한민국헌정회 공익재단</p>
                            <p>이사장 <b>김병태</b></p>
                        </div>
                        <div class="right">
                            <p class="title">
                                안녕하십니까?<br>
                                저는 대한민국 헌정회 공익재단 이사장 김병태입니다.
                            </p>
                            <p class="cont">
                                어려운 가정 환경 하에서도 약학대학을 마치고 약국을 개업하고 제약회사에 취직하여 더블잡을
                                해가며 한올바이오파마㈜, 한올파이넨스에너지㈜를 창업하였습니다.<br><br>
                                그동안의 과정에는 많은 어려움과 고난이 있었지만 오늘날이 있기 까지는 부모님의 기도와 사랑,
                                고비 마다 저를 도와 주셨던 주위의 많은분들 그리고 하나님의 인도하심이 계셨기 때문에
                                오늘날의 제가 있다는 생각이 듭니다.<br><br>
                                저는 제가 받은 과분한 사랑을 받은 만큼 사회에 돌려주기 위하여 2003년부터 어려운 환경에서도 열심히 공부하기를 원하는 청소년들을 위한 장학사업을 해왔습니다.<br><br>
                                특히 2010년에는 영자와 병태 바보들의 행진 장학재단을 설립하여 지금까지 운영해 오고 있습니다.<br><br>
                                하지만 저는 이에 만족하지 않고 기존의 장학재단을 더 크게 확장하고 많은 사회지도층들의 참여를 위하여 “대한민국 헌정회 공익재단”으로 다시 태어났습니다.<br><br>
                                뜻이 있는 많은 분들의 아낌없는 참여와 성원을 기대하며 이 모든 일들에 하나님의 은혜와 사랑이 넘치기를 기도합니다.<br><br>
                                앞으로도 대한민국헌정회 공익재단은 헌정회원님들의 뜻을 모아 쪽방촌 거주민, 노숙인등 사회적으로 어려운 형제들의 눈물을 닦아주고 또한 장차 대한민국을 이끌 인재들에게 장학금을 지급하는 사업을 진행하도록 하겠습니다.<br><br>
                            </p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
<!-- //container -->