<template>
    <MidwifeLayout title="Edit Patients">
        <form @submit.prevent="submitHandler">
            <Card title="Patients Information">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="grid sm:col-span-1">
                        <FormInput v-model="form.firstName" :error="form.errors.firstName" label="First Name"
                            type="text" />
                    </div>
                    <div class="grid sm:col-span-1">
                        <FormInput v-model="form.middleName" :error="form.errors.middleName" label="Middle Name"
                            type="text" />
                    </div>
                    <div class="grid sm:col-span-1">
                        <FormInput v-model="form.lastName" :error="form.errors.lastName" label="Last Name"
                            type="text" />
                    </div>
                    <div class="grid sm:col-span-1">
                        <FormInput v-model="form.extensionName" :error="form.errors.extensionName"
                            label="Extension Name" type="text" />
                    </div>
                    <div class="grid sm:col-span-1">
                        <FormInput v-model="form.address" :error="form.errors.address" label="Address" type="text" />
                    </div>
                    <div class="grid sm:col-span-1">
                        <FormInput v-model="form.email" :error="form.errors.email" label="Email" type="email" />
                    </div>
                    <div class="grid sm:col-span-1">
                        <FormInput v-model="form.contactNumber" :error="form.errors.contactNumber"
                            label="Contact Number" type="number" />
                    </div>
                    <div class="grid sm:col-span-1">
                        <FormInput v-model="form.dateOfBirth" :error="form.errors.dateOfBirth" label="Date of Birth"
                            type="date" />
                    </div>
                </div>
                <template #footer>
                    <div class="flex space-x-2">
                        <PrimaryButton :disabled="form.processing">Submit</PrimaryButton>
                        <SecondaryButtonLink :href="route('midwife.patients')">Cancel</SecondaryButtonLink>
                    </div>
                </template>
            </Card>
        </form>
    </MidwifeLayout>
</template>

<script setup>
import MidwifeLayout from '@/Layouts/MidwifeLayout.vue';
import TextInput from '@/Components/TextInput.vue'
import Card from '@/Components/Card.vue';
import FormInput from '@/Components/FormInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButtonLink from '@/Components/SecondaryButtonLink.vue';
import { useForm } from '@inertiajs/vue3';

let props = defineProps({
    patient: Object,
})

let form = useForm({
    id: props.patient.id,
    firstName: props.patient.first_name,
    middleName: props.patient.middle_name,
    lastName: props.patient.last_name,
    extensionName: props.patient.extension_name,
    address: props.patient.address,
    email: props.patient.email,
    contactNumber: props.patient.contact_number,
    dateOfBirth: props.patient.date_of_birth,
})

const submitHandler = () => {
    form.patch(route('midwife.patients.update', { id: props.patient.id }));
}
</script>
