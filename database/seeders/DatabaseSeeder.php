<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create(['name' => 'Admin', 'email' => 'admin@farpoint.com', 'Password123' => Hash::make('password'), 'role' => 'admin']);
        User::create(['name' => 'Staff', 'email' => 'staff@farpoint.com', 'Password123' => Hash::make('password'), 'role' => 'staff']);

        $cats = [];
        foreach (['Laptop', 'Monitor', 'Perangkat Lainnya'] as $nama) {
            $cats[$nama] = Category::create(['nama' => $nama])->id;
        }

        $data = [
            ['AST-001', 'Laptop Dell Latitude 5440', 'Laptop', 'Ruang IT', 'tersedia', '2026-10-15', 15500000],
            ['AST-002', 'Laptop Lenovo ThinkPad E14', 'Laptop', 'Ruang Finance', 'dipinjam', '2026-11-02', 13200000],
            ['AST-003', 'Laptop ASUS Vivobook 14', 'Laptop', 'Ruang HR', 'tersedia', '2026-10-20', 9800000],
            ['AST-004', 'Laptop HP ProBook 440', 'Laptop', 'Gudang', 'rusak', '2026-09-21', 11000000],
            ['AST-005', 'Monitor LG 24 inci', 'Monitor', 'Ruang IT', 'tersedia', '2026-09-25', 2100000],
            ['AST-006', 'Monitor Dell 27 inci', 'Monitor', 'Ruang Finance', 'tersedia', '2026-09-18', 3400000],
        ];

        foreach ($data as [$kode, $nama, $kat, $lokasi, $status, $tgl, $nilai]) {
            Asset::create([
                'kode' => $kode,
                'nama' => $nama,
                'category_id' => $cats[$kat],
                'lokasi' => $lokasi,
                'status' => $status,
                'tanggal_beli' => $tgl,
                'nilai' => $nilai,
            ]);
        }
    }
}
