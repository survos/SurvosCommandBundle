<?php

namespace Symfony\Config;

use Symfony\Component\Config\Loader\ParamConfigurator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * This class is automatically generated to help in creating a config.
 */
class SurvosCommandConfig implements \Symfony\Component\Config\Builder\ConfigBuilderInterface
{
    private $baseLayout;
    private $subdomainVariable;
    private $namespaces;
    private $_usedProperties = [];

    /**
     * @default 'base.html.twig'
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function baseLayout($value): static
    {
        $this->_usedProperties['baseLayout'] = true;
        $this->baseLayout = $value;

        return $this;
    }

    /**
     * @default 'subdomain'
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function subdomainVariable($value): static
    {
        $this->_usedProperties['subdomainVariable'] = true;
        $this->subdomainVariable = $value;

        return $this;
    }

    /**
     * @param ParamConfigurator|list<ParamConfigurator|mixed> $value
     *
     * @return $this
     */
    public function namespaces(ParamConfigurator|array $value): static
    {
        $this->_usedProperties['namespaces'] = true;
        $this->namespaces = $value;

        return $this;
    }

    public function getExtensionAlias(): string
    {
        return 'survos_command';
    }

    public function __construct(array $value = [])
    {
        if (array_key_exists('base_layout', $value)) {
            $this->_usedProperties['baseLayout'] = true;
            $this->baseLayout = $value['base_layout'];
            unset($value['base_layout']);
        }

        if (array_key_exists('subdomain_variable', $value)) {
            $this->_usedProperties['subdomainVariable'] = true;
            $this->subdomainVariable = $value['subdomain_variable'];
            unset($value['subdomain_variable']);
        }

        if (array_key_exists('namespaces', $value)) {
            $this->_usedProperties['namespaces'] = true;
            $this->namespaces = $value['namespaces'];
            unset($value['namespaces']);
        }

        if ([] !== $value) {
            throw new InvalidConfigurationException(sprintf('The following keys are not supported by "%s": ', __CLASS__).implode(', ', array_keys($value)));
        }
    }

    public function toArray(): array
    {
        $output = [];
        if (isset($this->_usedProperties['baseLayout'])) {
            $output['base_layout'] = $this->baseLayout;
        }
        if (isset($this->_usedProperties['subdomainVariable'])) {
            $output['subdomain_variable'] = $this->subdomainVariable;
        }
        if (isset($this->_usedProperties['namespaces'])) {
            $output['namespaces'] = $this->namespaces;
        }

        return $output;
    }

}
