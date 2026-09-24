<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Absensi;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
    'nip',
    'name',
    'email',
    'jabatan',
    'bidang',
    'pangkat_golongan',
    'tanggal_lahir',
    'jenis_kelamin',
    'pendidikan',
    'pendidikan_detail',
    'golongan_darah',
    'role',
    'status',
    'password',
    'must_change_password',
];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'tanggal_lahir' => 'date',
            'password' => 'hashed',
            'must_change_password' => 'boolean',
        ];
    }

    /**
     * Password default akun baru / hasil reset, dibaca dari .env
     * (DEFAULT_PASSWORD) supaya tidak tertulis di source code.
     */
    public static function passwordDefault(): string
    {
        $password = config('attendance.default_password');

        if (! $password) {
            throw new \RuntimeException(
                'DEFAULT_PASSWORD belum diisi di file .env.'
            );
        }

        return (string) $password;
    }

    public function absensis()
{
    return $this->hasMany(Absensi::class);
}
}
