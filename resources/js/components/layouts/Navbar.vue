<style></style>

<template>
    <div>
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <img alt="image" class="rounded-circle"
                                 src="/backend/images/theme/profile_small.jpg"/> <!-- Hỏi cách load image -->
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold"></span>
                                <span class="text-muted text-xs block">Quản lý <b class="caret"></b></span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="dropdown-item" href="javascript:void(0)">Thông tin cá nhân</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="">Đăng xuất</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>
                    <li class="active">
                        <a href="javascript:void(0);">
                            <i class="fa fa-th-large"></i>
                            <span class="nav-label">Trang chủ</span>
                        </a>
                    </li>
                    <li class="active">
                        <router-link :to="{name:'Student'}">
                            <i class="fa fa-th-large"></i>
                            <span class="nav-label">Học sinh</span>
                        </router-link>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>
    export default {
        name: 'comp-navbar',
    }
</script>