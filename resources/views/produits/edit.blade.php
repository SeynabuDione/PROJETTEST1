@extends('layouts.template')

@section('content')

			    <h1 class="app-page-title">Produit</h1>
			    <hr class="mb-4">
                <div class="row g-4 settings-section">
	                <div class="col-12 col-md-4">
		                <h3 class="section-title">Edition</h3>
		                <div class="section-intro">Editer un burger </div>
	                </div>
	                <div class="col-12 col-md-8">
		                <div class="app-card app-card-settings shadow-sm p-4">
						    
						    <div class="app-card-body">
							    <form class="settings-form" method="POST" 
                                action="{{route('produit.store')}}">
                                    @csrf
                                    @method('POST')
                                  
                                    
									</div>
                                    <div class="mb-3">
									    <label for="setting-input-1" class="form-label">Nom</label>
									    <input type="text" class="form-control" id="setting-input-1" required
                                        placeholder="Saisir un nom " name="nom" value = "{{$produit->nom}}">
                                        @error('nom')
                                        <div class="text-danger"> {{ $message }}</div>
                                       
                                        @enderror
									</div>
                                    <div class="mb-3">
									    <label for="setting-input-1" class="form-label">Description</label>
									    <input type="description" class="form-control" id="setting-input-1" required
                                        placeholder=" Saisir une description " name="description" value = "{{$produit->description}}">
                                      
									</div>
									
                                    <div class="mb-3">
                                    
									    <label for="setting-input-1" class="form-label">Image</label>
									    <input type="file" class="form-control" id="setting-input-1" required
                                          name="image" >
                                      
									</div>
                                    <div class="mb-3">
									    <label for="setting-input-1" class="form-label">Prix</label>
									    <input type="number" class="form-control" id="setting-input-1" required
                                        placeholder="Saisir un  prix " name="prix" value = "{{$produit->prix}}">
                                        @error('prix')
                                        <div class="text-danger"> {{ $message }}</div>
                                       
                                        @enderror
									</div>
                                  
                                 

                                
								
									 
								
								   
									<button type="submit" class="btn app-btn-primary" >Enregistrer</button>
							    </form>
						    </div><!--//app-card-body-->
						    
						</div><!--//app-card-->
	                </div>
                </div><!--//row-->

@endsection