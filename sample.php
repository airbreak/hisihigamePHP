<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wxe567cacaccd3a88f", "bc3b100bc72d6240fbda0b54856a8820");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width ,initial-scale=1.0,maximum-scale=1.0,user-scalable=0;" />
    <title>轰炸设计师</title>
	<link href="area/css/home.css" rel="stylesheet/less" />
    <script src="area/js/jquery-1.8.2.min.js"></script>
    <script src="area/js/angular.min.js"></script>
    <script src="area/js/less-1.3.3.min.js"></script>
    <script src="area/js/prefixfree.min.js"></script>
    <script src="area/js/home.js"></script>
</head>
<body>
  <div class="wrapper">
        <div class="contentWrapper wrapperItem">
             <div class="aboutGameNotice btnsItem"></div>
            <div class="header">
                <div class="gameTitle"></div>
            </div>
            <div class="btnsContents">
                <div class="btns">
                    <div class="startGame btnsItem"></div>
                    <div class="showRecord btnsItem"></div>
                </div>
            </div>
            <div class="footer"></div>
            <div class="gameNotice">
                <div class="closeGameNotice btnsItem"></div>
                <p>在30秒之内，</p>
                <p>答对题目累计积分。</p>
                <p>连击翻倍，答对加分，答错不扣分</p>
                <p>题目无上限,</p>
                <p>比比你的反应力吧！</p>
            </div>
            <div class="gameRecords" ng-app="myApp">
                <div class="closeGameRecords btnsItem"></div>
                <div class="gameRecordsContent">
                    <table ng-controller="gameRecordsController">
                        <tr ng-repeat="item in items">
                            <td>{{item.date}}</td>
                            <td>{{item.scores}}</td>
                            <td>{{item.name}}</td>
                        </tr>
                    </table>
                    <p>第一次玩吧，一边自个儿玩去！</p>
                </div>
            </div>
        </div>
        <div class="gameContentWrapper wrapperItem">
            <div class="gameContentHeader"><div class="questionNum">第&nbsp;<span id="totalDoneQuestionsNum">1</span>&nbsp;题</div></div>
            <div class="gameContentPeople"></div>
            <div class="gameContentTime"><span></span><label class="timeDetailInfo"></label></div>
            <div class="moreInfoSeeHisihi"><a href="http://hisihi.com" target="_blank"></a></div>
            <div class="gameContentQuestion"><p>在ps中，ctrl+v是复制的快捷键么</p></div>
            <div class="doubleHitInfo"><p>&nbsp;×<span class="doubleHitNums"></span>&nbsp;</p></div>
            <div class="wrongAnsweInfo"></div>
            <div class="rightAnsweInfo"></div>
            <div class="gameContentBtns">
                    <div class="btnYes btnsItem"></div>
                    <div class="btnNo btnsItem"></div>
            </div>
        </div>

        <div class="gameOverWrapper wrapperItem">
            <div class="gameResultPanel">
                <div class="scoresWrapper">
                    <div class="scoresLevel scoreLevelHide"></div>
                    <div class="scroresBg"><p>本局累计积分</p><p><span id="totalScores"">0</span>分</p></div>
                    <div class="scroresDescription">
                        <!--<p>你已超过<span id="defeatPeopleCounts">12313432</span>名设计师</p>-->
                        <p>获得&nbsp;&nbsp;<span id="yourHonor"></span>&nbsp;&nbsp;称号！！</p>
                    </div>
                    <div class="gameResultBtns">
                        <div class="shareToFriends btnsItem"></div>
                        <div class="oneMoreTime btnsItem"></div>
                    </div>
                </div>
            </div>
            <!--<div class="gameRankingListPanel"></div>-->
            <div class="gameOverFooter"><a href="http://hisihi.com" target="_blank"></a></div>
        </div>

    </div>
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
  /*
   * 注意：
   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
   * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
   *
   * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
   * 邮箱地址：weixin-open@qq.com
   * 邮件主题：【微信JS-SDK反馈】具体问题
   * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
   */
  wx.config({
    debug: false,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
        'checkJsApi','chooseImage','onMenuShareAppMessage'
    ]
  });
  wx.ready(function () {
    // 在这里调用 APIs
    wx.onMenuShareAppMessage({
      title: '轰炸设计师', // 分享标题
      desc: '我得到了 '+game.totalScores+' 分，获得 '+game.scorcesName+' 称号,轰炸设计师,快来试试', // 分享描述
      link: 'http://wechat.hisihi.com/Sample/sample.php', // 分享链接
      imgUrl: '', // 分享图标
      type: 'link', // 分享类型,music、video或link，不填默认为link
      dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
      success: function () {
		alert(game);
		alert(game.totalScores);
		alert(game.scorcesName);
        // 用户确认分享后执行的回调函数
        alert('分享成功');
      },
      cancel: function () {
        // 用户取消分享后执行的回调函数
        alert('取消');
      }
    });
  });

/*  weixin://contacts/profile/wxe567cacaccd3a88f*/

  wx.error(function(res){
    // config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。
  });


</script>
</html>
