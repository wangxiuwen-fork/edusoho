<?php

namespace ApiBundle\Api\Resource\CourseSet;

use ApiBundle\Api\Resource\Filter;
use AppBundle\Common\ArrayToolkit;

class CourseSetFilter extends Filter
{
    private $publicFields = array(
        'id', 'title', 'subtitle', 'type', 'tags', 'category', 'serializeMode', 'status',
        'summary', 'goals', 'audiences', 'cover', 'ratingNum', 'rating', 'noteNum', 'studentNum',
        'recommended', 'recommendedSeq', 'recommendedTime', 'orgId', 'orgCode', 'discountId',
        'discount', 'maxRate', 'hitNum', 'materialNum', 'parentId', 'locked', 'maxCoursePrice',
        'minCoursePrice', 'teachers', 'creator', 'createdTime', 'updatedTime'
    );

    function filter(&$data)
    {
        $data = ArrayToolkit::parts($data, $this->publicFields);
        $data['recommendedTime'] = date('c', $data['recommendedTime']);
        $data['createdTime'] = date('c', $data['createdTime']);
        $data['updatedTime'] = date('c', $data['updatedTime']);
    }
}