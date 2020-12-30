@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
@endphp
<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

        {{--@if(auth()->user()->usertype == 'Admin')
            <li class="nav-item has-treeview {{ ($prefix=='/users')?'menu-open':'' }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Manage User
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link {{ ($route=='users.index')?'active':'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View User</p>
                        </a>
                    </li>
                </ul>
            </li>
        @endif--}}


        <li class="nav-item has-treeview {{ ($prefix=='/suppliers')?'menu-open':'' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    Manage Suppliers
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('suppliers.index') }}" class="nav-link {{ ($route=='suppliers.index')?'active':'' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View Supplier</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview {{ ($prefix=='/customer')?'menu-open':'' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    Manage Customer
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('customers.index') }}" class="nav-link {{ ($route=='customers.index')?'active':'' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View Customer</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview {{ ($prefix=='/units')?'menu-open':'' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    Manage Unit
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('units.index') }}" class="nav-link {{ ($route=='units.index')?'active':'' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View Unit</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview {{ ($prefix=='/categories')?'menu-open':'' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    Manage Category
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link {{ ($route=='categories.index')?'active':'' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View Category</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview {{ ($prefix=='/products')?'menu-open':'' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    Manage Product
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link {{ ($route=='products.index')?'active':'' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View Product</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview {{ ($prefix=='/purchases')?'menu-open':'' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    Manage Purchase
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('purchases.index') }}" class="nav-link {{ ($route=='purchases.index')?'active':'' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View Purchase</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('purchases.pending.list') }}" class="nav-link {{ ($route=='purchases.pending.list')?'active':'' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Approval Purchase</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview {{ ($prefix=='/invoice')?'menu-open':'' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    Manage Invoice
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('invoice.index') }}" class="nav-link {{ ($route=='invoice.index')?'active':'' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View Invoice</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('invoice.pending.list') }}" class="nav-link {{ ($route=='invoice.pending.list')?'active':'' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Approval Invoice</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('invoice.print.list') }}" class="nav-link {{ ($route=='invoice.print.list')?'active':'' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Print Invoice</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('invoice.daily.report') }}" class="nav-link {{ ($route=='invoice.daily.report')?'active':'' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Daily Invoice Report</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview {{ ($prefix=='/stocks')?'menu-open':'' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    Manage Stock
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('stocks.report') }}" class="nav-link {{ ($route=='stocks.report')?'active':'' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Stock Report</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('stocks.report.supplier.product.wise') }}" class="nav-link {{ ($route=='stocks.report.supplier.product.wise')?'active':'' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Supplier/Product Wise</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->

{{--Category--}}
{{--Product--}}
