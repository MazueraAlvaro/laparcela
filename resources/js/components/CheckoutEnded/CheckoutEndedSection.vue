<template>
    <section class="contact spad">
        <b-overlay :show="typeof order.number !== 'string'">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 offset-md-4 offset-lg-4 offset-sm-3 text-center">
                        <div class="contact__widget">
                            <span class="icon_check_alt2"></span>
                            <h4>Orden #{{order.number}} Recibida</h4>
                            <p>Tu orden ha sido recibida por nosotros y pronto estará contigo</p>
                        </div>
                    </div>
                </div>
                <b-table :items="order.products" :fields="fields">
                    <template v-slot:cell(number)="data">
                        {{ data.index + 1 }}
                    </template>
                    <template v-slot:custom-foot="data">
                        <b-tr>
                            <b-th colspan="5" class="text-right" >SUBTOTAL</b-th>
                            <b-th>{{formatValue(order.subtotal)}}</b-th>
                        </b-tr>
                        <b-tr>
                            <b-th colspan="5" class="text-right" >DOMICILIO</b-th>
                            <b-th>{{formatValue(delivery)}}</b-th>
                        </b-tr>
                        <b-tr>
                            <b-th colspan="5" class="text-right" >TOTAL</b-th>
                            <b-th>{{formatValue(order.total + delivery)}}</b-th>
                        </b-tr>
                    </template>
                </b-table>
            </div>
        </b-overlay>
    </section>
</template>

<script>

    export default {
        name: "CheckoutEndedSection",
        props: ["order"],
        data(){
            return {
                delivery: 3000,
                fields: [
               {
                   key: 'number',
                   label: 'Item',
               },
               {
                   key: 'name',
                   label: 'Producto',
               },
               {
                   key: 'quantity',
                   label: 'Cantidad',
               },
               {
                   key: 'unit',
                   label: 'Unidad',
               },
               {
                   key: 'price',
                   label: 'Valor',
                   formatter: this.formatValue
               },
               {
                   key: 'subtotal',
                   label: 'Valor Total',
                   formatter: this.formatValue
               }
           ]
            }
        },
        methods: {
            formatValue(value){
                console.log(value)
                return "$" + new Intl.NumberFormat('de-DE',
                    {useGrouping: true, minimumFractionDigits: 2})
                    .format(value);
            }
        }
    }
</script>

<style scoped>

</style>
