<?php
// Task 3: Check if a number is odd or even with manual input
?>
<form method="post">
    Number: <input type="number" name="number" required><br>
    <input type="submit" value="Check">
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $number = $_POST['number'];
    if ($number % 2 == 0) {
        echo "$number is even.";
    } else {
        echo "$number is odd.";
    }
}
?> 