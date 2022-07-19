
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
        <div class="sub_contents gallery">
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
                            <h2>갤러리 / 사진첩</h2>
                        </div>
                        <div class="gallery_contents">
                            <?if(!empty($gallery)):?>
                                <?foreach($gallery as $key => $val):?>
                                    <div class="list">
                                        <a href="/gallery-view/<?=$val->idx?>">
                                            <div class="thumb" style="background-image: url('/assets/uploads/<?=$val->thumbnail?>');"></div>
                                        </a>
                                        <a href="/gallery-view/<?=$val->idx?>"><?=$val->title?></a>
                                        <p><?=date('Y.m.d', strtotime($val->reg_date))?></p>
                                    </div>
                                <?endforeach;?>
                            <?else:?>

                            <?endif;?>
                        </div>
                        <div class="common_list">
                            <?=$paging?>
                            <div class="search_area">
                                <form action="/gallery" >
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
