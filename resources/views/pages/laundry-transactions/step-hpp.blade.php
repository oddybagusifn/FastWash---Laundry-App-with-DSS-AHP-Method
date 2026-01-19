@extends('layouts.main')

@section('content')
    <div class="bg-[#F3F3F3] rounded-2xl">

        {{-- TAB UTAMA --}}
        <div class="flex gap-3 mb-6 bg-white p-2 rounded-xl">
            <a href="{{ route('raw-materials.index') }}"
                class="px-[20px] py-[8px] rounded-[12px] w-full text-center
                  text-[18px] sm:text-[20px] font-medium
                  text-gray-400 hover:bg-gray-100">
                Manajemen
            </a>

            <a href="{{ route('laundry-transactions.index') }}"
                class="px-[20px] py-[8px] rounded-[12px] w-full text-center
                  text-[18px] sm:text-[20px] font-medium
                  bg-[#EA821B] text-white">
                Transaksi
            </a>
        </div>

        {{-- CARD --}}
        <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm max-w-3xl mx-auto">

            {{-- HEADER --}}
            <div class="flex items-center gap-3 mb-6">
                <a href="{{ route('laundry-transactions.step3') }}" class="text-[18px] text-gray-500 hover:text-black">
                    ←
                </a>

                <h2 class="font-semibold text-[22px] sm:text-[24px]">
                    Hitung HPP
                </h2>

                <span class="ml-auto text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full">
                    DSS - AHP
                </span>
            </div>

            <div class="bg-[#FAFAFA] rounded-2xl p-4">

                {{-- TITLE --}}
                <p class="font-semibold text-[16px] mb-4">
                    Rincian Perhitungan Harga Pokok Produksi
                </p>

                {{-- TABLE HEADER --}}
                <div class="grid grid-cols-3 text-sm text-gray-400 mb-3">
                    <span>Komponen Biaya</span>
                    <span class="text-center">Keterangan</span>
                    <span class="text-right">Biaya</span>
                </div>

                {{-- RAW MATERIAL --}}
                <div class="grid grid-cols-3 text-sm py-2 border-b">
                    <span>Bahan Baku</span>
                    <span class="text-center">Total</span>
                    <span class="text-right">
                        Rp {{ number_format($rawMaterialCost, 0, ',', '.') }}
                    </span>
                </div>

                {{-- LABOR --}}
                <div class="grid grid-cols-3 text-sm py-2 border-b">
                    <span>Tenaga Kerja</span>
                    <span class="text-center">Total</span>
                    <span class="text-right">
                        Rp {{ number_format($laborCost, 0, ',', '.') }}
                    </span>
                </div>

                {{-- OVERHEAD --}}
                <div class="grid grid-cols-3 text-sm py-2 border-b">
                    <span>Biaya Overhead</span>
                    <span class="text-center">Total</span>
                    <span class="text-right">
                        Rp {{ number_format($overheadCost, 0, ',', '.') }}
                    </span>
                </div>

                {{-- HPP PER KG --}}
                <div class="grid grid-cols-3 text-sm py-2 border-b text-gray-600">
                    <span>HPP per Kg (AHP)</span>
                    <span class="text-center">
                        {{ $step2['laundry_weight'] }} Kg
                    </span>
                    <span class="text-right">
                        Rp {{ number_format($hppPerKg, 0, ',', '.') }}
                    </span>
                </div>

                {{-- TOTAL --}}
                <div class="grid grid-cols-3 text-sm font-semibold py-4">
                    <span>Total HPP</span>
                    <span></span>
                    <span class="text-right text-black">
                        Rp {{ number_format($totalHpp, 0, ',', '.') }}
                    </span>
                </div>

                {{-- ACTION --}}
                <div class="flex gap-3 mt-6">
                    <a href="{{ route('laundry-transactions.step3') }}"
                        class="w-full border border-[#EA821B]
                          text-[#EA821B] py-3 rounded-xl font-medium
                          text-center hover:bg-orange-50 transition">
                        Kembali
                    </a>

                    <form action="{{ route('laundry-transactions.final') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit"
                            class="w-full bg-[#EA821B] text-white
                               py-3 rounded-xl font-medium
                               hover:bg-orange-600 transition">
                            Konfirmasi & Simpan
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
