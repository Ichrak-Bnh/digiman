<!-- Statut de la commande Modal -->
<div class="modal fade" id="Edition{{ $item->id }}" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close monBouton_close"
                    data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="address-title mb-2">Editeur de catégories</h3>
                    <p class="text-muted address-subtitle"> <b>Catégorie :</b> <a href="#">{{ $item->titre }}</a> </p>
                </div>
                <form action="/client/update-categorie" method="post" enctype="multipart/form-data">
                    <div class="text-center">
                        <img src="/uploads/{{ $item->icone }}" class="rounded-1" style="width: 100px;">
                    </div>
                    @csrf
                    <div class="col-12 col-md-12">
                        <input type="hidden" value="{{ $item->id }}"
                            name="id">
                        <label class="form-label" for="statut">Titre</label>
                        <input type="text" name="edition_titre" value="{{ old("edition_titre",$item->titre)}}" class="form-control" />
                        @error('edition_titre')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        <br>
                        <label for="form-label">Icône <span class="text-warning">(png, svg, jpeg, jpg)</span> </label>
                                <input type="file" name="icone" class="form-control" accept="image/png, image/jpeg, image/svg" >
                                @error('icone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <br>
                        <label for="form-label"> Description</label>
                        <textarea name="edition_description" required class="form-control" rows="3">{{ old("edition_description", $item->description) }}</textarea>
                                @error('edition_description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                    </div>
                    <br><br>
                    <div class="col-12 text-center">
                        <button type="submit"
                            class="btn btn-primary me-sm-3 me-1">Enregistrer les modification</button>
                        <button type="reset" class="btn btn-label-secondary"
                            data-bs-dismiss="modal" aria-label="Close">
                            Fermer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>