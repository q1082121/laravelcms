var _0x89fd = ["maps", "fn", "extend", "length", "ul", "children", "<span class='indicator'>+</span>", "append", "each", "li", "find", ".venus-menu", "<li class='showhide'><span class='title'>Menu</span><span class='icon'><em></em><em></em><em></em><em></em></span></li>", "prepend", "resize", "unbind", "li, a", "hide", "innerWidth", ".venus-menu > li:not(.showhide)", "slide-left", "removeClass", "mouseleave", "zoom-out", "speed", "fadeOut", "stop", "bind", "mouseover", "addClass", "fadeIn", ".venus-menu li", "click", "display", "css", "siblings", "none", "slideDown", "slideUp", "a", ".venus-menu li:not(.showhide)", "show", ".venus-menu > li.showhide", ":hidden", "is", ".venus-menu > li"];
$[_0x89fd[1]][_0x89fd[0]] = function(_0x2091x1) {
	var _0x2091x2 = {
		speed: 300
	};
	$[_0x89fd[2]](_0x2091x2, _0x2091x1);
	var _0x2091x3 = 0;
	$(_0x89fd[11])[_0x89fd[10]](_0x89fd[9])[_0x89fd[8]](function() {
		if ($(this)[_0x89fd[5]](_0x89fd[4])[_0x89fd[3]] > 0) {
			$(this)[_0x89fd[7]](_0x89fd[6]);
		};
	});
	$(_0x89fd[11])[_0x89fd[13]](_0x89fd[12]);
	_0x2091x4();
	$(window)[_0x89fd[14]](function() {
		_0x2091x4();
	});

	function _0x2091x4() {
		$(_0x89fd[11])[_0x89fd[10]](_0x89fd[16])[_0x89fd[15]]();
		$(_0x89fd[11])[_0x89fd[10]](_0x89fd[4])[_0x89fd[17]](0);
		if (window[_0x89fd[18]] <= 768) {
			_0x2091x7();
			_0x2091x6();
			if (_0x2091x3 == 0) {
				$(_0x89fd[19])[_0x89fd[17]](0);
			};
		} else {
			_0x2091x8();
			_0x2091x5();
		};
	};

	function _0x2091x5() {
		$(_0x89fd[11])[_0x89fd[10]](_0x89fd[4])[_0x89fd[21]](_0x89fd[20]);
		$(_0x89fd[31])[_0x89fd[27]](_0x89fd[28], function() {
			$(this)[_0x89fd[5]](_0x89fd[4])[_0x89fd[26]](true, true)[_0x89fd[30]](_0x2091x2[_0x89fd[24]])[_0x89fd[29]](_0x89fd[23]);
		})[_0x89fd[27]](_0x89fd[22], function() {
			$(this)[_0x89fd[5]](_0x89fd[4])[_0x89fd[26]](true, true)[_0x89fd[25]](_0x2091x2[_0x89fd[24]])[_0x89fd[21]](_0x89fd[23]);
		});
	};

	function _0x2091x6() {
		$(_0x89fd[11])[_0x89fd[10]](_0x89fd[4])[_0x89fd[21]](_0x89fd[23]);
		$(_0x89fd[40])[_0x89fd[8]](function() {
			if ($(this)[_0x89fd[5]](_0x89fd[4])[_0x89fd[3]] > 0) {
				$(this)[_0x89fd[5]](_0x89fd[39])[_0x89fd[27]](_0x89fd[32], function() {
					if ($(this)[_0x89fd[35]](_0x89fd[4])[_0x89fd[34]](_0x89fd[33]) == _0x89fd[36]) {
						$(this)[_0x89fd[35]](_0x89fd[4])[_0x89fd[37]](300)[_0x89fd[29]](_0x89fd[20]);
						_0x2091x3 = 1;
					} else {
						$(this)[_0x89fd[35]](_0x89fd[4])[_0x89fd[38]](300)[_0x89fd[21]](_0x89fd[20]);
					};
				});
			};
		});
	};

	function _0x2091x7() {
		$(_0x89fd[42])[_0x89fd[41]](0);
		$(_0x89fd[42])[_0x89fd[27]](_0x89fd[32], function() {
			if ($(_0x89fd[45])[_0x89fd[44]](_0x89fd[43])) {
				$(_0x89fd[45])[_0x89fd[37]](300);
				_0x2091x3 = 1;
			} else {
				$(_0x89fd[19])[_0x89fd[38]](300);
				$(_0x89fd[42])[_0x89fd[41]](0);
				_0x2091x3 = 0;
			};
		});
	};

	function _0x2091x8() {
		$(_0x89fd[45])[_0x89fd[41]](0);
		$(_0x89fd[42])[_0x89fd[17]](0);
	};
};

$(document).ready(function(){
	$().maps();
});