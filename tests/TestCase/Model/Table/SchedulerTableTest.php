<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SchedulerTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SchedulerTable Test Case
 */
class SchedulerTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SchedulerTable
     */
    public $Scheduler;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.scheduler'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Scheduler') ? [] : ['className' => 'App\Model\Table\SchedulerTable'];
        $this->Scheduler = TableRegistry::get('Scheduler', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Scheduler);

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
