





































// MaterialTab
$('.materialTab li[data-tab]').on('click', function(){
    $('.materialTab li[data-tab]').removeClass('active');
    $(this).addClass('active');
    $('.materialTabContent[data-tab-content').removeClass('active');
    $('.materialTabContent[data-tab-content='+ $(this).data('tab') +']').addClass('active');
    $('.materialTabContent[data-tab-content='+ $(this).data('tab') +']').addClass('animate__fadeInUp');
});






