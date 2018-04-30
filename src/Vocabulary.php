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
        if (isset($this->messages[$module][$context][$var]))
            return $this->messages[$module][$context][$var];
        
        elseif (isset($this->messages[$module]['default'][$var]))
            return $this->messages[$module]['default'][$var];
        
        elseif (isset($this->messages[$module][$var]))
            return $this->messages[$module][$var];
        
        else
            throw new TextNotFound("Unable to translate {$module}::{$var}");
    }
}