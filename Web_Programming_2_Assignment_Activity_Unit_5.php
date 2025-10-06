<?php
/**
* Author: Anuj Acharya
* Date: 2025-10-06
// -------------------- START SESSION --------------------

// ---------------------------------------------------------
// Vehicle Management System: Classes, Objects, Inheritance
// ---------------------------------------------------------
// Purpose: Demonstrate PHP OOP concepts such as inheritance,
// static members, method overriding, and dynamic form handling
// in a car dealership system.

// --------------------
// Base Class: Vehicle
// --------------------
class Vehicle {
    protected $brand;
    protected $model;
    protected $year;
    protected $price;
    public static $totalVehicles = 0; // Track total instances created

    // Constructor initializes shared attributes and increments counter
    public function __construct($brand, $model, $year, $price) {
        $this->brand = $brand;
        $this->model = $model;
        $this->year = $year;
        $this->price = $price;
        self::$totalVehicles++;
    }

    // Display common vehicle info
    public function displayInfo() {
        return "Brand: {$this->brand} | Model: {$this->model} | Year: {$this->year} | Price: \${$this->price}";
    }

    // Compare two vehicles by selected criterion (price or year)
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

    public function __construct($brand, $model, $year, $price, $numberOfDoors) {
        parent::__construct($brand, $model, $year, $price);
        $this->numberOfDoors = $numberOfDoors;
    }

    // Override to include specific Car property
    public function displayInfo() {
        return parent::displayInfo() . " | Doors: {$this->numberOfDoors}";
    }
}

// --------------------
// Subclass: Truck
// --------------------
class Truck extends Vehicle {
    private $cargoCapacity;

    public function __construct($brand, $model, $year, $price, $cargoCapacity) {
        parent::__construct($brand, $model, $year, $price);
        $this->cargoCapacity = $cargoCapacity;
    }

    // Override to include specific Truck property
    public function displayInfo() {
        return parent::displayInfo() . " | Cargo Capacity: {$this->cargoCapacity} tons";
    }
}

// --------------------
// Subclass: Motorcycle
// --------------------
class Motorcycle extends Vehicle {
    private $handlebarType;

    public function __construct($brand, $model, $year, $price, $handlebarType) {
        parent::__construct($brand, $model, $year, $price);
        $this->handlebarType = $handlebarType;
    }

    // Override to include specific Motorcycle property
    public function displayInfo() {
        return parent::displayInfo() . " | Handlebar Type: {$this->handlebarType}";
    }
}

// ----------------------------------------------------
// Handle Form Submissions for Adding and Comparing
// ----------------------------------------------------
$vehicles = [];
$comparisonResult = "";

// Handle new vehicle submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_vehicle'])) {
    $type = $_POST['type'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];

    // Create the corresponding object
    if ($type === "Car") {
        $vehicles[] = new Car($brand, $model, $year, $price, $_POST['numberOfDoors']);
    } elseif ($type === "Truck") {
        $vehicles[] = new Truck($brand, $model, $year, $price, $_POST['cargoCapacity']);
    } elseif ($type === "Motorcycle") {
        $vehicles[] = new Motorcycle($brand, $model, $year, $price, $_POST['handlebarType']);
    }
}

// Handle comparison between two vehicles
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['compare'])) {
    $vehicle1 = new Car($_POST['brand1'], $_POST['model1'], $_POST['year1'], $_POST['price1'], 4);
    $vehicle2 = new Car($_POST['brand2'], $_POST['model2'], $_POST['year2'], $_POST['price2'], 4);
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
    form, .result { background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 25px; }
    label { display: block; margin-top: 10px; font-weight: 500; }
    input, select { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 8px; margin-top: 4px; }
    button { background: #0078D7; color: white; border: none; padding: 10px 15px; border-radius: 8px; cursor: pointer; margin-top: 15px; }
    button:hover { background: #005fa3; }
    .result { text-align: center; color: #0078D7; font-weight: bold; }
</style>
<script>
// ------------------------------------------------------------------
// JavaScript: Control visible input fields based on vehicle type
// ------------------------------------------------------------------
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

<!-- Vehicle Creation Form -->
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

    <!-- Unique Fields -->
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

<!-- Comparison Form -->
<form method="POST">
    <h3>Compare Two Vehicles</h3>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
        <div>
            <h4>Vehicle 1</h4>
            <label>Brand:</label><input type="text" name="brand1" required>
            <label>Model:</label><input type="text" name="model1" required>
            <label>Year:</label><input type="number" name="year1" min="2000" max="2025" required>
            <label>Price ($):</label><input type="number" name="price1" min="1" step="0.01" required>
        </div>
        <div>
            <h4>Vehicle 2</h4>
            <label>Brand:</label><input type="text" name="brand2" required>
            <label>Model:</label><input type="text" name="model2" required>
            <label>Year:</label><input type="number" name="year2" min="2000" max="2025" required>
            <label>Price ($):</label><input type="number" name="price2" min="1" step="0.01" required>
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

<!-- Comparison Result -->
<?php if (!empty($comparisonResult)): ?>
    <div class="result">
        <p><?= htmlspecialchars($comparisonResult) ?></p>
        <p>Total Vehicles Created: <?= Vehicle::$totalVehicles ?></p>
    </div>
<?php endif; ?>

</body>
</html>
