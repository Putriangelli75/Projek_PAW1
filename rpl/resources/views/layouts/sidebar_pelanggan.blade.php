<div class="col-md-2 p-0">

    <div class="sidebar">

        <!-- LOGO -->

        <div class="sidebar-logo">

            <h2>SPLJ</h2>

            <small>
                Sistem Pemesanan Lapangan Jakabaring
            </small>

        </div>

        <!-- MENU -->

        <ul class="sidebar-menu">

            <li>

                <a href="{{ route('pelanggan.dashboard') }}"
                    class="{{ request()->routeIs('pelanggan.dashboard') ? 'active' : '' }}">

                    🏠 Dashboard

                </a>

            </li>

            <li>

                <a href="{{ route('pelanggan.lapangan') }}"
                    class="{{ request()->routeIs('pelanggan.lapangan') ? 'active' : '' }}">

                    ⚽ Booking Lapangan

                </a>

            </li>

            <li>

                <a href="{{ route('pelanggan.riwayat-booking') }}"
                    class="{{ request()->routeIs('pelanggan.riwayat-booking') ? 'active' : '' }}">

                    📋 Riwayat Booking

                </a>

            </li>

            <li>

                <a href="{{ route('pelanggan.akun') }}"
                    class="{{ request()->routeIs('pelanggan.akun') ? 'active' : '' }}">

                    👤 Akun Saya

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
