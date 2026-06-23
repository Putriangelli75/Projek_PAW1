<aside class="w-72 rounded-2xl border border-slate-200 bg-white shadow-sm p-5 lg:sticky lg:top-24">

    <!-- Header Pelanggan -->
    <div class="mb-6 pelanggan-only hidden">

        <div class="flex items-center gap-3">

            <div class="w-12 h-12 rounded-full 
                        bg-emerald-600 
                        text-white 
                        flex items-center justify-center
                        font-bold text-lg">
                U
            </div>

            <div>
                <h3 class="font-semibold text-slate-800">
                    User
                </h3>

                <p class="text-xs text-slate-500">
                    Pelanggan SPLJ
                </p>
            </div>

        </div>


        <div class="mt-4 rounded-xl bg-emerald-50 p-4">

            <p class="text-xs font-semibold 
                      uppercase tracking-widest 
                      text-emerald-700">

                Area Pengguna

            </p>


            <p class="mt-2 text-sm text-slate-600 leading-5">

                Kelola booking dan pemesanan lapangan.

            </p>

        </div>

    </div>




    <!-- Header Admin -->
    <div class="mb-6 admin-only hidden">


        <div class="flex items-center gap-3">


            <div class="w-12 h-12 rounded-full 
                        bg-slate-900 
                        text-white 
                        flex items-center justify-center
                        font-bold text-lg">

                A

            </div>


            <div>

                <h3 class="font-semibold text-slate-800">

                    Admin

                </h3>


                <p class="text-xs text-slate-500">

                    Administrator SPLJ

                </p>


            </div>


        </div>



        <div class="mt-4 rounded-xl bg-slate-50 p-4">


            <p class="text-xs font-semibold 
                      uppercase tracking-widest 
                      text-emerald-700">

                Area Admin

            </p>


            <p class="mt-2 text-sm text-slate-600 leading-5">

                Kelola sistem, lapangan dan verifikasi booking.

            </p>


        </div>


    </div>





    <!-- Menu -->
    <nav class="space-y-2">


        <!-- Pelanggan -->

        <a 
        class="pelanggan-only hidden flex items-center justify-between
        px-4 py-3 rounded-xl
        text-slate-700
        hover:bg-emerald-50
        hover:text-emerald-700
        transition

        {{ request()->routeIs('dashboard') 
        ? 'bg-emerald-600 text-white' : '' }}"

        href="{{ route('dashboard') }}">


            <span class="flex gap-3 items-center">

                📊 Dashboard

            </span>


            <span>→</span>


        </a>





        <a 
        class="pelanggan-only hidden flex items-center justify-between
        px-4 py-3 rounded-xl
        text-slate-700
        hover:bg-emerald-50
        hover:text-emerald-700
        transition"

        href="{{ route('lapangan.index') }}">


            <span class="flex gap-3 items-center">

                🏟️ Pesan Lapangan

            </span>


            <span>→</span>


        </a>






        <!-- ADMIN -->


        <a 
        class="admin-only hidden flex items-center justify-between
        px-4 py-3 rounded-xl
        text-slate-700
        hover:bg-emerald-50
        hover:text-emerald-700
        transition

        {{ request()->routeIs('admin.dashboard') 
        ? 'bg-emerald-600 text-white' : '' }}"

        href="{{ route('admin.dashboard') }}">


            <span class="flex gap-3 items-center">

                📊 Dashboard Admin

            </span>


            <span>→</span>


        </a>





        <a 
class="admin-only hidden flex items-center justify-between
px-4 py-3 rounded-xl
text-slate-700
hover:bg-emerald-50
hover:text-emerald-700
transition

{{ request()->routeIs('admin.lapangan') 
? 'bg-emerald-600 text-white shadow-md' : '' }}"

href="{{ route('admin.lapangan') }}">


            <span class="flex gap-3 items-center">

                🏟️ Kelola Lapangan

            </span>


            <span>→</span>


        </a>





        <a 
class="admin-only hidden flex items-center justify-between
px-4 py-3 rounded-xl
text-slate-700
hover:bg-emerald-50
hover:text-emerald-700
transition

{{ request()->routeIs('admin.bookings') 
? 'bg-emerald-600 text-white shadow-md' : '' }}"

href="{{ route('admin.bookings') }}">


            <span class="flex gap-3 items-center">

                📅 Kelola Booking

            </span>


            <span>→</span>


        </a>


    </nav>


</aside>