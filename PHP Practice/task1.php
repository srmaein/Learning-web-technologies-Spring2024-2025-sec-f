<?php
// Task 1: Calculate area and perimeter of a rectangle with manual input
?>
<form method="post">
    Length: <input type="number" name="length" step="any" required><br>
    Width: <input type="number" name="width" step="any" required><br>
    <input type="submit" value="Calculate">
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $length = $_POST['length'];
    $width = $_POST['width'];
    $area = $length * $width;
    $perimeter = 2 * ($length + $width);
    echo "Length: $length, Width: $width<br>";
    echo "Area: $area<br>";
    echo "Perimeter: $perimeter<br>";
}
?> 