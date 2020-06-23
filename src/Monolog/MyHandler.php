<?php

declare(strict_types=1);

namespace App\Monolog;

use Monolog\Handler\AbstractHandler;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MyHandler extends AbstractHandler
{
    public function __construct(
        // FIXME comment next line to make it work OR see config/packages/monolog.yaml
        ValidatorInterface $validator
    ) {
    }

    public function handle(array $record): bool
    {
        return false;
    }
}
