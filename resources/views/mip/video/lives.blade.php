<?php
    $keywords = "爱看球,爱看球录像,中超录像,英超录像,全场回放,高清录像";
    $description = "爱看球录像，为球迷收录各大联赛的精彩录像、高清录像。";
?>
@extends('mip.layout.base')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{env('CDN_URL')}}/css/mip/videoList.css?rd=201901181541">
@endsection
@section('js')
    <script src="https://c.mipcdn.com/static/v1/mip-lightbox/mip-lightbox.js"></script>
@endsection
@section('banner')
    <div id="Navigation">
        <h1>JRS低调看爱看球直播</h1>
        <div class="banner">
            <mip-img height="26" width="75" src="{{env('CDN_URL')}}/img/mip/image_slogan_nav.png"></mip-img>
            <button on="tap:my-lightbox.toggle" id="btn-open" role="button" tabindex="0" class="league"></button>
        </div>
    </div>
@endsection
@section('content')
    <div class="publicAd"><a href="/download/index.html"><mip-img src="{{env('CDN_URL')}}/img/mip/image_ad_wap.jpg"></mip-img></a></div>
    <mip-lightbox id="my-lightbox" layout="nodisplay" class="mip-hidden">
        <div class="lightbox" id="League">
            <div class="title">专题分类</div>
            @foreach($subjects as $name=>$subject)
                <p class="item"><a href="{{\App\Http\Controllers\Mip\UrlCommonTool::subjectUrl($name)}}">{{$subject['name']}}</a></p>
            @endforeach
        </div>
    </mip-lightbox>
    @foreach($matches as $time=>$match_array)
        <?php
        $week = date('w', strtotime($time));
        $week_array = array('周日','周一','周二','周三','周四','周五','周六');
        ?>
        <div class="default">
            <p class="day">{{$time}}&nbsp;&nbsp;{{$week_array[$week]}}</p>
            @foreach($match_array as $match)
                <?php
                $channels = $match['channels'];
                $firstChannel = isset($channels[0]) ? $channels[0] : [];
                $impt = isset($firstChannel['impt']) ? $firstChannel['impt'] : 1;
                $impt_style = '';
                //                if ($impt == 2) {
                //                    $impt_style = 'style="color:#bc1c25;"';
                //                }
                ?>
                @if($match['sport'] == 3)
                    <a href="{{\App\Http\Controllers\Mip\UrlCommonTool::matchVideoUrl($match['mid'])}}">
                        <p class="time" {!! $impt_style !!}>{{$match['league_name']}}&nbsp;&nbsp;{{date('H:i', strtotime($match['time']))}}</p>
                        @if(isset($match['type']) && $match['type'] == 1)
                            <p class="other" {!! $impt_style !!} >{{$match['hname']}}</p>
                        @else
                            <p class="team host" {!! $impt_style !!} >{{$match['hname']}}</p>
                            <p class="vs" {!! $impt_style !!} >VS</p>
                            <p class="team away" {!! $impt_style !!} >{{$match['aname']}}</p>
                        @endif
                    </a>
                @else
                    <a href="{{\App\Http\Controllers\Mip\UrlCommonTool::matchVideoUrl($match['mid'])}}">
                        <p class="time" {!! $impt_style !!}>{{$match['league_name']}}&nbsp;&nbsp;{{date('H:i', strtotime($match['time']))}}</p>
                        <p class="team host" {!! $impt_style !!}>{{$match['hname']}}</p>
                        <p class="vs" {!! $impt_style !!} >VS</p>
                        <p class="team away" {!! $impt_style !!}>{{$match['aname']}}</p>
                    </a>
                @endif
            @endforeach
        </div>
    @endforeach
    <div class="nolist separated">暂时无直播比赛</div>
@endsection
@section('bottom')
    @include("mip.layout.bottom_cell", ["cur"=>'video'])
@endsection