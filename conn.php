<?php 
$server = "localhost";
$username = "root";
$password = "root";
$name = "db1";

$conn = new mysqli($server,$username,$password,$name);
if($conn->connect_error)
{
    die("connessione non effettuata" . $conn->connect_error);
}else
{
   echo "connessione riuscita";
}
if($_SERVER['REQUEST_METHOD'] == "GET")
{
 $sql = "SELECT * FROM flist";
 $result = $conn->query($sql);
 if($result->num_rows > 0)
 {
    $result->data_seek(rand(0,$result->num_rows-1));
    $row = $result->fetch_assoc();
    $titolo_casuale = $row["titolo"];
    $regista_casuale = $row["regista"];
    echo "<h1> film casuale : </h1><br>" . $titolo_casuale;
    if(!empty($regista_casuale)) echo " " . $regista_casuale;
    
    while($row = $result->fetch_assoc()){
      echo "titolo: " .$row["titolo"]. " - Regista: ".$row["regista"] . "<br>";
    }
 }
}
?>