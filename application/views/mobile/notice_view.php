<!-- container -->
<div id="content">
    <div class="sub_container">
        <div class="sub_banner">
            <div class="cover">
                <h1>공지사항</h1>
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
                                        <p><?=$notice->title?></p>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="info">
                                    <td class="left">
                                        <dl>
                                            <dt>조회수 : </dt>
                                            <dd><?=$notice->hit?></dd>
                                        </dl>
                                    </td>
                                    <td class="right">

                                        <dl>
                                            <dt>등록일 : </dt>
                                            <dd><?=date('Y.m.d', strtotime($notice->reg_date))?></dd>
                                        </dl>
                                    </td>
                                </tr>
                                <tr class="cont">
                                    <td colspan="2">
                                        <div class="details" style="text-align: center;">
                                            <!-- 이곳에 실제 넘어온 데이터 출력 -->
                                            <?=$notice->content?>
                                            <!-- //이곳에 실제 넘어온 데이터 출력 -->
                                        </div>
                                        <?if($notice->up_file1 || $notice->up_file2 || $notice->up_file3):?>
                                        <div class="attach_files">
                                            <strong>첨부파일 : </strong>
                                            <ul>
                                                <?for($i=1; $i<=5; $i++) :?>
                                                    <?if($notice->{'up_file'.$i}):?>
                                                        <li><a href="/assets/uploads/file/<?=$notice->{'up_file'.$i}?>"><?=$notice->{'up_file'.$i}?></a></li>

                                                    <?endif;?>
                                                <?endfor;?>
                                            </ul>
                                        </div>
                                        <?endif;?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <div class="btn_wrap right">
                                <a href="/notice" class="btn_list"><i class="fas fa-bars"></i> 목록으로</a>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
<!-- //container -->