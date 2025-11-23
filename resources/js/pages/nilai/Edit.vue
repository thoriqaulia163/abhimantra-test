<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Label from '@/components/ui/label/Label.vue';
import Input from '@/components/ui/input/Input.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { disable } from '@/routes/two-factor';

interface Siswa{
  id:number,
  nama:string,
  kelas:number,
}

interface Nilai{
  id:number,
  siswa: Siswa
  kelas: number,
  mapel:string,
  nilai: number,
}

const props = defineProps<{ nilai: Nilai }>();

const form = useForm({
  kelas: props.nilai.kelas,
  mapel: props.nilai.mapel,
  nilai: props.nilai.nilai,
})

const handleSubmit = () => {
  console.log(form)
  form.put(`/daftar-nilai/${props.nilai.id}`)
}

</script>

<template>

  <Head title="Edit Nilai" />

  <AppLayout :breadcrumbs="[
    {
      title: 'Edit Nilai',
      href: `/daftar-nilai/${props.nilai.id}/edit`,
    },
  ]">
    <div class="p-4">
      <form @submit.prevent="handleSubmit" class="w-8/12 space-y-4">
        <div class="space-y-2">
          <Label for="kelas">Kelas</Label>
          <Input v-model="form.kelas" type="text" placeholder="kelas" />
          <div v-if="form.errors.kelas">{{ form.errors.kelas }}</div>
        </div>
        <div class="space-y-2">
          <Label for="mapel">Mapel</Label>
          <Input v-model="form.mapel" type="text" placeholder="mapel" />
          <div v-if="form.errors.mapel">{{ form.errors.mapel }}</div>
        </div>
        <div class="space-y-2">
          <Label for="nilai">Nilai</Label>
          <Input v-model="form.nilai" type="number" placeholder="nilai" />
          <div v-if="form.errors.nilai">{{ form.errors.nilai }}</div>
        </div>
        <Button type="submit" :disabled="form.processing">Edit</Button>
      </form>
    </div>
  </AppLayout>
</template>
