<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
  chdir(dirname(__FILE__));
  //core init required for all pages
  require_once '../../core/init.php';

  $db = DB::getInstance();

  $q = $_GET['q'];
  // normally outputs date in really wierd format. change using string functions to mm/dd/yyyy
  // the get method only outputs strings. so can't use date_format or strftime
  $year = substr($q,0,4);
  $q = $q . "-";
  $q = $q . $year;
  $q = substr($q,5);

  // find where the last and first names match the ajax request
  $sql="SELECT * FROM accountability WHERE date_absent = '".$q."'";
  $ajaxData = $db->query($sql)->results();

  echo "<table>
  <tr>
  <th>Last</th>
  <th>First</th>
  <th>Date</th>
  <th>Event</th>
  </tr>";

  foreach ($ajaxData as $i) {
    echo "<tr>" .
    "<td>" . $i->last . "</td>" .
    "<td>" . $i->first . "</td>" .
    "<td>" . $i->date_absent . "</td>" .
    "<td>" . $i->event . "</td>" .
    "</tr>";
  }

  echo "</table>";
?>

</body>
</html>
