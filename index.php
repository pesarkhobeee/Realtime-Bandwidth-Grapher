<!DOCTYPE html>
<html>
<header>
	<title>Realtime Bandwidth Monitoring</title>
	<link href="style.css" rel="stylesheet" />
</header>

<body>
<div id="container">
	<h1>Realtime Bandwidth Monitoring</h1>
	<br><br>

	<!-- Receive -->
	<div id="rec_result"></div>
	<canvas	id="rec_graph" width="1000" height="300"></canvas>

	<br><br><br>

	<!-- Send -->
	<div id="snd_result"></div>
	<canvas	id="snd_graph" width="1000" height="300"></canvas>
</div>

<br>
<div id="footer"></div>

<script type="text/javascript" src="graph.js"></script>
<script type="text/javascript" src="script.js"></script>

</body>
</html>
