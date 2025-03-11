<?php
// Ensure the script runs only when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve input values from the HTML form and sanitize inputs
    $name = htmlspecialchars($_POST["name"]);
    $cookie = $_POST["cookie"];
    $quantity = (int)$_POST["quantity"];  // Ensure quantity is an integer
    $delivery = $_POST["delivery"];

    // Array to store different cookie types and their respective prices
    $cookie_prices = [
        "Pineapple Tarts" => 25,
        "Almond London" => 30,
        "Kuih Bangkit" => 20,
        "Semperit" => 22,
        "Sugee Cookies" => 28
    ];

    // Array to store delivery charges
    $delivery_charges = [
        "Self-Pickup" => 0,
        "Standard Delivery" => 10,
        "Express Delivery" => 20
    ];

    // Get the price of the selected cookie type
    $price_per_container = $cookie_prices[$cookie];

    // Calculate total cookie cost before any discounts
    $cookie_cost = $price_per_container * $quantity;

    // Apply a 5% discount for orders of 5 or more containers
    if ($quantity >= 5) {
        $discount = $cookie_cost * 0.05; // 5% discount calculation
    } else {
        $discount = 0; // No discount for less than 5 containers
    }

    // Get the delivery charge based on user selection
    $delivery_charge = $delivery_charges[$delivery];

    // Calculate the final total cost after discount and adding delivery charges
    $total_cost = $cookie_cost - $discount + $delivery_charge;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
    <link rel="stylesheet" href="style.css">  <!-- Link CSS file -->
</head>
<body>
    <h2>Order Summary</h2>
    <table>
        <tr>
            <th>Customer Name</th>
            <th>Cookie Type</th>
            <th>Quantity</th>
            <th>Price per Container</th>
            <th>Delivery</th>
            <th>Total Cost</th>
        </tr>
        <tr>
            <td><?php echo $name; ?></td>
            <td><?php echo $cookie; ?></td>
            <td><?php echo $quantity; ?></td>
            <td>RM<?php echo number_format($price_per_container, 2); ?></td>
            <td><?php echo $delivery; ?></td>
            <td><strong>RM<?php echo number_format($total_cost, 2); ?></strong></td>
        </tr>
    </table>

    <h3>Breakdown Calculation</h3>
    <p>Cookie Cost: RM<?php echo number_format($price_per_container, 2); ?> × <?php echo $quantity; ?> = RM<?php echo number_format($cookie_cost, 2); ?></p>
    <p>Discount (5% for 5+ containers): -RM<?php echo number_format($discount, 2); ?></p>
    <p>Delivery Charge (<?php echo $delivery; ?>): RM<?php echo number_format($delivery_charge, 2); ?></p>
    <p><strong>Total Estimated Cost: RM<?php echo number_format($total_cost, 2); ?></strong></p>
</body>
</html>

<?php
}
?>
