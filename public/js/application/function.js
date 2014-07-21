/**
 * Created by Nguyen on 7/19/14.
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
window.onload = function () {
    var position = new google.maps.LatLng(11.8649, 106.612);
    var options = {
        zoom: 12,
        center: position,
        mapTypeControl: true,
        disableDefaultUI: true,
        panControl: true
    };
    var map = new google.maps.Map(document.getElementById('map-canvas'), options);
}
function getLocation(id) {
    if (window.XMLHttpRequest) {
        ajax = new XMLHttpRequest();
    }
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var text = ajax.responseText;
            var obj = JSON.parse(text);
            var n = Object.keys(obj).length;
            var textContent = "";
            var position = new google.maps.LatLng(10.8649, 106.612);
            var options = {
                zoom: 12,
                center: position,
                mapTypeControl: true,
                disableDefaultUI: true,
                panControl: true
            };
            var map = new google.maps.Map(document.getElementById('map-canvas'), options);
            var markers = [];
            var infoContents = [];
            var infoWindows = [];
            for (var i = 0; i < n; i += 1) {
                markers[i] =
                    new google.maps.Marker(
                        {
                            position: new google.maps.LatLng(obj[i].lat, obj[i].long),
                            map: map,
                            title: obj[i].lat + ' | ' + obj[i].long
                        }
                    );
                infoContents[i] = 'Cơ sở: ' + obj[i].name + '</br>'
                    + 'Địa chỉ: số ' + obj[i].no + ' ' + obj[i].street + ', phường ' + obj[i].ward + ', Quận '
                    + obj[i].dist + ', ' + obj[i].city + '</br>'
                    + 'Điện thoại: ' + obj[i].phone + '</br>'
                    + 'Email: ' + obj[i].email + '</br>';
                google.maps.event.addListener(markers[i], 'click', function () {
                    infoWindows[i] = new google.maps.InfoWindow({
                        content: infoContents[i],
                        maxWidth: 200
                    });
                    infoWindows[i].open(map, markers[i]);
                });
                // alert(infoContents[i])
                textContent = textContent + (obj[i].lat + " - " + obj[i].long + "</br>");
            }
              google.maps.event.addListener(markers[0], 'click', function () {
                infoWindows[0] = new google.maps.InfoWindow({
                    content: infoContents[0],
                    maxWidth: 200
                });
                infoWindows[0].open(map, markers[0]);
            });
            google.maps.event.addListener(markers[1], 'click', function () {
                infoWindows[1] = new google.maps.InfoWindow({
                    content: infoContents[1],
                    maxWidth: 200
                });
                infoWindows[1].open(map, markers[1]);
            });
            document.getElementById('locationList').innerHTML = textContent;

        }
    }
    ajax.open("POST", "map/getLocationById/", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("id=" + id);
}