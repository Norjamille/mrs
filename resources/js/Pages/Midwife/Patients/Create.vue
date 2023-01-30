<template>
    <MidwifeLayout title="Create Patients">
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
                        <FormSelect v-model="form.purokId" :error="form.errors.purokId" label="Purok">
                            <option v-for="purok in puroks" :key="purok.id" :value="purok.id">
                                {{ purok.name }}
                            </option>
                        </FormSelect>
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
                        <PrimaryButton :loading-on="form.processing" :disabled="form.processing">
                            Submit
                        </PrimaryButton>
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
import FormSelect from '../../../Components/FormSelect.vue';

let props = defineProps({
    puroks: Object
})

let form = useForm({
    firstName: '',
    middleName: '',
    lastName: '',
    extensionName: '',
    address: '',
    purokId: '',
    email: '',
    contactNumber: '',
    dateOfBirth: '',
})

const submitHandler = () => {
    form.post(route('midwife.patients.store'));
}
</script>
