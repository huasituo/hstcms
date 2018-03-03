;
(function($, h) {
	$(document).on('keydown', function(event) {
		var e = window.event || event;
		if(e.keyCode == 116) {
			e.keyCode = 0;
			var $doc = $(parent.window.document),
				id = $doc.find('#B_history .current').attr('data-id'),
				iframe = $doc.find('#iframe_' + id);
			if(iframe[0].contentWindow) {
				reloadPage(iframe[0].contentWindow); 
			}
			//!ie
			return false;
		}
	});
	h.datalist = function(elem, options) {
		var _options = {
			
		}
		$.extend(true, _options, options);
		Hstui.dataTable('#list', {
			scrollY: 200,
			scrollX: true,
		}, function(t) {

		});
	}
})(jQuery, Hstui);