//aboutMe
$('#aboutMe').click(function (event) {
    event.stopPropagation();
    window.location.href = "./about_cn.html";
})

//index
$('#productBtnIdx').click(function (event) {
    event.preventDefault();
    window.location.href = "./detail_cn.html";
})

$('#productBtnIdx').hover(function () {
    $(this).find('#productList').stop(true, true).fadeIn(200);
    $(this).find('.arrow-up').css('opacity', '0')
}, function () {
    $(this).find('#productList').fadeOut(500);
    $(this).find('.arrow-up').css('opacity', '1')
});
$('#sellCn').hover(function () {
    $(this).find('#productListCn').stop(true, true).fadeIn(200);
    $(this).find('.arrow-up').css('opacity', '0')
}, function () {
    $(this).find('#productListCn').fadeOut(500);
    $(this).find('.arrow-up').css('opacity', '1')
});
$('#selectLanguageIdx').hover(function () {
    $(this).find('#languageItem').stop(true, true).fadeIn(200);
    $(this).find('.arrow-up').css('opacity', '0')
}, function () {
    $(this).find('#languageItem').fadeOut(500);
    $(this).find('.arrow-up').css('opacity', '1')
});

// 产品系列 product
$('#productBtn').click(function (event) {
    event.preventDefault();
    window.location.href = "./detail_cn.html";
})

$('#productBtn').hover(function () {
    $(this).find('#productList').stop(true, true).slideDown(200);
    $(this).find('.arrow-donw').css('opacity', '0')
}, function () {
    $(this).find('#productList').slideUp(200);
    $(this).find('.arrow-donw').css('opacity', '1')
});



$('#toVenus').click(function (event) {
    event.stopPropagation();
    window.location.href = "./detail-venus_cn.html";
});
$('#toVenusDe').click(function (event) {
    event.stopPropagation();
    window.location.href = "./detail-venus_de_cn.html";
});
$('#toVenusGe').click(function (event) {
    event.stopPropagation();
    window.location.href = "./detail-venus_ge_cn.html";
});
// language
$('#selectLanguage').hover(function () {
    $(this).find('#languageItem').stop(true, true).slideDown(200);
    $(this).find('.arrow-donw').css('opacity', '0')
}, function () {
    $(this).find('#languageItem').slideUp(200);
    $(this).find('.arrow-donw').css('opacity', '1')
});

//image-icon页面图标跳转

$('.venus-btn').click(function (event) {
    event.stopPropagation();
    window.location.href = "./detail-venus_cn.html";
});
$('.venus-de-btn').click(function (event) {
    event.stopPropagation();
    window.location.href = "./detail-venus_de_cn.html";
});
$('.venus-ge-btn').click(function (event) {
    event.stopPropagation();
    window.location.href = "./detail-venus_ge_cn.html";
});

//detail logo to index
$('#toIndex').click(function (event) {
    event.stopPropagation();
    window.location.href = "./index_cn.html";
})

/**
 * 验证防伪
 * 
 */
$(document).on('click', '#searchBtn', function (event) {
    event.stopPropagation();
    var code = $('#codeInput').val();
    var url = "http://china3-15.com/module/GetCode_getjson.ashx?action=add&callback=?";
    // var url = "http://www.china3-15.com/Result.aspx?code=";
    var data = { c: code, key: "347ebf8d172e977ad09d583a6687cd4f" };
    if (code != '') {
        $.getJSON(url, data, function (backdata) {
            $('#textContent').hide();
            $('#fontTip').hide();
            $('.success').show();
            console.log(backdata)
            $('.result-content').html(backdata.result)
            // var test = new RegExp("请核实后再试", "g");
            // var result = test.test(backdata.result);
            // if (result) {
            //     // $('#antiBox').hide();
            //     // $('#failWrapper').show();

            // } else {
            //     $('#textContent').hide();
            //     $('#fontTip').hide();
            //     $('.success').show()
            //     $('.result-content').html(backdata.result)
            //     // alert(backdata.result);
            //     // $('#textContent').hide();
            //     // $('#fontTip').hide();
            //     // $('.success').show()
            // }

        });
    } else {
        alert("請輸入防偽碼")
    }

});

$('.fail-btn').click(function (event) {
    event.stopPropagation();
    $('#antiBox').show();
    $('#failWrapper').hide()
});

$('.submit').click(function (event) {
    event.stopPropagation();
    $('#textContent').show();
    $('#fontTip').show();
    $('.success').hide()
});
//close
$('.icon-close').click(function (event) {
    event.stopPropagation();
    $('#textContent').show();
    $('#fontTip').show();
    $('.success').hide()
});

$('#toAnti').click(function (event) {
    event.stopPropagation();
    window.location.href = './anti_cn.html';
});
$('#toSellCn').click(function (event) {
    event.stopPropagation();
    window.location.href = './sell_cn.html';
});


$('#chinaSell').hover(function () {
    $(this).find('#chinaItem').stop(true, true).slideDown(200);
    $(this).find('.arrow-donw').css('opacity', '0')
}, function () {
    $(this).find('#chinaItem').slideUp(200);
    $(this).find('.arrow-donw').css('opacity', '1')
});