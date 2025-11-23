<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Label from '@/components/ui/label/Label.vue';
import Input from '@/components/ui/input/Input.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { disable } from '@/routes/two-factor';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Tambah siswa',
        href: '/daftar-nilai/create-siswa',
    },
];

const form = useForm({
  nama: '',
  kelas: '',
})

const handleSubmit =()=>{
  // console.log(form)
  form.post('/daftar-nilai-siswa')
}

</script>

<template>
    <Head title="Tambah Siswa" />

    <AppLayout :breadcrumbs="breadcrumbs">
       <div class="p-4">
          <form @submit.prevent="handleSubmit" class="w-8/12 space-y-4">
            <div class="space-y-2">
              <Label for="nama">nama</Label>
              <Input v-model="form.nama" type="text" placeholder="nama"/>
               <div v-if="form.errors.nama">{{ form.errors.nama }}</div>
            </div>
            <div class="space-y-2">
              <Label for="kelas">kelas</Label>
              <Input v-model="form.kelas" type="number" placeholder="kelas"/>
              <div v-if="form.errors.kelas">{{ form.errors.kelas }}</div>
            </div>
            <Button type="submit" :disabled="form.processing" >Add</Button>
          </form>
        </div>
    </AppLayout>
</template>
