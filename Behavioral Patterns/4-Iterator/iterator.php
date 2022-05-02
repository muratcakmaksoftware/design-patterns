<?php

interface StackIteratorInterface
{
    public function first();

    public function next();

    public function current();

    public function previous();
}

//Verilerin içerisinde gezmek için stack iterator.
class StackIterator implements StackIteratorInterface
{
    private $collection;
    private $position = 0;

    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    public function first()
    {
        $this->position = 0;
        return $this->collection->items[$this->position] ?? null;
    }

    public function next()
    {
        if (isset($this->collection->items[$this->position + 1])) { //increment position
            return $this->collection->items[++$this->position];
        } else if (isset($this->collection->items[$this->position])) { //last position
            return $this->collection->items[$this->position];
        } else { //empty array
            return null;
        }
    }

    public function current()
    {
        return $this->collection->items[$this->position] ?? null;
    }

    public function previous()
    {
        if (isset($this->collection->items[$this->position - 1])) { //decrement position
            return $this->collection->items[--$this->position];
        } else if (isset($this->collection->items[$this->position])) { //last position
            return $this->collection->items[$this->position];
        } else { //empty array
            return null;
        }
    }
}

//Aggregate içerisinde oluşturabileceğimiz Iteratorleri belirleriz.
interface StackAggregateInterface
{
    public function createStackIterator();
}

//Aggregate bir koleksiyon sınıfıdır ve sadece koleksiyonla alakalı fonksiyonlar yazılmalıdır.
class StackCollection implements StackAggregateInterface
{
    public $items = [];

    //Iterator oluşturarak koleksiyonun içerisinde gezinmeyi sağlarız.
    public function createStackIterator()
    {
        return new StackIterator($this);
    }

    public function add($item)
    {
        $this->items[] = $item;
    }

    public function getItems()
    {
        return $this->items;
    }
}

$stackCollection = new StackCollection();
$stackCollection->add('Murat');
$stackCollection->add('Ilhan');
$stackCollection->add('Mehmet');

$stackIterator = $stackCollection->createStackIterator();
echo $stackIterator->first(). '<br/>'; // Murat
echo $stackIterator->next(). '<br/>'; // Ilhan
echo $stackIterator->next(). '<br/>'; // Mehmet
echo $stackIterator->next(). '<br/>'; // Mehmet
echo $stackIterator->previous(). '<br/>'; // Ilhan
echo $stackIterator->previous(). '<br/>'; //Murat
echo $stackIterator->current(). '<br/>'; // Murat
//Output:
//Murat
//Ilhan
//Mehmet
//Mehmet
//Ilhan
//Murat
//Murat
