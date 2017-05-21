<?php

namespace Waredesk\Mappers\Product\Variant;

use Waredesk\Collections\Products\Variants\Annotations;
use Waredesk\Mapper;
use Waredesk\Models\Product\Variant\Annotation;

class AnnotationsMapper extends Mapper
{
    public function map(Annotations $annotations, array $data): Annotations
    {
        return $this->replace($annotations, $data, Annotation::class, AnnotationMapper::class);
    }
}
