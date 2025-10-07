# 🚗 Vehicle Management System – PHP OOP Project

### Overview
The **Vehicle Fleet Manager** is a PHP-based Object-Oriented Programming (OOP) web application designed for a car dealership that manages a diverse fleet of vehicles, including **Cars**, **Trucks**, and **Motorcycles**. The system allows users to dynamically add new vehicles, view the total count of created instances, and compare vehicles based on chosen attributes such as price or model year.

This project demonstrates key OOP concepts such as **inheritance**, **encapsulation**, **method overriding**, **static properties**, and **class-based abstraction** — all implemented through an interactive web interface.

---

### 🎯 **Key Features**
- **Base Class (`Vehicle`)**:  
  Contains shared properties (`brand`, `model`, `year`, `price`) and methods such as:
  - `displayInfo()` — Displays vehicle details.
  - `compareVehicles()` — Compares two user-selected vehicles based on price, brand, model, or year.
  - **Static Property `$vehicleCount`** — Automatically counts total vehicle instances created.

- **Subclasses:**
  - `Car` – Includes a unique property `$numberOfDoors`.
  - `Truck` – Includes a unique property `$cargoCapacity`.
  - `Motorcycle` – Includes a unique property `$handlebarType`.

  Each subclass overrides the `displayInfo()` method to include its unique attribute.

- **Dynamic Vehicle Form:**  
  Users can select the vehicle type (Car, Truck, or Motorcycle), input relevant details, and add it to the list. The total vehicle count automatically updates.

- **Comparison Feature:**  
  Allows comparison of any two user-added vehicles using a dropdown menu with options for brand, model, year, or price.

- **Interactive Feedback:**  
  When a new vehicle is added, a message appears dynamically at the top of the form confirming successful addition.

- **Persistent Vehicle List:**  
  Newly added vehicles appear on the same page (below the form and above the comparison section) to guide users visually.

---

### 🧩 **System Flow**
1. **User selects vehicle type** from a dropdown (`Car`, `Truck`, or `Motorcycle`).
2. **Form dynamically changes** based on the selected type (e.g., shows doors for cars, cargo for trucks).
3. **User fills in details** — brand, model, year, price, and type-specific property.
4. **Upon submission:**
   - Vehicle object is created.
   - Static count increases.
   - A success message appears.
   - The vehicle is displayed in the list.
5. **Users can compare** two vehicles based on price, brand, model, or year using dropdowns.

---

### 🧪 **Dummy Input Examples**

| Type | Brand | Model | Year | Price ($) | Unique Attribute |
|------|--------|--------|------|------------|------------------|
| Car | Toyota | Corolla | 2022 | 25,000 | 4 doors |
| Car | Honda | Civic | 2023 | 27,000 | 4 doors |
| Truck | Ford | F-150 | 2021 | 45,000 | 1000 kg cargo capacity |
| Truck | Tata | Xenon | 2022 | 38,000 | 900 kg cargo capacity |
| Motorcycle | Yamaha | MT-15 | 2023 | 3,500 | Sport handlebar |
| Motorcycle | Royal Enfield | Classic 350 | 2021 | 4,000 | Cruiser handlebar |

---

### ⚙️ **Technologies Used**
- **PHP 8** (Object-Oriented Programming)
- **HTML5 & CSS3** (User Interface)
- **JavaScript** (Form interactivity and popup)
- **Visual Studio Code** (Development Environment)

---

### 📖 **How to Run**
1. Clone this repository:
   ```bash
   git clone https://github.com/YourUsername/VehicleFleetManager_PHP_OOP.git
