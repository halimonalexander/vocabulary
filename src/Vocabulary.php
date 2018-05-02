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

abstract class Vocabulary
{
    /**
     * @var array Array with translations. Must be used in childs.
     */
    protected $messages = [];
    
    /** @inheritdoc */
    final public function getText($module, $var, $context = 'default')
    {
        if (!isset($this->messages[$module]))
            throw new ModuleNotFound("Unable to load module {$module}");
          
        if (isset($this->messages[$module][$context][$var]))
            return $this->messages[$module][$context][$var];
        
        elseif (isset($this->messages[$module]['default'][$var]))
            return $this->messages[$module]['default'][$var];
        
        elseif (isset($this->messages[$module][$var]))
            return $this->messages[$module][$var];
        
        else
            throw new TextNotFound("Unable to translate {$module}::{$var}");
    }
  
    final public function getModuleTexts($module, $context = 'default'): array
    {
        $messages = $this->getMessages();
        
        if (!isset($messages[ $module ]))
            throw new ModuleNotFound("Unable to load module {$module}");
        
        if (isset($messages[ $module ][ $context ]))
            return $messages[ $module ][ $context ];
        
        elseif (isset($messages[ $module ]['default']))
            return $messages[ $module ]['default'];
        
        return $messages[ $module ];
    }

    protected function getMessages(): array
    {
        if ($this instanceof Vocabulary)
            return $this->messages;
          
        return array_merge(parent::getMessages(), $this->messages);
    }
}