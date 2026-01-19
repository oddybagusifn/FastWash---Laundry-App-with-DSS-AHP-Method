@extends('layouts.main')

@section('content')
    <div class="bg-[#F3F3F3] rounded-2xl">

         {{-- TAB UTAMA --}}
        <div class="flex gap-3 mb-6 bg-white p-2 rounded-xl">

            {{-- MANAJEMEN --}}
            <a href="{{ route('employees.index') }}"
                class="px-[20px] py-[8px] rounded-[12px] w-full text-center
           text-[18px] sm:text-[20px] font-medium
           bg-[#EA821B] text-white">
                Manajemen
            </a>

            {{-- TRANSAKSI --}}
            <a href="{{ route('laundry-transactions.index') }}"
                class="px-[20px] py-[8px] rounded-[12px] w-full text-center
           text-[18px] sm:text-[20px] font-medium
           text-gray-400 hover:bg-gray-100">
                Transaksi
            </a>

        </div>

        {{-- CARD --}}
        <div
            class="bg-white rounded-2xl
            p-4 sm:p-6
            shadow-sm flex flex-col
            lg:h-full lg:overflow-hidden">

            {{-- HEADER --}}
            <div class="flex flex-col gap-3 mb-4 shrink-0
            sm:flex-row sm:justify-between sm:items-center">

                {{-- TITLE --}}
                <h2 class="font-semibold
               text-[20px] sm:text-[24px] lg:text-[28px]">
                    Kategori Manajemen
                </h2>

                {{-- CATEGORY TABS --}}
                <div class="flex gap-2 overflow-x-auto sm:overflow-visible pb-1 sm:pb-0">

                    <a href="{{ route('raw-materials.index') }}"
                        class="px-4 py-2 sm:px-[20px] sm:py-[12px] rounded-[12px]
                   text-[14px] sm:text-[16px] font-medium whitespace-nowrap
                   bg-[#EA821B] text-white">
                        Bahan Baku
                    </a>

                    <a href="{{ route('employees.index') }}"
                        class="px-4 py-2 sm:px-[20px] sm:py-[12px] rounded-[12px]
                   text-[14px] sm:text-[16px] font-medium whitespace-nowrap
                   bg-[#F3F3F3] text-gray-400 hover:bg-gray-200">
                        Tenaga Kerja
                    </a>

                    <a href="{{ route('overhead-costs.index') }}"
                        class="px-4 py-2 sm:px-[20px] sm:py-[12px] rounded-[12px]
                   text-[14px] sm:text-[16px] font-medium whitespace-nowrap
                   bg-[#F3F3F3] text-gray-400 hover:bg-gray-200">
                        Overhead
                    </a>

                </div>
            </div>


            {{-- CONTENT --}}
            <div
                class="bg-[#FAFAFA] rounded-2xl
            p-3 sm:p-4
            flex flex-col
            lg:flex-1 lg:overflow-hidden">

                {{-- SUB HEADER --}}
                <div class="shrink-0">
                    <p class="font-semibold text-[20px]">Bahan Baku Laundry</p>
                    <p class="text-[16px] text-gray-400 mb-4">
                        Manajemen Pengelolaan Bahan Baku
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

                    {{-- ================= DESKTOP TABLE ================= --}}
                    <div class="hidden sm:block">
                        <table class="w-full table-fixed border-collapse">
                            <thead class="h-[56px]">
                                <tr class="border-b border-gray-300">
                                    <th class="text-left text-[15px] font-semibold">Nama Item</th>
                                    <th class="text-left text-[15px] font-semibold">Kategori Item</th>
                                    <th class="text-center text-[15px] font-semibold">Stok Item</th>
                                    <th class="text-right text-[15px] font-semibold">Harga Item</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($rawMaterials as $item)
                                    <tr class="h-[50px] border-b border-gray-200 last:border-none">
                                        <td class="text-[15px]">{{ $item->item_name }}</td>

                                        <td class="text-[15px] text-gray-400">
                                            {{ $item->item_category }}
                                        </td>

                                        <td class="text-center text-[15px]">
                                            <span class="font-medium">{{ $item->unit }}</span>
                                            <span class="ml-3 text-gray-400">{{ $item->stock }}</span>
                                        </td>

                                        <td class="text-right text-[15px]">
                                            <span class="font-medium">Rp</span>
                                            <span class="text-gray-400">
                                                {{ number_format($item->price, 0, ',', '.') }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach

                                {{-- filler desktop --}}
                                @for ($i = $rawMaterials->count(); $i < 5; $i++)
                                    <tr class="h-[50px]">
                                        <td colspan="4"></td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>

                    {{-- ================= MOBILE LIST ================= --}}
                    <div class="flex flex-col gap-3 sm:hidden">
                        @foreach ($rawMaterials as $item)
                            <div class="border border-gray-200 rounded-xl p-3 text-sm">
                                <div class="font-medium text-[15px]">
                                    {{ $item->item_name }}
                                </div>

                                <div class="text-gray-400 text-[13px]">
                                    {{ $item->item_category }}
                                </div>

                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-[13px]">
                                        Stok: <span class="font-medium">{{ $item->stock }}</span>
                                    </span>

                                    <span class="font-medium text-[14px]">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>


            </div>

            @include('partials.table-pagination', ['items' => $rawMaterials])

        </div>
    </div>
@endsection
