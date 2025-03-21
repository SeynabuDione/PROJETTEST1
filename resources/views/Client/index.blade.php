@extends('layouts.template')

@section('content')

@if(session('success_message'))
    <div class="alert alert-success">
        {{ session('success_message') }}
    </div>
@endif




<nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
    <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">Nos Burgers</a>
</nav>




<div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                              
                                <th class="cell">Nom</th>
                                <th class="cell">Prix</th>
                                <th class="cell">Image</th>
                                <th class="cell">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ( $produits as $p)
                            <tr>
                                
                                <td class="cell">{{$p->nom}}</td>
                                <td class="cell"><span class="badge bg-success">{{$p->prix}} FRCA</span></td>
								<td>
								<a href="{{ route('produit.details', $p->id) }}">
    <button class="btn border border-dark p-0">
        <img src="{{ asset('assets/images/' . $p->image) }}" alt="{{ $p->nom }}" class="img-fluid rounded-3" style="width: 100px; height: 100px; object-fit: cover;">
    </button>
</a>


</td>

                                <td class="cell">{{$p->description}}</td>
                            </tr>
                            @empty
                           
                            @endforelse
                        </tbody>
                    </table>
                </div><!--//table-responsive-->
            </div><!--//app-card-body-->        
        </div><!--//app-card-->
    </div><!--//tab-pane-->
</div><!--//tab-content-->



@endsection
