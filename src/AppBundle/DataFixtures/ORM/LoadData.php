<?php
namespace AppBundle\DataFixtures\ORM;

use Hautelook\AliceBundle\Alice\DataFixtureLoader;

class LoadData extends DataFixtureLoader
{
    protected function getFixtures()
    {
        return array(
            __DIR__.'/fixturesEmployee.yml',
            __DIR__.'/fixturesCategory.yml',
        );
    }
}
