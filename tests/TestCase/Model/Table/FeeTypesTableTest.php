<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FeeTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FeeTypesTable Test Case
 */
class FeeTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FeeTypesTable
     */
    public $FeeTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.fee_types',
        'app.concession',
        'app.registration',
        'app.students_master_details',
        'app.registration',
        'app.classes_sections',
        'app.users',
        'app.roles',
        'app.campuses',
        'app.shift',
        'app.campuses',
        'app.dues',
        'app.registrations',
        'app.shifts',
        'app.sessions',
        'app.months',
        'app.fee_types',
        'app.fee_heads',
        'app.fees',
        'app.session',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('FeeTypes') ? [] : ['className' => 'App\Model\Table\FeeTypesTable'];
        $this->FeeTypes = TableRegistry::get('FeeTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FeeTypes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
