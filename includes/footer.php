<div class="footer">

    <div class="footer-container">

        <!-- COLUMN 1 -->
        <div class="footer-col">
            <h3>Centre for Textile Heritage & Technology</h3>
            <p>Preserving traditional sarees and weaving culture of India.</p>
        </div>

        <!-- COLUMN 2 -->
        <div class="footer-col">
            <h4>CoE</h4>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="index.php?page=about">About</a></li>
                <li><a href="index.php?page=vision">Vision</a></li>
                <li><a href="index.php?page=mission">Mission</a></li>
                <li><a href="index.php?page=objectives">Key Objectives</a></li>
            </ul>
        </div>

        <!-- COLUMN 3 -->
        <div class="footer-col">
            <h4>Products</h4>
            <ul>
                <?php
                require_once "includes/db.php";
                $stmt = $pdo->query("SELECT * FROM products WHERE status=1 ORDER BY product_name ASC");

                while ($row = $stmt->fetch()) {
                    echo '<li><a href="index.php?product=' . $row["product_key"] . '">' . $row["product_name"] . '</a></li>';
                }
                ?>
            </ul>
        </div>

        <!-- COLUMN 4 -->
        <div class="footer-col">
            <h4>Contact</h4>
            <p>Email: bipin[AT]iitd.ac.in</p>
            <p>Phone: +91-26591401</p>
            <p></p>
        </div>

    </div>

    <!-- BOTTOM BAR -->
    <div class="footer-bottom">
        © <?php echo date("Y"); ?> DST &amp; T&FE, IITD | All Rights Reserved.
    </div>

</div>
