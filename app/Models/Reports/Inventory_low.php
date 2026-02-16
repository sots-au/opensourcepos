<?php

namespace App\Models\Reports;

use App\Models\Item;

/**
 *
 *
 * @property item item
 *
 */
class Inventory_low extends Report
{
    /**
     * @return array[]
     */
    public function getDataColumns(): array
    {
        return [
            ['item_id'       => lang('Reports.item_id')],
            ['item_name'     => lang('Reports.item_name')],
            ['item_location' => lang('Reports.item_location')],
			['item_code'     => lang('Reports.item_code')],
            ['item_language' => lang('Reports.item_language')],
            ['category'      => lang('Reports.category')],
            ['quantity'      => lang('Reports.quantity')],
            ['location_name' => lang('Reports.stock_location')]
        ];
    }

    /**
     * @param array $inputs
     * @return array
     */
    public function getData(array $inputs): array
    {    // TODO: convert to using QueryBuilder. Use App/Models/Reports/Summary_taxes.php getData() as a reference template
        $item = model(Item::class);
        $query = $this->db->query("SELECT " . $item->get_item_name('name') . ",
            items.item_id,
            items.category,
            item_quantities.quantity,
            stock_locations.location_name
            FROM " . $this->db->prefixTable('items') . " AS items
            JOIN " . $this->db->prefixTable('item_quantities') . " AS item_quantities ON items.item_id = item_quantities.item_id
            JOIN " . $this->db->prefixTable('stock_locations') . " AS stock_locations ON item_quantities.location_id = stock_locations.location_id
            WHERE items.deleted = 0
            AND items.stock_type = 0
            AND item_quantities.quantity <= items.reorder_level
            AND stock_locations.deleted = 0
            ORDER BY items.name");

        return $query->getResultArray() ?: [];
    }

    /**
     * @param array $inputs
     * @return array
     */
    public function getSummaryData(array $inputs): array
    {
        return [];
    }
}
