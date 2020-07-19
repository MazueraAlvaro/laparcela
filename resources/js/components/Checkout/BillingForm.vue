<template>
    <div>
        <alert-error :form="form" message="Se encontraron algunos errores en el formulario."></alert-error>
        <div class="row">
            <div class="col-lg-6">
                <div class="checkout__input">
                    <p>Nombre<span>*</span></p>
                    <input
                        type="text"
                        v-model="form.first_name"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('first_name') }"
                    >
                    <has-error :form="form" field="first_name"></has-error>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="checkout__input">
                    <p>Apellidos<span>*</span></p>
                    <input
                        type="text"
                        v-model="form.last_name"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('last_name') }"
                    >
                    <has-error :form="form" field="last_name"></has-error>
                </div>
            </div>
        </div>
        <div class="checkout__input">
            <p>Dirección<span>*</span></p>
            <input
                type="text"
                placeholder="Dirección de entrega"
                class="checkout__input__add form-control"
                v-model="form.address"
                :class="{ 'is-invalid': form.errors.has('address') }">
                <has-error :form="form" field="address"/>
            <input
                type="text"
                placeholder="Unidad residencial, Bloque, Apto (opcional)"
                v-model="form.address_additional"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('address_additional') }"
            >
            <has-error :form="form" field="address_additional"/>
        </div>
        <div class="checkout__input">
            <p>Ciudad<span>*</span></p>
            <input
                type="text"
                v-model="form.city"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('city') }"
            >
            <has-error :form="form" field="city"></has-error>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="checkout__input">
                    <p>Teléfono<span>*</span></p>
                    <input
                        type="text"
                        v-model="form.phone"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('phone') }"
                    >
                    <has-error :form="form" field="phone"></has-error>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="checkout__input">
                    <p>Correo Electrónico<span>*</span></p>
                    <input
                        type="email"
                        v-model="form.email"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('email') }"
                    >
                    <has-error :form="form" field="email"></has-error>
                </div>
            </div>
        </div>
        <div class="checkout__input">
            <p>Notas adicionales</p>
            <input
                type="text"
                placeholder="Notas sobre su pedido, ej. notas especiales para la entrega."
                v-model="form.notes"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('notes') }"
            >
            <has-error :form="form" field="notes"></has-error>
        </div>
    </div>
</template>

<script>
    import {Form, HasError, AlertError} from "vform";
    Vue.component(HasError.name, HasError)
    Vue.component(AlertError.name, AlertError)
    export default {
        name: "BillingForm",
        data(){
            return {
                form: new Form({
                    first_name: '',
                    last_name: '',
                    city : '',
                    address: '',
                    address_additional: '',
                    phone : '',
                    email : '',
                    notes : '',
                }),
            }
        },
        methods:{
            async sendForm(){
                    return this.form.post("/api/order");
            },
            formKeyDown($event){
                this.form.onKeydown($event)
            }
        }
    }
</script>

<style scoped>

</style>
