$(document).ready(function () {
    $('.li__item').each(function (index) {
        $(this).click(function () {
                $(this).parent().parent().find($('.li__text_hiden')).toggle('slow');
            }
        )
    });
});