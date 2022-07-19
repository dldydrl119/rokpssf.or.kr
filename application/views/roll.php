<!-- container -->
<div id="content">
    <div class="sub_container">
        <div class="sub_banner">
            <div class="cover">
                <h1>기부자 및 후원자 명단</h1>
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
                            1% 기부자 명단
                        </p>
                        <div class="common_list">
                            <table id="oneper_table">
                                <colgroup>
                                    <col style="width:33.33%;" />
                                    <col style="width:33.33%;" />
                                    <col style="width:33.33%;" />
                                </colgroup>
                                <thead>
                                <tr>
                                    <!--<th>구분</th>-->
                                    <th>성명</th>
                                    <th>금액</th>
                                    <th>비고</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?if(!empty($donation)):?>
                                    <?foreach($donation as $key => $val):?>
                                        <tr class="oneper-tr">
                                            <!--<td><?=$donation_number?></td>-->
                                            <td><?=$val->name?></td>
                                            <td><?=$val->give_money?></td>
											<!--<td><?=number_format($val->give_money)?>원</td>-->
                                            <td><?=$val->memo?></td>
                                        </tr>
                                        <?$donation_number--; endforeach;?>
                                <?else:?>
                                    <tr><td colspan="10">데이터가 없습니다.</td></tr>
                                <?endif;?>
                                </tbody>
                            </table>
                            <div id="oneper_paging"><?=$donation_page?></div>

                        </div>
                    </div>
                    <div class="details">
                        <p class="title">
                            물품기부 및 후원자 명단
                        </p>
                        <div class="common_list">
                            <table id="roll_table">
                                <colgroup>
                                    <col style="width:33.33%;" />
                                    <col style="width:33.33%;" />
                                    <col style="width:33.33%;" />
                                </colgroup>
                                <thead>
                                <tr>
                                    <!--<th>구분</th>-->
                                    <th>성명</th>
                                    <th>금액</th>
                                    <th>비고</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?if(!empty($goods)):?>
                                    <?foreach($goods as $key => $val):?>
                                        <tr class="roll-tr">
                                            <!--<td><?=$donation_number?></td>-->
                                            <td><?=$val->name?></td>
                                            <td><?=number_format($val->give_money)?>원</td>
                                            <td><?=$val->memo?></td>
                                        </tr>
                                        <?$goods_number--; endforeach;?>
                                <?else:?>
                                    <tr><td colspan="10">데이터가 없습니다.</td></tr>
                                <?endif;?>
                                </tbody>
                            </table>
                            <div id="roll_paging"><?=$goods_page?></div>
                        </div>
                    </div>
                </article>
            </div>


        </div>
    </div>
</div>
<!-- //container -->