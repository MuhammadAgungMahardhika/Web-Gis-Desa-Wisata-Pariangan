<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run()
    {
        $data = [
            'id' => 1,
            'name' => 'Indonesia',
        ];

        $this->db->table('country')->insert($data);

        $this->db->table('country')->set('geom', "ST_GeomFromGeoJSON('')", false)->where('id', 1)->update();
    }
}
