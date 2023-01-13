
<?php
include_once('functions/connessione.php');

if($_SERVER["REQUEST_METHOD"] === "GET")
{
    echo "<h1> FILM CONSIGLIATO </h1>";
   
    filmCasuale();
    //quando clicco un form ricarica la pagina
?>
    <form method = "POST" action ="Prova1.php"> 
    <input type = "text" name = "titolo">
    <input type = "text" name = "regista">
    <input type = "submit" name = "trova">
    </form>
<?php
}else{ 
    
    if(isset($_POST["trova"]))
    {
        //cerco il record richiesto
        $titolo = $_POST["titolo"];
        $regista = $_POST["regista"];
        if($titolo  == "" && $regista == "")
        {
            print "<br><br><h1>Inserire un criterio di ricerca</h1>";
            print '<br><a href = "Prova1.php">Torna indietro';
        }
        else
        {
        //$sql = "SELECT * FROM flist where";
            $sql = "";
            $and = false;
            if($titolo != "")
            {
                //$sql.= " titolo = '$titolo' ";
                $sql = "SELECT * FROM flist where titolo = '$titolo'";
                $and = true;
                
            }
            if($regista != "")
            {
                if($and)
                {
                    $sql = "SELECT * FROM flist where titolo = '$titolo' and regista = '$regista'";
                    //$sql.="AND";
                }
                //$sql.=" regista = '$regista'";
                $sql = "SELECT * FROM flist where regista = '$regista'";
            }
            $result = $GLOBALS["conn"]->query($sql);

            if($result->num_rows > 0)
            {
                //esiste il film cercato
                print "<h1> film richiest";
                print ($result->num_rows == 1 ? "o<br>" : "i<br>");
                while($row = $result->fetch_assoc())
                {
                    print $row["titolo"] . " ". $row["regista"] ."<br>";
                }
                print "<br><a href = 'Prova1.php'>torna indietro";
            }
            else
            {
                //show list wish list film desiderati aggiunti se non esistono nella lista dei film tabella :wlist
                $sql = str_replace("flist","wlist",$sql);
                $result = $GLOBALS["conn"]->query($sql);
                if($result->num_rows > 0)
                {
                    echo "e' presente nella wlist";
                    while($row = $result->fetch_assoc())
                    {
                        echo $row["titolo"] . " " .$row["restista"];
                    }
                }
                else
                {
                    echo "$titolo   $regista <br>non è presente vuoi aggiungerlo alla wlist ?";
                     
                    ?>
                    <form method = "POST" action = "Prova1.php">
                        <input type="hidden" name = "titolo" value = "<?php print $titolo?>">
                        <input type="hidden" name = "regista" value = "<?php print $regista?>">
                        <input type= "submit" name = "si" value = "si">
                        <input type= "submit" name = "no" value = "no">
                    </form>
                    <?php
                }
                
            }  
        }

    }
    if(isset($_POST["si"]))
    {
        $titolo = $_POST["titolo"];
        $regista = $_POST["regista"];
        $sql = "INSERT INTO wlist(titolo,regista) VALUES ('$titolo','$regista')";
        $GLOBALS["conn"]->query($sql);
        header("location:Prova1.php?i=y");
    }
    if(isset($_POST["no"]))
    {
        header("location:Prova1.php?i=n");
    }
}
function filmCasuale(){
        $sql = "SELECT * FROM flist order by RAND() LIMIT 1";
        $result = $GLOBALS["conn"]->query($sql);
        if($result->num_rows > 0){
           $row = $result->fetch_assoc();
           $titolo = $row["titolo"];
           $regista = $row["regista"];
           
           echo "TITOLO :" .$titolo ." <BR> REGISTA : ".$regista;
        }

}

?>
<table>
    <?php
    $sql = "SELECT * FROM flist";
    $result = $GLOBALS["conn"]->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            print "<form action =" .$_SERVER["PHP_SELF"] . " method = post id = ".$row["id"] ."></form>"; 
            
        }
    }
    
?>