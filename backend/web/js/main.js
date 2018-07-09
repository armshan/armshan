/**
 * Created by mayunfeng on 2017/12/13.
 */


//通用弹窗插件
$('#data-create, .data-view, .data-update, .data-resetP').on('click', function () {
    var url = $(this).data('url'),
        title = $(this).attr('data-title'),
        size = $(this).data('size');
    if (size){
        $('.modal-dialog').addClass(size);
    }
    $('.modal-title').html(title);
    $.get(url, {},
        function (data) {

            $('.modal-body').html(data);
        }
    );
});