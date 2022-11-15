<script setup>
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeInputError from '@/Components/InputError.vue';
import BreezeLabel from '@/Components/Label.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <BreezeGuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit" class="x-form-auth">
            <div>
                <BreezeLabel for="name" value="Имя" />
                <BreezeInput id="name" type="text" class="x-input x-input-border" v-model="form.name" required autofocus autocomplete="name" />
                <BreezeInputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="email" value="Email" />
                <BreezeInput id="email" type="email" class="x-input x-input-border" v-model="form.email" required autocomplete="username" />
                <BreezeInputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="password" value="Пароль" />
                <BreezeInput id="password" type="password" class="x-input x-input-border" v-model="form.password" required autocomplete="new-password" />
                <BreezeInputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="password_confirmation" value="Подтвердите пароль" />
                <BreezeInput id="password_confirmation" type="password" class="x-input x-input-border" v-model="form.password_confirmation" required autocomplete="new-password" />
                <BreezeInputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Уже зарегистрированы?
                </Link>
                <button class="xt-btn color-10 ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Регистрация</button>
            </div>
        </form>
    </BreezeGuestLayout>
</template>
