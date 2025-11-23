<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import { Rocket } from 'lucide-vue-next';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { edit } from '@/actions/App/Http/Controllers/ProductController';
import { create } from '@/actions/App/Http/Controllers/ProductController';
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

interface Product{
  id:number,
  name: string,
  subject:string,
  score: number,
}

interface Props{
  products: Product[];
}

const props = defineProps<Props>()

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Products',
    href: '/products',
  },
];

const page = usePage();

const handleDelete =(productId:number)=>{
  if(confirm("do you want to delete this student?")){
    router.delete(`/products/${productId}`)
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
        <Link :href="create()"><Button>Create a product</Button></Link>
      </div>

      <div>
        <Table>
          <TableCaption>list of your recent products</TableCaption>
          <TableHeader>
            <TableRow>
              <TableHead class="w-[100px]">
                ID
              </TableHead>
              <TableHead>Name</TableHead>
              <TableHead>Subject</TableHead>
              <TableHead>Score</TableHead>
              <TableHead class="text-center">
                Action
              </TableHead>
            </TableRow>
          </TableHeader>
          <TableBody>
            <TableRow v-for="product in props.products" :key="product.id">
              <TableCell class="font-medium">
                {{product.id}}
              </TableCell>
              <TableCell> {{product.name}}</TableCell>
              <TableCell> {{product.subject}}</TableCell>
              <TableCell> {{product.score}}</TableCell>
              <TableCell class="text-center">
                <Link :href="edit(product.id)" ><Button class="bg-amber-400">Edit</Button></Link>
                <Button class="ml-2 bg-red-600" @click="handleDelete(product.id)">Delete</Button>
              </TableCell>
            </TableRow>
          </TableBody>
        </Table>
      </div>
    </div>
  </AppLayout>
</template>
