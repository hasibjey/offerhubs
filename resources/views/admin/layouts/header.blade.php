<header>
    <div class="row m-0">
        <div class="col-md-5">
            <ul class="f-top-icon-group">
                <li class="d-none">
                    <ion-icon name="menu-outline"></ion-icon>
                </li>
                <li class="f-top-icon-item">
                    <ion-icon name="mail-outline"></ion-icon>
                    <span class="count">99</span>
                    <div class="f-notification-container">
                        <ul class="f-row">
                            <li class="f-col">1</li>
                            <li class="f-col">md hasibur rahman</li>
                            <li class="f-col"><img src="{{ asset('assets/images/demo.jpeg') }}" alt=""
                                    class="f-notification-img"></li>
                        </ul>
                        <ul class="f-row">
                            <li class="f-col">1</li>
                            <li class="f-col">md hasibur rahman</li>
                            <li class="f-col"><img src="{{ asset('assets/images/demo.jpeg') }}" alt=""
                                    class="f-notification-img"></li>
                        </ul>
                        <ul class="f-row">
                            <li class="f-col">1</li>
                            <li class="f-col">md hasibur rahman</li>
                            <li class="f-col"><img src="{{ asset('assets/images/demo.jpeg') }}" alt=""
                                    class="f-notification-img"></li>
                        </ul>
                        <ul class="f-row">
                            <li class="f-col">1</li>
                            <li class="f-col">md hasibur rahman</li>
                            <li class="f-col"><img src="{{ asset('assets/images/demo.jpeg') }}" alt=""
                                    class="f-notification-img"></li>
                        </ul>
                        <ul class="f-row">
                            <li class="f-col">1</li>
                            <li class="f-col">md hasibur rahman</li>
                            <li class="f-col"><img src="{{ asset('assets/images/demo.jpeg') }}" alt=""
                                    class="f-notification-img"></li>
                        </ul>
                        <ul class="f-row">
                            <li class="f-col">1</li>
                            <li class="f-col">md hasibur rahman</li>
                            <li class="f-col"><img src="{{ asset('assets/images/demo.jpeg') }}" alt=""
                                    class="f-notification-img"></li>
                        </ul>
                        <ul class="f-row">
                            <li class="f-col">1</li>
                            <li class="f-col">md hasibur rahman</li>
                            <li class="f-col"><img src="{{ asset('assets/images/demo.jpeg') }}" alt=""
                                    class="f-notification-img"></li>
                        </ul>
                    </div>
                </li>
                <li class="f-top-icon-item">
                    <ion-icon name="notifications-outline"></ion-icon>
                    <span class="count">99</span>
                    <div class="f-notification-container">
                        <ul class="f-row">
                            <li class="f-col">1</li>
                            <li class="f-col">md hasibur rahman</li>
                            <li class="f-col"><img src="{{ asset('assets/images/demo.jpeg') }}" alt=""
                                    class="f-notification-img"></li>
                        </ul>
                        <ul class="f-row">
                            <li class="f-col">1</li>
                            <li class="f-col">md hasibur rahman</li>
                            <li class="f-col"><img src="{{ asset('assets/images/demo.jpeg') }}" alt=""
                                    class="f-notification-img"></li>
                        </ul>
                        <ul class="f-row">
                            <li class="f-col">1</li>
                            <li class="f-col">md hasibur rahman</li>
                            <li class="f-col"><img src="{{ asset('assets/images/demo.jpeg') }}" alt=""
                                    class="f-notification-img"></li>
                        </ul>
                        <ul class="f-row">
                            <li class="f-col">1</li>
                            <li class="f-col">md hasibur rahman</li>
                            <li class="f-col"><img src="{{ asset('assets/images/demo.jpeg') }}" alt=""
                                    class="f-notification-img"></li>
                        </ul>
                        <ul class="f-row">
                            <li class="f-col">1</li>
                            <li class="f-col">md hasibur rahman</li>
                            <li class="f-col"><img src="{{ asset('assets/images/demo.jpeg') }}" alt=""
                                    class="f-notification-img"></li>
                        </ul>
                        <ul class="f-row">
                            <li class="f-col">1</li>
                            <li class="f-col">md hasibur rahman</li>
                            <li class="f-col"><img src="{{ asset('assets/images/demo.jpeg') }}" alt=""
                                    class="f-notification-img"></li>
                        </ul>
                        <ul class="f-row">
                            <li class="f-col">1</li>
                            <li class="f-col">md hasibur rahman</li>
                            <li class="f-col"><img src="{{ asset('assets/images/demo.jpeg') }}" alt=""
                                    class="f-notification-img"></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col-md-5"></div>
        <div class="col-md-2 position-relative">
            <div class="f-admin-img">
                
                <img src="{{ Auth::guard('admin')->user()->image == null? "https://ui-avatars.com/api/?name=".Auth::guard('admin')->user()->name : asset(Auth::guard('admin')->user()->image) }}" alt="">
            </div>
            <ul class="f-admin-nav">
                <li class="f-admin-item">
                    <a href="/admin/profile" class="f-admin-link">
                        <i class="fa-solid fa-user"></i>
                        <span>profile</span>
                    </a>
                </li>
                <li class="f-admin-item">
                    <form method="POST" action="{{ route('admin.logout') }}" style="margin: 0;">
                        @csrf
                        <a href="{{ route('admin.logout') }}" class="f-admin-link" onclick="event.preventDefault();this.closest('form').submit();">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>logout</span>
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>