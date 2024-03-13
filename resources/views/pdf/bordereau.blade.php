@php
    $currentDate = \Carbon\Carbon::now();
    if (auth()->user()->avatar == '') {
        $avatar = public_path('/img/avatar.webp');
    } else {
        $avatar = public_path('/uploads/' . auth()->user()->avatar);
    }
@endphp
@php
    use Milon\Barcode\Facades\DNS1DFacade as DNS1D;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Commande</title>
</head>

<body>
    @foreach ($orders as $index => $commande)
        @if ($index > 0)
            <div style="page-break-before: always;">
        @endif
            <div style="text-align: right;">
                <b>COMMANDE : #{{ $commande->id }} </b> <br>
                <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($commande->id, 'C39') }}" alt="barcode" style="width: 200px;" />

            </div>
            <br><br><br>
            <table style="width: 100%;">
                <tr>
                    <td style="width: 100px;">
                        <img src="{{ $avatar }}" alt="" style="width: 100%">
                    </td>
                    <td>
                        <b>Société : </b>{{ auth()->user()->name }} <br>
                        <b>Email : </b>{{ auth()->user()->email }} <br>
                        <b>Téléphone : </b>{{ auth()->user()->telephone }}
                    </td>
                    <td style="text-align: right;">
                        <img src="{{ public_path('/img/digi.png') }}" alt="" srcset=""
                            style="width: 60px;">
                    </td>
                </tr>
            </table>
            <br>
            <table style="width: 100%;">
                <tr style="background-color: #dff7e9;">
                    <td colspan="2">
                        Informations du client
                    </td>
                </tr>
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td><b>Nom du client: </b> {{ $commande->nom_client }} </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><b>Email : </b> {{ $commande->email }} </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><b>Téléphone : </b> {{ $commande->telephone }} </td>
                                <td></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table>
                            <tr>
                                <td><b>Gouvernorat : </b> {{ $commande->gouvernerat }} </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><b>Adresse : </b> {{ $commande->adresse }} </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><b>Type de commande : </b> {{ $commande->type }} </td>
                                <td></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <hr>
            <br><br>
            <table style="width: 100%;">
                <tr style="background-color: #312585;color: white;font-weight: bold;">
                    <td>Désignation</td>
                    <td>Quantité</td>
                    <td>Prix Unitaire</td>
                    <td>Total</td>
                </tr>
                @php
                    $total = 0;
                @endphp
                @forelse ($commande->produits as $item)
                    <tr>
                        <td> {{ $item->nom }} </td>
                        <td> {{ $item->quantite }} </td>
                        <td> {{ $item->prix_unitaire }} </td>
                        <td> {{ $item->prix_unitaire * $item->quantite }} </td>
                    </tr>
                    @php
                        $total += $item->prix_unitaire * $item->quantite;
                    @endphp
                @empty
                @endforelse
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2" style="color: #312585;">
                        <b>
                            TOTAL = {{ $total }}
                        </b>
                    </td>
                </tr>
            </table>

            <br>
            <div style="text-align: right;opacity: 0.8;">
                <i>
                    Date d'impression : {{ $currentDate->format('d-m-Y H:i') }}
                </i>
            </div>
        </div>
    @endforeach
</body>

</html>
