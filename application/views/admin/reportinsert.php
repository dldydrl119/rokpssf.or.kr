<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <span class="section"><?= $name ?></span>

                        <form class="form-horizontal form-label-left insu">
                            <input type="hidden" name="idx" value="<?= isset($data->idx) ? $data->idx : '' ?>">


                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> 구분 <span class="required"></span></label>
                                <div class="col-md-1 col-sm-6 col-xs-12">2019년</div>
                                <div class="col-md-1 col-sm-6 col-xs-12">2020년</div>
                                <div class="col-md-1 col-sm-6 col-xs-12">2021년</div>
                                <div class="col-md-1 col-sm-6 col-xs-12">계</div>
                                <div class="col-md-1 col-sm-6 col-xs-12">비고</div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rice"> 노숙인 사랑의 쌀 지원사업<span class="required"></span></label>
                                <div class="col-md-1 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 req insure" id="rice_1" name="rice_1" value="<?= isset($data->rice_1) ? $data->rice_1 : '' ?>" required="required">
                                </div>
                                <div class="col-md-1 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 req insure" id="rice_2" name="rice_2" value="<?= isset($data->rice_2) ? $data->rice_2 : '' ?>" required="required">
                                </div>
                                <div class="col-md-1 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 req insure" id="rice_3" name="rice_3" value="<?= isset($data->rice_3) ? $data->rice_3 : '' ?>" required="required">
                                </div>
                                <div class="col-md-1 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 req insure" id="rice_sum" name="rice_sum" value="<?= isset($data->rice_sum) ? $data->rice_sum : '' ?>" required="required">
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 req insure" id="rice_note" name="rice_note" value="<?= isset($data->rice_note) ? $data->rice_note : '' ?>" required="required">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rice"> 장학사업<span class="required"></span></label>
                                <div class="col-md-1 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 req insure" id="scholarship_1" name="scholarship_1" value="<?= isset($data->scholarship_1) ? $data->scholarship_1 : '' ?>" required="required">
                                </div>
                                <div class="col-md-1 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 req insure" id="scholarship_2" name="scholarship_2" value="<?= isset($data->scholarship_2) ? $data->scholarship_2 : '' ?>" required="required">
                                </div>
                                <div class="col-md-1 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 req insure" id="scholarship_3" name="scholarship_3" value="<?= isset($data->scholarship_3) ? $data->scholarship_3 : '' ?>" required="required">
                                </div>
                                <div class="col-md-1 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 req insure" id="scholarship_sum" name="scholarship_sum" value="<?= isset($data->scholarship_sum) ? $data->scholarship_sum : '' ?>" required="required">
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 req insure" id="scholarship_note" name="scholarship_note" value="<?= isset($data->scholarship_note) ? $data->scholarship_note : '' ?>" required="required">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rice"> 긴급의료비 지원사업<span class="required"></span></label>
                                <div class="col-md-1 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 req insure" id="medical_1" name="medical_1" value="<?= isset($data->medical_1) ? $data->medical_1 : '' ?>" required="required">
                                </div>
                                <div class="col-md-1 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 req insure" id="medical_2" name="medical_2" value="<?= isset($data->medical_2) ? $data->medical_2 : '' ?>" required="required">
                                </div>
                                <div class="col-md-1 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 req insure" id="medical_3" name="medical_3" value="<?= isset($data->medical_3) ? $data->medical_3 : '' ?>" required="required">
                                </div>
                                <div class="col-md-1 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 req insure" id="medical_sum" name="medical_sum" value="<?= isset($data->medical_sum) ? $data->medical_sum : '' ?>" required="required">
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 req insure" id="medical_note" name="medical_note" value="<?= isset($data->medical_note) ? $data->medical_note : '' ?>" required="required">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rice"> 저소득 취약계층 지원사업<span class="required">*</span></label>
                                <div class="col-md-1 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 req insure" id="lowincome_1" name="lowincome_1" value="<?= isset($data->lowincome_1) ? $data->lowincome_1 : '' ?>" required="required">
                                </div>
                                <div class="col-md-1 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 req insure" id="lowincome_2" name="lowincome_2" value="<?= isset($data->lowincome_2) ? $data->lowincome_2 : '' ?>" required="required">
                                </div>
                                <div class="col-md-1 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 req insure" id="lowincome_3" name="lowincome_3" value="<?= isset($data->lowincome_3) ? $data->lowincome_3 : '' ?>" required="required">
                                </div>
                                <div class="col-md-1 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 req insure" id="lowincome_sum" name="lowincome_sum" value="<?= isset($data->lowincome_sum) ? $data->lowincome_sum : '' ?>" required="required">
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 req insure" id="lowincome_note" name="lowincome_note" value="<?= isset($data->lowincome_note) ? $data->lowincome_note : '' ?>" required="required">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rice"> 합계 <span class="required">*</span></label>
                                <div class="col-md-1 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 req insure" id="total_1" name="total_1" value="<?= isset($data->total_1) ? $data->total_1 : '' ?>" required="required">
                                </div>
                                <div class="col-md-1 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 req insure" id="total_2" name="total_2" value="<?= isset($data->total_2) ? $data->total_2 : '' ?>" required="required">
                                </div>
                                <div class="col-md-1 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 req insure" id="total_3" name="total_3" value="<?= isset($data->total_3) ? $data->total_3 : '' ?>" required="required">
                                </div>
                                <div class="col-md-1 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 req insure" id="total_sum" name="total_sum" value="<?= isset($data->total_sum) ? $data->total_sum : '' ?>" required="required">
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 req insure" id="total_note" name="total_note" value="<?= isset($data->total_note) ? $data->total_note : '' ?>" required="required">
                                </div>
                            </div>



                            <!-- <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> 금액 <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12 req insure" id="give_money" name="give_money" value="<?= isset($data->give_money) ? $data->give_money : '' ?>" required="required">
                                </div>
                            </div> -->
                       

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <? if (!empty($data)) {
                                        $id = "report_edit";
                                        $text = "수정하기..";
                                    } else {
                                        $id = "report_go";
                                        $text = "등록 하기";
                                    } ?>
                                    <button id="<?= $id ?>" type="button" class="btn btn-success"><?= $text ?></button>
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

<? require_once(APPPATH . "views/admin/admin_footer.php"); ?>

<script src="<?= base_url('assets/js/common.js') ?>?<?= TESTING ?>"></script>
<script src="<?= base_url('assets/js/admin.js') ?>?<?= TESTING ?>"></script>