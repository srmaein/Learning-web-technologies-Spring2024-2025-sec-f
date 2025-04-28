<?php
// Task 5: Print all odd numbers between a given range with manual input
?>
<form method="post">
    Start: <input type="number" name="start" required><br>
    End: <input type="number" name="end" required><br>
    <input type="submit" value="Print Odd Numbers">
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start = $_POST['start'];
    $end = $_POST['end'];
    for ($i = $start; $i <= $end; $i++) {
        if ($i % 2 != 0) {
            echo $i . " ";
        }
    }
}
?> 