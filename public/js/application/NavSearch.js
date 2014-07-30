/**
 * Created by DUONG_TRUC on 7/29/14.
 */
$(function () {
    $("#txt-search").on('keyup', function () {
        $(".search-result  ul").html('');
        if ($(this).val() == '') {
            $(".search-result").css('display', 'none');
        }
        else {
            $.get('navSearch/articleSearch/?query=' + $("#txt-search").val())
                .done(function (data) {
                    var obj = JSON.parse(data);
                    var length = obj.length;
                    if (length > 0) {
                        $(".search-result").css('display', 'block');
                        $(".search-result ul").append('<li><div class = "category">Hoạt động</div><ul>');
                        for (var i = 0; i < length; i++){
                            $(".search-result  ul  li ul").append('<li><a href="articles/detail/' + obj[i].id +'"><img src="public/img/'
                                + obj[i].imageUrl + '"class="search-thumbnail"/>'
                                + obj[i].title + '</a></li>');
                        }
                        $(".search-result  ul").append('</ul></li>');
                    }
                });
        }

    });

})
