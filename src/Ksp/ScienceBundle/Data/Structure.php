<?php


namespace Ksp\ScienceBundle\Data;


class Structure
{

    private $childName;
    private $data;

    public function __construct($childName = '__children')
    {
        $this->childName = $childName;
    }

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function addChildrens(array $childrens)
    {
        foreach($childrens as $child) {
            if ($child instanceof Structure) {
                $this->data[$this->childName][] = $child;
            }
        }

        return $this;
    }

    public function addChildren(Structure $children)
    {
        $this->data[$this->childName][] = $children;
        return $this;
    }


}