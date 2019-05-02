<?php

namespace App\Entity;

class PropertySearch {
    private $maxPrice;
    private $minSurface;
    private $nbrBedrooms;
    private $nbrRooms;

    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    public function setMaxPrice(int $maxPrice)
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }   

    public function getMinSurface()
    {
        return $this->minSurface;
    }

    public function setMinSurface(int $minSurface)
    {
        $this->minSurface = $minSurface;
        return $this;
    }

    public function getNbrBedrooms()
    {
        return $this->nbrBedrooms;
    }

    public function setNbrBedrooms(int $nbrBedrooms)
    {
        $this->nbrBedrooms = $nbrBedrooms;
        return $this;
    }   

    public function getNbrRooms()
    {
        return $this->nbrRooms;
    }

    public function setNbrRooms(int $nbrRooms)
    {
        $this->nbrRooms = $nbrRooms;
        return $this;
    }   
}