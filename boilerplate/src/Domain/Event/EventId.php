<?php

declare(strict_types=1);

namespace App\Domain\Event;

use App\Domain\Shared\ValueObject\Uuid;

class EventId extends Uuid
{
    public static function generate(): self
    {
        return new self(parent::generate());
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }
} 