<?php

namespace denis909\yii;

class AttributeTypecastBehavior extends \yii\behaviors\AttributeTypecastBehavior
{

    const TYPE_UNIX_TIMESTAMP = 'unix_timestamp';

    public $typecastBeforeValidate = false;

    public $typecastAfterSetAttributes = false;

    /**
     * {@inheritdoc}
     */
    public function events()
    {
        $events = parent::events();

        if ($this->typecastBeforeValidate)
        {
            $events[Model::EVENT_BEFORE_VALIDATE] = 'beforeValidate';
        }

        if ($this->typecastAfterSetAttributes)
        {
            $events[Model::EVENT_AFTER_SET_ATTRIBUTES] = 'afterSetAttributes';
        }

        return $events;
    }

    /**
     * Handles owner 'beforeValidate' event, ensuring attribute typecasting.
     * @param \yii\base\Event $event event instance.
     */
    public function beforeValidate($event)
    {
        $this->typecastAttributes();
    }

    /**
     * Handles owner 'afterSetAttributes' event, ensuring attribute typecasting.
     * @param \yii\base\Event $event event instance.
     */
    public function afterSetAttributes($event)
    {
        $this->typecastAttributes();
    }

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