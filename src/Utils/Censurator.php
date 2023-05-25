<?php

namespace App\Utils;

class Censurator
{
    const BAN_WORDS = ['lutin', 'caramel', 'voilà'];
    public function purify(string $textToPurify) : string
    {
       //$purifyText =  str_ireplace(self::BAN_WORDS, '*****', $textToPurify);
        foreach (self::BAN_WORDS as $word){
            $newText = str_repeat('*', strlen($word));
            $textToPurify = str_ireplace($word, $newText, $textToPurify);
        }

       return $textToPurify;
    }

}