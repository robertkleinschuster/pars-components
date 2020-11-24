<?php

namespace Pars\Component\Base\Form;

use Pars\Component\Base\BackgroundAwareInterface;
use Pars\Component\Base\BackgroundAwareTrait;
use Pars\Component\Base\BorderAwareInterface;
use Pars\Component\Base\BorderAwareTrait;
use Pars\Component\Base\ColorAwareInterface;
use Pars\Component\Base\ColorAwareTrait;
use Pars\Mvc\View\AbstractField;

class Input extends AbstractField implements BackgroundAwareInterface, ColorAwareInterface, BorderAwareInterface
{
    use BackgroundAwareTrait;
    use ColorAwareTrait;
    use BorderAwareTrait;

    public const TYPE_BUTTON = 'button';
    public const TYPE_CHECKBOX = 'checkbox';
    public const TYPE_COLOR = 'color';
    public const TYPE_DATE = 'date';
    public const TYPE_DATETIME_LOCAL = 'datetime-local';
    public const TYPE_EMAIL = 'email';
    public const TYPE_FILE = 'file';
    public const TYPE_HIDDEN = 'hidden';
    public const TYPE_IMAGE = 'image';
    public const TYPE_MONTH = 'month';
    public const TYPE_NUMBER = 'number';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_RADIO = 'radio';
    public const TYPE_RANGE = 'range';
    public const TYPE_RESET = 'reset';
    public const TYPE_SEARCH = 'search';
    public const TYPE_SUBMIT = 'submit';
    public const TYPE_TEL = 'tel';
    public const TYPE_TEXT = 'text';
    public const TYPE_TIME = 'time';
    public const TYPE_URL = 'url';
    public const TYPE_WEEK = 'week';

    public const AUTOCOMPLETE_OFF = 'off';
    public const AUTOCOMPLETE_ON = 'on';
    public const AUTOCOMPLETE_NAME = 'name';
    public const AUTOCOMPLETE_HONORIFIC_PREFIX = 'honorific-prefix';
    public const AUTOCOMPLETE_GIVEN_NAME = 'given-name';
    public const AUTOCOMPLETE_ADDITIONAL_NAME = 'additional-name';
    public const AUTOCOMPLETE_FAMILY_NAME = 'family-name';
    public const AUTOCOMPLETE_HONORIFIC_SUFFIX = 'honorific-suffix';
    public const AUTOCOMPLETE_NICKNAME = 'nickname';
    public const AUTOCOMPLETE_EMAIL = 'email';
    public const AUTOCOMPLETE_USERNAME = 'username';
    public const AUTOCOMPLETE_NEW_PASSWORD = 'new-password';
    public const AUTOCOMPLETE_CURRENT_PASSWORD = 'current-password';
    public const AUTOCOMPLETE_ONE_TIME_CODE = 'one-time-code';
    public const AUTOCOMPLETE_ORGANIZATION_TITLE = 'organization-title';
    public const AUTOCOMPLETE_ORGANIZATION = 'organization';
    public const AUTOCOMPLETE_STREET_ADDRESS = 'street-address';
    public const AUTOCOMPLETE_ADDRESS_LINE1 = 'address-line1';
    public const AUTOCOMPLETE_ADDRESS_LINE2 = 'address-line2';
    public const AUTOCOMPLETE_ADDRESS_LINE3 = 'address-line3';
    public const AUTOCOMPLETE_ADDRESS_LEVEL4 = 'address-level4';
    public const AUTOCOMPLETE_ADDRESS_LEVEL3 = 'address-level3';
    public const AUTOCOMPLETE_ADDRESS_LEVEL2 = 'address-level2';
    public const AUTOCOMPLETE_ADDRESS_LEVEL1 = 'address-level1';
    public const AUTOCOMPLETE_COUNTRY = 'country';
    public const AUTOCOMPLETE_COUNTRY_NAME = 'country-name';
    public const AUTOCOMPLETE_POSTAL_CODE = 'postal-code';
    public const AUTOCOMPLETE_CREDIT_CARD_NAME = 'cc-name';
    public const AUTOCOMPLETE_CREDIT_CARD_GIVEN_NAME = 'cc-given-name';
    public const AUTOCOMPLETE_CREDIT_CARD_ADDITIONAL_NAME = 'cc-additional-name';
    public const AUTOCOMPLETE_CREDIT_CARD_FAMILY_NAME = 'cc-family-name';
    public const AUTOCOMPLETE_CREDIT_CARD_NUMBER = 'cc-number';
    public const AUTOCOMPLETE_CREDIT_CARD_EXP = 'cc-exp';
    public const AUTOCOMPLETE_CREDIT_CARD_EXP_MONTH = 'cc-exp-month';
    public const AUTOCOMPLETE_CREDIT_CARD_EXP_YEAR = 'cc-exp-year';
    public const AUTOCOMPLETE_CREDIT_CARD_CSC = 'cc-csc';
    public const AUTOCOMPLETE_CREDIT_CARD_TYPE = 'cc-type';
    public const AUTOCOMPLETE_TRANSACTION_CURRENCY = 'transaction-currency';
    public const AUTOCOMPLETE_TRANSACTION_AMOUNT = 'transaction-amount';
    public const AUTOCOMPLETE_LANGUAGE = 'language';
    public const AUTOCOMPLETE_BIRTHDAY = 'bday';
    public const AUTOCOMPLETE_BIRTHDAY_DAY = 'bday-day';
    public const AUTOCOMPLETE_BIRTHDAY_MONTH = 'bday-month';
    public const AUTOCOMPLETE_BIRTHDAY_YEAR = 'bday-year';
    public const AUTOCOMPLETE_SEX = 'sex';
    public const AUTOCOMPLETE_TEL = 'tel';
    public const AUTOCOMPLETE_TEL_COUNTRY_CODE = 'tel-country-code';
    public const AUTOCOMPLETE_TEL_NATIONAL = 'tel-national';
    public const AUTOCOMPLETE_TEL_AREA_CODE = 'tel-area-code';
    public const AUTOCOMPLETE_TEL_LOCAL = 'tel-local';
    public const AUTOCOMPLETE_TEL_EXTENSION = 'tel-extension';
    public const AUTOCOMPLETE_IMPP = 'impp';
    public const AUTOCOMPLETE_URL = 'url';
    public const AUTOCOMPLETE_PHOTO = 'photo';


    public ?string $type = null;
    public ?string $name = null;
    public ?string $autocomplete = null;
    public ?string $placeholder = null;
    public ?string $value = null;
    public bool $required = false;
    public bool $disabled = false;

    /**
     * Input constructor.
     * @param string|null $type
     */
    public function __construct(?string $type = null)
    {
        parent::__construct();
        $this->type = $type;
    }

    protected function initialize()
    {
        $this->setTag('input');
        $this->addOption('form-control');
        if ($this->hasType()) {
            $this->setAttribute('type', $this->getType());
            if (in_array($this->getType(), [self::TYPE_RADIO, self::TYPE_CHECKBOX])) {
                $this->removeOption('form-control');
            }
        }
        if ($this->hasName()) {
            $this->setAttribute('name', $this->getName());
            if (!$this->hasId()) {
                $this->setId($this->getName());
            }
        }
        if ($this->hasAutocomplete()) {
            $this->setAttribute('autocomplete', $this->getAutocomplete());
        }
        if ($this->hasValue()) {
            $this->setAttribute('value', $this->getValue());
        }
        if ($this->hasPlaceholder()) {
            $this->setAttribute('placeholder', $this->getPlaceholder());
        }
        if ($this->isRequired()) {
            $this->setAttribute('required', 'required');
        }
        if ($this->isDisabled()) {
            $this->setAttribute('disabled', 'disabled');
        }
        if ($this->hasColor()) {
            $this->addOption($this->getColor());
        }
        if ($this->hasBackground()) {
            $this->addOption($this->getBackground());
        }
        if ($this->hasBorder()) {
            $this->addOption('border');
            $this->addOption($this->getBorder());
        }
        if ($this->hasRounded()) {
            $this->addOption($this->getRounded());
        }
        if ($this->hasBorderPosition()) {
            $this->addOption($this->getBorderPosition());
        }
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasType(): bool
    {
        return isset($this->type);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasName(): bool
    {
        return isset($this->name);
    }

    /**
     * @return string
     */
    public function getAutocomplete(): string
    {
        return $this->autocomplete;
    }

    /**
     * @param string $autocomplete
     *
     * @return $this
     */
    public function setAutocomplete(string $autocomplete): self
    {
        $this->autocomplete = $autocomplete;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasAutocomplete(): bool
    {
        return isset($this->autocomplete);
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * @param bool $required
     */
    public function setRequired(bool $required): void
    {
        $this->required = $required;
    }

    /**
     * @return bool
     */
    public function isDisabled(): bool
    {
        return $this->disabled;
    }

    /**
     * @param bool $disabled
     * @return Input
     */
    public function setDisabled(bool $disabled): self
    {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlaceholder(): string
    {
        return $this->placeholder;
    }

    /**
     * @param string $placeholder
     *
     * @return $this
     */
    public function setPlaceholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasPlaceholder(): bool
    {
        return isset($this->placeholder);
    }

    /**
    * @return string
    */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
    * @param string $value
    *
    * @return $this
    */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
    * @return bool
    */
    public function hasValue(): bool
    {
        return isset($this->value);
    }


}
