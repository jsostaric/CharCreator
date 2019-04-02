<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <a class="navbar-brand" href="<?php echo $route; ?>index.php">PF</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <?php if(!isset($_SESSION["session"])): ?>
          <a class="nav-link" href="<?php echo $route; ?>index.php">Home</a>
        <?php else: ?>
          <a class="nav-link" href="<?php echo $route; ?>private/index.php">Dashboard</a>
        <?php endif; ?>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="<?php echo $route; ?>public/about.php">About</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="<?php echo $route; ?>public/contact.php">Contact</a>
      </li>
        <?php if(isset($_SESSION["session"])): ?>
      <li class="nav-item">
          <a class="nav-link" href="<?php echo $route; ?>public/logout.php">Logout</a>
      </li>
        <?php endif; ?>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $route; ?>documentation/era.png" target="_blank">Era</a>
      </li>
      <li>
        <a class="nav-link" target="_blank" href="https://github.com/jsostaric">Github</a>
      </li>
    </ul>
  </div>
</nav>
