<?php

/*
 * This file is part of the zenstruck/foundry package.
 *
 * (c) Kevin Bond <kevinbond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zenstruck\Foundry\Tests\Fixture\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
#[ORM\MappedSuperclass]
#[MongoDB\MappedSuperclass]
abstract class Model2
{
    /** @var Collection<int,Model1> */
    protected Collection $models;
    #[ORM\Column]
    #[MongoDB\Field(type: 'string')]
    private string $prop1;

    public function __construct(string $prop1)
    {
        $this->prop1 = $prop1;
        $this->models = new ArrayCollection();
    }

    public function getProp1(): string
    {
        return $this->prop1;
    }

    /**
     * @return Collection<int,Model1>
     */
    public function getModels(): Collection
    {
        return $this->models;
    }

    public function addModel(Model1 $model): void
    {
        if (!$this->models->contains($model)) {
            $this->models->add($model);
            $model->setRelation($this);
        }
    }

    public function removeModel(Model1 $model): void
    {
        if ($this->models->removeElement($model)) {
            // set the owning side to null (unless already changed)
            if ($model->getRelation() === $this) {
                $model->setRelation(null);
            }
        }
    }
}