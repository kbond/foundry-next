<?php

/*
 * This file is part of the zenstruck/foundry package.
 *
 * (c) Kevin Bond <kevinbond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zenstruck\Foundry\Tests\Fixture\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zenstruck\Foundry\Tests\Fixture\Model\Relation;
use Zenstruck\Foundry\Tests\Fixture\Model\StandardModel;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
#[ORM\Entity]
class StandardEntity extends StandardModel
{
    #[ORM\ManyToOne(targetEntity: StandardRelationEntity::class, inversedBy: 'models')]
    protected ?Relation $relation = null;
}
