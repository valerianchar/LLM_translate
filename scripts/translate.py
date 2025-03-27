import os
import sys
from mistralai import Mistral

# Récupérer la clé API depuis le .env
API_KEY = os.getenv("MISTRAL_API_KEY")

if not API_KEY:
    raise ValueError("La clé API Mistral est manquante dans les variables d'environnement")

# Initialiser le client Mistral
client = Mistral(api_key=API_KEY)

# Vérification des arguments
if len(sys.argv) != 3:
    print("Usage: python translate.py '<text>' '<target_language>'")
    sys.exit(1)

text = sys.argv[1]
target_language = sys.argv[2]

# Message à envoyer au modèle
messages = [
    {
        "role": "system",
        "content": "Tu es un traducteur professionnel. Réponds uniquement avec une liste de traductions possibles, sans phrase complète ni explication. Une ligne par traduction."
    },
    {
        "role": "user",
        "content": f"Traduis le texte suivant en {target_language} : {text}"
    }
]


try:
    response = client.chat.complete(model="mistral-medium", messages=messages)

    # Récupération de toutes les suggestions
    suggestions = [choice.message.content for choice in response.choices]

    # Retourner chaque suggestion sur une nouvelle ligne
    print("\n".join(suggestions))

except Exception as e:
    print(f"Erreur lors de la traduction : {str(e)}")
    sys.exit(1)
