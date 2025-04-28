<?php
// Task 8: Declare a 2D array and print the shapes using nested loops with manual input
?>
<form method="post">
    2D Array (one row per line, values comma-separated):<br>
    <textarea name="array" rows="4" cols="30" required>1,2,3,A
1,2,B,C
1,D,E,F</textarea><br>
    <input type="submit" value="Print Array">
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lines = explode("\n", trim($_POST['array']));
    $array = array();
    foreach ($lines as $line) {
        $array[] = array_map('trim', explode(',', $line));
    }
    for ($i = 0; $i < count($array); $i++) {
        for ($j = 0; $j < count($array[$i]); $j++) {
            echo $array[$i][$j] . " ";
        }
        echo "<br>";
    }
}
?> 