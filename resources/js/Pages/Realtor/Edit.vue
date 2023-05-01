<template>
    <form @submit.prevent="update">
      <div class="grid grid-col-6 gap-4">
        <div class="col-span-2">
          <label class="label">Beds</label>
          <input type="text" v-model.number="form.beds" class="input"/>
          <FormErrorMessage v-if="form.errors.beds" :error="form.errors.beds" />
        </div>

        <div class="col-span-2">
          <label class="label">Baths</label>
          <input type="text" v-model.number="form.baths" class="input"/>
          <FormErrorMessage v-if="form.errors.baths" :error="form.errors.baths" />
        </div>

        <div class="col-span-2">
          <label class="label">Area</label>
          <input type="text" v-model.number="form.area" class="input"/>
          <FormErrorMessage v-if="form.errors.area" :error="form.errors.area" />
        </div>

        <div class="col-span-4">
          <label class="label">City</label>
          <input type="text" v-model="form.city" class="input"/>
          <FormErrorMessage v-if="form.errors.city" :error="form.errors.city" />
        </div>

        <div class="col-span-2">
          <label class="label">Post Code</label>
          <input type="text" v-model="form.code" class="input"/>
          <FormErrorMessage v-if="form.errors.code" :error="form.errors.code" />
        </div>

        <div class="col-span-4">
          <label class="label">Street</label>
          <input type="text" v-model="form.street" class="input"/>
          <FormErrorMessage v-if="form.errors.sreet" :error="form.errors.street" />
        </div>

        <div class="col-span-2">
          <label class="label">Street Nr</label>
          <input type="text" v-model.number="form.street_nr" class="input"/>
          <FormErrorMessage v-if="form.errors.street_nr" :error="form.errors.street_nr" />
        </div>

        <div class="col-span-6">
          <label class="label">Price</label>
          <input type="text" v-model.number="form.price" class="input"/>
          <FormErrorMessage v-if="form.errors.price" :error="form.errors.price" />
        </div>

        <div class="col-span-6">
          <button type="submit" class="btn-primary">Update</button>
        </div>
      </div>
    </form>
  </template>

<script setup>
    import {reactive} from 'vue'
    import {useForm} from '@inertiajs/vue3'
    import FormErrorMessage from '@/Components/FormErrorMessage.vue';

    const props = defineProps({
        listing: Object
    })

    const form = useForm({
        beds: props.listing.beds,
        baths: props.listing.baths,
        area: props.listing.area,
        city: props.listing.city,
        street: props.listing.street,
        code: props.listing.code,
        street_nr: props.listing.street_nr,
        price: props.listing.price,
    })

    const update = () => form.put(route('realtor.listing.update', {listing: props.listing.id}))
</script>
