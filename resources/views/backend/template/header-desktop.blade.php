<header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
                <div class="form-header">
                </div>
                <div class="header-button">
                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="image">
                                <img src="{{asset('backend/images/icon/avatar-01.jpg')}}" alt="John Doe" />
                            </div>
                            <div class="content">
                                <a class="js-acc-btn" href="{{Auth::user()->roles == 'admin' ? route('dashboard.admin') : route('dashboard.user')}}">{{ auth()->user()->nama }}</a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="image">
                                        <a href="{{Auth::user()->roles == 'admin' ? route('dashboard.admin') : route('dashboard.user')}}">
                                            <img src="{{asset('backend/images/icon/avatar-01.jpg')}}" alt="John Doe" />
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="name">
                                            <a href="{{Auth::user()->roles == 'admin' ? route('dashboard.admin') : route('dashboard.user')}}">{{ auth()->user()->nama }}</a>
                                        </h5>
                                        <span class="email">{{ auth()->user()->username }}</span>
                                    </div>
                                </div>
                                <div class="account-dropdown__footer">
                                    <a href="/logout">
                                        <i class="zmdi zmdi-power"></i>Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
