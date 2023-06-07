<section class="f-left">
    <div class="f-main-nav">
        <header>
            <p class="f-company">Offer hubs</p>
            {{-- <p class="f-company-title">company title</p> --}}
        </header>
        <nav class="f-nav">
            <ul class="f-nav-group">
                <li class="f-nav-item">
                    <a href="/admin/dashboard" class="f-nav-link" id="dashboard">
                        <span class="material-icons f-nav-angle invisible">
                            expand_more
                        </span>
                        <span class="material-icons f-nav-icon">
                            home
                        </span>
                        <span class="f-nav-name">dashboard</span>
                    </a>
                </li>
                <li class="f-nav-item">
                    <p class="f-nav-link">
                        <span class="material-icons f-nav-angle">
                            expand_more
                        </span>
                        <span class="material-icons f-nav-icon">
                            production_quantity_limits
                        </span>
                        <span class="f-nav-name">offer management</span>
                    </p>
                    <ul class="f-sub-nav-group">
                        <li class="f-sub-nav-item">
                            <a href="/admin/books" class="f-sub-nav-link" id="books">offers</a>
                        </li>
                        <li class="f-sub-nav-item">
                            <a href="{{ route('admin.navigation') }}" class="f-sub-nav-link" id="navigation">navigation</a>
                        </li>
                        <li class="f-sub-nav-item">
                            <a href="{{ route('admin.category') }}" class="f-sub-nav-link" id="categories">category</a>
                        </li>
                    </ul>
                </li>
                <li class="f-nav-item">
                    <a href="/admin/dashboard" class="f-nav-link" id="sellers">
                        <span class="material-icons f-nav-angle invisible">
                            expand_more
                        </span>
                        <span class="material-icons f-nav-icon">
                            storefront
                        </span>
                        <span class="f-nav-name">restaurants</span>
                    </a>
                </li>
                <li class="f-nav-item">
                    <a href="{{ route('admin.customer') }}" class="f-nav-link" id="users">
                        <span class="material-icons f-nav-angle invisible">
                            expand_more
                        </span>
                        <span class="material-icons f-nav-icon">
                            group
                        </span>
                        <span class="f-nav-name">Cutomers</span>
                    </a>
                </li>
                <li class="f-nav-item">
                    <a href="{{ route('admin.popupads') }}" class="f-nav-link" id="users">
                        <span class="material-icons f-nav-angle invisible">
                            expand_more
                        </span>
                        <span class="material-icons f-nav-icon">
                            ads_click
                        </span>
                        <span class="f-nav-name">popup ads</span>
                    </a>
                </li>
                <li class="f-nav-item">
                    <p class="f-nav-link">
                        <span class="material-icons f-nav-angle">
                            expand_more
                        </span>
                        <span class="material-icons f-nav-icon">
                            settings
                        </span>
                        <span class="f-nav-name">setting</span>
                    </p>
                    <ul class="f-sub-nav-group">
                        <li class="f-sub-nav-item">
                            <a href="/admin/admins" class="f-sub-nav-link" id="admins">admins</a>
                        </li>
                        <li class="f-sub-nav-item">
                            <a href="/admin/company" class="f-sub-nav-link" id="company">Company Information</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</section>
