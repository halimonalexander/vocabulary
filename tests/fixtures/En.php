<?php
namespace HalimonAlexander\Vocabulary\Tests\Fixtures;

use HalimonAlexander\Vocabulary\Vocabulary;

class En extends Vocabulary
{
    protected $messages = [
        "digits" => [
            "apple" => [
                "one" => "one apple",
            ],
            "peach" => [
                "one" => "one peach",
            ],
            "melon" => [
                "one" => "one melon",
            ],
        ],
    ];
}
