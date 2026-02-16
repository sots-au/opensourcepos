<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->setDefaultController('Login');

$routes->get('/', 'Login::index');
$routes->get('login', 'Login::index');
$routes->post('login', 'Login::index');

// CSV Import routes - Maps old snake_case URLs to new CI4 camelCase methods
$routes->get('sales/csv_import', 'Sales::getCsvImport');
$routes->post('sales/csv_import', 'Sales::postDoCsvImport');
$routes->get('sales/do_csv_import', 'Sales::getCsvImport');
$routes->post('sales/do_csv_import', 'Sales::postDoCsvImport');
$routes->post('sales/doCsvImport', 'Sales::postDoCsvImport');
$routes->get('sales/csvImport', 'Sales::getCsvImport');
$routes->post('sales/csvImport', 'Sales::postDoCsvImport');

$routes->get('receivings/csv_import', 'Receivings::getCsvImport');
$routes->post('receivings/csv_import', 'Receivings::postDoCsvImport');
$routes->get('receivings/do_csv_import', 'Receivings::getCsvImport');
$routes->post('receivings/do_csv_import', 'Receivings::postDoCsvImport');
$routes->post('receivings/doCsvImport', 'Receivings::postDoCsvImport');
$routes->get('receivings/csvImport', 'Receivings::getCsvImport');
$routes->post('receivings/csvImport', 'Receivings::postDoCsvImport');

$routes->add('no_access/index/(:segment)', 'No_access::index/$1');
$routes->add('no_access/index/(:segment)/(:segment)', 'No_access::index/$1/$2');

$routes->add('reports/summary_(:any)/(:any)/(:any)', 'Reports::Summary_$1/$2/$3/$4');
$routes->add('reports/summary_expenses_categories', 'Reports::date_input_only');
$routes->add('reports/summary_payments', 'Reports::date_input_only');
$routes->add('reports/summary_discounts', 'Reports::summary_discounts_input');
$routes->add('reports/summary_(:any)', 'Reports::date_input');

$routes->add('reports/graphical_(:any)/(:any)/(:any)', 'Reports::Graphical_$1/$2/$3/$4');
$routes->add('reports/graphical_summary_expenses_categories', 'Reports::date_input_only');
$routes->add('reports/graphical_summary_discounts', 'Reports::summary_discounts_input');
$routes->add('reports/graphical_(:any)', 'Reports::date_input');

$routes->add('reports/inventory_(:any)/(:any)', 'Reports::Inventory_$1/$2');
$routes->add('reports/inventory_low', 'Reports::inventory_low');
$routes->add('reports/inventory_summary', 'Reports::inventory_summary_input');
$routes->add('reports/inventory_summary/(:any)/(:any)/(:any)', 'Reports::inventory_summary/$1/$2/$3');

$routes->add('reports/detailed_(:any)/(:any)/(:any)/(:any)', 'Reports::Detailed_$1/$2/$3/$4');
$routes->add('reports/detailed_sales', 'Reports::date_input_sales');
$routes->add('reports/detailed_receivings', 'Reports::date_input_recv');

$routes->add('reports/specific_(:any)/(:any)/(:any)/(:any)', 'Reports::Specific_$1/$2/$3/$4');
$routes->add('reports/specific_customers', 'Reports::specific_customer_input');
$routes->add('reports/specific_employees', 'Reports::specific_employee_input');
$routes->add('reports/specific_discounts', 'Reports::specific_discount_input');
$routes->add('reports/specific_suppliers', 'Reports::specific_supplier_input');

// Common method routes for auto-routing with HTTP verb support
$routes->get('items/search', 'Items::getSearch');
$routes->get('items/suggest', 'Items::getSuggest');
$routes->get('items/suggest_low_sell', 'Items::getSuggestLowSell');
$routes->get('items/suggest_kits', 'Items::getSuggestKits');
$routes->get('items/suggest_category', 'Items::getSuggestCategory');
$routes->get('items/suggest_location', 'Items::getSuggestLocation');
$routes->get('items/row/(:any)', 'Items::getRow/$1');
$routes->get('items/view/(:num)', 'Items::getView/$1');
$routes->get('items/inventory/(:num)', 'Items::getInventory/$1');
$routes->get('items/count_details/(:num)', 'Items::getCountDetails/$1');
$routes->get('items/generate_barcodes/(:any)', 'Items::getGenerateBarcodes/$1');
$routes->get('items/attributes/(:num)', 'Items::getAttributes/$1');
$routes->post('items/attributes/(:num)', 'Items::postAttributes/$1');
$routes->get('items/bulk_edit', 'Items::getBulkEdit');
$routes->post('items/save/(:num)', 'Items::postSave/$1');
$routes->post('items/check_item_number', 'Items::postCheckItemNumber');
$routes->get('items/remove_logo/(:num)', 'Items::getRemoveLogo/$1');
$routes->get('items/index', 'Items::getIndex');
$routes->get('items', 'Items::getIndex');

// Receivings controller routes
$routes->get('receivings/item_search', 'Receivings::getItemSearch');
$routes->get('receivings/stock_item_search', 'Receivings::getStockItemSearch');
$routes->post('receivings/select_supplier', 'Receivings::postSelectSupplier');
$routes->post('receivings/change_mode', 'Receivings::postChangeMode');
$routes->post('receivings/set_comment', 'Receivings::postSetComment');
$routes->post('receivings/set_print_after_sale', 'Receivings::postSetPrintAfterSale');
$routes->post('receivings/set_reference', 'Receivings::postSetReference');
$routes->post('receivings/add', 'Receivings::postAdd');
$routes->post('receivings/edit_item/(:any)', 'Receivings::postEditItem/$1');
$routes->get('receivings/edit/(:num)', 'Receivings::getEdit/$1');
$routes->get('receivings/delete_item/(:any)', 'Receivings::getDeleteItem/$1');
$routes->post('receivings/delete/(:num)', 'Receivings::postDelete/$1');
$routes->get('receivings/remove_supplier', 'Receivings::getRemoveSupplier');
$routes->post('receivings/complete', 'Receivings::postComplete');
$routes->post('receivings/requisition_complete', 'Receivings::postRequisitionComplete');
$routes->get('receivings/receipt/(:num)', 'Receivings::getReceipt/$1');
$routes->post('receivings/save/(:num)', 'Receivings::postSave/$1');
$routes->post('receivings/cancel_receiving', 'Receivings::postCancelReceiving');
$routes->get('receivings/index', 'Receivings::getIndex');
$routes->get('receivings', 'Receivings::getIndex');

// Sales controller routes
$routes->get('sales/manage', 'Sales::getManage');
$routes->get('sales/row/(:num)', 'Sales::getRow/$1');
$routes->get('sales/search', 'Sales::getSearch');
$routes->get('sales/item_search', 'Sales::getItemSearch');
$routes->post('sales/select_customer', 'Sales::postSelectCustomer');
$routes->post('sales/change_mode', 'Sales::postChangeMode');
$routes->post('sales/set_comment', 'Sales::postSetComment');
$routes->post('sales/set_invoice_number', 'Sales::postSetInvoiceNumber');
$routes->post('sales/set_payment_type', 'Sales::postSetPaymentType');
$routes->post('sales/set_print_after_sale', 'Sales::postSetPrintAfterSale');
$routes->post('sales/set_price_work_orders', 'Sales::postSetPriceWorkOrders');
$routes->post('sales/set_email_receipt', 'Sales::postSetEmailReceipt');
$routes->post('sales/add_payment', 'Sales::postAddPayment');
$routes->get('sales/delete_payment/(:any)', 'Sales::getDeletePayment/$1');
$routes->post('sales/add', 'Sales::postAdd');
$routes->post('sales/edit_item/(:any)', 'Sales::postEditItem/$1');
$routes->get('sales/delete_item/(:num)', 'Sales::getDeleteItem/$1');
$routes->get('sales/remove_customer', 'Sales::getRemoveCustomer');
$routes->post('sales/complete', 'Sales::postComplete');
$routes->post('sales/cancel', 'Sales::postCancel');
$routes->post('sales/suspend', 'Sales::postSuspend');
$routes->get('sales/suspended', 'Sales::getSuspended');
$routes->get('sales/discard_suspended_sale', 'Sales::getDiscardSuspendedSale');
$routes->get('sales/send_pdf/(:num)', 'Sales::getSendPdf/$1');
$routes->get('sales/index', 'Sales::getIndex');
$routes->get('sales', 'Sales::getIndex');

// camelCase route variants for Sales (for backward compatibility with views)
$routes->post('sales/changeMode', 'Sales::postChangeMode');
$routes->post('sales/selectCustomer', 'Sales::postSelectCustomer');
$routes->post('sales/setComment', 'Sales::postSetComment');
$routes->post('sales/setInvoiceNumber', 'Sales::postSetInvoiceNumber');
$routes->post('sales/setPaymentType', 'Sales::postSetPaymentType');
$routes->post('sales/setPrintAfterSale', 'Sales::postSetPrintAfterSale');
$routes->post('sales/setPriceWorkOrders', 'Sales::postSetPriceWorkOrders');
$routes->post('sales/setEmailReceipt', 'Sales::postSetEmailReceipt');
$routes->post('sales/addPayment', 'Sales::postAddPayment');
$routes->get('sales/deletePayment/(:any)', 'Sales::getDeletePayment/$1');
$routes->post('sales/editItem/(:any)', 'Sales::postEditItem/$1');
$routes->get('sales/deleteItem/(:num)', 'Sales::getDeleteItem/$1');
$routes->get('sales/removeCustomer', 'Sales::getRemoveCustomer');
$routes->post('sales/cancel', 'Sales::postCancel');
$routes->post('sales/suspend', 'Sales::postSuspend');
$routes->get('sales/suspended', 'Sales::getSuspended');
$routes->get('sales/discardSuspendedSale', 'Sales::getDiscardSuspendedSale');
$routes->get('sales/itemSearch', 'Sales::getItemSearch');
$routes->post('sales/csvImport', 'Sales::postDoCsvImport');

// camelCase route variants for Receivings
$routes->post('receivings/changeMode', 'Receivings::postChangeMode');
$routes->post('receivings/selectSupplier', 'Receivings::postSelectSupplier');
$routes->post('receivings/setComment', 'Receivings::postSetComment');
$routes->post('receivings/setPrintAfterSale', 'Receivings::postSetPrintAfterSale');
$routes->post('receivings/setReference', 'Receivings::postSetReference');
$routes->post('receivings/editItem/(:any)', 'Receivings::postEditItem/$1');
$routes->get('receivings/deleteItem/(:any)', 'Receivings::getDeleteItem/$1');
$routes->post('receivings/csvImport', 'Receivings::postDoCsvImport');

// camelCase route variants for Items
$routes->get('items/itemSearch', 'Items::getItemSearch');
$routes->post('items/saveItem', 'Items::postSave');
$routes->post('items/checkItemNumber', 'Items::postCheckItemNumber');

// CSV template download routes (methods don't follow get/post naming convention)
$routes->get('sales/csv', 'Sales::csv');
$routes->get('receivings/csv', 'Receivings::csv');
$routes->get('items/generateCsvFile', 'Items::getGenerateCsvFile');