<?php

namespace HalimonAlexander\Vocabulary;

use HalimonAlexander\Vocabulary\Exception\InvalidSourceType;

class Source
{
  private $type;
  private $storage;

  /**
   * @param string $sourceType
   * @return $this
   * @see \HalimonAlexander\Vocabulary\Sids\SourceTypes
   */
  function check(string $sourceType)
  {
    if (!defined('\HalimonAlexander\Vocabulary\Sids\SourceTypes::'.strtoupper($sourceType)))
      throw new InvalidSourceType('Unable to use '.$sourceType);
    
    $this->type = $sourceType;
    
    return $this;
  }
  
  function load($source): Bag
  {
    if (empty($this->type))
      throw new InvalidSourceType('Source type is not set');
    $this->storage = Storage::Factory($this->type);
    return $this->storage->load($source);
  }
}