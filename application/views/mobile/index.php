<!-- container -->
<div id="content">
    <div class="main_container">
        <div class="main_slide">
            <ul>
                <? if (!empty($slide_data)) : ?>
                    <? foreach ($slide_data as $key => $val) : ?>
                        <li <? if ($key == 0) : ?>class="show" <? endif; ?>>
                            <div class="photo" onclick="location.href='<?= $val->slide_link ?>'">
                                <div style="background-image: url('/assets/uploads/<?= $val->slide_image ?>');"></div>
                            </div>
                            <div class="info">
                                <a href="<?= $val->slide_link ?>">
                                    <p class="summary">[ 대한민국 헌정회 ]</p>
                                    <p class="subject"><?= $val->slide_name ?></p>
                                </a>
                            </div>
                        </li>

                    <? endforeach; ?>
                <? else : ?>
                    <li class="show">
                        <div class="photo">
                            <div style="text-align: center; display: table-cell; vertical-align: middle;">등록된 이미지가 없습니다.</div>
                        </div>

                    </li>
                <? endif; ?>
            </ul>
            <div class="controls">
                <button type="button" class="btn prev" title="이전"></button>
                <button type="button" class="btn control play" title="멈춤"></button>
                <button type="button" class="btn next" title="다음"></button>
            </div>
            <div class="indicator">
                <? if (!empty($slide_data)) : ?>
                    <? foreach ($slide_data as $key => $val) : ?>
                        <span <? if ($key == 0) : ?>class="curr" <? endif; ?>></span>
                    <? endforeach; ?>
                <? endif; ?>
            </div>
        </div>
        <!-- main contents -->
        <div class="main_contents">
            <div class="row_top">
                <div class="board">
                    <ul class="board_tab">
                        <li class="curr"><a href="javascript:;">공지사항</a></li>
                        <li><a href="javascript:;">언론보도</a></li>
                    </ul>
                    <div class="boards">
                        <!-- 공지사항 -->
                        <div class="board_box curr">
                            <ul>
                                <? if (!empty($notice_data)) : ?>
                                    <? foreach ($notice_data as $notice) : ?>
                                        <li>
                                            <a href="/notice-view/<?= $notice->idx ?>">
                                                <p class="subject">[공지] <?= $notice->title ?></p>
                                                <span class="date"><?= date('Y-m-d', strtotime($notice->reg_date)) ?></span>
                                            </a>
                                        </li>
                                    <? endforeach; ?>
                                <? else : ?>
                                    <li>
                                        <a -href="/notice-view/">
                                            <p class="subject">등록된 글이 없습니다.</p>
                                            <span class="date"></span>
                                        </a>
                                    </li>
                                <? endif; ?>

                            </ul>
                        </div>
                        <!-- 언론보도 -->
                        <div class="board_box">
                            <ul>
                                <? if (!empty($press_data)) : ?>
                                    <? foreach ($press_data as $press) : ?>
                                        <li>
                                            <a href="/press-view/<?= $press->idx ?>">
                                                <p class="subject">[보도] <?= $press->title ?></p>
                                                <span class="date"><?= date('Y-m-d', strtotime($press->reg_date)) ?></span>
                                            </a>
                                        </li>
                                    <? endforeach; ?>
                                <? else : ?>
                                    <li>
                                        <a -href="/press-view/">
                                            <p class="subject">등록된 글이 없습니다.</p>
                                            <span class="date"></span>
                                        </a>
                                    </li>
                                <? endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>




                <br>
                <style>
                    table.type11 {
                        border-collapse: collapse;
                        border-spacing: 1px;
                        text-align: center;
                        font-size: 11px;
                        line-height: 1.5;
                        margin: 20px 0px;
                        border: 1px solid #686868;
                    }

                    table.type11 th {
                        width: 155px;
                        padding: 6px;
                        font-weight: bold;
                        vertical-align: middle;
                        color: #fff;
                        background: #153b60;
                    }

                    table.type11 td {
                        width: 155px;
                        padding: 0px;
                        vertical-align: middle;
                        border: 1px solid #ccc;
                        background: #fff;
                    }

                    table.type11 .tr_l td {
                        background-color: #feedd3;
                    }
                </style>
                <table class="type11">
                    <thead>
                        <tr>
                            <th>구분</th>
                            <th>2019년</th>
                            <th>2020년</th>
                            <th>2021년</th>
                            <th>계</th>
                            <th>비고</th>
                        </tr>
                    </thead>
                    <tbody>
                        <? if (!empty($report_data)) : ?>
                            <? foreach ($report_data as $report) : ?>
                                <tr>
                                    <td><?= $report->rice_name ?></td>
                                    <td><?= $report->rice_1 ?></td>
                                    <td><?= $report->rice_2 ?></td>
                                    <td><?= $report->rice_3 ?></td>
                                    <td><?= $report->rice_sum ?></td>
                                    <td><?= $report->rice_note ?></td>
                                </tr>
                                <tr>
                                    <td><?= $report->scholarship_name ?></td>
                                    <td><?= $report->scholarship_1 ?></td>
                                    <td><?= $report->scholarship_2 ?></td>
                                    <td><?= $report->scholarship_3 ?></td>
                                    <td><?= $report->scholarship_sum ?></td>
                                    <td><?= $report->scholarship_note ?></td>
                                </tr>
                                <tr>
                                    <td><?= $report->medical_name ?></td>
                                    <td><?= $report->medical_1 ?></td>
                                    <td><?= $report->medical_2 ?></td>
                                    <td><?= $report->medical_3 ?></td>
                                    <td><?= $report->medical_sum ?></td>
                                    <td><?= $report->medical_note ?></td>
                                </tr>
                                <tr>
                                    <td><?= $report->lowincome_name ?></td>
                                    <td><?= $report->lowincome_1 ?></td>
                                    <td><?= $report->lowincome_2 ?></td>
                                    <td><?= $report->lowincome_3 ?></td>
                                    <td><?= $report->lowincome_sum ?></td>
                                    <td><?= $report->lowincome_note ?></td>
                                </tr>
                                <tr class="tr_l">
                                    <td><?= $report->total_name ?></td>
                                    <td><?= $report->total_1 ?></td>
                                    <td><?= $report->total_2 ?></td>
                                    <td><?= $report->total_3 ?></td>
                                    <td><?= $report->total_sum ?></td>
                                    <td><?= $report->total_note ?></td>
                                </tr>

                            <? endforeach; ?>
                        <? else : ?>
                            <li>
                                <a -href="/press-view/">
                                    <p class="subject">등록된 글이 없습니다.</p>
                                    <span class="date"></span>
                                </a>
                            </li>
                        <? endif; ?>
                    </tbody>
                </table>

                <div class="main_gallery">
                    <div class="gallery_title">
                        <h2>갤러리 / 사진첩</h2>
                        <a href="/gallery" class="btn_more_view">더보기 &gt;</a>
                    </div>
                    <div class="gallery_contents">
                        <? if (!empty($gallery_data)) : ?>
                            <? foreach ($gallery_data as $gallery) : ?>
                                <div class="list">
                                    <a href="/gallery-view/<?= $gallery->idx ?>">
                                        <div class="thumb" style="background-image: url('/assets/uploads/<?= $gallery->thumbnail ?>');"></div>
                                    </a>
                                    <a href="/gallery-view/<?= $gallery->idx ?>"><?= $gallery->title ?></a>
                                    <p><?= date('Y-m-d', strtotime($gallery->reg_date)) ?></p>
                                </div>
                            <? endforeach; ?>
                        <? else : ?>
                            <div class="list">
                                <a -href="/gallery-view/">
                                    <div class="thumb" style="">등록된 갤러리가 없습니다.</div>
                                </a>
                                <p></p>
                            </div>
                        <? endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //container -->

<!-- gov_link -->
<div id="gov_link">
    <div class="owl-carousel gov-carousel">
        <a href="http://www.rokps.or.kr/" target="_blank">
            <img src="/assets/images/footer_banner_00.jpg" alt="">
        </a>
        <a href="https://www.assembly.go.kr/assm/userMain/main.do" target="_blank">
            <img src="/assets/images/footer_banner_01.jpg" alt="">
        </a>
        <a href="https://memorial.assembly.go.kr/mmrl/main/mmrlMain/main.do" target="_blank">
            <img src="/assets/images/footer_banner_02.jpg" alt="">
        </a>
        <a href="https://assembly.webcast.go.kr/" target="_blank">
            <img src="/assets/images/footer_banner_03.jpg" alt="">
        </a>
        <a href="https://www.nanet.go.kr/main.do" target="_blank">
            <img src="/assets/images/footer_banner_04.jpg" alt="">
        </a>
        <a href="https://www.nabo.go.kr/" target="_blank">
            <img src="/assets/images/footer_banner_05.jpg" alt="">
        </a>
        <a href="https://www.natv.go.kr/renew09/brd/index.jsp" target="_blank">
            <img src="/assets/images/footer_banner_06.jpg" alt="">
        </a>
    </div>
</div>
<!-- //gov_link -->