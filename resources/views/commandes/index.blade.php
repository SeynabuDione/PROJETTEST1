@extends('layouts.template')

@section('content')

@if(isset($message))
    <div class="alert alert-warning">
        {{ $message }}
    </div>
@endif

<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">Commandes</h1>
    </div>
    <div class="col-auto">
        <div class="page-utilities">
            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                <div class="col-auto">
                    <form class="table-search-form row gx-1 align-items-center">
                        <!-- Formulaire de recherche -->
                    </form>
                </div><!--//col-->
                <div class="col-auto">                             
                    <a class="btn app-btn-secondary" href="{{ url('client') }}">Ajouter Une Commande</a>
                </div>
            </div><!--//row-->
        </div><!--//table-utilities-->
    </div><!--//col-auto-->
</div><!--//row-->

<nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
    <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">Toutes les Commandes</a>
</nav>

<div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                @php
                    // Récupérer l'ID de l'utilisateur qui a effectué la commande depuis la session
                    $clientId = session('client_id');
                    $commande = App\Models\Commande::where('client_id', $clientId)->latest()->first();
                @endphp

                @if($commande)
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
                                    <th class="cell">Date_Commande</th>
                                    <th class="cell">Total</th>
                                    <th class="cell">Statut</th>
                                    <th class="cell" colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="cell">{{ $commande->client->nom }}</td>
                                    <td class="cell">{{ $commande->client->prenom }}</td>
                                    <td class="cell">{{ $commande->produits->nom }}</td>
                                    <td class="cell"><img src="{{ asset('assets/images/' . $commande->produits->image) }}" width="50"></td>
                                    <td class="cell">{{ number_format($commande->produits->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                                    <td class="cell">{{ $commande->nbre_pieces }}</td>
                                    <td class="cell">{{ $commande->date_commande }}</td>
                                    <td class="cell">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</td>
                                    <td class="cell">{{ $commande->statut }}</td>
                                    <td class="cell">
                                        <a class="btn-sm app-btn-secondary" href="#">Éditer</a>
                                    </td>
                                    <td class="cell">
                                        <form action="{{ route('commandes.destroy', $commande->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm app-btn-danger">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div><!--//table-responsive-->
                @else
                    <p>Aucune commande trouvée.</p>
                @endif
            </div><!--//app-card-body-->        
        </div><!--//app-card-->
    </div><!--//tab-pane-->
</div><!--//tab-content-->

@endsection
