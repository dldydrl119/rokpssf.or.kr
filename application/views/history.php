<!-- container -->
<div id="content">
    <div class="sub_container">
        <div class="sub_banner">
            <div class="cover">
                <h1>연혁</h1>
            </div>
        </div>
        <div class="breadcrumb">
            <a href="#"><i class="fas fa-home"></i></a>
            <i class="far fa-chevron-right"></i>
            <a href="#"><?=$fic_main_menu?></a>
            <i class="far fa-chevron-right"></i>
            <a href="#"><?=$sub_menu[$fic_sub_menu]?></a>
        </div>
        <div class="sub_contents history">
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
                        <div class="details_area">
                            <p class="title">
                                설립과정
                            </p>
                            <ul>
                                <?if(!empty($history)):?>
                                    <?foreach ($history as $value):?>
                                    <li><?=$value->year?>년 <?=$value->memo?></li>
                                    <?endforeach;?>
                                <?else:?>
                                    <li>데이터가 없습니다</li>
                                <?endif;?>
                            </ul>
                        </div>
                        <div class="details_area">
                            <p class="title">
                                장학금 지급 내역
                            </p>
                            <?if(!empty($history_give)):?>
                            <div class="total">
                                    <?
                                    $sum_bur_val=0;
                                    foreach ($history_give as $value){
                                        $sum_bur_val = $sum_bur_val+ str_replace(',','', $value->bur_val);
                                    }?>
                                    <!--<?=date('Y')?>년 -->총 장학금 지급액 <?=number_format($sum_bur_val)?>원 지급
                            </div>
                            <?endif;?>
                            <ul>
                                <?if(!empty($history_give)):?>
                                    <?foreach ($history_give as $value):?>
                                        <li><?=$value->year?>년 <?=$value->memo?> 장학금 <?=number_format(str_replace(',','', $value->bur_val))?>원 지급</li>
                                    <?endforeach;?>
                                <?else:?>
                                    <li>데이터가 없습니다</li>
                                <?endif;?>
                            </ul>
                        </div>
                        <div class="details_area">
                            <p class="title">
                                물품 지원 내역
                            </p>
                            <?if(!empty($history_support)):?>
                            <div class="total">
                                    <?
                                    $sum_bur_val=0;
                                    $sum_rice = 0;
                                    $sum_household = 0;
                                    foreach ($history_support as $value){
                                        $sum_bur_val = $sum_bur_val+ str_replace(',','', $value->bur_val);
                                        $sum_rice = $sum_rice+ str_replace(',','', $value->rice);
                                        $sum_household = $sum_household+ str_replace(',','', $value->household);
                                    }?>
                                    <!--<?=date('Y')?>년 -->총 물품 지원 <!--<?=number_format($sum_household)?>세대 -->쌀 5kg <?=number_format($sum_rice)?>포대 (<?=number_format($sum_bur_val)?>원) 전달
                            </div>
                            <?endif;?>
                            <ul>
                                <?if(!empty($history_support)):?>
                                    <?foreach ($history_support as $value):?>
                                        <li><?=$value->year?>년 <?=$value->memo?> <!--<?=number_format(str_replace(',','', $value->household))?>세대 -->쌀 5kg <?=number_format(str_replace(',','', $value->rice))?>포대 금액 <?=number_format(str_replace(',','', $value->bur_val))?>원 지원</li>
                                    <?endforeach;?>
                                <?else:?>
                                    <li>데이터가 없습니다</li>
                                <?endif;?>
                            </ul>
                        </div>
                        <div class="details_area">
                            <p class="title">
                                성금지원 내역
                            </p>
                            <?if(!empty($history_contribution)):?>
                            <div class="total">
                                    <?
                                    $sum_bur_val=0;
                                    foreach ($history_contribution as $value){
                                        $sum_bur_val = $sum_bur_val+ str_replace(',','', $value->bur_val);
                                    }?>
                                    <!--<?=date('Y')?>년 -->총 성금 <?=number_format($sum_bur_val)?>원 전달
                            </div>
                            <?endif;?>
                            <ul>
                                <?if(!empty($history_contribution)):?>
                                    <?foreach ($history_contribution as $value):?>
                                        <li><?=$value->year?>년 <?=$value->memo?> 성금 <?=number_format(str_replace(',','', $value->bur_val))?>원 지급</li>
                                    <?endforeach;?>
                                <?else:?>
                                    <li>데이터가 없습니다</li>
                                <?endif;?>
                            </ul>
                        </div>
                        <div class="details_area">
                            <p class="title">
                                기부 내역
                            </p>
                            <?if(!empty($history_donate)):?>
                            <div class="total">
                                <?
                                $sum_bur_val=0;
                                foreach ($history_donate as $value){
                                    $sum_bur_val = $sum_bur_val+ str_replace(',','', $value->bur_val);
                                }?>
                                총 후원금 <?=number_format($sum_bur_val)?>원 전달
                            </div>
                            <?endif;?>
                            <ul>
                                <?if(!empty($history_donate)):?>
                                    <?foreach ($history_donate as $value):?>
                                        <li><?=$value->kind?> <?=$value->memo?> 기부금 <?=number_format(str_replace(',','', $value->bur_val))?>원 지급</li>
                                    <?endforeach;?>
                                <?else:?>
                                    <li>데이터가 없습니다</li>
                                <?endif;?>
                            </ul>
                        </div>
                        <div class="details_area">
                            <p class="title">
                                협력 법인
                            </p>
                            <ul>

                                <?if(!empty($history_collabo)):?>
                                    <?foreach ($history_collabo as $value):?>
                                        <li><?=$value->memo?> </li>
                                    <?endforeach;?>
                                <?else:?>
                                    <li>데이터가 없습니다</li>
                                <?endif;?>
                            </ul>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>