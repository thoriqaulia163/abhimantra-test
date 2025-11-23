<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import { Rocket } from 'lucide-vue-next';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { create, createsiswa, edit } from '@/actions/App/Http/Controllers/SekolahController';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableFooter,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'

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

interface Props{
  nilais: Nilai[];
}

const props = defineProps<Props>()
console.log(props)

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Daftar nilai',
    href: '/daftar-nilai',
  },
];

const page = usePage();

const handleDelete =(nilaiId:number)=>{
  if(confirm("apakah yakin ingin menghapus nilai ini?")){
    router.delete(`/daftar-nilai/${nilaiId}`)
  }
}

</script>

<template>

  <Head title="Products" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-4">

      <div v-if="page.props.flash?.message" class="mb-4">
        <Alert>
          <Rocket class="h-4 w-4" />
          <AlertTitle>Notification!</AlertTitle>
          <AlertDescription>
            {{ page.props.flash?.message }}
          </AlertDescription>
        </Alert>
      </div>

      <div class="mb-4">
        <Link :href="create()"><Button>Tambah Nilai</Button></Link>
        <Link class="ml-2" :href="createsiswa()"><Button class="bg-blue-500">Tambah Siswa</Button></Link>
      </div>

      <div>
        <Table>
          <TableCaption>daftar nilai siswa</TableCaption>
          <TableHeader>
            <TableRow>
              <TableHead class="w-[100px]">
                ID
              </TableHead>
              <TableHead>Nama</TableHead>
              <TableHead>Mapel</TableHead>
              <TableHead>Nilai</TableHead>
              <TableHead class="text-center">
                Action
              </TableHead>
            </TableRow>
          </TableHeader>
          <TableBody>
            <TableRow v-for="nilai in props.nilais" :key="nilai.id">
              <TableCell class="font-medium">
                {{nilai.id}}
              </TableCell>
              <TableCell> {{nilai.siswa?.nama}}</TableCell>
              <TableCell> {{nilai.mapel}}</TableCell>
              <TableCell> {{nilai.nilai}}</TableCell>
              <TableCell class="text-center">
                <Link :href="edit(nilai.id)" ><Button class="bg-amber-400">Edit</Button></Link>
                <Button class="ml-2 bg-red-600" @click="handleDelete(nilai.id)">Delete</Button>
              </TableCell>
            </TableRow>
          </TableBody>
        </Table>
      </div>
    </div>
  </AppLayout>
</template>
