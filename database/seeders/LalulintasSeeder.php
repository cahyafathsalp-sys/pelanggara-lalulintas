<?php

namespace Database\Seeders;

use App\Models\DetailPelanggaran;
use App\Models\JenisPelanggaran;
use App\Models\Kendaraan;
use App\Models\Pelanggaran;
use App\Models\Pengendara;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LalulintasSeeder extends Seeder
{
    public function run(): void
    {
        // Cari user admin/atau user pertama yang tersedia untuk mengisi petugas.user_id
        $user = User::where('role', 'admin')->first() ?? User::first();
        if (!$user) {
            // supaya seeders ini tetap aman dipanggil setelah AdminSeeder
            return;
        }

        DB::transaction(function () use ($user) {
            // 1) Jenis Pelanggaran (master)
            $jenis = $this->seedJenisPelanggaran();

            // 2) Pengendara + Kendaraan (master)
            $pengendara = $this->seedPengendaraDanKendaraan();

            // 3) Petugas (transaksi)
            $petugas = Petugas::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'nip' => 'NIP-0001',
                ],
                [
                    'nama' => 'Petugas Utama',
                    'pangkat' => 'Brigadir',
                    'no_hp' => '081234567890',
                ]
            );

            // 4) Pelanggaran + Detail Pelanggaran
            $dataPelanggaran = [
                [
                    'pengendara_index' => 0,
                    'kendaraan_index' => 0,
                    'tanggal' => '2026-07-10',
                    'lokasi' => 'Jl. Sudirman',
                    'keterangan' => 'Tidak memakai helm saat berkendara',
                    'jenis_indices' => [0],
                ],
                [
                    'pengendara_index' => 1,
                    'kendaraan_index' => 0,
                    'tanggal' => '2026-07-11',
                    'lokasi' => 'Jl. Thamrin',
                    'keterangan' => 'Melanggar marka jalan',
                    'jenis_indices' => [1, 2],
                ],
                [
                    'pengendara_index' => 2,
                    'kendaraan_index' => 0,
                    'tanggal' => '2026-07-12',
                    'lokasi' => 'Jl. Gajah Mada',
                    'keterangan' => 'Tidak memiliki surat izin mengemudi',
                    'jenis_indices' => [3],
                ],
            ];

            foreach ($dataPelanggaran as $item) {
                $p = $pengendara[$item['pengendara_index']];
                $k = $p['kendaraan'][$item['kendaraan_index']];

                $jenisIds = array_map(fn ($i) => $jenis[$i]->id, $item['jenis_indices']);
                $totalDenda = JenisPelanggaran::whereIn('id', $jenisIds)->sum('denda');

                // Idempotent: buat kunci unik berbasis tanggal+lokasi+nomor_polisi
                $kunci = sprintf(
                    'PLG-%s-%s-%s',
                    $item['tanggal'],
                    Str::slug($item['lokasi']),
                    $k->nomor_polisi
                );

                // Simpan kunci dengan cara cek keberadaan paling mendekati (karena skema belum punya unique key)
                $pelanggaran = Pelanggaran::where('petugas_id', $petugas->id)
                    ->where('tanggal', $item['tanggal'])
                    ->where('lokasi', $item['lokasi'])
                    ->where('kendaraan_id', $k->id)
                    ->first();

                if (!$pelanggaran) {
                    $pelanggaran = Pelanggaran::create([
                        'petugas_id' => $petugas->id,
                        'pengendara_id' => $p['pengendara']->id,
                        'kendaraan_id' => $k->id,
                        'tanggal' => $item['tanggal'],
                        'lokasi' => $item['lokasi'],
                        'keterangan' => $item['keterangan'],
                        'total_denda' => (int) $totalDenda,
                    ]);
                }

                // Sync detail pelanggaran
                $existing = DetailPelanggaran::where('pelanggaran_id', $pelanggaran->id)
                    ->pluck('jenis_pelanggaran_id')
                    ->all();

                $toInsert = array_values(array_diff($jenisIds, $existing));
                foreach ($toInsert as $jenisId) {
                    DetailPelanggaran::create([
                        'pelanggaran_id' => $pelanggaran->id,
                        'jenis_pelanggaran_id' => $jenisId,
                    ]);
                }
            }
        });
    }

    private function seedJenisPelanggaran(): array
    {
        $rows = [
            ['nama_pelanggaran' => 'Tidak memakai helm', 'pasal' => 'Pasal 291', 'denda' => 250000],
            ['nama_pelanggaran' => 'Melanggar marka jalan', 'pasal' => 'Pasal 287', 'denda' => 50000],
            ['nama_pelanggaran' => 'Tidak tertib berlalu lintas', 'pasal' => 'Pasal 288', 'denda' => 100000],
            ['nama_pelanggaran' => 'Tidak memiliki SIM', 'pasal' => 'Pasal 281', 'denda' => 250000],
        ];

        $result = [];
        foreach ($rows as $r) {
            $record = JenisPelanggaran::firstOrCreate(
                [
                    'nama_pelanggaran' => $r['nama_pelanggaran'],
                    'pasal' => $r['pasal'],
                ],
                [
                    'denda' => $r['denda'],
                ]
            );
            $result[] = $record;
        }

        return $result;
    }

    private function seedPengendaraDanKendaraan(): array
    {
        $data = [
            [
                'pengendara' => [
                    'nik' => '3201010101010001',
                    'nama' => 'Ahmad Fauzi',
                    'alamat' => 'Jl. Mawar No. 1',
                    'no_sim' => 'SIM-A-0001',
                ],
                'kendaraan' => [
                    [
                        'nomor_polisi' => 'B 1234 ABC',
                        'merk' => 'Honda',
                        'jenis' => 'Motor',
                        'warna' => 'Hitam',
                        'tahun' => 2022,
                    ],
                ],
            ],
            [
                'pengendara' => [
                    'nik' => '3201010101010002',
                    'nama' => 'Siti Nurhaliza',
                    'alamat' => 'Jl. Melati No. 2',
                    'no_sim' => 'SIM-A-0002',
                ],
                'kendaraan' => [
                    [
                        'nomor_polisi' => 'B 2345 DEF',
                        'merk' => 'Yamaha',
                        'jenis' => 'Motor',
                        'warna' => 'Merah',
                        'tahun' => 2021,
                    ],
                ],
            ],
            [
                'pengendara' => [
                    'nik' => '3201010101010003',
                    'nama' => 'Budi Santoso',
                    'alamat' => 'Jl. Kenanga No. 3',
                    'no_sim' => 'SIM-A-0003',
                ],
                'kendaraan' => [
                    [
                        'nomor_polisi' => 'B 3456 GHI',
                        'merk' => 'Suzuki',
                        'jenis' => 'Motor',
                        'warna' => 'Biru',
                        'tahun' => 2020,
                    ],
                ],
            ],
        ];

        $out = [];
        foreach ($data as $item) {
            $p = Pengendara::firstOrCreate(
                [
                    'nik' => $item['pengendara']['nik'],
                ],
                $item['pengendara']
            );

            $kendaraanRows = [];
            foreach ($item['kendaraan'] as $k) {
                $kendaraan = Kendaraan::firstOrCreate(
                    [
                        'nomor_polisi' => $k['nomor_polisi'],
                    ],
                    [
                        'pengendara_id' => $p->id,
                        'merk' => $k['merk'],
                        'jenis' => $k['jenis'],
                        'warna' => $k['warna'],
                        'tahun' => $k['tahun'],
                    ]
                );
                $kendaraanRows[] = $kendaraan;
            }

            $out[] = [
                'pengendara' => $p,
                'kendaraan' => $kendaraanRows,
            ];
        }

        return $out;
    }
}

