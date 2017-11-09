<div class="sidebar" data-color="purple" data-image="img/sidebar-1.jpg">
    <div class="logo">
        <a href="#" class="simple-text">
            Adiguna Tupperware
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li>
                <a href="dashboard.html">
                    <i class="pe-7s-graph"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li @if(Route::currentRouteName() == 'barang') class="active" @endif>
                <a href="{{ route('barang', ['kategori' => 'Semua_kategori']) }}">
                    <i class="pe-7s-note2"></i>
                    <p>Barang</p>
                </a>
            </li>
            <li>
                <a href="typography.html">
                    <i class="pe-7s-news-paper"></i>
                    <p>Transaksi</p>
                </a>
            </li>
            <li>
                <a href="icons.html">
                    <i class="pe-7s-science"></i>
                    <p>Icons</p>
                </a>
            </li>
            <li>
                <a href="notifications.html">
                    <i class="pe-7s-bell"></i>
                    <p>Utility</p>
                </a>
            </li>
            <li class="active-pro">
                <a href="upgrade.html">
                    <i class="pe-7s-rocket"></i>
                    <p>Keluar</p>
                </a>
            </li>
        </ul>
    </div>
</div>