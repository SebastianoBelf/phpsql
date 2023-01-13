
<form method = "POST" action =" <?php echo $_SERVER["PHP_SELF"]; ?> ">  <?php // action = 'provaform.php ?>
    <input type = "text" name = "stringa">
    <input type = "submit">
</form>

<?php 
if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    $str = $_REQUEST['stringa'];
    if(empty($str)){
        echo " non hai scritto niente";
    } else {
        echo "hai scritto " . $str . " nel form qui sopra";
    }
}