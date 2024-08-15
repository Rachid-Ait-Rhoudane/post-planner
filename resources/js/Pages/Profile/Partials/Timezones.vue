<script setup>
import { ref } from 'vue';
import { router, useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import FormSection from '@/Components/FormSection.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectInput from '../../../Components/SelectInput.vue';

let props = defineProps({
    timezones: {
        type: Array,
        required: true
    }
});

const form = useForm({
    _method: 'PUT',
    timezone: 'UTC',
});
</script>

<template>
    <FormSection>
        <template #title>
            Timezones
        </template>

        <template #description>
            Set your timezone to manage content across your social media channels accurately
        </template>

        <template #form>

            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="timezones" value="Timezones" />
                <SelectInput id="timezones" v-model="form.timezone">
                    <option v-for="timezone in timezones" :value="timezone" :key="timezone + new Date().getTime()">{{ timezone }}</option>
                </SelectInput>
                <InputError :message="form.errors.timezone" class="mt-2" />
            </div>

        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </PrimaryButton>
        </template>
    </FormSection>
</template>
