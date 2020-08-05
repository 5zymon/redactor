<?php

declare(strict_types=1);

namespace Bolt\Redactor;

use Bolt\Extension\BaseExtension;
use Symfony\Component\Filesystem\Filesystem;

class Extension extends BaseExtension
{
    public function getName(): string
    {
        return 'Bolt Extension to add the Redactor FieldType';
    }

    public function initialize(): void
    {
        $this->addTwigNamespace('redactor');
        $this->addWidget(new RedactorInjectorWidget());
    }

    public function install(): void
    {
        $projectDir = $this->getContainer()->getParameter('kernel.project_dir');
        $public = $this->getContainer()->getParameter('bolt.public_folder');

        $source = dirname(__DIR__) . '/assets/';
        $destination = $projectDir . '/' . $public . '/assets/';

        $filesystem = new Filesystem();
        $filesystem->mirror($source, $destination);
    }
}
