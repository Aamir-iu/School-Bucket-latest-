<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SmsLogTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SmsLogTable Test Case
 */
class SmsLogTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SmsLogTable
     */
    public $SmsLog;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sms_log',
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
        $config = TableRegistry::exists('SmsLog') ? [] : ['className' => 'App\Model\Table\SmsLogTable'];
        $this->SmsLog = TableRegistry::get('SmsLog', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SmsLog);

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
