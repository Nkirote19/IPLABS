$(document).ready(function()
		{
			/*Returns the number of minutes ahead or behind green which meridian*/
			var offset = new Date().getTimezoneOffset();
			/*Returns the number of milliseconds since 1970/01/01*/
			var timestamp = new Date().getTime();

			/*We convert our time to : Universal Time Coordinated / Universal Coordinated Time*/
			var utc_timestamp = timestamp + (60000 * offset);

			$('#time_zone_offset').val(offset);
			$('#utc_timestamp').val(utc_timestamp);
		}
	);