@if ($statut == 'Crée')
    <span class="badge rounded-pill " style="background-color: #0a7cff;">{{ $statut }}</span>
@endif
@if ($statut == 'Livré')
    <span class="badge rounded-pill " style="background-color: #067116;">{{ $statut }}</span>
@endif

@if ($statut == 'En cours de livraison')
    <span class="badge rounded-pill " style="background-color: #e67300;">{{ $statut }}</span>
@endif
@if ($statut == 'Livré et payé')
    <span class="badge rounded-pill " style="background-color: #00bc1d;">{{ $statut }}</span>
@endif
@if ($statut == 'Planification retour')
    <span class="badge rounded-pill " style="background-color: #f0f000;">{{ $statut }}</span>
@endif
@if ($statut == 'Retourné')
    <span class="badge rounded-pill " style="background-color: #c60000;">{{ $statut }}</span>
@endif
