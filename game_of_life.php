<html> 
	<head> 
		<title></title> 
		<script type="text/javascript"> 
 
			function GameOfLife () {
			 
				this.init = function (turns,width,height) {
					this.board = new Array(height);
					for (var x = 0; x < height; x++) {
						this.board[x] = new Array(width);
						for (var y = 0; y < width; y++) {
							this.board[x][y] = Math.round(Math.random());
						}
					}
					this.turns = turns;
				}
			 
				this.nextGen = function() {
					this.boardNext = new Array(this.board.length);
					for (var i = 0; i < this.board.length; i++) {
						this.boardNext[i] = new Array(this.board[i].length);
					}
					for (var x = 0; x < this.board.length; x++) {
						for (var y = 0; y < this.board[x].length; y++) {
							var n = 0;
							for (var dx = -1; dx <= 1; dx++) {
								for (var dy = -1; dy <= 1; dy++) {
									if ( dx == 0 && dy == 0){}
									else if (typeof this.board[x+dx] !== 'undefined'
											&& typeof this.board[x+dx][y+dy] !== 'undefined'
											&& this.board[x+dx][y+dy]) {
										n++;
									}
								}	
							}
							var c = this.board[x][y];
							switch (n) {
								case 0:
								case 1:
									c = 0;
									break;
								case 2:
									break; 
								case 3:
									c = 1;
									break;
								default:
									c = 0;
							}
							this.boardNext[x][y] = c;
						}
					}
					this.board = this.boardNext.slice();
				}
			 
				this.print = function(ctx,w,h) {
					if (!w)
						w = 8;
					if (!h)
						h = 8;
					for (var x = 0; x < this.board.length; x++) {
						var l = "";
						for (var y = 0; y < this.board[x].length; y++) {
							if (this.board[x][y])
							// x and y reversed to draw matrix like it looks in source
							// rather than the "actual" positions
								ctx.fillStyle = "orange";
							else
								ctx.fillStyle = "black";
							ctx.fillRect(y*h,x*w,h,w);
						}
					}
				}
			 
				this.start = function(ctx,w,h) {
					for (var t = 0; t < this.turns; t++) {
						this.print(ctx,w,h);
						this.nextGen()
					}
				}
			 
			}
			 
			function init() {
				// Change document title and text under canvas
				document.title = "Coding Sample Part 2";
			 
				var random = new GameOfLife();
				random.init(null,100,100);
			 
				// Get canvas contexts or return 1
				random.canvas = document.getElementById('random');
				if (random.canvas.getContext) {
					random.ctx = random.canvas.getContext('2d');
				} else {
					return 1;
				}
			 
			 
				// Run main() at set interval
				setInterval(function(){run(random,random.ctx,5,5)},200);
				return 0;
			}
			 
			function run(game,ctx,w,h) {
				game.print(ctx,w,h);
				game.nextGen()
			 
				return 0;
			}
			function getInputValue(){
				// Getting the input size value
				var inputVal = document.getElementById("myInput").value;
				
				if(inputVal > 0){
					// Setting the width and height to that value
					document.getElementById("random").width = inputVal;
					document.getElementById("random").height = inputVal;
				}
			}
 
		</script> 
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
		<style>
			html, body {
		  display: flex;
		  justify-content: center;
		  height: 100%;
      }
      body, div, h1, form, input, p { 
		  padding: 0;
		  margin: 0;
		  outline: none;
		  font-family: Roboto, Arial, sans-serif;
		  font-size: 16px;
		  color: #666;
      }
      h1 {
		  padding: 10px 0;
		  font-size: 32px;
		  font-weight: 300;
		  text-align: center;
      }
      p {
		font-size: 12px;
      }
      hr {
		  color: #a9a9a9;
		  opacity: 0.3;
      }
      .main-block {
		  padding: 10px 0;
		  margin: auto;
		  border-radius: 5px; 
		  border: solid 1px #ccc;
		  box-shadow: 1px 2px 5px rgba(0,0,0,.31); 
		  background: #ebebeb; 
      }
      form {
		margin: 0 30px;
      }
      label#icon {
		  margin: 0;
		  border-radius: 5px 0 0 5px;
      }
      input[type=text]{
		  width: calc(100% - 57px);
		  height: 36px;
		  margin: 13px 0 0 -5px;
		  padding-left: 10px; 
		  border-radius: 0 5px 5px 0;
		  border: solid 1px #cbc9c9; 
		  box-shadow: 1px 2px 5px rgba(0,0,0,.09); 
		  background: #fff; 
      }
      #icon {
		  display: inline-block;
		  padding: 9.3px 15px;
		  box-shadow: 1px 2px 5px rgba(0,0,0,.09); 
		  background: #1c87c9;
		  color: #fff;
		  text-align: center;
      }
      .btn-block {
		  margin-top: 10px;
		  text-align: center;
      }
      button {
		  width: 90%;
		  padding: 10px 10px;
		  margin: 10px auto;
		  border-radius: 5px; 
		  border: none;
		  background: #1c87c9; 
		  font-size: 14px;
		  font-weight: 600;
		  color: #fff;
      }
      button {
		background: #26a9e0;
		cursor: pointer;
      }
		</style>
	</head> 
	<body onLoad="init();"> 
		<div class="row">
			<div class="main-block">
				<div>
					<h1>Hello There!</h1><hr>
					<p>Would you be so nice as to enter the size below? i.e. 200</p>
					<hr>
					<label id="icon" for="width"><i class="fas fa-user"></i></label>
					<input type="text" name="width" id="myInput" placeholder="500" required/>
					<div class="btn-block">
						<button class="btn btn-primary" onclick="getInputValue();">SET BOUNDS!</button>
					</div>
					<p>Thanks so much for the consideration and I look forward to hearing back from you. Sincerely, <a href="https://www.venanciogomani.net/" target="_blank">Venancio Gomani</a>.</p>
				</div>
			</div>
			<canvas id="random" width = "400" height = "400"> 
				No canvas support found!
			</canvas>
		</div>
	</body>
</html>