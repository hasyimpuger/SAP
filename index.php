
<?php
header("refresh: 2; http://sap.easytech.co.id/public/");
?>
<!DOCTYPE html>
<html>
<head>
	<title>SAP | Login</title>
</head>
<link rel="stylesheet" href="/public/dist/js/fakeLoader.css">
<body>
<div  id="fakeloader"></div>
</body>
<script src="/public/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/public/dist/js/fakeLoader.min.js"></script>
<script type="text/javascript">
	$("#fakeloader").fakeLoader({
	    timeToHide:2500, //Time in milliseconds for fakeLoader disappear
        zIndex:"999",//Default zIndex
        spinner:"spinner6",//Options: 'spinner1', 'spinner2', 'spinner3', 'spinner4', 'spinner5', 'spinner6', 'spinner7'
        bgColor:"#58FAF4",
	});
</script>
</html>