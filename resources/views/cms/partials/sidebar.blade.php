
<!-- Aside Start-->
<aside class="left-panel">

    <!-- brand -->
    <div class="logo">
         <a href="/cms" class="logo-expanded">                    
            <span class="nav-label">CMS MENTOR4YOU </span>
        </a>
    </div>

    <!-- / brand -->
    <!-- Navbar Start -->
    <nav class="navigation">
        <ul class="list-unstyled">
            <!-- pages en sections -->
            <li class="has-submenu ">
                <a href="#"><i class="ion-document"></i> 
                <span class="nav-label">Pagina beheer</span></a>
                <ul class="list-styled">
                    <li><strong><a href="#">Pagina's</a></strong></li>
                    <li><a href="{{ URL::to("cms/page") }}"><i class="ion-grid"></i> Overzicht</a></li>
                    <li><a href="{{ URL::to("cms/page/create") }}"><i class="ion-plus"></i> Toevoegen</a></li>
                </ul>
            </li>

            <!-- projecten -->
            <li class="has-submenu "><a href="#"><i class="ion-document"></i> <span
                            class="nav-label">Projecten beheer</span></a>
                <ul class="list-styled">
                    <li><strong><a href="#">Pagina's</a></strong></li>
                    <li><a href="{{ URL::to("cms/project") }}"><i class="ion-grid"></i> Overzicht</a></li>
                    <li><a href="{{ URL::to("cms/project/create") }}"><i class="ion-plus"></i> Toevoegen</a></li>
                </ul>
            </li>

            <!-- tags -->
            <li class="has-submenu "><a href="#"><i class="ion-document"></i> <span
                            class="nav-label">Projecttags beheren</span></a>
                <ul class="list-styled">
                    <li><strong><a href="#">Pagina's</a></strong></li>
                    <li><a href="{{ URL::to("cms/tag") }}"><i class="ion-grid"></i> Overzicht</a></li>
                </ul>
            </li>


            <!-- Disciplines -->
            <li class="has-submenu ">
                <a href="#"><i class="ion-document"></i> 
                    <span class="nav-label">Disciplines beheer</span>
                </a>
                <ul class="list-styled">
                    <li><strong><a href="#">Disciplines's</a></strong></li>
                    <li><a href="{{ URL::to("cms/discipline") }}"><i class="ion-grid"></i> Overzicht</a></li>
                    <li><a href="{{ URL::to("cms/discipline/create") }}"><i class="ion-plus"></i> Toevoegen</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ URL::to("/logout") }}"><i class="ion-home"></i> 
                    <span class="nav-label">Logout</span>
                </a>
            </li>      
        </ul>
    </nav>
</aside>
<!-- Aside Ends-->