<section>

    <header>

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Informasi Profil
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">

            @if(Auth::user()->role === 'admin')

                Kelola informasi akun administrator.

            @else

                Lihat informasi akun pegawai. Data utama pegawai dikelola oleh administrator.

            @endif

        </p>

    </header>


    <form
        method="post"
        action="{{ route('profile.update') }}"
        class="mt-6 space-y-6"
    >

        @csrf
        @method('patch')


        {{-- ============================================= --}}
        {{-- ADMIN --}}
        {{-- ============================================= --}}

        @if(Auth::user()->role === 'admin')

            {{-- Nama --}}
            <div>

                <x-input-label
                    for="name"
                    value="Nama"
                />

                <x-text-input
                    id="name"
                    name="name"
                    type="text"
                    class="mt-1 block w-full"
                    :value="old('name', $user->name)"
                    required
                    autofocus
                    autocomplete="name"
                />

                <x-input-error
                    class="mt-2"
                    :messages="$errors->get('name')"
                />

            </div>


            {{-- Email --}}
            <div>

                <x-input-label
                    for="email"
                    value="Email"
                />

                <x-text-input
                    id="email"
                    name="email"
                    type="email"
                    class="mt-1 block w-full"
                    :value="old('email', $user->email)"
                    required
                    autocomplete="username"
                />

                <x-input-error
                    class="mt-2"
                    :messages="$errors->get('email')"
                />

            </div>


            <div class="flex items-center gap-4">

                <x-primary-button>
                    Simpan Profil
                </x-primary-button>


                @if (session('status') === 'profile-updated')

                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 3000)"
                        class="text-sm text-green-600 dark:text-green-400"
                    >
                        Profil berhasil diperbarui.
                    </p>

                @endif

            </div>


        {{-- ============================================= --}}
        {{-- PEGAWAI --}}
        {{-- ============================================= --}}

        @elseif(Auth::user()->role === 'pegawai')


            {{-- NIP --}}
            <div>

                <x-input-label
                    for="nip"
                    value="NIP"
                />

                <x-text-input
                    id="nip"
                    type="text"
                    class="
                        mt-1
                        block
                        w-full
                        bg-gray-100
                        dark:bg-gray-700
                        cursor-not-allowed
                    "
                    :value="$user->nip"
                    readonly
                />

            </div>


            {{-- Nama --}}
            <div>

                <x-input-label
                    for="pegawai_name"
                    value="Nama Pegawai"
                />

                <x-text-input
                    id="pegawai_name"
                    name="name"
                    type="text"
                    class="mt-1 block w-full"
                    :value="old('name', $user->name)"
                    required
                    autocomplete="name"
                />

                <x-input-error
                    class="mt-2"
                    :messages="$errors->get('name')"
                />

            </div>


            {{-- Jabatan --}}
            <div>

                <x-input-label
                    for="jabatan"
                    value="Jabatan"
                />

                <x-text-input
                    id="jabatan"
                    name="jabatan"
                    type="text"
                    class="mt-1 block w-full"
                    :value="old('jabatan', $user->jabatan)"
                />

                <x-input-error
                    class="mt-2"
                    :messages="$errors->get('jabatan')"
                />

            </div>


            {{-- Bidang --}}
            <div>

                <x-input-label
                    for="bidang"
                    value="Bidang"
                />

                <x-text-input
                    id="bidang"
                    type="text"
                    class="
                        mt-1
                        block
                        w-full
                        bg-gray-100
                        dark:bg-gray-700
                        cursor-not-allowed
                    "
                    :value="$user->bidang"
                    readonly
                />

            </div>


            {{-- Email --}}
            <div>

                <x-input-label
                    for="pegawai_email"
                    value="Email (untuk Login dengan Google)"
                />

                <x-text-input
                    id="pegawai_email"
                    name="email"
                    type="email"
                    class="mt-1 block w-full"
                    :value="old('email', $user->email)"
                    autocomplete="username"
                />

                <x-input-error
                    class="mt-2"
                    :messages="$errors->get('email')"
                />

                @if(! $user->email)

                    <p
                        class="
                            mt-2
                            flex
                            items-start
                            gap-2
                            text-sm
                            text-amber-700
                            dark:text-amber-400
                        "
                    >
                        <span>⚠️</span>
                        <span>
                            Alamat email Anda belum diisi. Lengkapi dengan
                            email Google Anda supaya bisa Login dengan Google
                            di halaman login.
                        </span>
                    </p>

                @endif

            </div>


            <div
                class="
                    p-4
                    rounded-lg
                    bg-blue-50
                    dark:bg-blue-900/20
                    text-sm
                    text-blue-700
                    dark:text-blue-300
                "
            >
                Jika terdapat kesalahan pada NIP atau bidang, silakan
                hubungi administrator BPKAD. Nama, jabatan, dan alamat
                email dapat Anda perbarui sendiri di atas.
            </div>


            <div class="flex items-center gap-4">

                <x-primary-button>
                    Simpan Profil
                </x-primary-button>


                @if (session('status') === 'profile-updated')

                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 3000)"
                        class="text-sm text-green-600 dark:text-green-400"
                    >
                        Profil berhasil diperbarui.
                    </p>

                @endif

            </div>

        @endif


    </form>

</section>