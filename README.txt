QuickEats v2 - XAMPP demo (larger fonts, login/register, admin auth, order status)
---------------------------------------------------------------------------
How to use:
1. Copy the 'food_delivery_xampp_v2' folder into XAMPP's htdocs directory, e.g. C:\xampp\htdocs\food_delivery
2. Start Apache and MySQL in XAMPP control panel.
3. Open http://localhost/phpmyadmin and import 'db.sql' (it creates database 'food_db' and sample data).
   Note: For security, the sample users have empty password fields in db.sql. Run the small helper below to set passwords or manually set via phpMyAdmin.
4. Visit http://localhost/food_delivery in your browser.
5. Register a new user or login as admin (set admin password via phpMyAdmin).

Helper: Use this simple PHP script to set passwords for demo accounts if needed:
<?php
include('includes/db.php');
$hash1 = password_hash('demo123', PASSWORD_DEFAULT);
$hash2 = password_hash('admin123', PASSWORD_DEFAULT);
mysqli_query($conn, "UPDATE users SET password='$hash1' WHERE email='demo@example.com'");
mysqli_query($conn, "UPDATE users SET password='$hash2' WHERE email='admin@example.com'");
echo 'Passwords set.';
?>
