<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <form class="form-horizontal form-label-left form-group news">
                            <span class="section"><?=$name?></span>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> 제목 <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="title" class="form-control col-md-7 col-xs-12 req" name="title" value = "<?=isset($data->title) ? $data->title : ''?>" required="required">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image"> 내용 <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="content" name="content" class="req" required="required"><?=isset($data->content) ? $data->content : ''?></textarea>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image"> 언론사 <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="media_name" class="form-control col-md-7 col-xs-12 req" name="media_name" value = "<?=isset($data->media_name) ? $data->media_name : ''?>" required="required">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image"> 언론사url </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="media_url" class="form-control col-md-7 col-xs-12" name="media_url" value = "<?=isset($data->media_url) ? $data->media_url : ''?>" >
                                </div>
                            </div>


                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file"> 썸네일 이미지 </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" id="thumbnail_image">
                                    <input type = "hidden" name="image" value="<?=isset($data->thumbnail) ? $data->thumbnail : ''?>">
                                    <img src = "<?= isset($data->thumbnail)? SURL.'assets/uploads/'.$data->thumbnail : ''?>" >
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <?if(!empty($data)){ $id = "press_edit"; $text = "수정하기";} else { $id = "press_go"; $text = "등록하기"; }?>
                                    <button type="button" id="<?=$id?>" class="btn btn-success"><?=$text?></button>
                                    <button type="submit" style="display:none;"></button>
                                </div>
                            </div>

                            <input type="hidden" id="idx" name="idx" value="<?=isset($data->idx) ? $data->idx : ''?>">
                            <!--smart에디터 이미지업로드용-->
                            <input type="file" id="imagesUpload" style="display:none;">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<!-- footer content -->
<footer>
    <div class="pull-right">
        Copyright © radon Dr. All rights reserved.
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>


<!-- jQuery -->
<script src="/assets/template/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/assets/template/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="/assets/js/common.js"></script>
<script src="/assets/js/admin.js"></script>
<script src="/assets/template/buildjs/custom.min.js"></script>
<script src="/smarteditor/js/service/HuskyEZCreator.js" charset="utf-8"></script>
<script>
    oEditors = [];
    nhn.husky.EZCreator.createInIFrame({
        oAppRef: oEditors,
        elPlaceHolder: "content",
        sSkinURI: "/smarteditor/SmartEditor2Skin.html",
        fCreator: "createSEditor2"
    });
    $('#imagesUpload').change(function() {
        var json = uploadImage($(this));
        console.log(json);
        if (json) {
            if (json.return == 'true') {
                for (var variable in json.url) {
                    if (json.url.hasOwnProperty(variable)) {
                        if ($('textarea+iframe').length) {
                            var sHTML = "<img style='max-width:100%' src='/assets/uploads/"+json.url[variable]+"' />";
                            oEditors.getById['content'].exec("PASTE_HTML", [sHTML]);
                        }
                    }
                }
                $(this).val('');
            }
        } else {
            alert('서버 에러');
        }
    });
    $('#images').change(function() {
        var json = uploadImage($(this));
        $(this).next().attr('src','/assets/uploads/'+json.url[0]).css('display','block');
        $(this).next().next().val(json.url[0]);

    });
</script>

</body>
</html>
