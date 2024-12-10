<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ChequeIssuanceRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ChequeIssuanceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ChequeIssuanceCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\ChequeIssuance::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/cheque-issuance');
        CRUD::setEntityNameStrings('cheque issuance', 'cheque issuances');

        $this->crud->setColumns([
            [
                'name'  => 'business_name',
                'label' => 'Business Name',   // Custom label for the 'business_name' column
            ],
            [
                'name'  => 'bank',
                'label' => 'Bank Name',       // Custom label for the 'bank' column
            ],
            [
                'name'  => 'cheque_number',
                'label' => 'Cheque No. (Last 4 Digits)',  // Custom label for the 'cheque_number' column
            ],
            [
                'name'  => 'amount',
                'label' => 'Cheque Amount',
                'type'  => 'closure', // Use 'closure' to format the amount
                'function' => function($entry) {
                    return '₱' . number_format($entry->amount, 2, '.', ','); // Format amount as ₱10,000.00
                }
            ],
            [
                'name'  => 'status',
                'label' => 'Cheque Status',   // Custom label for the 'status' column
            ],
            [
                'name'  => 'remarks',
                'label' => 'Remarks',         // Custom label for the 'remarks' column
            ],
            [
                'name'  => 'created_at',
                'label' => 'Date Created',    // Custom label for the 'created_at' column
            ],
        ]);
        

        $this->crud->addFields([
            [
                'name'  => 'business_name',
                'type'  => 'text',
                'label' => 'Business Name',
                'attributes' => [
                    'placeholder' => 'Enter the business name'
                ]
            ],
            [
                'name'  => 'bank',
                'type'  => 'text',
                'label' => 'Bank',
                'attributes' => [
                    'placeholder' => 'Enter the bank name'
                ]
            ],
            [
                'name'  => 'cheque_number',
                'type'  => 'text',
                'label' => 'Last 4 Digits of Cheque Number',
                'attributes' => [
                    'placeholder' => 'Enter the last 4 digits of the cheque number',
                    'maxlength' => 4
                ]
            ],

            [
                'name'  => 'amount',
                'label' => 'Amount',
                'type'  => 'number',
                'attributes' => [
                    'step' => '0.01',
                    'min' => '0',
                ],
                'prefix' => '₱',
            ],

            [
                'name'  => 'status',
                'label' => 'Status',
                'type'  => 'select_from_array',
                'options' => [
                    'pending' => 'Pending',
                    'processed' => 'Processed',
                    'paid' => 'Paid',
                    'failed' => 'Failed',
                ],
                'allows_null' => false,
                'default' => 'pending',
            ],

            [
                'name'  => 'remarks',
                'type'  => 'textarea',
                'label' => 'Remarks',
                'attributes' => [
                    'placeholder' => 'Enter any remarks'
                ]
            ],

        ]);
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // set columns from db columns.

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ChequeIssuanceRequest::class);
        CRUD::setFromDb(); // set fields from db columns.

        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
