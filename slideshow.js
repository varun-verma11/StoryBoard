$(document).ready(function() {
	/*
	 *  Simple image gallery. Uses default settings
	 */

	$('.fancybox').fancybox();

	$('.storyboard').fancybox({
			//openEffect  : 'none',
			//closeEffect : 'none',
			wrapCSS    : 'fancybox-custom',
			prevEffect : 'elastic',
			nextEffect : 'elastic',
			closeBtn  : false,
			arrows    : false,
			nextClick : true,
			onClosed  : function() {updateLastImage();},
			helpers : {
				title : {
					type : 'float'
				    },
				buttons : {},
				thumbs : {
					width : 70,
					height : 70
				}
			},

	//in case we want to resize images, change the width here...
/*				beforeShow: function () {
				 // set new fancybox width

			var newWidth = this.width * 2;
			// apply new size to img
			$(".fancybox-image").css({
					"width": newWidth,
					"height": "auto"
			});
			// set new values for parent container
			this.width = newWidth;
			this.height = $(".fancybox-image").innerHeight();
				},
*/
		

		openEffect : 'elastic',
		openSpeed  : 150,

		closeEffect : 'elastic',
		closeSpeed  : 150,
		'cyclic'       :   false,

		closeClick : true,

			afterLoad : function() {
			this.title = 'Frame ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
		 }
		});

	
		$('.storyboard2').fancybox({
			//openEffect  : 'none',
			//closeEffect : 'none',
			wrapCSS    : 'fancybox-custom',
			prevEffect : 'elastic',
			nextEffect : 'elastic',
			closeBtn  : false,
			arrows    : false,
			nextClick : true,
			onClosed  : function() {updateLastImage();},
			helpers : {
				title : {
					type : 'float'
				    },
				thumbs : {
					width : 70,
					height : 70
				}
			},

	//in case we want to resize images, change the width here...
/*				beforeShow: function () {
				 // set new fancybox width

			var newWidth = this.width * 2;
			// apply new size to img
			$(".fancybox-image").css({
					"width": newWidth,
					"height": "auto"
			});
			// set new values for parent container
			this.width = newWidth;
			this.height = $(".fancybox-image").innerHeight();
				},
*/
		

		openEffect : 'elastic',
		openSpeed  : 150,

		closeEffect : 'elastic',
		closeSpeed  : 150,
		'cyclic'       :   false,

		closeClick : false,

			afterLoad : function() {
			this.title = 'Frame ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
		 }
		});


	// $(".storyboard").onClosed( function() {
	// 	document.getElementById("lastImage").href = document.getElementById("lastImage").href ;
	// });

	// function updateLastImage() {
	// 	document.getElementById("lastImage").href = document.getElementById("lastImage").href ;
	// };

	function open_editor()
	{
		print("opening");
	};

});