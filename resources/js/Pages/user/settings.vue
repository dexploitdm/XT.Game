<script setup>
import BreezeMainLayout from '@/Layouts/Main.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';
import {ref} from "vue";

const form = useForm({
    old_password: '',
    new_password: '',
    new_password_confirmation: ''
});

const error_valid = ref()
const errorNewPass = ref(false)

const changePass = () => {
    if(form.new_password && form.new_password_confirmation) {
        (form.new_password !== form.new_password_confirmation) ? (error_valid.value = 'Пароли не совпадают', errorNewPass.value = true) : (error_valid.value = undefined, errorNewPass.value = false)
    }
}

const submit = () => {
    if(!errorNewPass.value){
        form.post(route('password.change'), {
            onFinish: () => form.reset(),
        })
    }
};

</script>

<template>
    <Head title="Покупайте игры по выгодной цене" />
    <BreezeMainLayout>
        <div class="page-layout">
            <div class="layout">
                <div class="layout-box layout-box_x2">
                    <div class="bg-w xt-box">
                        <form @submit.prevent="submit" class="x-form">
                            <div class="x-form-title">
                                Смена пароля
                            </div>
                            <div v-if="$page.props.flash.message === '1'" class="alert alert-success shadow-lg">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    Пароль успешно изменен!
                                </div>
                            </div>
                            <div v-else-if="$page.props.flash.message || error_valid" class="alert alert-error shadow-lg">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    <span v-if="$page.props.flash.message">{{ $page.props.flash.message }}</span>
                                    <span v-else>{{error_valid}}</span>
                                </div>
                            </div>
                            <div class="x-form-control">
                                <label>Пароль</label>
                                <input class="x-input" type="password" v-model="form.old_password" autocomplete="current-password" autofocus="">
                            </div>
                            <div class="x-form-control" :class="{ 'error' : errorNewPass }">
                                <label>Новый пароль</label>
                                <input class="x-input" type="password" v-model="form.new_password" v-on:change="changePass" autocomplete="current-password" autofocus="">
                            </div>
                            <div class="x-form-control" :class="{ 'error' : errorNewPass }">
                                <label>Подтвердите пароль</label>
                                <input class="x-input" type="password" v-model="form.new_password_confirmation" v-on:change="changePass" autocomplete="current-password" autofocus="">
                            </div>
                            <button class="xt-btn color-10 x-form-submit"  :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeMainLayout>
</template>
