<template>
    <MidwifeLayout title="Pregnancy">
        <div class="flex  flex-1 space-x-5 ">
            <main class="flex-1">
                <div class="mx-auto ">
                    <div class="flex justify-between">
                        <template v-if="!props.patient.current_pregnant_with">
                            <PrimaryButtonLink>Add</PrimaryButtonLink>
                        </template>
                    </div>
                    <div class="pb-16 mt-8 grid gap-5">
                        <div class="flex justify-between items-center">
                            <h1>
                                Pregnancy History
                            </h1>
                            <SecondaryButton @click="showDetails = !showDetails">
                                <div class="flex space-x-2">
                                    <ArrowLeftIcon v-if="!showDetails" class="h-4" />
                                    <span>{{ detailsToggleText }}</span>
                                    <ArrowRightIcon v-if="showDetails" class="h-4" />
                                </div>
                            </SecondaryButton>
                        </div>
                        <Table :headers="['Initial Visit', 'Baby Full Name', 'No. Months (Initial Visit)', 'status']">

                        </Table>
                    </div>
                </div>
            </main>

            <!-- Details sidebar -->
            <aside :class="{
                'w-96 p-8 border': showDetails,
                'w-0': !showDetails
            }"
                class="hidden  overflow-y-auto bg-white transform duration-150 ease-in-out  rounded-xl border-rose-200  lg:block">
                <div class="pb-16 space-y-6">
                    <div>
                        <div class="flex items-start justify-between ">
                            <div class="flex space-x-3">
                                <img :src="props.patient.user.profile_photo_url" class="h-12 rounded-full" alt="">
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-900">Information</h3>
                        <dl class="mt-2 border-t border-b border-gray-200 divide-y divide-gray-200">
                            <div class="flex justify-between py-3 text-sm font-medium">
                                <dt class="text-gray-500">
                                    First Name
                                </dt>
                                <dd class="text-gray-900 whitespace-nowrap">
                                    {{ props.patient.first_name }}
                                </dd>
                            </div>
                            <div class="flex justify-between py-3 text-sm font-medium">
                                <dt class="text-gray-500">
                                    Middle Name
                                </dt>
                                <dd class="text-gray-900 whitespace-nowrap">
                                    {{ props.patient.middle_name }}
                                </dd>
                            </div>
                            <div class="flex justify-between py-3 text-sm font-medium">
                                <dt class="text-gray-500">
                                    Last Name
                                </dt>
                                <dd class="text-gray-900 whitespace-nowrap">
                                    {{ props.patient.last_name }}
                                </dd>
                            </div>
                            <div class="flex justify-between py-3 text-sm font-medium">
                                <dt class="text-gray-500">
                                    Extension Name
                                </dt>
                                <dd class="text-gray-900 whitespace-nowrap">
                                    {{ props.patient.extention_name }}
                                </dd>
                            </div>
                            <div class="flex justify-between py-3 text-sm font-medium">
                                <dt class="text-gray-500">
                                    Address
                                </dt>
                                <dd class="text-gray-900 whitespace-nowrap">
                                    {{ props.patient.address }}
                                </dd>
                            </div>
                            <div class="flex justify-between py-3 text-sm font-medium">
                                <dt class="text-gray-500">
                                    Email
                                </dt>
                                <dd class="text-gray-900 whitespace-nowrap">
                                    {{ props.patient.email }}
                                </dd>
                            </div>
                            <div class="flex justify-between py-3 text-sm font-medium">
                                <dt class="text-gray-500">
                                    Contact Number
                                </dt>
                                <dd class="text-gray-900 whitespace-nowrap">
                                    {{ props.patient.contact_number }}
                                </dd>
                            </div>
                            <div class="flex justify-between py-3 text-sm font-medium">
                                <dt class="text-gray-500">
                                    Date Of Birth
                                </dt>
                                <dd class="text-gray-900 whitespace-nowrap">
                                    {{ formattedDateOfBirth }}
                                </dd>
                            </div>
                            <div class="flex justify-between py-3 text-sm font-medium">
                                <dt class="text-gray-500">
                                    Age
                                </dt>
                                <dd class="text-gray-900 whitespace-nowrap">
                                    {{ props.patient.age }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </aside>
        </div>
    </MidwifeLayout>
</template>

<script setup>
import MidwifeLayout from '@/Layouts/MidwifeLayout.vue';
import TextInput from '@/Components/TextInput.vue'
import PrimaryButtonLink from '@/Components/PrimaryButtonLink.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'

import Table from '@/Components/Table.vue';
import Tcell from '@/Components/Tcell.vue';
import EmptyTable from '@/Components/EmptyTable.vue';
import Pagination from '@/Components/Pagination.vue';
import { Link, router } from '@inertiajs/vue3';
import Confirm from '@/Components/Confirm.vue';
import { computed, ref } from 'vue';
import { useDateFormat } from '@vueuse/core'
import {
    ArrowLeftIcon,
    ArrowRightIcon
} from '@heroicons/vue/24/outline'

let showDetails = ref(true);

let detailsToggleText = computed(() => {
    return showDetails.value == true ? 'Hide Details' : 'Show Details'
})

let props = defineProps({
    patient: Object
})

const formattedDateOfBirth = useDateFormat(props.patient.date_of_birth, 'MMM DD YYYY')

</script>
