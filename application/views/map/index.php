<HTML5
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link href="<?php echo URL;?>/public/css/metro-bootstrap.css" rel="stylesheet">
    <link href="<?php echo URL;?>/public/css/metro-bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo URL;?>/public/css/iconFont.css" rel="stylesheet">
    <link href="<?php echo URL;?>/public/css/docs.css" rel="stylesheet">
    <link href="<?php echo URL;?>/public/js/prettify/prettify.css" rel="stylesheet">

    <!-- Load JavaScript Libraries -->
    <script src="<?php echo URL;?>/public/js/jquery/jquery.min.js"></script>
    <script src="<?php echo URL;?>/public/js/jquery/jquery.widget.min.js"></script>
    <script src="<?php echo URL;?>/public/js/jquery/jquery.mousewheel.js"></script>
    <script src="<?php echo URL;?>/public/js/prettify/prettify.js"></script>

    <!-- Metro UI CSS JavaScript plugins -->
    <script src="<?php echo URL;?>/public/js/load-metro.js"></script>

    <!-- Local JavaScript -->
    <script src="<?php echo URL;?>/public/js/docs.js"></script>
    <script src="<?php echo URL;?>/public/js/github.info.js"></script>
    <script
        src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAA33EjxkLYsh9SEveh_MphphQP1yR2bHJW2Brl_bW_l0KXsyt8cxTKO5Zz-UKoJ6IepTlZRxN8nfTRgw"></script>
    <script>
        function load() {
            if (GBrowserIsCompatible) {
                var map = new GMap2(document.getElementById("map"));
                map.setCenter(new GLatLng(37.4419, -122.1419), 13);
            }
        }
    </script>
    <title>Metro UI CSS : Metro Bootstrap CSS Library</title>
</head>
<body class="metro" onload = "load()">
<div class="navbar fixed-top">
    <div class="navbar-content">

        <a href="/" class="element"><span class="icon-grid-view"></span> METRO UI CSS <sup>2.0</sup></a>
        <span class="element-divider"></span>

        <a class="pull-menu" href="#"></a>
        <ul class="element-menu">
            <li>
                <a class="dropdown-toggle" href="#">Base CSS</a>
                <ul class="dropdown-menu" data-role="dropdown">
                    <li><a href="#">Requirements</a></li>
                    <li>
                        <a href="#" class="dropdown-toggle">General CSS</a>
                        <ul class="dropdown-menu" data-role="dropdown">
                            <li><a href="#">Global styles</a></li>
                            <li><a href="#">Grid system</a></li>
                            <li><div class="divider"></div></li>
                            <li><a href="#">Typography</a></li>
                            <li><a href="#">Tables</a></li>
                            <li><a href="#">Forms</a></li>
                            <li><a href="#">Buttons</a></li>
                            <li><a href="#">Images</a></li>
                        </ul>
                    </li>
                    <li class="divider"></li>
                    <li><a href="#">Responsive</a></li>
                    <li class="disabled"><a href="#">Layouts and templates</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Icons</a></li>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle"  href="#">Community</a>
                <ul class="dropdown-menu" data-role="dropdown">
                    <li class="disabled"><a href="#">Blog</a></li>
                    <li class="disabled"><a href="#">Community Forum</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Github</a></li>
                    <li class="divider"></li>
                    <li><a href="#">License</a></li>
                </ul>
            </li>
        </ul>

        <div class="no-tablet-portrait">
            <span class="element-divider"></span>
            <a class="element brand" href="#"><span class="icon-spin"></span></a>
            <a class="element brand" href="#"><span class="icon-printer"></span></a>
            <span class="element-divider"></span>

            <div class="element input-element">
                <form>
                    <div class="input-control text">
                        <input type="text" placeholder="Search...">
                        <button class="btn-search"></button>
                    </div>
                </form>
            </div>

            <div class="element place-right">
                <a class="dropdown-toggle" href="#"><span class="icon-cog"></span></a>
                <ul class="dropdown-menu place-right" data-role="dropdown">
                    <li><a href="#">Products</a></li>
                    <li><a href="#">Download</a></li>
                    <li><a href="#">Support</a></li>
                    <li><a href="#">Buy Now</a></li>
                </ul>
            </div>
            <span class="element-divider place-right"></span>
            <button class="element image-button image-left place-right">
                Sergey Pimenov
                <img src="<?php echo URL;?>/public/images/me.jpg"/>
            </button>
        </div>
    </div>
</div>
<div id='map' style="width: 2000px; height: 2000px"></div>
<script src="<?php echo URL;?>/public/js/hitua.js"></script>
</body>
</html>