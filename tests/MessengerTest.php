<?php
/**
 * Created by PhpStorm.
 * User: jakjr
 * Date: 08/07/15
 * Time: 15:00
 */

class MessengerTest extends TestCase
{
    /** @var \Jakjr\Messenger\Messenger messenger */
    protected $messenger;

    public function setUp()
    {
        parent::setUp();
        $this->messenger = app('messenger');
    }

    public function testHasFalse()
    {
        $this->assertFalse($this->messenger->has());
    }

    public function testHasTrue()
    {
        $this->messenger->set('Hello Word', 'success');
        $this->assertTrue($this->messenger->has());
    }

    public function testSetSuccess()
    {
        $this->messenger->set('Hello Word', 'success');

        $messages = $this->messenger->get();
        $firstMessage = current($messages);

        $this->assertContains('Hello Word', $firstMessage->display());
        $this->assertContains('success', $firstMessage->display());
    }

    public function testSetDanger()
    {
        $this->messenger->set('Hello Word', 'danger');

        $messages = $this->messenger->get();
        $firstMessage = current($messages);

        $this->assertContains('Hello Word', $firstMessage->display());
        $this->assertContains('danger', $firstMessage->display());
    }

    public function testMessengerFlash()
    {
        $this->messenger->set('Hello Word', 'success');
        $this->messenger->set('Hello Word Jakjr', 'danger');

        $this->messenger->get();

        $this->assertFalse($this->messenger->has());
    }

    public function testFacadeUse()
    {
        Messenger::set('Hello Word via Facade', 'warning');

        $messages = Messenger::get();
        $firstMessage = current($messages);

        $this->assertContains('Hello Word via Facade', $firstMessage->display());
        $this->assertContains('warning', $firstMessage->display());
    }

    public function testConfigLoad()
    {
        \Config::set('messenger.success-class', 'success');
        $this->assertEquals('success', \Config::get('messenger.success-class'));
    }

    public function testSuccessAlias()
    {
        $this->messenger->success('Hello Green Word');
        $messages = $this->messenger->get();
        $firstMessage = current($messages);

        $this->assertContains('Hello Green Word', $firstMessage->display());
        $this->assertContains('success', $firstMessage->display());
    }

    public function testErrorAlias()
    {
        Messenger::error('Hello Bad/Red World');
        $messages = $this->messenger->get();
        $firstMessage = current($messages);

        $this->assertContains('Hello Bad/Red World', $firstMessage->display());
        $this->assertContains('danger', $firstMessage->display());
    }

    public function testInfoAlias()
    {
        Messenger::info('Hello Info World');
        $messages = $this->messenger->get();
        $firstMessage = current($messages);

        $this->assertContains('Hello Info World', $firstMessage->display());
        $this->assertContains('info', $firstMessage->display());
    }

    public function testWarnAlias()
    {
        Messenger::warn('Hello Warn World');
        $messages = $this->messenger->get();
        $firstMessage = current($messages);

        $this->assertContains('Hello Warn World', $firstMessage->display());
        $this->assertContains('warning', $firstMessage->display());
    }

    public function testWrapper()
    {
        Config::set('messenger.wrapper', '<div>:message:</div>');

        $this->messenger->success('Hello wrapper');
        $messages = $this->messenger->get();
        $first = current($messages);

        $this->assertEquals('<div>Hello wrapper</div>', $first->display());
    }

    public function testWrapperClass()
    {
        Config::set('messenger.wrapper', '<p class=":status-class:">:message:</p>');
        Config::set('messenger.error-class', 'danger');

        $this->messenger->error('Hello wrapper and status-class');

        $messages = $this->messenger->get();
        $first = current($messages);

        $this->assertEquals('<p class="danger">Hello wrapper and status-class</p>', $first->display());
    }

    public function testGetReturningFalse()
    {
        $this->assertFalse($this->messenger->get());
    }

}