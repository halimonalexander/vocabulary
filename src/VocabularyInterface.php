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

interface VocabularyInterface
{
    /**
     * Get the translation of the phrase.
     *
     * @param string $module   Module to search in.
     * @param string $var      Variable to translate.
     * @param string $context  Context of the translation, if there are several of them.
     * 
     * @return string
     */
    public function getText($module, $var, $context = 'default'): string;
}