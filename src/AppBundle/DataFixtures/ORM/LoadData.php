<?php

namespace AppBundle\DataFixtures\ORM;

use Application\Sonata\MediaBundle\Entity\Media;
use Hautelook\AliceBundle\Alice\DataFixtureLoader;

class LoadData extends DataFixtureLoader
{
    protected function getFixtures()
    {
        return array(
            __DIR__.'/fixturesPost_uk.yml',
            __DIR__.'/fixturesCategory_uk.yml',
            __DIR__.'/fixturesEmployee_uk.yml',
        );
    }

    public function getMedia($name, $context = 'default')
    {
        $media = new Media();

        $media->setBinaryContent(__DIR__.'/../data/'.$name);
        $media->setContext($context);
        $media->setProviderName('sonata.media.provider.image');

        $this->container->get('sonata.media.manager.media')->save($media, $andFlush = true);

        return $media;
    }
}
