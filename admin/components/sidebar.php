<header class="topbar" data-navbarbg="skin5" style="position:fixed;width: 100%">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin6">
            <a class="navbar-brand" href="<?= $baseUrl ?>" target="_blank">
                <b class="logo-icon">
                    <img src="<?= $baseUrl ?>img/icon-black.png" alt="homepage" style="height: 40px;">
                </b>
                <span class="logo-text">
                    <img src="<?= $baseUrl ?>img/text-black.png" alt="homepage" style="height: 30px;width: 150px;">
                </span>
            </a>
            <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
        </div>
        <ul class="navbar-nav ms-auto d-flex align-items-center px-2">
            <li>
                <a class="profile-pic" href="#">
                    <img src="<?= $baseUrl ?>img/varun.png" alt="user-img" width="36" class="img-circle"><span class="text-white font-medium">
                        <?php
                        if (isset($_SESSION['fullname'])) {
                            echo $_SESSION['fullname'];
                        } else {
                            echo "Guest";
                        }
                        ?>
                    </span></a>
            </li>
        </ul>
    </nav>
</header>
<aside class="left-sidebar" style="position:fixed" data-sidebarbg="skin6">
    <div class="scroll-sidebar" style="overflow-y: auto">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"></a>
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= $adminBaseUrl ?>" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12.71 2.29a1 1 0 0 0-1.42 0l-9 9a1 1 0 0 0 0 1.42A1 1 0 0 0 3 13h1v7a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-7h1a1 1 0 0 0 1-1a1 1 0 0 0-.29-.71zM6 20v-9.59l6-6l6 6V20z" />
                        </svg>
                        <span class="hide-menu px-2">Home</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= $adminBaseUrl ?>events" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16">
                            <g fill="currentColor">
                                <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z" />
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                            </g>
                        </svg>
                        <span class="hide-menu px-2">Events</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= $adminBaseUrl ?>notification" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12 22a2 2 0 0 1-2-2h4a2 2 0 0 1-2 2Zm8-3H4v-2l2-1v-5.5c0-3.462 1.421-5.707 4-6.32V2h4v2.18c2.579.612 4 2.856 4 6.32V16l2 1v2ZM12 5.75A3.6 3.6 0 0 0 8.875 7.2A5.692 5.692 0 0 0 8 10.5V17h8v-6.5a5.693 5.693 0 0 0-.875-3.3A3.6 3.6 0 0 0 12 5.75Z" />
                        </svg>
                        <span class="hide-menu px-2">Notification</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= $adminBaseUrl ?>messages" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M21 2H6a2 2 0 0 0-2 2v3H2v2h2v2H2v2h2v2H2v2h2v3a2 2 0 0 0 2 2h15a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1zm-8 2.999c1.648 0 3 1.351 3 3A3.012 3.012 0 0 1 13 11c-1.647 0-3-1.353-3-3.001c0-1.649 1.353-3 3-3zM19 18H7v-.75c0-2.219 2.705-4.5 6-4.5s6 2.281 6 4.5V18z" />
                        </svg>
                        <span class="hide-menu px-2">Messages</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= $adminBaseUrl ?>directions" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="m22.43 10.59l-9.01-9.01c-.75-.75-2.07-.76-2.83 0l-9 9c-.78.78-.78 2.04 0 2.82l9 9c.39.39.9.58 1.41.58c.51 0 1.02-.19 1.41-.58l8.99-8.99c.79-.76.8-2.02.03-2.82zm-10.42 10.4l-9-9l9-9l9 9l-9 9zM8 11v4h2v-3h4v2.5l3.5-3.5L14 7.5V10H9c-.55 0-1 .45-1 1z" />
                        </svg>
                        <span class="hide-menu px-2">Directions</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= $adminBaseUrl ?>emergency" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M8.5 17V7h7v10zM1 17v-2h4v-2H1V7h6v2H3v2h4v6zm16 0v-2h4v-2h-4V7h6v2h-4v2h4v6zm-6.5-2h3V9h-3z" />
                        </svg>
                        <span class="hide-menu px-2">Emergency</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= $adminBaseUrl ?>users" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 36 36">
                            <path fill="currentColor" d="M12 16.14h-.87a8.67 8.67 0 0 0-6.43 2.52l-.24.28v8.28h4.08v-4.7l.55-.62l.25-.29a11 11 0 0 1 4.71-2.86A6.59 6.59 0 0 1 12 16.14Z" class="clr-i-solid clr-i-solid-path-1" />
                            <path fill="currentColor" d="M31.34 18.63a8.67 8.67 0 0 0-6.43-2.52a10.47 10.47 0 0 0-1.09.06a6.59 6.59 0 0 1-2 2.45a10.91 10.91 0 0 1 5 3l.25.28l.54.62v4.71h3.94v-8.32Z" class="clr-i-solid clr-i-solid-path-2" />
                            <path fill="currentColor" d="M11.1 14.19h.31a6.45 6.45 0 0 1 3.11-6.29a4.09 4.09 0 1 0-3.42 6.33Z" class="clr-i-solid clr-i-solid-path-3" />
                            <path fill="currentColor" d="M24.43 13.44a6.54 6.54 0 0 1 0 .69a4.09 4.09 0 0 0 .58.05h.19A4.09 4.09 0 1 0 21.47 8a6.53 6.53 0 0 1 2.96 5.44Z" class="clr-i-solid clr-i-solid-path-4" />
                            <circle cx="17.87" cy="13.45" r="4.47" fill="currentColor" class="clr-i-solid clr-i-solid-path-5" />
                            <path fill="currentColor" d="M18.11 20.3A9.69 9.69 0 0 0 11 23l-.25.28v6.33a1.57 1.57 0 0 0 1.6 1.54h11.49a1.57 1.57 0 0 0 1.6-1.54V23.3l-.24-.3a9.58 9.58 0 0 0-7.09-2.7Z" class="clr-i-solid clr-i-solid-path-6" />
                            <path fill="none" d="M0 0h36v36H0z" />
                        </svg>
                        <span class="hide-menu px-2">Students</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= $adminBaseUrl ?>logout" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 256 256">
                            <path fill="currentColor" d="m224.5 136.5l-42 42a12 12 0 0 1-8.5 3.5a12.2 12.2 0 0 1-8.5-3.5a12 12 0 0 1 0-17L187 140h-83a12 12 0 0 1 0-24h83l-21.5-21.5a12 12 0 0 1 17-17l42 42a12 12 0 0 1 0 17ZM104 204H52V52h52a12 12 0 0 0 0-24H48a20.1 20.1 0 0 0-20 20v160a20.1 20.1 0 0 0 20 20h56a12 12 0 0 0 0-24Z" />
                        </svg>
                        <span class="hide-menu px-2">Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>