<?php
class CacheService{
    
    public $modelName;
    public $action;
    public $position;
    public $page;
    public $id;
    public $sort;
    

    public function __construct($modelName,$action,$position='',$id='',$page='',$sort=''){
        $this->modelName = $modelName;
        $this->action = $action;
        $this->position = $position;
        $this->id = $id;
        $this->page = $page;
        $this->sort = $sort;
    }
    
    public function createKey(){
        $cacheName = "e_financial.".$this->modelName.".cache.".$this->action;
        if($this->position != ''){
            $cacheName .='.'.$this->position;
        }
        if($this->id != ''){
            $cacheName .='.'.$this->id;
        }
        if($this->page != ''){
            $cacheName .='.'.$this->page;
        }
    	if($this->sort != ''){
            $cacheName .='.'.$this->sort;
        }
        
        return trim($cacheName);
    }


    public function createDependency(){
        $dependencyName = "e_financial.".$this->modelName.".cache.".$this->action;
        if($this->position != ''){
            $dependencyName .='.'.$this->position;
        }
        if($this->id != ''){
            $dependencyName .='.'.$this->id;
        }
        $dependencyName.='.status';

        return trim($dependencyName);
    }
}