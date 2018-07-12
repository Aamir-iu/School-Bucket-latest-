<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FeeHeadsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FeeHeadsTable Test Case
 */
class FeeHeadsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FeeHeadsTable
     */
    public $FeeHeads;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.fee_heads',
        'app.classes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('FeeHeads') ? [] : ['className' => 'App\Model\Table\FeeHeadsTable'];
        $this->FeeHeads = TableRegistry::get('FeeHeads', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FeeHeads);

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
