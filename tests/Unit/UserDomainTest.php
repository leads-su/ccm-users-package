<?php

namespace ConsulConfigManager\Users\Test\Unit;

use ConsulConfigManager\Users\UserDomain;
use ConsulConfigManager\Users\Test\TestCase;

/**
 * Class UserDomainTest
 *
 * @package ConsulConfigManager\Users\Test\Unit
 */
class UserDomainTest extends TestCase
{
    public function testMigrationsShouldRunByDefault(): void
    {
        $this->assertTrue(UserDomain::shouldRunMigrations());
    }

    public function testMigrationsPublishingCanBeDisabled(): void
    {
        UserDomain::ignoreMigrations();
        $this->assertFalse(UserDomain::shouldRunMigrations());
        UserDomain::registerMigrations();
    }

    public function testRoutesShouldNotBeRegisteredByDefault(): void
    {
        UserDomain::ignoreRoutes();
        $this->assertFalse(UserDomain::shouldRegisterRoutes());
        UserDomain::registerRoutes();
    }

    public function testRoutesRegistrationCanBeEnabled(): void
    {
        UserDomain::registerRoutes();
        $this->assertTrue(UserDomain::shouldRegisterRoutes());
        UserDomain::ignoreRoutes();
    }
}
