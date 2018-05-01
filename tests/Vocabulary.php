<?php
namespace HalimonAlexander\Vocabulary\Tests;

use HalimonAlexander\Vocabulary\Tests\Fixtures\{
  En,
  Fr,
  Ge,
  Pl
};
use HalimonAlexander\Vocabulary\{
    VocabularyFactory,
    Exceptions\ModuleNotFound,
    Exceptions\TextNotFound,
    Exceptions\UnknownVocabulary
};
use PHPUnit\Framework\TestCase;

class Vocabulary extends TestCase
{
    /** @dataProvider defaultDataProvider */
    public function testDefault($vocabulary, $module, $var, $expect)
    {
        $this->assertEquals($expect, $vocabulary->getText($module, $var));
    }
    
    /** @dataProvider contextDataProvider */
    public function testContext($vocabulary, $module, $var, $context, $expect)
    {
        $this->assertEquals($expect, $vocabulary->getText($module, $var, $context));
    }
    
    /** @dataProvider moduleDataProvider */
    public function testModule($vocabulary, $module, $var, $expect)
    {
        $this->assertEquals($expect, $vocabulary->getText($module, $var));
    }
    
    public function testFactory()
    {
        $factory = new VocabularyFactory("HalimonAlexander\\Sid\\Tests\\Fixtures");
        $vocabulary = $factory->create("Pl");
        
        $this->assertInstanceOf('HalimonAlexander\\Sid\\Tests\\Fixtures\\Pl', $vocabulary);
        $this->assertInstanceOf('HalimonAlexander\\Vocabulary\\Vocabulary', $vocabulary);
    }
    
    public function testAllModule()
    {
      $fr = new Fr();
      $this->assertEquals(
        [
          "one" => "un",
          "two" => "deux",
          "three" => "trois",
        ],
        $fr->getModuleTexts('digits')
      );
    }
    
    public function testNxVocabulary()
    {
        $factory = new VocabularyFactory("HalimonAlexander\\Vocabulary\\Tests\\Fixtures");
        $vocabulary = $factory->create("Gb");
    
        $this->expectException('UnknownVocabulary');
    }
    
    public function testNxModule()
    {
      $vocabulary = new Pl();
      $vocabulary->getText("unknown", "unknown");
  
      $this->expectException('ModuleNotFound');
    }
    
    public function testNxText()
    {
        $vocabulary = new Pl();
        $vocabulary->getText("known", "unknown");
        
        $this->expectException('TextNotFound');
    }
    
    public function defaultDataProvider()
    {
        $vocabulary = new Fr();
        
        return [
            [$vocabulary, 'digits', 'one', 'un'],
            [$vocabulary, 'digits', 'two', 'deux'],
            [$vocabulary, 'digits', 'three', 'trois'],
        ];
    }
    
    public function contextDataProvider()
    {
        $vocabulary = new Ge();
        
        return [
            [$vocabulary, 'digits', 'one', 'apple', 'ein Apfel'],
            [$vocabulary, 'digits', 'two', 'apple', 'zwei Äpfel'],
            [$vocabulary, 'digits', 'three', 'apple', 'drei Äpfel'],
        ];
    }
    
    public function moduleDataProvider()
    {
        $vocabulary = new En();
        
        return [
            [$vocabulary, 'apple', 'one', 'one apple'],
            [$vocabulary, 'peach', 'one', 'one peach'],
            [$vocabulary, 'melon', 'one', 'one melon'],
        ];
    }
}
