<?php

namespace Waredesk\Mappers\Product\Variant;

use Waredesk\Collections\Products\Variants\Annotations;
use Waredesk\Models\Product\Variant\Annotation;

class AnnotationsMapper
{
    public function map(Annotations $annotations, array $data): Annotations
    {
        foreach ($data as $annotation) {
            $annotations->add((new AnnotationMapper())->map(new Annotation(), $annotation));
        }
        return $annotations;
    }
}
