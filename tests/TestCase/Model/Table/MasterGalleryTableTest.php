<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MasterGalleryTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MasterGalleryTable Test Case
 */
class MasterGalleryTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MasterGalleryTable
     */
    public $MasterGallery;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.master_gallery',
        'app.gallery_details'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MasterGallery') ? [] : ['className' => 'App\Model\Table\MasterGalleryTable'];
        $this->MasterGallery = TableRegistry::get('MasterGallery', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MasterGallery);

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
