<?php

namespace WPSettingsKit\Builder\Decorator\TextField;

use WPSettingsKit\Attribute\FieldDecorator;
use WPSettingsKit\Builder\Decorator\AbstractFieldBuilderDecorator;

/**
 * Decorator for adding placeholder text to text fields.
 */
#[FieldDecorator(
    type: 'text',
    method: 'setPlaceholder',
    priority: 20
)]
class PlaceholderDecorator extends AbstractFieldBuilderDecorator
{
    /**
     * @var string Placeholder text
     */
    private string $placeholder;

    /**
     * Constructor.
     *
     * @param string $placeholder Placeholder text
     * @param int|null $priority Optional priority override
     */
    public function __construct(string $placeholder, ?int $priority = null)
    {
        parent::__construct($priority);
        $this->placeholder = $placeholder;
    }

    /**
     * {@inheritdoc}
     */
    protected function getConfigModifications(): array
    {
        return [
            'placeholder' => $this->placeholder,
            'attributes' => [
                'placeholder' => $this->placeholder
            ]
        ];
    }
}