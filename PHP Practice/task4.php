<?php
// Task 4: Find the largest number from three given numbers with manual input
?>
<form method="post">
    Number 1: <input type="number" name="a" required><br>
    Number 2: <input type="number" name="b" required><br>
    Number 3: <input type="number" name="c" required><br>
    <input type="submit" value="Find Largest">
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = $_POST['a'];
    $b = $_POST['b'];
    $c = $_POST['c'];
    if ($a >= $b && $a >= $c) {
        $largest = $a;
    } elseif ($b >= $a && $b >= $c) {
        $largest = $b;
    } else {
        $largest = $c;
    }
    echo "The largest number is: $largest";
}
?> 