

@extends('layouts.template')

@section('content')
<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">Commandes</h1>
    </div>
</div>

@if (Session::has('success_message'))
    <div class="alert alert-success">
        {{ Session::get('success_message') }}
    </div>
@endif

<nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
    <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">Toutes les Commandes</a>
</nav>

<div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show active" id="orders-all" role="tabpanel">
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell">Nom_Client</th>
                                <th class="cell">Prenom_Client</th>
                                <th class="cell">Nom_Burger</th>
                                <th class="cell">Burger</th>
                                <th class="cell">Prix_Unitaire</th>
                                <th class="cell">Nbre_Pieces</th>
                                <th class="cell">Total</th>
                                <th class="cell">Statut</th>
                                <th class="cell">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($commandes as $commande)
                            <tr>
                                <td class="cell">{{ $commande->client->nom }}</td>
                                <td class="cell">{{ $commande->client->prenom }}</td>
                                <td class="cell">
                                    @foreach ($commande->produits as $produit)
                                        {{ $produit->nom }}<br>
                                    @endforeach
                                </td>
                                <td class="cell">
                                    @foreach ($commande->produits as $produit)
                                        <img src="{{ asset('assets/images/' . $produit->image) }}" width="50">
                                    @endforeach
                                </td>
                                <td class="cell">
                                    @foreach ($commande->produits as $produit)
                                        {{ number_format($produit->prix, 0, ',', ' ') }} FCFA<br>
                                    @endforeach
                                </td>
                                <td class="cell">
                                    @foreach ($commande->produits as $produit)
                                        {{ $produit->pivot->quantite }}<br>
                                    @endforeach
                                </td>
                                
                                <td class="cell">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</td>
                                <td class="cell">
    <div class="statut-options" data-id="{{ $commande->id }}">
        <label class="statut-label">
            <input type="radio" name="statut_{{ $commande->id }}" value="En attente" class="update-statut" 
                {{ $commande->statut == 'En attente' || !in_array($commande->statut, ['En cours', 'Terminé']) ? 'checked' : '' }}>
            <span class="statut-circle" style="background-color:rgb(6, 6, 6);"></span> En attente
        </label>
        <label class="statut-label">
            <input type="radio" name="statut_{{ $commande->id }}" value="En cours" class="update-statut"
                {{ $commande->statut == 'En cours' ? 'checked' : '' }}>
            <span class="statut-circle" style="background-color: rgb(6, 6, 6);"></span> En cours
        </label>
        <label class="statut-label">
            <input type="radio" name="statut_{{ $commande->id }}" value="Terminé" class="update-statut"
                {{ $commande->statut == 'Terminé' ? 'checked' : '' }}>
            <span class="statut-circle" style="background-color:rgb(6, 6, 6);"></span> Terminé
        </label>
    </div>
</td>






                                
                                <td class="cell">
                                    <form action="{{ route('commandes.destroyy', $commande->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-sm app-btn-danger">Supprimer</button>
                                    </form>
                                </td>

                                <td class="cell">
    <form action="{{ route('commandes.generatePdf', $commande->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn-sm app-btn-primary">Générer le PDF et Envoyer</button>
    </form>
</td>

                            </tr>
                            @empty
                            <tr>
                                <td class="cell text-center" colspan="10">Aucune Commande Disponible</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>        
        </div>
    </div>
</div>
@endsection

<script>
    document.querySelectorAll('.update-statut').forEach(function (radio) {
    radio.addEventListener('click', function () {
        let statut = this.value;
        let commandeId = this.closest('.statut-options').getAttribute('data-id');

        fetch(`/commandes/${commandeId}/update-statut`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ statut: statut })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message); // Affiche le message renvoyé par Laravel
            } else {
                alert('Une erreur est survenue lors de la mise à jour du statut.');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Impossible de mettre à jour le statut.');
        });
    });
});

</script>



