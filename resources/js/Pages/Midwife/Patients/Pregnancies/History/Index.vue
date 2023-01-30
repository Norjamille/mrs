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
                <PrimaryButton v-if="!props.patient.current_pregnant_with">
                    Add new
                </PrimaryButton>
            </div>
            <Table :headers="['First check-up at', 'Baby Name', 'Status', 'Actions']">
                <template v-for="pregnancy in props.pregnancies.data" :key="pregnancy.id">
                    <tr>
                        <Tcell> {{ pregnancy.first_check_up_at }} </Tcell>
                        <Tcell>{{ pregnancy.baby_first_name }}</Tcell>
                        <Tcell>{{ pregnancy.status }}</Tcell>
                        <Tcell>
                            <div class="flex space-x-5">
                                <button>
                                    <EyeIcon class="h-5 text-gray-500 hover:text-teal-600" />
                                </button>
                            </div>
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
    </MidwifeLayout>
</template>

<script setup>
import MidwifeLayout from '@/Layouts/MidwifeLayout.vue';
import TextInput from '@/Components/TextInput.vue'
import PrimaryButtonLink from '@/Components/PrimaryButtonLink.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import Card from '@/Components/Card.vue'

import Table from '@/Components/Table.vue';
import Tcell from '@/Components/Tcell.vue';
import EmptyTable from '@/Components/EmptyTable.vue';
import Pagination from '@/Components/Pagination.vue';
import { Link, router } from '@inertiajs/vue3';
import Confirm from '@/Components/Confirm.vue';
import { computed, ref } from 'vue';
import PrimaryButton from '../../../../../Components/PrimaryButton.vue';

let props = defineProps({
    patient: Object,
    pregnancies: Object
})

</script>
