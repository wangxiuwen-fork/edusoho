<?php

namespace Topxia\WebBundle\Extensions\DataTag\Test;

use Biz\BaseTestCase;;
use Topxia\WebBundle\Extensions\DataTag\EliteCourseThreadsByTypeDataTag;

class EliteCourseThreadsByTypeDataTagTest extends BaseTestCase
{   

    public function testGetData()
    {
        $datatag = new EliteCourseThreadsByTypeDataTag();
        $datatag->getData(array('count' => 5));

    }

}