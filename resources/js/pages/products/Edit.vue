<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Label from '@/components/ui/label/Label.vue';
import Input from '@/components/ui/input/Input.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { disable } from '@/routes/two-factor';

interface Product {
  id: number;
  name: string;
  subject: string;
  score: number;
}

const props = defineProps<{ product: Product }>();

const form = useForm({
  name: props.product.name,
  subject: props.product.subject,
  score: props.product.score,
})

const handleSubmit = () => {
  console.log(form)
  form.put(`/products/${props.product.id}`)
}

</script>

<template>

  <Head title="Edit a Product" />

  <AppLayout :breadcrumbs="[
    {
      title: 'Edit a Products',
      href: `/products/${props.product.id}/edit`,
    },
  ]">
    <div class="p-4">
      <form @submit.prevent="handleSubmit" class="w-8/12 space-y-4">
        <div class="space-y-2">
          <Label for="Name">Name</Label>
          <Input v-model="form.name" type="text" placeholder="Name" />
          <div v-if="form.errors.name">{{ form.errors.name }}</div>
        </div>
        <div class="space-y-2">
          <Label for="Subject">Subject</Label>
          <Input v-model="form.subject" type="text" placeholder="Subject" />
          <div v-if="form.errors.subject">{{ form.errors.subject }}</div>
        </div>
        <div class="space-y-2">
          <Label for="Score">Score</Label>
          <Input v-model="form.score" type="number" placeholder="Score" />
          <div v-if="form.errors.score">{{ form.errors.score }}</div>
        </div>
        <Button type="submit" :disabled="form.processing">Edit</Button>
      </form>
    </div>
  </AppLayout>
</template>
