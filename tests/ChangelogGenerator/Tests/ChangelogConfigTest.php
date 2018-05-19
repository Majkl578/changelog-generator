<?php

declare(strict_types=1);

namespace ChangelogGenerator\Tests;

use ChangelogGenerator\ChangelogConfig;
use PHPUnit\Framework\TestCase;

final class ChangelogConfigTest extends TestCase
{
    /** @var string */
    private $user;

    /** @var string */
    private $repository;

    /** @var string */
    private $milestone;

    /** @var string[] */
    private $labels = [];

    /** @var ChangelogConfig */
    private $changelogConfig;

    public function testGetSetUser() : void
    {
        self::assertEquals($this->user, $this->changelogConfig->getUser());

        $this->changelogConfig->setUser('romanb');

        self::assertEquals('romanb', $this->changelogConfig->getUser());
    }

    public function testGetSetRepository() : void
    {
        self::assertEquals($this->repository, $this->changelogConfig->getRepository());

        $this->changelogConfig->setRepository('purl');

        self::assertEquals('purl', $this->changelogConfig->getRepository());
    }

    public function testGetSetMilestone() : void
    {
        self::assertEquals($this->milestone, $this->changelogConfig->getMilestone());

        $this->changelogConfig->setMilestone('1.0');

        self::assertEquals('1.0', $this->changelogConfig->getMilestone());
    }

    public function testGetSetLabels() : void
    {
        self::assertEquals($this->labels, $this->changelogConfig->getLabels());

        $this->changelogConfig->setLabels(['Improvement']);

        self::assertEquals(['Improvement'], $this->changelogConfig->getLabels());
    }

    public function testGetMilestoneIssuesUrl() : void
    {
        self::assertEquals('https://api.github.com/search/issues?q=milestone%3A%221.0%22+repo%3Ajwage%2Fchangelog-generator+state%3Aclosed+label%3AEnhancement', $this->changelogConfig->getMilestoneIssuesUrl('Enhancement'));
    }

    public function testGetMilestoneIssuesUrlNoLabel() : void
    {
        self::assertEquals('https://api.github.com/search/issues?q=milestone%3A%221.0%22+repo%3Ajwage%2Fchangelog-generator+state%3Aclosed', $this->changelogConfig->getMilestoneIssuesUrl(''));
    }

    protected function setUp() : void
    {
        $this->user       = 'jwage';
        $this->repository = 'changelog-generator';
        $this->milestone  = '1.0';
        $this->labels     = ['Enhancement', 'Bug'];

        $this->changelogConfig = new ChangelogConfig(
            $this->user,
            $this->repository,
            $this->milestone,
            $this->labels
        );
    }
}