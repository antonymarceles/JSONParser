<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <title>JSON Parser - NxGn Innovations Demo</title>
  <meta name="author" content="Jake Rocheleau">
  <link rel="stylesheet" type="text/css" media="all" href="style.css">
  <link rel="stylesheet" type="text/css" media="all" href="responsive.css">
</head>

<body>

	<section id="container">
		<span class="chyron"><em><a href="http://www.nxgninnovations.com/">&laquo; back to the NxGn Innovations, LLC</a></em></span>
		<h2>JSON Parser & Database Insertion</h2>
		<form action="process/insert2DB.php" method="post" name="hongkiat" id="hongkiat-form" method="post" action="#" style="align:center" target="foo">
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			<input type="text" name="jsonurl" id="website" placeholder="Enter JSON API url" tabindex="1" class="txtinput">
		
			<input type="text" name="parentnode" id="name" placeholder="Enter Parent Node" tabindex="2" class="txtinput">
		
			<input type="text" name="tablename" id="email" placeholder="Enter Name for Table to be Created" tabindex="3" class="txtinput">
				
			<textarea name="fields2capture" id="message" placeholder="Enter Fields to be Captured" tabindex="4" class="txtblock"></textarea>
			</section>
		</div>


		<section id="buttons">
			<input type="reset" name="reset" id="resetbtn" class="resetbtn" value="Reset">
			<input type="submit" name="submit" id="submitbtn" class="submitbtn" tabindex="7" value="Submit this!">
			<br style="clear:both;">
		</section>
		
		<iframe name="foo" width="620px" height="300" style="float:center; margin-left:70px; margin-top:25px;">
		  <p>Your browser does not support iframes.</p>
		</iframe>
		
		</form>
	</section>

<p align="center" style="margin-top:-45px; color:#fff">© COPYRIGHT 2013 NxGn Innovations, LLC. ALL RIGHTS RESERVED.</p>
</body>

</html>