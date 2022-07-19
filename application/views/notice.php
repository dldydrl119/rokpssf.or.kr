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
        <div class="sub_contents notice">
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
                            공지사항
                        </p>
                        <div class="common_list">
                            <table>
                                <colgroup>
                                    <col style="width:10%" />
                                    <col style="width:65%" />
                                    <col style="width:15%" />
                                    <col style="width:10%" />
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>번호</th>
                                    <th>제목</th>
                                    <th>등록일</th>
                                    <th>조회</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?if(!empty($notice)):?>
                                <?foreach($notice as $key => $val):?>
                                <tr>
                                    <td><?=$number?></td>
                                    <td class="subject"><a href="/notice-view/<?=$val->idx?>"><?=$val->title?></a></td>
                                    <td><?=date('Y.m.d', strtotime($val->reg_date))?></td>
                                    <td><?=$val->hit?></td>
                                </tr>
                                <?$number--; endforeach;?>
                                <?else:?>
                                <tr><td colspan="10">데이터가 없습니다.</td></tr>
                                <?endif;?>
                                </tbody>
                            </table>
                            <?=$paging?>
                            <div class="search_area">
                                <form action="/notice" >
                                <div class="category">
                                    <select name="search_kind">
                                        <?foreach($search_terms as$key=> $term):?>
                                            <option value="<?=$key?>" <?if($search_kind == $key) { echo 'selected="selected"';}?>><?=$term?></option>
                                        <?endforeach;?>
                                    </select>
                                </div>
                                <div class="input_box">
                                    <input type="text" id="search_txt" name="search_txt" placeholder="검색어를 입력하세요" value="<?=!empty($search_txt) ? $search_txt :''?>"/>
                                </div>
                                <button type="submit" class="btn_list_search" >검색</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
<!-- //container -->