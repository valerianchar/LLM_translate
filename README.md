# 🌍 Application de Traduction IA (Laravel + Sail + Mistral + Vue.js)

Cette application permet de traduire du texte en plusieurs langues à l’aide d’un script Python connecté à l’API de Mistral. Elle est construite avec Laravel en API, Vue 3 côté frontend et Docker via Laravel Sail.

---

## 🚀 Fonctionnalités

- Traduction automatique d’un texte vers une langue cible.
- Utilisation de **Mistral API** (LLM) pour générer plusieurs traductions possibles.
- Résultats affichés sous forme de **liste** dans une interface moderne Vue 3.
- Communication Laravel ↔ Python via `Symfony Process`.
- Conteneur Docker Laravel Sail prêt à l’emploi.

---

## 🧾 Prérequis

- [Docker](https://www.docker.com/) installé sur ta machine.

---

---

## 🐳 Lancer l'application avec Sail

### 1. Installer les dépendances PHP et JS

```bash
./vendor/bin/sail up -d
./vendor/bin/sail composer install
./vendor/bin/sail npm install && ./vendor/bin/sail npm run dev
```

### 2. Générer la clé d'application Laravel

```bash
./vendor/bin/sail artisan key:generate
```

### 3. Démarrer le serveur en développement

```bash
./vendor/bin/sail up
```

- Frontend (Vue.js) compilé via Vite : http://localhost
- API Laravel : http://localhost/api/translate

---

## 💡 Comment ça marche ?

- L’utilisateur saisit un texte dans le frontend Vue 3.
- Il sélectionne une langue cible.
- Un appel est fait vers `/api/translate`.
- Laravel appelle un **script Python** avec les arguments (texte + langue).
- Le script utilise **MistralClient** pour générer plusieurs traductions.
- Le JSON renvoyé contient une **liste de traductions**.

---

## 🐍 Script Python

Situé dans `scripts/translate.py`, il utilise la lib `mistralai` :

```bash
python3 scripts/translate.py "Bonjour" "en"
```

---

## 📦 Stack technique

- **Laravel** 11 (API only)
- **Vue 3 + Composition API**
- **Inertia.js**
- **Tailwind CSS**
- **Python 3.12**
- **Mistral AI**
- **Docker + Sail**

---

## 📌 Astuce utile

Pour exécuter un script dans le conteneur :

```bash
./vendor/bin/sail shell
python3 scripts/translate.py "test" "en"
```

---

## 🤖 Auteur

Développé par toi-même avec passion ❤️ et un peu d’IA (Génération du README par CHATGPT).

---

## 🛟 Ressources utiles

- [Laravel Sail](https://laravel.com/docs/sail)
- [Mistral API](https://docs.mistral.ai/)
- [Vue 3 Documentation](https://vuejs.org/guide/introduction.html)

--- 

## 🏭URL de production

