<!-- page content -->
<div class="right_col" role="main">
    <div class="">

    <div class="clearfix"></div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3><?=$name?></h3>
                    <?if($insert && count($list) <= 4) :?>
                        <a href = "<?=$insert?>"><button type="button" class="btn btn-info" >등록하기</button></a>
                    <?endif;?>
                          <button type="button" id="idxgo" class="btn btn-primary" data-page="<?=$page?>" data-url="/admin/slideIdxsUpdate" data-count="/admin/slide-count">순서 저장하기</button></a>
                    <div class="clearfix"></div>
                </div>

                <form>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr class="headings">
                                    <?foreach($col as $row) {?>
                                        <th class="column-title"> <?=$row?> </th>
                                    <?}?>
                                    </tr>
                                </thead>
                                <tbody>
                                <?if(empty($pre_one)):?>

                                <?else:?>

                                    <?foreach ($pre_one as $key => $data):?>
                                        <tr class="even pointer" data-idx="<?=$data->idx?>" style="display: none;">
                                            <?$i=0; foreach ($data as $subkey => $value):?>
                                                <?if($i == 1):?>
                                                    <td> <button type="button" class="btn up"><i class="fa fa-caret-up"></i></button> <button type="button" class="btn down"><i class="fa fa-caret-down"></i></button> </td>
                                                <?endif;?>

                                                <?if(strpos($subkey,'idx') === false):?>
                                                    <td class=""><?=$value?></td>
                                                <?endif;?>
                                                <?$i++ ; endforeach;?>
                                            <?=$adminbutton?>
                                        </tr>
                                    <?endforeach;?>

                                <?endif;?>

                                <?if(empty($list)):?>

                                <?else:?>

                                    <?foreach ($list as $key => $data):?>
                                    <tr class="even pointer" data-idx="<?=$data->slide_idx?>">
                                        <?$i=0; foreach ($data as $subkey => $value):?>
                                            <?if($i == 2):?>
                                                <td> <button type="button" class="btn up"><i class="fa fa-caret-up"></i></button> <button type="button" class="btn down"><i class="fa fa-caret-down"></i></button> </td>
                                            <?endif;?>

                                            <?if(strpos($subkey,'idx') === false):?>
                                                <?if(strpos($subkey,'image') !== false):?>
                                                    <td class=" "><img src="<?=SURL?>/assets/uploads/<?=$value?>" style="width : 230px;"></td>
                                                <?else:?>
                                                    <td class=" "><?=$value?></td>
                                                <?endif;?>
                                            <?endif;?>
                                        <?$i++ ; endforeach;?>
                                        <?=$adminbutton?>
                                    </tr>
                                    <?endforeach;?>

                                <?endif;?>

                                <?if(empty($next_one)):?>

                                <?else:?>

                                    <?foreach ($next_one as $key => $data):?>
                                        <tr class="even pointer" data-idx="<?=$data->idx?>" style="display: none;">
                                            <?$i=0; foreach ($data as $subkey => $value):?>
                                                <?if($i == 1):?>
                                                    <td> <button type="button" class="btn up"><i class="fa fa-caret-up"></i></button> <button type="button" class="btn down"><i class="fa fa-caret-down"></i></button> </td>
                                                <?endif;?>

                                                <?if(strpos($subkey,'idx') === false):?>
                                                    <td class=""><?=$value?></td>
                                                <?endif;?>
                                                <?$i++ ; endforeach;?>
                                            <?=$adminbutton?>
                                        </tr>
                                    <?endforeach;?>

                                <?endif;?>
                                </tbody>


                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

  <div style="margin-top: 20px; text-align: center;">
    <? echo $this->pagination->create_links(); ?>
  </div>
</div>
<!-- /page content -->

<? require_once(APPPATH."views/admin/admin_footer.php");?>
<script src="<?=base_url('assets/js/common.js')?>"></script>
<script src="<?=base_url('assets/js/admin.js')?>"></script>

<script>

    $('body').on('click', '.adminedit', function() {
        var idx = $(this).parent().parent().attr('data-idx');
        location.href = '/admin/slideedit/'+idx;
    });
    $('body').on('click', '.admindel', function() {
        var con = confirm("정말 삭제하시겠습니까?");
        if(con) {
            var idx = $(this).parent().parent().attr('data-idx');
            var result = jsonreturn('/admin/slidedel/'+idx);
            if(result.return == true) {
                alert("삭제되었습니다");
                location.reload();
            }
        }
    });
</script>
