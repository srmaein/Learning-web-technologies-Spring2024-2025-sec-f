<?php
// Task 6: Search for an element in an array with manual input
?>
<form method="post">
    Array (comma-separated): <input type="text" name="array" required><br>
    Search value: <input type="text" name="search" required><br>
    <input type="submit" value="Search">
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $array = explode(',', $_POST['array']);
    $array = array_map('trim', $array);
    $search = $_POST['search'];
    $found = false;
    foreach ($array as $value) {
        if ($value == $search) {
            $found = true;
            break;
        }
    }
    if ($found) {
        echo "$search found in the array.";
    } else {
        echo "$search not found in the array.";
    }
}
?> 