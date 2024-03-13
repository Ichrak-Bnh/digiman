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
    <title>Manifest</title>
</head>

<body>
    <div style="text-align: center;">
        <table style="width: 100%">
            <tr>
                <td>
                    <h1>MANIFEST</h1>
                </td>
                <td style="text-align: right;">
                    <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG( auth()->user()->name, 'C39') }}" alt="barcode"
                        style="width: 200px;" />
                </td>
            </tr>
        </table>
    </div>
    <hr>
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
                <img src="{{ public_path('/img/digi.png') }}" alt="" srcset="" style="width: 60px;">
            </td>
        </tr>
    </table>
    <hr>
    <table style="width: 100%;">
        <tr>
            <td>
                <h3>Détails</h3>
            </td>
            <td style="text-align: right;">
                Date : {{ $currentDate->format('d-m-Y H:i') }}
            </td>
        </tr>
    </table>
    <br>
    <table style="width: 100%;">
        <thead>
            <tr style="background-color: #312585;color: white;">
                <th>ID</th>
                <th>Date</th>
                <th>Client</th>
                <th>Téléphone</th>
                <th>Montant</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($commandes as $commande)
                <tr>
                    <td>{{ $commande->id }}</td>
                    <td>{{ \Carbon\Carbon::parse($commande->created_at)->format('H:i:s d-m-Y') }}</td>
                    <td>{{ $commande->nom_client }}</td>
                    <td>{{ $commande->telephone }}</td>
                    <td>{{ $commande->total_amount }}</td>
                    <td>{{ $commande->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
