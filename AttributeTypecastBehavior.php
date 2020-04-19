<?php

namespace denis909\yii;

use Yii;
use DateTime;
use DateTimeZone;

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
            if ($value && !is_numeric($value))
            {
                return (new DateTime($value, new DateTimeZone(Yii::$app->formatter->timeZone)))->format('U');
            }

            return $value; 
        }

        return parent::typecastValue($value, $type);
    }

}