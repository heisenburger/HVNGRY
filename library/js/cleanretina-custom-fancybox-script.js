jQuery(document).ready(function() 
		{
			jQuery('a.gallery-fancybox').fancybox
			({
				'transitionIn'		: 'none',
				'transitionOut'	: 'none',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) 
				{
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});
		});