<?php

namespace Styde;

abstract class Model
{
    protected $attributes = [];

    public function __construct(array $attributes = [])
    {
        $this->fill($attributes);
    }
    
    public function getAttributes()
    {
        return $this->attributes;
    }
    
    public function fill(array $attributes = [])
    {
        return $this->attributes = $attributes;
    }

    public function setAttribute($name, $value)
    {
        return $this->attributes[$name] = $value;
    }

    public function __set($name, $value)
    {
        return $this->setAttribute($name, $value);
    }

    public function getAttribute($name)
    {
        $value = $this->getAttributeValue($name);

        
        if ($this->hasGetMutator($name)) {
            return $this->mutateAttribute($name, $value);
        }
        
        return $value;
    }
    
    protected function hasGetMutator($name)
    {
        return method_exists($this, $this->nameMethod($name));
    }
    
    protected function mutateAttribute($name, $value)
    {
        return $this->{$this->nameMethod($name)}($value);
    }

    public function nameMethod($name)
    {
        return 'get'.Str::studly($name).'Attribute';
    }

    public function getAttributeValue($name)
    {
        if (array_key_exists($name, $this->attributes)) {
            return $this->attributes[$name];
        }
    }

    public function __get($name)
    {
        return $this->getAttribute($name);
    }

    public function __isset($name)
    {
        return isset($this->attributes[$name]);
    }
    
    public function __unset($name)
    {
        unset($this->attributes[$name]);
    }
}