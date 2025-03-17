<?php
require_once 'db_connect.php';

if (isset($_GET['term'])) {
    $search = $_GET['term'];
    
    // Prepare the SQL query with LIKE for name search
    $sql = "SELECT * FROM products WHERE display = 'Yes' AND name LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%" . $search . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>NAME</th>
                    <th>BUYING PRICE</th>
                    <th>SELLING PRICE</th>
                    <th>PROFIT</th>
                    <th>Actions</th>
                </tr>";
        
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["name"] . "</td>
                    <td>" . $row["buying_price"] . "</td>
                    <td>" . $row["selling_price"] . "</td>
                    <td>" . $row["profit"] . "</td>
                    <td>
                        <a href='edit.php?id=" . $row["id"] . "'>edit</a>
                        <a href='delete.php?id=" . $row["id"] . "'>delete</a>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No products found matching your search.</p>";
    }
    
    $stmt->close();
}

$conn->close();
?> 