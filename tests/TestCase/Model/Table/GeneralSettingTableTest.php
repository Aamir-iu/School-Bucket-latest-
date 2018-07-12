<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GeneralSettingTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GeneralSettingTable Test Case
 */
class GeneralSettingTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GeneralSettingTable
     */
    public $GeneralSetting;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.general_setting'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('GeneralSetting') ? [] : ['className' => 'App\Model\Table\GeneralSettingTable'];
        $this->GeneralSetting = TableRegistry::get('GeneralSetting', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GeneralSetting);

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
