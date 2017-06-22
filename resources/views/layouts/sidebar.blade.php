<nav id="mainnav-container">
    <div id="mainnav">

        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">

                    <div id="mainnav-profile" class="mainnav-profile">
                        <div class="profile-wrap">
                            <div class="pad-btm">
                                <span class="label label-success pull-right">New</span>
                                <img class="img-circle img-sm img-border" src="img/profile-photos/1.png" alt="Profile Picture">
                            </div>
                            <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                <span class="pull-right dropdown-toggle">
                                    <i class="dropdown-caret"></i>
                                </span>
                                <p class="mnp-name">Aaron Chavez</p>
                                <span class="mnp-desc">aaron.cha@themeon.net</span>
                            </a>
                        </div>
                        <div id="profile-nav" class="collapse list-group bg-trans">
                            <a href="#" class="list-group-item">
                                <i class="ti-medall icon-lg icon-fw"></i> Link 1
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="ti-paint-roller icon-lg icon-fw"></i> Link 2
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="ti-heart icon-lg icon-fw"></i> Link 3
                            </a>
                        </div>
                    </div>

                    <div id="mainnav-shortcut">
                        <ul class="list-unstyled">
                            <li class="col-xs-4" data-content="Shortcut 1">
                                <a class="shortcut-grid" href="#">
                                    <i class="ti-gallery"></i>
                                </a>
                            </li>
                            <li class="col-xs-4" data-content="Shortcut 2">
                                <a class="shortcut-grid" href="#">
                                    <i class="ti-headphone"></i>
                                </a>
                            </li>
                            <li class="col-xs-4" data-content="Shortcut 3">
                                <a class="shortcut-grid" href="#">
                                    <i class="ti-pin-alt"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <ul id="mainnav-menu" class="list-group">

                        <li class="list-header">导航</li>

                        @if (webCan('rbac'))
                        <li @if (request()->getRequestUri() == '/user' || request()->getRequestUri() == '/role' || request()->getRequestUri() == '/permission') class="active" @endif>
                            <a href="#">
                                <i class="demo-psi-split-vertical-2"></i>
                                <span class="menu-title">
                                    <strong>权限管理</strong>
                                </span>
                                <i class="arrow"></i>
                            </a>

                            <ul class="collapse">
                                @if (webCan('user/index'))
                                    <li @if (request()->getRequestUri() == '/user') class="active-link" @endif ><a href="/user">管理员管理</a></li>
                                @endif
                                @if (webCan('role/index'))
                                    <li @if (request()->getRequestUri() == '/role') class="active-link" @endif><a href="/role">角色管理</a></li>
                                @endif
                                @if (webCan('permission/index'))
                                    <li @if (request()->getRequestUri() == '/permission') class="active-link" @endif><a href="/permission">权限管理</a></li>
                                @endif
                            </ul>
                        </li>
                        @endif

                        <li>
                            <a href="#">
                                <i class="demo-psi-split-vertical-2"></i>
                                <span class="menu-title">
                                    <strong>xxx</strong>
                                </span>
                                <i class="arrow"></i>
                            </a>

                            <ul class="collapse">
                                <li><a href="/aaa">111</a></li>
                                <li><a href="/bbb">2222</a></li>
                                <li><a href="/ccc">3333</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>