<?php

declare(strict_types=1);

namespace App\Domain\Shared;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

abstract class AggregateRoot
{
    private Collection $domainEvents;

    protected function __construct()
    {
        $this->domainEvents = new ArrayCollection();
    }

    protected function recordDomainEvent(DomainEvent $domainEvent): void
    {
        $this->domainEvents->add($domainEvent);
    }

    public function pullDomainEvents(): array
    {
        $domainEvents = $this->domainEvents->toArray();
        $this->domainEvents->clear();

        return $domainEvents;
    }

    public function getDomainEvents(): Collection
    {
        return $this->domainEvents;
    }
} 