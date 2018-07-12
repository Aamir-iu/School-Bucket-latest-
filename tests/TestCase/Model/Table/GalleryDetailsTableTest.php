<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GalleryDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GalleryDetailsTable Test Case
 */
class GalleryDetailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GalleryDetailsTable
     */
    public $GalleryDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.gallery_details',
        'app.master_galleries'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('GalleryDetails') ? [] : ['className' => 'App\Model\Table\GalleryDetailsTable'];
        $this->GalleryDetails = TableRegistry::get('GalleryDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GalleryDetails);

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
