<header class="site-header">
  <div class="wrap header-inner">
    <a class="brand" href="/food_delivery">QuickEats</a>
    <nav>
      <a href="/food_delivery">Home</a>
      <a href="/food_delivery/cart.php">Cart</a>
      <?php if(isset($_SESSION['user'])): ?>
        <span class="muted">Hello, <?php echo htmlspecialchars($_SESSION['user']['name']); ?></span>
        <a href="/food_delivery/logout.php">Logout</a>
        <?php if($_SESSION['user']['role']==='admin'): ?>
          <a href="/food_delivery/admin">Admin</a>
        <?php endif; ?>
      <?php else: ?>
        <a href="/food_delivery/login.php">Login</a>
        <a href="/food_delivery/register.php">Register</a>
      <?php endif; ?>
    </nav>
  </div>
</header>
