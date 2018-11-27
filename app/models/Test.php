<?php

namespace app\models;

use Pheasant\Types;

class Test extends BaseModel {

    public function properties() {
        return array(
            'id' => new Types\SequenceType(),
            'title' => new Types\StringType(255, 'required')
        );
    }

}
