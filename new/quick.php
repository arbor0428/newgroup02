<script type="text/javascript" language="javascript">
  // 퀵메뉴 시작
  var stmnLEFT = ""; // 스크롤메뉴의 좌측 위치 
  var stmnGAP1 = 100; // 페이지 헤더부분의 여백 
  var stmnGAP2 = 50; // 스크롤시 브라우저 상단과 약간 띄움. 필요없으면 0으로 세팅 
  var stmnBASE = 50; // 스크롤메뉴 초기 시작위치 (아무렇게나 해도 상관은 없지만 stmnGAP1과 약간 차이를 주는게 보기 좋음) 
  var stmnActivateSpeed = 0; // 움직임을 감지하는 속도 (숫자가 클수록 늦게 알아차림) 
  var stmnScrollSpeed = 0; // 스크롤되는 속도 (클수록 늦게 움직임) 

  var stmnTimer;

  function ReadCookie(name) {
    var label = name + "=";
    var labelLen = label.length;
    var cLen = document.cookie.length;
    var i = 0;

    while (i < cLen) {
      var j = i + labelLen;

      if (document.cookie.substring(i, j) == label) {
        var cEnd = document.cookie.indexOf(";", j);
        if (cEnd == -1) cEnd = document.cookie.length;
        return unescape(document.cookie.substring(j, cEnd));
      }
      i++;
    }
    return "";
  }

  function SaveCookie(name, value, expire) {
    var eDate = new Date();
    eDate.setDate(eDate.getDate() + expire);
    document.cookie = name + "=" + value + "; expires=" + eDate.toGMTString() + "; path=/";
  }

  function RefreshStaticMenu() {
    var stmnStartPoint, stmnEndPoint, stmnRefreshTimer;

    stmnStartPoint = parseInt(STATICMENU.style.top, 10);


    stmnEndPoint = document.body.scrollTop + stmnGAP2;

    stmnLimit = parseInt(window.document.body.scrollHeight) - parseInt(STATICMENU.offsetHeight) - 90; //하단에서 10만큼 위로 올려서....스톱
    if (stmnEndPoint > stmnLimit) stmnEndPoint = stmnLimit;

    if (stmnEndPoint < stmnGAP1) stmnEndPoint = stmnGAP1;

    stmnRefreshTimer = stmnActivateSpeed;

    if (stmnStartPoint != stmnEndPoint) {
      stmnScrollAmount = Math.ceil(Math.abs(stmnEndPoint - stmnStartPoint) / 15);
      STATICMENU.style.top = parseInt(STATICMENU.style.top, 10) + ((stmnEndPoint < stmnStartPoint) ? -stmnScrollAmount : stmnScrollAmount);
      stmnRefreshTimer = stmnScrollSpeed;
    }

    stmnTimer = setTimeout("RefreshStaticMenu();", stmnRefreshTimer);
  }

  function ToggleAnimate() {
    if (ANIMATE.value == false) {
      RefreshStaticMenu();
      SaveCookie("ANIMATE", "true", 300);
    } else {
      clearTimeout(stmnTimer);
      STATICMENU.style.top = stmnGAP1;
      SaveCookie("ANIMATE", "false", 300);
    }
  }

  function InitializeStaticMenu() {
    STATICMENU.style.left = stmnLEFT;
    if (ReadCookie("ANIMATE") == "false") {
      ANIMATE.value = true;
      STATICMENU.style.top = document.body.scrollTop + stmnGAP1;
    } else {
      ANIMATE.value = false;
      STATICMENU.style.top = document.body.scrollTop + stmnBASE;
      RefreshStaticMenu();
    }
  }
  // 퀵메뉴 마지막
</script>




<div id="STATICMENU">
  <iframe id="quick_sms" name='ifra_sms' src='/new/quick_sms.php?userid=<?= $GBL_USERID ?>'  frameborder='0' scrolling='no'></iframe>
</div>




<script language="javascript">
  // InitializeStaticMenu(); // 스크롤메뉴를 가동하는 자바스크립트
</script>