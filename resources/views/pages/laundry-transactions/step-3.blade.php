@extends('layouts.main')

@section('content')
<div class="bg-[#F3F3F3] rounded-2xl">

    {{-- TAB UTAMA --}}
    <div class="flex gap-3 mb-6 bg-white p-2 rounded-xl">
        <a href="{{ route('raw-materials.index') }}"
            class="px-[20px] py-[8px] rounded-[12px] w-full text-center
                   text-[18px] sm:text-[20px] font-medium text-gray-400 hover:bg-gray-100">
            Manajemen
        </a>

        <a href="{{ route('laundry-transactions.index') }}"
            class="px-[20px] py-[8px] rounded-[12px] w-full text-center
                   text-[18px] sm:text-[20px] font-medium bg-[#EA821B] text-white">
            Transaksi
        </a>
    </div>

    {{-- CARD --}}
    <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm max-w-3xl mx-auto">

        {{-- HEADER --}}
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('laundry-transactions.step2') }}"
               class="text-[18px] text-gray-500 hover:text-black">←</a>

            <h2 class="font-semibold text-[22px] sm:text-[24px]">
                Transaksi Laundry
            </h2>
        </div>

        {{-- STEP INFO --}}
        <div class="bg-[#FAFAFA] rounded-2xl p-4">

            <div class="flex justify-between items-center mb-4">
                <p class="font-semibold text-[16px]">Ringkasan Transaksi</p>
                <p class="text-sm text-gray-400">Langkah 3 Dari 3</p>
            </div>

            {{-- INFORMASI PELANGGAN --}}
            <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                <div>
                    <p class="text-gray-400">Nama Pelanggan</p>
                    <p class="font-medium">{{ session('step1.customer_name') }}</p>
                </div>

                <div>
                    <p class="text-gray-400">Nomor Telepon</p>
                    <p class="font-medium">
                        (+62) {{ ltrim(session('step1.phone_number'), '0') }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-400">ID Transaksi</p>
                    <p class="font-medium">LM - 00001</p>
                </div>

                <div>
                    <p class="text-gray-400">Tanggal Masuk</p>
                    <p class="font-medium">
                        {{ session('step1.transaction_date') }}
                    </p>
                </div>
            </div>

            <hr class="my-4">

            {{-- RINCIAN LAYANAN --}}
            <div class="space-y-2 text-sm">

                <div class="flex justify-between">
                    <span>Harga per Kg</span>
                    <span>
                        Rp {{ number_format($pricingResult['price_per_kg'], 0, ',', '.') }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span>Subtotal Laundry</span>
                    <span>
                        Rp {{ number_format($pricingResult['laundry_subtotal'], 0, ',', '.') }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span>Parfum</span>
                    <span>
                        Rp {{ number_format($pricingResult['perfume_fee'], 0, ',', '.') }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span>Biaya Layanan</span>
                    <span>
                        Rp {{ number_format($pricingResult['service_fee'], 0, ',', '.') }}
                    </span>
                </div>

                <hr class="my-3">

                <div class="flex justify-between font-semibold text-base">
                    <span>Total Biaya</span>
                    <span>
                        Rp {{ number_format($pricingResult['total_price'], 0, ',', '.') }}
                    </span>
                </div>
            </div>

            <hr class="my-4">

            {{-- CATATAN --}}
            <div class="text-sm text-gray-400 mb-6">
                <p class="mb-1">Catatan</p>
                <p>{{ session('step2.notes') ?? 'Tidak ada catatan.' }}</p>
            </div>

            {{-- BUTTON --}}
            <div class="flex gap-3">
                <a href="{{ route('laundry-transactions.hpp') }}"
                   class="w-full border border-[#EA821B]
                          text-[#EA821B] py-3 rounded-xl font-medium text-center">
                    Hitung HPP
                </a>

                <form action="{{ route('laundry-transactions.final') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit"
                        class="w-full bg-[#EA821B] text-white
                               py-3 rounded-xl font-medium hover:bg-orange-600 transition">
                        Konfirmasi
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
