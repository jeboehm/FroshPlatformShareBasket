<?php
declare(strict_types=1);

namespace Frosh\ShareBasket\Core\Content\ShareBasket\Aggregate\ShareBasketLineItem;

use Frosh\ShareBasket\Core\Content\ShareBasket\ShareBasketDefinition;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\CustomFields;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IntField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\JsonField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class ShareBasketLineItemDefinition extends EntityDefinition
{
    final public const ENTITY_NAME = 'frosh_share_basket_line_item';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getCollectionClass(): string
    {
        return ShareBasketLineItemCollection::class;
    }

    public function getEntityClass(): string
    {
        return ShareBasketLineItemEntity::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new PrimaryKey(), new Required()),
            (new FkField('share_basket_id', 'shareBasketId', ShareBasketDefinition::class))->addFlags(new Required()),
            (new StringField('identifier', 'identifier'))->addFlags(new Required()),
            new IntField('quantity', 'quantity'),
            (new StringField('type', 'type'))->addFlags(new Required()),
            new JsonField('payload', 'payload'),
            new CustomFields(),
            new BoolField('stackable', 'stackable'),
            new BoolField('removable', 'removable'),
            (new StringField('line_item_identifier', 'lineItemIdentifier'))->addFlags(new Required()),
            new ManyToOneAssociationField('shareBasket', 'share_basket_id', ShareBasketDefinition::class, 'id'),
            new OneToOneAssociationField('product', 'identifier', 'product_number', ProductDefinition::class),
        ]);
    }
}
