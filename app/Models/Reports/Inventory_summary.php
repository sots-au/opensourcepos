<?php

namespace App\Models\Reports;

use App\Models\Item;

/**
 *
 *
 * @property item item
 *
 */
class Inventory_summary extends Report
{
    /**
     * @return array[]
     */
    public function getDataColumns(): array
    {
        return [
            ['item_id'           => lang('Reports.item_id')],
            ['item_name'         => lang('Reports.item_name')],
            ['item_location'     => lang('Reports.item_location')],
            ['item_code'         => lang('Reports.item_code')],
            ['item_language'     => lang('Reports.item_language')],
            ['category'          => lang('Reports.category')],
            ['quantity'          => lang('Reports.quantity')],
            ['cost_price'        => lang('Reports.cost_price'), 'sorter' => 'number_sorter'],
			['subtotal'          => lang('Reports.sub_total_value'), 'sorter' => 'number_sorter'],
            ['location_name'     => lang('Reports.stock_location')]
        ];
    }

    /**
     * @param array $inputs
     * @return array
     */
    public function getData(array $inputs): array
    {
        $item = model(Item::class);

        $builder = $this->db->table('items AS items');


        $this->db->from('item_inventory_summary');
    

        // Should be corresponding to the values Inventory_summary::getItemCountDropdownArray() returns
        if ($inputs['item_count'] == 'zero_and_less') {
            $builder->where('item_quantities.quantity <=', 0);
        } elseif ($inputs['item_count'] == 'more_than_zero') {
            $builder->where('item_quantities.quantity >', 0);
        }

        if (!empty($inputs['location_id']) && $inputs['location_id'] !== 'all') {
			$this->db->where('location_id', $inputs['location_id']);
		}

        $this->db->order_by('name', 'ASC');
		$this->db->order_by('qty_per_pack', 'ASC');

        return $builder->get()->getResultArray();
    }

    /**
     * calculates the total value of the given inventory summary by summing all sub_total_values (see Inventory_summary::getData())
     *
     * @param array $inputs expects the reports-data-array which Inventory_summary::getData() returns
     *
     * @return array
     */
    public function getSummaryData(array $inputs): array
    {
        $return = [    // TODO: This variable name should be refactored to reflect what it is... perhaps summary_data
            'total_inventory_value'   => 0,
            'total_quantity'          => 0,
            'total_low_sell_quantity' => 0,
            'total_retail'            => 0
        ];

        foreach ($inputs as $input) {
            $return['total_inventory_value'] += $input['sub_total_value']??0;
            $return['total_quantity'] += $input['quantity']??0;
            $return['total_low_sell_quantity'] += $input['low_sell_quantity']??0;
            $return['total_retail'] += ($input['unit_price']??0) * ($input['quantity']??0);
        }

        return $return;
    }

    /**
     * returns the array for the dropdown-element item-count in the form for the inventory summary-report
     *
     * @return array
     */
    public function getItemCountDropdownArray(): array
    {
        return [
            'all'            => lang('Reports.all'),
            'zero_and_less'  => lang('Reports.zero_and_less'),
            'more_than_zero' => lang('Reports.more_than_zero')
        ];
    }
}
