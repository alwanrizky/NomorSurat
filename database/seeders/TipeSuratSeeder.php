<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipeSuratSeeder extends Seeder
{

    private $tipeSurat = ["Intern", "Ekstern", "SKet (Surat Keterangan untuk dosen/karyawan)", "SK (Surat Keputusan Dekan)",
                        "MOU (Memorandum of Understanding)", "MOA (Memorandum of Agreement)", "ST (Surat Tugas)", "KM (Keterangan Mahasiswa)",
                        "U (Pengumuman)", "C (Cuti Study)", "UD (Undur)"];

    private $alias = ["I", "E", "SKet", "SK", "MOU", "MOA", "ST", "KM", "U", "C", "UD"];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < sizeof($this->tipeSurat); $i++){
            DB::table('tipe_surats')->insert([
                'tipe_surat' => $this->tipeSurat[$i],
                'alias' => $this->alias[$i]
            ]);
        }
    }
}
