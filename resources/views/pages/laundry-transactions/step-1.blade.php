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
                <a href="{{ route('laundry-transactions.index') }}" class="text-[18px] text-gray-500 hover:text-black">
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
                        Langkah 1 <span class="mx-1">Dari</span> 3
                    </p>
                </div>

                {{-- FORM --}}
                <form action="{{ route('laundry-transactions.store') }}" method="POST" class="space-y-4">
                    @csrf

                    {{-- NAMA --}}
                    <div>
                        <label class="text-sm font-medium">Nama Pelanggan</label>
                        <input type="text" name="customer_name" placeholder="Nama Pelanggan" required
                            class="w-full mt-1 rounded-xl border-gray-200
                      px-4 py-3 text-sm
                      focus:outline-none focus:ring-1 focus:ring-[#EA821B]">
                    </div>

                    {{-- NOMOR --}}
                    <div>
                        <label class="text-sm font-medium">Nomor Telepon</label>
                        <input type="text" name="phone_number" placeholder="81234567890" required
                            class="w-full mt-1 rounded-xl border-gray-200
                      px-4 py-3 text-sm
                      focus:outline-none focus:ring-1 focus:ring-[#EA821B]">
                    </div>

                    {{-- ALAMAT --}}
                    <div>
                        <label class="text-sm font-medium">Alamat Pelanggan</label>
                        <input type="text" name="address" placeholder="Semarang"
                            class="w-full mt-1 rounded-xl border-gray-200
                      px-4 py-3 text-sm
                      focus:outline-none focus:ring-1 focus:ring-[#EA821B]">
                    </div>

                    {{-- TANGGAL MASUK --}}
                    <div>
                        <label class="text-sm font-medium">Tanggal Masuk</label>
                        <input type="date" name="transaction_date" required
                            class="w-full mt-1 rounded-xl border-gray-200
                      px-4 py-3 text-sm
                      focus:outline-none focus:ring-1 focus:ring-[#EA821B]">
                    </div>

                    {{-- TANGGAL AMBIL --}}
                    <div>
                        <label class="text-sm font-medium">Tanggal Ambil</label>
                        <input type="date" name="pickup_date" required
                            class="w-full mt-1 rounded-xl border-gray-200
                      px-4 py-3 text-sm
                      focus:outline-none focus:ring-1 focus:ring-[#EA821B]">
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
