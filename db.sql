-- QuickEats v2 schema and sample data
CREATE DATABASE IF NOT EXISTS food_db;
USE food_db;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255),
  role ENUM('customer', 'admin') DEFAULT 'customer'
);

CREATE TABLE IF NOT EXISTS restaurants (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  description TEXT,
  address VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS menu_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  restaurant_id INT,
  name VARCHAR(100),
  price DECIMAL(8,2),
  image VARCHAR(255),
  FOREIGN KEY (restaurant_id) REFERENCES restaurants(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  restaurant_id INT,
  total DECIMAL(10,2),
  status VARCHAR(50) DEFAULT 'Placed',
  order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS order_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT,
  menu_item_id INT,
  qty INT,
  price DECIMAL(8,2),
  FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
);

-- Sample data
INSERT INTO restaurants(name, description, address) VALUES
('Pasta Place','Italian pastas and more','MG Road, City'),
('Curry Corner','Homestyle Indian curries','Station Road, City');

-- Sample users with empty password placeholders (set via helper)
INSERT INTO users(name, email, password, role) VALUES
('Demo User','demo@example.com','', 'customer'),
('Admin','admin@example.com','', 'admin');

INSERT INTO menu_items(restaurant_id, name, price, image) VALUES
(1, 'Spaghetti Bolognese', 140.00, ''),
(1, 'Penne Arrabiata', 120.00, ''),
(2, 'Butter Chicken', 180.00, ''),
(2, 'Paneer Tikka', 150.00, '');
