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
            <a href="{{ route('laundry-transactions.create') }}"
               class="text-[18px] text-gray-500 hover:text-black">
                ←
            </a>

            <h2 class="font-semibold text-[22px] sm:text-[24px]">
                Transaksi Laundry
            </h2>
        </div>

        {{-- STEP INFO --}}
        <div class="bg-[#FAFAFA] rounded-2xl p-4 mb-6">
            <div class="flex justify-between items-center mb-1">
                <p class="font-semibold text-[16px]">
                    Silakan isi formulir di bawah ini!
                </p>
                <p class="text-sm text-gray-400">
                    Langkah 2 <span class="mx-1">Dari</span> 3
                </p>
            </div>

            {{-- FORM --}}
            <form action="{{ route('laundry-transactions.step2.store') }}" method="POST" class="space-y-4">
                @csrf

                {{-- KATEGORI LAUNDRY --}}
                <div>
                    <label class="text-sm font-medium">Kategori Laundry</label>
                    <select
                        name="category"
                        class="w-full mt-1 rounded-xl border-gray-200
                               px-4 py-3 text-sm
                               focus:outline-none focus:ring-1 focus:ring-[#EA821B]">
                        <option value="reguler">Reguler</option>
                        <option value="express">Express</option>
                    </select>
                </div>

                {{-- JENIS LAUNDRY --}}
                <div>
                    <label class="text-sm font-medium">Jenis Laundry</label>
                    <select
                        name="laundry_type"
                        class="w-full mt-1 rounded-xl border-gray-200
                               px-4 py-3 text-sm
                               focus:outline-none focus:ring-1 focus:ring-[#EA821B]">
                        <option value="cuci_setrika">Cuci Setrika</option>
                        <option value="cuci_kering">Cuci Kering</option>
                        <option value="setrika">Setrika</option>
                    </select>
                </div>

                {{-- BERAT --}}
                <div>
                    <label class="text-sm font-medium">Berat Laundry</label>
                    <input type="number"
                           step="0.1"
                           name="laundry_weight"
                           placeholder="Kg"
                           class="w-full mt-1 rounded-xl border-gray-200
                                  px-4 py-3 text-sm
                                  focus:outline-none focus:ring-1 focus:ring-[#EA821B]">
                </div>

                {{-- JENIS PARFUM --}}
                <div>
                    <label class="text-sm font-medium">Jenis Parfume</label>
                    <select
                        name="perfume"
                        class="w-full mt-1 rounded-xl border-gray-200
                               px-4 py-3 text-sm
                               focus:outline-none focus:ring-1 focus:ring-[#EA821B]">
                        <option value="ysl">YSL</option>
                        <option value="lavender">Lavender</option>
                        <option value="rose">Rose</option>
                    </select>
                </div>

                {{-- CATATAN --}}
                <div>
                    <label class="text-sm font-medium">Catatan</label>
                    <textarea
                        name="notes"
                        rows="3"
                        placeholder="Silahkan tinggalkan catatan"
                        class="w-full mt-1 rounded-xl border-gray-200
                               px-4 py-3 text-sm
                               resize-none
                               focus:outline-none focus:ring-1 focus:ring-[#EA821B]"></textarea>
                </div>

                {{-- BUTTON --}}
                <button type="submit"
                        class="w-full mt-6 bg-[#EA821B] text-white
                               py-3 rounded-xl font-medium
                               hover:bg-orange-600 transition">
                    Selanjutnya
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
