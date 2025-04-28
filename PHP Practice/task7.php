<?php
// Task 7: Print the given shapes using nested loops with manual input
?>
<form method="post">
    Rows for first two shapes: <input type="number" name="rows" value="3" min="1" required><br>
    Letters for third shape (comma-separated, 6 letters): <input type="text" name="letters" value="A,B,C,D,E,F" required><br>
    <input type="submit" value="Print Shapes">
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rows = intval($_POST['rows']);
    $letters = explode(',', $_POST['letters']);
    $letters = array_map('trim', $letters);
    // First shape
    for ($i = 1; $i <= $rows; $i++) {
        for ($j = 1; $j <= $i; $j++) {
            echo "*";
        }
        echo "<br>";
    }
    // Second shape
    for ($i = 1; $i <= $rows; $i++) {
        for ($j = 1; $j <= $rows; $j++) {
            echo $j . " ";
        }
        echo "<br>";
    }
    // Third shape
    $index = 0;
    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 2; $j++) {
            if (isset($letters[$index])) {
                echo $letters[$index++] . " ";
            }
        }
        echo "<br>";
    }
}
?> 