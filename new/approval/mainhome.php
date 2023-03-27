<script language='javascript'>

</script>

<table width="1200" border="0" cellspacing="0" cellpadding="0" align='center'>
</table>


<!-- icon -->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<!-- font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;700&display=swap" rel="stylesheet">

<style>
.wrap {
  display: flex;
  justify-content: center;
  align-items: center;
}
.container {
  /*width: 60%;*/
  width: 700px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.list-wrap{
  /*width: 60%;*/
  width: 100%;
  text-align: center;
}
.list-title {
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 2rem;
  font-weight: 700;
  margin: 50px 0px 15px 0px;
}
.material-icons {
  font-size: 2rem;
}
.btn-wrap {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}
.list-btn {
  width: 140px;
  height: 70px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 20px;
  padding: 10px;
  margin: 0px 5px 5px 0px;
  text-align: center;
	font-size: 16px;
	color: #000;
  font-family: 'Noto Sans KR', sans-serif;
  cursor: pointer;
}
.list-btn .material-icons {
  margin-bottom: 5px;
  font-size: 2rem;
	color: #000;
}
.list-btn:hover {
  background-color: #c4c4c4;
  font-weight: 700;
}
.color-person {
  background-color: #3766D5;
  color: #fff;
}
.color-person:hover {
  background-color: #4173e7;
}
.finance {
  background-color: #0AB380;
  color: #fff;
}
.finance:hover {
  background-color: #0fc790;
}
.deactivation {
  background-color: #d4d3d3;
}
.list-title-text {
 color: #000;
 font-size: 2rem;
}
.work {
  background-color:  #F7CC3B;
  color: #fff;
}
.work:hover {
  background-color:  #f7d568;
}
@media(max-width: 970px) {
  .wrap {
    height: auto;
  }
  .container {
    width: 80%;
  }
  .list-wrap {
    width: 80%;
  }
}

</style>

<!--<div id="area">

      <ul>
				<li><a href="http://wgroup.smilework.kr/"><i class="fa fa-home fa-2x"></i><span class="name">���ڰ����ý���</span></a></li>
        <li><i class="fa fa-folder-open fa-2x"></i><span class="name">������</span></li>
        <li>
          <i class="fa fa-folder-open fa-2x"></i><span class="name">�ŷ�����</span>
        </li>
        <li>
          <i class="fa fa-folder-open fa-2x"></i><span class="name">���û����</span>
        </li>
        <li>
          <i class="fa fa-folder-open fa-2x"></i><span class="name">��༭</span>
        </li>
        <li>
          <i class="fa fa-folder-open fa-2x"></i><span class="name">�޿�����</span>
        </li>
        <li>
          <i class="fa fa-folder-open fa-2x"></i
          ><span class="name">�λ����ī��</span>
        </li>
        <li>
          <i class="fa fa-folder-open fa-2x"></i
          ><span class="name">����(�ڵ����)</span>
        </li>
        <li>
          <i class="fa fa-folder-open fa-2x"></i><span class="name">�ް���û��</span>
        </li>
        <li>
          <i class="fa fa-folder-open fa-2x"></i><span class="name">�������</span>
        </li>
        <li>
          <i class="fa fa-folder-open fa-2x"></i><span class="name">��༭</span>
        </li>
        <li>
          <i class="fa fa-folder-open fa-2x"></i><span class="name">��༭</span>
        </li>
        <li>
          <i class="fa fa-folder-open fa-2x"></i><span class="name">��༭</span>
        </li>
        <li>
          <i class="fa fa-folder-open fa-2x"></i><span class="name">��༭</span>
        </li>
        <li>
          <i class="fa fa-power-off off fa-2x"></i><span class="name">LOGOUT</span>
        </li>
      </ul>
    </div>-->

		<div class="wrap">

     <div class="container">
      <div class="list-wrap">
        <div class="list-title">
          <div class="list-title-text">�λ�</div>
          <span class="material-icons" style="color: #000;">person</span>
        </div>
        <div class="btn-wrap">
					<a href= "./proof/up_index.php?type=write" >
						<div class="list-btn color-person">��������</div>
					</a>
					<a href= "./career/up_index.php?type=write">
						<div class="list-btn color-person">�������</div>
					</a>
					<a href= "./leave/up_index.php?type=list" >
						<div class="list-btn deactivation">�ް� ��û��</div>
					</a>
          <div class="list-btn deactivation">���� ��û��</div>
          <div class="list-btn deactivation">������ ��û</div>
          <div class="list-btn deactivation">ź�±ٹ���û</div>
          <div class="list-btn deactivation">�ٷνð�����<br/>��û</div>
          <div class="list-btn deactivation">����/����<br/>�ٹ���û</div>
        </div>
      </div>

      <div class="list-wrap">
        <div class="list-title">
          <div class="list-title-text">�繫</div>
          <span class="material-icons" style="color: #000;">request_quote</span>
        </div>
        <div class="btn-wrap">
					<a href="#">
						<div class="list-btn deactivation">������</div>
					</a>
          <a href="#">
						<div class="list-btn deactivation">�ŷ�����</div>
					</a>
					<a href="#">
						<div class="list-btn deactivation">���û����</div>
					</a>
          <a href="#">
						<div class="list-btn deactivation">��༭</div>
					</a>
          <div class="list-btn deactivation">������Ǽ�</div>
          <div class="list-btn deactivation">���� ǰ�Ǽ�</div>
          <div class="list-btn deactivation">�������<br/>��û</div>
        </div>
      </div>

      <div class="list-wrap">
        <div class="list-title">
          <div class="list-title-text">��������</div>
        <span class="material-icons" style="color: #000;">description</span>
        </div>
        <div class="btn-wrap">
          <div class="list-btn deactivation">���� ���<br/>���� ��û��</div>
          <div class="list-btn deactivation">���� ����<br/>��û��</div>
					<a href="./work/up_index.php?type=list"><div class="list-btn work">�ְ� ȸ�Ƿ�</div></a>
        </div>
      </div>

    </div>

  </div>
<script>

</script>