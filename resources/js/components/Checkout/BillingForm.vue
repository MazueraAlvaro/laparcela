<template>
    <div>
        <div class="row">
            <div class="col-lg-6">
                <div class="checkout__input">
                    <p>Nombre<span>*</span></p>
                    <input type="text">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="checkout__input">
                    <p>Apellidos<span>*</span></p>
                    <input type="text">
                </div>
            </div>
        </div>
        <div class="checkout__input form-group">
            <p>Dirección<span>*</span></p>
            <input type="text" placeholder="Dirección de entrega" class="checkout__input__add form-control is-invalid">
            <input type="text" placeholder="Unidad residencial, Bloque, Apto (opcional)">
        </div>
        <div class="checkout__input">
            <p>Ciudad<span>*</span></p>
            <input type="text">
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="checkout__input">
                    <p>Teléfono<span>*</span></p>
                    <input type="text">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="checkout__input">
                    <p>Correo Electrónico<span>*</span></p>
                    <input type="text">
                </div>
            </div>
        </div>
        <div class="checkout__input">
            <p>Notas adicionales<span>*</span></p>
            <input type="text"
                   placeholder="Notas sobre su pedido, ej. notas especiales para la entrega.">
        </div>
    </div>
</template>

<script>
    export default {
        name: "BillingForm",

    }
</script>

<style scoped>

</style>
