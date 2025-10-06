# 🚗 OOP Vehicle Management System in PHP

A simple yet elegant **Object-Oriented PHP** web application that models a **car dealership management system**.  
It demonstrates core OOP concepts such as **classes, inheritance, encapsulation, static properties, and polymorphism**,  
combined with interactive **HTML forms** and **dynamic data rendering**.

---

## 🧾 Project Overview

This project simulates a car dealership system that manages a diverse fleet of vehicles — **Cars, Trucks, and Motorcycles**.  
Each vehicle type shares common attributes (brand, model, year, price) but also includes unique properties relevant to its category.

The system allows users to:
- Add new vehicles dynamically via a form.
- View all registered vehicles in a clean and structured layout.
- Compare any two vehicles based on **price** or **model year**.
- Track the total number of vehicle instances created using a static class property.

This project is designed to demonstrate **OOP principles in PHP** through a real-world example.

---

## 🧠 Key OOP Concepts Demonstrated

### 1. **Base Class Creation**
- `Vehicle` class defines shared attributes and behaviors.
- Includes a **static property** `$vehicleCount` to track the total number of vehicles created.
- Contains a `compareVehicles()` method to compare vehicles by price or year.

### 2. **Inheritance and Method Overriding**
- Subclasses `Car`, `Truck`, and `Motorcycle` extend `Vehicle`.
- Each adds unique properties:
  - `Car`: `$numberOfDoors`
  - `Truck`: `$cargoCapacity`
  - `Motorcycle`: `$handlebarType`
- Each subclass overrides `displayInfo()` to show both common and unique attributes.

### 3. **Encapsulation and Polymorphism**
- Common structure ensures reusability and maintainability.
- `displayInfo()` behaves differently depending on the subclass invoked.

---

## 🧰 Technologies Used

| Component | Description |
|------------|-------------|
| **Language** | PHP (Object-Oriented PHP 8) |
| **Frontend** | HTML5, CSS3 (inline minimal design) |
| **Server** | Localhost (XAMPP / WAMP / PHP built-in server) |
| **IDE** | Visual Studio Code |

---

## 💻 Features

- 🚙 Add new vehicles dynamically via form inputs.
- 🏗️ Modular OOP structure for scalability.
- 🧮 Static counter to track all instantiated vehicles.
- 🧾 Vehicle comparison by **price** or **model year**.
- 🎨 Clean, elegant, and user-friendly interface.
- 🧱 Demonstrates real-world use of **classes, inheritance, and polymorphism**.

---

## 🧑‍💻 How to Run the Project

1. Clone this repository:
   ```bash
   git clone https://github.com/<your-username>/OOP-Vehicle-Management-System-PHP.git
