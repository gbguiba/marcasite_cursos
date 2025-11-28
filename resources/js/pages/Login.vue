<template>
  <div class="min-h-screen bg-gray-100 flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-white shadow-2xl rounded-2xl p-8 space-y-6">

      <h2 class="text-center text-3xl font-bold text-gray-800">
        Entrar
      </h2>

      <form @submit.prevent="login" class="space-y-5">

        <div>
          <label class="block text-gray-700 font-medium">Email</label>
          <input 
            v-model="email"
            type="email"
            class="w-full mt-1 px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
            placeholder="Seu email"
          />
        </div>

        <div>
          <label class="block text-gray-700 font-medium">Senha</label>
          <input 
            v-model="password"
            type="password"
            class="w-full mt-1 px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
            placeholder="••••••••"
          />
        </div>

        <button
          type="submit"
          class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition-all shadow-lg"
        >
          Acessar
        </button>

        <p v-if="error" class="text-red-600 text-center font-medium">
          {{ error }}
        </p>

      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const email = ref('')
const password = ref('')
const error = ref('')

const login = async () => {
  error.value = ''

  try {

    const response = await axios.post('auth/login', {
      email: email.value,
      password: password.value,
    })

    console.log('Logado!', response.data)

    await fetch('/courses', {
      credentials: 'include',
    });

    window.location.href = '/'
    
  } catch (err) {
    error.value = 'Email ou senha inválidos.'
  }
}
</script>
