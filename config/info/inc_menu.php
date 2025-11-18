<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index">
        <div class="sidebar-brand-icon">
            <img style="height: 62px;" src="../assets/img/globo_foup_fav_icon.png">
        </div>
        <div class="sidebar-brand-text mx-3">Painel Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <?php foreach ($_SESSION['menu'] as $menu => $programas) { $str_menu = str_replace(' ', '', $menu); ?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse<?= $str_menu ?>"
           aria-expanded="true" aria-controls="collapse<?= $str_menu ?>">
            <i class="fas fa-fw fa-cog"></i>
            <span><?=$menu?></span>
        </a>
        <div id="collapse<?=$str_menu?>" class="collapse" aria-labelledby="heading<?=$str_menu?>" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!--h6 class="collapse-header">Custom Components:</h6-->
                <?php foreach ($programas as $item) { ?>
                <a class="collapse-item" href="<?=$item['url_programa']."?".cript("m=".$item['cd_modulo'].'&p='.$item['cd_programa'])?>"><?=$item['nm_programa']?></a>
                <?php } ?>
            </div>
        </div>
    </li>
    <?php } ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>