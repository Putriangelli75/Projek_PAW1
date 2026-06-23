@extends('layouts.app')

@section('title', 'Pesan Lapangan - SPLJ')
@section('app_sidebar', true)

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="surface p-6">

        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

            <div>

                <p class="eyebrow-clean">
                    Sistem Pemesanan Lapangan
                </p>

                <h1 class="mt-2 text-3xl font-bold text-slate-900">
                    Pesan Lapangan
                </h1>

                <p class="mt-2 text-slate-500">
                    Pilih lapangan yang tersedia dan lakukan booking secara online.
                </p>

            </div>

            <a href="{{ route('dashboard') }}"
                class="btn-outline-clean">

                Kembali ke Dashboard

            </a>

        </div>

    </div>

    {{-- STATISTIK --}}
    <div class="grid gap-4 md:grid-cols-3">

        <div class="surface p-5">

            <p class="text-sm text-slate-500">
                Total Lapangan
            </p>

            <h3 id="totalLapangan"
                class="mt-2 text-3xl font-bold text-slate-900">
                0
            </h3>

        </div>

        <div class="surface p-5">

            <p class="text-sm text-slate-500">
                Tersedia
            </p>

            <h3 id="totalTersedia"
                class="mt-2 text-3xl font-bold text-emerald-700">
                0
            </h3>

        </div>

        <div class="surface p-5">

            <p class="text-sm text-slate-500">
                Maintenance
            </p>

            <h3 id="totalMaintenance"
                class="mt-2 text-3xl font-bold text-orange-600">
                0
            </h3>

        </div>

    </div>

    <div class="grid gap-6 xl:grid-cols-[1fr_420px]">

        {{-- DAFTAR LAPANGAN --}}
        <div>

            <div id="lapanganCards"
     class="grid gap-5 lg:grid-cols-2">

        </div>

        {{-- BOOKING --}}
        <aside class="surface sticky top-24 h-fit p-6">

            <h2 id="selectedLapanganName"
                class="text-xl font-bold text-slate-900">

                Pilih Lapangan

            </h2>

            <p id="selectedLapanganMeta"
                class="mt-2 text-sm text-slate-500">

                Klik tombol pesan pada lapangan yang tersedia.

            </p>

            <div id="bookingAlert"
                class="mt-4">
            </div>

            <form id="bookingForm"
                class="mt-5 space-y-4">

                <input type="hidden" id="lapangan_id">
                <input type="hidden" id="harga_per_jam">

                <div>

                    <label class="label-clean">
                        Tanggal
                    </label>

                    <input
                        type="date"
                        id="tanggal"
                        class="input-clean"
                        required>

                </div>

                <div>

                    <label class="label-clean">
                        Jam Mulai
                    </label>

                    <input
                        type="time"
                        id="jam_mulai"
                        class="input-clean"
                        required>

                </div>

                <div>

                    <label class="label-clean">
                        Jam Selesai
                    </label>

                    <input
                        type="time"
                        id="jam_selesai"
                        class="input-clean"
                        required>

                </div>

                <div class="rounded-lg bg-emerald-50 p-4">

                    <p class="text-sm text-slate-500">
                        Estimasi Biaya
                    </p>

                    <h3 id="bookingEstimate"
                        class="mt-2 text-2xl font-bold text-emerald-700">

                        -

                    </h3>

                </div>

                <button
                    id="bookingButton"
                    type="submit"
                    disabled
                    class="btn-clean w-full">

                    Pilih Lapangan Dulu

                </button>

            </form>

        </aside>

    </div>

    {{-- TABEL --}}
    <div class="surface overflow-hidden">

        <div class="border-b border-slate-200 px-6 py-4">

            <h3 class="font-semibold">
                Daftar Lapangan
            </h3>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-6 py-4 text-left">
                            Nama
                        </th>

                        <th class="px-6 py-4 text-left">
                            Olahraga
                        </th>

                        <th class="px-6 py-4 text-left">
                            Harga
                        </th>

                        <th class="px-6 py-4 text-left">
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody id="lapanganBody">
                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection

@push('scripts')
<script>

requireAuth();

let lapangans = [];

loadLapangan();
setupBookingForm();

async function loadLapangan() {

    const response = await fetch('/api/lapangan', {
        headers: apiHeaders()
    });

    if (!response.ok) {

        showAlert(
            'lapanganAlert',
            await getErrorMessage(response)
        );

        return;
    }

    lapangans = await response.json();

    document.getElementById('totalLapangan').innerText =
    lapangans.length;

document.getElementById('totalTersedia').innerText =
    lapangans.filter(item => item.status === 'tersedia').length;

document.getElementById('lapanganCards').innerHTML =
lapangans.map(item => `

<div class="surface field-card overflow-hidden">

    <div class="border-b border-slate-100 p-5">

        <div class="flex items-start justify-between">

            <div>

                <h3 class="text-lg font-bold text-slate-900">
                    ${escapeHtml(item.nama_lapangan)}
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    ${escapeHtml(item.jenis_olahraga)}
                </p>

            </div>

            <span class="
                rounded-full px-3 py-1 text-xs font-semibold
                ${
                    item.status === 'tersedia'
                    ? 'bg-emerald-50 text-emerald-700'
                    : 'bg-orange-50 text-orange-700'
                }
            ">
                ${escapeHtml(item.status)}
            </span>

        </div>

    </div>

    <div class="p-5">

        <div class="flex items-center gap-3">

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-2xl">

                ${
                    item.jenis_olahraga.toLowerCase().includes('futsal')
                    ? '⚽'
                    : item.jenis_olahraga.toLowerCase().includes('badminton')
                    ? '🏸'
                    : item.jenis_olahraga.toLowerCase().includes('basket')
                    ? '🏀'
                    : item.jenis_olahraga.toLowerCase().includes('voli')
                    ? '🏐'
                    : '🏟️'
                }

            </div>

            <div>

                <p class="text-xs text-slate-400">
                    Harga per Jam
                </p>

                <h4 class="text-xl font-bold text-emerald-700">
                    ${formatRupiah(item.harga_per_jam)}
                </h4>

            </div>

        </div>

        <p class="mt-4 text-sm leading-6 text-slate-600">

            ${escapeHtml(
                item.deskripsi ??
                'Lapangan siap digunakan untuk berbagai aktivitas olahraga.'
            )}

        </p>

        <div class="mt-5">

            ${
                item.status === 'tersedia'
                ? `
                <button
                    onclick="selectLapangan(${item.id})"
                    class="btn-clean w-full">

                    Pesan Lapangan

                </button>
                `
                : `
                <button
                    disabled
                    class="btn-outline-clean w-full opacity-60">

                    Tidak Tersedia

                </button>
                `
            }

        </div>

    </div>

</div>

`).join('');

document.getElementById('lapanganBody').innerHTML =
lapangans.map(item => `

<tr class="border-b border-slate-100">

    <td class="px-6 py-4 font-semibold text-slate-900">

        ${escapeHtml(item.nama_lapangan)}

    </td>

    <td class="px-6 py-4 text-slate-600">

        ${escapeHtml(item.jenis_olahraga)}

    </td>

    <td class="px-6 py-4 text-slate-600">

        ${formatRupiah(item.harga_per_jam)}

    </td>

    <td class="px-6 py-4">

        <span class="
            rounded-full px-3 py-1 text-xs font-semibold

            ${
                item.status === 'tersedia'
                ? 'bg-green-100 text-green-700'
                : 'bg-red-100 text-red-700'
            }
        ">

            ${escapeHtml(item.status)}

        </span>

    </td>

</tr>

`).join('');

}

function setupBookingForm() {

    setDefaultBookingDate();

    ['tanggal','jam_mulai','jam_selesai']
    .forEach(id => {

        document
        .getElementById(id)
        .addEventListener(
            'input',
            updateBookingEstimate
        );

    });

    document
    .getElementById('bookingForm')
    .addEventListener(
        'submit',
        submitBooking
    );

}

function setDefaultBookingDate() {

    const today =
        new Date()
        .toISOString()
        .slice(0,10);

    document.getElementById('tanggal').min =
        today;

    document.getElementById('tanggal').value =
        today;

}

function selectLapangan(id) {

    const lapangan =
        lapangans.find(
            item => item.id === id
        );

    if (!lapangan) {
        return;
    }

    document.getElementById('lapangan_id').value =
        lapangan.id;

    document.getElementById('harga_per_jam').value =
        lapangan.harga_per_jam;

    document.getElementById('selectedLapanganName').innerText =
        lapangan.nama_lapangan;

    document.getElementById('selectedLapanganMeta').innerText =
        `${lapangan.jenis_olahraga} • ${formatRupiah(lapangan.harga_per_jam)} / jam`;

    document.getElementById('bookingButton').disabled =
        false;

    document.getElementById('bookingButton').innerText =
        'Buat Booking';

    showAlert(
        'bookingAlert',
        'Lapangan berhasil dipilih. Silakan lengkapi jadwal booking.',
        'success'
    );

    updateBookingEstimate();

    document
        .getElementById('bookingForm')
        .scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });

}

function updateBookingEstimate() {

    const harga =
        Number(
            document.getElementById('harga_per_jam').value || 0
        );

    const mulai =
        document.getElementById('jam_mulai').value;

    const selesai =
        document.getElementById('jam_selesai').value;

    if (
        !harga ||
        !mulai ||
        !selesai ||
        selesai <= mulai
    ) {

        document.getElementById(
            'bookingEstimate'
        ).innerText = '-';

        return;
    }

    const [mulaiJam, mulaiMenit] =
        mulai.split(':').map(Number);

    const [selesaiJam, selesaiMenit] =
        selesai.split(':').map(Number);

    const durasi =
        (
            (selesaiJam * 60 + selesaiMenit) -
            (mulaiJam * 60 + mulaiMenit)
        ) / 60;

    const total =
        durasi * harga;

    document.getElementById(
        'bookingEstimate'
    ).innerText =
        formatRupiah(total);

}

async function submitBooking(event) {

    event.preventDefault();

    const button =
        document.getElementById('bookingButton');

    button.disabled = true;
    button.innerText = 'Menyimpan...';

    const response =
        await fetch('/api/booking', {

            method: 'POST',

            headers: apiHeaders(),

            body: JSON.stringify({

                lapangan_id:
                    document.getElementById('lapangan_id').value,

                tanggal:
                    document.getElementById('tanggal').value,

                jam_mulai:
                    document.getElementById('jam_mulai').value,

                jam_selesai:
                    document.getElementById('jam_selesai').value

            })

        });

    if (!response.ok) {

        showAlert(
            'bookingAlert',
            await getErrorMessage(response)
        );

        button.disabled = false;
        button.innerText = 'Buat Booking';

        return;
    }

    const data =
        await response.json();

    showAlert(
        'bookingAlert',
        data.message ??
        'Booking berhasil dibuat.',
        'success'
    );

    document
        .getElementById('bookingForm')
        .reset();

    setDefaultBookingDate();

    document.getElementById('lapangan_id').value =
        '';

    document.getElementById('harga_per_jam').value =
        '';

    document.getElementById('selectedLapanganName').innerText =
        'Pilih Lapangan';

    document.getElementById('selectedLapanganMeta').innerText =
        'Booking berhasil disimpan. Pilih lapangan lain untuk booking berikutnya.';

    document.getElementById('bookingEstimate').innerText =
        '-';

    button.disabled = true;

    button.innerText =
        'Pilih lapangan dulu';

}

</script>
@endpush