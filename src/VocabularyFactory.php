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

use HalimonAlexander\Vocabulary\Exceptions\UnknownVocabulary;

class VocabularyFactory
{
    private $baseNamespace;
    
    public function __construct($baseNamespace)
    {
        $this->baseNamespace = $baseNamespace;
    }
    
    public function create(string $vocabulary): Vocabulary
    {
        $classname = $this->baseNamespace . $vocabulary;
        
        if (!class_exists($classname)) {
            throw new UnknownVocabulary('Vocabulary not found');
        }
        
        return new $classname();
    }
}
