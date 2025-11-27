<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'

const props = defineProps({
  restaurants: {
    type: Array,
    default: () => []
  }
})
</script>

<template>
  <Head title="Home" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Home</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <div v-if="props.restaurants.length === 0" class="text-gray-500">
              No restaurants found.
            </div>

            <div v-else class="grid grid-cols-1 sm:grid-cols-3 gap-x-4 gap-y-8">
              <div v-for="restaurant in props.restaurants" :key="restaurant.id">
                <Link :href="route('restaurant', restaurant)" class="flex flex-col gap-2">
                  <div>
                    <img
                      class="w-full aspect-video rounded-xl"
                      :src="`https://picsum.photos/seed/${restaurant.id}/380/220?blur=2`"
                    />
                  </div>
                  <div class="font-bold text-lg truncate">
                    {{ restaurant.name }} ({{ restaurant.address }})
                  </div>
                </Link>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
