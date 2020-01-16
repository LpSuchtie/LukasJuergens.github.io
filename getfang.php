<?php
$mysqli = new mysqli("localhost", "newuser", "Fangtest.", "fang");
if($mysqli->connect_error) {
  exit('Could not connect');
}

$sql = "SELECT Mitglieder.Name, Mitglieder.Nachname, Mitglieder.Geburtsdatum, Mitglieder.Rang, Fische.Fischname, Fang.Gewicht, Fang.Anzahl, Gewässer.Gewässername
FROM Mitglieder INNER JOIN (Gewässer INNER JOIN (Fische INNER JOIN Fang ON Fische.F_ID = Fang.F_ID) ON Gewässer.G_ID = Fang.G_ID) ON Mitglieder.M_ID = Fang.M_ID
WHERE (((Fang.FG_ID) = ?));";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $_GET['q']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($name, $lname, $date, $rank, $fname, $gew, $anz, $gname);
$stmt->fetch();
$stmt->close();

echo "<table>";
echo "<tr>";
echo "<th>Name</th>";
echo "<td>" . $name . "</td>";
echo "<th>Nachname</th>";
echo "<td>" . $lname . "</td>";
echo "<th>Geburt</th>";
echo "<td>" . $date . "</td>";
echo "<th>Rang</th>";
echo "<td>" . $rank . "</td>";
echo "<th>Fisch</th>";
echo "<td>" . $fname . "</td>";
echo "<th>Gewicht</th>";
echo "<td>" . $gew . "</td>";
echo "<th>Anzahl</th>";
echo "<td>" . $anz . "</td>";
echo "<th>Gewässer</th>";
echo "<td>" . $gname . "</td>";
echo "</tr>";
echo "</table>";
?>