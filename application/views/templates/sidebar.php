<?php $role = $this->session->userdata('role'); ?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= site_url('dashboard') ?>">
        <div class="sidebar-brand-icon">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="sidebar-brand-text mx-3">PT Maju Jaya</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <?php if ($role === 'admin'): ?>
    <div class="sidebar-heading">Master Data</div>

    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('produk') ?>">
            <i class="fas fa-fw fa-box"></i>
            <span>Produk</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('pelanggan') ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Pelanggan</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <?php endif; ?>

    <div class="sidebar-heading">Transaksi</div>

    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('sales_order') ?>">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Sales Order</span>
        </a>
    </li>

    <?php if ($role === 'admin' || $role === 'manager'): ?>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Laporan</div>

    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('laporan/penjualan') ?>">
            <i class="fas fa-fw fa-chart-bar"></i>
            <span>Laporan Penjualan</span>
        </a>
    </li>
    <?php endif; ?>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
