<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Javascript practice</title>
	<link rel="icon" href="assets/img/master_favicon_thumbnail.png">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/all.css">
</head>
<body>
	
</body>

<section>
	<div class="container">
		<h3 class="text-center mt-3">Javascript Practice</h3>
	</div>
</section>
<hr>
<section id="javascript" class="text-center">
	
</section>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(function() {
		// this is ready function
		let myArray = ['first', 'second', 'third', 'fourth', 'fifth', 'sixth', 'seventh'];
		let target = document.getElementById('javascript');
/*		for(let i = 0; i < myArray.length; i++) 
		{
			target.innerText = target.innerText + myArray[i] + ', ';
		}*/
		let index = 0;
		do {
			target.innerText = target.innerText + myArray[index] + ', ';
			index++;
		}while(index < myArray.length);
	});
</script>
</html>