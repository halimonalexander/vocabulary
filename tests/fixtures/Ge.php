<?php
namespace HalimonAlexander\Vocabulary\Tests\Fixtures;

use HalimonAlexander\Vocabulary\Vocabulary;

class Ge extends Vocabulary
{
    protected $messages = [
        "digits" => [
            "apple" => [
                "one" => "ein Apfel",
                "two" => "zwei Äpfel",
                "three" => "drei Äpfel",
            ],
        ],
    ];
}
