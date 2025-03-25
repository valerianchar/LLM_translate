<template>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md mt-10">
        <h1 class="text-2xl font-bold mb-4 text-gray-800">
            🌍 Traduction Automatique (depuis Mistral)
        </h1>

        <!-- Champ de texte -->
        <textarea
            v-model="text"
            placeholder="Saisissez le texte à traduire..."
            class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            rows="4"
        ></textarea>

        <!-- Sélection de la langue -->
        <select
            v-model="targetLanguage"
            class="w-full mt-3 p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
            <option value="fr">🇫🇷 Français</option>
            <option value="en">🇬🇧 Anglais</option>
            <option value="de">🇩🇪 Allemand</option>
            <option value="es">🇪🇸 Espagnol</option>
        </select>

        <!-- Bouton de soumission -->
        <button
            @click="translate"
            :disabled="loading"
            class="w-full mt-4 bg-blue-600 text-white font-semibold p-4 rounded-lg hover:bg-blue-700 transition duration-300 disabled:bg-gray-400 disabled:cursor-not-allowed"
        >
            {{ loading ? "Traduction en cours..." : "Traduire" }}
        </button>

        <!-- Affichage des suggestions -->
        <div v-if="results.length" class="mt-6 bg-gray-100 p-4 rounded-lg border-l-4 border-blue-500">
            <h2 class="font-semibold text-gray-700">Suggestions :</h2>
            <ol class="list-decimal list-inside mt-2">
                <li v-for="(result, index) in results" :key="index" class="mt-2 text-gray-800">
                    {{ result }}
                </li>
            </ol>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'
import { router } from '@inertiajs/vue3'

const text = ref('')
const targetLanguage = ref('fr')
const results = ref([])
const loading = ref(false)

const translate = async () => {
    if (!text.value || !targetLanguage.value) return
    loading.value = true

    try {
        const response = await axios.post(route('api.translate'), {
            text: text.value,
            targetLanguage: targetLanguage.value,
        })

        // ✅ Stocker plusieurs suggestions
        results.value = response.data.translatedTexts
    } catch (error) {
        console.error('Erreur lors de la traduction:', error)
        alert('Erreur lors de la traduction.')
    } finally {
        loading.value = false
    }
}
</script>
