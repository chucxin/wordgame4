$(document).ready(function(){

var bees = ["有", "他", "是", "还", "不", "也", "没", "来", "祝", "昕", "狗", "猫", "哥", "妹", "书"];

var game = new Game();
game.selectBees(bees);

var c = 200;
var t;

// refreshHighscores();


// 点击砖块
$(".rect").mousedown(function(){
	// 如果是第一步就开始计时
	if(game.steps == 0){
		timeCount();
	}

	// debug
	console.log("suc"+game.success);
	console.log("num"+game.numberOfFlipped);

	// 检查此次点击是否有效
	if(game.numberOfFlipped<2 && $(this).parent().parent().attr("class")!="bigframe flipped"){
		// 计步并显示
		game.steps++;
		$("#step").text(game.steps);
		// 翻开
		$(this).parent().parent().addClass("flipped");
		game.numberOfFlipped++;
		// 取所点的id 并加入数列
		var id = $(this).parent().parent().attr("id").slice(2);
		game.flippedTiles.push(id);
		

		// 如果已翻了两块砖
		if(game.numberOfFlipped == 2){
			var id1 = game.flippedTiles[0];
			var id2 = game.flippedTiles[1];
			var yn = game.check2Tiles();
			// 如果两块一样
			if(yn){
				setTimeout(function(){
					$("#bf"+id1+" .bb").css("background-color", "#94FFB0");
					$("#bf"+id2+" .bb").css("background-color", "#94FFB0");
				}, 300);
				// 清空
				game.numberOfFlipped = 0;
				game.flippedTiles = [];
				// 记录砖块
				game.success+=2;
				// 检查是否已翻开所有的砖
				if(game.success == 24){
					game.youwin();
				}

				// debug
				console.log("suc"+game.success);
				console.log("num"+game.numberOfFlipped);
			}else{
				
				game.flippedTiles = [];
				setTimeout(function(){
					game.numberOfFlipped = 0;
					$("#bf"+id1).removeClass("flipped");
					$("#bf"+id2).removeClass("flipped");
					console.log("suc"+game.success);
					console.log("num"+game.numberOfFlipped);
				}, 1000);
			}
		}

	}


});

// 点击 restart
$(".restart").mousedown(function(){
	game.restart();
});
$("#panelrestart").mousedown(function(){
	if($("#win").css("display")!="block" && $("#lose").css("display")!="block" && $("#submit").css("display")!="block" && $("#highscores")!="block"){
		game.restart();
	}
});

// 点击 上传分数
$("#submitscore").mousedown(function(){
	// 显示
	$("#win").css("display", "none");
	$("#submit").css("display", "block");
});
// 点击 上传 （在上传分数页）
$("#submitscoresubmit").mousedown(function(){
	// 准备资料
	// game.score = c * 10 + 100 - game.steps;
	var name = $("#submitinput").val();
	var data = {name:name, score:game.score};
	$.post("submitscore.php", data, function(result){
		console.log(result);
		// 清空输入入框
		$("#submitinput").val("");
		// 刷新并进入排行榜
		refreshHighscores();
		$("#submit").css("display", "none");
		$("#highscores").css("display", "block");
	});
});

// 取消 上传分数
$("#cancelsubmit").mousedown(function(){
	// 显示
	$("#win").css("display", "block");
	$("#submit").css("display", "none");
	// 清空输入框
	$("#submitinput").val("");
});

// 打开排行榜
$("#highscoresbutton").mousedown(function(){
	if($("#win").css("display")!="block" && $("#lose").css("display")!="block" && $("#submit").css("display")!="block"){
		refreshHighscores();
		// 显示
		$("#highscores").css("display", "block");
		$("#transparency").css("display", "block");
	}
	
});

// 关闭排行榜
$("#closehighscores").mousedown(function(){
	$("#highscores").css("display", "none");
	$("#transparency").css("display", "none");
})


// 刷新排行
function refreshHighscores(){
	game.highscores = [];
	$("#highscorestable").html("");
	$.get("highscores.xml", function(xml){
		var scores = [];

		$(xml).find("case").each(function(){
			var name = $(this).find("name").text();
			var score = $(this).find("score").text();
			console.log(name+" "+score);
			scores.push([name, score]);
		})
		// 排序
		while(scores.length > 0){
			for(var i in scores){
				var yn = true;
				for(var ii in scores){
					if(parseInt(scores[i][1]) < parseInt(scores[ii][1])) {
						yn = false;
					}
				}
				if(yn){
					game.highscores.push(scores[i]);
					scores.splice(i, 1);
				}
			}
		}
		console.log(game.highscores);

		// 显示
		var highscoresHtml = "";
		for(var i in game.highscores){
			highscoresHtml += "<tr><td>"+game.highscores[i][0]+"</td><td>"+game.highscores[i][1]+"</td></tr>";
		}
		// 
		$("#highscorestable").html(highscoresHtml);
	});
}


// 游戏状态类
function Game(){
	// 分数
	this.score = 32;
	// 步数
	this.steps = 0;
	// 所剩时间
	this.time = 300;
	// 排行榜
	this.highscores = [];

	// 时间到
	this.youlose = function(){
		clearTimeout(t);
		// 显示
		setTimeout(function(){
			$("#transparency").css("display", "block");
			$("#lose").css("display", "block");
		}, 400);
	}
	// you win
	this.youwin = function(){
		// 
		this.score = c * 10 + 100 - this.steps;
		console.log(this.score);
		// 显示
		setTimeout(function(){
			$("#transparency").css("display", "block");
			$("#win").css("display", "block");
			$("#displayscore").text(game.score);
			console.log(game.score);
		},400);
		clearTimeout(t);
	}

	// 重新玩
	this.restart = function(){
		// 清空
		clearTimeout(t);
		this.score = 0;
		this.steps = 0;
		this.success = 0;
		this.flippedTiles = [];
		this.numberOfFlipped = [];
		c = 200;
		// 把所有的砖都扣过来
		$(".flipped").removeClass("flipped");
		// 显示
		$("#transparency").css("display", "none");
		$("#lose").css("display", "none");
		$("#win").css("display", "none");
		$("#highscores").css("display", "none");
		$("#time").text(c);
		$("#step").text(this.steps);
		// 背景颜色
		$(".bb").css("background-color","#d6d6d6");
		// 重新生成排列
		this.selectBee(bees);
		this.putImages();

	}

	// 此次点击打开的砖数
	this.numberOfFlipped = 0;
	// 此次点开的砖
	this.flippedTiles = [];
	// 一共点开的砖
	this.success = 0;
	// 检查两块砖是否相同
	this.check2Tiles = function(){
		var id1 = this.flippedTiles[0];
		var id2 = this.flippedTiles[1];
		var img1 = "";
		var img2 = "";
		for(var i=0;i<this.numberOfTiles;i++){
			if(this.beeArray[i][1] == id1){
				img1 = this.beeArray[i][0];
			}
			if(this.beeArray[i][1] == id2){
				img2 = this.beeArray[i][0];
			}
		}
		console.log(img1+" "+img2);
		if(img1 == img2){
			return true;
		}else{
			return false;
		}

	}

	// 游戏总砖数
	this.numberOfTiles = 24;
	// 随机选出的12个汉字
	this.bees = [];
	// 随机选出12个汉字的方法
	this.selectBees = function(bees){
		// 先选出12个数字
		var numbers = [];
		while(numbers.length < 12){
			var number = parseInt(Math.random()*bees.length);
			if(numbers.indexOf(number) == -1){
				numbers.push(number);
			}
		}
		for(var i in numbers){
			this.bees.push(bees[numbers[i]]);
		}
		console.log(this.bees);
	}


	// 随机选出的汉字/位置数列
	this.beeArray = [];
	// 汉字/位置数列的方法
	this.selectBee = function(){
		this.beeArray = [];
		// 随机取数
		var locationArray = []
		while(locationArray.length < this.numberOfTiles){
			var number = parseInt(Math.random()*this.numberOfTiles);
			var yn = false;
			for(var i in locationArray){
				if(locationArray[i] == number){
					yn = true;
				}
			}
			if(!yn){
				locationArray.push(number);
			}
		}
		// 组成数组
			// 把图片数列变成两倍
		var doubleBees = [];
		for(var i in this.bees){
			doubleBees.push(bees[i]);
			doubleBees.push(bees[i]);
		}
			// 完成
		for(var i=0;i<this.numberOfTiles;i++){
			this.beeArray.push([doubleBees[i], locationArray[i]]);
		}
	}

	// 将图片放入砖块的方法
	this.putImages = function(){
		for(var i=0;i<this.numberOfTiles;i++){
			var id = this.beeArray[i][1];
			var image = this.beeArray[i][0];
			$("#img"+id).css("background-image", "url(images/"+image+")");
		}
	}
}

// 计时器

window.timeCount = function(){
	if(c == 0){
		game.youlose();
		return;
	}
    c -= 1;
    $("#time").text(c);
    t = setTimeout("timeCount()",1000);
}




});