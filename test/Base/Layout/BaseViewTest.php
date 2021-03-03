<?php

declare(strict_types=1);

/**
 * @see       https://github.com/niceshops/nice-beans for the canonical source repository
 * @license   https://github.com/niceshops/nice-beans/blob/master/LICENSE BSD 3-Clause License
 */

namespace ParsTest\Mvc\View;

use Niceshops\Bean\Type\Base\AbstractBaseBean;
use Niceshops\Bean\Type\Base\BeanInterface;
use Pars\Component\Base\Layout\BaseLayout;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class DefaultTestCaseTest
 * @package Niceshops\Bean
 */
class BaseViewTest extends \Niceshops\Core\PHPUnit\DefaultTestCase
{


    /**
     * @var BaseLayout|MockObject
     */
    protected $object;


    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     */
    protected function setUp(): void
    {
        $this->object = $this->getMockBuilder(BaseLayout::class)->disableOriginalConstructor()->getMockForAbstractClass();
    }


    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }


    /**
     * @group integration
     * @small
     */
    public function testTestClassExists()
    {
        $this->assertTrue(class_exists(BaseLayout::class), "Class Exists");
        $this->assertTrue(is_a($this->object, BaseLayout::class), "Mock Object is set");
    }

    public function mockBean(): BeanInterface
    {
        return $this->getMockBuilder(AbstractBaseBean::class)->getMockForAbstractClass();
    }

    /**
     * @group integration
     * @small
     */
    public function testRenderSimple()
    {
        $bean = $this->mockBean();
        $bean->set('language', 'en');
        $bean->set('charset', 'utf-8');
        $bean->set('description', 'test');
        $bean->set('author', 'test');
        $bean->set('title', 'test');
        $bean->set('favicon', '/favicon.ico');
        $this->assertEquals('<html lang=\'en\'><head><meta charset=\'utf-8\'></meta><meta name=\'viewport\' content=\'width=device-width, initial-scale=1, shrink-to-fit=no\'></meta><meta name=\'description\' content=\'test\'></meta><meta name=\'author\' content=\'test\'></meta><title>test</title><link rel=\'shortcut icon\' href=\'favicon.ico}\'></link><link rel=\'stylesheet\' href=\'https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.bubble.css\' integrity=\'sha256-2hxHujXw890GumwDHPWrwJCtdZZdrJanlGsrOTSfXnc=\' crossorigin=\'anonymous\'></link></head><body><script src=\'https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js\' integrity=\'sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=\' crossorigin=\'anonymous\'></script><script src=\'https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js\' integrity=\'sha256-H4Qt7pVBp547bdul9EtvPU/m+XQ9EQTsYH7zFe5W9Gw=\' crossorigin=\'anonymous\'></script><script src=\'https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js\' integrity=\'sha256-XfzdiC+S1keia+s9l07y7ye5a874sBq67zK4u7LTjvk=\' crossorigin=\'anonymous\'></script><script src=\'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js\' integrity=\'sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s\' crossorigin=\'anonymous\'></script><script src=\'https://cdn.jsdelivr.net/npm/bs-custom-file-input@1.3.4/dist/bs-custom-file-input.min.js\' integrity=\'sha256-e0DUqNhsFAzOlhrWXnMOQwRoqrCRlofpWgyhnrIIaPo=\' crossorigin=\'anonymous\'></script><script src=\'https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js\' integrity=\'sha256-xnX1c4jTWYY3xOD5/hVL1h37HCCGJx+USguyubBZsHQ=\' crossorigin=\'anonymous\'></script></body></html>', $this->object->render($bean));
    }
}
