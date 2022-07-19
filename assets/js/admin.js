$(document).ready(function(){
    function admin() {
        editor = function() {
            $('#imagesUpload').change(function() {
                var json = uploadImage($(this));
                if (json) {
                    if (json.return == 'true') {
                        for (var variable in json.url) {
                            if (json.url.hasOwnProperty(variable)) {
                                if ($('textarea+iframe').length) {
                                    var sHTML = "<img style='max-width:100%' src='/assets/uploads/"+json.url[variable]+"' />";
                                    oEditors.getById["content"].exec("PASTE_HTML", [sHTML]);
                                } else {
                                    $img = common.target.clone();
                                    $img.removeClass('req def').attr('src', json.path + json.url[variable]);
                                    $img.appendTo(common.target.parent()).after('<input type="hidden" name="' + $img.attr('id').replace(/[0-9]/g, '') + '[]" value="' + json.url[variable] + '">');
                                    common.target=false;
                                }
                            }
                        }
                        $(this).val('');
                    }
                } else {
                    alert('서버 에러');
                }
            });
        }
        this.slide = function() {
            $('body').on('click', '#slidego, #slideedit', function() {
                var check = true;
                $('.req').each(function() {
                    if (!$(this).val()) {
                        check = false;
                        return false;
                    }
                });
                if(check) {
                    var form = $('form')[0];
                    var data = new FormData(form);
                    if($(this).attr('id') == "slidego"){
                        var json = jsonreturn('/admin/slideinsertData',data);
                        if(json.return == true) {
                            alert("등록되었습니다");
                            location.href = "/admin/slideList";
                        }
                    }
                    else {
                        var json = jsonreturn('/admin/slideUpdate',data);
                        if(json.return == true) {
                            alert("수정되었습니다");
                            // location.reload();
                            location.href = "/admin/slideList";
                        }
                    }
                }
                else {
                    $(this).next().trigger('click');
                }
            });
            $('body').on('click', '.up', function() {
                var $tr = $(this).parent().parent(); // 클릭한 버튼이 속한 tr 요소
                if(!$tr.prev().is(':visible') && $tr.prev().length > 0) {
                    $tr.prev().show();
                    $tr.hide();
                }
                $tr.prev().before($tr); // 현재 tr 의 이전 tr 앞에 선택한 tr 넣기
            });

            $('body').on('click', '.down', function() {
                var $tr = $(this).parent().parent(); // 클릭한 버튼이 속한 tr 요소

                if(!$tr.next().is(':visible') && $tr.next().length >0) {
                    $tr.next().show();
                    $tr.hide();
                }
                $tr.next().after($tr); // 현재 tr 의 이전 tr 앞에 선택한 tr 넣기

            });

            $('body').on('click', '#idxgo', function() {
                var result =json($(this).attr('data-count'));
                var page = $(this).attr('data-page');
                var idxs = new Array();
                var idx = new Array();

                var i;
                if(page*10 > 10){
                    if((result*1)/(10*(page-1)) > 1) {
                        i = result - (page-1)*10;
                    }
                    else {
                        i = result%((page-1)*10);
                    }
                } else {
                    i =result;
                }
                $(".pointer").each(function() {
                    idxs.push(i);
                    idx.push($(this).attr('data-idx'));
                    i--;
                });
                var url = $(this).attr('data-url');
                var result =json(url,{'idxs':idxs,'idx':idx});
                location.reload();
            });

            $('body').on('change', '#slideimage, #thumbnail_image', function() {
                var json = uploadImage($(this));
                $(this).next().val(json.url[0]);
                $(this).next().next().css('display','block');
                $(this).next().next().attr('src','/assets/uploads/'+json.url[0]);
            });

        }

        this.history = function() {
            $('body').on('click', '#history_go, #history_edit', function() {
                var check = true;
                $('.req').each(function() {
                    if (!$(this).val()) {
                        check = false;
                        return false;
                    }
                });
                if(check) {
                    var form = $('form')[0];
                    var data = new FormData(form);
                    if($(this).attr('id') == "history_go"){
                        var json = jsonreturn('/admin/history-insert',data);
                        if(json.return == true) {
                            alert("등록되었습니다");
                            location.href = "/admin/history-menu";
                        }
                    }
                    else {
                        var json = jsonreturn('/admin/history-update',data);
                        if(json.return == true) {
                            alert("수정되었습니다");
                            location.href = "/admin/history-menu";
                        }
                    }
                }
                else {
                    $(this).next().trigger('click');
                }
            });

            $('body').on('change', '#product_thumb', function() {
                var json = uploadImage($(this));
                $(this).next().val(json.url[0]);
                $(this).next().next().css('display','block');
                $(this).next().next().attr('src','/assets/uploads/'+json.url[0]);
            });

        }

        this.historygive = function() {
            $('body').on('click', '#historygive_go, #historygive_edit', function() {
                var check = true;
                $('.req').each(function() {
                    if (!$(this).val()) {
                        check = false;
                        return false;
                    }
                });
                if(check) {
                    var form = $('form')[0];
                    var data = new FormData(form);
                    if($(this).attr('id') == "historygive_go"){
                        var json = jsonreturn('/admin/history-give-addInsert',data);
                        if(json.return == true) {
                            alert("등록되었습니다");
                            location.href = "/admin/history-give";
                        }
                    }
                    else {
                        var json = jsonreturn('/admin/history-give-editdata',data);
                        if(json.return == true) {
                            alert("수정되었습니다");
                            location.href = "/admin/history-give";
                        }
                    }
                }
                else {
                    $(this).next().trigger('click');
                }
            });

        }

        this.history_support = function() {
            $('body').on('click', '#historysupport_go, #historysupport_edit', function() {
                var check = true;
                $('.req').each(function() {
                    if (!$(this).val()) {
                        check = false;
                        return false;
                    }
                });
                if(check) {
                    var form = $('form')[0];
                    var data = new FormData(form);
                    if($(this).attr('id') == "historysupport_go"){
                        var json = jsonreturn('/admin/history-support-addInsert',data);
                        if(json.return == true) {
                            alert("등록되었습니다");
                            location.href = "/admin/history-support";
                        }
                    }
                    else {
                        var json = jsonreturn('/admin/history-support-editdata',data);
                        if(json.return == true) {
                            alert("수정되었습니다");
                            location.href = "/admin/history-support";
                        }
                    }
                }
                else {
                    $(this).next().trigger('click');
                }
            });

        }

        this.history_contribution = function() {
            $('body').on('click', '#historycontribution_go, #historycontribution_edit', function() {
                var check = true;
                $('.req').each(function() {
                    if (!$(this).val()) {
                        check = false;
                        return false;
                    }
                });
                if(check) {
                    var form = $('form')[0];
                    var data = new FormData(form);
                    if($(this).attr('id') == "historycontribution_go"){
                        var json = jsonreturn('/admin/history-contribution-addInsert',data);
                        if(json.return == true) {
                            alert("등록되었습니다");
                            location.href = "/admin/history-contribution";
                        }
                    }
                    else {
                        var json = jsonreturn('/admin/history-contribution-editdata',data);
                        if(json.return == true) {
                            alert("수정되었습니다");
                            location.href = "/admin/history-contribution";
                        }
                    }
                }
                else {
                    $(this).next().trigger('click');
                }
            });



        }

        this.history_donate = function() {
            $('body').on('click', '#historydonate_go, #historydonate_edit', function () {
                var check = true;
                $('.req').each(function () {
                    if (!$(this).val()) {
                        check = false;
                        return false;
                    }
                });
                if (check) {
                    var form = $('form')[0];
                    var data = new FormData(form);
                    if ($(this).attr('id') == "historydonate_go") {
                        var json = jsonreturn('/admin/history-donate-addInsert', data);
                        if (json.return == true) {
                            alert("등록되었습니다");
                            location.href = "/admin/history-donate";
                        }
                    } else {
                        var json = jsonreturn('/admin/history-donate-editdata', data);
                        if (json.return == true) {
                            alert("수정되었습니다");
                            location.href = "/admin/history-donate";
                        }
                    }
                } else {
                    $(this).next().trigger('click');
                }
            });
        }

        this.history_collabo = function() {
            $('body').on('click', '#historycollabo_go, #historycollabo_edit', function () {
                var check = true;
                $('.req').each(function () {
                    if (!$(this).val()) {
                        check = false;
                        return false;
                    }
                });
                if (check) {
                    var form = $('form')[0];
                    var data = new FormData(form);
                    if ($(this).attr('id') == "historycollabo_go") {
                        var json = jsonreturn('/admin/history-collabo-addInsert', data);
                        if (json.return == true) {
                            alert("등록되었습니다");
                            location.href = "/admin/history-collabo";
                        }
                    } else {
                        var json = jsonreturn('/admin/history-collabo-editdata', data);
                        if (json.return == true) {
                            alert("수정되었습니다");
                            location.href = "/admin/history-collabo";
                        }
                    }
                } else {
                    $(this).next().trigger('click');
                }
            });
        }





        this.report = function() {
            $('body').on('click', '#report_go, #report_edit', function() {
                // oEditors.getById["news_text"].exec("UPDATE_CONTENTS_FIELD", []);
                var check = true;
                $('.req').each(function() {
                    if (!$(this).val()) {
                        check = false;
                        return false;
                    }
                });
                if(check) {
                    var form = $('form')[0];
                    var data = new FormData(form);
                    if($(this).attr('id') == "report_go"){
                        var json = jsonreturn('/admin/report-add-data',data);
                        if(json.return == true) {
                            alert("등록되었습니다");
                            location.href = "/admin/reportList";
                        }
                    }
                    else {
                        var json = jsonreturn('/admin/reportUpdateData',data);
                        if(json.return == true) {
                            alert("수정되었습니다");
                            location.href = "/admin/reportList";
                        }
                    }
                }
                else {
                    $(this).next().trigger('click');
                }
            });
        }











        this.bursary = function() {
            $('body').on('click', '#bursary_edit, #bursary_go', function() {
                // oEditors.getById["news_text"].exec("UPDATE_CONTENTS_FIELD", []);
                var check = true;
                $('.req').each(function() {
                    if (!$(this).val()) {
                        check = false;
                        return false;
                    }
                });
                if(check) {
                    var form = $('form')[0];
                    var data = new FormData(form);
                    if($(this).attr('id') == "bursary_go"){
                        var json = jsonreturn('/admin/give-add-data',data);
                        if(json.return == true) {
                            alert("등록되었습니다");
                            location.href = "/admin/bursary-give";
                        }
                    }
                    else {
                        var json = jsonreturn('/admin/bursary-give-update',data);
                        if(json.return == true) {
                            alert("수정되었습니다");
                            location.href = "/admin/bursary-give";
                        }
                    }
                }
                else {
                    $(this).next().trigger('click');
                }
            });
        }


        this.donation = function() {
            $('body').on('click', '#donation_edit, #donation_go', function() {
                // oEditors.getById["news_text"].exec("UPDATE_CONTENTS_FIELD", []);
                var check = true;
                $('.req').each(function() {
                    if (!$(this).val()) {
                        check = false;
                        return false;
                    }
                });
                if(check) {
                    var form = $('form')[0];
                    var data = new FormData(form);
                    if($(this).attr('id') == "donation_go"){
                        var json = jsonreturn('/admin/donation-add-data',data);
                        if(json.return == true) {
                            alert("등록되었습니다");
                            location.href = "/admin/bursary-donation";
                        }
                    }
                    else {
                        var json = jsonreturn('/admin/donation-update',data);
                        if(json.return == true) {
                            alert("수정되었습니다");
                            location.href = "/admin/bursary-donation";
                        }
                    }
                }
                else {
                    $(this).next().trigger('click');
                }
            });
        }
        this.goods = function() {
            $('body').on('click', '#goods_go, #goods_edit', function() {
                // oEditors.getById["news_text"].exec("UPDATE_CONTENTS_FIELD", []);
                var check = true;
                $('.req').each(function() {
                    if (!$(this).val()) {
                        check = false;
                        return false;
                    }
                });
                if(check) {
                    var form = $('form')[0];
                    var data = new FormData(form);
                    if($(this).attr('id') == "goods_go"){
                        var json = jsonreturn('/admin/goods-add-data',data);
                        if(json.return == true) {
                            alert("등록되었습니다");
                            location.href = "/admin/bursary-goods";
                        }
                    }
                    else {
                        var json = jsonreturn('/admin/goods-update',data);
                        if(json.return == true) {
                            alert("수정되었습니다");
                            location.href = "/admin/bursary-goods";
                        }
                    }
                }
                else {
                    $(this).next().trigger('click');
                }
            });
        }

        this.notice = function() {
            $('body').on('click', '#notice_go, #notice_edit', function() {
                oEditors.getById["content"].exec("UPDATE_CONTENTS_FIELD", []);

                var check = true;
                var editor_chk = true;
                $('.req').each(function() {
                    if (!$(this).val()) {
                        check = false;
                        return false;
                    }

                    if($(this).attr('id') == 'content') {
                        var content =$(this).val();

                        if( content == ""  || content == null || content == '&nbsp;' || content == '<br>' || content == '<br />'
                            || content == '<p>&nbsp;</p>' || content == '<p><br></p>')  {
                            alert("내용을 입력하세요.");
                            oEditors.getById["content"].exec("FOCUS"); //포커싱
                            check = false;
                            editor_chk = false;
                            return false;
                        }
                    }
                });
                if(!editor_chk) {
                    return false;
                }

                if(check) {
                    var form = $('form')[0];
                    var data = new FormData(form);
                    if($(this).attr('id') == "notice_go"){
                        var json = jsonreturn('/admin/notice-add-data',data);
                        if(json.return == true) {
                            alert("등록되었습니다");
                            location.href = "/admin/notice";
                        }
                    }
                    else {
                        var json = jsonreturn('/admin/notice-update',data);
                        if(json.return == true) {
                            alert("수정되었습니다");
                            location.href = "/admin/notice";
                        }
                    }
                }
                else {
                    $(this).next().trigger('click');
                }
            });
        }

        this.press = function() {
            $('body').on('click', '#press_go, #press_edit', function() {
                oEditors.getById["content"].exec("UPDATE_CONTENTS_FIELD", []);

                var check = true;
                var editor_chk = true;
                $('.req').each(function() {
                    if (!$(this).val()) {
                        check = false;
                        return false;
                    }

                    if($(this).attr('id') == 'content') {
                        var content =$(this).val();

                        if( content == ""  || content == null || content == '&nbsp;' || content == '<br>' || content == '<br />'
                            || content == '<p>&nbsp;</p>' || content == '<p><br></p>')  {
                            alert("내용을 입력하세요.");
                            oEditors.getById["content"].exec("FOCUS"); //포커싱
                            check = false;
                            editor_chk = false;
                            return false;
                        }
                    }
                });
                if(!editor_chk) {
                    return false;
                }
                if(check) {
                    var form = $('form')[0];
                    var data = new FormData(form);
                    if($(this).attr('id') == "press_go"){
                        var json = jsonreturn('/admin/press-add-data',data);
                        if(json.return == true) {
                            alert("등록되었습니다");
                            location.href = "/admin/press";
                        }
                    }
                    else {
                        var json = jsonreturn('/admin/press-update',data);
                        if(json.return == true) {
                            alert("수정되었습니다");
                            location.href = "/admin/press";
                        }
                    }
                }
                else {
                    $(this).next().trigger('click');
                }
            });
        }

        this.gallery = function() {
            $('body').on('click', '#gallery_go, #gallery_edit', function() {
                oEditors.getById["content"].exec("UPDATE_CONTENTS_FIELD", []);

                var check = true;
                var editor_chk = true;
                $('.req').each(function() {
                    if (!$(this).val()) {
                        check = false;
                        return false;
                    }

                    if($(this).attr('id') == 'content') {
                        var content =$(this).val();

                        if( content == ""  || content == null || content == '&nbsp;' || content == '<br>' || content == '<br />'
                            || content == '<p>&nbsp;</p>' || content == '<p><br></p>')  {
                            alert("내용을 입력하세요.");
                            oEditors.getById["content"].exec("FOCUS"); //포커싱
                            check = false;
                            editor_chk = false;
                            return false;
                        }
                    }
                });
                if(!editor_chk) {
                    return false;
                }
                if(check) {
                    var form = $('form')[0];
                    var data = new FormData(form);
                    if($(this).attr('id') == "gallery_go"){
                        var json = jsonreturn('/admin/gallery-add-data',data);
                        if(json.return == true) {
                            alert("등록되었습니다");
                            location.href = "/admin/gallery";
                        }
                    }
                    else {
                        var json = jsonreturn('/admin/gallery-update',data);
                        if(json.return == true) {
                            alert("수정되었습니다");
                            location.href = "/admin/gallery";
                        }
                    }
                }
                else {
                    $(this).next().trigger('click');
                }
            });
        }

        this.login = function() {
            $('body').on('click', '#logingo', function() {
                var req = true;
                $('.req').each(function() {
                    if (!$(this).val()) {
                        req = false;
                        return false;
                    }
                });

                if(req) {
                    var form = $('form')[0];
                    var data = new FormData(form);
                    var json = jsonreturn('/admin/loginData',data);
                    if(json.return == true) {
                        location.href = '/admin/slideList';
                    }
                    else {
                        alert("아이디 비밀번호가 일치하지 않습니다");
                    }
                }
                else {
                    $(this).next().trigger('click');
                }
            });

            $(".log").keypress(function(e) {
                if (e.keyCode == 13){
                    var req = true;
                    $('.req').each(function() {
                        if (!$(this).val()) {
                            req = false;
                            return false;
                        }
                    });

                    if(req) {
                        var form = $('form')[0];
                        var data = new FormData(form);
                        var json = jsonreturn('/admin/loginData',data);
                        if(json.return == true) {
                            // alert("로그인 되었습니다");
                            location.href = '/admin/slideList';
                        }
                        else {
                            alert("아이디 비밀번호가 일치하지 않습니다");
                        }
                    }
                    else {
                        $(this).next().trigger('click');
                    }
                }
            });


        }

        this.oneper = function() {
            $('body').on('click', '#oneper_go, #oneper_edit', function() {
                // oEditors.getById["news_text"].exec("UPDATE_CONTENTS_FIELD", []);
                var check = true;
                $('.req').each(function() {
                    if (!$(this).val()) {
                        check = false;
                        return false;
                    }
                });
                if(check) {
                    var form = $('form')[0];
                    var data = new FormData(form);
                    if($(this).attr('id') == "oneper_go"){
                        var json = jsonreturn('/admin/oneper-add-data',data);
                        if(json.return == true) {
                            alert("등록되었습니다");
                            location.href = "/admin/bursary-oneper";
                        }
                    }
                    else {
                        var json = jsonreturn('/admin/oneper-update',data);
                        if(json.return == true) {
                            alert("수정되었습니다");
                            location.href = "/admin/bursary-oneper";
                        }
                    }
                }
                else {
                    $(this).next().trigger('click');
                }
            });
        }


        this.roll = function() {
            $('body').on('click', '#roll_go, #roll_edit', function() {
                // oEditors.getById["news_text"].exec("UPDATE_CONTENTS_FIELD", []);
                var check = true;
                $('.req').each(function() {
                    if (!$(this).val()) {
                        check = false;
                        return false;
                    }
                });
                if(check) {
                    var form = $('form')[0];
                    var data = new FormData(form);
                    if($(this).attr('id') == "roll_go"){
                        var json = jsonreturn('/admin/roll-add-data',data);
                        if(json.return == true) {
                            alert("등록되었습니다");
                            location.href = "/admin/bursary-roll";
                        }
                    }
                    else {
                        var json = jsonreturn('/admin/roll-update',data);
                        if(json.return == true) {
                            alert("수정되었습니다");
                            location.href = "/admin/bursary-roll";
                        }
                    }
                }
                else {
                    $(this).next().trigger('click');
                }
            });
        }

        this.cms = function() {
            $('body').on('click', '#cms_go, #cms_edit', function() {
                // oEditors.getById["news_text"].exec("UPDATE_CONTENTS_FIELD", []);
                var check = true;
                $('.req').each(function() {
                    if (!$(this).val()) {
                        check = false;
                        return false;
                    }
                });
                if(check) {
                    var form = $('form')[0];
                    var data = new FormData(form);
                    if($(this).attr('id') == "cms_go"){
                        var json = jsonreturn('/admin/cms-add-data',data);
                        if(json.return == true) {
                            alert("등록되었습니다");
                            location.href = "/admin/bursary-cms";
                        }
                    }
                    else {
                        var json = jsonreturn('/admin/cms-update',data);
                        if(json.return == true) {
                            alert("수정되었습니다");
                            location.href = "/admin/bursary-cms";
                        }
                    }
                }
                else {
                    $(this).next().trigger('click');
                }
            });
        }


        $('body').on('change', '#logo, #logos, #slide', function() {
            var json = uploadImage($(this));
            if (json) {
                var url = json.url.join();
                $(this).next().val(url);
                if(json.url[1]) {
                    $('.slidess').remove();
                    for(i = 0; i < json.url.length; i++){
                        $('.youtubb').after('<img src="/assets/uploads/'+json.url[i]+'" class = "slidess">');
                        $(this).next().next().css('display','block');
                    }
                }
                else {
                    $(this).next().next().attr('src','/assets/uploads/'+json.url[0]);
                    $(this).next().next().css('display','block');
                }
            }
        });

        $('body').on('click', '#up', function() {
            $(".chktable").each(function() {
                if ($(this).is(":checked")) {
                    var $tr = $(this).parent().parent(); // 클릭한 버튼이 속한 tr 요소
                    $tr.prev().before($tr); // 현재 tr 의 이전 tr 앞에 선택한 tr 넣기
                }
            });
        });

        $('body').on('click', '#down', function() {
            $(".chktable").each(function() {
                if ($(this).is(":checked")) {
                    var $tr = $(this).parent().parent(); // 클릭한 버튼이 속한 tr 요소
                    $tr.next().after($tr); // 현재 tr 의 이전 tr 앞에 선택한 tr 넣기
                }
            });
        });

        $('body').on('click', '.btn-show', function() {
            var result = json($(this).attr('data-url'),
                {show : $(this).attr('data-value'), idx : $(this).parent().parent().attr('data-idx')});
            location.reload();
        });
        //
        // $('body').on('click', '#idxgo', function() {
        // 	var idxs = new Array();
        // 	var idx = new Array();
        // 	var i = 1;
        // 	$(".chktable").each(function() {
        // 		idxs.push(i);
        // 		idx.push($(this).parent().parent().attr('data-idx'));
        // 		i++;
        // 	});
        // 	var url = $(this).attr('data-url');
        // 	var result =json(url,{'idxs':idxs,'idx':idx});
        // 	location.reload();
        // });


        // $('body').on('click', '.adminview', function() {
        //     var idx = $(this).parent().parent().attr('data-idx');
        //     location.href = '/admin/estimateView/'+idx;
        // });

    }
    var admin = new admin();
    admin.slide();
    admin.history();
    admin.login();
    admin.bursary();
    admin.donation();
    admin.goods();
    admin.oneper();
    admin.roll();
    admin.cms();
    admin.report();
    admin.notice();
    admin.press();
    admin.gallery();
    admin.historygive();
    admin.history_support();
    admin.history_contribution();
    admin.history_donate();
    admin.history_collabo();
});
