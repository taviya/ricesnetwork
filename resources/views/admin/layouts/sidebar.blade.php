{{-- <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('public/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin') }}" class="nav-link @if (\Request::route()->getName() == 'admin') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link @if (\Request::route()->getName() == 'user') active @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>User</p>
                    </a>
                </li>
                <!-- Add or Update Icons for other menu items as needed -->
                <li class="nav-item">
                    <a href="{{ route('size.index') }}" class="nav-link @if (\Request::route()->getName() == 'size.index') active @endif">
                        <i class="nav-icon fas fa-arrows-alt"></i>
                        <p>Size</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('rarity.index') }}" class="nav-link @if (\Request::route()->getName() == 'rarity.index') active @endif">
                        <i class="nav-icon fas fa-gem"></i>
                        <p>Rarity</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link @if (\Request::route()->getName() == 'products.index') active @endif">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>Product</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('booster_packages.index') }}" class="nav-link @if (\Request::route()->getName() == 'booster_packages.index') active @endif">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>Booster Packages</p>
                    </a>
                </li>                
                <li class="nav-item">
                    <a href="{{ route('order.index') }}" class="nav-link @if (\Request::route()->getName() == 'order.index') active @endif">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Order</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('fuel_maintenance_order.index') }}" class="nav-link @if (\Request::route()->getName() == 'fuel_maintenance_order.index') active @endif">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>Fuel Maintenance Order</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('withdraw.index') }}" class="nav-link @if (\Request::route()->getName() == 'withdraw.index') active @endif">
                        <i class="nav-icon fas fa-wallet"></i>
                        <p>Withdraw</p>
                    </a>
                </li>   
                <li class="nav-item">
                    <a href="{{ route('settings.index') }}" class="nav-link @if (\Request::route()->getName() == 'settings.index') active @endif">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>Settings</p>
                    </a>
                </li>                
            </ul>
        </nav>
    </div>
</aside> --}}


<aside class="left-sidebar" data-sidebarbg="skin5">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link @if (\Request::route()->getName() == 'admin') active @endif"
                        href="{{ route('admin') }}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                            class="hide-menu">Dashboard</span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link @if (\Request::route()->getName() == 'category') active @endif"
                        href="{{ route('category.index') }}" aria-expanded="false"><i
                            class="mdi mdi-border-inside"></i><span class="hide-menu">Cayegory</span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link @if (\Request::route()->getName() == 'sub_category') active @endif"
                        href="{{ route('sub_category.index') }}" aria-expanded="false"><i
                            class="mdi mdi-collage"></i><span class="hide-menu">Sub Cayegory</span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link @if (\Request::route()->getName() == 'nft') active @endif"
                        href="{{ route('nft.index') }}" aria-expanded="false"><i class="mdi mdi-arrow-all"></i><span
                            class="hide-menu">Nft</span></a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
