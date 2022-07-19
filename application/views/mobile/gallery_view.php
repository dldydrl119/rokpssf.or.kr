<!-- container -->
<div id="content">
    <div class="sub_container">
        <div class="sub_banner">
            <div class="cover">
                <h1>갤러리</h1>
            </div>
        </div>
        <div class="breadcrumb">
            <a href="#"><i class="fas fa-home"></i></a>
            <i class="far fa-chevron-right"></i>
            <a href="#"><?=$fic_main_menu?></a>
            <i class="far fa-chevron-right"></i>
            <a href="#"><?=$sub_menu[$fic_sub_menu]?></a>
        </div>
        <div class="sub_contents notice_view">
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
                        <div class="common_view">
                            <table>
                                <colgroup>
                                    <col style="width: 50%;" />
                                    <col style="width: 50%;" />
                                </colgroup>
                                <thead>
                                <tr>
                                    <th colspan="3" class="subject">
                                        <p><?=$gallery->title?></p>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="info">
                                    <td class="left">
                                        <dl>
                                            <dt>조회수 : </dt>
                                            <dd><?=$gallery->hit?></dd>
                                        </dl>
                                    </td>
                                    <td class="right">

                                        <dl>
                                            <dt>등록일 : </dt>
                                            <dd><?=date('Y.m.d', strtotime($gallery->reg_date))?></dd>
                                        </dl>
                                    </td>
                                </tr>
                                <tr class="cont">
                                    <td colspan="2">
                                        <div class="details">
                                            <!-- 이곳에 실제 넘어온 데이터 출력 -->
                                            <?=$gallery->content?>
                                            <!-- //이곳에 실제 넘어온 데이터 출력 -->
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <div class="btn_wrap right">
                                <a href="/gallery" class="btn_list"><i class="fas fa-bars"></i> 목록으로</a>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
<!-- //container -->
