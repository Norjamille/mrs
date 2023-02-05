<template>
    <MidwifeLayout title="Patient's Schedules">
        <div class="flex space-x-5">
            <div class="w-full">
                <Table :headers="['Date', 'Description', 'Status', 'Action']">
                    <template v-for="schedule in props.schedules.data" :key="schedule.id">
                        <tr>
                            <Tcell> {{ schedule.date_at }} </Tcell>
                            <Tcell> {{ schedule.description }} </Tcell>

                            <Tcell>
                                {{ schedule.status }}
                            </Tcell>
                            <Tcell>
                                <Link>
                                </Link>
                            </Tcell>
                        </tr>
                    </template>
                    <template v-if="props.schedules.data.length === 0">
                        <EmptyTable colspan="7" />
                    </template>
                    <template #footer>
                        <Pagination :prev-url="schedules.prev_page_url" :next-url="schedules.next_page_url"
                            :from="schedules.from" :to="schedules.to" :total="schedules.total" />
                    </template>
                </Table>
            </div>
            <div class="w-[1000px]">
                <section class="p-5 bg-white border shadow-sm rounded-xl">
                    <h2 class="font-semibold text-gray-900">
                        Add Check Up Schedules
                    </h2>
                    <form @submit.prevent="handleSaveSchedule" class="gap-4 mt-5 sm:grid">
                        <FormTextarea placeholder="Describe yourself here..." v-model="form.description"
                            :error="form.errors.description" label="Description" />
                        <FormInput label="Select Date" v-model="form.date" :error="form.errors.date"
                            type="datetime-local" />
                        <div class="flex justify-end">
                            <PrimaryButton :disabled="form.processing" type="submit">Save</PrimaryButton>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </MidwifeLayout>
</template>

<script setup>
import MidwifeLayout from '@/Layouts/MidwifeLayout.vue';
import { ref, computed } from 'vue';
import Table from '@/Components/Table.vue';
import Tcell from '@/Components/Tcell.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

import EmptyTable from '@/Components/EmptyTable.vue';
import Pagination from '@/Components/Pagination.vue';
import { useForm } from '@inertiajs/vue3';
import FormTextarea from '@/Components/FormTextarea.vue';
import FormInput from '@/Components/FormInput.vue';
const formatter = ref({
    date: 'DD MMM YYYY hh:mm:s A',
    month: 'MMM'
})
let props = defineProps({
    patient: Object,
    schedules: Object,
})

let form = useForm({
    description: '',
    date: '',
    patientId: props.patient.id
})

const handleSaveSchedule = () => {
    form.post(route('midwife.patients.schedules.store'))
    form.reset()
}

</script>
