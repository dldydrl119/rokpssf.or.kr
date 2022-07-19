function donation_js_page(page) {
    var option = {
        url : '/main/donationPage/'+page,
        async:false
    };
    option.type = "post";
    option.contentType = false;
    option.processData = false;

    $.ajax(
        option
    ).done(function(data){
        console.log(data);

        var html = '';
        var obj = jQuery.parseJSON( data)
        var number = obj.donation_number;
        $.each(obj.donation,function(index, item){
            html = html+ '<tr class="donation-tr">';
            html = html+ '<td>' + number +'</td>';
            html = html+ '<td>' + item.name +'</td>';
            html = html+ '<td>' + item.associate +'</td>';
            html = html+ '<td>' + item.give_money +'</td>';
            html = html+ '</tr>';
            number = number-1;
        });
        $('.donation-tr').remove();
        $('#donation_table').append(html);

        $('#donation_paging').empty();
        $('#donation_paging').append(obj.donation_page);
    });

}

function goods_js_page(page) {
    var option = {
        url : '/main/goodsPage/'+page,
        async:false
    };
    option.type = "post";
    option.contentType = false;
    option.processData = false;

    $.ajax(
        option
    ).done(function(data){
        console.log(data);

        var html = '';
        var obj = jQuery.parseJSON( data)
        var number = obj.goods_number;
        $.each(obj.goods,function(index, item){
            html = html+ '<tr class="goods-tr">';
            html = html+ '<td>' + number +'</td>';
            html = html+ '<td>' + item.name +'</td>';
            html = html+ '<td>' + item.associate +'</td>';
            html = html+ '<td>' + item.give_money +'</td>';
            html = html+ '</tr>';
            number = number-1;
        });
        $('.goods-tr').remove();
        $('#goods_table').append(html);

        $('#goods_paging').empty();
        $('#goods_paging').append(obj.goods_page);
    });

}

function oneper_js_page(page) {
    var option = {
        url : '/main/oneperPage/'+page,
        async:false
    };
    option.type = "post";
    option.contentType = false;
    option.processData = false;

    $.ajax(
        option
    ).done(function(data){
        console.log(data);

        var html = '';
        var obj = jQuery.parseJSON( data)
        var number = obj.onper_number;
        $.each(obj.oneper,function(index, item){
            html = html+ '<tr class="oneper-tr">';
            html = html+ '<td>' + number +'</td>';
            html = html+ '<td>' + item.name +'</td>';
            html = html+ '<td>' + item.give_money +'</td>';
            html = html+ '<td>' + item.memo +'</td>';
            html = html+ '</tr>';
            number = number-1;
        });
        $('.oneper-tr').remove();
        $('#oneper_table').append(html);

        $('#oneper_paging').empty();
        $('#oneper_paging').append(obj.onper_page);
    });

}


function roll_js_page(page) {
    var option = {
        url : '/main/rollPage/'+page,
        async:false
    };
    option.type = "post";
    option.contentType = false;
    option.processData = false;

    $.ajax(
        option
    ).done(function(data){
        console.log(data);

        var html = '';
        var obj = jQuery.parseJSON( data)
        var number = obj.onper_number;
        $.each(obj.roll,function(index, item){
            html = html+ '<tr class="roll-tr">';
            html = html+ '<td>' + number +'</td>';
            html = html+ '<td>' + item.name +'</td>';
            html = html+ '<td>' + item.give_money +'</td>';
            html = html+ '<td>' + item.memo +'</td>';
            html = html+ '</tr>';
            number = number-1;
        });
        $('.roll-tr').remove();
        $('#roll_table').append(html);

        $('#roll_paging').empty();
        $('#roll_paging').append(obj.onper_page);
    });

}