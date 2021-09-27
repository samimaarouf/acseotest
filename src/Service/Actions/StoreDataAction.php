<?php

namespace App\Service\Actions;

use Symfony\Component\Filesystem\Filesystem;

class StoreDataAction extends ActionBase
{
    public function run(): void
    {
        $filesystem = new Filesystem();
        $filesystem->dumpFile('../listDemands/Demande ' . $this->question->getId() . '.json ', $this->data);
    }
}
