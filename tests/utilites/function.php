<?php

function create($class, $attr = [])
{
    return $class::factory()->create($attr);
}

function make($class, $attr = [])
{
    return $class::factory()->create($attr);
}
