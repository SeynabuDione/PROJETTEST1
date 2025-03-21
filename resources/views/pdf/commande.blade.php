<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande #{{ $commande->id }}</title>
</head>
<body>
    <h1>Commande #{{ $commande->id }}</h1>
    <p>Nom Client: {{ $commande->client->nom }}</p>
    <p>Prénom Client: {{ $commande->client->prenom }}</p>
    <p>Téléphone Client: {{ $commande->client->telephone }}</p>
    <p>Email Client: {{ $commande->client->email }}</p>

    <h2>Produits</h2>
    <ul>
        @foreach ($commande->produits as $produit)
            <li>{{ $produit->nom }} ({{ $produit->pivot->quantite }} x {{ number_format($produit->prix, 0, ',', ' ') }} FCFA)</li>
        @endforeach
    </ul>

    <h3>Total: {{ number_format($commande->total, 0, ',', ' ') }} FCFA</h3>

    <!-- Formulaire pour envoyer par email -->
    <form action="{{ route('commande.sendEmail', $commande->id) }}" method="POST">
        @csrf
        <button type="submit">Envoyer par email</button>
    </form>
</body>
</html>
