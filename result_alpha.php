<html>
<head>
<script type="text/x-mathjax-config">
        MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});
    </script>

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
$functional_group = $_REQUEST['functional_group'];

// Database
$servername = "localhost";
$username = "root";
$password = "aoteman";
$dbname = "alpha";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM Glycine_Betaine WHERE `Solute` LIKE '$solute' AND `Functional_Group` LIKE '$functional_group';");
?>

<?php
echo $functional_group;
echo $solute;
     // output data of each row
if ($result->num_rows > 0) {
     echo "<table>
	     <thead>
  	       <tr>
    	         <th>Solute</th>
    		 <th>Functional Group</th>
    	 	 <th>&alpha; Value</th>
    		 <th>Error</th>
    	 	 <th>Method</th>
    		 <th>Author &amp; Publication</th>
  	       </tr>
	     </thead>";
     while($row = $result->fetch_assoc()) {
        echo "
	<tbody>
	  <tr>
	    <td>" . $row["Solute"]. "</td>
	    <td>" . $row["Functional_Group"]. "</td>
	    <td>" . $row["Alpha_Value"]. "</td>
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
$result1 = $conn1->query("SELECT * FROM Urea WHERE `Solute` LIKE '$solute' AND `Functional_Group` LIKE '$functional_group';");

if ($result1->num_rows > 0) {
    echo "<table>
             <thead>
               <tr>
                 <th>Solute</th>
                 <th>Functional Group</th>
                 <th>&alpha; Value * 10<sup>4</sup> (m<sup>-1</sup> A<sup>2</sup>)</th>
                 <th>Error</th>
                 <th>Method</th>
                 <th>Author &amp; Publication</th>
               </tr>
             </thead>";
    while($row1 = $result1->fetch_assoc()) {
        echo "
	<tr>
	  <td>" . $row1["Solute"]. "</td>
	  <td>" . $row1["Functional_Group"]. "</td>
	  <td>" . $row1["Alpha_Value"]. "</td>
	  <td>" . $row1["Error"]."</td>
	  <td>" . $row1["Method"]."</td>
	  <td>" . $row1["Author_and_Publication"]. "</td>
	</tr>";
    }
}
$conn1->close();

// search another database
$conn2 = new mysqli($servername, $username, $password, $dbname);
$result2 = $conn2->query("SELECT * FROM Proline WHERE `Solute` LIKE '$solute' AND `Functional_Group` LIKE '$functional_group';");

if ($result2->num_rows > 0) {
    echo "<table>
             <thead>
               <tr>
                 <th>Solute</th>
                 <th>Functional Group</th>
                 <th>&alpha; Value</th>
                 <th>Error</th>
                 <th>Method</th>
                 <th>Author &amp; Publication</th>
               </tr>
             </thead>";
    while($row2 = $result2->fetch_assoc()) {
        echo "
        <tr>
          <td>" . $row2["Solutes"]. "</td>
          <td>" . $row2["Functional_Group"]. "</td>
          <td>" . $row2["Alpha_Value"]. "</td>
          <td>" . $row2["Error"]."</td>
          <td>" . $row2["Method"]."</td>
          <td>" . $row2["Author_and_Publication"]. "</td>
        </tr>";
    }
}

$conn2->close();

// search another database
$conn3 = new mysqli($servername, $username, $password, $dbname);
$result3 = $conn3->query("SELECT * FROM PEG WHERE `Solute` LIKE '$solute' AND `Functional_Group` LIKE '$functional_group';");


if ($result3->num_rows > 0) {
    echo "<table>
             <thead>
               <tr>
                 <th>Solute</th>
                 <th>Functional Group</th>
                 <th>&alpha; Value</th>
                 <th>Error</th>
                 <th>Method</th>
                 <th>Author &amp; Publication</th>
               </tr>
             </thead>";
    while($row3 = $result3->fetch_assoc()) {
        echo "
        <tr>
          <td>" . $row3["Solutes"]. "</td>
          <td>" . $row3["Functional_Group"]. "</td>
          <td>" . $row3["Alpha_Value"]. "</td>
          <td>" . $row3["Error"]."</td>
          <td>" . $row3["Method"]."</td>
          <td>" . $row3["Author_and_Publication"]. "</td>
        </tr>";
    }
}

$conn3->close();

?>
</table>
</body>
</html>
