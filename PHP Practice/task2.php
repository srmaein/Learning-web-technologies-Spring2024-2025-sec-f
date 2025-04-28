<?php
// Task 2: Calculate VAT (15%) over an amount with manual input
?>
<form method="post">
    Amount: <input type="number" name="amount" step="any" required><br>
    <input type="submit" value="Calculate VAT">
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = $_POST['amount'];
    $vat = $amount * 0.15;
    echo "Amount: $amount<br>";
    echo "VAT (15%): $vat<br>";
}
?> 