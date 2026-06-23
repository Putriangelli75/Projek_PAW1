@extends('layouts.app')

@section('title', 'Riwayat Booking - SPLJ')
@section('app_sidebar', true)

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="surface p-6">

        <h1 class="text-3xl font-bold text-slate-900">
            Riwayat Booking
        </h1>

        <p class="mt-2 text-slate-500">
            Lihat seluruh riwayat booking dan status pembayaran Anda.
        </p>

    </div>
   <div class="mt-6 flex flex-wrap gap-4">

    <div class="surface flex-1 min-w-[220px] p-5">
        <p class="text-sm text-slate-500">
            Total Booking
        </p>

        <h3 id="totalBooking"
            class="mt-2 text-3xl font-bold text-slate-900">
            0
        </h3>
    </div>

    <div class="surface flex-1 min-w-[220px] p-5">
        <p class="text-sm text-slate-500">
            Pending
        </p>

        <h3 id="pendingBooking"
            class="mt-2 text-3xl font-bold text-yellow-600">
            0
        </h3>
    </div>

    <div class="surface flex-1 min-w-[220px] p-5">
        <p class="text-sm text-slate-500">
            Verifikasi
        </p>

        <h3 id="verifikasiBooking"
            class="mt-2 text-3xl font-bold text-blue-600">
            0
        </h3>
    </div>

    <div class="surface flex-1 min-w-[220px] p-5">
        <p class="text-sm text-slate-500">
            Disetujui
        </p>

        <h3 id="disetujuiBooking"
            class="mt-2 text-3xl font-bold text-green-600">
            0
        </h3>
    </div>

</div>

</div>

    {{-- LIST BOOKING --}}
    <div id="bookingList">

        <div class="surface p-6 text-center">

            <p class="text-slate-500">
                Memuat data booking...
            </p>

        </div>

    </div>

</div>

{{-- MODAL UPLOAD --}}
<div id="uploadModal"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">

    <div class="surface w-full max-w-md p-6">

        <h3 class="text-xl font-bold text-slate-900">
            Upload Bukti Pembayaran
        </h3>

        <p class="mt-1 text-sm text-slate-500">
            Upload bukti transfer untuk verifikasi admin.
        </p>

        <div id="uploadAlert" class="mt-4"></div>

        <form id="uploadForm"
              class="mt-5 space-y-4">

            <input type="hidden"
                   id="upload_booking_id">

            <div>

                <label class="label-clean">
                    Bukti Pembayaran
                </label>

                <input
                    type="file"
                    id="bukti_bayar"
                    accept=".jpg,.jpeg,.png,.pdf"
                    class="input-clean"
                    required>

            </div>

            <div class="flex justify-end gap-3">

                <button
                    type="button"
                    onclick="closeUploadModal()"
                    class="btn-outline-clean">

                    Batal

                </button>

                <button
                    type="submit"
                    id="uploadSubmitBtn"
                    class="btn-clean">

                    Upload

                </button>

            </div>

        </form>

    </div>

</div>

@endsection

@push('scripts')

<script>

requireAuth();

loadBooking();

document
.getElementById('uploadForm')
.addEventListener(
    'submit',
    submitBukti
);

async function loadBooking() {

    const response = await fetch(
        '/api/riwayat-booking',
        {
            headers: apiHeaders()
        }
    );

    if (!response.ok) {

        document.getElementById(
            'bookingList'
        ).innerHTML = `

            <div class="alert-clean-danger">

                Gagal memuat data booking.

            </div>

        `;

        return;
    }

    const bookings =
        await response.json();

        document.getElementById('totalBooking').innerText =
bookings.length;

document.getElementById('pendingBooking').innerText =
bookings.filter(
b => b.status === 'pending'
).length;

document.getElementById('verifikasiBooking').innerText =
bookings.filter(
b => b.status === 'menunggu_verifikasi'
).length;

document.getElementById('disetujuiBooking').innerText =
bookings.filter(
b => b.status === 'disetujui'
).length;

    if (!bookings.length) {

        document.getElementById(
            'bookingList'
        ).innerHTML = `

            <div class="surface p-6 text-center">

                <p class="text-slate-500">

                    Belum ada riwayat booking.

                </p>

            </div>

        `;

        return;
    }

   document.getElementById('bookingList').innerHTML =
bookings.map(booking => `

<div class="surface overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl mb-5">

    <div class="p-6">

        <div class="flex items-start justify-between">

            <div class="flex gap-4">

                <div class="h-14 w-14 rounded-2xl bg-emerald-50 flex items-center justify-center text-3xl">

                    🏸

                </div>

                <div>

                    <h3 class="text-xl font-bold text-slate-900">

                        ${booking.lapangan?.nama_lapangan ?? 'Lapangan'}

                    </h3>

                    <div class="mt-2 flex flex-col gap-1 text-sm text-slate-500">

                        <span>

                            📅 ${booking.tanggal}

                        </span>

                        <span>

                            🕒 ${booking.jam_mulai.substring(0,5)}
                            -
                            ${booking.jam_selesai.substring(0,5)}

                        </span>

                    </div>

                </div>

            </div>

            <span class="
                rounded-full px-4 py-2 text-xs font-semibold

                ${
                    booking.status === 'disetujui'
                    ? 'bg-green-100 text-green-700'
                    : booking.status === 'ditolak'
                    ? 'bg-red-100 text-red-700'
                    : booking.status === 'menunggu_verifikasi'
                    ? 'bg-blue-100 text-blue-700'
                    : 'bg-yellow-100 text-yellow-700'
                }
            ">

                ${booking.status.replace('_',' ')}

            </span>

        </div>

        <div class="mt-6 flex items-center justify-between border-t border-slate-100 pt-5">

            <div>

                <p class="text-xs uppercase tracking-wide text-slate-400">

                    Total Pembayaran

                </p>

                <h3 class="mt-1 text-3xl font-bold text-emerald-700">

                    ${formatRupiah(booking.total_harga)}

                </h3>

            </div>

            ${
                booking.status === 'pending'
                ? `
                <button
                    onclick="showUploadModal(${booking.id})"
                    class="rounded-xl bg-emerald-600 px-5 py-3 font-semibold text-white transition hover:bg-emerald-700">

                    Upload Bukti

                </button>
                `
                : ''
            }

        </div>

    </div>

</div>

`).join('');

}

function showUploadModal(id) {

    document.getElementById(
        'upload_booking_id'
    ).value = id;

    document
        .getElementById(
            'uploadModal'
        )
        .classList.remove('hidden');

    document
        .getElementById(
            'uploadModal'
        )
        .classList.add('flex');

}

function closeUploadModal() {

    document
        .getElementById(
            'uploadModal'
        )
        .classList.add('hidden');

    document
        .getElementById(
            'uploadModal'
        )
        .classList.remove('flex');

}

async function submitBukti(event) {

    event.preventDefault();

    const bookingId =
        document.getElementById(
            'upload_booking_id'
        ).value;

    const file =
        document.getElementById(
            'bukti_bayar'
        ).files[0];

    if (!file) {
        return;
    }

    const button =
        document.getElementById(
            'uploadSubmitBtn'
        );

    button.disabled = true;
    button.innerText = 'Mengupload...';

    const formData =
        new FormData();

    formData.append(
        'bukti_bayar',
        file
    );

    const response =
        await fetch(
            `/api/booking/${bookingId}/upload-bukti`,
            {
                method: 'POST',

                headers: {
                    'Accept': 'application/json',
                    'Authorization':
                    `Bearer ${localStorage.getItem('token')}`
                },

                body: formData
            }
        );

    if (!response.ok) {

        showAlert(
            'uploadAlert',
            await getErrorMessage(
                response
            )
        );

        button.disabled = false;
        button.innerText = 'Upload';

        return;
    }

    closeUploadModal();

    loadBooking();

    button.disabled = false;
    button.innerText = 'Upload';

}

</script>

@endpush