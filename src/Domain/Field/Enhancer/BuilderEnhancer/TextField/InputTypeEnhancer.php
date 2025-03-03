<?php

namespace WPSettingsKit\Domain\Field\Enhancer\BuilderEnhancer\TextField;

use WPSettingsKit\Domain\Field\Enhancer\Attribute\FieldEnhancer;
use WPSettingsKit\Domain\Field\Enhancer\BuilderEnhancer\AbstractFieldBuilderEnhancer;

/**
 * Enhancer for setting input type on text fields.
 */
#[FieldEnhancer(
    type: 'text',
    method: 'setInputType',
    priority: 15
)]
class InputTypeEnhancer extends AbstractFieldBuilderEnhancer
{
    /**
     * @var string HTML input type
     */
    private string $inputType;

    /**
     * @var array<string> Valid input types
     */
    private array $validTypes = ['text', 'email', 'url', 'tel', 'password', 'number', 'search', 'date', 'time', 'datetime-local', 'month', 'week', 'color'];

    /**
     * Constructor.
     *
     * @param string $inputType HTML input type
     * @param int|null $priority Optional priority override
     */
    public function __construct(string $inputType, ?int $priority = null)
    {
        parent::__construct($priority);
        $this->inputType = in_array($inputType, $this->validTypes) ? $inputType : 'text';
    }

    /**
     * {@inheritdoc}
     */
    protected function getConfigModifications(): array
    {
        return [
            'input_type' => $this->inputType,
            'attributes' => [
                'type' => $this->inputType
            ]
        ];
    }
}