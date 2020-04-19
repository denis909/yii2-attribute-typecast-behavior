<?php

namespace denis909\yii;

class AttributeTypecastBehavior extends \yii\behaviors\AttributeTypecastBehavior
{

    const TYPE_UNIX_TIMESTAMP = 'unix_timestamp';

    /**
     * {@inheritdoc}
     */
    protected function typecastValue($value, $type)
    {
        if (is_scalar($type) && ($type == static::TYPE_UNIX_TIMESTAMP))
        {
            return ($value && !is_numeric($value)) ? strtotime($value): $value;   
        }

        return parent::typecastValue($value, $type);
    }

}