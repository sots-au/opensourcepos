<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Migration_add_cc_surcharge extends Migration
{
    /**
     * Perform a migration step.
     */
    public function up(): void
    {
        // Add cc_surcharge column to sales table
        $this->db->query('ALTER TABLE ' . $this->db->prefixTable('sales') . ' 
            ADD COLUMN `cc_surcharge` DECIMAL(10,4) DEFAULT 0.0000 AFTER `sale_type`');

        // Add cc_surcharge configuration keys with defaults
        $config_values = [
            ['key' => 'cc_surcharge',          'value' => '1.4'],
            ['key' => 'cc_surcharge_decimals', 'value' => '4']
        ];

        $this->db->table('app_config')->ignore(true)->insertBatch($config_values);
    }

    /**
     * Revert a migration step.
     */
    public function down(): void
    {
        // Remove cc_surcharge column from sales table
        $this->db->query('ALTER TABLE ' . $this->db->prefixTable('sales') . ' 
            DROP COLUMN `cc_surcharge`');

        // Remove cc_surcharge configuration keys
        $this->db->table('app_config')
            ->whereIn('key', ['cc_surcharge', 'cc_surcharge_decimals'])
            ->delete();
    }
}
