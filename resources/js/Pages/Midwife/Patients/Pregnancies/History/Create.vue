<template>
    <MidwifeLayout title="New Pregnancy">
        <form @submit.prevent="handleSubmit">
            <Card title="Pregnancy Information">
                <div class="grid grid-cols-2 gap-4">
                    <div class="grid sm:col-span-1">
                        <FormInput v-model="form.firstCheckUpAt" :error="form.errors.firstCheckUpAt"
                            label="Initial check up date" type="date" />
                    </div>
                    <div class="grid sm:col-span-1">
                        <FormInput v-model="form.months" :error="form.errors.months" label="No. of months"
                            type="number" />
                    </div>
                    <div class="grid sm:col-span-1">
                        <FormSelect v-model="form.status" :error="form.errors.status" label="Status">
                            <option value="" hidden></option>
                            <option v-for="(status, index) in props.statuses" :key="index" :value="index">
                                {{ status }}
                            </option>
                        </FormSelect>
                    </div>
                    <div class="grid sm:col-span-1">
                        <FormInput v-model="form.noOfBabies" :error="form.errors.noOfBabies" label="No. of babies"
                            type="number" />
                    </div>
                </div>
                <template #footer>
                    <div class="flex space-x-2">
                        <PrimaryButton>
                            Submit
                        </PrimaryButton>
                        <SecondaryButtonLink :href="props.refererUrl">Cancel</SecondaryButtonLink>
                    </div>
                </template>
            </Card>
        </form>
    </MidwifeLayout>
</template>

<script setup>
import MidwifeLayout from '@/Layouts/MidwifeLayout.vue';
import Card from '@/Components/Card.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButtonLink from '@/Components/SecondaryButtonLink.vue';
import FormInput from '@/Components/FormInput.vue';
import FormSelect from '@/Components/FormSelect.vue';
import { useForm } from '@inertiajs/vue3';
import { useNow, useDateFormat } from '@vueuse/core'

let props = defineProps({
    patient: Object,
    refererUrl: String,
    statuses: Object
})

let dateNow = useDateFormat(useNow(), 'YYYY-MM-DD');

let form = useForm({
    patientId: props.patient.id,
    firstCheckUpAt: dateNow.value,
    months: '',
    status: '',
    noOfBabies: 1,
    refererUrl: props.refererUrl
})

const handleSubmit = () => {
    form.post(route('midwife.patients.pregnancies.new-pregnancy.store'));
}

</script>
