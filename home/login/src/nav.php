<!-- navBar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky">
    <a class="navbar-brand" href="./home.php">
        <img src="../src/logo/LOGO dark .png" alt="Logo" style="height: 40px; margin: 0px; padding: 0px;">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-link <?php echo "$home" ?>" href="./home.php">Home</span></a>
            <a class="nav-link <?php echo "$api" ?>" href="./api.php">API</a>
            <a class="nav-link <?php echo "$featchure" ?>" href="./featchure.php">Features</a>
            <a class="nav-link <?php echo "$price" ?>" href="./price.php">Pricing</a>
            <a class="nav-link <?php echo "$contact" ?>" href="./contact.php">Contact</a>
            <a class="nav-link" href="../user-interface/logout.php">Logout</a>
        </div>
    </div>
</nav>