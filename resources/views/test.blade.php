<pre>

    @php
    print_r($cate->lien_ket_den_bang_product->toarray());
    @endphp

</pre>
@foreach ($cate->lien_ket_den_bang_product as $row)
    {{ $row->name }}
    <hr>
@endforeach