<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <br>
                <h4>{{name}}</h4>
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Donnez un à votre planing</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="name">
                        <small id="emailHelp" class="form-text text-muted">Ce nom est arbitraire.</small>
                    </div>
                    <button class="btn btn-primary"  @click.prevent="createPlanning">Créer</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                name : ''
            }
        },

       props: ['visible'],
       methods:{
           createPlanning(){
               axios.post('/planning',{
                   name : this.name
               })
               .then( (response)=> {
                    this.$emit('planningcreated',response);
                })
                .catch(function (error) {
                    console.log(error);
                });
           }
       }
    }
</script>
