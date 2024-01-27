<?php
function calculateElectricityRate($voltage, $current, $rate) {
    // Calculate Power in Watts
    $power = $voltage * $current / 1000;

    // Calculate Energy in kWh
    $energy = $power * 1 * 1000; 

    // Calculate Total Charge
    $totalCharge = $energy * ($rate / 100);

    return array(
        'power' => $power,
        'energy' => $energy,
        'totalCharge' => $totalCharge
    );
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $voltage = isset($_POST["voltage"]) ? floatval($_POST["voltage"]) : 0;
    $current = isset($_POST["current"]) ? floatval($_POST["current"]) : 0;
    $rate = isset($_POST["rate"]) ? floatval($_POST["rate"]) : 0;

    $result = calculateElectricityRate($voltage, $current, $rate);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Electricity Rate Calculator</title>
    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('download.jpg') fixed;
            background-size: cover;
            font-family: 'Arial', sans-serif;
            color: #000000; 
            margin: 0;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8); 
            border-radius: 10px;
            padding: 20px;
            margin-top: 50px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #007bff;
        }
        button {
            background-color: #007bff;
            color: #ffffff;
        }
        button:hover {
            background-color: #0056b3;
        }
        .result {
            margin-top: 20px;
        }
        p {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Electricity Rate Calculator</h2>
        <form method="post">
            <div class="form-group">
                <label for="voltage">Voltage (V)</label>
                <input type="number" step="0.01" class="form-control" id="voltage" name="voltage" required>
            </div>
            <div class="form-group">
                <label for="current">Current (A)</label>
                <input type="number" step="0.01" class="form-control" id="current" name="current" required>
            </div>
            <div class="form-group">
                <label for="rate">Current Rate (sen/kWh)</label>
                <input type="number" step="0.01" class="form-control" id="rate" name="rate" required>
            </div>
            <button type="submit" class="btn btn-primary">Calculate</button>
        </form>

        <?php if (isset($result)): ?>
            <div class="result mt-3">
                <h3>Result</h3>
                <p>Power: <?php echo number_format($result['power'], 5) ?> kW</p>
                <p>Energy: <?php echo number_format($result['energy'], 2) ?> kWh</p>
                <p>Total Charge: RM <?php echo number_format($result['totalCharge'], 3) ?></p>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
