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
   * Get the vocabulary for language
   *
   * @param string $lang Language as ISO-2 format.
   */
  static function getInstance($lang);
}