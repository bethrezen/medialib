(function($){
	var config={};

	var methods={
		init: function (options) {
			//alert('init');
//			initFrame(options);
			return this.each(function(){
				var item=$(this);
				item.find('.fileupload').fileupload({
					dataType: 'json',
					dropZone: '#'+item.attr('id'),
					done: function (e, data) {
						if (data.result.success)
						{
							item.find('input[type=text]').val(data.result.id);
						}
						else
						{
							console.log(data);
							alert(data.result.error);
						}
						//alert()
						/*$.each(data.result.files, function (index, file) {
							$('<p/>').text(file.name).appendTo(document.body);
						});*/
					},
					formData: {
						'Picture[catid]': 0
					},
					progressall: function (e, data) {
						var progress = parseInt(data.loaded / data.total * 100, 10);
						console.log(progress);
						item.find('.bar').css('width',progress + '%');
					}
				});
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