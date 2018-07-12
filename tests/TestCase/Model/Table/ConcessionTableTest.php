<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConcessionTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConcessionTable Test Case
 */
class ConcessionTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ConcessionTable
     */
    public $Concession;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.concession',
        'app.registrations',
        'app.campuses',
        'app.users',
        'app.roles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Concession') ? [] : ['className' => 'App\Model\Table\ConcessionTable'];
        $this->Concession = TableRegistry::get('Concession', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Concession);

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
