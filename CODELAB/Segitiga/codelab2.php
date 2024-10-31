<?php
$tinggi = 5;

for ($i = $tinggi; $i >= 1; $i--) {
    for ($j = $tinggi; $j > $i; $j--) {
        echo "&nbsp;&nbsp;";
    }
    // Cetak bintang
    for ($k = 1; $k <= (2 * $i - 1); $k++) {
        echo "*";
    }
    echo "<br>";
}
?>
