<template>
    <MidwifeLayout title="Pregnancies History">
        <div class="grid gap-5">
            <div class="p-3 bg-white border border-gray-200 rounded-lg shadow-sm">
                <div class="flex space-x-3">
                    <span class="text-xl text-gray-600">Patient Name: </span>
                    <h1 class="text-xl font-extrabold text-rose-600">
                        {{ props.patient.full_name }}
                    </h1>
                </div>
            </div>
            <div>
                <PrimaryButtonLink :href="route('midwife.patients.pregnancies.history.new-pregnancy', {
                    id: patient.id,
                    refererUrl: $page.url
                })" v-if="!props.patient.current_pregnant_with">
                    Add new
                </PrimaryButtonLink>
            </div>
            <Table :headers="['First check-up at', 'Baby Name', 'months', 'Status', 'Action']">
                <template v-for="pregnancy in props.pregnancies.data" :key="pregnancy.id">
                    <tr>
                        <Tcell> {{ formateFirstCheckUpAt(pregnancy.firstCheckUpAt) }} </Tcell>
                        <Tcell>
                            <div class="flex items-center space-x-2">
                                <span>{{ pregnancy.baby_full_name }}</span>
                                <Link class="text-yellow-500 flex space-x-1">
                                <span>Edit</span>
                                <PencilIcon class="h-5 text-yellow-500" />
                                </Link>
                            </div>
                        </Tcell>
                        <Tcell>
                            <div class="flex items-center space-x-2">
                                <span>{{ pregnancy.status }}</span>
                                <div title="current" v-if="pregnancy.birth_id == props.patient.current_pregnant_with"
                                    class="flex animate-pulse">
                                    <span class="p-2 bg-red-600 rounded-full"></span>
                                </div>
                            </div>
                        </Tcell>
                        <Tcell>{{ pregnancy.current_months_of_pregnancy }} </Tcell>
                        <Tcell>
                            <Link>
                            <PencilIcon class="h-5 text-gray-500 hover:text-yellow-500" />
                            </Link>
                        </Tcell>
                    </tr>
                </template>
                <template v-if="props.pregnancies.data.length === 0">
                    <EmptyTable colspan="7" />
                </template>
                <template #footer>
                    <Pagination :prev-url="pregnancies.prev_page_url" :next-url="pregnancies.next_page_url"
                        :from="pregnancies.from" :to="pregnancies.to" :total="pregnancies.total" />
                </template>
            </Table>
        </div>
        <Modal :show="showEditBabyNameModal">
            <form>
                <Card title="Update Baby Information">
                    <div class="flex flex-col space-y-3">
                        <FormInput label="First Name" type="text" />
                        <FormInput label="Middle Name" type="text" />
                        <FormInput label="Last Name" type="text" />
                    </div>
                </Card>
            </form>
        </Modal>
    </MidwifeLayout>
</template>

<script setup>
import MidwifeLayout from '@/Layouts/MidwifeLayout.vue';
import PrimaryButtonLink from '@/Components/PrimaryButtonLink.vue'
import Modal from '@/Components/Modal.vue';
import Card from '@/Components/Card.vue';

import Table from '@/Components/Table.vue';
import Tcell from '@/Components/Tcell.vue';
import EmptyTable from '@/Components/EmptyTable.vue';
import Pagination from '@/Components/Pagination.vue';
import { useDateFormat } from '@vueuse/core'
import { Link, useForm } from '@inertiajs/vue3';
import { PencilIcon } from '@heroicons/vue/24/solid';
import FormInput from '@/Components/FormInput.vue';
import { ref } from 'vue';

let showEditBabyNameModal = ref(true);

let babyInfoForm = useForm({
    firstName: '',
    middleName: '',
    lastName: '',
})


const formateFirstCheckUpAt = (date) => {
    return useDateFormat(date, 'MMM DD YYYY');
}
let props = defineProps({
    patient: Object,
    pregnancies: Object
})

</script>
