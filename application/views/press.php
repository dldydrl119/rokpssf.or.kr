<!-- container -->
<div id="content">
    <div class="sub_container">
        <div class="sub_banner">
            <div class="cover">
                <h1>언론보도</h1>
            </div>
        </div>
        <div class="breadcrumb">
            <a href="#"><i class="fas fa-home"></i></a>
            <i class="far fa-chevron-right"></i>
            <a href="#"><?=$fic_main_menu?></a>
            <i class="far fa-chevron-right"></i>
            <a href="#"><?=$sub_menu[$fic_sub_menu]?></a>
        </div>
        <div class="sub_contents news">
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
                        <div class="gallery_title">
                            <h2>언론보도</h2>
                        </div>
                        <div class="gallery_contents">
                            <?if(!empty($press)):?>
                                <?foreach($press as $key => $val):?>
                                    <div class="list">
                                        <a href="/press-view/<?=$val->idx?>">
                                            <div class="thumb" style="background-image: url(<?=$val->thumbnail ? '/assets/uploads/'.$val->thumbnail : '/assets/images/xbox.jpg'?>);"></div>
                                        </a>
                                        <a href="/press-view/<?=$val->idx?>"><?=$val->title?></a>
                                        <p><?=$val->media_name?></p>
                                        <p><?=date('Y.m.d', strtotime($val->reg_date))?></p>
                                    </div>
                                <?endforeach;?>
                            <?else:?>
                                <div class="list">
                                    <a -href="/press-view/">
                                        <div class="thumb" -style="background-image: url('/assets/uploads/');" >데이터가 없습니다.</div>
                                    </a>
                                    <a -href="/press-view/"></a>
                                    <p></p>
                                    <p></p>
                                </div>
                            <?endif;?>

                        </div>
                        <div class="common_list">
                            <?=$paging?>

                            <div class="search_area">
                                <form action="/press" >
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