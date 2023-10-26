<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pariangan extends Migration
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
            'open'       => [
                'type'           => 'TIME',
                'null'           => true
            ],
            'close'       => [
                'type'           => 'TIME',
                'null'           => true
            ],
            'type_of_tourism'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'null'           => true
            ],
            'address' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'           => true
            ],
            'contact_person'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 13,
                'null'           => true
            ],
            'description'      => [
                'type'           => 'TEXT',
                'null'           => true
            ],
            'lat'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null'           => false
            ],
            'lng'      => [
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
        $this->forge->createTable('pariangan', TRUE);
    }

    public function down()
    {
        // menghapus tabel pariangan
        $this->forge->dropTable('pariangan');
    }
}
