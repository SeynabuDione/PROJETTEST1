<x-mail::message>
# Commande Confirmée 🎉

Bonjour **{{ $commande->client->prenom }} {{ $commande->client->nom }}**,

Votre commande a bien été enregistrée ! Voici les détails :

- **Produit :** {{ $commande->produit->nom }}
- **Quantité :** {{ $commande->quantite }}
- **Prix total :** {{ number_format($commande->total, 0, ',', ' ') }} FCFA
- **Date :** {{ $commande->created_at->format('d/m/Y H:i') }}

Vous pouvez télécharger votre facture en cliquant sur le bouton ci-dessous.

<x-mail::button :url="route('telecharger.facture', ['id' => $commande->id])">
Télécharger la Facture
</x-mail::button>

Merci pour votre confiance ! 😊

**L'équipe {{ config('app.name') }}**  
</x-mail::message>
