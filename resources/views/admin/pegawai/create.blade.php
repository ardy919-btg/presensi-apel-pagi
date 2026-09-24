<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            Tambah Pegawai
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4">

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">

                <form action="{{ route('admin.pegawai.store') }}"
                      method="POST">

                    @csrf

                    <div class="mb-4">
                        <label>NIP</label>

                        <input type="text"
                               name="nip"
                               value="{{ old('nip') }}"
                               class="w-full mt-1 rounded border-gray-300">

                        @error('nip')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label>Nama Pegawai</label>

                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               class="w-full mt-1 rounded border-gray-300">

                        @error('name')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label>Email</label>

                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               class="w-full mt-1 rounded border-gray-300">

                        @error('email')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label>Jabatan</label>

                        <input type="text"
                               name="jabatan"
                               value="{{ old('jabatan') }}"
                               class="w-full mt-1 rounded border-gray-300">

                        @error('jabatan')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label>Bidang / Unit Kerja</label>

                        <input type="text"
                               name="bidang"
                               value="{{ old('bidang') }}"
                               class="w-full mt-1 rounded border-gray-300">

                        @error('bidang')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label>Pangkat / Golongan</label>

                        <input type="text"
                               name="pangkat_golongan"
                               value="{{ old('pangkat_golongan') }}"
                               class="w-full mt-1 rounded border-gray-300">

                        @error('pangkat_golongan')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label>Tanggal Lahir</label>

                        <input type="date"
                               name="tanggal_lahir"
                               value="{{ old('tanggal_lahir') }}"
                               class="w-full mt-1 rounded border-gray-300">

                        @error('tanggal_lahir')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label>Jenis Kelamin</label>

                        <select name="jenis_kelamin"
                                class="w-full mt-1 rounded border-gray-300">

                            <option value="">-- Pilih Jenis Kelamin --</option>

                            <option value="Laki-Laki"
                                {{ old('jenis_kelamin') === 'Laki-Laki' ? 'selected' : '' }}>
                                Laki-Laki
                            </option>

                            <option value="Perempuan"
                                {{ old('jenis_kelamin') === 'Perempuan' ? 'selected' : '' }}>
                                Perempuan
                            </option>

                        </select>

                        @error('jenis_kelamin')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label>Pendidikan</label>

                        <input type="text"
                               name="pendidikan"
                               value="{{ old('pendidikan') }}"
                               placeholder="Contoh: S1, S2, D3, SMA/SMK/Sederajat"
                               class="w-full mt-1 rounded border-gray-300">

                        @error('pendidikan')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label>Pendidikan (Detail)</label>

                        <input type="text"
                               name="pendidikan_detail"
                               value="{{ old('pendidikan_detail') }}"
                               placeholder="Contoh: SMK, Madrasah Aliyah"
                               class="w-full mt-1 rounded border-gray-300">

                        @error('pendidikan_detail')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label>Golongan Darah</label>

                        <select name="golongan_darah"
                                class="w-full mt-1 rounded border-gray-300">

                            <option value="">-- Pilih Golongan Darah --</option>

                            @foreach (['A', 'B', 'AB', 'O'] as $golongan)
                                <option value="{{ $golongan }}"
                                    {{ old('golongan_darah') === $golongan ? 'selected' : '' }}>
                                    {{ $golongan }}
                                </option>
                            @endforeach

                        </select>

                        @error('golongan_darah')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label>Password</label>

                        <input type="password"
                               name="password"
                               class="w-full mt-1 rounded border-gray-300">

                        @error('password')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label>Konfirmasi Password</label>

                        <input type="password"
                               name="password_confirmation"
                               class="w-full mt-1 rounded border-gray-300">
                    </div>

                    <div class="flex gap-3">

                        <button
                            class="px-4 py-2 bg-blue-600 text-white rounded">
                            Simpan
                        </button>

                        <a href="{{ route('admin.pegawai.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded">
                            Kembali
                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>