<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HomestayGallery extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel homestay
        $this->forge->addField([
            'id'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 8,
                'null'           => false
            ],
            'homestay_id'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 8,
                'null'           => false
            ],
            'url'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'           => false
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ]
        ]);

        // Membuat primary homestay
        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('homestay_id', 'homestay', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('homestay_gallery', TRUE);
    }

    public function down()
    {
        // menghapus tabel homestay
        $this->forge->dropTable('homestay_gallery');
    }
}
