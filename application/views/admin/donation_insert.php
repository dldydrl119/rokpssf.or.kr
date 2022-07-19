
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> 이름 <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" class="form-control col-md-7 col-xs-12 req insure" id="name" name="name" value = "<?=isset($data->name)? $data->name : ''?>" required="required">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> 연락처 <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" class="form-control col-md-7 col-xs-12 req insure" id="phon" name="phon" value = "<?=isset($data->phon) ? $data->phon : ''?>" required="required">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> 학교 <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" class="form-control col-md-7 col-xs-12 req insure" id="school" name="school" value = "<?=isset($data->school) ? $data->school : ''?>" required="required">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> 가족 <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" class="form-control col-md-7 col-xs-12 req insure" id="family" name="family" value = "<?=isset($data->family) ? $data->family : ''?>" required="required">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> 비고 </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" class="form-control col-md-7 col-xs-12" id="memo" name="memo" value = "<?=isset($data->memo) ? $data->memo : ''?>" >
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> 지급액 <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" class="form-control col-md-7 col-xs-12 req insure" id="give_money" name="give_money" value = "<?=isset($data->give_money) ? $data->give_money : ''?>" required="required">
                                </div>
                            </div>


                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <?if(!empty($data)) { $id = "donation_edit"; $text = "수정하기"; } else { $id = "donation_go"; $text = "등록하기";}?>
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
