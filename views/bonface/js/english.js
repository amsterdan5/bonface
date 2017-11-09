//aboutMe
$('#aboutMe').click(function (event) {
    event.stopPropagation();
    window.location.href = "./about_en.html";
})

//index
$('#productBtnIdx').click(function(event){
    event.preventDefault();
    window.location.href = "./detail_en.html";
})

$('#productBtnIdx').hover(function () {
    $(this).find('#productList').stop(true, true).fadeIn(200);
    $(this).find('.arrow-up').css('opacity', '0')
}, function () {
    $(this).find('#productList').fadeOut(500);
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
$('#productBtn').click(function(event){
    event.preventDefault();
    window.location.href = "./detail_en.html";
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
    window.location.href = "./detail-venus_en.html";
});
$('#toVenusDe').click(function (event) {
    event.stopPropagation();
    window.location.href = "./detail-venus_de_en.html";
});
$('#toVenusGe').click(function (event) {
    event.stopPropagation();
    window.location.href = "./detail-venus_ge_en.html";
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
    window.location.href = "./detail-venus_en.html";
});
$('.venus-de-btn').click(function (event) {
    event.stopPropagation();
    window.location.href = "./detail-venus_de_en.html";
});
$('.venus-ge-btn').click(function (event) {
    event.stopPropagation();
    window.location.href = "./detail-venus_ge_en.html";
});

//detail logo to index
$('#toIndex').click(function(event){
    event.stopPropagation();
    window.location.href="./index.html";
}) 