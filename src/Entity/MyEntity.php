<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 *
 * @UniqueEntity(fields="uniqueField", errorPath="uniqueField", message="This must be unique!")
 */
class MyEntity
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(unique=true, length=191, nullable=false)
     */
    protected $uniqueField;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getUniqueField(): string
    {
        return $this->uniqueField;
    }

    public function setUniqueField(string $uniqueField): self
    {
        $this->uniqueField = $uniqueField;

        return $this;
    }
}
