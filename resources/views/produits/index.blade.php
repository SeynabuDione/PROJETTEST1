@extends('layouts.template')

@section('content')
<div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Produit</h1>
				    </div>
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							    <div class="col-auto">
								    <form class="table-search-form row gx-1 align-items-center">
					                    
					                   
					                </form>
					                
							    </div><!--//col-->
							   
							    <div class="col-auto">						    
								    <a class="btn app-btn-secondary" href="{{route('produit.create')}}">
									    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
		  <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
		  <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
		</svg>
									    Ajouter Un Burger
									</a>
							    </div>
						    </div><!--//row-->
					    </div><!--//table-utilities-->
				    </div><!--//col-auto-->
			    </div><!--//row-->
			   
			    
			    <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
				    <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">Nos Burgers</a>

                   
				</nav>
			@if (Session::get('success_message'))

			<div class="alert alert-success">
				{{(Session::get('success_message'))}}</div>
			@endif				
				<div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
							        <table class="table app-table-hover mb-0 text-left">
										<thead>
											<tr>
												<th class="cell" >#</th>
												<th class="cell">nom</th>
		
												<th class="cell">prix</th>
                                                <th class="cell">image</th>
												<th class="cell">description</th>
												<th class="cell"  colspan="2">Action</th>
												
                                              
											</tr>
										</thead>
										<tbody>
											@forelse ( $produits as $p)
											<tr>
											     <td class="cell">{{$p->id}}</td>
												 <td class="cell" >{{$p->nom}}</td>
                                                 <td class="cell"><span class="badge bg-success">
													{{$p->prix}} FRCFA </span></td>
 
                                                 <td>
                                                 <img src="{{ asset('assets/images/' . $p->image) }}" alt="{{ $p->nom }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">
                                                 </td>

                                  
                                


												<td class="cell"  colspan="2">{{$p->description}}</td>
											
												<td class="cell">
   <a class="btn-sm app-btn-secondary" href="{{route('produit.edit', $p->id)}}">Editer</a>
</td>
<td class="cell">
   <a class="btn-sm app-btn-secondary" href="{{route('produit.delete', $p->id)}}">Supprimer</a>
</td>
											</tr>
                                           
                                            
										
											@empty
											<tr>
												<td class="cell"  colspan="6" >Aucun Produit Ajoute</td>
											
											</tr>
											@endforelse
											
										
		
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						       
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
						
						
			        </div><!--//tab-pane-->
			        
			        <div class="tab-pane fade" id="orders-paid" role="tabpanel" aria-labelledby="orders-paid-tab">
					    <div class="app-card app-card-orders-table mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
								    
							        <table class="table mb-0 text-left">
										<thead>
											
										</thead>
										<tbody>
											
											
										
											
										
										
											
											
		
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
			        </div><!--//tab-pane-->
			        
			        <div class="tab-pane fade" id="orders-pending" role="tabpanel" aria-labelledby="orders-pending-tab">
					    <div class="app-card app-card-orders-table mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
							        <table class="table mb-0 text-left">
										<thead>
										
										</thead>
										<tbody>
										
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
			        </div><!--//tab-pane-->
			        <div class="tab-pane fade" id="orders-cancelled" role="tabpanel" aria-labelledby="orders-cancelled-tab">
					    <div class="app-card app-card-orders-table mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
							        <table class="table mb-0 text-left">
										<thead>
										
										</thead>
										<tbody>
											
										
										
											
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
			        </div><!--//tab-pane-->
				</div><!--//tab-content-->
				
				
			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
        

	    
    </div><!--//app-wrapper--> 

@endsection