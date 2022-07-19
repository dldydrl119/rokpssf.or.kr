
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


                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> 년도 <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" id="year" class="form-control col-md-7 col-xs-12 req insure" name="year" value = "<?=isset($data->year)? $data->year : ''?>" required="required">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> 장학금 지급 내역 <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" id="memo" class="form-control col-md-7 col-xs-12 req insure" name="memo" value = "<?=isset($data->memo) ? $data->memo : ''?>" required="required">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> 세대 <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" id="household" class="form-control col-md-7 col-xs-12 req insure" name="household" value = "<?=isset($data->household)? $data->household : ''?>" required="required">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> 쌀 <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" id="rice" class="form-control col-md-7 col-xs-12 req insure" name="rice" value = "<?=isset($data->rice)? $data->rice : ''?>" required="required">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> 장학금 <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" id="bur_val" class="form-control col-md-7 col-xs-12 req insure" name="bur_val" value = "<?=isset($data->bur_val)? $data->bur_val : ''?>" required="required">
                                </div>
                            </div>

                            <input type = "hidden" name = "idx" value = "<?=isset($data->idx) ? $data->idx : ''?>">

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <?if(!empty($data)) { $id = "historysupport_edit"; $text = "수정하기"; } else { $id = "historysupport_go"; $text = "등록하기";}?>
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
