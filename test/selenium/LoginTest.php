<?php
/**
 * Selenium TestCase for login related tests
 *
 * @package    PhpMyAdmin-test
 * @subpackage Selenium
 */
declare(strict_types=1);

namespace PhpMyAdmin\Tests\Selenium;

/**
 * LoginTest class
 *
 * @package    PhpMyAdmin-test
 * @subpackage Selenium
 * @group      selenium
 */
class LoginTest extends TestBase
{
    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->logOutIfLoggedIn();
    }
    /**
     * Test for successful login
     *
     * @return void
     *
     * @group large
     */
    public function testSuccessfulLogin()
    {
        $this->login();
        $this->waitForElement('xpath', "//*[@id=\"serverinfo\"]");
        $this->assertTrue($this->isSuccessLogin());
        $this->logOutIfLoggedIn();
    }

    /**
     * Test for unsuccessful login
     *
     * @return void
     *
     * @group large
     */
    public function testLoginWithWrongPassword()
    {
        // With username as "Admin" and the password "Admin"
        $this->login("Admin", "Admin");
        $this->waitForElement('cssSelector', "div.error");
        $this->assertTrue($this->isUnsuccessLogin());
    }
}
