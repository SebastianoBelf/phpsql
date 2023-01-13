<?php
define("COSTANTE","Sono una costante <BR>"); // il true significa case-sensitive posso scriverlo anche minuscolo
echo COSTANTE;
$x = 10;
$y = 50;
$cars = array("Volvo","BMW");
var_dump($cars);
echo strpos("Hello world!","world"); //restituisce 6 pos di world
echo str_replace("world","dolly","hello world!"); //output hello dolly
$ages = array(10,20,30);
echo "<BR>";
foreach($ages as $age){
    echo $age . "<BR>";
}
$hashmap = array("Peter" =>"30", "Ben" => "35");
foreach($hashmap as $x => $val){
    echo $x . " " . $val ."<BR>";
}
?>
<?php
$x = 0;
 if($x == 0) {?>
    <BR>VERO
 <?php } else { ?>
    FALSO<BR>
    <?php } ?>
