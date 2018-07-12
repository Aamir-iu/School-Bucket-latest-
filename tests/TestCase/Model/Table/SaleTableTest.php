<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SaleTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SaleTable Test Case
 */
class SaleTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SaleTable
     */
    public $Sale;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sale',
        'app.customers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Sale') ? [] : ['className' => 'App\Model\Table\SaleTable'];
        $this->Sale = TableRegistry::get('Sale', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Sale);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
