<?php

namespace HalimonAlexander\Vocabulary;

use HalimonAlexander\Vocabulary\Exception\AccessForbidden;
use HalimonAlexander\Vocabulary\Exception\InvalidSourceType;
use HalimonAlexander\Vocabulary\Sids\SourceTypes;

class Storage
{
  function __construct()
  {
    throw new AccessForbidden('Use Storage::Factory instead');
  }

  static function Factory($type)
  {
    switch ($type){
      case SourceTypes::CSV:
        return new Storage\csv();
        break;
      case SourceTypes::INI:
        return new Storage\ini();
        break;
      case SourceTypes::METHOD:
        return new Storage\method();
        break;
      default:
        throw new InvalidSourceType('Source type is not set');
        break;
    }
  }
}
