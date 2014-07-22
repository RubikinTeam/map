/**
 * Created by Nguyen on 7/22/14.
 */
/**
 * Hien Login Form
 */
$(function () {
    $("#userLoginButton").on('click', function () {
        $.Dialog({
            overlay: true,
            shadow: true,
            flat: true,
            draggable: true,
            icon: '<span class = "icon-user">',
            title: 'Flat window',
            content: '',
            padding: 10,
            onShow: function (_dialog) {
                var content = '<form class="user-input" action = "users/userLogin/" method="POST">' +
                    '<label for = "email">Email</label>' +
                    '<div class="input-control text"><input type="text" name="email" tabindex="1" autofocus="1"><button class="btn-clear"></button></div>' +
                    '<label for = "password">Mật khẩu</label>' +
                    '<div class="input-control password"><input type="password" name="password" tabindex="2"><button class="btn-reveal"></button></div>' +
                    '<div class="input-control checkbox"><label><input type="checkbox" name="c1" checked/><span class="check"></span>Ghi nhớ</label></div>' +
                    '<div class="form-actions">' +
                    '<button class="button primary" tabindex="3">Đăng nhập</button>&nbsp;' +
                    '<button class="button" type="button" onclick="$.Dialog.close()">Cancel</button> ' +
                    '</div>' +
                    '</form>';

                $.Dialog.title("Đăng nhập");
                $.Dialog.content(content);
            }
        });
    });
});
