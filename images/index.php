<?php 
echo '<html>
<body>

<form action="process/insert2DB.php" method="post">
JSON URL: <input type="text" name="jsonurl"><br/><br/>
Parent Node: <input type="text" name="parentnode"><br/><br/>
Comma Seperate Fields to Capture: <textarea rows="4" cols="50" type="text" name="fields2capture"></textarea><br/><br/>
Table Name: <input type="text" name="tabelname"><br/><br/>
<input type="submit">
</form>

</body>
</html>';
?>