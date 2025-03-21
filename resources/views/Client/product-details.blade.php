<style>
/* Style pour la section du produit */
.product-details {
    background-color: #f8f9fa; /* Couleur de fond */
    padding: 40px 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-top: 50px;
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    align-items: center;
    gap: 20px;
    max-width: 100%;
    overflow: hidden;
    box-sizing: border-box;
}

/* Image du produit */
.product-image {
    width: 400px; /* Fixe la largeur de l'image */
    height: auto;
    object-fit: contain;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

/* Nom du produit */
.product-name {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 20px;
    color: #343a40;
    text-align: left;
}

/* Description du produit */
.product-description {
    font-size: 1.3rem;
    color: #6c757d;
    margin-bottom: 25px;
    text-align: left;
}

/* Prix du produit (sans fond vert) */
.product-price {
    font-size: 1rem;
    color: green;
   
    margin-bottom: 20px;
    text-align: left;
}

/* Bouton Commander (lien stylisé comme un bouton) */
.btn-primary {
    display: inline-block;
    padding: 15px 30px; /* Plus de padding pour un bouton plus large */
    font-size: 1.4rem;
    border-radius: 5px;
    background-color: #007bff;
    color: #fff;
    text-align: center;
    text-decoration: none; /* Supprime le soulignement du lien */
    transition: background-color 0.3s ease, transform 0.3s ease;
    cursor: pointer; /* Change le curseur pour indiquer que c'est cliquable */
}

/* Effet au survol pour le bouton */
.btn-primary:hover {
    background-color: #0056b3;
    transform: translateY(-3px); /* Légère élévation pour l'effet de survol */
}

/* Media Queries pour les petits écrans */
@media (max-width: 768px) {
    .product-details {
        flex-direction: column;
        align-items: center;
        padding: 30px 15px;
    }

    .product-name {
        font-size: 2rem;
    }

    .product-description {
        font-size: 1.1rem;
    }

    .product-price {
        font-size: 1.5rem;
    }

    .btn-primary {
        font-size: 1.3rem;
    }
}

</style>

<div class="container mt-5">
    <div class="product-details row justify-content-center align-items-center">
        <!-- Image -->
        <div class="col-md-6">
            <img src="{{ asset('assets/images/' . $produit->image) }}" alt="{{ $produit->nom }}" class="img-fluid rounded-3 product-image">
        </div>
        
        <!-- Détails du produit -->
        <div class="col-md-6">
            <h2 class="product-name">{{ $produit->nom }}</h2>
            <p class="product-description">{{ $produit->description }}</p>
            <h3 class="product-price">Prix : <span>{{ $produit->prix }} CFA</span></h3>
           
     
                
            <form action="{{ route('commandes.store') }}" method="POST">
    @csrf
    <!-- Ajouter l'ID du produit comme champ caché -->
    <input type="hidden" name="produit_id" value="{{ $produit->id }}">

 
    <a href="{{ route('commandes.create', ['id' => $produit->id]) }}" class="btn btn-primary">

    Commander
</a>

</form>

        </div>
    </div>
</div>

