<?php

namespace App\Tbuy\Attribute\Enums;

enum AttributeType: string
{
    case NUMBER = 'number';
    case TEXT_INPUT = 'text_input';
    case SELECT = 'select';
    case RANGE = 'range';
    case BOOLEAN = 'boolean';
}
