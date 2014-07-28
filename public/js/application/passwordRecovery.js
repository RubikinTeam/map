/**
 * Created by DUONG_TRUC on 7/26/14.
 */
$(function () {
    $("#submit").on('click', function () {
        $.post("../passwordRecoveryMail/",
            {email: $("#email").val() },
            function (data, status) {
                if (status == "success" && data == "1") {
                    $("#content").html('<h3>Hệ thống đã gởi email khôi phục mật khẩu vào: <b><span style="color: #0000ff"> '
                        + $("#email").val() + '</span></b>, vui lòng mở mail và làm theo hướng dẫn</h3>'
                        + ' Nhấn <a href = "../../">vào đây</a> để về trang chủ</h3>')
                }
                else {
                    $("#content").html('<h3>Email: '
                        + $("#email").val() + ' chưa được đăng ký.</h3>'
                        + '. Nhấn <a href = "../register/">vào đây</a> để đăng ký</h3>');

                }
            }, "text");
    });
    $("#reset").on('click', function () {
        $("#password").prop("value", '');
        $("#repassword").prop("value", '');
    });
    $("#submit2").on('click', function () {
        if (checkPasswordSame($("#password").val(), $("#repassword").val())) {
            $.post("../updatePassword/",
                {
                    email: $("#userEmail").val(),
                    newPassword: $('#password').val()
                },
                function (data, status) {
                    if(status == "success" && data == "1"){
                        $("#content").html('<h3>Cập nhật mật khẩu thành công<b>' + '. Nhấn <a href = "../../">vào đây</a> để về trang chủ</h3>');
                    }

                    else {
                        $("#content").html('<h3>Đăng ký không thành công, đường dẫn kích hoạt đã được sử dụng hoặc quá hạn</h3>'
                            + '. Nhấn <a href = "../passwordRecovery/">vào đây</a> để thử lại</h3>');
                    }
                }
            )
        }
    })
})
function checkPassword(pass) {
    if (pass == '') {
        $('#pwStatus').innerHTML = '';
    } else {
        if (pass.length < 6) {
            $('#pwStatus').innerHTML = "<p style='color: #ff0000'><b>" + "Mật khẩu phải lớn hơn 6 kí tự" + "</b></p>";
        }
        else {
            $('#pwStatus').innerHTML = "<p style='color: green'><b>" + "OK" + "</b></p>";
        }
    }
}

function checkPasswordSame(pass, passCopy) {
    if (pass == '' || passCopy == '') {
        document.getElementById('pwStatus2').innerHTML = '';
        return false;
    } else {
        if (pass == passCopy) {
            document.getElementById('pwStatus2').innerHTML = "<p style='color: green'><b>" + "Mật khẩu trùng khớp" + "</b></p>";
            return true;
        }
        else {
            document.getElementById('pwStatus2').innerHTML = "<p style='color: #ff0000'><b>" + "Mật khẩu chưa trùng khớp" + "</b></p>";
            return false;
        }
    }

}

