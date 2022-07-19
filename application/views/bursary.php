<!-- container -->
<div id="content">
    <div class="sub_container">
        <div class="sub_banner">
            <div class="cover">
                <h1>지원사업 활동내역</h1>
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
                            1. 사랑의 쌀 지원사업
                        </p>
                        <div class="common_list">
                            <table id="donation_table" class="rice">
                                <colgroup>
                                    <col style="width:90%;" />
                                    <col style="width:10%;" />
                                </colgroup>
								<thead>
									<tr>
										<th colspan="2">총 지원금 49,219,500원 (2877세대)</th>
									</tr>
								</thead>
                                <tbody>
									<tr class="donation-tr">
										<td>- 영등포 노숙인 및 쪽방 480세대 쌀 5Kg(696만원) 전달</td>
										<td>2019.09.10</td>
									</tr>
									<tr class="donation-tr">
										<td>- 종로 노숙인 및 쪽방 500세대 쌀 5Kg(725만원) 전달</td>
										<td>2019.12.05</td>
									</tr>
									<tr class="donation-tr">
										<td>- 동대문 노숙인 및 쪽방 300세대 쌀 5Kg(435만원) 전달</td>
										<td>2019.12.06</td>
									</tr>
									<tr class="donation-tr">
										<td>- 제주도 노숙인 및 쪽방 216세대 쌀 5Kg(313만원) 전달</td>
										<td>2019.12.14</td>
									</tr>
									<tr class="donation-tr">
										<td>- 남대문 노숙인 및 쪽방 600세대 쌀 5Kg(870만원) 전달</td>
										<td>2019.12.20</td>
									</tr>
									<tr class="donation-tr">
										<td>- 충청남도 노숙인, 쪽방 및 취약계층 415세대 쌀 5Kg (6,017,500원)전달</td>
										<td>2020.06.01</td>
									</tr>
									<tr class="donation-tr">
										<td>- 헌정회 연금지원 대상자 346명 쌀 10Kg(1210만원) 전달</td>
										<td>2020.08</td>
									</tr>
									<tr class="donation-tr">
										<td>- 북한이탈주민, 다문화가정 각 10가정 20가정에 쌀 10Kg(70만원) 전달</td>
										<td>2020.09</td>
									</tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
					<div class="details">
                        <p class="title">
                            2. 장학금 지원사업
                        </p>
                        <div class="common_list">
                            <table id="donation_table" class="rice">
                                <colgroup>
                                    <col style="width:100%;" />
                                    <col style="width:33.33%;" />
                                    <col style="width:33.33%;" />
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>총 지원금 219,459,000원 (361명)</th>
                                </tr>
                                </thead>
                                <tbody>
									<tr class="donation-tr">
										<td>- 헌법지킴이 장학생 총 115명에게 73,839,000의 장학금을 지급 (2018년 장학사업 1차)</td>
									</tr>
									<tr class="donation-tr">
										<td>- 헌법지킴이 장학생 총 105명에게 80,120,000의 장학금을 지급 (2019년 장학사업 2차)</td>
									</tr>
									<tr class="donation-tr">
										<td>- 북한이탈주민 청소년 5명, 다문화 가정 청소년 5명, 헌법지킴이 장학생 84명에게 도서장학금 4700만원 지급 (2019년 장학사업 3차)</td>
									</tr>
									<tr class="donation-tr">
										<td>- 헌법지킴이 장학생 (송파병 지역, 진주고등학교) 총 20명에게 1000만원 장학금 지급 (2020년 상반기 장학사업 4차)</td>
									</tr>
									<tr class="donation-tr">
										<td>- 헌법지킴이 장학생 (헌정회 관련 6명, 북한이탈주민 5명, 종교단체 추천 6명) 총 17명에게 총 850만원 장학금 지급</td>
									</tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
					<div class="details">
                        <p class="title">
                            3. 지원금 및 성금 전달
                        </p>
                        <div class="common_list">
                            <table id="donation_table" class="rice">
                                <colgroup>
                                    <col style="width:100%;" />
                                    <col style="width:33.33%;" />
                                    <col style="width:33.33%;" />
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>총 지원금 14,000,000원 (3개 자치단체)</th>
                                </tr>
                                </thead>
                                <tbody>
									<tr class="donation-tr">
										<td>- 산불피해를 입은 고성군, 강릉시에 600만원 성금 전달 (2019년 4월 12일)</td>
									</tr>
									<tr class="donation-tr">
										<td>- 헌정회원 3명 지원금 각 100만원씩 총 300만원 전달 (2019년 6월 14일)</td>
									</tr>
									<tr class="donation-tr">
										<td>- 충청남도 코로나 19피해 취약계층 지원을 위한 마스크 2000개 (200만원) 전달 (2020년 6월 1일)</td>
									</tr>
									<tr class="donation-tr">
										<td>- 긴급생계비 지원 300만원</td>
									</tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
					<div class="details">
                        <p class="title">
                            4. 긴급 의료비 지원사업
                        </p>
                        <div class="common_list">
                            <table id="donation_table" class="rice">
                                <colgroup>
                                    <col style="width:100%;" />
                                    <col style="width:33.33%;" />
                                    <col style="width:33.33%;" />
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>총 지원금 5,500,000원</th>
                                </tr>
                                </thead>
                                <tbody>
									<tr class="donation-tr">
										<td>- 북한이탈주민 최혜연 (신장질환) : 의료비 지원 100만원</td>
									</tr>
									<tr class="donation-tr">
										<td>- 부산진구쪽방상담소 박완복 380716 (암수술환자) 의료비 지원 100만원</td>
									</tr>
									<tr class="donation-tr">
										<td>- 서울역쪽방상담소 틀니 지원 2명 100만원</td>
									</tr>
									<tr class="donation-tr">
										<td>- 대구역쪽방상담소 페결핵환자 1명 100만원</td>
									</tr>
									<tr class="donation-tr">
										<td>- 영등포쪽방상담소 틀니 지원 5명 100만원</td>
									</tr>
									<tr class="donation-tr">
										<td>- 강준 북한이탈주민 의료비 지원 50만원</td>
									</tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
					<div class="details">
                        <p class="title">
                            5. 기부내역
                        </p>
                        <div class="common_list">
                            <table id="donation_table" class="rice">
                                <colgroup>
                                    <col style="width:100%;" />
                                    <col style="width:33.33%;" />
                                    <col style="width:33.33%;" />
                                </colgroup>
                                <tbody>
									<tr class="donation-tr">
										<td>- 1% 유산기부자 김병태 헌정회원 (10억 기부약정), 황학수, 비회원 이순주, 유용준</td>
									</tr>
									<tr class="donation-tr">
										<td>- 국창근 헌정회원께서 복지재단에 1000만원 기부</td>
									</tr>
									<tr class="donation-tr">
										<td>- 고진부 헌정회원께서 장학재단에 1000만원 기부</td>
									</tr>
									<tr class="donation-tr">
										<td>- 이상득 헌정회원께서 장학재단에 100만원 기부</td>
									</tr>
									<tr class="donation-tr">
										<td>- 이범관 헌정회원께서 복지재단에 100만원 기부</td>
									</tr>
									<tr class="donation-tr">
										<td>- 유흥수 헌정회원께서 복지재단에 100만원 기부</td>
									</tr>
									<tr class="donation-tr">
										<td>- 한효섭 헌정회원께서 복지재단에 10만원 기부</td>
									</tr>
									<tr class="donation-tr">
										<td>- 김석원 님이 복지재단에 10만원 기부</td>
									</tr>
									<tr class="donation-tr">
										<td>- 김지원 님이 복지재단에 30만원 기부</td>
									</tr>
									<tr class="donation-tr">
										<td>- 이순주 님이 복지재단에 30만원 기부</td>
									</tr>
									<tr class="donation-tr">
										<td>- CMS 후원자 총 176명이 매월 2,390,000원 기부</td>
									</tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </article>
            </div>
			<!--
			<div class="contents">
                <article class="page_cont">
                    <div class="details">
                        <p class="title">
                            장학금 지급 <span>(지금까지 총 100,000,000원 지급)</span>
                        </p>
                        <div class="common_list">
                            <table id="donation_table">
                                <colgroup>
                                    <col style="width:33.33%;" />
                                    <col style="width:33.33%;" />
                                    <col style="width:33.33%;" />
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>성명</th>
                                    <th>학교</th>
                                    <th>금액</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?if(!empty($donation)):?>
                                    <?foreach($donation as $key => $val):?>
                                        <tr class="donation-tr">
                                            <td><?=$val->name?></td>
                                            <td><?=$val->associate?></td>
                                            <td><?=number_format($val->give_money)?></td>
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
                            물품 지금
                        </p>
                        <div class="common_list">
                            <table id="goods_table">
                                <colgroup>
                                    <col style="width:33.33%;" />
                                    <col style="width:33.33%;" />
                                    <col style="width:33.33%;" />
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>성명</th>
                                    <th>단체 및 모임명</th>
                                    <th>금액 및 물품</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?if(!empty($goods)):?>
                                    <?foreach($goods as $key => $val):?>
                                        <tr class="goods-tr">
                                            <td><?=$val->name?></td>
                                            <td><?=$val->associate?></td>
                                            <td><?=number_format($val->give_money)?></td>
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
			-->
        </div>
    </div>
</div>
<!-- //container -->