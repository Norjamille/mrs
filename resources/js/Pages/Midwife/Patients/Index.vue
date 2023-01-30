<template>
    <MidwifeLayout title="Patients">
        <div>
            <div class="grid gap-4">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <TextInput type="text" placeholder="Search" />
                    </div>
                    <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                        <PrimaryButtonLink :href="route('midwife.patients.create')">New Patient</PrimaryButtonLink>
                    </div>
                </div>
                <Table :headers="['Pregnancy', 'Full Name', 'Contact Number', 'Email', 'Age', 'Status', 'Actions']">
                    <template v-for="patient in props.patients.data" :key="patient.id">
                        <tr>
                            <Tcell>
                                <SecondaryButtonLink
                                    :href="route('midwife.patients.pregnancies.history', { id: patient.id })">
                                    <ClockIcon class="h-5 mr-2" />
                                    <span>History</span>
                                </SecondaryButtonLink>
                            </Tcell>
                            <Tcell> {{ patient.fullName }} </Tcell>
                            <Tcell>{{ patient.contactNumber }}</Tcell>
                            <Tcell>{{ patient.email }}</Tcell>
                            <Tcell>{{ patient.age }}</Tcell>
                            <Tcell>
                                <span :class="{
                                    'bg-green-600 ': patient.status === 'Active',
                                    'bg-red-600 ': patient.status === 'Inactive',
                                }" class="px-3 py-1.5 text-white rounded-full">
                                    {{ patient.status }}
                                </span>
                            </Tcell>
                            <Tcell>
                                <div class="flex space-x-5">
                                    <Link :href="route('midwife.patients.edit', { id: patient.id })">
                                    <PencilIcon class="h-5 text-gray-500 hover:text-yellow-500" />
                                    </Link>
                                    <button @click="showConfirmDeletePatient(patient.id)">
                                        <TrashIcon class="h-5 text-gray-500 hover:text-red-600" />
                                    </button>
                                    <button>
                                        <EyeIcon class="h-5 text-gray-500 hover:text-teal-600" />
                                    </button>
                                </div>
                            </Tcell>
                        </tr>
                    </template>
                    <template v-if="props.patients.data.length === 0">
                        <EmptyTable colspan="7" />
                    </template>
                    <template #footer>
                        <Pagination :prev-url="patients.prev_page_url" :next-url="patients.next_page_url"
                            :from="patients.from" :to="patients.to" :total="patients.total" />
                    </template>
                </Table>
            </div>
        </div>
        <Confirm :show="confirmDeletePatient" title="Confirm" @cancel="closeDeleteModal" @confirm="confirmDelete"
            description="Are you sure you want do delete this patients?" />
    </MidwifeLayout>
</template>

<script setup>
import MidwifeLayout from '@/Layouts/MidwifeLayout.vue';
import TextInput from '@/Components/TextInput.vue'
import PrimaryButtonLink from '@/Components/PrimaryButtonLink.vue'
import Table from '@/Components/Table.vue';
import Tcell from '@/Components/Tcell.vue';
import EmptyTable from '@/Components/EmptyTable.vue';
import Pagination from '@/Components/Pagination.vue';
import { EyeIcon, PencilIcon, TrashIcon } from '@heroicons/vue/24/solid';
import { Link, router } from '@inertiajs/vue3';
import Confirm from '@/Components/Confirm.vue';
import { ref } from 'vue';
import SecondaryButtonLink from '../../../Components/SecondaryButtonLink.vue';
import {
    ClockIcon
} from '@heroicons/vue/24/outline'

let confirmDeletePatient = ref(false);
let patienId = ref(null);

const resetDeleteData = () => {
    confirmDeletePatient.value = false
    patienId.value = null
}

const showConfirmDeletePatient = (id) => {
    confirmDeletePatient.value = true
    patienId.value = id
}

const closeDeleteModal = () => {
    resetDeleteData();
}

const confirmDelete = () => {
    router.delete(route('midwife.patients.destroy', { id: patienId.value }))
    resetDeleteData();
}


let props = defineProps({
    patients: Object
})

</script>
