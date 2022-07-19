<!-- container -->
<div id="content">
    <div class="sub_container">
        <div class="sub_banner">
            <div class="cover">
                <h1>기부자 명단</h1>
            </div>
        </div>
        <div class="breadcrumb">
            <a href="#"><i class="fas fa-home"></i></a>
            <i class="far fa-chevron-right"></i>
            <a href="#">장학금 · 기부자 명단</a>
            <i class="far fa-chevron-right"></i>
            <a href="#">기부자 명단</a>
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
                            1. 장학금 지급 내역
                        </p>
                        <div class="common_list">
                            <table id="donation_table">
                                <colgroup>
                                    <col style="width:20%;" />
                                    <col style="width:20%;" />
                                    <col style="width:20%;" />
                                    <col style="width:20%;" />
                                    <col style="width:20%;" />
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>구분</th>
                                    <th>성명</th>
                                    <th>학교</th>
                                    <th>지급액</th>
                                    <th>비고</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?if(!empty($donation)):?>
                                    <?foreach($donation as $key => $val):?>
                                        <tr class="donation-tr">
                                            <td><?=$donation_number?></td>
                                            <td><?=$val->name?></td>
                                            <td><?=$val->school?></td>
                                            <td><?=$val->give_money?></td>
                                            <td><?=$val->memo?></td>
                                            <td></td>
                                        </tr>
                                    <?$donation_number--; endforeach;?>
                                <?else:?>
                                    <tr><td colspan="10">데이터가 없습니다.</td></tr>
                                <?endif;?>
                                </tbody>
                            </table>
                            <div id="donation_paging"><?=$donation_page?></div>

                        </div>
                    </div>
                    <div class="details">
                        <p class="title">
                            2. 물품 지원 내역
                        </p>
                        <div class="common_list">
                            <table id="goods_table">
                                <colgroup>
                                    <col style="width:20%;" />
                                    <col style="width:20%;" />
                                    <col style="width:20%;" />
                                    <col style="width:20%;" />
                                    <col style="width:20%;" />
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>구분</th>
                                    <th>성명</th>
                                    <th>연락처</th>
                                    <th>지원 물품</th>
                                    <th>비고</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?if(!empty($goods)):?>
                                    <?foreach($goods as $key => $val):?>
                                        <tr class="goods-tr">
                                            <td><?=$goods_number?></td>
                                            <td><?=$val->name?></td>
                                            <td><?=$val->phon?></td>
                                            <td><?=$val->goods?> <?=$val->goods_count?></td>
                                            <td><?=$val->memo?></td>
                                        </tr>
                                        <?$goods_number--; endforeach;?>
                                <?else:?>
                                    <tr><td colspan="10">데이터가 없습니다.</td></tr>
                                <?endif;?>
                                </tbody>
                            </table>
                            <div id="goods_paging"><?=$goods_page?></div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
<!-- //container -->