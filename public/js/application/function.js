/**
 * Created by Nguyen on 7/19/14.
 */
/**
 * Hien Login Form
 */
$(function() {
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
                var content = '<form class="user-input" action = "home/userLogin/" method="POST">' +
                    '<label>Email</label>' +
                    '<div class="input-control text"><input type="text" name="email"><button class="btn-clear"></button></div>' +
                    '<label>Mật khẩu</label>' +
                    '<div class="input-control password"><input type="password" name="password"><button class="btn-reveal"></button></div>' +
                    '<div class="input-control checkbox"><label><input type="checkbox" name="c1" checked/><span class="check"></span>Ghi nhớ</label></div>' +
                    '<div class="form-actions">' +
                    '<button class="button primary">Đăng nhập</button>&nbsp;' +
                    '<button class="button" type="button" onclick="$.Dialog.close()">Cancel</button> ' +
                    '</div>' +
                    '</form>';

                $.Dialog.title("Đăng nhập");
                $.Dialog.content(content);
            }
        });
    });
})
/**
 * Load google Map
 */
window.onload = function() {
    var mapDiv = document.getElementById('map-canvas');
    var latlng = new google.maps.LatLng(37.09, -95.71);
    var options = {
        zoom: 12,
        center: new google.maps.LatLng(-28.643387, 153.612224),
        mapTypeControl: true,
        disableDefaultUI: true,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            position: google.maps.ControlPosition.BOTTOM_CENTER
        },
        panControl: true,
        panControlOptions: {
            position: google.maps.ControlPosition.TOP_RIGHT
        }
    };
    var map = new google.maps.Map(mapDiv, options);
}