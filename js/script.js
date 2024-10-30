window.addEvent('domready', function()
{
	var $j = jQuery.noConflict();
	
	if($j('#searchfield').length>0)
    {
		var myAutocompleter = new GooCompleter('searchfield',
		{
			action : 'wp-content/plugins/mootools-accessible-autocomplete/php/webservice.php',		// The webservice to get the suggestions
			param: 'search',																		// Param string to send			
			listbox_offset: { y: 2 },																// Listbox offset for Y			
			delay: 500																				// Request delay to 0.5 seconds
		});
		
		var test = document.getElementById('searchsubmit');
		
		
		$j('body').delegate('#searchsubmit','click', function(e)
		{
			if($j('#searchfield').val().length>0)
			{
				var request = new Request.JSON(
				{
					url: 'wp-content/plugins/mootools-accessible-autocomplete/php/webservice.php',
					method: 'get',
					
					onSuccess: function(data)
					{
						window.location = data[0];
					}
				});
				
				request.send('fetch='+$j('#searchfield').val());
			}
		});
    }
});
