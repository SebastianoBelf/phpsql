<?php
$server = "localhost";
$username = "root";
$pass = "root";
$name = "db1";

$conn = new mysqli($server,$username,$pass,$name);

if($conn->connect_error)
{
    echo "errore dio";
    
}


if($_SERVER["REQUEST_METHOD"] === "GET")
{
    $sql = "SELECT * FROM flist ORDER BY RAND() LIMIT 1";
    $result = $conn->query($sql);
    if($result->num_rows)
    {
        $row = $result->fetch_assoc();
        echo "<b>Film consigliato</b> <BR> " .$row["titolo"] ."    ".$row["regista"]."<BR>";
    }
    ?>
    <form method = "POST" action = "Prova2.php">
    <input type = "text" name = "titolo">
    <input type = "text" name = "regista">
    <input type = "submit" name = "invia" value = "invia">
    </form>
    <?php
}else
{
    if(isset($_POST["invia"]))
    {
        echo "ciao1";
        $titolo = $_POST["titolo"];
        $regista = $_POST["regista"];
        $sql = "";
        if($titolo == "" && $regista == "")
        {
            echo "ciao2";
            ?>
            <br> <b>Parametri non validi</b>
            <a href="Prova2.php">Torna alla home</a>
            <?php
        }else if($titolo != "" && $regista != "")
        {
            echo "ciao3";
            $sql = "SELECT * FROM flist WHERE titolo ='$titolo' and regista ='$regista'";
        }else if($titolo != "")
        {
            echo "ciao4";
            $sql = "SELECT * FROM flist WHERE titolo ='$titolo'";
        }else if($regista != "")
        {
            echo "ciao5";
            $sql = "SELECT * FROM flist WHERE regista ='$regista'";
        }
        if($sql != "")
        {
            echo "ciao6";
            $result = $conn->query($sql);
            if($result->num_rows > 0)
            {
                    ?>
                    <br> Titoli trovati :
                    <table>
                    <?php
                while($row = $result->fetch_assoc())
                {
                    echo "<tr>";
                    echo "<td>".$row["titolo"] ."</td><td>".$row["regista"]."</td>";
                    ?>
                    <td><form method = "POST" action = "">
                            <input type = "hidden" name = "titolo" value = "<?php print $row["titolo"]?>">
                            <input type = "hidden" name = "regista" value = "<?php print $row["regista"]?>">
                            <input type = "submit" name = "modifica" value = "modifica"></form></td></tr>
                    <?php
                }
                ?> 
                </table>
                <?php
            }else
            {
                echo "Non ci sono risultati";
                ?>
                <a href="Prova2.php">Back</a>
                <?php
            }
        }
        
    }
    if(isset($_POST["modifica"]))
    {
        $titolo = $_POST["titolo"];
        $regista = $_POST["regista"];
        ?>
        <form method = "POST" action = "">
            <input type = "text" name = "titolo" value = "<?php print $titolo ?>">
            <input type = "text" name = "regista" value = "<?php print $regista ?>">
            <input type = "hidden" name = "pretitolo" value = "<?php print $titolo ?>">;
            <input type = "hidden" name = "preregista" value = "<?php print $regista ?>">;
            <input type = "submit" name = "applicamodifica" value = "applicamodifica"></form></td></tr>
        </form>
        <?php
    }
    if(isset($_POST["applicamodifica"]))
    {
        $titolo = $_POST["titolo"];
        $regista = $_POST["regista"];
        $pretitolo = $_POST["pretitolo"];
        $preregista = $_POST["preregista"];
        $sql = "UPDATE flist SET titolo = '".$titolo."',regista ='".$regista."' WHERE titolo ='".$pretitolo."'and regista ='".$preregista."'";
        $result = $conn->query($sql);

        echo "<BR>Risultati Aggiornati";
        echo "<a href='/Prova2.php'>BACK</a>";
    }
}

?>
<BR>
