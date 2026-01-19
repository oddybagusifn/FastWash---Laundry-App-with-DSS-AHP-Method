@extends('layouts.main')

@section('content')
    <div class="bg-[#F3F3F3] rounded-2xl">

        {{-- TAB UTAMA --}}
        <div class="flex gap-3 mb-6 bg-white p-2 rounded-xl">

            {{-- TRANSAKSI --}}
            <a href="{{ route('raw-materials.index') }}"
                class="px-[20px] py-[8px] rounded-[12px] w-full text-center
           text-[18px] sm:text-[20px] font-medium
           text-gray-400 hover:bg-gray-100">
                Manajemen
            </a>

            {{-- MANAJEMEN --}}
            <a href="{{ route('laundry-transactions.index') }}"
                class="px-[20px] py-[8px] rounded-[12px] w-full text-center
           text-[18px] sm:text-[20px] font-medium
           bg-[#EA821B] text-white">
                Transaksi
            </a>



        </div>

        {{-- CARD --}}
        <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm flex flex-col lg:h-full lg:overflow-hidden">

            {{-- HEADER --}}
            <div class="flex flex-col gap-4 mb-6
            sm:flex-row sm:justify-between sm:items-center">

                <h2 class="font-semibold text-[22px] sm:text-[26px]">
                    Daftar Transaksi
                </h2>

                <a href="{{ route('laundry-transactions.create') }}"
                    class="flex items-center justify-center gap-2
              border border-[#EA821B] text-[#EA821B]
              w-full sm:w-auto
              px-3 sm:px-4 py-2 sm:py-2.5
              rounded-xl
              text-[13px] sm:text-[14px]
              font-medium
              hover:bg-orange-50 transition">
                    <span class="text-[16px] sm:text-[18px]">+</span>
                    Tambah Transaksi
                </a>

            </div>



            {{-- CONTENT --}}
            <div class="bg-[#FAFAFA] rounded-2xl p-3 sm:p-4 flex flex-col lg:flex-1 lg:overflow-hidden">

                {{-- SUB HEADER --}}
                <div class="shrink-0">
                    <p class="font-semibold text-[20px]">Tenaga Kerja</p>
                    <p class="text-[16px] text-gray-400 mb-4">
                        Manajemen Pengelolaan Tenaga Kerja
                    </p>
                </div>

                {{-- SEARCH --}}
                <div class="flex flex-col sm:flex-row sm:items-center gap-3 mb-4 shrink-0">
                    <div class="relative flex-1">
                        <img src="{{ asset('icons/search-normal.svg') }}"
                            class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 opacity-60">

                        <input type="text" placeholder="Pencarian"
                            class="w-full rounded-[12px] pl-12 pr-4 py-3 text-[16px] font-medium
                              focus:outline-none focus:ring-1 focus:ring-[#EA821B]">
                    </div>

                    <button
                        class="bg-[#EA821B] text-white px-5 py-3 rounded-xl
               text-sm font-medium flex gap-1
               w-full sm:w-auto justify-center">
                        Kategori
                        <img src="{{ asset('icons/arrow-down.svg') }}" class="w-4 h-4">
                    </button>
                </div>

                {{-- TABLE --}}
                <div class="bg-white px-3 sm:px-[16px] py-4 rounded-[12px]">

                    {{-- DESKTOP TABLE --}}
                    <div class="hidden sm:block">
                        <table class="w-full table-fixed border-collapse">
                            <thead>
                                <tr class="border-b border-gray-300 h-[52px]">
                                    <th class="text-left text-[15px] font-semibold">Nama Pelanggan</th>
                                    <th class="text-left text-[15px] font-semibold">Nomor Telepon</th>
                                    <th class="text-left text-[15px] font-semibold">Berat Laundry</th>
                                    <th class="text-right text-[15px] font-semibold">Total Biaya</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($transactions as $item)
                                    <tr class="border-b border-gray-200 h-[52px] last:border-none">

                                        <td class="text-[15px]">
                                            {{ $item->customer->customer_name }}
                                        </td>

                                        <td class="text-[15px] text-gray-400">
                                            (+62)
                                            {{ ltrim($item->customer->phone_number, '0') }}
                                        </td>

                                        <td class="text-[15px]">
                                            <span class="ml-2 text-gray-400">
                                                {{ $item->laundry_weight }}
                                            </span>
                                            <span class="text-center">Kg</span>
                                        </td>

                                        <td class="text-right text-[15px]">
                                            <span class="text-gray-400">Rp</span>
                                            <span class="ml-2 text-gray-400">
                                                {{ number_format($item->total_price, 0, ',', '.') }}
                                            </span>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- MOBILE LIST --}}
                    <div class="flex flex-col gap-3 sm:hidden">
                        @foreach ($transactions as $item)
                            <div class="border border-gray-200 rounded-xl p-3 text-sm">

                                {{-- NAMA --}}
                                <div class="font-medium text-[15px]">
                                    {{ $item->customer->customer_name }}
                                </div>

                                {{-- NOMOR --}}
                                <div class="text-[13px] text-gray-400 mt-1">
                                    (+62)
                                    {{ ltrim($item->customer->phone_number, '0') }}
                                </div>

                                {{-- BERAT & BIAYA --}}
                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-[13px] text-gray-400">
                                        {{ $item->laundry_weight }} Kg
                                    </span>

                                    <span class="font-medium text-[14px]">
                                        Rp {{ number_format($item->total_price, 0, ',', '.') }}
                                    </span>
                                </div>

                            </div>
                        @endforeach
                    </div>





                </div>

            </div>

            @include('partials.table-pagination', ['items' => $transactions])

        </div>
    </div>
@endsection
