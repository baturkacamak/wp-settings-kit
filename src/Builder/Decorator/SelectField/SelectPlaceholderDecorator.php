<?php

namespace WPSettingsKit\Builder\Decorator\SelectField;

use WPSettingsKit\Attribute\FieldDecorator;
use WPSettingsKit\Builder\Decorator\AbstractFieldBuilderDecorator;

/**
 * Decorator for adding a placeholder option to select fields.
 */
#[FieldDecorator(
    type: 'select',
    method: 'setPlaceholder',
    priority: 5
)]
class SelectPlaceholderDecorator extends AbstractFieldBuilderDecorator
{
    /**
     * @var string Placeholder text
     */
    private string $placeholder;

    /**
     * @var bool Whether the placeholder option is disabled
     */
    private bool $disabled;

    /**
     * @var string|null Value for the placeholder option (default: '')
     */
    private ?string $value;

    /**
     * Constructor.
     *
     * @param string $placeholder Placeholder text
     * @param bool $disabled Whether the placeholder option is disabled
     * @param string|null $value Value for the placeholder option (default: '')
     * @param int|null $priority Optional priority override
     */
    public function __construct(
        string $placeholder,
        bool $disabled = true,
        ?string $value = '',
        ?int $priority = null
    ) {
        parent::__construct($priority);
        $this->placeholder = $placeholder;
        $this->disabled = $disabled;
        $this->value = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function applyToConfig(array $config): array
    {
        $config['placeholder'] = $this->placeholder;
        $config['placeholder_disabled'] = $this->disabled;

        // Initialize options array if it doesn't exist
        if (!isset($config['options'])) {
            $config['options'] = [];
        }

        // Add the placeholder as the first option
        $options = [
            $this->value => $this->placeholder
        ];

        // Merge with existing options, keeping placeholder first
        $config['options'] = $options + $config['options'];

        // Add placeholder attributes if needed
        if ($this->disabled) {
            $config['placeholder_attributes'] = [
                'disabled' => 'disabled',
                'selected' => !isset($config['value']) || $config['value'] === $this->value
            ];
        }

        return $config;
    }

    /**
     * {@inheritdoc}
     */
    protected function getConfigModifications(): array
    {
        // This is not used in the SelectPlaceholderDecorator since it requires
        // custom handling in applyToConfig
        return [];
    }
}