<div id="order_item_{{ $id }}">
    <span>Produkt: {{ $product->name }}</span>
    <span>Dni: {{ $days }}</span>
    @isset($additional->name)
        <span>Dodatki: {{ $additional->name }}</span>
    @endisset
</div>