<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ParianganVideo extends Migration
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
            'pariangan_id'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 8,
                'null'           => false
            ],
            'url'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'           => false
            ],
            'duration'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'           => true
            ]
        ]);
        // Membuat tabel pariangan


        // Membuat primary pariangan
        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('pariangan_id', 'pariangan', 'id');
        $this->forge->createTable('pariangan_video', TRUE);
    }

    public function down()
    {
        // menghapus tabel pariangan
        $this->forge->dropTable('pariangan_video');
    }
}
