<!-- Header -->
<header class="top-head container-fluid">
    <button type="button" class="navbar-toggle pull-left">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <!-- Search -->
    <!-- Left navbar -->
    <nav class=" navbar-default hidden-xs" role="navigation">
        <ul class="nav navbar-nav">
            <li><a href="#">Bestanden</a></li>
            <li><a href=" {{ URL::to('/') }}" target="_blank">Website bekijken</a></li>
        </ul>
    </nav>
    <!-- Right navbar -->
    <ul class="list-inline navbar-right top-menu top-right-menu">

        <!-- user login dropdown start-->
        <li class="dropdown text-center">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="../../img/avatar-2.jpg" class="img-circle profile-img thumb-sm">
                <span class="username">{{ $user->name }}</span>
            </a>
        </li>
        <!-- user login dropdown end -->
    </ul>
    <!-- End right navbar -->

</header>