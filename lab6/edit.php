<?php
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $buying_price = $_POST['buying_price'];
    $selling_price = $_POST['selling_price'];
    $profit = $selling_price - $buying_price; // Calculate profit
    $display = $_POST['display'];

    $sql = "UPDATE products SET name=?, buying_price=?, selling_price=?, profit=?, display=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdddsi", $name, $buying_price, $selling_price, $profit, $display, $id);
    
    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $stmt->close();
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <script>
        function calculateProfit() {
            const buyingPrice = parseFloat(document.getElementById('buying_price').value) || 0;
            const sellingPrice = parseFloat(document.getElementById('selling_price').value) || 0;
            const profit = sellingPrice - buyingPrice;
            document.getElementById('profit_display').textContent = profit.toFixed(2);
        }
        
        window.onload = calculateProfit;
    </script>
</head>
<body>
    <div align="center">
        <h2>Edit Product</h2>
        <form method="POST">
            <table border="0" cellpadding="5">
                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                <tr>
                    <td>Name:</td>
                    <td><input type="text" id="name" name="name" value="<?php echo $product['name']; ?>" required></td>
                </tr>
                <tr>
                    <td>Buying Price:</td>
                    <td><input type="number" id="buying_price" name="buying_price" step="0.01" value="<?php echo $product['buying_price']; ?>" required onchange="calculateProfit()" onkeyup="calculateProfit()"></td>
                </tr>
                <tr>
                    <td>Selling Price:</td>
                    <td><input type="number" id="selling_price" name="selling_price" step="0.01" value="<?php echo $product['selling_price']; ?>" required onchange="calculateProfit()" onkeyup="calculateProfit()"></td>
                </tr>
                <tr>
                    <td>Profit:</td>
                    <td><span id="profit_display"><?php echo $product['profit']; ?></span></td>
                </tr>
                <tr>
                    <td>Display:</td>
                    <td>
                        <select name="display" id="display">
                            <option value="Yes" <?php echo ($product['display'] == 'Yes') ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" <?php echo ($product['display'] == 'No') ? 'selected' : ''; ?>>No</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="Update Product">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
<?php $conn->close(); ?> 