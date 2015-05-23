(function($){
	var config={};
	var innerInit=function(options)
	{
		config=options;
		jQuery(window).resize(function(){
			//alert('1');
			jQuery('#medialib-folder > div').height(jQuery('#medialib-folder').parent().height()-5);
		});
	};
	
	var initFrame=function(options){
		if (options===undefined) options={};
		if (options.title===undefined) options.title="Picture select";
		
		if (jQuery('#medialib-folder').length===0)
		{
			jQuery('body').append('<div id="medialib-folder">8456+46</div>');
			$.ajax({
				url: "/medialib/folder",
				data: "",
				success: function(msg){
					jQuery('#medialib-folder').html(msg);
					innerInit(options);
					open();
				}
			});
		}
	};
	var open=function(){
		jQuery.fancybox.open('#medialib-folder', {
			title: config.title, 
			width: '800px', 
			height: '700px', 
			autoDimensions: false, 
			autoSize:false
		});
	};

	var methods={
		init: function (options) {
			//alert('init');
			initFrame(options);
			return this.each(function(){
				/*$(this).on('click', (function(){
					//alert('select');
					//open();
				}));*/
			});
		},
		select: function (options) {
			console.log(options);/*
			return this.each(function(){
				$(this).click(function(){alert('click '+$(this).attr('id'))});
			});*/
		}
	};
	  
	$.fn.fileselect = function( method ) {
     
		if ( methods[method] ) {
			return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
		} else if ( typeof method === 'object' || ! method ) {
			return methods.init.apply( this, arguments );
		} else {
			$.error( 'Method ' +  method + ' does not exist on jQuery.fileselect' );
		}   

	};
})(jQuery);