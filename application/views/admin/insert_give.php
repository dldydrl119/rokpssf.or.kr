
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <span class="section"><?=$name?></span>

                        <form class="form-horizontal form-label-left insu">
                            <input type = "hidden" name = "idx" value = "<?=isset($data->idx) ? $data->idx : ''?>">

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> 성명 <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" class="form-control col-md-7 col-xs-12 req insure" id="name" name="name" value = "<?=isset($data->name)? $data->name : ''?>" required="required">
                                </div>
                            </div>


                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> 학교 <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" class="form-control col-md-7 col-xs-12 req insure" id="associate" name="associate" value = "<?=isset($data->associate) ? $data->associate : ''?>" required="required">
                                </div>
                            </div>


                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> 금액 <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" class="form-control col-md-7 col-xs-12 req insure" id="give_money" name="give_money" value = "<?=isset($data->give_money) ? $data->give_money : ''?>" required="required">
                                </div>
                            </div>


                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <?if(!empty($data)) { $id = "bursary_edit"; $text = "수정하기"; } else { $id = "bursary_go"; $text = "등록하기";}?>
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
