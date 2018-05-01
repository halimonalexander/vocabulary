<?php
namespace HalimonAlexander\Vocabulary;

use HalimonAlexander\Vocabulary\Exception\InvalidArgumentException;

class Bag
{
  /**
   * @var array Array with translations.
   */
  protected $data;

  function get($domain, $sid, $context)
  {
    if (isset($this->data[$domain][$context][$sid]))
      return $this->data[$domain][$context][$sid];

    elseif (isset($this->data[$domain]['default'][$sid]))
      return $this->data[$domain]['default'][$sid];

    elseif (isset($this->data[$domain][$sid]))
      return $this->data[$domain][$sid];

    elseif (isset($this->data[$sid]))
      return $this->data[$sid];
    
    else
      throw new InvalidArgumentException('Sid '.$sid.' not set');
  }

  function set($data)
  {
    $this->data = $data;
  }

  function load()
  {

  }

  function __toString()
  {
    return json_encode($this->data);
  }
}