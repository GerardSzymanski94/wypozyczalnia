<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        #container {
            width: 100%;
            text-align: center;
        }

        #left {
            float: left;
            width: 100px;
        }

        #center {
            display: inline-block;
            margin: 0 auto;
            width: 100px;
        }

        #right {
            float: right;
            width: 100px;
        }
    </style>
</head>
<body>

<div id="container">
    <h2 style="text-align: center">UMOWA WYPOŻYCZENIA</h2>
    <br>
    <br>
    zawarta dnia .................................... w Poznaniu pomiędzy:<br>
    <br>
    GymProFit Łukasz Gołębniak z siedzibą w Poznaniu przy ulicy Andrzejewskiego 5/5, wpisaną do ewidencji działalności
    gospodarczej prowadzonej przez Prezydenta Miasta Poznania pod numerem 38153/2006/S, REGON 639764777<br>
    reprezentowaną przez:<br>
    - Łukasza Gołębniaka zwanym dalej Usługodawcą,<br>
    <br>
    a {{ $user->name }} {{ $user->surname }} (imię i nazwisko)<br>
    <br>
    zam.:
    {{ $user->street }}, {{ $user->zip_code }} {{ $user->city }}
    (adres)<br>
    <br>
    legitymującą / ym się: …………………………………………..…………………….………. (rodzaj i numer dowodu tożsamości)<br>
    <br>
    tel. stacjonarny: ..............................................., tel. kom.
    ...............................................<br>
    zwaną / zwanym dalej Usługobiorcą, o następującej treści:<br>
    <br>
    <br>


    @foreach($order->orderProducts as $orderProduct)
        @if($orderProduct->product->status==1)
            <span style="text-align: center">§ 1 </span><br>
            Usługodawca przekazuje do użytkowania urządzenie rehabilitacyjne<br>
            <br>
            {{ $orderProduct->product->name }}<br>
            <br>
            nr fabr.: {{ $orderProduct->series }}  należący do Usługodawcy, zwany dalej przedmiotem wypożyczenia.<br>
            <br>
            <span style="text-align: center">§ 2 </span><br>
            <br>
            Okres wypożyczenia trwa {{ $orderProduct->start_date }}. dni, tj.
            od {{ \Carbon\Carbon::parse($orderProduct->start_date)->format('Y-m-d') }} do
            {{ \Carbon\Carbon::parse($orderProduct->start_date)->addDays($orderProduct->days)->format('Y-m-d') }}<br>
        @endisset
    @endforeach
    <br>
    <span style="text-align: center">§ 3 </span>
    <br>
    Usługobiorca zobowiązuje się do użytkowania przedmiotu zgodnie z instrukcją usługodawcy, zapewnienia niezbędnych
    warunków dla bezpiecznego przechowywania sprzętu i jest odpowiedzialny za wszelkie szkody powstałe w okresie
    wypożyczenia.

    <br>
    <br>
    <span style="text-align: center">§ 4 </span>
    <br>
    Za ww. usługę w ww. okresie Usługobiorca zobowiązuje się do zapłaty kwoty [stawka brutto za dzień wypożyczenia] x
    ilość
    dni wypożyczenia, łącznie: .................... zł.
    <br>
    Za każdą kolejną dobę wypożyczenia Usługobiorca zapłaci ww. stawkę dzienną dla danego urządzenia.
    <br>
    Forma płatności: gotówka (odbiór osobisty / dowóz w Warszawie i okolicy). W przypadku przedłużenia umowy
    wypożyczenia,
    Usługobiorca zobowiązuje się do uregulowania należności w wyznaczonym przez Usługodawcę terminie.
    <br>

    <br>
    <span style="text-align: center">§ 5 </span><br>
    Zwłoka Usługobiorcy w płatności należności, o której mowa w § 4, powoduje rozwiązanie umowy i zwrot przedmiotu
    wypożyczenia.<br>
    <br>
    <span style="text-align: center">§ 6 </span><br>
    Usługodawca wystawi Usługobiorcy fakturę. / Dane Usługobiorcy do wystawienia faktury inne niż powyższe:<br>
    <br>
    ………………………………………………………………………………………...........................................……………………………..<br>
    <br>
    <span style="text-align: center">§ 7 </span><br>
    Wszelkie zmiany niniejszej umowy wymagają pod rygorem nieważności formy pisemnej w postaci aneksu do umowy.<br>
    <br>
    <span style="text-align: center">§ 8 </span><br>
    Usługobiorca może zwrócić przedmiot wypożyczenia w dowolnym terminie, przy czym jest zobowiązany do zapłaty na rzecz
    Usługodawcy ustalonej kwoty usługi, o której mowa w § 4. W przypadku chęci przedłużenia okresu wypożyczenia,
    Usługobiorca jest zobowiązany do powiadomienia Usługodawcy najpóźniej 3 dni przed upływem terminu wypożyczenia,
    określonego w umowie.<br>
    <br>
    <span style="text-align: center">§ 9 </span><br>
    W sprawach nie uregulowanych niniejszą umową mają zastosowanie przepisy Kodeksu Cywilnego.<br>
    <br>
    <span style="text-align: center">§ 10 </span><br>
    Koszty związane z transportem przedmiotu wypożyczenia poza teren Poznania pokrywa Usługobiorca.<br>
    <br>
    <span style="text-align: center">§ 11 </span><br>
    Umowę sporządzono w dwóch jednobrzmiących egzemplarzach, po jednym dla każdej ze stron<br>

    <br>
</div>
<div id="container">
    <div id="left">...................................................<br>
        podpis USŁUGOBIORCY
    </div>
    <div id="center"></div>
    <div id="right">.................................................<br>podpis USŁUGODAWCY</div>
</div>


</body>
</html>
