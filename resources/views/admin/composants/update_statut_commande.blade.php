<!-- Statut de la commande Modal -->
<div class="modal fade" id="addNewAddress{{ $id }}" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close monBouton_close"
                    data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="address-title mb-2">Statut de la commande</h3>
                    <p class="text-muted address-subtitle">Statut de la commande
                        #{{ $id }}</p>
                </div>
                <form class="row g-3 addNewstatutForm" onsubmit="return false">
                    @csrf
                    <div class="col-12 col-md-12">
                        <input type="hidden" value="{{ $id }}"
                            name="id_commande">
                        <label class="form-label" for="statut">Nouveau statut</label>
                        <select name="statut" id="statut_commande{{ $id }}" class="form-control"
                            required>
                            <x-status-select />
                        </select>
                        <div id="motif{{ $id }}" class="hide">
                            <br>
                            <label class="form-label" for="statut">Motif du
                                retour</label>
                                <select name="motif" id="" class="form-control ">
                                    <option value=""></option>
                                    <option value="Faute du livreur">Faute du livreur</option>
                                    <option value="Annuler par le client">Annuler par le client</option>
                                    <option value="Echange">Echange</option>
                                </select>
                        </div>
                        <br>
                        <hr>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit"
                            class="btn btn-primary me-sm-3 me-1">Enregistrer</button>
                        <button type="reset" class="btn btn-label-secondary"
                            data-bs-dismiss="modal" aria-label="Close">
                            Quitter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Statut de la commande Modal -->
<script>
    $(document).ready(function() {
        $('#statut_commande{{ $id }}').change(function() {
            var valeurSelectionnee = $(this).val();
            // console.log('valeur' + valeurSelectionnee);
            if (valeurSelectionnee == "Planification retour") {
                $('#motif{{ $id }}').show();
                $('#motif{{ $id }}').prop('required', true);
            } else {
                $('#motif{{ $id }}').hide();
                $('#motif{{ $id }}').prop('required', false);
            }
        });



    });
</script>
