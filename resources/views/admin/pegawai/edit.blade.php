<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            Edit Pegawai
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4">

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">

                <form action="{{ route('admin.pegawai.update', $pegawai->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label>NIP</label>

                        <input type="text"
                               name="nip"
                               value="{{ old('nip', $pegawai->nip) }}"
                               class="w-full mt-1 rounded border-gray-300">
                    </div>

                    <div class="mb-4">
                        <label>Nama Pegawai</label>

                        <input type="text"
                               name="name"
                               value="{{ old('name', $pegawai->name) }}"
                               class="w-full mt-1 rounded border-gray-300">
                    </div>

                    <div class="mb-4">
                        <label>Email</label>

                        <input type="email"
                               name="email"
                               value="{{ old('email', $pegawai->email) }}"
                               class="w-full mt-1 rounded border-gray-300">
                    </div>

                    <div class="mb-4">
                        <label>Jabatan</label>

                        <input type="text"
                               name="jabatan"
                               value="{{ old('jabatan', $pegawai->jabatan) }}"
                               class="w-full mt-1 rounded border-gray-300">
                    </div>

                    <div class="mb-4">
                        <label>Bidang</label>

                        <input type="text"
                               name="bidang"
                               value="{{ old('bidang', $pegawai->bidang) }}"
                               class="w-full mt-1 rounded border-gray-300">

                        @error('bidang')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label>Pangkat / Golongan</label>

                        <input type="text"
                               name="pangkat_golongan"
                               value="{{ old('pangkat_golongan', $pegawai->pangkat_golongan) }}"
                               class="w-full mt-1 rounded border-gray-300">

                        @error('pangkat_golongan')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label>Tanggal Lahir</label>

                        <input type="date"
                               name="tanggal_lahir"
                               value="{{ old('tanggal_lahir', optional($pegawai->tanggal_lahir)->format('Y-m-d')) }}"
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
                                {{ old('jenis_kelamin', $pegawai->jenis_kelamin) === 'Laki-Laki' ? 'selected' : '' }}>
                                Laki-Laki
                            </option>

                            <option value="Perempuan"
                                {{ old('jenis_kelamin', $pegawai->jenis_kelamin) === 'Perempuan' ? 'selected' : '' }}>
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
                               value="{{ old('pendidikan', $pegawai->pendidikan) }}"
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
                               value="{{ old('pendidikan_detail', $pegawai->pendidikan_detail) }}"
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
                                    {{ old('golongan_darah', $pegawai->golongan_darah) === $golongan ? 'selected' : '' }}>
                                    {{ $golongan }}
                                </option>
                            @endforeach

                        </select>

                        @error('golongan_darah')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label>Status</label>

                        <select name="status"
                                class="w-full mt-1 rounded border-gray-300">

                            <option value="aktif"
                                {{ $pegawai->status === 'aktif' ? 'selected' : '' }}>
                                Aktif
                            </option>

                            <option value="nonaktif"
                                {{ $pegawai->status === 'nonaktif' ? 'selected' : '' }}>
                                Nonaktif
                            </option>

                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Password Baru</label>

                        <input type="password"
                               name="password"
                               class="w-full mt-1 rounded border-gray-300">

                        <p class="text-sm text-gray-500">
                            Kosongkan jika password tidak ingin diubah.
                        </p>
                    </div>

                    <div class="mb-6">
                        <label>Konfirmasi Password Baru</label>

                        <input type="password"
                               name="password_confirmation"
                               class="w-full mt-1 rounded border-gray-300">
                    </div>

                    <div class="flex gap-3">

                        <button
                            class="px-4 py-2 bg-blue-600 text-white rounded">
                            Update
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