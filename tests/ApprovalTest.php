<?php

declare(strict_types=1);

namespace Tests;

use ApprovalTests\Approvals;
use PHPUnit\Framework\TestCase;

class ApprovalTest extends TestCase
{
    public function testTestFixture(): void
    {
        $argv[0] = 'texttest_fixture.php';
        $argv[1] = 31;

        ob_start();
        require_once __DIR__ . '/../fixtures/texttest_fixture.php';
        $output = ob_get_contents();
        ob_end_clean();

        Approvals::verifyString($output);
    }

    public function testTestFixtureWithMagic(): void
    {
        $argv[0] = 'texttest_fixture_with_magic.php';
        $argv[1] = 31;

        ob_start();
        require_once __DIR__ . '/../fixtures/texttest_fixture_with_magic.php';
        $output = ob_get_contents();
        ob_end_clean();

        Approvals::verifyString($output);
    }
}
