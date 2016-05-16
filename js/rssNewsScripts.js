/*
 * AJAX-i fail, täiendavate uudiste laadimisel näidatakse
 * pöörlevat laadimise märguannet tähistavat logo.
 */
$(document).ready(function() {
	function getResult(url) {
		$.ajax({
			url: url,
			type: "GET",
			data:  {rowcount:$("#rowcount").val()},
			beforeSend: function() {
				$('#loader-icon').show();
			},
			complete: function() {
				$('#loader-icon').hide();
			},
			success: function(data){
				$("#rss-uudised").append(data);
			
			},
			error: function() {} 	        
	   });
	}
	$(window).scroll(function() {
		if ($(window).scrollTop() == $(document).height() - $(window).height()) {
			if($(".pagenum:last").val() <= $(".total-page").val()) {
				var pagenum = parseInt($(".pagenum:last").val()) + 1;
				getResult('getResult.php?page='+pagenum);
			}
		}
	}); 
});