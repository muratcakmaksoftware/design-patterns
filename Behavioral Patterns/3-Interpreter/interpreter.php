<?php

//İstemci tarafından alınan bilgiyi ve çevirilmiş olan bilgiyi tutar.
class Context
{
    public string $input;
    public int $total;
}

//RoleExpression. Ne tür bir çevirme işlemleri gerçekleştirilecekse fonksiyonlar belirlenir.
abstract class RoleExpression
{
    public abstract function interpret(Context $context);
}

//Terminal Expression // Genellikle aranan ifadenin karşılığı verilir.
class RomanTenExpression extends RoleExpression
{
    function interpret(Context $context)
    {
        if(str_contains($context->input, 'X')){
            return $context->total += 10;
        }
    }
}

//Terminal Expression // Genellikle aranan ifadenin karşılığı verilir.
class RomanFiveExpression extends RoleExpression
{
    function interpret(Context $context)
    {
        if(str_contains($context->input, 'V')){
            $context->total += 5;
        }
    }
}

//NonTerminalExpression burada kullanılmadı. Açıklama olarak genellikle mantıksal işlevler için kullanılır örneğin +-*/ && || gibi.

$context = new Context();
$context->input = 'XV X V';
$context->total = 0;

//Roman ifadelerinin karşılığı olan ifade sınıfları
$roleExpression = [
    'X' => new RomanTenExpression(),
    'V' => new RomanFiveExpression()
];

//String array çevrilerek, ifadelere karşılık geliyorsa çeviri işlemini yapar.
foreach (str_split($context->input) as $char){
    if(array_key_exists($char, $roleExpression)){
        $roleExpression[$char]->interpret($context);
    }
}

echo $context->total;
//Output: 30