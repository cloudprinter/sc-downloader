$(document).ready(function(){
	$("#download").click(function(){
		if($("#link").val()=="") return;
		var d = {};
		d['link'] = $("#link").val();
		$.ajax({
			url: "link.php",
			type: "POST",
			data: d,
			success: function(data)
			{
				var datadec = jQuery.parseJSON(data);
				if(datadec.status=="0")
				{
					$("#links").append("<li><span class=\"heading\">"+datadec.name+"</span><a class=\"mp3-link\" target=\"_blank\" href=\""+datadec.link+"\">"+datadec.link+"</a></li>");
					$("#mask").fadeIn();
				}
				else
				{
					alert(datadec.message);
					$("#link").removeAttr("disabled");
					$("#link").val("");
				}
			},
			beforeSend: function()
			{
				$("#link").val("Please wait...");
				$("#link").attr("disabled","disabled");
			}
		});
	});
	$("#mask").click(function(e){
		var target = e.target.id;
		if(e.target.id=="mask")
		{
			$("#mask").fadeOut();
			$("#link").removeAttr("disabled");
			$("#link").val("");
		}
	});
});
