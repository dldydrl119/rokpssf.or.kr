
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <span class="section"><?=$name?></span>

                        <form class="form-horizontal form-label-left">
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> 슬라이드 이름 <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12 req" name="name" value="<?=isset($data->slide_name) ? $data->slide_name : ''?>" required="required">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file"> 슬라이드 이미지 <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" id="slideimage" required="required">
                                    <input type = "hidden" class = "req" name="image" value="<?=isset($data->slide_image) ? $data->slide_image : ''?>">
                                    <img src = "<?= isset($data->slide_image)? SURL.'assets/uploads/'.$data->slide_image : ''?>" >
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url"> 클릭 시 링크주소<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="url" name="link" value="<?=isset($data->slide_link) ? $data->slide_link : ''?>" class="form-control col-md-7 col-xs-12 req" required="required">
                                </div>
                            </div>
                            <input type="hidden" name="idx" value="<?=isset($data->slide_idx) ? $data->slide_idx : ''?>">
                            <!--smart에디터 이미지업로드용-->
                            <input type="file" id="imagesUpload" style="display:none;">
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <!-- <button type="submit" class="btn btn-primary">Cancel</button> -->
                                    <?if(isset($data) && !empty($data)) { $id="slideedit"; $text="수정하기"; } else { $id="slidego"; $text="등록하기";}?>
                                    <button id="<?=$id?>" type="button" class="btn btn-success"><?=$text?></button>
                                    <button type="submit" style="display:none;"></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<? require_once(APPPATH."views/admin/admin_footer.php");?>

<script src="<?=base_url('assets/js/common.js')?>?<?=TESTING?>"></script>
<script src="<?=base_url('assets/js/admin.js')?>?<?=TESTING?>"></script>
