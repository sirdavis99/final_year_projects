<nav class="navbar navbar-expand-md bg-success navbar-dark shadow fixed-top justify-content-between">
    <!-- Brand -->
    <div class="flex-grow-1" >
        <a href="<?=base_url()?>" class="navbar-brand">
            <b class="d-inline-block d-md-none">ITS</b>
            <b class="d-none d-md-block"> Intelligent Tourist System</b>
        </a>
    </div>
    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Navbar links -->
    <div class="flex-grow-0 collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>admin/places">Places</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>admin/users">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>admin/feedbacks">Feedbacks</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>account/logout">Logout</a>
            </li>
        </ul>
    </div>
</nav>