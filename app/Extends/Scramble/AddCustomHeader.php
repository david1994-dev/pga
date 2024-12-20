<?php

namespace App\Extends\Scramble;

use Dedoc\Scramble\Support\RouteInfo;
use Dedoc\Scramble\Support\Generator\Schema;
use Dedoc\Scramble\Support\Generator\Operation;
use Dedoc\Scramble\Support\Generator\Parameter;
use Dedoc\Scramble\Extensions\OperationExtension;
use Dedoc\Scramble\Support\Generator\Types\StringType;

class AddCustomHeader  extends OperationExtension
{
    public function handle(Operation $operation, RouteInfo $routeInfo)
    {
        $operation->addParameters([
            Parameter::make('Authorization', 'header')
                ->setSchema(
                    Schema::fromType(new StringType())
                )
                ->required(true)
                ->example("Bearer {token}")
        ]);
    }
}
