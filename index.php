<!DOCTYPE html>
<html>
<head>
    <title>Product Display</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }
        .center {
            text-align: center;
        }
    </style>
    <script>
        function toggleSearch() {
            var searchContainer = document.getElementById('searchContainer');
            searchContainer.style.display = searchContainer.style.display === 'none' ? 'block' : 'none';
        }

        function searchProducts() {
            var searchTerm = document.getElementById('searchInput').value;
            var xhr = new XMLHttpRequest();
            
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('searchResults').innerHTML = this.responseText;
                }
            };
            
            xhr.open('GET', 'search.php?term=' + encodeURIComponent(searchTerm), true);
            xhr.send();
        }
    </script>
</head>
<body>
    <div align="center">
        <h2>DISPLAY</h2>
        <button onclick="toggleSearch()">Search</button>
        <div id="searchContainer" style="display: none; margin: 10px;">
            <input type="text" id="searchInput" placeholder="Search products..." oninput="searchProducts()">
        </div>
        <div id="searchResults">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "product_db";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            $sql = "SELECT * FROM products WHERE display = 'Yes'";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
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
                            <td>" . htmlspecialchars($row["name"]) . "</td>
                            <td align='right'>" . number_format($row["buying_price"], 2) . "</td>
                            <td align='right'>" . number_format($row["selling_price"], 2) . "</td>
                            <td align='right'>" . number_format($row["profit"], 2) . "</td>
                            <td align='center'>
                                <a href='edit.php?id=" . $row["id"] . "'>edit</a>
                                <a href='delete.php?id=" . $row["id"] . "'>delete</a>
                            </td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No products found</p>";
            }
            $conn->close();
            ?>
        </div>
        <p>
            <a href="add_product.php">Add New Product</a>
        </p>
        <p><i>*** Note: Only Products with a display value "Yes" should be printed</i></p>
    </div>
</body>
</html> 