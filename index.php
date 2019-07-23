<!DOCTYPE html>
<html>
<head>
	<title>THANOS vs All</title>
	<script type="text/javascript" src="./pixi.min.js"></script>
	<script type="text/javascript" src="./webfont.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.2.min.js"
                  integrity="sha256-lZFHibXzMHo3GGeehn1hudTAP3Sc0uKXBXAzHX1sjtk="
                  crossorigin="anonymous"></script>
</head>
<body>
	<script>
		/*NOTES
		*	power stone: gives extra strength and speed to beam
		*	soul stone: avengers' weapons cannot hurt thanos
		*	time stone: makes avengers move and shoot slower
		*	space stone: enhances the mobility of thanos
		*	mind stone: avengers cant shoot weapons
		*	reality stone: avengers' weapons incraese thanos' health
		*/

		//Check User Agent			
		var UA;
		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
    		UA = "isMobile";
		}
		else{
			UA = "isPC";
		}
		console.log(UA);

		var renderer = PIXI.autoDetectRenderer(window.innerWidth-15,window.innerHeight-20,{
			//transparent:true
			backgroundColor : 0x45095f
		});
		PIXI.settings.SCALE_MODE = PIXI.SCALE_MODES.NEAREST;

		//Graphics
		var tray = new PIXI.Graphics;
		var topbar = new PIXI.Graphics;
		var pulse = new PIXI.Graphics();
		var pb = new PIXI.Graphics();

		var usernameTbBg = new PIXI.Graphics();
		//usernameTbBg.beginFill(0x000000);


		//Textures
		var stage = new PIXI.Container();
		const splscrn = PIXI.Texture.from('splashscreen.png');
		const startscrn = PIXI.Texture.from('startscreen.png');
		const img_play = PIXI.Texture.from('objs/play.png');
		const img_replay = PIXI.Texture.from('objs/replay.png');
		const img_tick = PIXI.Texture.from('objs/tick.png');
		const tex_bg = PIXI.Texture.from('objs/bg_ptn.png');			//space background texture
		const img_ttn = PIXI.Texture.from('objs/bg_ttn.png');			//titan planet in background
		const img_thanos = new PIXI.Texture.from('chars/thanos.png');	//thanos head/ player
		const img_thanos_power = new PIXI.Texture.from('chars/thanos_power.png');	//thanos head with power stone
		const img_thanos_soul = new PIXI.Texture.from('chars/thanos_soul.png');	//thanos head with soul stone
		const img_thanos_time = new PIXI.Texture.from('chars/thanos_time.png');	//thanos head with time stone
		const img_thanos_space = new PIXI.Texture.from('chars/thanos_space.png');	//thanos head with space stone
		const img_thanos_mind = new PIXI.Texture.from('chars/thanos_mind.png');	//thanos head with mind stone
		const img_thanos_reality = new PIXI.Texture.from('chars/thanos_reality.png');	//thanos head with reality stone
		const img_right = new PIXI.Texture.from('objs/arr_right.png');	//right control
		const img_left = new PIXI.Texture.from('objs/arr_left.png');	//left control
		const img_shoot = new PIXI.Texture.from('objs/shoot.png');		//shooting control
		const img_mirror = new PIXI.Texture.from('objs/mirror.png');	//mirror
		const img_hulk_inc = new PIXI.Texture.from('objs/hulk_inc.png');//hulk inc flag
		const img_msl = new PIXI.Texture.from('objs/im_msl.png');		//ironman missile
		const img_msl_2 = new PIXI.Texture.from('objs/im_msl_2.png');	//ironman missile

		var img_irn = new PIXI.Texture.from("chars/ironman.png");		//ironman's head
		var img_cap = new PIXI.Texture.from("chars/captainamerica.png");//cap's head
		var img_hulk = new PIXI.Texture.from("chars/hulk.png");			//hulk's head
		var img_thor = new PIXI.Texture.from("chars/thor.png");			//thor's head
		var img_thor_burst = new PIXI.Texture.from("chars/thor_burst.png");			//thor's head angry
		var img_witch = new PIXI.Texture.from("chars/scarlettwitch.png");//witch head
		var img_strange = new PIXI.Texture.from("chars/drstrange.png");	//strange's head
		var img_spiderman = new PIXI.Texture.from("chars/spiderman.png");//spiderman's head
		var img_vision = new PIXI.Texture.from("chars/vision.png");		//vision's head
		var img_panther = new PIXI.Texture.from("chars/blackpanther.png");//panther's head
		var img_marvel = new PIXI.Texture.from("chars/captainmarvel.png");//marvel's head
		var img_warmachine = new PIXI.Texture.from("chars/warmachine.png");//war machine's head
		var img_hawkeye = new PIXI.Texture.from("chars/hawkeye.png");	//hawkeye head

		var img_beam = new PIXI.Texture.from("objs/beam.png");			//thanos' beam
		var img_beam_p = new PIXI.Texture.from("objs/beam_p.png");		//thanos' beam with power
		const img_beam_f = new PIXI.Texture.from("objs/shoot_shine_f.png");//beam shine
		const img_beam_e = new PIXI.Texture.from("objs/shoot_shine_f.png");//beam shine
		var img_thunder = new PIXI.Texture.from('objs/thor_strike.png');
		var img_power = new PIXI.Texture.from('objs/stone_power.png');	//power stone
		var img_soul = new PIXI.Texture.from('objs/stone_soul.png');	//soul stone
		var img_time = new PIXI.Texture.from('objs/stone_time.png');	//time stone
		var img_space = new PIXI.Texture.from('objs/stone_space.png');	//space stone
		var img_mind = new PIXI.Texture.from('objs/stone_mind.png');	//mind stone
		var img_reality = new PIXI.Texture.from('objs/stone_reality.png');//reality stone
		var img_empty = new PIXI.Texture.from('objs/empty_stone.png');	//empty position of stone

		//Sprites
		var splashscreenBG = new PIXI.Sprite(splscrn);
		var startscreenBG = new PIXI.Sprite(startscrn);
		var btnPlay = new PIXI.Sprite(img_play);
		var btnReplay = new PIXI.Sprite(img_replay);
		var btnTick = new PIXI.Sprite(img_tick);
		var right = new PIXI.Sprite(img_right);
		var left = new PIXI.Sprite(img_left);
		var player = new PIXI.Sprite(img_thanos);
		var icon = new 	PIXI.Sprite(img_hawkeye); //default level 1 icon
		var ttn = new PIXI.Sprite(img_ttn);
		var shooter = new PIXI.Sprite(img_shoot);
		var beam = new PIXI.Sprite(img_beam);
		var beam_f = new PIXI.Sprite(img_beam_f);
		var beam_e = new PIXI.Sprite(img_beam_e);
		var hulk_inc = new PIXI.Sprite(img_hulk_inc);
		var power = new PIXI.Sprite(img_power);
		var soul = new PIXI.Sprite(img_soul);
		var time = new PIXI.Sprite(img_time);
		var space = new PIXI.Sprite(img_space);
		var mind = new PIXI.Sprite(img_mind);
		var reality = new PIXI.Sprite(img_reality);

		//variables
		var H=window.innerHeight;
		var W=window.innerWidth;
		var name = "Anonymous";
		var subName = "Anonymous";
		var fontLoaded = false;
		var hasGameStarted = false;
		var level = 1;
		var thanosHealth = 100;
		var isThanosAlive = false;
		var coolingDown = false;
		var stone1_locked = true;
		var stone2_locked = true;
		var stone3_locked = true;
		var stone4_locked = true;
		var stone5_locked = true;
		var stone6_locked = true;
		var score = 0;
		var beaming = false;
		var bd = 1;		//power stone multiplier/beam damage
		var ss = 1;		//soul stone multiplier
		var ms = false;	//mind stone
		var v = 1;		//velocity of normal beam
		var sp = 1;		//space stone thanos speed
		var pwr = 1.5;	//power of beam
		var s =false;	//shooter state
		var isUsingStone = false;
		var isMoving = false; //is player moving
		var mirrorD = false; //mirror dimension
		var py;			//get Y player location for shoot animation

		//text
		var fontName = 'Press Start 2P';
		
		window.onload = function(){
			WebFont.load(
			{
				active: function(){
								fontLoaded = true;
							},
				google:
				{
					families: [ fontName ]
				}
			});
		};
		var _fontSize = W/16;
		var style =
		{
			fontFamily	: fontName,
			fontSize	: _fontSize,
			fill		: '#ffffff', //thanos color #c7518d
			padding		: 20, // some fonts may require additional space around themselves to render correctly
			wordWrap	: true
		};

		//var playerHealthText = new PIXI.Text("💜", style); //purple heart
		var playerHealthText = new PIXI.Text(thanosHealth.toString(), style);
		//var avengerHealthText = new PIXI.Text("❤️", style); //red heart
		var avengerHealthText = new PIXI.Text("100", style);
		var avengerGHealthText = new PIXI.Text("", style);
		var vs = new PIXI.Text("vs", style);
		var youWonText = new PIXI.Text("Well\xa0done! Thanos\xa0Won.", style);
		var scoreW = new PIXI.Text("Your\xa0Score:", style);
		var scoreText = new PIXI.Text("0", style);
		var enterYourName = new PIXI.Text("(Optional) Enter\xa0your\xa0name:", style);

		var usernameTb = new PIXI.Text("Anonymous", style);
		var lbInfo = new PIXI.Text("Updating\xa0your\xa0name\xa0will\
			reflect\xa0your\xa0name\xa0and\xa0score\
			in\xa0the\xa0leaderboard.", style);
		var tfp = new PIXI.Text("Thanks\xa0for\xa0playing\xa0", style);

		var yay = new PIXI.Text("!", style);
		yay.visible=false;

		var levelText = new PIXI.Text("Level\xa01:\
			Hawkeye", style);

		var lText = new PIXI.Text("Level\xa01", style); //level indicator on topbar

		var coolingText = new PIXI.Text("Cooling\xa0down\xa0the\xa0gauntlet...", style);
		var gotStone = new PIXI.Text(" ", style);
		
		//Tickers
		var tkr_beam = new PIXI.ticker.Ticker(); tkr_beam.stop();
		tkr_beam.add((deltaTime) => {
			if(beaming){
				if(v<30) v+=0.8;
				beam.height +=pwr*v*deltaTime;
				beam.position.y-=pwr*v*deltaTime;
				if(beam.position.y<0  || (mirrorD && beam.position.y < 0.35*H)){
					tkr_beam.stop();
					v = 1;
				}
			}
		});

		function checkHealth(tH) {
			if (tH<1 && tH != NaN) {
				isThanosAlive = false;
				endScreen();
			}
		}

		function endScreen(){
			renderer.view.style.height = H- 120 + "px";
			renderer.view.style.width = W-15 + "px";
			//renderer.view.style.align = "center";
			//renderer.view.style.position.x=(W- renderer.width)/2;
			score = thanosHealth;
			var ask;
			var lastLevel = level;
			//clear scrn
			while(stage.children[0]){
				stage.removeChild(stage.children[0]);
			}//

			if(level<=10){
				console.log("You lost!");
				console.log(lastLevel, thanosHealth);
				stage.addChild(startscreenBG);
				startscreenBG.width = W;
				startscreenBG.height = H;

				scoreText.text = "Try\xa0again!";
				scoreText.scale.set(W/2/scoreText.width, W/2/scoreText.width);
				scoreText.position.set((W- scoreText.width)/2, 0.8*(H- scoreText.height)/2);
				stage.addChild(scoreText);

				scoreW.text = "Avengers\xa0won\
				this\xa0time.";
				scoreW.scale.set(W/1.25/scoreW.width, W/1.25/scoreW.width);
				scoreW.position.set((W- scoreW.width)/2, scoreText.y - 2*(scoreW.height));
				stage.addChild(scoreW);
				
				// youWonText.style.lineHeight = 2*scoreW.height;
				// youWonText.scale.set(W/2/youWonText.width, W/2/youWonText.width);
				// youWonText.position.set((W - youWonText.width)/2, scoreW.y - (youWonText.height + scoreW.height));
				// stage.addChild(youWonText);

				enterYourName.text = "Better\xa0Luck\
				Next\xa0Time.";
				enterYourName.scale.set(W/2/enterYourName.width, W/2/enterYourName.width);
				enterYourName.position.set((W- enterYourName.width)/2, 0.7*H);
				//enterYourName.style.lineHeight = enterYourName.height/0.5;
				stage.addChild(enterYourName);

				btnReplay.scale.set(W/4/btnReplay.width, W/4/btnReplay.width);
				btnReplay.position.set((W- btnReplay.width)/2, scoreText.getBounds().y + 1.2*scoreText.getBounds().height);
				stage.addChild(btnReplay);
				btnReplay.interactive = true;
				btnReplay.buttonMode = true;
				btnReplay.on("pointertap", function(){
					window.location.reload(false);
				});

			}else{
				console.log("You won!");
				var rid =Math.trunc(Math.random()*10000);
				console.log(rid);
				//write to ledger (initially)



				//

				stage.addChild(startscreenBG);
				startscreenBG.width = W;
				startscreenBG.height = H;

				scoreText.text = Math.trunc(score);
				scoreText.scale.set(W/2/scoreText.width, W/2/scoreText.width);
				scoreText.position.set((W- scoreText.width)/2, 0.8*(H- scoreText.height)/2);
				stage.addChild(scoreText);

				scoreW.scale.set(W/2/scoreW.width, W/2/scoreW.width);
				scoreW.position.set((W- scoreW.width)/2, scoreText.y - 2*(scoreW.height));
				stage.addChild(scoreW);

				youWonText.style.lineHeight = 2*scoreW.height;
				youWonText.scale.set(W/2/youWonText.width, W/2/youWonText.width);
				youWonText.position.set((W - youWonText.width)/2, scoreW.y - (youWonText.height + scoreW.height));
				stage.addChild(youWonText);

				enterYourName.scale.set(W/2/enterYourName.width, W/2/enterYourName.width);
				enterYourName.position.set((W- enterYourName.width)/2, 0.7*H);
				enterYourName.style.lineHeight = enterYourName.height/0.5;
				stage.addChild(enterYourName);

				btnReplay.scale.set(W/4/btnReplay.width, W/4/btnReplay.width);
				btnReplay.position.set((W- btnReplay.width)/2, scoreText.getBounds().y + scoreText.getBounds().height);
				stage.addChild(btnReplay);
				btnReplay.interactive = true;
				btnReplay.buttonMode = true;
				btnReplay.on("pointertap", function(){
					window.location.reload(false);
				});

				usernameTb.interactive = true;
				usernameTb.buttonMode = true;
				usernameTb.on("pointertap", function(){
					ask = prompt("Enter your name. Leave blank to save anonymously");
					if(ask==null || ask==""){
						usernameTb.text="Anonymous";
						usernameTb.position.set((W- usernameTb.width)/2, enterYourName.y + (enterYourName.height));
						ask = "Anonymous";
					}
					else{
						name = ask;
						subName = name;
						if(name.length<10){usernameTb.text = name;}
						else{
							subName = name.substring(0, 7) + "..";
							usernameTb.text = subName;
						}
						usernameTb.position.set((W- usernameTb.width)/2, enterYourName.y + (enterYourName.height));
					}
					//// saves the record in db
					writeRecord();
					////
					
					enterYourName.visible = false;
					usernameTb.visible = false;
					usernameTbBg.visible = false;
					btnTick.visible = false;

					tfp.text += subName + " Score\xa0saved\xa0successfully!";
					tfp.scale.set(W/1.15/tfp.width, W/1.15/tfp.width);
					tfp.position.set((W- tfp.width)/2, 0.7*H);
					stage.addChild(tfp);
					// alert("Saved successfully!");
				});
				usernameTb.scale.set(W/2/usernameTb.width, W/2/usernameTb.width);
				usernameTb.position.set((W- usernameTb.width)/2, enterYourName.y + (enterYourName.height));

				usernameTbBg.lineStyle(usernameTb.height*1.2, 0x000000, 0.5);
				usernameTbBg.moveTo(usernameTb.x - 30, usernameTb.y+ usernameTb.height/2);
				usernameTbBg.lineTo(usernameTb.x + usernameTb.width + 30, usernameTb.y+ usernameTb.height/2);
				stage.addChild(usernameTbBg);
				stage.addChild(usernameTb);

// 				btnTick.scale.set(100/usernameTb.height, 100/usernameTb.height);
// 				btnTick.position.set(usernameTb.x+usernameTb.width+50, usernameTb.y);
// 				btnTick.interactive = true;
// 				btnTick.buttonMode = true;
// 				btnTick.on("pointertap", function(){
// 					//remove tb
// 					if(ask=="" || ask == null){subName= "Anonymous";}
					// enterYourName.visible = false;
					// usernameTb.visible = false;
					// usernameTbBg.visible = false;
					// btnTick.visible = false;
// 					//add to ledger
// <?php
					
// ?>
// 					//
// 					tfp.text += subName + " Score\xa0saved\xa0successfully!";
// 					tfp.scale.set(W/1.15/tfp.width, W/1.15/tfp.width);
// 					tfp.position.set((W- tfp.width)/2, 0.6*H);
// 					stage.addChild(tfp);
// 					console.log(name);
// 					alert("Saved successfully!");
// 				});
// 				stage.addChild(btnTick);

				lbInfo.style.lineHeight=2*lbInfo.height/5;
				lbInfo.scale.set(W/1.25/lbInfo.width, W/1.25/lbInfo.width);
				//lbInfo.position.set((W- lbInfo.width)/2, H- 1.2*lbInfo.height);
				lbInfo.position.set((W- lbInfo.width)/2, 1.1*(usernameTbBg.getBounds().y+usernameTbBg.getBounds().height));
				stage.addChild(lbInfo);

			}
		}

		//Avengers
		class Avenger extends PIXI.Sprite{
			//_this = this;
			constructor(identity, dlevel, alevel, amlevel, health, damageT, damageG) {
				super();
				var _this, _identity, isAlive, isAttacking, hasEntered;
				this._this = this;
				this._isAlive = true;
				this._dlevel =  dlevel;
				this._alevel =  alevel;
				this._amlevel =  amlevel;
				this._health = health;
				this._damageT = damageT;
				this._damageG = damageG;
				this._identity = identity;
				switch(this._identity){
					case "ironman":
						this.texture = img_irn; break;
					case "captainamerica":
						this.texture = img_cap; break;
					case "hulk":
						this.texture = img_hulk; break;
					case "thor":
						this.texture = img_thor; break;
					case "scarlettwitch":
						this.texture = img_witch; break;
					case "drstrange":
						this.texture = img_strange; break;
					case "spiderman":
						this.texture = img_spiderman; break;
					case "vision":
						this.texture = img_vision; break;
					case "blackpanther":
						this.texture = img_panther; break;
					case "captainmarvel":
						this.texture = img_marvel; break;
					case "warmachine":
						this.texture = img_warmachine; break;
					case "hawkeye":
						this.texture = img_hawkeye; break;
				}
				this.position.set((W/2)-H/18/2, -W/8);
				this.scale.set(H/(60*18), H/(60*18));
				this.alpha = 0.5;
				this.hasEntered = false;
				
				icon.texture = this.texture;
				avengerHealthText.text = 100;

				levelText.text = "Level\xa0" + level + ":\
				" + this._identity.toString().toUpperCase();

				lText.text = "Level\xa0" + level;

				//gotStone.text = "Gauntlet\xa0is\xa0empty";
			}
			enterWorld(){
				//add health text
				avengerHealthText.scale.set(W/130/8, W/130/8);
				avengerHealthText.position.set(20, 0.15*H-(W/16)-20);//idk but its perfect

				var _this = this._this;
				var _dlevel = this._dlevel;
				var _alevel = this._alevel;
				var _amlevel = this._amlevel;
				var _identity = this._identity;
				var _hasEntered = this.hasEntered;

				if(_identity == "drstrange"){
					var strikesShot = 0;
					var mirror = new PIXI.Sprite(img_mirror);
					mirror.alpha = 0.5;
					mirror.scale.set(W/100, W/100);
					mirror.position.set(0, 0.3*H);	
				}else if(_identity == "thor"){
					var thunderShot=0; var tripp=false; var burst=false;
					var bolt = new PIXI.Graphics();
					bolt.lineStyle(20, 0x4d99ff, 0.5);
					bolt.moveTo(0, 0);
					bolt.lineTo(0, 0.2*H);
					bolt.visible=false;
				}else if(_identity == "ironman"){
					var preX;	//pulse shot X
					var th=0;	//theta
					var _y=0;	//rate of Y of msl
					var _xmsl=-1;	//X of im when msl shot
					var rx=-1	//X of rocket blast
					var mx=-1	//X of msl blast
					var mx2=-1	//X of msl2 blast
					var sw_pulse = 0; //switch pulse
					
					var msl = new PIXI.Sprite(img_msl);
					msl.scale.set(0.5,0.5);
					var msl2 = new PIXI.Sprite(img_msl);
					msl2.scale.set(0.5,0.5);
					
					//pulse is global to use mind stone
					pulse.lineStyle(40, 0xFFFFFF, 0.5);
					pulse.moveTo(0, 0);
					pulse.lineTo(0, H);
					stage.addChild(pulse);
					pulse.visible=false;

					var rocket = new PIXI.Sprite(img_msl_2);
					rocket.scale.set(0.5, 0.5);

					var blast = new PIXI.Graphics();
					blast.beginFill(0xFF7800);
					blast.lineStyle(25, 0xEEFF00, 0.8);
					blast.drawCircle(0, 0, W/6);
					blast.endFill();
					blast.alpha = 0.3;
					stage.addChild(blast);
					blast.visible = false;

					var blast_msl = new PIXI.Graphics();
					blast_msl.beginFill(0xFF7800);
					blast_msl.lineStyle(15, 0xEEFF00, 0.8);
					blast_msl.drawCircle(0, 0, W/12);
					blast_msl.endFill();
					blast_msl.alpha = 0.3;
					stage.addChild(blast_msl);
					blast_msl.visible = false;

					var blast_msl2 = new PIXI.Graphics();
					blast_msl2.beginFill(0xFF7800);
					blast_msl2.lineStyle(15, 0xEEFF00, 0.8);
					blast_msl2.drawCircle(0, 0, W/12);
					blast_msl2.endFill();
					blast_msl2.alpha = 0.3;
					stage.addChild(blast_msl2);
					blast_msl2.visible = false;
				}
				
				var d = 1; //dodging direction
				var strikeProp = [W/18/4, 0x000000, 0.5, 50]; //width, color, opacity, length
				switch(_identity){
					case "ironman":
						strikeProp = [W/18/4, 0xFFFFFF, 0.5, 50];
						break;
					case "captainamerica":
						strikeProp = [W/18/4, 0x0000FF, 0.5, 50];
						break;
					case "hulk":
						strikeProp = [W/18/4, 0x00FF00, 0.5, 50];
						break;
					case "thor":
						strikeProp = [W/18/4, 0xFFFFFF, 0.5, 50];
						break;
					case "scarlettwitch":
						strikeProp = [W/18/4, 0xFF0000, 0.5, 50];
						break;
					case "drstrange":
						strikeProp = [W/18/4, 0xFFD491, 0.8, 80];					
						break;
					case "spiderman":
						strikeProp = [W/18/6, 0xFFFFFF, 1, 100];
						break;
					case "vision":
						strikeProp = [W/18/6, 0xFFF791, 0.8, 200];
						break;
					case "blackpanther":
						strikeProp = [W/18/3, 0xBB00FF, 0.5, 50];
						break;
					case "captainmarvel":
						strikeProp = [W/18/4, 0xFFC14F, 0.5, 80];
						break;
					case "warmachine":
						strikeProp = [W/18/4, 0xFFAAAA, 0.5, 30];
						break;
					case "hawkeye":
						strikeProp = [W/18/8, 0x000000, 1, 90];
						break;
				}
				var entry = setInterval(function(){
					var posY = 0.2;
					levelText.visible = true;
					//gotStone.visible = true;
					if(_identity == "hulk"){posY = 0.83;}
					_this.position.y += _dlevel*10;
					if(_this.position.y > posY*H){
						clearInterval(entry);
						_this.alpha = 1;
						_this.hasEntered = true;
						levelText.visible = false;
						//gotStone.visible = false;
						var dodging = setInterval(function(){
							_this.position.x-=d*_dlevel *10;
							if(_this.position.x < 0){d*=-1;}
							if(_this.position.x > W - _this.width){d*=-1;}
							//avengers hit
							if(beaming && _this._isAlive && _this.hasEntered){
								if(beam.y<=posY*H){
									if((_this.x<beam.x && _this.x+_this.width>beam.x+beam.width)||(beam.x+beam.width>_this.x && beam.x+beam.width<_this.x+_this.width) || (_this.x<beam.x && _this.x+_this.width>beam.x)){
										//HIT CODE
										_this._health -=bd*_this._damageT;
										//_this._health = Math.floor(_this._health);
										avengerHealthText.text = Math.trunc(_this._health);
										avengerHealthText.text = Math.trunc(_this._health)<100 && Math.trunc(_this._health)>=10 ? "0" + Math.trunc(_this._health).toString() : "00" + Math.trunc(_this._health).toString();
										avengerHealthText.text = Math.trunc(_this._health)<1 ? "end" : avengerHealthText.text;

										//avenger dies
										if(_this._health<1){
											_this.visible = false;
											_this._isAlive = false;
											level++;
											if(level<=10){
												addAvenger(level);

												switch(level){
													case 1:break;
													case 2:
													power.texture = img_power;
													stone1_locked = false;
													//gotStone.text="You\xa0got\xa0POWER\xa0stone!";
													//gotStone.position.x = (W-gotStone.width)/2;
													break;
													case 3:
													//gotStone=" "; break;
													case 4:
													soul.texture = img_soul;
													stone2_locked = false;
													//gotStone.text="You\xa0got\xa0SOUL\xa0stone!";
													//gotStone.position.x = (W-gotStone.width)/2;
													break;
													case 5:
													//gotStone=" ";
													break;
													case 6:
													mind.texture = img_mind;
													stone5_locked = false;
													//gotStone.text="You\xa0got\xa0MIND\xa0stone!";
													//gotStone.position.x = (W-gotStone.width)/2;
													break;
													case 7:
													reality.texture = img_reality;
													stone6_locked = false;
													//gotStone.text="You\xa0got\xa0REALITY\xa0stone!";
													//gotStone.position.x = (W-gotStone.width)/2;
													break;
													case 8:
													time.texture = img_time;
													stone3_locked = false;
													//gotStone.text="You\xa0got\xa0SOUL\xa0stone!";
													//gotStone.position.x = (W-gotStone.width)/2;
													break;
													case 9:
													space.texture = img_space;
													stone4_locked = false;
													//gotStone.text="You\xa0got\xa0TIME\xa0stone!";
													//gotStone.position.x = (W-gotStone.width)/2;
													break;
													case 10:
													//gotStone=" ";
													break;
												}

											}else{
												endScreen();
											}
											//remove mirror when drstrange dies
											if (_identity=="drstrange") {
												mirrorD = false;
												mirror.visible=false;
											}
										}
										//
										yay.position.set(_this.x+_this.width, _this.y);
										if(_this._isAlive) yay.visible=true; else yay.visible = false;
									}else yay.visible=false;
								}else yay.visible=false;
							}else yay.visible=false;

							if(!_this._isAlive) clearInterval(dodging);
						}, 100);
						var attack = setInterval(function(){
							if(!ms && _this._isAlive && isThanosAlive){
								var t = (Math.atan(((player.position.y) - (_this.position.y + _this.height)) / (player.position.x + (player.width/2) - (_this.position.x + H/18/2))));
								t = t<0 ? Math.PI+t : t;
								var r=_this.width;
								var dist_tr, dist_tl, dist_br, dist_bl;
								if(_identity == "scarlettwitch"){
									var energy = new PIXI.Graphics();
									energy.beginFill(0xFF0000);
									energy.drawCircle(_this.x, _this.y, r);
									energy.endFill();
									energy.alpha = 0.4;
									stage.addChild(energy);
								}else if(_identity == "thor"){
									var thunder = new PIXI.Sprite.from(img_thunder);
									var thunder2 = new PIXI.Sprite.from(img_thunder);
									var thunder3 = new PIXI.Sprite.from(img_thunder);
									var thunders = [];
									thunders.length = 27; //number of thunders in burst mode (*4)
									for (var i = 0; i < thunders.length; i++) {
										thunders[i] = new PIXI.Sprite(img_thunder);
										thunders[i].scale.set(_this.width/50/2);
										thunders[i].pivot.set(thunders[i].width/2, thunders[i].height/2);
									}
									
									thunder.position.set(_this.x+_this.width/2, _this.y+_this.height);
									thunder.scale.set(_this.width/50/1.25, _this.width/50/1.25);
									thunder.rotation = -(Math.PI/2)+t;
									stage.addChild(thunder);
									thunderShot++;
									if(thunderShot==4){
										if(_this._health>50){
											thunder2.position.set(thunder.x+thunder.width/2, _this.y+_this.height);
											thunder2.scale.set(_this.width/50/1.25, _this.width/50/1.25);
											thunder2.rotation = -((Math.PI/2)-t) -0.26;
											stage.addChild(thunder2);
										
											thunder3.position.set(thunder.x+thunder.width/2, _this.y+_this.height);
											thunder3.scale.set(_this.width/50/1.25, _this.width/50/1.25);
											thunder3.rotation = -((Math.PI/2)-t) +0.26;
											stage.addChild(thunder3);
	
											tripp=true;
											thunderShot=0;	
										}else{
											_this.texture = img_thor_burst;
											stage.addChild(bolt);
											for (var i = 0; i < thunders.length; i++) {
												thunders[i].position.set(_this.x, _this.y);
												stage.addChild(thunders[i]);
											}
											burst=true;
											bolt.visible=true;
											thunderShot=0;
										}
										
									}
								}else if(_identity=="ironman"){
									if(_this._health>50){
										pulse.position.set(_this.x+(_this.width-pulse.width), _this.y+_this.height);
										preX=pulse.x;
									}
	
									sw_pulse+=1;
									if(sw_pulse==3) sw_pulse=0;
	
									var strike = new PIXI.Graphics();
									var strike2 = new PIXI.Graphics();
									if(sw_pulse!=1){
										strike.lineStyle(strikeProp[0], strikeProp[1], strikeProp[2]);
										strike.moveTo(_this.position.x + H/18/2, _this.position.y + _this.height);
										strike.lineTo(_this.position.x + H/18/2 + strikeProp[3]*(Math.cos(t)), _this.position.y + _this.height + strikeProp[3]*(Math.sin(t)));	
	
										strike2.lineStyle(strikeProp[0], strikeProp[1], strikeProp[2]);
										strike2.moveTo(_this.position.x + H/18, _this.position.y + _this.height);
										strike2.lineTo(_this.position.x + H/18 + strikeProp[3]*(Math.cos(t)), _this.position.y + _this.height + strikeProp[3]*(Math.sin(t)));	
	
	
										rocket.position.set(_this.position.x + H/18/2 + strikeProp[3]*(Math.cos(t)), _this.position.y + _this.height + strikeProp[3]*(Math.sin(t)));	
										rocket.rotation = -(Math.PI/2)+t;
									}else{
										if(_xmsl==-1){
											_xmsl=_this.x+_this.width/2;
											th=0;
											_y=0;
											msl.position.set((_xmsl)+_y/200*(50*Math.sin(th)), _y+_this.y+_this.height);
											msl2.position.set((_xmsl)+_y/200*(50*Math.cos(Math.PI/2+th)), _y+_this.y+_this.height);
										}
									}
									
																
								}else if(_identity == "hulk"){
	
								}
								else{
									var strike = new PIXI.Graphics();
									strike.lineStyle(strikeProp[0], strikeProp[1], strikeProp[2]);
									strike.moveTo(_this.position.x + H/18/2, _this.position.y + _this.height);
									strike.lineTo(_this.position.x + H/18/2 + strikeProp[3]*(Math.cos(t)), _this.position.y + _this.height + strikeProp[3]*(Math.sin(t)));	
									if(_identity == "drstrange"){
										strikesShot++;
										if(strikesShot==4){mirrorD=true; stage.addChild(mirror);} else if(strikesShot==6){mirrorD=false; stage.removeChild(mirror);strikesShot=0;}
									}else if(_identity == "captainmarvel"){
										var strike2 = new PIXI.Graphics();
										strike2.lineStyle(strikeProp[0], strikeProp[1], strikeProp[2]);
										strike2.moveTo(_this.position.x + H/18, _this.position.y + _this.height);
										strike2.lineTo(_this.position.x + H/18 + strikeProp[3]*(Math.cos(t)), _this.position.y + _this.height + strikeProp[3]*(Math.sin(t)));	
									}
								}
								var attackMove = setInterval(function(){
									if(_identity == "scarlettwitch"){
											dist_tl = Math.pow(energy.getBounds().x+(energy.width/2)-player.getBounds().x, 2) + Math.pow(energy.getBounds().y+(energy.height/2)-player.getBounds().y, 2);
											dist_tr = Math.pow(energy.getBounds().x+(energy.width/2)-(player.getBounds().x+player.width), 2) + Math.pow(energy.getBounds().y+(energy.height/2)-player.getBounds().y, 2);
											dist_br = Math.pow(energy.getBounds().x+(energy.width/2)-(player.getBounds().x+player.width), 2) + Math.pow(energy.getBounds().y+(energy.height/2)-(player.getBounds().y+player.height), 2);
											dist_bl = Math.pow(energy.getBounds().x+(energy.width/2)-player.getBounds().x, 2) + Math.pow(energy.getBounds().y+(energy.height/2)-(player.getBounds().y+player.height), 2);
											
											if(dist_tr<r*r||dist_tl<r*r||dist_br<r*r||dist_bl<r*r){
												//HIT CODE
												if(_this._damageG==NaN) _this._damageG=1;
												thanosHealth-=ss*_this._damageG;
												//thanosHealth=Math.floor(thanosHealth);
												playerHealthText.text = Math.trunc(thanosHealth)<100 && Math.trunc(thanosHealth)>=10 ? "0" + Math.trunc(thanosHealth).toString() : "00" + Math.trunc(thanosHealth).toString();
												playerHealthText.text = thanosHealth<1 ? "end" : playerHealthText.text;
												if(isThanosAlive)checkHealth(thanosHealth);
											} 
											energy.position.y+=20*_amlevel*Math.sin(t);
											energy.position.x+=20*_amlevel*Math.cos(t);	
											if(energy.position.y > H){ clearInterval(attackMove);stage.removeChild(energy);energy.destroy();}
	
									}else if(_identity=="thor"){
										//THANOS GETS HIT
										if(thunder.getBounds().y>player.y-thunder.height && thunder.getBounds().y<player.y+player.height){
											if((thunder.getBounds().x<player.x && thunder.getBounds().x+thunder.width>player.x)||(thunder.getBounds().x<player.x+player.width && thunder.getBounds().x+thunder.width>player.x+player.width)){
												console.log("ouch");
												//HIT CODE
												if(_this._damageG==NaN) _this._damageG=1;
												thanosHealth-=ss*_this._damageG;
												//thanosHealth=Math.floor(thanosHealth);
												playerHealthText.text = Math.trunc(thanosHealth)<100 && Math.trunc(thanosHealth)>=10 ? "0" + Math.trunc(thanosHealth).toString() : "00" + Math.trunc(thanosHealth).toString();
												playerHealthText.text = thanosHealth<1 ? "end" : playerHealthText.text;
												if(isThanosAlive)checkHealth(thanosHealth);
											}
										}
	
										thunder.position.y+=20*_amlevel*Math.sin(t);
										thunder.position.x+=20*_amlevel*Math.cos(t);	
										if(thunder.position.y > H+200){ clearInterval(attackMove);stage.removeChild(thunder);thunder.destroy();}
	
										if(tripp){
											
											//THANOS GETS HIT
											if(thunder2.getBounds().y>player.y-thunder2.height && thunder2.getBounds().y<player.y+player.height){
												if((thunder2.getBounds().x<player.x && thunder2.getBounds().x+thunder2.width>player.x)||(thunder2.getBounds().x<player.x+player.width && thunder2.getBounds().x+thunder2.width>player.x+player.width)){
													console.log("ouch");
													thanosHealth-=ss*_this._damageG;
													//thanosHealth=Math.floor(thanosHealth);
													playerHealthText.text = Math.trunc(thanosHealth)<100 && Math.trunc(thanosHealth)>=10 ? "0" + Math.trunc(thanosHealth).toString() : "00" + Math.trunc(thanosHealth).toString();
													playerHealthText.text = thanosHealth<1 ? "end" : playerHealthText.text;
												}
											}
	
											//THANOS GETS HIT
											if(thunder3.getBounds().y>player.y-thunder3.height && thunder3.getBounds().y<player.y+player.height){
												if((thunder3.getBounds().x<player.x && thunder3.getBounds().x+thunder3.width>player.x)||(thunder3.getBounds().x<player.x+player.width && thunder3.getBounds().x+thunder3.width>player.x+player.width)){
													console.log("ouch");
													thanosHealth-=ss*_this._damageG;
													//thanosHealth=Math.floor(thanosHealth);
													playerHealthText.text = Math.trunc(thanosHealth)<100 && Math.trunc(thanosHealth)>=10 ? "0" + Math.trunc(thanosHealth).toString() : "00" + Math.trunc(thanosHealth).toString();
													playerHealthText.text = thanosHealth<1 ? "end" : playerHealthText.text;
												}
											}
	
											thunder2.position.y+=20*_amlevel*Math.sin(t-0.26);
											thunder2.position.x+=20*_amlevel*Math.cos(t-0.26);	
											if(thunder2.position.y > H+200){ clearInterval(attackMove);stage.removeChild(thunder2);thunder2.destroy();tripp=false;}
	
											thunder3.position.y+=20*_amlevel*Math.sin(t+0.26);
											thunder3.position.x+=20*_amlevel*Math.cos(t+0.26);	
											if(thunder3.position.y > H+200){ clearInterval(attackMove);stage.removeChild(thunder3);thunder3.destroy();tripp=false;}
	
										}
										if(burst){
											bolt.position.x=_this.x+_this.width/2;
											bolt.position.y=0;
											for (var i = 0; i < thunders.length; i++) {
												if((3.14*(i/thunders.length)*t+0.26) < 2.35 &&(3.14*(i/thunders.length)*t+0.26 > 0.78)){
													//HIT CODE
													if(thunders[i].getBounds().y>player.y-thunders[i].height && thunders[i].getBounds().y<player.y+player.height){
														if((thunders[i].getBounds().x<player.x && thunders[i].getBounds().x+thunders[i].width>player.x)||(thunders[i].getBounds().x<player.x+player.width && thunders[i].getBounds().x+thunders[i].width>player.x+player.width)){
															console.log("ouchs");
															if(_this._damageG==NaN) _this._damageG=1;
															thanosHealth-=ss*_this._damageG;
															//thanosHealth=Math.floor(thanosHealth);
															playerHealthText.text = Math.trunc(thanosHealth)<100 && Math.trunc(thanosHealth)>=10 ? "0" + Math.trunc(thanosHealth).toString() : "00" + Math.trunc(thanosHealth).toString();
															playerHealthText.text = thanosHealth<1 ? "end" : playerHealthText.text;
												if(isThanosAlive)checkHealth(thanosHealth);
														}
													}
													//
													thunders[i].position.y+=20*_amlevel*Math.sin(3.14*(i/thunders.length)*t+0.26);
													thunders[i].position.x+=20*_amlevel*Math.cos(3.14*(i/thunders.length)*t+0.26);	
													thunders[i].pivot.set(thunders[i].width/2, thunders[i].height/2);
													thunders[i].rotation+=0.5;
												}else{stage.removeChild(thunders[i]);} // filter upper burst
											}
											
											if(thunder.y>H){
												for (var i = 0; i < thunders.length; i++) {
													thunders[i].visible=false;
													stage.removeChild(thunders[i]);
												}
												bolt.visible=false;
												burst=false;
												_this.texture = img_thor;
											}
	
										}
									}else if(_identity=="ironman"){
	
										if(_this._health>50){
											pulse.position.set(_this.x+(_this.width-pulse.width), _this.y+_this.height);
											//if((_this.x>preX+0.15*W && d==-1) || (_this.x<preX-0.15*W && d==1)){pulse.visible=false;} //bleh :P
											//THNAOS GETS HIT
											if(pulse.visible){
												if((player.x<pulse.x && player.x+player.width>pulse.x+pulse.width)||(pulse.x+pulse.width>player.x && pulse.x+pulse.width<player.x+player.width) || (player.x<pulse.x && player.x+player.width>pulse.x)){
													//HIT CODE
													if(_this._damageG==NaN) _this._damageG=1;
													thanosHealth-=ss*_this._damageG/10;
													playerHealthText.text = Math.trunc(thanosHealth)<100 && Math.trunc(thanosHealth)>=10 ? "0" + Math.trunc(thanosHealth).toString() : "00" + Math.trunc(thanosHealth).toString();
													playerHealthText.text = thanosHealth<1 ? "end" : playerHealthText.text;
												if(isThanosAlive)checkHealth(thanosHealth);
												}	
											}
	
											if(sw_pulse==1 && !ms){
												pulse.visible=true;
											}else{
												pulse.visible=false;
												strike.position.y+=20*_amlevel*Math.sin(t);
												strike.position.x+=20*_amlevel*Math.cos(t);
												strike2.position.y+=20*_amlevel*Math.sin(t);
												strike2.position.x+=20*_amlevel*Math.cos(t);
												if(strike.position.y > H){stage.removeChild(strike);stage.removeChild(strike2);}else{stage.addChild(strike);stage.addChild(strike2);}
	
												if((strike.getBounds().y+strike.getBounds().height>player.getBounds().y && strike.getBounds().y<player.getBounds().y+player.getBounds().height)&&(strike.getBounds().x>player.getBounds().x && strike.getBounds().x<player.getBounds().x+player.getBounds().width)){
												//HIT CODE
													if(_this._damageG==NaN) _this._damageG=1;
													thanosHealth-=ss*_this._damageG;
													//thanosHealth=Math.floor(thanosHealth);
													playerHealthText.text = Math.trunc(thanosHealth)<100 && Math.trunc(thanosHealth)>=10 ? "0" + Math.trunc(thanosHealth).toString() : "00" + Math.trunc(thanosHealth).toString();
													playerHealthText.text = thanosHealth<1 ? "end" : playerHealthText.text;
												if(isThanosAlive)checkHealth(thanosHealth);
												}
											}
											
										}else{
											stage.removeChild(strike);
											stage.removeChild(strike2);
											stage.removeChild(pulse);
											if(sw_pulse==1){
												if(msl.y<H){
													stage.addChild(msl2);
													_y+=H/50;
													th+=H/10000;
													msl.position.set((_xmsl)+_y/200*(50*Math.sin(th)), _y+_this.y+_this.height);
													msl2.position.set((_xmsl)+_y/200*(50*Math.cos(Math.PI/2+th)), _y+_this.y+_this.height);
													//Missile hit
														if(msl.y>player.y){
															if(mx==-1){mx=msl.x;mx2=msl2.x;}
															blast_msl.position.set(mx, player.y+player.height/2);
															blast_msl2.position.set(mx2, player.y+player.height/2);
															blast_msl.visible = true;
															blast_msl2.visible = true;
															//HIT CODE
															if((Math.abs(player.x+player.width/2 - blast_msl.x) < blast_msl.width/2 + player.width/2)||(Math.abs(player.x+player.width/2 - blast_msl2.x) < blast_msl2.width/2 + player.width/2)){
																if(_this._damageG==NaN) _this._damageG=1;
																thanosHealth-=ss*_this._damageG/4;
																////thanosHealth=Math.floor(thanosHealth);
																playerHealthText.text = Math.trunc(thanosHealth)<100 && Math.trunc(thanosHealth)>=10 ? "0" + Math.trunc(thanosHealth).toString() : "00" + Math.trunc(thanosHealth).toString();
																playerHealthText.text = thanosHealth<1 ? "end" : playerHealthText.text;
												if(isThanosAlive)checkHealth(thanosHealth);
															}
															//
															stage.removeChild(msl);
															stage.removeChild(msl2);
															if(msl.getBounds().y>H){
																blast_msl.visible = false;
																blast_msl2.visible = false;
																clearInterval(attackMove);
																mx=-1;
																mx2=-1;
																_xmsl=-1;
															}
														}else stage.addChild(msl);
													//
												}
											}else{
	
												rocket.position.y+=20*_amlevel*Math.sin(t);
												rocket.position.x+=20*_amlevel*Math.cos(t);
												if(rocket.position.y > player.y){
													if(rx==-1){rx=rocket.x;} 
													blast.position.set(rx, player.y+player.height/2);
													blast.visible = true;
													//HIT CODE
													if(Math.abs(player.x+player.width/2 - blast.x) < blast.width/2 + player.width/2){
														if(_this._damageG==NaN) _this._damageG=1;
														thanosHealth-=ss*_this._damageG/2;
														//thanosHealth=Math.floor(thanosHealth);
														playerHealthText.text = Math.trunc(thanosHealth)<100 && Math.trunc(thanosHealth)>=10 ? "0" + Math.trunc(thanosHealth).toString() : "00" + Math.trunc(thanosHealth).toString();
														playerHealthText.text = thanosHealth<1 ? "end" : playerHealthText.text;
												if(isThanosAlive)checkHealth(thanosHealth);
													}
													//
													stage.removeChild(rocket);
													if(rocket.getBounds().y>H){
														blast.visible = false;
														clearInterval(attackMove);
														rx=-1;
													}
												}else stage.addChild(rocket);
											}
											
										}
	
									}else{
										
										//THANOS GETS HIT
										if((strike.getBounds().y+strike.getBounds().height>player.getBounds().y && strike.getBounds().y<player.getBounds().y+player.getBounds().height)&&(strike.getBounds().x>player.getBounds().x && strike.getBounds().x<player.getBounds().x+player.getBounds().width)){
											//HIT CODE
											if(_this._damageG==NaN) _this._damageG=1;
											thanosHealth-=ss*_this._damageG;
											//thanosHealth=Math.floor(thanosHealth);
											playerHealthText.text = Math.trunc(thanosHealth)<100 && Math.trunc(thanosHealth)>=10 ? "0" + Math.trunc(thanosHealth).toString() : "00" + Math.trunc(thanosHealth).toString();
											playerHealthText.text = thanosHealth<1 ? "end" : playerHealthText.text;
											if(isThanosAlive)checkHealth(thanosHealth);
										}
										//
										strike.position.y+=20*_amlevel*Math.sin(t);
										strike.position.x+=20*_amlevel*Math.cos(t);
	
										if(strike.position.y > H){ clearInterval(attackMove);stage.removeChild(strike);}else{stage.addChild(strike);}
										if(_identity == "captainmarvel"){

											//THANOS GETS HIT
											if((strike2.getBounds().y+strike2.getBounds().height>player.getBounds().y && strike2.getBounds().y<player.getBounds().y+player.getBounds().height)&&(strike2.getBounds().x>player.getBounds().x && strike2.getBounds().x<player.getBounds().x+player.getBounds().width)){
												//HIT CODE
												if(_this._damageG==NaN) _this._damageG=1;
												thanosHealth-=ss*_this._damageG;
												//thanosHealth=Math.floor(thanosHealth);
												playerHealthText.text = Math.trunc(thanosHealth)<100 && Math.trunc(thanosHealth)>=10 ? "0" + Math.trunc(thanosHealth).toString() : "00" + Math.trunc(thanosHealth).toString();
												playerHealthText.text = thanosHealth<1 ? "end" : playerHealthText.text;
												if(isThanosAlive)checkHealth(thanosHealth);
											}
											//

											strike2.position.y+=20*_amlevel*Math.sin(t);
											strike2.position.x+=20*_amlevel*Math.cos(t);
											if(strike2.position.y > H){ clearInterval(attackMove);stage.removeChild(strike2);}else{stage.addChild(strike2);}
										}
									}
								},50);		//_amlevel is already used inside the inteval
							}
						}, 3000/_alevel);
					}
				}, 100);
				console.log(this._dlevel);
				console.log(this._alevel);
				console.log(this._amlevel);
			}
		}


		class AvengerG extends PIXI.Sprite{
			constructor(identity, dlevel, alevel, amlevel, health, damageT, damageG){
				super();
				var _this, _identity, health, isAlive, isAttacking, hasEntered;
				this._this = this;
				this._isAlive = true;
				this._dlevel =  dlevel;
				this._alevel =  alevel;
				this._amlevel =  amlevel;
				this._health = health;
				this._damageT = damageT;
				this._damageG = damageG;
				this._identity = identity;
				switch(this._identity){
					case "hulk":
						this.texture = img_hulk;
					break;
				}
				this.position.set(-2*W, 0.83*H);
				this.scale.set(H/(60*18), H/(60*18));
				this.hasEntered = false;

				var trayG = new PIXI.Graphics();
				trayG.lineStyle()
				var icon = new 	PIXI.Sprite(this.texture);
				icon.scale.set(W/54/8, W/54/8);
				icon.position.set(40+1.5*(W/8)+40, 20);
				stage.addChild(icon);
			}
			enterWorld(){
				avengerGHealthText.text = 100;
				avengerGHealthText.scale.set(W/130/8, W/130/8);
				avengerGHealthText.position.set(20+(1.5*W/8)+40, 0.15*H-(W/16)-20);//idk but its perfect
				var d = 1;
				var _this = this._this;
				var _dlevel = this._dlevel;
				var _alevel = this._alevel;
				var _amlevel = this._amlevel;
				var _identity = this._identity;
				var _hasEntered = this.hasEntered;
				var dodging = setInterval(function(){
					_this.position.x-=d * _dlevel *10;
					if(_this.position.x < -2*W){d*=-1;}
					if(_this.position.x > 3*W){d*=-1;}
					if(!_this._isAlive)clearInterval(dodging);
					//add incoming flag
					if(_this.position.x>-0.45*W && _this.position.x<0 && d==-1){
						hulk_inc.scale.x = 1; hulk_inc.position.set(10, shooter.y+shooter.height+(right.y-hulk_inc.height-shooter.y-shooter.height)/2); stage.addChild(hulk_inc); 
					}else if(_this.position.x<1.45*W && _this.position.x>W && d==1){
						hulk_inc.scale.x = -1; hulk_inc.position.set(W-20, shooter.y+shooter.height+(right.y-hulk_inc.height-shooter.y-shooter.height)/2); stage.addChild(hulk_inc);
					}else stage.removeChild(hulk_inc);
					//
					//collision with thanos
					if(_this.position.x-player.position.x > (-_this.width/2) && _this.position.x-player.position.x < (_this.width/2)){
						d*=-1;
						//HIT CODE
						//avenger dies
						if(_this._health<1){
							_this.visible = false;
							_this._isAlive = false;
						}
						//

						if(_this._damageG==NaN) _this._damageG=1;
						thanosHealth-=ss*_this._damageG*2;
						//thanosHealth=Math.floor(thanosHealth);
						playerHealthText.text = Math.trunc(thanosHealth)<100 && Math.trunc(thanosHealth)>=10 ? "0" + Math.trunc(thanosHealth).toString() : "00" + Math.trunc(thanosHealth).toString();
						playerHealthText.text = thanosHealth<1 ? "end" : playerHealthText.text;
						if(isThanosAlive)checkHealth(thanosHealth);
						//
						//Hulk hits Thanos
						_this._health -=_this._damageT*5;
						_this._health = Math.floor(_this._health);
						avengerGHealthText.text = _this._health;
						avengerGHealthText.text = _this._health<100 && _this._health>=10 ? "0" + _this._health.toString() : "00" + _this._health.toString();
						avengerGHealthText.text = _this._health<1 ? "end" : avengerGHealthText.text;
					}
				}, 100);
			}
		}

		//

		function addBg(){
			//add pttn
			var repH = 3;
			if (UA=="isPC") repH = 5; else rep = 3;
			var scaleH = (W/(600*repH));
			var repV = Math.floor((H/(W/repH)));
			for (var i=0; i < repV+1; i++) {
				for (var j=0; j<repH; j++) {
					var bg = new PIXI.Sprite(tex_bg);
					bg.position.set(j*W/repH, i*W/repH);
					bg.scale.set(scaleH,scaleH);
					stage.addChild(bg);	
				}
			}
			//add titan
			ttn.position.set(W*0.65,H*0.85);
			ttn.scale.set(W/(480*2),W/(480*2));
			ttn.alpha=0.5;
			stage.addChild(ttn);

			//add topbar
			topbar.lineStyle(0.15*H, 0x000000, 0.3);
			topbar.moveTo(0, 0.075*H);
			topbar.lineTo(W, 0.075*H);
			stage.addChild(topbar);
			//
		}
		//F addBg();

		function addPlayer(){
			player.scale.set(H/(110*18), H/(110*18)); //18 times smaller than screen height
			player.position.set((W-45)/2, 0.82*H);
			stage.addChild(player);
			isThanosAlive = true;
			py = player.y; 
		}
		//F addPlayer();

/*
			var im = new Avenger("ironman", 2, 1, 2, 100, 0.5, 1); // identity, dodge level, attack level, attackmove level, health, damage takes, damage gives
			stage.addChild(im);	
			im.enterWorld();

			var hulk = new AvengerG("hulk", 2, 1, 2, 100, 1, 1); // identity, dodge level, attack level, attackmove level
			stage.addChild(hulk);	
			hulk.enterWorld();		
		
*/	

		function addFrontend(){
			//add 
			//add controls
			var t=false;
			var lt = new PIXI.ticker.Ticker(); lt.stop();
			var lf = false;
			left.interactive = true;
			left.buttonMode = true;
			left.on("pointerdown", function(){
				left.scale.set(left.scale.x-0.05, left.scale.y-0.05);
				left.y+=10;
				if(!beaming){lt.start(); isMoving = true;}
				lf=!lf;
				if(lf && !beaming){
					lt.add(function(deltaTime){
						if(player.position.x > 0 && lt.started) player.position.x-=5*sp*deltaTime;
					});
					lf=!lf;
				}
				t = !t;
			});
			left.on("pointerup", function(){
				if(t){
					left.scale.set(left.scale.x+0.05, left.scale.y+0.05);
					left.y-=10;	
					t=!t;
					lt.stop();
					isMoving = false;
					lf=!lf;
				}
			});
			left.on("pointerout", function(){
				if (t){
					left.scale.set(left.scale.x+0.05, left.scale.y+0.05);
					left.y-=10;	
					t=!t;
					lt.stop();
					isMoving = false;
					lf=!lf;
				}
			});
			left.on("pointerupoutside", function(){
				if (t){
					left.scale.set(left.scale.x+0.05, left.scale.y+0.05);
					left.y-=10;	
					t=!t;
					lt.stop();
					isMoving = false;
					lf=!lf;
				}
			});

			
			left.alpha = 0.3;
			left.scale.set(W/(190*6), W/(190*6)); //6 times smaller than width
			left.position.set(10, H -((W*225/(180*6)+W/6 + 20)));
			stage.addChild(left);


			var t2 = false;
			var rt = new PIXI.ticker.Ticker();
			var rf = false;
			right.interactive = true;
			right.buttonMode = true;
			//right.on("pointertap", moveRight);
			right.on("pointerdown", function(){
				right.scale.set(right.scale.x-0.05, right.scale.y-0.05);
				right.y+=10;
				if(!beaming){ rt.start(); isMoving = true; }
				rf=!rf;
				if(rf && !beaming){
					rt.add((deltaTime) => {
						if(player.position.x < W-player.width-10 && rt.started) player.position.x+=5*sp*deltaTime;
					});
					rf=!rf;
				}
				t2=!t2;
			});
			right.on("pointerup", function(){
				if (t2) {
					right.scale.set(right.scale.x+0.05, right.scale.y+0.05);
					right.y-=10;
					t2=!t2;
					rt.stop();
					isMoving = false;
					rf=!rf;
				}
			});
			right.on("pointerout", function(){
				if (t2){
					right.scale.set(right.scale.x+0.05, right.scale.y+0.05);
					right.y-=10;	
					t2=!t2;
					rt.stop();
					isMoving = false;
					rf=!rf;
				}
			});
			right.on("pointerupoutside", function(){
				if (t2){
					right.scale.set(right.scale.x+0.05, right.scale.y+0.05);
					right.y-=10;	
					t2=!t2;
					rt.stop();
					isMoving = false;
					rf=!rf;
				}
			});
			right.position.set((5*W/6)-25, H -((W*225/(180*6)+W/6 + 20))); //divides width in 6 parts and places Right on the last part
			right.alpha = 0.3;
			right.scale.set(W/(190*6), W/(190*6)); //6 times smaller than width
			stage.addChild(right);

			//shooter
			shooter.alpha = 0.3;
			shooter.scale.set(W/(190*6), W/(190*6)); //6 times smaller than width
			shooter.position.set(W - shooter.width - 25, H*0.55);
			shooter.interactive = true;
			shooter.buttonMode = true;

			shooter.on("pointerdown", function(){
				shooter.scale.set(shooter.scale.x-0.05, shooter.scale.y-0.05);
				shooter.y+=10;
				s=!s;
				if(!isMoving){
					beaming = true;
					shoot();
				}
			});
			shooter.on("pointerup", function(){
				if(s){
					shooter.scale.set(shooter.scale.x+0.05, shooter.scale.y+0.05);
					shooter.y-=10;
					s=!s;
					beaming = false;
					tkr_beam.stop();
					stage.removeChild(beam);
					stage.removeChild(beam_f);
				}
			});
			shooter.on("pointerout", function(){
				if(s){
					shooter.scale.set(shooter.scale.x+0.05, shooter.scale.y+0.05);
					shooter.y-=10;
					s=!s;
					beaming = false;
					tkr_beam.stop();
					stage.removeChild(beam);
					stage.removeChild(beam_f);
				}
			});
			shooter.on("pointerupoutside", function(){
				if(s){
					shooter.scale.set(shooter.scale.x+0.05, shooter.scale.y+0.05);
					shooter.y-=10;
					s=!s;
					beaming = false;
					tkr_beam.stop();
					stage.removeChild(beam);
					stage.removeChild(beam_f);
				}
				
			});
			stage.addChild(shooter);
			//end controls

			//add topbar items
			icon.scale.set(W/54/8, W/54/8);
			icon.position.set(20, 20);
			stage.addChild(icon);

			var thanos_icon = new PIXI.Sprite(img_thanos);
			thanos_icon.scale.set(W/110/8, W/110/8);
			thanos_icon.position.set(W-20-(W/8), 20);
			stage.addChild(thanos_icon);

			playerHealthText.scale.set(W/130/8, W/130/8);
			playerHealthText.position.set(W-W/4.5, 0.15*H-(W/16)-20);//idkw but its perfect

			vs.position.set((W-(W/16))/2, 20+(W/16));
			
			var writeScore = setInterval(function(){
				if(fontLoaded){
					stage.addChild(vs);
					stage.addChild(playerHealthText);
					stage.addChild(avengerHealthText);
					stage.addChild(avengerGHealthText);
					stage.addChild(yay);	

					levelText.scale.set(W/2.5/levelText.width, W/2.5/levelText.width);
					levelText.position.set((W - levelText.width)/2, (H - levelText.height)/2);
					levelText.visible = false;
					stage.addChild(levelText);

					//gotStone.scale.set(W/1.5/gotStone.width, W/1.5/gotStone.width);
					//gotStone.position.set((W-gotStone.width)/2 ,levelText.y+(2*levelText.height));
					//gotStone.visible = false;
					stage.addChild(gotStone);

					lText.scale.set(W/3/lText.width, W/3/lText.width);
					lText.position.set((W - lText.width)/2, 0.15*H-(W/16)-20);
					stage.addChild(lText);

					clearInterval(writeScore);
				}
			},1000);
			
			//


		}
		//F addFrontend();

		function shoot(){
			console.log("shoot");
			//animate recoil thanos
			player.y+=10;
			var ticker = new PIXI.ticker.Ticker();
			ticker.start();	
			ticker.add((deltaTime) => {
				if(player.y<py) ticker.stop();
				player.y-=1 * deltaTime;
			});	
			ticker.remove();
			//

			beam.scale.set((player.width*0.5)/44, (player.width*0.5)/44);
			beam.alpha = 0.5;
			beam.position.set(player.position.x + (player.width - (player.width*0.5))/2, player.position.y - 10);
			beam.scale.y = 0;

			beam_f.alpha = 0.7;
			beam_f.scale.set(player.width*0.8/11, player.width*0.8/11);
			beam_f.position.set(player.position.x + (player.width - (player.width*0.8))/2, player.position.y - beam_f.height - 10);

			v = 1;
			tkr_beam.start();

			stage.addChild(beam);
			stage.addChild(beam_f);
		}

		function addStones(){
			tray.lineStyle((W*225/(180*6))*0.8, 0x000000, 0.3);
			tray.moveTo(0, H - (W*225/(180*6))/2);
			tray.lineTo(W, H - (W*225/(180*6))/2);
			stage.addChild(tray);

			power.scale.set(W/(180*6), W/(180*6)); //6 times smaller than Width
			power.position.set(0, H - W*225/(180*6));
			power.interactive = true;
			power.buttonMode = true;
			power.on("pointertap", function(){
				if(!isUsingStone && !coolingDown  && !stone1_locked){
					console.log("power");
					isUsingStone = true;
					beam.texture = img_beam_p;
					player.texture = img_thanos_power;
					pwr = 2.5;
					//do smth here
					bd=3;
					//highlight stone
					var disableStone = new PIXI.Graphics;
					disableStone.lineStyle((W*225/(180*6))*0.8, 0x000000, 0.5);
					disableStone.moveTo(W/6, H - (W*225/(180*6))/2);
					disableStone.lineTo(W, H - (W*225/(180*6))/2);
					stage.addChild(disableStone);
					var selectedStone = new PIXI.Graphics;
					selectedStone.lineStyle((W*225/(180*6))*0.8, 0x009900, 0.5);
					selectedStone.moveTo(0, H - (W*225/(180*6))/2);
					selectedStone.lineTo(W/6, H - (W*225/(180*6))/2);
					stage.addChild(selectedStone);
					//
					var count=setInterval(function(){
						selectedStone.width-=(W/6)/100;
						if(selectedStone.width<0){
							console.log("done");
							isUsingStone = false;
							stage.removeChild(disableStone);
							beam.texture = img_beam;
							player.texture = img_thanos;
							pwr = 1.5;
							bd=1;
							clearInterval(count);
							coolDown();
						}
					},100);
				}
			});
			stage.addChild(power);

			soul.scale.set(W/(180*6), W/(180*6)); //6 times smaller than Width
			soul.position.set(W/6, H - W*225/(180*6));
			soul.interactive = true;
			soul.buttonMode = true;
			soul.on("pointertap", function(){
				if(!isUsingStone && !coolingDown && !stone2_locked){
					console.log("soul");
					isUsingStone = true;
					//do smth here
					player.texture = img_thanos_soul;
					player.alpha = 0.5;
					ss=0;
					//highlight stone
					var disableStone = new PIXI.Graphics;
					disableStone.lineStyle((W*225/(180*6))*0.8, 0x000000, 0.5);
					disableStone.moveTo(0, H - (W*225/(180*6))/2);
					disableStone.lineTo(W/6, H - (W*225/(180*6))/2);
					disableStone.moveTo(W*2/6, H - (W*225/(180*6))/2);
					disableStone.lineTo(W, H - (W*225/(180*6))/2);
					stage.addChild(disableStone);
					var selectedStone = new PIXI.Graphics;
					selectedStone.lineStyle((W*225/(180*6))*0.8, 0x009900, 0.5);
					selectedStone.moveTo(W/6, H - (W*225/(180*6))/2);
					selectedStone.lineTo(W*2/6, H - (W*225/(180*6))/2);
					stage.addChild(selectedStone);
					var count=setInterval(function(){
						selectedStone.width-=(W/6)/100;
						selectedStone.position.x+=(W/6)/100;
						if(selectedStone.width<0){
							console.log("done");
							isUsingStone = false;
							stage.removeChild(disableStone);
							//reverse effects
							player.texture = img_thanos;
							player.alpha = 1;
							ss=1;
							clearInterval(count);
							coolDown();
						}
					},100);
				}
			});
			stage.addChild(soul);

			time.scale.set(W/(180*6), W/(180*6)); //6 times smaller than Width
			time.position.set(W/6*2, H - W*225/(180*6));
			time.interactive = true;
			time.buttonMode = true;
			time.on("pointertap", function(){
				if(!isUsingStone && !coolingDown && !stone3_locked){
					console.log("time");
					isUsingStone = true;
					//do smth here
					player.texture = img_thanos_time;
					//highlight stone
					var disableStone = new PIXI.Graphics;
					disableStone.lineStyle((W*225/(180*6))*0.8, 0x000000, 0.5);
					disableStone.moveTo(0, H - (W*225/(180*6))/2);
					disableStone.lineTo(W*2/6, H - (W*225/(180*6))/2);
					disableStone.moveTo(W*3/6, H - (W*225/(180*6))/2);
					disableStone.lineTo(W, H - (W*225/(180*6))/2);
					stage.addChild(disableStone);
					var selectedStone = new PIXI.Graphics;
					selectedStone.lineStyle((W*225/(180*6))*0.8, 0x009900, 0.5);
					selectedStone.moveTo(W*2/6, H - (W*225/(180*6))/2);
					selectedStone.lineTo(W*3/6, H - (W*225/(180*6))/2);
					//
					var count=setInterval(function(){
						selectedStone.width-=(W/6)/100;
						selectedStone.position.x+=2*(W/6)/100;
						if(selectedStone.width<0){
							console.log("done");
							isUsingStone = false;
							stage.removeChild(disableStone);
							//reverse effects
							player.texture = img_thanos;
							clearInterval(count);
							coolDown();
						}
					},100);
					stage.addChild(selectedStone);
				}
			});
			stage.addChild(time);

			space.scale.set(W/(180*6), W/(180*6)); //6 times smaller than Width
			space.position.set(W/6*3, H - W*225/(180*6));
			space.interactive = true;
			space.buttonMode = true;
			space.on("pointertap", function(){
				if(!isUsingStone && !coolingDown  && !stone4_locked){
					console.log("space");
					isUsingStone = true;
					//do smth here
					player.texture = img_thanos_space;
					sp = 3;	//thanos mobility X3
					//highlight stone
					var disableStone = new PIXI.Graphics;
					disableStone.lineStyle((W*225/(180*6))*0.8, 0x000000, 0.5);
					disableStone.moveTo(0, H - (W*225/(180*6))/2);
					disableStone.lineTo(W*3/6, H - (W*225/(180*6))/2);
					disableStone.moveTo(W*4/6, H - (W*225/(180*6))/2);
					disableStone.lineTo(W, H - (W*225/(180*6))/2);
					stage.addChild(disableStone);
					var selectedStone = new PIXI.Graphics;
					selectedStone.lineStyle((W*225/(180*6))*0.8, 0x009900, 0.5);
					selectedStone.moveTo(W*3/6, H - (W*225/(180*6))/2);
					selectedStone.lineTo(W*4/6, H - (W*225/(180*6))/2);
					var count=setInterval(function(){
						selectedStone.width-=(W/6)/100;
						selectedStone.position.x+=3*(W/6)/100;
						if(selectedStone.width<0){
							console.log("done");
							isUsingStone = false;
							stage.removeChild(disableStone);
							//reverse effects
							player.texture = img_thanos;
							sp = 1;
							clearInterval(count);
							coolDown();
						}
					},100);
					stage.addChild(selectedStone);
				}
			});
			stage.addChild(space);

			mind.scale.set(W/(180*6), W/(180*6)); //6 times smaller than Width
			mind.position.set(W/6*4, H - W*225/(180*6));
			mind.interactive = true;
			mind.buttonMode = true;
			mind.on("pointertap", function(){
				if(!isUsingStone && !coolingDown && !stone5_locked){
					console.log("mind");
					isUsingStone = true;
					//do smth here
					player.texture = img_thanos_mind;
					ms = true;
					//highlight stone
					var disableStone = new PIXI.Graphics;
					disableStone.lineStyle((W*225/(180*6))*0.8, 0x000000, 0.5);
					disableStone.moveTo(0, H - (W*225/(180*6))/2);
					disableStone.lineTo(W*4/6, H - (W*225/(180*6))/2);
					disableStone.moveTo(W*5/6, H - (W*225/(180*6))/2);
					disableStone.lineTo(W, H - (W*225/(180*6))/2);
					stage.addChild(disableStone);
					var selectedStone = new PIXI.Graphics;
					selectedStone.lineStyle((W*225/(180*6))*0.8, 0x009900, 0.5);
					selectedStone.moveTo(W*4/6, H - (W*225/(180*6))/2);
					selectedStone.lineTo(W*5/6, H - (W*225/(180*6))/2);
					var count=setInterval(function(){
						selectedStone.width-=(W/6)/100;
						selectedStone.position.x+=4*(W/6)/100;
						if(selectedStone.width<0){
							console.log("done");
							stage.removeChild(disableStone);
							isUsingStone = false;
							//reverse effects
							player.texture = img_thanos;
							ms = false;
							clearInterval(count);
							coolDown();
						}
					},100);
					stage.addChild(selectedStone);
				}
			});
			stage.addChild(mind);

			reality.scale.set(W/(180*6), W/(180*6)); //6 times smaller than Width
			reality.position.set(W/6*5, H - W*225/(180*6));
			reality.interactive = true;
			reality.buttonMode = true;
			reality.on("pointertap", function(){
				if(!isUsingStone && !coolingDown && !stone6_locked){
					console.log("reality");
					isUsingStone = true;
					//do smth here
					ss=-0.5;
					player.texture = img_thanos_reality;
					//highlight stone
					var disableStone = new PIXI.Graphics;
					disableStone.lineStyle((W*225/(180*6))*0.8, 0x000000, 0.5);
					disableStone.moveTo(0, H - (W*225/(180*6))/2);
					disableStone.lineTo(W*5/6, H - (W*225/(180*6))/2);
					disableStone.moveTo(W*6/6, H - (W*225/(180*6))/2);
					disableStone.lineTo(W, H - (W*225/(180*6))/2);
					stage.addChild(disableStone);
					var selectedStone = new PIXI.Graphics;
					selectedStone.lineStyle((W*225/(180*6))*0.8, 0x009900, 0.5);
					selectedStone.moveTo(W*5/6, H - (W*225/(180*6))/2);
					selectedStone.lineTo(W*6/6, H - (W*225/(180*6))/2);
					var count=setInterval(function(){
						selectedStone.width-=(W/6)/100;
						selectedStone.position.x+=5*(W/6)/100;
						if(selectedStone.width<0){
							console.log("done");
							isUsingStone = false;
							stage.removeChild(disableStone);
							//reverse effects
							ss=1;
							player.texture = img_thanos;
							clearInterval(count);
							coolDown();
						}
					},100);
					stage.addChild(selectedStone);
				}
			});
			stage.addChild(reality);

			//empty stones
			power.texture = img_empty;
			soul.texture = img_empty;
			time.texture = img_empty;
			space.texture = img_empty;
			mind.texture = img_empty;
			reality.texture = img_empty;
			//

		}
		//F addStones();

		function addAvenger(level){
			switch(level){
				case 1:
					var he = new Avenger("hawkeye", 1, 0.5, 2, 100, 1.7, 0.5); // identity, dodge level, attack level, attackmove level, health, damage takes, damage gives
					stage.addChild(he);
					he.enterWorld();
				break;
				case 2:
					var wm = new Avenger("warmachine", 1.5, 0.75, 1.5, 100, 1.3, 1); // identity, dodge level, attack level, attackmove level, health, damage takes, damage gives
					stage.addChild(wm);
					wm.enterWorld();
				break;
				case 3: 
					var bp = new Avenger("blackpanther", 1.5, 1, 2, 100, 1, 1.1); // identity, dodge level, attack level, attackmove level, health, damage takes, damage gives
					stage.addChild(bp);
					bp.enterWorld();
				break;
				case 4:
					var sm = new Avenger("spiderman", 2, 1, 2, 100, 1.4, 1.4); // identity, dodge level, attack level, attackmove level, health, damage takes, damage gives
					stage.addChild(sm);
					sm.enterWorld();
				break;
				case 5:
					var vn = new Avenger("vision", 2, 1, 2, 100, 1.4, 0.9); // identity, dodge level, attack level, attackmove level, health, damage takes, damage gives
					stage.addChild(vn);
					vn.enterWorld();
				break;
				case 6:
					var sw = new Avenger("scarlettwitch", 2, 1, 2, 100, 1.4, 1); // identity, dodge level, attack level, attackmove level, health, damage takes, damage gives
					stage.addChild(sw);
					sw.enterWorld();
				break;
				case 7:
					var ds = new Avenger("drstrange", 2, 1, 2, 100, 1.2, 1.8); // identity, dodge level, attack level, attackmove level, health, damage takes, damage gives
					stage.addChild(ds);
					ds.enterWorld();
				break;
				case 8:
					var cm = new Avenger("captainmarvel", 2, 1, 2, 100, 1, 1.4); // identity, dodge level, attack level, attackmove level, health, damage takes, damage gives
					stage.addChild(cm);
					cm.enterWorld();
				break;
				case 9:
					var tr = new Avenger("thor", 2, 1, 2, 100, 1, 1.2); // identity, dodge level, attack level, attackmove level, health, damage takes, damage gives
					stage.addChild(tr);
					tr.enterWorld();

					var hk = new AvengerG("hulk", 2, 1, 2, 100, 1, 1); // identity, dodge level, attack level, attackmove level
					stage.addChild(hk);
					hk.enterWorld();
				break;
				case 10:
					var im = new Avenger("ironman", 2, 1, 2, 100, 0.9, 1); // identity, dodge level, attack level, attackmove level, health, damage takes, damage gives
					stage.addChild(im);
					im.enterWorld();
				break;
			}
		}

		function startGame() {
			if(!hasGameStarted){
				renderer.view.style.height = H-20 + "px";
				renderer.view.style.width = W-15 + "px";

				addBg();
				addPlayer();
//==============================================================================fix hack
				addAvenger(1);
				//level=10;
/*
				var hulk = new AvengerG("hulk", 2, 1, 2, 100, 1, 1); // identity, dodge level, attack level, attackmove level
				stage.addChild(hulk);
				hulk.enterWorld();


				var count=0;
				var add = setInterval(function(){
					var im = new Avenger("drstrange", 2.5, 1, 2); // identity, dodge level, attack level, attackmove level
					stage.addChild(im);	
					im.enterWorld();
					count++;
					if(count==3){clearInterval(add);}
				}, 2000);
*/			
				addFrontend();
				addStones();
			}
			hasGameStarted = true;
		}

		function startscreen(){
			renderer.view.style.height = H- 120 + "px";
			renderer.view.style.width = W-15 + "px";
			//clear scrn
			stage.removeChild(splashscreenBG);
			stage.removeChild(pb);
			//
			//add bg
			startscreenBG.width=W; startscreenBG.height=H;
			stage.addChild(startscreenBG);
			startscreenBG.interactive = true;
			startscreenBG.buttonMode = true;
			//
			var b=0;
			var greetText = "Ever\xa0wondered\xa0how\
			hard\xa0it\xa0would\xa0have\
			been\xa0for\xa0thanos\xa0to\
			fight\xa0the\xa0avengers?\
			I\xa0mean,\xa0deciding\
			which\xa0stone\xa0to\xa0use\
			when\xa0and\xa0against\
			whom\xa0doesn't\xa0look\
			easy.\xa0Well,\xa0let's\
			check\xa0out\xa0how\
			good\xa0thanos\xa0you\
			can\xa0be..";
			
			var tva1 = new PIXI.Text("THANOS", style);
			tva1.scale.set(W/1.5/tva1.width, W/1.5/tva1.width);
			tva1.position.set((W-tva1.width)/2, 100);
			stage.addChild(tva1);

			var tva2 = new PIXI.Text("VS\xa0\xa0THE", style);
			tva2.scale.set(W/3/tva2.width, W/3/tva2.width);
			tva2.position.set((W-tva2.width)/2, 250);
			stage.addChild(tva2);

			var tva3 = new PIXI.Text("AVENGERS", style);
			tva3.scale.set(W/1.5/tva3.width, W/1.5/tva3.width);
			tva3.position.set((W-tva3.width)/2, 350);
			stage.addChild(tva3);

			btnPlay.position.set((W-btnPlay.width)/2, 0.8*H);
			btnPlay.alpha = 0.5;
			btnPlay.interactive = true;
			btnPlay.buttonMode = true;
			btnPlay.visible=false;
			stage.addChild(btnPlay);

			var greet = new PIXI.Text("", style);
			greet.scale.set(0.5, 0.5);
			greet.style.lineHeight = 120;
			greet.position.set(0.1*W, 0.3*H);
			stage.addChild(greet);

			var tapToContText = new PIXI.Text("Tap\xa0to\xa0continue!", style);
			tapToContText.visible=false;
			tapToContText.scale.set(W/1.5/tapToContText.width, W/1.5/tapToContText.width);
			tapToContText.position.set((W-tapToContText.width)/2, 0.85*H);
			stage.addChild(tapToContText);
			
			

			function greet2(){
				btnPlay.visible = true;
				tapToContText.visible = false;
				greet.text="";
				greetText = "In\xa0this\xa0game,\xa0you’re\xa0THANOS\
				and\xa0you\xa0have\xa0to\xa0beat\xa0all\
				the\xa0Avengers.\xa0Thanos\xa0can\
				move\xa0right\xa0&\xa0left\xa0and\xa0can\
				shoot\xa0beam\xa0using\xa0the\
				controls.\
				...\
				Remember,\xa0the\xa0power\
				stone\xa0gives\xa0more\xa0power,\xa0duh.\
				Soul\xa0stone\xa0will\xa0make\xa0you\
				invisible\xa0to\xa0the\xa0Avengers.\
				Time\xa0ka\xa0pata\xa0nhi\xa0abhi.\
				Space\xa0stone\xa0helps\xa0you\xa0move\
				faster.\xa0Mind\xa0stone\xa0will\xa0stop\
				the\xa0Avengers\xa0from\xa0shooting.\
				And\xa0use\xa0the\xa0reality\xa0stone\
				to\xa0incraese\xa0Thanos'\xa0health.";
				stage.removeChild(tva1);
				stage.removeChild(tva2);
				stage.removeChild(tva3);
				if (b==1){typer();}
				btnPlay.on("pointertap", function(){
					if(!hasGameStarted) while(stage.children[0]){stage.removeChild(stage.children[0]);}
					startGame();
				});

			}

			function startBlinking(){
				b=1;
				var blinking = setInterval(function(){
					tapToContText.visible=!tapToContText.visible;
				}, 500);
				startscreenBG.on("pointertap", function(){
					clearInterval(blinking);
					greet2();
				});
			}


			function typer(){
				if(b==1) b=2;
				greet.text = "";
				var i = 0;	//keystroke effect
				startscreenBG.on("pointertap", function(){
					console.log(b);
					greet.text=greetText;
					if(b==0) greet.position.set((W-greet.width)/2, 0.3*H);
					else if(b==2) greet.position.set((W-greet.width)/2, 0.05*H);
					clearInterval(type);
					if(b==0) startBlinking();
				});
				var type = setInterval(function(){
					
					greet.text += greetText.charAt(i);
					if(b==0) greet.position.set((W-greet.width)/2, 0.3*H);
					else if(b==2) greet.position.set((W-greet.width)/2, 0.05*H);
					if(i<greetText.length)
						i++; 
					else{ 
						clearInterval(type);
						if(b==0) startBlinking();
					}
				}, 50);
			}
			
			typer();
			
		}

		function splash(){
			
			splashscreenBG.position.set(0,0);
			splashscreenBG.height = H;
			splashscreenBG.width = W;
			stage.addChild(splashscreenBG);
			
			pb.lineStyle(50, 0x4c015a, 1);
			pb.moveTo(0.2*W - 20, 0.85*H);
			pb.lineTo(0.8*W + 20, 0.85*H);
			pb.lineStyle(25, 0x4c015a, 1);
			pb.moveTo(0.2*W - 30, 0.85*H);
			pb.lineTo(0.8*W + 30, 0.85*H);
			
			var p = 0;
			var prog = setInterval(function(){
				p++;
				pb.lineStyle(10, 0xffffff, 1);
				pb.moveTo(0.2*W + 15, 0.85*H);
				pb.lineTo((0.8*W*p/5) + 15, 0.85*H);	
				stage.addChild(pb);
				if(p==5){
					clearInterval(prog);
					var initStScrn = setInterval(function(){
						if(fontLoaded){
							startscreen();
							clearInterval(initStScrn);
						}
					}, 500);
				}
			}, 300);
		}

		function main(){

			var dlgs = new Array("Part of the journey is the end.",
			 "Whatever it takes.",
			 "You could not live with your own failure, and where did that bring you? Back to me.",
			 "On your left.",
			 "Hail Hydra.",
			 "This is the fight of our lives.",
			 "Can you buzz me in?",
			 "Thanos did exactly what he said he was gonna do. He wiped out 50%  of all living creatures.",
			 "Fun isn’t something one considers when balancing the universe. But this… does put a smile on my face.",
			 "When I’m done, half of humanity will still exist. Perfectly balanced, as all things should be. I hope they remember you.",
			 "You’re strong. But I could snap my fingers, and you’d all cease to exist.",
			 "We are in the endgame now.",
			 "Stark… you have my respect. I hope the people of Earth will remember you.",
			 "The hardest choices require the strongest wills.",
			 "You should have gone for the head.",
			 "I went for the head.",
			 "I am Ironman.",
			 "I love you 3000.",
			 "Cheeseburgers.");
			//console.log(dlgs);
			splash(); //start scrn is auto


		}main();
		
		function render(){
 			requestAnimationFrame(render);
  			renderer.render(stage);
		}
		render();
		document.body.appendChild(renderer.view);

	// var entrydata= {Name:name};
	// $(document).on("click", "#save", function(e){ 
	// 	e.preventDefault();
	// 	//get the textarea data bu its id="demo"
	// 	//var textdata = score;
	// 	console.log(subName);
	// 	request = $.ajax({
	// 		type:'POST',
	// 		data: entrydata,
	// 		url: 'ledger/update.php',
	// 		success: function(data) {                
	// 			if(data){
	// 				$("#demo").html(data);//load data from update.php
	// 				alert('Saved!');
	// 			}else{
	// 				alert('Update failed');
	// 			}
	// 		}
	// 		});
	// });

	function coolDown() {
		coolingDown = true;

		var coolCounterBG = new PIXI.Graphics;
		coolCounterBG.lineStyle((W*225/(180*6))*0.8, 0x000000, 0.75);
		coolCounterBG.moveTo(0, H - (W*225/(180*6))/2);
		coolCounterBG.lineTo(W, H - (W*225/(180*6))/2);
		stage.addChild(coolCounterBG);

		var coolCounter = new PIXI.Graphics;
		coolCounter.lineStyle((W*225/(180*6))*0.8, 0x1b9a9b, 0.5);
		coolCounter.moveTo(0, H - (W*225/(180*6))/2);
		coolCounter.lineTo(W, H - (W*225/(180*6))/2);
		stage.addChild(coolCounter);

		stage.addChild(coolingText);
		coolingText.visible = true;
		coolingText.scale.set(W/1.5/1890, W/1.5/1890);
		coolingText.position.set((W-coolingText.width)/2, H - (W*225/(180*6))/2);
		//coolingText.visible = true;

		var counter = setInterval(function(){
			coolCounter.width-=W/200;
			if (coolCounter.width<0) {
				coolCounter.visible=false;
				coolCounterBG.visible=false;
				coolingText.visible = false;
				stage.removeChild(coolingText);
				clearInterval(counter);
				coolingDown = false;
			}
		}, 100);
	}

	function writeRecord(){
		var raw = name.toString() + "|" + Math.trunc(score).toString();
		var entrydata= {param:raw};
		console.log(entrydata);
		//get the textarea data bu its id="demo"
		request = $.ajax({
			type:'POST',
			data: entrydata,
			url: 'ledger/update.php',
			// success: function(data) {                
			// 	if(data){
			// 		alert('Saved!');
			// 	}else{
			// 		alert('Update failed');
			// 	}
			// }
		});	
		document.getElementById('ledger').contentWindow.location.reload(true);
	}

	</script>
	<center><h1 style="font-size: 48px">^ Scroll to unfold leaderboard ^</h1></center>
	<iframe id="ledger" src="ledger/index.php" style="height: 1024px; width: 100%;"></iframe>
</body>
</html>