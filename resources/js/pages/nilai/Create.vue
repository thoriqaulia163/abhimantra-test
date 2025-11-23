<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Label from '@/components/ui/label/Label.vue';
import Input from '@/components/ui/input/Input.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { disable } from '@/routes/two-factor';
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Tambah nilai',
    href: '/daftar-nilai/create',
  },
];

const form = useForm({
  siswa_id: '',
  kelas: '',
  mapel: '',
  nilai: '',
})

const handleSubmit = () => {
  // console.log(form)
  form.post('/daftar-nilai')
}

interface Siswa {
  id: number,
  nama: string,
  kelas: number,
}

interface Props {
  siswas: Siswa[];
}

const props = defineProps<Props>()
console.log(props)
</script>

<template>

  <Head title="Tambah Nilai" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-4">
      <form @submit.prevent="handleSubmit" class="w-8/12 space-y-4">
        <div class="space-y-2">
          <Label for="siswa">siswa</Label>
          <Select v-model="form.siswa_id">
            <SelectTrigger>
              <SelectValue placeholder="Pilih Siswa" />
            </SelectTrigger>
            <SelectContent v-for="siswa in props.siswas" :key="siswa.id">
              <SelectItem :value="siswa.id">{{ siswa.nama }}</SelectItem>
            </SelectContent>
          </Select>
        </div>

        <div class="space-y-2">
          <Label for="mapel">mapel</Label>
          <Input v-model="form.mapel" type="text" placeholder="mapel" />
          <div v-if="form.errors.mapel">{{ form.errors.mapel }}</div>
        </div>

        <div class="space-y-2">
          <Label for="kelas">kelas</Label>
          <Input v-model="form.kelas" type="number" placeholder="kelas" />
          <div v-if="form.errors.kelas">{{ form.errors.kelas }}</div>
        </div>

        <div class="space-y-2">
          <Label for="nilai">nilai</Label>
          <Input v-model="form.nilai" type="number" placeholder="nilai" />
          <div v-if="form.errors.nilai">{{ form.errors.nilai }}</div>
        </div>

        <Button type="submit" :disabled="form.processing">Add</Button>

      </form>
    </div>
  </AppLayout>
</template>
