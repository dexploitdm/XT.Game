<script setup>
import BreezeCheckbox from '@/Components/Checkbox.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeInputError from '@/Components/InputError.vue';
import BreezeLabel from '@/Components/Label.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <BreezeGuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="x-form-auth">
            <div>
                <BreezeLabel for="email" value="Email" />
                <BreezeInput id="email" type="email" class="x-input x-input-border" v-model="form.email" required autofocus autocomplete="username" />
                <BreezeInputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="password" value="Пароль" />
                <BreezeInput id="password" type="password" class="x-input x-input-border" v-model="form.password" required autocomplete="current-password" />
                <BreezeInputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <BreezeCheckbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">Оставаться в системе</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Забыли пароль?
                </Link>
                <button class="xt-btn color-10 ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Вход</button>
            </div>
        </form>
    </BreezeGuestLayout>
</template>
