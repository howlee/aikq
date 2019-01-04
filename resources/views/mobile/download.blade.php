<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <meta content="telephone=no,email=no" name="format-detection" />
    <meta name="viewport" content="width=device-width, initial-scale=0.5, maximum-scale=0.5, minimum-scale=0.5, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="{{env('CDN_URL')}}/css/mobile/style_phone.css?t=201808241105">
    <link rel="stylesheet" type="text/css" href="{{env('CDN_URL')}}/css/mobile/downloadPhone.css?t=201808141550">
    <link rel="Shortcut Icon" data-ng-href="{{env('CDN_URL')}}/img/pc/ico.ico" href="{{env('CDN_URL')}}/img/pc/ico.ico">
    <link href="{{env('CDN_URL')}}/img/pc/icon_face.png" sizes="100x100" rel="apple-touch-icon-precomposed">
    <title>爱看球APP下载_爱看球官网软件下载-爱看球直播</title>
</head>
<script type="text/javascript">
    var u = navigator.userAgent;
    var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
    var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
    var isApp = u.indexOf('Liaogou168') > -1 || u.indexOf('AKQ') > -1;
    if (!isAndroid && !isiOS && !isApp){
        var url = window.location.href;
        if (/(https?:\/\/)m\./.test(url)) {
            url = url.replace(/(https?:\/\/)m\./, "$1www.");
            window.location.href = url;
        }
    }
</script>
<body style="padding: 0px;">
<h1>爱看球APP下载</h1>
<img src="{{env('CDN_URL')}}/img/mobile/image_bg_top_n.jpg" class="bg">
<div class="downbox">
    <a id="iOS" href="itms-services://?action=download-manifest&url=https://static.dlfyb.com/download/lehu/lehuzhibo.plist?201901041722" class="down">iOS下载</a>
    <a id="Android" href="{{env('CDN_URL')}}/download/android.apk" class="down" download="{{env('CDN_URL')}}/download/android.apk">安卓下载</a>
    <p class="warm">※安装APP后若无法更新版本，<br/>请先卸载再重新安装</p>
</div>
<!-- <p class="ios">苹果用户安装步骤>></p> -->
<!-- <p class="copy">【复制下载地址】</p> -->
<!-- <div id="Copy">http://www.aikq.cc/downloadPhone.html</div> -->

<div id="Teach">
    <div class="title">
        <p><span class="b">安装教学</span></p>
    </div>
    <div class="content">因为这类软体无法通过Apple/Google审核于AppStore/Google play上架，因此需要透过特殊的方式下载并安装，请各位客官放心安装！</div>
    <div class="title">
        <p><span class="b">I</span><span class="s">os</span>如何安装？</p>
    </div>
    <div class="content sort">
        <p>1.APP下载完成后，请开启【设定】>点选【通用】或【一般】</p>
        <p>2.点选【描述档】或【描述档与装置管理】或【设备管理】</p>
        <p>3.点入【企业级应用】的选项</p>
        <p>4.按下【信任TOP LTD TOV】</p>
        <p>5.按下【信任】APP即完成设定</p>
        <p>6.点击开启【爱看球 App】，开始享用！</p>
    </div>
    <div class="title">
        <p><span class="b">A</span><span class="s">ndriod</span>如何安装？</p>
    </div>
    <div class="content sort">
        <p>1.下载前请先至【设定】> [安全性] > 将[未知的来源] 打勾（务必请打勾）</p>
        <p>2.点击【下载按钮】或扫描二维码下载爱看球 apk并同意安装即可</p>
    </div>
</div>

<img src="{{env('CDN_URL')}}/img/mobile/image_bg_down_n.jpg" class="bg">

<!-- <div id="Step" step="1" style="display: none;">
    <div class="inner">
        <button class="close"></button>
        <div class="imgbox">
            <img src="img/image_ex1.jpg" class="on">
            <img src="img/image_ex2.jpg">
            <img src="img/image_ex3.jpg">
            <img src="img/image_ex4.jpg">
            <img src="img/image_ex5.jpg">
            <img src="img/image_ex6.jpg">
            <div class="text">
                <p class="on">打开APP时，如出现上面弹窗<br/>请记住划线部分内容</p>
                <p>设置，选择通用</p>
                <p>选择设备管理</p>
                <p>点击刚才记住的证书名称</p>
                <p>点击信任证书</p>
                <p>点击信任证书</p>
            </div>
            <img src="img/image_ex1.jpg" class="bg">
        </div>
        <div class="step">
            <p class="on"></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
        </div>
    </div>
</div> -->
<div id="Share" style="display: none;">
    <p>请使用<span>系统浏览器</span>打开</p>
    <button onclick="$(this).parent().css('display','none')"></button>
</div>
</body>
<script src="{{env('CDN_URL')}}/js/jquery.js"></script>
<script src="{{env('CDN_URL')}}/js/jquery.mobile.js"></script>
<script type="text/javascript">
    var u = navigator.userAgent;
    var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
    var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端

    function isWeiXin() {
        var ua = u.toLowerCase();
        if (ua.match(/MicroMessenger/i) == 'micromessenger') {
            return true;
        } else {
            return false;
        }
    }


    if (isWeiXin()){
        $('a.down').attr('href','javascript:$("#Share").css("display","");').removeAttr('download');
    }else if(navigator.userAgent.indexOf('UCBrowser') > -1 && isiOS) {
        $('a.down').attr('href','javascript:alert("请在Safari中打开，即可下载");')
    }else{
        $('a#Android').click(function () {
            $("body,html").animate({
                scrollTop: $('.sort:last').offset().top //让body的scrollTop等于pos的top，就实现了滚动
            },0);
        })
        $('a#iOS').click(function () {
            this.innerHTML = '下载中';
            $("body,html").animate({
                scrollTop: $('.sort:first').offset().top //让body的scrollTop等于pos的top，就实现了滚动
            },0);
        })
    }

</script>
<script type="text/javascript">
    window.onload = function () {
        $('a#iOS').click(function () {
            _hmt.push(['_trackEvent', 'download', 'ios']);
        });
        $('a#Android').click(function () {
            _hmt.push(['_trackEvent', 'download', 'android']);
        });
    }
</script>
<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?19357052dae32337b52601a9b1541c57";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
</html>

