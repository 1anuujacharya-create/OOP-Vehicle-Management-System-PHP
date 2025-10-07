<?php
// Author: Anuj Acharya
// Date: 2025-10-07
// -------------------- START SESSION --------------------

// ---------------------------------------------------------
// Vehicle Management System: Classes, Objects, Inheritance
// ---------------------------------------------------------

session_start(); // To persist added vehicles between reloads

// --------------------
// Base Class: Vehicle
// --------------------
class Vehicle {
    protected $brand;
    protected $model;
    protected $year;
    protected $price;
    public static $totalVehicles = 0; // Track total instances created

    public function __construct($brand, $model, $year, $price, $count = true) {
        $this->brand = $brand;
        $this->model = $model;
        $this->year = $year;
        $this->price = $price;
        if ($count) self::$totalVehicles++;
    }

    public function displayInfo() {
        return "Brand: {$this->brand} | Model: {$this->model} | Year: {$this->year} | Price: \${$this->price}";
    }

    public static function compareVehicles($vehicle1, $vehicle2, $criterion) {
        if ($criterion === "price") {
            return $vehicle1->price > $vehicle2->price
                ? "{$vehicle1->model} is more expensive than {$vehicle2->model}."
                : "{$vehicle2->model} is more expensive than {$vehicle1->model}.";
        } elseif ($criterion === "year") {
            return $vehicle1->year > $vehicle2->year
                ? "{$vehicle1->model} is newer than {$vehicle2->model}."
                : "{$vehicle2->model} is newer than {$vehicle1->model}.";
        } else {
            return "Invalid comparison criterion.";
        }
    }
}

// --------------------
// Subclass: Car
// --------------------
class Car extends Vehicle {
    private $numberOfDoors;

    public function __construct($brand, $model, $year, $price, $numberOfDoors, $count = true) {
        parent::__construct($brand, $model, $year, $price, $count);
        $this->numberOfDoors = $numberOfDoors;
    }

    public function displayInfo() {
        return parent::displayInfo() . " | Doors: {$this->numberOfDoors}";
    }
}

// --------------------
// Subclass: Truck
// --------------------
class Truck extends Vehicle {
    private $cargoCapacity;

    public function __construct($brand, $model, $year, $price, $cargoCapacity, $count = true) {
        parent::__construct($brand, $model, $year, $price, $count);
        $this->cargoCapacity = $cargoCapacity;
    }

    public function displayInfo() {
        return parent::displayInfo() . " | Cargo Capacity: {$this->cargoCapacity} tons";
    }
}

// --------------------
// Subclass: Motorcycle
// --------------------
class Motorcycle extends Vehicle {
    private $handlebarType;

    public function __construct($brand, $model, $year, $price, $handlebarType, $count = true) {
        parent::__construct($brand, $model, $year, $price, $count);
        $this->handlebarType = $handlebarType;
    }

    public function displayInfo() {
        return parent::displayInfo() . " | Handlebar Type: {$this->handlebarType}";
    }
}

// ----------------------------------------------------
// Handle Form Submissions for Adding and Comparing
// ----------------------------------------------------
if (!isset($_SESSION['vehicles'])) {
    $_SESSION['vehicles'] = [];
}
$comparisonResult = "";
$vehicleAdded = false;

// Handle new vehicle submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_vehicle'])) {
    $type = $_POST['type'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];

    if ($type === "Car") {
        $_SESSION['vehicles'][] = new Car($brand, $model, $year, $price, $_POST['numberOfDoors']);
    } elseif ($type === "Truck") {
        $_SESSION['vehicles'][] = new Truck($brand, $model, $year, $price, $_POST['cargoCapacity']);
    } elseif ($type === "Motorcycle") {
        $_SESSION['vehicles'][] = new Motorcycle($brand, $model, $year, $price, $_POST['handlebarType']);
    }

    $vehicleAdded = true;
}

// Keep track of the count correctly
Vehicle::$totalVehicles = count($_SESSION['vehicles']);

// Handle comparison between two vehicles
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['compare'])) {
    $vehicle1 = new Car($_POST['brand1'], $_POST['model1'], $_POST['year1'], $_POST['price1'], 4, false);
    $vehicle2 = new Car($_POST['brand2'], $_POST['model2'], $_POST['year2'], $_POST['price2'], 4, false);
    $comparisonResult = Vehicle::compareVehicles($vehicle1, $vehicle2, $_POST['criterion']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Vehicle Management System</title>
<style>
    body { font-family: 'Segoe UI', sans-serif; background: #f5f6f8; padding: 40px; }
    h2 { color: #333; text-align: center; }
    form, .result, .added-vehicles { background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 25px; }
    label { display: block; margin-top: 10px; font-weight: 500; }
    input, select { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 8px; margin-top: 4px; }
    button { background: #0078D7; color: white; border: none; padding: 10px 15px; border-radius: 8px; cursor: pointer; margin-top: 15px; }
    button:hover { background: #005fa3; }
    .result { text-align: center; color: #0078D7; font-weight: bold; }
    .counter { text-align: center; background: #e8f4ff; padding: 10px; border-radius: 10px; font-size: 1.1em; margin-bottom: 15px; color: #0078D7; font-weight: bold; }
    .success { background: #e6ffe6; padding: 10px; border-radius: 8px; color: #008000; font-weight: bold; text-align: center; margin-bottom: 15px; }
</style>
<script>
function toggleFields() {
    const type = document.getElementById("typeSelect").value;
    document.getElementById("carFields").style.display = type === "Car" ? "block" : "none";
    document.getElementById("truckFields").style.display = type === "Truck" ? "block" : "none";
    document.getElementById("motorcycleFields").style.display = type === "Motorcycle" ? "block" : "none";
}
</script>
</head>
<body>

<h2>🚗 Vehicle Management System</h2>

<div class="counter">
    Total Vehicles Created: <?= Vehicle::$totalVehicles ?>
</div>

<?php if ($vehicleAdded): ?>
<div class="success">✅ New vehicle successfully added!</div>
<?php endif; ?>

<form method="POST">
    <h3>Add New Vehicle</h3>
    <label>Vehicle Type:</label>
    <select id="typeSelect" name="type" onchange="toggleFields()" required>
        <option value="">-- Select Type --</option>
        <option value="Car">Car</option>
        <option value="Truck">Truck</option>
        <option value="Motorcycle">Motorcycle</option>
    </select>

    <label>Brand:</label>
    <select name="brand" required>
        <option value="">-- Select Brand --</option>
        <option value="Toyota">Toyota</option>
        <option value="Ford">Ford</option>
        <option value="Yamaha">Yamaha</option>
        <option value="Honda">Honda</option>
    </select>

    <label>Model:</label>
    <select name="model" required>
        <option value="">-- Select Model --</option>
        <option value="Corolla">Corolla</option>
        <option value="Ranger">Ranger</option>
        <option value="Civic">Civic</option>
        <option value="R15">R15</option>
    </select>

    <label>Year:</label>
    <select name="year" required>
        <option value="">-- Select Year --</option>
        <?php for ($i = 2025; $i >= 2000; $i--) echo "<option value='$i'>$i</option>"; ?>
    </select>

    <label>Price ($):</label>
    <input type="number" name="price" step="0.01" min="1" placeholder="Enter price" required>

    <div id="carFields" style="display:none;">
        <label>Number of Doors:</label>
        <input type="number" name="numberOfDoors" min="2" max="6" placeholder="e.g., 4">
    </div>

    <div id="truckFields" style="display:none;">
        <label>Cargo Capacity (tons):</label>
        <input type="number" name="cargoCapacity" step="0.1" placeholder="e.g., 3.5">
    </div>

    <div id="motorcycleFields" style="display:none;">
        <label>Handlebar Type:</label>
        <input type="text" name="handlebarType" placeholder="e.g., Sport or Cruiser">
    </div>

    <button type="submit" name="add_vehicle">Add Vehicle</button>
</form>

<!-- 🚘 Display Added Vehicles -->
<?php if (!empty($_SESSION['vehicles'])): ?>
<div class="added-vehicles">
    <h3>🚘 Added Vehicles</h3>
    <ul>
        <?php foreach ($_SESSION['vehicles'] as $index => $vehicle): ?>
            <li><?= ($index + 1) . ". " . htmlspecialchars($vehicle->displayInfo()); ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<!-- Compare Section -->
<form method="POST">
    <h3>Compare Two Vehicles</h3>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
        <div>
            <h4>Vehicle 1</h4>
            <label>Brand:</label>
            <select name="brand1" required>
                <option value="">-- Select Brand --</option>
                <option value="Toyota">Toyota</option>
                <option value="Ford">Ford</option>
                <option value="Yamaha">Yamaha</option>
                <option value="Honda">Honda</option>
            </select>
            <label>Model:</label>
            <select name="model1" required>
                <option value="">-- Select Model --</option>
                <option value="Corolla">Corolla</option>
                <option value="Ranger">Ranger</option>
                <option value="Civic">Civic</option>
                <option value="R15">R15</option>
            </select>
            <label>Year:</label>
            <select name="year1" required>
                <?php for ($i = 2025; $i >= 2000; $i--) echo "<option value='$i'>$i</option>"; ?>
            </select>
            <label>Price ($):</label>
            <input type="number" name="price1" required>
        </div>

        <div>
            <h4>Vehicle 2</h4>
            <label>Brand:</label>
            <select name="brand2" required>
                <option value="">-- Select Brand --</option>
                <option value="Toyota">Toyota</option>
                <option value="Ford">Ford</option>
                <option value="Yamaha">Yamaha</option>
                <option value="Honda">Honda</option>
            </select>
            <label>Model:</label>
            <select name="model2" required>
                <option value="">-- Select Model --</option>
                <option value="Corolla">Corolla</option>
                <option value="Ranger">Ranger</option>
                <option value="Civic">Civic</option>
                <option value="R15">R15</option>
            </select>
            <label>Year:</label>
            <select name="year2" required>
                <?php for ($i = 2025; $i >= 2000; $i--) echo "<option value='$i'>$i</option>"; ?>
            </select>
            <label>Price ($):</label>
            <input type="number" name="price2" required>
        </div>
    </div>

    <label>Compare By:</label>
    <select name="criterion" required>
        <option value="">-- Select Criterion --</option>
        <option value="price">Price</option>
        <option value="year">Model Year</option>
    </select>

    <button type="submit" name="compare">Compare Vehicles</button>
</form>

<?php if (!empty($comparisonResult)): ?>
<div class="result">
    <p><?= htmlspecialchars($comparisonResult) ?></p>
</div>
<?php endif; ?>

</body>
</html>
