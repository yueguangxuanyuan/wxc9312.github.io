<?php
/**
 * Typecho Blog Platform
 *
 * @copyright  Copyright (c) 2008 Typecho team (http://www.typecho.org)
 * @license    GNU General Public License 2.0
 * @version    $Id: index.php 1153 2009-07-02 10:53:22Z magike.net $
 */

/** 载入配置支持 */
if (!defined('__TYPECHO_ROOT_DIR__') && !@include_once 'config.inc.php') {
    file_exists('./install.php') ? header('Location: install.php') : print('Missing Config File');
    exit;
}

/** 初始化组件 */
Typecho_Widget::widget('Widget_Init');

/** 注册一个初始化插件 */
Typecho_Plugin::factory('index.php')->begin();

/** 开始路由分发 */
Typecho_Router::dispatch();

/** 注册一个结束插件 */
Typecho_Plugin::factory('index.php')->end();
?>


<div id="kuaile" style="position:fixed;z-index:5000; top:0px; left:0px" >
	<a href="javascript:show()">
		<img src="http://chunc.pub/xinnian.jpg"></img>
	</a>
	</div>
<div id="zhici" onload="after_func()" style="position:fixed;z-index：10000 ;top:0px; left:0px ;width:100%;height:100%;display:none;background:rgba(10%,20%,30%,0.3);text-align:center" onClick="hide()">
	<img  style="top:50%;left:50%;position:relative;transform(-50%,-50%)" src ="http://chunc.pub/zhici.jpg">
</div>	
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<script>


	var keys = { 33:1, 34:1, 35:1 , 36:1 ,37: 1, 38: 1, 39: 1, 40: 1 };

	function preventDefault(e) {
		e = e || window.event;
		if (e.preventDefault)
			e.preventDefault();
		e.returnValue = false;
	}

	function preventDefaultForScrollKeys(e) {
		if (keys[e.keyCode]) {
			preventDefault(e);
			return false;
		}
	}
	var oldonwheel, oldonmousewheel1, oldonmousewheel2, oldontouchmove, oldonkeydown
	, isDisabled;
	function disableScroll() {
		if (window.addEventListener) // older FF
			window.addEventListener('DOMMouseScroll', preventDefault, false);
		oldonwheel = window.onwheel;
		window.onwheel = preventDefault; // modern standard

		oldonmousewheel1 = window.onmousewheel;
		window.onmousewheel = preventDefault; // older browsers, IE
		oldonmousewheel2 = document.onmousewheel;
		document.onmousewheel = preventDefault; // older browsers, IE

		oldontouchmove = window.ontouchmove;
		window.ontouchmove = preventDefault; // mobile

		oldonkeydown = document.onkeydown;
            document.onkeydown = preventDefaultForScrollKeys;
            isDisabled = true;
	}

	function enableScroll() {
		if (!isDisabled) return;
		if (window.removeEventListener)
			window.removeEventListener('DOMMouseScroll', preventDefault, false);

		window.onwheel = oldonwheel; // modern standard

		window.onmousewheel = oldonmousewheel1; // older browsers, IE
		document.onmousewheel = oldonmousewheel2; // older browsers, IE

		window.ontouchmove = oldontouchmove; // mobile

		document.onkeydown = oldonkeydown;
		isDisabled = false;
	}
	window.scrollHanlder = {
		disableScroll: disableScroll,
		enableScroll: enableScroll
	};
	
	var show = function(){
		document.getElementById("zhici").style.display = "block";
		document.getElementById("zhici").style['z-index'] = "10000";
		document.body.style.overflow='hidden';
		document.body.style['padding–right']="17px";
	};
	var hide = function(){
		document.getElementById("zhici").style.display = "none";
		document.body.style.overflow='';
		document.body.style['padding–right']="0px";
	};
	var x = 0;
	var y = 0;
	var abs_xd = 10;
	var abs_yd = 10;
	var xd = abs_xd;
	var yd = abs_yd;
	var move = function(){
		var width = window.innerWidth - 611;
		var height = window.innerHeight -123;
		if(x+ xd >= width){
			xd = 0 - abs_xd;
		} 
		if(x + xd < 0){
			xd = abs_xd;
		}
		if(y + yd >= height){
			yd = 0 - abs_yd;
		} 
		if(y + yd <0){
			yd = abs_yd;
		}
		x += xd;
		y += yd;
		document.getElementById('kuaile').style.top = y+"px";
		document.getElementById('kuaile').style.left= x+"px";
	};
	var timer = setInterval( move,300);
	
		
</script>