<?php
$tinggi = 5; 

for ($i = 1; $i <= $tinggi; $i++) {
    for ($j = $tinggi; $j > $i; $j--) {
        echo "&nbsp;&nbsp;";
    }
    for ($k = 1; $k <= (2 * $i - 1); $k++) {
        echo "*";
    }
    echo "<br>";
}
?>
