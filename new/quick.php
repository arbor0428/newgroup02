<script type="text/javascript" language="javascript">
  // ���޴� ����
  var stmnLEFT = ""; // ��ũ�Ѹ޴��� ���� ��ġ 
  var stmnGAP1 = 100; // ������ ����κ��� ���� 
  var stmnGAP2 = 50; // ��ũ�ѽ� ������ ��ܰ� �ణ ���. �ʿ������ 0���� ���� 
  var stmnBASE = 50; // ��ũ�Ѹ޴� �ʱ� ������ġ (�ƹ����Գ� �ص� ����� ������ stmnGAP1�� �ణ ���̸� �ִ°� ���� ����) 
  var stmnActivateSpeed = 0; // �������� �����ϴ� �ӵ� (���ڰ� Ŭ���� �ʰ� �˾�����) 
  var stmnScrollSpeed = 0; // ��ũ�ѵǴ� �ӵ� (Ŭ���� �ʰ� ������) 

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

    stmnLimit = parseInt(window.document.body.scrollHeight) - parseInt(STATICMENU.offsetHeight) - 90; //�ϴܿ��� 10��ŭ ���� �÷���....����
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
  // ���޴� ������
</script>




<div id="STATICMENU">
  <iframe id="quick_sms" name='ifra_sms' src='/new/quick_sms.php?userid=<?= $GBL_USERID ?>'  frameborder='0' scrolling='no'></iframe>
</div>




<script language="javascript">
  // InitializeStaticMenu(); // ��ũ�Ѹ޴��� �����ϴ� �ڹٽ�ũ��Ʈ
</script>