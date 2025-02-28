<?php

namespace WPSettingsKit\Builder\Decorator\CheckboxField;

use WPSettingsKit\Attribute\FieldDecorator;
use WPSettingsKit\Builder\Decorator\AbstractFieldBuilderDecorator;

/**
 * Decorator for setting the unchecked value of a checkbox field.
 */
#[FieldDecorator(
    type: 'checkbox',
    method: 'setUncheckedValue',
    priority: 15
)]
class UncheckedValueDecorator extends AbstractFieldBuilderDecorator
{
    /**
     * @var mixed Value when checkbox is unchecked
     */
    private mixed $uncheckedValue;

    /**
     * Constructor.
     *
     * @param mixed $uncheckedValue Value when checkbox is unchecked
     * @param int|null $priority Optional priority override
     */
    public function __construct(mixed $uncheckedValue, ?int $priority = null)
    {
        parent::__construct($priority);
        $this->uncheckedValue = $uncheckedValue;
    }

    /**
     * {@inheritdoc}
     */
    protected function getConfigModifications(): array
    {
        return [
            'unchecked_value' => $this->uncheckedValue,
        ];
    }
}