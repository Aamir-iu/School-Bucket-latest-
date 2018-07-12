<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DuesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DuesTable Test Case
 */
class DuesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DuesTable
     */
    public $Dues;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.dues',
        'app.registrations',
        'app.classes',
        'app.shifts',
        'app.sessions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Dues') ? [] : ['className' => 'App\Model\Table\DuesTable'];
        $this->Dues = TableRegistry::get('Dues', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Dues);

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
