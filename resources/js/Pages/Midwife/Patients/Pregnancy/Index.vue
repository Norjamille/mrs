<template>
    <MidwifeLayout title="Pregnancy">
        <div class="flex items-stretch flex-1 space-x-5 overflow-hidden">
            <main class="flex-1 overflow-y-auto">
                <div class="mx-auto ">
                    <div class="flex justify-between">
                        <PrimaryButtonLink>Add</PrimaryButtonLink>
                    </div>
                    <!-- Gallery -->
                    <div class="pb-16 mt-8">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. A, nulla omnis? Pariatur magnam quo,
                        nulla saepe adipisci illo quibusdam, quisquam cumque itaque possimus quia ab ipsam facilis hic
                        suscipit praesentium.
                    </div>
                </div>
            </main>

            <!-- Details sidebar -->
            <aside class="hidden p-8 overflow-y-auto bg-white border rounded-xl border-rose-200 w-96 lg:block">
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
                    <div class="flex">
                        <button type="button"
                            class="flex-1 px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Download</button>
                        <button type="button"
                            class="flex-1 px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Delete</button>
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
import Table from '@/Components/Table.vue';
import Tcell from '@/Components/Tcell.vue';
import EmptyTable from '@/Components/EmptyTable.vue';
import Pagination from '@/Components/Pagination.vue';
import { Link, router } from '@inertiajs/vue3';
import Confirm from '@/Components/Confirm.vue';
import { ref } from 'vue';
import { useDateFormat } from '@vueuse/core'


let props = defineProps({
    patient: Object
})

const formattedDateOfBirth = useDateFormat(props.patient.date_of_birth, 'MMM DD YYYY')

</script>
