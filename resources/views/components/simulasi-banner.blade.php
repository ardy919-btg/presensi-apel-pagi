@if(\App\Helpers\AttendanceTime::simulasiAktif())

    <div
        class="
            mb-6
            rounded-xl
            border
            border-amber-300
            bg-amber-50
            dark:bg-amber-900/20
            dark:border-amber-800
            px-4
            py-3
        "
    >

        <div class="flex items-start gap-3">

            <span class="text-xl leading-none">🧪</span>

            <div>

                <p
                    class="
                        text-sm
                        font-semibold
                        text-amber-800
                        dark:text-amber-300
                    "
                >
                    Simulasi Absensi Apel Pagi Sedang Aktif
                </p>

                <p
                    class="
                        mt-1
                        text-xs
                        leading-5
                        text-amber-700
                        dark:text-amber-400
                    "
                >
                    Hari ini Anda tetap bisa mengisi Apel Pagi walau bukan
                    hari Senin, khusus untuk keperluan uji coba. Data yang
                    Anda kirim selama simulasi akan tersimpan seperti
                    absensi Apel Pagi sungguhan.
                </p>

            </div>

        </div>

    </div>

@endif
