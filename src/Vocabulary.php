<?
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

use HalimonAlexander\Vocabulary\Exception\InvalidArgumentException;
use HalimonAlexander\Vocabulary\Exception\InvalidSourceType;

/**
 * Class Vocabulary
 */
class Vocabulary
{
  /**
   * @var Bag
   */
  public $bag;

  /**
   * Get the translation of the phrase.
   *
   * @param string $sid Variable to translate.
   * @param string $domain Domain filter to search in.
   * @param string $context Context of the translation, if there are several of them.
   * @return string
   */
  function getText($sid, $domain = '', $context = 'default')
  {
    try {
      $text = $this->bag->get($domain, $sid, $context);
    }catch(InvalidArgumentException $e){
      $text = ucfirst(strtolower($sid));
    }

    return $text;
  }

  /**
   *
   */
  function load(string $source, string $sourceType)
  {
    $this->bag = (new Source())->check($sourceType)->load($source);
  }
}