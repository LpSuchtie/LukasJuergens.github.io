<?php
$servername = "192.168.2.226";
$username = "newuser";
$password = "Fangtest.";
$dbname = "fang";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT Mitglieder.Name, Mitglieder.Nachname, Mitglieder.Geburtsdatum, Mitglieder.Rang, Fische.Fischname, Fang.Gewicht, Fang.Anzahl, Gewässer.Gewässername
FROM Mitglieder INNER JOIN (Gewässer INNER JOIN (Fische INNER JOIN Fang ON Fische.F_ID = Fang.F_ID) ON Gewässer.G_ID = Fang.G_ID) ON Mitglieder.M_ID = Fang.M_ID
WHERE Fang.FG_ID = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Name</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["Rang"]."</td><td>".$row["Name"]." ".$row["Nachname"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>