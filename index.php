<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<header>
	<title>Bandwidth Realtime Graph</title>
	<script>
		var range=<?php echo $bandwidth; ?>;
	</script>
	<style>
		#container
		{
			margin:0px auto;
			width:960px;
			text-align:center;
		}
		#footer
		{
			text-align:center;
		}
	</style>
</header>
<body>
<div id="container">
<h1>Bandwidth Realtime Graph</h1>

<!-- Receive -->
<div id="rec_result" style="font-weight:bold; color:#129631;"></div>
<canvas
	id="rec_graph"
	width="930"
	height="200"
	style="font-size: 6pt;
"></canvas>
<br><br>

<!-- Send -->
<div id="snd_result" style="font-weight:bold; color:#0E15CF;"></div>
<canvas
	id="snd_graph"
	width="930"
	height="200"
	style="font-size: 6pt;
"></canvas>
</div>
<br>
<div id="footer">
	<a href="http://www.w3.org/html/logo/">
		<img src="HTML5_Logo_64.png" alt="HTML5" />
	</a>
</div>
<script type="text/javascript" src="graph.js"></script>
<script>

if(typeof(EventSource) !== "undefined") {
	var seconds = 1;

	// Receive
	var rec_source = new EventSource("rec.php");
	var rate_rec= 0;
	rec_source.onmessage = function(event)
	{
		var new_rec = event.data;
		if ( typeof(old_rec) != "undefined") { 
			bytes = new_rec - old_rec;
			rate_rec = bytes * 8 / seconds / 1024;
			// Check over/under flow
			if ( rate_rec > range  || rate_rec < 0 )
				rate_rec = old_rate_rec;
			else
				old_rate_rec = rate_rec;
			document.getElementById("rec_result").innerHTML=
				"Receive: " + Math.round(rate_rec) + " kbps";
		}
		old_rec = new_rec;
	};
	
	// Send
	var snd_source = new EventSource("snd.php");
	var rate_snd= 0;
	snd_source.onmessage = function(event)
	{
		var new_snd = event.data;
		if ( typeof(old_snd) != "undefined") { 
			bytes = new_snd - old_snd;
			rate_snd = bytes * 8 / seconds / 1024;
			// Check over/under flow
			if ( rate_snd > range  || rate_snd < 0 )
				rate_snd = old_rate_snd;
			else
				old_rate_snd = rate_snd;
			document.getElementById("snd_result").innerHTML=
				"Send: " + Math.round(rate_snd) + " kbps";
		}
		old_snd = new_snd;
	};
	
} else {
	document.getElementById("rec_result").innerHTML=
		"Sorry, your browser does not support server-sent events...";
}


window.onload = function() {

    g_graph = new Graph(
    {
        'id': "rec_graph",
        'strokeStyle': "#819C58",
        'fillStyle': "rgba(64,128,0,0.25)",
        'interval': 1000,
	'range': [0,range+10],
	'grid': [65,40],
	'showlabels': true,
        'call': function(){return (Math.round(rate_rec));},
    });

    f_graph = new Graph(
    {
        'id': "snd_graph",
        'strokeStyle': "#58819C",
        'fillStyle': "rgba(0,88,145,0.25)",
        'interval': 1000,
	'range': [0,range+10],
	'grid': [65,40],
	'showlabels': true,
        'call': function(){return (Math.round(rate_snd));}
    });

}

</script>

</body>
</html>
