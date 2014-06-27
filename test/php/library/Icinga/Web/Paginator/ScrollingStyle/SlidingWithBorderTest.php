<?php
// {{{ICINGA_LICENSE_HEADER}}}
// {{{ICINGA_LICENSE_HEADER}}}

namespace Tests\Icinga\Web\Paginator\ScrollingStyle;

// @codingStandardsIgnoreStart
require_once realpath(ICINGA_LIBDIR . '/Icinga/Web/Paginator/ScrollingStyle/SlidingWithBorder.php');
// @codingStandardsIgnoreEnd

use Mockery;
use Zend_Paginator;
use Icinga\Test\BaseTestCase;

class SlidingwithborderTest extends BaseTestCase
{
    public function testGetPages2()
    {
        $scrollingStyle = new \Icinga_Web_Paginator_ScrollingStyle_SlidingWithBorder();
        $paginator = new Zend_Paginator($this->getPaginatorAdapter());

        $pages = $scrollingStyle->getPages($paginator);
        $this->assertInternalType('array', $pages);
        $this->assertCount(13, $pages);
        $this->assertEquals('...', $pages[11]);
    }

    public function testGetPages3()
    {
        $scrollingStyle = new \Icinga_Web_Paginator_ScrollingStyle_SlidingWithBorder();
        $paginator = new Zend_Paginator($this->getPaginatorAdapter());
        $paginator->setCurrentPageNumber(9);

        $pages = $scrollingStyle->getPages($paginator);
        $this->assertInternalType('array', $pages);
        $this->assertCount(16, $pages);
        $this->assertEquals('...', $pages[3]);
        $this->assertEquals('...', $pages[14]);
    }

    protected function getPaginatorAdapter()
    {
        return Mockery::mock('\Zend_Paginator_Adapter_Interface')->shouldReceive('count')->andReturn(1000)->getMock();
    }
}
