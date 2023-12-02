<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class City extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel pariangan
        $this->forge->addField([
            'id'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 8,
                'null'           => false
            ],
            'name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'           => false
            ],
            'geom'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'           => true
            ]
        ]);

        // Membuat primary pariangan
        $this->forge->addKey('id', TRUE);

        // Membuat tabel pariangan
        $this->forge->createTable('city', TRUE);
    }

    public function down()
    {
        // menghapus tabel pariangan
        $this->forge->dropTable('city');
    }
}
