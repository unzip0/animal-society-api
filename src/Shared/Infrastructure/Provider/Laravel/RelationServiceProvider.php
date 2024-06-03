<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Provider\Laravel;

use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Models\Animals\Animal;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class RelationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->relations();
    }

    private function relations(): self
    {
        Relation::requireMorphMap();

        Relation::morphMap([
            Animal::MORPH_ALIAS => Animal::class,
        ]);

        return $this;
    }
}
