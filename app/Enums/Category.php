<?php

namespace App\Enums;

enum Status: string
{
    case Firmly = 'がっつり';
    case Rich = 'こってり';
    case Light = 'あっさり';
    case Sour = '酸っぱい';
    case Salty = '塩辛い';
    case Spicy = '辛い';
    case Sweet = '甘い';
    case Hot = '熱い';
    case Cold = '冷たい';
    case Creamy = 'クリーミ―';
    case Bitter = '苦い';
    case Easy = 'かんたん調理';
}
