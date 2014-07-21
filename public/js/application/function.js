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
                    '<label for = "email">Email</label>' +
                    '<div class="input-control text"><input type="text"><button class="btn-clear"></button></div>' +
                    '<label for = "password">Mật khẩu</label>' +
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
window.onload = getLocation(0);
//$("#map-type-all").on('click', getLocation(0));
//$("#map-location-all").on('click', getLocation(0));
//$("#map-activities-all").on('click', getActivityByType(0));
//document.getElementById("map-activities-all").addEventListener('click',getActivityByType(0));
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
            //var markers = [];
            var infoContents = [];
            //var infoWindows = [];
            for (var i = 0; i < n; i += 1) {
                var marker =
                    new google.maps.Marker(
                        {
                            position: new google.maps.LatLng(obj[i].lat, obj[i].long),
                            map: map,
                            title: obj[i].lat + ' | ' + obj[i].long
                        }
                    );
                infoContents[i] = '<div style="width: 200px"><b>Cơ sở:</b> ' + obj[i].name + '</br>'
                    + '<b>Địa chỉ:</b> số ' + obj[i].no + ' ' + obj[i].street + ', phường ' + obj[i].ward + ', Quận '
                    + obj[i].dist + ', ' + obj[i].city + '</br>'
                    + '<b>Điện thoại:</b> ' + obj[i].phone + '</br>'
                    + '<b>Email:</b> ' + obj[i].email + '</br>'
                    + '<a href = "#" style="text-align: left">Xem thêm...</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href = "#" style="align-self: flex-end">Bài viết liên quan</a></div>';
                var infoWindow = new google.maps.InfoWindow(), marker, i;
                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        infoWindow.setContent(infoContents[i]);
                        infoWindow.open(map, marker);
                    }
                })(marker, i));
                textContent = textContent + (obj[i].lat + " - " + obj[i].long + "</br>");
            }
            document.getElementById('locationList').innerHTML = textContent;
        }
    }
    ajax.open("POST", "map/getLocationById/", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("id=" + id);
}

function getActivityByType(type) {
    if (window.XMLHttpRequest) {
        ajax = new XMLHttpRequest();
    }
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var text = ajax.responseText;
            //alert(text);
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
            var infoContents = [];
            for (var i = 0; i < n; i += 1) {
                var marker =
                    new google.maps.Marker(
                        {
                            position: new google.maps.LatLng(obj[i].lat, obj[i].long),
                            map: map,
                            title: obj[i].lat + ' | ' + obj[i].long
                        }
                    );
                infoContents[i] = '<div style="width: 300px"><b>Hoạt động:</b>' + obj[i].activityName + '</br>'
                    + '<b>Ngày bắt đầu:</b>'+ obj[i].startday + '</br>' + '<b>Ngày kết thúc: </b> ' + obj[i].endday + '</br>'
                    + '<b>Đơn vị tổ chức: </b> ' + '<a href = "vplaces/detail/' + obj[i].placeId + '">'
                    +  obj[i].placeName + '</a></br>'
                    + '<a href = "activities/detail/' + obj[i].activityId + '">Chi tiết...</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href = "#" style="align-self: flex-end">Bài viết liên quan</a></div>';
                var infoWindow = new google.maps.InfoWindow(), marker, i;
                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        infoWindow.setContent(infoContents[i]);
                        infoWindow.open(map, marker);
                    }
                })(marker, i));
                textContent = textContent + (obj[i].lat + " - " + obj[i].long + "</br>");
            }
            document.getElementById('locationList').innerHTML = textContent;
        }
    }
    ajax.open("POST", "activities/getActivityShortDesByType/", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("type=" +type);
}