<?php
// 改变语言
$lan = $_GET['lan'];
if(!empty($lan)){
	setcookie('language', $lan, time()+(60*60*24*30));
	setcookie('language', $lan, time()+(60*60*24*30), '/');
	setcookie('language', $lan, time()+(60*60*24*30), '/learn');

	header('Location: '.$_SERVER['PHP_SELF']);
}




?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Wordgame 4</title>
	<link rel="stylesheet" href="bee.css" />
	<script type="text/javascript" src="jquery-2.1.0.min.js"></script>
	<script type="text/javascript" src="../js/jquery-ui.js"></script>
	<script src="../js/jquery.cookie.js"></script>

	<script type="text/javascript" src="bee.js"></script>
	<link rel="stylesheet" type="text/css" href="../header.css"/>
	<script src="../header.js"></script>
</head>
<body>
<?php include_once("../analyticstracking.php") ?>


<?php
require_once('../startsession.php');
$username = $_SESSION['username'];
require_once('../header.php');

// LANGUAGES
switch($_COOKIE['language']){
	case 'chinese':
		$Ltime = "时间";
		$Lsteps = "步数";
		$Lhighscores = "排行榜";
		$Lrestart = "重新开始";
		$Lsubmitscore = "上传分数";
		$Lyouwin = "你赢了！";
		$Lyoulose = "时间到，你输了！";
		$Lclose = "关闭";
		$Lyourscoreis = "你的得分是";
		$Ltryagain = "再试一次";
		$Lyourname = "你的名字";
		$Lsubmit = "提交";
		break;
	case 'vietnamese':
		$Ltime = "Thời gian";
		$Lsteps = "Số bước";
		$Lhighscores = "Bảng điểm";
		$Lrestart = "Chơi lại";
		$Lsubmitscore = "Tải điểm lên";
		$Lyouwin = "Bạn thắng rồi!";
		$Lyoulose = "Hết thời gian, bạn thua rồi!";
		$Lclose = "Đóng";
		$Lyourscoreis = "Điểm của bạn la ";
		$Ltryagain = "Thử lần nữa";
		$Lyourname = "Tên";
		$Lsubmit = "Tải lên";
		break;
	case 'english':
		$Ltime = "Time";
		$Lsteps = "Steps";
		$Lhighscores = "High Scores";
		$Lrestart = "Restart";
		$Lsubmitscore = "Submit Score";
		$Lyouwin = "You Win!";
		$Lyoulose = "Sorry, Time's Up.";
		$Lclose = "Close";
		$Lyourscoreis = "Your Score is ";
		$Ltryagain = "Try Again";
		$Lyourname = "Your name ";
		$Lsubmit = "Submit";
		break;
	case 'esperanto':
		$Ltime = "Tempo";
		$Lsteps = "Paŝnombro";
		$Lhighscores = "Poentaro";
		$Lrestart = "Restartu";
		$Lsubmitscore = "Submetu Poenton";
		$Lyouwin = "Vi Venkis!";
		$Lyoulose = "Vi Malvenkis!";
		$Lclose = "Fermu";
		$Lyourscoreis = "Via Poento estas ";
		$Ltryagain = "Reprovu";
		$Lyourname = "Via nomo ";
		$Lsubmit = "Submetu";
		break;
	default:
		$Ltime = "Time";
		$Lsteps = "Steps";
		$Lhighscores = "High Scores";
		$Lrestart = "Restart";
		$Lsubmitscore = "Submit Score";
		$Lyouwin = "You Win!";
		$Lyoulose = "Sorry, Time's Up.";
		$Lclose = "Close";
		$Lyourscoreis = "Your Score is ";
		$Ltryagain = "Try Again";
		$Lyourname = "Your name ";
		$Lsubmit = "Submit";
		break;
}


?>

<div id="allgame">

<div id="gameground">

	<div id="game">

		<div class="col1">

			<div class="bigframe" id="bf0">
				<div class="frame a">
					<div class="rect aa rect1"></div>
					<div class="rect aa rect2"></div>
					<div class="rect aa rect3"></div>
				</div>
				<div class="frame b">
					<div class="rect bb rect1"></div>
					<div class="rect bb rect2"></div>
					<div class="rect bb rect3"></div>
					<div class="hz" id="hz0"></div>
				</div>
			</div>

			<div class="bigframe" id="bf1">
				<div class="frame a">
					<div class="rect aa rect1"></div>
					<div class="rect aa rect2"></div>
					<div class="rect aa rect3"></div>
				</div>
				<div class="frame b">
					<div class="rect bb rect1"></div>
					<div class="rect bb rect2"></div>
					<div class="rect bb rect3"></div>
					<div class="hz" id="hz1"></div>
				</div>
			</div>

			<div class="bigframe" id="bf2">
				<div class="frame a">
					<div class="rect aa rect1"></div>
					<div class="rect aa rect2"></div>
					<div class="rect aa rect3"></div>
				</div>
				<div class="frame b">
					<div class="rect bb rect1"></div>
					<div class="rect bb rect2"></div>
					<div class="rect bb rect3"></div>
					<div class="hz" id="hz2"></div>
				</div>
			</div>

			<div class="bigframe" id="bf3">
				<div class="frame a">
					<div class="rect aa rect1"></div>
					<div class="rect aa rect2"></div>
					<div class="rect aa rect3"></div>
				</div>
				<div class="frame b">
					<div class="rect bb rect1"></div>
					<div class="rect bb rect2"></div>
					<div class="rect bb rect3"></div>
					<div class="hz" id="hz3"></div>
				</div>
			</div>

		</div>

		<div class="col2">

			<div class="bigframe" id="bf4">
				<div class="frame a">
					<div class="rect aa rect1"></div>
					<div class="rect aa rect2"></div>
					<div class="rect aa rect3"></div>
				</div>
				<div class="frame b">
					<div class="rect bb rect1"></div>
					<div class="rect bb rect2"></div>
					<div class="rect bb rect3"></div>
					<div class="hz" id="hz4"></div>
				</div>
			</div>

			<div class="bigframe" id="bf5">
				<div class="frame a">
					<div class="rect aa rect1"></div>
					<div class="rect aa rect2"></div>
					<div class="rect aa rect3"></div>
				</div>
				<div class="frame b">
					<div class="rect bb rect1"></div>
					<div class="rect bb rect2"></div>
					<div class="rect bb rect3"></div>
					<div class="hz" id="hz5"></div>
				</div>
			</div>

			<div class="bigframe" id="bf6">
				<div class="frame a">
					<div class="rect aa rect1"></div>
					<div class="rect aa rect2"></div>
					<div class="rect aa rect3"></div>
				</div>
				<div class="frame b">
					<div class="rect bb rect1"></div>
					<div class="rect bb rect2"></div>
					<div class="rect bb rect3"></div>
					<div class="hz" id="hz6"></div>
				</div>
			</div>

			<div class="bigframe" id="bf7">
				<div class="frame a">
					<div class="rect aa rect1"></div>
					<div class="rect aa rect2"></div>
					<div class="rect aa rect3"></div>
				</div>
				<div class="frame b">
					<div class="rect bb rect1"></div>
					<div class="rect bb rect2"></div>
					<div class="rect bb rect3"></div>
					<div class="hz" id="hz7"></div>
				</div>
			</div>

			<div class="bigframe" id="bf8">
				<div class="frame a">
					<div class="rect aa rect1"></div>
					<div class="rect aa rect2"></div>
					<div class="rect aa rect3"></div>
				</div>
				<div class="frame b">
					<div class="rect bb rect1"></div>
					<div class="rect bb rect2"></div>
					<div class="rect bb rect3"></div>
					<div class="hz" id="hz8"></div>
				</div>
			</div>

		</div>



		<div class="col3">

			<div class="bigframe" id="bf9">
				<div class="frame a">
					<div class="rect aa rect1"></div>
					<div class="rect aa rect2"></div>
					<div class="rect aa rect3"></div>
				</div>
				<div class="frame b">
					<div class="rect bb rect1"></div>
					<div class="rect bb rect2"></div>
					<div class="rect bb rect3"></div>
					<div class="hz" id="hz9"></div>
				</div>
			</div>

			<div class="bigframe" id="bf10">
				<div class="frame a">
					<div class="rect aa rect1"></div>
					<div class="rect aa rect2"></div>
					<div class="rect aa rect3"></div>
				</div>
				<div class="frame b">
					<div class="rect bb rect1"></div>
					<div class="rect bb rect2"></div>
					<div class="rect bb rect3"></div>
					<div class="hz" id="hz10"></div>
				</div>
			</div>

			<div class="bigframe" id="bf11">
				<div class="frame a">
					<div class="rect aa rect1"></div>
					<div class="rect aa rect2"></div>
					<div class="rect aa rect3"></div>
				</div>
				<div class="frame b">
					<div class="rect bb rect1"></div>
					<div class="rect bb rect2"></div>
					<div class="rect bb rect3"></div>
					<div class="hz" id="hz11"></div>
				</div>
			</div>

			<div class="bigframe" id="bf12">
				<div class="frame a">
					<div class="rect aa rect1"></div>
					<div class="rect aa rect2"></div>
					<div class="rect aa rect3"></div>
				</div>
				<div class="frame b">
					<div class="rect bb rect1"></div>
					<div class="rect bb rect2"></div>
					<div class="rect bb rect3"></div>
					<div class="hz" id="hz12"></div>
				</div>
			</div>

			<div class="bigframe" id="bf13">
				<div class="frame a">
					<div class="rect aa rect1"></div>
					<div class="rect aa rect2"></div>
					<div class="rect aa rect3"></div>
				</div>
				<div class="frame b">
					<div class="rect bb rect1"></div>
					<div class="rect bb rect2"></div>
					<div class="rect bb rect3"></div>
					<div class="hz" id="hz13"></div>
				</div>
			</div>

			<div class="bigframe" id="bf14">
				<div class="frame a">
					<div class="rect aa rect1"></div>
					<div class="rect aa rect2"></div>
					<div class="rect aa rect3"></div>
				</div>
				<div class="frame b">
					<div class="rect bb rect1"></div>
					<div class="rect bb rect2"></div>
					<div class="rect bb rect3"></div>
					<div class="hz" id="hz14"></div>
				</div>
			</div>

		</div>

		<div class="col4">

			<div class="bigframe" id="bf15">
				<div class="frame a">
					<div class="rect aa rect1"></div>
					<div class="rect aa rect2"></div>
					<div class="rect aa rect3"></div>
				</div>
				<div class="frame b">
					<div class="rect bb rect1"></div>
					<div class="rect bb rect2"></div>
					<div class="rect bb rect3"></div>
					<div class="hz" id="hz15"></div>
				</div>
			</div>

			<div class="bigframe" id="bf16">
				<div class="frame a">
					<div class="rect aa rect1"></div>
					<div class="rect aa rect2"></div>
					<div class="rect aa rect3"></div>
				</div>
				<div class="frame b">
					<div class="rect bb rect1"></div>
					<div class="rect bb rect2"></div>
					<div class="rect bb rect3"></div>
					<div class="hz" id="hz16"></div>
				</div>
			</div>

			<div class="bigframe" id="bf17">
				<div class="frame a">
					<div class="rect aa rect1"></div>
					<div class="rect aa rect2"></div>
					<div class="rect aa rect3"></div>
				</div>
				<div class="frame b">
					<div class="rect bb rect1"></div>
					<div class="rect bb rect2"></div>
					<div class="rect bb rect3"></div>
					<div class="hz" id="hz17"></div>
				</div>
			</div>

			<div class="bigframe" id="bf18">
				<div class="frame a">
					<div class="rect aa rect1"></div>
					<div class="rect aa rect2"></div>
					<div class="rect aa rect3"></div>
				</div>
				<div class="frame b">
					<div class="rect bb rect1"></div>
					<div class="rect bb rect2"></div>
					<div class="rect bb rect3"></div>
					<div class="hz" id="hz18"></div>
				</div>
			</div>

			<div class="bigframe" id="bf19">
				<div class="frame a">
					<div class="rect aa rect1"></div>
					<div class="rect aa rect2"></div>
					<div class="rect aa rect3"></div>
				</div>
				<div class="frame b">
					<div class="rect bb rect1"></div>
					<div class="rect bb rect2"></div>
					<div class="rect bb rect3"></div>
					<div class="hz" id="hz19"></div>
				</div>
			</div>

		</div>

		<div class="col5">

			<div class="bigframe" id="bf20">
				<div class="frame a">
					<div class="rect aa rect1"></div>
					<div class="rect aa rect2"></div>
					<div class="rect aa rect3"></div>
				</div>
				<div class="frame b">
					<div class="rect bb rect1"></div>
					<div class="rect bb rect2"></div>
					<div class="rect bb rect3"></div>
					<div class="hz" id="hz20"></div>
				</div>
			</div>

			<div class="bigframe" id="bf21">
				<div class="frame a">
					<div class="rect aa rect1"></div>
					<div class="rect aa rect2"></div>
					<div class="rect aa rect3"></div>
				</div>
				<div class="frame b">
					<div class="rect bb rect1"></div>
					<div class="rect bb rect2"></div>
					<div class="rect bb rect3"></div>
					<div class="hz" id="hz21"></div>
				</div>
			</div>

			<div class="bigframe" id="bf22">
				<div class="frame a">
					<div class="rect aa rect1"></div>
					<div class="rect aa rect2"></div>
					<div class="rect aa rect3"></div>
				</div>
				<div class="frame b">
					<div class="rect bb rect1"></div>
					<div class="rect bb rect2"></div>
					<div class="rect bb rect3"></div>
					<div class="hz" id="hz22"></div>
				</div>
			</div>

			<div class="bigframe" id="bf23">
				<div class="frame a">
					<div class="rect aa rect1"></div>
					<div class="rect aa rect2"></div>
					<div class="rect aa rect3"></div>
				</div>
				<div class="frame b">
					<div class="rect bb rect1"></div>
					<div class="rect bb rect2"></div>
					<div class="rect bb rect3"></div>
					<div class="hz" id="hz23"></div>
				</div>
			</div>

		</div>

	<!-- end of Game -->
	</div>

	<div id="transparency"></div>
	<!-- win -->
	<div id="win">
		<div id="youwin"><?php echo $Lyouwin?></div>
		<div id="yourscore"><?php echo $Lyourscoreis?><span id="displayscore">0</span></div>
		<div class="button1" id="submitscore"><?php echo $Lsubmitscore?></div>
		<div class="button1 restart"><?php echo $Lrestart?></div>
	</div>
	<!-- lose -->
	<div id="lose">
		<div id="youlose"><?php echo $Lyoulose?></div>
		<div class="button1 restart"><?php echo $Ltryagain?></div>
	</div>
	<!-- submit score -->
	<div id ="submit">
		<div id="submittitle"><?php echo $Lsubmitscore?></div>
		<div id="submitinputdiv"><?php echo $Lyourname?>: <input type="text" id="submitinput"/></div>
		<div class="button1" id="submitscoresubmit"><?php echo $Lsubmit?></div>
		<div class="button1" id="cancelsubmit"><?php echo $Lclose?></div>
	</div>
	<!-- highscores -->
	<div id="highscores">
		<div id="highscorestitle"><?php echo $Lhighscores?></div>
		<div id="highscoresdiv">
		<table id="highscorestable"></table>
		</div>
		<div class="button1" id="closehighscores"><?php echo $Lclose?></div>
	</div>


<!-- end of gameground -->
</div>


<!-- 右侧面板 -->
<div id="panel">
	<div>
		<div class="paneltitle"><?php echo $Ltime?></div>
		<div class="panelcontent" id="time">150</div>
	</div>
	<div>
		<div class="paneltitle"><?php echo $Lsteps?></div>
		<div class="panelcontent" id="step">0</div>
	</div>
	<div>
		<div class="button2" id="highscoresbutton"><?php echo $Lhighscores?></div>
		<div class="button2" id="panelrestart"><?php echo $Lrestart?></div>
	</div>

	<!-- guide -->
	<div id="guide">
		<p>
	</div>


	<div id="by">Designed by <i><strong>Chuc Xin<strong></i></div>
</div>



<!-- end of allgame -->
</div>

<br>
<br>
<?php
require_once('../footer.php');
?>






