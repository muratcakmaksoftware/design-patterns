<?php

// Özellik 1 //Bridge 1
interface ShapeInterface
{
    public function draw();
}

//Dikdortgen sekli //Özellik 1 varsayonu 1 //ImplementationA
class Rectangle implements ShapeInterface
{
    public function draw()
    {
        echo 'Rectangle drew';
    }
}

//Daire Sekli //Özellik 1 varyasyonu 2 //ImplementationB
class Circle implements ShapeInterface
{
    public function draw()
    {
        echo 'Circle drew';
    }
}

//Özellik 2  //Bridge 2
interface ColorInterface
{
    public function setColor();
}

//Özellik 2 Varyasyon 1
class ColorRed implements ColorInterface
{
    public function setColor()
    {
        echo ' set red';
    }
}

//Özellik 2 Varyasyon 2
class ColorBlue implements ColorInterface
{
    public function setColor()
    {
        echo ' set blue';
    }
}

//Çizici //Verilen özellikleri birleştirir. // Abstraction
class Plotter
{
    private ShapeInterface $shape;
    private ColorInterface $color;

    public function __construct(ShapeInterface $shape, ColorInterface $color)
    {
        $this->shape = $shape;
        $this->color = $color;
    }

    public function setShape(ShapeInterface $shape)
    {
        $this->shape = $shape;
    }

    public function setColor(ColorInterface $color)
    {
        $this->color = $color;
    }

    public function draw()
    {
        $this->shape->draw();
        $this->color->setColor();
    }
}

$rectangle = new Rectangle();
$colorRed = new ColorRed();
$plotter = new Plotter($rectangle, $colorRed);
$plotter->draw();

echo '<br/>';

$circle = new Circle();
$colorBlue = new ColorBlue();
$plotter->setShape($circle);
$plotter->setColor($colorBlue);
$plotter->draw();

/**
 * Output
   Rectangle drew set red
   Circle drew set blue
 */