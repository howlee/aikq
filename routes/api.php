<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace'=>'IntF'], function (){
    Route::post("/transfer/save", "TransferController@saveTransfer");//保存转会信息
    //Route::get("/transfer/rank", "TransferController@rank");//转会金额排行榜
});

Route::group(['namespace'=>'Api', 'middleware'=>'web'], function () {
    Route::get("/base/auth", "WxAuthController@wxAuthToOther");
    Route::get("/wechat/jsSign", "WxAuthController@jsSign");
});

Route::group(['namespace'=>'IntF'], function () {
    Route::any("/spider/ttzb/{action}", "SpiderTTZBController@index");//天天直播抓取
});

Route::group(["namespace" => 'PC\Article'], function () {
    Route::any("/spider/article/{id}", "ArticleController@logBaiduSpider");//记录百度爬虫进入文章
});

Route::group(["namespace" => 'PC\Record'], function (){
    Route::get("/recordByDate", "RecordController@getRecordByDateJson");
});

Route::group(["namespace" => 'Sync'], function () {
    Route::any("/label/sync/article", "LabelController@syncArticleLabel");//同步文章
});