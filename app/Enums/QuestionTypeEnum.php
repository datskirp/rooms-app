<?php

namespace App\Enums;

enum QuestionTypeEnum:int {

    case Text = 1;

    case Code = 2;

    case Checkbox = 3;

    case Radio = 4;

}
