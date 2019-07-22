<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="/home">
                    <span data-feather="home"></span>
                    Dashboard <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/home">
                    <span data-feather="shopping-cart"></span>
                    Packages
                </a>
            </li>

            {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="#">--}}
                    {{--<span data-feather="users"></span>--}}
                    {{--Customers--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="#">--}}
                    {{--<span data-feather="bar-chart-2"></span>--}}
                    {{--Reports--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="#">--}}
                    {{--<span data-feather="layers"></span>--}}
                    {{--Integrations--}}
                {{--</a>--}}
            {{--</li>--}}
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Database</span>
            <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin_itinerary_index_path')}}">
                    <span data-feather="layers"></span>
                    Itinerary
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin_included_index_path')}}">
                    <span data-feather="plus"></span>
                    Included
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin_not_included_index_path')}}">
                    <span data-feather="minus"></span>
                    Not Included
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin_category_index_path')}}">
                    <span data-feather="folder"></span>
                    Category
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin_difficulty_index_path')}}">
                    <span data-feather="activity"></span>
                    Difficulty
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin_destinations_index_path')}}">
                    <span data-feather="map-pin"></span>
                    Destinations
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin_testimonial_index_path')}}">
                    <span data-feather="message-circle"></span>
                    Testimonials
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin_video_index_path')}}">
                    <span data-feather="video"></span>
                    Video Testimonials
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Sales</span>
            <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin_list_index_path')}}">
                    <span data-feather="code"></span>
                    Code Inquire
                </a>
            </li>
        </ul>

    </div>
</nav>