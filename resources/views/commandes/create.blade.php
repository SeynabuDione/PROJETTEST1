<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commander - {{ $produit->nom }}</title>

    <style>
        /* Styles globaux */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"], input[type="email"], input[type="date"], input[type="number"], input[type="hidden"], input[type="submit"] {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
        }

        input[type="text"]:focus, input[type="email"]:focus, input[type="number"]:focus, input[type="date"]:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            padding: 12px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            margin-top: 20px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .product-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            cursor: pointer;
            border-radius: 5px;
        }

        .product-info {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-top: 10px;
            text-align: center;
        }

        .product-price {
            font-size: 16px;
            color: #28a745;
            text-align: center;
            margin-top: 5px;
        }

        .mb-4 {
            margin-bottom: 30px;
        }

        .mb-3 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Titre en haut de la page -->
    <h2>Commander - {{ $produit->nom }}</h2>

    <form action="{{ route('commandes.store') }}" method="POST" class="form-container">
        @csrf

        <!-- Champ caché pour l'ID du produit -->
        <input type="hidden" name="produit_id" id="produit_id" value="{{ $produit->id }}">
        <input type="hidden" name="status" value="en_attente"> <!-- Status initial de la commande -->

        <!-- Affichage du produit sélectionné -->
        <div class="mb-4">
            <img src="{{ asset('assets/images/' . $produit->image) }}" alt="Image du produit" class="product-img">
            <p class="product-info">{{ $produit->nom }}</p>
            <p class="product-price">{{ $produit->prix }} €</p>
        </div>

        <!-- Informations sur le client -->
        <div class="form-group mb-3">
            <label for="client_nom">Nom du Client</label>
            <input type="text" class="form-control" id="client_nom" name="client_nom" required>
        </div>
        <div class="form-group mb-3">
            <label for="client_prenom">Prénom du Client</label>
            <input type="text" class="form-control" id="client_prenom" name="client_prenom" required>
        </div>
        <div class="form-group mb-3">
            <label for="client_email">Email du Client</label>
            <input type="email" class="form-control" id="client_email" name="client_email" required>
        </div>
        <div class="form-group mb-3">
            <label for="client_telephone">Téléphone</label>
            <input type="text" class="form-control" id="client_telephone" name="client_telephone" required>
        </div>

        <!-- Quantité du produit -->
        <div class="form-group mb-3">
            <label for="nombre_de_pieces">Quantité</label>
            <input type="number" class="form-control" id="nombre_de_pieces" name="nombre_de_pieces" value="1" min="1" required>
        </div>

        <!-- Prix total -->
        <div class="form-group mb-3">
            <label for="total">Prix Total</label>
            <input type="text" class="form-control" id="total" name="total" value="{{ $produit->prix }}" readonly>
        </div>

        <!-- Date de commande (automatique) -->
        <div class="form-group mb-3">
            <label for="date_commande">Date de Commande</label>
            <input type="date" class="form-control" id="date_commande" name="date_commande" value="{{ now()->toDateString() }}" readonly>
        </div>

        <button type="submit" class="btn">Ajouter la commande</button>
    </form>
</div>
<script>
    // Récupérer les éléments nécessaires une seule fois
    var nombrePiecesInput = document.getElementById("nombre_de_pieces");
    var totalInput = document.getElementById("total");
    var prixUnitaire = parseFloat("{{ $produit->prix }}");

    // Calculer le total et mettre à jour le champ lorsque la quantité change
    nombrePiecesInput.addEventListener("input", function() {
        var quantite = this.value || 0;
        totalInput.value = (prixUnitaire * quantite).toFixed(0) ;
    });
</script>


</body>
</html>
