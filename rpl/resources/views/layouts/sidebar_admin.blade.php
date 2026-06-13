<div class="col-md-2 p-0">

    <div class="sidebar">

        <!-- LOGO -->

        <div class="sidebar-logo">

            <h2>SPLJ</h2>

            <small>
                Administrator Panel
            </small>

        </div>

        <!-- MENU -->

        <ul class="sidebar-menu">

            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

                    📊 Dashboard

                </a>
            </li>

            <li>
                <a href="{{ route('admin.lapangan.index') }}"
                    class="{{ request()->routeIs('admin.lapangan.*') ? 'active' : '' }}">

                    ⚽ Kelola Lapangan

                </a>
            </li>

            <li>
                <a href="{{ route('admin.booking.index') }}"
                    class="{{ request()->routeIs('admin.booking.*') ? 'active' : '' }}">

                    📅 Kelola Booking

                </a>
            </li>

            <li>

                <form action="{{ route('logout') }}" method="POST">

                    @csrf

            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit"
                        style="
                background:none;
                border:none;
                color:white;
                width:100%;
                text-align:left;
                padding:14px 20px;
            ">
                        🚪 Logout
                    </button>
                </form>
            </li>
            </button>

            </form>

            </li>

        </ul>

    </div>

</div>
