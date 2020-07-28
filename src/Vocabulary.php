<?php
/*
 * This file is part of Vocabulary.
 *
 * (c) Halimon Alexander <vvthanatos@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace HalimonAlexander\Vocabulary;

use HalimonAlexander\Vocabulary\Exceptions\ModuleNotFound;
use HalimonAlexander\Vocabulary\Exceptions\TextNotFound;
use HalimonAlexander\Vocabulary\Interfaces\VocabularyInterface;

abstract class Vocabulary implements VocabularyInterface
{
    /**
     * @var array Array with translations. Must be used in childs.
     */
    protected $messages = [];
    
    /**
     * @inheritdoc
     * @throws ModuleNotFound
     * @throws TextNotFound
     */
    final public function getText(string $module, string $var, string $context = 'default'): string
    {
        $texts = $this->getModuleTexts($module, $context);
          
        if (array_key_exists($var, $texts)) {
            return $texts[$var];
        }
        
        throw new TextNotFound("Unable to translate {$module}::{$var}");
    }
    
    /**
     * @inheritdoc
     * @throws ModuleNotFound
     */
    final public function getModuleTexts(string $module, string $context = 'default'): array
    {
        $this->checkModuleExistence($module);
    
        if (array_key_exists($context, $this->messages[$module])) {
            return $this->messages[$module][$context];
        }
    
        if (array_key_exists('default', $this->messages[$module])) {
            return $this->messages[$module]['default'];
        }
    
        return $this->messages[$module];
    }
    
    private function checkModuleExistence(string $module): void
    {
        if (!array_key_exists($module, $this->messages)) {
            throw new ModuleNotFound("Unable to load module `{$module}`");
        }
    }
}
