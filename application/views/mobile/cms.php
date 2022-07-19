<!-- container -->
<div id="content">
    <div class="sub_container">
        <div class="sub_banner">
            <div class="cover">
                <h1>장학금 명단</h1>
            </div>
        </div>
        <div class="breadcrumb">
            <a href="#"><i class="fas fa-home"></i></a>
            <i class="far fa-chevron-right"></i>
            <a href="#"><?=$fic_main_menu?></a>
            <i class="far fa-chevron-right"></i>
            <a href="#"><?=$sub_menu[$fic_sub_menu]?></a>
        </div>
        <div class="sub_contents donation">
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
                        <p class="title">
                            장학금 지급 내역
                        </p>
                        <div class="common_list">
                            <table>
                                <colgroup>
                                    <col style="width:10%;" />
                                    <col style="width:20%;" />
                                    <col style="width:20%;" />
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>성명</th>
                                    <th>총 인원</th>
                                    <th>금액</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?if(!empty($bursary)):?>
                                    <?foreach($bursary as $key => $val):?>
                                        <tr>
                                            <td><?=$val->name?></td>
                                            <td><?=$val->associate?></td>
                                            <td><?=$val->give_money?></td>
                                        </tr>
                                        <?$number--; endforeach;?>
                                <?else:?>
                                    <tr><td colspan="10">데이터가 없습니다.</td></tr>
                                <?endif;?>
                                </tbody>
                            </table>

                            <?=$paging?>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
<!-- //container -->