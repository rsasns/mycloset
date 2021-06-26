//ファイル選択時のプレビュー
$(function(){
  $("[name='image']").on('change', function (e) {
    
    var reader = new FileReader();
    
    reader.onload = function (e) {
        $("#preview").attr('src', e.target.result);
    }
 
    reader.readAsDataURL(e.target.files[0]);   
 
  });
});

//最上部へスクロールするボタン
jQuery(function() {
    var pagetop = $('#page_top');   
    pagetop.hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {  //100pxスクロールしたら表示
            pagetop.fadeIn();
        } else {
            pagetop.fadeOut();
        }
    });
    pagetop.click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 500); //0.5秒かけてトップへ移動
        return false;
    });
});
