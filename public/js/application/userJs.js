/**
 * Created by Nguyen on 7/22/14.
 */
/**
 * Hien Login Form
 */
$("#registerButton").on("click", function () {
    if (window.XMLHttpRequest) {
        ajax = new XMLHttpRequest();
    }
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var result = ajax.responseText;
            if (result == "0") {
                document.getElementById('content').innerHTML = "<p>Đăng kí không thành công</p>";
            }
            else {
                document.getElementById('content').innerHTML = "<p>Đăng kí thành công</p>";
            }
        }
    }
    var fname = document.getElementsByName('fname')[0].value();
    var lname = document.getElementsByName('lname')[0].value();
    var email = document.getElementsByName('email')[0].value();
    var password = document.getElementsByName('password')[0].value();
    ajax.open("POST", "users/register/", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("fname=" + fname + '&' + "lname=" + lname + '&' + "password=" + password);
    //ajax.send();
});
$(function () {
    $("#userLoginButton").on('click', function () {
        $.Dialog({
            overlay: true,
            shadow: true,
            flat: true,
            draggable: true,
            icon: '<span class = "icon-key-2">',
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
    $("#userSignUpButton").on('click', function () {
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
                var content =
                    '<div class="row" id = "content"><div class = "span6"><form action="users/register/" method="POST">'
                        + '<fieldset><legend>Đăng kí</legend><label>Họ</label>'
                        + '<div class="input-control text" data-role="input-control">'
                        + '<input type="text" name="fname" tabindex="1" autofocus="" required>'
                        + '<button class="btn-clear" ></button>'
                        + '</div>'
                        + '<label>Tên lót - Tên</label>'
                        + '<div class="input-control text" data-role="input-control">'
                        + '<input type="text" name ="lname" tabindex="2" required>'
                        + '<button class="btn-clear" ></button>'
                        + '</div>'
                        + '<label>Email: </label>'
                        + '<div class="input-control text" data-role="input-control">'
                        + '<input type="email" name="email" tabindex="3" required>'
                        + ' <button class="btn-clear" ></button>'
                        + '</div>'
                        + '<label>Password: </label>'
                        + '<div class="input-control password"  data-role="input-control">'
                        + '<input type="password" tabindex="4" name="password" id = "password" onkeyup="checkPassword(this.value)" required>'
                        + ' <button class="btn-reveal" ></button>'
                        + ' <div id = "pwStatus"></div>'
                        + '</div>'
                        + '<label>Nhập lại password: </label>'
                        + '<div class="input-control password"  data-role="input-control">'
                        + '<input type="password" tabindex="5" onkeyup="checkPasswordSame(this.value, document.getElementById(' + '&#39;password&#39;' + ').value)" name="repassword" required>'
                        + '<button class="btn-reveal" ></button>'
                        + '</div>'
                        + '<button class="button primary" id = "registerButton" >Đăng ký</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                        + '<input type="reset" value="Xóa">'
                        + '</fieldset>'
                        + '</form></div></div>';

                $.Dialog.title("Đăng ký");
                $.Dialog.content(content);
            }
        });
    });
});


    /**
     * Register validator function
     * @param pass
     */
    function checkPassword(pass) {
        if (pass.length < 6) {
            document.getElementById('pwStatus').innerHTML = "<p style='color: #ff0000'><b>" + "Mật khẩu phải lớn hơn 6 kí tự" + "</b></p>";
        }
        else {
            document.getElementById('pwStatus').innerHTML = "<p style='color: green'><b>" + "OK" + "</b></p>";
        }
    }

    function checkPasswordSame(pass, passCopy) {
        if (pass == passCopy) {
            document.getElementById('pwStatus').innerHTML = "<p style='color: green'><b>" + "Mật khẩu trùng khớp" + "</b></p>";
        }
        else {
            document.getElementById('pwStatus').innerHTML = "<p style='color: #ff0000'><b>" + "Mật khẩu chưa trùng khớp" + "</b></p>";
        }
    }
