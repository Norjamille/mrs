<template>
    <MidwifeLayout title="Schedules">
        <div>
            <div class="grid gap-4">
                <div class="sm:flex sm:items-center">
                    <div class="flex-auto space-x-4">
                        <TextInput type="text" placeholder="Search" />
                        <TextInput type="date" />
                    </div>
                    <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                        <PrimaryButtonLink>New Patient</PrimaryButtonLink>
                    </div>
                </div>
                <Table :headers="['Patient Full Name', 'Date', 'Description', 'Status', 'Actions']">
                    <template v-for="schedule in props.schedules.data" :key="schedule.id">
                        <tr>
                            <Tcell> {{ schedule.patient_full_name }} </Tcell>
                            <Tcell>{{ schedule.date }}</Tcell>
                            <Tcell>{{ schedule.description }}</Tcell>
                            <Tcell>{{ schedule.status }}</Tcell>
                            <Tcell>
                                <!-- <div class="flex space-x-5">
                                    <Link :href="route('midwife.patients.edit', { id: patient.id })">
                                    <PencilIcon class="h-5 text-gray-500 hover:text-yellow-500" />
                                    </Link>
                                    <button @click="showConfirmDeletePatient(patient.id)">
                                        <TrashIcon class="h-5 text-gray-500 hover:text-red-600" />
                                    </button>
                                    <button>
                                        <EyeIcon class="h-5 text-gray-500 hover:text-teal-600" />
                                    </button>
                                </div> -->
                                <button>
                                    <EyeIcon class="h-5 text-gray-500 hover:text-teal-600" />
                                </button>
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
        </div>
    </MidwifeLayout>
</template>

<script setup>
import MidwifeLayout from '@/Layouts/MidwifeLayout.vue';
import Table from '@/Components/Table.vue';
import Tcell from '@/Components/Tcell.vue';
import EmptyTable from '@/Components/EmptyTable.vue';
import Pagination from '@/Components/Pagination.vue';
import PrimaryButtonLink from '@/Components/PrimaryButtonLink.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';


let props = defineProps({
    schedules: Object,
})
</script>
