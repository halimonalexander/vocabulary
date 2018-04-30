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

abstract class Vocabulary
{
  /**
   * Instance of the class.
   */
  static $instance;

  /**
   * @var array Array with translations. Must be used in childs.
   */
  protected $messages = [];
  
  public function __construct($lang)
  {
    $this->loadMessages($lang);
  }
  
  protected function loadMessages($lang)
  {
    $class = "\\".$this->getCoreNamaspace()."\\Vocabulary\\$lang";
    if (class_exists($class)) {
      $this->messages = array_merge($this->messages, $class::$messages);
    }
  }
  
  protected function getCoreNamaspace()
  {
    $tmp = explode('\\', get_called_class());

    return $tmp[0];
  }
  
  /**
   * Get the translation of the phrase.
   *
   * @param string $var Variable to translate.
   * @param string $module Module to search in.
   * @param string $context Context of the translation, if there are several of them.
   * @return string
   */
  public function getTitle($var, $module, $context = 'default')
  {
    if ( isset($this->messages[$module][$context][$var]) )
      return $this->messages[$module][$context][$var];
    elseif ( isset($this->messages[$module]['default'][$var]) )
      return $this->messages[$module]['default'][$var];
    elseif ( isset($this->messages[$module][$var]) )
      return $this->messages[$module][$var];
    else
      return ucfirst( strtolower($var) );
  }
}