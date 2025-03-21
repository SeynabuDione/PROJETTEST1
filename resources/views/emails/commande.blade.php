<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Merci pour votre commande !</h1>
    </div>

    <div class="content">
        <p>Bonjour {{ $client->prenom }} {{ $client->nom }},</p>
        <p>Nous avons bien reçu votre commande. Vous trouverez ci-joint le récapitulatif de celle-ci sous forme de PDF.</p>

        <p>Voici les détails de votre commande :</p>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px;">Nom du produit</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Quantité</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Prix unitaire</th>
            </tr>
            @foreach ($commandes->produits as $produit)
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $produit->nom }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $produit->pivot->quantite }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</td>
            </tr>
            @endforeach
        </table>

        <p><strong>Total : </strong>{{ number_format($commandes->total, 0, ',', ' ') }} FCFA</p>
    </div>

    <div class="footer">
        <p>Si vous avez des questions, n'hésitez pas à nous contacter.</p>
        <p>Merci pour votre confiance !</p>
    </div>
</body>
</html>
