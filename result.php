<html>
<head>

<style>
table { 
	width: 750px; 
	border-collapse: collapse; 
	margin:50px auto;
	}

/* Zebra striping */
tr:nth-of-type(odd) { 
	background: #eee; 
	}

th { 
	background: #3498db; 
	color: white; 
	font-weight: bold; 
	}

td, th { 
	padding: 10px; 
	border: 1px solid #ccc; 
	text-align: left; 
	font-size: 18px;
	}

/* 
Max width before this PARTICULAR table gets nasty
This query will take effect for any screen smaller than 760px
and also iPads specifically.
*/
@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	table { 
	  	width: 100%; 
	}

	/* Force table to not be like tables anymore */
	table, thead, tbody, th, td, tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 1px solid #ccc; }
	
	td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}

	td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
		/* Label the data */
		content: attr(data-column);

		color: #000;
		font-weight: bold;
	}

}
</style>

</head>

<body>

<?php
$solute=$_REQUEST['solute'];

// Database
$servername = "localhost";
$username = "root";
$password = "aoteman";
$dbname = "mu23";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM Proline WHERE Solutes='$solute' OR Model_Compound='$solute';");
?>

<?php
     // output data of each row
if ($result->num_rows > 0) { 
     echo "<table>
	     <thead>
  	       <tr>
    	         <th>Solute</th>
    		 <th>Model Compound</th>
    	 	 <th>&mu;23/RT (M^-1)</th>
    		 <th>Error</th>
    	 	 <th>Method</th>
    		 <th>Author &amp; Publication</th>
  	       </tr>
	     </thead>";
     while($row = $result->fetch_assoc()) {
        echo "
	<tbody>
	  <tr>
	    <td>" . $row["Solutes"]. "</td>
	    <td>" . $row["Model_Compound"]. "</td>
	    <td>" . $row["mu23/RT (M-1)"]. "</td>
	    <td>" . $row["Error"]."</td>
	    <td>" . $row["Method"]."</td>
	    <td>" . $row["Author_and_Publication"]. "</td>
	  </tr>
	</tbody>";
     }
}
$conn->close();

// search another database
$conn1 = new mysqli($servername, $username, $password, $dbname);
$result1 = $conn1->query("SELECT * 
FROM  `PEG` 
WHERE  `Solutes` LIKE  '$solute'
OR `Model_Compound` LIKE '$solute';");
    
if ($result1->num_rows > 0) {
    echo "<table>
             <thead>
               <tr>
                 <th>Solute</th>
                 <th>Model Compound</th>
                 <th>&mu;23/RT (M^-1)</th>
                 <th>Error</th>
                 <th>Method</th>
                 <th>Author &amp; Publication</th>
               </tr>
             </thead>";
    while($row1 = $result1->fetch_assoc()) {
        echo "
	<tr>
	  <td>" . $row1["Solutes"]. "</td>
	  <td>" . $row1["Model_Compound"]. "</td>
	  <td>" . $row1["mu23 (cal/(mol molal))"]. "</td>
	  <td>" . $row1["Error"]."</td>
	  <td>" . $row1["Method"]."</td>
	  <td>" . $row1["Author_and_Publication"]. "</td>
	</tr>";
    }
}
$conn1->close();

// search another database
$conn2 = new mysqli($servername, $username, $password, $dbname);
$result2 = $conn2->query("SELECT * FROM Urea WHERE Solutes='$solute' OR Model_Compound='$solute';");
    
if ($result2->num_rows > 0) {
    echo "<table>
             <thead>
               <tr>
                 <th>Solute</th>
                 <th>Model Compound</th>
                 <th>&mu;23/RT (M^-1)</th>
                 <th>Error</th>
                 <th>Method</th>
                 <th>Author &amp; Publication</th>
               </tr>
             </thead>";
    while($row2 = $result2->fetch_assoc()) {
        echo "
        <tr>
          <td>" . $row2["Solutes"]. "</td>
          <td>" . $row2["Model_Compound"]. "</td>
          <td>" . $row2["mu23/RT (M-1)"]. "</td>
          <td>" . $row2["Error"]."</td>
          <td>" . $row2["Method"]."</td>
          <td>" . $row2["Author_and_Publication"]. "</td>
        </tr>";
    }    
}

$conn2->close();
?>
</table>
</body>
</html>

