<?php

class Node
{
    private int $key;
    private string $data = '';
    private Node $parent;
    private ?array $children;

    public function __construct(int $key, string $data)
    {
        //$this->key = rand(0, 1000000);
        $this->key = $key;
        $this->data = $data;
        $this->children = null;
    }
    
    public function setParent(Node $parent): void
    {
        $this->parent = $parent;
    }
    
    public function addChild(Node $childNode): void
    {
        $this->children[] = $childNode;
    }
    
    public function getKey(): int
    {
        return $this->key;
    }
    
    public function getChildren(): ?array
    {
        return $this->children;
    }
    
    private function haveChildren(): bool
    {
        return !empty($this->children);
    }

    public function getData(): string
    {
        return $this->data;
    }
    
    public function findNodeInChildrenByKey(int $key, Node $parentNode): ?Node 
    {
        foreach ($parentNode->children as $child) {
            if ($child->key === $key) {
                return $child;
            }
        }
        
        return null;
    }
    
    public function getNodeByKey(int $key, Node $parentNode): ?Node 
    {
        if ($parentNode->haveChildren()) {
            $neededNode = $this->findNodeInChildrenByKey($key, $parentNode);
            if (\is_null($neededNode)) {
                foreach ($parentNode->children as $childNode) {
                    $this->getNodeByKey($key, $childNode);
                }
            } else {
                echo '--- key: ' . $neededNode->key . ', data: ' . $neededNode->data . ' ---';
            }            
        } else {
            return null;
        }
        
        return null;
    }
}
