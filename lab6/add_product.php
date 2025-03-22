<?php
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $buying_price = $_POST['buying_price'];
    $selling_price = $_POST['selling_price'];
    $profit = $selling_price - $buying_price; // Calculate profit
    $display = $_POST['display'];

    // Create a new connection for the insert operation
    $insertConn = new mysqli($servername, $username, $password, $dbname);
    
    if ($insertConn->connect_error) {
        die("Connection failed: " . $insertConn->connect_error);
    }

    // Prepare and bind
    $stmt = $insertConn->prepare("INSERT INTO products (name, buying_price, selling_price, profit, display) VALUES (?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        die('Error in prepare statement: ' . $insertConn->error);
    }
    
    $stmt->bind_param("sddds", $name, $buying_price, $selling_price, $profit, $display);
    
    // Execute the statement
    if ($stmt->execute()) {
        $stmt->close();
        $insertConn->close();
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $insertConn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Product</title>
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
        <h2>Add New Product</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <table border="0" cellpadding="5">
                <tr>
                    <td>Name:</td>
                    <td><input type="text" id="name" name="name" required></td>
                </tr>
                <tr>
                    <td>Buying Price:</td>
                    <td><input type="number" id="buying_price" name="buying_price" step="0.01" required onchange="calculateProfit()" onkeyup="calculateProfit()"></td>
                </tr>
                <tr>
                    <td>Selling Price:</td>
                    <td><input type="number" id="selling_price" name="selling_price" step="0.01" required onchange="calculateProfit()" onkeyup="calculateProfit()"></td>
                </tr>
                <tr>
                    <td>Profit:</td>
                    <td><span id="profit_display">0.00</span></td>
                </tr>
                <tr>
                    <td>Display:</td>
                    <td>
                        <select name="display" id="display">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="Add Product">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html> 