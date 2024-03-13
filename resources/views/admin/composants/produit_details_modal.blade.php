<!-- Modal -->
<div class="modal fade" id="modal_prodit{{ $item->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">{{ $item->nom }}</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="text-center">
            <img src="/uploads/{{ $item->photo }}" style="width: 40%">
            <br>
            @if ($item->gallerie_info !== null)
            <div class="row">
                @foreach ($item->gallerie_info as $image)
                  <div class="col">
                    <img src="/uploads/{{ $image->url }}" style="width: 100%;">
                  </div>
                @endforeach
            </div>
            @endif
            <br>
            <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG( $item->code_bar, 'C39') }}" alt="barcode" style="width: 60%" />
          </div>
          <hr>
          <b>Produit :</b> {{ $item->nom }} <br>
          <b>Description : </b> {{ $item->description}}
          <br>
          <br>
          <table style="width: 100%;">
            <tr style="font-weight: bold;">
                <td>PRIX ACHAT</td>
                <td>PRIX VENTE</td>
                <td>CODE BARRE</td>
            </tr>
            <tr>
                <td>{{ $item->prix_achat }}</td>
                <td>{{ $item->prix_vente}}</td>
                <td>{{ $item->code_bar }}</td>
            </tr>
          </table>
          <div class="footer mt-5 text-center">
            <a href="/client/ajout_rapide/{{ $item->code_bar }}">
                <button class="btn btn-sm btn-success">
                    <i class="fa-solid fa-cubes"></i>  &nbsp;&nbsp;&nbsp; Récharge rapide du stock
                </button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- Modal -->
