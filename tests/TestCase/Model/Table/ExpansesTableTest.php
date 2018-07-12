<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExpansesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExpansesTable Test Case
 */
class ExpansesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ExpansesTable
     */
    public $Expanses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.expanses',
        'app.transaction_accounts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Expanses') ? [] : ['className' => 'App\Model\Table\ExpansesTable'];
        $this->Expanses = TableRegistry::get('Expanses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Expanses);

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
