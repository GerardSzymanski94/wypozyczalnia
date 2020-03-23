<html>
<head></head>
<body>
Przypomnienie o zwrocie produktów<br><br>

Produkty, które musisz zwrócić w najbliższym czasie:<br>

@foreach($products as $product)
    {{ $product['name'] }} - {{ $product['date'] }}
@endforeach

</body>
</html>