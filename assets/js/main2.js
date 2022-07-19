$(document).ready(function(){
    function main() {
        this.categorylist = function() {
            $('body').on('click', '.categoryview', function() {
                var idx = $(this).attr('data-idx');
                location.href = "/index.php/main/nationlist/"+idx;
            });
        }
        jsonreturn = function(url,data) {
            var option = {
                url : 'http://127.0.0.1:81/index.php'+url,
                async:false
            };
            if(data){
                option.data = data;
                option.type = "post";
                option.contentType = false;
                option.processData = false;
            }
            $.ajax(
                option
            ).done(function(data){
                result = data;
            });
            return result;
        }
        json = function(url,data) {
            var option = {
                url : 'http://127.0.0.1:81/index.php'+url,
                data : data,
                type : "post",
                async:false
            };
            $.ajax(
                option
            ).done(function(data){
                result = data;
            });
            return result;
        }

    }
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
    uploadImage = function(form) {
        var image = new FormData();
        for (var i = 0; i < form[0].files.length; i++) {
            image.append('images[]', form[0].files[i]);
        }
        if (form.data('width')) {
            image.append('x', form.data('width'));
            if (form.data('height')) {
                image.append('y', form.data('height'));
            }
        }
        return this.jsonreturn('/main/uploadimage', image);
    }


    // main.categorylist();
    // main.nationlist();
    // main.reviewwrite();
});
